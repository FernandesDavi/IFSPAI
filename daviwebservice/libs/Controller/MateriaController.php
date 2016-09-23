<?php
/** @package    IFSPAI::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Materia.php");

/**
 * MateriaController is the controller class for the Materia object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package IFSPAI::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class MateriaController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code
		
		// TODO: if authentiation is required for this entire controller, for example:
		// $this->RequirePermission(ExampleUser::$PERMISSION_USER,'SecureExample.LoginForm');
	}

	/**
	 * Displays a list view of Materia objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Materia records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new MateriaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('IdMateria,NomeMateria,IdMateriaAluno,IdMateriaProf,CargaHoraria'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$materias = $this->Phreezer->Query('Materia',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $materias->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $materias->TotalResults;
				$output->totalPages = $materias->TotalPages;
				$output->pageSize = $materias->PageSize;
				$output->currentPage = $materias->CurrentPage;
			}
			else
			{
				// return all results
				$materias = $this->Phreezer->Query('Materia',$criteria);
				$output->rows = $materias->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single Materia record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idMateria');
			$materia = $this->Phreezer->Get('Materia',$pk);
			$this->RenderJSON($materia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Materia record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$materia = new Materia($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $materia->IdMateria = $this->SafeGetVal($json, 'idMateria');

			$materia->NomeMateria = $this->SafeGetVal($json, 'nomeMateria');
			$materia->IdMateriaAluno = $this->SafeGetVal($json, 'idMateriaAluno');
			$materia->IdMateriaProf = $this->SafeGetVal($json, 'idMateriaProf');
			$materia->CargaHoraria = $this->SafeGetVal($json, 'cargaHoraria');

			$materia->Validate();
			$errors = $materia->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$materia->Save();
				$this->RenderJSON($materia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Materia record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('idMateria');
			$materia = $this->Phreezer->Get('Materia',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $materia->IdMateria = $this->SafeGetVal($json, 'idMateria', $materia->IdMateria);

			$materia->NomeMateria = $this->SafeGetVal($json, 'nomeMateria', $materia->NomeMateria);
			$materia->IdMateriaAluno = $this->SafeGetVal($json, 'idMateriaAluno', $materia->IdMateriaAluno);
			$materia->IdMateriaProf = $this->SafeGetVal($json, 'idMateriaProf', $materia->IdMateriaProf);
			$materia->CargaHoraria = $this->SafeGetVal($json, 'cargaHoraria', $materia->CargaHoraria);

			$materia->Validate();
			$errors = $materia->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$materia->Save();
				$this->RenderJSON($materia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Materia record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idMateria');
			$materia = $this->Phreezer->Get('Materia',$pk);

			$materia->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>
