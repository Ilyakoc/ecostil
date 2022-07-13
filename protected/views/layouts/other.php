<?php $this->beginContent('//layouts/main'); ?>

<div class="page-content">
	<div class="page-content__container container">
    <?php $this->widget('\ext\D\breadcrumbs\widgets\Breadcrumbs', array('breadcrumbs' => $this->breadcrumbs->get())); ?>

    <?=$content?>
  </div>
</div>

<?php $this->endContent(); ?>
