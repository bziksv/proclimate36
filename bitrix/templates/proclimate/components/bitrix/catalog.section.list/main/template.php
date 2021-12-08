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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>
<div class="category-section">
    <div class="section-title">Категории товаров</div>
    <div class="row category-section_content">
        <? foreach ($arResult['SECTIONS'] as &$arSection):
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
        ?>
        <div class="col-lg-3 col-6">
            <div class="category-item">
                <a href="<?=$arSection['SECTION_PAGE_URL']?>">
                    <span class="category-item_img">
                        <img data-src="<?=$arSection['PICTURE']['SRC']?>" alt="<?=$arSection['NAME']?>">
                    </span>
                    <?=$arSection['NAME']?>
                </a>
            </div>
        </div>
        <?endforeach;?>
    </div>
</div>
