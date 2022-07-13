<? $this->beginContent('//layouts/main') ?>

    <div class="container">
        <? $this->widget('\ext\D\breadcrumbs\widgets\Breadcrumbs', array('breadcrumbs' => $this->breadcrumbs->get())) ?>
        <article id="content" class="content">
            <?= $content ?>
        </article>
    </div>

<? $this->endContent() ?>