<?php
  namespace app\ctrl;
  class shareCtrl {
    private $model;
    private $table = 'sharelist';
    public function __construct(){
			$this->model = new \app\model\accountModel(); // 加载模型
    }
    public function getAllShareList () {
      // 获取sharelist列表
      $moodid = getPostParams('moodid');
      $data = $this->model->selectAll($this->table,[
        '[>]account'=>['openid'=>'openid']
      ],[
        $this->table.'.createTime',
        'usermsg'=>[
          'account.nickname',
          'account.avatarUrl'
        ]
        ],[
          'moodid'=>$moodid
        ]);
      echo json_encode(array('retCode'=>0,'errCode'=>0,'data'=>$data));
    }
    public function getAllStarList () {
      // 获取sharelist列表
      $moodid = getPostParams('moodid');
      $data = $this->model->selectAll('starlist',[
        '[>]account'=>['openid'=>'openid']
      ],[
        'starlist.createTime',
        'usermsg'=>[
          'account.nickname',
          'account.avatarUrl'
        ]
        ],[
          'moodid'=>$moodid
        ]);
      echo json_encode(array('retCode'=>0,'errCode'=>0,'data'=>$data));
    }
  }
?>