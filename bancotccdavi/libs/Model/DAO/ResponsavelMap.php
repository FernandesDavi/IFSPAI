<?php
/** @package    Bancotccdavi::Model::DAO */

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
 * @package Bancotccdavi::Model::DAO
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
			self::$FM["Nome"] = new FieldMap("Nome","responsavel","nome",false,FM_TYPE_VARCHAR,100,null,false);
			self::$FM["Cpf"] = new FieldMap("Cpf","responsavel","cpf",false,FM_TYPE_VARCHAR,15,null,false);
			self::$FM["Rg"] = new FieldMap("Rg","responsavel","rg",false,FM_TYPE_VARCHAR,13,null,false);
			self::$FM["Logradouro"] = new FieldMap("Logradouro","responsavel","logradouro",false,FM_TYPE_VARCHAR,30,null,false);
			self::$FM["Cep"] = new FieldMap("Cep","responsavel","cep",false,FM_TYPE_VARCHAR,20,null,false);
			self::$FM["Numero"] = new FieldMap("Numero","responsavel","numero",false,FM_TYPE_INT,11,null,false);
			self::$FM["Complemento"] = new FieldMap("Complemento","responsavel","complemento",false,FM_TYPE_VARCHAR,20,null,false);
			self::$FM["Usuario"] = new FieldMap("Usuario","responsavel","usuario",false,FM_TYPE_VARCHAR,50,null,false);
			self::$FM["Senha"] = new FieldMap("Senha","responsavel","senha",false,FM_TYPE_VARCHAR,30,null,false);
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
			self::$KM["aluno_ibfk_1"] = new KeyMap("aluno_ibfk_1", "IdResp", "Aluno", "IdRespAluno", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["log_sis_ibfk_1"] = new KeyMap("log_sis_ibfk_1", "IdResp", "LogSis", "UsuarioId", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["observacoes_ibfk_2"] = new KeyMap("observacoes_ibfk_2", "IdResp", "Observacoes", "IdRespObs", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["sugestoes_ibfk_1"] = new KeyMap("sugestoes_ibfk_1", "IdResp", "Sugestoes", "IdRespSug", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return self::$KM;
	}

}

?>