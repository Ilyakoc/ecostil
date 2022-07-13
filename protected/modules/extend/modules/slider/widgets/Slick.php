<?php
/**
 * Виджет слайдера, используеющего плагин Slick.
 * 
 */
namespace extend\modules\slider\widgets;

use common\components\helpers\HYii as Y;

class Slick extends \extend\modules\slider\components\base\SliderWidget
{
    /**
     * {@inheritDoc}
     * @see \extend\modules\slider\components\base\SliderWidget::$tagOptions
     */
    public $tagOptions=['class'=>'slick__slider'];
    
    /**
     * {@inheritDoc}
     * @see \extend\modules\slider\components\base\SliderWidget::$tagOptions
     */
    public $itemsTagName='div';
    
    /**
     * {@inheritDoc}
     * @see \extend\modules\slider\components\base\SliderWidget::$itemsOptions
     */
    public $itemsOptions=['class'=>'slick__slider-items'];
    
    /**
     * {@inheritDoc}
     * @see \extend\modules\slider\components\base\SliderWidget::$tagOptions
     */
    public $itemTagName='div';
    
    /**
     * {@inheritDoc}
     * @see \extend\modules\slider\components\base\SliderWidget::$itemOptions
     */
    public $itemOptions=['class'=>'slick__slider-item'];
    
	/**
     * {@inheritDoc}
     * @see \extend\modules\slider\components\base\SliderWidget::$config
     */
    public $config='default';
    
    /**
     * {@inheritDoc}
     * @see \extend\modules\slider\components\base\SliderWidget::init()
     */
    public function init()
    {
        parent::init();

        if($this->jsLoad) { 
            Y::jsCore('slick');
        }
        
        $this->registerScript('$("'.$this->getJQueryItemsSelector().'").not(".slick-initialized").slick('.\CJavaScript::encode($this->options).');');   
    }
}
