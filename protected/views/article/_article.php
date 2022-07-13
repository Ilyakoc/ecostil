<?php

?>
<div class="article-item">
        <div class="article__preview">
            <img src="<?= $data->tmbSrc ?>" alt="<?php echo $data->preview_image_alt; ?>" title="<?php echo $data->preview_image_alt; ?>">
        </div>
        <div class="article-item__content">
            <div class="article-item__title">
                <?= $data->title; ?>
            </div>
            <div class="article-item__intro"><?= $data->intro; ?></div>
            <a class="article-item__read" href="<?=Yii::app()->createUrl('article/view', ['alias'=>$data->alias])?>">
                Читать полностью
                <svg width="26" height="8" viewBox="0 0 26 8" fill="" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.8575 4.47709C25.0527 4.28183 25.0527 3.96524 24.8575 3.76998L21.6755 0.588001C21.4802 0.392739 21.1636 0.392739 20.9684 0.588001C20.7731 0.783263 20.7731 1.09985 20.9684 1.29511L23.7968 4.12354L20.9684 6.95196C20.7731 7.14722 20.7731 7.46381 20.9684 7.65907C21.1636 7.85433 21.4802 7.85433 21.6755 7.65907L24.8575 4.47709ZM0.503906 4.62354L24.5039 4.62354V3.62354L0.503906 3.62354L0.503906 4.62354Z" fill=""/>
                </svg>
            </a>
        </div>
</div>
