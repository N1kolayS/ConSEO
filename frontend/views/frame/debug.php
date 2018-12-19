<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 04.12.2018
 * Time: 17:00
 */

/* @var $this yii\web\View */
/* @var $widget \common\models\WidgetFrame */

if ($widget->isLeft())
{
    $position        = 'left';
    $position_invert = 'right';
}
else {
    $position        = 'right';
    $position_invert = 'left';
}

$script_desktop = <<< JS

const head_text =  '{$widget->code}';
const head_open_text ='{$widget->title} {$widget->code}';
const color_corner = $(".close-widget").css("color");
const color_corner_pos = $(".corner-widget").css("color");
let _staticComplete = true;
function complete() {
    if (_staticComplete)
        {
            let width_open = head_open_text.length*10;
            if ( head_open_text.length*10>370)
            {
                width_open = 370;
            }
            if ( head_open_text.length*10<250)
            {
                width_open =250;
            }
            
            $("#block").animate({
            height: "150px",
            width: width_open+"px"
            }, 1000, function() {
                
                $(".right-close").show();
                $("#content").fadeIn("slow");
                $("#title_head").fadeOut('slow', function() {
                    $("#corner").css('border-$position_invert-color', color_corner);
                    $("#head").addClass('head-focus');
                    $("#title_head").html('{$widget->title} {$widget->code}').fadeIn();
                });
               
            });
            $("#image").removeClass('img').addClass('img-hover');
            $("#circle").removeClass('blink-circle-$position');
            _staticComplete = false;
        }
}

const cover = $("#image_block");
cover.mouseover(function() {
  complete();
});


$("#close").click(function() {
    $("#title_head").fadeOut('slow', function() {
                   
                    $("#title_head").html('{$widget->code}').fadeIn();
                });
    let width = head_text.length*10+20;
    $("#content").fadeOut('slow');
    $("#block").animate({
    height: "30px",
     width: width+"px"
    }, 1000, function() {
        
        $("#head").removeClass('head-focus');
        $("#corner").css('border-$position_invert-color', color_corner_pos);
        $(".right-close").hide();
        $("#close_widget").show();
        
        
    });
});
// Minimized
$("#close_widget").click(function () {
  $("#full").fadeOut("slow", function() {
        $("#small_widget").animate({ $position: '0' },  "slow" );
  });
});

$("#small_widget").click(function() {
    _staticComplete = true;
    $("#image").removeClass('img-hover').addClass('img');
  $("#small_widget").animate({ $position: '-40px' },  "slow", function() {
        $("#full").fadeIn('slow');
  } );
});
  
JS;

$script_mobile = <<< JS

    const head_text =  '{$widget->title} {$widget->code}';
    const code_text = '{$widget->code}';
    const widget  = $("#small_widget");
    const block =  $("#block");
    // Init
     widget.animate({ $position: '0' },  "slow", function() {
       // Show baloon
       $("#block").fadeIn();
     });
     
     
    let _staticComplete = true;
    let _staticOpen = false;
    
    function complete() {
    if (_staticComplete)
        {
            block.show();
            $("#small_widget").animate({ $position: '-40px' },  "slow" );
            block.animate({
            $position: '0',
            height: "150px",
            width: "100%"
            }, 1000, function() {
                $("#close").show();
                $("#content").fadeIn("slow");
                $("#title_head").fadeOut('slow', function() {
                    $("#head").addClass('head-focus');
                    $("#title_head").html(head_text).fadeIn();
                });
            });
            _staticOpen = true;
            _staticComplete = false;
        }
    }


widget.click(function() {

  complete();
});

$("#close").click(function() {
    if (_staticOpen)
        {
            let width = code_text.length*10+50;
            $("#title_head").html(code_text).fadeIn();
            $("#content").fadeOut('slow');
            $("#block").animate({
            $position: '55px',
            height: "30px",
            width: width+"px"
            }, 1000, function() {
                $("#head").removeClass('head-focus');
                widget.animate({ $position: '0' },  "slow", );
            });
            _staticOpen = false;
            _staticComplete = true;    
        }
        else {
            block.hide();
             }
});

JS;

$this->registerCss($widget->template->code);
if ($widget->mobile)
{
    $this->registerJs($script_mobile);
}
else {
    $this->registerJs($script_desktop);
}


?>
<?php if ($widget->mobile): ?>
    <div class="mobile-widget">
        <div id="small" >
            <div  class="mobile-small-block mobile-small-block-<?=$position?>" id="small_widget"><div class="mobile-small-img"></div></div>
        </div>
        <div class="mobile-block-text mobile-block-text-<?=$position?>" id="block">
            <div class="mobile-header" id="head">
                <span class="mobile-head-text" id="title_head"><?=$widget->title_flip?></span> <span id="close" class="mobile-right-close">&times;</span>
            </div>
            <div class="mobile-content-opacity" id="content">
                <span class="mobile-icon-warning"></span>Позвоните по телефону<br />
                <a target="_parent" id="usephone" class="mobile-phone" href="tel:<?=$widget->phone?>"><?=$widget->phone?></a><br />
                назовите Ваш код и<br />
                получите скидку!<br/>
                <a class="mobile-logo" href="" target="_blank"><div class="mikro-logo"></div></a>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="widget">
        <div id="full" >
            <div class="close-widget close-widget-<?=$position?>"        id="close_widget">&times;</div>
            <div class="circle circle-<?=$position?> blink-circle-<?=$position?>" id="circle" >&nbsp;</div>

            <div class="image-block-<?=$position?>" id="image_block">
                <div class="corner-<?=$position?>" id="corner" ></div>
                <div class="img"                   id="image"></div>
            </div>
            <div class="block-text block-text-<?=$position?>" id="block">
                <div class="header" id="head">
                    <span class="head-text" id="title_head"><?=$widget->title_flip?></span> <span id="close" class="right-close">&times;</span>
                </div>
                <div class="content-opacity" id="content">
                    <span class="icon-warning"></span>Позвоните по телефону<br>
                    <a target="_parent" id="usephone" class="phone" href="tel:<?=$widget->phone?>"><?=$widget->phone?></a>
                    <br>назовите Ваш код и<br>получите скидку!<br><a class="logo" href="" target="_blank"><div class="mikro-logo"></div></a>
                </div>
            </div>
        </div>
        <div id="small" >
            <div class="small-block small-block-<?=$position?>" id="small_widget"><div class="small-img"></div></div>
        </div>
    </div>
<?php endif; ?>