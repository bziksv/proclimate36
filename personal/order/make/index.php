<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?>    <main class="main-content">
        <div class="cart-section">
            <div class="container">

                <h1>Оформление заказа</h1>

                <?$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", "sale.order.ajax", Array(
                "ACTION_VARIABLE" => "soa-action",	// Название переменной, в которой передается действие
                "ADDITIONAL_PICT_PROP_2" => "-",	// Дополнительная картинка [Каталог]
                "ALLOW_APPEND_ORDER" => "Y",	// Разрешить оформлять заказ на существующего пользователя
                "ALLOW_AUTO_REGISTER" => "Y",	// Оформлять заказ с автоматической регистрацией пользователя
                "ALLOW_NEW_PROFILE" => "N",	// Разрешить множество профилей покупателей
                "ALLOW_USER_PROFILES" => "N",	// Разрешить использование профилей покупателей
                "BASKET_IMAGES_SCALING" => "adaptive",	// Режим отображения изображений товаров
                "BASKET_POSITION" => "after",	// Расположение списка товаров
                "COMPATIBLE_MODE" => "Y",	// Режим совместимости для предыдущего шаблона
                "DELIVERIES_PER_PAGE" => "9",	// Количество доставок на странице
                "DELIVERY_FADE_EXTRA_SERVICES" => "N",	// Дополнительные услуги, которые будут показаны в пройденном (свернутом) блоке
                "DELIVERY_NO_AJAX" => "N",	// Когда рассчитывать доставки с внешними системами расчета
                "DELIVERY_NO_SESSION" => "Y",	// Проверять сессию при оформлении заказа
                "DELIVERY_TO_PAYSYSTEM" => "d2p",	// Последовательность оформления
                "DISABLE_BASKET_REDIRECT" => "N",	// Оставаться на странице оформления заказа, если список товаров пуст
                "EMPTY_BASKET_HINT_PATH" => "/",	// Путь к странице для продолжения покупок
                "HIDE_ORDER_DESCRIPTION" => "N",	// Скрыть поле комментариев к заказу
                "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",	// Разрешить оплату с внутреннего счета только в полном объеме
                "PATH_TO_AUTH" => "/auth/",	// Путь к странице авторизации
                "PATH_TO_BASKET" => "/personal/cart/",	// Путь к странице корзины
                "PATH_TO_PAYMENT" => "/personal/order/payment/",	// Страница подключения платежной системы
                "PATH_TO_PERSONAL" => "/personal/",	// Путь к странице персонального раздела
                "PAY_FROM_ACCOUNT" => "N",	// Разрешить оплату с внутреннего счета
                "PAY_SYSTEMS_PER_PAGE" => "9",	// Количество платежных систем на странице
                "PICKUPS_PER_PAGE" => "5",	// Количество пунктов самовывоза на странице
                "PICKUP_MAP_TYPE" => "yandex",	// Тип используемых карт
                "PRODUCT_COLUMNS_HIDDEN" => "",	// Свойства товаров отображаемые в свернутом виде в списке товаров
                "PRODUCT_COLUMNS_VISIBLE" => array(	// Выбранные колонки таблицы списка товаров
                    0 => "PREVIEW_PICTURE",
                    1 => "PROPS",
                ),
                "PROPS_FADE_LIST_1" => "",	// Свойства заказа, которые будут показаны в пройденном (свернутом) блоке (Физическое лицо)[s1]
                "PROPS_FADE_LIST_2" => "",	// Свойства заказа, которые будут показаны в пройденном (свернутом) блоке (Юридическое лицо)[s1]
                "SEND_NEW_USER_NOTIFY" => "N",	// Отправлять пользователю письмо, что он зарегистрирован на сайте
                "SERVICES_IMAGES_SCALING" => "adaptive",	// Режим отображения вспомагательных изображений
                "SET_TITLE" => "Y",	// Устанавливать заголовок страницы
                "SHOW_BASKET_HEADERS" => "N",	// Показывать заголовки колонок списка товаров
                "SHOW_COUPONS" => "Y",	// Отображать поля ввода купонов
                "SHOW_COUPONS_BASKET" => "Y",	// Показывать поле ввода купонов в блоке списка товаров
                "SHOW_COUPONS_DELIVERY" => "Y",	// Показывать поле ввода купонов в блоке доставки
                "SHOW_COUPONS_PAY_SYSTEM" => "Y",	// Показывать поле ввода купонов в блоке оплаты
                "SHOW_DELIVERY_INFO_NAME" => "Y",	// Отображать название в блоке информации по доставке
                "SHOW_DELIVERY_LIST_NAMES" => "Y",	// Отображать названия в списке доставок
                "SHOW_DELIVERY_PARENT_NAMES" => "Y",	// Показывать название родительской доставки
                "SHOW_MAP_IN_PROPS" => "N",	// Показывать карту в блоке свойств заказа
                "SHOW_NEAREST_PICKUP" => "N",	// Показывать ближайшие пункты самовывоза
                "SHOW_NOT_CALCULATED_DELIVERIES" => "L",	// Отображение доставок с ошибками расчета
                "SHOW_ORDER_BUTTON" => "final_step",	// Отображать кнопку оформления заказа (для неавторизованных пользователей)
                "SHOW_PAY_SYSTEM_INFO_NAME" => "Y",	// Отображать название в блоке информации по платежной системе
                "SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",	// Отображать названия в списке платежных систем
                "SHOW_PICKUP_MAP" => "Y",	// Показывать карту для доставок с самовывозом
                "SHOW_STORES_IMAGES" => "Y",	// Показывать изображения складов в окне выбора пункта выдачи
                "SHOW_TOTAL_ORDER_BUTTON" => "N",	// Отображать дополнительную кнопку оформления заказа
                "SHOW_VAT_PRICE" => "N",	// Отображать значение НДС
                "SKIP_USELESS_BLOCK" => "Y",	// Пропускать шаги, в которых один элемент для выбора
                "SPOT_LOCATION_BY_GEOIP" => "Y",	// Определять местоположение покупателя по IP-адресу
                "TEMPLATE_LOCATION" => "popup",	// Визуальный вид контрола выбора местоположений
                "TEMPLATE_THEME" => "blue",	// Цветовая тема
                "USER_CONSENT" => "N",	// Запрашивать согласие
                "USER_CONSENT_ID" => "0",	// Соглашение
                "USER_CONSENT_IS_CHECKED" => "Y",	// Галка по умолчанию проставлена
                "USER_CONSENT_IS_LOADED" => "N",	// Загружать текст сразу
                "USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",	// Заменить стандартные фразы на свои
                "USE_CUSTOM_ERROR_MESSAGES" => "N",	// Заменить стандартные фразы на свои
                "USE_CUSTOM_MAIN_MESSAGES" => "N",	// Заменить стандартные фразы на свои
                "USE_ENHANCED_ECOMMERCE" => "N",	// Отправлять данные электронной торговли в Google и Яндекс
                "USE_PHONE_NORMALIZATION" => "Y",	// Использовать нормализацию номера телефона
                "USE_PRELOAD" => "Y",	// Автозаполнение оплаты и доставки по предыдущему заказу
                "USE_PREPAYMENT" => "N",	// Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
                "USE_YM_GOALS" => "N",	// Использовать цели счетчика Яндекс.Метрики
                "COMPONENT_TEMPLATE" => ".default"
            ),
            false
        );?>
            </div>
        </div>
    </main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>