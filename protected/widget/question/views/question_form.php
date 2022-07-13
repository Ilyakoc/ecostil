<?php
/** @var QuestionForm $this */

/** @var Question $model */

use common\components\helpers\HYii as Y;
use common\components\helpers\HArray as A;

$t = Y::ct('question');
$tbtn = Y::ct('CommonModule.btn', 'common');
?>
<? if ($this->popup): ?>
    <span class="question__add-wrapper">
    <a class="btn" href="javascript:;" data-src="#fancybox-question-add-form"
       data-js="add-question"><?= $t('btn.add'); ?></a>
</span>
<? endif; ?>

<div style="display: none;">
    <div id="fancybox-question-add-form"
         class="modal-form questions__add-form<?= Y::c($this->popup, 'questions__add-form-popup'); ?>">
        <div class="wrap">
            <? $form = $this->beginWidget('\CActiveForm', [
                'id' => 'question-add-form',
                'action' => $this->actionUrl,
                'enableClientValidation' => true,
                'clientOptions' => [
                    'validateOnSubmit' => true,
                    'validateOnChange' => false,
                    'afterValidate' => 'js:window.QuestionFormWidget.submitAddForm'
                ]
            ]); ?>

            <div class="cbHead">
                <p>
                    <?= $t('form.add.title'); ?>
                </p>
            </div>

            <div>
                <?php echo $form->textField($model, 'username', array('class' => 'inpt', 'placeholder' => $t('form.username'))); ?>
                <?php echo $form->error($model, 'username'); ?>
            </div>

            <div>
                <?php echo $form->textArea($model, 'question', array('class' => 'inpt', 'placeholder' => $t('form.question'))); ?>
                <?php echo $form->error($model, 'question'); ?>
            </div>

            <div class="modal-form__footer">
                <div>
                    <?php echo $form->checkBox($model, 'privacy_policy', array('class' => 'inpt inpt-privacy_policy')); ?>
                    <?php echo $form->labelEx($model, 'privacy_policy', ['label' => 'Нажимая на кнопку "Отправить", я даю согласие на <a target="_blank" href="' . \Yii::app()->createUrl('/site/page', ['id' => \D::cms('privacy_policy')]) . '">обработку персональных данных</a>']); ?>
                    <?php echo $form->error($model, 'privacy_policy'); ?>
                </div>

                <div class="buttons" data-js="buttons">
                    <?= CHtml::submitButton($tbtn('send'), ['class' => 'btn']); ?>
                    <div class="error__result" data-js="result-errors"></div>
                </div>
            </div>

            <? $this->endWidget(); ?>
        </div>
    </div>
</div>
