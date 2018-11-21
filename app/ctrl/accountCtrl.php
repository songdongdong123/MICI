<?php
	namespace app\ctrl;
	use core\lib\conf; // 配置类
	define('WXCXC_CODE_TO_SESSION_URL', 'https://api.weixin.qq.com/sns/jscode2session');
	/**
	 * 用户信息控制器
	 * 小程序秘钥：36dbd815836aa621dd8caec1a9e2f566
	 */
	class accountCtrl{
		private $model;
		public $table = 'account';
		public function __construct(){
			$this->model = new \app\model\accountModel(); // 加载模型
		}
		public function index () {
			$res = $this->model->selectAll();
			echo json_encode(array('retCode'=>0,'errcode'=>0,'data'=>$res));
		}
		public function code2Session () {
			$options= conf::all('wxapp'); // 加载微信小程序配置
			$appid = getPostParams('appid');
			$code = getPostParams('code');
			// 小程序配置不存在
			if (!isset($options['appid'])) {
				echo json_encode(array('retCode'=>1,'errCode'=>1,'msg'=>'小程序配置不存在'));
				return;
			}
			// appid与配置不一致
			if ($options['appid'] != $appid) {
				echo json_encode(array('retCode'=>2,'errCode'=>2,'msg'=>'appid不一致'));
				return;
			}
			$url = WXCXC_CODE_TO_SESSION_URL.'?appid='.$appid.'&secret='.$options[$appid].'&js_code='.$code.'&grant_type=authorization_code';
			$data = json_decode(doHttpRequest($url), true);

			// 获取openID出错
			if(isset($data['errCode'])) {
				echo json_encode(array('retCode'=>3,'errCode'=>$data['errCode'],'msg'=>$data['errmsg']));
			}

			// 将openid写入数据库
			$res = $this->model->checkOpenId($this->table,['openid'],['openid'=>$data['openid']]);
			if (empty($res)) {
				$this->model->insertInto($this->table,['openid'=>$data['openid']]);
			}
			echo json_encode(array('retCode'=>0,'errcode'=>0,'data'=>$data));
		}
		public function wxLogin () {
			// 登录
			$userinfo = getPostParams('userinfo');
			$sessionData = getPostParams('sessionData');
			$openid = getPostParams('openid');
			$userData = json_decode($userinfo, true);
			if (!isset($_COOKIE['lkey'])) {
				setcookie("lkey", $openid, time()+60*60*24);
				// 更新用户数据
				if ($userinfo) {
					$data = $this->model->updateUser($this->table,[
						'avatarUrl'=>$userData['avatarUrl'],
						'city'=>$userData['city'],
						'gender'=>$userData['gender'],
						'nickName'=>$userData['nickName'],
						'province'=>$userData['province']
					],[
						'openid'=>$openid
					]);
				}
			}
			echo json_encode(array('retCode'=>0,'errcode'=>0,'data'=>[]));
		}

		public function CompletionUser () {
			//完善用户信息
			$openid = $_COOKIE['lkey'];
			$phone = getPostParams('phone');
			$address = getPostParams('address');
			$data = $this->model->updateUser($this->table,[
				'phone'=>$phone,
				'address'=>$address
			],[
				'openid'=>$openid
			]);
			if($data) {
				echo json_encode(array('retCode'=>0,'errcode'=>0,'data'=>[]));
			}
    }
	}
?>