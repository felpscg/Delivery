$(function(){
	$("#cpf").onblur(function(){
		//Recuperar o valor do campo
		var cpf = $(this).val();
		
		//Verificar se ha algo digitado
		if(cpf != ''){
			var dados = {
				valcpf : cpf
			}
			$.post('../class/pesq_cpf-email_cad.php', dados, function(retorna){
				
				$(".resultcpf").html(retorna);
			});
		}
	});
});