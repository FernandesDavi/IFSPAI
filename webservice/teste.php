<?php


//Definir formato de arquivo
header('content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Credentials: true");

  
$servidor = '186.202.152.167';
$usuario = 'daviwebservice';
$senha = '';
$banco = 'daviwebservice';

// Conecta-se ao banco de dados MySQL

$con = mysqli_connect($servidor, $usuario, $senha, $banco);


//@pg_close($con); //Encerrrar Conexão

if(!$con) {
  echo '[{"erro": "Não foi possível conectar ao banco"';
  echo '}]';
}else {
  //SQL de BUSCA LISTAGEM
  $sql   = "select count(*) as quantidade_materias from materia where id_materia_aluno = 1";
    $result = mysqli_query($con, $sql); //Executar a SQL
  $n     = mysqli_num_rows($result); //Número de Linhas retornadas
  if (!$result) {
    //Caso não haja retorno
    echo '[{"erro": "Há algum erro com a busca. Não retorna resultados"';
    echo '}]';
  }else if($n<1) {
    //Caso não tenha nenhum item
    echo '[{"erro": "Não há nenhum dado cadastrado"';
    echo '}]';
  }else {
    //Mesclar resultados em um array
    
    for($i = 0; $i<$n; $i++) {
      $dados[] = mysqli_fetch_assoc($result);
    }
  
    echo json_encode($dados);
    //echo json_encode($categories,128);

  }
}
?>
