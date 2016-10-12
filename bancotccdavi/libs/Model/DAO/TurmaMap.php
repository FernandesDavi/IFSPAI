<?php
/** @package    Bancotccdavi::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * TurmaMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the TurmaDAO to the turma datastore.
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
class TurmaMap implements IDaoMap, IDaoMap2
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
			self::$FM["IdTurma"] = new FieldMap("IdTurma","turma","id_turma",true,FM_TYPE_INT,11,null,true);
			self::$FM["Turma"] = new FieldMap("Turma","turma","turma",false,FM_TYPE_VARCHAR,40,null,false);
			self::$FM["Sala"] = new FieldMap("Sala","turma","sala",false,FM_TYPE_VARCHAR,20,null,false);
			self::$FM["Ano"] = new FieldMap("Ano","turma","ano",false,FM_TYPE_INT,11,null,false);
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
			self::$KM["atribuicao_ibfk_2"] = new KeyMap("atribuicao_ibfk_2", "IdTurma", "Atribuicao", "TurmaAtr", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["calendario_ibfk_1"] = new KeyMap("calendario_ibfk_1", "IdTurma", "Calendario", "IdTurmaCalen", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return self::$KM;
	}

}

?>