<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 28.11.2018
 * Time: 21:27
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $project common\models\Project */

$this->title = 'Быстрый старт';
$this->params['breadcrumbs'][] = $this->title;

/* EnjoyHint */

$enjoy_script = <<<JS
 
//initialize instance
var  enjoyhint_instance = new EnjoyHint();
	//var enjoyhint_instance = new EnjoyHint();
var enjoyhint_script_steps = [
  {
    'click .new_btn' : 'Click the "New" button to start creating your project'
  }  
];

//set script config
enjoyhint_instance.set(enjoyhint_script_steps);

//run Enjoyhint script
enjoyhint_instance.run();
/*
//simple config.
//Only one step - highlighting(with description) "New" button
//hide EnjoyHint after a click on the button.
var enjoyhint_script_steps = [
    {
        "next #banner": 'Hello, I\'d like to tell you about EnjoyHint.<br> Click "Next" to proceed.'
    },
    {
        "next #buttons": "You can select different blocks. For example, let's select title.<br>" +
            "This event has a very simple code.<br>" +
            "{<br>" +
            "<text style='color: #00a6eb'>&nbsp &nbsp ' next #title '</text> : <text style='color: #2bff3c'>' Some description '</text> <br>" +
            "}<br>" +
            "<text style='color: #00ebe7'>next</text> - event (all events are described in the documentation)<br>" +
            "<text style='color: #00ebe7'>#title</text> - selector <br>" +
            "<text style='color: #00ebe7'>Some description</text> - Description for the block <br>"
    },
    {
        "click .btn-success" : "For example, let's set a handler for a button click event.<br>" +
            "{<br>" +
            "<text style='color: #00a6eb'>&nbsp &nbsp ' click .btn-success '</text> : <text style='color: #2bff3c'>' Some description '</text> <br>" +
            "}<br>" +
            "Click the button and move on.",
        showSkip: false
    },
    {
        "next #button6" : "You can highlight blocks by selecting them in a circle. <br>" +
            "<text style='color: #00ebe7'>shape</text> - you can define shape of highligting (rectangular||circle)<br>" +
            "{<br>" +
            "<text style='color: #00a6eb'>&nbsp &nbsp ' next #selector '</text> : <text style='color: #2bff3c'>' Some description ',</text> <br>" +
            "<text style='color: #00a6eb'>&nbsp &nbsp ' shape '</text> :  <text style='color: #2bff3c'>' circle '</text> <br>" +
            "}<br>" +
            "The circle radius seems to be too small.<br> Click 'Next' to fix it.",
        shape : 'circle'
    },
    {
        "next #mini_button" : "At this step we fix radius<br>" +
            "<text style='color: #00ebe7'>radius</text> - sets the size of the circle radius<br>" +
            "{<br>" +
            "<text style='color: #00a6eb'>&nbsp &nbsp ' next #selector '</text> : <text style='color: #2bff3c'>' Some description ',</text> <br>" +
            "<text style='color: #00a6eb'>&nbsp &nbsp ' shape '</text> :  <text style='color: #2bff3c'>' circle '</text> <br>" +
            "<text style='color: #00a6eb'>&nbsp &nbsp ' radius '</text> : 80<br>" +
            "}<br>",
        shape : 'circle',
        radius: 80
    },
    {
        "next #animationSpeed" : "Sometimes you need to scroll the page either very slowly (as we've just done) or very fast.<br>" +
            "<text style='color: #00ebe7'>scrollAnimationSpeed</text> - sets the speed for the scroll page<br>" +
            "{<br>" +
            "<text style='color: #00a6eb'>&nbsp &nbsp ' next #selector '</text> : <text style='color: #2bff3c'>' Some description ',</text> <br>" +
            "<text style='color: #00a6eb'>&nbsp &nbsp ' scrollAnimationSpeed '</text> : 2500<br>" +
            "}<br>",
        scrollAnimationSpeed : 2500
    },
    {
        "key #suc_input" : "You can attach handlers to keyboard events.<br>" +
            "<text style='color: #00ebe7'>keyCode</text> - key code for any 'key' event.<br>" +
            "{<br>" +
            "<text style='color: #00a6eb'>&nbsp &nbsp ' key #selector '</text> : <text style='color: #2bff3c'>' Some description ',</text> <br>" +
            "<text style='color: #00a6eb'>&nbsp &nbsp ' keyCode '</text> : 13<br>" +
            "}<br>" +
            "Enter some text and press 'Enter'",
        keyCode : 13
    }

];

//set script config
enjoyhint_instance.set(enjoyhint_script_steps);

//run Enjoyhint script
enjoyhint_instance.run();
*/
JS;

\common\assets\PrismjsAsset::register($this);

\common\assets\EnjoyhintAsset::register($this);

//$this->registerJs($enjoy_script);
?>

<div class="row ui-app__row">
    <div class="col m12 ui-app__header">
        <h1 class="center-align display-2"><?= Html::encode($this->title) ?></h1>
    </div>

</div>

<div class="row">
    <h2 class="center-align headline ">Поздравляем, вы успешно создали проект. Осталось несколько шагов</h2>
    <div class="col s12 m6">

        <div class="card ui-app__page-content">
            <div class="card-content">
                <div class="card-title headline">Шаг первый</div>

                <div class="card-body">

                    <div class="card indigo darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Настроить каналы</span>
                            <p>В разделе каналов настроить каналы</p>
                        </div>
                        <div class="card-action">

                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
    <div class="col s12 m6">

        <div class="card ui-app__page-content">
            <div class="card-content">
                <div class="card-title headline">Шаг второй</div>

                <div class="card-body">

                    <div class="card indigo darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Настроить виджет</span>
                            <p>В разделе виджетов настроить Виджет</p>
                        </div>
                        <div class="card-action">


                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
    <div class="col s12 m6">

        <div class="card ui-app__page-content">
            <div class="card-content">
                <div class="card-title headline">Шаг 3</div>

                <div class="card-body">
                    <div class="card indigo darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Установите код на сайт</span>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <div class="col s12 m6">

        <div id="syntex-html" class="col s12">
                                            <pre>
    <code class="language-html">
&lt;script src="<?=\yii\helpers\Url::toRoute(['file/script', 'id'=>$project->id], true)?>"&gt;&lt;/script&gt;
&lt;div id="conseo_block"&gt;&lt;/div&gt;
&lt;script type="text/javascript"&gt;
    conseo_promo.init('conseo_block');
&lt;/script&gt;
    </code>
</pre>
        </div>
    </div>

</div>
