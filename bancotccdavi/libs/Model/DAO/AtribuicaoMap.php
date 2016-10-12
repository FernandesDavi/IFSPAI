<?php
/** @package    Bancotccdavi::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * AtribuicaoMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the AtribuicaoDAO to the atribuicao datastore.
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
class AtribuicaoMap implements IDaoMap, IDaoMap2
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
			self::$FM["Atribuicao"] = new FieldMap("Atribuicao","atribuicao","id_atribuicao",true,FM_TYPE_INT,11,null,true);
			self::$FM["ProfAtr"] = new FieldMap("ProfAtr","atribuicao","id_prof_atr",false,FM_TYPE_INT,11,null,false);
			self::$FM["TurmaAtr"] = new FieldMap("TurmaAtr","atribuicao","id_turma_atr",false,FM_TYPE_INT,11,null,false);
			self::$FM["DiscAtr"] = new FieldMap("DiscAtr","atribuicao","id_disc_atr",false,FM_TYPE_INT,11,null,false);
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
			self::$KM["frequencia_ibfk_2"] = new KeyMap("frequencia_ibfk_2", "Atribuicao", "Frequencia", "IdAtribuicaoFreq", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["notas_ibfk_2"] = new KeyMap("notas_ibfk_2", "Atribuicao", "Notas", "IdAtribuicaoNotas", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["atribuicao_ibfk_1"] = new KeyMap("atribuicao_ibfk_1", "ProfAtr", "Professor", "IdProfessor", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["atribuicao_ibfk_2"] = new KeyMap("atribuicao_ibfk_2", "TurmaAtr", "Turma", "IdTurma", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["atribuicao_ibfk_3"] = new KeyMap("atribuicao_ibfk_3", "DiscAtr", "Disciplina", "IdDisc", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>