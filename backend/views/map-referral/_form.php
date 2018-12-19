<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MapReferral */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="map-referral-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->dropDownList($model::listType(), ['prompt' => 'Выберите тип']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn waves-effect waves-light']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
