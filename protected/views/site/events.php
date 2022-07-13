<h1><?= D::cms('events_title', Yii::t('events', 'events_title')) ?></h1>

<div class="news__list news__list--page">
    <?php foreach ($events as $event): ?>
        <? $this->renderPartial('//site/_events_item', ['data' => $event]) ?>
    <?php endforeach; ?>
</div>
<div class="pager search-pager">
    <?php $this->widget('DLinkPager', array(
        'header' => '',
        'pages' => $pages,
        'lastPageLabel' => '&gt;&gt;',
        'nextPageLabel' => '&gt;',
        'prevPageLabel' => '&lt;',
        'firstPageLabel' => '&lt;&lt;',
        'cssFile' => false,
//  'htmlOptions'=>array('class'=>'')
    )); ?>
</div>