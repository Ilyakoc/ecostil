<?
use settings\components\helpers\HSettings;
$shopSettings=HSettings::getById('shop');

if(D::role('admin')) CmsHtml::editPricePlugin();
?>

<div class="shop-content">
	<div class="catalog-menu">
		<div class="catalog-menu__title">Каталог товаров</div>
		<?php $this->widget('widget.ShopCategories.ShopCategories') ?>
        <?php $this->widget('widget.filters.AFilters') ?>
	</div>
	<div class="shop-content__prod">
		<h1><?= $category->getMetaH1() ?></h1>

		<? if(!empty($brand)): ?>
		<div class="brand__category">
			<h2><span>Бренд</span><?= CHtml::link($brand->title, '/brands/' . $brand->alias); ?></h2>
			<div class="brand__info">
				<div class="brand__logo"><img src="<?= $brand->getSrc(); ?>" /></div>
				<div class="brand__preview-text"><?= $brand->preview_text; ?></div>
			</div>
		</div>
		<? else: ?>
		<? if(D::cms('shop_show_categories') && $category->isShowCategoriesList()): ?>
		<? $this->widget('widget.catalog.CategoryListWidget', ['id'=>$category->id]); ?>
		<? endif; ?>
		<? endif; ?>

		<?if($category->description && (D::cms('shop_pos_description') <> 1)):?>
		<div id="category-description" class="category-description">
			<?= $category->description ?>
		</div>
		<?endif?>

		<div id="product-list-module">
			<?$this->renderPartial('_products_listview', compact('model', 'category'))?>
		</div>
	</div>
</div>
<?php
$session=new CHttpSession;
//получение товаров
$session->open();

$str = $session['id3'];
$arr = array_unique(explode(', ',$str));

$session->close();

if($arr[1] != []) {?>
    <h1 style = "padding-top: 30px;">Вы смотрели</h1>
<?php }?>
<div class="data-php" data-attr="<?=$arr[3]; ?>"></div>
<div class = "look-products product-list row" >
    <?php

    use ext\D\image\components\behaviors\ImageBehavior;
    $max=0;
    for($i=count($arr)-2; $i>=0; $i--){
        if($max == 4 ) break;
        $max++;
        $id=$arr[$i];
        $data = Product::model()->visibled()->findByPk($id);
        if (empty($category)) $categoryId = $data>category_id;
        else $categoryId = $category->id;
        $productUrl = Yii::app()->createUrl('shop/product', ['id' => $data->id, 'category_id' => $categoryId]);?>

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
<?if($category->description && (D::cms('shop_pos_description') == 1)):?>
    <div id="category-description" class="category-description">
        <?= $category->description ?>
    </div>
<?endif?>