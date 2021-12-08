<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

$this->setFrameMode(true);
?>
<? if (!empty($arResult['ITEMS'])): ?>
<div class="relate-products_section">
    <div class="section-title">Похожие товары</div>
    <div class="product-unified_slider">
        <? foreach ($arResult['ITEMS'] as $key => $arItem): ?>
            <div class="product-item">
            <div class="product-item_img">
                <?
                if($arItem['PROPERTIES']['MARK']['VALUE_XML_ID'])
                    include('mark/'.$arItem['PROPERTIES']['MARK']['VALUE_XML_ID'].'.php');
                ?>
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                    <img data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
                </a>
            </div>
            <span class="product-item_category">
                <?=($arItem['IBLOCK_SECTION_ID']) ? CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID'])->GetNext()['NAME'] : '';?>
            </span>
            <div class="product-item_title">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
            </div>
            <span class="product-item_price"><?=$arItem['PRICES']['BASE']['PRINT_VALUE']?></span>
            <div class="product-item_hidden">
                <ul class="product-item_features">
                    <? foreach ($arParams['LIST_PROPERTY_CODE'] as $code):?>
                        <li>
                            <span class="<?=($arItem['PROPERTIES'][$code]['HINT']) ?: 'glipf-swing'?>"></span>
                            <span class="gray-color"><?=$arItem['PROPERTIES'][$code]['NAME']?></span> -
                            <? echo (is_array($arItem['PROPERTIES'][$code]['VALUE']) ? implode(' / ', $arItem['PROPERTIES'][$code]['VALUE']) : $arItem['PROPERTIES'][$code]['VALUE']);?>
                        </li>
                    <? endforeach; ?>
                </ul>
                <a href="#" class="product-item_buy-btn main-btn" data-id="<?=$arItem['ID']?>">Купить</a>
            </div>
        </div>
        <? endforeach;?>
    </div>
</div>
<? endif; ?>
