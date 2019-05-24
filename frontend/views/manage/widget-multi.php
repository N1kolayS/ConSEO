<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 28.11.2018
 * Time: 21:53
 */



/* @var $this yii\web\View */
/* @var $searchModel backend\models\TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $project common\models\Project */
/* @var $channel common\models\Channel */
/* @var $position common\models\Position */


use common\efnify\widgets\ActiveForm;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;



$this->title = 'Мульти Лэндинг';
$this->params['breadcrumbs'][] = $this->title;

$route_add_channel = Url::to(['channel/create', 'project_id' => $project->id ]);
$routes_update_channel = Url::to(['channel/update', 'id' => $project->id ]);
$widget_on_off = Url::to(['ajax/widget-multi', 'id' => $project->id]);




$script = <<<JS
//Edit Name
$(".name-text").click(function() {
    // Close previous
    $(".name-text").show();
    $(".name-input").hide();
    let channel_id = $(this).attr("data-id");
    $(this).hide();
    $("#name_input_"+channel_id).show(); 
 });
//Edit code
$(".code-text").click(function() {
    // Close previous
    $(".code-text").show();
    $(".code-input").hide();
    let channel_id = $(this).attr("data-id");
    $(this).hide();
    $("#code_input_"+channel_id).show(); 
 });

$(".referral-text").click(function() {
    // Close previous
    $(".referral-text").show();
    $(".referral-input").hide();
    let channel_id = $(this).attr("data-id");
    $(this).hide();
    $("#referral_input_"+channel_id).show(); 
 });

$(".utm_source-text").click(function() {
    // Close previous
    $(".utm_source-text").show();
    $(".utm_source-input").hide();
    
    let channel_id = $(this).attr("data-id");
    $(this).hide();
    $("#utm_source_chips_"+channel_id).hide();
    $("#utm_source_input_"+channel_id).show(); 
 });
$(".utm_campaign-text").click(function() {
    // Close previous
    $(".utm_campaign-text").show();
    $(".utm_campaign-input").hide();
    
    let channel_id = $(this).attr("data-id");
    $(this).hide();
    $("#utm_campaign_chips_"+channel_id).hide();
    $("#utm_campaign_input_"+channel_id).show(); 
 });

// Save values
$(".save").click(function() {
    const channel_id = $(this).attr("data-id");
    const data_name = $(this).attr("data-name");
    const value = $("#"+data_name+"_"+channel_id);
    if (value.val().length>0)
        {
            let request;
            switch (data_name) {
                case 'name':
                    request = { name: value.val() };
            break;
                case 'code':
                    request = { code: value.val() };
            break;
       
            }
            
            $.get( constructorUrl('update',channel_id ), {attributes: request } )
                        .done(function( json )
                        {
                            let result = JSON.parse(json);
                            if (result['result'])
                                {
                                     $("#"+data_name+"_input_"+channel_id).hide(); 
                                     $("#"+data_name+"_text_"+channel_id).html(value.val()); 
                                     $("#"+data_name+"_text_"+channel_id).show(); 
                                    
                                }
                        });
        }
    
     
 });

$(".save_referral").click(function() {
    const channel_id = $(this).attr("data-id");
   
    const value = $("#referral_"+channel_id);
   
  

        const    request = {referral: value.val()};
         $.get( constructorUrl('update',channel_id ), {attributes: request } )
                        .done(function( json )
                        {
                            let result = JSON.parse(json);
                            if (result['result'])
                                {
                                    $(".referral-chips").show(); 
                                     $("#referral_input_"+channel_id).hide(); 
                                     $("#referral_text_"+channel_id).html(value.val()); 
                                     $("#referral_text_"+channel_id).show(); 
                                    
                                }
                        });
     
 });

// Save UTM 
$(".save_utm").click(function() {
    const channel_id = $(this).attr("data-id");
    const data_name = $(this).attr("data-name");
    const value = $("#"+data_name+"_"+channel_id);

            let request;
            switch (data_name) {
           
                case 'utm_source':
                    request = { utm_source: value.val() };
            break;
            case 'utm_campaign':
                    request = { utm_campaign: value.val() };
            break;
          
            }
            
            $.get( constructorUrl('update',channel_id ), {attributes: request } )
                        .done(function( json )
                        {
                            let result = JSON.parse(json);
                            if (result['result'])
                                {
                                    $(".utm-chips").show(); 
                                     $("#"+data_name+"_input_"+channel_id).hide(); 
                                     $("#"+data_name+"_chips_"+channel_id).html(''+value.val()); 
                                     $("#"+data_name+"_text_"+channel_id).show(); 
                                    
                                }
                        });
        
    
     
 });
    
const constructorUrl = function(action, id) {
  return '/channel/'+id+'/'+action;
};

$('#on_off').change(function() {
    let widget_demo = $("#widget_multi");
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
$this->registerJs($script);

?>

<div class="row ui-app__row">
    <div class="col s12 m6 ui-app__header">
        <h1 class="ui-app__header__title display-1"><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="col s12 m6 ui-app__header">
        <div class="switch">
            <label>Отключен<input id="on_off"  type="checkbox" <?=$project->isWidgetMultiEnable() ? 'checked' : ''?>><span class="lever"></span>Включен</label>
        </div>
    </div>

</div>
<div id="widget_multi" style="<?=$project->isWidgetMultiEnable() ? '' : 'display: none'?>">
    <div class="row">
        <div class="col s12"  >

            <table class="striped" id="channels">
                <thead>
                <tr>
                    <th width="250">Канал</th>
                    <th>Заголовок</th>

                </tr>
                </thead>
                <tbody  id="multi_table">
                <?php foreach ($project->channels as $channel ): ?>
                    <tr class=" <?=$channel->isEnable() ? '': 'pink lighten-5'?>" id="channel_row_<?=$channel->id?>">
                        <td>
                            <span class="name-text " ><?=$channel->name?></span>
                            <strong> = <?=$channel->code?></strong>

                        </td>

                        <td>
                            <ul class="collection">
                                <?php foreach ($project->positions as $position): ?>
                                    <li class="collection-item"><?=$position->name?>
                                        <span class="name-text editable" id="name_text_<?=$channel->id?>" data-id="<?=$channel->id?>" ><?=(($value = $position::showValue($channel->id, $position->id))==null) ? 'Без имени' : $value?></span>
                                        <div class="name-input" id="name_input_<?=$channel->id?>" style="display: none">
                                            <div class="input-field col s8">
                                                <input id="name_<?=$channel->id?>" type="text" class="validate" value="<?=$value?>">
                                                <label for="name_<?=$channel->id?>">Название</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <button class="btn waves-effect waves-light btn-small save" data-name="name" data-id="<?=$channel->id?>"><i class="tiny material-icons">check</i></button>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <br />
            <hr />
            <br />

        </div>
    </div>
    <div class="row">
        <div class="col s12 m6 l4">
            <?php $form = ActiveForm::begin(['id' => 'position_form']); ?>

            <?= $form->field($position, 'name',  ['options' => [
                'class'=> 'input-field',
            ]])->textInput(['maxlength' => true]) ?>


            <?= $form->field($position, 'htmlId',  ['options' => [
                'class'=> 'input-field',
            ]])->textInput(['maxlength' => true]) ?>


            <div class="input-field" id="block_button">
                <?= Html::submitButton('Создать позицию',  ['class' => 'btn  btn-block waves-effect waves-light']) ?>
            </div>


            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
