<?PHP
if (!isset($_SESSION)) {
 	 session_start();
}

include "./common.func.php";

$edit_no	=	$_GET['no'];

$sql="SELECT * 
FROM `news` 
where news_no=:edit_no;";

$result = $db->prepare("$sql");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
$result->bindValue(':edit_no', $edit_no, PDO::PARAM_INT);
$result->execute();
$rows = $result->fetch(PDO::FETCH_ASSOC);
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
<form id="form1" name="form1" method="post" action="ind_unboxing_edit_ok.php" enctype="multipart/form-data" onsubmit="return checkform();">			
			<div class="module_content">
					<fieldset>
						<div style="float:left;width:100%;margin-top: 15px;" class="billing"><input type="hidden" name="edit_no" value="<?=$edit_no?>">
							<span style="float:left;margin-left: 9px;width: 100%;">標題：　　</span><br>
							<input name="title" type="text"  required="required"  id="title" value="<?=$rows["news_title"]; ?>" data-error="必須填寫標題" ><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;">簡述：　　</span><br>
							<textarea name="title_en" wrap="virtual" id="title_en"  style="height:60px;"required="required" data-error="必須填寫簡述"><?=$rows["news_title_en"]; ?></textarea>
							<br><br>
							  
   		<span style="float:left;margin-left: 9px;width: 100%;">目前圖片：</span></br>    		
    	<span style="float:left;margin-left: 9px;width: 100%;"><img src="./goods_pic/<?=$rows["news_pic_s"]; ?>"  height="150" border="1"  ></span></br>  
   	 	
     
							<span style="float:left;margin-left: 9px;width: 100%;margin-top:12px;">圖片：　　寬:440px,高440px</span><br>
					　　　　　<input name="imgfile" type="file" id="imgfile" size="40" onChange="chkfile(this);" accept="image/gif, image/jpeg, image/png" /><br><br>							
							<span style="float:left;margin-left: 9px;width: 100%;">內文：　　</span><br>
							<textarea name="content" wrap="virtual" id="content"  style="height:100px;" ><?=$rows["news_content"]; ?></textarea>
						</div>
						<div class="submit_link">
							<br><br><input type="submit" value="送出" class="alt_btn">
						</div>
					</fieldset>
					<br>
					<div class="clear"></div>

			</div>
		</form>
		
<!-- 啟用 tinymce--> 
<script src="/tiny_mce/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: "#content,#content_en",
    height: '300px',
	//selector: "#textarea,#textarea2",//單獨選擇id
    theme : "modern",
	fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
    language : "zh_TW" ,
    plugins: [
    "advlist autolink lists link image charmap print preview anchor colorpicker textcolor lineheight",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table contextmenu paste jbimages youTube",
  ],
	

  toolbar: "insertfile undo redo | styleselect | bold italic strikethrough forecolor backcolor | fontselect | fontsizeselect | lineheightselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages youTube | code",
  relative_urls: false
});
	
</script>
<!-- 啟用 tinymce--> 

