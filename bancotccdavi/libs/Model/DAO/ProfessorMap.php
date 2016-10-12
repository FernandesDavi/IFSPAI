<?php
/** @package    Bancotccdavi::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * ProfessorMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the ProfessorDAO to the professor datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Bancotccdavi::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class ProfessorMap implements IDaoMap, IDaoMap2
{

	private static $KM;
	private static $FM;
	
	/**
	 * {@inheritdoc}
	 */
	public static function AddMap($property,FieldMap $map)
	{
		self::GetFieldMaps();
		self::$FM[$property] = $map;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function SetFetchingStrategy($property,$loadType)
	{
		self::GetKeyMaps();
		self::$KM[$property]->LoadType = $loadType;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetFieldMaps()
	{
		if (self::$FM == null)
		{
			self::$FM = Array();
			self::$FM["IdProfessor"] = new FieldMap("IdProfessor","professor","id_professor",true,FM_TYPE_INT,11,null,true);
			self::$FM["Nome"] = new FieldMap("Nome","professor","nome",false,FM_TYPE_VARCHAR,100,null,false);
			self::$FM["Cpf"] = new FieldMap("Cpf","professor","cpf",false,FM_TYPE_VARCHAR,15,null,false);
			self::$FM["Rg"] = new FieldMap("Rg","professor","rg",false,FM_TYPE_VARCHAR,13,null,false);
			self::$FM["Logradouro"] = new FieldMap("Logradouro","professor","logradouro",false,FM_TYPE_VARCHAR,30,null,false);
			self::$FM["Cep"] = new FieldMap("Cep","professor","cep",false,FM_TYPE_VARCHAR,20,null,false);
			self::$FM["Numero"] = new FieldMap("Numero","professor","numero",false,FM_TYPE_INT,11,null,false);
			self::$FM["Complemento"] = new FieldMap("Complemento","professor","complemento",false,FM_TYPE_VARCHAR,20,null,false);
			self::$FM["Prontuario"] = new FieldMap("Prontuario","professor","prontuario",false,FM_TYPE_INT,11,null,false);
		}
		return self::$FM;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetKeyMaps()
	{
		if (self::$KM == null)
		{
			self::$KM = Array();
			self::$KM["atribuicao_ibfk_1"] = new KeyMap("atribuicao_ibfk_1", "IdProfessor", "Atribuicao", "ProfAtr", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return self::$KM;
	}

}

?>