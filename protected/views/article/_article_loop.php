<?php
$this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_article',
    'ajaxUpdate'=>false,
    'pager' => [
        'class' => '\common\components\pagers\MorePager',
        'htmlOptions' => ['class' => '']
    ],
    'template' => '{items}{pager}',
]);