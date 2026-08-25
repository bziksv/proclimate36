<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
\Bitrix\Main\Loader::includeModule('sng.secure');
			
if(!strlen($_POST['file']))
{
	$_SESSION['SNG_SECURE'] = array();
}

global $number;

if($file = CSNGSecure::searchPhp($_POST['secure_path'], $_POST['file'], intval($_POST['countF']), "ajax"))
{
	echo '{"status":"progress", "file":"'.$file.'", "count":"'.$number.'"}';
} 
else
{
	echo '{"status":"done", "count":"'.$number.'"}';
}
?>