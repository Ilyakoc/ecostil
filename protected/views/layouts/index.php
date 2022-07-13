<?php $this->beginContent('//layouts/main'); ?>

<?php if (D::yd()->isActive('slider')): ?>
<?php $this->widget('\extend\modules\slider\widgets\Slider', ['code'=>'main', 'content'=>function($slides) { ?>
    <div class="slider-wrap">
        <section class="slider">
          <div class="catalog-menu">
            <div class="catalog-menu__title">Каталог товаров</div>
            	<?php $this->widget('widget.ShopCategories.ShopCategories') ?>
          </div>
        <div class="slider-m__arrows">
            <div class="slide-prev">
                <img src="images/arrow-prev.svg" alt="">
            </div>

            <div class="slide-next">
                <img src="images/arrow-next.svg" alt="">
            </div>
        </div>
            <div class="slider__main slider__container">
                <?php foreach ($slides as $slide): ?>
                <div class="slider__main-item">
                    <?//php if ($slide->url): ?>
                        <!-- <a href="<?= $slide->url ?>" class="slider__item"> -->
                    <?//php endif; ?>
                        <div class="slider__img" style="background-image:url(<?= $slide->src ?>)"
                             alt="<?= $slide->alt ?>" title="<?= $slide->alt ?>">
                          	<div class="container">
                              	<?php if ($slide->title || $slide->desc): ?>
                                <div class="slider__item-textbox">
                                    <?php if ($slide->title): ?>
                                        <div class="slider__item-header"><?= $slide->title ?></div>
                                    <?php endif; ?>
                                    <? if ($slide->desc): ?>
                                        <div class="slider__item-desc"><?= $slide->desc ?></div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                          	</div>
                        </div>
                    <?//php if ($slide->url): ?></a>
                        <?//php endif; ?>
                </div>
            <? endforeach; ?>
            </div>
        </section>
<?php }, 'cache'=>false, 'options'=>[
        'dots' => true,
        'infinite' => true,
        'autoplay' => true,
        'prevArrow'=> '.slide-prev',
        'nextArrow'=> '.slide-next',

        // 'responsive' => [[
        //     'breakpoint'=> 414,
        //     'settings'=> [
        //         'arrows'=> false,
        //         'slidesToShow'=> 2,
        //         'dots' => true,
        //     ]
        // ]],
        
]]); ?>
<?php else: ?>


<div class="banner">
    <div class="banner__slider">
        <div class="banner__item banner__item-wide">
            <div class="banner__img" style="background-image: url('/images/img/img/banner.jpg');">
                <div class="container">
                    <div class="catalog-menu">
                        <div class="catalog-menu__title">Каталог товаров</div>
                            <?php $this->widget('widget.ShopCategories.ShopCategories') ?>
                    </div>
                    <div class="banner__text">
                        Одежда и аксессуары из монгольского кашемира, французского хлопка, белорусского и итальянского льна
                    </div>
                    <img class="banner__sub1" src="/images/img/img/banner1.jpg" alt="banner1">
                    <img class="banner__sub2" src="/images/img/img/banner2.jpg" alt="banner2">
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<div class="index-content">
    <div class="container">
        <div class="index-content__wrapper">
            <sidebar class="sidebar">
                <?php if (D::cms('hide_news') == false): ?>
                    <?php $this->widget('widget.Events.Events') ?>
                <? endif ?>
            </sidebar>
            <div class="index-content__content">
                <?=$content?>
            </div>
        </div>
    </div>
</div>


<?php $this->endContent();?>
