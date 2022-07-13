<?php
/**
 * Date type widget
 *
 */
namespace feedback\widgets\types;

class TimeTypeWidget extends BaseTypeWidget
{
	/**
	 * (non-PHPdoc)
	 * @see \feedback\widgets\types\BaseTypeWidget::run()
	 */
	public function run($name, \feedback\components\FeedbackFactory $factory, \CActiveForm $form)
	{
		$this->render('time', compact('name', 'factory', 'form'));
	}
}