<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-content">
    <!-- title -->
    <div class="body-1 ui-app__page-content--title border"><?= Html::encode($this->title) ?></div>

    <!-- card body -->
    <div class="card-body">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username', [
                    'options' => [
                        'class'=> 'input-field col s12',
                    ],
                    'template' => "<i class=\"material-icons prefix\">account_circle</i>\n{input}\n{label}\n{error}"
                ])->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email', [
                    'options' => [
                        'class'=> 'input-field col s12',
                    ],
                    'template' => "<i class=\"material-icons prefix\">email</i>\n{input}\n{label}\n{error}"
                ])->textInput() ?>

                <?= $form->field($model, 'password', [
                    'options' => [
                        'class'=> 'input-field col s12',
                    ],
                    'template' => "<i class=\"material-icons prefix\">lock_outline</i>\n{input}\n{label}\n{error}"
                ])->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-block waves-effect waves-light', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
    </div>
    <!-- End card body -->

</div>