<?php

use yii\helpers\Html;
use common\efnify\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WidgetFrame */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-body">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <?= $form->field($model, 'name', [
            'options' => [
                'class'=> 'input-field col s3',
            ],

        ])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'template_id', [
            'options' => [
                'class'=> 'input-field col s3',
            ],
            'template' => "\n{input}\n{label}\n{error}"
            ])->dropDownList(\common\models\Template::listAll(), ['prompt' => 'Выберите шаблон']) ?>

        <?= $form->field($model, 'position', [
            'options' => [
                'class'=> 'input-field col s3',
            ],
            'template' => "\n{input}\n{label}\n{error}"
        ])->dropDownList($model::listPosition(), ['prompt' => 'Выберите позицию на сайте']) ?>

        <?= $form->field($model, 'enable', [
            'options' => [
                'class'=> 'input-field col s3',
            ],
            'template' => "<div class=\"switch\"><label>
                                                Off
                                                {input}
                                                <span class=\"lever\"></span>
                                                On
                                            </label></div>"
        ])->checkbox( [], false) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'title', [
            'options' => [
                'class'=> 'input-field col s12 m3',
            ],
            //'template' => "<i class=\"material-icons prefix\">email</i>\n{input}\n{label}\n{error}"
        ])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'title_flip', [
            'options' => [
                'class'=> 'input-field col  s12 m3',
            ],
            //'template' => "<i class=\"material-icons prefix\">email</i>\n{input}\n{label}\n{error}"
        ])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'text',[
            'options' => [
                'class'=> 'input-field col  s12 m3',
            ],
            //'template' => "<i class=\"material-icons prefix\">email</i>\n{input}\n{label}\n{error}"
        ])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone',[
            'options' => [
                'class'=> 'input-field col  s12 m3',
            ],
            //'template' => "<i class=\"material-icons prefix\">email</i>\n{input}\n{label}\n{error}"
        ])->textInput(['maxlength' => true]) ?>



        <div class="input-field col s12">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
