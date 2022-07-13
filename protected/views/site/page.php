<?php /** @var Page $page */
if ($page->isShowPageTitle()): ?>
    <h1><?= $page->getMetaH1() ?></h1>
<?php endif ?>
<?= $page->text ?>

<? if ($page->blog && $page->blog->id) {
    $url = $this->createUrl('site/blog', array('id' => $page->blog->id));
    echo HtmlHelper::linkBack('Назад', $url, $url);
} ?>
