<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<a href="/personal/cart/">
    <span class="glipf-cart"></span>
    <span class="head-cart_number"><?=$arResult['NUM_PRODUCTS']?></span>
</a>
<? if($arResult['CATEGORIES']['READY']): ?>
    <div class="head-cart_dropdown">
        <div class="head-cart_dropdown-content">

            <div class="wrapper_head-cart_product">
                <? foreach($arResult['CATEGORIES']['READY'] as $arItems): ?>
                    <div class="head-cart_product-item">
                        <div class="head-cart_product-img">
                            <img data-src="<?=$arItems['PICTURE_SRC']?>" alt="<?=$arItems['NAME']?>">
                        </div>
                        <div class="head-cart_product-desc">
                        <span class="head-cart_product-title">
                            <?=$arItems['NAME']?> (<?=$arItems['QUANTITY']?>)
                        </span>
                            <span class="head-cart_product-price"><?=$arItems['SUM']?></span>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>

            <? if($arResult['SERVICE']):?>
            <div class="head-cart_services-box">
                <div class="head-cart_services-header">Выберите услугу</div>
                <ul class="head-cart_services-list">
                    <? foreach ($arResult['SERVICE'] as $service):?>
                    <li>
                        <label class="unified-radio unified-radio_mod">
                            <input value="<?=$service['NAME']?>" type="radio" class="catalog_service" name="service_cart" <?=($_SESSION['CATALOG_SERVICE'] == $service['NAME']) ? 'checked' : null?>>
                            <span class="radio-text"><?=$service['NAME']?></span>
                        </label>
                    </li>
                    <? endforeach; ?>
                </ul>
            </div>
            <? endif; ?>

            <div class="head-cart_dropdown-footer">
                <span class="text">Итог:</span>
                <span class="head-cart_sum"><?=$arResult['TOTAL_PRICE']?></span>
            </div>
        </div>
    </div>
<? endif; ?>

