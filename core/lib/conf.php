<?php
	namespace core\lib;
	class conf {
		static public $conf = array();
		static public function get ($name, $file) {
			// p($name);
			/*
			 *1.判断配置文件是否存在
			 *2.判断配置是否存在
			 *3.缓存配置
			 *
			*/
			if (isset(self::$conf[$file])) {
				return self::$conf[$file][$name];
			} else {
				$path = MICI.'/core/config/'.$file.'.php';
				// p(1);
				if (is_file($path)) {
					$conf = include $path;
					// p($conf);
					if (isset($conf[$name])) {
						self::$conf[$file] = $conf;
						// p($conf[$name]);
						return $conf[$name];
					} else {
						throw new \Exception('找不到配置项'.$name);
					}
				} else {
					throw new \Exception('找不到配置文件'.$file);
				}
			}
		}

		static public function all ($file) {
			// p($file);
			if (isset(self::$conf[$file])) {
				return self::$conf[$file];
			} else {
				$path = MICI.'/core/config/'.$file.'.php';
				if (is_file($path)) {
					$conf = include $path;
					self::$conf[$file] = $conf;
					return $conf;
				} else {
					throw new \Exception('找不到配置文件'.$file);
				}
			}
		}
	}

?>