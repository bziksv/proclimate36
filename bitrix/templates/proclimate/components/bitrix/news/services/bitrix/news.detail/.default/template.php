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
<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
    <h1><?=$arResult["NAME"]?></h1>
<?endif;?>

<div class="services-detailed_top-desc">
    <div class="row">
        <div class="col-md-6">
            <p><?echo $arResult["DETAIL_TEXT"];?></p>
        </div>
        <div class="col-md-6">
            <div class="services-detailed_main-img">
                <img data-src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult["NAME"]?>">
                <span class="services-detailed_price"><?=$arResult['PROPERTIES']['PRICE']['VALUE']?></span>
            </div>
        </div>
    </div>
</div>

<? if($arResult['PROPERTIES']['STANDART']['DESCRIPTION']): ?>
<div class="services-detailed_box">
    <div class="services-detailed_box-title"><?=$arResult['PROPERTIES']['STANDART']['NAME']?></div>

    <? foreach ($arResult['PROPERTIES']['STANDART']['DESCRIPTION'] as $key => $name):
        $arName = explode('|', $name, 2);
        ?>
    <div class="services-detailed_work-item">
        <div class="services-detailed_work-item_header">
            <span class="left-column"><?=$arName[0]?></span>
            <span class="right-column"><?=$arName[1]?></span>
        </div>
        <div class="services-detailed_work-item_body">
            <?=$arResult['PROPERTIES']['STANDART']['~VALUE'][$key]['TEXT']?>
        </div>
    </div>
    <? endforeach; ?>
</div>
<? endif; ?>
<!-- end services-detailed_box -->

<? if($arResult['PROPERTIES']['PRICE_LIST']['DESCRIPTION']): ?>
    <div class="services-detailed_box">
        <div class="services-detailed_box-title"><?=$arResult['PROPERTIES']['PRICE_LIST']['NAME']?></div>

        <? foreach ($arResult['PROPERTIES']['PRICE_LIST']['DESCRIPTION'] as $key => $name):
            $arName = explode('|', $name, 2);
            ?>
            <div class="services-detailed_work-item">
                <div class="services-detailed_work-item_header">
                    <span class="left-column"><?=$arName[0]?></span>
                    <span class="right-column"><?=$arName[1]?></span>
                </div>
                <div class="services-detailed_work-item_body">
                    <?=$arResult['PROPERTIES']['PRICE_LIST']['~VALUE'][$key]['TEXT']?>
                </div>
            </div>
        <? endforeach; ?>
    </div>
<? endif; ?>
<!-- end services-detailed_box -->

<? if($arResult['PROPERTIES']['WORK']['DESCRIPTION']): ?>
<div class="services-detailed_box">
    <div class="services-detailed_box-title"><?=$arResult['PROPERTIES']['WORK']['NAME']?></div>

    <? foreach ($arResult['PROPERTIES']['WORK']['DESCRIPTION'] as $key => $name):?>
    <div class="services-detailed_work-item">
        <div class="services-detailed_work-item_header"><?=$name?></div>
        <div class="services-detailed_work-item_body">
            <?=$arResult['PROPERTIES']['WORK']['~VALUE'][$key]['TEXT']?>
        </div>
    </div>
    <? endforeach; ?>
</div>
<? endif; ?>
<!-- end services-detailed_box -->

<? if($arResult['PROPERTIES']['MATERIALS']['VALUE']): ?>
<div class="services-detailed_box">
    <div class="services-detailed_box-title"><?=$arResult['PROPERTIES']['MATERIALS']['NAME']?></div>
    <table class="services-detailed_materials-table">
        <? foreach ($arResult['PROPERTIES']['MATERIALS']['DESCRIPTION'] as $key => $name):?>
        <tr>
            <td><?=$arResult['PROPERTIES']['MATERIALS']['VALUE'][$key]?></td>
            <td><?=$name?></td>
        </tr>
        <? endforeach; ?>
    </table>
</div>
<? endif; ?>
<!-- end services-detailed_box -->
<div class="services-detailed_footer-text">
    <?=$arResult['PROPERTIES']['INFO']['~VALUE']['TEXT'];?>
</div>
