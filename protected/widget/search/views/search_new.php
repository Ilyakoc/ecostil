<? use common\components\helpers\HYii as Y; ?>
<div class="search">
  <div id="search-toggle" class="search__toggle">
    <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M8.15581 2.04201C4.77925 2.04201 2.04201 4.77925 2.04201 8.15581C2.04201 11.5324 4.77925 14.2696 8.15581 14.2696C11.5324 14.2696 14.2696 11.5324 14.2696 8.15581C14.2696 4.77925 11.5324 2.04201 8.15581 2.04201ZM0 8.15581C0 3.65148 3.65148 0 8.15581 0C12.6601 0 16.3116 3.65148 16.3116 8.15581C16.3116 12.6601 12.6601 16.3116 8.15581 16.3116C3.65148 16.3116 0 12.6601 0 8.15581Z" />
      <path fill-rule="evenodd" clip-rule="evenodd" d="M17.6949 19.574L11.7944 13.6735L13.2341 12.2338L19.1347 18.1343L17.6949 19.574Z" />
    </svg>
  </div>

  <div class="search__modal">
    <form class="search__form" id="search" action="<?= \Yii::app()->createUrl('search/index') ?>" role="search">
      <div class="search__ico">
        <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M8.15581 2.04201C4.77925 2.04201 2.04201 4.77925 2.04201 8.15581C2.04201 11.5324 4.77925 14.2696 8.15581 14.2696C11.5324 14.2696 14.2696 11.5324 14.2696 8.15581C14.2696 4.77925 11.5324 2.04201 8.15581 2.04201ZM0 8.15581C0 3.65148 3.65148 0 8.15581 0C12.6601 0 16.3116 3.65148 16.3116 8.15581C16.3116 12.6601 12.6601 16.3116 8.15581 16.3116C3.65148 16.3116 0 12.6601 0 8.15581Z"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M17.6949 19.574L11.7944 13.6735L13.2341 12.2338L19.1347 18.1343L17.6949 19.574Z"/>
        </svg>
      </div>
  		<?= \CHtml::textField(Y::config('search', 'queryname'), \Yii::app()->request->getQuery('q'), [
  			'placeholder'=>'Я ищу ...',
  			'id'=>$this->id,
  			'autocomplete'=>'off',
        'class'=>'search__input'
  		]); ?>
  		<?= \CHtml::submitButton('Найти', ['encode'=>false, 'class'=>'btn btn--small']); ?>
      <div class="search__close" id="search-close">
        <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
          <path d="M9.00005 7.93955L12.7126 4.22705L13.7731 5.28755L10.0606 9.00005L13.7731 12.7126L12.7126 13.7731L9.00005 10.0606L5.28755 13.7731L4.22705 12.7126L7.93955 9.00005L4.22705 5.28755L5.28755 4.22705L9.00005 7.93955Z"/>
        </svg>
      </div>
	   </form>
  </div>
</div>
