<?php
include_once libs.'pageAD.php';

$pageNow = (isset($_GET['p']) and $_GET['p'] != '') ? intval($_GET['p']) : 1;

$pageNum = 30;          //每頁呈現最大筆數




$ary_data = $obj_banner->fetchAll(' * ', " type = '2' ORDER BY `sort` DESC ",True , array($pageNow-1 , $pageNum));   //取出所需會員資料




$page = new SplitPage($pageNow, $obj_banner->num, $pageNum, 10);  //建構出 SplitPage 物件
$page->setViewList("index.php?ct=".$ary_get['ct']."&", '_self');   //設定導覽列資料,參數1為連結的頁面,參數2為連結的target(本參數可不設定)




?>
<script>

$(function(){






});

</script>
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
							<h3>廣告banner</h3>

						</div>
						<div class="widget-content">
							<div class="body">
								<table class="table table-striped">
									<thead>
										<tr>
											<th></th>
											<th>寬:1200px / 高300px</th>
											<th></th>
											<th width="150px"></th>
										</tr>
									</thead>
									<tbody class="tbodyC">
										<?php 											if(!$ary_data){
												echo '<tr><td colspan="7" style="text-align:center;">無資料</td></tr>';
											}

											foreach($ary_data as $value){
										?>
										<tr>
											<td style="vertical-align:middle;">
												<span style="font-size:16px;"><?php echo $value['title']?></span>
											</td>
											<td style="vertical-align:middle;">
												<img src="../uploads/<?php echo $value['pic']?>" height="100px">
											</td>
											<td style="vertical-align:middle;">
												<?php echo $value['url']?>
											</td>
											<td style="vertical-align:middle;text-align: center;">
												<a class="btn btn-primary btn-xs fancybox" data-fancybox-type="iframe" href="proc.php?proc=edit&ct=<?php echo $ary_get['ct']?>&pk=<?php echo $value['pkey']?>">修改</a>
											</td>
										</tr>
										<?php 											}
										?>
									</tbody>
								</table>
								<div class="clearfix">

									<ul class="pagination no-margin">
										<?php 
										echo $page->viewlist;
										?>
										<!-- <li class="disabled"><a href="#">Prev</a></li>
										<li class="active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">4</a></li>
										<li><a href="#">Next</a></li> -->
									</ul>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="bottom-nav footer"></div>
 

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
