<?php
include_once("../config.php");


	
if($_GET['logout'] == 1){

	unset($_SESSION['AdminLogin']);
	header("Location:./index.php");
	exit;
	
}else{

	$ary_data = $obj_admin->fetch('*' , " acc = '".$ary_post['acc']."' ");
	if(!$ary_data){
		header("Location:./index.php?mag=err");
		exit;
	}
	// cmutK5vcNUCyAzyQ
	if( MD5This($ary_post['pwd']) == $ary_data['pwd'] ){
		$ary_DBdata['acc'] = $ary_post['acc'];
		$ary_DBdata['info'] = 'login';
		$ary_DBdata['ip_addr'] = showUserIp();
		$obj_admin_log->create($ary_DBdata);
		$_SESSION['AdminAcc'] = $ary_data['acc'];
		$_SESSION['AdminPkey'] = $ary_data['pkey'];
		$_SESSION['AdminLogin'] = true;
		header("Location:./index.php?ct=1&p=1");
		exit;
	}else{
		// echo Md5This($ary_post['pwd']);
		// echo $ary_data['pwd'];
		// echo '<pre>';
		// print_r($ary_data);
		// print_r($ary_post);
		header("Location:./index.php?mag=err");
		exit;
	}
}


?>