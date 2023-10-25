
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
  

</head>


    <body>
<form  method="post" >
  <div class="container">
  <div class="brand-logo"  ></div>
  <div class="title" style="color:aquamarine; font-size:40px">LOGIN</div>
  <div class="inputs">
    <label>Nom:</label>
    <input type="text" name="login" placeholder="your name" />
    <label>Password:</label>
    <input type="password" name="password" placeholder="password" />
    <button type="submit" name="submit" style="background-color: aquamarine;">Envoyer</button>
  </div>
</body>

</html>

<?php
require_once 'connexion.php';
if (isset($_POST['submit']) && ($_POST['login']) && isset($_POST['password'])) {
    $nom = $_POST['login'];
    $password = $_POST['password'];
    $sql = "SELECT login, pass FROM user WHERE login = :login AND pass = :pass";
    $statement = $conn->prepare($sql);
    $statement->execute([':login' => $nom, ':pass' => $password]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    
    if(isset($_POST['submit']) and $user['login'] == $nom && $user['pass'] == $password){
        setcookie("Pc_name",gethostname(), time() + (86400 * 30), "/");
        session_start();
        $_SESSION['password']= $password;
        $_SESSION['username']= $nom;
        header('Location: form.php');
    }
    else{
        echo '<script>alert("Invalid password or Username")</script>';
    }
 
}
?>
