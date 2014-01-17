//GESTION CATALOGUE jQuery POUR GERER LES CLIQUES DU TABLEAU
$(function() {

    var count=1;
    var large={width: "+=60px",height: "+=60px"};
    var small={width: "-=60px",height: "-=60px"};

    //CONTROLE DES PANNEAUX DE DESCRIPTIONS DE PRODUITS
    $("td.clickable:not([colspan=7])").click(function(event) {
        var $target = $(event.target);

            //TOUS LES PANNEAUX SONT CACHE
            if(count==1) {
                $target.parent().find("img").animate(large, "slow", function() {
                    $target.closest("tr").next().find("article.product-details").slideToggle("slow");
                    $target.closest("tr").next().find("article.product-details").toggleClass("visible-details");
                    $target.parent().find("img").toggleClass("large-image");
                    count = 2;
                });
            } else {
                //LE MEME PANNEAU OUVERT EST CLIQUE DE NOUVEAU
                if($target.closest("tr").next().find("article.product-details").hasClass("visible-details")) {
                    $("article.visible-details").slideToggle("slow", function() {
                        $("article.visible-details").toggleClass("visible-details");
                        $("img.large-image").animate(small, "slow", function() {
                            $("img.large-image").toggleClass("large-image");
                            count = 1;
                        });
                    });
                } else {
                    //UN PANNEAU DIFFERENT EST OUVERT
                    $("article.visible-details").slideToggle("slow", function() {
                        $("article.visible-details").toggleClass("visible-details");
                        $("img.large-image").animate(small, "slow", function() {
                            $("img.large-image").toggleClass("large-image");
                            $target.parent().find("img").animate(large, "slow", function() {
                                $target.closest("tr").next().find("article.product-details").slideToggle("slow");
                                $target.closest("tr").next().find("article.product-details").toggleClass("visible-details");
                                $target.parent().find("img").toggleClass("large-image");
                            });
                        });      
                    });
                }           
            }                
    });

    //AFFICHAGE DES OPTIONS DE FILTRES
    $("#btn-filtres").bind("click", function() {
        $("#panel-filtres").slideToggle("fast");
    });

    //SELECTIONS DES CATEGORIES
    $("input.categorieBox").bind("click", function() {
        var aBox   = document.querySelectorAll("input.categorieBox");
        var aRadio = document.querySelectorAll("input.filtreRadio");
        if(aRadio[0].checked) var tri = "specs";
        if(aRadio[1].checked) var tri = "tous";
        if(aRadio[2].checked) var tri = "prix";
        if(!tri) var tri = "tous";
        window.location.replace("./index.php?requete=produits&mode="+tri+"&1="+aBox[0].checked+"&2="+aBox[1].checked+"&3="+aBox[2].checked);
    });

    //SELECTION DU MODE DE TRI
    $("input.filtreRadio").bind("change", function() {
        var aBox = document.querySelectorAll("input.categorieBox");
        var tri  = this.value;
        window.location.replace("./index.php?requete=produits&mode="+tri+"&1="+aBox[0].checked+"&2="+aBox[1].checked+"&3="+aBox[2].checked);
    });
});