<?php
namespace app\model;
use core\lib\model;
// 一般我们会把sql操作放在模型类里面
class accountModel extends model {
	public function selectAll ($table) {
		$ret = $this->select($table, '*');
		return $ret;
	}
	public function insertInto ($table,$params) {
		$ret = $this->insert($table,$params);
		return $ret;
	}
	public function checkOpenId ($table,$params,$where) {
		$ret = $this->select($table,$params,$where);
		return $ret;
	}
	public function updateUser ($table,$params,$where) {
		$ret = $this->update($table,$params,$where);
		return $ret;
	}
}
	
?>