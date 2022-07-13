<?php

/** @var \DCart\widgets\CartWidget $this */
/** @var \DCart\components\DCart $cart */
?>
<?if($cart->isEmpty()):?>
<div class="dcart-mcart-empty">
	Ваша корзина пуста
</div>
<?else:?>
<div class="adaptive-cart-page clearfix js-dcart-mcart">

	<div class="adaptive-cart__head d-none d-sm-block">
		<div class="row">
			<div class="col-4 col-sm-2">Фото</div>
			<div class="col-8 col-sm-10">
				<div class="row">
					<div class="col-12 col-sm-3">Товар</div>
					<div class="col-12 col-sm-2 text-center">Количество</div>
					<div class="col-12 col-sm-3">Цена</div>
					<div class="col-12 col-sm-3">Сумма</div>
					<div class="col-12 col-sm-1"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="js-dcart-items">
		<?foreach($cart->getData() as $hash=>$data) $this->render('_modal_cart_item', compact('cart', 'hash', 'data'));?>
	</div>

	<div class="adaptive-cart__total-value-box">
		<div class="row">
			<div class="col-6">Итоговая цена:</div>
			<div class="col-6 text-right">
				<span class="adaptive-cart__total-value dcart-total-price"><?= HtmlHelper::priceFormat($cart->getTotalPrice()) ?></span> руб.
			</div>
		</div>
	</div>
	<div class="adaptive-cart__link-order">
		<div class="row">
			<div class="col-12 text-center-left">
				<p>Что-то забыли? <a href="/catalog">Хотите вернуться и положить еще?</a></p>
			</div>
		</div>
	</div>
	<!-- <div class="adaptive-cart__link-order">
		<div class="row">
			<div class="col-12 text-center">
				<a href="/order" class="btn">Оформить заказ</a>
			</div>
		</div>
	</div> -->

</div>
<?endif?>