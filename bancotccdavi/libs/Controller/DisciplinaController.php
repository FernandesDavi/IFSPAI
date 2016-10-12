<?php
/** @package    BANCOTCCDAVI::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Disciplina.php");

/**
 * DisciplinaController is the controller class for the Disciplina object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package BANCOTCCDAVI::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class DisciplinaController extends AppBaseController
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
	 * Displays a list view of Disciplina objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Disciplina records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new DisciplinaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('IdDisc,Nome,CargaHoraria'
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

				$disciplinas = $this->Phreezer->Query('Disciplina',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $disciplinas->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $disciplinas->TotalResults;
				$output->totalPages = $disciplinas->TotalPages;
				$output->pageSize = $disciplinas->PageSize;
				$output->currentPage = $disciplinas->CurrentPage;
			}
			else
			{
				// return all results
				$disciplinas = $this->Phreezer->Query('Disciplina',$criteria);
				$output->rows = $disciplinas->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single Disciplina record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idDisc');
			$disciplina = $this->Phreezer->Get('Disciplina',$pk);
			$this->RenderJSON($disciplina, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Disciplina record and render response as JSON
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

			$disciplina = new Disciplina($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $disciplina->IdDisc = $this->SafeGetVal($json, 'idDisc');

			$disciplina->Nome = $this->SafeGetVal($json, 'nome');
			$disciplina->CargaHoraria = $this->SafeGetVal($json, 'cargaHoraria');

			$disciplina->Validate();
			$errors = $disciplina->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$disciplina->Save();
				$this->RenderJSON($disciplina, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Disciplina record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idDisc');
			$disciplina = $this->Phreezer->Get('Disciplina',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $disciplina->IdDisc = $this->SafeGetVal($json, 'idDisc', $disciplina->IdDisc);

			$disciplina->Nome = $this->SafeGetVal($json, 'nome', $disciplina->Nome);
			$disciplina->CargaHoraria = $this->SafeGetVal($json, 'cargaHoraria', $disciplina->CargaHoraria);

			$disciplina->Validate();
			$errors = $disciplina->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$disciplina->Save();
				$this->RenderJSON($disciplina, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Disciplina record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idDisc');
			$disciplina = $this->Phreezer->Get('Disciplina',$pk);

			$disciplina->Delete();

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
