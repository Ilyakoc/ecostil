<?php
use common\components\helpers\HYii as Y;
use common\components\helpers\HArray as A;
use common\components\helpers\HRequest as R;
use common\components\helpers\HDb;

class SearchController extends Controller
{
    public function actionAutoComplete() 
    {
        $result = '';
        
		$q = Y::config('search', 'queryname');
		$isPost=isset($_POST[$q]);
        if ($isPost || isset($_GET[$q])) {
			$items=[];
            $query = R::get($q);
            $phrases=$this->getPhrases($query);

			$markIt=Y::config('search', 'autocomplete.mark');
            $autocompletes = Y::config('search', 'autocomplete.models');
            foreach($autocompletes as $modelClass=>$config) {
                $criteria = HDb::criteria(A::get($config, 'criteria', []));
                foreach(A::get($config, 'attributes', []) as $attribute) {
                    $this->addSearchInCondition($criteria, $attribute, $phrases);
                }
                $criteria->limit = Y::config('search', 'autocomplete.limit', 10);
                $models = $modelClass::model()->findAll($criteria);
                if(!empty($models)) {
                    foreach($models as $model) {
                        $titleAttribute = A::get($config, 'titleAttribute', 'title');
                        if(is_callable($titleAttribute)) {
                            $title = call_user_func($titleAttribute, $model);
                        }
                        else {
                            $title = $model->$titleAttribute;
						}

						$items[]=$markIt ? preg_replace_callback('#(<.*?>|^)(.*?)(</.*?>|$)#', function($m) use ($phrases) {
                            return $m[1] . preg_replace('/('.implode('|', $phrases).')/iu', '<mark>$1</mark>', $m[2]) . $m[3];
                        }, $title) : $title;
                    }
                }
			}
			
			$result=$isPost ? json_encode(['items'=>$items]) : implode("\n", $items);
        }
        
        echo $result;
        
        Y::end();
    }
    
	public function actionIndex()
	{
	    $this->prepareSeo('Результаты поиска');
	    $this->breadcrumbs->add('Поиска');
	    
	    $q = Y::config('search', 'queryname');
	    
	    $query = Yii::app()->request->getQuery($q);
		
	    if (mb_strlen($query, 'UTF-8') < Y::config('search', 'minlength', 3)) {
			$this->prepareSeo('Слишком короткий запрос');
			$this->render('index_empty');
			return;
		}

    	$phrases=$this->getPhrases($query);
		
    	$dataProviders = [];
    	
    	$searches = Y::config('search', 'search.models');
    	foreach($searches as $modelClass=>$config) {
    	    $criteria = HDb::criteria(A::get($config, 'criteria', []));
			$attributes=A::get($config, 'attributes', []);
			foreach($attributes as $attribute) {
    	        $this->addSearchInCondition($criteria, $attribute, $phrases);
    	    }

			if(!empty($attributes) && !empty($phrases)) {
				$strongRelevanceMultiplier=(int)A::get($config, 'strong_relevance_multiplier', 0);
	            $maxRelevance=count($attributes) * count($phrases) * 20;
	            $relevance=$maxRelevance;
	            $select='';
            	foreach($phrases as $phrase) {
            		$select.=!$select ? '(' : '+';
            		foreach($attributes as $attribute) {
						if($strongRelevanceMultiplier) {
							$select.='IF('.HDb::qc($attribute).' REGEXP '.HDb::qv("[[:<:]]{$phrase}[[:>:]]").','.($strongRelevanceMultiplier*$relevance).', IF('.HDb::qc($attribute).' LIKE '.HDb::qv("%{$phrase}%").', '.$relevance.',';
						}
						else {
                			$select.='IF('.HDb::qc($attribute).' LIKE '.HDb::qv("%{$phrase}%").', '.$relevance.',';
						}
            			$relevance-=20;
            		}
            		$select.='0' . str_repeat(')', ($strongRelevanceMultiplier ? 2 : 1) * count($attributes));
            	}
	            $select.=') AS `relevance`';
	            if($criteria->select == '*') {
                	$criteria->select=($criteria->alias ?: 't') . '.*';
                }
	            $criteria->select.=',' . $select;
	            $criteria->order='`relevance` DESC';
        	}
    	    
    	    $pagination = new \CPagination();
    	    $pagination->pageSize = A::get($config, 'limit', 10);;

    	    $dataProviders[] = [
    	        'modelClass' => $modelClass,
    	        'title' => A::get($config, 'title'),
    	        'view' =>  A::get($config, 'view'),
    	        'wrapperOpen' => A::get($config, 'wrapperOpen'),
    	        'wrapperClose' => A::get($config, 'wrapperClose'),
    	        'listView' => A::get($config, 'listView', []),
    	        'item' => A::get($config, 'item', []),
    	        'dataProvider' => new \CActiveDataProvider($modelClass, [
    	            'criteria'=>$criteria,
    	            'pagination' => $pagination
    	        ]),
    	        'beforeContent' => A::get($config, 'beforeContent'),
    	        'afterContent' => A::get($config, 'afterContent')
    	    ];
    	}
    			
		$this->render('index', compact('dataProviders', 'query'));
	}
    
    protected function getPhrases($q) 
    {
        $q=preg_replace('/ +/', ' ', $q);
        return array_filter(explode(' ', $q), function($v) { return (strlen($v) > 2); });
    }
    
    protected function addSearchInCondition(&$criteria, $attribute, $phrases, $operator='OR') {
        $c=new CDbCriteria();
        if(!empty($phrases)) {
            foreach($phrases as $p) {
                $c->addSearchCondition($attribute, $p, true, 'AND');
            }
        }
        $criteria->mergeWith($c, $operator);
    }
}
