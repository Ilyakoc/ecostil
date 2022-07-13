<?php
use common\components\helpers\HArray as A;
?>
<h1>Поиск</h1>
<? $this->widget('widget.search.SearchWidget', ['submit'=>'', 'view'=>'search_form_on_page']); ?>
<?php
$isEmpty=true;
foreach($dataProviders as $config) {
    $dataProvider = A::get($config, 'dataProvider');
    if(!empty($dataProvider) && $dataProvider->getTotalItemCount()) {
		$isEmpty=false;
        echo A::get($config, 'wrapperOpen') ?: '<div class="search__block">';

        if($title = A::get($config, 'title')) {
            echo \CHtml::tag('h2', [], $title);
        }

        if($beforeContent = A::get($config, 'beforeContent')) {
            if(!is_string($beforeContent) && is_callable($beforeContent)) { echo call_user_func($beforeContent, $dataProvider); }
            else { echo $beforeContent; }
        }
        
        $this->widget('zii.widgets.CListView', A::m([
            'dataProvider'=>$dataProvider,
            'itemView'=>'_item_default',
            'sorterHeader'=>'Сортировка:',
            'itemsTagName'=>'div',
            'emptyText'=>'<div class="search-empty">Не найдено.</div>',
            'itemsCssClass'=>'search-result__items',
            // 'sortableAttributes'=>['title'],
            'id'=>'ajaxListView' . md5(A::get($config, 'modelClass')),
            'template'=>'{items}{pager}',
			'viewData'=>compact('config'),
//			'pagerCssClass'=>'pagination',
            'pagerCssClass'=>'pager search-pager',
            'pager'=>[
                'class' => 'DLinkPager',
                'maxButtonCount'=>'5',
                'header'=>'',
                'firstPageLabel' => '<<',
                'prevPageLabel' => '<',
                'nextPageLabel' => '>',
                'lastPageLabel' => '>>',
            ],
//            'pager' => [
//                'class' => '\common\components\pagers\MorePager',
//                'htmlOptions' => ['class' => '']
//            ],

        ], A::get($config, 'listView')));

        if($afterContent = A::get($config, 'afterContent')) {
            if(!is_string($afterContent) && is_callable($afterContent)) { echo call_user_func($afterContent, $dataProvider); }
            else { echo $afterContent; }
        }
        
        echo A::get($config, 'wrapperClose') ?: '</div>';
    }
}
if($isEmpty): ?>
<div class="search__result-is-empty">По вашему запросу ничего не найдено</div>
<?php endif; ?>
