$(function(){
	 

	
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

    $('.selecionarTodos').click(function(event) {  //on click 
    	
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
    $('.selecionarTodosGrupo').click(function(event) {  //on click 
    	var grupo = $(this).attr('data-grupo');
        if(this.checked) { // check select status
            $('.checkbox1'+grupo).each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1'+grupo).each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
	    

	
});
