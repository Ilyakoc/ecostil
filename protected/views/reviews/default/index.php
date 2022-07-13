<?
/** @var \reviews\controllers\DefaultController $this */
/** @var \CActiveDataProvider[\reviews\models\Review] $dataProvider */
use reviews\models\Settings;
?>

<div class="reviews">
	<div class="reviews__header">
		<h1 class="reviews__title">
			<?= $this->getHomeTitle(); ?>
		</h1>

		<div class="reviews__add-review">
			<? $this->widget('\reviews\widgets\NewReviewForm', ['actionUrl'=>$this->createUrl('addReview')]); ?>
		</div>
	</div>

	<div class="reviews__text is_read_more">
		<?= Settings::model()->index_page_content; ?>
	</div>

	<div class="reviews__list">
		<? $this->renderPartial('_reviews_listview', compact('dataProvider')); ?>
	</div>
</div>
