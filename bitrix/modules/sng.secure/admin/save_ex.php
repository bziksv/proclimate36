<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
\Bitrix\Main\Loader::includeModule('sng.secure');

foreach($_POST['secure_exeptions'] as $key => $path)
{
	if(!strlen(trim(htmlspecialchars($path)))>0)
	{
		unset($_POST['secure_exeptions'][$key]);
	}
}
if(!empty($_POST['secure_exeptions']))
{	
	COption::SetOptionString("sng.secure", "exeptions", serialize($_POST['secure_exeptions']));
}
else
{
	COption::SetOptionString("sng.secure", "exeptions", '');
}

				$arEx = unserialize(COption::GetOptionString("sng.secure", "exeptions", ''));
				if(!empty($arEx))
				{					
					foreach($arEx as $key => $path)
					{
					?>
					<input class="secure_exeptions_i" type="text" size="35" maxlength="255" value="<?=$path;?>" name="secure_ex[]"><br>
					<?
					}
				}
				?>
				<input class="secure_exeptions_i" type="text" size="35" maxlength="255" value="" name="secure_ex[]"><br>
