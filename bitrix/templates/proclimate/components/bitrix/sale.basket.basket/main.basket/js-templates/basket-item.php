<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */
?>
<script id="basket-item-template" type="text/html">

	<tr id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">

		{{^SHOW_RESTORE}}


            <td>
                <div class="cart-item_img-title">
                    <div class="cart-item_img">
                        <img src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?=$templateFolder?>/images/no_photo.png{{/IMAGE_URL}}" alt="{{NAME}}">
                    </div>
                    <span class="cart-item_title">
                        <a href="{{DETAIL_PAGE_URL}}">{{NAME}}</a>
                    </span>
                </div>
            </td>

            <?
            if (!empty($arParams['PRODUCT_BLOCKS_ORDER']))
            {
                foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName)
                {
                    switch (trim((string)$blockName))
                    {
                        case 'columns':
                            ?>
                            {{#COLUMN_LIST}}
                                {{#IS_TEXT}}
                                <td>
                                    <span class="cart-table_mobile-text">{{NAME}}</span>
                                    {{VALUE}}
                                </td>
                                {{/IS_TEXT}}
                            {{/COLUMN_LIST}}
                            <?
                            break;
                    }
                }
            }
            ?>

            <td>
                <span class="cart-item_price" id="basket-item-price-{{ID}}">{{{PRICE_FORMATED}}}</span>
            </td>

            <td>
                <div class="wrapper-counter-btn" data-entity="basket-item-quantity-block">
                    <button class="counter-back" data-entity="basket-item-quantity-minus"></button>
                    <input type="text" value="{{QUANTITY}}" class="product-count" {{#NOT_AVAILABLE}} disabled="disabled"{{/NOT_AVAILABLE}}
                    data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
                    id="basket-item-quantity-{{ID}}">
                    <button class="counter-forward" data-entity="basket-item-quantity-plus"></button>
                </div>
            </td>

            <td>
                <span class="cart-item_price" id="basket-item-sum-price-{{ID}}">{{{SUM_PRICE_FORMATED}}}</span>
            </td>

            <td>
                <div class="cart-item_delete">
                    <span class="glipf-delete" data-entity="basket-item-delete"></span>
                </div>
            </td>

		{{/SHOW_RESTORE}}
	</tr>
</script>
