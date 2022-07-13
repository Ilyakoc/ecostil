<?php
/** @var \reviews\controllers\DefaultController $this */
/** @var \CActiveDataProvider[\reviews\models\Review] $dataProvider */
use common\components\helpers\HYii as Y;

$t=Y::ct('ReviewsModule.controllers/default');
$tcl=Y::ct('CommonModule.labels', 'common');
?>

<div class="reviews-list" id="listView">
	<?
	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$dataProvider,
	    'itemView'=>'_reviews_item',
	    'ajaxUpdate'=>false,
			'itemsCssClass'=>'reviews-list__items',
	    'template'=>"{items}\n{pager}",
	));
	?>
</div>

<?php if ($dataProvider->totalItemCount > $dataProvider->pagination->pageSize): ?>

    <p id="loading" style="display:none"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loader.gif" alt="" /></p>
		<div class="reviews-list__show-more">
			<span id="showMore">
				<svg width="8" height="19" viewBox="0 0 8 19" fill="" xmlns="http://www.w3.org/2000/svg">
					<path d="M3.64645 18.3536C3.84171 18.5488 4.15829 18.5488 4.35355 18.3536L7.53553 15.1716C7.7308 14.9763 7.7308 14.6597 7.53553 14.4645C7.34027 14.2692 7.02369 14.2692 6.82843 14.4645L4 17.2929L1.17157 14.4645C0.976311 14.2692 0.659729 14.2692 0.464467 14.4645C0.269205 14.6597 0.269205 14.9763 0.464467 15.1716L3.64645 18.3536ZM3.5 2.18557e-08L3.5 18L4.5 18L4.5 -2.18557e-08L3.5 2.18557e-08Z" />
				</svg>
				<span>Показать ещё</span>
			</span>
		</div>


    <script type="text/javascript">
    /*<![CDATA[*/
        (function($)
        {
            // скрываем стандартный навигатор
            $('.pager').hide();

            // запоминаем текущую страницу и их максимальное количество
            var page = parseInt('<?php echo (int)Yii::app()->request->getParam('page', 1); ?>');
            var pageCount = parseInt('<?php echo (int)$dataProvider->pagination->pageCount; ?>');

            var loadingFlag = false;

            $('#showMore').click(function()
            {
                // защита от повторных нажатий
                if (!loadingFlag)
                {
                    // выставляем блокировку
                    loadingFlag = true;

                    // отображаем анимацию загрузки
                    $('#loading').show();

                    $.ajax({
                        type: 'post',
                        url: window.location.href,
                        data: {
                            // передаём номер нужной страницы методом POST
                            'page': page + 1,
                            '<?php echo Yii::app()->request->csrfTokenName; ?>': '<?php echo Yii::app()->request->csrfToken; ?>'
                        },
                        success: function(data)
                        {
                            // увеличиваем номер текущей страницы и снимаем блокировку
                            page++;
                            loadingFlag = false;

                            // прячем анимацию загрузки
                            $('#loading').hide();

                            // вставляем полученные записи после имеющихся в наш блок
                            $('#listView').append(data);

                            // если достигли максимальной страницы, то прячем кнопку
                            if (page >= pageCount)
                                $('#showMore').hide();
                        }
                    });
                }
                return false;
            })
        })(jQuery);
    /*]]>*/
    </script>

<?php endif; ?>
