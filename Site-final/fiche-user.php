<?php
	session_start();
	include('connect.php');
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
				//====AFFICHAGE FICHE USER====
				
				if($_GET['id']){
					
					$id=$_GET['id'];
					
					$requete="SELECT * FROM User WHERE IDUser=".$id.";";
					$result=mysql_query($requete);
					$liste_user=mysql_fetch_row($result);
					
					if($result){
						if(($liste_user[11]==2)||($liste_user[11]==4)){
							
							$requete=mysql_query("Select LoginUser, NomUser, BioUser, ImgProfilUser, SiteUser, FacebookUser, TwitterUser From User where IDUser=".$id.";");
							$result=mysql_fetch_array($requete);
							
							echo "<figure><figcaption><p>".$result['NomUser']."</p></figcaption><img src=css/images-contenu/upload/profil-user/".$result['ImgProfilUser']." width=300 height=300 alt=".$result['ImgProfilUser']."><figcaption>";
								if($_SESSION){
									if(($_SESSION['id']==$id)||($_SESSION['type']==5)){
										echo"<a href=modif-img.php?id=".$id.">Modifier votre image de profil</a></br>";
										echo"<a href=modif-user.php?id=".$id.">Modifier vos informations</a></br>";
										echo"<a href=suppr-user.php?id=".$id.">Supprimer votre compte</a>";	
									}
								}
							echo"</figcaption></figure>";
							echo"<div class=contenu_fiche>";
							echo"<div class=info>";
							echo"<div><h4>Email</h4><p>".$result['LoginUser']."</p></div>";
							if(!empty($result['BioUser'])){
								echo"<div><h4>Descriptif</h4><p class=bio>".$result['BioUser']."</p></div>";
							}
							echo"</div>";
							
							
							echo"<div class=liensExterne>";
							echo"<ul>";
							if(!empty($result['SiteUser'])){
								echo "<li><a href=".$result['SiteUser'].">Site Web</a></li>";
							}
							if(!empty($result['FacebookUser'])){
								echo "<li><a href=".$result['FacebookUser'].">Facebook</a></li>";
							}
							if(!empty($result['TwitterUser'])){
								echo "<li><a href=".$result['TwitterUser'].">Twitter</a></li>";
							}
							echo"<ul>";
							echo"</div>";
							echo"</div>";
						
						}else{
							
 							$requete=mysql_query("Select LoginUser, NomUser, PrenomUser, BioUser, ImgProfilUser, SiteUser, DateNaissanceUser, FacebookUser, TwitterUser From User where IDUser=".$id.";");
							$result=mysql_fetch_array($requete);
							
							echo "<figure><figcaption><p>".$result['NomUser']." ".$result['PrenomUser']."</p></figcaption><img src=css/images-contenu/upload/profil-user/".$result['ImgProfilUser']." width=300 height=300 alt=".$result['ImgProfilUser']."><figcaption>";
								if($_SESSION){
									if(($_SESSION['id']==$id)||($_SESSION['type']==5)){
										echo"<a href=modif-img.php?id=".$id.">Modifier votre image de profil</a></br>";
										echo"<a href=modif-user.php?id=".$id.">Modifier vos information</a></br>";
										echo"<a href=suppr-user.php?id=".$id.">Supprimer votre compte</a>";	
									}
								}
							echo"</figcaption></figure>";
							echo"<div class=contenu_fiche>";
							
							echo"<div class=info>";
							
							if(!empty($result['DateNaissanceUser'])){
								echo"<div><h4>Date de naissance</h4><p class=date>".$result['DateNaissanceUser']."</p></div>";
							}	
							if(!empty($result['BioUser'])){
								echo"<div><h4>Biographie</h4><p class=bio>".$result['BioUser']."</p></div>";
							}

							echo"</div>";
							
							echo"<div class=liensExterne>";
							
							if(!empty($result['SiteUser'])){
								echo "<a href=".$result['SiteUser'].">Site Web</a>";
							}
							if(!empty($result['FacebookUser'])){
								echo "<a href=".$result['FacebookUser'].">Facebook</a>";
							}
							if(!empty($result['TwitterUser'])){
								echo "<a href=".$result['TwitterUser'].">Twitter</a></br>";
							}
							echo"</div>";
							echo"</div>";
						}
						
						if($liste_user[11]!=2){
							$requete="SELECT NomProjet,Projet.IDProjet,ImgProfilProjet,User.NomUser,FondRecolteProjet,FondNecessaireProjet FROM User,Projet,Don WHERE User.IDUser=Don.IDUser AND Projet.IDProjet=Don.IDProjet AND User.IDUser=".$id." GROUP BY IDProjet ORDER BY IDProjet DESC ;";
							$result=mysql_query($requete);
							$nb=mysql_affected_rows();
							
							echo "<h3><span>L'utilisateur soutient ".$nb." projet(s)</span></h3>";
							if($nb!=0){
								echo"<div class='en-avant'>";
								while($liste=mysql_fetch_row($result)){
									$pourcentage= (($liste[4]*100)/$liste[5]);
		    						echo "<div class='groupe_en-avant'>";
									echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-projet/".$liste[2]." width=220 height=150 alt=".$liste[2]."></div>";
		    						echo "<div class='contenu_en-avant'><h4><a href=fiche-projet?idproj=".$liste[1].">".$liste[0]."</a></h4></div>";
									echo "<div class='contenu_en-avant'><h5>Avancement</h5><div class=progress progress-striped><div class=bar style='width:".$pourcentage."%;'></div></div></div></div>";
								}
								echo"</div>";
							}
						}
						
					}else{
						echo"<h3><span>Cette utilisateur n'existe plus</span></h3>";
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