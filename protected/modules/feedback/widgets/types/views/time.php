<?php
/** @var \feedback\widgets\types\StringTypeWidget $this */
/** @var FeedbackFactory $factory */
/** @var string $name attribute name. */

use common\components\helpers\HArray as A;
// @var \feedback\models\FeedbackModel
$model = $factory->getModelFactory()->getModel();
// @var int  
$hash = rand(0, 1000000);

$htmlOptions=A::m(A::m([
	'class'=>'inpt '  . $name . $hash,
	'placeholder'=>$factory->getOption("attributes.{$name}.placeholder", '') 
], $factory->getOption("attributes.{$name}.htmlOptions", [])), A::get($this->params, 'htmlOptions', []));
?>
<?php //echo $form->labelEx($factory->getModelFactory()->getModel(), $name); ?>
<?= \CHtml::tag('div', ['style'=>'display:none'], $form->error($factory->getModelFactory()->getModel(), $name)); ?>
<?= $form->textField($factory->getModelFactory()->getModel(), $name, $htmlOptions); ?>
<script type="text/javascript">
jQuery(function($) {
	jQuery(".<?php echo $name . $hash;?>").mask("99:99");
});
</script>