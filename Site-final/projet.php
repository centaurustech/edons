<?php
	session_start();
	include('connect.php');
?>
<html>
	<head>
		<meta charset='utf-8'>
   	 	<title>Edons (Site final) | Projets</title>
   	 	<link rel='stylesheet' href='css/styles-mise-en-page.css'>
		<link rel='stylesheet' href='css/styles-typographie-couleur.css'>
		<link rel='stylesheet' href='css/styles-graphique.css'>
		<link rel="icon" href="css/images-interface/favicon.ico"/>
   	</head>
    <body class="projets-actif">
    	<?php 
    		include('header.php');
    	?>
    	<div class="corps">
    		<aside>
				<form method="get" action="projet.php">
					<div>
				    <h4>Catégrorie</h4>
				    <p>Régional<input type="radio" name="categorie" value="regional"></p>
				    <p>National<input type="radio" name="categorie" value="national"></p>
				    <p>International<input type="radio" name="categorie" value="international"></p>
				   	</div>
				   	<div>
				    <h4>Date de publication</h4>
				    <input id="date" type="text" name="date_publication" placeholder="AAAA/MM/JJ">
				    </div>
				    <div>
				    <h4>Progression</h4>
				    <p>Nouveau<input type="radio" name="progression" value="nouveau"></p>
					<p>En cours<input type="radio" name="progression" value="en_cours"></p>
				    <p>Bientot terminé<input type="radio" name="progression" value="bientot_termine"></p>
					<p>Terminé<input type="radio" name="progression" value="termine"></p>
					</div>
				    <input class="submit" type="submit" value="Rechercher" name="submit">
				</form>
			</aside>
    		<section class="module-projets">
    			<div class="en-avant">
				<?php
					
					if(isset($_GET['submit'])){
					  
						if(isset($_GET['categorie'])) $categorie=$_GET['categorie'];
						if(isset($_GET['date_publication'])) $date_publication=$_GET['date_publication'];
						if(isset($_GET['progression'])) $progression=$_GET['progression'];
						
						if((empty($categorie)) && (empty($date_publication)) && (empty($progression))){
						  echo "<script>alert(\"Veuillez choisir une date et/ou une catégorie et/ou une progression\")</script>";
						}
						if((empty($categorie)) && (!empty($date_publication)) && (empty($progression))){
						  $requete="SELECT Projet.IDUser,NomUser,NomProjet,Projet.IDProjet,ImgProfilProjet,FondRecolteProjet,FondNecessaireProjet FROM Projet,User WHERE DateCreationProjet='".$date_publication."' AND User.IDUser=Projet.IDUser AND User.IDType=2 ORDER BY DateCreationProjet;";
						}                                                                                             
						if((!empty($categorie)) && (empty($date_publication)) && (empty($progression))){              
						  $requete="SELECT Projet.IDUser,NomUser,NomProjet,Projet.IDProjet,ImgProfilProjet,FondRecolteProjet,FondNecessaireProjet FROM Projet,User WHERE CategorieProjet='".$categorie."' AND User.IDUser=Projet.IDUser AND User.IDType=2 ORDER BY DateCreationProjet;";
						}                                                                                           
						if((!empty($categorie)) && (!empty($date_publication)) && (empty($progression))){           
						  $requete="SELECT Projet.IDUser,NomUser,NomProjet,Projet.IDProjet,ImgProfilProjet,FondRecolteProjet,FondNecessaireProjet FROM Projet,User WHERE CategorieProjet='".$categorie."' AND DateCreationProjet='".$date_publication."' AND User.IDUser=Projet.IDUser AND User.IDType=2 ORDER BY DateCreationProjet;";
						}                                                                                             
						if((empty($categorie)) && (empty($date_publication)) && (!empty($progression))){              
						  $requete="SELECT Projet.IDUser,NomUser,NomProjet,Projet.IDProjet,ImgProfilProjet,FondRecolteProjet,FondNecessaireProjet FROM Projet,User WHERE ProgressionProjet='".$progression."' AND User.IDUser=Projet.IDUser AND User.IDType=2 ORDER BY DateCreationProjet;";
						}                                                                                             
						if((!empty($categorie)) && (empty($date_publication)) && (!empty($progression))){             
						  $requete="SELECT Projet.IDUser,NomUser,NomProjet,Projet.IDProjet,ImgProfilProjet,FondRecolteProjet,FondNecessaireProjet FROM Projet,User WHERE CategorieProjet='".$categorie."' AND ProgressionProjet='".$progression."' AND User.IDUser=Projet.IDUser AND User.IDType=2 ORDER BY DateCreationProjet;";
						}                                                                                            
						if((empty($categorie)) && (!empty($date_publication)) && (!empty($progression))){            
						  $requete="SELECT Projet.IDUser,NomUser,NomProjet,Projet.IDProjet,ImgProfilProjet,FondRecolteProjet,FondNecessaireProjet FROM Projet,User WHERE DateCreationProjet='".$date_publication."' AND ProgressionProjet='".$progression."' AND User.IDUser=Projet.IDUser AND User.IDType=2 ORDER BY DateCreationProjet;";
						}
						if((!empty($categorie)) && (!empty($date_publication)) && (!empty($progression))){
						  $requete="SELECT Projet.IDUser,NomUser,NomProjet,Projet.IDProjet,ImgProfilProjet,FondRecolteProjet,FondNecessaireProjet FROM Projet,User WHERE CategorieProjet='".$categorie."' AND DateCreationProjet='".$date_publication."' AND ProgressionProjet='".$progression."' AND User.IDUser=Projet.IDUser AND User.IDType=2 ORDER BY DateCreationProjet;";
						}
						
						$result=mysql_query($requete);
						$nb=mysql_affected_rows();
							
							if($nb == 0){
								echo"<h3><span>Aucun projets correspond à cette recherche</span></h3>";
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
											echo "<div class='contenu_en-avant'><h5>Avancement</h5><div class=progress progress-striped><div class=bar style='width:".$pourcentage."%;'></div></div><div class=modif-suppr><a href=modif-projet.php?idproj=".$liste_projet[0].">Modifier</a>";
											echo"<a href=suppr-projet.php?idproj=".$liste_projet[0].">Supprimer</a></div></div></div>";
										}
										elseif($_SESSION['id']==$liste_projet[0]){
											$pourcentage= (($liste_projet[5]*100)/$liste_projet[6]);
											echo "<div class='groupe_en-avant'>";
											echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-projet/".$liste_projet[4]." width=220 height=150 alt=".$liste_projet[4]."></div>";
				    						echo "<div class='contenu_en-avant'><h4><a href=fiche-projet?idproj=".$liste_projet[3].">".$liste_projet[2]."</a></h4>";
											echo "<h5>Par <a href=fiche-user?id=".$liste_projet[0].">".$liste_projet[1]."</a></h5></div>";
											echo "<div class='contenu_en-avant'><h5>Avancement</h5><div class=progress progress-striped><div class=bar style='width:".$pourcentage."%;'></div></div><div class=modif-suppr><a href=modif-projet.php?idproj=".$liste_projet[0].">Modifier</a>";
											echo"<a href=suppr-projet.php?idproj=".$liste_projet[0].">Supprimer</a></div></div></div>";
										}
										else{
											$pourcentage= (($liste_projet[5]*100)/$liste_projet[6]);
											echo "<div class='groupe_en-avant'>";
											echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-projet/".$liste_projet[4]." width=220 height=150 alt=".$liste_projet[4]."></div>";
						    				echo "<div class='contenu_en-avant'><h4><a href=fiche-projet?idproj=".$liste_projet[3].">".$liste_projet[2]."</a></h4>";
											echo "<h5>Par <a href=fiche-user?id=".$liste_projet[0].">".$liste_projet[1]."</a></h5></div>";
											echo "<div class='contenu_en-avant'><h5>Avancement</h5><div class=progress progress-striped><div class=bar style='width:".$pourcentage."%;'></div></div></div></div>";
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
						$requete="SELECT Projet.IDUser,NomUser,NomProjet,Projet.IDProjet,ImgProfilProjet,FondRecolteProjet,FondNecessaireProjet FROM User,Projet WHERE User.IDUser=Projet.IDUser AND User.IDType=2 GROUP BY IDProjet ORDER BY IDProjet DESC;";
						$result=mysql_query($requete);
						$nb=mysql_affected_rows();
						echo "<h3><span>Il y a ".$nb." résultat(s)</span></h3>";
						
						while($liste=mysql_fetch_row($result)){
							$pourcentage= (($liste[5]*100)/$liste[6]);
	    					echo "<div class='groupe_en-avant'>";
							echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-projet/".$liste[4]." width=220 height=150 alt=".$liste[4]."></div>";
	    					echo "<div class='contenu_en-avant'><h4><a href=fiche-projet?idproj=".$liste[3].">".$liste[2]."</a></h4>";
							echo "<h5>Par <a href=fiche-user?id=".$liste[0].">".$liste[1]."</a></h5></div>";
							echo "<div class='contenu_en-avant'><h5>Avancement</h5><div class=progress progress-striped><div class=bar style='width:".$pourcentage."%;'></div></div></div></div>";
						}
					}
					
				?>
    			</div>
    		</section>
  		</div>
    	<?php
    		include('footer.php');
    	?>
    </body>
</html>