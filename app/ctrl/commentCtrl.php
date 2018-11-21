<?php
  namespace app\ctrl;
  class commentCtrl {
    private $model;
    private $table = 'commentlist';
    public function __construct(){
			$this->model = new \app\model\accountModel(); // 加载模型
    }
    public function publishComment () {
      // 发表评论
      $database = $this->model;
      $data = $database->action(function($database) {
        $moodid = getPostParams('moodid');
        $openid = $_COOKIE['lkey'];
        $commentdetail = getPostParams('commentdetail');
        $database->insertInto($this->table,[
          'moodid'=>$moodid,
          'openid'=>$openid,
          'commentdetail'=>$commentdetail
        ]);
        $database->updateUser('moodlist',[
          'commentNum[+]'=>1
        ], [
          'moodid'=>$moodid
        ]);
        if ($database->has("post", ["user_id" => 2312])){
            return false;
        }
      });
      echo json_encode(array('retCode'=>0,'errCode'=>0, 'data'=>$data));
    }
  }
?>