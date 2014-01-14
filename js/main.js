/* ==========================================================================
*   Projet d'intégration II.
*	Prof.	: Jonathan Martel
*	Author	: Luis Felipe Rosas, Valeriu Tihai, Luc Cinq-Mars, Yan Boucher-Bouchard
   ========================================================================== */

$(function(){
	try{
		$('#msgError').hide();
        Catalogue.demarre();  // fonction qui demarre module //
    }catch(e){
         $('#msgError').show(); // Affichage d'error
    }

    try{
    	$('.ajouter').bind('click', function(e){
            //event.preventDefault();
    		Catalogue.ajouterProduit(e);
    	});
    }catch(e){
    	$('#msgError').show(); // Affichage d'error
    }


    //Initialisation du logo anime
    $( document ).ready(function() {
        initLogo();
    }); 

});
/* ----- Module Pattern avec IIFE et Closure ----- */
var Catalogue = (function () {  // Module qui contient la fonction pour ajouter un produit dans le panier	
	var nbProduitsPanier = 0;
    var prodObject;
	var _demarre = function(){
		/* Ici on verfie l'existence de produits dans le web storage */
        if(localStorage.length != 0){
            nbProduitsPanier = localStorage.length;
            $('#nbProducts').html(nbProduitsPanier);
        }else{
            nbProduitsPanier = 0;
            $('#nbProducts').html('Vide');
        }
        //console.log("ICI",nbProduitsPanier);
        /* Désactivation de produits que sont déjà au panier */
        for (var i = 0; i < localStorage.length; i++){
            prodObject = JSON.parse(localStorage.getItem(localStorage.key(i)));
            $('#'+prodObject.idP).attr('disabled', 'disabled');
            $('#'+prodObject.idP).html('Déjà ajouté');
        }
	}
	/* Fonctionne qui gère l'ajoute des produits au panier */
    var _ajouterProduit = function(e){  
        /* Evenement qui sera reconstruit à chaque fois que une page du catalogue est chargé */
            for (var i = 0; i < localStorage.length; i++){
                prodObject = JSON.parse(localStorage.getItem(localStorage.key(i)));
                $('#'+prodObject.idP).attr('disabled', 'disabled');
                $('#'+prodObject.idP).html('Déjà ajouté');
            }
            var idElement = e.target.id;
            nbProduitsPanier++;
            $('#nbProducts').html(nbProduitsPanier);
            var produit    = new Object();
            produit.idP     = idElement;
            produit.nom    = $('#'+idElement).parent().siblings('.nom').children().html();
            produit.image  = $('#'+idElement).parent().siblings('.img').children().attr('src');
            produit.quant  = 1;
            produit.prix   = $('#'+idElement).parent().siblings('.text-pricing').children().children('.prix-valeur').html();
            window.localStorage.setItem(produit.idP, JSON.stringify(produit));
            /* Désactivation du produit ajouté au panier */
            $('#'+idElement).attr('disabled', 'disabled');
            $('#'+idElement).html('Déjà ajouté');
    }

 return { // Return des méthodes ou fonctions publiques
 		demarre : _demarre,
        ajouterProduit : _ajouterProduit
    }
}());

