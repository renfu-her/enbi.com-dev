<?php
require_once '../config.php';


if($_SESSION['AdminLogin'] != true ){			//登入檢查，include後記得去掉註解
	header("Location:./index.php");
	exit;
}








if($ary_post['self_post'] == 33){

	switch($ary_post['ct']){

		case '1':

			$ary_DBdata['title'] = $ary_post['title'];
			$ary_DBdata['url'] = $ary_post['url'];
			$ary_DBdata['type'] = '1';
			if($_FILES['pic']['error'] == 0){
				$pic = pic_upload_proc($_FILES['pic']['name'] ,$_FILES['pic']['tmp_name'] ,'1366' , '643');
				$ary_DBdata['pic'] = $pic;
			}
			if($pic == 'sizeErr'){
				echo '
				<script type="text/javascript">
				alert("圖片尺寸錯誤");
				parent.location.href="index.php?msg=succ_add&'.$_SESSION['redirectPageUrl'].'";
				</script>
				';
				exit;
			}


			if($ary_post['proc'] == 'add'){
				$total_data = $obj_banner -> fetch('count(*) total' , " type = '1' ");
				$ary_DBdata['sort'] = ($total_data['total'] * 5 +200);
				if($obj_banner -> create($ary_DBdata)){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_add&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_DBdata);
					exit;
				}
			}else if($ary_post['proc'] == 'edit'){
				$ary_data = $obj_banner -> fetch('*' , " pkey = '".$ary_post['pk']."' ");
				if($obj_banner -> edit($ary_DBdata , " pkey = '".$ary_post['pk']."' ")){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_edit&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_data ,$ary_DBdata);
					exit;
				}
			}


		break;


		case 'sort_1':

			$total_data = $obj_banner -> fetch('count(*) total' , " type = '1' ");
			$ary_list = explode(',' , $ary_post['data_order'] );
			foreach($ary_list as $key => $value){
				$ary_DBdata = array(
									'sort' => ($total_data['total'] * 5 +100)
				);
				$obj_banner -> edit($ary_DBdata , " pkey = '".$ary_list[$key]."' ");
				unset($ary_DBdata);
				$total_data['total']--;
			}
			echo '
			<script type="text/javascript">
			parent.location.href="index.php?msg=succ_edit&'.$_SESSION['redirectPageUrl'].'";
			</script>
			';
			exit;

		break;


		case '2':

			$ary_DBdata['title'] = $ary_post['title'];
			$ary_DBdata['url'] = $ary_post['url'];
			$ary_DBdata['type'] = '2';
			if($_FILES['pic']['error'] == 0){
				$pic = pic_upload_proc($_FILES['pic']['name'] ,$_FILES['pic']['tmp_name'] ,'1207' , '411');
				$ary_DBdata['pic'] = $pic;
			}
			if($pic == 'sizeErr'){
				echo '
				<script type="text/javascript">
				alert("圖片尺寸錯誤");
				parent.location.href="index.php?msg=succ_add&'.$_SESSION['redirectPageUrl'].'";
				</script>
				';
				exit;
			}


			if($ary_post['proc'] == 'add'){
				$total_data = $obj_banner -> fetch('count(*) total' , " type = '1' ");
				$ary_DBdata['sort'] = ($total_data['total'] * 5 +200);
				if($obj_banner -> create($ary_DBdata)){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_add&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_DBdata);
					exit;
				}
			}else if($ary_post['proc'] == 'edit'){
				$ary_data = $obj_banner -> fetch('*' , " pkey = '".$ary_post['pk']."' ");
				if($obj_banner -> edit($ary_DBdata , " pkey = '".$ary_post['pk']."' ")){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_edit&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_data ,$ary_DBdata);
					exit;
				}
			}


		break;



		case '3':

			$ary_DBdata['title'] = $ary_post['title'];
			$ary_DBdata['newsdate'] = $ary_post['newsdate'];
			$ary_DBdata['info'] = safe(strip_magic_slashes($_POST['info']));
			if($_FILES['pic']['error'] == 0){
				$pic = pic_upload_proc($_FILES['pic']['name'] ,$_FILES['pic']['tmp_name'] ,'587' , '313');
				$ary_DBdata['pic'] = $pic;
			}
			if($pic == 'sizeErr'){
				echo '
				<script type="text/javascript">
				alert("圖片尺寸錯誤");
				parent.location.href="index.php?msg=succ_add&'.$_SESSION['redirectPageUrl'].'";
				</script>
				';
				exit;
			}


			if($ary_post['proc'] == 'add'){
				if($obj_news -> create($ary_DBdata)){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_add&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_DBdata);
					exit;
				}
			}else if($ary_post['proc'] == 'edit'){
				$ary_data = $obj_news -> fetch('*' , " pkey = '".$ary_post['pk']."' ");
				if($obj_news -> edit($ary_DBdata , " pkey = '".$ary_post['pk']."' ")){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_edit&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_data ,$ary_DBdata);
					exit;
				}
			}


		break;


		case '4':

			$ary_DBdata['title'] = $ary_post['title'];
			$ary_DBdata['data_pkey'] = '0';

			if($ary_post['proc'] == 'add'){
				$total_data = $obj_category -> fetch('count(*) total' , " data_pkey = '0' ");
				$ary_DBdata['sort'] = ($total_data['total'] * 5 +200);
				if($obj_category -> create($ary_DBdata)){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_add&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_DBdata);
					exit;
				}
			}else if($ary_post['proc'] == 'edit'){
				$ary_data = $obj_category -> fetch('*' , " pkey = '".$ary_post['pk']."' ");
				if($obj_category -> edit($ary_DBdata , " pkey = '".$ary_post['pk']."' ")){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_edit&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_data ,$ary_DBdata);
					exit;
				}
			}


		break;


		case 'sort_4':

			$total_data = $obj_category -> fetch('count(*) total' , " data_pkey = '0' ");
			$ary_list = explode(',' , $ary_post['data_order'] );
			foreach($ary_list as $key => $value){
				$ary_DBdata = array(
									'sort' => ($total_data['total'] * 5 +100)
				);
				$obj_category -> edit($ary_DBdata , " pkey = '".$ary_list[$key]."' ");
				unset($ary_DBdata);
				$total_data['total']--;
			}
			echo '
			<script type="text/javascript">
			parent.location.href="index.php?msg=succ_edit&'.$_SESSION['redirectPageUrl'].'";
			</script>
			';
			exit;

		break;


		case '5':

			$ary_DBdata['title'] = $ary_post['title'];
			$ary_DBdata['data_pkey'] = $ary_post['data'];

			if($ary_post['proc'] == 'add'){
				$total_data = $obj_category -> fetch('count(*) total' , " data_pkey = '".$ary_post['data']."' ");
				$ary_DBdata['sort'] = ($total_data['total'] * 5 +200);
				if($obj_category -> create($ary_DBdata)){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_add&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_DBdata);
					exit;
				}
			}else if($ary_post['proc'] == 'edit'){
				$ary_data = $obj_category -> fetch('*' , " pkey = '".$ary_post['pk']."' ");
				if($obj_category -> edit($ary_DBdata , " pkey = '".$ary_post['pk']."' ")){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_edit&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_data ,$ary_DBdata);
					exit;
				}
			}


		break;


		case 'sort_5':

			$total_data = $obj_category -> fetch('count(*) total' , " data_pkey = '".$ary_post['data']."' ");
			$ary_list = explode(',' , $ary_post['data_order'] );
			//print_r($ary_list);
			foreach($ary_list as $key => $value){
				$ary_DBdata = array(
									'sort' => ($total_data['total'] * 5 +100)
				);
				$obj_category -> edit($ary_DBdata , " pkey = '".$ary_list[$key]."' ");
				unset($ary_DBdata);
				$total_data['total']--;
			}
			echo '
			<script type="text/javascript">
			parent.location.href="index.php?msg=succ_edit&'.$_SESSION['redirectPageUrl'].'";
			</script>
			';
			exit;

		break;


		case '6':

			$ary_DBdata['title'] = $ary_post['title'];
			$ary_DBdata['data_pkey'] = $ary_post['data'];
			$ary_DBdata['info'] = safe(strip_magic_slashes($_POST['info']));
			if($_FILES['pic']['error'] == 0){
				$pic = pic_upload_proc($_FILES['pic']['name'] ,$_FILES['pic']['tmp_name'] ,'310' , '310');
				$ary_DBdata['pic'] = $pic;
			}
			if($pic == 'sizeErr'){
				echo '
				<script type="text/javascript">
				alert("圖片尺寸錯誤");
				parent.location.href="index.php?msg=succ_add&'.$_SESSION['redirectPageUrl'].'";
				</script>
				';
				exit;
			}


			if($ary_post['proc'] == 'add'){
				$total_data = $obj_products -> fetch('count(*) total' , " data_pkey = '".$ary_post['data']."' ");
				$ary_DBdata['sort'] = ($total_data['total'] * 5 +200);
				if($obj_products -> create($ary_DBdata)){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_add&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_DBdata);
					exit;
				}
			}else if($ary_post['proc'] == 'edit'){
				$ary_data = $obj_products -> fetch('*' , " pkey = '".$ary_post['pk']."' ");
				if($obj_products -> edit($ary_DBdata , " pkey = '".$ary_post['pk']."' ")){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_edit&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_data ,$ary_DBdata);
					exit;
				}
			}


		break;


		case 'sort_6':

			$total_data = $obj_products -> fetch('count(*) total' , " data_pkey = '".$ary_post['data']."' ");
			$ary_list = explode(',' , $ary_post['data_order'] );
			//print_r($ary_list);
			foreach($ary_list as $key => $value){
				$ary_DBdata = array(
									'sort' => ($total_data['total'] * 5 +100)
				);
				$obj_products -> edit($ary_DBdata , " pkey = '".$ary_list[$key]."' ");
				unset($ary_DBdata);
				$total_data['total']--;
			}
			echo '
			<script type="text/javascript">
			parent.location.href="index.php?msg=succ_edit&'.$_SESSION['redirectPageUrl'].'";
			</script>
			';
			exit;

		break;



		case '8':


			if(!$obj_admin -> fetch('*' , " pkey = '".$_SESSION['AdminPkey']."' AND is_main = '1' ")){
				header("Location:./index.php?ct=1&p=1");
				exit;
			}


			$ary_DBdata['acc'] = $ary_post['acc'];
			$ary_DBdata['pwd'] = MD5This($ary_post['pwd']);


			if($ary_post['proc'] == 'add'){
				if($obj_admin -> create($ary_DBdata)){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_add&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_DBdata);
					exit;
				}
			}else if($ary_post['proc'] == 'edit'){
				$ary_data = $obj_admin -> fetch('*' , " pkey = '".$ary_post['pk']."' ");
				if($obj_admin -> edit($ary_DBdata , " pkey = '".$ary_post['pk']."' ")){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_edit&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_data ,$ary_DBdata);
					exit;
				}
			}


		break;



		case '9':

			$ary_DBdata['title'] = $ary_post['title'];
			$ary_DBdata['area'] = $ary_post['data'];
			$ary_DBdata['addr'] = $ary_post['addr'];
			$ary_DBdata['tel'] = $ary_post['tel'];
			$ary_DBdata['fax'] = $ary_post['fax'];
			if($_FILES['pic']['error'] == 0){
				$pic = pic_upload_proc($_FILES['pic']['name'] ,$_FILES['pic']['tmp_name'] ,'644' , '328');
				$ary_DBdata['pic'] = $pic;
			}
			if($pic == 'sizeErr'){
				echo '
				<script type="text/javascript">
				alert("圖片尺寸錯誤");
				parent.location.href="index.php?msg=succ_add&'.$_SESSION['redirectPageUrl'].'";
				</script>
				';
				exit;
			}


			if($ary_post['proc'] == 'add'){
				$total_data = $obj_store -> fetch('count(*) total' , " area = '".$ary_post['data']."' ");
				$ary_DBdata['sort'] = ($total_data['total'] * 5 +200);
				if($obj_store -> create($ary_DBdata)){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_add&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_DBdata);
					exit;
				}
			}else if($ary_post['proc'] == 'edit'){
				$ary_data = $obj_store -> fetch('*' , " pkey = '".$ary_post['pk']."' ");
				if($obj_store -> edit($ary_DBdata , " pkey = '".$ary_post['pk']."' ")){
					echo '
					<script type="text/javascript">
					parent.location.href="index.php?msg=succ_edit&'.$_SESSION['redirectPageUrl'].'";
					</script>
					';
					add_edit_rec($ary_post['ct'] ,$ary_data ,$ary_DBdata);
					exit;
				}
			}


		break;


		case 'sort_9':

			$total_data = $obj_store -> fetch('count(*) total' , " area = '".$ary_post['data']."' ");
			$ary_list = explode(',' , $ary_post['data_order'] );
			//print_r($ary_list);
			foreach($ary_list as $key => $value){
				$ary_DBdata = array(
									'sort' => ($total_data['total'] * 5 +100)
				);
				$obj_store -> edit($ary_DBdata , " pkey = '".$ary_list[$key]."' ");
				unset($ary_DBdata);
				$total_data['total']--;
			}
			echo '
			<script type="text/javascript">
			parent.location.href="index.php?msg=succ_edit&'.$_SESSION['redirectPageUrl'].'";
			</script>
			';
			exit;

		break;


















		case '91':

			$ary_DBdata['info'] = safe(strip_magic_slashes($_POST['info']));

			$ary_data = $obj_story -> fetch('*' , " pkey = '".$ary_post['pk']."' ");
			if($obj_story -> edit($ary_DBdata , " pkey = '".$ary_post['pk']."' ")){
				echo '
				<script type="text/javascript">
				parent.location.href="index.php?msg=succ_edit&'.$_SESSION['redirectPageUrl'].'";
				</script>
				';
				add_edit_rec($ary_post['ct'] ,$ary_data ,$ary_DBdata);
				exit;
			}


		break;







	}

	

}




if($ary_get['proc'] == 'ajax_hide1'){

	if($ary_post['s'] == '1'){
		$ary_DBdata['is_show'] = '1';
	}else{
		$ary_DBdata['is_show'] = '0';
	}
	$ary_data = $obj_product_firclass -> fetch('*' , " pkey = '".$ary_post['pk']."' ");
	if($obj_product_firclass -> edit($ary_DBdata , " pkey = '".$ary_post['pk']."' ")){
		add_edit_rec($ary_post['ct'] ,$ary_data ,$ary_DBdata);

		echo 'succ';
	}
	exit;
}







if($ary_get['proc'] == 'ckeditorUpload'){

	$img = pic_upload_proc($_FILES['upload']['name'],$_FILES['upload']['tmp_name'],0,0);

	$CKEditorFuncNum = isset($_GET['CKEditorFuncNum']) ? $_GET['CKEditorFuncNum'] : 2;
	$fileUrl = $ary_config['ckeditorUploadUrl'].$img;
	echo "<script>window.parent.CKEDITOR.tools.callFunction(". $CKEditorFuncNum .",'" . $fileUrl . "','');</script>";

	exit;
}







if(strstr($ary_get['proc'],"ajax") == false){

?>
<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
<!--[if lt IE 9]>
<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script> 
<link rel="stylesheet" href="css/jquery-ui.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">
	#jui_item_ul{
		padding : 0px;
	}
	#jui_item_ul .jui_item_li {
		border: 3px solid #d4d4d4;
		margin-top: 3px;
		font-size: 12px;
		line-height: 22px;
		background-color: #fff;
		color: #333;
		padding-left: 5px;
		cursor: move;
		list-style-type:none;
	}
	#jui_item_ul .ui-state-highlight {
		background-color: #EDF0FA;
	}
	div.ui-datepicker{
		font-size:12px;
	}
	</style>
<?php
}















switch($ary_get['ct']){



	case '1':



	if($ary_get['proc'] == 'add'){

	}else if($ary_get['proc'] == 'edit'){
		$ary_data = $obj_banner -> fetch('*' , " pkey = '".$ary_get['pk']."' ");
	}
?>  
<script type="text/javascript">
	function checkform () {
		return true;
	}
	$(function(){




		
	});

</script>
		<form id="form1" name="form1" method="post" action="proc.php" enctype="multipart/form-data" onsubmit="return checkform();">
			<input name="ct" type="hidden" value="<?php echo $ary_get['ct']?>" />     
			<input name="proc" type="hidden" value="<?php echo $ary_get['proc']?>" />     
			<input name="self_post" type="hidden" value="33" />
			<input name="pk" type="hidden" value="<?php echo $ary_get['pk']?>" />
			<div class="module_content">
					<fieldset>
						<div style="float:left;width:100%;margin-top: 15px;" class="billing">
							<span style="float:left;margin-left: 9px;width: 100%;">辨識名稱：　　</span><br>
							<input AutoComplete="Off" type="text" style="" name="title" value="<?php echo $ary_data['title']?>"><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;">連結：　　</span><br>
							<input AutoComplete="Off" type="text" style="" name="url" value="<?php echo $ary_data['url']?>"><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;margin-top:12px;">banner：　　寬:1366px,高643px</span><br>
					　　　　　<input AutoComplete="Off" type="file" style="" name="pic" accept="image/*" >
						</div>
						<div class="submit_link">
							<input type="submit" value="送出" class="alt_btn">
						</div>
					</fieldset>
					<br>
					<div class="clear"></div>

			</div>
		</form>
<?php   



	break;


	case 'sort_1':

		

		$ary_data = $obj_banner -> fetchAll('*' , " type = '1' order by sort DESC ");

		

	?>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>  
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>  
	<script>
	$(function() {
		$( "#jui_item_ul" ).sortable({
			placeholder: "ui-state-highlight"
		});

		$( "#jui_item_ul" ).disableSelection();

		$('#save').click(function(){
			$('#data_order').val('');
			$('li').each(function(ind,ele){
				if($('#data_order').val() == ''){
					$('#data_order').val( $(ele).attr('ref') );
				}else{
					$('#data_order').val( $('#data_order').val() + ',' + $(ele).attr('ref') );
				}
			});
			$('#form1').submit();
		});
	});

	</script>
	<span style="color:red;font-size:12px;">請拖曳以調整排序</span>
	<ul id="jui_item_ul">
	<?php
		foreach($ary_data as $value){
	?>
		<li class="jui_item_li" ref="<?php echo $value['pkey']?>">
			<?php echo $value['title']?>
		</li>
	<?php
		}
	?>
	</ul>
	<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" >
		<input name="ct" type="hidden" id="proc" value="<?php echo $ary_get['ct']?>" />
		<input name="self_post" type="hidden" id="self_post" value="33" />
		<input name="data_order" type="hidden" id="data_order" value="" />
		<input type="button" id="save" value="儲存" />
	</form>

	<?php

		exit;

	break;




	case '2':



	if($ary_get['proc'] == 'add'){

	}else if($ary_get['proc'] == 'edit'){
		$ary_data = $obj_banner -> fetch('*' , " pkey = '".$ary_get['pk']."' ");
	}
?>  
<script type="text/javascript">
	function checkform () {
		return true;
	}
	$(function(){




		
	});

</script>
		<form id="form1" name="form1" method="post" action="proc.php" enctype="multipart/form-data" onsubmit="return checkform();">
			<input name="ct" type="hidden" value="<?php echo $ary_get['ct']?>" />     
			<input name="proc" type="hidden" value="<?php echo $ary_get['proc']?>" />     
			<input name="self_post" type="hidden" value="33" />
			<input name="pk" type="hidden" value="<?php echo $ary_get['pk']?>" />
			<div class="module_content">
					<fieldset>
						<div style="float:left;width:100%;margin-top: 15px;" class="billing">
							<span style="float:left;margin-left: 9px;width: 100%;">辨識名稱：　　</span><br>
							<input AutoComplete="Off" type="text" style="" name="title" value="<?php echo $ary_data['title']?>"><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;margin-top:12px;">banner：　　寬:1207px,高411px</span><br>
					　　　　　<input AutoComplete="Off" type="file" style="" name="pic" accept="image/*" ><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;">連結：　　</span><br>
							<input AutoComplete="Off" type="text" style="" name="url" value="<?php echo $ary_data['url']?>"><br>
						</div>
						<div class="submit_link">
							<input type="submit" value="送出" class="alt_btn">
						</div>
					</fieldset>
					<br>
					<div class="clear"></div>

			</div>
		</form>
<?php   



	break;



	case '3':

	if($ary_get['proc'] == 'add'){

	}else if($ary_get['proc'] == 'edit'){
		$ary_data = $obj_news -> fetch('*' , " pkey = '".$ary_get['pk']."' ");
	}
?>
<script src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	function checkform () {
		return true;
	}
	$(function(){

		$( ".newsdate" ).datepicker({ dateFormat: 'yy-mm-dd' });

        CKEDITOR.replace( 'editor1',{
        	filebrowserBrowseUrl: 'upload/browse.php',
        	width:'758px',
        	height:'400px'
    	});


		CKEDITOR.on('dialogDefinition', function( ev ){
			var dialogName = ev.data.name;  
			var dialogDefinition = ev.data.definition;
			     
			switch (dialogName) {  
				case 'image': //Image Properties dialog      
				dialogDefinition.removeContents('Link');
				break;      

				case 'link': //image Properties dialog          
				dialogDefinition.removeContents('upload');   
				break;
			}
		});





	});

</script>

		<form id="form1" name="form1" method="post" action="proc.php" enctype="multipart/form-data" onsubmit="return checkform();">
			<input name="ct" type="hidden" value="<?php echo $ary_get['ct']?>" />     
			<input name="proc" type="hidden" value="<?php echo $ary_get['proc']?>" />     
			<input name="self_post" type="hidden" value="33" />
			<input name="pk" type="hidden" value="<?php echo $ary_get['pk']?>" />
			<div class="module_content">
					<fieldset>
						<div style="float:left;width:100%;margin-top: 15px;" class="billing">
							<span style="float:left;margin-left: 9px;width: 100%;">標題：　　</span><br>
							<input AutoComplete="Off" type="text" style="" name="title" value="<?php echo $ary_data['title']?>" maxlength="32"><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;margin-top:12px;">banner：　　寬:587px,高313px</span><br>
					　　　　　<input AutoComplete="Off" type="file" style="" name="pic" accept="image/*" ><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;">文章日期：　　</span><br>
							<input class="newsdate" AutoComplete="Off" type="text" style="" name="newsdate" value="<?php echo $ary_data['newsdate']?>" ><br><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;">內文：　　</span><br>
							<textarea name="info" id="editor1" style="float: left;width:100%;"><?php echo $ary_data['info']?></textarea>
						</div>
						<div class="submit_link">
							<br><br><input type="submit" value="送出" class="alt_btn">
						</div>
					</fieldset>
					<br>
					<div class="clear"></div>

			</div>
		</form>
<?php   



	break;


	case '4':



	if($ary_get['proc'] == 'add'){

	}else if($ary_get['proc'] == 'edit'){
		$ary_data = $obj_category -> fetch('*' , " pkey = '".$ary_get['pk']."' ");
	}
?>  
<script type="text/javascript">
	function checkform () {
		return true;
	}
	$(function(){




		
	});

</script>
		<form id="form1" name="form1" method="post" action="proc.php" enctype="multipart/form-data" onsubmit="return checkform();">
			<input name="ct" type="hidden" value="<?php echo $ary_get['ct']?>" />     
			<input name="proc" type="hidden" value="<?php echo $ary_get['proc']?>" />     
			<input name="self_post" type="hidden" value="33" />
			<input name="pk" type="hidden" value="<?php echo $ary_get['pk']?>" />
			<div class="module_content">
					<fieldset>
						<div style="float:left;width:100%;margin-top: 15px;" class="billing">
							<span style="float:left;margin-left: 9px;width: 100%;">名稱：　　</span><br>
							<input AutoComplete="Off" type="text" style="" name="title" value="<?php echo $ary_data['title']?>"><br><br>
						</div>
						<div class="submit_link">
							<input type="submit" value="送出" class="alt_btn">
						</div>
					</fieldset>
					<br>
					<div class="clear"></div>

			</div>
		</form>
<?php   



	break;


	case 'sort_4':

		

		$ary_data = $obj_category -> fetchAll('*' , " data_pkey = '0' order by sort DESC ");

		

	?>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>  
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>  
	<script>
	$(function() {
		$( "#jui_item_ul" ).sortable({
			placeholder: "ui-state-highlight"
		});

		$( "#jui_item_ul" ).disableSelection();

		$('#save').click(function(){
			$('#data_order').val('');
			$('li').each(function(ind,ele){
				if($('#data_order').val() == ''){
					$('#data_order').val( $(ele).attr('ref') );
				}else{
					$('#data_order').val( $('#data_order').val() + ',' + $(ele).attr('ref') );
				}
			});
			$('#form1').submit();
		});
	});

	</script>
	<span style="color:red;font-size:12px;">請拖曳以調整排序</span>
	<ul id="jui_item_ul">
	<?php
		foreach($ary_data as $value){
	?>
		<li class="jui_item_li" ref="<?php echo $value['pkey']?>">
			<?php echo $value['title']?>
		</li>
	<?php
		}
	?>
	</ul>
	<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" >
		<input name="ct" type="hidden" id="proc" value="<?php echo $ary_get['ct']?>" />
		<input name="self_post" type="hidden" id="self_post" value="33" />
		<input name="data_order" type="hidden" id="data_order" value="" />
		<input type="button" id="save" value="儲存" />
	</form>

	<?php

		exit;

	break;



	case '5':



	if($ary_get['proc'] == 'add'){

	}else if($ary_get['proc'] == 'edit'){
		$ary_data = $obj_category -> fetch('*' , " pkey = '".$ary_get['pk']."' ");
	}
?>  
<script type="text/javascript">
	function checkform () {
		if( $('input[name="title"]').val() == '' ){
			alert('請輸入子類名稱');
			return false;
		}
		return true;
	}
	$(function(){




		
	});

</script>
		<form id="form1" name="form1" method="post" action="proc.php" enctype="multipart/form-data" onsubmit="return checkform();">
			<input name="ct" type="hidden" value="<?php echo $ary_get['ct']?>" />     
			<input name="proc" type="hidden" value="<?php echo $ary_get['proc']?>" />     
			<input name="self_post" type="hidden" value="33" />
			<input name="pk" type="hidden" value="<?php echo $ary_get['pk']?>" />
			<input name="data" type="hidden" value="<?php echo $ary_get['data']?>" />
			<div class="module_content">
					<fieldset>
						<div style="float:left;width:100%;margin-top: 15px;" class="billing">
							<span style="float:left;margin-left: 9px;width: 100%;">子類名稱：　　</span><br>
							<input AutoComplete="Off" type="text" style="" name="title" value="<?php echo $ary_data['title']?>" >
						</div>
						<div class="submit_link">
							<input type="submit" value="送出" class="alt_btn">
						</div>
					</fieldset>
					<br>
					<div class="clear"></div>

			</div>
		</form>
<?php   



	break;


	case 'sort_5':

		

		$ary_data = $obj_category -> fetchAll('*' , " data_pkey = '".$ary_get['data']."' order by sort DESC ");

		

	?>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>  
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>  
	<script>
	$(function() {
		$( "#jui_item_ul" ).sortable({
			placeholder: "ui-state-highlight"
		});

		$( "#jui_item_ul" ).disableSelection();

		$('#save').click(function(){
			$('#data_order').val('');
			$('li').each(function(ind,ele){
				if($('#data_order').val() == ''){
					$('#data_order').val( $(ele).attr('ref') );
				}else{
					$('#data_order').val( $('#data_order').val() + ',' + $(ele).attr('ref') );
				}
			});
			$('#form1').submit();
		});
	});

	</script>
	<span style="color:red;font-size:12px;">請拖曳以調整排序</span>
	<ul id="jui_item_ul">
	<?php
		foreach($ary_data as $value){
	?>
		<li class="jui_item_li" ref="<?php echo $value['pkey']?>">
			<?php echo $value['title']?>
		</li>
	<?php
		}
	?>
	</ul>
	<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" >
		<input name="ct" type="hidden" id="proc" value="<?php echo $ary_get['ct']?>" />
		<input name="self_post" type="hidden" id="self_post" value="33" />
		<input name="data_order" type="hidden" id="data_order" value="" />
		<input name="data" type="hidden" id="data" value="<?php echo $ary_get['data']?>" />
		<input type="button" id="save" value="儲存" />
	</form>

	<?php

		exit;

	break;



	case '6':

	if($ary_get['proc'] == 'add'){

	}else if($ary_get['proc'] == 'edit'){
		$ary_data = $obj_products -> fetch('*' , " pkey = '".$ary_get['pk']."' ");
	}
?>
<script src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	function checkform () {
		return true;
	}
	$(function(){


        CKEDITOR.replace( 'editor1',{
        	filebrowserBrowseUrl: 'upload/browse.php',
        	width:'758px',
        	height:'400px'
    	});


		CKEDITOR.on('dialogDefinition', function( ev ){
			var dialogName = ev.data.name;  
			var dialogDefinition = ev.data.definition;
			     
			switch (dialogName) {  
				case 'image': //Image Properties dialog      
				dialogDefinition.removeContents('Link');
				break;      

				case 'link': //image Properties dialog          
				dialogDefinition.removeContents('upload');   
				break;
			}
		});





	});

</script>

		<form id="form1" name="form1" method="post" action="proc.php" enctype="multipart/form-data" onsubmit="return checkform();">
			<input name="ct" type="hidden" value="<?php echo $ary_get['ct']?>" />     
			<input name="proc" type="hidden" value="<?php echo $ary_get['proc']?>" />     
			<input name="self_post" type="hidden" value="33" />
			<input name="pk" type="hidden" value="<?php echo $ary_get['pk']?>" />
			<input name="data" type="hidden" value="<?php echo $ary_get['data']?>" />
			<div class="module_content">
					<fieldset>
						<div style="float:left;width:100%;margin-top: 15px;" class="billing">
							<span style="float:left;margin-left: 9px;width: 100%;">標題：　　</span><br>
							<input AutoComplete="Off" type="text" style="" name="title" value="<?php echo $ary_data['title']?>" maxlength="32"><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;margin-top:12px;">列表頁顯示圖片：　　寬:310px,高310px</span><br>
					　　　　　<input AutoComplete="Off" type="file" style="" name="pic" accept="image/*" ><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;">內文：　　</span><br>
							<textarea name="info" id="editor1" style="float: left;width:100%;"><?php echo $ary_data['info']?></textarea>
						</div>
						<div class="submit_link">
							<br><br><input type="submit" value="送出" class="alt_btn">
						</div>
					</fieldset>
					<br>
					<div class="clear"></div>

			</div>
		</form>
<?php   



	break;


	case 'sort_6':

		

		$ary_data = $obj_products -> fetchAll('*' , " data_pkey = '".$ary_get['data']."' order by sort DESC ");

		

	?>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>  
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>  
	<script>
	$(function() {
		$( "#jui_item_ul" ).sortable({
			placeholder: "ui-state-highlight"
		});

		$( "#jui_item_ul" ).disableSelection();

		$('#save').click(function(){
			$('#data_order').val('');
			$('li').each(function(ind,ele){
				if($('#data_order').val() == ''){
					$('#data_order').val( $(ele).attr('ref') );
				}else{
					$('#data_order').val( $('#data_order').val() + ',' + $(ele).attr('ref') );
				}
			});
			$('#form1').submit();
		});
	});

	</script>
	<span style="color:red;font-size:12px;">請拖曳以調整排序</span>
	<ul id="jui_item_ul">
	<?php
		foreach($ary_data as $value){
	?>
		<li class="jui_item_li" ref="<?php echo $value['pkey']?>">
			<?php echo $value['title']?>
		</li>
	<?php
		}
	?>
	</ul>
	<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" >
		<input name="ct" type="hidden" id="proc" value="<?php echo $ary_get['ct']?>" />
		<input name="self_post" type="hidden" id="self_post" value="33" />
		<input name="data_order" type="hidden" id="data_order" value="" />
		<input name="data" type="hidden" id="data" value="<?php echo $ary_get['data']?>" />
		<input type="button" id="save" value="儲存" />
	</form>

	<?php

		exit;

	break;




	case '8':

	if($ary_get['proc'] == 'add'){

	}else if($ary_get['proc'] == 'edit'){
		$ary_data = $obj_admin -> fetch('*' , " pkey = '".$ary_get['pk']."' ");
	}
?>
<script src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	function checkform () {
		return true;
	}
	$(function(){




	});

</script>

		<form id="form1" name="form1" method="post" action="proc.php" enctype="multipart/form-data" onsubmit="return checkform();">
			<input name="ct" type="hidden" value="<?php echo $ary_get['ct']?>" />     
			<input name="proc" type="hidden" value="<?php echo $ary_get['proc']?>" />     
			<input name="self_post" type="hidden" value="33" />
			<input name="pk" type="hidden" value="<?php echo $ary_get['pk']?>" />
			<div class="module_content">
					<fieldset>
						<div style="float:left;width:100%;margin-top: 15px;" class="billing">
							<span style="float:left;margin-left: 9px;width: 100%;">帳號：　　</span><br>
							<input AutoComplete="Off" type="text" style="" name="acc" value="<?php echo $ary_data['acc']?>" ><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;">密碼：　　</span><br>
							<input AutoComplete="Off" type="text" style="" name="pwd" value="" ><br><br>
						</div>
						<div class="submit_link">
							<br><br><input type="submit" value="送出" class="alt_btn">
						</div>
					</fieldset>
					<br>
					<div class="clear"></div>

			</div>
		</form>
<?php   



	break;









	case '9':

	if($ary_get['proc'] == 'add'){

	}else if($ary_get['proc'] == 'edit'){
		$ary_data = $obj_store -> fetch('*' , " pkey = '".$ary_get['pk']."' ");
	}
?>
<script src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	function checkform () {
		return true;
	}
	$(function(){






	});

</script>

		<form id="form1" name="form1" method="post" action="proc.php" enctype="multipart/form-data" onsubmit="return checkform();">
			<input name="ct" type="hidden" value="<?php echo $ary_get['ct']?>" />     
			<input name="proc" type="hidden" value="<?php echo $ary_get['proc']?>" />     
			<input name="self_post" type="hidden" value="33" />
			<input name="pk" type="hidden" value="<?php echo $ary_get['pk']?>" />
			<input name="data" type="hidden" value="<?php echo $ary_get['data']?>" />
			<div class="module_content">
					<fieldset>
						<div style="float:left;width:100%;margin-top: 15px;" class="billing">
							<span style="float:left;margin-left: 9px;width: 100%;">店名：　　</span><br>
							<input AutoComplete="Off" type="text" style="" name="title" value="<?php echo $ary_data['title']?>" maxlength="32"><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;">地址：　　</span><br>
							<input AutoComplete="Off" type="text" style="" name="addr" value="<?php echo $ary_data['addr']?>" maxlength="200"><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;">電話：　　</span><br>
							<input AutoComplete="Off" type="text" style="" name="tel" value="<?php echo $ary_data['tel']?>" maxlength="32"><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;">傳真：　　</span><br>
							<input AutoComplete="Off" type="text" style="" name="fax" value="<?php echo $ary_data['fax']?>" maxlength="32"><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;margin-top:12px;">圖片：　　寬:644px,高328px</span><br>
					　　　　　<input AutoComplete="Off" type="file" style="" name="pic" accept="image/*" ><br><br>
						</div>
						<div class="submit_link">
							<br><br><input type="submit" value="送出" class="alt_btn">
						</div>
					</fieldset>
					<br>
					<div class="clear"></div>

			</div>
		</form>
<?php   



	break;


	case 'sort_9':

		

		$ary_data = $obj_store -> fetchAll('*' , " area = '".$ary_get['data']."' order by sort DESC ");

		

	?>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>  
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>  
	<script>
	$(function() {
		$( "#jui_item_ul" ).sortable({
			placeholder: "ui-state-highlight"
		});

		$( "#jui_item_ul" ).disableSelection();

		$('#save').click(function(){
			$('#data_order').val('');
			$('li').each(function(ind,ele){
				if($('#data_order').val() == ''){
					$('#data_order').val( $(ele).attr('ref') );
				}else{
					$('#data_order').val( $('#data_order').val() + ',' + $(ele).attr('ref') );
				}
			});
			$('#form1').submit();
		});
	});

	</script>
	<span style="color:red;font-size:12px;">請拖曳以調整排序</span>
	<ul id="jui_item_ul">
	<?php
		foreach($ary_data as $value){
	?>
		<li class="jui_item_li" ref="<?php echo $value['pkey']?>">
			<?php echo $value['title']?>
		</li>
	<?php
		}
	?>
	</ul>
	<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" >
		<input name="ct" type="hidden" id="proc" value="<?php echo $ary_get['ct']?>" />
		<input name="self_post" type="hidden" id="self_post" value="33" />
		<input name="data_order" type="hidden" id="data_order" value="" />
		<input name="data" type="hidden" id="data" value="<?php echo $ary_get['data']?>" />
		<input type="button" id="save" value="儲存" />
	</form>

	<?php

		exit;

	break;













	case '91':



	$ary_data = $obj_story -> fetch('*' , " pkey = '".$ary_get['pk']."' ");
?>
<script src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	function checkform () {
		return true;
	}
	$(function(){


        CKEDITOR.replace( 'editor1',{
        	filebrowserBrowseUrl: 'upload/browse.php',
        	width:'758px',
        	height:'400px'
    	});


		CKEDITOR.on('dialogDefinition', function( ev ){
			var dialogName = ev.data.name;  
			var dialogDefinition = ev.data.definition;
			     
			switch (dialogName) {  
				case 'image': //Image Properties dialog      
				dialogDefinition.removeContents('Link');
				break;      

				case 'link': //image Properties dialog          
				dialogDefinition.removeContents('upload');   
				break;
			}
		});





	});

</script>

		<form id="form1" name="form1" method="post" action="proc.php" enctype="multipart/form-data" onsubmit="return checkform();">
			<input name="ct" type="hidden" value="<?php echo $ary_get['ct']?>" />     
			<input name="proc" type="hidden" value="<?php echo $ary_get['proc']?>" />     
			<input name="self_post" type="hidden" value="33" />
			<input name="pk" type="hidden" value="<?php echo $ary_get['pk']?>" />
			<div class="module_content">
					<fieldset>
						<div style="float:left;width:100%;margin-top: 15px;" class="billing">
							<span style="float:left;margin-left: 9px;width: 100%;">內文：　　</span><br>
							<textarea name="info" id="editor1" style="float: left;width:100%;"><?php echo $ary_data['info']?></textarea>
						</div>
						<div class="submit_link">
							<input type="submit" value="送出" class="alt_btn">
						</div>
					</fieldset>
					<br>
					<div class="clear"></div>

			</div>
		</form>
<?php   



	break;





}




function add_edit_rec($page ,$firstData ,$secondData = ''){

	global $obj_admin_log;
	global $_SESSION;

	$ary_AdminData['acc'] = $_SESSION['AdminAcc'];
	$ary_AdminData['ip_addr'] = showUserIp();
	if($secondData){
		$ary_AdminData['info'] = $page.'  '.safe(print_r($firstData, true)).' EDIT '.safe(print_r($secondData, true));
	}else{
		$ary_AdminData['info'] = $page.' ADD '.safe(print_r($firstData, true));
	}
	$obj_admin_log -> create($ary_AdminData);

}



?>