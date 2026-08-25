<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-logo">
                    <a href=""><img data-src="<?=SITE_TEMPLATE_PATH?>/img/static/logo.png" alt="alt"></a>
                </div>
            </div>
            <div class="col-md-5 footer-nav">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "bottom.menu",
                    array(
                        "ROOT_MENU_TYPE" => "bottom",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "36000000",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_THEME" => "site",
                        "CACHE_SELECTED_ITEMS" => "N",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "MAX_LEVEL" => "1",
                        "USE_EXT" => "N",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "COMPONENT_TEMPLATE" => "bottom.menu1",
                        "CHILD_MENU_TYPE" => "left"
                    ),
                    false
                );?>
            </div>
            <div class="col-md-3 footer-right_column">
                <div class="footer-right_content">
                    <ul class="footer-contact">
                        <li>
                            <span class="glipf-phone"></span>
                            <a href="tel:+<?= tplvar('phone');?>"><?= tplvar('phone', true);?></a>
                        </li>
                        <li>
                            <span class="glipf-placeholder"></span>
                            <?= tplvar('city', true);?>
                        </li>
                        <li>
                            <a href="mailto:<?= tplvar('email');?>">
                                <span class="glipf-email"></span>
                                <?= tplvar('email', true);?>
                            </a>
                        </li>
                    </ul>


					<ul class="container">
						<li> <a href="https://prime-ltd.su/?from=proclimate36.ru"><img style="margin-left: -12px; width: 80%; height: 80%;" src="http://prime-ltd.su/logo/white.svg"; title="Продвижение сайтов" alt="Продвижение сайтов"></a></li>
					</ul>
                </div>

            </div>


<div style="border-top: 1px #757575 solid; padding-top: 15px; color: #757575;">
    Наш сайт использует <a style="color: #17769b;" target="_blank" href="/legal/cookie.pdf">cookies</a> для обеспечения работоспособности и сбора статистики. С их помощью мы анализируем пользовательскую активность, улучшаем работу сайта и делаем рекламу более релевантной. Оставаясь на сайте, вы даете <a style="color: #17769b;" target="_blank" href="/legal/consent.pdf">согласие на обработку ваших персональных данных</a>. Вы можете отключить сохранение cookies в настройках браузера в любой момент. На сайте также применяются <a style="color: #17769b;" target="_blank" href="/legal/recommendation.pdf">рекомендательные технологии</a>. Подробнее об обработке персональных данных — в соответствующей <a style="color: #17769b;" target="_blank" href="/legal/personal-data.pdf">Политике</a>.
</div>


        </div>
    </div>
</footer>
<!-- end main-footer -->
<div class="scroll-to-top"></div>
</div>
<!-- END GLOBAL-WRAPPER -->

<div aria-hidden="true" class="modal fade js-modal" id="callback" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-callback" role="document">
        <div class="modal-content">
            <button aria-label="Close" class="close uhified_close-btn" data-dismiss="modal" type="button"></button>

            <?$APPLICATION->IncludeComponent(
                "prime:main.feedback",
                "",
                array(
                    "EVENT_MESSAGE_ID" => array(
                        0 => "7",
                    ),
                    "IBLOCK_ID" => "10",
                    "IBLOCK_TYPE" => "feedback",
                    "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                    "PROPERTY_CODE" => array(
                        0 => "NAME",
                        1 => "PHONE",
                    ),
                    "COMPONENT_TEMPLATE" => ""
                ),
                false
            );?>
        </div>
    </div>
</div>

<? if($_REQUEST["success"]): ?>
    <div aria-hidden="true" class="modal fade js-modal" id="success_msg" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-callback" role="document">
            <div class="modal-content">
                <button aria-label="Close" class="close uhified_close-btn" data-dismiss="modal" type="button"></button>
                <div class="form-callback_title" style="padding: 30px;">
                    <h3>Сообщение отправлено!</h3>
                    <small>Мы обязательно вам перезвоним.</small>
                </div>
            </div>
        </div>
    </div>
<? endif; ?>


<link href="<?=SITE_TEMPLATE_PATH?>/css/min.css" rel="stylesheet" />
<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>

<link href="<?=SITE_TEMPLATE_PATH?>/css/main.css" rel="stylesheet" />
<script src="<?=SITE_TEMPLATE_PATH?>/js/min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/main.js"></script>



<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(62466880, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/62466880" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script>
	$('[data-text]').each(function(i, el){
        let self = $(el);
        self.html(self.data('text'));
    });
</script>


</body>
</html>