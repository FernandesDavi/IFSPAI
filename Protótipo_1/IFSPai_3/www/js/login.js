/*
	heuristicas de nielsen

	tentar encontrar no mercado um sistema seimilar a nossa, e tentar detectar problemas segundo as heristicas de nilsen

	pesquisar sobre: metodos para vilidação com o usuario
		formularios de pesquisa, 
		escala de likert,

	pesquisar questoes educacionais sobre a importancia do acompanhamento dos pais no dia-a-dia no ambiente escolar

*/  
function log_out(){
var itens = "", url = "	http://davifernandes.profissional.ws/Alunos/log.php";
var ios = 1;
var users = 1;
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


function log_sis(){
var itens = "", url = "	http://davifernandes.profissional.ws/Alunos/log.php";
var io = 0;
var user = 1;
    //Capturar Dados Usando Método AJAX do jQuery
    $.ajax({
	    url: url,
	    cache: false,
		crossDomain: true,
		type:"post", 
	    dataType: "json",
	    data:"io="+io+"&user="+user,
	   
    });
	

}

function validaaparecer(){
	
     		 
	$('#errolog').hide();
	var inputUsername = localStorage.getItem("usuario");
	var inputPassword = localStorage.getItem("senha");
	$.ajax({            //Função AJAX

	url:"http://davifernandes.profissional.ws/Alunos/login2.php",//Arquivo php
	type:"post",    //Método de envio
	dataType: "json",
	data:"login="+inputUsername+"&senha="+inputPassword,    //Dados

							
		success: function (retorno){            //Sucesso no AJAX					
			if(retorno[0].id_login_aluno != 0){                       
					location.href='menu.html'   //Redireciona
				}else{
					$('#errolog').hide();
					

				}
			}
		});
}

function limparLocalStorage(){
$('#errolog').hide();
	localStorage.clear();
}

function validaLogin(){
	var data = "";

	$(document).ready(function(){
		$('#errolog').hide(); //Esconde o elemento com id errolog
		$('#formlogin').submit(function(){  //Ao submeter formulário
			var login=$('#login').val();    //Pega valor do campo login
			var senha=$('#password').val(); //Pega valor do campo senha
			var aluno;

			localStorage.setItem("usuario",login);
			localStorage.setItem("senha",senha);
				$.ajax({            //Função AJAX
					url:"http://davifernandes.profissional.ws/Alunos/login2.php",//Arquivo php
					type:"post",    //Método de envio
					dataType: "json",
					data:"login="+login+"&senha="+senha,    //Dados
						error: function(data) {
							this.data = data;
							console.log(data);
							$('#errolog').show(); 
							},
						success: function (retorno){            //Sucesso no AJAX
							if(retorno[0].id_login_aluno != 0){                        
								location.href='menu.html';   //Redireciona
								aluno = retorno[0].id_login_aluno;
								localStorage.setItem("aluno",aluno);

							}
						}
				});
					return false;   //Evita que a página seja atualizada
			})
		})
};

