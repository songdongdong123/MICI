<?php
	/*
	 *
	 *文件系统
	 *
	*/
	namespace core\lib\drive\log;
	use core\lib\conf;
	class file {
		public $path; // 日志存储位置
		public function __construct () {
			$conf = conf::get('OPTION', 'log');
			$this->path = $conf['PATH'];
		}
		public function log ($message,$file='log') {
			/*
			 *
			 *1.确定文件存储位置是否存在
			 *2.如果不存在新建目录
			 *3.写入日志
			 **
			*/
			// P($this->path);
			if (!is_dir($thia->path.date('YmdH'))) {
				mkdir($this->path.date('YmdH'), '0777', true);
			}
			// $message .= date('Y-m-d H:i:s');
			// P($this->path.$file.'.php');
			// path.data('YmdH').$file.'.php' // 根据时间生成对应目录下的日志文件
			// p($this->path.date('YmdH').'/'.$file.'.php');
			return file_put_contents($this->path.date('YmdH').'/'.$file.'.php', date('Y-m-d H:i:s').json_encode($message).PHP_EOL, FILE_APPEND);
			// FILE_APPEND参数为了防止覆盖
			// PHP_EOL换行符
		}
	}
?>