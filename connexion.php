<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crudtp";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    echo " ";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("<script>
    alert('Erreur de connexion à la base de données:' )
   </script>" . $e->getMessage());
}



?>


