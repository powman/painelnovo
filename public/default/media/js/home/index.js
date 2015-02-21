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
		          pathSite+"/js/bower_components/bootstrap-table/src/extensions/export/bootstrap-table-export.js", 
		          pathSite+"/js/bower_components/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css", 
		          pathSite+"/js/bower_components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js" ],
		  complete: function () {
			  
			   // Habilitar Table
			   $(function () {
			        $('[data-toggle="table"]').bootstrapTable();
			    });
			   
			    // Pesquisar Filtrar
			    $('.botaoPesquisar').click(function () {
			    	$('[data-toggle="table"]').bootstrapTable('destroy');
			    	$('[data-toggle="table"]').bootstrapTable({
			    		url: $('#buscar').attr('data-url')+'?'+$('#buscar').serialize()
			    	});
				});
			   
			   
		  }
	}]);
});
  