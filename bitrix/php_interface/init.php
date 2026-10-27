<?php
if (defined('ADMIN_SECTION') && ADMIN_SECTION === true) {
    $asset = \Bitrix\Main\Page\Asset::getInstance();
    $asset->addJs('https://code.jquery.com/jquery-2.2.4.min.js');
    $asset->addJs('/local/js/admin/custom.js');
}

AddEventHandler("sale", "OnOrderNewSendEmail", "bxModifySaleMails");
function bxModifySaleMails($orderID, &$eventName, &$arFields)
{
  $arOrder = CSaleOrder::GetByID($orderID); 
  $order_props = CSaleOrderPropsValue::GetOrderProps($orderID);
  
  while ($arProps = $order_props->Fetch())
  {
    if ($arProps["CODE"] == "PHONE")
       $arFields["PHONE"] = htmlspecialchars($arProps["VALUE"]);
  }
}

/**
 * Юридически обязательная серверная проверка согласия на обработку ПДн
 * при сохранении заказа через sale.order.ajax (нельзя обойти снятием галочки в JS).
 *
 * saveOrderAjax идёт через BX.ajax.submitAjax — поля формы приходят плоско
 * (pd_consent=Y), а не внутри order[...]. refreshOrderAjax кладёт их в order.
 */
AddEventHandler('sale', 'OnSaleComponentOrderCreated', 'proclimateRequirePdConsent');
function proclimateRequirePdConsent(&$order, &$arUserResult, $request, &$arParams, &$arResult, &$arDeliveryServiceAll = null, &$arPaySystemServiceAll = null)
{
	if (!is_object($request))
	{
		return;
	}

	$action = (string)$request->get('soa-action');
	if ($action === '')
	{
		$action = (string)$request->get('action');
	}
	if ($action !== 'saveOrderAjax')
	{
		return;
	}

	$consent = (string)$request->get('pd_consent');
	if ($consent === '')
	{
		$orderData = $request->get('order');
		if (is_array($orderData) && isset($orderData['pd_consent']))
		{
			$consent = (string)$orderData['pd_consent'];
		}
	}

	if ($consent !== 'Y')
	{
		$msg = 'Необходимо согласие на обработку персональных данных';
		if (!isset($arResult['ERROR']) || !is_array($arResult['ERROR']))
		{
			$arResult['ERROR'] = [];
		}
		$arResult['ERROR'][] = $msg;

		if (!isset($arResult['ERROR_SORTED']) || !is_array($arResult['ERROR_SORTED']))
		{
			$arResult['ERROR_SORTED'] = [];
		}
		if (!isset($arResult['ERROR_SORTED']['MAIN']) || !is_array($arResult['ERROR_SORTED']['MAIN']))
		{
			$arResult['ERROR_SORTED']['MAIN'] = [];
		}
		$arResult['ERROR_SORTED']['MAIN'][] = $msg;
	}
}
