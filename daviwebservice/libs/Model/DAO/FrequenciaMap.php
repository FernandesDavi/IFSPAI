<?php
/** @package    Daviwebservice::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * FrequenciaMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the FrequenciaDAO to the frequencia datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Daviwebservice::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class FrequenciaMap implements IDaoMap, IDaoMap2
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
			self::$FM["IdFrequencia"] = new FieldMap("IdFrequencia","frequencia","id_frequencia",true,FM_TYPE_INT,11,null,true);
			self::$FM["Frequencia"] = new FieldMap("Frequencia","frequencia","frequencia",false,FM_TYPE_CHAR,1,null,false);
			self::$FM["Dia"] = new FieldMap("Dia","frequencia","dia",false,FM_TYPE_DATE,null,null,false);
			self::$FM["AulaDada"] = new FieldMap("AulaDada","frequencia","aula_dada",false,FM_TYPE_INT,11,null,false);
			self::$FM["IdFrequenciaAluno"] = new FieldMap("IdFrequenciaAluno","frequencia","id_frequencia_aluno",false,FM_TYPE_INT,11,null,false);
			self::$FM["IdFrequenciaMateria"] = new FieldMap("IdFrequenciaMateria","frequencia","id_frequencia_materia",false,FM_TYPE_INT,11,null,false);
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
			self::$KM["frequencia_ibfk_1"] = new KeyMap("frequencia_ibfk_1", "IdFrequenciaAluno", "Aluno", "IdAluno", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["frequencia_ibfk_2"] = new KeyMap("frequencia_ibfk_2", "IdFrequenciaMateria", "Materia", "IdMateria", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>