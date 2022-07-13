<?php CmsHtml::fancybox(); ?>
<?php
use ext\D\image\components\behaviors\ImageBehavior;
$session=new CHttpSession;
//запись в сессию
$session->open();

//добавление элемента
$session['id3'] .=$product->id;
$session['id3'] .= ', ';
$str = $session['id3'];
$arr = array_unique(explode(', ',$str));

if(count($arr)>6){
    $newarr = array_slice($arr, 1);
    $session['id3'] = implode(', ',$newarr);
} else {
    $session['id3'] = implode(', ',$arr);
}

$session->close();
?>

<div class="product-page">
	<div class="images">
		<?php if (!Yii::app()->user->isGuest) echo CHtml::link('редактировать', array('cp/shop/productUpdate', 'id' => $product->id), array('class' => 'btn-product-edit', 'target' => 'blank')); ?>
		<div class="js__main-photo product-main-img">
			<div class="ico-box">
				<? foreach (['sale'=>'sale', 'new'=>'new', 'hit'=>'hit'] as $attribute=>$cssClass) { if(!$product->$attribute) continue; ?>
				<div class="ico <?= $cssClass ?>"></div>
				<? } ?>
			</div>
			<?php if ($product->mainImageBehavior->isEnabled()) : ?>
				<?= CHtml::link(CHtml::image(ResizeHelper::resize($product->getSrc(), 900, 1300), $product->mainImageBehavior->getAlt(), ['title' => $product->mainImageBehavior->getAlt()]), $product->mainImageBehavior->getSrc(), ['class' => 'image-full', 'data-fancybox' => 'group']); ?>
				<?endif?>
				<div class="main-img-zoom">
					<svg width="33" height="34" viewBox="0 0 33 34" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M18.9351 3.54704C24.7582 3.54704 29.4788 8.30171 29.4788 14.1669C29.4788 20.0321 24.7582 24.7867 18.9351 24.7867C13.112 24.7867 8.39138 20.0321 8.39138 14.1669C8.39138 8.30171 13.112 3.54704 18.9351 3.54704ZM33.0004 14.1669C33.0004 6.34273 26.7031 0 18.9351 0C11.167 0 4.86977 6.34273 4.86977 14.1669C4.86977 21.9911 11.167 28.3338 18.9351 28.3338C26.7031 28.3338 33.0004 21.9911 33.0004 14.1669Z" fill="#F2E5D2" />
						<path d="M10.7409 25.6827C9.7852 24.9916 8.91905 24.1827 8.16336 23.2772L1.24381 30.2468C0.557402 30.9381 0.557401 32.0602 1.24381 32.7516C1.92867 33.4414 3.03787 33.4414 3.72273 32.7516L10.7409 25.6827Z" fill="#F2E5D2" />
						<path d="M18.9574 8.5V14.5208M18.9574 14.5208V20.5417M18.9574 14.5208H24.5744M18.9574 14.5208H13.3403" stroke="#F2E5D2" stroke-width="3" stroke-linecap="round" />
					</svg>
				</div>
		</div>

		<div class="more-images">
			<?foreach($product->moreImages as $id=>$img):?>
			<div class="more-images-item">
				<a class="image-full" data-fancybox="group" href="<?= $img->url ?>" title="<?= $img->description ?>"><?= CHtml::image(ResizeHelper::resize($img->tmbUrl, 65, 100), $img->description); ?></a>
			</div>
			<?endforeach?>
		</div>
	</div>
	<div class="product-page__right">
		<h1><?= $product->getMetaH1() ?></h1>
		<div class="options">

			<?if(!empty($product->brand_id)):?>
			<div class="product-brand">
				<strong>Бренд:</strong> <?= $product->brand->title ?>
			</div>
			<?endif?>
			<?if(!empty($product->code)):?>
			<div class="product-code">
				<strong>Артикул:</strong> <?= $product->code ?>
			</div>
			<?endif?>

		<div class="buy">

			<p class="order__price">
				<? if(D::cms('shop_enable_old_price')): ?>
				<?php if ($product->old_price > 0) : ?>
					<span class="old_price"><?= HtmlHelper::priceFormat($product->old_price); ?>
						<i class="rub">руб</i>
					</span>
				<?php endif; ?>
				<? endif; ?>
				<span class="new_price"><?= HtmlHelper::priceFormat($product->price); ?>
					<span class="rub">руб</span>
				</span>
			</p>

			<div class="buy__buy">
				<div class="counter_number">
					<span class="counter_numbe_minus">-</span>
					<input type="text" name="counter" value="1" class="counter_number_input counter_input total-num" id="js-product-count-<?= $data->id ?>" maxlength="4" disabled>
					<span class="counter_number_plus">+</span>
				</div>

				<?if($product->notexist):?>
				нет в наличии
				<?else:?>
				<?php $this->widget('\DCart\widgets\AddToCartButtonWidget', array(
					'id' => $product->id,
					'model' => $product,
					'title' => '<span>В корзину</span>',
					'cssClass' => 'btn shop-button to-cart button_1 js__photo-in-cart open-cart',
					'attributes' => [
						// ['count', '.counter_input'],
					]
				));
				?>
				<?endif?>
			</div>
		</div>
		</div>
		<div class="clr"></div>
        <?if(D::yd()->isActive('shop') && (int)D::cms('shop_enable_attributes') && count($product->productAttributes)):?>
            <div class="product-attributes">
                <ul>
                    <?php foreach ($product->productAttributes as $productAttribute) : ?>
                        <li><span><?= $productAttribute->eavAttribute->name; ?>: </span><span><?= $productAttribute->value; ?></span></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
		<?if(!empty($product->description)):?>
		<div class="description">
			<?= $product->description ?>
		</div>
		<?endif?>
	</div>
</div>

<div class="tabs">
    <div class="left-border"></div>
    <input type="radio" name="tab-btn" id="tab-btn-1" value="" checked>
    <label for="tab-btn-1">с этим товаром покупают</label>
    <?php
    $session=new CHttpSession;
    //получение товаров
    $session->open();

    $str = $session['id3'];
    $arr = array_unique(explode(', ',$str));

    $session->close();

    //print_r($arr);
    //die();
    if($arr[2] != []) {?>
    <input type="radio" name="tab-btn" id="tab-btn-2" value="">
    <label for="tab-btn-2">вы смотрели</label>
    <?php }?>
    <div class="right-border"></div>
    <div id="content-1">
        <div class = "product-list row with-buy" style = "margin-left:0;">
            <?
            $sql = "SELECT `product_add` FROM `with_product` WHERE `product_id` = $product->id";
            $connection=Yii::app()->db; // так можно делать, если в конфигурации настроен компонент соединения "db"
            $command=$connection->createCommand($sql);
            $rows=$command->queryAll();
            ?>
            <? foreach ($rows as $row) {
                $criteria=new CDbCriteria;
                $criteria->condition = "id = :id";
                $criteria->params = array (
                    ':id' => $row['product_add'],
                );
                //$criteria->addCondition('date', $object);
                $data = Product::model()->find($criteria);?>

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

            <? }?>
        </div>
    </div>
    <?if($arr[2] != []) {?>
    <div id="content-2">
        <div class="data-php" data-attr="<?=$arr[3]; ?>"></div>
        <div class = "look-products product-list row" style = "margin-left:0;">
            <?php



            for($i=count($arr)-3; $i>=0; $i--){
                $id=$arr[$i];
                $data = Product::model()->visibled()->findByPk($id);
                if (empty($category)) $categoryId = $product->category_id;
                else $categoryId = $category->id;
                $productUrl = Yii::app()->createUrl('shop/product', ['id' => $product->id, 'category_id' => $categoryId]);?>

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
            <?php	}
            ?>
        </div>
    </div>
    <?php }?>
</div>
<?if(D::cms('shop_enable_reviews')) $this->widget('widget.productReviews.ProductReviews', array('product_id' => $product->id))?>