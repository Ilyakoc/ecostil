<?
/**
 * @var Product $data
 */
$cache=\Yii::app()->user->isGuest;
if(!$cache || $this->beginCache('shop__product_card', ['varyByParam'=>[$data->id]])): // cache begin

if(empty($category)) $categoryId=$data->category_id;
else $categoryId=$category->id;
$productUrl=Yii::app()->createUrl('shop/product', ['id'=>$data->id, 'category_id'=>$categoryId]);
?>
<div class="product-item">
	<? if(!\Yii::app()->user->isGuest) echo CHtml::link('редактировать', ['/cp/shop/productUpdate', 'id'=>$data->id], ['class'=>'btn-product-edit', 'target'=>'_blank']); ?>
	<div class="product">
		<div class="ico-box">
			<? foreach (['sale'=>'sale', 'new'=>'new', 'hit'=>'hit'] as $attribute=>$cssClass) { if(!$data->$attribute) continue; ?>
			<div class="ico <?= $cssClass ?>"></div>
			<? } ?>
		</div>
		<div class="product__image product-block">
			<?= CHtml::link(CHtml::image(ResizeHelper::resize($data->getSrc(), 255, 400)), $productUrl); ?>
		</div>

		<div class="product__price">
			<?php if ($data->price > 0) : ?>
				<p class="order__price">

					<span class="new_price"><?= HtmlHelper::priceFormat($data->price); ?>
						<span class="rub">руб</span>
					</span>
					<? if(D::cms('shop_enable_old_price')): ?>
					<?php if ($data->old_price > 0) : ?>
						<span class="old_price"><?= HtmlHelper::priceFormat($data->old_price); ?>
							<span class="rub">руб</span>
						</span>
					<?php endif; ?>
					<? endif; ?>
				</p>
			<?php endif; ?>
		</div>
		<div class="product__title product-block">
			<?= CHtml::link($data->title, $productUrl, array('title' => $data->link_title)); ?>
		</div>
		<div class="product__to-cart">
			<?if($data->notexist):?>
			Нет в наличии
			<?else:?>
			<div class="counter_number">
				<span class="counter_numbe_minus">-</span>
				<input type="text" name="counter" value="1" class="counter_number_input counter_input total-num" id="js-product-count-<?= $data->id ?>" maxlength="4" disabled>
				<span class="counter_number_plus">+</span>
			</div>
			<?$this->widget('\DCart\widgets\AddToCartButtonWidget', array(
					'id' => $data->id,
					'model' => $data,
					'title'=>'<span>В корзину</span>',
					'cssClass'=>'shop-button to-cart button_1 js__in-cart open-cart btn',
					'attributes'=>[
						['count', '#js-product-count-' . $data->id],
					]
				));
				?>
			<?endif?>
		</div>
	</div>
</div>

<? if($cache) { $this->endCache(); } endif; // cache end ?>