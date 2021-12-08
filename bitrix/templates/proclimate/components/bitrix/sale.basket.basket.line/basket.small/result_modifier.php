<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if($arParams['SERVICE_IBLOCK_ID']){
	$arSelect = Array("ID", "NAME", "PREVIEW_TEXT", "DATE_ACTIVE_FROM");
	$arFilter = Array("IBLOCK_ID" => $arParams['SERVICE_IBLOCK_ID'], "ACTIVE" => "Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		$arResult['SERVICE'][] = $arFields;
	}
}
