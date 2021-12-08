<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">

    <?
    if ($arParams['HIDE_COUPON'] !== 'Y')
    {
        ?>

        <div class="col-md-6">
            <span class="coupon-text"><?=Loc::getMessage('SBB_COUPON_ENTER')?>:</span>
            <form action="#" class="coupon-form">
                <input type="text" class="coupon-form_input" id="" placeholder="" data-entity="basket-coupon-input">
                <input type="button" class="main-btn coupon-form_submit-btn" value="Применить" onclick="return false;">
            </form>
        </div>

        <?
    }
    ?>

    <div class="col-md-6 right-column">

        <div class="cart_totat-price">
            <span class="text">Итого:</span>
            <span class="cart-total_sum" data-entity="basket-total-price">{{{PRICE_FORMATED}}}</span>
        </div>

        <button class="main-btn checkout-btn{{#DISABLE_CHECKOUT}} disabled{{/DISABLE_CHECKOUT}}"
                data-entity="basket-checkout-button">
            <?=Loc::getMessage('SBB_ORDER')?>
        </button>
    </div>

    <?
    if ($arParams['HIDE_COUPON'] !== 'Y')
    {
        ?>
        <div class="col-md-12 basket-coupon-alert-section">
            <div class="basket-coupon-alert-inner">
                {{#COUPON_LIST}}
                <div class="basket-coupon-alert text-{{CLASS}}">
						<span class="basket-coupon-text">
							<strong>{{COUPON}}</strong> - <?=Loc::getMessage('SBB_COUPON')?> {{JS_CHECK_CODE}}
							{{#DISCOUNT_NAME}}({{DISCOUNT_NAME}}){{/DISCOUNT_NAME}}
						</span>
                    <span class="close-link" data-entity="basket-coupon-delete" data-coupon="{{COUPON}}">
							<?=Loc::getMessage('SBB_DELETE')?>
                    </span>
                </div>
                {{/COUPON_LIST}}
            </div>
        </div>
        <?
    }
    ?>

</script>
