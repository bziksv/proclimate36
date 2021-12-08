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
<div class="sidebar-show_mobile-btn">
    <span class="text">Показать все фильтры</span>
    <span class="glipf-filter"></span>
</div>

<aside class="sidebar-filter">

    <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
        <?foreach($arResult["HIDDEN"] as $arItem):?>
            <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
        <?endforeach;?>

        <div class="sidebar-filter_block bx-filter-parameters-box">
            <?
            foreach($arResult["ITEMS"] as $key => $arItem)//prices
            {
                $key = $arItem["ENCODED_ID"];
                if(isset($arItem["PRICE"])):

                    if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                        continue;

                    ?>
                    <div class="sidebar-filter_block-title"><?=$arItem["NAME"]?></div>
                    <span class="bx-filter-container-modef"></span>
                    <div class="sidebar-filter_block-content" data-role="bx_filter_block">
                        <div class="filter-number">
                            <div id="slider-range"></div>
                            <div class="field-number_container">
                                <div class="wrapper_field-number">
                                    <span class="text"><?=GetMessage("CT_BCSF_FILTER_FROM")?></span>
                                    <input
                                            class="field-number"
                                            type="text"
                                            name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                            id="price-min"
                                            value="0"
                                            onkeyup="smartFilter.keyup(this)"
                                    />
                                </div>
                                <div class="wrapper_field-number wrapper_field-number_second">
                                    <span class="text">- <?=GetMessage("CT_BCSF_FILTER_TO")?></span>
                                    <input
                                            class="field-number"
                                            type="text"
                                            name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                            id="price-max"
                                            value="<?echo round($arItem["VALUES"]["MAX"]["VALUE"])?>"
                                            onkeyup="smartFilter.keyup(this)"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                <?
                $arJsParams = array(
                    "minPrice" => 0,
                    "maxPrice" => round($arItem["VALUES"]["MAX"]["VALUE"])
                );
                ?>
                    <script type="text/javascript">
                        var filterPrice = <?=CUtil::PhpToJSObject($arJsParams)?>;
                    </script>
                <?
                endif;
            }
            ?>
        </div>


        <?
        //not prices
        $sl = 2;
        foreach($arResult["ITEMS"] as $key=>$arItem)
        {
            if(
                empty($arItem["VALUES"])
                || isset($arItem["PRICE"])
            )
                continue;

            if (
                $arItem["DISPLAY_TYPE"] == "A"
                && (
                    $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                )
            )
                continue;
            ?>
            <div class="sidebar-filter_block bx-filter-parameters-box <?if ($arItem["DISPLAY_EXPANDED"] == "N"):?>is-hidden<?endif?>">
                <div class="sidebar-filter_block-title"><?=$arItem["NAME"]?></div>
                <span class="bx-filter-container-modef"></span>

                <div class="sidebar-filter_block-content">
                    <?
                    $arCur = current($arItem["VALUES"]);
                    switch ($arItem["DISPLAY_TYPE"])
                    {
                        case "A"://NUMBERS_WITH_SLIDER
                            ?>
                            <div class="filter-number">
                                <div id="slider-range_<?=$sl?>"></div>
                                <div class="field-number_container">
                                    <div class="wrapper_field-number">
                                        <span class="text"><?=GetMessage("CT_BCSF_FILTER_FROM")?></span>
                                        <input
                                                class="field-number"
                                                type="text"
                                                name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                                id="price-min_<?=$sl?>"
                                                value="<?echo $arItem["VALUES"]["MIN"]["VALUE"]?>"
                                                onkeyup="smartFilter.keyup(this)"
                                        />
                                    </div>
                                    <div class="wrapper_field-number wrapper_field-number_second">
                                        <span class="text">- <?=GetMessage("CT_BCSF_FILTER_TO")?></span>
                                        <input
                                                class="field-number"
                                                type="text"
                                                name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                                id="price-max_<?=$sl?>"
                                                value="<?echo round($arItem["VALUES"]["MAX"]["VALUE"])?>"
                                                onkeyup="smartFilter.keyup(this)"
                                        />
                                    </div>
                                </div>
<!--                                 <div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">
                                    <div class="bx-ui-slider-track" id="drag_track_<?=$key?>">
                                        <?
                                        $precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
                                        $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
                                        $value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
                                        $value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
                                        $value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
                                        $value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
                                        $value5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                                        ?>
                                        <div class="bx-ui-slider-part p1"><span><?=$value1?></span></div>
                                        <div class="bx-ui-slider-part p2"><span><?=$value2?></span></div>
                                        <div class="bx-ui-slider-part p3"><span><?=$value3?></span></div>
                                        <div class="bx-ui-slider-part p4"><span><?=$value4?></span></div>
                                        <div class="bx-ui-slider-part p5"><span><?=$value5?></span></div>

                                        <div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
                                        <div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
                                        <div class="bx-ui-slider-pricebar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
                                        <div class="bx-ui-slider-range"     id="drag_tracker_<?=$key?>"  style="left: 0;right: 0;">
                                            <a class="bx-ui-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
                                            <a class="bx-ui-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <?
                            $arJsParams = array(
                                        "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                                        "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                                        "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                        "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"]
                            );?>
                                <script type="text/javascript">
                                    var filterPrice_<?=$sl?> = <?=CUtil::PhpToJSObject($arJsParams)?>;
                                </script>
                            <?
                            $sl++;
                            break;
                        case "K"://RADIO_BUTTONS
                            ?>
                            <ul class="sidebar-filter_parameters">

                                <li>
                                    <label class="unified-radio" for="<? echo "all_".$arCur["CONTROL_ID"] ?>">
                                        <input
                                                type="radio"
                                                value=""
                                                name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
                                                id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                                                onclick="smartFilter.click(this)"
                                        />
                                        <span class="radio-text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
                                    </label>
                                </li>

                            <?foreach($arItem["VALUES"] as $val => $ar):?>
                                <li>
                                    <label class="unified-radio" for="<? echo $ar["CONTROL_ID"] ?>">
                                        <input
                                                type="radio"
                                                value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
                                                id="<? echo $ar["CONTROL_ID"] ?>"
                                            <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                onclick="smartFilter.click(this)"
                                        />
                                        <span class="radio-text"><a href="?<? echo $ar["CONTROL_NAME_ALT"] ?>=<? echo $ar["HTML_VALUE_ALT"] ?>"><?=$ar["VALUE"];?></a></span>
                                    </label>
                                </li>
                            <?endforeach;?>
                            </ul>

                            <?
                            break;
                        default://CHECKBOXES
                            ?>
                            <ul class="sidebar-filter_parameters">
                            <?foreach($arItem["VALUES"] as $val => $ar):?>
                                <li>
                                    <label class="unified-checkbox">
                                        <input
                                                type="checkbox"
                                                value="<? echo $ar["HTML_VALUE"] ?>"
                                                name="<? echo $ar["CONTROL_NAME"] ?>"
                                                id="<? echo $ar["CONTROL_ID"] ?>"
                                            <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                onclick="smartFilter.click(this)"
                                        />
                                        <span class="checkbox-text"><a href="?<? echo $ar["CONTROL_NAME"] ?>=<? echo $ar["HTML_VALUE"] ?>"><?=$ar["VALUE"];?></a></span>
                                    </label>
                                </li>
                            <?endforeach;?>
                            </ul>
                        <?
                    }
                    ?>
                </div>
            </div>
            <?
        }
        ?>

        <input
                class="main-btn filter-show_btn"
                type="submit"
                id="set_filter"
                name="set_filter"
                value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
        />
        <input
                class="filter-reset_btn"
                type="submit"
                id="del_filter"
                name="del_filter"
                value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"
        />

        <div class="bx-filter-popup-result <?if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?>>
            <?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
            <a href="<?echo $arResult["FILTER_URL"]?>" target=""><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
        </div>

    </form>

    <div class="tablet-small_hidden">
        <div class="section-title sidebar-title">Наши услуги</div>
        <?$APPLICATION->IncludeComponent("bitrix:news.line", "services.catalog", Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
            "CACHE_GROUPS" => "Y",  // Учитывать права доступа
            "CACHE_TIME" => "300",  // Время кеширования (сек.)
            "CACHE_TYPE" => "A",    // Тип кеширования
            "DETAIL_URL" => "", // URL, ведущий на страницу с содержимым элемента раздела
            "FIELD_CODE" => array(  // Поля
                0 => "PREVIEW_TEXT",
            ),
            "IBLOCKS" => array( // Код информационного блока
                0 => "5",
            ),
            "IBLOCK_TYPE" => "news",    // Тип информационного блока
            "NEWS_COUNT" => "4",    // Количество новостей на странице
            "SORT_BY1" => "ACTIVE_FROM",    // Поле для первой сортировки новостей
            "SORT_BY2" => "SORT",   // Поле для второй сортировки новостей
            "SORT_ORDER1" => "DESC",    // Направление для первой сортировки новостей
            "SORT_ORDER2" => "ASC", // Направление для второй сортировки новостей
        ),
            false
        );?>
    </div>
</aside>

<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>
