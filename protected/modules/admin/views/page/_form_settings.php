<?if(D::role('sadmin')):?>
<div class="row">
    <?php echo $form->label($model, 'view_template'); ?>
    <?php echo $form->textField($model, 'view_template', array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'view_template'); ?>
    <p class="note">По умолчанию "page"</p>
</div>
<div class="row">
    <?php echo $form->CheckBox($model, 'show_page_title') ?>
    <?php echo $form->labelEx($model, 'show_page_title', array('class'=>'inline')); ?>
    <?php echo $form->error($model,'show_page_title'); ?>
</div>
<?endif?>