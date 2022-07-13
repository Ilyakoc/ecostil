<? use common\components\helpers\HYii as Y; ?>
<div class="search search_in-page">
    <form id="search" action="<?= $this->owner->createUrl('search/index') ?>" role="search">
		<?= \CHtml::textField(Y::config('search', 'queryname'), \Yii::app()->request->getQuery('q'), [
			'placeholder'=>$this->placeholder,
			'id'=>$this->id,
			'autocomplete'=>'off'
		]); ?>
        <div class="search__button">
            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.979 2.75503C14.3555 2.75503 17.0928 5.49227 17.0928 8.86882C17.0928 12.2454 14.3555 14.9826 10.979 14.9826C7.60241 14.9826 4.86517 12.2454 4.86517 8.86882C4.86517 5.49227 7.60241 2.75503 10.979 2.75503ZM19.1348 8.86882C19.1348 4.36449 15.4833 0.713013 10.979 0.713013C6.47463 0.713013 2.82315 4.36449 2.82315 8.86882C2.82315 13.3731 6.47463 17.0246 10.979 17.0246C15.4833 17.0246 19.1348 13.3731 19.1348 8.86882Z" fill="#B3B3B3"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.44031 20.287L7.34082 14.3865L5.90111 12.9468L0.000595093 18.8473L1.44031 20.287Z" fill="#B3B3B3"/>
            </svg>
        </div>
	</form>
</div>
<script>
    $(document).ready(function (){
        $('.search__button').click(function (){
            $(this).closest('form').submit();
        })
    })
</script>
