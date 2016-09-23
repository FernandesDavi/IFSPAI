<?php
/** @package    IFSPAI::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Frequencia.php");

/**
 * FrequenciaController is the controller class for the Frequencia object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package IFSPAI::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class FrequenciaController extends AppBaseController
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
	 * Displays a list view of Frequencia objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Frequencia records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new FrequenciaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('IdFrequencia,Frequencia,Dia,AulaDada,IdFrequenciaAluno,IdFrequenciaMateria'
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

				$frequencias = $this->Phreezer->Query('Frequencia',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $frequencias->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $frequencias->TotalResults;
				$output->totalPages = $frequencias->TotalPages;
				$output->pageSize = $frequencias->PageSize;
				$output->currentPage = $frequencias->CurrentPage;
			}
			else
			{
				// return all results
				$frequencias = $this->Phreezer->Query('Frequencia',$criteria);
				$output->rows = $frequencias->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single Frequencia record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idFrequencia');
			$frequencia = $this->Phreezer->Get('Frequencia',$pk);
			$this->RenderJSON($frequencia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Frequencia record and render response as JSON
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

			$frequencia = new Frequencia($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $frequencia->IdFrequencia = $this->SafeGetVal($json, 'idFrequencia');

			$frequencia->Frequencia = $this->SafeGetVal($json, 'frequencia');
			$frequencia->Dia = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dia')));
			$frequencia->AulaDada = $this->SafeGetVal($json, 'aulaDada');
			$frequencia->IdFrequenciaAluno = $this->SafeGetVal($json, 'idFrequenciaAluno');
			$frequencia->IdFrequenciaMateria = $this->SafeGetVal($json, 'idFrequenciaMateria');

			$frequencia->Validate();
			$errors = $frequencia->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$frequencia->Save();
				$this->RenderJSON($frequencia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Frequencia record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idFrequencia');
			$frequencia = $this->Phreezer->Get('Frequencia',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $frequencia->IdFrequencia = $this->SafeGetVal($json, 'idFrequencia', $frequencia->IdFrequencia);

			$frequencia->Frequencia = $this->SafeGetVal($json, 'frequencia', $frequencia->Frequencia);
			$frequencia->Dia = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dia', $frequencia->Dia)));
			$frequencia->AulaDada = $this->SafeGetVal($json, 'aulaDada', $frequencia->AulaDada);
			$frequencia->IdFrequenciaAluno = $this->SafeGetVal($json, 'idFrequenciaAluno', $frequencia->IdFrequenciaAluno);
			$frequencia->IdFrequenciaMateria = $this->SafeGetVal($json, 'idFrequenciaMateria', $frequencia->IdFrequenciaMateria);

			$frequencia->Validate();
			$errors = $frequencia->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$frequencia->Save();
				$this->RenderJSON($frequencia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Frequencia record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idFrequencia');
			$frequencia = $this->Phreezer->Get('Frequencia',$pk);

			$frequencia->Delete();

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
