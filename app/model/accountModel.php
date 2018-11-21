<?php
namespace app\model;
use core\lib\model;
// 一般我们会把sql操作放在模型类里面
class accountModel extends model {
	public function selectAll ($table,$join,$columns,$where) {
		$ret = $this->select($table,$join,$columns,$where);
		return $ret;
	}
	public function sellectAllData ($table,$params,$where) {
		$ret = $this->select($table,$params,$where);
		return $ret;
	}
	public function insertInto ($table,$params) {
		// dddssss
		$ret = $this->insert($table,$params);
		return $ret;
	}
	public function checkOpenId ($table,$params,$where) {
		$ret = $this->select($table,$params,$where);
		return $ret;
	}
	public function queryMoodDetail ($table,$join,$params,$where) {
		$ret = $this->get($table,$join,$params,$where);
		return $ret;
	}
	public function updateUser ($table,$params,$where) {
		$ret = $this->update($table,$params,$where);
		return $ret;
	}
}
	
?>