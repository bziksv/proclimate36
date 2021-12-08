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
<div class="main-slider">
    <?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="main-slide">
        <div class="row align-items-center">
            <div class="col-md-6 order-md-2">
                <div class="main-slide_title tablet-small_visible">
                    <?=$arItem['NAME']?>
                </div>
                <div class="main-slide_img">
                    <img data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="main-slide_title tablet-small_hidden">
                    <?=$arItem['NAME']?>
                </div>
                <p><?=$arItem['PREVIEW_TEXT']?></p>
                <a href="<?=$arItem['CODE']?>" class="main-btn main-slide_btn">В каталог</a>
            </div>
        </div>
    </div>
    <?endforeach;?>
</div>
