<?php
/**
 * Действие удаления картинки
 *
 */
namespace iblock\actions;

use common\components\helpers\HRequest as R;
use iblock\components\InfoBlockHelper;
use iblock\models\InfoBlockElementProp;

class RemoveFileAction extends \CAction
{
	/**
	 * @var string имя поведения \common\ext\file\behaviors\FileBehavior;
	 * По умолчанию "fileBehavior" 
	 */
    public $behaviorName='fileBehavior';
    
    /**
	 * @var boolean действие вызывается через ajax-запрос. По умолчанию (FALSE) нет. 
	 */
	public $ajaxMode=false;
	
	/**
	 * @var string URL перенаправления после удаления. Используется при режиме RemoveFileAction::$ajax=FALSE. 
	 * По умолчаню array('index').
	 */
	public $redirectUrl=['index'];
	
	/**
	 * Run
	 * @param integer $id id модели. Не обязательный, если в поведении не задан атрибут id модели.
	 */
	public function run($id=null)
	{
        $propId=R::get('prop');
		if(empty($id) || empty($propId)) {
			throw new \CHttpException(404);
		}

        if($prop=InfoBlockElementProp::model()->findByAttributes(['element_id'=>$id, 'prop_id'=>$propId])) {
            if($el=InfoBlockHelper::getElementByPk($id)) {
                if($el['model']->{$this->behaviorName}->attributeId) {
                    $el['model']->{$el['model']->{$this->behaviorName}->attributeId}=$id;
                }
                $el['model']->{$this->behaviorName}->delete(); 
                $prop->delete();               
                
                if($this->ajaxMode) {
                    \Yii::app()->end();
                    die;
                }
                else {
                    $this->getController()->redirect($this->redirectUrl);
                }
            }
        }
        
        throw new \CHttpException(404);
	}
}