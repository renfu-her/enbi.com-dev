<?php
require_once 'config.php';






// if($ary_get['proc'] == 'contact'){

// 	if(strtolower($ary_post['captcha']) != strtolower($_SESSION['captcha']['code'])){
// 		echo 'captcha';
// 		exit;
// 	}
// 	$ary_DBdata = array(
// 						'uname' => $ary_post['uname'],
// 						'gender' => $ary_post['gender'],
// 						'tel' => $ary_post['tel'],
// 						'email' => $ary_post['email'],
// 						'info' => safe(nl2br($_POST['info'])),
// 						'ip_addr' => showUserIp()
// 		);
// 	if($obj_contact->create($ary_DBdata)){

// 		$ary_gender['1'] = '男';
// 		$ary_gender['2'] = '女';

// 		$mailBody = '
// 		姓名：'.$ary_post['uname'].'<br>
// 		性別：'.$ary_gender[$ary_post['gender']].'<br>
// 		電話：'.$ary_post['tel'].'<br>
// 		email：'.$ary_post['email'].'<br>
// 		填寫日期：'.date('Y-m-d H:i:s').'<br>
// 		內容：'.nl2br($_POST['info']).'<br>
// 		';

// 		send_mail('Enbi與我聯絡 '.date('Y-m-d H:i'),$mailBody,'clouderwang@gmail.com;amiwu2012@gmail.com;win102427@hotmail.com;edison.0350@yahoo.com.tw;amiwu2012@gmail.com');

// 		echo 'succ';
// 	}else{
// 		echo 'err';
// 	}
// 	unset($_SESSION['captcha']);
// 	exit;
// }





// if($ary_get['proc'] == 'captcha'){

// 	include "uploads/captcha/simple-php-captcha.php";
// 	$_SESSION['captcha'] = simple_php_captcha();
// 	echo $_SESSION['captcha']['image_src'];
// 	exit;
// }








