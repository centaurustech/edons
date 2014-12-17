<html>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv="refresh" content="2; url=https://src-projet2.pu-pm.univ-fcomte.fr/projets-co/projet33/Site-final/index.php" />
   	 	<title>Edons (Site final) | Validation suppression</title>
   	 	<link rel='stylesheet' href='css/styles-mise-en-page.css'>
		<link rel='stylesheet' href='css/styles-typographie-couleur.css'>
		<link rel='stylesheet' href='css/styles-graphique.css'>
		<link rel="icon" href="css/images-interface/favicon.ico"/>
    </head>
</html>
<?php
	session_start();
	include('connect.php');
	if(!(isset($_SESSION['login']))) header ('location:index.php');
		
		$select="SELECT ImgProfilUser from User WHERE IDUser=".$_GET['id'].";";

		$result=mysql_query($select);
		$image=mysql_result($result,0,0);


	//====SUPRESSION====
	
	$requete="DELETE FROM Don WHERE IDUser=".$_GET['id'].";";
	$result=mysql_query($requete);
	$requete="DELETE FROM Media WHERE IDUser=".$_GET['id'].";";
	$result=mysql_query($requete);
	$requete="DELETE FROM Commentaire WHERE IDUser=".$_GET['id'].";";
	$result=mysql_query($requete);
	$requete="DELETE FROM Projet WHERE IDUser=".$_GET['id'].";";
	$result=mysql_query($requete);
	$requete="DELETE FROM User WHERE IDUser=".$_GET['id'].";";
	$result=mysql_query($requete);
	$nb=mysql_affected_rows();
	
	if($nb==0){
		echo "<p>Suppression ratée.</p>";
	}
	else{

		
		unlink("css/images-contenu/upload/profil-user/".$image);
		echo "<p>Suppression éffectuée.</p>";
		unset($_SESSION);
		unset($_COOKIE);
		session_destroy();
	}
?>