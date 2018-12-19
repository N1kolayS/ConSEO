<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\WidgetFrame */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Widget Frames', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-frame-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'project_id',
            'template_id',
            'title',
            'title_flip',
            'text',
            'phone',
            'position',
            'enable',
        ],
    ]) ?>

</div>
