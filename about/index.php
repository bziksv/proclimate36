<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О магазине");
?><main class="main-content">
<div class="about-us_section">
	<div class="container">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"breadcrumb",
	Array(
		"SITE_ID" => SITE_ID
	)
);?>
		<h1>О компании</h1>
		<div class="container" align="center">

 <a target="_blank" href="/images/dealer_certificate_1_LESSAR_Sert2021.pdf"><img src="/images/preview_dealer_certificate_1_LESSAR_Sert2021.jpg" title="Сертификат дилера LESSAR"></a>

 <a target="_blank" href="/images/dealer_certificate_2_TOSOT.pdf"><img src="/images/preview_dealer_certificate_2_TOSOT.jpg" title="Сертификат дилера TOSOT"></a>

<a target="_blank" href="/images/dealer_certificate_3_Haier.pdf"><img src="/images/preview_dealer_certificate_3_Haier.jpg" title="Сертификат дилера Haier"></a>

			</div>
				<div class="row">
					<div class="col-md-7">
					</div>
				</div>
				<ul class="advantages-list advantages-list_mod">
					<li class="advantages-item"> <span class="advantages-item_icon glipf-file"></span>
					Гарантия <br>
					 от производителя <br>
					 до 5 лет </li>
					<li class="advantages-item"> <span class="advantages-item_icon glipf-free-delivery"></span>
					Бесплатная <br>
					 доставка </li>
					<li class="advantages-item"> <span class="advantages-item_icon glipf-settings"></span>
					Монтаж любой <br>
					 сложности </li>
					<li class="advantages-item"> <span class="advantages-item_icon glipf-money-2"></span>
					Гарантия <br>
					 лучшей цены </li>
				</ul>
				<div class="row">
					<div class="col-md-5">
						<div class="about-us_img">
 <br>
						</div>
					</div>
				</div>
			</div>
		</div>
		 <!-- end news-mod_section -->
	</div>
</div>
</main><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>