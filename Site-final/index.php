<?php
	include('connect.php');
	//if(!(isset($_SESSION['id']))) session_destroy();
	session_start();
?>
<html>
	<head>
		<meta charset='utf-8'>
   	 	<title>Edons (Site final) | Accueil</title>
   	 	<link rel='stylesheet' href='css/styles-mise-en-page.css'>
		<link rel='stylesheet' href='css/styles-typographie-couleur.css'>
		<link rel='stylesheet' href='css/styles-graphique.css'>
		<link rel="icon" href="css/images-interface/favicon.ico"/>
   	</head>
    <body>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		 		var js, fjs = d.getElementsByTagName(s)[0];
		 		if (d.getElementById(id)) return;
		  		js = d.createElement(s); js.id = id;
		  		js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
		  		fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
		</script>
    	<?php 
    		include('header.php');
    	?>
    	<div class="corps" id="index">
    		<section class="module-projets">
    			<h3><span>Les nouveaux projets</span></h3>
    			<div class="en-avant">
    				<?php
    					$requete="SELECT Projet.IDUser,NomUser,NomProjet,Projet.IDProjet,ImgProfilProjet,FondRecolteProjet,FondNecessaireProjet FROM User,Projet WHERE User.IDUser=Projet.IDUser AND User.IDType=2 GROUP BY IDProjet ORDER BY IDProjet DESC Limit 0,4;";
						$result=mysql_query($requete);
						while($liste=mysql_fetch_row($result)){
								$pourcentage= (($liste[5]*100)/$liste[6]);
	    						echo "<div class='groupe_en-avant'>";
								echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-projet/".$liste[4]." width=220 height=150 alt=".$liste[4]."></div>";
	    						echo "<div class='contenu_en-avant'><h4><a href=fiche-projet?idproj=".$liste[3].">".$liste[2]."</a></h4>";
								echo "<h5>Par <a href=fiche-user?id=".$liste[0].">".$liste[1]."</a></h5></div>";
								echo "<div class='contenu_en-avant'><h5>Avancement</h5><div class=progress progress-striped><div class=bar style='width:".$pourcentage."%;'></div></div></div></div>";
						}
    				?>
    			</div>
    		</section>
    		<section class="module-entreprises">
    			<h3><span>Les nouvelles entreprises</span></h3>
    			<div class="en-avant">
    				<?php
    					$requete="SELECT User.IDUser,User.NomUser,User.ImgProfilUser,Projet.NomProjet,Projet.IDProjet, User.IDType FROM User,Projet,Don WHERE User.IDUser=Don.IDUser AND Projet.IDProjet=Don.IDProjet AND User.IDType=4 GROUP BY IDUser ORDER BY IDUser Limit 0,4;";
						$result=mysql_query($requete);
						while($liste=mysql_fetch_row($result)){
	    						echo "<div class='groupe_en-avant'>";
	    						echo "<div class='contenu_en-avant'><img src=css/images-contenu/upload/profil-user/".$liste[2]." width=220 height=150 alt=".$liste[2]."></div>";
	    						echo "<div class='contenu_en-avant'><h4><a href=fiche-user?id=".$liste[0].">".$liste[1]."</a></h4>";
								echo "<h5>A participé à </br><a href=fiche-projet?idproj=".$liste[4].">".$liste[3]."</a></h5></div></div>";
						}
    				?>
    			</div>
    		</section>
    		<section class="module-membres">
    			<h3><span>Les nouveaux membres</span></h3>
    			<div class="en-avant">
    				<?php
    					$requete="SELECT IDUser,ImgProfilUser FROM User WHERE User.IDType=4 OR User.IDType=3 OR User.IDType=5 GROUP BY IDUser ORDER BY IDUser DESC Limit 0,21;";
						$result=mysql_query($requete);
						while($liste=mysql_fetch_row($result)){
	    						echo "<div class='groupe_en-avant'>";
	    						echo "<a href=fiche-user?id=".$liste[0]."><img src=css/images-contenu/upload/profil-user/".$liste[1]." width=60 height=60 alt=".$liste[1]."></a></div>";
						}
    				?>
    			</div>
    		</section>
    		<section class="module-facebook">
    			<h3><span>Facebook</span></h3>
    			<div class="fb-like-box" data-href="https://www.facebook.com/EdonsSrcmedia" data-width="250" data-show-faces="true" data-stream="false" data-show-border="true" data-header="true"></div>
    		</section>
  		</div>
    	<?php
    		include('footer.php');
    	?>
    </body>
</html>
<!--INSCRIPTION NEWSLETTER-->

<?php
		if(isset($_POST['ok-news']))//Si l'utilisateur clique sur OK
		{
			$requete="SELECT LoginUser FROM User WHERE LoginUser='".$_POST['email-news']."';";
			$result=mysql_query($requete);
			$nb=mysql_num_rows($result);
			
			if($nb<1){
				$email = $_POST['email-news'];
				$key = md5($_POST['email-news']);
				
				$requete="INSERT INTO User (LoginUser,IDType) VALUES ('".$_POST['email-news']."', 0);";
				$result=mysql_query($requete);
				$id=mysql_insert_id();
		       
			    $message = "Bonjour, pour valider votre inscription à la newsletter de Edons, 
		        <a href=https://src-projet2.pu-pm.univ-fcomte.fr/projets-co/projet33/Site-promotionnel/validation-newsletter.php?id=".$id."&key=".$key.">cliquez ici</a>.";
		  
		        $destinataire = $email;
		        $objet = "Inscription à la newsletter de Edons";
		  
		        $headers  = 'MIME-Version: 1.0' . "\r\n";
		        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		        $headers .= 'From: Edons' . "\r\n";
				
		        if ( mail($destinataire, $objet, $message, $headers) )
		        {
		        echo "<script>alert(\"Pour valider votre inscription, veuillez cliquer sur le lien dans l'e-mail que nous venons de vous envoyer.\")</script>";
		        }
		        else
		        {
		        echo "<script>alert(\"Il y a eu une erreur lors de l'envoi du mail pour votre inscription.\")</script>";
		        }
	        }
			else{
				echo "<script>alert(\"Vous êtes déja inscrit.\")</script>";
			}
	
		}
?>