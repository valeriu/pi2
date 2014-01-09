/* ==========================================================================
*   Projet d'intégration II.
*	Prof.	: Jonathan Martel
*	Author	: Luis Felipe Rosas, Valeriu Tihai, Luc Cinq-Mars, Yan Boucher-Bouchard
   ========================================================================== */

$(function(){
	try{
		$('#msgError').hide();
        Catalogue.demarre();  /* fonction qui demarre module */ // Module qui contient la fonction pour ajouter un produit dans le panier
    }catch(e){
       
    }
    try{
    	$('.ajouter').bind('click', function(e){
    		Catalogue.ajouterProduit(e);
    	});
    }catch(e){
        console.log('ERROR');
    	 $('#msgError').show(); // Affichage d'error
    }    

});

var Catalogue = (function () {     /* ----- Module Pattern avec IIFE et Closure ----- */
	
	var nbProduitsPanier = 0;

	var _demarre = function(){
		/* Ici on verfie l'existence de produits dans le web storage */
        if(localStorage.length != 0){
            nbProduitsPanier = localStorage.length;
            $('#nbProducts').html(nbProduitsPanier);
            console.log('ICI');
        }else{
            nbProduitsPanier = 0;
            $('#nbProducts').html('Vide');
        }
        //console.log("ICI",nbProduitsPanier);
        /* Désactivation de produits que sont déjà au panier */
        for (var i = 0; i < localStorage.length; i++){
            var prodObject = JSON.parse(localStorage.getItem(localStorage.key(i)));
            $('#'+prodObject.idP).attr('disabled', 'disabled');
            $('#'+prodObject.idP).html('Déjà ajouté');
        }
	}
	/* Fonctionne qui gère l'ajoute des produits au panier */
    var _ajouterProduit = function(e){  
        /* Evenement qui sera reconstruit à chaque fois que une page du catalogue est chargé */
            for (var i = 0; i < localStorage.length; i++){
                var prodObject = JSON.parse(localStorage.getItem(localStorage.key(i)));
                $('#'+prodObject.idP).attr('disabled', 'disabled');
                $('#'+prodObject.idP).html('Déjà ajouté');
            }

            var idElement = e.target.id;

            console.log(idElement);

            nbProduitsPanier++;
            $('#nbProducts').html(nbProduitsPanier);
            var produit    = new Object();
            produit.idP     = idElement;
            produit.nom    = $(idElement).siblings('.nom').html();
            produit.image  = $(idElement).siblings().children().attr('src');
            produit.descp  = $(idElement).siblings('.description').html();
            produit.quant  = 1;
            produit.prix   = $(idElement).siblings('.prix').children('.prix-valeur').html();
            /* Désactivation du produit ajouté au panier */
            $(idElement).attr('disabled', 'disabled');
            $(idElement).html('Déjà ajouté');

            window.localStorage.setItem(produit.idP, JSON.stringify(produit));
        
        console.log(nbProduitsPanier);
    }/* / */

 return { // Return des méthodes ou fonctions publiques
 		demarre : _demarre,
        ajouterProduit : _ajouterProduit
    }
}());

