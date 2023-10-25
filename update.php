<?php
session_start();
if(!isset($_SESSION['password'])){
    header('location:login.php');
}else{

?>
<?php
require('connexion.php');
$id = $_GET['id'];
if (isset($_POST['submit'])) {
    $namber = $_POST['namber'];
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $ville = $_POST["ville"];

    $sql = "UPDATE foumisseur 
    SET namber = :namber , nom = :nom , adresse = :adresse
    WHERE foumisseurID = :id ";
    $statement = $conn->prepare($sql);
    $statement->execute([':namber' => $namber, ':nom' => $nom, ':adresse' => $adresse,  ':id' => $id]);
    // Delete the existing consultation for the patient
    $sql2 = "DELETE from consultation where foumisseurID=:foumisseurID ";
    $statement2 = $conn->prepare($sql2);
    $statement2->execute([':foumisseurID' => $id]);


    // Insert the consultation table new information 
    foreach ($ville as $value) {
        $sql3 = "INSERT INTO consultation (villeID, foumisseurID) VALUES (:value, :foumisseurID)";
        $statement3 = $conn->prepare($sql3);
        $statement3->execute([':value' => $value, ':foumisseurID' => $id]);
    }
    if ($statement and $statement2 and $statement3) {

        header('location:backend.php?msg=Data updated successfully');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php
    // require_once('inc/header.php')
    ?>
    <?php
    //this request is for collect the information from table patient and specialite with join to join between the 3 table
    $sql = "SELECT p.*, GROUP_CONCAT(s.nom SEPARATOR ',') as ville
            FROM foumisseur p
            JOIN consultation c ON p.foumisseurID = c.foumisseurID
            JOIN ville s ON c.villeID = s.villeID
            WHERE p.foumisseurID = :id
            LIMIT 1";

    $statement = $conn->prepare($sql);
    $statement->execute([':id' => $id]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    // $exploded_rdv = explode(" ", $row['rdv']);
    ?>
      <?php
    require_once('nav/header.php')
    ?>
    <form class=" container  d-flex justify-content-center " method="post">
        <div class="col-6">
            <div class="form-group">
                <label for="nom">NbrFoumisseur:</label>
                <input type="text" class="form-control" id="namber" name="namber" value="<?php echo $row['namber']; ?>" required>
            </div>

            <!-- <div class="form-group">
                <label for="sex">Sexe:</label>
                <select class="form-control" id="sexe" name="sexe" required>
                    <option value="">Sélectionnez</option>
                    <option value="homme" ?php echo ($row['sexe'] == 'homme') ? "selected" : ""; ?>>Homme</option>
                    <option value="femme" ?php echo ($row['sexe'] == 'femme') ? "selected" : ""; ?>>Femme</option>
                </select>
            </div> -->
            <div class="form-group">
                <label for="num_tel">Nom :</label>
                <input type="tel" class="form-control" id="nom" name="nom" value="<?php echo $row['nom']; ?>" required>
            </div>
            <!-- <div class="form-group">
                <label>Avez-vous déjà consulter ce médicine?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="consultatoinmed" id="oui" value="1" ?php echo ($row['specialite_boolean'] == '1') ? "checked" : ""; ?>>
                    <label class="form-check-label" for="oui">
                        Oui
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="consultatoinmed" id="non" value="0" ?php echo ($row['specialite_boolean'] == '0') ? "checked" : ""; ?>>
                    <label class="form-check-label" for="non">
                        Non
                    </label>
                </div>
            </div> -->
            <div class="form-group">
                <label for="num_tel">Adresse :</label>
                <input type="tel" class="form-control" id="adresse" name="adresse" value="<?php echo $row['adresse']; ?>" required>
            </div>
            <div class="form-group">
                <label>Ville :</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="ville[]" value="1" <?php echo (str_contains($row['ville'], ' agadir')) ? "checked" : ""; ?> id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                     agadir
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="ville[]" value="2" <?php echo (str_contains($row['ville'], 'morrakech')) ? "checked" : ""; ?> id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    morrakech
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="ville[]" value="3" <?php echo (str_contains($row['ville'], ' fés')) ? "checked" : ""; ?> id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    fés
                    </label>
                </div>
                
            <!-- <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="date">Date du rendez-vous:</label>
                        <input type="date" class="form-control" id="date" name="date" value="?php echo $exploded_rdv[0]; ?>" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="heure">Heure du rendez-vous:</label>
                        <input type="time" class="form-control" id="heure" name="heure" value="?php echo $exploded_rdv[1]; ?>" required>
                    </div>
                </div>
            </div> -->
            <div class="container">
                <div class="row">
                    <div class="col-md-6 py-3  text-center col">
                        <button type="submit" class="btn btn-success" name="submit">Update</button>
                    </div>
                    <div class="col-md-6 py-3  text-center col">
                        <a href="backend.php" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    require_once('nav/footer.php')
    ?>

</body>

</html>
<?php 
 }?>