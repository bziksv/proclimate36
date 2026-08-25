<?
IncludeModuleLangFile(__FILE__);
Class sng_secure extends CModule
{
	const MODULE_ID = 'sng.secure';
	var $MODULE_ID = 'sng.secure'; 
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $strError = '';

	function __construct()
	{
		$arModuleVersion = array();
		include(dirname(__FILE__)."/version.php");
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = GetMessage("sng.secure_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("sng.secure_MODULE_DESC");

		$this->PARTNER_NAME = GetMessage("sng.secure_PARTNER_NAME");
		$this->PARTNER_URI = GetMessage("sng.secure_PARTNER_URI");
	}
/*
	function InstallDB($arParams = array())
	{		
		//RegisterModuleDependences('main', 'OnBuildGlobalMenu', self::MODULE_ID, 'CSngOK', 'OnBuildGlobalMenu');
		RegisterModuleDependences("main","OnBeforeEndBufferContent", self::MODULE_ID, "CSngOK","AddScriptUp", "100");
		return true;
	}

	function UnInstallDB($arParams = array())
	{		
		//UnRegisterModuleDependences('main', 'OnBuildGlobalMenu', self::MODULE_ID, 'CSngOK', 'OnBuildGlobalMenu');
        UnRegisterModuleDependences("main", "OnBeforeEndBufferContent", self::MODULE_ID, "CSngOK", "AddScriptUp");		
		return true;
	}
*/
	function InstallEvents()
	{
		return true;
	}

	function UnInstallEvents()
	{
		return true;
	}

	function InstallFiles($arParams = array())
	{
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || $item == 'menu.php')
						continue;
					file_put_contents($file = $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.self::MODULE_ID.'_'.$item,
					'<'.'? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/'.self::MODULE_ID.'/admin/'.$item.'");?'.'>');
				}
				closedir($dir);
			}
		}
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/components'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/'.$item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
			}
		}
        //CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sng.ok/install/js", $_SERVER["DOCUMENT_ROOT"]."/bitrix/js/sng.ok/", true, true);
       // CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sng.ok/install/images", $_SERVER["DOCUMENT_ROOT"]."/bitrix/images/sng.ok/", true, true);
	    CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/tools", $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/".self::MODULE_ID."/", true, true);
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/admin/ajax.php", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin/", true, true);
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/images", $_SERVER["DOCUMENT_ROOT"]."/bitrix/images/".self::MODULE_ID."/", true, true);
		return true;
	}

	function UnInstallFiles()
	{
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					unlink($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.self::MODULE_ID.'_'.$item);
				}
				closedir($dir);
			}
		}
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/components'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || !is_dir($p0 = $p.'/'.$item))
						continue;

					$dir0 = opendir($p0);
					while (false !== $item0 = readdir($dir0))
					{
						if ($item0 == '..' || $item0 == '.')
							continue;
						DeleteDirFilesEx('/bitrix/components/'.$item.'/'.$item0);
					}
					closedir($dir0);
				}
				closedir($dir);
			}
		}
		//DeleteDirFilesEx("/bitrix/js/sng.ok");
		DeleteDirFilesEx("/bitrix/tools/".self::MODULE_ID."/");	
        DeleteDirFilesEx("/bitrix/images/".self::MODULE_ID."/");		
		DeleteDirFilesEx("/bitrix/admin/".self::MODULE_ID."ajax.php");		
		return true; 
	}

	function DoInstall()
	{
		global $APPLICATION;
		$this->InstallFiles();

		$this->InstallDB();
		RegisterModule(self::MODULE_ID);
	}

	function DoUninstall()
	{
		global $APPLICATION;
		UnRegisterModule(self::MODULE_ID);
		$this->UnInstallDB();
		$this->UnInstallFiles();
	}
}
?>