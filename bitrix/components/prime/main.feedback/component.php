<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

$arResult["PARAMS_HASH"] = md5(serialize($arParams).$this->GetTemplateName());

$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !(is_object($USER) && $USER->IsAuthorized())) ? "Y" : "N");
$arParams["EVENT_NAME"] = trim((string)$arParams["EVENT_NAME"]);
if($arParams["EVENT_NAME"] == '')
	$arParams["EVENT_NAME"] = "FEEDBACK_FORM";

$arParams["EMAIL_TO"] = trim((string)$arParams["EMAIL_TO"]);
if($arParams["EMAIL_TO"] == '')
{
	$arParams["EMAIL_TO"] = COption::GetOptionString("sale", "order_email", "");
	if($arParams["EMAIL_TO"] == '')
		$arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from", "");
	if($arParams["EMAIL_TO"] == '')
		$arParams["EMAIL_TO"] = "info@proclimate36.ru";
}

$arParams["OK_TEXT"] = trim((string)$arParams["OK_TEXT"]);
if($arParams["OK_TEXT"] == '')
	$arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");

$arPropertyField = array();
foreach($arParams['PROPERTY_CODE'] as $code){
	$rsProp = CIBlockProperty::GetList(array(), array("ACTIVE"=>"Y", "IBLOCK_ID" => $arParams['IBLOCK_ID'],"CODE" => $code));
	if($arr = $rsProp->Fetch())
	{ $arPropertyField[] = $arr; }
}

/**
 * Reject scanner payloads that previously flooded mail (SQLi/XSS/RCE probes).
 */
$isSuspiciousPayload = function ($value)
{
	$value = (string)$value;
	if ($value === '')
		return false;
	if (preg_match('/(nslookup|bxss\.me|sleep\s*\(|xor\s*\(|\becho\s+|\$\(|\`|curl\s+|wget\s+|\/etc\/passwd|union\s+select|<\s*script)/i', $value))
		return true;
	if (strlen($value) > 300)
		return true;
	return false;
};

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] <> '' && (!isset($_POST["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"]))
{
	$arResult["ERROR_MESSAGE"] = array();
	if(check_bitrix_sessid())
	{
		// Honeypot: real users leave empty; bots often fill hidden fields.
		if (trim((string)($_POST["fax"] ?? '')) !== '')
		{
			LocalRedirect($APPLICATION->GetCurPageParam("success=".$arResult["PARAMS_HASH"], Array("success")));
		}

		$remoteAddr = (string)($_SERVER["REMOTE_ADDR"] ?? "unknown");
		$rateKey = "PRIME_FB_RATE_".md5($remoteAddr);
		$rateNow = time();
		if (!isset($_SESSION[$rateKey]) || !is_array($_SESSION[$rateKey]) || ($rateNow - (int)$_SESSION[$rateKey]["t"]) > 600)
			$_SESSION[$rateKey] = array("t" => $rateNow, "n" => 0);
		if ((int)$_SESSION[$rateKey]["n"] >= 5)
			$arResult["ERROR_MESSAGE"][] = GetMessage("MF_RATE_LIMIT");

		foreach($arPropertyField as $field){
			if($field['IS_REQUIRED'] == "Y"){
				if(strlen((string)($_POST[$field['CODE']] ?? '')) < 1)
					$arResult["ERROR_MESSAGE"][] = GetMessage("FIELD_ERROR").': '.$field['NAME'];
			}
			$raw = (string)($_POST[$field['CODE']] ?? '');
			if ($isSuspiciousPayload($raw))
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_SPAM_REJECT");
		}

		if($arParams["USE_CAPTCHA"] == "Y")
		{
			$captcha_code = (string)($_POST["captcha_sid"] ?? '');
			$captcha_word = (string)($_POST["captcha_word"] ?? '');
			$cpt = new CCaptcha();
			$captchaPass = COption::GetOptionString("main", "captcha_password", "");
			if ($captcha_word !== '' && $captcha_code !== '')
			{
				if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
					$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTCHA_WRONG");
			}
			else
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTHCA_EMPTY");
		}

		if(empty($arResult["ERROR_MESSAGE"])){
			$el = new CIBlockElement;
			$PROP = array();
			foreach($arPropertyField as $field) {
				if($field['PROPERTY_TYPE'] == "S"){
                    $PROP[$field['CODE']] = trim(strip_tags((string)$_POST[$field['CODE']]));
				}elseif($field['PROPERTY_TYPE'] == "L"){
					$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "CODE"=> $field["CODE"]));
					if($enum_fields = $property_enums->GetNext())
					{
						$PROP[$field['CODE']] = Array("VALUE" => $enum_fields['ID']);
					}
				}elseif($field['PROPERTY_TYPE'] == "F"){
					$file = $_FILES['FILE'];
					$fid = CFile::SaveFile($file, "vote");
					$PROP[$field['CODE']] = Array("VALUE" => $fid);
				}
			}

			$arLoadProductArray = Array(
				"IBLOCK_SECTION_ID" => false,
				"IBLOCK_ID"      => $arParams['IBLOCK_ID'],
				"PROPERTY_VALUES"=> $PROP,
				"NAME"           => trim(strip_tags((string)$_POST[$arPropertyField[0]['CODE']])),
				"PREVIEW_TEXT" => (trim(strip_tags((string)($_POST['PREVIEW_TEXT'] ?? '')))) ?: null,
				"ACTIVE"         => "Y"
			);
			$PRODUCT_ID = $el->Add($arLoadProductArray);
		}


		if(empty($arResult["ERROR_MESSAGE"]))
		{
			$arFields = Array();

			if(isset($arParams['ROI_VISIT']) && $arParams['ROI_VISIT'])
			    $arFields['ROI_VISIT'] = $arParams['ROI_VISIT'];

            foreach($arPropertyField as $field){
                $arFields[$field['CODE']] = trim(strip_tags((string)$_POST[$field['CODE']]));
            }

            if(!empty($arLoadProductArray['PREVIEW_TEXT']))
                $arFields['PREVIEW_TEXT'] = $arLoadProductArray['PREVIEW_TEXT'];

            if(!empty($arLoadProductArray['PROPERTY_VALUES']['FILE']))
                $arFields['FILE'] = CFile::GetPath($arLoadProductArray['PROPERTY_VALUES']['FILE']['VALUE']);

			// Always notify site owner — never send to attacker-controlled #EMAIL#.
			if (!empty($arFields["EMAIL"]))
				$arFields["AUTHOR_EMAIL"] = $arFields["EMAIL"];
			$arFields["EMAIL"] = $arParams["EMAIL_TO"];
			$arFields["EMAIL_TO"] = $arParams["EMAIL_TO"];
            
			if(!empty($arParams["EVENT_MESSAGE_ID"]))
			{
				foreach($arParams["EVENT_MESSAGE_ID"] as $v)
					if(IntVal($v) > 0)
						CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", IntVal($v));
			}
			else
			CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields);

			$_SESSION[$rateKey]["n"] = (int)$_SESSION[$rateKey]["n"] + 1;

			LocalRedirect($APPLICATION->GetCurPageParam("success=".$arResult["PARAMS_HASH"], Array("success")));
		}

		foreach($arPropertyField as $field){
			$arResult[$field['CODE']] = htmlspecialcharsbx(trim(strip_tags((string)($_POST[$field['CODE']] ?? ''))));
		}
	}
	else
		$arResult["ERROR_MESSAGE"][] = GetMessage("MF_SESS_EXP");
}
elseif((string)($_REQUEST["success"] ?? '') == $arResult["PARAMS_HASH"])
{
	$arResult["OK_MESSAGE"] = $arParams["OK_TEXT"];
}
$arResult['USER_FIELD'] = $arPropertyField;

if($arParams["USE_CAPTCHA"] == "Y")
	$arResult["capCode"] = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());

$this->IncludeComponentTemplate();
