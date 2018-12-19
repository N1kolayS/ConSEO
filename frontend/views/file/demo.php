<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 05.12.2018
 * Time: 12:27
 */


/* @var $model common\models\Project */
/* @var $widget common\models\WidgetFrame */

use yii\helpers\Url;

?>

    const conseo_promo = {
        idBox: 'conseo_block',
        access_key: '<?=$model->id?> ',
        init: function(id) {
            if (!id) { id = this.idBox; }
            if (document.getElementById(id)) {
                conseo_promo.render(id);
            }
            else { console.log('The specified block id="'+id+'" is missing'); }
        },

        render: function (id) {
            <?php if ($widget->mobile) : // Render Moblie Iframe  ?>

            document.getElementById(id).style.height = '200px';
            document.getElementById(id).style.width = '100vw';
            document.getElementById(id).style.position = 'fixed';
            document.getElementById(id).style.background = 'rgba(0, 0, 0, 0) none repeat scroll 0% 0%';
            document.getElementById(id).style.zIndex = '10000';
            document.getElementById(id).style.<?=($widget->isLeft() ? 'left' : 'right')?> = '0';
            document.getElementById(id).style.bottom = '0';
            document.getElementById(id).innerHTML = '<iframe scrolling="no" id="' + id + '_frame" style="overflow: hidden; box-shadow: none; height: 210px; width: 100%; background: transparent;"  frameborder="0" src="<?=Url::to(['frame/debug', 'id' => $model->default_widget_id], true)?>?mobile=1" ></iframe>';

            <?php else: ?>

            document.getElementById(id).style.height = '210px';
            document.getElementById(id).style.width = '500px';
            document.getElementById(id).style.position = 'fixed';
            document.getElementById(id).style.background = 'rgba(0, 0, 0, 0) none repeat scroll 0% 0%';
            document.getElementById(id).style.zIndex = '10000';
            <?=$widget->positionFrame()?>
            document.getElementById(id).innerHTML = '<iframe scrolling="no" id="' + id + '_frame" style="overflow: hidden; box-shadow: none; height: 210px; width: 500px; background: transparent;"  frameborder="0" src="<?=Url::to(['frame/debug', 'id' =>  $model->default_widget_id], true)?>" ></iframe>';

            <?php endif; ?>
        }
    };
