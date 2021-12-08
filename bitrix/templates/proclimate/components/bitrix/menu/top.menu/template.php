<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<nav class="head-nav">
    <ul class="head-menu">
        <?foreach($arResult["MENU_STRUCTURE"] as $itemID => $arColumns):?>
        <?$existPictureDescColomn = ($arResult["ALL_ITEMS"][$itemID]["PARAMS"]["picture_src"] || $arResult["ALL_ITEMS"][$itemID]["PARAMS"]["description"]) ? true : false;?>
        <li><a href="<?=$arResult["ALL_ITEMS"][$itemID]["LINK"]?>"><?=$arResult["ALL_ITEMS"][$itemID]["TEXT"]?></a></li>
        <?endforeach;?>
    </ul>
</nav>
