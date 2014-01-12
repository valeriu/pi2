$(function(){ 
	/* Bind click sur les boutons 
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
	}*/

	$('#formEnregistrer').on('click', function(){
		//console.log('ICI');
		var xhr = new XMLHttpRequest();
		xhr.open("GET", "ajaxControler.php?requete=formEnregistrer", true);	
		xhr.onreadystatechange = function() {
			if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
				/*clearTimeout(timeout);*/
				console.log(xhr.responseText);
				$('.modal-content').html(xhr.responseText);
				$('#myModal').modal('show');
			}
		};
		xhr.send();
	});

	$('#formConnecter').on('click', function(){
		var xhr = new XMLHttpRequest();
		xhr.open("GET", "ajaxControler.php?requete=formConnecter", true);	
		xhr.onreadystatechange = function() {
			if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
				/*clearTimeout(timeout);*/
				//console.log(xhr.responseText);
				$('.modal-content').html(xhr.responseText);
				$('#myModal').modal('show');
			}
		};
		xhr.send();
		
	});

});
