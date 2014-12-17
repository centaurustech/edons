<?php
	include('connect.php');
	
	$requete="SELECT emailNewsletter FROM Newsletter ;";
	$result=mysql_query($requete);
	
	$liste = 'lu.simeon@gmail.com';
	while ($donnees = mysql_fetch_assoc($result))
    {	
    	$liste .= ',';
		$liste .= $donnees['emailNewsletter'];
    }
    $headers .= 'Bcc:' . $liste . '' . "\r\n";
?>
	