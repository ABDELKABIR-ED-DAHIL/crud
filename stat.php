<?php
session_start();
if (!isset($_SESSION['password'])) {
    header('location:login.php');
} else {
    require('connexion.php');

    $query4 = "SELECT COUNT(consultation.foumisseurID) as nbr, consultation.villeID, ville.nom 
               FROM consultation  
               LEFT JOIN ville ON consultation.villeID = ville.villeID 
               GROUP BY villeID";

    $stm4 = $conn->prepare($query4);
    $stm4->execute();
    $row4 = $stm4->fetchAll();
//     $query4 = "SELECT  COUNT(consultation.patientID) as nbr_pat, consultation.specialiteID,specialite.nom 
// FROM consultation  
// LEFT JOIN specialite ON consultation.specialiteID = specialite.specialiteID 
// GROUP BY specialiteID";
// $stm4 = $connection->prepare($query4);
// $stm4->execute();
// $row4 = $stm4->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <?php require_once('nav/header.php'); ?>
    <div class="card mt-0">
        <div class="card-header">Les Statistiques des associations</div>
        <div class="container-fluid card-body">
            <div class="row">
                <div class="container col-2">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ville</th>
                                <th>Nb de demande</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($row4) {
                                foreach ($row4 as $result2) {
                            ?>
                                    <tr>
                                        <td>
                                            <?= $result2['nom'] ?>
                                        </td>
                                        <td>
                                            <?= $result2['nbr'] ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="2">
                                        Aucun Enregistrement Trouvé
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="2">
                                    <div class="d-flex justify-content-center">
                                        <a href="mibyan.php" class="btn btn-primary">mibyan</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('nav/footer.php'); ?>
</body>

</html>
<?php
}
?>
