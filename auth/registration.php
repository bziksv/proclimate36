<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>
<main class="main-content">
	<div class="container" style="padding-top: 2em; padding-bottom: 3em;">
<?$APPLICATION->IncludeComponent("bitrix:main.register", ".default", Array(
	"AUTH" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"REQUIRED_FIELDS" => array(
			0 => "EMAIL",
		),
		"SET_TITLE" => "Y",
		"SHOW_FIELDS" => array(
			0 => "EMAIL",
		),
		"SUCCESS_PAGE" => "/personal/cart/",
		"USER_PROPERTY" => "",
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "Y",
	),
	false
);?>
	</div>
</main>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
