<?php
/* @var $this ArticleController */

use \settings\components\helpers\HSettings;

/** @var ServicesSettings $settings */
$settings = HSettings::getById('services');
$text_before = $settings['main_text'];
$text_after = $settings['main_text2'];
?>
<h1>Услуги</h1>
<div class="articles">
    <?php echo $text_before ?>

    <div class="article__list show-more">
        <? \crud\models\ar\Service::widget();?>
    </div>
    <?php echo $text_after ?>
</div>