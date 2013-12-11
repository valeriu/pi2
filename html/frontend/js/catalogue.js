//GESTION CATALOGUE jQuery POUR GERER LES CLIQUES DU TABLEAU
$(function() {

    var count=1;
    var large={width: "+=60px",height: "+=60px"};
    var small={width: "-=60px",height: "-=60px"};

    $("td[colspan=7]").find("div.product-details").hide();

    $("td:not([colspan=7])").click(function(event) {
        event.stopPropagation();
        var $target = $(event.target);

        //TOGGLE DETAILS IN CATALOG
        if ( $target.closest("td").attr("colspan") > 1 ) {
            $target.slideUp();
        } else {
            //TOGGLE IMAGE SIZE IN CATALOG
            (count==1)?$target.parent().find("img").animate(large, "slow", function() {
                $target.closest("tr").next().find("div.product-details").slideToggle("slow");}):$target.closest("tr").next().find("div.product-details").slideToggle("slow", function() {
                    $target.parent().find("img").animate(small, "slow")});
            count = 1-count; 
        }                   
    });
});