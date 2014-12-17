<?php
	session_start();
	include('connect.php');
?>
<html>
	<head>
		<meta charset='utf-8'>
   	 	<title>Edons (Site final) | Entreprises</title>
   	 	<link rel='stylesheet' href='css/styles-mise-en-page.css'>
		<link rel='stylesheet' href='css/styles-typographie-couleur.css'>
		<link rel='stylesheet' href='css/styles-graphique.css'>
		<link rel="icon" href="css/images-interface/favicon.ico"/>
   	</head>
    <body class="entreprises-actif">
    	<?php 
    		include('header.php');
    	?>
    	<div class="corps">
    		<section class="module-entreprises">
    			<div class="en-avant">
				<?php
					 
					$requete="SELECT User.IDUser,User.NomUser,User.ImgProfilUser,Projet.NomProjet,Projet.IDProjet, User.IDType FROM User,Projet,Don WHERE User.IDUser=Don.IDUser AND Projet.IDProjet=Don.IDProjet AND User.IDType=4 GROUP BY IDUser ORDER BY IDUser;";
					$result=mysql_query($requete);
					$nb=mysql_affected_rows();
				
					if($nb != 0){
						echo "<h3><span>Il y a ".$nb." résultat(s)</span></h3>";
						while($liste_entreprise=mysql_fetch_row($result)){
							if($_SESSION){
								if($_SESSION['type']==5){
									echo "<div class='groupe_en-avant'>";
			    					echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-user/".$liste_entreprise[2]." width=220 height=150 alt=".$liste_entreprise[2]."></div>";
			    					echo "<div class='contenu_en-avant'><h4><a href=fiche-user?id=".$liste_entreprise[0].">".$liste_entreprise[1]."</a></h4>";
									echo "<h5>A participé à </br><a href=fiche-projet?idproj=".$liste_entreprise[4].">".$liste_entreprise[3]."</a></h5></div>";
									echo"<div class=modif-suppr><a href=modif-user.php?id=".$liste_entreprise[0].">Modifier</a>";
									echo"<a href=suppr-user.php?id=".$liste_entreprise[0].">Supprimer</a></div></div>";
								}
								elseif($_SESSION['id']==$liste_entreprise[5]){
									echo "<div class='groupe_en-avant'>";
			    					echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-user/".$liste_entreprise[2]." width=220 height=150 alt=".$liste_entreprise[2]."></div>";
			    					echo "<div class='contenu_en-avant'><h4><a href=fiche-user?id=".$liste_entreprise[0].">".$liste_entreprise[1]."</a></h4>";
									echo "<h5>A participé à </br><a href=fiche-projet?idproj=".$liste_entreprise[4].">".$liste_entreprise[3]."</a></h5></div>";
									echo"<div class=modif-suppr><a href=modif-user.php?id=".$liste_entreprise[0].">Modifier</a>";
									echo"<a href=suppr-user.php?id=".$liste_entreprise[0].">Supprimer</a></div></div>";
								}
								else{
								
									echo "<div class='groupe_en-avant'>";
			    					echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-user/".$liste_entreprise[2]." width=220 height=150 alt=".$liste_entreprise[2]."></div>";
			    					echo "<div class='contenu_en-avant'><h4><a href=fiche-user?id=".$liste_entreprise[0].">".$liste_entreprise[1]."</a></h4>";
									echo "<h5>A participé à </br><a href=fiche-projet?idproj=".$liste_entreprise[4].">".$liste_entreprise[3]."</a></h5></div></div>";
								}
								
							}else{
								echo "<div class='groupe_en-avant'>";
			    				echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-user/".$liste_entreprise[2]." width=220 height=150 alt=".$liste_entreprise[2]."></div>";
			    				echo "<div class='contenu_en-avant'><h4><a href=fiche-user?id=".$liste_entreprise[0].">".$liste_entreprise[1]."</a></h4>";
								echo "<h5>A participé à </br><a href=fiche-projet?idproj=".$liste_entreprise[4].">".$liste_entreprise[3]."</a></h5></div></div>";
							}
							
						}
					}else echo "<h3><span>Aucune entreprise n'as encore fait de dons</span></h3>";
				?>
    			</div>
    		</section>
  		</div>
    	<?php 
    		include('footer.php');
    	?>
    </body>
</html>