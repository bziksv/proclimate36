<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");

global $USER;
$userName = is_object($USER) ? $USER->GetFullName() : '';
if (!$userName && is_object($USER))
	$userName = $USER->GetLogin();
?>
<main class="main-content">
	<div class="container" style="padding-top: 2em; padding-bottom: 3em;">

<? if($_REQUEST["USER_LOGIN"] && $_REQUEST["USER_CHECKWORD"]): ?>

<?$APPLICATION->IncludeComponent("bitrix:main.auth.changepasswd", ".default", Array(
	"AUTH_AUTH_URL" => "/auth/",
		"AUTH_REGISTER_URL" => "/auth/registration.php",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>

<? else: ?>

<?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	".default",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"FORGOT_PASSWORD_URL" => "/auth/forget.php",
		"PROFILE_URL" => "/personal/",
		"REGISTER_URL" => "/auth/registration.php",
		"SHOW_ERRORS" => "Y"
	)
);?>

<? endif; ?>

	</div>
</main>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
