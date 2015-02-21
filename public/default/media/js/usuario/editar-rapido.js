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

