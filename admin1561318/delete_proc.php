<?php
require_once '../config.php';


if($_SESSION['AdminLogin'] != true ){			//登入檢查，include後記得去掉註解
	header("Location:./index.php");
	exit;
}




switch($ary_get['ct']){





	case '1':

		if(is_numeric($ary_get['pk'])){
			$obj_banner->drop(" pkey = '".$ary_get['pk']."' ");
		}
		header("Location:./index.php?msg=succ_del&".$_SESSION['redirectPageUrl']."");
		exit;

	break;


	case '3':

		if(is_numeric($ary_get['pk'])){
			$obj_news->drop(" pkey = '".$ary_get['pk']."' ");
		}
		header("Location:./index.php?msg=succ_del&".$_SESSION['redirectPageUrl']."");
		exit;

	break;


	case '4':

		if(is_numeric($ary_get['pk'])){
			$obj_category->drop(" pkey = '".$ary_get['pk']."' ");
			$obj_category->drop(" data_pkey = '".$ary_get['pk']."' ");
			$obj_products -> drop(" data_pkey = '".$ary_get['pk']."' ");
		}
		header("Location:./index.php?msg=succ_del&".$_SESSION['redirectPageUrl']."");
		exit;

	break;


	case '5':

		if(is_numeric($ary_get['pk'])){
			$obj_category -> drop(" pkey = '".$ary_get['pk']."' ");
			$obj_products -> drop(" data_pkey = '".$ary_get['pk']."' ");
		}
		header("Location:./index.php?msg=succ_del&".$_SESSION['redirectPageUrl']."");
		exit;

	break;


	case '6':

		if(is_numeric($ary_get['pk'])){
			$obj_products -> drop(" pkey = '".$ary_get['pk']."' ");
		}
		header("Location:./index.php?msg=succ_del&".$_SESSION['redirectPageUrl']."");
		exit;

	break;


	case '7':

		if(is_numeric($ary_get['pk'])){
			$obj_contact -> drop(" pkey = '".$ary_get['pk']."' ");
		}
		header("Location:./index.php?msg=succ_del&".$_SESSION['redirectPageUrl']."");
		exit;

	break;


	case '8':

		if(!$obj_admin -> fetch('*' , " pkey = '".$_SESSION['AdminPkey']."' AND is_main = '1' ")){
			header("Location:./index.php?ct=1&p=1");
			exit;
		}

		if(is_numeric($ary_get['pk'])){
			$obj_admin -> drop(" pkey = '".$ary_get['pk']."' AND is_main != '1' ");
		}
		header("Location:./index.php?msg=succ_del&".$_SESSION['redirectPageUrl']."");
		exit;

	break;

	case '9':

		if(is_numeric($ary_get['pk'])){
			$obj_store -> drop(" pkey = '".$ary_get['pk']."' ");
		}
		header("Location:./index.php?msg=succ_del&".$_SESSION['redirectPageUrl']."");
		exit;

	break;




	default:
		header("Location:./index.php");
		exit;
	break;


}


















?>