<?php
/** @package    IFSPAI::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Notas.php");

/**
 * NotasController is the controller class for the Notas object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package IFSPAI::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class NotasController extends AppBaseController
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
	 * Displays a list view of Notas objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Notas records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new NotasCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('IdNotas,AvaliacaoNome,Datas,Calculo,Nota,IdNotasAluno,IdNotasMateria'
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

				$notases = $this->Phreezer->Query('Notas',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $notases->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $notases->TotalResults;
				$output->totalPages = $notases->TotalPages;
				$output->pageSize = $notases->PageSize;
				$output->currentPage = $notases->CurrentPage;
			}
			else
			{
				// return all results
				$notases = $this->Phreezer->Query('Notas',$criteria);
				$output->rows = $notases->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single Notas record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idNotas');
			$notas = $this->Phreezer->Get('Notas',$pk);
			$this->RenderJSON($notas, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Notas record and render response as JSON
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

			$notas = new Notas($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $notas->IdNotas = $this->SafeGetVal($json, 'idNotas');

			$notas->AvaliacaoNome = $this->SafeGetVal($json, 'avaliacaoNome');
			$notas->Datas = $this->SafeGetVal($json, 'datas');
			$notas->Calculo = $this->SafeGetVal($json, 'calculo');
			$notas->Nota = $this->SafeGetVal($json, 'nota');
			$notas->IdNotasAluno = $this->SafeGetVal($json, 'idNotasAluno');
			$notas->IdNotasMateria = $this->SafeGetVal($json, 'idNotasMateria');

			$notas->Validate();
			$errors = $notas->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$notas->Save();
				$this->RenderJSON($notas, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Notas record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idNotas');
			$notas = $this->Phreezer->Get('Notas',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $notas->IdNotas = $this->SafeGetVal($json, 'idNotas', $notas->IdNotas);

			$notas->AvaliacaoNome = $this->SafeGetVal($json, 'avaliacaoNome', $notas->AvaliacaoNome);
			$notas->Datas = $this->SafeGetVal($json, 'datas', $notas->Datas);
			$notas->Calculo = $this->SafeGetVal($json, 'calculo', $notas->Calculo);
			$notas->Nota = $this->SafeGetVal($json, 'nota', $notas->Nota);
			$notas->IdNotasAluno = $this->SafeGetVal($json, 'idNotasAluno', $notas->IdNotasAluno);
			$notas->IdNotasMateria = $this->SafeGetVal($json, 'idNotasMateria', $notas->IdNotasMateria);

			$notas->Validate();
			$errors = $notas->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$notas->Save();
				$this->RenderJSON($notas, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Notas record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idNotas');
			$notas = $this->Phreezer->Get('Notas',$pk);

			$notas->Delete();

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
