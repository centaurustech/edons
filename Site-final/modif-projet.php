<?php
	session_start();
	include('connect.php');
	if(!(isset($_SESSION['id']))) header ('location:index.php');
	
	//====MODIFICATION====
	
	$req="SELECT * FROM Projet WHERE IDProjet=".$_GET['idproj'].";";
	$res=mysql_query($req);
	$liste=mysql_fetch_row($res);
	
	$nom=$liste[1];
	$categorie=$liste[2];
	$bio=$liste[7];
	$fonds=$liste[4];
	$idproj=$liste[0];
	$image=$liste[8];
?>
<html>
	<head>
		<meta charset='utf-8'>
   	 	<title>Edons (Site final) | Modification Projet</title>
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
	    			<form method='post' action='modif-projet.php?idproj=<?php echo $idproj ?>' enctype="multipart/form-data">
	    				<div class="info">
							<div><h4>Nom du projet</h4><input type='text' name='nom' value="<?php echo $nom ?>"></div>
							<div><h4>Descriptif</h4><textarea name='bio'/><?php echo $bio ?></textarea></div>
							<div><h4>Fonds necessaire</h4><input type='number' name='fonds' value='<?php echo $fonds ?>'/></div>
							<div><h4>Catégorie</h4><!--
							--><select name="categorie">
									<option value="regional">Régional</option>
									<option value="national">National</option>
									<option value="international">International</option>
								</select>
							</div>
						</div>
						<input class="submit" type='submit' value='Modifier' name="modifier"/>
					</form>
				</div>
			</section>
  		</div>
    	<?php
    		include('footer.php');
    	?>
    </body>
</html>
<?php			
	if(isset($_GET['idproj'])){
		if(isset($_POST['modifier'])){
			if((!empty($_POST['nom']))&&(!empty($_POST['bio']))&&(!empty($_POST['fonds']))&&(!empty($_POST['categorie']))){
				$nom_nouv=addslashes($_POST['nom']);
				$bio_nouv=addslashes($_POST['bio']);
				$fonds_nouv=$_POST['fonds'];
				$categorie_nouv=$_POST['categorie'];
				
				$requete="UPDATE Projet SET NomProjet='".$nom_nouv."',CategorieProjet='".$categorie_nouv."',FondNecessaireProjet=".$fonds_nouv.",BioProjet='".$bio_nouv."' WHERE IDProjet=".$idproj.";";
				$result=mysql_query($requete);
				$nb=mysql_affected_rows();
				
				if($nb == 0){
					echo"<script>alert(\"Modification échouée\")</script>";
				}
				else{
					if($result){
						header ('location:fiche-projet.php?idproj='.$idproj);
					}
				}
			}else{
				echo"<script>alert(\"Veuillez remplir tout les champs\")</script>";
			}
		}
	}
?>