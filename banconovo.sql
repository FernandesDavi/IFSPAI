create database escolatcc;
use bancotccdavi;

create table responsavel(
	id_resp int primary key auto_increment,
    nome varchar(100),
    cpf varchar(15),
    rg varchar(13),
    logradouro varchar(30),
    cep varchar(20),
    numero int,
    complemento varchar(20),
    usuario varchar(50),
    senha varchar(30)
);
insert into responsavel values(null,'davi','1234567','12345678','rua do hue','234567',234,'','user','senha');
SELECT * FROM aluno;
create table sugestoes(
	id_sug int primary key auto_increment,
	sugestoes varchar(255),
	id_resp_sug int,
	foreign key (id_resp_sug) references responsavel(id_resp)
);

create table aluno(
	id_aluno int primary key auto_increment,
    nome varchar(100),
    cpf varchar(15),
    rg varchar(13),
    logradouro varchar(30),
    cep varchar(20),
    numero int,
    complemento varchar(20),
    prontuario int,
    id_resp_aluno int,
    foreign key(id_resp_aluno) references responsavel(id_resp)  
);
insert into aluno values(null,'teste','1234567','12345678','rua do hue','234567',234,'',1470205,2);

create table observacoes(
	id_obs int primary key auto_increment,
	observacoes varchar(255),
	id_aluno_obs int,
    id_resp_obs int,
	foreign key (id_aluno_obs) references aluno(id_aluno),
    foreign key (id_resp_obs) references responsavel(id_resp)
);
create table professor(
	id_professor int primary key auto_increment,
    nome varchar(100),
    cpf varchar(15),
    rg varchar(13),
    logradouro varchar(30),
    cep varchar(20),
    numero int,
    complemento varchar(20),
    prontuario int
);
insert into professor values(null,'cirço','123456789','1245896', 'rua das pedrinhas', '06434705', 124, 'b',1234567); 
create table disciplina(
	id_disc int primary key auto_increment,
	nome varchar(50),
	carga_horaria int
);
insert into disciplina values (null,'JAVA',80);

create table turma(
	id_turma int primary key auto_increment,
    turma varchar(40),
    sala varchar(20),
    ano int
    );
    select * from aluno;
    insert into turma values(null,'redes 2','',2016);
    
create table atribuicao(
	id_atribuicao int primary key auto_increment,
	id_prof_atr int,
	id_turma_atr int,
	id_disc_atr int,
	foreign key (id_prof_atr) references professor(id_professor),
	foreign key (id_turma_atr) references turma(id_turma),
	foreign key (id_disc_atr) references disciplina(id_disc)
);
create table frequencia(
	id_freq int primary key auto_increment,
    dia datetime,
    aula_dada int,
    frequencia int,
    id_aluno_freq int,
    id_turma_freq int,
    foreign key (id_aluno_freq) references aluno(id_aluno),
    foreign key (id_turma_freq) references turma(id_turma)
);
insert into frequencia values(null,now(),4,1,1,1);

create table notas(
	id_notas int primary key auto_increment,
    avaliacao_nome varchar(50),
    datas date,
    calculo varchar(30),
    nota float,
    id_aluno_notas int,
	id_turma_notas int,
    foreign key (id_aluno_notas) references aluno(id_aluno),
    foreign key (id_turma_notas) references turma(id_turma)
);
insert into notas values(null,'prova 1','2016-08-03','MEDIA',5.99,1,1);
insert into notas values(null,'prova 2','2016-08-06','MEDIA',6.99,1,1);
insert into notas values(null,'trabalho 1','2016-09-06','MEDIA',8,1,1);
insert into notas values(null,'prova 2','2016-08-08','MEDIA',7,1,1);

create table calendario(
	id_calendario int primary key auto_increment,
    data date,
    aviso varchar(15),
	id_turma_calen int,
	foreign key (id_turma_calen) references turma(id_turma)

);

create table log_sis(
	id_log int primary key auto_increment,
    io_es bit,
    usuario_id int,
    data_hora datetime,
    foreign key (usuario_id) references responsavel(id_resp)

);

insert into atribuicao values (null, 1,1,1);

select * from frequencia;

/* Mostrar a frequencia de uma determinada materia */
select frequencia.dia, frequencia.aula_dada, aluno.nome, turma.turma,disciplina.nome from frequencia 
inner join aluno on aluno.id_aluno = frequencia.id_aluno_freq
inner join turma on turma.id_turma = frequencia.id_turma_freq
inner join atribuicao on atribuicao.id_turma_atr = frequencia.id_turma_freq
inner join disciplina on disciplina.id_disc = atribuicao.id_disc_atr where disciplina.id_disc = 1; 

/* Montar a lista de materias */
select disciplina.nome, disciplina.id_disc from frequencia 
inner join aluno on aluno.id_aluno = frequencia.id_aluno_freq
inner join turma on turma.id_turma = frequencia.id_turma_freq
inner join atribuicao on atribuicao.id_turma_atr = frequencia.id_turma_freq
inner join disciplina on disciplina.id_disc = atribuicao.id_disc_atr where aluno.id_aluno = 1;

/* quantidade de materias */
select count(*)quantidade_materias  from frequencia 
inner join aluno on aluno.id_aluno = frequencia.id_aluno_freq
inner join turma on turma.id_turma = frequencia.id_turma_freq
inner join atribuicao on atribuicao.id_turma_atr = frequencia.id_turma_freq
inner join disciplina on disciplina.id_disc = atribuicao.id_disc_atr where aluno.id_aluno = 1;

/* Mostrar as notas */

select notas.avaliacao_nome, notas.datas, notas.calculo, notas.nota, aluno.nome, turma.turma, disciplina.nome from notas
inner join aluno on aluno.id_aluno = notas.id_aluno_notas
inner join turma on turma.id_turma = notas.id_turma_notas
inner join atribuicao on atribuicao.id_turma_atr = notas.id_turma_notas
inner join disciplina on disciplina.id_disc = atribuicao.id_disc_atr where disciplina.id_disc = 1; 

/*materias*/
select notas.avaliacao_nome, DATE_FORMAT(notas.datas,'%m-%d-%Y') as data, notas.calculo, notas.nota, aluno.nome as aluno,professor.nome as professor, turma.turma, disciplina.nome as disciplina from notas
inner join aluno on aluno.id_aluno = notas.id_aluno_notas
inner join turma on turma.id_turma = notas.id_turma_notas
inner join atribuicao on atribuicao.id_turma_atr = notas.id_turma_notas
inner join professor on professor.id_professor = atribuicao.id_prof_atr
inner join disciplina on disciplina.id_disc = atribuicao.id_disc_atr where disciplina.id_disc = 1 and aluno.id_aluno =1;

select * from notas;

select responsavel.usuario, responsavel.senha, aluno.id_aluno, aluno.nome from responsavel
inner join aluno on aluno.id_resp_aluno = responsavel.id_resp where responsavel.usuario = 1 and responsavel.senha = 1;

select * from frequencia;
select * from turma;
select * from atribuicao;
select * from disciplina;
select * from aluno;


SELECT * from log_sis;


select * from responsavel;



		insert into log_sis (io_es, usuario_id,data_hora)values(1,1,now());
        select aluno.id_aluno, aluno.nome from responsavel inner join aluno on aluno.id_resp_aluno = responsavel.id_resp where responsavel.usuario = 'admin' and responsavel.senha ='admin';


select professor.nome as professor,disciplina.carga_horaria, frequencia.dia,COUNT(frequencia.frequencia) as faltas, SUM(frequencia.aula_dada) as aulasdadas, aluno.nome as aluno, turma.turma, disciplina.nome as disciplina_nome from frequencia 
inner join aluno on aluno.id_aluno = frequencia.id_aluno_freq
inner join turma on turma.id_turma = frequencia.id_turma_freq
inner join atribuicao on atribuicao.id_turma_atr = frequencia.id_turma_freq
inner join professor on professor.id_professor = atribuicao.id_prof_atr
inner join disciplina on disciplina.id_disc = atribuicao.id_disc_atr where disciplina.id_disc = 1 and aluno.id_aluno = 1;




select * from observacoes;

