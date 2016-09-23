<?php
/** @package Daviwebservice::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("MateriaMap.php");

/**
 * MateriaDAO provides object-oriented access to the materia table.  This
 * class is automatically generated by ClassBuilder.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the Model class which is extended from this DAO class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Daviwebservice::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class MateriaDAO extends Phreezable
{
	/** @var int */
	public $IdMateria;

	/** @var string */
	public $NomeMateria;

	/** @var int */
	public $IdMateriaAluno;

	/** @var int */
	public $IdMateriaProf;

	/** @var int */
	public $CargaHoraria;


	/**
	 * Returns a dataset of Frequencia objects with matching IdFrequenciaMateria
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetIdFrequenciaFrequencias($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "frequencia_ibfk_2", $criteria);
	}

	/**
	 * Returns a dataset of Notas objects with matching IdNotasMateria
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetIdNotasNotass($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "notas_ibfk_2", $criteria);
	}

	/**
	 * Returns the foreign object based on the value of IdMateriaProf
	 * @return Prof
	 */
	public function GetIdMateriaProf()
	{
		return $this->_phreezer->GetManyToOne($this, "materia_ibfk_1");
	}

	/**
	 * Returns the foreign object based on the value of IdMateriaAluno
	 * @return Aluno
	 */
	public function GetIdMateriaAluno()
	{
		return $this->_phreezer->GetManyToOne($this, "materia_ibfk_2");
	}


}
?>