<?php
use common\components\helpers\HArray as A;

$titleAttribute = A::rget($config, 'item.titleAttribute', 'title');
$introAttribute = A::rget($config, 'item.introAttribute', 'intro');
if(is_callable($titleAttribute)) {
    $title = call_user_func($titleAttribute, $data);
}
else {
    $title = $data->$titleAttribute;
}

$url = A::rget($config, 'item.url');
if(is_callable($url)) {
    $url = call_user_func($url, $data);
}
?>

<div class="search-result__item">
    <div class="search__number">*</div>
    <div class="search__content">
        <div class="search__title"><?php echo CHtml::link($title, $url); ?></div>
        <div class="search__text"><?= $data->intro;?></div>
    </div>
</div>