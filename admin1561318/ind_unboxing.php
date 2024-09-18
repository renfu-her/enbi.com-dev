<?php
include_once libs.'pageAD.php';
include "./common.func.php";
##$pageNow = (isset($_GET['p']) and $_GET['p'] != '') ? intval($_GET['p']) : 1;
?>

<div class="wrapper">
<?php
include "include/menu.php";
?>
	<div class="page-content">
		<div class="content container">
			<div class="row">
			  <form name="form2" method="post" action="ind_unboxing_sort.php">  
				<div class="col-lg-12">
					<div class="widget">
						<div class="widget-header" style="height: 90px;"> <i class="icon-list-ol"></i>
							<h3>開箱特輯</h3>
							
<a class="btn btn-danger fancybox" data-fancybox-type="iframe" href="ind_unboxing_add.php" style="float: right;margin-top: 14px;margin-right: 40px;">新增</a>

							
							<input type="submit" name="Submit2" value="重新排序" class="btn btn-primary" style="float: right;margin-top: 14px; margin-right: 15px;"/>
						<div style="text-align: right; margin-right: 5px;" >排序方式：數字越小排在越前面(P.S.請輸入半形阿拉伯數字)</div>
						</div>
						
						<div> <?PHP 

		//取得資料新增修改刪除狀態

		if(isset($_GET['msg'])){

			$msg	= $_GET['msg'];

			switch($msg){

				case 'add':

					echo $msg='【資料狀態】：&nbsp;&nbsp;新增成功';

				break;

				case 'updata':

					echo $msg='【資料狀態】：&nbsp;&nbsp;修改成功';

				break;

				case 'del':

					echo $msg='【資料狀態】：&nbsp;&nbsp;刪除成功';

				break;

	}		

}

		?>
					</div>
						<div class="widget-content">
							<div class="body">
								<table class="table table-striped">
									<thead>
										<tr>
											<th  width="80px" align="center" bgcolor="#222222">圖片</th>
											<th align="center" bgcolor="#222222">標題</th>
											<th width="50px" align="center" bgcolor="#222222">排序</th>
										  <th width="150px" align="center" bgcolor="#222222"></th>
										</tr>
									</thead>
									<tbody class="tbodyC">
										<?PHP
										//使用分頁控制必備變數--開始
										include "./include/pages.php";
										$pagesize='30';//設定每頁顯示資料量
										$phpfile = 'index.php?ct=ind_unboxing';//使用頁面檔案
										$page= isset($_GET['page'])?$_GET['page']:1;//如果沒有傳回頁數，預設為第1頁



										//查詢
										$sql="
										SELECT * FROM news
										ORDER BY `news_no` DESC
										";//算總頁數用

										$result = $db->prepare("$sql");//防sql注入攻擊
										// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
										//$result->bindValue(':id', $id, PDO::PARAM_INT);
										$result->execute();
										$counts=$result->rowCount();//算出總筆數

										if ($page>$counts) $page = $counts;//輸入值大於總數則顯示最後頁
										else $page = intval($page);//當前頁面-避免非數字頁碼
										$getpageinfo = page($page,$counts,$phpfile,$pagesize);//將函數傳回給pages.php處理
										$page_sql_start=($page-1)*$pagesize;//資料庫查詢起始資料
										?>
										<?PHP 
										//列出內容
										$no_id=$no_id+$start+(($page-1)*$pagesize);//流水號

										$sql="
										SELECT * FROM news 
										ORDER BY `news_sort` ASC ,`news_no` DESC 
										LIMIT $page_sql_start , $pagesize

										 ";

										$result = $db->prepare("$sql");//防sql注入攻擊
										// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
										//$result->bindValue(':id', $id, PDO::PARAM_INT);
										$result->execute();
										 $counts=$result->rowCount();//算出總筆數

										if($counts<>0){//如果判斷結果有值才跑回圈抓資料
										   while($rows = $result->fetch(PDO::FETCH_ASSOC)) {
										$no_id=$no_id+1;
										?>
										<tr>
											<td style="vertical-align:middle;">
												 <img src="./goods_pic/<?=$rows["news_pic_s"]; ?>" height="60" border="1" style=" border-color:#666666; border-style:solid;" onerror="this.src='../goods_pic/defpic.jpg'" >
											</td>
											<td style="vertical-align:middle;">
												<span style="font-size:16px;"><?=$rows["news_title"]; ?></span>
											</td>
											<td style="vertical-align:middle;">
												 <input type="hidden" name="ck_<?=$rows["news_no"];?>" id="ck_<?=$rows["news_no"];?>" value="<?=$rows["news_sort"];?>">
                      <input name="<?=$rows["news_no"];?>" type="text" id="<?=$rows["news_no"];?>" style="width:40px;" value="<?=$rows["news_sort"];?>">
											</td>
											<td align="right" style="vertical-align:middle;text-align: center;">
												<a class="btn btn-primary btn-xs fancybox" data-fancybox-type="iframe" href="ind_unboxing_edit.php?no=<?=$rows["news_no"];?>">修改</a>
												<a class="btn btn-danger btn-xs" onclick="if(window.confirm('確定要刪除？一旦刪除則無法復原。')) location.href='ind_unboxing_del_ok.php?no=<?=$rows["news_no"];?>&bpic=<?=$rows["news_pic_b"];?>&spic=<?=$rows["news_pic_s"];?>';">刪除</a>
											</td>
										</tr>
										<?php	
										}
										}
										?>
										
									</tbody>
								</table>
								<div class="clearfix">

									<?php
									echo $getpageinfo['pagecode'];//顯示分頁的html代碼
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				</form> 
			</div>
		</div>
	</div>
</div>

 

<div style="display: none;" id="loading" >
		<div class="image">
				<img src="images/ring.svg">
		</div>
</div>
<style>
#loading {
		background-color: #000000;
		display: none;
		height: 100%;
		left: 0;
		position: fixed;
		top: 0;
		width: 100%;
		z-index: 4;
		opacity: 0.8;
}
#loading .image {
		left: 50%;
		margin: -60px 0 0 -60px;
		position: absolute;
		top: 50%;
}



</style>
