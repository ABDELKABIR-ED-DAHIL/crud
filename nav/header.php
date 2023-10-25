<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="css/nav.css"> -->
    <style>
   ul {
  display: flex;
 font-family: "chivo Movo" , monospace;
 gap: 40px; 
 align-items: center;


}

.navbar-left img {
  width: 100px;
  height: 70px;
  object-fit: cover;
  margin-right: 10px;
}

/* .navbar-right button {
  margin-left: 10px;
  padding: 10px 20px;
  border: none;
  background-color: #b593d6;
  color: #fff;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
} */
/* .button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border-radius: 5px;
  text-decoration: none;
  font-size: 16px;
} */

/* .button:hover {
  background-color: #0062cc;
} */

/* .navbar-right button:hover {
  background-color:#36edf4;
} */

ul li {
  list-style: none;
}

ul li a {
font-size: 20px;
font-weight: 700;
text-decoration: none;
text-transform: uppercase;
color:yellow;
transition: 0.5s ease;
display: inline-block;

}
ul:hover li a {
 color: #36edf4;

}

ul:hover li a:not(:hover) {
 color: white;
 opacity: 0.3;
 filter: blur(1px);

}
nav {
  background-color:darkseagreen;
  width: 100%;
}


    </style>
  </head>
  <body>
  <nav class="navbar">
    <div class="navbar-left">
      <img src="image/marouane.png " alt="Votre image">
    </div>
      <ul class="nav-list">
        <li class="nav-item"><a href="form.php">Form</a></li>
        <li class="nav-item"><a href="backend.php">Affichage</a></li>
        <li  class="nav-item"><a href="logout.php">Logout</a></li>
        <li  class="nav-item"><a href="stat.php">Graph</a></li>

      </ul>
    <!-- <div class="navbar-right">
      <button><a href="">Button</a></button>
      <button><a href="">Button</a></button>
    </div> -->
  </nav>
  </body>
</html> 
<!-- "SELECT COUNT(consultation.foumisseurID) AS nbr, consultation.villeID, nom
           FROM consultation  
           LEFT JOIN foumisseur ON consultation.villeID = foumisseur.foumisseurID
           GROUP BY villeID"; -->
