<?php

/* @var $this yii\web\View */
/* @var $projects \common\models\Project[] */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Мои проекты';
?>


<div class="col s12">
    <div class="card ui-app__page-content">

        <div class="card-content">
            <div class="card-title headline"><?= Html::encode($this->title) ?></div>
            <div class="card-body">


                <?php if (count($projects)>0): ?>
                <ul class="collection">
                    <?php foreach ($projects as $project): ?>
                    <li class="collection-item avatar">
                        <a href="<?=Url::to(['manage/dash', 'id' => $project->id])?>"><i class="material-icons circle green">folder</i></a>
                        <a href="<?=Url::to(['manage/dash', 'id' => $project->id])?>"><span class="title"><?=$project->name?></span></a>
                        <p><?=$project->host?>
                        </p>
                        <?= Html::a('<i class="material-icons">delete_forever</i>', ['project/delete', 'id' => $project->id], [
                            'class' => 'secondary-content',
                            'data' => [
                                'confirm' => 'Удалить проект безвозвратно? ',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <h5 class="center-align">У вас еще нет проектов, создайте проект и начните работать</h5>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="card ui-app__page-content">
        <div class="card-content">
            <div class="center-align">
                <?=Html::a(' Создать проект', ['project/create'], ['class' => 'waves-effect waves-light btn-large btn-rounded '])?>
            </div>
        </div>

    </div>
</div>
