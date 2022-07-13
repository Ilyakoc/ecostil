<?php
use common\components\helpers\HArray as A;
?>
<div class="row">
    <?php echo $form->checkBox($model, 'show_messengers'); ?>
    <?php echo $form->label($model, 'show_messengers', ['class' => 'inline']); ?>
    <?php echo $form->error($model,'show_messengers'); ?>
</div>

<div class="row">
    <?php echo $form->label($model, 'whatsapp'); ?>
    <?php echo $form->textField($model, 'whatsapp', array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'whatsapp'); ?>
</div>

<div class="row">
    <?php echo $form->label($model, 'telegram'); ?>
    <?php echo $form->textField($model, 'telegram', array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'telegram'); ?>
</div>

<div class="row">
    <?php echo $form->label($model, 'viber'); ?>
    <?php echo $form->textField($model, 'viber', array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'viber'); ?>
</div>
<script>
    $(document).ready(function(){
        const $tab_messenger = $('#tab-messenger');
        const $messenger_enable = $tab_messenger.find('input[type="checkbox"]');
        const $messengers = $tab_messenger.find('input[type="text"]');
        if (!$messenger_enable.is(':checked')) {
            $messengers.prop('disabled', true);
        }
        $messenger_enable.change(function () {
            if (this.checked) {
                $messengers.removeAttr('disabled');
            } else {
                $messengers.prop('disabled', true);
            }
        })
    });
</script>