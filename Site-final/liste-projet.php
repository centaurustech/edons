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
    	<div class="corps" id="liste-projet">
    		<section class="module-projets">
	    		<?php	
					//====AFFICHAGE LISTE PROJETS====
					
					if(isset($_POST['rechercher'])){
						if(!empty($_POST['recherche'])){
							
							$critere=$_POST['recherche'];
							$requete="SELECT Projet.IDUser,NomUser,NomProjet,Projet.IDProjet,ImgProfilProjet,FondRecolteProjet,FondNecessaireProjet,User.IDType FROM User,Projet WHERE User.IDUser=Projet.IDUser AND User.IDType=2 AND NomProjet LIKE '".$critere."%' ORDER BY IDProjet;";
							$result=mysql_query($requete);
							$nb=mysql_affected_rows();
							
							if($nb == 0){
								echo"<h4>Aucun projets correspond à cette recherche</h4>";
							}else{
								echo "<h3><span>Il y a ".$nb." résultat(s)</span></h3>";
								while($liste_projet=mysql_fetch_row($result)){
									if($_SESSION){
										if($_SESSION['type']==5){
											$pourcentage= (($liste_projet[5]*100)/$liste_projet[6]);
											echo "<div class='groupe_en-avant'>";
											echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-projet/".$liste_projet[4]." width=220 height=150 alt=".$liste_projet[4]."></div>";
				    						echo "<div class='contenu_en-avant'><h4><a href=fiche-projet?idproj=".$liste_projet[3].">".$liste_projet[2]."</a></h4>";
											echo "<h5>Par <a href=fiche-user?id=".$liste_projet[0].">".$liste_projet[1]."</a></h5></div>";
											echo "<div class='contenu_en-avant'><h5>Avancement</h5><div class=progress progress-striped><div class=bar style='width:".$pourcentage."%;'></div></div><div class=modif-suppr><a href=modif-projet.php?idproj=".$liste_projet[3].">Modifier</a>";
											echo"<a href=suppr-projet.php?idproj=".$liste_projet[3].">Supprimer</a></div></div></div>";
										}
										elseif($_SESSION['id']==$liste_projet[7]){
											$pourcentage= (($liste_projet[5]*100)/$liste_projet[6]);
											echo "<div class='groupe_en-avant'>";
											echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-projet/".$liste_projet[4]." width=220 height=150 alt=".$liste_projet[4]."></div>";
				    						echo "<div class='contenu_en-avant'><h4><a href=fiche-projet?idproj=".$liste_projet[3].">".$liste_projet[2]."</a></h4>";
											echo "<h5>Par <a href=fiche-user?id=".$liste_projet[0].">".$liste_projet[1]."</a></h5></div>";
											echo "<div class='contenu_en-avant'><h5>Avancement</h5><div class=progress progress-striped><div class=bar style='width:".$pourcentage."%;'></div></div><div class=modif-suppr><a href=modif-projet.php?idproj=".$liste_projet[3].">Modifier</a>";
											echo"<a href=suppr-projet.php?idproj=".$liste_projet[3].">Supprimer</a></div></div></div></div>";
										}
										else{
											$pourcentage= (($liste_projet[5]*100)/$liste_projet[6]);
											echo "<div class='groupe_en-avant'>";
											echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-projet/".$liste_projet[4]." width=220 height=150 alt=".$liste_projet[4]."></div>";
						    				echo "<div class='contenu_en-avant'><h4><a href=fiche-projet?idproj=".$liste_projet[3].">".$liste_projet[2]."</a></h4>";
											echo "<h5>Par <a href=fiche-user?id=".$liste_projet[0].">".$liste_projet[1]."</a></h5></div>";
											echo "<div class='contenu_en-avant'><h5>Avancement</h5><div class=progress progress-striped><div class=bar style='width:".$pourcentage."%;'></div></div></div>";
											echo "</div>";
										}
									}else{
										$pourcentage= (($liste_projet[5]*100)/$liste_projet[6]);
											echo "<div class='groupe_en-avant'>";
											echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-projet/".$liste_projet[4]." width=220 height=150 alt=".$liste_projet[4]."></div>";
						    				echo "<div class='contenu_en-avant'><h4><a href=fiche-projet?idproj=".$liste_projet[3].">".$liste_projet[2]."</a></h4>";
											echo "<h5>Par <a href=fiche-user?id=".$liste_projet[0].">".$liste_projet[1]."</a></h5></div>";
											echo "<div class='contenu_en-avant'><h5>Avancement</h5><div class=progress progress-striped><div class=bar style='width:".$pourcentage."%;'></div></div></div>";
											echo "</div>";
									}
								}
							}
						}else{
							echo "Veuillez renseigner la recherche";
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