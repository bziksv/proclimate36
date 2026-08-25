<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
\Bitrix\Main\Loader::includeModule('sng.secure');
IncludeModuleLangFile(__FILE__); 
krsort($_SESSION['SNG_SECURE']);

$arSort = array();
foreach($_SESSION['SNG_SECURE'] as $key => $value)
{
	$arSort[ConvertTimeStamp($key, 'FULL')] = $value; 
}

if(!empty($arSort)){
	?><br>
	<table style="width:100%;" id="table_secure">
		<tr>
		<td style="width:150px;"><b><?echo GetMessage("SNG_SECURE_TABLE_DATE")?></b></td>
		<td><b><span style="width:180px;display:inline-block"><?echo GetMessage("SNG_SECURE_TABLE_TYPE")?></span> <?echo GetMessage("SNG_SECURE_TABLE_FILE")?></b></td>
		</tr>
	<?
	foreach($arSort as $key => $value)
	{
		?>
		<tr>
		<td style="width:150px;"><?=$key?></td>
		<td>
			<table style="border:none;">		
				<?		
				foreach($value as $k => $v)
				{	
					?>
					<tr>
					<td style="border:none !important;width:180px;"><?=$v;?></td>
					<td style="border:none !important;"><?=$k;?></td>
					</tr>
					<?				
				}
				?>
			</table>
		</td>			
		</tr>
		<?
	}
	?></table>
	<style>
	#table_secure td{border-collapse:collapse;border: 1px solid #C4CED2 !important; margin-top:1px;margin-right:1px;}
	</style>
	<?
	COption::SetOptionString('sng.secure', 'path', htmlspecialchars($_POST['secure_path']));
	COption::SetOptionString("sng.secure", "last_search", serialize($arSort));
	?>
	<br><b style="color:red;"><?echo GetMessage("SNG_SECURE_SEND");?></b><br>
	<?
	echo GetMessage("SNG_SECURE_SEND_BLOCK");
	
	//send mail to admin

}
else
{
	echo GetMessage("SNG_SECURE_OK");
	COption::SetOptionString("sng.secure", "last_search", '');
} 
?>