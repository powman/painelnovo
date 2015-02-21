/*
 * FUNCAO PARA CRIAR FORMULARIO DE ENVIO DE CONTATO AJAX
 */
$(function(){
	
	yepnope([{
		  load: [ 
		          pathSite+"/js/tableExport/tableExport.js",  
		          pathSite+"/js/tableExport/jquery.base64.js",  
		          pathSite+"/js/tableExport/html2canvas.js",  
		          pathSite+"/js/bower_components/bootstrap-table/src/bootstrap-table.css",  
		          pathSite+"/js/bower_components/bootstrap-table/src/bootstrap-table.js",  
		          pathSite+"/js/bower_components/bootstrap-table/src/locale/bootstrap-table-pt-BR.js", 
		          pathSite+"/js/bower_components/bootstrap-table/src/extensions/flatJSON/bootstrap-table-flatJSON.js", 
		          pathSite+"/js/bower_components/bootstrap-table/src/extensions/export/bootstrap-table-export.js"],
		  complete: function () {
			  
			   // Habilitar Table com o tooltip
			   $(function () {
			        $('[data-toggle="table"]').bootstrapTable({
			        	onLoadSuccess: function(){
			        		$("[data-toggle='tooltip']").tooltip();
			        	},
			        	responseHandler : function(response){
			        		if(response.situacao == "error"){
				     			mostraMensagem(response.msg,null,'error',true);
				     			$('.jumbotron').hide();
			        		}
			        		
			        		return response;
			        	}
			        });
			    });
			   
			   
		  }
	}]);
	
	// Acao para chamar o modal do cadastro rapido
	$('.cadastro-rapido').click(function(){
		var $modal = $('.forget-modal-all');
     	
 		// create the backdrop and wait for next modal to be triggered
 		$('body').modalmanager('loading');
     		$modal.load(pathSite+'/default/membro/cadastro-rapido', function( response, status, xhr ){
 			var resposta = xhr.responseText;
     		if(resposta.indexOf("situacao") == -1){	
     			$modal.modal();
     			
     		}else{
     			var resposta2 = JSON.parse(xhr.responseText);
     			$modal.modal('hide');
     			mostraMensagem(resposta2.msg,null,'error',true);
         	}
 		});
 		 
 		$modal.on('click', '.update', function(){
     		$modal.modal('loading');
     		setTimeout(function(){
     		$modal
	        		.modal('loading')
	        		.find('.modal-body')
	        		.prepend('<div class="alert alert-info fade in">' +
	        		'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
	        		'</div>');
     		}, 1000);
 		});
	});
});

// chama o modal da pesquisa
$(function(){
	$('.modalDePesquisa').click(function(){
		var $modal = $('.forget-modal-all');
		
		// create the backdrop and wait for next modal to be triggered
		$('body').modalmanager('loading');
			$modal.load($(this).attr('data-url'), function( response, status, xhr ){
			var resposta = xhr.responseText;
     		if(resposta.indexOf("situacao") == -1){	
     			$modal.modal();
     			
     		}else{
     			var resposta2 = JSON.parse(xhr.responseText);
     			$modal.modal('hide');
     			mostraMensagem(resposta2.msg,null,'error',true);
     		}
		});
		 
		$modal.on('click', '.update', function(){
			$modal.modal('loading');
			setTimeout(function(){
			$modal
	    		.modal('loading')
	    		.find('.modal-body')
	    		.prepend('<div class="alert alert-info fade in">' +
	    		'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
	    		'</div>');
			}, 1000);
		});
	});
});

// habilita as opções e editar, excluir e edição rápida.
function operateFormatter(value, row, index) {
    return [
        '<div class="col-md-4 col-xs-12 col-sm-4" align="center"><a data-toggle="tooltip" href="#" class="btn btn-block btn-sm btn-primary editar" title="Editar">',
            '<span class="glyphicon glyphicon-pencil">',
        '</a></div>',
        '<div class="col-md-4 col-xs-12 col-sm-4" align="center"><a href="#" data-toggle="tooltip" class="btn btn-block btn-sm btn-primary editFast" title="Edição Rápida">',
	        '<span class="glyphicon glyphicon-check"></span>',
	    '</a></div>',
        '<div class="col-md-4 col-xs-12 col-sm-4" align="center"><a href="#" data-toggle="tooltip" class="btn btn-block btn-sm btn-primary remove" title="Remover">',
            '<span class="glyphicon glyphicon-trash"></span>',
        '</a></div>'
    ].join('');
}

// cria os eventos para os botoes editar, excluir e edição rápida.
window.operateEvents = {
		'click .editar': function (e, value, row, index) {
        		window.location.href=pathSite+'/default/membro/editar-form/id/'+row.id;
        	
        },
        'click .editFast': function (e, value, row, index) {
        	
        	var $modal = $('.forget-modal-all');
        	
        	// create the backdrop and wait for next modal to be triggered
        	$('body').modalmanager('loading');
        	$modal.load(pathSite+'/default/membro/editar-rapido/id/'+row.id+"/type/json", '', function(){
        		$modal.modal();
        	});
        	
        	$modal.on('click', '.update', function(){
        		$modal.modal('loading');
        		setTimeout(function(){
        			$modal
        			.modal('loading')
        			.find('.modal-body')
        			.prepend('<div class="alert alert-info fade in">' +
        					'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
        			'</div>');
        		}, 1000);
        	});
        	
        },
        'click .remove': function (e, value, row, index) {
        	var r = confirm("Deseja Excluir?");
            if(r) {
            	$.ajax({
					url: pathSite+'/default/membro/excluir/id/'+row.id+"/type/json",
					dataType: 'json',
					type: 'POST',
					data: {
						id: row.id
					},
					success: function(obj){
						if(obj.situacao=="sucess"){
					    	$('[data-toggle="table"]').bootstrapTable('refresh');
					    	mostraMensagem(obj.msg,3,'success',true);
						} else if(obj.situacao=="error"){
							$('[data-toggle="table"]').bootstrapTable('refresh');
							mostraMensagem(obj.msg,null,'error',true);
						}
					},
					error : function (XMLHttpRequest, textStatus, errorThrown) {
						
					},
					
					beforeSend : function(requisicao){
					}
				});
            }
        }
    };
  