<?php

use yii\helpers\Html;

use common\efnify\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $form common\efnify\widgets\ActiveForm */

$route_check_domain = \yii\helpers\Url::to(['ajax/check-domain']);

$this->title = 'Создать проект';


$script = <<< JS
  
    const field_project_host = $("#project-host");
    const field_project_screenShot = $("#project-screenshot");
    const block_next_button = $("#block_button");
    const block_progress = $("#check_domain_progress"); 
    const block_error =  $("#error"); 
    const block_error_project_name = $("#error_project_name");
     $("#next").click(function() {
         block_next_button.hide();
         block_error.hide();
         block_progress.show();
         block_error_project_name.hide();
         let host = field_project_host.val();
         
        $.get( "$route_check_domain", { url: host } )
                .done(function( jsonr )
                {
                    let result = JSON.parse(jsonr);
                    if (result['result']===true)
                        {
                            field_project_host.val(result['domain']); 
                            field_project_screenShot.val(result['screenShot']);
                            if ($("#project-name").val().length > 0) 
                                {
                                    $("#form_project").submit(); // Всё ок, отправялем форму               
                                }
                                else  {
                                // Имя проекта не заполнено
                                block_progress.hide();
                                    block_error_project_name.show();
                                    block_next_button.show();   
                                }
                        }
                        else 
                            {
                                block_error.show();
                                block_progress.hide();
                                block_next_button.show();           

                            }
                           
                       
                });
       
     });
     
     /**
     * Без проверки доменного имени 
     */
     $("#forceNext").click(function() {
         if ($("#project-name").val().length > 0) 
                                {
                                    $("#form_project").submit(); // Всё ок, отправялем форму               
                                }
                                else  {
                                // Имя проекта не заполнено
                                block_progress.hide();
                                    block_error_project_name.show();
                                    block_next_button.show();   
                                }
       
     })
     
     
  

JS;

$this->registerJs($script, yii\web\View::POS_END);

?>
<!-- Avatar Content -->
<div class="col s12">
    <h1 class="ui-app__header__title display-1 center-align"><?= Html::encode($this->title) ?></h1>
    <div class="card ui-app__page-content ui-app__page-content--form">

        <div class="card-content">

            <?php $form = ActiveForm::begin(['id' => 'form_project']); ?>



            <?= $form->field($model, 'name',  ['options' => [
                'class'=> 'input-field',
            ]])->textInput(['maxlength' => true]) ?>
            <p id="error_project_name" class="red lighten-2 center-align" style="display: none">Заполните имя проекта</p>

            <?= $form->field($model, 'host',  ['options' => [
                'class'=> 'input-field',
            ]])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'screenShot', [
                'template' => "{input}"
            ])->hiddenInput()->label(false) ?>
            <div class="input-field" id="block_button">
                <?= Html::a('Создать проект', null, ['class' => 'btn  btn-block waves-effect waves-light', 'id' => 'next']) ?>
            </div>

            <div class="input-field card-panel red lighten-4" id="error" style="display: none">
                <p class="headline   center-align">Сайт с адресом  <?=$model->host?> не найден </p>
                <p class="body-2  center-align">Если вы уверены, что адрес сайта правильный, <br/> то Вы можете</p>
                <?= Html::a('Создать проект без проверки Адреса', null, ['class' => ' waves-effect waves-light btn-flat grey-text', 'id' => 'forceNext']) ?>
            </div>




            <?php ActiveForm::end(); ?>

            <br />
            <div class="row" id="check_domain_progress" style="display: none" >
                <div class="col s12 center">
                    <p class="subheading">Проверяем Ваш сайт</p>
                    <div class="preloader-wrapper big active">
                        <div class="spinner-layer spinner-red">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="gap-patch">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
</div>
