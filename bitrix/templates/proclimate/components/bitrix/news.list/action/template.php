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
<h1>Акции</h1>
<ul class="action-link_names">
    <li class="<?if(!isset($_REQUEST['CHECK_DATES']) || $_REQUEST['CHECK_DATES'] == 'Y'):?>active<?endif;?>"><a href="?CHECK_DATES=Y">Действующие акции</a></li>
    <li class="<?if($_REQUEST['CHECK_DATES'] == 'N'):?>active<?endif;?>"><a href="?CHECK_DATES=N">Архив акций</a></li>
</ul>
<div class="action-section_content">
    <?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

    if($arItem['DATE_ACTIVE_TO'])
    $new_date = $DB->FormatDate($arItem['DATE_ACTIVE_TO'], "DD.MM.YYYY", "MM DD, YYYY");
    ?>
    <div class="action-item">
        <div class="action-item_img">
            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?echo $arItem["NAME"]?>">
        </div>
        <div class="action-item_desc">
            <div class="action-item_title">
                <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                    <?echo $arItem["PREVIEW_TEXT"];?>
                <?endif;?>
            </div>
            <p><?echo $arItem["DETAIL_TEXT"];?></p>
            <div class="row align-items_end">
                <div class="col-lg-7">
                    <div class="action-item_price">
                        <del class="action-item_old-price"><?=$arItem['PROPERTIES']['PRICE']['VALUE']?></del>
                        <span class="action-item_new-price"><?=$arItem['PROPERTIES']['PRICE']['DESCRIPTION']?></span>
                    </div>
                    <a href="<?=$arItem['PROPERTIES']['BTN']['VALUE']?>" class="action-item_buy-btn main-btn">
                        <?=$arItem['PROPERTIES']['BTN']['DESCRIPTION']?>
                    </a>
                </div>
                <div class="col-lg-5">
                    <span class="action-timer_text">До конца акции</span>
                    <div class="action-timer" data-cdate="<?=$new_date?>"></div>
                </div>
            </div>
        </div>
    </div>
    <?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
