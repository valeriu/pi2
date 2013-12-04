$(function(){ 
	/* Bind click sur les boutons */
	$('[name="connecter"], [name="enregistrer"], [name="motPasseOublie"]').bind('click', ouvrirDiv);
	/* Cacher tous les formulaires */
	$('#connecterDiv').hide();
	$('#enregistrerDiv').hide();
	$('#motPasseOublieDiv').hide();
	
	/* Bind click sur le bouton CONNEXION du formulaire de connexion */
	$('[name="connexion"]').bind('click',function(){
			$('[name="form-usager-connecter"]').slideToggle();
			$('#infosConnecter').slideToggle();
		});
	
	/* Bind click sur le bouton CONFIRMER du formulaire d'enregistrement */
	$('[name="confirmer"]').bind('click',function(){
			$('[name="form-usager-enregistrer"]').slideToggle();
			$('#infosEnregistrer').slideToggle();
		});
		
	/* Bind click sur le lien MOT DE PASSE OUBLIE */
	$('[name="envoyer"]').bind('click',function(){
			$('[name="form-usager-oublie"]').slideToggle();
			$('#courrielEnvoye').slideToggle();
		});	
	
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
