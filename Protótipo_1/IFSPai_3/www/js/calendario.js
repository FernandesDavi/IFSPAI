function calendario(){
    //variáveis
    var itens = "", url = " http://davifernandes.profissional.ws/escola/calendario.php";
    var idaluno =localStorage.getItem("aluno");

    //Capturar Dados Usando Método AJAX do jQuery
    $.ajax({
        url: url,
        cache: false,
        crossDomain: true,
        dataType: "json",
        data:"aluno="+idaluno,


        success: function(retorno) {

        for(var i = 0; i<retorno.length; i++){  
            itens += "<center>";
                 itens += "<tr>";
                 itens += "<td colspan='2'><b>" + retorno[i].data + ":"+"</b></td>";
                  itens +=" ";
                 itens += "<td> " + retorno[i].aviso + "</td>";
                 itens += "<tr>";
                }
                 itens += "</center>";
                //Preencher o cabeçalho da tabela
                $("#atv").html(itens);


            }
        });
}


