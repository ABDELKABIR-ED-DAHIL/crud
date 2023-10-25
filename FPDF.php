<?php
session_start();
if(!isset($_SESSION['password'])){
    header('location:login.php');
}else{

?>
<?php
require('connexion.php');
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <title>Document</title>
</head>

<body>
    <?php
    require_once('nav/header.php')
    ?>
    <img src="image/cmc.jpg" class="rounded float-start" alt="" width="150px">
    <img src="image/agadir.jpg" class="rounded float-end " alt="" width="200px">
    <div class="container col-7">

        <table class="table">
            <?php
            $sql = "SELECT p.*, GROUP_CONCAT(s.nom SEPARATOR '<br>') as villes
            FROM foumisseur p
            JOIN consultation c ON p.foumisseurID = c.foumisseurID
            JOIN ville s ON c.villeID = s.villeID
            WHERE p.foumisseurID = :id
            LIMIT 1";

            $statement = $conn->prepare($sql);
            $statement->execute([':id' => $id]);
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            ?>
            <tr>
                <th>namber</th>
                <td><?php echo $row['namber']; ?></td>
            </tr>
            <tr>
                <th>Nom</th>
                <td><?= $row['nom'] ?></td>
            </tr>
            <tr>
                <th>adresse</th>
                <td><?= $row['adresse'] ?></td>
            </tr>
            <tr>
                <th>les villes</th>
                <td><?= $row['villes'] ?></td>
            </tr>

            <tr>

                <td class="d-flex justify-content-center ">
                    <a href="download.php?id=<?= $id; ?>" class="btn btn-success">Download &nbsp <i class="fa fa-download"></i></a>
                </td>
            </tr>
        </table>
    </div><br>
    <pre>



    </pre>
   
    <img src="image/MORAKECH.jpg" class="rounded float-start" alt="" width="200px">
    <img src="image/fes2.jpg" class="rounded float-end " alt="" width="200px"><br>
    <pre>




    </pre>
    <?php require_once('nav/footer.php'); ?>

</body>

</html>
<?php  }?>