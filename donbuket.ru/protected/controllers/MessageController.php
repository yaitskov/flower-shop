<?php

class MessageController extends Controller
{
  public $mytime;
  public function actionHelloWorld()
  {
    $this->mytime = $theTime = date('d.j.Y H:s');

    $this->render('helloWorld' ); //, array ( 'time' => $theTime ) );
  }
  public function actionGoodBye()
  {
    $this->render('bayPiece');
  }

  public function actionIndex()
  {
    $this->actionGoodBye();
  }

	// -----------------------------------------------------------
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}