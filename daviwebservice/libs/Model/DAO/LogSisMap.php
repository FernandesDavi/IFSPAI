<?php
/** @package    Daviwebservice::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * LogSisMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the LogSisDAO to the log_sis datastore.
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
class LogSisMap implements IDaoMap, IDaoMap2
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
			self::$FM["Id"] = new FieldMap("Id","log_sis","id",true,FM_TYPE_INT,11,null,true);
			self::$FM["IoEs"] = new FieldMap("IoEs","log_sis","io_es",false,FM_TYPE_INT,11,null,false);
			self::$FM["UsuarioId"] = new FieldMap("UsuarioId","log_sis","usuario_id",false,FM_TYPE_INT,11,null,false);
			self::$FM["DataHora"] = new FieldMap("DataHora","log_sis","data_hora",false,FM_TYPE_DATETIME,null,"CURRENT_TIMESTAMP",false);
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
			self::$KM["log_sis_ibfk_1"] = new KeyMap("log_sis_ibfk_1", "UsuarioId", "Responsavel", "IdResp", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>