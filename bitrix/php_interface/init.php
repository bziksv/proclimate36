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