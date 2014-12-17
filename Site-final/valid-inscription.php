<?php
	include('connect.php');
	session_start();

	$id=$_GET['id'];

	$key=$_GET['key'];
	$type=$_GET['type'];

echo "<html>";
	echo"<head>";
	echo"<meta charset='utf-8'>";		
		echo"<meta http-equiv='refresh' content='2; url=https://src-projet2.pu-pm.univ-fcomte.fr/projets-co/projet33/Site-final/modif-user.php?id=".$id."' />"; ?>
		
   	 	<title>Edons (Site final) | Validation inscription</title>
		<link rel="icon" href="css/images-interface/favicon.ico"/>
    </head>
</html>


<?php

	
	$requete="SELECT LoginUser FROM User WHERE IDUser=".$id.";";
	$result=mysql_query($requete);
	$email=mysql_result($result,0,0);
	
	$emailMd5=md5($email);
	
	if($emailMd5==$key){
		
		$requete="UPDATE User SET IDType=".$type." WHERE IDUser=".$id.";";
		$result=mysql_query($requete);
		
		if($result){
			echo "Inscription réussie";
			$_SESSION['login']=$email;
			$_SESSION['id']=$id;
			$_SESSION['type']=$type;
		}
		
	}
	else{
			echo"Les adresses mails ne correspondent pas.";
		}
?>