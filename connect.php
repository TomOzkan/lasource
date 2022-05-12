
<?php

// retenir l'email de la personne connectée pendant 1 an

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
$mdp = $_POST['mdp']; //mot de passe
$mail = $_POST['mail'];//e-mail-----


//----------requete sql pour selectionné des données de la bdd----------
//$sql = mysqli_query($conn, "SELECT * FROM user WHERE mail = '".$_POST['mail']."'");
//$sql = mysqli_query($conn, "SELECT * FROM user WHERE mdp = '".$_POST['mdp']."'");

if (isset($_POST['mail'])){
	$mail = stripslashes($_REQUEST['mail']);
	$mail = mysqli_real_escape_string($conn, $mail);
	$mdp = stripslashes($_REQUEST['mdp']);
	$mdp = mysqli_real_escape_string($conn, $mdp);
    $query = "SELECT * FROM `user` WHERE mail='$mail' and mdp='".hash('sha256', $mdp)."'";
	$result = mysqli_query($conn,$query);
	while($row = $result->fetch_assoc()){
		echo "Statut :".$row['type_user'];
		$type=$row['type_user'];
		} 
	$rows = mysqli_num_rows($result);
	if($type='Joueur'){
          session_start ();
	      $_SESSION['mail'] = $mail;
	      header("Location:membre.html");
	}
		  if($type='admin'){
			session_start ();
			$_SESSION['mail'] = $mail;
			header("location:adminpanel.php");
	}
	else{
		echo "Le nom d'utilisateur ou le mot de passe est incorrect.";
	}
}

//if(mysqli_num_rows($sql)) {
      
  //    $_SESSION['mail']=$_POST['mail'];
    //  $_SESSION['mdp']=$_POST['mdp'];
  //    header("Location:adminpanel.php");
   //   die(); //L'adresse mail et le mot de passe sont valide
//}else{
      //echo "PAS OK"; //Le mot de passe ou l'email n'est pas valide
//}
//Fermer la connexion 
mysqli_close($conn);