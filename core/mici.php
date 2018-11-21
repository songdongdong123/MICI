<?php
	namespace core;
	class mici {
		public static $classMap = array(); //缓存已经加载过的类
		public $assign;
		static public function run () {

			/*
			 *测试日志类
			 *
			 *
			*/
			// \core\lib\log::init();
			// \core\lib\log::log('测试日志类2');
			// // P('DSDD');
			// \core\lib\log::log($_SERVER, 'server'); // 第二个参数为指定文件名

			// phpinfo();
			$route = new \core\lib\route(); // 自动加载路由类
			// p($route);
			$ctrlClass = $route->ctrl; // 根据路由类获取控制器名
			$action = $route->action;  //根据路由类获取方法名
			// p($route);
			// p($ctrlClass);

			// 下面这段是根据我们从路由类中获取到的控制器名去加载对应的控制器类文件
			$ctrlFile = APP.'/ctrl/'.$ctrlClass.'Ctrl.php'; // 拼接控制器类文件的路径
			// p($ctrlFile);
			$ctrlClass = '\\'.MODULE.'\ctrl\\'.$ctrlClass.'Ctrl'; // 根据控制器名拼接对应控制器的命名空间
			if (is_file($ctrlFile)) {  // 判断控制器文件是否存在
				include $ctrlFile; // 因为类文件
				$ctrl = new $ctrlClass(); // 实例化控制器
				// 判断控制器中的方法是否存在
				if (method_exists($ctrl,$action)) {
					$ctrl->$action(); // 根据从路由类中获取的方法，去调用控制器的方法
				} else {
					p("控制器".$ctrlClass."中不存在".$action.'方法；请检查对应文件');
				}
			} else {
				p('控制文件找不到');
			}
		}

		static public function load ($class) {
			// 自动加载类库
			// new \core\route();
			// $class = '\core\route';
			// MICI.'/core/route.php';
			// p($class);
			if (isset($classMap[$class])) {
				return true;
			} else {
				$class = str_replace("\\", "/", $class);
				// 判断当前参数传递过来的文件路径对应的文件是不是一个php文件
				$file = MICI.'/'.$class.'.php';
				if (is_file($file)) {
					// 如果不存在，就去加载这个类文件
					include $file;
					// 加载之后缓存在$classMap中
					self::$classMap[$class] = $class;
				} else {
					return false;
				}
			}
		}

		public function assign($name, $value) {
			$this->assign[$name] = $value;
		}

		public function display ($file) {
			$file = APP.'/views/'.$file;
			if (is_file($file)) {
				extract($this->assign);
				include $file;
			}
		}
	}
?>