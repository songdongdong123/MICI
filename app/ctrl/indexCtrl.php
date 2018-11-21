<?php
	namespace app\ctrl;
	use core\lib\model;
	class indexCtrl extends \core\mici {
		// 在控制器里面加载模型
		public function index () {
			// 数据库模型的类测试
			$model = new model();
			p($model);
			// $data = $model->select('account', '*');
			// echo json_encode(array('retCode'=>0,'errcode'=>0,'data'=>$data));
		}
	}
?>