<?php
/**
 * File: ProductReviews.php
 * User: Mobyman
 * Date: 10.04.13
 * Time: 12:54
 */

class AFilters extends CWidget {

    private function _publishAssets()
    {
        $assets = dirname(__FILE__).'/assets';
        $baseUrl = Yii::app()->assetManager->publish($assets);

        $cs=Yii::app()->getClientScript();

        $cs->registerScriptFile("{$baseUrl}/js/attr_filter.js", CClientScript::POS_HEAD);
        $cs->registerScriptFile("{$baseUrl}/js/jquery-ui.min.js", CClientScript::POS_HEAD);
        $cs->registerCssFile("{$baseUrl}/css/jquery-ui.css");
        # $cs->registerCssFile("http://code.jquery.com/ui/1.10.3/themes/south-street/jquery-ui.css");

    }

    public function run(){
        $this->_publishAssets();
        if(Yii::app()->controller->action->id == 'category'){

            $cat_id = Yii::app()->request->getParam('id');

            $categoryFilter = Yii::app()->cache->get('filter_category_'.$cat_id);

            if (!$categoryFilter) {
                $category = Category::model()->findByPk($cat_id);
                $inIDs = array_keys($category->descendants()->findAll(array('index' => 'id', 'select' => 'id')));
                $inIDs[] = (int)$cat_id;

                $criteriaRelated = new CDbCriteria();
                $criteriaRelated->index = 'product_id';
                $criteriaRelated->select = 'product_id';
                $criteriaRelated->addInCondition('category_id', $inIDs);
                $related = RelatedCategory::model()->findAll($criteriaRelated);


                $max_price = Category::model()->getMax($inIDs, $related, 'price');
                $min_price = Category::model()->getMin($inIDs, $related, 'price');

                //$cat_id = Yii::app()->request->getParam('id');

                $criteria = new CDbCriteria;
                $criteria->with = array('productAttributes');
                $criteria->compare('category_id', $cat_id);
                $criteria->condition = 'category_id = ' . $cat_id;
                $criteria->together = true;

                $products = Product::model()->findAll($criteria);


                $attributes = array();

                foreach ($products as $key => $pr) {
                    foreach ($pr->productAttributes as $key => $attr) {
                        if (strlen($attr->value) == 0) continue;
                        $attributes[$attr->id_attrs]['values'][$attr->value] = $attr->value;
                    }
                }
                foreach ($attributes as $key => $attr) {
                    $attr = EavAttribute::model()->findByPk($key);
                    $attributes[$key]['id'] = $attr->id;
                    $attributes[$key]['name'] = $attr->name;
                }

            }

            $this->render('attr_list', compact('attributes', 'max_price', 'min_price'));
        }
    }

}