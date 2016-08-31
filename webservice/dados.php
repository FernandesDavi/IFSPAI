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

  $aluno=$_POST['aluno'];  //Pegando dados passados por AJAX
  $materia=$_POST['materia'];
//@pg_close($con); //Encerrrar Conexão

if(!$con) {
  echo '[{"erro": "Não foi possível conectar ao banco"';
  echo '}]';
}else {
  //SQL de BUSCA LISTAGEM

  $sql ="select notas.avaliacao_nome,professor.nome as professor, DATE_FORMAT(notas.datas,'%m-%d-%Y') as data, notas.calculo, notas.nota, aluno.nome as aluno, turma.turma, disciplina.nome as disciplina from notas
inner join aluno on aluno.id_aluno = notas.id_aluno_notas
inner join turma on turma.id_turma = notas.id_turma_notas
inner join atribuicao on atribuicao.id_turma_atr = notas.id_turma_notas
inner join professor on professor.id_professor = atribuicao.id_prof_atr
inner join disciplina on disciplina.id_disc = atribuicao.id_disc_atr where disciplina.id_disc ='".$materia."' and aluno.id_aluno ='".$aluno."'";
  
    $result = mysqli_query($con, $sql); //Executar a SQL
  $n = mysqli_num_rows($result); //Número de Linhas retornadas
  
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