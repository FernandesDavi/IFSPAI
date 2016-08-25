function carregar(){
	//variáveis
	var itens = "", url = "	http://davifernandes.profissional.ws/escola/dados.php";
	var tabela = "";
	var materia = "";
	var turma = "";
	var psor = "";
    var data = ""; 

    var x="";
  // var mat = localStorage.getItem("materia");
   //var aluno = localStorage.getItem("aluno");
  // alert(mat,aluno);
    var mat =1;
    var aluno =1;
var  vl1 = 0;
var calc;
var vl3;

    //Capturar Dados Usando Método AJAX do jQuery
    $.ajax({
	    url: url,
	    cache: false,
		crossDomain: true,
	    dataType: "json",
	    type:"post", 

	    data:"aluno="+aluno+"&materia="+mat, 

		 
		  success: function(retorno) {
			if(retorno[0].erro){
				alert(retorno[0].erro);
			}
					else{

					materia = retorno[0].disciplina;
					turma = retorno[0].turma;
					psor = retorno[0].professor;
					
			    //Laço para criar linhas da tabela
			   for(var i = 0; i<retorno.length; i++){
					
				    	itens += "<tr>";
					    itens += "<td colspan='2'><b>" + retorno[i].avaliacao_nome + "</b></td>";
					    itens += "<td>" + retorno[i].data + "</td>";
					    itens += "<td>" + retorno[i].calculo + "</td>";
					    calc = retorno[i].calculo;
					    itens += "<td><b>" + retorno[i].nota + "</b></td>";
					    vl1 += parseFloat(retorno[i].nota);

					 	itens += "</tr>";
					   
				
			  }
			  if (calc == "MEDIA") {
				vl3 = (vl1 / i);

			  }
			 					    

			    //Preencher a Tabela
			     $("#mediafinal").html(vl3);
				 $("#dis").html(materia);
				 $("#turma").html(turma);
				 $("#prof").html(psor);
			    $("#minhaTabela ").html(itens);
			    
			    
		    
	    }
	}
    });
	
	


	
}

function teste(){

	console.log("asdfg");
}