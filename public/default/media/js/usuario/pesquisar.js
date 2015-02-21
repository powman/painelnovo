			   
// Pesquisar Filtrar
$('.botaoPesquisar').click(function () {
	$('[data-toggle="table"]').bootstrapTable('destroy');
	$('[data-toggle="table"]').bootstrapTable({
		url: $('#frmPesquisar').attr('data-url')+'?'+$('#frmPesquisar').serialize(),
		onLoadSuccess: function(){
    		$("[data-toggle='tooltip']").tooltip();
    	},responseHandler : function(response){
    		if(response.situacao == "error"){
     			mostraMensagem(response.msg,null,'error',true);
     			$('.jumbotron').hide();
    		}
    		
    		return response;
    	}
	});
	
	$('.forget-modal-all').modal('hide');
});