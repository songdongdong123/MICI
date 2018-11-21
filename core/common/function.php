<?php
/*
	输出对应变量或者数组
*/
	function p($var){
		// var_dump($var);
		if(is_bool($var)){
			var_dump($var);
		}else if(is_null($var)){
			var_dump(NULL);
		}else{
			echo "<pre style='position:relative;z-index=1000;padding:10px;border-radius:4px;background:#f5f5f5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;'>".print_r($var, true)."</pre>";
			// print_r($var);
		}
	}
	function getPostParams ($index) {
			if(isset($_POST[$index])){
	      return $_POST[$index];
	    } else if(isset($_GET[$index])){
	      return $_GET[$index];
	    } else{
	      return false;
	    }
	}
	// 用户密码加密
	function md5PassWord ($password) {
		if (!$password) {
			return false;
		}
		return md5(md5($password).'ethanloveyou');
	}

	// 解构数据
	function Deconstruction ($array) {
		$data = array();
		foreach ($array->fetchAll() as $key => $value) {
			$tempArr = array();
			$tempArr["username"] = $value["username"];
			$data[]= $tempArr;
		}
		return $data;
	}

	// 发起http请求
	function doHttpRequest($url, $params = '', $userAgent = ''){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);

		if(!empty($params)){
			curl_setopt($ch, CURLOPT_POST,true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		}
		if(!empty($userAgent)){
			curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);

		curl_close($ch);

		return $data;
	}
?>