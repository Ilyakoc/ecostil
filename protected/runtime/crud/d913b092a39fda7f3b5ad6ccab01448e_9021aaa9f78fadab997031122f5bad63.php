<?php 
namespace crud\models\ar;
use common\components\helpers\HArray as A;
\Yii::import('application.config.crud.behaviors.AdminBehavior', true);
class Admin extends \common\components\base\ActiveRecord
{
	const ROLE_ADMIN='admin';
	public function tableName()
	{
		return 'admins';
	}
	
	public function behaviors()
	{
		return A::m(parent::behaviors(), ['adminBehavior'=>['class'=>'\crud\models\ar\Admin\behaviors\AdminBehavior'], 'updateTimeBehavior'=>['class'=>'\common\ext\updateTime\behaviors\UpdateTimeBehavior', 'addColumn'=>false], 'publishedBehavior'=>['class'=>'\common\ext\active\behaviors\PublishedBehavior', 'attribute'=>'published', 'addColumn'=>false]]);
	}
	
	public function relations()
	{
		return $this->getRelations([]);
	}
	
	public function scopes()
	{
		return $this->getScopes([]);
	}
	
	public function rules()
	{
		return $this->getRules(['0'=>['0'=>'create_time,published', '1'=>'safe']]);
	}
	
	public function attributeLabels()
	{
		return $this->getAttributeLabels(array('id'=>'ID', 'create_time'=>'Время создания', 'update_time'=>'Время обновления', 'published'=>'Активен', 'name'=>'ФИО', 'email'=>'E-Mail', 'login'=>'Логин', 'password'=>'Пароль', 'role'=>'Роль', 'comment'=>'Комментарий'));
	}
	
public function roles() {
                return [
                    self::ROLE_ADMIN=>"Администратор",
                ];
            }
}
