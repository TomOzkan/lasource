<?php
session_start ();

//----------Parametre de la connexion----------
$servername = "localhost"; //adresse du serveur---
$database = "bdd"; //nom de la base de donnees
$username = "lasource"; //Identifiant de la bdd-------
$password = "yolo"; //Mot de passe--------------------
$conn = mysqli_connect($servername, $username, $password, $database);//Connexion a la base

if (!$conn) {
   die("Echec de la connexion : " . mysqli_connect_error());
}
$sql = mysqli_query($conn,'SELECT * from user WHERE mail="'.$_SESSION['mail'].'"');
?>
<!DOCTYPE HTML> 
<HTML> <!-- HTML -->
   <HEAD>
      <link rel="stylesheet" href="style.css"> <!-- lie la page html a la feuille de style -->
      <TITLE>BDD|Pannel </TITLE> <!-- titre de l'onglet -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   </HEAD>
   <body>
    <div class="decomail"><?php echo $_SESSION['mail']; ?> </div> </br> <div id="deco" ><a id="link" href="deco.php">Deconnexion </a></div>
      <div class="infobox">
	  <h1>Administration panel</h1>
     
      <?php
      
      while($row = $sql->fetch_assoc()){
         echo "User : ".$row['pseudo']."</br> Statut :".$row['type_user'];
        
         } 
      ?>
	  </div>
      <div class="box-user"> Utilisateurs </br></br>
      
<!-- Insertion d'une requete sql dans une div -->   
<form action="#" method="post">
<input type="text" id="name" name="name" placeholder="Entrez le pseudo">
<input type="text" id="ajoutcred" name="ajoutcred" placeholder="Entrez une valeurs de crédit"></br>
<input type="submit" id="okpost">
</form>
<p id="output">
</p>
<script type="text/javascript">


okpost.addEventListener("click", function() {
  <?php

    if( isset( $_POST['name'] ) )
    {
      $name = $_POST['name'];
      $changeCred = $_POST['ajoutcred'];
      $sqle = mysqli_query($conn,"UPDATE user SET credit='$changeCred' WHERE pseudo='$name' ");
    }

  ?>

}, false);

</script>

      </div>
<img class="logopannel" src="lasource.png">
   </body>
</HTML>
