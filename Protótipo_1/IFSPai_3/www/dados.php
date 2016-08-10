<?php


//Definir formato de arquivo
header('Content-Type:' . "text/plain");

$servidor = '186.202.152.167';
$usuario = 'daviwebservice';
$senha = 'davi41947181';
$banco = 'daviwebservice';

// Conecta-se ao banco de dados MySQL

$con = mysqli_connect($servidor, $usuario, $senha, $banco);


//@pg_close($con); //Encerrrar Conexão

if(!$con) {
  echo '[{"erro": "Não foi possível conectar ao banco"';
  echo '}]';
}else {
  //SQL de BUSCA LISTAGEM
  $sql   = "SELECT notas.id_notas, notas.avaliacao_nome, notas.datas, notas.calculo, notas.nota, aluno.nome_aluno, materia.nome_materia,prof.nome_prof, aluno.prontuario FROM notas INNER JOIN aluno on notas.id_notas_aluno = aluno.id_aluno INNER JOIN materia on notas.id_notas_materia = materia.id_materia INNER JOIN prof on materia.id_materia_prof = prof.id_prof WHERE aluno.id_aluno = 1;";
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