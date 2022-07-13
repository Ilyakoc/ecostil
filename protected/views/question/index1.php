<?
/** @var QuestionController $this */
?>

<div class="questions">
    <div class="questions__header">
        <h1 class="questions__title">
            <?= Yii::t('app', 'FAQ') ?>
        </h1>

        <div class="questions__add-question">
            <? $this->widget('widget.question.QuestionForm', ['actionUrl' => $this->createUrl('addQuestion')]); ?>
        </div>
    </div>

    <div class="question__list show-more">
        <? $this->renderPartial('_listview', compact('dataProvider')); ?>
    </div>
</div>
