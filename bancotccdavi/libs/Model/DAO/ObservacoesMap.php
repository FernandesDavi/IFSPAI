<?php
/** @package    Bancotccdavi::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * ObservacoesMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the ObservacoesDAO to the observacoes datastore.
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
class ObservacoesMap implements IDaoMap, IDaoMap2
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
			self::$FM["IdObs"] = new FieldMap("IdObs","observacoes","id_obs",true,FM_TYPE_INT,11,null,true);
			self::$FM["Observacoes"] = new FieldMap("Observacoes","observacoes","observacoes",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["IdAlunoObs"] = new FieldMap("IdAlunoObs","observacoes","id_aluno_obs",false,FM_TYPE_INT,11,null,false);
			self::$FM["IdRespObs"] = new FieldMap("IdRespObs","observacoes","id_resp_obs",false,FM_TYPE_INT,11,null,false);
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
			self::$KM["observacoes_ibfk_1"] = new KeyMap("observacoes_ibfk_1", "IdAlunoObs", "Aluno", "IdAluno", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["observacoes_ibfk_2"] = new KeyMap("observacoes_ibfk_2", "IdRespObs", "Responsavel", "IdResp", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>