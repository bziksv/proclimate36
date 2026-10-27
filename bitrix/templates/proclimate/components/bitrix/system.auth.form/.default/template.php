<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();

$APPLICATION->SetAdditionalCSS("/bitrix/css/main/system.auth/flat/style.css");
?>

<div class="bx-authform">

<h3 class="bx-title"><?=GetMessage("auth_form_comp_auth")?></h3>

<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
	ShowMessage($arResult['ERROR_MESSAGE']);
?>

<?
// Prefer explicit ?backurl= from checkout/cart flow over current /auth/ URL.
$authBackUrl = '';
if (!empty($_REQUEST['backurl']) && is_string($_REQUEST['backurl']))
{
	$candidate = $_REQUEST['backurl'];
	if (strpos($candidate, '/') === 0 && strpos($candidate, '//') === false && strpos($candidate, '/auth') !== 0)
		$authBackUrl = $candidate;
}
if ($authBackUrl === '' && !empty($arResult['~BACKURL']) && is_string($arResult['~BACKURL']))
{
	$candidate = $arResult['~BACKURL'];
	if (strpos($candidate, '/') === 0 && strpos($candidate, '/auth') === false)
		$authBackUrl = $candidate;
}
?>

<?if($arResult["FORM_TYPE"] == "login"):?>

<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($authBackUrl <> ''):?>
	<input type="hidden" name="backurl" value="<?=htmlspecialcharsbx($authBackUrl)?>" />
<?endif?>
<?foreach ($arResult["POST"] as $key => $value):?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />
	
	<div class="bx-authform-formgroup-container">
		<div class="bx-authform-label-container"><?=GetMessage("AUTH_LOGIN")?>: </div>
		<div class="bx-authform-input-container">
			<input type="text" name="USER_LOGIN" maxlength="50" value="" size="17" />
		</div>
	</div>

	<div class="bx-authform-formgroup-container">
		<div class="bx-authform-label-container"><?=GetMessage("AUTH_PASSWORD")?>: </div>
		<div class="bx-authform-input-container">
			<input type="password" name="USER_PASSWORD" maxlength="255" size="17" autocomplete="off" />
		</div>
	</div>
	
	<div class="bx-authform-formgroup-container">
		<input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" />
		<label for="USER_REMEMBER_frm" title="<?=GetMessage("AUTH_REMEMBER_ME")?>" style="vertical-align: text-bottom;"><?echo GetMessage("AUTH_REMEMBER_SHORT")?></label>
	</div>
	
	<div class="bx-authform-formgroup-container">
		<div class="bx-authform-input-container">
			<input type="submit" name="Login" class="btn btn-primary" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" />
		</div>
	</div>
	
</form>

<hr class="bxe-light">

<?
$authRegisterUrl = $arResult["AUTH_REGISTER_URL"];
$authForgotUrl = $arResult["AUTH_FORGOT_PASSWORD_URL"];
if ($authBackUrl !== '')
{
	$authRegisterUrl = "/auth/registration.php?backurl=".rawurlencode($authBackUrl);
	$authForgotUrl = "/auth/forget.php?backurl=".rawurlencode($authBackUrl);
}
?>
<div class="bx-authform-formgroup-container">
	<a href="<?=htmlspecialcharsbx($authRegisterUrl)?>" class="btn btn-primary" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a>
	<a href="<?=htmlspecialcharsbx($authForgotUrl)?>" class="btn btn-primary" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
</div>
<? else: ?>
	<? LocalRedirect($authBackUrl !== '' ? $authBackUrl : $arParams["PROFILE_URL"]); ?>
<?endif?>
</div>
