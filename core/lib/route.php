<?php
	namespace core\lib;
	use core\lib\conf;
	class route {
		public $ctrl; //控制器变量
		public $action; //方法变量
		public function __construct () {
			// url处理
			// xxx.com/index.php/index
			/*
				1.隐藏index.php
				2.获取url参数 参数的形式（控制器名/方法名）
				3.返回对应的控制器和方法
			*/
				// $_SERVER包含了服务器的所有信息
				// p($_SERVER['REQUEST_URI']);
				// exec();
			// 2.
			if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
				// 判断参数是否存在
				// 解析：参数/参数
				$path = $_SERVER['REQUEST_URI'];
				// explode用来分割字符串
				$patharr = explode('/', trim($path,'/'));
				if (isset($patharr[0])) {
					$this->ctrl = $patharr[0];
					// 判断是否存在控制器名
				}
				unset($patharr[0]);
				// 判断是否存在方法名
				if (isset($patharr[1])) {
					$this->action = $patharr[1];
					unset($patharr[1]);
				} else {
					$this->action = conf::get('ACTION', 'route');
				}
				// 将url多余部分（也就是除过控制器名和方法名剩下的部分）转换为GET参数
				// id/1/str/2/test/3
				$conut = count($patharr) + 2;
				$i = 2;
				while($i<$conut) {
					if (isset($patharr[$i+1])) {
						$_GET[$patharr[$i]] = $patharr[$i+1];
					}
					$i = $i + 2;
				}
				// p($_GET);
			} else {
				$this->ctrl = conf::get('CTRL', 'route');
				$this->action = conf::get('ACTION', 'route');
			}
		}
	}
?>