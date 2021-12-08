<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $arResult
 * @var SaleOrderAjax $component
 */

$component = $this->__component;

if($_SESSION['CATALOG_SERVICE'])
    $arResult['JS_DATA']['ORDER_DESCRIPTION'] = 'Выбранная услуга: '.$_SESSION['CATALOG_SERVICE'];

$component::scaleImages($arResult['JS_DATA'], $arParams['SERVICES_IMAGES_SCALING']);
