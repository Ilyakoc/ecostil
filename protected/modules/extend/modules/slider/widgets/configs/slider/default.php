<?php
/**
 * Конфигурация для виджета Slider.
 * "По умолчанию"
 *
 * @var \extend\modules\slider\widgets\Slider $widget
 */

return [
	'options'=>[
	 	'prevArrow' => '<button type="button" class="slick-prev slick-arrow">&#10229;</button>',
        'nextArrow' => '<button type="button" class="slick-next slick-arrow">&#10230;</button>',
        'dots' => true,
        'speed' => 1300,
        'autoplay' => true,
        'autoplaySpeed' => 5000,
        'infinite' => false,
        'slidesToShow' => 1,
        'slidesToScroll' => 1
    ]
];
