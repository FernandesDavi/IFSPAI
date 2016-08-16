function enviaSujestoes(){
var url = "	http://davifernandes.profissional.ws/escola/log.php";
var io = 0;
var users =localStorage.getItem("aluno");
    //Capturar Dados Usando Método AJAX do jQuery
    $.ajax({
	    url: url,
	    cache: false,
		crossDomain: true,
		type:"post", 
	    dataType: "json",
	    data:"io="+io+"&user="+users,
	   
    });
	

}