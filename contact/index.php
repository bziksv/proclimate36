<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Контакты магазина Proclimate");
$APPLICATION->SetTitle("Контакты");
?><main class="main-content">
<div class="contact-mod_section">
	<div class="container">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"breadcrumb",
	Array(
		"SITE_ID" => SITE_ID
	)
);?>
		<h1>Контакты</h1>
		<ul class="contact-section_top-panel">
			<li> <span class="glipf-placeholder"></span>
			<?= tplvar('street', true);?> </li>
			<li> <span class="glipf-phone"></span> <a href="tel:<?= tplvar('phone');?>"><?= tplvar('phone', true);?></a> </li>
			<li> <a href="mailto:online@rusklimat.ru"> <span class="glipf-email"></span>
			<?= tplvar('email', true);?> </a> </li>
		</ul>
	</div>
	<div class="container-fluid">
		<div class="row no-gutters">
			<div class="col-md-6">
				<div class="contact-section_desc-mod">
					<div class="h3">
						Есть вопросы? <br>
						 Оставьте ваше сообщение
					</div>
					 <?$APPLICATION->IncludeComponent(
	"prime:main.feedback",
	"contact",
	Array(
		"COMPONENT_TEMPLATE" => "",
		"EVENT_MESSAGE_ID" => array(0=>"7",),
		"IBLOCK_ID" => "11",
		"IBLOCK_TYPE" => "feedback",
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"PROPERTY_CODE" => array(0=>"NAME",1=>"EMAIL",2=>"PHONE",3=>"MSG",),
	)
);?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="map-container map-container_mod">
					<div id="map">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 <!-- end contact-section --> </main><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>