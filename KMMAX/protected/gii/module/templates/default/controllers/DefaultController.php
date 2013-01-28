<?php echo "<?php\n"; ?>

class DefaultController extends AppController
{
	public function actionIndex()
	{
		$this->render('index');
	}
}