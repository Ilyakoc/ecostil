<?php
/* @var $this ArticleController */

?>
<h1>Статьи</h1>
<div class="articles">
    <div class="article__list show-more">
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
        ?>
    </div>
</div>