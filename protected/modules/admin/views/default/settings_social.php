<?php
use common\components\helpers\HArray as A;
?>
<div class="row">
    <?php echo $form->checkBox($model, 'show_socials'); ?>
    <?php echo $form->label($model, 'show_socials', ['class' => 'inline']); ?>
    <?php echo $form->error($model,'show_socials'); ?>
</div>

<div class="row">
    <?php echo $form->label($model, 'vk'); ?>
    <?php echo $form->textField($model, 'vk', array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'vk'); ?>
</div>

<div class="row">
    <?php echo $form->label($model, 'odnoklassniki'); ?>
    <?php echo $form->textField($model, 'odnoklassniki', array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'odnoklassniki'); ?>
</div>

<div class="row">
    <?php echo $form->label($model, 'instagram'); ?>
    <?php echo $form->textField($model, 'instagram', array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'instagram'); ?>
</div>

<div class="row">
    <?php echo $form->label($model, 'facebook'); ?>
    <?php echo $form->textField($model, 'facebook', array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'facebook'); ?>
</div>
<script>
    $(document).ready(function(){
        const $tab_social = $('#tab-social');
        const $social_enable = $tab_social.find('input[type="checkbox"]');
        const $socials = $tab_social.find('input[type="text"]');
        if (!$social_enable.is(':checked')) {
            $socials.prop('disabled', true);
        }
        $social_enable.change(function () {
            if (this.checked) {
                $socials.removeAttr('disabled');
            } else {
                $socials.prop('disabled', true);
            }
        })
    });
</script>