<?php
/** @package    Bancotccdavi::Reporter */

/** import supporting libraries */
require_once("verysimple/Phreeze/Reporter.php");

/**
 * This is an example Reporter based on the Responsavel object.  The reporter object
 * allows you to run arbitrary queries that return data which may or may not fith within
 * the data access API.  This can include aggregate data or subsets of data.
 *
 * Note that Reporters are read-only and cannot be used for saving data.
 *
 * @package Bancotccdavi::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class ResponsavelReporter extends Reporter
{

	// the properties in this class must match the columns returned by GetCustomQuery().
	// 'CustomFieldExample' is an example that is not part of the `responsavel` table
	public $CustomFieldExample;

	public $IdResp;
	public $Nome;
	public $Cpf;
	public $Rg;
	public $Logradouro;
	public $Cep;
	public $Numero;
	public $Complemento;
	public $Usuario;
	public $Senha;

	/*
	* GetCustomQuery returns a fully formed SQL statement.  The result columns
	* must match with the properties of this reporter object.
	*
	* @see Reporter::GetCustomQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomQuery($criteria)
	{
		$sql = "select
			'custom value here...' as CustomFieldExample
			,`responsavel`.`id_resp` as IdResp
			,`responsavel`.`nome` as Nome
			,`responsavel`.`cpf` as Cpf
			,`responsavel`.`rg` as Rg
			,`responsavel`.`logradouro` as Logradouro
			,`responsavel`.`cep` as Cep
			,`responsavel`.`numero` as Numero
			,`responsavel`.`complemento` as Complemento
			,`responsavel`.`usuario` as Usuario
			,`responsavel`.`senha` as Senha
		from `responsavel`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();
		$sql .= $criteria->GetOrder();

		return $sql;
	}
	
	/*
	* GetCustomCountQuery returns a fully formed SQL statement that will count
	* the results.  This query must return the correct number of results that
	* GetCustomQuery would, given the same criteria
	*
	* @see Reporter::GetCustomCountQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomCountQuery($criteria)
	{
		$sql = "select count(1) as counter from `responsavel`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();

		return $sql;
	}
}

?>