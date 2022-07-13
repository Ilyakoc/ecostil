<?php
$sql = "SELECT `product_add` FROM `with_product`";
$connection=Yii::app()->db; // так можно делать, если в конфигурации настроен компонент соединения "db"
$command=$connection->createCommand($sql);
$rows=$command->queryAll();
?>

<div>
    <label>С этим товаром</label>
    <ul id="product-list" class="product-list row">
        <? foreach ($rows as $row) {
            $criteria=new CDbCriteria;
            $criteria->condition = "id = :id";
            $criteria->params = array (
                ':id' => $row['product_add'],
            );
            //$criteria->addCondition('date', $object);
            $product = Product::model()->find($criteria);?>

        <li id="item_<?php echo $product->id ?>" data-sort-id="<?= $product->id; ?>" class="col-xs-3">
            <div class="product thumbnail">
                <div class="img">
                    <?= CHtml::link($product->img(195, 195), ['shop/productUpdate', 'id'=>$product->id]); ?>
                </div>
                <div class="caption">
                    <p class="title" title="<?php echo $product->title ?>"><?php echo Chtml::link($product->title, array('shop/productUpdate', 'id'=>$product->id)); ?></p>
                    <div class="btn btn-danger add-prod-<?=$product->id?>" onclick="removeProd(<?php echo $product->id ?>)">Удалить</div>
                    <div class="add-prod-suc-<?=$product->id?>" style="display: none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M10.5,14.7928932 L17.1464466,8.14644661 C17.3417088,7.95118446 17.6582912,7.95118446 17.8535534,8.14644661 C18.0488155,8.34170876 18.0488155,8.65829124 17.8535534,8.85355339 L10.8535534,15.8535534 C10.6582912,16.0488155 10.3417088,16.0488155 10.1464466,15.8535534 L7.14644661,12.8535534 C6.95118446,12.6582912 6.95118446,12.3417088 7.14644661,12.1464466 C7.34170876,11.9511845 7.65829124,11.9511845 7.85355339,12.1464466 L10.5,14.7928932 Z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </li>

       <? }?>
    </ul>
</div>
<div class="input-group">
        <input type="text" id="search-1">
        <div onclick="searchProduct()" class="btn">Найти</div>
    </div>
    <input id="prod-id" type="hidden" value="<?=$model->id?>">
    <div class="item-result">

    </div>
<script>
    function searchProduct(){
        var text = document.getElementById("search-1");
        var val = text.value;

        var data = JSON.stringify(val);

        $.ajax({
            url: '/shop/Searchproduct',
            method: 'post',
            data: data,
        }).then(function (result) {
            $(".item-result").html(result);
        })

    }
    function removeProd(id){
        var text = document.getElementById("prod-id");
        var val = text.value;
        var data = JSON.stringify(id+'-'+val);

        $.ajax({
            url: '/shop/Removeproduct',
            method: 'post',
            data: data,
        }).then(function (result) {
            $('.add-prod-'+id).css('display', 'none');
            $('.add-prod-suc-'+id).css('display', 'block');
            //$(".item-result").html(result);
        })

    }
</script>

