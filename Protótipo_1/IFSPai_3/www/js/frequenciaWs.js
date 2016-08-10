function carregarItensFrequencia(){
	//variáveis
	var itens = "", url = "	http://davifernandes.profissional.ws/Alunos/NOME_DA_PAGINA.php";
	var tabela = "";
	var materia = "";
	var materia2 = "";
	var psor = "";
    var data = ""; 
    //Capturar Dados Usando Método AJAX do jQuery
    $.ajax({
	    url: url,
	    cache: false,
		crossDomain: true,
	    dataType: "json",
	    beforeSend: function() {
		    $("h2").html("Carregando..."); //Carregando
	    },
	    error: function(data) {
			this.data = data;
			console.log(data);
		    $("h2").html("Há algum problema com a fonte de dados");
	    },
	    success: function(retorno) {
		    if(retorno[0].erro){
			    $("h2").html(retorno[0].erro);
		    }
		    else{
					
					//Dados do cabeçalho da tabela
					materia = retorno[1].nome_materia;
					materia2 += retorno[1].nome_materia;
					psor += retorno[1].nome_prof;

			    //Laço para criar linhas da tabela
			   for(var i = 0; i<retorno.length; i++){
			   	
						//editar itens abaixo para receber DADOS de FREQUENCIA do aluno
				    	itens += "<tr>";
					    //itens += "<td>" + retorno[i].id_notas + "</td>";
					    itens += "<td colspan='2'><b>" + retorno[i].avaliacao_nome + "</b></td>";
					    itens += "<td>" + retorno[i].datas + "</td>";
					    itens += "<td>" + retorno[i].calculo + "</td>";
					    itens += "<td><b>" + retorno[i].nota + "</b></td>";
					    //itens += "<td>" +  + "</td>";
					    //itens += "<td>" + retorno[i].nome_materia + "</td>";
					    //itens += "<td>" + retorno[i].nome_prof + "</td>";
					    //itens += "<td>" + retorno[i].prontuario + "</td>";
					   
					itens += "</tr>";
			  }
			    //Preencher o cabeçalho da tabela
				 $("#materia").html(materia);
				 $("#materia2").html(materia2);
				 $("#psor").html(psor);
			     $("#minhaTabela tbody").html(itens);
			    
			    
		    }
	    }
    });
	
	
	
}