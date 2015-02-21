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
			        	}
			        });
			    });
			   
			   
		  }
	}]);
});

// chama o modal da pesquisa
$(function(){
	$('.modalDePesquisa').click(function(){
		var $modal = $('.forget-modal-all');
		
		// create the backdrop and wait for next modal to be triggered
		$('body').modalmanager('loading');
			$modal.load($(this).attr('data-url'), '', function(){
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
	});
});
  