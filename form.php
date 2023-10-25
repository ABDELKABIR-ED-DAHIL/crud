<?php
session_start();
if(isset($_SESSION['password'])){
    
?>
<?php
require('connexion.php');
if (isset($_POST['submit'])) {
    $namber = $_POST['namber'];
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $ville = $_POST["ville"]; 
    $sql = "INSERT INTO foumisseur (namber, nom, adresse)
    VALUES (:namber, :nom, :adresse)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['namber' => $namber, 'nom' => $nom, 'adresse' => $adresse]);
    $foumisseurID = $conn->lastInsertId();
    foreach ($ville as $value) {
        $sql = "INSERT INTO consultation (villeID,foumisseurID) VALUES (:value, :foumisseurID)";
        $statement = $conn->prepare($sql);
        $statement->execute([':value' => $value, 'foumisseurID' => $foumisseurID]);
    };
    if ($statement) {
        echo "<script>alert('Succesfully registred')</script>";
        header('Location:backend.php');
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
    <style>
        /* Set the font family and size for the whole page */
body {
  /* font-family: Arial, sans-serif; */
  font-size: 25px;
  background-image: url('image/ville1.jpg');
			background-size: cover;
			margin: 0;
			padding: 0;
}

/* Center the container and give it a max width */
.container {
  max-width: 1000px;
  margin: 20px auto;
}

/* Add some padding and a background color to the card */
.cardcolor {
  background-color: #f5f5f5;
  padding: 20px;
}

/* Style the card header */
.card-header {
  font-size: 24px;
  font-weight: bold;
  text-align: center;
  margin-bottom: 60px;
  color:darkgoldenrod;
}

/* Style the form labels */
label {
  font-size: 18px;
  font-weight: bold;
  color: #212529;
}

/* Add some margin to the form inputs */
.form-group {
  margin-bottom: 20px;
}

/* Style the form submit button */
#submit {
  background-color: #007bff;
  color: #fff;
  border: none;
  font-size: 20px;
  padding: 10px 20px;
  margin-top: 20px;
}

/* Style the form checkbox labels */
.form-check-label {
  font-size: 16px;
  font-weight: normal;
  color: #212529;
}

/* Add some margin to the form checkbox inputs */
.form-check {
  margin-bottom: 10px;
}

/* Style the form input fields */
.form-control {
  border-color: #ced4da;
}

/* Style the selected options in the form select field */
select option:checked {
  background-color: #007bff;
  color: #fff;
}

    </style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style/formstyle.css">
    <title>Document</title>
</head>

<body>
<?php
    require_once('nav/header.php')
    ?>
    
    <div class="container col-12 bg-success">
        <div class="card cardcolor">
        <div class="card-header bg-info">
            Foumisseur

            </div>
            <form class=" container  d-flex justify-content-center card-body"  method="post">
                <div class="col-11">
                    <div class="form-group">
                        <label for="nom">NbrFoumisseur:</label>
                        <input type="text" class="form-control" id="namber" name="namber" required>
                    </div>

                    <div class="form-group">
                        <label for="num_tel">Nom :</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="num_tel">Adresse :</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>

                    <div class="form-group">
                        <label>Ville :</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ville[]" value="1" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                agadir
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ville[]" value="2" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              morrakech
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ville[]" value="3" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                fés
                            </label>
                    </div>
                    <div>
                        <input required type="submit" name="submit" id="submit" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div><br>
    <pre>
    </pre>

    <?php
    require_once('nav/footer.php')
    ?>

</body>
</html>
<?php 

}else{
    header('location:login.php');}?>