<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var CBitrixComponentTemplate $this */
$this->setFrameMode(true);

$this->addExternalCss(SITE_TEMPLATE_PATH."/css/services-landing.css");

$ctaLabel = htmlspecialcharsbx($arResult["SVC_CTA"] ?? "Заказать услугу");
$price = htmlspecialcharsbx($arResult["SVC_PRICE"] ?? "");
$pic = $arResult["DETAIL_PICTURE"]["SRC"] ?? "";
$name = $arResult["NAME"];
?>

<div class="svc-land">
	<section class="svc-land__hero">
		<div class="svc-land__hero-glow" aria-hidden="true"></div>
		<div class="svc-land__hero-grid">
			<div class="svc-land__hero-copy">
				<?if(!empty($arResult["SVC_EYEBROW"])):?>
					<div class="svc-land__eyebrow"><?=htmlspecialcharsbx($arResult["SVC_EYEBROW"])?></div>
				<?endif;?>

				<?if($arParams["DISPLAY_NAME"]!="N" && $name):?>
					<h1 class="svc-land__title"><?=$name?></h1>
				<?endif;?>

				<div class="svc-land__lead">
					<?=$arResult["SVC_INTRO"]?>
				</div>

				<div class="svc-land__actions">
					<a href="#callback" data-toggle="modal" class="main-btn svc-land__btn"><?=$ctaLabel?></a>
				</div>
			</div>
			<div class="svc-land__hero-media">
				<div class="svc-land__visual">
					<div class="svc-land__visual-frame">
						<?if($pic):?>
							<img src="<?=$pic?>" data-src="<?=$pic?>" alt="<?=htmlspecialcharsbx($name)?>">
						<?endif;?>
					</div>
					<div class="svc-land__visual-note">
						<span class="<?=htmlspecialcharsbx($arResult["SVC_ICON"] ?? "glipf-conditioner")?>" aria-hidden="true"></span>
						Работаем по договору · убираем за собой
					</div>
				</div>
			</div>
		</div>

		<?if(!empty($arResult["SVC_BULLETS"])):?>
			<div class="svc-land__lead svc-land__lead--bullets">
				<?=$arResult["SVC_BULLETS"]?>
			</div>
		<?endif;?>
	</section>

	<?if($arResult["SVC_HAS_MORE"]):?>
	<section class="svc-land__panel svc-land__panel--more">
		<button type="button" class="svc-land__more-toggle js-svc-more-toggle" aria-expanded="false">
			<span>Подробнее об услуге</span>
			<i aria-hidden="true"></i>
		</button>
		<div class="svc-land__more-body js-svc-more-body" hidden>
			<?=$arResult["SVC_MORE"]?>
		</div>
	</section>
	<?endif;?>

	<? if(!empty($arResult['PROPERTIES']['STANDART']['DESCRIPTION'])): ?>
	<section class="svc-land__panel">
		<div class="svc-land__panel-head">
			<div class="services-detailed_box-title"><?=$arResult['PROPERTIES']['STANDART']['NAME']?></div>
			<p class="svc-land__panel-hint">Что входит и как считается стандарт</p>
		</div>
		<div class="services-detailed_box svc-land__accordion">
			<? foreach ($arResult['PROPERTIES']['STANDART']['DESCRIPTION'] as $key => $itemName):
				$arName = explode('|', $itemName, 2);
				?>
			<div class="services-detailed_work-item<?=($key===0?' is-active':'')?>">
				<div class="services-detailed_work-item_header">
					<span class="left-column"><?=htmlspecialcharsbx(trim($arName[0]))?></span>
					<?if(!empty($arName[1])):?>
					<span class="right-column"><?=htmlspecialcharsbx(trim($arName[1]))?></span>
					<?endif;?>
				</div>
				<div class="services-detailed_work-item_body">
					<?=$arResult['PROPERTIES']['STANDART']['~VALUE'][$key]['TEXT']?>
				</div>
			</div>
			<? endforeach; ?>
		</div>
	</section>
	<? endif; ?>

	<? if(!empty($arResult['PROPERTIES']['PRICE_LIST']['DESCRIPTION'])): ?>
	<section class="svc-land__panel svc-land__panel--price" id="svc-prices">
		<div class="svc-land__panel-head">
			<div class="services-detailed_box-title"><?=$arResult['PROPERTIES']['PRICE_LIST']['NAME']?></div>
			<p class="svc-land__panel-hint">Тарифы без сюрпризов — откройте пункт, чтобы увидеть состав работ</p>
		</div>
		<div class="services-detailed_box svc-land__accordion">
			<? foreach ($arResult['PROPERTIES']['PRICE_LIST']['DESCRIPTION'] as $key => $itemName):
				$arName = explode('|', $itemName, 2);
				?>
			<div class="services-detailed_work-item<?=($key===0?' is-active':'')?>">
				<div class="services-detailed_work-item_header">
					<span class="left-column"><?=htmlspecialcharsbx(trim($arName[0]))?></span>
					<?if(!empty($arName[1])):?>
					<span class="right-column"><?=htmlspecialcharsbx(trim($arName[1]))?></span>
					<?endif;?>
				</div>
				<div class="services-detailed_work-item_body">
					<?=$arResult['PROPERTIES']['PRICE_LIST']['~VALUE'][$key]['TEXT']?>
				</div>
			</div>
			<? endforeach; ?>
		</div>
	</section>
	<? endif; ?>

	<? if(!empty($arResult['PROPERTIES']['WORK']['DESCRIPTION'])): ?>
	<section class="svc-land__panel">
		<div class="svc-land__panel-head">
			<div class="services-detailed_box-title"><?=$arResult['PROPERTIES']['WORK']['NAME']?></div>
		</div>
		<div class="services-detailed_box svc-land__accordion">
			<? foreach ($arResult['PROPERTIES']['WORK']['DESCRIPTION'] as $key => $itemName):?>
			<div class="services-detailed_work-item">
				<div class="services-detailed_work-item_header"><?=htmlspecialcharsbx($itemName)?></div>
				<div class="services-detailed_work-item_body">
					<?=$arResult['PROPERTIES']['WORK']['~VALUE'][$key]['TEXT']?>
				</div>
			</div>
			<? endforeach; ?>
		</div>
	</section>
	<? endif; ?>

	<? if(!empty($arResult['PROPERTIES']['MATERIALS']['VALUE'])): ?>
	<section class="svc-land__panel">
		<div class="svc-land__panel-head">
			<div class="services-detailed_box-title"><?=$arResult['PROPERTIES']['MATERIALS']['NAME']?></div>
		</div>
		<table class="services-detailed_materials-table">
			<? foreach ($arResult['PROPERTIES']['MATERIALS']['DESCRIPTION'] as $key => $itemName):?>
			<tr>
				<td><?=$arResult['PROPERTIES']['MATERIALS']['VALUE'][$key]?></td>
				<td><?=$itemName?></td>
			</tr>
			<? endforeach; ?>
		</table>
	</section>
	<? endif; ?>

	<?
	$infoValue = $arResult['PROPERTIES']['INFO']['~VALUE'] ?? '';
	$infoHtml = is_array($infoValue) ? ($infoValue['TEXT'] ?? '') : $infoValue;
	if (trim((string)$infoHtml) !== ''):
	?>
	<div class="services-detailed_footer-text svc-land__info"><?=$infoHtml?></div>
	<?endif;?>

	<section class="svc-land__footer-cta">
		<div class="svc-land__footer-cta-inner">
			<div>
				<div class="svc-land__footer-cta-title">Нужна консультация или выезд?</div>
				<p>Оставьте заявку — перезвоним и уточним сроки и стоимость по вашему объекту.</p>
			</div>
			<div class="svc-land__footer-cta-actions">
				<a href="#callback" data-toggle="modal" class="main-btn"><?=$ctaLabel?></a>
				<a href="#svc-prices" class="svc-land__link-prices">Смотреть прайс</a>
			</div>
		</div>
	</section>
</div>

<script>
(function () {
	var root = document.currentScript && document.currentScript.previousElementSibling;
	if (!root || !root.classList.contains('svc-land')) {
		root = document.querySelector('.svc-land');
	}
	if (!root) return;
	var btn = root.querySelector('.js-svc-more-toggle');
	var body = root.querySelector('.js-svc-more-body');
	if (btn && body) {
		btn.addEventListener('click', function () {
			var open = btn.getAttribute('aria-expanded') === 'true';
			btn.setAttribute('aria-expanded', open ? 'false' : 'true');
			btn.classList.toggle('is-open', !open);
			if (open) body.setAttribute('hidden', '');
			else body.removeAttribute('hidden');
		});
	}
})();
</script>
