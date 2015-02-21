			   
// Pesquisar Filtrar
$('.botaoPesquisar').click(function () {
	$('[data-toggle="table"]').bootstrapTable('destroy');
	$('[data-toggle="table"]').bootstrapTable({
		url: $('#frmPesquisar').attr('data-url')+'?'+$('#frmPesquisar').serialize(),
		onLoadSuccess: function(){
    		$("[data-toggle='tooltip']").tooltip();
    	}
	});
	
	$('.forget-modal-all').modal('hide');
});

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
