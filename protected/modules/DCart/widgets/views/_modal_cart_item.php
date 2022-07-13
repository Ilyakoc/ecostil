<?php
/** @var \DCart\widgets\CartWidget $this */
/** @var \DCart\components\DCart $cart */
/** @var string $hash cart item hash */
/** @var string $data cart item data */
?>
<div class="adaptive-cart__item js-mcart-item" data-hash="<?=$hash?>">
    <div class="row">
      <div class="col-xs-4 col-sm-2">
      	<div class="adaptive-cart__images">
      		<?=CHtml::image($cart->getImage($hash), '', ['class'=>'img-responsive'])?>
      	</div>
      </div>

      <div class="col-xs-8 col-sm-10">
        <div class="row">
          <div class="col-xs-12 col-sm-3">
         		<div class="adaptive-cart__name">
         		<?=\CHtml::link(
					$data['attributes'][$cart->attributeTitle],
					array('shop/product', 'id'=>$data[$cart->attributeId]),
					array('title'=>$data['attributes'][$cart->attributeTitle])
				)?><br>
				<?php
				// вывод дополнительных аттрибутов
				foreach($cart->getAttributes(true, false, true) as $attribute):
					list($label, $value) = $cart->getAttributeValue($hash, $attribute, true);
					if($value):?>
						<p><small>
							<?=D::c($label, mb_strtolower($label).':')?>
							<i><?=$value?></i>
						</small></p>
					<?endif;
				endforeach;
				?>
         		</div>
          </div>
          <div class="col-xs-12 col-sm-2 count">
          	<div class="adaptive-cart__count number">
            	<span class="cart__count-down cart__count-btn glyphicon glyphicon-minus down"></span>
            	<?=\CHtml::textField('count', $data['count'], ['data-hash'=>$hash, 'size'=>7,'maxlength'=>20, 'class'=>'cart__count-input']);?>
            	<span class="cart__count-up cart__count-btn glyphicon glyphicon-plus up"></span>
	          </div>
          </div>
          <div class="col-xs-12 col-sm-3">
          	<div class="adaptive-cart__unit-price">
          		<span class="adaptive-cart__price unit-price"><?=HtmlHelper::priceFormat($data['price'])?></span>
          		<span class="adaptive-cart__price-cur">руб./шт.</span></div>
          </div>
          <div class="col-xs-12 col-sm-3">
          	<div class="adaptive-cart__total-price">
          		<span class="adaptive-cart__price total-price"><?=HtmlHelper::priceFormat($data['count']*$data['price'])?></span>
          		<span class="adaptive-cart__price-cur">руб.</span></div>
          </div>
          <div class="col-xs-12 col-sm-1">
          	<div class="adaptive-cart__delite">
            	<?=\CHtml::link('', 'javascript:;', array(
					'class'=>'glyphicon glyphicon-remove js-mcart-btn-remove',
					'title'=>'Удалить',
					'data-hash'=>$hash
				))?>
          	</div>
          </div>
        </div>
      </div>
    </div>
</div>