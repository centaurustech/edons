<?php
	include('connect.php');
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Edons (Site promotionnel) | Accueil</title>
	<link rel='stylesheet' href='css/styles-mise-en-page.css'>
	<link rel='stylesheet' href='css/styles-typographie-couleur.css'>
	<link rel='stylesheet' href='css/styles-graphique.css'>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
	<link rel="icon" href="css/images-interface/favicon.ico"/>
  </head>
  <body>
    <?php
    	include('header.php');
    ?>
    <div class="corps" id="accueil">
    	<section id="pitch">
    		<h2>Qu'est-ce que Edons&nbsp;?</h2>
    		<div></div>
    		<p>Vous souhaitez soutenir des projets <strong>humanitaires</strong>&nbsp;?&nbsp;Edons est la solution. En quelques clics, donnez l'opportunité à un panel <strong>d'associations</strong> de réaliser leurs projets, grâce à un paiement <strong>sécurisé</strong>. Que vous soyez un particulier ou une entreprise, Edons vous donne la possibilité de créer votre profil, lancez une recherche <strong>personnalisée</strong> et suivre l'actualité des projets que vous avez financés&nbsp;!&nbsp;Ces associations ont besoins de vous. <strong>Engagez-vous</strong> avec Edons, devenez des Edonneurs et <strong>encouragez vos rêves</strong>&nbsp;!</p>
    		<div></div>
    	</section>
    	<section id="slider">
	    	<div id="conteneur-slider"> 
			   <div>
				    <div id="slide-1" class="courant">
				    	<h3>Associations</h3>
				    	<ul>
							<li><span><span class="en-rose">+</span>Etender votre visibilité</span></li>
							<li><span><span class="en-rose">+</span>Augmenter vos fonds</span></li>
							<li><span><span class="en-rose">+</span>Personnaliser vos pages de projet</span></li>
							<li><span><span class="en-rose">+</span>Echanger avec les donnateurs</span></li>
						</ul>
						<span class="voir-plus"><a href="#" class="opener" data-dialog-opener="dialog1"></a></span>
						<div class="dialog" id="dialog1" title="Associations">
							<p>Vous êtes une <strong>association</strong> humanitaire&nbsp;?&nbsp;Edons est une vitrine pour <strong>lancez votre projet</strong>&nbsp;!&nbsp;Vous pourrez y déposer toutes les informations nécessaires à l’accomplissement de votre projet grâce à une page de projet <strong>entièrement paramétrable</strong>. Ajoutez-y des images ou des vidéos, un descriptif de votre projet ainsi que le montant des <strong>fonds nécessaires</strong>. Une fois le projet mené à son terme, Edons proposera de stocker vos anciens projets dans le profil de l'association, <strong>consultable par tous</strong>.</p>
						</div>
				    </div>  
				    <div id="slide-2" class="apres">
				    	<h3>Particuliers</h3>
				    	<ul>                                        
				    		<li><span><span class="en-rose">+</span>Liste d'associations accessibles</span></li>
				    		<li><span><span class="en-rose">+</span>Participer à des projets</span></li>
				    		<li><span><span class="en-rose">+</span>Utiliser un paiement sécurisée</span></li>
				    		<li><span><span class="en-rose">+</span>Suiver l'avancement des projets</span></li>
				    	</ul>
				    	<span class="voir-plus"><a href="#" class="opener" data-dialog-opener="dialog2"></a></span>
				    	<div class="dialog" id="dialog2" title="Particuliers">
							<p>Edons vous donne la possibilité de <strong>participer activement</strong> à l’aboutissement de nombreux <strong>projets humanitaire</strong>. Car c’est en grande partie <strong>grâce à vous</strong>, que de nombreuses associations arrivent à <strong>mener à termes</strong> leurs projets. Devenez un <strong>membre actif</strong> de cette communauté en créant votre profil. Dans laquelle vous posterez toutes vos informations. Plusieurs <strong>paiements sécurisés</strong> ont été mis en place pour assurer de meilleures transactions. Bénéficiez ensuite de nombreux avantages fiscaux directement déductibles de vos impôts.</p>
						</div>
				    </div>  
				    <div id="slide-3" class="apres">
				    	<h3>Entreprises</h3>
				    	<ul>
				    		<li><span><span class="en-rose">+</span>Parrainer des associations
				    		<li><span><span class="en-rose">+</span>Améliorer votre image de marque
				    		<li><span><span class="en-rose">+</span>Personnaliser vos profils
				    		<li><span><span class="en-rose">+</span>Obtener une déduction fiscale
				    	</ul>
				    	<span class="voir-plus"><a href="#" class="opener" data-dialog-opener="dialog3"></a></span>
				    	<div class="dialog" id="dialog3" title="Entreprises">
							<p>Edons vous propose une nouvelle manière de <strong>façonner votre image de marque</strong> et ce, en participant activement aux financements de <strong>projets humanitaires</strong>. L'utilité publique joue en votre faveur. Avec cet investissement vous y trouverez un <strong>double avantage</strong>, car cette participation vous permet également une <strong>déduction fiscal</strong> sur vos charges. Vous disposerez d'une page <strong>profil paramétrable</strong> à votre guise, dans laquelle vous pourrez y ajouter toutes les informations vous concernant.</p>
						</div>
				    </div>
				</div>
			</div>
			<ul id="navigation-slider">
				<li class="actif"><a href="#slide-1" accesskey="1">Associations</a></li>
				<li><a href="#slide-2" accesskey="2">Particuliers</a></li>
				<li><a href="#slide-3" accesskey="3">Entreprises</a></li>
			</ul>
    	</section>
    	<section id="conteneur-compteur">
    		<div id="visible">
	    		<h2>Votre service sera disponible dans&nbsp;:</h2>
	    		<div id="compteur">
		    		<div class="bloc" id="jours"></div>
		    		<p class="bloc">:</p>
		    		<div class="bloc" id="heures"></div>
		    		<p class="bloc">:</p>
		    		<div class="bloc" id="minutes"></div>
		    		<p class="bloc">:</p>
		    		<div class="bloc" id="secondes"></div>
	    		</div><!--
	    		--><div id="description-compteur">
	    			<ul>
	    				<li>Jours</li><!--
	    				--><li>Heures</li><!--
	    				--><li>Minutes</li><!--
	    				--><li>Secondes</li>
	    			</ul>
	    		</div>
    		</div><!--
    		--><div id="texte-compteur-cacher">
    			<h3>Cliquez sur ce lien et découvrez notre service&nbsp;:</h3>
    			<a href="https://src-projet2.pu-pm.univ-fcomte.fr/projets-co/projet33/Site-final/index.php">Accèder au site</a>
    		</div>
    	</section>
    </div>	
	<?php
		include('footer.php');
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script src="js/compteur.js"></script>
	<script src="js/slider.js"></script>
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