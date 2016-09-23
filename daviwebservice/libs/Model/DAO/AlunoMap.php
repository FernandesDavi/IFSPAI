<?php
/** @package    Daviwebservice::Model::DAO */

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
 * @package Daviwebservice::Model::DAO
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
			self::$FM["NomeAluno"] = new FieldMap("NomeAluno","aluno","nome_aluno",false,FM_TYPE_VARCHAR,50,null,false);
			self::$FM["Prontuario"] = new FieldMap("Prontuario","aluno","prontuario",false,FM_TYPE_INT,11,null,false);
			self::$FM["IdAlunoResp"] = new FieldMap("IdAlunoResp","aluno","id_aluno_resp",false,FM_TYPE_INT,11,null,false);
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
			self::$KM["frequencia_ibfk_1"] = new KeyMap("frequencia_ibfk_1", "IdAluno", "Frequencia", "IdFrequenciaAluno", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["login_ibfk_1"] = new KeyMap("login_ibfk_1", "IdAluno", "Login", "IdLoginAluno", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["materia_ibfk_2"] = new KeyMap("materia_ibfk_2", "IdAluno", "Materia", "IdMateriaAluno", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["notas_ibfk_1"] = new KeyMap("notas_ibfk_1", "IdAluno", "Notas", "IdNotasAluno", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["aluno_ibfk_1"] = new KeyMap("aluno_ibfk_1", "IdAlunoResp", "Responsavel", "IdResp", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>