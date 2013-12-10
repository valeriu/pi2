$(function(){ 
	/* Bind click sur les boutons */
	$('[name="connecter"], [name="enregistrer"], [name="motPasseOublie"]').bind('click', ouvrirDiv);
	
	function ouvrirDiv(e){
		var name = '#' + e.target.name + 'Div';
		var divs = ['#connecterDiv', '#enregistrerDiv', '#motPasseOublieDiv'];
		for(var i = 0; i < divs.length; i++){
			if(name != divs[i]){
				$(divs[i]).hide();
			}
			else{
				$(name).slideToggle();
			}
		}
	}
});
/* Ouverture des formulaires */
