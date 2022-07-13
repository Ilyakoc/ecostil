


<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'page-form',
));

?>
<div class="filter-title">Фильтр</div>

<div class="filter-block">
    <div class="filter-wrap active-filter">
        <div class="filter-title__sub" onclick="activeBlock('0')" id="svg-0">
            <span class='bold'>Цена</span>
            <svg width="13" height="8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.06 4.67L1.74.3A1 1 0 00.32.3L.29.33a1 1 0 000 1.4l5.05 5.13a1 1 0 001.43 0l5.05-5.13a1 1 0 000-1.4L11.8.3a1 1 0 00-1.42 0L6.06 4.67z" fill="#212121"/>
            </svg>
        </div>
        <div class="filter-inner" id="block-0">
            <!--            --><?php //echo CHtml::textField('price_from'); ?>
            <!--            --><?php //echo CHtml::textField('price_to'); ?>
            <!---->
            <!--            <div class="filter-slider">-->
            <!--                <div id="slider-range"></div>-->
            <!--            </div>-->
            <div class="filter-slide__inputs">
                <input type="text"  class="price_from" id="price_from">
                <input type="text"  class="price_to" id="price_to">
            </div>
            <div class="filter-slider">
                <input type="text" class="example_2">
            </div>
        </div>
    </div>
</div>






<?php
$current_price_min = $min_price;
$current_price_max = $max_price;
//if (isset(Yii::app()->request->cookies['price_from'])) $current_price_min = Yii::app()->request->cookies['price_from'];
//else{
//	$current_price_min = $min_price;
//}
//if (isset(Yii::app()->request->cookies['price_to'])) $current_price_max = Yii::app()->request->cookies['price_to'];
//else{
//	$current_price_max = $max_price;
//}
?>

<script>
    $(document).ready(function(){
        var $range = $(".example_2");
        var $inputFrom = $(".price_from");
        var $inputTo = $(".price_to");
        var instance;
        var min = <?php echo $current_price_min; ?>;
        var max = <?php echo $current_price_max; ?>;
        var from = <?php echo $current_price_min; ?>;
        var to = <?php echo $current_price_max; ?>;

        $range.ionRangeSlider({
            skin: "round",
            type: "double",
            min: min,
            max: max,
            from: <?php echo $current_price_min; ?>,
            to: <?php echo $current_price_max; ?>,
            onStart: updateInputs,
            onChange: updateInputs,
            onFinish: updateInputs
        });

        instance = $range.data("ionRangeSlider");

        $('.reset-filter').on('click', function(){
            $("select").each(function() { $(this).val('none'); });
            $('#price_from').val('<?php echo $current_price_min; ?>');
            $('#price_to').val('<?php echo $current_price_max; ?>');

            $('input[type="checkbox"]').prop('checked', false);

            instance.update({
                from: <?php echo $current_price_min; ?>
            });
            instance.update({
                to: <?php echo $current_price_max; ?>
            });
            $('#form-filter').submit();
        });





        function updateInputs (data) {
            from = data.from;
            to = data.to;

            $inputFrom.prop("value", from);
            $inputTo.prop("value", to);
        }

        $inputFrom.on("change", function () {
            var val = $(this).prop("value");
            //validate
            if (val < min) {
                val = min;
            } else if (val > to) {
                val = to;

            }

            instance.update({
                from: val
            });

            $(this).prop("value", val);

        });

        $inputTo.on("change", function () {
            var val = $(this).prop("value");

            // validate
            if (val < from) {
                val = from;
            } else if (val > max) {
                val = max;
            }

            instance.update({
                to: val
            });

            $(this).prop("value", val);
        });
    });

</script>

<?php

echo CHtml::beginForm('', '', array('id'=>'form-filter'));

foreach ($attributes as $key => $attr):  ?>
    <div class="filter-block">
        <div class="filter-wrap">
            <div class="filter-title__sub" onclick="activeBlock('<?=$key?>')" id="svg-<?=$key?>">
                <span class="bold"><?php echo $attr['name']; ?></span>
                <svg width="13" height="8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.06 4.67L1.74.3A1 1 0 00.32.3L.29.33a1 1 0 000 1.4l5.05 5.13a1 1 0 001.43 0l5.05-5.13a1 1 0 000-1.4L11.8.3a1 1 0 00-1.42 0L6.06 4.67z" fill="#212121"/>
                </svg>
            </div>
            <div class="filter-inner" id="block-<?=$key?>">
                <?php
                //$attr['values']['none'] = 'Без фильтра';
                //echo CHtml::dropDownList($attr['id'], 'none', $attr['values'], array('data-id'=>$key, 'selected'=>'none'));

                foreach ($attr['values'] as $name => $val){
                    ?>
                    <label class="cont">
                        <input type="checkbox" class="custom-checkbox" id="custom-checkbox-<?=$key?>" name="<?=$attr['id']?>" value="<?=$val?>">
                        <!--                        <span class="checkmark"></span>-->
                        <label for="custom-checkbox-<?=$key?>"><?=$val?></label>
                    </label>
                <?}?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script>
    function activeBlock(id){
        $('#block-'+id).toggle('active');
        $('#svg-'+id).toggleClass( "active-svg" );

        // if($('.svg-'+id).hasClass('active-svg');){
        //     $('.svg-'+id).removeClass('active-svg');
        // }
    }
</script>

<!--<div class="filter-block">-->
<div class="filter-wrap filter-but">
    <div class="filter-buttons">
        <?php echo CHtml::button('Сбросить', array('class'=>'reset-filter fiter-btn__remove')); ?>
        <?php echo CHtml::submitButton('Применить', array('class'=>'filter-button fiter-btn__submit')); ?>
    </div>
</div>
<!--</div>-->


<?php $this->endWidget(); ?>


<?php echo CHtml::endForm(); ?>
