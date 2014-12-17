<header>
	<hgroup >
		<a class="logo" href="index.php"></a>
	</hgroup>
	<nav>
		<ul>
			<li class="projets-actif"><a href="projet.php">Les Projets</a></li>
			<li class="entreprises-actif"><a href="entreprise.php">Les Entreprises</a></li>
			<li class="associations-actif"><a href="association.php">Les Associations</a></li>
			<?php 
				if($_SESSION){
					if(($_SESSION['type']==2)||($_SESSION['type']==5)){
						echo"<li class='nouveau-actif'><a href='ajout-projet.php'>Créer un projet</a></li>";
					}
				}
			?>
		</ul>
	</nav><!--
 --><div>
 	<?php
			if(!(isset($_SESSION['login']))){
				echo"<div class=info><a href=inscri-connex.php>Se connecter</a> / <a href=inscri-connex.php>S'inscrire</a></div>";
			}else{
				$requete="SELECT ImgProfilUser FROM User WHERE IDUser=".$_SESSION['id'].";";
				$result= mysql_query($requete);
				$nb=mysql_affected_rows();
				if($nb!=0){
					$liste=mysql_fetch_assoc($result);
					echo "<div class=info><ul><li><img src=css/images-contenu/upload/profil-user/".$liste['ImgProfilUser']." width=40 height=40 alt=".$liste['ImgProfilUser']."></li>";
					echo "<li><a href=fiche-user.php?id=".$_SESSION['id'].">Profil</a></li>";
					echo "<li>/</li>";
					echo "<li><a href=deconnexion.php>Se déconnecter</a></li></div>";
				}else{
					echo "<div class=info><ul><li>".$_SESSION['login']."</li>";
					echo "<li><a href=fiche-user.php?id=".$_SESSION['id'].">Profil</a></li>";
					echo "<li>/</li>";
					echo "<li><a href=deconnexion.php>Se déconnecter</a></li></div>";	
				}
			}
		?>
 		<form class="recherche" method="post" action="liste-projet.php">
			<input type="text" name="recherche" placeholder="Rechercher un projet"/>
			<input type="submit" name="rechercher" value="Ok"/>
		</form>
	</div>
</header>