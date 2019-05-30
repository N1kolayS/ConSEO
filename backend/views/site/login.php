<?php

/* @var $this yii\web\View */
/* @var $form common\efnify\widgets\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use common\efnify\widgets\ActiveForm;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-content">
    <!-- title -->
    <div class="body-1 ui-app__page-content--title border"><?= Html::encode($this->title) ?></div>

    <!-- card body -->
    <div class="card-body">

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',

        ]); ?>
        <div class="row m-b-5">

            <?= $form->field($model, 'email', [
                'options' => [
                    'class'=> 'input-field col s12',
                ],
                'template' => "<i class=\"material-icons prefix\">email</i>\n{input}\n{label}\n{error}"
            ])->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password', [
                'options' => [
                    'class'=> 'input-field col s12',
                ],
                'template' => "<i class=\"material-icons prefix\">lock_outline</i>\n{input}\n{label}\n{error}"
            ])->passwordInput() ?>

            <?= $form->field($model, 'rememberMe', [
                'options' => [
                    'class'=> 'col s12',
                ],
                'template' => "<p>\n <label>{input}\n<span>ЗАПОМНИТЬ МЕНЯ</span> </label>\n </p>"
            ])->input('checkbox') ?>

            <div class="input-field col s12">

                <?= Html::submitButton('Войти в аккаут', ['class' => 'btn btn-block waves-effect waves-light', 'name' => 'login-button']) ?>
            </div>

        </div>
        <?php ActiveForm::end(); ?>

    </div>


</div>