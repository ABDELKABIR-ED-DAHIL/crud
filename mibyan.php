<?php
session_start();
if(!isset($_SESSION['password'])){
    header('location:login.php');
}else{

?>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "crudtp";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $e->getMessage();
}
$query4 = "SELECT COUNT(consultation.foumisseurID) as nbr, consultation.villeID, ville.nom 
               FROM consultation  
               LEFT JOIN ville ON consultation.villeID = ville.villeID 
               GROUP BY villeID";

    $stm4 = $conn->prepare($query4);
    $stm4->execute();
    $row4 = $stm4->fetchAll();

$nb1 = $row4[0]['nbr'] ?? 0;
$nb2 = $row4[1]['nbr'] ?? 0;
$nb3 = $row4[2]['nbr'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
</head>
<body>
<?php
    require_once('nav/header.php');
    ?>
  <canvas id="myChart"></canvas>
  <script>
    var nb1 =<?php echo json_encode($nb1); ?>;
    var nb2 =<?php echo json_encode($nb2); ?>;
    var nb3 =<?php echo json_encode($nb2); ?>;

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['agadir', 'morrakech', 'fés'],
    datasets: [{
      label: 'consultation',
      data: [nb1, nb2, nb3],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 0, 0, 0.2)'
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});
  </script>
   <?php
    require_once('nav/footer.php');
    ?>
  <?php
}

?>
</body>
</html>