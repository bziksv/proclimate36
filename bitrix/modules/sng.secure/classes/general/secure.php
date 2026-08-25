<?
Class CSNGSecure 
{	
	static $var = '\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*';
	static $spaces = "[ \r\t\n]*";
	static $arLinks = array("linkfeed.ru", 
	"sape.ru", 
	"linkbuilder.su",
	"zenlink.ru",
	"crowdlinks.ru",
	"zapostim.ru",
	"rookee.ru",
	"seowizard.ru",
	"linkum.ru",
	"linkparty.ru",
	"advego.ru",
	"mainlink.ru",
	"setlinks.ru",
	"collaborator.pro",
	"miralinks.ru",
	"gogetlinks.net",
	"gogettop.ru",
	"blogun.ru",
	"prnews.io", 
	"seopult.ru",
	"megaindex.ru",
	"webeffector.ru",
	"rookee.ru",
	"seowizard.ru");	
	
	static $arLinksPhiten = array("LinkfeedClient");	
	
	static $arExeptions = array(
	"/bxu/main/.access.php",	
	"/bitrix/cache/",
	"/bitrix/modules/sng.secure/",
	"/bitrix/managed_cache/",
	"/bitrix/modules/bitrix.xscan/",
	"/bitrix/modules/main/classes/general/update_class.php",
	"/bitrix/modules/main/classes/general/file.php",
	"/bitrix/modules/main/classes/general/update_client.php",
	);	

	
	public static function searchPhp($dirname, $file_path, $countEl, $type = "ajax")
	{
		$max_ex_time = 10;
		
		$fileinfos = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($dirname)
		);

		$limit = new LimitIterator($fileinfos, $countEl);
		
		$arEx = unserialize(COption::GetOptionString("sng.secure", "exeptions", ''));
		$arExeptions = array();
	
		foreach(self::$arExeptions as $k => $v){	
			$arExeptions[] = $v;
		}
		foreach($arEx as $k => $v){	
			$arExeptions[] = $v;
			
		}		
		
		foreach ($limit as $file =>  $ar)  
		{	
			$countEl++;			
				$flagEx = 0;
				
				if(!empty($arExeptions))
				{
					foreach($arExeptions as $k => $v)
					{				
						if(preg_match("#".$v."#", $file))
						{
							$flagEx = 1;
						}
					}	
				}	

					
				if ($file != '.' && $file != '..' && !$flagEx) {
				
					// не добавл€ем Ђне файлыї Ч это каталоги и ссылки
					if (is_file($file) 
					&& preg_match("#\.php#",$file) 
					)					
					{ 	
					
						//сразу делаем проверку файла, если найден подозрительный код, то записываем файл в сессию
					
						if($result = self::CheckFile($file))
						{	
				
							$_SESSION['SNG_SECURE'][filemtime($file)][$file] = $result;
							
						}
							
							
					}
				}
/*file_put_contents(
                        $_SERVER["DOCUMENT_ROOT"]."/log_secure.txt", 
                        date('d m o, H:i:s') . ' - '.filemtime($file).' - '.$file. ' - '.$result.$countEl. PHP_EOL,
                        FILE_APPEND
                    );	
*/					
						if(intval(getmicrotime()-START_EXEC_TIME)>$max_ex_time && $file && $type == "ajax")
						{
								global $number;
								$number = $countEl;
								return $file;
						}					
		}
		
		global $number;
		$number = $countEl;
								
		return false;
	}
	
	static function StatVulnCheck($str, $bAll = false)
	{
		$regular = $bAll ? '#\$?[a-z_]+#i' : '#'.self::$var.'#';
		if (!preg_match_all($regular, $str, $regs))
			return false;
		$ar0 = $regs[0];
		$ar1 = array_unique($ar0);
		$uniq = count($ar1)/count($ar0);

		$ar2 = array();
		foreach($ar1 as $var)
		{
			if ($bAll && function_exists($var))
				$p = 0;
			elseif ($bAll && preg_match('#^[a-z]{1,2}$#i', $var))
				$p = 1;
			elseif (preg_match('#^\$?(function|php|csv|sql|__DIR__|__FILE__|__LINE__|DBDebug|DBType|DBName|DBPassword|DBHost|APPLICATION)$#i', $var))
				$p = 0;
			elseif (preg_match('#__#', $var))
				$p = 1;
			elseif (preg_match('#^\$(ar|str)[A-Z]#', $var, $regs))
				$p = 0;
			elseif (preg_match_all('#([qwrtpsdfghjklzxcvbnm]{3,}|[a-z]+[0-9]+[a-z]+)#i', $var, $regs))
				$p = strlen(implode('',$regs[0]))/strlen($var) > 0.3;
			else
				$p = 0;

			$ar2[] = $p;
		}
		$prob = array_sum($ar2)/count($ar2);
		if ($prob < 0.3)
			return false;

		if (!$bAll)
			return self::StatVulnCheck($str, true);

		return true;
	}

	
	public static function CheckFile($f)
	{
		global $LAST_REG;

		# CODE 110
		if (preg_match('#^/upload/.*\.php$#',str_replace($_SERVER['DOCUMENT_ROOT'], '' ,$f)))
		{
			return '[110] php file in upload dir';
		}

		if (!preg_match('#\.php$#',$f,$regs))
			return false;

		# CODE 200
		if (false === $str = file_get_contents($f))
			return '[200] read error';

		$str = preg_replace('#/\*.*?\*/#s', '', $str);
		$str = preg_replace('#[\r\n][ \t]*//.*#m', '', $str);
		$str = preg_replace('/[\r\n][ \t]*#.*/m', '', $str);

		# CODE 300
		if (preg_match('#[^a-z:](eval|assert|create_function|ob_start)'.self::$spaces.'\(([^\)]*)\)#i', $str, $regs))
		{
			$LAST_REG = $regs[0];
			if (preg_match('#\$(GLOBALS|_COOKIE|_GET|_POST|_REQUEST|[a-z_]{2,}[0-9]+)#', $regs[2],$regs))
			{
				return '[300] eval';
			}
		}

		# CODE 350
		if (preg_match('#'.self::$var.self::$spaces.'='.self::$spaces.'\$(GLOBALS|_COOKIE|_GET|_POST|_REQUEST)'.self::$spaces.'[^\[]#', $str,$regs))
		{
			$LAST_REG = $regs[0];
			if (self::StatVulnCheck($str))
				return '[350] global vars manipulation';
		}

		# CODE 400
		if (preg_match('#\$(USER|GLOBALS..USER..)->Authorize'.self::$spaces.'\([0-9]+\)#i', $str, $regs))
		{
			$LAST_REG = $regs[0];
			return '[400] bitrix auth';
		}

		# CODE 500
		if (preg_match('#[\'"]php://filter#i', $str, $regs))
		{
			$LAST_REG = $regs[0];
			return '[500] php wrapper';
		}

		# CODE 600
		if (preg_match('#(include|require)(_once)?'.self::$spaces.'\([^\)]+\.([a-z0-9]+).'.self::$spaces.'\)#i', $str, $regs))
		{
			$LAST_REG = $regs[0];
			if ($regs[3] != 'php')
				return '[600] strange include';
		}

		# CODE 610
		if (preg_match('#\$__+[^a-z_]#i', $str, $regs))
		{
			$LAST_REG = $regs[0];
			return '[610] strange vars';
		}

		# CODE 615
		if (preg_match('#\${["\']\\\\x[0-9]{2}[a-z0-9\\\\]+["\']}#i', $str, $regs))
		{
			$LAST_REG = $regs[0];
			return '[615] hidden vars';
		}


		# CODE 620
		if (preg_match('#\$['."_\x80-\xff".']+'.self::$spaces.'=#i', $str, $regs))
		{
			$LAST_REG = $regs[0];
			return '[620] binary vars';
		}

		# CODE 630
		if (preg_match('#[a-z0-9+=/\n\r]{255,}#im', $str, $regs))
		{
			$LAST_REG = $regs[0];
			if (!preg_match('#data:image/[^;]+;base64,[a-z0-9+=/]{255,}#i', $str, $regs))
				return '[630] long line';
		}

		# CODE 640
		if (preg_match('#exif_read_data\(#i', $str, $regs))
		{
			$LAST_REG = $regs[0];
			return '[640] strange exif';
		}

		# CODE 650
		if (preg_match('#[^\\\\]'.self::$var.self::$spaces.'\(#i', $str, $regs))
		{
			$LAST_REG = $regs[0];
			if (self::StatVulnCheck($str))
				return '[650] variable as a function';
		}

		# CODE 660
		if (preg_match('#'.self::$var.'('.$spaces.'\[[\'"]?[a-z0-9]+[\'"]?\])+'.$spaces.'\(#i', $str, $regs))
		{
			$LAST_REG = $regs[0];
			if (self::StatVulnCheck($str))
				return '[660] array member as a function';
		}

		# CODE 663
		if (preg_match("#^.*([\x01-\x08\x0b\x0c\x0f-\x1f])#m", $str, $regs))
		{
			$LAST_REG = $regs[1];
			if (!preg_match('#^\$ser_content = #', $regs[0]))
				return '[663] binary data';
		}

		# CODE 665
		if (preg_match_all('#(\\\\x[a-f0-9]{2}|\\\\[0-9]{2,3})#i', $str, $regs))
		{
			$LAST_REG = implode(" ", $regs[1]);
			if (strlen(implode('', $regs[1]))/filesize($f) > 0.1)
				return '[665] chars by code';
		}

		# CODE 700
		if (preg_match('#file_get_contents\(\$[^\)]+\);[^a-z]*file_put_contents#mi', $str, $regs))
		{
			$LAST_REG = $regs[0];
			return '[700] file from variable';
		}

		# CODE 710
		if (preg_match('#file_get_contents\([\'"]https?://#mi', $str, $regs))
		{
			$LAST_REG = $regs[0];
			return '[710] file from the Internet';
		}
 
		# CODE 800
		if (preg_match('#preg_replace\(\$_#mi', $str, $regs))
		{
			$LAST_REG = $regs[0];
			return '[800] preg_replace pattern from variable';
		}
		
		# CODE 801
		if (preg_match('#wp-admin#', $str, $regs))
		{
			$LAST_REG = $regs[0];
			return '[801] wp-admin';
		}	
		
		foreach(self::$arLinksPhiten as $key => $link)
		{	
			if (preg_match("#".$link."#", $str, $regs))
			{
				$LAST_REG = $regs[0];
				return '['.$link.'] '.$link;
			}
		}
		
		# CODE 805
		foreach(self::$arLinks as $key => $link)
		{	
			if (preg_match("#".$link."#", $str, $regs))
			{
				$LAST_REG = $regs[0];
				return '[805] link stock';
			}
		}	
		
		# CODE 670
		if (preg_match('#('.self::$var.')'.$spaces.'\('.$spaces.self::$var.'#i', $str, $regs))
		{
			$LAST_REG = $regs[0];
			$src_var = $regs[1];
			while(preg_match('#\$'.str_replace('$', '', $src_var).$spaces.'='.$spaces.'('.self::$var.')#i', $str, $regs))
			{
				$src_var = str_replace('$', '', $regs[1]);
			}
			if (preg_match('#^(GLOBAL|_COOKIE|_GET|_POST|_REQUEST)$#', $src_var))
				return '[670] function from global var';
		}

		# CODE END
	
		return false;
	}	
	
}
?>