<?php
	session_start();
	include('connect.php');
?>
<html>
	<head>
		<meta charset='utf-8'>
   	 	<title>Edons (Site final) | Fiche-Projet</title>
   	 	<link rel='stylesheet' href='css/styles-mise-en-page.css'>
		<link rel='stylesheet' href='css/styles-typographie-couleur.css'>
		<link rel='stylesheet' href='css/styles-graphique.css'>
		<link rel="icon" href="css/images-interface/favicon.ico"/>
   	</head>
    <body>
    	<?php 
    		include('header.php');
    	?>
    	<div class="corps" id="fiche-projet">
    		<section>
			<?php	
				//====AFFICHAGE FICHE PROJETS====
				
				if($_GET['idproj']){
					$requete="SELECT * FROM Projet WHERE IDProjet=".$_GET['idproj'].";";
					$result=mysql_query($requete);
					
					if($result){
						while($liste_fiche=mysql_fetch_array($result)){
							
							echo "<figure><figcaption><p>".$liste_fiche['NomProjet']."</p></figcaption><img src=css/images-contenu/upload/profil-projet/".$liste_fiche['ImgProfilProjet']." 
							width=300 height=300 alt=".$liste_fiche['ImgProfilProjet']."><figcaption>";
								if($_SESSION){
									if(($_SESSION['id']==$_GET['idproj'])||($_SESSION['type']==5)){
										echo"<a href=modif-imgProjet.php?id=".$_GET['idproj'].">Modifier l'image du projet</a></br>";
										echo"<a href=modif-projet.php?idproj=".$_GET['idproj'].">Modifier votre projet</a></br>";
										echo"<a href=suppr-projet.php?idproj=".$_GET['idproj'].">Supprimer votre projet</a>";	
									}else{
										echo"<a href=don.php?idproj=".$_GET['idproj'].">Soutenir le projet</a>";
									}
								}else{
									echo"<a href=don.php?idproj=".$_GET['idproj'].">Soutenir le projet</a>";
								}
							echo "</figcaption></figure>";
							echo"<div class=contenu_fiche>";
							
							echo"<div class=info>";
							
							echo"<div><h4>Catégorie</h4><p>".$liste_fiche['CategorieProjet']."</p></div>";
							echo"<div><h4>Date de création</h4><p>".$liste_fiche['DateCreationProjet']."</p></div>";
							echo"<div><h4>Fonds récoltés</h4><p>".$liste_fiche['FondRecolteProjet']."/".$liste_fiche['FondNecessaireProjet']." €</p></div>";
							echo"<div><h4>Descriptif</h4><p>".$liste_fiche['BioProjet']."</p></div>";
							echo"</div>";
							echo"</div>";	
						}
					}else{
						echo"<h3>Le projet n'existe plus</h3>";
					}
				}
			?>
			</section>
			<section>
			<?php
				
				$requete="SELECT * FROM Projet WHERE IDProjet=".$_GET['idproj'].";";
				$result=mysql_query($requete);
				$nb=mysql_affected_rows();
				
				if($nb!=0){
					while($liste_fiche=mysql_fetch_array($result)){
						$id_user=$liste_fiche['IDUser'];
					}
				}
				
				if($_SESSION){
				    if(($_SESSION['id']==$liste_fiche['IDUser'])||($_SESSION['type']==5)){
				    	
						echo "<form method='post' action='fiche-projet.php?idproj=".$_GET['idproj']."' enctype='multipart/form-data'>";
						echo "<div><h4>Ajouter une image</h4><input type='file' name='media'/></div>";
						echo"<input class='submit' type='submit' name='envoyer' value='Ajouter' />";
						echo "</form>";
	
						if(isset($_FILES['media'])){
							$media_nouv=$_FILES['media'];
							$extension=strtolower(substr($media_nouv['name'],-3));
							$extension_autorise=array('jpg','jpeg','png','gif');
							if (in_array($extension, $extension_autorise)){
								move_uploaded_file($media_nouv['tmp_name'],"css/images-contenu/upload/media-projet/".$media_nouv['name']);
							}else{
								echo "<script>alert(\"Ceci n'est pas une image.\")</script>";
							}
	
							$insert="INSERT INTO Media (NomMedia,IDUser,IDProjet) VALUE ('".$media_nouv['name']."',".$_SESSION['id'].",".$_GET['idproj'].")";
							$result=mysql_query($insert);
						}
					}
				}


				//=====AFFICHAGE MEDIA GALERIE====
				
				$select=mysql_query("SELECT * FROM Media WHERE IDProjet=".$_GET['idproj']." ORDER BY IDMedia DESC Limit 10;");
			    $nb_media=mysql_affected_rows();
				
				if($nb_media!=0){
						
				    echo"<h3><span>La galerie du projet</span></h3>";
				    echo"<div class='conteneur_images'>";
					
				    while($row= mysql_fetch_assoc($select)) {
				    	$id_media=$row['IDMedia'];
						$nom_media=$row['NomMedia'];
				    	$id_projet=$row['IDProjet'];
						$id_user=$row['IDUser'];
	
						if(isset($id_media)){
							if($_SESSION){
								
								if(($_SESSION['id']==$id_user)||($_SESSION['type']==5)){
									echo "<div class='image'><figure><img src=css/images-contenu/upload/media-projet/".$nom_media." width=160 height=160 alt=".$nom_media.">
									<figcaption><a href=fiche-projet.php?idproj=".$_GET['idproj']."&idmed=".$id_media.">Supprimer</a></figcaption></figure></div>";
								}else{
									echo "<div class='image'><figure><img src=css/images-contenu/upload/media-projet/".$nom_media." width=160 height=160 alt=".$nom_media."></figure></div>";
								}
								
							}else{
								echo "<div class='image'><figure><img src=css/images-contenu/upload/media-projet/".$nom_media." width=160 height=160 alt=".$nom_media."></figure></div>";
							}
						}
					}
					
					//=====SUPPRESSION MEDIA======
				
					if(isset($_GET['idmed'])){
						$suppr=mysql_query("SELECT NomMedia FROM Media WHERE IDProjet=".$_GET['idmed'].";");
						$media_suppr=mysql_result($suppr, 0);
					
						unlink("css/images-contenu/upload/media-projet/".$media_suppr);
						$requete="DELETE FROM Media WHERE IDMedia=".$_GET['idmed'].";";
						$result=mysql_query($requete);
						header ('location:fiche-projet.php?idproj='.$id_projet);
					}
					echo"</div>";
				}
			?>
			</section>
			<section>
			<?php
			
				if($_SESSION) echo "<h3><span>Poster un commentaire</span></h3>";
				else echo "<h3><span>Les commentaire</span></h3>";
				
				$id_projet=$_GET['idproj'];
				
				//=====AJOUT DE COMMENTAIRE=====
				 			
				if($_SESSION){
				
					echo"<form class=form-commentaire method='POST' action=fiche-projet.php?idproj=".$_GET['idproj'].">
					<textarea name='message' rows='6' cols='35' placeholder='Ecriver votre message ici'></textarea></br>
					<input class='submit' type='submit' name='submit' value='Poster'>
		    		</form>"; 
					
					if(isset($_POST['submit'])){
				  		if(!empty($_POST['message'])) {
							
							$requete="SELECT * FROM User WHERE IDUser=".$_SESSION['id'].";";
							$result=mysql_query($requete);
							
				    		$message=$_POST['message'];
	
						    if (strlen($message)>500) {
						      	echo"<script>alert(\"Votre message ne doit pas dépasser 500 caractères\")</script>";
						    }
						    else{
						      	$id_user=$_SESSION['id'];
						      
						    	$time=time();
						    	$date=date('Y-m-d H:i:s',$time);
						      
						       	$req = "INSERT INTO Commentaire(DateCommentaire, TexteCommentaire, IDUser, IDProjet ) VALUES ('".$date."','".$message."',".$id_user.",".$id_projet.");";
						      	$result=mysql_query($req);
								
								if($result) header ("location:fiche-projet.php?idproj=".$_GET['idproj']);
						    }
				  		}else echo"<script>alert(\"Remplir tout les champs\")</script>";;
					}
				}
				
				
				//======AFFICHAGE COMMENTAIRES=====  
				
			  	$select=mysql_query("SELECT * FROM Commentaire WHERE IDProjet=".$id_projet." ORDER BY IDCommentaire DESC ;");
			    $nb_com=mysql_affected_rows();
				
				if($nb_com!=0){
					echo"<div class='groupe-commentaire'>";
				    while ($row= mysql_fetch_assoc($select)) {
				    	$id_commentaire=$row['IDCommentaire'];
				    	$id_projet=$_GET['idproj'];
						$id_user=$row['IDUser'];
						$date_commentaire=$row['DateCommentaire'];
						$texte=$row['TexteCommentaire'];
						$select_infos_user=mysql_query("SELECT * FROM User WHERE IDUser=".$id_user.";");
					
				    	while ($row_user= mysql_fetch_assoc($select_infos_user)) {
					  		$nom=$row_user['NomUser'];
							if(isset($row_user['PrenomUser'])) $prenom=$row_user['PrenomUser'];
							$img=$row_user['ImgProfilUser'];
						}
	
						if($_SESSION){
							if(($_SESSION['id']==$id_user)||($_SESSION['type']==5)){
								if(isset($prenom)){
									echo "<div class='commentaire'><p><strong>".$prenom." ".$nom."</strong> à écrit le <strong>".$date_commentaire."</strong></p>
									<form method='post' action='fiche-projet?idproj=".$_GET['idproj']."'>
									<textarea name='nouv_text' rows='6' cols='35'>".$texte."</textarea></br>
									<input type='hidden' name='idcom' value='".$id_commentaire."'/>
									<input class='submit' type='submit' name='modif' value='Modifier'/>
									<input class='submit' type='submit' name='suppr' value='Supprimer'/>
									</form>";
								}else 
									echo "<div class='commentaire'><p><strong>".$nom."</strong> à écrit le <strong>".$date_commentaire."</strong></p>
									<form method='post' action='fiche-projet?idproj=".$_GET['idproj']."'>
									<textarea name='nouv_text' rows='6' cols='35'>".$texte."</textarea></br>
									<input type='hidden' name='idcom' value='".$id_commentaire."'/>
									<input class='submit' type='submit' name='modif' value='Modifier'/>
									<input class='submit' type='submit' name='suppr' value='Supprimer'/>
									</form>";
							}
						}
						else{
							if(isset($prenom)){
								echo "<div class='commentaire'><div class=image-commentaire></div><p><strong>".$prenom." ".$nom."</strong> à écrit le <strong>".$date_commentaire."</strong></p><p class='texte'>".$texte."</p><div class=image-commentaire></div></div>";
							}else echo "<div class='commentaire'><div class=image-commentaire></div><p><strong>".$nom."</strong> à écrit le <strong>".$date_commentaire."</strong></p><p class='texte'>".$texte."</p><div class=image-commentaire></div></div>";
						}
						
						//=====MODIF ET SUPPR COMMENTAIRE=======
					}
					
					if($_POST){
							if(isset($_POST['modif'])){
								$nouv_com=$_POST['nouv_text'];
								$requete="UPDATE Commentaire SET TexteCommentaire='".$nouv_com."' WHERE IDCommentaire=".$_POST['idcom'].";";
								$resultat=mysql_query($requete);
								
								if(isset($resultat)){
									header ('location:fiche-projet.php?idproj='.$_GET['idproj']);
								}
							}
							if(isset($_POST['suppr'])){
								$requete="DELETE FROM Commentaire WHERE IDCommentaire=".$_POST['idcom'].";";
								$resultat=mysql_query($requete);
								
								if(isset($resultat)){
									header ('location:fiche-projet.php?idproj='.$_GET['idproj']);
								}
							}
					}
					echo"</div>";
				}
			?>
			</section>
  		</div>
    	<?php
    		include('footer.php');
    	?>
    </body>
</html>