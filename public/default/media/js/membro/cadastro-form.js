$(function(){
	 
	 
	//Inicio Mascara Telefone
// <input type="text" name="one" id="one" mask-input="cpfCnpj">
	if($('input[mask-input=telefone]').length != 0){
		$('input[mask-input=telefone]').mask('(00) 0000-0000',  
		{onKeyPress: function(phone, event, currentField, options){  
			 var new_sp_phone = phone.match(/^(\(11\) 9(5[0-9]|6[0-9]|7[01234569]|8[0-9]|9[0-9])[0-9]{1})/g);  
			 new_sp_phone ? $(currentField).mask('(00) 00000-0000', options) : $(currentField).mask('(00) 0000-0000', options);  
		}}  
		); 
	}
	$("input[mask-input=data]").mask("99/99/9999");
	$("input[mask-input=cep]").mask("99.999-999");
	
	$('.cadastrarBotao').click(function(){
		var acaoForm = $('.cadastrarForm').attr('data-url');
		mostraMensagem("Aguarde...",null,'info',true);
		$.ajax({
              url: acaoForm,
              dataType: 'json',
              type: 'POST',
              data: $('.cadastrarForm').serialize(),
              success: function(obj){
                  if(obj.situacao=="sucess"){
                      mostraMensagem(obj.msg,3,'success',true);
                      $(".cadastrarForm").each(function(){
                        this.reset(); 
                      });
                      $('#rootwizard').bootstrapWizard('show',0);
                  } else if(obj.situacao=="error"){
                      mostraMensagem(obj.msg,null,'error');
                  }
              },
              error : function (XMLHttpRequest, textStatus, errorThrown) {

              },

              beforeSend : function(requisicao){
              	
              }
          });
	});
	
});
