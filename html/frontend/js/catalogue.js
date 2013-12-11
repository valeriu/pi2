//GESTION CATALOGUE jQuery POUR GERER LES CLIQUES DU TABLEAU
$(function() {

    var count=1;
    var large={width: "+=60px",height: "+=60px"};
    var small={width: "-=60px",height: "-=60px"};

    $("td:not([colspan=7])").click(function(event) {
        event.stopPropagation();
        var $target = $(event.target);

        //TOGGLE DETAILS IN CATALOG
            //TOGGLE IMAGE SIZE IN CATALOG
            (count==1)?$target.parent().find("img").animate(large, "slow", function() {
                $target.closest("tr").next().find("div.product-details").slideToggle("slow");}):$target.closest("tr").next().find("div.product-details").slideToggle("slow", function() {
                    $target.parent().find("img").animate(small, "slow")});
            count = 1-count;                   
    });
});