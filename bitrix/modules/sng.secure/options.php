<?
#################################################
#   Developer: Semen Golikov                    #
#   Site: https://www.sng-it.ru                 #
#   E-mail: info@sng-it.ru                      #
#   Copyright (c) 2009-2019 Semen Golikov       #
#################################################

IncludeModuleLangFile(__FILE__);  //Connecting the language files for the current script
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
\Bitrix\Main\Loader::includeModule('sng.secure');
DeleteDirFilesEx("/bitrix/managed_cache/MYSQL/");

$module_id = 'sng.secure';

$aTabs = array(
	array('DIV' => 'edit1', 'TAB' => GetMessage('SNG_SECURE_SETTINGS'), 'TITLE' => GetMessage('MAIN_TAB_TITLE_SET'))	
); 
$tabControl = new CAdminTabControl('tabControl', $aTabs);
$tabControl->Begin();

$path = COption::GetOptionString('sng.secure', 'path', "");
if(!strlen($path)>0)
{
	$path = $_SERVER['DOCUMENT_ROOT'];
}
?>
<?=bitrix_sessid_post();?>
<?$tabControl->BeginNextTab();?>
<table width="100%">
	<tr class="field-str">
		<td align="left" valign='middle' width='50%'>
			<div style="text-align:left;"><a href="https://www.sng-it.ru" target="new" style="text-decoration:none;"><img src="/bitrix/images/sng.secure/logo_sng.png" width="137" height="43" alt="www.sng-it.ru"></a></div> 
		</td>
		 <td valign='middle' width='50%'>		 
		 <?=GetMessage('SNG_SECURE_DESCRIPTION')?> 
		 </td>
	</tr>	
	
	<tr class="field-str">
		<td valign='middle' width='50%' class='field-name'><?=GetMessage('SNG_SECURE_PATH')?>: &nbsp;<input type="text" size="35" maxlength="255" value="<?=$path;?>" name="secure_path" id="secure_path"></td>
		<td valign='middle' width='50%'>
			<input style="padding: 5px 30px; height:auto;font-size:16px;" type="button" title="<?echo GetMessage("SNG_START_SECURE")?>" OnClick="StartSecure();" value="<?echo GetMessage("SNG_START_SECURE")?>">
		</td>
	</tr>	
	
	<tr class="field-str">
		<td valign='middle' width='50%' class='field-name'><br><?echo GetMessage("SNG_SECURE_EX_TITLE")?></td>
		<td valign='middle' width='50%'><br>			
			<div id="secure_exeptions">
				<?
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
				
			</div>
			<input style="padding: 5px 10px; height:auto; font-size:14px; font-weight:500;" type="button" title="<?echo GetMessage("SNG_SECURE_EX_ADD")?>" OnClick="AddExeption();" value="<?echo GetMessage("SNG_SECURE_EX_ADD")?>">
			<input style="padding: 5px 10px; height:auto; font-size:14px; font-weight:500;" type="button" title="<?echo GetMessage("SNG_SECURE_EX_SAVE")?>" OnClick="SaveExeption();" value="<?echo GetMessage("SNG_SECURE_EX_SAVE")?>">
		</td>
	</tr>	
	
</table>
	<div id="secure_loader" style="display:none;text-align:center;">
		<?echo GetMessage("SNG_SECURE_LOADER_TEXT")?>
		<img src="/bitrix/images/sng.secure/loader.gif" width="60" height="60" alt="loader">
	</div>
	<div id="secure_result_count_block" style="display:none;text-align:center;margin-bottom:20px;"><?echo GetMessage("SNG_SECURE_COUNT");?> <span id="secure_result_count"></span></div>
<div id="secure_result">
	<?
	$arTable = unserialize(COption::GetOptionString("sng.secure", "last_search", ""));
	
	if(!empty($arTable))
	{
	?>
	<br>
	<table style="width:100%;" id="table_secure">
		<tr>
		<td style="width:150px;"><b><?echo GetMessage("SNG_SECURE_TABLE_DATE")?></b></td>
		<td><b><span style="width:180px;display:inline-block"><?echo GetMessage("SNG_SECURE_TABLE_TYPE")?></span> <?echo GetMessage("SNG_SECURE_TABLE_FILE")?></b></td>
		
		</tr>
		<?
		foreach($arTable as $key => $value)
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
		?>
	</table> 
	<style>
	#table_secure td{border-collapse:collapse;border: 1px solid #C4CED2 !important; margin-top:1px;margin-right:1px;}
	</style>
	<?/*?>
	<div class="adm-info-message-wrap adm-info-message-red" style="text-align:center;">
		<br>
		<div class="adm-info-message" style="margin: 0 auto"><?echo GetMessage("SNG_SECURE_SEND");?><div class="adm-info-message-icon"></div></div>
		<br>
		<br>
		<div style="background-color: #e0e8ea;font-size: 14px;padding: 8px 4px 10px!important;font-weight: bold;"><?echo GetMessage("SNG_SECURE_SEND_BLOCK");?></div>
		<br><br>
		<form action="send.php">
			<input type="text" placeholder="Ваше Имя" style="margin-bottom:10px;"><br>
			<input type="text" placeholder="Ваш E-mail" style="margin-bottom:10px;"><br>
			<input type="submit" value="Отправить заявку"><br>
		</form>		
	</div>	
	<?*/
	?><br><b style="color:red;"><?echo GetMessage("SNG_SECURE_SEND");?></b><br><?
	echo GetMessage("SNG_SECURE_SEND_BLOCK");
	}
	?>	
</div>

<?echo GetMessage("SNG_SECURE_REGULAR");?>
<script>	
	function SaveExeption(){	
		var arr = document.getElementsByClassName('secure_exeptions_i'),
		len = arr.length,
		data_exeptions = [];
		for (var i=0; i < len; i++){
		  data_exeptions.push(arr[i].value);
		}
		
		BX.ajax({ 
			url: '/bitrix/admin/<?=$module_id?>_save_ex.php', 
			data: {'secure_exeptions': data_exeptions}, 
			method: 'POST',
			async: true,		 
            //dataType: 'json',			
			onsuccess: function(data)
			{
				document.getElementById('secure_exeptions').innerHTML = data;					
			}			 
		});	
	}

	function AddExeption(){
		var node = document.createElement("div");  
		node.innerHTML += '<input class="secure_exeptions_i" type="text" size="35" maxlength="255" value="" name="secure_ex[]"><br>';  
		document.getElementById("secure_exeptions").appendChild(node);
	}
	
	function Preloader(fl, id)
	{		
		if(fl == true)			
			document.getElementById(id).style.display = "block";			
		else
			document.getElementById(id).style.display = "none";
	}	
	function StartSecure()
	{	
		Preloader(true,'secure_loader');
		sendreq('');
	}	
	
	var count;
	count = 0;
	
	function sendreq(file, countF)
	{	 
		BX.ajax({ 
			url: '/bitrix/admin/<?=$module_id?>_ajax.php', 
			data: {'secure_path': document.getElementById('secure_path').value, 'file':file, 'countF': countF}, 
			method: 'POST',
			async: true,		 
            dataType: 'json',			
			onsuccess: function(data)
			{
				document.getElementById('secure_result_count_block').style.display = "block";

				if(data.status=='progress'){	
					count = Number(data.count); 
					document.getElementById('secure_result_count').innerHTML = count;				
					sendreq(data.file, count);					
				}
				else if(data.status=='done'){
					Preloader(false,'secure_loader');					
					document.getElementById('secure_result_count').innerHTML = data.count;		
					ShowResult();
				}
			}			
		});		
	}	
	function ShowResult()
	{	
		BX.ajax({ 
			url: '/bitrix/admin/<?=$module_id?>_result.php', 
			method: 'POST',
			async: true,		 
			onsuccess: function(data)
			{
				document.getElementById('secure_result').innerHTML = data;						
			}			
		});		
	}	
</script>
<?
$tabControl->Buttons();
$tabControl->End();
CUtil::InitJSCore(Array("jquery"));
?>		