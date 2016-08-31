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
  $io=$_POST['io'];  //Pegando dados passados por AJAX
  $usuario=$_POST['user'];
 $today = date("Y-m-d H:i:s");  
  
//@pg_close($con); //Encerrrar Conexão

  //SQL de BUSCA LISTAGEM
  $sql = ("INSERT INTO log_sis(io_es, usuario_id, data_hora) VALUES ('".$io."','".$usuario."' ,'".$today."')");
   mysqli_query($con, $sql);
  
  

?>
      