<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;

ShowError($arResult["strProfileError"]);

if ($arResult['DATA_SAVED'] == 'Y')
{
    ShowNote(Loc::getMessage('PROFILE_DATA_SAVED'));
}

?>
<form method="post" class="personal-data_form" name="form1" action="<?=POST_FORM_ACTION_URI?>" enctype="multipart/form-data" role="form">
    <?=$arResult["BX_SESSION_CHECK"]?>
    <input type="hidden" name="lang" value="<?=LANG?>" />
    <input type="hidden" name="ID" value="<?=$arResult["ID"]?>" />
    <input type="hidden" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>" />

    <div class="row align-items-end">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label"><?=Loc::getMessage('NAME')?></label>
                <input type="text" name="NAME" value="<?=$arResult["arUser"]["NAME"]?>" class="form-input">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label"><?=Loc::getMessage('LAST_NAME')?></label>
                <input type="text" name="LAST_NAME" value="<?=$arResult["arUser"]["LAST_NAME"]?>" class="form-input">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label"><?=Loc::getMessage('SECOND_NAME')?></label>
                <input type="text" name="SECOND_NAME" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" class="form-input">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label"><?=Loc::getMessage('EMAIL')?></label>
                <input type="text" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>" class="form-input">
            </div>
        </div>

        <? if ($arResult['CAN_EDIT_PASSWORD']): ?>
        <div class="col-md-6">
            <div class="form-group">
                <span class="text"><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></span>
                <label class="form-label"><?=Loc::getMessage('NEW_PASSWORD_REQ')?></label>
                <input type="password" name="NEW_PASSWORD" value="" autocomplete="off" class="form-input">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label"><?=Loc::getMessage('NEW_PASSWORD_CONFIRM')?></label>
                <input type="password" name="NEW_PASSWORD_CONFIRM" value="" autocomplete="off" class="form-input">
            </div>
        </div>
        <? endif; ?>

    </div>
    <div class="personal-data_form-footer">
        <input type="submit" class="personal-data_form-submit main-btn" name="save" value="<?=(($arResult["ID"]>0) ? Loc::getMessage("MAIN_SAVE") : Loc::getMessage("MAIN_ADD"))?>">
        <input type="submit" class="border-blue_btn personal-data_form-reset"  name="reset" value="<?echo GetMessage("MAIN_RESET")?>">
    </div>
</form>
