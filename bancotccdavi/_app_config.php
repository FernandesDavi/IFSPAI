<?php
/**
 * @package BANCOTCCDAVI
 *
 * APPLICATION-WIDE CONFIGURATION SETTINGS
 *
 * This file contains application-wide configuration settings.  The settings
 * here will be the same regardless of the machine on which the app is running.
 *
 * This configuration should be added to version control.
 *
 * No settings should be added to this file that would need to be changed
 * on a per-machine basic (ie local, staging or production).  Any
 * machine-specific settings should be added to _machine_config.php
 */

/**
 * APPLICATION ROOT DIRECTORY
 * If the application doesn't detect this correctly then it can be set explicitly
 */
if (!GlobalConfig::$APP_ROOT) GlobalConfig::$APP_ROOT = realpath("./");

/**
 * check is needed to ensure asp_tags is not enabled
 */
if (ini_get('asp_tags')) 
	die('<h3>Server Configuration Problem: asp_tags is enabled, but is not compatible with Savant.</h3>'
	. '<p>You can disable asp_tags in .htaccess, php.ini or generate your app with another template engine such as Smarty.</p>');

/**
 * INCLUDE PATH
 * Adjust the include path as necessary so PHP can locate required libraries
 */
set_include_path(
		GlobalConfig::$APP_ROOT . '/libs/' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/../phreeze/libs' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/vendor/phreeze/phreeze/libs/' . PATH_SEPARATOR .
		get_include_path()
);

/**
 * COMPOSER AUTOLOADER
 * Uncomment if Composer is being used to manage dependencies
 */
// $loader = require 'vendor/autoload.php';
// $loader->setUseIncludePath(true);

/**
 * SESSION CLASSES
 * Any classes that will be stored in the session can be added here
 * and will be pre-loaded on every page
 */
require_once "App/ExampleUser.php";

/**
 * RENDER ENGINE
 * You can use any template system that implements
 * IRenderEngine for the view layer.  Phreeze provides pre-built
 * implementations for Smarty, Savant and plain PHP.
 */
require_once 'verysimple/Phreeze/SavantRenderEngine.php';
GlobalConfig::$TEMPLATE_ENGINE = 'SavantRenderEngine';
GlobalConfig::$TEMPLATE_PATH = GlobalConfig::$APP_ROOT . '/templates/';

/**
 * ROUTE MAP
 * The route map connects URLs to Controller+Method and additionally maps the
 * wildcards to a named parameter so that they are accessible inside the
 * Controller without having to parse the URL for parameters such as IDs
 */
GlobalConfig::$ROUTE_MAP = array(

	// default controller when no route specified
	'GET:' => array('route' => 'Default.Home'),
		
	// example authentication routes
	'GET:loginform' => array('route' => 'SecureExample.LoginForm'),
	'POST:login' => array('route' => 'SecureExample.Login'),
	'GET:secureuser' => array('route' => 'SecureExample.UserPage'),
	'GET:secureadmin' => array('route' => 'SecureExample.AdminPage'),
	'GET:logout' => array('route' => 'SecureExample.Logout'),
		
	// Aluno
	'GET:alunos' => array('route' => 'Aluno.ListView'),
	'GET:aluno/(:num)' => array('route' => 'Aluno.SingleView', 'params' => array('idAluno' => 1)),
	'GET:api/alunos' => array('route' => 'Aluno.Query'),
	'POST:api/aluno' => array('route' => 'Aluno.Create'),
	'GET:api/aluno/(:num)' => array('route' => 'Aluno.Read', 'params' => array('idAluno' => 2)),
	'PUT:api/aluno/(:num)' => array('route' => 'Aluno.Update', 'params' => array('idAluno' => 2)),
	'DELETE:api/aluno/(:num)' => array('route' => 'Aluno.Delete', 'params' => array('idAluno' => 2)),
		
	// Atribuicao
	'GET:atribuicaos' => array('route' => 'Atribuicao.ListView'),
	'GET:atribuicao/(:num)' => array('route' => 'Atribuicao.SingleView', 'params' => array('atribuicao' => 1)),
	'GET:api/atribuicaos' => array('route' => 'Atribuicao.Query'),
	'POST:api/atribuicao' => array('route' => 'Atribuicao.Create'),
	'GET:api/atribuicao/(:num)' => array('route' => 'Atribuicao.Read', 'params' => array('atribuicao' => 2)),
	'PUT:api/atribuicao/(:num)' => array('route' => 'Atribuicao.Update', 'params' => array('atribuicao' => 2)),
	'DELETE:api/atribuicao/(:num)' => array('route' => 'Atribuicao.Delete', 'params' => array('atribuicao' => 2)),
		
	// Calendario
	'GET:calendarios' => array('route' => 'Calendario.ListView'),
	'GET:calendario/(:num)' => array('route' => 'Calendario.SingleView', 'params' => array('idCalendario' => 1)),
	'GET:api/calendarios' => array('route' => 'Calendario.Query'),
	'POST:api/calendario' => array('route' => 'Calendario.Create'),
	'GET:api/calendario/(:num)' => array('route' => 'Calendario.Read', 'params' => array('idCalendario' => 2)),
	'PUT:api/calendario/(:num)' => array('route' => 'Calendario.Update', 'params' => array('idCalendario' => 2)),
	'DELETE:api/calendario/(:num)' => array('route' => 'Calendario.Delete', 'params' => array('idCalendario' => 2)),
		
	// Disciplina
	'GET:disciplinas' => array('route' => 'Disciplina.ListView'),
	'GET:disciplina/(:num)' => array('route' => 'Disciplina.SingleView', 'params' => array('idDisc' => 1)),
	'GET:api/disciplinas' => array('route' => 'Disciplina.Query'),
	'POST:api/disciplina' => array('route' => 'Disciplina.Create'),
	'GET:api/disciplina/(:num)' => array('route' => 'Disciplina.Read', 'params' => array('idDisc' => 2)),
	'PUT:api/disciplina/(:num)' => array('route' => 'Disciplina.Update', 'params' => array('idDisc' => 2)),
	'DELETE:api/disciplina/(:num)' => array('route' => 'Disciplina.Delete', 'params' => array('idDisc' => 2)),
		
	// Frequencia
	'GET:frequencias' => array('route' => 'Frequencia.ListView'),
	'GET:frequencia/(:num)' => array('route' => 'Frequencia.SingleView', 'params' => array('idFreq' => 1)),
	'GET:api/frequencias' => array('route' => 'Frequencia.Query'),
	'POST:api/frequencia' => array('route' => 'Frequencia.Create'),
	'GET:api/frequencia/(:num)' => array('route' => 'Frequencia.Read', 'params' => array('idFreq' => 2)),
	'PUT:api/frequencia/(:num)' => array('route' => 'Frequencia.Update', 'params' => array('idFreq' => 2)),
	'DELETE:api/frequencia/(:num)' => array('route' => 'Frequencia.Delete', 'params' => array('idFreq' => 2)),
		
	// LogSis
	'GET:logsises' => array('route' => 'LogSis.ListView'),
	'GET:logsis/(:num)' => array('route' => 'LogSis.SingleView', 'params' => array('idLog' => 1)),
	'GET:api/logsises' => array('route' => 'LogSis.Query'),
	'POST:api/logsis' => array('route' => 'LogSis.Create'),
	'GET:api/logsis/(:num)' => array('route' => 'LogSis.Read', 'params' => array('idLog' => 2)),
	'PUT:api/logsis/(:num)' => array('route' => 'LogSis.Update', 'params' => array('idLog' => 2)),
	'DELETE:api/logsis/(:num)' => array('route' => 'LogSis.Delete', 'params' => array('idLog' => 2)),
		
	// Notas
	'GET:notases' => array('route' => 'Notas.ListView'),
	'GET:notas/(:num)' => array('route' => 'Notas.SingleView', 'params' => array('idNotas' => 1)),
	'GET:api/notases' => array('route' => 'Notas.Query'),
	'POST:api/notas' => array('route' => 'Notas.Create'),
	'GET:api/notas/(:num)' => array('route' => 'Notas.Read', 'params' => array('idNotas' => 2)),
	'PUT:api/notas/(:num)' => array('route' => 'Notas.Update', 'params' => array('idNotas' => 2)),
	'DELETE:api/notas/(:num)' => array('route' => 'Notas.Delete', 'params' => array('idNotas' => 2)),
		
	// Observacoes
	'GET:observacoeses' => array('route' => 'Observacoes.ListView'),
	'GET:observacoes/(:num)' => array('route' => 'Observacoes.SingleView', 'params' => array('idObs' => 1)),
	'GET:api/observacoeses' => array('route' => 'Observacoes.Query'),
	'POST:api/observacoes' => array('route' => 'Observacoes.Create'),
	'GET:api/observacoes/(:num)' => array('route' => 'Observacoes.Read', 'params' => array('idObs' => 2)),
	'PUT:api/observacoes/(:num)' => array('route' => 'Observacoes.Update', 'params' => array('idObs' => 2)),
	'DELETE:api/observacoes/(:num)' => array('route' => 'Observacoes.Delete', 'params' => array('idObs' => 2)),
		
	// Professor
	'GET:professors' => array('route' => 'Professor.ListView'),
	'GET:professor/(:num)' => array('route' => 'Professor.SingleView', 'params' => array('idProfessor' => 1)),
	'GET:api/professors' => array('route' => 'Professor.Query'),
	'POST:api/professor' => array('route' => 'Professor.Create'),
	'GET:api/professor/(:num)' => array('route' => 'Professor.Read', 'params' => array('idProfessor' => 2)),
	'PUT:api/professor/(:num)' => array('route' => 'Professor.Update', 'params' => array('idProfessor' => 2)),
	'DELETE:api/professor/(:num)' => array('route' => 'Professor.Delete', 'params' => array('idProfessor' => 2)),
		
	// Responsavel
	'GET:responsavels' => array('route' => 'Responsavel.ListView'),
	'GET:responsavel/(:num)' => array('route' => 'Responsavel.SingleView', 'params' => array('idResp' => 1)),
	'GET:api/responsavels' => array('route' => 'Responsavel.Query'),
	'POST:api/responsavel' => array('route' => 'Responsavel.Create'),
	'GET:api/responsavel/(:num)' => array('route' => 'Responsavel.Read', 'params' => array('idResp' => 2)),
	'PUT:api/responsavel/(:num)' => array('route' => 'Responsavel.Update', 'params' => array('idResp' => 2)),
	'DELETE:api/responsavel/(:num)' => array('route' => 'Responsavel.Delete', 'params' => array('idResp' => 2)),
		
	// Sugestoes
	'GET:sugestoeses' => array('route' => 'Sugestoes.ListView'),
	'GET:sugestoes/(:num)' => array('route' => 'Sugestoes.SingleView', 'params' => array('idSug' => 1)),
	'GET:api/sugestoeses' => array('route' => 'Sugestoes.Query'),
	'POST:api/sugestoes' => array('route' => 'Sugestoes.Create'),
	'GET:api/sugestoes/(:num)' => array('route' => 'Sugestoes.Read', 'params' => array('idSug' => 2)),
	'PUT:api/sugestoes/(:num)' => array('route' => 'Sugestoes.Update', 'params' => array('idSug' => 2)),
	'DELETE:api/sugestoes/(:num)' => array('route' => 'Sugestoes.Delete', 'params' => array('idSug' => 2)),
		
	// Turma
	'GET:turmas' => array('route' => 'Turma.ListView'),
	'GET:turma/(:num)' => array('route' => 'Turma.SingleView', 'params' => array('idTurma' => 1)),
	'GET:api/turmas' => array('route' => 'Turma.Query'),
	'POST:api/turma' => array('route' => 'Turma.Create'),
	'GET:api/turma/(:num)' => array('route' => 'Turma.Read', 'params' => array('idTurma' => 2)),
	'PUT:api/turma/(:num)' => array('route' => 'Turma.Update', 'params' => array('idTurma' => 2)),
	'DELETE:api/turma/(:num)' => array('route' => 'Turma.Delete', 'params' => array('idTurma' => 2)),

	// catch any broken API urls
	'GET:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'PUT:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'POST:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'DELETE:api/(:any)' => array('route' => 'Default.ErrorApi404')
);

/**
 * FETCHING STRATEGY
 * You may uncomment any of the lines below to specify always eager fetching.
 * Alternatively, you can copy/paste to a specific page for one-time eager fetching
 * If you paste into a controller method, replace $G_PHREEZER with $this->Phreezer
 */
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Aluno","aluno_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Atribuicao","atribuicao_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Atribuicao","atribuicao_ibfk_2",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Atribuicao","atribuicao_ibfk_3",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Calendario","calendario_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Frequencia","frequencia_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Frequencia","frequencia_ibfk_2",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("LogSis","log_sis_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Notas","notas_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Notas","notas_ibfk_2",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Observacoes","observacoes_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Observacoes","observacoes_ibfk_2",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Sugestoes","sugestoes_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
?>