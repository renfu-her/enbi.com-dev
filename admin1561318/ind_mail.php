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
				<div class="col-lg-12">
					<div class="widget">
						<div class="widget-header"> <i class="icon-list-ol"></i>
							<h3>合作洽談</h3>



						</div>
						<div class="widget-content">
							<div class="body">
								<table class="table table-striped">
									<thead>
										<tr>
											<th align="center" bgcolor="#222222">寄件人</th>
											<th width="200px" align="center" bgcolor="#222222">發送時間</th>
										  <th width="150px" align="center" bgcolor="#222222"></th>
										</tr>
									</thead>
									<tbody class="tbodyC">
										<?PHP
										//使用分頁控制必備變數--開始
										include "./include/pages.php";
										$pagesize='30';//設定每頁顯示資料量
										$phpfile = 'index.php?ct=ind_mail';//使用頁面檔案
										$page= isset($_GET['page'])?$_GET['page']:1;//如果沒有傳回頁數，預設為第1頁



										//查詢
										$sql="
										SELECT * FROM mail
										$sql_where_name
										ORDER BY `no` DESC
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
										SELECT * FROM mail 
										$sql_where_name
										ORDER BY `no` DESC 
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
												<span style="font-size:16px;"><?PHP if($rows["company"]<>''){ ?>【<?=$rows["company"]; ?>】<?PHP } ?><?=$rows["name"]; ?></span}>
											</td>
											<td style="vertical-align:middle;">
												<span style="font-size:16px;"><?=$rows["date"];?></span>
											</td>
											<td align="right" style="vertical-align:middle;text-align: center;">
												<a class="btn btn-primary btn-xs"  href="index.php?ct=ind_mail_print&no=<?=$rows["no"];?>">觀看</a>
												<a class="btn btn-danger btn-xs" onclick="if(window.confirm('確定要刪除？一旦刪除則無法復原。')) location.href='ind_mail_del_ok.php?no=<?=$rows["no"];?>';">刪除</a>
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
