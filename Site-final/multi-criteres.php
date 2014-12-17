<form method="get" action="multi-criteres.php">
    <strong>Catégrorie</strong>
    Régional<input type="radio" name="categorie" value="regional">
    National<input type="radio" name="categorie" value="national">
    International<input type="radio" name="categorie" value="international">
    <strong>Date de publication</strong>
    <input id="date" type="text" name="date_publication">
    <strong>progression</strong>
    Nouveau<input type="radio" name="progression" value="nouveau">
	En cours<input type="radio" name="progression" value="en_cours">
    Bientot terminé<input type="radio" name="progression" value="bientot_termine">
	Terminé<input type="radio" name="progression" value="termine">
    <input type="submit" value="rechercher" name="submit">
</form>
<?php

	session_start();
	include('connect.php');
	
	if(isset($_GET['submit'])){
	  
		if(isset($_GET['categorie'])) $categorie=$_GET['categorie'];
		if(isset($_GET['date_publication'])) $date_publication=$_GET['date_publication'];
		if(isset($_GET['progression'])) $progression=$_GET['progression'];
		
		if((empty($categorie)) && (empty($date_publication)) && (empty($progression))){
		  echo "<script>alert(\"Veuillez choisir une date et/ou une cat&eacute;gorie et/ou un progression\")</script>";
		}
		if((empty($categorie)) && (!empty($date_publication)) && (empty($progression))){
		  $requete="SELECT * FROM Projet WHERE DateCreationProjet='".$date_publication."' ORDER BY DateCreationProjet;";
		}
		if((!empty($categorie)) && (empty($date_publication)) && (empty($progression))){
		  $requete="SELECT * FROM Projet WHERE CategorieProjet='".$categorie."' ORDER BY DateCreationProjet;";
		}
		if((!empty($categorie)) && (!empty($date_publication)) && (empty($progression))){
		  $requete="SELECT * FROM Projet WHERE CategorieProjet='".$categorie."' AND DateCreationProjet='".$date_publication."' ORDER BY DateCreationProjet;";
		}
		if((empty($categorie)) && (empty($date_publication)) && (!empty($progression))){
		  $requete="SELECT * FROM Projet WHERE ProgressionProjet='".$progression."' ORDER BY DateCreationProjet;";
		}
		if((!empty($categorie)) && (empty($date_publication)) && (!empty($progression))){
		  $requete="SELECT * FROM Projet WHERE CategorieProjet='".$categorie."' AND ProgressionProjet='".$progression."' ORDER BY DateCreationProjet;";
		}
		if((empty($categorie)) && (!empty($date_publication)) && (!empty($progression))){
		  $requete="SELECT * FROM Projet WHERE DateCreationProjet='".$date_publication."' AND ProgressionProjet='".$progression."' ORDER BY DateCreationProjet;";
		}
		if((!empty($categorie)) && (!empty($date_publication)) && (!empty($progression))){
		  $requete="SELECT * FROM Projet WHERE CategorieProjet='".$categorie."' AND DateCreationProjet='".$date_publication."' AND ProgressionProjet='".$progression."' ORDER BY DateCreationProjet;";
		}
		
		$result=mysql_query($requete);
		
		if($_SESSION){
			if($_SESSION['type']==5){
				while($liste_projet=mysql_fetch_row($result)){
					echo "<div class='groupe_en-avant'>";
					echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-projet/".$liste_projet[8]." width=223 height=150 alt=".$liste_projet[8]."></div>";
		    		echo "<div class='contenu_en-avant'><h4><a href=fiche-projet?idproj=".$liste_projet[0].">".$liste_projet[1]."</a></h4>";
					echo "<h5>Par <a href=fiche-user?id=".$liste_projet[9].">".$liste_projet[1]."</a></h5></div>";
					echo "<div class='contenu_en-avant'><h5>Avancement</h5><div class=progress progress-striped><div class=bar style='width: 50%;'></div></div><div class=modif-suppr><a href=modif-projet.php?idproj=".$liste_projet[0].">Modifier</a>";
					echo"<a href=suppr-projet.php?idproj=".$liste_projet[0].">Supprimer</a></div></div></div>";
				}
			}
			}else{
				while($liste_projet=mysql_fetch_row($result) or die (mysql_error())){
					echo "<div class='groupe_en-avant'>";
					echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-projet/".$liste_projet[8]." width=223 height=150 alt=".$liste_projet[8]."></div>";
			    	echo "<div class='contenu_en-avant'><h4><a href=fiche-projet?idproj=".$liste_projet[0].">".$liste_projet[1]."</a></h4>";
					echo "<h5>Par <a href=fiche-user?id=".$liste_projet[9].">".$liste_projet[1]."</a></h5></div>";
					echo "<div class='contenu_en-avant'><h5>Avancement</h5><div class=progress progress-striped><div class=bar style='width: 50%;'></div></div>";
					if($_SESSION){
						if($_SESSION['id']==$liste_projet[7]){
							echo"<a href=modif-projet.php?idproj=".$liste_projet[0].">Modifier</a>";
							echo"<a href=suppr-projet.php?idproj=".$liste_projet[0].">Supprimer</a>";	
						}
					}
				}
			}
		
		echo "</div>";
	}
	
?>