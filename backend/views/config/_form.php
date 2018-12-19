<?php

use yii\helpers\Html;
use common\efnify\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Config */
/* @var $form common\efnify\widgets\ActiveForm */
$css = <<<CSS
.collection-item >a {
    cursor: pointer;
}
CSS;
$scriptMaps = '';
if (!$model->isNewRecord)
{
    foreach (\yii\helpers\Json::decode($model->value) as $key => $val)
    {
        $scriptMaps .= "mapValue.set('$key', '$val'); ".PHP_EOL;

    }
}


$script = <<<JS

function mapToObj(map){
  const obj = {};
  for (let [k,v] of map)
    obj[k] = v
  return obj
}



let mapValue = new Map();
$scriptMaps
$(document).on("click", ".remove", function() {
    let key = $(this).attr("data-key");
  $(this).parent().remove();
 
 mapValue.delete(key);
 let objectArray = mapToObj(mapValue);
 
 $("#config-value").val(JSON.stringify(objectArray));  
 
});

    $("#add_position").click(function() {
        const input_text = $("#input_text");
        let inputarr = input_text.val().split('=');
        let key = inputarr[0].trim();
        let val = inputarr[1].trim();
        if (key&&val)
            {
                $("#position").append('<li class="collection-item"> '+key+' == '+val+ '<a  data-key="'+key+'"  class="secondary-content remove"><i class="material-icons">delete_forever</i></a></li>');
                mapValue.set(key, val);
                
                let objectArray = mapToObj(mapValue);
                $("#config-value").val(JSON.stringify(objectArray));  
                input_text.val('');
            }
        
    });
   
    
JS;

$this->registerJs($script);
$this->registerCss($css);
?>

<div class="card-body">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'value')->hiddenInput()->label(false) ?>
    <div class="row">


    <?= $form->field($model, 'description', ['options' => [
        'class'=> 'input-field col s6 m4',
    ]])->textInput(['maxlength' => true]) ?>


        <div class="input-field col s12 m6 l4">
            <h5>Позиции, через : </h5>
            <ul class="collection" id="position">
                <?php
                if (!$model->isNewRecord)
                {
                    foreach (\yii\helpers\Json::decode($model->value) as $key => $val)
                    {
                        echo '<li class="collection-item">'. $key .'== '.$val .'<a  data-key="'. $key .'"  class="secondary-content remove"><i class="material-icons">delete_forever</i></a></li>';
                        //$scriptMaps .= "mapValue.set('$key', '$val'); ".PHP_EOL;

                    }
                }
                ?>
            </ul>
            <hr />
            <input type="text" id="input_text"> <a class="btn " id="add_position">Добавить</a>
        </div>


    <div class="input-field col s12">
        <?= Html::submitButton('Сохранить', ['class' => 'btn waves-effect waves-light right']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
