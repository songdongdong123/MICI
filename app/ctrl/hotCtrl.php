<?php
  namespace app\ctrl;
  class hotCtrl {
    private $model;
    private $table = 'hotlist';
    public function __construct(){
			$this->model = new \app\model\accountModel(); // 加载模型
    }
    public function getAllHotList () {
      $data = $this->model->selectAll($this->table,[
        '[>]account'=>['openid'=>'openid']
      ],[
        $this->table.'.moodid',
        $this->table.'.moodtitle',
        $this->table.'.moodcontent',
        $this->table.'.createTime',
        'usermsg'=>[
          'account.nickname',
          'account.avatarUrl'
        ]
      ]);
      echo json_encode(array('retCode'=>0,'errCode'=>0,'data'=>$data));
    }
  }
?>