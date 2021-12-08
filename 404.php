<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
define("HIDE_SIDEBAR", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");?><div class="container">
	<div class="bx-404-container">
		<div class="bx-404-block">404</div>
		<div class="bx-404-text-block">
			<h2>Такой страницы нет =(</h2>
			<div class="bx-404-text-block-in">
				Возможно, эта страница была удалена, <br>
				перемещена, или ее никогда не было (( <br>
				Воспользуйтесь <a href="/catalog/">каталогом товаров</a>, <br>
				или вернитесь на <a href="<?=SITE_DIR?>">главную страницу</a>.
			</div>
		</div>
	</div>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"main",
	Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
		"FILTER_NAME" => "sectionsFilter",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "catalog",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(0=>"",1=>"",),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "1",
		"VIEW_MODE" => "LINE"
	)
);?> <!-- end category-section --> <?
        $arPopular = array();
        $arSelect = Array("IBLOCK_ID", "ID", "NAME");
        $arFilter = Array("IBLOCK_ID" => 2, "ACTIVE" => "Y", "PROPERTY_POPULAR_VALUE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
            $arPopular['IDS'][] = $arFields['ID'];
            $arPopular['IBLOCK_ID'] = $arFields['IBLOCK_ID'];
        }

        if($arPopular['IDS']){

            global $popularFilter;

            $popularFilter = array(
                "=ID" => $arPopular['IDS'],
            );

            $APPLICATION->IncludeComponent(
				"bitrix:catalog.section", 
				"popular", 
				array(
					"ACTION_VARIABLE" => "action_crp",
					"ADD_PICT_PROP" => "-",
					"ADD_PROPERTIES_TO_BASKET" => "Y",
					"ADD_SECTIONS_CHAIN" => "N",
					"ADD_TO_BASKET_ACTION" => "ADD",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "N",
					"BACKGROUND_IMAGE" => "-",
					"BASKET_URL" => "/personal/basket.php",
					"BROWSER_TITLE" => "-",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"COMPATIBLE_MODE" => "Y",
					"CONVERT_CURRENCY" => "N",
					"CUSTOM_FILTER" => "",
					"DISABLE_INIT_JS_IN_COMPONENT" => "N",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"DISPLAY_COMPARE" => "N",
					"DISPLAY_TOP_PAGER" => "N",
					"ELEMENT_SORT_FIELD" => "name",
					"ELEMENT_SORT_FIELD2" => "id",
					"ELEMENT_SORT_ORDER" => "asc",
					"ELEMENT_SORT_ORDER2" => "desc",
					"ENLARGE_PRODUCT" => "STRICT",
					"FILTER_NAME" => "popularFilter",
					"HIDE_NOT_AVAILABLE" => "N",
					"HIDE_NOT_AVAILABLE_OFFERS" => "N",
					"IBLOCK_ID" => $arPopular["IBLOCK_ID"],
					"LIST_PROPERTY_CODE" => array(
						0 => "TYPE",
						1 => "AREA",
						2 => "COMPRESSOR",
						3 => "COOLING",
						4 => "MAX_TEMP_POWER",
						5 => "AVERAGE_FUEL",
						6 => "NUMBER_TEMP_HEART",
						7 => "EFFECTIVE_SQUARE",
						8 => "NUMB_SECTION",
						9 => "GARANT",
						10 => "POWER",
						11 => "NUMBER_OF_SPEEDS",
						12 => "IDLING",
						13 => "UNDER_LOAD",
						14 => "DIAM_ALMZ_CROWN",
						15 => "CONNECTION",
						16 => "DIAM_CROWN",
						17 => "CROWN_LENGH",
					),
					"IBLOCK_TYPE" => "catalog",
					"INCLUDE_SUBSECTIONS" => "Y",
					"LABEL_PROP" => "",
					"LAZY_LOAD" => "N",
					"LINE_ELEMENT_COUNT" => "3",
					"LOAD_ON_SCROLL" => "N",
					"MESSAGE_404" => "",
					"MESS_BTN_ADD_TO_BASKET" => "В корзину",
					"MESS_BTN_BUY" => "Купить",
					"MESS_BTN_DETAIL" => "Подробнее",
					"MESS_BTN_SUBSCRIBE" => "Подписаться",
					"MESS_NOT_AVAILABLE" => "Нет в наличии",
					"META_DESCRIPTION" => "-",
					"META_KEYWORDS" => "-",
					"OFFERS_LIMIT" => "5",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => ".default",
					"PAGER_TITLE" => "Товары",
					"PAGE_ELEMENT_COUNT" => "18",
					"PARTIAL_PRODUCT_PROPERTIES" => "N",
					"PRICE_CODE" => array(
						0 => "BASE",
					),
					"PRICE_VAT_INCLUDE" => "Y",
					"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
					"PRODUCT_ID_VARIABLE" => "id",
					"PRODUCT_PROPS_VARIABLE" => "prop",
					"PRODUCT_QUANTITY_VARIABLE" => "quantity",
					"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
					"PRODUCT_SUBSCRIPTION" => "Y",
					"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
					"RCM_TYPE" => "personal",
					"SECTION_CODE" => "",
					"SECTION_CODE_PATH" => $_REQUEST["SECTION_CODE_PATH"],
					"SECTION_ID" => "",
					"SECTION_USER_FIELDS" => array(
						0 => "",
						1 => "",
					),
					"SEF_MODE" => "N",
					"SET_BROWSER_TITLE" => "Y",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "Y",
					"SET_META_KEYWORDS" => "Y",
					"SET_STATUS_404" => "N",
					"SET_TITLE" => "Y",
					"SHOW_404" => "N",
					"SHOW_ALL_WO_SECTION" => "N",
					"SHOW_CLOSE_POPUP" => "N",
					"SHOW_DISCOUNT_PERCENT" => "N",
					"SHOW_FROM_SECTION" => "N",
					"SHOW_MAX_QUANTITY" => "N",
					"SHOW_OLD_PRICE" => "N",
					"SHOW_PRICE_COUNT" => "1",
					"SHOW_SLIDER" => "Y",
					"SLIDER_INTERVAL" => "3000",
					"SLIDER_PROGRESS" => "N",
					"TEMPLATE_THEME" => "blue",
					"USE_ENHANCED_ECOMMERCE" => "N",
					"USE_MAIN_ELEMENT_SECTION" => "N",
					"USE_PRICE_COUNT" => "N",
					"USE_PRODUCT_QUANTITY" => "N",
					"COMPONENT_TEMPLATE" => "popular",
					"SECTION_URL" => "",
					"DETAIL_URL" => "",
					"SECTION_ID_VARIABLE" => "",
					"SEF_RULE" => "",
					"COMPOSITE_FRAME_MODE" => "A",
					"COMPOSITE_FRAME_TYPE" => "AUTO"
				),
				false
			);
        }
        ?> 
	<div class="services-section"></div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>