$(document).ready(function() {

var nbProducts = Arg.get("nbP");
var viewMode   = Arg.get("mode");
//PAGE COURANTE 
var currentPage    = parseInt(Arg.get("page"));

//AFFICHAGES
if(nbProducts == 99) {
  //TOUS LES PRODUITS
  $('#product-container').append(myProducts);
} else {
  //CALCUL DU NOMBRE DE PAGES TOTAL
  var totalProduits = myProducts.length;
  var nbPages       = Math.ceil(totalProduits/nbProducts);

  //PAGINATION
  var root = 'catalog.php';
  if(currentPage > 1) {
    $('#pages-control').append('<li><a href="'+root+'?nbP='+nbProducts+'&amp;page='+(currentPage-1)+'&amp;mode='+viewMode+'">&#60;</a></li>');
  }
  for(i=0,c=nbPages; i<c; i++) {
    $('#pages-control').append('<li><a href="'+root+'?nbP='+nbProducts+'&amp;page='+(i+1)+'&amp;mode='+viewMode+'">'+(i+1)+'</a></li>');
  }
  if(currentPage < nbPages) {
    $('#pages-control').append('<li><a href="'+root+'?nbP='+nbProducts+'&amp;page='+(currentPage+1)+'&amp;mode='+viewMode+'">&#62;</a></li>');
  }

  //AFFICHAGE DE LA PAGE COURANTE
  var start = nbProducts*(currentPage-1);
  for(i=start,c=(nbProducts+start); i<c; i++) {
    $('#product-container').append(myProducts[i]);
  }
}
//MODE TABLEAU
if(viewMode == "grid") {
  $('.produit').addClass('grid');
}
});


