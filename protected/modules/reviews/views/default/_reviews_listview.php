<?php
/** @var \reviews\controllers\DefaultController $this */
/** @var \CActiveDataProvider[\reviews\models\Review] $dataProvider */
use common\components\helpers\HYii as Y;

$t=Y::ct('ReviewsModule.controllers/default');
$tcl=Y::ct('CommonModule.labels', 'common');
?>

<div class="reviews-list show-more" id="listView">
	<?
	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$dataProvider,
	    'itemView'=>'_reviews_item',
	    'ajaxUpdate'=>false,
	    'itemsCssClass'=>'reviews-list__items',
	    'beforeAjaxUpdate' => 'function(id, data){console.log("zzz")}',
	    'afterAjaxUpdate' => 'function(id, data){console.log("aaa");}',
	    'pager' => [
	        'class' => '\common\components\pagers\MorePager',
            'htmlOptions' => ['class' => '']
	    ],
	    'template'=>'{items}{pager}',
	));
	?>
    <p id="loading"><img src="/images/loader.gif" alt=""></p>
</div>
