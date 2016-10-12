<?php
/** @package    Bancotccdavi::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Criteria.php");

/**
 * AlunoCriteria allows custom querying for the Aluno object.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the ModelCriteria class which is extended from this class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @inheritdocs
 * @package Bancotccdavi::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class AlunoCriteriaDAO extends Criteria
{

	public $IdAluno_Equals;
	public $IdAluno_NotEquals;
	public $IdAluno_IsLike;
	public $IdAluno_IsNotLike;
	public $IdAluno_BeginsWith;
	public $IdAluno_EndsWith;
	public $IdAluno_GreaterThan;
	public $IdAluno_GreaterThanOrEqual;
	public $IdAluno_LessThan;
	public $IdAluno_LessThanOrEqual;
	public $IdAluno_In;
	public $IdAluno_IsNotEmpty;
	public $IdAluno_IsEmpty;
	public $IdAluno_BitwiseOr;
	public $IdAluno_BitwiseAnd;
	public $Nome_Equals;
	public $Nome_NotEquals;
	public $Nome_IsLike;
	public $Nome_IsNotLike;
	public $Nome_BeginsWith;
	public $Nome_EndsWith;
	public $Nome_GreaterThan;
	public $Nome_GreaterThanOrEqual;
	public $Nome_LessThan;
	public $Nome_LessThanOrEqual;
	public $Nome_In;
	public $Nome_IsNotEmpty;
	public $Nome_IsEmpty;
	public $Nome_BitwiseOr;
	public $Nome_BitwiseAnd;
	public $Cpf_Equals;
	public $Cpf_NotEquals;
	public $Cpf_IsLike;
	public $Cpf_IsNotLike;
	public $Cpf_BeginsWith;
	public $Cpf_EndsWith;
	public $Cpf_GreaterThan;
	public $Cpf_GreaterThanOrEqual;
	public $Cpf_LessThan;
	public $Cpf_LessThanOrEqual;
	public $Cpf_In;
	public $Cpf_IsNotEmpty;
	public $Cpf_IsEmpty;
	public $Cpf_BitwiseOr;
	public $Cpf_BitwiseAnd;
	public $Rg_Equals;
	public $Rg_NotEquals;
	public $Rg_IsLike;
	public $Rg_IsNotLike;
	public $Rg_BeginsWith;
	public $Rg_EndsWith;
	public $Rg_GreaterThan;
	public $Rg_GreaterThanOrEqual;
	public $Rg_LessThan;
	public $Rg_LessThanOrEqual;
	public $Rg_In;
	public $Rg_IsNotEmpty;
	public $Rg_IsEmpty;
	public $Rg_BitwiseOr;
	public $Rg_BitwiseAnd;
	public $Logradouro_Equals;
	public $Logradouro_NotEquals;
	public $Logradouro_IsLike;
	public $Logradouro_IsNotLike;
	public $Logradouro_BeginsWith;
	public $Logradouro_EndsWith;
	public $Logradouro_GreaterThan;
	public $Logradouro_GreaterThanOrEqual;
	public $Logradouro_LessThan;
	public $Logradouro_LessThanOrEqual;
	public $Logradouro_In;
	public $Logradouro_IsNotEmpty;
	public $Logradouro_IsEmpty;
	public $Logradouro_BitwiseOr;
	public $Logradouro_BitwiseAnd;
	public $Cep_Equals;
	public $Cep_NotEquals;
	public $Cep_IsLike;
	public $Cep_IsNotLike;
	public $Cep_BeginsWith;
	public $Cep_EndsWith;
	public $Cep_GreaterThan;
	public $Cep_GreaterThanOrEqual;
	public $Cep_LessThan;
	public $Cep_LessThanOrEqual;
	public $Cep_In;
	public $Cep_IsNotEmpty;
	public $Cep_IsEmpty;
	public $Cep_BitwiseOr;
	public $Cep_BitwiseAnd;
	public $Numero_Equals;
	public $Numero_NotEquals;
	public $Numero_IsLike;
	public $Numero_IsNotLike;
	public $Numero_BeginsWith;
	public $Numero_EndsWith;
	public $Numero_GreaterThan;
	public $Numero_GreaterThanOrEqual;
	public $Numero_LessThan;
	public $Numero_LessThanOrEqual;
	public $Numero_In;
	public $Numero_IsNotEmpty;
	public $Numero_IsEmpty;
	public $Numero_BitwiseOr;
	public $Numero_BitwiseAnd;
	public $Complemento_Equals;
	public $Complemento_NotEquals;
	public $Complemento_IsLike;
	public $Complemento_IsNotLike;
	public $Complemento_BeginsWith;
	public $Complemento_EndsWith;
	public $Complemento_GreaterThan;
	public $Complemento_GreaterThanOrEqual;
	public $Complemento_LessThan;
	public $Complemento_LessThanOrEqual;
	public $Complemento_In;
	public $Complemento_IsNotEmpty;
	public $Complemento_IsEmpty;
	public $Complemento_BitwiseOr;
	public $Complemento_BitwiseAnd;
	public $Prontuario_Equals;
	public $Prontuario_NotEquals;
	public $Prontuario_IsLike;
	public $Prontuario_IsNotLike;
	public $Prontuario_BeginsWith;
	public $Prontuario_EndsWith;
	public $Prontuario_GreaterThan;
	public $Prontuario_GreaterThanOrEqual;
	public $Prontuario_LessThan;
	public $Prontuario_LessThanOrEqual;
	public $Prontuario_In;
	public $Prontuario_IsNotEmpty;
	public $Prontuario_IsEmpty;
	public $Prontuario_BitwiseOr;
	public $Prontuario_BitwiseAnd;
	public $IdRespAluno_Equals;
	public $IdRespAluno_NotEquals;
	public $IdRespAluno_IsLike;
	public $IdRespAluno_IsNotLike;
	public $IdRespAluno_BeginsWith;
	public $IdRespAluno_EndsWith;
	public $IdRespAluno_GreaterThan;
	public $IdRespAluno_GreaterThanOrEqual;
	public $IdRespAluno_LessThan;
	public $IdRespAluno_LessThanOrEqual;
	public $IdRespAluno_In;
	public $IdRespAluno_IsNotEmpty;
	public $IdRespAluno_IsEmpty;
	public $IdRespAluno_BitwiseOr;
	public $IdRespAluno_BitwiseAnd;

}

?>