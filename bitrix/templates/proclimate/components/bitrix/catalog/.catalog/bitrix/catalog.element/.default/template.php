<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="row selected-product_content">
    <div class="col-lg-5">
        <div class="selected-product_desc-header  tablet-visible">
            <span class="selected-product_desc-type"><?=$arResult['SECTION']['NAME']?></span>
            <div class="selected-product_title"><?=$arResult['NAME']?></div>
            <div class="selected-product_bottom-panel">
                <? if($arResult['PROPERTIES']['ARTICLE']['VALUE']): ?>
                <span class="selected-product_code">Код товара: <?=$arResult['PROPERTIES']['ARTICLE']['VALUE']?></span>
                <?endif;?>

                <? if($arResult['PROPERTIES']['BRAND']['VALUE']): ?>
                <span class="selected-product_brand">
                    <img data-src="<?=CFile::GetPath($arResult['PROPERTIES']['BRAND']['VALUE']);?>" alt="<?=$arResult['NAME']?>">
                </span>
                <?endif;?>
            </div>
        </div>

        <div class="selected-product_large-slider js-big-slider-img">
            <? if($arResult['PROPERTIES']['YOUTUBE']['VALUE']): ?>
                <? foreach ($arResult['PROPERTIES']['YOUTUBE']['VALUE'] as $video):?>
                    <a class="fancybox selected-product_large-img" data-fancybox="group" data-width="800" data-height="600" href="https://www.youtube.com/watch?v=<?=$video?>">
                        <img data-src="http://img.youtube.com/vi/<?=$video?>/sddefault.jpg">
                    </a>
                <? endforeach; ?>
            <? endif; ?>

            <? foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $key => $gallery):?>
                <a href="<?=$gallery?>" class="fancybox selected-product_large-img" data-fancybox="group">
                    <img data-src="<?=$gallery?>" alt="<?=$arResult['NAME']?>">
                    <?
                    if($arResult['PROPERTIES']['MARK']['VALUE_XML_ID'])
                        include('mark/'.$arResult['PROPERTIES']['MARK']['VALUE_XML_ID'].'.php');
                    ?>
                </a>
            <? endforeach; ?>
        </div>
        <!-- end selected-product-large-img -->
        <ul class="selected-product_small-slider js-miniature-pictures">
            <? if($arResult['PROPERTIES']['YOUTUBE']['VALUE']): ?>
                <? foreach ($arResult['PROPERTIES']['YOUTUBE']['VALUE'] as $video):?>
                    <li>
                        <a class="fancybox" data-fancybox="" data-width="800" data-height="600" href="https://www.youtube.com/watch?v=<?=$video?>">
                            <img data-src="<?=SITE_TEMPLATE_PATH?>/img/icons/video.jpg">
                        </a>
                    </li>
                <? endforeach; ?>
            <? endif; ?>

            <? foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $key => $gallery):?>
            <li>
                <img data-src="<?=$gallery?>" alt="<?=$arResult['NAME']?>">
            </li>
            <? endforeach; ?>
        </ul>
        <!-- end realty-detailed-small-slider -->
    </div>
    <div class="col-lg-7">
        <div class="selected-product_desc">
            <div class="selected-product_desc-header  tablet-hidden">
                <span class="selected-product_desc-type"><?=$arResult['SECTION']['NAME']?></span>
                <h1 class="selected-product_title"><?=$arResult['NAME']?></h1>
                <div class="selected-product_bottom-panel">
                    <span class="selected-product_code">
                    <? if($arResult['PROPERTIES']['ARTICLE']['VALUE']): ?>
                        Код товара: <?=$arResult['PROPERTIES']['ARTICLE']['VALUE']?>
                    <? endif; ?>
                    </span>

                    <? if($arResult['PROPERTIES']['BRAND']['VALUE']): ?>
                    <span class="selected-product_brand">
                        <img data-src="<?=CFile::GetPath($arResult['PROPERTIES']['BRAND']['VALUE']);?>" alt="<?=$arResult['NAME']?>">
                    </span>
                    <? endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5 col-mod-right">
                    <div class="selected-product_features-title"></div>
                    <ul class="selected-product_features">
                        <? foreach ($arParams['DETAIL_PROPERTY_CODE'] as $code):
                            if(!$arResult['PROPERTIES'][$code]['VALUE'])
                                continue;
                            ?>
                        <li>
                            <span class="<?=($arResult['PROPERTIES'][$code]['HINT']) ?: 'glipf-swing'?>"></span>
								<? //echo $arResult['PROPERTIES'][$code]['NAME']?>
								<?
									if($arResult['PROPERTIES'][$code]['CODE'] == 'AREA' && $arResult['PROPERTIES']['CHANGE_AREA_FIELD_NAME']['VALUE'] != '') {
										echo $arResult['PROPERTIES']['CHANGE_AREA_FIELD_NAME']['VALUE'];
									} else {
										echo $arResult['PROPERTIES'][$code]['NAME'];
									}
								?>
							 - <? echo (is_array($arResult['PROPERTIES'][$code]['VALUE']) ? implode(' / ', $arResult['PROPERTIES'][$code]['VALUE']) : $arResult['PROPERTIES'][$code]['VALUE']);?>
                        </li>
                        <? endforeach; ?>
                    </ul>
                </div>
                <div class="col-sm-7">
                    <div class="selected-product_border-box">
                        <div class="selected-product_box-top">
                            <span class="text">Цена</span>
                            <span class="product-availability">В наличии</span>
                        </div>
                        <span class="selected-product_price"><?=$arResult['PRICES']['BASE']['PRINT_VALUE']?></span>
                        <a href="" class="selected-product_buy-btn main-btn" data-id="<?=$arResult['ID']?>">Купить</a>
                        <a href="#callback" data-toggle="modal" class="selected-product_help-btn border-blue_btn">Помощь специалиста</a>
                        <? if($arResult['SERVICE']):?>
                        <div class="selected-product_services-title">Выберите услугу:</div>
                        <ul class="selected-product_services-list">
                            <? foreach ($arResult['SERVICE'] as $service):?>
                            <li>
                                <label class="unified-radio unified-radio_mod">
                                    <input value="<?=$service['NAME']?>" type="radio" class="catalog_service" name="service_cat" <?=($_SESSION['CATALOG_SERVICE'] == $service['NAME']) ? 'checked' : null?>>
                                    <span class="radio-text"><?=$service['NAME']?></span>
                                </label>
                                <div class="selected-product_hint"><?=$service['PREVIEW_TEXT']?></div>
                            </li>
                            <? endforeach; ?>
                        </ul>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<? if($arResult['PROPERTIES']['VERSOIN']['VALUE']): ?>
<div class="products_same-series">
    <span class="products_same-series_title">Кондиционеры из серии <?=$arResult['PROPERTIES']['VERSOIN']['VALUE']?> другой мощности:</span>
    <ul class="products_same-series_list">
        <? foreach ($arResult['PROPERTIES']['OTHER_CLIMAT']['VALUE'] as $link => $val):?>
        <li class="product_same-series_item">
            <a href="<?=$arResult['PROPERTIES']['OTHER_CLIMAT']['DESCRIPTION'][$link]?>">
                <?
                $arValue = explode('/', $val, 2);
                ?>
                <span class="product_same-series_content"><?=$arValue[0]?></span>
                <span class="product_same-series_price"><?=$arValue[1]?></span>
            </a>
        </li>
        <? endforeach; ?>
    </ul>
</div>
<? endif; ?>
<!-- end products_same-series -->

<div class="tab-container">
    <ul class="selected-product_tab-names">
        <li class="tab active">Описание</li>
        <li class="tab">Характеристики</li>
        <li><a href="/payment/" target="_blank">Оплата и доставка</a></li>
    </ul>
    <div class="selected-product_content-tabs">
        <div class="tab-item is-visible"><?=$arResult['DETAIL_TEXT']?></div>
        <div class="tab-item">
            <ul class="menu-dot">
                <? foreach ($arParams['DETAIL_MAIN_PROPERTY_CODE'] as $code):
                    if(!$arResult['PROPERTIES'][$code]['VALUE'])
                        continue;
                    ?>
                    <li>
                        <span class="main">
                            <?=$arResult['PROPERTIES'][$code]['NAME']?>

                            <? if($arResult['PROPERTIES'][$code]['DESCRIPTION']):?>
                                <span class="question-mark" title="<? echo (is_array($arResult['PROPERTIES'][$code]['DESCRIPTION']) ? implode(' / ', $arResult['PROPERTIES'][$code]['DESCRIPTION']) : $arResult['PROPERTIES'][$code]['DESCRIPTION']);?>">?</span>
                            <? endif; ?>
                        </span>
                        <span class="page">
                            <? echo (is_array($arResult['PROPERTIES'][$code]['VALUE']) ? implode(' / ', $arResult['PROPERTIES'][$code]['VALUE']) : $arResult['PROPERTIES'][$code]['VALUE']);?>
                        </span>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
    </div>
</div>

