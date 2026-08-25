<?
global $USER;
$arItem = [];
$res = CIBlockElement::GetByID($arParams["ITEM_ID"]);
if($ar_res = $res->GetNext())
  $arItem = $ar_res;
  
$arPrice = CCatalogProduct::GetOptimalPrice($arItem['ID'], 1, $USER->GetUserGroupArray(), 'N');
?>
<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
	<div class="product-item product-itemclass product-item_list">
		<div class="product-item_img">
				<a href="<?echo $arParams["URL"]?>"><img alt="<?echo $arParams["TITLE_FORMATED"]?>" src="<?=CFile::GetPath($arItem["PREVIEW_PICTURE"]);?>"></a>
		</div>
		<div class="product-item_desc">

			<div class="product_item_desc-top">
				<div class="product-item_title">
					<a href="<?echo $arParams["URL"]?>"><?echo $arParams["TITLE_FORMATED"]?></a>
				</div>
				<span class="product-item_price"><?=CurrencyFormat($arPrice['DISCOUNT_PRICE'], $arPrice['PRICE']['CURRENCY'])?></span>
				<div class="description"><?echo $arParams["BODY_FORMATED"]?></div>
			</div>
			
			<div class="product-item_hidden">
				<a href="" class="product-item_buy-btn main-btn" data-id="<?echo $arParams["ITEM_ID"]?>">Купить</a>
			</div>
		</div>
	</div>
</div>