<?php

$this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '//services/_item',
    'viewData' => compact('cid'),
    'pager' => [
        'class' => '\common\components\pagers\MorePager',
        'htmlOptions' => ['class' => '']
    ],
    'template' => '{items}{pager}',
]);
?>