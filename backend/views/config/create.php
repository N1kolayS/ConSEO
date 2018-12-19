<?php

use yii\helpers\Html;

use common\efnify\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Config */
/* @var $form common\efnify\widgets\ActiveForm */

$confString = ($model->value!==null) ? \yii\helpers\Json::decode($model->value) : '{}';
$script = <<<JS

    
     const confObject = {};
            
   $("#go").click(function() {
      //  $("#form_project").submit();
        confObject.name         = $("#name").val();
        confObject.code         = $("#code").val();
        confObject.url          = $("#url").val();
        confObject.utm_campaign = $("#utm_campaign").val();
        confObject.utm_source   = $("#utm_source").val();
        console.log(confObject);
        $("#config-value").val(JSON.stringify(confObject));
      
           $("#form_config").submit(); // Всё ок, отправялем форму            
   });
     
    
JS;

$this->registerJs($script, yii\web\View::POS_END);


?>

<div class="col m12 l6">
    <div class="card ui-app__page-content">
        <div class="card-content">

            <div class="card-title title"><?= Html::encode($this->title) ?></div>

            <div class="card-body">

                <?php $form = ActiveForm::begin(['id' => 'form_config']); ?>
                <?= $form->field($model, 'value')->hiddenInput()->label(false) ?>
                <div class="row">

                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'type')->dropDownList($model::listType()) ?>


                    <div class="input-field col s12">
                        <?= Html::button('Сохранить', ['class' => 'btn waves-effect waves-light right', 'id' =>'go']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>

                <div class="input-field col s12 m6 l4">
                    <h5>Позиции, через : </h5>
                    <ul class="collection" id="position">
                        <li class="collection-item"><label for="name">Имя канала</label> <input type="text" id="name"> </li>
                        <li class="collection-item"><label for="code">Промокод</label> <input type="text" id="code"> </li>
                        <li class="collection-item"><label for="url">Рефералы</label> <input type="text" id="url"> </li>
                        <li class="collection-item"><label for="utm_campaign">utm_campaign</label> <input type="text" id="utm_campaign"> </li>
                        <li class="collection-item"><label for="utm_source">utm_source</label> <input type="text" id="utm_source"> </li>

                    </ul>
                </div>
            </div>
    </div>
</div>