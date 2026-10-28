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
AddEventHandler('main', 'OnBeforeProlog', 'proclimateLogSoaIncoming');
function proclimateLogSoaIncoming()
{
	$uri = (string)($_SERVER['REQUEST_URI'] ?? '');
	$isSoa = (strpos($uri, '/personal/order/make') !== false)
		|| (strpos($uri, 'sale.order.ajax/ajax.php') !== false);
	if (!$isSoa)
	{
		return;
	}
	$via = (string)($_REQUEST['via_ajax'] ?? '');
	$action = (string)($_REQUEST['soa-action'] ?? $_REQUEST['action'] ?? '');
	if ($via !== 'Y' && $action === '' && strpos($uri, 'ajax.php') === false)
	{
		return;
	}
	global $USER;
	$auth = (is_object($USER) && $USER->IsAuthorized()) ? ('Y:'.$USER->GetID()) : 'N';
	$propDump = '';
	$orderData = $_REQUEST['order'] ?? null;
	$propSource = is_array($orderData) ? $orderData : $_REQUEST;
	if (is_array($propSource))
	{
		$bits = [];
		foreach ($propSource as $k => $v)
		{
			if (strpos((string)$k, 'ORDER_PROP_') !== 0)
			{
				continue;
			}
			if (is_array($v))
			{
				$bits[] = $k . '=arr:' . count($v);
			}
			else
			{
				$bits[] = $k . '=len:' . strlen(trim((string)$v));
			}
		}
		$propDump = ' props=[' . implode(',', $bits) . ']';
	}
	$line = date('c')
		. ' IN uri=' . $uri
		. ' action=' . $action
		. ' via=' . $via
		. ' auth=' . $auth
		. ' pd_consent=' . (string)($_REQUEST['pd_consent'] ?? '')
		. (is_array($orderData) && isset($orderData['pd_consent']) ? (' order.pd_consent=' . (string)$orderData['pd_consent']) : '')
		. $propDump
		. ' method=' . (string)($_SERVER['REQUEST_METHOD'] ?? '')
		. "\n";
	@file_put_contents(
		dirname(__DIR__, 2) . '/local/soa_save.log',
		$line,
		FILE_APPEND
	);
}

AddEventHandler('sale', 'OnSaleComponentOrderShowAjaxAnswer', 'proclimateLogSoaAjaxAnswer');
function proclimateLogSoaAjaxAnswer(&$result)
{
	$request = \Bitrix\Main\Context::getCurrent()->getRequest();
	$action = (string)$request->get('soa-action');
	if ($action === '')
	{
		$action = (string)$request->get('action');
	}
	if ($action !== 'saveOrderAjax')
	{
		return;
	}

	$line = date('c')
		. ' OUT pd_consent=' . (string)$request->get('pd_consent')
		. ' has_order=' . (isset($result['order']) ? 'Y' : 'N')
		. ' redirect=' . (isset($result['order']['REDIRECT_URL']) ? (string)$result['order']['REDIRECT_URL'] : '')
		. ' error=' . (isset($result['order']['ERROR']) ? json_encode($result['order']['ERROR'], JSON_UNESCAPED_UNICODE) : '')
		. "\n";
	@file_put_contents(
		dirname(__DIR__, 2) . '/local/soa_save.log',
		$line,
		FILE_APPEND
	);
}

function proclimateSoaLog($msg)
{
	@file_put_contents(
		dirname(__DIR__, 2) . '/local/soa_save.log',
		date('c') . ' ' . $msg . "\n",
		FILE_APPEND
	);
}

AddEventHandler('main', 'OnBeforeProlog', 'proclimateSoaSaveShutdownHook');
function proclimateSoaSaveShutdownHook()
{
	$uri = (string)($_SERVER['REQUEST_URI'] ?? '');
	$action = (string)($_REQUEST['soa-action'] ?? $_REQUEST['action'] ?? '');
	if ($action !== 'saveOrderAjax' && strpos($uri, 'sale.order.ajax/ajax.php') === false)
	{
		return;
	}
	if ($action !== 'saveOrderAjax')
	{
		return;
	}
	register_shutdown_function(static function () {
		$err = error_get_last();
		$msg = 'SHUTDOWN';
		if (is_array($err))
		{
			$msg .= ' type=' . $err['type'] . ' msg=' . $err['message'] . ' file=' . $err['file'] . ':' . $err['line'];
		}
		else
		{
			$msg .= ' ok';
		}
		proclimateSoaLog($msg);
	});
}

AddEventHandler('sale', 'OnSaleOrderBeforeSaved', static function (\Bitrix\Main\Event $event) {
	proclimateSoaLog('EVT OnSaleOrderBeforeSaved');
});
AddEventHandler('sale', 'OnSaleOrderSaved', static function (\Bitrix\Main\Event $event) {
	/** @var \Bitrix\Sale\Order $order */
	$order = $event->getParameter('ENTITY');
	$id = is_object($order) ? (string)$order->getId() : '';
	proclimateSoaLog('EVT OnSaleOrderSaved id=' . $id);
});
AddEventHandler('sale', 'OnSaleComponentOrderCreated', static function (&$order, &$arUserResult, $request, &$arParams, &$arResult) {
	$action = is_object($request) ? (string)$request->get('soa-action') : '';
	if ($action === '')
	{
		$action = is_object($request) ? (string)$request->get('action') : '';
	}
	if ($action === 'saveOrderAjax')
	{
		$errCnt = (isset($arResult['ERROR']) && is_array($arResult['ERROR'])) ? count($arResult['ERROR']) : 0;
		proclimateSoaLog('EVT OnSaleComponentOrderCreated errors=' . $errCnt);
	}
});

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
