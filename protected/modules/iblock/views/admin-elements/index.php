<?php
/* @var $this iblock\controllers\AdminElementsController */
/* @var $model iblock\models\InfoBlockElement */
/* @var $iblock iblock\models\InfoBlock */

use common\components\helpers\HArray as A;
use iblock\components\helpers\HInfoBlock;

$this->breadcrumbs=array(
	$iblock->title,
);
?>
<h1><?=$iblock->title?></h1>

<?=CHtml::link(
	'Добавить запись',
	['/admin/iblockElements/create', 'block_id' => $iblock->id],
	['type' => 'button', 'class' => 'btn btn-primary']
)?>

<?php
$gridViewConfig=HInfoBlock::param($iblock->code, 'admin.gridview', []);
$isEmptyGridViewColumns=empty($gridViewConfig['columns']);
if($isEmptyGridViewColumns) {
    $gridViewConfig['columns']=[
        'id',
        'title',
        [
            'type' => 'raw',
			'name' => 'preview',
            'visible' => $iblock->use_preview,
			'value' => function ($data) {
				/* @var \iblock\models\InfoBlockElement $data */
				if (empty($data->preview)) {
					return '';
				}
				return $data->imageBehavior->img(50, 50, 1);
			},
        ],
        [
            'name' => 'active',
            'value' => function ($data) {
                return (int)$data->active ? 'да' : 'нет';
            }
        ]        
    ];
}
if($isEmptyGridViewColumns || isset($gridViewConfig['columns']['buttons'])) {
    if(isset($gridViewConfig['columns']['buttons'])) {
        unset($gridViewConfig['columns']['buttons']);
    }
    
    $gridViewConfig['columns'][]=[
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
    ];
}
?>
<?php 
$this->widget('zii.widgets.grid.CGridView', A::m([
	'id'=>'info-block-element-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-striped  table-bordered table-hover items_sorter',
	'pagerCssClass'=>['htmlOptions'=>['class'=>'pagination']],
	'filter'=>null, // $model,
], $gridViewConfig)); 
?>
