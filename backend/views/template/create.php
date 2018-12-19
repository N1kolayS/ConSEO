<?php

use yii\helpers\Html;
use common\efnify\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Template */

$this->title = 'Создать шаблон';
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col m12 l6">
    <div class="card ui-app__page-content">
        <div class="card-content">

            <div class="card-title title"><?= Html::encode($this->title) ?></div>

            <div class="card-body">

                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'code')->textarea(['rows' => 6]) ?>

                    <div class="input-field col s12">
                        <?= Html::submitButton('Создать <i class="material-icons right">send</i>', ['class' => 'btn waves-effect waves-light right']) ?>
                    </div>
                    </div>
                <?php ActiveForm::end(); ?>

            </div>

        </div>
    </div>
</div>