$(function(){

	window.addEventListener('load', function () {
        "use strict";
        var targetClickUp, targetClickDown, targetClickRemove;
        targetClickUp = document.querySelectorAll('button[class*="up"]');
        targetClickDown = document.querySelectorAll('button[class*="down"]');
        targetClickRemove = document.querySelectorAll('button[class*="remove"]');
        //console.log(targetLinkClick);
        for (var i = 0; i < targetClickUp.length; i++){
            targetClickUp[i].addEventListener('click', up.eTarget);
        }
        for (var i = 0; i < targetClickDown.length; i++){
            targetClickDown[i].addEventListener('click', down.eTarget);
        }
        for (var i = 0; i < targetClickRemove.length; i++){
            targetClickRemove[i].addEventListener('click', remove.eTarget);
        }
    });

    var up = (function(){
        var val_cible, val_input;
        var valeur = 1, val_input_final;
        return {
            eTarget : function(e){
            	valeur++;
                e.preventDefault();
                val_cible = $(e.currentTarget).siblings();
            	var val_input = val_cible.val();
            	val_input++;
            	val_cible.val(val_input);
            }
        };
    }());

    var down = (function(){
        var val_cible, val_input;
        var valeur = 1, val_input_final;
        return {
            eTarget : function(e){
            	valeur--;
                e.preventDefault();
                val_cible = $(e.currentTarget).siblings();
                if(val_cible.val() > 1){
	            	var val_input = val_cible.val();
	            	val_input--;
	            	val_cible.val(val_input);
	            }
            }
        };
    }());

    var remove = (function(){
        var val_cible, val_input;
        var valeur = 1, val_input_final;
        return {
            eTarget : function(e){
            	valeur--;
                e.preventDefault();
                val_cible = $(e.currentTarget).parents('.row');
                val_cible.remove();

                //console.log(val_cible);
                
                /*if(val_cible.val() > 1){
	            	var val_input = val_cible.val();
	            	val_input--;
	            	val_cible.val(val_input);
	            }*/
            }
        };
    }());

	/*$('.up').bind('click', function(){

		bouton = $('.pPanier').parents('#1');
		//bouton++;
		//$('.pPanier').val(bouton);
		console.log(bouton);
	});
	$('.down').bind('click', function(){
		bouton = $('.pPanier').val();
		if(bouton>1){
			bouton--;
			$('.pPanier').val(bouton);
		}
		console.log(bouton);
	});*/
});
