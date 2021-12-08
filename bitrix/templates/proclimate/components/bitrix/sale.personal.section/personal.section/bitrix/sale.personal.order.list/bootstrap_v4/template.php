<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/bootstrap_v4/script.js");
Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/bootstrap_v4/style.css");
CJSCore::Init(array('clipboard', 'fx'));

Loc::loadMessages(__FILE__);

if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach($arResult['ERRORS']['FATAL'] as $code => $error)
	{
		if ($code !== $component::E_NOT_AUTHORIZED)
			ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		?>
		<div class="row">
			<div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
				<div class="alert alert-danger"><?=$arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]?></div>
			</div>
			<? $authListGetParams = array(); ?>
			<div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
				<?$APPLICATION->AuthForm('', false, false, 'N', false);?>
			</div>
		</div>
		<?
	}

}
else
{
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	if (!count($arResult['ORDERS']))
	{
		if ($_REQUEST["filter_history"] == 'Y')
		{
			if ($_REQUEST["show_canceled"] == 'Y')
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER')?></h3>
				<?
			}
			else
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST')?></h3>
				<?
			}
		}
		else
		{
			?>
			<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?></h3>
			<?
		}
	}
	?>

    <table class="current-orders_table">
        <tr>
            <th>Товар</th>
            <th>Дата заказа</th>
            <th>Статус</th>
            <th>Сумма</th>
            <th></th>
        </tr>
        <?foreach ($arResult['ORDERS'] as $key => $order): ?>
        <tr>
            <td>
                <div class="current-order_img-title">
                    <div class="current-order_img">
                        <span class="personal-area_menu-icon glipf-note"></span>
                    </div>
                    <span class="current-order_title">
                        <?=Loc::getMessage('SPOL_TPL_ORDER')?>
                        <?=Loc::getMessage('SPOL_TPL_NUMBER_SIGN').$order['ORDER']['ACCOUNT_NUMBER']?>,
                        <?=count($order['BASKET_ITEMS']);?>
                        <?
                        $count = count($order['BASKET_ITEMS']) % 10;
                        if ($count == '1')
                        {
                            echo Loc::getMessage('SPOL_TPL_GOOD');
                        }
                        elseif ($count >= '2' && $count <= '4')
                        {
                            echo Loc::getMessage('SPOL_TPL_TWO_GOODS');
                        }
                        else
                        {
                            echo Loc::getMessage('SPOL_TPL_GOODS');
                        }
                        ?>
                        <ul class="list-unstyled" style="font-size: 12px;">
                            <? foreach ($order['BASKET_ITEMS'] as $product): ?>
                            <li><a href="<?=$product['DETAIL_PAGE_URL']?>" class="small" target="_blank"><?=$product['NAME']?></a> (<?=$product['QUANTITY']?>)</li>
                            <? endforeach; ?>
                        </ul>
                    </span>
                </div>
            </td>
            <td><?=$order['ORDER']['DATE_INSERT']->format($arParams['ACTIVE_DATE_FORMAT'])?></td>
            <td>
                <?
                if ($order['ORDER']['PAYED'] === 'Y')
                {
                    echo Loc::getMessage('SPOL_TPL_PAID');
                }else
                {
                    echo Loc::getMessage('SPOL_TPL_NOTPAID');
                }
                ?>
            </td>
            <td><?=$order['ORDER']['FORMATED_PRICE']?></td>
            <td>
                <a class="main-btn current-order_btn" href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_COPY"])?>"><?=Loc::getMessage('SPOL_TPL_REPEAT_ORDER')?></a>
            </td>
        </tr>
        <? endforeach;?>
    </table>
    <?
	echo $arResult["NAV_STRING"];
}
?>
