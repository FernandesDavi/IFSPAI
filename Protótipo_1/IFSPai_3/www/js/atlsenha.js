function alterarSenha(){
	url = "	http://davifernandes.profissional.ws/escola/altersenha.php";
	var senhaVer = $('#login').val();
	var senhaAtual = localStorage.getItem("senha");
	var pai = localStorage.getItem("pai");
	var senhaNova = $('#senha').val();


	if(senhaVer == senhaAtual){
		// faz o bailinho
	$.ajax({
    	url: url,
    	cache: false,
    	crossDomain: true,
    	dataType: "json",
    	data: "post",
    	data:"senha="+senhaNova+"&pai="+pai,

    	success: function(retorno) {

			alert("Senha alteada com sucesso você sera deslogado para concluir o processo!");
			}
		});	

	}else
	alert("Digite a senha atual corretamente");
}