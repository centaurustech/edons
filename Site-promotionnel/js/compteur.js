function CompteARebours(){
	    var date_actuelle = new Date(); // On déclare la date d'aujourd'hui.
	 	console.log(date_actuelle);
	    var lancement = new Date(2013, 5, 10, 13, 10, 0); // On déclare la date de lancement.
	    console.log(lancement);     
	    var tps_restant = lancement.getTime() - date_actuelle.getTime(); // Temps restant en millisecondes
	 
	//============ CONVERSIONS
	 
		var s_restantes = tps_restant / 1000; // On convertit en secondes
		var i_restantes = s_restantes / 60;
		var H_restantes = i_restantes / 60;
		var d_restants = H_restantes / 24;
	 
	 
	    s_restantes = Math.floor(s_restantes % 60); // Secondes restantes
	    i_restantes = Math.floor(i_restantes % 60); // Minutes restantes
	    H_restantes = Math.floor(H_restantes % 24); // Heures restantes
	    d_restants = Math.floor(d_restants); // Jours restants
	    
	//==================
	    

	    if (d_restants < 10){
	    	var jours = "0"+d_restants;
	    }
	    else{
	    	var jours = +d_restants;
	    }
	    
	    if (H_restantes < 10){
	    	var heures = "0"+H_restantes;
	    }
	    else{
	    	var heures = +H_restantes;
	    }
	    
	    
	    if (i_restantes < 10){
	    	var minutes = "0"+i_restantes;
	    }
	    else{
	    	var minutes = +i_restantes;
	    }
	    
	    if (s_restantes < 10){
	    	var secondes = "0"+s_restantes;
	    }
	    else{
	    	var secondes = +s_restantes;
	    }
	 
		document.getElementById("jours").innerHTML = jours;
		document.getElementById("heures").innerHTML = heures;
		document.getElementById("minutes").innerHTML = minutes;
		document.getElementById("secondes").innerHTML = secondes;
		
		//==================COMPTEUR TERMINÉ AFFICHAGE LIEN ======
		
		jQuery(function ($){
			"use strict";
			$("#texte-compteur-cacher").hide();
			if ( tps_restant < 0){
				$("#visible").hide();
				$("#texte-compteur-cacher").show();
				clearInterval(intervalle);
			}
		});
	}
	
	var intervalle = setInterval(CompteARebours, 1000); // Rappel de la fonction toutes les secondes
	