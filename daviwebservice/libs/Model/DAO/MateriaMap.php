<?php
/** @package    Daviwebservice::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * MateriaMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the MateriaDAO to the materia datastore.
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
class MateriaMap implements IDaoMap, IDaoMap2
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
			self::$FM["IdMateria"] = new FieldMap("IdMateria","materia","id_materia",true,FM_TYPE_INT,11,null,true);
			self::$FM["NomeMateria"] = new FieldMap("NomeMateria","materia","nome_materia",false,FM_TYPE_VARCHAR,30,null,false);
			self::$FM["IdMateriaAluno"] = new FieldMap("IdMateriaAluno","materia","id_materia_aluno",false,FM_TYPE_INT,11,null,false);
			self::$FM["IdMateriaProf"] = new FieldMap("IdMateriaProf","materia","id_materia_prof",false,FM_TYPE_INT,11,null,false);
			self::$FM["CargaHoraria"] = new FieldMap("CargaHoraria","materia","carga_horaria",false,FM_TYPE_INT,11,null,false);
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
			self::$KM["frequencia_ibfk_2"] = new KeyMap("frequencia_ibfk_2", "IdMateria", "Frequencia", "IdFrequenciaMateria", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["notas_ibfk_2"] = new KeyMap("notas_ibfk_2", "IdMateria", "Notas", "IdNotasMateria", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["materia_ibfk_1"] = new KeyMap("materia_ibfk_1", "IdMateriaProf", "Prof", "IdProf", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["materia_ibfk_2"] = new KeyMap("materia_ibfk_2", "IdMateriaAluno", "Aluno", "IdAluno", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>