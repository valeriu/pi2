/* ==========================================================================
*   Projet d'Intégration 2 AEC Commerce Électronique 
*   Author  : Luis Felipe Rosas
   ========================================================================== */
/***********************************************
        Testé en FIREFOX et  Google Chrome
    *******************************/
var Panier = (function () {
    var _creerPanier = function(){
        var htmlProduits = '';
        /* Condition d'existence de produits dans le web storage */
        if(localStorage.length > 0){
            $('#panierVide').hide(); // Panier avec contenu, display none pour le message Vide
            $('#panierConfirmation').hide(); // Panier avec contenu, display none pour le message Vide
            $('#champsVides').hide();
            for (var i = 0; i < localStorage.length; i++){
                var produit = JSON.parse(localStorage.getItem(localStorage.key(i))); // HTML géneré pour chaque produit créé!
                // Récuperation de la quantité de produits stockés et le valeur de prix total par produit
                htmlProduits += '<article id="'+produit.idP+'" class="row">\n\
                            <div class="col-sm-12">\n\
                                <div class="col-sm-2">\n\
                                    <a href="#" class="thumbnail">\n\
                                        <img class="img-responsive" src="'+produit.image+'" alt="'+produit.nom+'">\n\
                                    </a>\n\
                                </div>\n\
                                <div class="col-sm-4">\n\
                                    <p>'+produit.nom+'</p>\n\
                                </div>\n\
                                <div class="col-sm-2">\n\
                                    <p><span class="prix">'+produit.prix+'</span><span> $CAD</span></p>\n\
                                </div>\n\
                                <div class="col-sm-1">\n\
                                    <p>\n\
                                        <input type="text" value='+produit.quant+' class="pPanier" name="quantite" size="1">\n\
                                        <button type="button" class="btn btn-default btn-xs up">\n\
                                            <span class="glyphicon glyphicon-chevron-up"></span>\n\
                                        </button>\n\
                                        <button type="button" class="btn btn-default btn-xs down">\n\
                                            <span class="glyphicon glyphicon-chevron-down"></span>\n\
                                        </button>\n\
                                    </p>\n\
                                </div>\n\
                                <div class="col-sm-1 text-center">\n\
                                    <br>\n\
                                    <button type="button" class="btn btn-default btn-xs remove">\n\
                                        <span class="glyphicon glyphicon-remove"></span>\n\
                                    </button>\n\
                                </div>\n\
                                <div class="col-sm-2 text-center">\n\
                                    <p><span class="total">'+(produit.prix*produit.quant).toFixed(2)+'</span><span> $CAD</span></p>\n\
                                </div>\n\
                            </div>\n\
                        </article>';

            }
            $('#produits').html(htmlProduits);

            _totalProduitsPanier();
            _totalPrix();

        }else{
            $('#panier').remove();
            $('#panierVide').show(); // Afficher un message de Panier Vide au utilisateur
        }
    }
    //Total produits au Panier 
    var _totalProduitsPanier = function(){
        // Récuperation de chanque produit trouvé au Panier
        var totalCumulatif=0;
        $( "input[name=quantite]:text").each(function(index, element){
            var cumulatif = $(this).val();
            totalCumulatif += cumulatif*1;
        });
        //Condition pour savoir s'il y a au minimum un produit dans le Panier
        if(totalCumulatif > 0){
            totalProduits = $('#totalProduitsPanier');
            totalProduits.html(totalCumulatif.toFixed(0));
        }else{
            // Élimination du content Panier
            $('#panier').remove();
            $('#panierVide').show(); // Afficher un message de Alerte au utilisateur
        }
    }
    //Total prix du Panier
    var _totalPrix = function(){
        // Récuperation de chanque produit avec prix trouvé au Panier
        var totalCumulatif=0;
        $('.total').each(function(index, element){
            var cumulatif = $(this).html();
            totalCumulatif += cumulatif*1;
        });
        var totalPrixP     = $('#totalPrixPanier');
        totalPrixP.html(totalCumulatif.toFixed(2));

    }

    // Fonction qui enregistre la commande dans la base de données
    var _passerCommande =  function(){
        try{
            console.log('PASSER LA COMMANDE');
            var adresse = $("input[name='courriel']").val();
            var valEmail = $("input[name='courriel']").val();
            var adresse = $("input[name*='adresse']").val();

            if(valEmail != "" && adresse != ""){ // Vérification de Champs
                var produit = new Object();
                for (var i = 0; i < localStorage.length; i++){
                    produit[i] = JSON.parse(localStorage.getItem(localStorage.key(i)));
                }
                console.log(valEmail,adresse);
                // Source : http://stackoverflow.com/questions/9001526/send-array-with-ajax-to-php-script
                var jsonString = JSON.stringify(produit);
                $.ajax({
                    type: "POST",
                    url: "ajaxControler.php?requete=etapeUn",
                    data: {
                        quantite : localStorage.length,
                        email : valEmail,
                        data : jsonString
                    },
                    cache: false,
                    success: function(info){
                        if(info == 1){ // Vérification de la réponse AJAX TRUE
                            $('#myModal').modal({backdrop:false});
                            $('#myModal').modal('hide');
                            $('#panier').remove();
                            $('#panierConfirmation').show();
                            localStorage.clear();
                        }else{
                            $('#myModal').modal('hide');
                            $('#panier').remove();
                            $('#pasEnregistre').show();

                        }
                    },
                    error: function(error){
                        console.log("Error:", error);
                        $('#msgError').show();
                    }
                });
            }else{
              $('#champsVides').show();
            }
        }catch(e){
            $('#msgError').show(); // Affichage d'error
        }
    }

    return {
        creerPanier : _creerPanier,
        totalProduitsPanier : _totalProduitsPanier,
        totalPrix : _totalPrix,
        passerCommande : _passerCommande
    };

}());

$(function(){

    //window.addEventListener('load', function () {
        "use strict";
        // Déclaration de variables
        var targetClickUp, targetClickDown, targetClickRemove;
        // Récuperation de targets
        targetClickUp = document.querySelectorAll('button[class*="up"]');
        targetClickDown = document.querySelectorAll('button[class*="down"]');
        targetClickRemove = document.querySelectorAll('button[class*="remove"]');
        
        for (var i = 0; i < targetClickUp.length; i++){
            targetClickUp[i].addEventListener('click', up.eTarget);
            targetClickDown[i].addEventListener('click', down.eTarget);
            targetClickRemove[i].addEventListener('click', remove.eTarget);
        }
    //});

    $('#panierConfirmation').hide();

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
                
                // Total prix par produit
                total  = $(e.currentTarget).offsetParent().offsetParent().siblings().children().children('.total');
                var val = (val_prix*val_input).toFixed(2);
                total.html(val);

                // ------------------------
                // Reformater l'information du produit stocké dans le WebStorage (quantité et prix)
                // ------------------------
                var val_cible_id = $(e.currentTarget).parents('.row');
                var idP = val_cible_id.attr('id');
                var produit = new Object();
                produit = JSON.parse(localStorage.getItem(idP));
                produit.quant = val_input;
                window.localStorage.setItem(produit.idP, JSON.stringify(produit));
                
                // Appelle de la fonction qui montre le total de produits au panier
                Panier.totalProduitsPanier();
                    
                // Appelle à la fonction qui montre le prix total du Panier
                Panier.totalPrix();
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

                    // Total prix par produit
                    total  = $(e.currentTarget).offsetParent().offsetParent().siblings().children().children('.total');
                    var val = (val_prix*val_input).toFixed(2);
                    total.html(val);

                    // ------------------------
                    // Reformater l'information du produit stocké dans le WebStorage (quantité et prix)
                    // ------------------------
                    var val_cible_id = $(e.currentTarget).parents('.row');
                    var idP = val_cible_id.attr('id');
                    var produit = new Object();
                    produit = JSON.parse(localStorage.getItem(idP));
                    produit.quant = val_input;
                    window.localStorage.setItem(produit.idP, JSON.stringify(produit));

                    // Appelle de la fonction qui montre le total de produits au panier
                    Panier.totalProduitsPanier();

                    // Appelle à la fonction qui montre le prix total du Panier
                    Panier.totalPrix();
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
                var idP = val_cible.attr('id');
                /* ICI j'efface aussi le produit du webStorage*/
                localStorage.removeItem(idP);
                // Effacé de l'article (produit) html
                val_cible.remove();

                // Appelle de la fonction qui montre le total de produits au panier
                Panier.totalProduitsPanier();
                // Appelle à la fonction qui montre le prix total du Panier
                Panier.totalPrix();
                
            }
        };
    }());

});
/*
$(function(){
    $('#etape2').on('click', function(){
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "ajaxControler.php?requete=formConnecter", true);   
        xhr.onreadystatechange = function() {
            if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
                //clearTimeout(timeout);
                //console.log(xhr.responseText);
                $('.modal-content').html(xhr.responseText);
                $('#myModal').modal('show');
            }
        };
        xhr.send();
        
    });
});*/