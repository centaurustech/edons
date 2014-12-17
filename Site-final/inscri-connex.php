<?php
	session_start();
	include('connect.php');
?>
<html>
	<head>
		<meta charset='utf-8'>
   	 	<title>Edons (Site final) | Projet</title>
   	 	<link rel='stylesheet' href='css/styles-mise-en-page.css'>
		<link rel='stylesheet' href='css/styles-typographie-couleur.css'>
		<link rel='stylesheet' href='css/styles-graphique.css'>
		<link rel="icon" href="css/images-interface/favicon.ico"/>
   	</head>
    <body>
    	<?php 
    		include('header.php');
    	?>
    	<div class="corps" id="inscri-connex">
    		<section id="connexion">
    			<h3><span>Se connecter</span></h3>
    			<form method="POST" action="inscri-connex.php">
					<h4>Votre mail</h4><input type="email" name="mail" placeholder="nom@domaine.com"/>
					<h4>Mot de passe</h4><input type="password" name="pwd"/>
					<input class="submit" type="submit" name="connexion" value="Connexion"/>
				</form>
    		</section>
			<section id="inscription">
				<h3><span>S'inscrire</span></h3>
    			<form method="POST" action="inscri-connex.php">
					<h4>Votre mail</h4><input type="email" name="mail" placeholder="nom@domaine.com"/>
					<h4>Mot de passe</h4><input type="password" name="pwd"/>
					<h4>Validation mot de passe</h4><input type="password" name="pwdV"/>
					<h4>Votre statut</h4>
					<select name="type">
						<option value="2">Association</option>
						<option value="3">Particulier</option>
						<option value="4">Entreprise</option>
					</select>
					<h4>Êtes vous humain ?</h4><input type="number" name="captcha" placeholder="4 + 3"/>
					<input class="submit" type="submit" name="inscription" value="Inscription"/>
				</form>
    		</section>
  		</div>
    	<?php
    		include('footer.php');
    	?>
    </body>
</html>
<?php

	//=====================CONNEXION============================
	
	if(isset($_POST['connexion'])){
		if((!empty($_POST['mail']))&&(!empty($_POST['pwd']))){
			if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
			
				$mail = $_POST['mail']; 
				$mdp=md5($_POST['pwd']);
				
				$req="Select IDUser from User where LoginUser='".$mail."';";
				$result=mysql_query($req);
				$id=mysql_result($result,0,0);
				
				$req=mysql_query("select * From User where LoginUser='".$mail."' and MdpUser='".$mdp."';");
				$nb=mysql_num_rows($req);
				$tab=mysql_fetch_array($req);
				
				if($nb<1){
					echo "<script>alert(\"Vous n'êtes pas inscrit.\")</script>";
				}else{
					if($tab['IDType']>1){
						$_SESSION['login']=$mail;
						$_SESSION['id']=$id;
						$_SESSION['type']=$tab['IDType'];
						header('location: index.php');
					}else{
						echo "<script>alert(\"Vérifier la validation de votre inscription.\")</script>";
					}
				}
			}else{
				echo "<script>alert(\"Vérifier votre adresse mail.\")</script>";
			}
		}else{
			echo "<script>alert(\"Les champs sont vides.\")</script>";
		}
	}
?>
<?php

	//=====================INSCRIPTION============================
	
	if(isset($_POST['inscription'])){
		if((!empty($_POST['mail']))&&(!empty($_POST['pwd']))&&(!empty($_POST['pwdV']))){
			if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
				if($_POST['captcha']==7){
			
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
					echo "<script>alert(\"Le captcha n'est pas bon.\")</script>";
				}
				
			}else{
				echo "<script>alert(\"Vérifier votre adresse mail.\")</script>";
			}
			
		}else{
			echo "<script>alert(\"Les champs ne sont pas tous remplis.\")</script>";
		}
	}
?>