<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 28.11.2018
 * Time: 21:27
 */

use yii\helpers\Html;
use common\efnify\widgets\ActiveForm;
use common\models\Template;
use yii\helpers\Url;



/* @var $this yii\web\View */
/* @var $searchModel backend\models\TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $project common\models\Project */
/* @var $widget common\models\WidgetFrame */

$this->title = 'Виджет';
$this->params['breadcrumbs'][] = $this->title;

$css = <<< CSS
.preview-wrap {
    width: 100%;
    margin-left: auto;
    margin-right: auto;
}
.preview-demo {
    width: 1200px;
    border: 1px solid #bbbabb;
    height: 768px;
    position: relative;
}
.preview-borwser-menu {
    background: url('/img/safari.png') no-repeat 0 0; 
    height: 32px; 
    padding-left: 240px; 
    padding-top: 6px; 
    color: #636363; 
}
.preview-iframe {
    height:768px; 
    width:1200px; 
    border: 1px solid #d6d6d6;
}

CSS;

$position_lt = $widget::POSITION_LEFT_TOP;
$position_lm = $widget::POSITION_LEFT_MIDDLE;
$position_lb = $widget::POSITION_LEFT_BOTTOM;
$position_rt = $widget::POSITION_RIGHT_TOP;
$position_rb = $widget::POSITION_RIGHT_BOTTOM;
$position_rm = $widget::POSITION_RIGHT_MIDDLE;

$frame_url = Url::to(['frame/demo', 'id' => $widget->id]);
$widget_on_off = Url::to(['ajax/widget-frame', 'id' => $widget->id]);

$script = <<< JS

let template_id = $widget->template_id;
let position_id = $widget->position;
let title = '$widget->title'
let title_flip = '$widget->title_flip'
let phone = '$widget->phone';


function demoFrame(template_id, position_id, title, title_flip, phone) {
    position_id = +position_id;
    if (position_id === $position_lt)
       {
           $("#block-position").attr("style", "position: absolute; left: 0; top: 40px");
       }
    else if (position_id === $position_lm)
        {
            $("#block-position").attr("style", "position: absolute; left: 0; top: 300px");
        }
    else if (position_id === $position_lb)   
        {
                $("#block-position").attr("style", "position: absolute; left: 0; bottom: 0px");
        } 
    else if (position_id === $position_rt)   
        {
                $("#block-position").attr("style", "position: absolute; right: 0; top: 40px");
        }
    else if (position_id === $position_rm)   
        {
                $("#block-position").attr("style", "position: absolute; right: 0; top: 300px");
        }
         else   // right bottom
        {
                $("#block-position").attr("style", "position: absolute; right: 0; bottom: 0px");
        }
    const url = '$frame_url?template_id='+template_id+'&position='+position_id+'&title='+title+'&title_flip='+ title_flip+'&phone='+ phone;
    $("#iframe").attr('src',url);
  
}

 $(document).ready(function() {
        demoFrame(template_id, position_id, title, title_flip, phone);
    });
    $("#widgetframe-title").keyup(function(){
        title = $(this).val();
        demoFrame(template_id, position_id, title, title_flip, phone);
    });
    
    $("#widgetframe-title_flip").keyup(function(){
        title_flip = $(this).val();
        demoFrame(template_id, position_id, title, title_flip, phone);
    });
    
    $("#widgetframe-phone").keyup(function(){
        phone = $(this).val();
        demoFrame(template_id, position_id, title, title_flip, phone);
    });
    
    // Change template
   
    $("#widgetframe-template_id").change(function() {
        template_id = $(this).val();
        demoFrame(template_id, position_id, title, title_flip, phone);
    });

    $("#widgetframe-position").change(function() {
        position_id = $(this).val();
        demoFrame(template_id, position_id, title, title_flip, phone);
    });
    
    $('#on_off').change(function() {
    let widget_demo = $("#widget_demo");
    let status;
        console.log('change');
        if($(this).is(":checked")) {
           status = 1;
           widget_demo.show();
        }
        else  {
            //On
            status = 0;
            widget_demo.hide();
        }
               $.get( "$widget_on_off", { status: status } )
                .done(function( json )
                {
                    let result = JSON.parse(json);
                    if (!result['result'])
                        {

                        }
                });
      
    });
JS;
$this->registerJs($script, yii\web\View::POS_END);

$this->registerCss($css);
?>

<div class="row ui-app__row">
    <div class="col s12 m6 ui-app__header">
        <h1 class="ui-app__header__title display-1"><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="col s6 m4 right-align"><!-- <strong class="right-align"><?=$widget->isEnable() ? '': 'Виджет выключен' ?></strong> --></div>
    <div class="col s6 m2 right-align">

        <div class="switch">
            <label>Отключен<input id="on_off"  type="checkbox" <?=$widget->isEnable() ? 'checked' : ''?>><span class="lever"></span>Включен</label>
        </div>
    </div>
</div>
<div id="widget_demo" style="<?=$widget->isEnable() ? '' : 'display: none'?>">
    <div class="row">
        <?php if ($widget): ?>
            <div class="col s12">
                <div class="card-body">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <?= $form->field($widget, 'title_flip', [
                            'options' => [
                                'class'=> 'input-field col s4 m2',
                            ],
                        ])->textInput(['maxlength' => true]) ?>
                        <?= $form->field($widget, 'title', [
                            'options' => [
                                'class'=> 'input-field col  s4 m2',
                            ],
                        ])->textInput(['maxlength' => true]) ?>
                        <?= $form->field($widget, 'phone',[
                            'options' => [
                                'class'=> 'input-field col  s4 m2',
                            ],
                        ])->textInput(['maxlength' => true]) ?>
                        <?= $form->field($widget, 'template_id', [
                            'options' => [
                                'class'=> 'input-field col s4 m2',
                            ],
                            'template' => "\n{input}\n{label}\n{error}"
                        ])->dropDownList(\common\models\Template::listAll()) ?>
                        <?= $form->field($widget, 'position', [
                            'options' => [
                                'class'=> 'input-field col s4 m2',
                            ],
                            'template' => "\n{input}\n{label}\n{error}"
                        ])->dropDownList($widget::listPosition()) ?>
                        <div class="input-field col s4 m2">
                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="col s12 center-align">
                <?= Html::a('Создайте виджет', ['widget-frame/create', 'id' => $project->id], ['class' => 'btn btn-success']) ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="sol s12">
            <div class="preview-wrap">
                <div class="preview-borwser-menu"><?=$project->host?></div>
                <div class="preview-demo">
                    <div style="position: absolute; left: 0; bottom: 0; z-index: 999999;" id="block-position"><iframe id="iframe" style="overflow: hidden; box-shadow: none; height: 210px; width: 500px; background: transparent;" frameborder="0" scrolling="no"  src="<?=Url::to(['frame/demo', 'id' =>$widget->id] )?>"></iframe></div>
                    <?=$project->isFrame() ? '<iframe class="preview-iframe" frameborder="0" src="'.$project->host.'"></iframe>' : "<div style=\"height: 100%; width: 100%;  background: url('{$project->getScreenShotImage()}') no-repeat 0 0; \"></div>" ?>
                </div>
            </div>
        </div>
    </div>
</div>

