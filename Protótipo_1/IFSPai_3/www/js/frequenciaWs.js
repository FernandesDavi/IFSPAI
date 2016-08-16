function carregarItensFrequencia(){
	//variáveis
	var itens = "", url = "	http://davifernandes.profissional.ws/escola/frequencia.php";
	var tabela = "";
	var idaluno =localStorage.getItem("aluno");
	var mat=localStorage.getItem("materia");
	var professor = "";
	var faltas = "";
	var auladada = "";
	var aluno = "";
	var turma = "";
	var cargarH= "";
	var disciplina = "";
	var frequencia = "";
	var x = "";
    //Capturar Dados Usando Método AJAX do jQuery
    $.ajax({
    	url: url,
    	cache: false,
    	crossDomain: true,
    	dataType: "json",
    	data:"aluno="+idaluno+"&materia="+mat, 

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
					disciplina = retorno[0].disciplina_nome;
					turma = retorno[0].turma;
					professor = retorno[0].professor;
					auladada =retorno[0].aulasdadas;
					cargaH =retorno[0].carga_horaria;
					faltas =retorno[0].faltas;

					x = ((faltas / auladada));

					frequencia = 100 - x;
					frequencia += '%';

			    //Preencher o cabeçalho da tabela
			    $("#disciplina").html(disciplina);
			    $("#turma").html(turma);
			    $("#professor").html(professor);
			    $("#auladada").html(auladada);
			    $("#cargarH").html(cargaH);
			    $("#faltas").html(faltas);
			    $("#frquencia").html(frequencia);
			}
		}
	});
}


