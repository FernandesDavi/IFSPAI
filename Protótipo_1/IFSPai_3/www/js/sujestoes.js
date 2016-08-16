function enviaSujestoes(){
var url = "	http://davifernandes.profissional.ws/escola/suje.php";
var sugestoes = $('#textarea1').val();

var id_resp_sug =localStorage.getItem("pai");
    //Capturar Dados Usando Método AJAX do jQuery
    $.ajax({
	    url: url,
	    cache: false,
		crossDomain: true,
		type:"post", 
	    dataType: "json",
	    data:"sugestoes="+sugestoes+"&id_resp_sug="+id_resp_sug,
	   
    });
	
alert("Mensagem enviada com sucesso!");
};