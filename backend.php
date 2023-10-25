<?php
session_start();
if(!isset($_SESSION['password'])){
    header('location:login.php');
}else{

?>
<?php
include('connexion.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="style/formstyle.css">
    <script src="https://kit.fontawesome.com/9d4783e555.js" crossorigin="anonymous"></script>
   
    <title>FOURMULER</title>
   
    <style>
  body {
    background-color: #fff;
  }

  .card-header {
    background-color:cadetblue;
    color:#343a40;
  }

  .btn-secondary {
    background-color: #D21312;
    border-color: #D21312;
  }

  .btn
{
color: #fff;
}

.ajouter_btn {
margin-left: auto;
}

th {
background-color:darkgrey;
color:black;
}

td {
background-color: #fff;
}

.fa-trash {
vertical-align: middle;
}

.danger {
color: #D21312;
}

#table_data_wrapper {
padding: 100%;
}
</style>

</head>

<body>
    <?php
    require_once('nav/header.php');
    ?>
<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="row align-items-center text-center">
        <h3 class="col mb-0">Foumisseur Information</h3>
        
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <table class="table table-striped table-bordered" id="table_data">
          <thead>
            <tr>
            <th>ID</th>
            <th>NbrFoumisseur</th>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Ville</th>
            <th>modifier</th>
            <th>delet</th>
            <th>PDF</th>



            </tr>
          </thead>
          <tbody>
            <?php
              $query = "SELECT foumisseur.foumisseurID, foumisseur.namber, foumisseur.nom, foumisseur.adresse, GROUP_CONCAT(ville.nom SEPARATOR '<br>') as villes
                        FROM foumisseur 
                        LEFT JOIN consultation ON foumisseur.foumisseurID = consultation.foumisseurID 
                        LEFT JOIN ville ON consultation.villeID = ville.villeID
                        GROUP BY  foumisseur.foumisseurID, foumisseur.namber , foumisseur.nom, foumisseur.adresse";
              $statement = $conn->prepare($query);
              $statement->execute();
              $resault = $statement->fetchAll(PDO::FETCH_ASSOC);
              if ($resault) {
                foreach ($resault as $row) {
            ?>
                  <tr>
                     <td><?= $row['foumisseurID'] ?></td>
                     <td><?= $row['namber'] ?></td>
                     <td><?= $row['nom'] ?></td>
                     <td><?= $row['adresse'] ?></td>
                     <td><?= $row['villes'] ?></td>
                                 
                    <td><a href="update.php?id=<?= $row['foumisseurID']; ?>" class="btn btn-warning"> Update</a></td>
                    <td><a href="delete.php?id=<?php echo $row['foumisseurID']; ?>" onclick="return confirm('Are you sure you want to delete this Foumisseur?')" class="btn btn-danger"><i class="fas fa-trash">delete</i></a></td>
                    <td><a href="FPDF.php?id=<?= $row['foumisseurID']; ?>" class="btn btn-success">PDF</a></td> 
     
            <?php
                }
              } else {
            ?>
                <tr>
                  <td colspan="8">
                    No Records Found
                  </td>
                </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

    </div>
    
    <?php
    require_once('nav/footer.php')
    ?>

</body>

</html>
<?php  
}?>