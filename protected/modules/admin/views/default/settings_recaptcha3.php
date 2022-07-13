<?php
use common\components\helpers\HArray as A;

$this->widget('\common\widgets\form\TextField', A::m(compact('form', 'model'), ['attribute'=>'recaptcha3_sitekey']));
$this->widget('\common\widgets\form\TextField', A::m(compact('form', 'model'), ['attribute'=>'recaptcha3_secretkey']));
$this->widget('\common\widgets\form\NumberField', A::m(compact('form', 'model'), [
    'attribute'=>'recaptcha3_score',
    'note'=>'Укажите минимальную оценку вероятности при которой действия на сайте будут определятся как действия производимые человеком. 
    <br/>Google указывает, что оценка <code>0.9</code> означает, что действия на сайте производятся точно человеком.',
    'htmlOptions'=>['class'=>'form-control w10', 'min'=>0, 'max'=>1, 'step'=>0.01]
]));
?>