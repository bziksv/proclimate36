<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?><form action="<?=POST_FORM_ACTION_URI?>" method="POST" enctype="multipart/form-data" class="form-callback">
    <?=bitrix_sessid_post()?>
    <div class="form-callback_title">
        Заказать звонок
        <small>Введите Ваш номер телефона <span class="min">и мы вам перезвоним.</span></small>
        <?if(!empty($arResult["ERROR_MESSAGE"]))
        {
            foreach($arResult["ERROR_MESSAGE"] as $v)
                ShowError($v);
        }
        ?>
    </div>
    <? foreach($arResult['USER_FIELD'] as $field):?>
        <div class="form-group">
            <labek class="form-label"><?if($field['IS_REQUIRED'] == "Y"):?>*<?endif?><?=$field['NAME']?>:</labek>
            <input type="<?=($field['CODE'] == 'PHONE') ? 'tel' : 'text'?>"
                   class="form-input"
                   name="<?=$field['CODE']?>"
                   value="<?=$arResult[$field['CODE']]?>"
                   placeholder="<?=$field['NAME']?>"
                   <?if($field['IS_REQUIRED'] == "Y"):?>required<?endif?>
            >
        </div>
    <? endforeach; ?>

    <div class="text-center">
        <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
        <input type="submit" name="submit" class="main-btn form-callback_submit" value="Отправить">

        <?if($arParams["USE_CAPTCHA"] == "Y"):?>
            <div class="g-recaptcha" data-sitekey="<?=$arParams["CAPTCHA_SITE_KEY"]?>"></div>
        <?endif;?>
    </div>

    <br>
    <div class="text-center">
        <span class="form-static_policy-text">

Нажимая кнопку вы соглашаетесь с
<a href="/upload/politics.pdf" target="_blank" style="color: #0000FF">политикой конфиденциальности </a>
и
<a href="/upload/compliance.pdf"  target="_blank" style="color: #0000FF">правилами обработки персональных данных</a>

</span>
    </div>
</form>