<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MapReferral */

$this->title = 'Create Map Referral';
$this->params['breadcrumbs'][] = ['label' => 'Map Referrals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="map-referral-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
