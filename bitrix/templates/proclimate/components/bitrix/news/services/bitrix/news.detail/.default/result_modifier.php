<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$full = (string)($arResult["~DETAIL_TEXT"] ?? "");
$more = "";
$lead = $full;

if (preg_match('~<div\s+class="services-detailed_more">(.*)</div>\s*$~is', $full, $m)) {
	$more = trim($m[1]);
	$lead = trim(preg_replace('~<div\s+class="services-detailed_more">.*</div>\s*$~is', "", $full));
}

$intro = "";
$bullets = "";
if (preg_match('~<p\b[^>]*>.*?</p>~is', $lead, $pm)) {
	$intro = $pm[0];
}
if (preg_match('~<ul\b[^>]*class="[^"]*services-detailed_list[^"]*"[^>]*>.*?</ul>~is', $lead, $um)) {
	$bullets = $um[0];
}
if ($intro === "" && $bullets === "") {
	$intro = $lead;
}

$arResult["SVC_LEAD"] = $lead;
$arResult["SVC_INTRO"] = $intro;
$arResult["SVC_BULLETS"] = $bullets;
$arResult["SVC_MORE"] = $more;
$arResult["SVC_HAS_MORE"] = ($more !== "");

$code = (string)($arResult["CODE"] ?? "");
$price = trim((string)($arResult["PROPERTIES"]["PRICE"]["VALUE"] ?? ""));
$icon = trim((string)($arResult["PROPERTIES"]["MAIN_ICON"]["VALUE"] ?? "glipf-conditioner"));

$isInstall = (strpos($code, "ustanovka") !== false);
$isRepair = (strpos($code, "remont") !== false || strpos($code, "tekhnicheskoe") !== false);

if ($isInstall) {
	$arResult["SVC_CHIPS"] = array(
		array("icon" => "glipf-file-2", "text" => "Гарантия 12 месяцев"),
		array("icon" => "glipf-delivery", "text" => "Монтаж от 1,5 часов"),
		array("icon" => "glipf-air", "text" => $price !== "" ? $price : "Фиксированный прайс"),
		array("icon" => "glipf-placeholder", "text" => "Воронеж и область"),
	);
	$arResult["SVC_EYEBROW"] = "Монтаж под ключ";
	$arResult["SVC_CTA"] = "Заказать монтаж";
} elseif ($isRepair) {
	$arResult["SVC_CHIPS"] = array(
		array("icon" => "glipf-tools", "text" => "Ремонт и диагностика"),
		array("icon" => "glipf-cold", "text" => "Чистка и заправка"),
		array("icon" => "glipf-air", "text" => $price !== "" ? $price : "Выезд мастера"),
		array("icon" => "glipf-placeholder", "text" => "Воронеж и область"),
	);
	$arResult["SVC_EYEBROW"] = "Сервис и ремонт";
	$arResult["SVC_CTA"] = "Вызвать мастера";
} else {
	$arResult["SVC_CHIPS"] = array(
		array("icon" => $icon, "text" => $price !== "" ? $price : "Профессиональный сервис"),
		array("icon" => "glipf-placeholder", "text" => "Воронеж"),
	);
	$arResult["SVC_EYEBROW"] = "Услуги ProClimate";
	$arResult["SVC_CTA"] = "Заказать услугу";
}

$arResult["SVC_PRICE"] = $price;
$arResult["SVC_ICON"] = $icon;
