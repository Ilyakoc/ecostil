<?php
use common\components\helpers\HArray as A;
?>
<div class="row">
    <?php echo $form->label($model, 'additional_phones'); ?>
    <?php echo $form->textArea($model, 'additional_phones', array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'additional_phones'); ?>
</div>

<div class="row">
    <?php echo $form->label($model, 'additional_emails'); ?>
    <?php echo $form->textArea($model, 'additional_emails', array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'additional_emails'); ?>
</div>

<div class="row">
    <?php echo $form->label($model, 'additional_address'); ?>
    <?php echo $form->textArea($model, 'additional_address', array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'additional_address'); ?>
</div>
