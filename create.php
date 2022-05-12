<?php
session_start();
//----------Parametre de la connexion----------
$servername = "localhost"; //adresse du serveur---
$database = "bdd"; //nom de la base de donnees
$username = "lasource"; //Identifiant de la bdd-------
$password = "yolo"; //Mot de passe--------------------

//----------Connexion----------
$conn = mysqli_connect($servername, $username, $password, $database);
//Si la connexion ne marche pas afficher l'erreur
if (!$conn) {
      die("Échec de la connexion : " . mysqli_connect_error());
}

//----------variable----------
$mail = $_POST['mail'];
$mdp = $_POST['mdp'];
$pseudo = $_POST['pseudo'];
//----------requete sql pour crée des données dans la bdd----------
$sql = "INSERT INTO user (mail, mdp, pseudo, credit, use_credit) VALUES ('$mail', '".hash('sha256', $mdp)."', '$pseudo', '0', '0')";
//Si valide 
if (mysqli_query($conn, $sql)) {
    header("Location:registervalid.html");
    die();
//Sinon afficher l'erreur
} else {
      echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
}
//Fermer la connexion
mysqli_close($conn);