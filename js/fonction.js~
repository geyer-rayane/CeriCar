/* Variable globale */
let escale = 0;

/* Si on appuie sur la checkbox on inverse la valeur de la variable globale 1=> appuyé 0 sinon*/
function checkBoxModif() 
{
    // Inversion de la valeur de la variable globale escale
    escale = escale === 1 ? 0 : 1;
}

/* Si on change la vue il est possible que la checkbox soit cochée et donc la variable globale est à 1, or si on revient sur le formulaire elle est décochée donc doit etre à 0.
On appel donc la méthode checkBoxRestaure a chaque changement de vue pour reinitialiser sa valeur */
function checkBoxRestaure()
{
	escale = 0 ;
}


function voyageScript() {
    var departValue = $("#depart").val();
    var arriveeValue = $("#arrivee").val();
	var nbrePlacesValue = $("#nbrePlaces").val();
    var messageSortie = "";

    if (departValue && arriveeValue) {
        // Cas sans escale (escale === 0)
        if (escale === 0) {
            $.ajax({
                url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
                method: "POST",
                data: {
                    action: "resultatVoyageSansEscale",
                    depart: departValue,
                    arrivee: arriveeValue,
		    nbrePlaces : nbrePlacesValue
                },
                success: function(response) {
                    if (response === "Pas de voyage") {
                        $("#affichageBandeau").text("Recherche terminee, pas de resultat.");
                        $("#affichageVoyage").text("Pas de trajet correspondant");

                    } else {
                        $("#affichageVoyage").html(response);
                        $("#affichageBandeau").text("Recherche terminee");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(status + ": " + error);
                }
            });
        }
        // Cas avec escale (escale === 1)
        else{
            $.ajax({
                url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
                method: "POST",
                data: {
                    action: "resultatVoyageAvecEscale",
                    depart: departValue,
                    arrivee: arriveeValue,
					nbrePlaces : nbrePlacesValue
                },
                success: function(response) {
                    if (response === "Pas de voyage d'après votre recherche") {
                        $("#affichageBandeau").html(response);
                        messageSortie = "Recherche terminee, pas de resultat.";
                        $("#affichageBandeau").text(messageSortie);
                        $("#affichageAccueil").empty();
                        $("#affichageVoyage").empty();
                    } else {
                        $("#affichageVoyage").empty();
                        $("#affichageVoyage").html(response);
                        messageSortie = "Recherche terminee.";
                        $("#affichageBandeau").text(messageSortie);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(status + ": " + error);
                }
            });
        }
    } else {
        $("#affichageVoyage").empty();
        messageSortie = "Depart ou arrivee non renseigne(e)";
        $("#affichageBandeau").text(messageSortie);
    }
}


	
	
/* Même fonction que précédemment mais utiliser pour rafraîchir lors de l'appuie sur bouton réservation => modification du message (seul changement)) */

function voyageScriptApresReservation() {
    var departValue = $("#depart").val();
    var arriveeValue = $("#arrivee").val();
	var nbrePlacesValue = $("#nbrePlaces").val();
    var messageSortie = "";

    if (departValue && arriveeValue) {
        // Cas sans escale (escale === 0)
        if (escale === 0) {
            $.ajax({
                url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
                method: "POST",
                data: {
                    action: "resultatVoyageSansEscale",
                    depart: departValue,
                    arrivee: arriveeValue,
		    nbrePlaces : nbrePlacesValue
                },
                success: function(response) {
                    if (response === "Pas de voyage") {
                        $("#affichageBandeau").text("Recherche terminee, pas de resultat.");
                        $("#affichageVoyage").text("Pas de trajet correspondant");

                    } else {
                        $("#affichageVoyage").html(response);
                        $("#affichageBandeau").text("Reservation effectuee. Consultez vos reservations sur votre profil.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(status + ": " + error);
                }
            });
        }
        // Cas avec escale (escale === 1)
        else{
            $.ajax({
                url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
                method: "POST",
                data: {
                    action: "resultatVoyageAvecEscale",
                    depart: departValue,
                    arrivee: arriveeValue,
					nbrePlaces : nbrePlacesValue
                },
                success: function(response) {
                    if (response === "Pas de voyage d'après votre recherche") {
                        $("#affichageBandeau").html(response);
                        messageSortie = "Recherche terminee, pas de resultat.";
                        $("#affichageBandeau").text(messageSortie);
                        $("#affichageAccueil").empty();
                        $("#affichageVoyage").empty();
                    } else {
                        $("#affichageVoyage").empty();
                        $("#affichageVoyage").html(response);
                        messageSortie = "Recherche terminee.";
                        $("#affichageBandeau").text(messageSortie);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(status + ": " + error);
                }
            });
        }
    } else {
        $("#affichageVoyage").empty();
        messageSortie = "Depart ou arrivee non renseigne(e)";
        $("#affichageBandeau").text(messageSortie);
    }
}

/* Affichage dans la bonne div du formulaire d'inscription et vider les autres */
function retourIncription() {
        $.ajax({
            url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
            method: "GET",
            data: {
                action: "inscription",
            },
            success: function(response) { 
		$("#affichageBandeau").text("Creez un compte pour profiter de toutes les fonctionnalitees"); 
		$("#affichageVoyage").empty();	
		$("#affichageFormulaire").empty();         
		$("#affichageAccueil").empty() ;
		$("#affichageFormulaire").html(response)	;	
		$("#affichagePropositionVoyage").empty();  

		checkBoxRestaure();
            },
            error: function(xhr, status, error) {
                console.error(status + ": " + error);
            }
        });
}


/* Affichage dans la bonne div du formulaire de connexion et vider les autres */

function retourConnexion() {
        $.ajax({
            url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
            method: "GET",
            data: {
                action: "connexion",
            },
            success: function(response) { 
		$("#affichageBandeau").text("Ravi de vous revoir, connectez-vous sans plus attendre !"); 
		$("#affichageVoyage").empty();	
		$("#affichageFormulaire").empty();         
        	$("#affichageFormulaire").html(response);
		$("#affichageAccueil").empty() ;
		$("#affichageFormulaireInscription").empty() ;
		$("#affichagePropositionVoyage").empty();  

		checkBoxRestaure();	
            },
            error: function(xhr, status, error) {
                console.error(status + ": " + error);
            }
        });
}

/* Affichage dans la bonne div de l'accueil et vider les autres */

function retourAccueil() {
    $.ajax({
        url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
        method: "GET",
        data: {
            action: "retourAccueil",
        },
		
        success: function(response) {
            $("#affichageBandeau").empty();
			$("#affichageProfil").empty();
            $("#affichageAccueil").html(response);
            $("#affichageVoyage").empty();
            $("#affichageFormulaire").empty();
            $("#affichageFormulaireInscription").empty();
			$("#affichagePropositionVoyage").empty();  

			checkBoxRestaure();
        }
    });
}

/* Affichage dans la bonne div du formulaire de recherche et vider les autres */
function retourRecherche() {
    $.ajax({
        url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
        method: "GET",
        data: {
            action: "afficherFormulaireRecherche"
        },
        success: function(response) {
            $("#affichageBandeau").html("Ou voyagerez-vous aujourd'hui ?");
            $("#affichageFormulaire").html(response);
			checkBoxRestaure();
            $("#affichageVoyage").empty();            
			$("#affichageProfil").empty();
			$("#affichageAccueil").empty();	
			$("#affichageFormulaireInscription").empty() ;	
			$("#affichagePropositionVoyage").empty();  
			
        },
        error: function(xhr, status, error) {
            console.error(status + ": " + error);
        }
    });
}


/* Affichage dans la bonne div du profil et vider les autres */
function retourProfil()
{ 
    $.ajax({
        url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
        method: "GET",
        data: {
            action: "afficherProfil"
        },
        success: function(response) {
            $("#affichageBandeau").empty() ;
            $("#affichageVoyage").empty();
            $("#affichageFormulaire").empty() ;
			$("#affichageFormulaireInscription").empty() ;
			$("#affichageAccueil").empty();	
			$("#affichageFormulaireInscription").empty() ;	
			$("#affichageProfil").html(response);
			$("#affichagePropositionVoyage").empty();  

			checkBoxRestaure();
        },
        error: function(xhr, status, error) {
            console.error(status + ": " + error);
        }
    });
}


/* Fonction gérant la déconnexion */
function deconnexion() {  
    $.ajax({
        url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
        method: "GET",
        data: {
            action: "deconnexion",            
        },
        success: function(response) {
            retourAccueil();
	$("#affichageHeader").html(response);
	checkBoxRestaure();
			
        },
        error: function(xhr, status, error) {
            console.error(status + ": " + error);
        }
    });
}

/* Fonction gérant la connexion */
function tentativeConnexion() {    
    var identifiantValue = $("#identifiant").val();
    var mdpValue = $("#mdp").val();
    var messageSortie = "";

    if (identifiantValue && mdpValue) {
        $.ajax({
            url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
            method: "POST",
            data: {
                action: "resultatConnexion",
				identifiant: identifiantValue,
                mdp: mdpValue
            },
            success: function(response) {
			if (response.includes("compte"))			
			{
			$("#affichageBandeau").text("Identifiant ou mot de passe incorrecte"); 
               } 
			else 
			{
				$("#affichageHeader").html(response); 
				retourRecherche() ;
            }
            },
            error: function(xhr, status, error) {
                console.error(status + ": " + error);
            }
        });
    }
}


/* Fonction gérant l'inscription */
function tentativeInscription() {    
    var identifiantValue = $("#identifiantInscription").val();
    var mdpValue = $("#mdpInscription").val();
    var nomValue = $("#nomInscription").val();
    var prenomValue = $("#prenomInscription").val();
    var avatarValue = $("#avatarInscription").val();

    if (identifiantValue && mdpValue && nomValue && prenomValue) {
        $.ajax({
            url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
            method: "POST",
            data: {
                action: "resultatInscription",
				identifiantInscription: identifiantValue,
                mdpInscription: mdpValue,
                nomInscription: nomValue,
                prenomInscription: prenomValue,
                avatarInscription: avatarValue
            },
            success: function(response) {
                if (response === 'Utilisateur deja existant') 
				{
					$("#affichageBandeau").text("Inscription impossible : nom d'utilisateur deja utilise"); 
                } 
				else 
				{	
					$("#affichageHeader").html(response);				
					$("#affichageBandeau").text("Felicitations vous etes inscrit !");
                }
            },
            error: function(xhr, status, error) {
                console.error(status + ": " + error);
            }
        });
    }
	
	else
	{
		$("#affichageBandeau").text("Veuillez remplir toutes les informations"); 
	}
	
	
}


/* Fonction gérant la réservation d'un voyage */
function tentativeReservation(idVoyage) {
	    var nbrePlacesValue = $("#nbrePlaces").val();

    $.ajax({
        url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
        method: "POST",
        data: {
            action: "resultatReservation",
            idVoyage: idVoyage,
			nbrePlaces : nbrePlacesValue 
        },
        success: function(response) 
	{
				voyageScriptApresReservation() ;
				
        },
        error: function(xhr, status, error) {
            console.error(status + ": " + error);
        }
    });
}


/* Fonction gérant la réservation d'un ensemble de voyage en utilisant la fonction tentativeReservation */
function tentativeReservationMultiple(listeIdVoyage) {
    var nbrePlacesValue = $("#nbrePlaces").val();

    listeIdVoyage.forEach(function(idVoyage) {
        $.ajax({
            url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
            method: "POST",
            data: {
                action: "resultatReservation",
                idVoyage: idVoyage,
                nbrePlaces: nbrePlacesValue 
            },
            success: function(response) {
				voyageScriptApresReservation() ;
            },
            error: function(xhr, status, error) {
                console.error(status + ": " + error);
            }
        });
    });
}





/* Affichage du formulaire de proposition de voyage. Accessible uniquement si l'utilisateur est connecté. Vide les div inutiles.*/
function retourPropositionVoyage() {
        $.ajax({
            url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
            method: "GET",
            data: {
                action: "propositionVoyage",
            },
            success: function(response) { 
		$("#affichageBandeau").text("Proposez un voyage et coivoiturez en tant que conducteur"); 
		$("#affichageVoyage").empty();	
		$("#affichageFormulaire").empty();  
		$("#affichageFormulaire").html(response);  
		$("#affichageAccueil").empty() ;
		$("#affichageFormulaireInscription").empty() ;
		$("#affichageVoyage").empty();            
		$("#affichageProfil").empty();
		$("#affichageAccueil").empty();	
		$("#affichageFormulaireInscription").empty() ;	
		checkBoxRestaure();	
            },
            error: function(xhr, status, error) {
                console.error(status + ": " + error);
            }
        });
}


/* Fonction gerant la proposition de voyage via le formulaire */
function tentativePropositionVoyage() {    
    var departVoyageValue = $("#departVoyage").val();
    var arriveeVoyageValue = $("#arriveeVoyage").val();
    var heureDepartValue = $("#heureDepartVoyage").val();
    var tarifVoyageValue = $("#tarifVoyage").val();
    var nbrPlacesVoyageValue = $("#nbrPlacesVoyage").val();
    var contrainteVoyageValue = $("#contrainteVoyage").val();

    if (departVoyageValue && arriveeVoyageValue && heureDepartValue && tarifVoyageValue && nbrPlacesVoyageValue && contrainteVoyageValue) {

        // Vérification du nombre de places
        if (nbrPlacesVoyageValue > 5) {
            $("#affichageBandeau").text("Le nombre de places ne doit pas depasser 5");
            return;
        }

	// Vérification de l'heure de départ
        if (heureDepartValue > 23 || heureDepartValue < 0  ) {
            $("#affichageBandeau").text("L'heure de depart doit etre comprise entre 0 et 23");
            return;
        }

        // Vérification du tarif et de l'heure de départ
        if ((tarifVoyageValue > 150 && (heureDepartValue < 0 || heureDepartValue > 23 || !Number.isInteger(parseInt(heureDepartValue)))) ||
            (tarifVoyageValue > 99 && heureDepartValue < 0 || heureDepartValue > 23 || !Number.isInteger(parseInt(heureDepartValue)))) {
            $("#affichageBandeau").text("Le tarif ne doit pas depasser 150 et l'heure de depart doit etre un entier entre 0 et 23 inclus");
            return;
        }

	// Vérification du tarif
        if (tarifVoyageValue > 99) {
            $("#affichageBandeau").text("Le tarif ne doit pas depasser 99");
            return;
        }

        // Si toutes les conditions sont remplies, envoi de la requête AJAX
        $.ajax({
            url: "https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/monApplicationAjax.php",
            method: "POST",
            data: {
                action: "resultatProposition",
                departVoyage: departVoyageValue, 
                arriveeVoyage: arriveeVoyageValue, 
                heureDepartVoyage: heureDepartValue, 
                tarifVoyage: tarifVoyageValue, 
                nbrPlacesVoyage: nbrPlacesVoyageValue, 
                contrainteVoyage: contrainteVoyageValue 
            },
            success: function(response) {
                if (response === 'Trajet inexistant') {
                    $("#affichageBandeau").text("Le trajet n'existe pas");
                } else {
                    $("#affichageBandeau").text("Votre voyage est en ligne");
                }
            },
            error: function(xhr, status, error) {
                console.error(status + ": " + error);
            }
        });
    } else {
        $("#affichageBandeau").text("Veuillez remplir toutes les informations");
    }
}


