<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("payment");
?><main class="main-content">
<div class="delivery-section">
	<div class="container">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"breadcrumb",
	Array(
		"SITE_ID" => SITE_ID
	)
);?>
		<h1>Доставка</h1>
		<div class="delivery-section_content">
			<div class="row">
				<div class="col-md-6 left-column">
					<div class="h3">
						 Доставка по Воронежу и Воронежской области
					</div>
					<div class="delivery-img">
 <img alt="alt" src="/bitrix/templates/proclimate/img/static/delivery/01.jpg" data-src="/bitrix/templates/proclimate/img/static/delivery/01.jpg">
					</div>
					<div class="delivery-section_box">
						<div class="h4">
							 Условия оказания услуги
						</div>
						<p>
							 Доставка кондиционеров и другой техники из магазина &nbsp;в Воронежской области осуществляется средствами собственной службы доставки (наш транспорт позволяет доставлять как малогабаритные, так и крупногабаритные товары)
						</p>
						<p>
							 Доставка физическим лицам осуществляется с 9:00 до 19:00 местного времени.&nbsp;
						</p>
						<p>
							 Срок доставки товаров по области - 1-2 рабочих дня.
						</p>
					</div>
					<div class="delivery-section_box">
						<div class="h4">
							 Стоимость доставки
						</div>
						<p>
							 Доставка по Воронежу бесплатно. В пригороды Воронежа и по Воронежской области по цене 15р./км, либо посредством курьерских служб и транспортных компаний.⁠
						</p>
					</div>
					<div class="delivery-section_box">
						<div class="h4">
							 Подъем товара на этаж
						</div>
						<p>
							 Подъем товара является услугой доставки, или её частью.
						</p>
						<p>
							 Подъем крупногабаритного товара на этаж осуществляется только при условии, если товар в упаковке проходит по габаритам в дверной проем подъезда, грузовой лифт. В противном случае крупногабаритные товары доставляются к подъезду, либо на лестничную площадку.
						</p>
						<p>
							 Занос товара внутрь частного строения / квартиры не является услугой доставки, или её частью.&nbsp;
						</p>
					</div>
				</div>
				<div class="col-md-6 right-column">
					<div class="h3">
						 Доставка по России
					</div>
					<div class="delivery-img">
 <img alt="alt" src="/bitrix/templates/proclimate/img/static/delivery/02.jpg" data-src="/bitrix/templates/proclimate/img/static/delivery/02.jpg">
					</div>
					<div class="delivery-section_box">
						<div class="h4">
							 Условия оказания услуги
						</div>
						<p>
							 Доставка кондиционеров и другой техники из магазина по територии России осуществляется посредством курьерских служб и транспортных компаний.
						</p>
						<p>
							 Отправка товаров происходит с 10:00 до 18:00 местного времени по рабочим дням стандартно не ранее, чем на следующий день при приёме заказа до 12:00 текущего дня.
						</p>
						<p>
							 Срок отправки товаров - 1-2 рабочих дня.
						</p>
					</div>
					<div class="delivery-section_box">
						<div class="h4">
							 Стоимость доставки
						</div>
						<p>
							 Стоимость доставки по России – 400-800 руб. в зависимости от тарифов выбранной транспортной компании.
						</p>
					</div>
					<div class="delivery-section_box">
						<div class="h4">
							 Подъем товара на этаж
						</div>
						<p>
							 Подъем товара осуществляеться согласно договора и тарифов выбранной транспортной компании.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 <!-- end delivery-section -->
<div class="payment-section">
	<div class="container">
		<div class="section-title">
			 Способы оплаты
		</div>
		<div class="payment-section_box">
			<div class="h4">
				 Наличный расчёт
			</div>
			<p>
				 Вы можете оплатить покупку наличными в магазине или курьеру (при доставке товара).
			</p>
		</div>
		<div class="payment-section_box">
			<div class="h4">
				 Пластиковые карты
			</div>
			<p>
				 Безналичная оплата банковской картой в магазине и при доставке. <br>
				 Принимаются карты следующих платёжных систем: «VISA», «MasterCard», «Золотая Корона», «МИР».
			</p>
		</div>
		<div class="payment-section_box">
			<div class="h4">
				 Безналичный расчет
			</div>
			<p>
				 Доступен для юридических лиц (ООО, ЧП, ИП и т.п.).
			</p>
		</div>
		<div class="payment-section_box">
			<div class="h4">
				 Онлайн-оплата на сайте
			</div>
			<p>
				 Оплата осуществляется через компанию-партнера - Яндекс.Деньги. Комиссия не взимается. <br>
				 К оплате принимаются кошельки WebMoney, банковские карты, QIWI-кошельки и Яндекс-кошельки.
			</p>
			<p>
				 Если вы выбираете онлайн-оплату — вы указываете информацию о своем платежном средстве в специальной защищенной форме оплаты на странице компании-партнера. Партнер проводит проверку сформированного запроса на соответствие установленным требованиям и передает этот запрос нп авторизацию. После того, как банк-эмитент подтвердил авторизацию платежа, вы возвращаетесь на наш сайт на страницу подтверждения заказа. На номер телефона, указанный при оформлении заказа, высылается специальный код, который нужно будет сообщить сотрудникам магазина при получении заказа. <br>
				 Внимание! При возврате платежа денежные средства вернутся только на то же платежное средство (банковскую карту, кошелек Yandex / Qiwi / Webmoney), с которого был произведен платеж.
			</p>
			<ul class="payment-card_list">
				<li><img alt="alt" src="/bitrix/templates/proclimate/img/static/payment/01.jpg" data-src="/bitrix/templates/proclimate/img/static/payment/01.jpg"></li>
				<li><img alt="alt" src="/bitrix/templates/proclimate/img/static/payment/02.jpg" data-src="/bitrix/templates/proclimate/img/static/payment/02.jpg"></li>
				<li><img alt="alt" src="/bitrix/templates/proclimate/img/static/payment/03.jpg" data-src="/bitrix/templates/proclimate/img/static/payment/03.jpg"></li>
				<li><img alt="alt" src="/bitrix/templates/proclimate/img/static/payment/04.jpg" data-src="/bitrix/templates/proclimate/img/static/payment/04.jpg"></li>
				<li><img alt="alt" src="/bitrix/templates/proclimate/img/static/payment/05.jpg" data-src="/bitrix/templates/proclimate/img/static/payment/05.jpg"></li>
				<li><img alt="alt" src="/bitrix/templates/proclimate/img/static/payment/06.jpg" data-src="/bitrix/templates/proclimate/img/static/payment/06.jpg"></li>
			</ul>
		</div>
	</div>
</div>
 <!-- end payment-section --> </main>
    <!-- end main-content --><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>