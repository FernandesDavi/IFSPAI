<?php
/** @package    IFSPAI::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Aluno.php");

/**
 * AlunoController is the controller class for the Aluno object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package IFSPAI::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class AlunoController extends AppBaseController
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
	 * Displays a list view of Aluno objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Aluno records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new AlunoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('IdAluno,NomeAluno,Prontuario,IdAlunoResp'
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

				$alunos = $this->Phreezer->Query('Aluno',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $alunos->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $alunos->TotalResults;
				$output->totalPages = $alunos->TotalPages;
				$output->pageSize = $alunos->PageSize;
				$output->currentPage = $alunos->CurrentPage;
			}
			else
			{
				// return all results
				$alunos = $this->Phreezer->Query('Aluno',$criteria);
				$output->rows = $alunos->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single Aluno record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idAluno');
			$aluno = $this->Phreezer->Get('Aluno',$pk);
			$this->RenderJSON($aluno, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Aluno record and render response as JSON
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

			$aluno = new Aluno($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $aluno->IdAluno = $this->SafeGetVal($json, 'idAluno');

			$aluno->NomeAluno = $this->SafeGetVal($json, 'nomeAluno');
			$aluno->Prontuario = $this->SafeGetVal($json, 'prontuario');
			$aluno->IdAlunoResp = $this->SafeGetVal($json, 'idAlunoResp');

			$aluno->Validate();
			$errors = $aluno->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$aluno->Save();
				$this->RenderJSON($aluno, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Aluno record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idAluno');
			$aluno = $this->Phreezer->Get('Aluno',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $aluno->IdAluno = $this->SafeGetVal($json, 'idAluno', $aluno->IdAluno);

			$aluno->NomeAluno = $this->SafeGetVal($json, 'nomeAluno', $aluno->NomeAluno);
			$aluno->Prontuario = $this->SafeGetVal($json, 'prontuario', $aluno->Prontuario);
			$aluno->IdAlunoResp = $this->SafeGetVal($json, 'idAlunoResp', $aluno->IdAlunoResp);

			$aluno->Validate();
			$errors = $aluno->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$aluno->Save();
				$this->RenderJSON($aluno, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Aluno record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idAluno');
			$aluno = $this->Phreezer->Get('Aluno',$pk);

			$aluno->Delete();

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
