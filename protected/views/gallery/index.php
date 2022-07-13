<h1><?=D::cms('gallery_title',Yii::t('gallery','gallery_title'))?></h1>
<div class="album__list show-more">
    <?php
    $this->widget('zii.widgets.CListView', [
        'dataProvider' => $dataProvider,
        'itemView' => '_album',
        'pager' => [
            'class' => '\common\components\pagers\MorePager',
            'htmlOptions' => ['class' => '']
        ],
        'template' => '{items}{pager}',
    ]);
    ?>
</div>
