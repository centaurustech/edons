<?php
	include('connect.php');
	
	$id=$_GET['id'];
	$key=$_GET['key'];
	
	$requete="SELECT LoginUser FROM User WHERE IDUser=".$id.";";
	$result=mysql_query($requete);
	$email=mysql_result($result,0,0);
	
	$emailMd5=md5($email);
	
	if($emailMd5==$key){
		
		$requete="UPDATE User SET IDType=1 WHERE IDUser=".$id.";";
		$result=mysql_query($requete);
		
		if($result){echo"Inscription à la newsletter réussi";}
		else{echo"Les adresses mails ne correspondent pas.";}
	}
?>