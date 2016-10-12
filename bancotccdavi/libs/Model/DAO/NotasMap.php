<?php
/** @package    Bancotccdavi::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * NotasMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the NotasDAO to the notas datastore.
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
class NotasMap implements IDaoMap, IDaoMap2
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
			self::$FM["IdNotas"] = new FieldMap("IdNotas","notas","id_notas",true,FM_TYPE_INT,11,null,true);
			self::$FM["AvaliacaoNome"] = new FieldMap("AvaliacaoNome","notas","avaliacao_nome",false,FM_TYPE_VARCHAR,50,null,false);
			self::$FM["Datas"] = new FieldMap("Datas","notas","datas",false,FM_TYPE_DATE,null,null,false);
			self::$FM["Calculo"] = new FieldMap("Calculo","notas","calculo",false,FM_TYPE_VARCHAR,30,null,false);
			self::$FM["Nota"] = new FieldMap("Nota","notas","nota",false,FM_TYPE_FLOAT,null,null,false);
			self::$FM["IdAlunoNotas"] = new FieldMap("IdAlunoNotas","notas","id_aluno_notas",false,FM_TYPE_INT,11,null,false);
			self::$FM["IdAtribuicaoNotas"] = new FieldMap("IdAtribuicaoNotas","notas","id_atribuicao_notas",false,FM_TYPE_INT,11,null,false);
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
			self::$KM["notas_ibfk_1"] = new KeyMap("notas_ibfk_1", "IdAlunoNotas", "Aluno", "IdAluno", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["notas_ibfk_2"] = new KeyMap("notas_ibfk_2", "IdAtribuicaoNotas", "Atribuicao", "Atribuicao", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>