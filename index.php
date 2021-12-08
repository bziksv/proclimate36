<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Мы предлагаем широкий ассортимент кондиционеров по адекватным ценам.");
$APPLICATION->SetTitle("Кондиционеры в Воронеже");
?><main class="main-content">
<div class="main-section">
	<div class="container">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"slider",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "300",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"FIELD_CODE" => array(0=>"CODE",1=>"NAME",2=>"PREVIEW_TEXT",3=>"PREVIEW_PICTURE",4=>"",),
		"IBLOCKS" => array(0=>"7",),
		"IBLOCK_TYPE" => "news",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
	</div>
</div>
 <!-- end main-section -->
<div class="advantages-section">
	<div class="container">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"advantage",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "300",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"FIELD_CODE" => array(0=>"CODE",1=>"PREVIEW_TEXT",2=>"",),
		"IBLOCKS" => array(0=>"8",),
		"IBLOCK_TYPE" => "news",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
	</div>
</div>
 <!-- end advantages-section -->
<div class="container">
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
        ?> <!-- end product-section --> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/include/banner.php"
	)
);?> <!-- end banner --> <?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"services",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "300",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"FIELD_CODE" => array(0=>"PREVIEW_TEXT",),
		"IBLOCKS" => array(0=>"5",),
		"IBLOCK_TYPE" => "news",
		"NEWS_COUNT" => "3",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?> <!-- end services-section --> <?$APPLICATION->IncludeComponent("bitrix:news.line", "news", array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "300",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"FIELD_CODE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "PREVIEW_TEXT",
		),
		"IBLOCKS" => array(
			0 => "1",
		),
		"IBLOCK_TYPE" => "news",
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?> <!-- end news-section --> <?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"brands",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "300",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"FIELD_CODE" => array(0=>"PREVIEW_PICTURE",1=>"PREVIEW_TEXT",),
		"IBLOCKS" => array(0=>"4",),
		"IBLOCK_TYPE" => "news",
		"NEWS_COUNT" => "15",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?> <!-- end brands-section -->
	<div class="section-title">
		 Наши сертификаты
	</div>
	<div class="container" align="center">

 <a target="_blank" href="/images/dealer_certificate_1_LESSAR_Sert2021.pdf"><img src="/images/preview_dealer_certificate_1_LESSAR_Sert2021.jpg" title="Сертификат дилера LESSAR"></a> 

<a target="_blank" href="/images/dealer_certificate_2_TOSOT.pdf"><img src="/images/preview_dealer_certificate_2_TOSOT.jpg" title="Сертификат дилера TOSOT"></a>

<a target="_blank" href="/images/dealer_certificate_3_Haier.pdf"><img src="/images/preview_dealer_certificate_3_Haier.jpg" title="Сертификат дилера Haier"></a>

	</div>
 <br>
 <br>
	<div class="contact-section">
		<div class="container-fluid">
			<div class="row no-gutters align-items-center">
				<div class="col-md-6">
					<div class="contact-section_desc">
						<div class="section-title">
							 Наши контакты
						</div>
						<ul class="contact-list">
							<li> <span class="glipf-placeholder"></span>
							<?= tplvar('street', true);?> </li>
							<li> <span class="glipf-phone"></span> <a href="tel:<?= tplvar('phone');?>"><?= tplvar('phone', true);?></a> </li>
							<li> <a href="mailto:online@rusklimat.ru"> <span class="glipf-email"></span>
							<?= tplvar('email', true);?> </a> </li>
						</ul>
 <a href="#callback" data-toggle="modal" class="callback-btn main-btn">Заказать звонок</a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="map-container">
						<div id="map">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	 <!-- end contact-section -->
</div>
 </main>
<!-- end main-content --><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>