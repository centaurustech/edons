<?php
	session_start();
	include('connect.php');
	if(!(isset($_SESSION['id']))) header ('location:index.php');
?>
<html>
	<head>
		<meta charset='utf-8'>
   	 	<title>Edons (Site final) | Fiche-Utilisateur</title>
   	 	<link rel='stylesheet' href='css/styles-mise-en-page.css'>
		<link rel='stylesheet' href='css/styles-typographie-couleur.css'>
		<link rel='stylesheet' href='css/styles-graphique.css'>
		<link rel="icon" href="css/images-interface/favicon.ico"/>
   	</head>
    <body class="fiche-user">
	<?php 
    		include('header.php');
    	?>
    	<div class="corps">
    		<section class="fiche-user">
			<?php
				if(($_SESSION['id']==$_GET['id']) || ($_SESSION['type']==5)){
					echo"<form method='post' action='modif-img.php?id=".$_GET['id']."' enctype='multipart/form-data'>
					<h4>Modifier l'image de votre profil</h4><input type='file' name='img' />
					<input type='submit' name='ok' value='Envoyer'/>
					</form>";
				}else{
					echo "<h3>Vous ne pouvez pas modifier l'image</h3>";
				}
			
			if(isset($_POST['ok'])){
					if(isset($_FILES)){
						
						$img = $_FILES['img'];
						$extension=strtolower(substr($img['name'],-3));
						$extension_autorise=array('jpg','png','gif');
						
						
						if (in_array($extension, $extension_autorise)){
							move_uploaded_file($img['tmp_name'],"css/images-contenu/upload/profil-user/".$img['name']);
							$requete="Update User Set ImgProfilUser='".$img['name']."' where IDUser='".$_GET['id']."' ;";
							$result=mysql_query($requete);
							header('location: fiche-user.php?id='.$_GET['id'].''); 
						}
						else{
							"Ceci n'est pas une image ou n'est pas un format d'image accepté";
						}
					}
				}
				
			?>
			
			
</section>
  		</div>
    	<?php
    		include('footer.php');
    	?>
    </body>
</html>