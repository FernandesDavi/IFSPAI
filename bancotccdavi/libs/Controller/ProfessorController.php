<?php
/** @package    BANCOTCCDAVI::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Professor.php");

/**
 * ProfessorController is the controller class for the Professor object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package BANCOTCCDAVI::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class ProfessorController extends AppBaseController
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
	 * Displays a list view of Professor objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Professor records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new ProfessorCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('IdProfessor,Nome,Cpf,Rg,Logradouro,Cep,Numero,Complemento,Prontuario'
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

				$professors = $this->Phreezer->Query('Professor',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $professors->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $professors->TotalResults;
				$output->totalPages = $professors->TotalPages;
				$output->pageSize = $professors->PageSize;
				$output->currentPage = $professors->CurrentPage;
			}
			else
			{
				// return all results
				$professors = $this->Phreezer->Query('Professor',$criteria);
				$output->rows = $professors->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single Professor record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idProfessor');
			$professor = $this->Phreezer->Get('Professor',$pk);
			$this->RenderJSON($professor, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Professor record and render response as JSON
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

			$professor = new Professor($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $professor->IdProfessor = $this->SafeGetVal($json, 'idProfessor');

			$professor->Nome = $this->SafeGetVal($json, 'nome');
			$professor->Cpf = $this->SafeGetVal($json, 'cpf');
			$professor->Rg = $this->SafeGetVal($json, 'rg');
			$professor->Logradouro = $this->SafeGetVal($json, 'logradouro');
			$professor->Cep = $this->SafeGetVal($json, 'cep');
			$professor->Numero = $this->SafeGetVal($json, 'numero');
			$professor->Complemento = $this->SafeGetVal($json, 'complemento');
			$professor->Prontuario = $this->SafeGetVal($json, 'prontuario');

			$professor->Validate();
			$errors = $professor->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$professor->Save();
				$this->RenderJSON($professor, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Professor record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idProfessor');
			$professor = $this->Phreezer->Get('Professor',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $professor->IdProfessor = $this->SafeGetVal($json, 'idProfessor', $professor->IdProfessor);

			$professor->Nome = $this->SafeGetVal($json, 'nome', $professor->Nome);
			$professor->Cpf = $this->SafeGetVal($json, 'cpf', $professor->Cpf);
			$professor->Rg = $this->SafeGetVal($json, 'rg', $professor->Rg);
			$professor->Logradouro = $this->SafeGetVal($json, 'logradouro', $professor->Logradouro);
			$professor->Cep = $this->SafeGetVal($json, 'cep', $professor->Cep);
			$professor->Numero = $this->SafeGetVal($json, 'numero', $professor->Numero);
			$professor->Complemento = $this->SafeGetVal($json, 'complemento', $professor->Complemento);
			$professor->Prontuario = $this->SafeGetVal($json, 'prontuario', $professor->Prontuario);

			$professor->Validate();
			$errors = $professor->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$professor->Save();
				$this->RenderJSON($professor, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Professor record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idProfessor');
			$professor = $this->Phreezer->Get('Professor',$pk);

			$professor->Delete();

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
