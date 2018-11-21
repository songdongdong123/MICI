<?php
  namespace app\ctrl;
  class moodCtrl {
    private $model;
    private $table = 'moodlist';
    public function __construct(){
			$this->model = new \app\model\accountModel(); // 加载模型
    }
    public function getAllMoodList () {
      // 获取mood列表
      $data = $this->model->selectAll($this->table,[
        '[>]account'=>'openid',
        '[<]starlist'=>['moodid'=>'moodid']
      ],[
        $this->table.'.moodid',
        $this->table.'.moodcontent',
        $this->table.'.createTime',
        $this->table.'.starNum',
        $this->table.'.shareNum',
        $this->table.'.commentNum',
        'usermsg'=>[
          'account.nickname',
          'account.avatarUrl',
          'account.gender'
        ],
        'isStar'=>[
          'starlist.moodid'
        ]
        ],[]);
      echo json_encode(array('retCode'=>0,'errCode'=>0,'data'=>$data));
    }
    public function myMoodlist () {
      $openid = $_COOKIE['lkey'];
      $data = $this->model->sellectAllData($this->table, '*', [
        'openid'=>$openid
      ]);
      echo json_encode(array('retCode'=>0,'errCode'=>0,'data'=>$data));
    }
    public function releaseMood () {
      // 发布心愿
      $openid = $_COOKIE['lkey'];
      $moodtitle = getPostParams('moodtitle');
      $moodcontent = getPostParams('moodcontent');
      $data = $this->model->insertInto($this->table,[
        'moodcontent'=>$moodcontent,
        'openid'=>$openid
      ]);
      if($data) {
        echo json_encode(array('retCode'=>0,'errCode'=>0,'data'=>[]));
      } else {
        echo json_encode(array('retCode'=>1,'errCode'=>1,'data'=>[],'msg'=>'发布失败'));
      }
    }
    public function getMoodDetails () {
      // 获取心愿详情
      $database = $this->model;
      $data = $database->action(function($database){
        $moodid = getPostParams('moodid');
        // 获取mood详情
        $res = $database->queryMoodDetail($this->table,[
          '[>]account'=>['openid'=>'openid']
        ],[
          $this->table.'.moodid',
          $this->table.'.moodcontent',
          $this->table.'.createTime',
          $this->table.'.starNum',
          $this->table.'.shareNum',
          $this->table.'.commentNum',
          'usermsg'=>[
            'account.nickname',
            'account.avatarUrl'
          ]
        ],[
          'moodid'=>$moodid
        ]);
        // 默认获取获取评论列表
        $resCommentList = $this->model->selectAll('commentlist',[
          '[>]account'=>['openid'=>'openid']
        ],[
          'commentlist.createTime',
          'commentlist.commentdetail',
          'usermsg'=>[
            'account.nickname',
            'account.avatarUrl'
          ]
          ],[
            'moodid'=>$moodid
          ]);
        if ($database->has("post", ["user_id" => 2312])){
          return false;
        }
        return array(
          'mooddetail'=>$res,
          'commentlist'=>$resCommentList
        );
      });
      if ($data) {
        echo json_encode(array('retCode'=>0,'errCode'=>0,'data'=>$data));
      }
    }
    public function shareMood () {
      // 分享小程序
      $database = $this->model;
      $data = $database->action(function($database){
        $moodid = getPostParams('moodid');
        $openid = $_COOKIE['lkey'];
        $database->insertInto('sharelist', [
          'openid'=>$openid,
          'moodid'=>$moodid
        ]);
        $database->updateUser($this->table,[
          'shareNum[+]'=>1
        ], [
          'moodid'=>$moodid
        ]);
        if ($database->has("post", ["user_id" => 2312])){
          return false;
        }
      });
      if (!$data) {
        echo json_encode(array('retCode'=>0,'errCode'=>0,'data'=>$data));
      }
    }
    public function starMood () {
      // 点赞
      // 分享小程序
      $database = $this->model;
      $data = $database->action(function($database){
        $moodid = getPostParams('moodid');
        $openid = $_COOKIE['lkey'];
        $database->insertInto('starlist', [
          'openid'=>$openid,
          'moodid'=>$moodid
        ]);
        $database->updateUser($this->table,[
          'starNum[+]'=>1
        ], [
          'moodid'=>$moodid
        ]);
        if ($database->has("post", ["user_id" => 2312])){
          return false;
        }
      });
      if (!$data) {
        echo json_encode(array('retCode'=>0,'errCode'=>0,'data'=>$data));
      }
    }
  }
?>