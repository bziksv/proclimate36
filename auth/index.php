<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");

$userName = CUser::GetFullName();
if (!$userName)
	$userName = CUser::GetLogin();
?>

<? if($_REQUEST["USER_LOGIN"] && $_REQUEST["USER_CHECKWORD"]): ?>

<?$APPLICATION->IncludeComponent("bitrix:main.auth.changepasswd", ".default", Array(
	"AUTH_AUTH_URL" => "/auth/",	// Страница для авторизации
		"AUTH_REGISTER_URL" => "/auth/registration.php",	// Страница для регистрации
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

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>