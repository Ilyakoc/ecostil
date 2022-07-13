<?php
/**
 * Системные настройки
 *
 */
use YiiHelper as Y;
use AttributeHelper as A;

class SystemController extends DevadminController
{
	public $layout = "column2";
	
	public function actionIndex()
	{
		if (!function_exists('curl_init')) {
			throw new CException('Curl not found');
		}
		
		if(!D::role('sadmin')) 
			throw new \CHttpException(403);
			
		try {
			if(Y::request()->isPostRequest) {
					$modules=Y::request()->getPost('modules');
						$data=array();
						foreach($modules as $name=>$active) $data[$name]=true;
						
						file_put_contents(
							Yii::getPathOfAlias('application.config').DS.'modules.php',
							'<?php return '.A::toPHPString($data)
						);
						
						Yii::app()->user->setFlash('success', 'Изменения успешно приняты');
						$this->refresh(true);
			}
		} 
		catch(Exception $e) {
			Yii::app()->user->setFlash('error', $e->getMessage());
		}
		
		$this->render('index');
	}

}
