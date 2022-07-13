<?php
/* @var $this iblock\controllers\AdminController */
/* @var $model iblock\models\InfoBlock */

$this->breadcrumbs=array(
	'Информационные блоки'
);
?>
<h1>Информационные блоки</h1>

<a href="/cp/iblock/create" type="button" class="btn btn-primary">Создать информационный блок</a>

<?php $this->widget('zii.widgets.grid.CGridView', [
	'id'=>'info-block-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-striped  table-bordered table-hover items_sorter',
	'pagerCssClass'=>['htmlOptions'=>['class'=>'pagination']],
	'filter'=>null, // $model,
	'columns'=>[
		[
            'name'=>'id',
            'header'=>'ID',
            'headerHtmlOptions'=>['style'=>'width:5%;text-align:center'],
            'htmlOptions'=>['style'=>'text-align:center'],
        ],
        [
            'name'=>'code',
            'header'=>'Код',
            'headerHtmlOptions'=>['style'=>'width:20%'],
        ],
        'title',
        [
            'name'=>'sort',
            'header'=>'Порядок',
            'headerHtmlOptions'=>['style'=>'width:5%;text-align:center'],
            'htmlOptions'=>['style'=>'text-align:center'],                    
        ],
        [
            'name'=>'active',
            'header'=>'Активен',
            'headerHtmlOptions'=>['style'=>'width:5%;text-align:center'],
            'htmlOptions'=>['style'=>'text-align:center'],
            'value'=>'$data->active ? "да" : "нет"'
        ],        
        [
            'name'=>'use_preview',
            'header'=>'Фото',
            'headerHtmlOptions'=>['style'=>'width:5%;text-align:center'],
            'htmlOptions'=>['style'=>'text-align:center'],
            'value'=>'$data->use_preview ? "да" : "нет"'
        ],
        [
            'name'=>'use_description',
            'header'=>'Описание',
            'headerHtmlOptions'=>['style'=>'width:5%;text-align:center'],
            'htmlOptions'=>['style'=>'text-align:center'],
            'value'=>'$data->use_description ? "да" : "нет"'
        ],        
        [
            'class'=>'\CButtonColumn',
            'template'=>'{update}&nbsp;{delete}',
            'updateButtonImageUrl'=>false,
            'deleteButtonImageUrl'=>false,
            'buttons'=>[
                'delete'=>[
                    'label'=>'<span class="glyphicon glyphicon-remove"></span> ',
                    'options'=>['title'=>'Удалить'],
                ],
                'update'=>[
                    'label'=>'<span class="glyphicon glyphicon-pencil"></span> ',
                    'options'=>['title'=>'Редактировать'],
                ],
            ],
        ]
    ],
]); ?>
