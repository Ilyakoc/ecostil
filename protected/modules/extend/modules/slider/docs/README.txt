Инструкция по установке и использованию модуля
----------------------------------------------------------------------------
Содержание:
I. УСТАНОВКА
II. ИСПОЛЬЗОВАНИЕ

----------------------------------------------------------------------------
I. УСТАНОВКА
----------------------------------------------------------------------------
1) Добавить в основную конфигурацию protected\config\crud.php
return [
	...
	'application.modules.extend.modules.slider.config.crud.main_static'
];

main_static - с учетом прав доступа. Администратор может добавлять и редактировать слайдеры, 
менеджер может только управлять слайдами и активностью слайдеров.

main - полный доступ.

2) Добавьте пункт меню, при необходимости в раздел администрирования
protected\modules\admin\config\menu.php
use crud\components\helpers\HCrud;
...
	'modules'=>[
		HCrud::getMenuItems(Y::controller(), 'slider', 'crud/index', true)


----------------------------------------------------------------------------
II. ИСПОЛЬЗОВАНИЕ
----------------------------------------------------------------------------
Пример 1.
"main" - это код слайдера
<?php \extend\modules\slider\components\helpers\HSlider::widget('main'); ?>

Пример 2.
Параметр "code" - код слайдера
<?php $this->widget('\extend\modules\slider\widgets\Slick', ['code'=>'main', 'config'=>'banner']); ?>

Пример 3.
Произвольный слайдер. Отображение слайдера будет выполнено только если есть хоть один активный слайд.
Подключение Slick произоводится на CSS класс "slider__символьныйкодслайдера", напр. "slider__main".
Зарезервированные свойства слайда:
src ссылка на преобразованное изображение
src_origin ссылка на оригинальное изображение
alt - подпись для слайда (SEO значение для атрибута TITLE, ALT)
url - ссылка слайда 

Слайдер кэшируется. Для отключения кэша нужно передать параметр "cache"=>false
Дополнительные опции для slick слайдера передается в параметре "options"=>[]
Упрощенный код

<?php $this->widget('\extend\modules\slider\widgets\Slider', ['code'=>'main', 'content'=>function($slides) {
	?>
	<section class="slider">
		<div class="slider__main">
		<? foreach($slides as $slide) { ?>
			<div>
				<div class="slider__main-item">
					<a href="<?=$slide->url?:'#'?>">
						<img src="<?=$slide->src?>" alt="<?=$slide->alt?>" title="<?=$slide->alt?>" />
						<div class="slider__item-box">
							<div class="slider__item-header"><?=$slide->title?></div>
							<div class="slider__item-desc"><?=$slide->desc?></div>
						</div>
					</a>
				</div>
			</div>
		<? } ?>
		</div>
	</section>	
<?php }, 'cache'=>true, 'options'=>[
	'dots' => false,
]]); ?>

Код с проверками

<?php $this->widget('\extend\modules\slider\widgets\Slider', ['code'=>'main', 'content'=>function($slides) {
	?>
	<section class="slider">
		<div class="slider__main slider__container">
		<? foreach($slides as $slide) { ?>
			<div class="slider__main-item">
			<? if($slide->url) { ?><a href=<?=$slide->url?> class="slider__item"><? } ?>
				<img src="<?=$slide->src?>" alt="<?=$slide->alt?>" title="<?=$slide->alt?>" />
				<? if($slide->title || $slide->desc) { ?>
					<div class="slider__item-textbox">
					<? if($slide->title) { ?>
						<div class="slider__item-header"><?=$slide->title?></div>
					<? } ?>
					<? if($slide->desc) { ?>
						<div class="slider__item-desc"><?=$slide->desc?></div>
					<? } ?>
					</div>
				<? } ?>
			<? if($slide->url) { ?></a><? } ?>
			</div>
		<? } ?>
		</div>
	</section>	
<?php }, 'cache'=>true, 'options'=>[
	'dots' => false,
]]); ?>