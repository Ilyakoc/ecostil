<?php
/** @var $this refers to the owner of this list view widget. For example, if the widget is in the view of a controller, then $this refers to the controller. */
/** @var $data refers to the data item currently being rendered. */
/** @var $index refers to the zero-based index of the data item currently being rendered. */
/** @var $widget refers to this list view widget instance. */
use reviews\models\Settings;
use common\components\helpers\HYii as Y;
use common\components\helpers\HHtml;

?>
<div class="reviews-item">
	<div class="reviews-item__quotes">
		<svg width="26" height="24" fill="" viewBox="0 0 26 24" xmlns="http://www.w3.org/2000/svg">
			<path d="M10.8448 23.528H0V14.3616C0 6.8 2.89939 2.8016 10.3151 0L10.6218 0.7888C3.51272 3.4544 0.86424 7.1264 0.86424 14.3616V22.6848H10.8448V23.528ZM10.8448 13.464H4.73938L4.7115 13.0832C4.34908 8.4592 6.24483 5.712 11.7369 2.992L12.1272 3.7264C7.16483 6.2016 5.35271 8.6496 5.54786 12.6208H10.8448V13.464ZM25.0908 23.528H12.7127V14.3616C12.7127 6.8 15.6121 2.8016 23.0557 0L23.3624 0.7888C16.2254 3.4544 13.5769 7.1264 13.5769 14.3616V22.6848H24.2266V13.464H17.4799L17.4521 13.0832C17.0618 8.4592 18.9575 5.712 24.4496 2.992L24.8399 3.7264C19.8775 6.2016 18.0654 8.6496 18.2606 12.6208H25.063L25.0908 23.528Z"/>
		</svg>
	</div>
	<div class="reviews-item__content">
		<div class="reviews-item__date">
			<?= Y::formatDateVsRusMonth($data->publish_date); ?>
		</div>

		<div class="reviews-item__author">
			<?= $data->author; ?>
		</div>

		<div class="reviews-item__text">
			<div class="reviews-item__preview">
				<?= $data->preview_text; ?>
				<? if ($data->preview_text != $data->detail_text): ?>
					<span class="reviews-item__read-all">Читать полностью</span>
				<? endif ?>
			</div>

			<? if($data->preview_text != $data->detail_text): ?>
			<div class="reviews-item__full">
				<?= $data->detail_text; ?>
				<span class="reviews-item__read-all">Скрыть</span>
			</div>
			<? endif ?>
		</div>
	</div>
</div>
