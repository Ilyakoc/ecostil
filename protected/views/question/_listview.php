<?php
/** @var QuestionController $this */

/** @var \CActiveDataProvider[models\Question] $dataProvider */

use common\components\helpers\HYii as Y;

$t = Y::ct('ReviewsModule.controllers/default');
$tcl = Y::ct('CommonModule.labels', 'common');
?>

<div class="question__list" id="listView">
    <?
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
        'ajaxUpdate' => false,
        'itemsCssClass' => 'question-list__items',
        'pager' => [
            'class' => '\common\components\pagers\MorePager',
            'htmlOptions' => ['class' => '']
        ],
        'template' => '{items}{pager}',
    ));
    ?>
</div>
