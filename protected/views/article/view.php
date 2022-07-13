<?php
/* @var $this ArticleController */
?>
<h1><?=$article->title?></h1>
<?=$article->text?>
<?=HtmlHelper::linkBack('Назад', '/articles', '/articles', ['class' => 'back__button'])?>
