<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Наши работы по установке кондиционеров");
$APPLICATION->SetPageProperty("description", "Установка кондиционеров по выгодной цене в Воронеже");
$APPLICATION->SetTitle("Наши работы");

$currentLen = $_REQUEST['len'];
$arLen = [15, 30, 45];
$IBLOCK = 6;
$res = CIBlock::GetByID($IBLOCK);
if($ar_res = $res->GetNext())
    $arBlock = $ar_res;
?>

    <main class="main-content">
        <div class="works-section">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="">Главная</a></li>
                    <li>Наши работы</li>
                </ul>
                <h1>Наши работы</h1>
                <div class="unified-sorter-pahel">
                    <div class="unified_show-by_box">
                        <span class="text">Показывать по:</span>
                        <form action="" onchange="this.submit()">
                            <select class="js-select" name="len">
                                <? foreach ($arLen as $len):?>
                                    <option value="<?=$len?>" <?=($len == $currentLen) ? 'selected' : null; ?>><?=$len?></option>
                                <? endforeach; ?>
                            </select>
                        </form>
                    </div>
                </div>

                <?$APPLICATION->IncludeComponent("bitrix:news.line", "works", Array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
                    "CACHE_GROUPS" => "Y",	// Учитывать права доступа
                    "CACHE_TIME" => "300",	// Время кеширования (сек.)
                    "CACHE_TYPE" => "A",	// Тип кеширования
                    "DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
                    "FIELD_CODE" => array(	// Поля
                        0 => "PREVIEW_TEXT",
                        1 => "PREVIEW_PICTURE",
                        2 => "DETAIL_PICTURE",
                    ),
                    "IBLOCKS" => array(	// Код информационного блока
                        0 => $IBLOCK,
                    ),
                    "IBLOCK_TYPE" => "news",	// Тип информационного блока
                    "NEWS_COUNT" => ($currentLen) ?: "15",	// Количество новостей на странице
                    "SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
                    "SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
                    "SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
                    "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
                ),
                    false
                );?>
					<div class="text-section">
                    <?=$arBlock['DESCRIPTION'];?>
                </div>

            </div>
        </div>
        <!-- end works-section -->
    </main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
