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
				<a href="<?=$arSection['SECTION_PAGE_URL']?>"><img data-src="<?=$arSection['PICTURE']['SRC']?>" alt="<?=$arSection['NAME']?>"></a>
            </span>
            <div class="category-item_mod-title"><a href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a></div>
            <span class="category-item_view-categories">Посмотреть категории</span>

            <? if($arSection['SUB']): ?>
            <ul class="category-item_list">
                <? foreach ($arSection['SUB'] as $section_2): ?>
                <li class="category-item_list-title">
                    <a href="<?=$section_2['SECTION_PAGE_URL']?>"><?=$section_2['NAME']?></a>

                    <? if($section_2['SUB']): ?>
                    <ul class="category-item_submenu">
                        <? foreach ($section_2['SUB'] as $section_3): ?>
                        <li><a href="<?=$section_3['SECTION_PAGE_URL']?>"><?=$section_3['NAME']?></a></li>
                        <?endforeach;?>
                    </ul>
                    <? endif;?>
                </li>
                <?endforeach;?>
            </ul>
            <? endif;?>
        </div>
    </div>
    <?endforeach;?>
</div>
