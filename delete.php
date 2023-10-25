<?php 
require('connexion.php');
$id = $_GET['id'];


// $query = "SET FOREIGN_KEY_CHECKS = 0";
// $stmt = $connection -> prepare($query);
// $stmt -> execute();



$sql = "DELETE from foumisseur where foumisseurID=:foumisseurID";
$statement = $conn -> prepare($sql);
$statement -> execute([':foumisseurID'=>$id]);

// $sql2 = "DELETE from consultation where patientID=:patientID";
// $statement2 = $connection -> prepare($sql2);
// $statement2 -> execute([':patientID'=>$id]);



// $query2 = "SET FOREIGN_KEY_CHECKS = 1";
// $stmt2 = $connection -> prepare($query2);
// $stmt2 -> execute();

if($statement){
    header('location:backend.php?msg=Pation deleted successfully');
}

?>