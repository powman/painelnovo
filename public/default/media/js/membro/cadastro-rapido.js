if($('.formAjax').length != 0){
	$(".formAjax").validationEngine({
        onValidationComplete: function(form, status){
         if (status == true) {
        	    $('.forget-modal-all').modal('hide');
     	 	    mostraMensagem("Aguarde...",null,'info',true);
        	 	var modulo = $(".formAjax").attr('data-modulo');
        	 	var ctrl = $(".formAjax").attr('data-ctrl');
        	 	var funcao = $(".formAjax").attr('data-action');
                $.ajax({
                url: pathSite+"/" +modulo+"/"+ctrl+"/"+funcao,
                dataType: 'json',
                type: 'POST',
                data: $('.formAjax').serialize(),
                success: function(obj){
                    if(obj.situacao=="sucess"){
                        mostraMensagem(obj.msg,3,'success',true);
                        $('.forget-modal-all').modal('hide');
                        
                        $('[data-toggle="table"]').bootstrapTable('refresh');
                    } else if(obj.situacao=="error"){
                    	$('.forget-modal-all').modal('hide');
                    	$('[data-toggle="table"]').bootstrapTable('refresh');
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

$(function(){
	 
	 
	//Inicio Mascara Telefone
// <input type="text" name="one" id="one" mask-input="cpfCnpj">
	if($('input[mask-input=telefone]').length != 0){
		$('input[mask-input=telefone]').mask('(00) 0000-0000',  
		{onKeyPress: function(phone, event, currentField, options){  
			 var new_sp_phone = phone.match(/^(\(11\) 9(5[0-9]|6[0-9]|7[01234569]|8[0-9]|9[0-9])[0-9]{1})/g);  
			 new_sp_phone ? $(currentField).mask('(00) 00000-0000', options) : $(currentField).mask('(00) 0000-0000', options)  
		}}  
		); 
	}
	$("input[mask-input=data]").mask("99/99/9999");
	
});

