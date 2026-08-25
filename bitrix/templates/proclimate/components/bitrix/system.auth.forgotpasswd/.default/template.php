<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

global $APPLICATION;
$APPLICATION->SetAdditionalCSS("/bitrix/css/main/system.auth/flat/style.css");
?>
<div class="bx-authform">

	<? ShowMessage($arParams["~AUTH_RESULT"]); ?>
	
	<h3 class="bx-title">Восстановление пароля</h3>
	
	<form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
	<?
	if (strlen($arResult["BACKURL"]) > 0)
	{
	?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<?
	}
	?>
		<input type="hidden" name="AUTH_FORM" value="Y">
		<input type="hidden" name="TYPE" value="SEND_PWD">
		
		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container"><?=GetMessage("sys_forgot_pass_login1")?></div>
			<div class="bx-authform-input-container">
				<input type="text" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>" />
				<input type="hidden" name="USER_EMAIL" />
			</div>
		</div>
		
		<div class="bx-authform-formgroup-container">
			<input type="submit" name="send_account_info" class="btn btn-primary" value="<?=GetMessage("AUTH_SEND")?>" />
		</div>
		
		<hr class="bxe-light">

		<div class="bx-authform-formgroup-container">
			<a href="/auth/" class="btn btn-primary"><b><?=GetMessage("AUTH_AUTH")?></b></a>
		</div>

	</form>
</div>

<script type="text/javascript">
document.bform.onsubmit = function(){document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;};
document.bform.USER_LOGIN.focus();
</script>
