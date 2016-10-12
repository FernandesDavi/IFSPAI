<?php
/** @package    Bancotccdavi::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * CalendarioMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the CalendarioDAO to the calendario datastore.
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
class CalendarioMap implements IDaoMap, IDaoMap2
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
			self::$FM["IdCalendario"] = new FieldMap("IdCalendario","calendario","id_calendario",true,FM_TYPE_INT,11,null,true);
			self::$FM["Data"] = new FieldMap("Data","calendario","data",false,FM_TYPE_DATE,null,null,false);
			self::$FM["Aviso"] = new FieldMap("Aviso","calendario","aviso",false,FM_TYPE_VARCHAR,50,null,false);
			self::$FM["IdTurmaCalen"] = new FieldMap("IdTurmaCalen","calendario","id_turma_calen",false,FM_TYPE_INT,11,null,false);
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
			self::$KM["calendario_ibfk_1"] = new KeyMap("calendario_ibfk_1", "IdTurmaCalen", "Turma", "IdTurma", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>