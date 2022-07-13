<?php
/* @var $this ArticleController */
$url = crud\components\helpers\HCrudPublic::getIndexUrl($cid, $model->id);
?>
<h1><?=$model->title?></h1>
<?=$model->text?>
<?=HtmlHelper::linkBack('Назад', $url, $url, ['class' => 'back__button'])?>
