<?php
class BannersController extends Controller
{
	function BannersController()
	{
		parent::__construct();
	}

	function display()
	{
 	}

		function click()
	{
		$bid = intval($_REQUEST['bid']);
		if ($bid)
		{
			$model = &$this->getModel( 'Banner' );
			$model->click( $bid );
			$this->redirect( $model->getUrl( $bid ) );
		}
	}
}
?>