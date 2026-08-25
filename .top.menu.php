<?
$aMenuLinks = Array(
	Array(
		"Услуги", 
		"services/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Акции", 
		"action/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Наши работы", 
		"works/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Оплата и доставка", 
		"payment/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"О компании", 
		"about/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Полезные статьи", 
		"articles/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		$GLOBALS['USER']->IsAuthorized() ? "Мой кабинет" : "Вход / Регистрация", 
		"personal/", 
		Array(), 
		Array(), 
		"" 
	)
);
?>