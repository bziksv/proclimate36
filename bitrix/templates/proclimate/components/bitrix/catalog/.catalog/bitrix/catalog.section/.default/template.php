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
<style>
	/*.catalog-product_content.is-active .needtohide {
		display:none;
}*/
</style>
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
<script>
	/*$(function() {
		$('body').on('click', function() {
			$('body').find('.catalog-product_content.is-active .needtohide').remove();
		});
});*/
</script>

<div class="row catalog-product_content catalog-product_contentclass">
    <? if (!empty($arResult['ITEMS'])): ?>
    <? foreach ($arResult['ITEMS'] as $key => $arItem): ?>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="product-item product-itemclass">
                <div class="product-item_img">
                    <?
                        if($arItem['PROPERTIES']['MARK']['VALUE_XML_ID'])
                            include('mark/'.$arItem['PROPERTIES']['MARK']['VALUE_XML_ID'].'.php');
                    ?>
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                        <img data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
                    </a>
                </div>
                <div class="product-item_desc">

                    <div class="product_item_desc-top">
                        <? if(in_array($arItem['IBLOCK_SECTION_ID'], ['12', '21']) && $arItem['PROPERTIES']['HIDE_CATEGORY']['VALUE'] != 'Да'):?>
                            <?if($arItem['PROPERTIES']['VERSOIN']['VALUE']):?>
                                <span class="product-item_category">Серия:<br/><?=$arItem['PROPERTIES']['VERSOIN']['VALUE']?></span>
                            <?else:?>
                                <span class="product-item_category"><?=$arItem['SECTION']['NAME'];?></span>
                            <?endif;?>
                        <?else:?>
							<?if($arItem['PROPERTIES']['HIDE_CATEGORY']['VALUE'] != 'Да'):?>
                            	<span class="product-item_category"><?=$arItem['SECTION']['NAME'];?></span>
							<?endif;?>
                        <?endif;?>
                        <div class="product-item_title">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                <?=$arItem['NAME']?>
                            </a>
                        </div>
                        <span class="product-item_price"><?=$arItem['PRICES']['BASE']['PRINT_VALUE']?></span>
                    </div>
                    <div class="product-item_hidden">
                        <ul class="product-item_features">
                            <? foreach ($arParams['LIST_PROPERTY_CODE'] as $code):
                                if(!$arItem['PROPERTIES'][$code]['VALUE'])
                                    continue;
                                ?>

							<? if($arItem['PROPERTIES'][$code.'_SHOW']['VALUE'] != 'Нет'): ?>
                                <li>
                                    <span class="<?=($arItem['PROPERTIES'][$code]['HINT']) ?: 'glipf-swing'?>"></span>
                                    <span class="gray-color">
										<?
											if($arItem['PROPERTIES'][$code.'_CHANGENAME']['VALUE'] != '') {
												echo $arItem['PROPERTIES'][$code.'_CHANGENAME']['VALUE'];
											} else {
												echo $arItem['PROPERTIES'][$code]['NAME'];
											}
										?>
									</span> -
                                    <? echo (is_array($arItem['PROPERTIES'][$code]['VALUE']) ? implode(' / ', $arItem['PROPERTIES'][$code]['VALUE']) : $arItem['PROPERTIES'][$code]['VALUE']);?>
                                </li>
							<? endif; ?>


                            <? endforeach; ?>
							<?if($arItem["PREVIEW_TEXT"]):?>
                                <li>
                                    <?=$arItem["PREVIEW_TEXT"]?>
                                </li>
                            <? endif;?>
                        </ul>
						<? if($key >= $arResult["UF_HIDE_BUY"] && !is_null($arResult["UF_HIDE_BUY"])): ?>
							<a href="" class="product-item_buy-btn main-btn" data-id="<?=$arItem['ID']?>" data-text="Купить"></a>
						<? else: ?>
							<a href="" class="product-item_buy-btn main-btn" data-id="<?=$arItem['ID']?>">Купить</a>
						<?endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach;?>
    <?else:?>
        <p>Нет товаров!</p>
    <? endif;?>
</div>

<? echo $arResult["NAV_STRING"]; ?>

