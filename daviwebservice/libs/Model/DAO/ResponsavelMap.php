<?php
/** @package    Daviwebservice::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * ResponsavelMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the ResponsavelDAO to the responsavel datastore.
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
class ResponsavelMap implements IDaoMap, IDaoMap2
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
			self::$FM["IdResp"] = new FieldMap("IdResp","responsavel","id_resp",true,FM_TYPE_INT,11,null,true);
			self::$FM["Nome"] = new FieldMap("Nome","responsavel","nome",false,FM_TYPE_VARCHAR,30,null,false);
			self::$FM["Endereco"] = new FieldMap("Endereco","responsavel","endereco",false,FM_TYPE_VARCHAR,45,null,false);
			self::$FM["Cpf"] = new FieldMap("Cpf","responsavel","cpf",false,FM_TYPE_VARCHAR,20,null,false);
			self::$FM["Rg"] = new FieldMap("Rg","responsavel","rg",false,FM_TYPE_VARCHAR,15,null,false);
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
			self::$KM["aluno_ibfk_1"] = new KeyMap("aluno_ibfk_1", "IdResp", "Aluno", "IdAlunoResp", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["log_sis_ibfk_1"] = new KeyMap("log_sis_ibfk_1", "IdResp", "LogSis", "UsuarioId", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return self::$KM;
	}

}

?>