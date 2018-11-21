<?php
	namespace core\lib;
	use core\lib\conf;
	use Medoo\Medoo;
	/** 
	 * 下面是使用medoo框架的模型类
	 * 
	*/

	class model extends Medoo {
		public function __construct () {
			$options = conf::all('database');
			parent::__construct($options);
		}
	}


	/**
	 * 下面是继承pod的模型类
	 */
	// class model extends \PDO {
	// 	public function __construct() {
	// 		// p('数据库链接');
	// 		// $dsn='';
	// 		// $username = '';
	// 		// $password ='';
	// 		$database = conf::all('database');
	// 		// p($database);
	// 		try {
	// 			parent::__construct($database['DSN'],$database['USERNAME'],$database['PASSWORD']);
	// 			parent::exec("SET NAMES 'utf8';"); 
	// 			// phpinfo();
	// 		}catch(\PDOException $e) {
	// 			echo $e->getMessage();
	// 			// p('lianjie ');
	// 		}
	// 	}
	// 	public function insert ($table,$array) {
	// 		$name = '';
	// 		$values = '';
	// 		foreach ($array as $key => $value) {
	// 			$name .= "$key,";
	// 			$values .= "'$value',";
	// 		}
	// 		$name = chop($name, ',');
	// 		$values = chop($values, ',');
	// 		$sql = "INSERT INTO $table($name) VALUES ($values)";
	// 		return $this->exec($sql);
	// 	}
	// 	public function select ($table, $array) {
	// 		$where_condition = '';
	// 		foreach ($array as $key => $value) {
	// 			$where_condition .="$key='$value'AND ";
	// 		}
	// 		$where_condition = chop(chop($where_condition, ' '), 'AND');
	// 		$sql = "SELECT * FROM $table WHERE $where_condition";
	// 		return $this->query($sql);
	// 	}
	// 	public function queryAll ($table) {
	// 		$sql = "SELECT * FROM $table";
	// 		return $this->query($sql);
	// 	}
	// }
?>