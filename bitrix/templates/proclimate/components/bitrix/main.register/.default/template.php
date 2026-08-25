<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}

$APPLICATION->SetAdditionalCSS("/bitrix/css/main/system.auth/flat/style.css");
?>
<div class="bx-authform">

<?if($USER->IsAuthorized()):?>

<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

<?else:?>
<?
if (count($arResult["ERRORS"]) > 0):
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0) 
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));

elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
?>
<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
<?endif?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
<?
if($arResult["BACKURL"] <> ''):
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
endif;
?>

<h3 class="bx-title"><?=GetMessage("AUTH_REGISTER")?></h3>

<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
		
	<?
	switch ($FIELD)
	{
		case "LOGIN":
			?><input type="hidden" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" /><?
			break;
		case "PASSWORD":
			?>
			<div class="bx-authform-formgroup-container">
				<div class="bx-authform-label-container"><?=GetMessage("REGISTER_FIELD_".$FIELD)?> (<?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?>): </div>
				<div class="bx-authform-input-container">
					<input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="bx-auth-input" />
				</div>
			</div>
			<?
			break;
		case "CONFIRM_PASSWORD":
			?>
			<div class="bx-authform-formgroup-container">
				<div class="bx-authform-label-container"><?=GetMessage("REGISTER_FIELD_".$FIELD)?>: </div>
				<div class="bx-authform-input-container">
					<input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" />
				</div>
			</div>
			<?
			break;

		default:
				?>
				<div class="bx-authform-formgroup-container">
					<div class="bx-authform-label-container"><?=GetMessage("REGISTER_FIELD_".$FIELD)?>: </div>
					<div class="bx-authform-input-container">
						<input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" />
					</div>
				</div>
				<?
	}?>
	
<?endforeach?>

<?
/* CAPTCHA */
if ($arResult["USE_CAPTCHA"] == "Y")
{
	?>
	
	<div class="bx-authform-formgroup-container">
		<div class="bx-authform-label-container"><?=GetMessage("REGISTER_CAPTCHA_PROMT")?>: </div>
		<div class="bx-authform-input-container">
			<input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" />
		</div>
	</div>
	
	<div class="bx-authform-formgroup-container">
		<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
	</div>
		
<?
}
/* !CAPTCHA */
?>

	<div class="text-center" style="margin-bottom: 25px;">
        <span class="form-static_policy-text">

<label style="display: flex; align-items: flex-start; gap: 8px; cursor: pointer;">
  <input type="checkbox" name="consent" required style="margin-top: 3px;">
	<span style="text-align: left;">Нажимая на эту кнопку, я даю свое <a href="/legal/consent.pdf" target="_blank" rel="noopener noreferrer" style="color: #0000FF;">согласие</a>  на обработку персональных данных согласно условиям <a href="/legal/personal-data.pdf" target="_blank" rel="noopener noreferrer" style="color: #0000FF;">политики обработки персональных данных</a>.</span>
</label>

</span>
    </div>

	
	<div class="bx-authform-formgroup-container">
		<input type="submit" name="register_submit_button" class="btn btn-primary" value="<?=GetMessage("AUTH_REGISTER")?>" />
		<a href="/auth/" class="btn btn-primary">Авторизация</a>
	</div>



</form>

<?endif?>
</div>

<script type="text/javascript">
document.regform.onsubmit = function(){
	document.regform['REGISTER[LOGIN]'].value = document.regform['REGISTER[EMAIL]'].value;
};
</script>