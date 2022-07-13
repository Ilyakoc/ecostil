<?php
/** @var \feedback\widgets\types\StringTypeWidget $this */
/** @var FeedbackFactory $factory */
/** @var string $name attribute name. */

// @var \feedback\models\FeedbackModel
$model = $factory->getModelFactory()->getModel();
// @var int  
$hash = rand(0, 1000000);
?>
<div>
	<?php // echo $form->labelEx($model, $name); ?>
	<?php $this->widget('widgets.MaskedJuiDatePicker.MaskedJuiDatePicker',array(
			'language'=>'ru',
      		'name'=>preg_replace('/\\\\+/', '_', get_class($model)) . "[{$name}]",
		     //the new mask parmether
      		'mask'=>'99 / 99 / 9999',
			// additional javascript options for the date picker plugin
      		'options'=>array(
          		'showAnim'=>'fold',
          		'dateFormat'=>'dd / mm / yy',
          		'minDate'=>'new Date()'
      		),
			'value'=>Yii::app()->dateFormatter->formatDateTime($model->isNewRecord ? null : $model->created),
      		'htmlOptions'=>array(
				'class'=>'inpt ' . $name . $hash,
				'placeholder'=>$factory->getOption("attributes.{$name}.placeholder", '__ / __ / ____')
      		),
  		));
	?>
	<div style="display: none;">
		<?php echo $form->error($model, $name); ?>
	</div>
</div>

<script type="text/javascript">
jQuery(function($) {
	jQuery(".<?php echo $name . $hash;?>").mask("99 / 99 / 9999");
});
</script>