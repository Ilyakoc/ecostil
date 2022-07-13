<? if (D::role('sadmin')): ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'events_title'); ?>
        <?php echo $form->textField($model, 'events_title', array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'events_title'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'events_link_all_text'); ?>
        <?php echo $form->textField($model, 'events_link_all_text', array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'events_link_all_text'); ?>
    </div>
    <div class="row">
        <?php echo $form->checkBox($model, 'events_list_image_preview'); ?>
        <?php echo $form->label($model, 'events_list_image_preview', ['class' => 'inline']); ?>
        <?php echo $form->error($model, 'events_list_image_preview'); ?>
    </div>
<? endif ?>