<?php /** @var Event $data */ ?>
<div class="news__item">
    <div class="news-item <?php if (!D::cms('events_list_image_preview')): ?> news-item-without-image<?php endif; ?>">
        <div class="news-item-image">
            <!-- <div class="news-item__img-wrap"> -->
            <?php if (D::cms('events_list_image_preview')): ?>
                <a class="news-item-image__link"
                   href="<?= Yii::app()->createUrl('site/event', array('id' => $data->id)); ?>">
                    <? $src = $data->getPreviewImg() ?: $this->controller->template . '/images/news-empty.jpg' ?>
                    <img class="news-item-image__img" src="<?= ResizeHelper::resize($src, 350 * 1.2, 222 * 1.2) ?>"
                         alt="<?php echo $data->title; ?>" title="<?php echo $data->title; ?>">
                </a>
            <?php endif ?>
            <div class="news-item-image__date"><?php echo $data->date; ?></div>
        </div>
        <div class="news-item__content">
            <?php echo CHtml::link($data->title, array('site/event', 'id' => $data->id), array('class' => 'news-item__title')); ?>
            <div class="news-item__text"><?php echo $data->getIntro(100); ?></div>
        </div>
    </div>
</div>
