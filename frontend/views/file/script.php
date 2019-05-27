<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 04.12.2018
 * Time: 22:26
 */

/* @var $model \common\models\Project */
/* @var $widget \common\models\WidgetFrame */

/* @var $ip  */
/* @var $lifetime  */
/* @var $mobile  */

use yii\helpers\Url;
use yii\helpers\Json;

?>

    const conseo_promo = {
        idBox: 'conseo_block',
        access_key: '<?=$model->id?> ',
        init: function(id) {
            if (!id) { id = this.idBox; }
            if (document.getElementById(id)) {

                const list_utm_campaign = {};
                const list_utm_source = {};
                const list_referral = {};
                    <?php
                    foreach ($model->channelsEnable as $channel)
                    {
                        if ($channel->utm_campaign!==null){
                            foreach (explode(',', $channel->utm_campaign) as $campaign)
                            {
                                echo "list_utm_campaign['". trim($campaign). "'] = '$channel->id';".PHP_EOL ;
                            }
                        }
                        if ($channel->utm_source!==null)
                        {
                            foreach (explode(',', $channel->utm_source) as $source)
                            {
                                echo "list_utm_source['". trim($source). "'] = '$channel->id';".PHP_EOL ;
                            }
                        }
                        if ($channel->referral!==null)
                        {
                            foreach (explode(',', $channel->referral) as $referral)
                            {
                                echo "list_referral['". trim($referral). "'] = '$channel->id';".PHP_EOL ;
                            }
                        }
                    }
                    ?>

                let channel = '<?=$model->defaultChannel->id?>';
                let channel_campaign = false;
                let channel_source   = false;
                let channel_referral  = false;
                let url = document.location + ''; // Convert toString
                let search = url.split('?')[1]; // Select params after ?
                let ref = document.referrer;
                let request;
                let params = {};
                // Find referral host
                function getHost()
                {
                    let a = document.createElement('a');
                    a.href = ref;
                    return a.host;
                }

                if (search!==undefined)
                {
                    // Generate Array params => value and record into params
                    search.split('&').forEach(function(item) {
                        item = item.split('=');
                        params[item[0]] = item[1];
                    });

                    // Ищем по campaign
                    for(let key in list_utm_campaign) {
                        if (key===params['utm_campaign'])
                        {
                            channel_campaign = list_utm_campaign[key];
                            break;
                        }
                    }
                    // Ищем по source
                    for(let key in list_utm_source) {
                        if (key===params['utm_source'])
                        {
                            channel_source = list_utm_source[key];
                            break;
                        }
                    }
                }


                // Ищем по referral
                for(let key in list_referral) {
                    if (key===getHost())
                    {
                        channel_referral = list_referral[key];
                        break;
                    }
                }

                if (channel_referral)
                {
                    channel = channel_referral;
                }
                if (channel_source)
                {
                    channel = channel_source;
                }
                if (channel_campaign)
                {
                    channel = channel_campaign;
                }

//console.log(channel);

                request = this.sendAjaxUtm("url="+encodeURIComponent(url)
                    +"&key="+encodeURIComponent(this.access_key)
                    +"&channel_id="+encodeURIComponent(channel)
                    +"&ref="+encodeURIComponent(ref)
                    +"&browser="+encodeURIComponent(navigator.userAgent)
                    +"&ip="+encodeURIComponent('<?=$ip?>')
                    +"&mobile="+encodeURIComponent('<?= ($widget->mobile) ? 1 : 0 ?>')
                    +"&cookie="+encodeURIComponent(conseo_promo.getCookie('conseo')));

                request.onreadystatechange=function() {
                    if (this.readyState===4) {
                        if(this.status===200) {
                            var reqdata = JSON.parse(this.responseText);

                            conseo_promo.setCookie('conseo', reqdata.cookie, {
                                expires: <?=$lifetime?>,
                                path: '/'
                            });
                            <?php if ($model->isWidgetFrameEnable()) {  ?>
                            //Check if Default and Disable default
                            conseo_promo.render(id,channel, reqdata.cookie );
                            <?php }  ?>

                            <?php if ($model->isWidgetMultiEnable()) {  ?>
                            //conseo_promo.multi(channel, reqdata.cookie );
                            conseo_promo.multiHead(channel, params);
                            <?php }  ?>
                        }
                    }
                    return false;
                };

            }
            else { console.log('The specified block id="'+id+'" is missing'); }
        },
        addStyle: function(id) {
            document.head.innerHTML += '<style type="text/css">#conseo_showmephone {color: white; text-decoration: none; border: 2px solid white; border-radius: 20px; padding: 6px 18px; font-size: 14px; line-height: 100px; cursor: pointer; text-transform: none; margin: 0; transition: 0.3s;}</style>';
        },
        sendAjaxUtm: function (data)
        {
            const XHR = ("onload" in new XMLHttpRequest()) ? XMLHttpRequest : XDomainRequest; // Check IE or Browser
            const xhr = new XHR();
            xhr.open('POST', '<?=Url::to(['xajax/visit', 'id' => $model->id], true)?>', true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.send(data);
            return xhr;
        },
        getCookie: function (name) {
            const matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        },
        setCookie: function (name, value, options) {
            options = options || {};
            let expires = options.expires;
            if (typeof expires === "number" && expires) {
                let d = new Date();
                d.setTime(d.getTime() + expires * 1000);
                expires = options.expires = d;
            }
            if (expires && expires.toUTCString) {
                options.expires = expires.toUTCString();
            }
            value = encodeURIComponent(value);
            let updatedCookie = name + "=" + value;
            for (let propName in options) {
                updatedCookie += "; " + propName;
                let propValue = options[propName];
                if (propValue !== true) {
                    updatedCookie += "=" + propValue;
                }
            }
            document.cookie = updatedCookie;
        },

        render: function (id, channel, cookie) {
            <?php if ($widget->mobile) : // Render Moblie Iframe  ?>

            document.getElementById(id).style.height = '200px';
            document.getElementById(id).style.width = '100vw';
            document.getElementById(id).style.position = 'fixed';
            document.getElementById(id).style.background = 'rgba(0, 0, 0, 0) none repeat scroll 0% 0%';
            document.getElementById(id).style.zIndex = '10000';
            document.getElementById(id).style.<?=($widget->isLeft() ? 'left' : 'right')?> = '0';
            document.getElementById(id).style.bottom = '0';
            document.getElementById(id).innerHTML = '<iframe scrolling="no" id="' + id + '_frame" style="overflow: hidden; box-shadow: none; height: 210px; width: 100%; background: transparent;"  frameborder="0" src="<?=Url::to(['frame/demo', 'id' => $model->default_widget_id], true)?>?mobile=1&channel=' + channel + '&cookie=' + cookie + '" ></iframe>';

            <?php else: ?>

            document.getElementById(id).style.height = '210px';
            document.getElementById(id).style.width = '500px';
            document.getElementById(id).style.position = 'fixed';
            document.getElementById(id).style.background = 'rgba(0, 0, 0, 0) none repeat scroll 0% 0%';
            document.getElementById(id).style.zIndex = '10000';
            <?=$widget->positionFrame()?>
            document.getElementById(id).innerHTML = '<iframe scrolling="no" id="' + id + '_frame" style="overflow: hidden; box-shadow: none; height: 210px; width: 500px; background: transparent;"  frameborder="0" src="<?=Url::to(['frame/demo', 'id' =>  $model->default_widget_id], true)?>?channel=' + channel + '&cookie=' + cookie + '" ></iframe>';

            <?php endif; ?>

        },

        multiHead: function (channel_id, params) {
            <?php
            foreach ($model->positions as $position) {

                if ($position->listValueByChannel())
                {
                ?>
                let elem<?=$position->id?> = <?=Json::encode($position->listValueByChannel())?>;
                if (document.getElementById("<?=$position->htmlId?>")!==null)
                {
                    if ((elem<?=$position->id?>[channel_id]!==undefined)&&(elem<?=$position->id?>[channel_id]!==null)) {

                            let result_val<?=$position->id?> = (params['utm_term']!==undefined) ? elem<?=$position->id?>[channel_id].replace("{keyword}", decodeURI(params['utm_term']) ) : elem<?=$position->id?>[channel_id].replace("{keyword}", "" );
                            document.getElementById("<?=$position->htmlId?>").innerHTML =result_val<?=$position->id?>;
                    }
                }
                <?php
                echo PHP_EOL;
                }
            }
            ?>
        }

};
