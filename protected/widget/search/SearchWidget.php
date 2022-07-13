<?php

class SearchWidget extends \common\components\base\Widget
{
	public $id='q';
	public $placeholder='Поиск по сайту';
	public $submit='Найти';
	public $submitOptions=[];
	public $view='search_form';

	/**
	 * Заполнять поле поиска предыдущим значением поиска
	 *
	 * @var boolean
	 */
	public $safeValue=false;

	public $auto=false;
	public $autoView='search_form_auto';
	public $tag=false;
	public $formOptions=[];
	public $inputOptions=[];
	public $inputWrapperTag=false;
	public $inputWrapperOptions=[];
	public $submitWrapperTag=false;
	public $submitWrapperOptions=[];
	public $autoResultOptions=[];
	public $autoResultEmptyText='<i>Не найдено</i>';

	public function run()
	{
		if($this->auto) {
			$this->view=$this->autoView;
		}

		$this->render($this->view, $this->params);
	}
}
