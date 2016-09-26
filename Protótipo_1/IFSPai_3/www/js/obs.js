function observacoes(){
	//variáveis
	var itens = "", url = "	http://davifernandes.profissional.ws/escola/obs.php";
	var obs = "";
	var idaluno =localStorage.getItem("aluno");
	var pai=localStorage.getItem("pai");

    //Capturar Dados Usando Método AJAX do jQuery
    $.ajax({
    	url: url,
    	cache: false,
    	crossDomain: true,
    	dataType: "json",
    	data:"aluno="+idaluno+"&pai="+pai, 


    	success: function(retorno) {
    			obs+="<center>"
				//Dados do cabeçalho da tabela
				obs += retorno[0].observacoes;
				obs+="</center>"	
			    //Preencher o cabeçalho da tabela
			    $("#obs").html(obs);


			}
		});
}


