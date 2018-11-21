<?php
	/*
		入口文件
		1.定义常量，
		2.加载函数库，
		3.启动框架
	*/
	/*
		define() 函数定义一个常量。
		常量类似变量，不同之处在于：
		在设定以后，常量的值无法更改
		常量名不需要开头的美元符号 ($)
		作用域不影响对常量的访问
		常量值只能是字符串或数字
	*/
	define('MICI', realpath('./')); // 设置框架的根目录
	define('CORE', MICI.'/core'); //框架核心文件所处的目录
	define('APP', MICI.'/app'); // 项目文件所处的目录（mvc）
	define('MODULE', 'app');
	define('DEBUG', true); // 定义变量用来控制是否在调试状态

	include "vendor/autoload.php";
	if (DEBUG) {
		//设置php错误是否显示
		$whoops = new \Whoops\Run;
		$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
		$whoops->register();
		error_reporting(-1);
		ini_set('display_errors', 1);
	} else {
		ini_set('dispaly_error', 'Off');
	}

	// 加载工具函数库
	include CORE.'/common/function.php';
	// p(MICI);测试函数库
	include CORE.'/mici.php';

	// 作用：当我们实例化一个类的时候，如果这个类不存在，就会触发我们mici类下的load方法
	// 这是一个自动加载函数，在PHP5中，当我们实例化一个未定义的类时，就会触发此函数，帮我们自动加载类文件
	// \core\mici这里是命名空间
	spl_autoload_register('\core\mici::load');
	// 启动框架
	\core\mici::run();
?>
