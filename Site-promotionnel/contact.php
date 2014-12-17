<?php
	include('connect.php');
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Edons (Site promotionnel) | Contact</title>
    <link rel='stylesheet' href='css/styles-mise-en-page.css'>
	<link rel='stylesheet' href='css/styles-typographie-couleur.css'>
	<link rel='stylesheet' href='css/styles-graphique.css'>
	<link rel="icon" href="css/images-interface/favicon.ico"/>
  </head>
  <body class="contact-actif">
    <?php
    	include('header.php');
    ?>
    <div class="corps" id="contact">
    	<section id="contact">
    		<h1>Contact</h1>
    		<p>Vous souhaitez nous posez une question, nous faire part d'un problème&nbsp;?&nbsp;N'hésitez pas&nbsp;!</p>
    		 <form id="contact" method="post" action="contact.php">
    		 	<ul>
    		 		<li><input type="text" name="nom" placeholder="Votre nom"/></li>
      		 		<li><input type="email" name="email" placeholder="Votre email"/></li>
      		 		<li><textarea name="text-message" placeholder="Votre message"></textarea></li>
      				<li><input type="submit" name="ok" value="Envoyer" /></li>
   				</ul>
   			</form>
    	</section>
    </div>
	<?php
		include('footer.php');
	?>
  </body>
</html>

<!--GESTION ENVOI MESSAGE-->

<?php
	if(isset($_POST['email'])){$email = $_POST['email'];}
	if(isset($_POST['nom']))$nom = $_POST['nom'];
	if(isset($_POST['text-message']))$contenu = $_POST['text-message'];
	
	if(isset($_POST['ok'])){
		if(!empty($email) && !empty($contenu) && !empty($nom)){
			if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){//Si l'adresse correspond au bon format d'adresse
				$destinataire ='lu.simeon@gmail.com,benoit.mk@gmail.com,roonie90@gmail.com';
				$sujet ="Formulaire de contact Edons";
				$message = "Nom : ".$nom." \r\n Email : ".$email." \r\n".$contenu;
 				$headers = 'MIME-Version: 1.0'."\r\n";
 				$headers = 'Content-type: text/html; charset=iso-8859-1'."\r\n";
 				mail($destinataire,stripslashes($sujet),stripslashes($message));
				echo "<script type='text/javascript'>alert(\"Mail envoyé\")</script>";
			}
			else{
				echo"<script type='text/javascript'>alert(\"L'email n'est pas valide\")</script>";
			}
		}
		else{
			echo "<script type='text/javascript'>alert(\"Veuillez renseigner tout les champs\")</script>";
		}
	}
?>