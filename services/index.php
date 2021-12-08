<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Услуги");
?>
<main class="main-content">
    <?$APPLICATION->IncludeComponent("bitrix:news", "services", Array(
	"IBLOCK_TYPE" => "news",	// Тип инфоблока
		"IBLOCK_ID" => "5",	// Инфоблок
		"TEMPLATE_THEME" => "site",
		"NEWS_COUNT" => "15",	// Количество новостей на странице
		"USE_SEARCH" => "N",	// Разрешить поиск
		"USE_RSS" => "N",	// Разрешить RSS
		"NUM_NEWS" => "20",
		"NUM_DAYS" => "180",
		"YANDEX" => "N",
		"USE_RATING" => "N",	// Разрешить голосование
		"USE_CATEGORIES" => "N",	// Выводить материалы по теме
		"USE_REVIEW" => "N",	// Разрешить отзывы
		"USE_FILTER" => "N",	// Показывать фильтр
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
		"SEF_FOLDER" => "/services/",	// Каталог ЧПУ (относительно корня сайта)
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"DISPLAY_PANEL" => "Y",
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SET_STATUS_404" => "Y",	// Устанавливать статус 404
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"ADD_ELEMENT_CHAIN" => "Y",	// Включать название элемента в цепочку навигации
		"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"LIST_FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(	// Свойства
			0 => "PRICE",
			1 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"DETAIL_FIELD_CODE" => array(	// Поля
			0 => "SHOW_COUNTER",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(	// Свойства
			0 => "PRICE",
			1 => "STANDART",
			2 => "WORK",
			3 => "MATERIALS",
			4 => "INFO",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DETAIL_PAGER_TITLE" => "Страница",	// Название категорий
		"DETAIL_PAGER_TEMPLATE" => "arrows",	// Название шаблона
		"DETAIL_PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"DISPLAY_DATE" => "Y",	// Выводить дату элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"SLIDER_PROPERTY" => "PICS_NEWS",
		"COMPONENT_TEMPLATE" => "services",
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела
		"USE_SHARE" => "N",	// Отображать панель соц. закладок
		"DETAIL_SET_CANONICAL_URL" => "N",	// Устанавливать канонический URL
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"SHOW_404" => "N",	// Показ специальной страницы
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?>
</main>
<!-- end main-content -->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
