<?php
/** @package    Bancotccdavi::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Criteria.php");

/**
 * ResponsavelCriteria allows custom querying for the Responsavel object.
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
class ResponsavelCriteriaDAO extends Criteria
{

	public $IdResp_Equals;
	public $IdResp_NotEquals;
	public $IdResp_IsLike;
	public $IdResp_IsNotLike;
	public $IdResp_BeginsWith;
	public $IdResp_EndsWith;
	public $IdResp_GreaterThan;
	public $IdResp_GreaterThanOrEqual;
	public $IdResp_LessThan;
	public $IdResp_LessThanOrEqual;
	public $IdResp_In;
	public $IdResp_IsNotEmpty;
	public $IdResp_IsEmpty;
	public $IdResp_BitwiseOr;
	public $IdResp_BitwiseAnd;
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
	public $Usuario_Equals;
	public $Usuario_NotEquals;
	public $Usuario_IsLike;
	public $Usuario_IsNotLike;
	public $Usuario_BeginsWith;
	public $Usuario_EndsWith;
	public $Usuario_GreaterThan;
	public $Usuario_GreaterThanOrEqual;
	public $Usuario_LessThan;
	public $Usuario_LessThanOrEqual;
	public $Usuario_In;
	public $Usuario_IsNotEmpty;
	public $Usuario_IsEmpty;
	public $Usuario_BitwiseOr;
	public $Usuario_BitwiseAnd;
	public $Senha_Equals;
	public $Senha_NotEquals;
	public $Senha_IsLike;
	public $Senha_IsNotLike;
	public $Senha_BeginsWith;
	public $Senha_EndsWith;
	public $Senha_GreaterThan;
	public $Senha_GreaterThanOrEqual;
	public $Senha_LessThan;
	public $Senha_LessThanOrEqual;
	public $Senha_In;
	public $Senha_IsNotEmpty;
	public $Senha_IsEmpty;
	public $Senha_BitwiseOr;
	public $Senha_BitwiseAnd;

}

?>