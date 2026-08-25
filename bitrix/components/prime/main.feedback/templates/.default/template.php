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
    </div>

    <br>
    <div class="text-center">
        <span class="form-static_policy-text">

<label style="display: flex; align-items: flex-start; gap: 8px; cursor: pointer;">
  <input type="checkbox" name="consent" required style="margin-top: 3px;">
	<span style="text-align: left;">Нажимая на эту кнопку, я даю свое <a href="/legal/consent.pdf" target="_blank" rel="noopener noreferrer" style="color: #0000FF;">согласие</a>  на обработку персональных данных согласно условиям <a href="/legal/personal-data.pdf" target="_blank" rel="noopener noreferrer" style="color: #0000FF;">политики обработки персональных данных</a>.</span>
</label>


</span>
    </div>
</form>