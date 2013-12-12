$(function(){

	window.addEventListener('load', function () {
        "use strict";
        // Déclaration de variables
        var targetClickUp, targetClickDown, targetClickRemove, targetClickShipping;
        // Récuperation de targets
        targetClickUp = document.querySelectorAll('button[class*="up"]');
        targetClickDown = document.querySelectorAll('button[class*="down"]');
        targetClickRemove = document.querySelectorAll('button[class*="remove"]');
        targetClickShipping = document.querySelectorAll('#optionsShipping input[type="radio"]');

        //console.log(targetLinkClick);
        for (var i = 0; i < targetClickUp.length; i++){
            targetClickUp[i].addEventListener('click', up.eTarget);
            targetClickDown[i].addEventListener('click', down.eTarget);
            targetClickRemove[i].addEventListener('click', remove.eTarget);
        }
        for (var i = 0; i < targetClickShipping.length; i++){
            targetClickShipping[i].addEventListener('click', shipping.valeurShipping);
        }
        $('#panierVide').hide();
    });

    var up = (function(){
        var val_cible, val_input;
        return {
            eTarget : function(e){
                e.preventDefault(); // Désactiver la configuration par défaut du navigaterur
                
                // On cherche l'input qu'indique la quantité
                val_cible = $(e.currentTarget).siblings();
                // On recupere la quantité additioné
            	var val_input = val_cible.val();
            	val_input++;
                // Réaffecter une nouvelle valeur de la quantité du même produit
            	val_cible.val(val_input);
                
                // Pour retrouver la valeur du prix du produit
                prix  = $(e.currentTarget).offsetParent().offsetParent().siblings().children().children('.prix');
                // On recupere le prix du produit
                val_prix = prix.html();
                
                // **************************
                shipping.totalShipping()

                // Total prix par produit
                total  = $(e.currentTarget).offsetParent().offsetParent().siblings().children().children('.total');
                total.html(val_prix*val_input);
                
                // Appelle de la fonction qui montre le total de produits au panier
                totalProduitsPanier.totalProduits();
                    
                // Appelle à la fonction qui montre le prix total du Panier
                totalPrixPanier.totalPrix();
            }
        };
    }());

    var down = (function(){
        var val_cible, val_input;
        return {
            eTarget : function(e){
                e.preventDefault(); // Désactiver la configuration par défaut du navigaterur

                // On cherche l'input qu'indique la quantité
                val_cible = $(e.currentTarget).siblings();
                // Condition un produit ne peux pas désendre moins que 1
                if(val_cible.val() > 1){
                    // On recupere la quantité resté
	            	val_input = val_cible.val();
	            	val_input--;
                    // Réaffecter une nouvelle valeur de la quantité du même produit
	            	val_cible.val(val_input);

                    // Pour retrouver la valeur du prix du produit
                    prix  = $(e.currentTarget).offsetParent().offsetParent().siblings().children().children('.prix');
                    // On recupere le prix du produit
                    val_prix = prix.html();

                    // **************************
                    shipping.totalShipping()

                    // Total prix par produit
                    total  = $(e.currentTarget).offsetParent().offsetParent().siblings().children().children('.total');
                    total.html(val_prix*val_input);

                    // Appelle de la fonction qui montre le total de produits au panier
                    totalProduitsPanier.totalProduits();

                    // Appelle à la fonction qui montre le prix total du Panier
                    totalPrixPanier.totalPrix();

	            }
            }
        };
    }());

    var remove = (function(){
        var val_cible, val_input;
        return {
            eTarget : function(e){
                e.preventDefault(); // Désactiver la configuration par défaut du navigaterur

                // Cibler le bon produit à éffacer
                val_cible = $(e.currentTarget).parents('.row');
                val_cible.remove();

                // Appelle de la fonction qui montre le total de produits au panier
                totalProduitsPanier.totalProduits();
                // Appelle à la fonction qui montre le prix total du Panier
                totalPrixPanier.totalPrix();
                
            }
        };
    }());

    var totalPrixPanier = (function (){
        var totalshipping, totalTaxes;

        return {
             //Total produits au Panier
            totalPrix : function(){
                //Total prix du Panier
                // Récuperation de chanque produit avec prix trouvé au Panier
                var totalCumulatif=0;
                $('.total').each(function(index, element){
                    var cumulatif = $(this).html();
                    totalCumulatif += cumulatif*1;
                });
                totalPrix     = $('#totalPrixPanier');
                totalTaxes    = $('#totalTaxes').html();
                console.log(totalTaxes);

                totalshipping = shipping.totalShipping();

                if(totalshipping == undefined || !totalTaxes){
                    totalshipping = 10;
                    totalTaxes = 54;
                    totalCumulatif += (totalshipping*1) + (totalTaxes*1);
                }else{
                    totalCumulatif += (totalshipping*1) + (totalTaxes*1);
                    //console.log(totalshipping+totalTaxes);
                }

                totalPrix.html(totalCumulatif);
            }
        }
    }());

    var totalProduitsPanier = (function (){
        
        return {
            totalProduits : function(){
                // Récuperation de chanque produit trouvé au Panier
                //Condition pour savoir s'il y a au minimum un produit dans le Panier

                var totalCumulatif=0;
                $( "input[name=quantite]:text").each(function(index, element){
                    var cumulatif = $(this).val();
                    totalCumulatif += cumulatif*1;
                });
                //console.log(totalCumulatif);

                if(totalCumulatif > 0){
                    totalProduits = $('#totalProduitsPanier');
                    totalProduits.html(totalCumulatif);
                    //shipping.valeurShipping(total);
                }else{
                    // Élimination du content Panier
                    $('#panier').remove();
                    $('#panierVide').show(); // Afficher un message de Alerte au utilisateur
                }
            }
        }
    }());

    var shipping = (function(){
        var total, priceShipping = 10;
        return {
            valeurShipping : function(e){
                var valS = $(e.currentTarget).val();
                //$( "input:radio[name=bar]:checked" ).val();
                // Total prix par produit
                //total  = $(e.currentTarget).offsetParent().offsetParent().siblings().children().children('.total');
                //total.html(val_prix*val_input);

                //optionShipping = $("input[name=choixLivraison]:text").val();

                total = $('#totalshipping');
                total.html(valS);

                priceShipping = parseInt(valS);

                // Appelle à la fonction qui montre le prix total du Panier
                totalPrixPanier.totalPrix();

                //console.log("1", priceShipping);

                return priceShipping;
            },

            totalShipping : function (){

                //console.log("2", priceShipping);

                return priceShipping;
            }
        };
    }());
});
