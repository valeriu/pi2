$(function(){ 
	/* Bind click sur les boutons */
	$('[name="connecter"], [name="enregistrer"], [name="motPasseOublie"]').bind('click', ouvrirDiv);
	/* Cacher tous les formulaires */
	$('#connecterDiv').hide();
	$('#enregistrerDiv').hide();
	$('#motPasseOublieDiv').hide();
	//$('.form-signin').hide();
	
	function ouvrirDiv(e){
		//console.log(e.target.name);
		var name = '#' + e.target.name + 'Div';
		//console.log(name);
		$('#connecterDiv').hide();
		$('#enregistrerDiv').hide();
		$('#motPasseOublieDiv').hide();
		$(name).slideToggle();
	}
});
/* Ouverture des formulaires */
