function Carregarmaterias(){
	//variáveis
	var itens = ""; 
	var url = "	http://davifernandes.profissional.ws/Alunos/materias.php";
	var tabela = "";
	var materia = "";
	var materia2 = "";
	var psor = "";
    var data = ""; 

    var aluno = localStorage.getItem("aluno");
    //var aluno =1;
    //Capturar Dados Usando Método AJAX do jQuery
    $.ajax({
	    url: url,
	    cache: false,
		crossDomain: true,
		type:"post", 
	    dataType: "json",
	    data:"aluno="+aluno, 
	   
	    success: function(retorno) {
			    //Laço para criar linhas da tabela
			   for(var i = 0; i<retorno.length; i++){
					
				    itens += "<tr>";
					itens+="<td><button id='"+ retorno[i].id_materia +"' onClick='reply_click(this.id)'>"+ retorno[i].nome_materia +"</button></td>";
					//select
					itens += "</tr>";
			  }
			    //Preencher a Tabela
				
			    $("#minhaTabela tbody").html(itens);
			    
			    
		    
	    }
    });
	
}
	function reply_click(clicked_id)
{
    alert(clicked_id);
}