<?
use common\components\helpers\HArray as A;

if(D::isDevMode()) {
    $this->widget('\common\widgets\form\DropDownListField', A::m(compact('form', 'model'), [
        'attribute' => 'template_type',
        'data' => $model->getTemplateTypeList(),
    ]));

}
$this->widget('\common\widgets\form\TinyMceField', A::m(compact('form', 'model'), [
    'attribute'=>'main_text', 
    'uploadImages'=>false, 
    'uploadFiles'=>false, 
    'showAccordion'=>false
]));
$this->widget('\common\widgets\form\TinyMceField', A::m(compact('form', 'model'), ['attribute'=>'main_text2']));
