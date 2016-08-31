<?php


//Definir formato de arquivo
header('content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Credentials: true");

  
$servidor = '179.188.16.99';
$usuario = 'bancotccdavi';
$senha = 'davi41947181';
$banco = 'bancotccdavi';
// Conecta-se ao banco de dados MySQL

  $con = mysqli_connect($servidor, $usuario, $senha, $banco);
  $senha=$_GET['senha'];  //Pegando dados passados por AJAX
  $id_resp=$_GET['pai'];
  
//@pg_close($con); //Encerrrar Conexão

  //SQL de BUSCA LISTAGEM
  $sql = ("update responsavel set senha = '".$senha."' where id_resp = '".$id_resp."'");
  $result= mysqli_query($con, $sql);
  if (!$result) {
    //Caso não haja retorno
    echo '[{"erro": "0"';
    echo '}]';
    }


?>
      