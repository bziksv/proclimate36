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
<div class="row category-section_mod-content">
    <? foreach ($arResult['SECTIONS'] as &$arSection): ?>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="category-item_mod">
            <span class="category-item_mod-img">
				<a href="<?=$arSection['SECTION_PAGE_URL']?>"><img data-src="<?=($arSection['PICTURE']['SRC']) ? $arSection['PICTURE']['SRC'] : SITE_TEMPLATE_PATH.'/img/favicon.png'?>" alt="<?=$arSection['NAME']?>"></a>
            </span>
            <div class="category-item_mod-title"><a href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a></div>
        </div>
    </div>
    <?endforeach;?>
</div>
