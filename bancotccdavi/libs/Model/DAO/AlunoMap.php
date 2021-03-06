<?php
/** @package    Bancotccdavi::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * AlunoMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the AlunoDAO to the aluno datastore.
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
class AlunoMap implements IDaoMap, IDaoMap2
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
			self::$FM["IdAluno"] = new FieldMap("IdAluno","aluno","id_aluno",true,FM_TYPE_INT,11,null,true);
			self::$FM["Nome"] = new FieldMap("Nome","aluno","nome",false,FM_TYPE_VARCHAR,100,null,false);
			self::$FM["Cpf"] = new FieldMap("Cpf","aluno","cpf",false,FM_TYPE_VARCHAR,15,null,false);
			self::$FM["Rg"] = new FieldMap("Rg","aluno","rg",false,FM_TYPE_VARCHAR,13,null,false);
			self::$FM["Logradouro"] = new FieldMap("Logradouro","aluno","logradouro",false,FM_TYPE_VARCHAR,30,null,false);
			self::$FM["Cep"] = new FieldMap("Cep","aluno","cep",false,FM_TYPE_VARCHAR,20,null,false);
			self::$FM["Numero"] = new FieldMap("Numero","aluno","numero",false,FM_TYPE_INT,11,null,false);
			self::$FM["Complemento"] = new FieldMap("Complemento","aluno","complemento",false,FM_TYPE_VARCHAR,20,null,false);
			self::$FM["Prontuario"] = new FieldMap("Prontuario","aluno","prontuario",false,FM_TYPE_INT,11,null,false);
			self::$FM["IdRespAluno"] = new FieldMap("IdRespAluno","aluno","id_resp_aluno",false,FM_TYPE_INT,11,null,false);
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
			self::$KM["frequencia_ibfk_1"] = new KeyMap("frequencia_ibfk_1", "IdAluno", "Frequencia", "IdAlunoFreq", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["notas_ibfk_1"] = new KeyMap("notas_ibfk_1", "IdAluno", "Notas", "IdAlunoNotas", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["observacoes_ibfk_1"] = new KeyMap("observacoes_ibfk_1", "IdAluno", "Observacoes", "IdAlunoObs", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["aluno_ibfk_1"] = new KeyMap("aluno_ibfk_1", "IdRespAluno", "Responsavel", "IdResp", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>