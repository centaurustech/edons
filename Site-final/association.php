<?php
	session_start();
	include('connect.php');
?>
<html>
	<head>
		<meta charset='utf-8'>
   	 	<title>Edons (Site final) | Associations</title>
   	 	<link rel='stylesheet' href='css/styles-mise-en-page.css'>
		<link rel='stylesheet' href='css/styles-typographie-couleur.css'>
		<link rel='stylesheet' href='css/styles-graphique.css'>
		<link rel="icon" href="css/images-interface/favicon.ico"/>
   	</head>
    <body class="associations-actif">
    	<?php 
    		include('header.php');
    	?>
    	<div class="corps">
    		<section class="module-entreprises">
    			<div class="en-avant">
				<?php
					$requete="SELECT User.IDUser,User.NomUser,User.ImgProfilUser,Projet.NomProjet,Projet.IDProjet,User.IDType FROM User,Projet WHERE User.IDUser=Projet.IDUser AND User.IDType=2 GROUP BY IDUser ORDER BY IDUser;";
					$result=mysql_query($requete);
					$nb=mysql_affected_rows();
					
					if($nb != 0){
						echo "<h3><span>Il y a ".$nb." résultat(s)</span></h3>";
						while($liste_association=mysql_fetch_row($result)){
							if($_SESSION){
								if($_SESSION['type']==5){
									echo "<div class='groupe_en-avant'>";
			    					echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-user/".$liste_association[2]." width=220 height=150 alt=".$liste_association[2]."></div>";
			    					echo "<div class='contenu_en-avant'><h4><a href=fiche-user?id=".$liste_association[0].">".$liste_association[1]."</a></h4>";
									echo "<h5>A participé à </br><a href=fiche-projet?idproj=".$liste_association[4].">".$liste_association[3]."</a></h5></div>";
									echo"<div class=modif-suppr><a href=modif-user.php?id=".$liste_association[0].">Modifier</a>";
									echo"<a href=suppr-user.php?id=".$liste_association[0].">Supprimer</a></div></div>";
								}
								elseif($_SESSION['id']==$liste_association[5]){
									echo "<div class='groupe_en-avant'>";
			    					echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-user/".$liste_association[2]." width=220 height=150 alt=".$liste_association[2]."></div>";
			    					echo "<div class='contenu_en-avant'><h4><a href=fiche-user?id=".$liste_association[0].">".$liste_association[1]."</a></h4>";
									echo "<h5>A participé à </br><a href=fiche-projet?idproj=".$liste_association[4].">".$liste_association[3]."</a></h5></div>";
									echo"<div class=modif-suppr><a href=modif-user.php?id=".$liste_association[0].">Modifier</a>";
									echo"<a href=suppr-user.php?id=".$liste_association[0].">Supprimer</a></div></div>";
								}
								else{
									echo "<div class='groupe_en-avant'>";
			    				echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-user/".$liste_association[2]." width=220 height=150 alt=".$liste_association[2]."></div>";
			    				echo "<div class='contenu_en-avant'><h4><a href=fiche-user?id=".$liste_association[0].">".$liste_association[1]."</a></h4>";
								echo "<h5>A participé à </br><a href=fiche-projet?idproj=".$liste_association[4].">".$liste_association[3]."</a></h5></div></div>";
								}
								
							}else{
								echo "<div class='groupe_en-avant'>";
			    				echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-user/".$liste_association[2]." width=220 height=150 alt=".$liste_association[2]."></div>";
			    				echo "<div class='contenu_en-avant'><h4><a href=fiche-user?id=".$liste_association[0].">".$liste_association[1]."</a></h4>";
								echo "<h5>A participé à </br><a href=fiche-projet?idproj=".$liste_association[4].">".$liste_association[3]."</a></h5></div></div>";
							}
							
						}
					}else echo "<h3><span>Aucune association n'as encore été créer</span></h3>";
				?>
    			</div>
    		</section>
  		</div>
    	<?php
    		include('footer.php');
    	?>
    </body>
</html>