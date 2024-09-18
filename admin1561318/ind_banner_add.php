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
<form id="form1" name="form1" method="post" action="ind_banner_add_ok.php" enctype="multipart/form-data" onsubmit="return checkform();">			
			<div class="module_content">
					<fieldset>
						<div style="float:left;width:100%;margin-top: 15px;" class="billing">
							<span style="float:left;margin-left: 9px;width: 100%;">標題：　　</span><br>
							<input type="text" name="title"  id="title"  required="required" data-error="必須填寫標題" ><br><br>
							<span style="float:left;margin-left: 9px;width: 100%;">超連結：　　</span><br>
							<input type="text" name="link"  id="link"  >
							<br><br>
							<span style="float:left;margin-left: 9px;width: 100%;margin-top:12px;">圖片：　　寬:1200px,高400px</span><br>
					　　　　　<input name="imgfile" type="file" id="imgfile" size="40" onChange="chkfile(this);" accept="image/gif, image/jpeg, image/png" required/><br>
						</div>
						<div class="submit_link">
							<br><br><input type="submit" value="送出" class="alt_btn">
						</div>
					</fieldset>
					<br>
					<div class="clear"></div>

			</div>
		</form>
