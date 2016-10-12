<?php
/** @package    BANCOTCCDAVI::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Atribuicao.php");

/**
 * AtribuicaoController is the controller class for the Atribuicao object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package BANCOTCCDAVI::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class AtribuicaoController extends AppBaseController
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
	 * Displays a list view of Atribuicao objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Atribuicao records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new AtribuicaoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Atribuicao,ProfAtr,TurmaAtr,DiscAtr'
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

				$atribuicaos = $this->Phreezer->Query('Atribuicao',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $atribuicaos->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $atribuicaos->TotalResults;
				$output->totalPages = $atribuicaos->TotalPages;
				$output->pageSize = $atribuicaos->PageSize;
				$output->currentPage = $atribuicaos->CurrentPage;
			}
			else
			{
				// return all results
				$atribuicaos = $this->Phreezer->Query('Atribuicao',$criteria);
				$output->rows = $atribuicaos->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single Atribuicao record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('atribuicao');
			$atribuicao = $this->Phreezer->Get('Atribuicao',$pk);
			$this->RenderJSON($atribuicao, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Atribuicao record and render response as JSON
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

			$atribuicao = new Atribuicao($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $atribuicao->Atribuicao = $this->SafeGetVal($json, 'atribuicao');

			$atribuicao->ProfAtr = $this->SafeGetVal($json, 'profAtr');
			$atribuicao->TurmaAtr = $this->SafeGetVal($json, 'turmaAtr');
			$atribuicao->DiscAtr = $this->SafeGetVal($json, 'discAtr');

			$atribuicao->Validate();
			$errors = $atribuicao->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$atribuicao->Save();
				$this->RenderJSON($atribuicao, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Atribuicao record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('atribuicao');
			$atribuicao = $this->Phreezer->Get('Atribuicao',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $atribuicao->Atribuicao = $this->SafeGetVal($json, 'atribuicao', $atribuicao->Atribuicao);

			$atribuicao->ProfAtr = $this->SafeGetVal($json, 'profAtr', $atribuicao->ProfAtr);
			$atribuicao->TurmaAtr = $this->SafeGetVal($json, 'turmaAtr', $atribuicao->TurmaAtr);
			$atribuicao->DiscAtr = $this->SafeGetVal($json, 'discAtr', $atribuicao->DiscAtr);

			$atribuicao->Validate();
			$errors = $atribuicao->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$atribuicao->Save();
				$this->RenderJSON($atribuicao, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Atribuicao record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('atribuicao');
			$atribuicao = $this->Phreezer->Get('Atribuicao',$pk);

			$atribuicao->Delete();

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
