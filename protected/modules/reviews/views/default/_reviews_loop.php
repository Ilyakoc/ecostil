<?
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_reviews_item',
    'ajaxUpdate'=>false,
    'itemsCssClass'=>'reviews-list__items',
    'template'=>"{items}",
));
?>
