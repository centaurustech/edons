<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8"></meta>
    <title>Inscription</title>
	<script type="text/javascript" language="javascript" src="affiche.js"></script>
</head>
<body>
<nav>
	<form method="POST" action="inscription.php">
		<p>Votre mail <input type="email" name="mail" placeholder="nom@domaine.com"/></p>
		<p>Mot de passe <input type="password" name="pwd"/></p>
		<p>Validation mot de passe <input type="password" name="pwdV"/></p>
		<p>Votre statut 
			<select name="type">
				<option value="2">Association</option>
				<option value="3">Particulier</option>
				<option value="4">Entreprise</option>
			</select>
		</p>
		<input type="submit" name="inscription" value="Inscription"/>
	</form>
</nav>
<?php
	include('connect.php');
	if(isset($_POST['inscription'])){
		if((!empty($_POST['mail']))&&(!empty($_POST['pwd']))&&(!empty($_POST['pwdV']))){
			if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
			
				$mail = $_POST['mail']; 
	        	$mdp1=md5($_POST['pwd']);
				$mdp2=md5($_POST['pwdV']);
				$type=$_POST['type'];
			
				if($mdp1==$mdp2){
					$req=mysql_query("Select * From User where LoginUser='".$mail."'");
					$nb=mysql_num_rows($req);
					
					if($nb==0){
						$requete1="INSERT INTO User (LoginUser, MdpUser, IDType) VALUES('".$mail."', '".$mdp1."', 1);";
						$result=mysql_query($requete1);
						$id=mysql_insert_id();
						$key = md5($mail);
					
						$message="Pour vous inscrire à notre service vous devez valider votre inscription en cliquant sur le lien suivant:
						<a href=https://src-projet2.pu-pm.univ-fcomte.fr/projets-co/projet33/Site-final/valid-inscription.php?id=".$id."&key=".$key."&type=".$type.">Valider votre inscription</a>";
						$destinataire = $mail;
						$objet = "Inscription au site Edons";
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: Edons' . "\r\n";
			
						if ( mail($destinataire, $objet, $message, $headers) ){
							echo "<script>alert(\"Pour valider votre inscription, veuillez vérifier le mail qui vous a été envoyé sur votre adresse mail.\")</script>";
						}
						else{
							echo "<script>alert(\"Il y a eu une erreur lors de l'envoi du mail pour votre inscription.\")</script>";
						}
					}else{
						echo "<script>alert(\"Vous êtes deja inscrit.\")</script>";
					}
				}else{
					echo "<script>alert(\"Les mots de passe ne correspondent pas.\")</script>";
				}
			}else{
				echo "<script>alert(\"Vérifier votre adresse mail.\")</script>";
			}
		}else{
			echo "<script>alert(\"Les champs ne sont pas tous remplis.\")</script>";
		}
	}
?>
	
	
</body>
</html>