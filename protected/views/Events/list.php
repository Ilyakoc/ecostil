<div class="news">
	<div class="news__container container">
		<div class="news__inner">
			<div class="news__header">
				<h2 class="news__title">Новости</h2>
				<div class="news-all">
					<a class="news-all__link" href="<?= \Yii::app()->createUrl('site/events') ?>">Все новости</a>
					<?/*<?= CHtml::link(D::cms('events_link_all_text', Yii::t('events','news-all__link')), array('site/events'), array('class'=>'all_events')); ?>*/?>
				</div>
			</div>

			<div class="news__list">
				<?php foreach($events as $event): ?>
					<?$this->controller->renderPartial('//site/_events_item', ['data'=>$event])?>
				<?php endforeach; ?>
			</div>

			<div class="news-all news-all--mobile">
				<a class="news-all__link" href="<?= \Yii::app()->createUrl('site/events') ?>">Все новости</a>
			</div>
		</div>
	</div>
</div>
