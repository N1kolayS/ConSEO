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

$route_save_val = Url::to(['ajax/save-val' ]);

$widget_on_off = Url::to(['ajax/widget-multi', 'id' => $project->id]);




$script = <<<JS
//Edit Name
$(".name-text").click(function() {
    // Close previous
    $(".name-text").show();
    $(".name-input").hide();
    let channel_id = $(this).attr("data-channel-id");
    let position_id = $(this).attr("data-position-id");
    $(this).hide();
    $("#val_input_"+channel_id+"_"+position_id).show(); 
 });


// Save values
$(".save").click(function() {
    const channel_id = $(this).attr("data-channel-id");
    const position_id = $(this).attr("data-position-id");
   
    const value = $("#name_"+channel_id+"_"+position_id).val();
    if (value.length>0)
        {
            
            $.get( "$route_save_val", { value: value, channel_id: channel_id, position_id: position_id } )
                        .done(function( json )
                        {
                            let result = JSON.parse(json);
                            if (result['result'])
                                {
                                     $("#val_input_"+channel_id+"_"+position_id).hide(); 
                                     $("#val_text_"+channel_id+"_"+position_id).html(value).show(); 
                                     
                                }
                        });
                        
             
        }
    
     
 });



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
                    <th>Канал</th>
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
                            <!-- table -->
                            <table class="striped">
                                <?php foreach ($project->positions as $position): ?>
                                    <tr>
                                        <td><?=$position->name?> <strong><?=$position->htmlId?></strong> </td>
                                        <td>
                                            <span class="name-text editable" id="val_text_<?=$channel->id?>_<?=$position->id?>" data-channel-id="<?=$channel->id?>" data-position-id="<?=$position->id?>">
                                                <?=(($value = $position::showValue($channel->id, $position->id))==null) ? 'Не задан' : $value?>
                                            </span>
                                            <div class="name-input" id="val_input_<?=$channel->id?>_<?=$position->id?>" style="display: none">
                                                <div class="input-field col s8">
                                                    <input id="name_<?=$channel->id?>_<?=$position->id?>" type="text" class="validate" value="<?=$value?>">
                                                    <label for="name_<?=$channel->id?>_<?=$position->id?>">Название</label>
                                                </div>
                                                <div class="input-field col s4">
                                                    <button class="btn waves-effect waves-light btn-small save" data-name="name" data-channel-id="<?=$channel->id?>" data-position-id="<?=$position->id?>">
                                                        <i class="tiny material-icons">check</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </table>

                            <!-- table -->
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
