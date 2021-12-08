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
<div class="head-catalog">
    <span class="head-catalog_hamburger"></span>
    <span class="head-catalog_text"><a href="/catalog/">Каталог товаров</a></span>
    <div class="head-catalog_dropdown">
        <?foreach($arResult["MENU_STRUCTURE"] as $itemID => $arColumns):?>
        <?$existPictureDescColomn = ($arResult["ALL_ITEMS"][$itemID]["PARAMS"]["picture_src"] || $arResult["ALL_ITEMS"][$itemID]["PARAMS"]["description"]) ? true : false;?>
        <ul class="catalog-dropdown_menu">
            <li class="catalog-dropdown_menu-title"><a href="<?=$arResult["ALL_ITEMS"][$itemID]["LINK"]?>">
                    <?=$arResult["ALL_ITEMS"][$itemID]["TEXT"]?>
                </a>
            </li>
            <?foreach($arColumns as $key=>$arRow): ?>
                <?foreach($arRow as $itemIdLevel_2 => $arLevel_3):?>
                <li class="<?=($arLevel_3) ? 'parent' : null; ?>">
                    <a href="<?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"]?>"><?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["TEXT"]?></a>
                    <? if($arLevel_3): ?>
                    <ul class="catalog-dropdown_submenu">
                    <?foreach($arLevel_3 as $arLevel_4):?>
                        <li>
                            <a href="<?=$arResult["ALL_ITEMS"][$arLevel_4]["LINK"]?>"><?=$arResult["ALL_ITEMS"][$arLevel_4]["TEXT"]?></a>
                        </li>
                    <?endforeach;?>
                    </ul>
                    <? endif; ?>
                </li>
                <?endforeach;?>
            <?endforeach;?>
        </ul>
        <?endforeach;?>
    </div>
</div>
