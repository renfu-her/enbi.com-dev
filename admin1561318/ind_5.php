<?php
include_once libs.'pageAD.php';


$pageNow = (isset($_GET['p']) and $_GET['p'] != '') ? intval($_GET['p']) : 1;

$pageNum = 30;          //每頁呈現最大筆數



$ary_firClassAll = $obj_category -> fetchAll('*' , " data_pkey = '0' order by sort DESC ");



if($ary_get['mainClass']){
	$ary_firClass = $obj_category -> fetch('*' , " pkey = '".$ary_get['mainClass']."' ");
}else{
	$ary_firClass = $obj_category -> fetch('*' , " data_pkey = '0' order by sort DESC ");
}
$mainClassTitile = $ary_firClass['title'];
$sqlStr = $ary_firClass['pkey'];


$ary_data = $obj_category -> fetchAll(' * ', " data_pkey = '".$sqlStr."' ORDER BY `sort` DESC ",True , array($pageNow-1 , $pageNum));   //取出所需會員資料




$page = new SplitPage($pageNow, $obj_category->num, $pageNum, 10);  //建構出 SplitPage 物件
$page->setViewList("index.php?ct=".$ary_get['ct']."&mainClass=".$ary_get['mainClass']."&", '_self');   //設定導覽列資料,參數1為連結的頁面,參數2為連結的target(本參數可不設定)



?>
<script>

$(function(){



	$('.cList li').click(function(){
		var fthis = $(this).find('a');
		top.location.href = "index.php?ct=<?php echo $ary_get['ct']?>&mainClass="+fthis.attr('ref');
	});





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
							<h3>產品子類</h3>

							<a class="btn btn-danger fancybox" data-fancybox-type="iframe" href="proc.php?proc=add&ct=<?php echo $ary_get['ct']?>&data=<?php echo $sqlStr?>" style="float: right;margin-top: 14px;margin-right: 40px;">新增 <?php echo $mainClassTitile?> 子類</a>

							<a class="btn btn-primary fancybox" data-fancybox-type="iframe" href="proc.php?proc=sort&ct=sort_<?php echo $ary_get['ct']?>&data=<?php echo $sqlStr?>" style="float: right;margin-top: 14px;margin-right: 10px;">排序</a>

							<div class="btn-group cList" style="float: right;margin-top: 14px;margin-right: 13px;width: auto;">
								<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" ref="<?php echo $ary_get['mainClass']?>"><?php echo $mainClassTitile?> <span class="caret"></span></button>
								<ul class="dropdown-menu" style="height: 200px;overflow: scroll;left:auto;right: 0;">
									<?php 										foreach($ary_firClassAll as $value2){
											echo '<li><a ref="'.$value2['pkey'].'">'.$value2['title'].'</a></li>';
										}
									?>
								</ul>
							</div>

						</div>
						<div class="widget-content">
							<div class="body">
								<table class="table table-striped">
									<thead>
										<tr>
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
											<td style="vertical-align:middle;text-align: center;">
												<a class="btn btn-primary btn-xs fancybox" data-fancybox-type="iframe" href="proc.php?proc=edit&ct=<?php echo $ary_get['ct']?>&pk=<?php echo $value['pkey']?>&data=<?php echo $sqlStr?>">修改</a>
												<a class="btn btn-danger btn-xs" onclick="if(window.confirm('確定要刪除？一旦刪除則無法復原。')) location.href='delete_proc.php?ct=<?php echo $ary_get['ct']?>&pk=<?php echo $value['pkey']?>';">刪除</a>
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
