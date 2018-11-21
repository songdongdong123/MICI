<?php
	namespace core\lib;
	use core\lib\conf;
	class log {
		/*
		 *
		 *1.确定日志存储方式
		 *
		 *2.写日志
		 *
		*/
		static $class;
		static public function init () {
			// p(1);
			// // 确定存储方式
			$drive = conf::get('DRIVE', 'log');
			// p($drive);
			$class = '\core\lib\drive\log\\'.$drive;
			// p($class);
			self::$class = new $class;

		}

		static public function log($name, $file='log') {
			// p($name);
			self::$class->log($name, $file);
		}
	}
?>