<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>
<div class="container">

<h1>Поиск:</h1>

	<div class="row">
		<div class="col-12">
			<div class="row catalog-product_content catalog-product_contentclass is-active">
				<!-- Element -->
				<?
					if(count($arResult["SEARCH"]) > 0){
						
						foreach($arResult["SEARCH"] as $arItem)
							$APPLICATION->IncludeFile($templateFolder . "/temp/item.php", $arItem, ["SHOW_BORDER " => false]);
						
					}else{
						ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));
					}
				?>
			</div>
			<? if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]; ?>
		</div>
	</div>

</div>