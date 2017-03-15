<?php


//Definir formato de arquivo
header('content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Credentials: true");

  
$servidor = '179.188.16.99';
$usuario = 'bancotccdavi';
$senha = '';
$banco = 'bancotccdavi';
// Conecta-se ao banco de dados MySQL

  $con = mysqli_connect($servidor, $usuario, $senha, $banco);
  $sugestoes=$_POST['sugestoes'];  //Pegando dados passados por AJAX
  $id_resp_sug=$_POST['id_resp_sug'];
  
//@pg_close($con); //Encerrrar Conexão

  //SQL de BUSCA LISTAGEM
  $sql = ("INSERT INTO sugestoes(sugestoes, id_resp_sug) VALUES ('".$sugestoes."','".$id_resp_sug."')");
  $result= mysqli_query($con, $sql);
  if (!$result) {
    //Caso não haja retorno
    echo '[{"erro": "0"';
    echo '}]';
    }


?>
      
