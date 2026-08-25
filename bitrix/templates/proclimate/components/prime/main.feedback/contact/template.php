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
?>

<?if(!empty($arResult["ERROR_MESSAGE"]))
{
    foreach($arResult["ERROR_MESSAGE"] as $v)
        ShowError($v);
}
?>

<form action="<?=POST_FORM_ACTION_URI?>" method="POST" enctype="multipart/form-data" class="contact-form">
    <?=bitrix_sessid_post()?>

    <? foreach($arResult['USER_FIELD'] as $field): ?>

        <div class="form-group">
            <labek class="form-label"><?if($field['IS_REQUIRED'] == "Y"):?>*<?endif?><?=$field['NAME']?>:</labek>
            <?if($field['ROW_COUNT'] > "1"):?>
                <textarea
                        class="form-textarea"
                        name="<?=$field['CODE']?>"
                        <?if($field['IS_REQUIRED'] == "Y"):?>required<?endif?>
                ><?=$arResult[$field['CODE']]?></textarea>
            <? else: ?>
                <input type="<?=($field['CODE'] == 'PHONE') ? 'tel' : 'text'?>"
                       class="form-input"
                       name="<?=$field['CODE']?>"
                       value="<?=$arResult[$field['CODE']]?>"
                       placeholder="<?=$field['NAME']?>"
                       <?if($field['IS_REQUIRED'] == "Y"):?>required<?endif?>
                >
            <?endif;?>
        </div>

    <? endforeach; ?>

    <div class="text-center">
        <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
		<input type="submit" name="submit" class="main-btn form-callback_submit" value="Отправить">
    </div>

    <br>
    <div class="text-center">
        <span class="form-static_policy-text">

Нажимая на эту кнопку, я даю свое согласие на обработку персональных данных и соглашаюсь с условиями 
<a href="/upload/politics.pdf" target="_blank" rel="noopener noreferrer" style="color: #0000FF;">
политики обработки персональных данных
</a>

</span>
    </div>
</form>
