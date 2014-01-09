/* ==========================================================================
*   Projet d'int�gration II.
*	Prof.	: Jonathan Martel
*	Author	: Luis Felipe Rosas, Valeriu Tihai, Luc Cinq-Mars, Yan Boucher-Bouchard
   ========================================================================== */

$(function(){

    window.addEventListener('load', function()){
    	"use strict";
    	//
	    try{
	    	$('.ajouter').bind('click', function()){
	    		Catalogue.ajouterProduit(); // Module qui contient la fonction pour ajouter un produit dans le panier
	    	}
	    }catch(e){
	        $('#msgError').show(); // Affichage d'error
	    }
    }
});

var Catalogue = (function () {     /* ----- Module Pattern avec IIFE et Closure ----- */
/* Fonctionne qui g�re l'ajoute des produits au panier */
    var _ajouterProduit = function(){
        /* Ici on verfie l'existence de produits dans le web storage */
        if(localStorage.length != 0){
            var nbProduitsPanier = localStorage.length;
            $('#nbProducts').html(nbProduitsPanier);
        }else{
            var nbProduitsPanier = 0;
            $('#nbProducts').html('Vide');
        }
        /* D�sactivation de produits que sont d�j� au panier */
        for (var i = 0; i < localStorage.length; i++){
            var prodObject = JSON.parse(localStorage.getItem(localStorage.key(i)));
            $('#'+prodObject.idP).attr('disabled', 'disabled');
            $('#'+prodObject.idP).html('D�j� ajout�');
        }
        /* Evenement qui sera reconstruit � chaque fois que une page du catalogue est charg� */
        $('.ajouter').bind('click', function(){
            nbProduitsPanier++;
            $('#nbProducts').html(nbProduitsPanier);
            var produit    = new Object();
            produit.idP     = this.id;
            produit.nom    = $(this).siblings('.nom').html();
            produit.image  = $(this).siblings().children().attr('src');
            produit.descp  = $(this).siblings('.description').html();
            produit.quant  = 1;
            produit.prix   = $(this).siblings('.prix').children('.prix-valeur').html();
            /* D�sactivation du produit ajout� au panier */
            $(this).attr('disabled', 'disabled');
            $(this).html('D�j� ajout�');

            //window.localStorage.setItem(produit.idP, JSON.stringify(produit));
        });
    }/* / */

 return { // Return des m�thodes ou fonctions publiques
        ajouterProduit : _ajouterProduit
    }
}());

