<?php
namespace extend\modules\slider\widgets;

use common\components\helpers\HYii as Y;
use common\components\helpers\HArray as A;
use extend\modules\slider\models\Slide;

class Slider extends \extend\modules\slider\components\base\SliderWidget
{
    /**
     * Функция отрисовки сладера.
     * Принимает параметры function($slides) {},
     * где $slides - это массив слайдов (\stdClass)
     *
     * @var callable 
     */
    public $content=null;

    /**
     * Подключать и инициализировать плагин Slick.
     *
     * @var boolean
     */
    public $slick=true;

    /**
     * Запуск виджета
     * 
     * {@inheritDoc}
     * 
     * @return void
     */
    public function run()
    {
        if($this->slick) {
            $this->registerScript('$("'.$this->getJQueryItemsSelector().'").not(".slick-initialized").slick('.\CJavaScript::encode($this->options).');');
        }
        
        if($this->isCache()) {
            if(!($content=Y::cache()->get($this->getCacheId()))) {
                $content=$this->renderSlider(true);
                Y::cache()->set($this->getCacheId(), $content, $this->cacheTime);
            }
            echo $content;
        }
        else {
            $this->renderSlider();
        }
    }

    /**
	 * Получить jQuery выражение выборки DOM-элемента списка слайдов. 
	 * @return string
	 */
	public function getJQueryItemsSelector()
	{
	    if(A::exists('class', $this->itemsOptions)) {
	        $selector='.' . preg_replace('/\s+/', '.', $this->itemsOptions['class']);
	    }
	    elseif(A::exists('id', $this->itemsOptions)) {
	        $selector='#' . $this->itemsOptions['id'];
        }
        else {
            $selector='.slider__' . $this->code;
        }
	    
	    return $selector;
	}

    /**
     * Отрисовка слайдера
     *
     * @param boolean $return возвращать HTML код отрисовки. 
     * По умолчанию false (не возвращать)
     * @return void
     */
    public function renderSlider($return=false)
    {
        if(!is_string($this->content) && is_callable($this->content)) {
            if($slides=$this->getSlides()) {
            	// FIXME проверка активности и наличии свойств слайда в слайдере
            	$activeSliderOptions=$this->getSlider()->slidePropertiesBehavior->listData('code', 'active');
                $_slides=[];
                foreach($slides as $slide) {
                    if($slide instanceof Slide) {                        
                        $_slide=[
                            'src'=>$this->getSlideSrc($slide),
                            'src_origin'=>$slide->imageBehavior->getSrc(),
                            'alt'=>$slide->imageBehavior->getAlt(),
                            'url'=>($this->isLink() && $slide->url) ? $slide->url : null,
                        ];
                        $options=$slide->optionsBehavior->get(true);
                        foreach($options as $option) {
                            if(!empty($activeSliderOptions[$option['code']])) {
                                $_slide[$option['code']]=trim($option['value']);
                            }
                        }
                        $_slides[]=(object)$_slide;
                    }
                }

                ob_start();
                $content=call_user_func($this->content, $_slides);
                $content=ob_get_clean() . $content;

                if($return) {
                    return $content;
                }

                echo $content;
            }
        }
    }

    /**
	 * Публикация ресурсов виджета
	 *
     * {@inheritDoc}
     * 
	 */
	protected function publishAssets()
	{
        if($this->slick && $this->jsLoad) { 
            Y::jsCore('slick');
        }

	    $js=false;
	    if($this->jsLoad) $js=$this->js;
	    
	    return $this->publish($js, A::m(A::toa($this->css), A::toa($this->less)));
	}
}