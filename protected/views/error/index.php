<? 
/** @var int $code код ошибки */ 
?>
<div class="page-content">
    <div class="page-content__container container">
        <div class="server-error">
            <div class="error__number"><?php echo $code ?></div>
            <div class="error__title"><?= \Yii::t('error', 'error.title.' . $code) ?></div>
            <div class="error__text"><?= \Yii::t('error', 'error.text.' . $code) ?></div>
            <div class="error__back-link">
                <a class="btn" href="/">Вернуться на главную</a>
            </div>
        </div>
    </div>
</div>