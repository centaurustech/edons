<?php
	session_start();
	include('connect.php');
	if(!(isset($_SESSION['id']))) header ('location:index.php');
	
	//====MODIFICATION====
	
	$req="SELECT * FROM User WHERE IDUser=".$_GET['id'].";";
	$res=mysql_query($req);
	$liste=mysql_fetch_row($res);
	
	$id=$liste[0];
	$login=$liste[1];
	$nom=$liste[3];
	$prenom=$liste[4];
	$date=$liste[5];
	$bio=$liste[6];
	$image=$liste[7];
	$site=$liste[8];
	$facebook=$liste[9];
	$twitter=$liste[10];
	$idtype=$liste[11];
?>
<html>
	<head>
		<meta charset='utf-8'>
   	 	<title>Edons (Site final) | Modification Utilisateur</title>
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
    		<section class="modif-projet">
    			<div class="contenu_fiche">
    			<?php
    				if(($idtype==2)||($idtype==4)){
    					echo "<form method='post' action='modif-user.php?id=".$id."' enctype='multipart/form-data'>";
						echo"<div class='info'>";
    					echo "<div><h4>Nom</h4><input type='text' name='nom' value='".$nom."'/>(obligatoire)</div>";
						echo "<div><h4>Descriptif</h4><textarea name='bio'>".$bio."</textarea></div>";
						echo"</div>";
						echo"<div class='liensExterne'>";
						echo "<div><h4>Site web</h4><input type='text' name='site' value='".$site."'/></div>";
						echo "<div><h4>Facebook</h4><input type='text' name='facebook' value='".$facebook."'/></div>";
						echo "<div><h4>Twitter</h4><input type='text' name='twitter' value='".$twitter."'/></div>";
						echo"</div>";
						echo "<input class='submit' type='submit' name='envoie' value='Ajouter/Modifier'/></form>";
						
    				}else{
    					echo "<form method='post' action='modif-user.php?id=".$id."' enctype='multipart/form-data'>";
    					echo"<div class='info'>";
    					echo "<div><h4>Nom</h4><input type='text' name='nom' value='".$nom."'/>(obligatoire)</div>";
						echo "<div><h4>Prenom</h4><input type='text' name='prnm' value='".$prenom."'/>(obligatoire)</div>";
						echo "<div><h4>Biographie</h4><textarea name='bio'>".$bio."</textarea></div>";
						echo "<div><h4>Date de naissance</h4><input type='text' name='date' placeholder='AAAA/MM/JJ' value='".$date."'/></div>";
						echo"</div>";
						echo"<div class='liensExterne'>";
						echo "<div><h4>Site web</h4><input type='text' name='site' value='".$site."'/></div>";
						echo "<div><h4>Facebook</h4><input type='text' name='facebook' value='".$facebook."'/></div>";
						echo "<div><h4>Twitter</h4><input type='text' name='twitter' value='".$twitter."'/></div>";
						echo"</div>";
						echo "<input class='submit' type='submit' name='envoie' value='Ajouter/Modifier'/></form>";
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
<?php			
	if(isset($_GET['id'])){
		if(isset($_POST['envoie'])){
			if(($_SESSION['type']==3) || ($_SESSION['type']==5)){
				if(isset($_POST['nom']))$nom_nouv=addslashes($_POST['nom']);
				if(isset($_POST['prnm']))$prenom_nouv=addslashes($_POST['prnm']);
				if(isset($_POST['date']))$date_nouv=$_POST['date'];
				if(isset($_POST['site']))$site_nouv=addslashes($_POST['site']);
				if(isset($_POST['facebook']))$facebook_nouv=addslashes($_POST['facebook']);
				if(isset($_POST['twitter']))$twitter_nouv=addslashes($_POST['twitter']);
				if(isset($_POST['bio']))$bio_nouv=addslashes($_POST['bio']);

				$requete="UPDATE User SET NomUser='".$nom_nouv."',PrenomUser='".$prenom_nouv."',SiteUser='".$site_nouv."',FacebookUser='".$facebook_nouv."',TwitterUser='".$twitter_nouv."',DateNaissanceUser='".$date_nouv."',BioUser='".$bio_nouv."' WHERE IDUser=".$id.";";
				$result=mysql_query($requete);
				$nb=mysql_affected_rows();
			}

			if(($_SESSION['type']==2) || ($_SESSION['type']==4)){
				if(isset($_POST['nom'])) $nom_nouv=addslashes($_POST['nom']);
				if(isset($_POST['site']))$site_nouv=addslashes($_POST['site']);
				if(isset($_POST['facebook']))$facebook_nouv=addslashes($_POST['facebook']);
				if(isset($_POST['twitter']))$twitter_nouv=addslashes($_POST['twitter']);
				if(isset($_POST['bio']))$bio_nouv=addslashes($_POST['bio']);

				$requete="UPDATE User SET NomUser='".$nom_nouv."',SiteUser='".$site_nouv."',FacebookUser='".$facebook_nouv."',TwitterUser='".$twitter_nouv."',BioUser='".$bio_nouv."' WHERE IDUser=".$id.";";
				$result=mysql_query($requete);
				$nb=mysql_affected_rows();
			}
			if($nb == 0){
				echo"<script>alert(\"Modification échouée\")</script>";
			}
			else{
				if($result){
					header ('location:fiche-user.php?id='.$id);
				}
			}
		}
	}
?>