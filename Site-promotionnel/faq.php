<?php
	include('connect.php');
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Edons (Site promotionnel) | F.A.Q</title>
    <link rel='stylesheet' href='css/styles-mise-en-page.css'>
	<link rel='stylesheet' href='css/styles-typographie-couleur.css'>
	<link rel='stylesheet' href='css/styles-graphique.css'>
	<link rel="icon" href="css/images-interface/favicon.ico"/>
  </head>
  <body class="faq-actif">
    <?php
    	include('header.php');
    ?>
    <div class="corps" id="faq">
    	<h1>Foire aux questions</h1>
    	<h2><span>Les bases</span></h2>
    	<ul>
    		<li><h3><span>Edons, c’est quoi&nbsp;?</span></h3></li>
    		<li>Notre service "Edons" propose de venir en aide à des associations humanitaires. Nous sommes un intermédiaire entre elles et les donateurs. Edons est une vitrine pour lancer leurs projets. Nous collectons les fonds et ils les utilisent pour mener à bien leurs projets.</li>
    	</ul>
    	<h2><span>L'inscription</span></h2>
    	<ul>
    		<li><h3><span>Comment créer un profil&nbsp;?</span></h3></li>
    		<li>Nous avons choisi de créer 3 statuts différents, avec des possibilités différentes. Chaque statut est indispensable à la vie de la plateforme.
			Le profil "Particulier".  Depuis son profil, le membre doit pouvoir avoir accès aux actualités des projets qu'il a financé tout au long de leur déroulement, une page sera entièrement dédiée à l'actualité des différents projets, via un onglet "Mes actualités". Mais il pourra également avoir accès à l'actualité des associations et des projets qu'il n'a pas financé via un onglet "Favoris".
			Le statut "Association". Votre profil devra contenir un maximum d'informations utiles, tel que les projets déjà crées ou les actions que l'association déjà effectuées par le passé.
			Finalement, le statut "Entreprise", qui correspond au profil "Particulier" mais spécifique pour les entreprises.</li>
    		<li><h3><span>Comment créer et lancer son projet&nbsp;?</span></h3></li>
    		<li>Chaque association s'inscrivant sur le site aura accès à un espace entièrement paramétrable qui lui permettra d'afficher des images ou des vidéos de son projet, un descriptif de son projet, ses attentes en termes de dons et comment ces dons seront utilisés.</li>
    	</ul>
    	<h2><span>Comment réaliser un don&nbsp;?</span></h2>
    	<ul>
    		<li><h3><span>Pourquoi par carte bancaire&nbsp;?</span></h3></li>
    		<li>C’est le moyen de paiement le plus commun puisqu'il est utilisé dans la vie de tout les jours, cependant sur le net il est encore considéré comme peu sécurisé et les internautes craignent de voir les coordonnées bancaires récupérées par un pirate. Ce moyen de paiement est donc le plus commun mais aussi celui qui apparait comme le moins sécurisé.
    		Nous mettrons également en place un système de paiement sécurisé encore peu répandu : la carte bancaire à usage unique.</li>
    		<li><h3><span>Et le système Paypal&nbsp;?</span></h3></li>
    		<li><h4><span>Comment ça marche&nbsp;?</span></h4></li>
    		<li>Après l'ouverture d'un compte, l'Edonneur effectue son paiement en indiquant son adresse email, son mot de passe, l'adresse mail de l'association, le montant et la devise. PayPal sert alors d'intermédiaire entre l'Edonneur et le l'association et les opérations de débit et de crédit sont quasi-instantanées sur les comptes PayPal.
    		Vous pouvez ensuite vérifier que la transaction a bien été effectuée en vous connectant à votre compte PayPal.
    		A aucun moment vous ne communiquez vos informations bancaires au vendeur ni à un tiers.</li>
    		<li><h4><span>Déroulement d’un don</span></h4></li>
    		<li><img src="css/images-contenu/Paypal.jpg" width="" height="" alt="Fonctionnement Paypal" /></li>
    		<li><h3><span>Suis-je remboursé si le projet n'est pas financé à temps&nbsp;?</span></h3></li>
    		<li>Les fonds seront intégralement redistribués à leurs donateurs.</li>
    		<li><h3><span>Quel est le délai de collecte de fonds pour un projet&nbsp;?</span></h3></li>
    		<li>La collecte de fonds sur un projet se fera sur 90 jours en fonction de l’urgence du projet.</li>
    	</ul>
    </div>
	<?php
		include('footer.php');
	?>
  </body>
</html>