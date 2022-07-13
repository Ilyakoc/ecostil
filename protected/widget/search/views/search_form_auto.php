<? 
/** @var \SearchWidget $this */

use common\components\helpers\HYii as Y; 
use common\components\helpers\HArray as A;
use common\components\helpers\HRequest as R;
use common\components\helpers\HHash;

$formId=HHash::ujs('search');
$inputId=HHash::ujs('search');
$autoResultId=HHash::ujs('search');
$queryName=Y::config('search', 'queryname');
$queryValue=$this->safeValue ? R::get($queryName) : '';

if($this->tag) { echo \CHtml::openTag($this->tag, $this->tagOptions); }
	echo \CHtml::openTag('form', A::m($this->formOptions, [
		'action'=>$this->owner->createUrl('/search/index'),
		'method'=>'get',
		'role'=>'search',
		'id'=>$formId
	]));

		if($this->inputWrapperTag) { echo \CHtml::openTag($this->inputWrapperTag, $this->inputWrapperOptions); }
			echo \CHtml::textField($queryName, $queryValue, A::m([
				'autocomplete'=>'off',
				'id'=>$inputId,
				'placeholder'=>$this->placeholder
			], $this->inputOptions));
		if($this->inputWrapperTag) { echo \CHtml::closeTag($this->inputWrapperTag); }
		
		if($this->submitWrapperTag) { echo \CHtml::openTag($this->submitWrapperTag, $this->submitWrapperOptions); }
			echo \CHtml::tag('button', A::m([
				'type'=>'submit'
			], $this->submitOptions), $this->submit);
		if($this->submitWrapperTag) { echo \CHtml::closeTag($this->submitWrapperTag); }

		echo \CHtml::tag('div', A::m($this->autoResultOptions, [
			'style'=>'display:none',
			'id'=>$autoResultId
		]), '', true);
		
	echo \CHtml::closeTag('form');

if($this->tag) { echo \CHtml::closeTag($this->tag); }
?>
<script>(function(){let ajax=null;$(document).on('blur mouseleave', '#<?=$autoResultId?>', function(){$('#<?=$autoResultId?>').hide();});
$(document).on('keyup', '#<?=$inputId?>', function(e){if(ajax){ajax.abort();}let v=$(e.target).val();
if(v.length<<?=(int)Y::config('search', 'minlength')?>){$('#<?=$autoResultId?>').html('').hide();}else{ajax=$.post("<?=$this->owner->createUrl('/search/autoComplete')?>",{q:v},function(r){
if((typeof r.items != 'undefined') && r.items.length>0){$('#<?=$autoResultId?>').html(`<ul><li>${r.items.join('</li><li>')}</li></ul>`).show();}
else{$('#<?=$autoResultId?>').html("<?=$this->autoResultEmptyText?>").show();}},'json');}});})();</script>