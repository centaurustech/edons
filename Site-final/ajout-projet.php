<?php
	session_start();
	include('connect.php');
	if(!(isset($_SESSION['id']))) header ('location:index.php');
?>
<html>
	<head>
		<meta charset='utf-8'>
   	 	<title>Edons (Site final) | Ajout-Projet</title>
   	 	<link rel='stylesheet' href='css/styles-mise-en-page.css'>
		<link rel='stylesheet' href='css/styles-typographie-couleur.css'>
		<link rel='stylesheet' href='css/styles-graphique.css'>
		<link rel="icon" href="css/images-interface/favicon.ico"/>
   	</head>
    <body>
    	<?php 
    		include('header.php');
    	?>
    	<div class="corps" id="index">
 			<form method='post' action='ajout-projet.php' enctype="multipart/form-data">
			<h4>Nom du projet</h4><input type='text' name='nom'/>(Obligatoire)
			<h4>Descriptif</h4><textarea name='bio' /></textarea>(Obligatoire)
			<h4>Date</h4><input type='date' name='date' placeholder="AAAA/MM/JJ"/>(Obligatoire)
			<h4>Fonds necessaire</h4><input type='number' name='fonds' />(Obligatoire)
			<h4>Catégorie</h4><!--
			--><select name="categorie">
					<option value="regional">Régional</option>
					<option value="national">National</option>
					<option value="international">International</option>
				</select>(Obligatoire)
			<h4>Image de profil</h4><input type="file" name="img"/>(Obligatoire)</br>
			<input class="submit" type='submit' value='Créer' name="creer"/>
		</form>
  		</div>
    	<?php
    		include('footer.php');
    	?>
    </body>
</html>
<?php	
	//====CREATION====
	
	if(isset($_POST['creer'])){
		if((!empty($_POST['nom']))&&(!empty($_POST['date'])&&(!empty($_POST['bio']))&&(!empty($_POST['fonds']))&&(!empty($_POST['categorie'])))){
			$nom=addslashes($_POST['nom']);
			$categorie=$_POST['categorie'];
			$date=$_POST['date'];
			$bio=addslashes($_POST['bio']);
			$fonds=$_POST['fonds'];
			$img = $_FILES['img'];
			
			$extension=strtolower(substr($img['name'],-3));
			$extension_autorise=array('jpg','png','gif');
			
			if(isset($img)){
				if (in_array($extension, $extension_autorise)){
					move_uploaded_file($img['tmp_name'],"css/images-contenu/upload/profil-projet/".$img['name']);
				}else{
					echo "<script>alert(\"Ceci n'est pas une image.\")</script>";
				}
			}
		
			$requete="INSERT INTO Projet (NomProjet,CategorieProjet,DateCreationProjet,FondNecessaireProjet,ProgressionProjet,BioProjet,ImgProfilProjet,IDUser) VALUE ('".$nom."','".$categorie."','".$date."',".$fonds.",'nouveau','".$bio."','".$img['name']."',".$_SESSION['id'].");";
			$result=mysql_query($requete);
			$idproj=mysql_insert_id();
		
			if($result){
				header ('location:fiche-projet.php?idproj='.$idproj);
			}
			else{
				echo"<script>alert(\"Ajout échouée\")</script>";
			}
		}else{
			echo"<script>alert(\"Veuillez remplir tout les champs\")</script>";
		}
	}
?>