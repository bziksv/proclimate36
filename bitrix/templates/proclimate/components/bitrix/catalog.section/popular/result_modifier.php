<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

foreach ($arResult['ITEMS'] as $key => &$arItem){
    if($arItem['IBLOCK_SECTION_ID'])
        $arItem['SECTION'] = CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID'])->GetNext();

	$arResult['ITEMS'][$key]['DETAIL_PAGE_URL']='/catalog/product/'.$arItem['CODE'];

    if($arItem['PREVIEW_PICTURE']){
        $arItem['PREVIEW_PICTURE']['SRC'] = CFile::ResizeImageGet(
            $arItem['PREVIEW_PICTURE']['ID'],
            ["width" => 230, "height" => 195],
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        )['src'];
    }
}

