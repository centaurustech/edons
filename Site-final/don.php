<?php
	include('connect.php');
	session_start();
?>
<html>
	<head>
		<meta charset='utf-8'>
   	 	<title>Edons (Site final) | Don</title>
   	 	<link rel='stylesheet' href='css/styles-mise-en-page.css'>
		<link rel='stylesheet' href='css/styles-typographie-couleur.css'>
		<link rel='stylesheet' href='css/styles-graphique.css'>
		<link rel="icon" href="css/images-interface/favicon.ico"/>
   	</head>
    <body>
    	<?php 
    		include('header.php');
    	?>
    	<div class="corps" id="don-projet">
		<?php
			if($_SESSION){
				$id=$_SESSION['id'];
				$id_projet=$_GET['idproj'];
				
				$requete=mysql_query("Select FondNecessaireProjet From Projet where IDProjet=".$_GET['idproj'].";");
				$result=mysql_result($requete,0,0);
				$fondNecessaire=$result;
				
				echo"<form method=post action=don.php?idproj=".$id_projet.">
					<div><h4>Montant de votre don</h4><p><input type=number name=donsUser /> / ".$fondNecessaire."€</p></div>
					<input class=submit type=submit value='Faire un don' name=don />
				</form>";
				
				if(isset($_POST['don'])){
					$ValeurDon=$_POST['donsUser'];
					
					$requete="INSERT INTO Don (ValeurDon,IDUser,IDProjet) VALUES (".$ValeurDon.",".$id.",".$id_projet.");";
					$result=mysql_query($requete);
				
					$requete=mysql_query("Select FondRecolteProjet From Projet where IDProjet=".$_GET['idproj'].";");
					$result=mysql_result($requete,0,0);
				
					$fondRecolte=$result;
					$newFondRecolte=$fondRecolte+$ValeurDon;
					
					$nb=intval(($newFondRecolte*100)/$fondNecessaire);
					
					if(($nb>20)&&($nb<80)){
						$requete=mysql_query("Update Projet set ProgressionProjet='en_cours' where IDProjet=".$_GET['idproj'].";");
						
					}elseif(($nb>=80)&&($nb<100)){
						$requete=mysql_query("Update Projet set ProgressionProjet='bientot_termine' where IDProjet=".$_GET['idproj'].";");
					}elseif($nb>=100){
						$requete=mysql_query("Update Projet set ProgressionProjet='termine' where IDProjet=".$_GET['idproj'].";");
					}
					
					$requete2="Update Projet set FondRecolteProjet='".$newFondRecolte."' where IDProjet=".$_GET['idproj'].";";
					$reponse2=mysql_query($requete2);
					$affected=mysql_affected_rows();
					
					if($affected==0){
						echo "<script>alert(\"Votre don n'a pas été éffectué, réessayer.\")</script>";
					}else{
						echo "<script>alert(\"Votre don a bien été éffectué.\")</script>";
					}
				}
			}else{
				echo "<script>alert(\"Vous devez être connecté pour effectuer un don.\")</script>";
			}
		?>
  		</div>
    	<?php
    		include('footer.php');
    	?>
    </body>
</html>