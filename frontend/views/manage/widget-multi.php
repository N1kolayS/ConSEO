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
/* @var $mapReferral common\models\MapReferral */

use backend\models\TemplateSearch;
use common\models\Channel;
use common\models\MapReferral;
use common\models\Project;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;




$this->title = 'Каналы';
$this->params['breadcrumbs'][] = $this->title;

$route_add_channel = Url::to(['channel/create', 'project_id' => $project->id ]);
$routes_update_channel = Url::to(['channel/update', 'id' => $project->id ]);





$script = <<<JS
//Try init materialize chips
$('.chips').chips();

const  channels_table_body = $("#channels_body");
$("#add_new").click(function() {
    $.get( "$route_add_channel" )
                .done(function( json )
                {
                    let result = JSON.parse(json);
                    if (result['result']===true)
                        {
                            location.reload(); // Refresh page 
                            
                     /*       channels_table_body.append('<tr id="channel_row_'+channel_id+'">'+
                "<td>Канал #"+channel_id+"</td>"+
                "<td>000</td>"+
                "<td></td>"+
                "<td></td>"+
                "<td>"+
                 '<div class="switch">'+
                            '<label>Off<input class="on-off" data-id="'+channel_id+'" type="checkbox"checked><span class="lever"></span>On</label>'+
                        "</div></td>"+
            "</tr>");
            */
                        }
                });   
 });

//On Off channels
$('.on-off').change(function() {
    let channel_id = $(this).attr("data-id");
    let status;
        if($(this).is(":checked")) {
           
           $("#channel_row_"+channel_id).removeClass('pink lighten-5');
           status = 'enable';
        }
        else  {
            //On
            $("#channel_row_"+channel_id).addClass('pink lighten-5');
            status = 'disable';
        }
        $.get( constructorUrl('status',channel_id ), { status: status } )
                .done(function( json )
                {
                    let result = JSON.parse(json);
                    if (!result['result'])
                        {
                             
                             location.reload();
                        }
                });
                
    });

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
}
JS;
$this->registerJs($script);
?>

<div class="row ui-app__row">
    <div class="col s12 m6 ui-app__header">
        <h1 class="ui-app__header__title display-1"><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="col s12 m6 ui-app__header">

    </div>

</div>
<div class="row">
    <div class="col s12">

        <table class="striped" id="channels">
            <thead>
            <tr>
                <th width="250">Название</th>
                <th  width="200">Промокод</th>
                <th>Реферал</th>
                <th>UTM-метки</th>
                <th  width="200"></th>
            </tr>
            </thead>
            <tbody  id="channels_body">
            <?php foreach ($project->channels as $channel ): ?>
                <tr class=" <?=$channel->isEnable() ? '': 'pink lighten-5'?>" id="channel_row_<?=$channel->id?>">
                    <td>
                        <span class="name-text editable" id="name_text_<?=$channel->id?>" data-id="<?=$channel->id?>" ><?=($channel->name==null) ? 'Без имени' : $channel->name?></span>
                        <div class="name-input" id="name_input_<?=$channel->id?>" style="display: none">
                            <div class="input-field col s8">
                                <input id="name_<?=$channel->id?>" type="text" class="validate" value="<?=$channel->name?>">
                                <label for="name_<?=$channel->id?>">Название</label>
                            </div>
                            <div class="input-field col s4">
                                <button class="btn waves-effect waves-light btn-small save" data-name="name" data-id="<?=$channel->id?>"><i class="tiny material-icons">check</i></button>
                            </div>
                        </div>
                    </td>
                    <!--
                     Промокоды
                     -->
                    <td>
                        <span class="code-text editable" id="code_text_<?=$channel->id?>" data-id="<?=$channel->id?>" ><?=($channel->code==null) ? 'Укажите код' : $channel->code?></span>
                        <div class="code-input" id="code_input_<?=$channel->id?>" style="display: none">
                            <div class="input-field col s8">
                                <input id="code_<?=$channel->id?>" type="text" class="validate" value="<?=$channel->code?>">
                                <label for="code_<?=$channel->id?>">Код</label>
                            </div>
                            <div class="input-field col s4">
                                <button class="btn waves-effect waves-light btn-small save" data-name="code" data-id="<?=$channel->id?>"><i class="tiny material-icons">check</i></button>
                            </div>
                        </div>
                    </td>
                    <!--
                     Реферралы
                     -->
                    <td>
                        <span class="editable tooltipped referral-text" data-position="top" data-tooltip="Реферральные источники перехода" id="referral_text_<?=$channel->id?>" data-id="<?=$channel->id?>"><?=($channel->referral==null) ? 'Переходы' : $channel->referral?></span>

                        <div class="referral-input" id="referral_input_<?=$channel->id?>"  style="display: none">
                            <div class="input-field col s8">
                                <input id="referral_<?=$channel->id?>" type="text" class="validate" value="<?=$channel->referral?>">
                                <label for="referral_<?=$channel->id?>">referral</label>
                            </div>
                            <div class="input-field col s4">
                                <button class="btn waves-effect waves-light btn-small save_referral" data-name="referral" data-id="<?=$channel->id?>"><i class="tiny material-icons">check</i></button>
                            </div>
                        </div>
                    </td>
                    <!--
                     UTM метки
                     -->
                    <td>
                        <span class="editable tooltipped utm_source-text" data-position="top" data-tooltip="Метки utm_source через запятую" id="utm_source_text_<?=$channel->id?>" data-id="<?=$channel->id?>">source:</span>
                        <span class="utm-chips" id="utm_source_chips_<?=$channel->id?>" ><?=$channel->utm_source?></span>
                        <div class="utm_source-input" id="utm_source_input_<?=$channel->id?>" style="display: none">
                            <div class="input-field col s8">
                                <input id="utm_source_<?=$channel->id?>" type="text" class="validate" value="<?=$channel->utm_source?>">
                                <label for="utm_source_<?=$channel->id?>">utm_source</label>
                            </div>
                            <div class="input-field col s4">
                                <button class="btn waves-effect waves-light btn-small save_utm" data-name="utm_source" data-id="<?=$channel->id?>"><i class="tiny material-icons">check</i></button>
                            </div>
                        </div>

                        <br />
                        <span class="editable tooltipped utm_campaign-text" data-position="top" data-tooltip="Метки utm_campaign через запятую" id="utm_campaign_text_<?=$channel->id?>" data-id="<?=$channel->id?>">campaign:</span>
                        <span class="utm-chips" id="utm_campaign_chips_<?=$channel->id?>" ><?=$channel->utm_campaign?></span>
                        <div class="utm_campaign-input" id="utm_campaign_input_<?=$channel->id?>" style="display: none">
                            <div class="input-field col s8">
                                <input id="utm_campaign_<?=$channel->id?>" type="text" class="validate" value="<?=$channel->utm_campaign?>">
                                <label for="utm_campaign_<?=$channel->id?>">utm_campaign</label>
                            </div>
                            <div class="input-field col s4">
                                <button class="btn waves-effect waves-light btn-small save_utm" data-name="utm_campaign" data-id="<?=$channel->id?>"><i class="tiny material-icons">check</i></button>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php if (!$channel->isDefault()) : ?>
                            <div class="switch">
                                <label>
                                    Off
                                    <input class="on-off" data-id="<?=$channel->id?>" type="checkbox" <?=$channel->isEnable() ? 'checked': ''?>>
                                    <span class="lever"></span>
                                    On
                                </label>
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <br />
        <hr />
        <br />
        <a class="waves-effect waves-light btn " id="add_new"><i class="material-icons white-text left ">add_to_photos</i>Добавить канал</a>
    </div>
</div>