<?php 
namespace crud\models\ar;
use common\components\helpers\HArray as A;
class Service extends \common\components\base\ActiveRecord
{
	const ROLE_MANAGER='crud_service_pages_manager';
const TYPE_TOP='1';
const TYPE_CENTER='3';
const TYPE_BOTTOM='5';
	public function tableName()
	{
		return 'services_pages';
	}
	
	public function behaviors()
	{
		return A::m(parent::behaviors(), ['seoBehavior'=>'\seo\behaviors\SeoBehavior', 'updateTimeBehavior'=>['class'=>'\common\ext\updateTime\behaviors\UpdateTimeBehavior', 'addColumn'=>false], 'publishedBehavior'=>['class'=>'\common\ext\active\behaviors\PublishedBehavior', 'attribute'=>'published', 'addColumn'=>false], 'sefBehavior'=>['class'=>'\seo\ext\sef\behaviors\SefBehavior', 'attribute'=>'sef', 'attributeLabel'=>'URL', 'unique'=>true, 'uniqueWith'=>[], 'addColumn'=>false], 'imageBehavior'=>['class'=>'\common\ext\file\behaviors\FileBehavior', 'attribute'=>'image', 'attributeLabel'=>'Изображение', 'attributeAlt'=>'image_alt', 'attributeAltLabel'=>'ALT/TITLE изображения', 'attributeFileLabel'=>false, 'imageMode'=>true], 'sortFieldBehavior'=>['class'=>'\common\ext\sort\behaviors\SortFieldBehavior', 'addColumn'=>false, 'attribute'=>'sort', 'attributeLabel'=>'Сортировка', 'asc'=>false, 'step'=>10, 'default'=>0]]);
	}
	
	public function relations()
	{
		return $this->getRelations([]);
	}
	
	public function scopes()
	{
		return $this->getScopes(['previewColumns'=>['select'=>new \CDbExpression('`t`.`id`, `t`.`create_time`, `t`.`image`, `t`.`published`, `t`.`sort`, `t`.`title`, `t`.`preview_text`, IF(LENGTH(`t`.`text`)>0, 1, 0) AS `has_text`')]]);
	}
	
	public function rules()
	{
		return $this->getRules(['1'=>['0'=>'title', '1'=>'required'], '2'=>['0'=>'sort, preview_text', '1'=>'safe'], '3'=>['0'=>'sort', '1'=>'numerical', 'integerOnly'=>true], '4'=>['0'=>'title, sef', '1'=>'length', 'max'=>255], '5'=>['0'=>'create_time,published,title,text', '1'=>'safe']]);
	}
	
	public function attributeLabels()
	{
		return $this->getAttributeLabels(array('id'=>'ID', 'create_time'=>'Дата', 'update_time'=>'Время обновления', 'published'=>'Опубликовать на сайте', 'title'=>'Наименование', 'sef'=>'URL', 'image'=>'Изображение', 'text'=>'Текст', 'sort'=>'Сортировка', 'preview_text'=>'Анонс'));
	}
	
                public static function widgetWithParams($params=[], $dataProviderOptions=[], $returnOutput=false) {
                    $params['cid']='services';
                    $params['template_name']=\settings\components\helpers\HSettings::getById('services')->getCurrentTemplateType();
                    $params['dataProvider']=static::model()->getDataProvider($dataProviderOptions);
                    return \Yii::app()->getController()->renderPartial('//services/widget', $params, $returnOutput, false);
                }

                public static function widget() {
                    $params['cid']='services';
                    $params['template_name']=\settings\components\helpers\HSettings::getById('services')->getCurrentTemplateType();
                    $params['dataProvider']=static::model()->getDataProvider([
                        'scopes'=>['published', 'bySort']
                    ]);
                    \Yii::app()->getController()->renderPartial('//services/widget', $params, false, false);
                }
                

public $has_text;

public static function getPages($limit=10) {
                return static::model()->previewColumns()->published()->findAll(["limit"=>$limit, "order"=>"`t`.`create_time` DESC, `t`.`sort` DESC, `t`.`id` DESC"]);
            }

public function getTmbWidth(){
                return 350;
            }

public function getTmbHeight(){
                return 220;
            }

public function getPageUrl() {
                if($this->title || $this->has_text) {
                    return \crud\components\helpers\HCrudPublic::getViewUrl("services", $this->id);
                }
                return false;
            }

public function beforeSave() {
                parent::beforeSave();
                if($this->owner->isNewRecord) {
                    if(!$this->owner->sort) {
                        $query="SELECT MAX(`sort`) + 5 FROM " . \common\components\helpers\HDb::qt($this->tableName()) . " WHERE 1=1";
                        $this->owner->sort=(int)\common\components\helpers\HDb::queryScalar($query);
                    }
                    $createTime=preg_replace('/[^1-9]/', '', $this->create_time);
                    if(empty($createTime)) $this->create_time=new \CDbExpression("NOW()");
                }
                return true;
            }
}
