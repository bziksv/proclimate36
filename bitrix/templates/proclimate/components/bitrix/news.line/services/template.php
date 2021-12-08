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
<div class="services-section">
    <div class="section-title">Наши услуги</div>
    <div class="row services-slider">
        <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

        $db_props = CIBlockElement::GetProperty($arItem['IBLOCK_ID'], $arItem['ID'], array(), Array("CODE" => "MAIN_ICON"));
        if($ar_props = $db_props->Fetch())
            $ICON = $ar_props["VALUE"];
        ?>
        <div class="col-md-4">
            <div class="services-item">
                <span class="services-item_icon <?=$ICON;?>"></span>
                <div class="services-item_title"><?=$arItem['NAME']?></div>
                <p><?=$arItem['PREVIEW_TEXT']?></p>
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="services-item_more-details">
                    <span class="text">Подробнее</span> <span class="arrow">&#8594;</span>
                </a>
            </div>
        </div>
        <?endforeach;?>
    </div>
</div>
