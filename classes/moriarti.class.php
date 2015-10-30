<?php

class Moriarti {
	private static $dispatch = array();
	private static $vars = array();
	private static $loaded = false;

  public static function register($priority,$type,$func) {
		//echo ' ---- register ' . $type . '<br/>';
	  self::$dispatch[$priority][$type][] = $func;
  }

	private static function loadDirectoryRecursive($dir) {
		foreach (glob("$dir/*.php") as $filename) {
			include $filename;
		}
		foreach (glob("$dir/*",GLOB_ONLYDIR) as $filename) {
			// exclude all php in layout dirs
			if (fnmatch("*/layout*",$filename)) continue;
			if (fnmatch("*plugins",$dir)) {
				// all plugins root dir
				$settingsFileName = $filename . '/settings.json';
				if (file_exists($settingsFileName)) {
					$settings = json_decode(file_get_contents($settingsFileName),true);
					// if plugin is not enabled, don't load it
					if (isset($settings['enabled']) && !$settings['enabled']) continue;
					self::store("plugins/" . $settings['name'],$settings);
				}
			}
			self::loadDirectoryRecursive($filename);
		}

		/* NOTE: This approach is very much slower since layout include a lot of folders
		$directory = new RecursiveDirectoryIterator($dir);
		$recIterator = new RecursiveIteratorIterator($directory);
		$regex = new RegexIterator($recIterator, '/^.+\.php$/i');

		foreach($regex as $item) {
			// not include php in layout (templates)
			if (strrpos($item->getPathname(),"layout")) continue;

			$settingsFileName = dirname($item) . '/settings.json';
			if (file_exists($settingsFileName)) {
				$settings = json_decode(file_get_contents($settingsFileName),true);
				// if plugin is not enabled, don't load it
				if (isset($settings['enabled']) && !$settings['enabled']) continue;
				self::store("plugins/" . $settings['name'],$settings);
			}
			include $item->getPathname();
			echo $item->getPathname() . '<br/>';
		}
		*/
	}

	private static function cargar() {
		if (! self::$loaded) {
			self::loadDirectoryRecursive(dirname(__FILE__) . '/../app');
			self::loadDirectoryRecursive(dirname(__FILE__) . '/../plugins');
			self::$loaded = true;
		}
	}

  public static function sendDeferred($seconds,$tipo) {
	  //echo "send deferred $seconds $tipo";
	  //exec("php include/sendDeferred.php $seconds $tipo > /var/www/srvmobizlecom/include/txt.txt &");
	  exec("php include/sendDeferred.php $seconds $tipo > /dev/null 2> /dev/null &");
  }

	public static function storeArr($name,$value) {
		if (!isset(self::$vars[$name])) {
			self::$vars[$name] = [];
		}

		self::$vars[$name][] = $value;
	}

	public static function store($name,$value) {
		self::$vars[$name] = $value;
	}

	public static function get($name) {
		return self::$vars[$name];
	}

	public static function getArr($name) {
		if (isset(self::$vars[$name])) {
			return self::$vars[$name];
		} else {
			return [];
		}
	}

  public static function dispatch($message,$datos = null) {
		self::cargar();
		for($priority=0;$priority<=10;$priority++) {
			if (isset(self::$dispatch[$priority]) == false) continue;
			foreach(self::$dispatch[$priority] as $key=>$value) {
				if (fnmatch($key, $message->getCode())) {
					foreach($value as $func) {
						//echo '------' . $priority . '-' . $key .'<br/>';
						$time_start = microtime(true);
						$rslt = call_user_func($func,$message->getCode(),$datos);
						$message->setResult($rslt);
						$time_end = microtime(true);
						//Subtract the two times to get seconds
						$time = $time_end - $time_start;
						$message->setDispatchTime($time);
					}
				}
			}
		}
  }


}
?>
