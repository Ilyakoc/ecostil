<?php if (Yii::app()->user->hasFlash('contact')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>
<?php else: ?>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'contact-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false
        ),
    )); ?>
    <div class="contact-row">
        <div class="contact-col">
            <div class="contact-text-input">
                <?php echo $form->textField($model, 'name', array('class' => 'inpt', 'placeholder' => $model->attributeLabels()['name'])); ?>
                <?php echo $form->error($model, 'name'); ?>
            </div>
            <div class="contact-text-input">
                <?php echo $form->textField($model, 'email', array('class' => 'inpt', 'placeholder' => $model->attributeLabels()['email'])); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>
            <div class="contact-text-input">
                <?php echo $form->textField($model, 'phone', array('class' => 'inpt', 'placeholder' => $model->attributeLabels()['phone'])); ?>
                <?php echo $form->error($model, 'phone'); ?>
            </div>
        </div>
        <div class="contact-col">

                <?php echo $form->textArea($model, 'body', array('class' => 'inpt', 'placeholder' => $model->attributeLabels()['body'])); ?>
                <?php echo $form->error($model, 'body'); ?>

        </div>
    </div>
    <div class="contact-row contact-row-last">
        <div class="contact-col">
            <?php echo $form->checkBox($model, 'privacy_policy', array('class' => 'inpt inpt-privacy_policy')); ?>
            <?php echo $form->labelEx($model, 'privacy_policy', ['label' => 'Нажимая на кнопку "Отправить", я даю согласие на <a target="_blank" href="' . \Yii::app()->createUrl('/site/page', ['id' => \D::cms('privacy_policy')]) . '"><br />обработку персональных данных</a>']); ?>
            <?php echo $form->error($model, 'privacy_policy'); ?>
        </div>
        <div class="contact-col">
            <div style="text-align: right">
            <?php echo CHtml::submitButton('Отправить', [
                'class' => 'btn',
                'id' => $model->recaptchaBehavior->attachReCaptchaBySubmitButton()
            ]); ?>
            </div>
        </div>
    </div>


    <!--    <div class="note">Поля отмеченные <span class="required">*</span> обязательны для заполнения.</div>-->
    <?php echo $form->hiddenField($model, 'verifyCode'); ?>

    <script type="text/javascript">
        $(function () {
            $('#contact-form :submit').click(function () {
                $('#ContactForm_verifyCode').val('test_ok');
            });
        });
    </script>
    <?php $this->endWidget(); ?>
<?php endif; ?>
