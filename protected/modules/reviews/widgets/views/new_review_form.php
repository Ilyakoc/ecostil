<?php
/** @var \reviews\widgets\NewReviewForm $this */

/** @var \reviews\models\Review $model */

use common\components\helpers\HYii as Y;
use common\components\helpers\HArray as A;

$t = Y::ct('ReviewsModule.widgets/new_review_form', 'new_review_form');
$tbtn = Y::ct('CommonModule.btn', 'common');
?>
<? if ($this->popup): ?>
    <span class="reviews__add-wrapper">
    <a data-auto-focus="false" class="btn" href="javascript:;" data-src="#fancybox-review-add-form"
       data-js="add-review"><?= $t('btn.add'); ?></a>
</span>
<? endif; ?>

<div style="display: none;">
    <div id="fancybox-review-add-form"
         class="modal-form reviews__add-form<?= Y::c($this->popup, 'reviews__add-form-popup'); ?>">
        <div class="wrap">
            <? $form = $this->beginWidget('\CActiveForm', [
                'id' => 'review-add-form',
                'action' => $this->actionUrl,
                'enableClientValidation' => true,
                'clientOptions' => [
                    'validateOnSubmit' => true,
                    'validateOnChange' => false,
                    'afterValidate' => 'js:window.NewReviewFormWidget.submitAddForm'
                ]
            ]); ?>

            <div class="cbHead">
                <p>
                    <?= $t('form.add.title'); ?>
                </p>
            </div>

            <div>
                <?php echo $form->textField($model, 'author', array('class' => 'inpt', 'placeholder' => 'Имя')); ?>
                <?php echo $form->error($model, 'author'); ?>
            </div>

            <div>
                <?php echo $form->textArea($model, 'detail_text', array('class' => 'inpt', 'placeholder' => 'Ваш отзыв')); ?>
                <?php echo $form->error($model, 'detail_text'); ?>
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
            <div class="callback__answer" style="display: none">
                <div class="callback__header" style="margin-bottom: 0;">Спасибо за оставленный отзыв</div>
            </div>
        </div>
    </div>
</div>
