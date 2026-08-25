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
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);
$currentLen = $_REQUEST['len'];
$arLen = [30, 45];
$arSort = ['shows' => 'Популярности','SCALED_PRICE_1' => 'Цене', 'name' => 'Название'];
?><div class="catalog-section">
	<div class="container">

        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/banner-second.php"
            )
        );?>

        <?
        $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumb", Array("SITE_ID" => SITE_ID),
            false
        );

   $arFilterS = array('IBLOCK_ID' => $arParams['IBLOCK_ID'],'CODE' =>$arResult["VARIABLES"]["SECTION_CODE"]);
   $rsSectS = CIBlockSection::GetList(array(),$arFilterS,false,array("UF_SEO_NAME"));
   if ($arSectS = $rsSectS->GetNext())
   {
		if($arSectS["UF_SEO_NAME"]){
			$nesH = $arSectS["UF_SEO_NAME"];
	   }
   }?>
		<?if($nesH){?>
			<h1><?=$nesH?></h1>
		<?}else{?>
			<h1>Каталог товаров</h1>
		<?}?>
        <div class="row">
			<div class="col-xl-3 col-lg-4 col-md-4">
                <?
                if ($arParams['USE_FILTER'] == 'Y')
                {
                    $arFilter = array(
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "ACTIVE" => "Y",
                        "GLOBAL_ACTIVE" => "Y",
                    );
                    if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
                    {
                        $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
                    }
                    elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
                    {
                        $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
                    }

                    $obCache = new CPHPCache();
                    if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
                    {
                        $arCurSection = $obCache->GetVars();
                    }
                    elseif ($obCache->StartDataCache())
                    {
                        $arCurSection = array();
                        if (Loader::includeModule("iblock"))
                        {
                            $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID", "DESCRIPTION", "UF_FILTER"));

                            if(defined("BX_COMP_MANAGED_CACHE"))
                            {
                                global $CACHE_MANAGER;
                                $CACHE_MANAGER->StartTagCache("/iblock/catalog");

                                if ($arCurSection = $dbRes->Fetch())
                                {
                                    $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
                                }
                                $CACHE_MANAGER->EndTagCache();
                            }
                            else
                            {
                                if(!$arCurSection = $dbRes->Fetch())
                                    $arCurSection = array();
                            }
                        }
                        $obCache->EndDataCache($arCurSection);
                    }
                    ?>


                    <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.smart.filter",
                    "",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "SECTION_ID" => $arCurSection['ID'],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SAVE_IN_SESSION" => "N",
                        "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                        "XML_EXPORT" => "Y",
                        "SECTION_TITLE" => "NAME",
                        "SECTION_DESCRIPTION" => "DESCRIPTION",
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        "SEF_MODE" => $arParams["SEF_MODE"],
                        "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
                        "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );
                }
                ?>
				<!-- end sidebar-filter -->
			</div>

            <div class="col-xl-9 col-lg-8 col-md-8">

                <? $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
                    "section",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                        "TOP_DEPTH" => 1,
                        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                        "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                        "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                        "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                        "ADD_SECTIONS_CHAIN" => "N"
                    ),
                    $component,
                    array("HIDE_ICONS" => "Y")
                );?>
        <?
          global $menuTag;
          $arFilterTag = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'CODE'=>$arResult["VARIABLES"]["SECTION_CODE"]);
          $db_listTag = CIBlockSection::GetList(Array($by=>$order), $arFilterTag, true, Array("UF_TAG"));
          while($ar_resultTag = $db_listTag->GetNext())
          {
            if($ar_resultTag["UF_TAG"]){
                foreach($ar_resultTag["UF_TAG"] as $tag){
                    $menuTag[] = explode("##",$tag);
                }
            }
          }

if($menuTag):?>
				<?//if(count($menuTag)>5):?>
        <div class="slider_product_show_all slider_product_b tag_menu_b tag_menu_bc" id="tag_menu_b">
            <?
            foreach ($menuTag as $tag)
            {
                ?>
                    <div>
                        <a href="<?=$tag[1]?>"><?=$tag[0]?></a>
                    </div>
                <?
            }
            ?>
        </div>
				<?//endif;?>
    <div class="slider_product_show_all slider_product_b tag_menu_b slider_product_c tag_menu_all" style="display:none;" id="tag_menu_all">

        <?
        foreach ($menuTag as $tag)
        {
            ?>

                    <a href="<?=$tag[1]?>"><?=$tag[0]?></a>

            <?
        }
        ?>
    </div>
<div class="navi"><span class="open is-act">Показать все</span><span class="closem">Свернуть</span></div>
<?endif;?>

                <div class="catalog-top_box">
                    <? if($arCurSection['UF_FILTER']): ?>
					<div class="wrapper_filter-panel_item">
                        <?
                        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");
                        $arFilter = Array("IBLOCK_ID" => $arParams['UF_FILTER_IBLOCK_ID'], "ID" => $arCurSection['UF_FILTER'], "ACTIVE"=>"Y");
                        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                        while($ob = $res->GetNextElement()){
                            $arProps = $ob->GetProperties();
                            ?>
                            <div class="filter-panel_item">
                                <div class="filter-panel_item-title"><?=$arProps['NAME']['VALUE']?></div>
                                <ul class="filter-panel_parameters-list">
                                    <? foreach ($arProps['PROP']['VALUE'] as $desc => $val):?>
                                        <li>
                                            <a href="<?=$val?>"><?=$arProps['PROP']['DESCRIPTION'][$desc]?></a>
                                        </li>
                                    <? endforeach; ?>
                                    <li class="hidden_filter-paremeter_btn">
                                        <span class="text">Скрыть</span>
                                    </li>
                                </ul>
                            </div>
                        <? } ?>
					</div>
                    <? endif; ?>


					<div class="catalog-filter_panel">
						<div class="row">
							<div class="col-sm-6 left-column">
								<span class="text">Сортировать по:</span>
                                <form action="" onchange="this.submit()">
                                    <select class="js-select" name="SORT">
                                        <? foreach ($arSort as $sort => $text):?>
                                        <option value="<?=$sort?>" <?=($sort == $_REQUEST['SORT']) ? 'selected' : null; ?>><?=$text?></option>
                                        <? endforeach; ?>
                                    </select>
                                </form>
							</div>
							<div class="col-sm-6 right-column">
								<div class="catalog-filter_show-by">
									<span class="text">Показывать по:</span>
                                    <form action="" onchange="this.submit()">
                                        <select class="js-select" name="len">
                                            <? foreach ($arLen as $len):?>
                                                <option value="<?=$len?>" <?=($len == $currentLen) ? 'selected' : null; ?>><?=$len?></option>
                                            <? endforeach; ?>
                                        </select>
                                    </form>
								</div>
								<ul class="view-mode_list">
									<li class="view-mode_list-item product_view-mode_table js-product-view is-active">
										<span class="glipf-table view-mode_icon"></span>
									</li>
									<li class="view-mode_list-item js-product-view">
										<span class="glipf-list view-mode_icon"></span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
 
                <?$intSectionID = $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "",
                    array(
						"SECTION_USER_FIELDS" => ["UF_*"],
                        "LIST_PROPERTY_CODE" => $arParams['LIST_PROPERTY_CODE'],
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "ELEMENT_SORT_FIELD" => ($_REQUEST['SORT']) ?: $arParams["ELEMENT_SORT_FIELD"],
                        "ELEMENT_SORT_ORDER" => ($_REQUEST['SORT']) ? 'asc' : $arParams["ELEMENT_SORT_ORDER"],
                        "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                        "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                        "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                        "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                        "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                        "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                        "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                        "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                        "BASKET_URL" => $arParams["BASKET_URL"],
                        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                        "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SET_TITLE" => $arParams["SET_TITLE"],
                        "MESSAGE_404" => $arParams["MESSAGE_404"],
                        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                        "SHOW_404" => $arParams["SHOW_404"],
                        "FILE_404" => $arParams["FILE_404"],
                        "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                        "PAGE_ELEMENT_COUNT" => ($currentLen) ?: $arParams["PAGE_ELEMENT_COUNT"],
                        "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                        "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                        "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                        "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                        "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

                        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                        "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                        "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

                        "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                        "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                        "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                        "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                        "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                        "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

                        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                        "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                        "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

                        'LABEL_PROP' => $arParams['LABEL_PROP'],
                        'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                        'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

                        'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                        'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                        'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                        'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                        'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                        'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                        'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                        'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
                        'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
                        'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

                        'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                        "ADD_SECTIONS_CHAIN" => "Y",
                        'ADD_TO_BASKET_ACTION' => $basketAction,
                        'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                        'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare']
                    ),
                    $component
                );
                ?>
				
		<?
		
			$res = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'CODE' => $arResult["VARIABLES"]["SECTION_CODE"], 'SITE_ID' => "s1"));
			$section = $res->Fetch();
  
			$section_id =  $section["ID"];
			//echo $section_id;
			//$rsResult2 = CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>2, 'ACTIVE'=>'Y', "SECTION_ID"=>$section_id), true, array("UF_RECPRODUCTS"));
			//	while($arResult2 = $rsResult2->GetNext())
			//	{
			//	echo "<pre>"; print_r($arResult2); echo "</pre>";
			//	}
				//$arrID = array();
				$i=0;
				$arFilterSeo = Array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'ACTIVE'=>'Y', "ID"=>$section_id);
				$db_listSeo = CIBlockSection::GetList(Array($by=>$order), $arFilterSeo, true, Array('UF_RECPRODUCTS'));
				if($ar_resultSeo = $db_listSeo->GetNext())
				{
					 
					 foreach ($ar_resultSeo["~UF_RECPRODUCTS"] as $value) {
							//echo $value; 
							
							$id = explode(';', $value);
							//echo $id[0];
							$arrID[] = $id[0];
							//$i++;
							//echo "<br/>";
						}
				   /*print_r($ar_resultSeo["~UF_RECPRODUCTS"]);
				   echo "<br/>";
				  print_r($ar_resultSeo["~UF_RECPRODUCTS"][$i]);
				  $arrID = $ar_resultSeo[$i];
				 $i++;*/
				}

			//print_r($arrID);
            global $arrFilterRec;
			$arrFilterRec['ID'] = $arrID; 
			//$arParams["FILTER_NAME"] = "arrFilterRec";
				if (!empty($arrFilterRec['ID'])):
			?>
				<div class="section-title">Рекомендуемые товары</div>
			<?
				
			$APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "rec_section_by_ko",
                    array(
                        "LIST_PROPERTY_CODE" => $arParams['LIST_PROPERTY_CODE'],
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "ELEMENT_SORT_FIELD" => ($_REQUEST['SORT']) ?: $arParams["ELEMENT_SORT_FIELD"],
                        "ELEMENT_SORT_ORDER" => ($_REQUEST['SORT']) ? 'asc' : $arParams["ELEMENT_SORT_ORDER"],
                        "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                        "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                        "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                        "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                        "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                        "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                        "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                        "INCLUDE_SUBSECTIONS" => "A",
                        "BASKET_URL" => $arParams["BASKET_URL"],
                        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                        "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                        "FILTER_NAME" => "arrFilterRec",
						"USE_FILTER" => "Y",
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SET_TITLE" => $arParams["SET_TITLE"],
                        "MESSAGE_404" => $arParams["MESSAGE_404"],
                        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                        "SHOW_404" => $arParams["SHOW_404"],
                        "FILE_404" => $arParams["FILE_404"],
                        "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                        "PAGE_ELEMENT_COUNT" => ($currentLen) ?: $arParams["PAGE_ELEMENT_COUNT"],
                        "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                        "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                        "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                        "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                        "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
						"SHOW_ALL_WO_SECTION" => "Y",
                        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                        "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                        "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

                        "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                        "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                        "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                        "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                        "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                        "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

                        "SECTION_ID" => "",
                        "SECTION_CODE" => "",
                        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                        "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                        "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

                        'LABEL_PROP' => $arParams['LABEL_PROP'],
                        'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                        'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

                        'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                        'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                        'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                        'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                        'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                        'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                        'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                        'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
                        'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
                        'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

                        'TEMPLATE_THEME' => "rec_section_by_ko",
                        "ADD_SECTIONS_CHAIN" => "Y",
                        'ADD_TO_BASKET_ACTION' => $basketAction,
                        'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                        'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare']
                    ),
                    $component
                );
				
			endif;
		?>
		
        <?
          global $menuTagB;
          $arFilterTag = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'CODE'=>$arResult["VARIABLES"]["SECTION_CODE"]);
          $db_listTag = CIBlockSection::GetList(Array($by=>$order), $arFilterTag, true, Array("UF_TAG_2"));
          while($ar_resultTag = $db_listTag->GetNext())
          {
            if($ar_resultTag["UF_TAG_2"]){
                foreach($ar_resultTag["UF_TAG_2"] as $tag){
                    $menuTagB[] = explode("##",$tag);
                }
            }
          }

if($menuTagB):?>
                <?//if(count($menuTag)>5):?>
        <div class="slider_product_show_all slider_product_b tag_menu_b tag_menu_c tag_menu_bc" id="tag_menu_b">
            <?
            foreach ($menuTagB as $tag)
            {
                ?>
                    <div>
                        <a href="<?=$tag[1]?>"><?=$tag[0]?></a>
                    </div>
                <?
            }
            ?>
        </div>
                <?//endif;?>
    <div class="slider_product_show_all slider_product_b tag_menu_c tag_menu_b slider_product_c tag_menu_all" style="display:none;" id="tag_menu_all">

        <?
        foreach ($menuTagB as $tag)
        {
            ?>

                    <a href="<?=$tag[1]?>"><?=$tag[0]?></a>

            <?
        }
        ?>
    </div>
<div class="navi tag_menu_c"><span class="open is-act">Показать все</span><span class="closem">Свернуть</span></div>
<?endif;?>

                <div class="tablet-small_visible">
				
					<div class="section-title">Наши услуги</div>
					
                    <?$APPLICATION->IncludeComponent(
	"bitrix:news.line", 
	"services.catalog", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "300",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "",
		),
		"IBLOCKS" => array(
			0 => "5",
		),
		"IBLOCK_TYPE" => "news",
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"COMPONENT_TEMPLATE" => "services.catalog",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
				</div>

				<div class="text-section"><?=$arCurSection['DESCRIPTION']?></div>

			</div>
		</div>
	</div>
</div>

<?
$GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;
?>