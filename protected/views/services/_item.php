<?php
$url = crud\components\helpers\HCrudPublic::getViewUrl($cid, $data->id);
?>
<div class="article-item">
        <div class="article__preview">
<!--            <img src="--><?//= $data->tmbSrc ?><!--" alt="--><?php //echo $data->preview_image_alt; ?><!--" title="--><?php //echo $data->preview_image_alt; ?><!--">-->
        </div>
        <div class="article-item__content">
            <div class="article-item__title">
                <?= $data->title; ?>
            </div>
            <div class="article-item__intro"><?= $data->preview_text; ?></div>
            <a class="article-item__read" href="<?=$url?>">
                Читать полностью
            </a>
        </div>
</div>
