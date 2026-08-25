<!DOCTYPE html>
<html class="no-js" lang="<?=LANGUAGE_ID?>">
<head>
    <meta content="<?=SITE_TEMPLATE_PATH?>/browserconfig.xml" name="msapplication-config" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?$APPLICATION->ShowTitle()?></title>    <link href="<?=SITE_DIR?>img/favicon.ico" rel="icon" type="image/png" />
    <link href="<?=SITE_DIR?>img/favicon.png" rel="icon" type="image/png" />
    <link href="<?=SITE_DIR?>img/apple-touch-icon.png" rel="apple-touch-icon" />
    <? $APPLICATION->ShowHead(); ?>
    <style>body{opacity: 0;}</style>
    <script>var filterPrice = {},filterPrice_2 = {},filterPrice_3 = {},filterPrice_4 = {},filterPrice_5 = {},filterPrice_6 = {},filterPrice_7 = {},filterPrice_8 = {},filterPrice_9 = {},filterPrice_10 = {},filterPrice_11 = {},filterPrice_12 = {},filterPrice_13 = {},filterPrice_14 = {},filterPrice_15 = {},filterPrice_16 = {},filterPrice_17 = {},filterPrice_18 = {},filterPrice_19 = {},filterPrice_20 = {},filterPrice_21 = {},filterPrice_22 = {},filterPrice_23 = {},filterPrice_24 = {},filterPrice_25 = {},filterPrice_26 = {},filterPrice_27 = {},filterPrice_28 = {},filterPrice_29 = {},filterPrice_30 = {},filterPrice_31 = {},filterPrice_32 = {},filterPrice_33 = {},filterPrice_34 = {},filterPrice_35 = {},filterPrice_36 = {},filterPrice_37 = {},filterPrice_38 = {},filterPrice_39 = {},filterPrice_40 = {};</script>
<meta name="yandex-verification" content="61fd2e608af458fc" />
<meta name="google-site-verification" content="XVUUN__jKHjLxmKfdliCBFVVRv9jrw9XoC6BGbpXYiI" />
<link rel="icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
</head>
<body>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<!--[if lt IE 10]>
<p class="browsehappy"><br>Вы используете <strong>устаревший</strong> браузер.
    Пожалуйста, <a href="http://browsehappy.com/">обновите его</a> для корректного
    отображения сайтов.</p>
<![endif]-->
<div class="global-wrapper">

    <div class="wrapper-loader">
        <div class="preloader">
            <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
        </div>
    </div>

    <header class="ui-header">
        <div class="main-head">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-3 col-7 head_left-column">
                        <div class="hamburger hamburger--spring">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>

					<div class="logo-head">
                        <div class="head-logo">
                            <a href="/">
                                <img data-src="<?=SITE_TEMPLATE_PATH?>/img/static/logo.png" alt="alt">
                            </a>
                        </div>
						<div class="logo-head-text">Климатическая техника с установкой</div>
					</div>

                    </div>
                    <div class="col-sm-9 col-5 head_right-column">
                        <?
							$APPLICATION->IncludeComponent("bitrix:search.title", "visual", Array(
								"CATEGORY_0" => array(	// Ограничение области поиска
										0 => "iblock_catalog",
									),
									"CATEGORY_0_TITLE" => "",	// Название категории
									"CATEGORY_0_iblock_catalog" => array(	// Искать в информационных блоках типа "iblock_catalog"
										0 => "2",
									),
									"CHECK_DATES" => "N",	// Искать только в активных по дате документах
									"CONTAINER_ID" => "title-search",	// ID контейнера, по ширине которого будут выводиться результаты
									"INPUT_ID" => "title-search-input",	// ID строки ввода поискового запроса
									"NUM_CATEGORIES" => "1",	// Количество категорий поиска
									"ORDER" => "rank",	// Сортировка результатов
									"PAGE" => "#SITE_DIR#search/index.php",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
									"SHOW_INPUT" => "Y",	// Показывать форму ввода поискового запроса
									"SHOW_OTHERS" => "N",	// Показывать категорию "прочее"
									"TOP_COUNT" => "10",	// Количество результатов в каждой категории
									"USE_LANGUAGE_GUESS" => "N",	// Включить автоопределение раскладки клавиатуры
									"PRICE_CODE" => array(	// Тип цены
										0 => "BASE",
									),
									"SHOW_PREVIEW" => "Y",	// Показать картинку
								),
								false
							);?>

                        <div class="head-cart" id="small_cart">
                            <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "basket.small", Array(
                                "HIDE_ON_BASKET_PAGES" => "N",	// Не показывать на страницах корзины и оформления заказа
                                "SERVICE_IBLOCK_ID" => "13",
                                "POSITION_FIXED" => "N",	// Отображать корзину поверх шаблона
                                "SHOW_AUTHOR" => "N",	// Добавить возможность авторизации
                                "SHOW_EMPTY_VALUES" => "Y",	// Выводить нулевые значения в пустой корзине
                                "SHOW_NUM_PRODUCTS" => "Y",	// Показывать количество товаров
                                "SHOW_PERSONAL_LINK" => "N",	// Отображать персональный раздел
                                "SHOW_PRODUCTS" => "Y",	// Показывать список товаров
                                "SHOW_REGISTRATION" => "N",	// Добавить возможность регистрации
                                "SHOW_TOTAL_PRICE" => "Y",	// Показывать общую сумму по товарам
                                "COMPONENT_TEMPLATE" => ".default_old"
                            ),
                                false
                            );?>
                        </div>

                        <div class="head-contact">
                            <a href="tel:<?= tplvar('phone');?>" class="head_phone-number">
                                <span class="glipf-phone"></span><?= tplvar('phone', true);?></a>
                            <div class="head-adress">
                                <span class="glipf-placeholder"></span><?= tplvar('city', true);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="head_bottom-panel">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <?$APPLICATION->IncludeComponent("bitrix:menu", "catalog.menu.fixed", Array(
                            "ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
                            "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                            "MENU_CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                            "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                            "MENU_THEME" => "site",	// Тема меню
                            "CACHE_SELECTED_ITEMS" => "N",
                            "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                            "MAX_LEVEL" => "3",	// Уровень вложенности меню
                            "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                            "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                            "DELAY" => "N",	// Откладывать выполнение шаблона меню
                            "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                            "COMPONENT_TEMPLATE" => "catalog_horizontal"
                        ),
                            false
                        );?>
                    </div>
                    <div class="col-md-9">
                        <?$APPLICATION->IncludeComponent("bitrix:menu", "top.menu", Array(
                            "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                            "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                            "MENU_CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                            "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                            "MENU_THEME" => "site",	// Тема меню
                            "CACHE_SELECTED_ITEMS" => "N",
                            "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                            "MAX_LEVEL" => "1",	// Уровень вложенности меню
                            "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                            "DELAY" => "N",	// Откладывать выполнение шаблона меню
                            "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                            "COMPONENT_TEMPLATE" => "catalog_horizontal"
                        ),
                            false
                        );?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- END UI-HEADER -->