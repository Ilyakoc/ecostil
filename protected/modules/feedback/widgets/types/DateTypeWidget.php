<?php
/**
 * Date type widget
 *
 */
namespace feedback\widgets\types;

class DateTypeWidget extends BaseTypeWidget
{
	/**
	 * (non-PHPdoc)
	 * @see \feedback\widgets\types\BaseTypeWidget::run()
	 */
	public function run($name, \feedback\components\FeedbackFactory $factory, \CActiveForm $form)
	{
		$this->render('date', compact('name', 'factory', 'form'));
	}
}