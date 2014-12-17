<form method="POST" action="connexion.php">
	<p>Votre mail <input type="email" name="mail"/></p>
	<p>Mot de passe <input type="password" name="pwd"/></p>
	<input type="submit" name="connexion" value="Connexion"/>
</form>
<?php
	include('connect.php');
	session_start();
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