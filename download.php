<?php
// require('connexion.php');
// require('fpdf/fpdf.php');

// $id = $_GET['id'];

// class PDF extends FPDF
// {
//     // Page header
//     function Header()
//     {
//         // Logo

//         // Arial bold 15
//         $this->SetFont('Arial','B',15);
//         // Move to the center of the page
//         $this->Cell(0,30,'',0,1,'C');
//         // Title
//         $this->Cell(0,10,'Facteur',0,1,'C');
//         // Line break
//         $this->Ln(10);
//     }

//     // Page footer
//     function Footer()
//     {
//         // Position at 1.5 cm from bottom
//         $this->SetY(-15);
//         // Arial italic 8
//         $this->SetFont('Arial','I',8);
//         // Page number
//         $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
//     }
// }

// Instanciation of inherited class
// $pdf = new PDF();
// $pdf->AliasNbPages();
// $pdf->AddPage();
// $pdf->SetFont('Arial','',12);

// $sql = "SELECT p.*, GROUP_CONCAT(s.nom SEPARATOR '<br>') as villes
//             FROM foumisseur p
//             JOIN consultation c ON p.foumisseurID = c.foumisseurID
//             JOIN ville s ON c.villeID = s.villeID
//             WHERE p.foumisseurID = :id
//             LIMIT 1";

// $statement = $conn->prepare($sql);
// $statement->execute([':id' => $id]);
// $row = $statement->fetch(PDO::FETCH_ASSOC);

// // Center the text vertically and horizontally
// $pdf->Cell(0, 0, '', 0, 1, 'C');
// $pdf->MultiCell(0, 10, "Nom: ".$row['nom']."\nnum: ".$row['namber']."\nadresse: ".$row['adresse']."\nLes ville: ".$row['villes']);

// $pdf->Output();
?>


<?php

    require_once('fpdf/fpdf.php');
    require('connexion.php');

    $id = $_GET['id'];

    class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            // Logo
            $this->Image('image/cmc.jpg',10,6,30);
            $this->Image('image/city.jpg',180,6,30);
            $this->Image('image/qr.jpg',6,260,30);
            $this->Image('image/tt.jpg',160,250,30);
            // Arial bold 15
            $this->SetFont('Arial', 'B', 15);
            // Move to the center of the page
            $this->Cell(0, 30, '', 0, 1, 'C');
            // Title
            $this->Cell(0, 10, '', 0, 1, 'C');
            // Line break
            $this->Ln(10);
        }

        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
    }

    // Fetch appointment data
    $stmt = $conn->prepare("SELECT v.foumisseurID, v.namber, v.nom, v.adresse, GROUP_CONCAT(t.nom SEPARATOR ', ') AS villes
                       FROM foumisseur v
                       INNER JOIN consultation a ON v.foumisseurID = a.foumisseurID
                       INNER JOIN ville t ON a.villeID  = t.villeID 
                       WHERE v.foumisseurID = :id
                       GROUP BY v.foumisseurID");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$appointment) {
        exit("Appointment not found");
    }

    // Create PDF instance
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);

    $pdf->SetFillColor(46, 361, 39);
    $pdf->Cell(0, 10, 'Details', 0, 1, 'C', true);

    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 12);

    $pdf->Cell(40, 10, 'namber:', 0, 0);
    $pdf->Cell(0, 10, $appointment['namber'], 0, 1);

    $pdf->Cell(40, 10, 'nom:', 0, 0);
    $pdf->Cell(0, 10, $appointment['nom'], 0, 1);

    $pdf->Cell(40, 10, 'adresse:', 0, 0);
    $pdf->Cell(0, 10, $appointment['adresse'], 0, 1);

    $pdf->Cell(40, 10, 'Ville:', 0, 0);
    $pdf->Cell(0, 10, $appointment['villes'], 0, 1);

    

    // $pdf->Cell(40, 10, 'Total Price:', 0, 0);
    // $pdf->Cell(0, 10, number_format($appointment['adresse'] * $appointment['villeCount'], 2), 0, 1);

    // Output the PDF
    $pdf->Output();
    

    

?>