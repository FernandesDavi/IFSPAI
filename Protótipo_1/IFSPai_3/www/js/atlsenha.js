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

			
			}
		});	
alert("Senha alteada com sucesso você sera deslogado para concluir o processo!");
	 limparLocalStorage();
	}else
	alert("Digite a senha atual corretamente");
}

function log_out(){


var url = "	http://davifernandes.profissional.ws/escola/log.php";
var ios = 1;
var users =localStorage.getItem("aluno");
    //Capturar Dados Usando Método AJAX do jQuery
    $.ajax({
	    url: url,
	    cache: false,
		crossDomain: true,
		type:"post", 
	    dataType: "json",
	    data:"io="+ios+"&user="+users,
	   
    });
	

}

function limparLocalStorage(){
		window.location.replace("index.html");

	localStorage.clear();
	log_out();
}