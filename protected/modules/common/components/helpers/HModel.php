<?php
/**
 * Model helper
 */
namespace common\components\helpers;

use common\components\helpers\HYii as Y;
use common\components\helpers\HArray as A;
use common\components\helpers\HDb;

class HModel
{
	/**
	 * Массовое присваивание.
	 * @param mixed $model объект или имя класса модели
	 * @param bool $forciblyReturnModel в любом случае, возвращать модель. По умолчанию FALSE.
	 * @param bool $isPost указывает, что данные переданы исключительно методом POST. По умолчанию TRUE.
	 * @return mixed объект модели, либо false, если не задано принудительное создание модели
	 * и не переданы значения для массового присваивания.
	 */
	public static function massiveAssignment($model, $forciblyReturnModel=false, $isPost=true, $scenario=false)
	{
		$name = \CHtml::modelName($model);
		$isset = $isPost ? isset($_POST[$name]) : isset($_REQUEST[$name]);
		if($isset) {
			if(is_string($model)) {
				if($scenario) {
					$model = new $model($scenario);
				}
				else {
					$model = new $model();
				}
			}
	
			$model->attributes = $isPost ? $_POST[$name] : $_REQUEST[$name];
	
			return $model;
		}
	
		if ($forciblyReturnModel) {
		    if (is_object($model)) {
    		    if($scenario) {
    		        $model->setScenario($scenario);
    		    }
		        return $model;
		    }
		    else {
		        return new $model($scenario);
		    }
		}
		
		return false;
	}
	
	/**
	 * Получить значение свойства модели.
	 * @param mixed $model объект модели.
	 * @param string $property имя свойства.
	 * @param mixed $default значение по умолчанию, которое будет возвращено, 
	 * если свойство не найдено.
	 * @param boolean $forcibly принудительно получать значение свойства, даже если 
	 * его не существует. Требуется для свойств, которые получаются динамически, 
	 * например через магический метод __get(). 
	 * Для моделей наследуемых от \CComponent проверка осуществляется через метод
	 * hasProperty().
	 * @return string
	 */
	public static function getProperty($model, $property, $default=null, $forcibly=false)
	{
		if(is_object($model)
			&& ((($model instanceof \CComponent) && $model->hasProperty($property))
				|| (($model instanceof \CActiveRecord) && $model->hasAttribute($property))
				|| $forcibly || property_exists($model, $property))) 
		{
			return $model->$property;
		}
		
		return $default;
	}

	/**
	 * Проверка, отправлены ли в запросе данные для модели из формы.
	 * @param \CModel|string $model модель или имя класса модели.
	 * @param boolean $isPost проверять только POST данные. По умолчанию FALSE.
	 * @return boolean
	 */
	public static function isFormRequest($model, $isPost=false)
	{
		$name=\CHtml::modelName($model);
	
		return $isPost ? isset($_POST[$name]) : isset($_REQUEST[$name]);
	}
	
	/**
	 * Performs the AJAX validation.
	 *
	 * @param mixed $model the model to be validated.
	 * @param string $formId form id.
	 * @param boolean $isPost Получить данные только из POST запроса.
	 * @return string Если запрос является проверкой на валидацию
	 * выводится результат CActiveForm::validate() и скрипт завершается.
	 */
	public static function performAjaxValidation($model, $formId, $isPost=true)
	{
		if (self::isAjaxValidation($formId, $isPost)) {
			echo \CActiveForm::validate($model);
			Y::end();
		}
	}
	
	/**
	 * Проверка, является ли текущий запрос, запросом валидации формы.
	 * @param string $formId id формы.
	 * @param boolean $isPost Получить данные только из POST запроса.
	 * @return boolean
	 */
	public static function isAjaxValidation($formId, $isPost=true)
	{
		$ajax = $isPost ? Y::request()->getPost('ajax') : Y::request()->getParam('ajax');
		return (!empty($formId) && $ajax === $formId);
	}
	
	/**
	 * Загрузка модели
	 * @param mixed $className имя класса модели или объект модели \CActiveRecord
	 * @param string|array|\CDbCriteria $condition условие выборки
	 * @param array $params параметры для условия выборки.
	 * @return \CActiveRecord объект найденой модели.
	 */
	public static function load($className, $condition, $params=[])
	{
		return $className::model()->find($condition, $params);
	}
	
	/**
	 * Загрузка модели по значениям полей.
	 * @param mixed $className имя класса модели или объект модели \CActiveRecord
	 * @param array $columns list of column names and values to be matched (name=>value)
	 * @param string|array|\CDbCriteria $condition дополнительное условие выборки.
	 * По умолчанию NULL.
	 * @param string $columnOperator the operator to concatenate multiple column matching 
	 * condition. Defaults to 'AND'.
	 * @param string $operator the operator used to concatenate the new condition with the 
	 * existing one. Defaults to 'AND'.
	 * @return \CActiveRecord объект найденой модели.
	 */
	public static function loadByColumn($className, $columns, $criteria=null, $columnOperator='AND', $operator='AND')
	{
		if($criteria === null) $criteria=[];
		if(is_array($criteria)) {
			$criteria=new \CDbCriteria($criteria);
		}
		
		$criteria->addColumnCondition($columns);
		
		return $className::model()->find($criteria);
	}
	
	/**
	 * Загрузка модели по первичному ключу
	 * @param mixed $className имя класса модели или объект модели \CActiveRecord
	 * @param mixed $id идентификатор модели
	 * @param mixed $exception бросить исключение, если модель не найдена. По умолчанию TRUE.
	 * Может быть передан массив вида
	 * array(
	 * 	class=>класс исключения. По умолчанию \CHttpException.
	 *  code=>код исключения. По умолчанию 404.
	 *  message=>сообщение исключения. По умолчанию NULL.
	 * );
	 * В массиве могут быть переданы не все параметры.
	 * Любое пустое значение интерпретируется как FALSE.
	 * @param mixed объект критерия(\CDbCriteria или array) для запроса получения модели. По умолчанию NULL(не задан).
	 * @see \CActiveRecord::findByPk()
	 * @throws \CHttpException
	 * @return mixed объект найденой модели. Если $throwException=FALSE и модель не найдена, возвратит NULL.
	 * @FIXME имя первичного ключа для запроса поиска модели задано жестко "id".
	 */
	public static function loadByPk($className, $id, $exception=true, $criteria=null)
	{
		if(empty($criteria) || is_array($criteria))
			$criteria=new \CDbCriteria($criteria?:array());
	
		$criteria->params[':id']=$id;
		$criteria->addCondition('id=:id');
		$model=$className::model()->find($criteria);
	
		if(!empty($exception) && ($model===null)) {
			$isA=is_array($exception);
			$class=($isA && isset($exception['class'])) ? $exception['class'] : '\CHttpException';
			$code=($isA && isset($exception['code'])) ? $exception['code'] : 404;
			$msg=($isA && isset($exception['message'])) ? $exception['message'] : null;
	
			throw new $class($code, $msg);
		}
	
		return $model;
	}

	/**
	 * Получить дерево NestedSet модели
	 *
	 * @param string|\CActiveRecord $model имя класса модели или объект \CActiveRecord
	 * Класс должен содержать статический метод $model::model()
	 * @param string|[] $select дополнительные поля выборки, по умолчанию 'title'.
	 * @param []|\CDbCriteria $criteria дополнительный критерий выборки.
	 * @param string $rootAttribute имя атрибута "root". По умолчанию "root".
	 * @param string $lftAttribute имя атрибута "lft". По умолчанию "lft".
	 * @param string $levelAttribute имя атрибута "level". По умолчанию "level".
	 * @param string $idAttribute имя атрибута "id". По умолчанию "id".
	 * @return [] массив вида [
	 *  'id'=>идентификатор модели,
	 *  'model'=>объект модели,
	 *  'attributes'=>[ массив дополнительных атрибутов, которые были указаны в параметре $select.
	 * 		attribute=>value
	 *  ],
	 *  'children'=>[ 
	 * 		потомки, в аналогичной структуре 
	 *  ],
	 *  'parent' => &ссылка на родительский элемент массива
	 * ]
	 */
	public static function getNestedSetTree($model, $select='title', $criteria=[], $rootAttribute='root', $lftAttribute='lft', $levelAttribute='level', $idAttribute='id')
	{
		$tree=[];

		$select=A::toa($select);

		$criteria=HDb::criteria($criteria);
		$criteria->select=implode(',', A::m($select, [$idAttribute, $rootAttribute, $lftAttribute, $levelAttribute]));
		$criteria->order=$rootAttribute . ', ' . $lftAttribute;
		$modelClass=is_object($model) ? get_class($model) : $model;
        if($items=$modelClass::model()->findAll($criteria)) {
			$current=null; // ссылка на текущую обрабатываемую запись
			$level=1;
			foreach($items as $item) {
				$data=['id'=>$item->$idAttribute, 'parent'=>null, 'children'=>[], 'model'=>$item, 'attributes'=>[]];
				foreach($select as $attribute) {
					$data['attributes'][$attribute]=$item->$attribute;
				}
				if($item->$rootAttribute === $item->$idAttribute) {
					$tree[$item->$idAttribute]=$data;
					$current=&$tree[$item->$idAttribute];
				}
				else {
					if($item->$levelAttribute > $level) {
						$data['parent']=&$current;
						$current['children'][$item->$idAttribute]=$data;
						$current=&$current['children'][$item->$idAttribute];
					}
					elseif($item->$levelAttribute < $level) {
						while($item->$levelAttribute <= $level) {
							if(!$current['parent']) break;
							$current=&$current['parent'];
							$level--;
                        }
                        $data['parent']=$current;
                        $current['children'][$item->$idAttribute]=$data;
					}
					else {
						$data['parent']=$current;
						$current['parent']['children'][$item->$idAttribute]=$data;
					}
				}
				$level=$item->$levelAttribute;
			}
		}

		return $tree;
	}
}