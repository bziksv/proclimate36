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

<?foreach($arResult["ITEMS"] as $arItem):?>
<?
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<div class="services-mod_item">
    <div class="services-mod_item-img">
        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img data-src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></a>
    </div>
    <div class="services-mod_item-desc">
        <div class="services-mod_item-title"><?echo $arItem["NAME"]?></div>
        <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
            <p><?echo $arItem["PREVIEW_TEXT"];?></p>
        <?endif;?>
        <div class="services-mod_item-footer">
            <span class="services-mod_item-price"><?=$arItem['PROPERTIES']['PRICE']['VALUE']?></span>
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="services-mod_item-link">
                <span class="text">Подробнее</span> <span class="arrow">&#8594;</span>
            </a>
        </div>
    </div>
</div>
<?endforeach;?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
