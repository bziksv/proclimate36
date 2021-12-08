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
<script src="https://yastatic.net/share2/share.js" async="async"></script>

<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
    <h1><?=$arResult["NAME"]?></h1>
<?endif;?>
<div class="row">
    <div class="col-md-5 order-md-2">
        <figure class="news-detailed_img">
            <img data-src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult["NAME"]?>">
        </figure>
    </div>
    <div class="col-md-7">
        <div class="news-detailed_desc-box">
            <?echo $arResult["DETAIL_TEXT"];?>
        </div>
    </div>
</div>

<? if($arResult['PROPERTIES']['PRICE_SERVICE']['DESCRIPTION']): ?>
<div class="news-detailed_services">
    <div class="news-detailed_services-header"><?=$arResult['PROPERTIES']['PRICE_SERVICE']['NAME']?></div>
    <? foreach ($arResult['PROPERTIES']['PRICE_SERVICE']['DESCRIPTION'] as $key => $name):?>
    <div class="news-detailed_services-item">
        <div class="news-detailed_services-item_header"><?=$name?></div>
        <div class="news-detailed_services-item_body">
            <?=$arResult['PROPERTIES']['PRICE_SERVICE']['~VALUE'][$key]['TEXT']?>
        </div>
    </div>
    <? endforeach; ?>
</div>
<!-- end news-detailed_services -->
<? endif; ?>

<? if($arResult['PROPERTIES']['OTHER_INFO']['~VALUE']['TEXT']): ?>
<div class="news-detailed_additional-information">
    <div class="title"> <?=$arResult['PROPERTIES']['OTHER_INFO']['NAME'];?></div>
    <div class="wrapper-table">
        <?=$arResult['PROPERTIES']['OTHER_INFO']['~VALUE']['TEXT'];?>
    </div>
</div>
<!-- end news-detailed_additional-information -->
<? endif; ?>

<?=$arResult['PROPERTIES']['INFO']['~VALUE']['TEXT'];?>

<div class="news-detailed_footer">
    <span class="news-detailed_date"><?=$arResult['DISPLAY_ACTIVE_FROM']?></span>
    <span class="news-detailed_view"><span class="glipf-view"></span><?=$arResult['SHOW_COUNTER']?></span>
    <span class="news-detailed_share ya-share2" data-services="vkontakte,twitter,facebook,gplus" data-limit="0"></span>
</div>
