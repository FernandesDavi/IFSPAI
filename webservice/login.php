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
$vl1['valor'] = 1;
  $login=$_POST['login'];  //Pegando dados passados por AJAX
  $senha=$_POST['senha'];
//@pg_close($con); //Encerrrar Conexão

if(!$con) {
  echo '[{"erro": "Não foi possivel conectar ao banco"';
  echo '}]';
}else {
  //SQL de BUSCA LISTAGEM

 $sql="select aluno.id_aluno, aluno.nome, responsavel.id_resp from responsavel inner join aluno on aluno.id_resp_aluno = responsavel.id_resp where responsavel.usuario = '".$login."' and responsavel.senha ='".$senha."'"; 


 $result = mysqli_query($con, $sql); //Executar a SQL
  $n     = mysqli_num_rows($result); //Número de Linhas retornadas
  if (@mysqli_num_rows($result) > 0){ 
        //Mesclar resultados em um array
    for($i = 0; $i<$n; $i++) {
      $dados[] = mysqli_fetch_assoc($result);
    }
    $valor = 1;
    //$dados = $dados("VALOR" => "1");  
    echo json_encode($dados);

  }
}
?>

  