/*
 * FUNCAO PARA CRIAR FORMULARIO DE ENVIO DE CONTATO AJAX
 */
$(function(){
	
	if($('#frmRecuperarSenha').length != 0 || $('#frmLogar').length != 0){
	  	yepnope([{
		  load: [ pathSite+"/js/bower_components/jQuery-Validation-Engine/js/jquery.validationEngine.js", pathSite+"/js/bower_components/jQuery-Validation-Engine/js/languages/jquery.validationEngine-pt_BR.js", pathSite+"/js/bower_components/jQuery-Validation-Engine/css/validationEngine.jquery.css" ],
		  complete: function () {
			  	
			  	if($('#frmRecuperarSenha').length != 0){
			  		$("#frmRecuperarSenha").validationEngine({
			  			onValidationComplete: function(form, status){
			  				if (status == true) {
			  					mostraMensagem("Aguarde...",null,'info');
			  					$.ajax({
			  						url: pathSite + '/default/auth/recuperar',
			  						dataType: 'json',
			  						type: 'POST',
			  						data: $('#frmRecuperarSenha').serialize(),
			  						success: function(obj){
			  							if(obj.situacao=="sucess"){
			  								mostraMensagem(obj.msg,3,'success');
			  								$("#frmRecuperarSenha").each(function(){
			  									this.reset(); 
			  								});
			  							} else if(obj.situacao=="error"){
			  								mostraMensagem(obj.msg,null,'error');
			  							}
			  						},
			  						error : function (XMLHttpRequest, textStatus, errorThrown) {
			  							
			  						},
			  						
			  						beforeSend : function(requisicao){
			  						  mostraMensagem("Aguarde...",1,'info');
			  						}
			  					});
			  				}
			  			}
			  		
			  		});
			  	}
			  	
			  	if($('#frmLogar').length != 0){
			  		$("#frmLogar").validationEngine({
			  			onValidationComplete: function(form, status){
			  				if (status == true) {
			  					mostraMensagem("Aguarde...","",'info',true);
			  					$.ajax({
			  						url: pathSite + '/default/auth/logar',
			  						dataType: 'json',
			  						type: 'POST',
			  						data: $('#frmLogar').serialize(),
			  						success: function(obj){
			  							if(obj.situacao=="sucess"){
			  								mostraMensagem(obj.msg,3,'success',true);
			  								$("#frmLogar").each(function(){
			  									this.reset();
			  								});
			  								window.location.href=pathSite+'/';
			  							} else if(obj.situacao=="error"){
			  								mostraMensagem(obj.msg,null,'error');
			  							}
			  						},
			  						error : function (XMLHttpRequest, textStatus, errorThrown) {
			  							
			  						},
			  						
			  						beforeSend : function(requisicao){
			  						}
			  					});
			  				}
			  			}
			  		
			  		});
			  	}
				
				
		    
		  }
		}]);
	  }
});
  