<?php 	require_once 'config.php';

	$pageNow = (isset($_GET['p']) and $_GET['p'] != '') ? intval($_GET['p']) : 1;

	$pageNum = 6;			//每頁呈現最大筆數

	$ary_data = $obj_news->fetchAll_join('*' , " order by newsdate DESC ",True , array($pageNow-1 , $pageNum));


	$totalPage = ceil(($obj_news->num) / $pageNum);
	$prvePage = (($pageNow-1) <= 0) ? 1 : $pageNow-1;
	$nextPage = (($pageNow+1) >= $totalPage) ? $totalPage : $pageNow+1;

?>
<?php

include "./admin1561318/common.func.php";
##$pageNow = (isset($_GET['p']) and $_GET['p'] != '') ? intval($_GET['p']) : 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<?php include icld.'head.php'; ?>

</head>

<body class="sub-page">

    <!-- Navigation -->
     <nav class="navbar navbar-inverse navbar-bg-white navbar-static-top" role="navigation">

		<?php include './include/nav.php'; ?>

    </nav>
<?PHP
			//使用分頁控制必備變數--開始
										include "./admin1561318/include/pages.php";
										$pagesize='15';//設定每頁顯示資料量
										$phpfile = 'unboxing.php?class=0';//使用頁面檔案
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

										if ($page>$counts) {
											$page = $counts;//輸入值大於總數則顯示最後頁
											if($page==0) $page=1;
														   }
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
										

										if($counts<>0){//如果判斷結果有值才跑回圈抓資料
?>	
	<section class="sidebar unbox"><!-- 20181111 edited /// remove mt-50 ///  -->
		<!-- Page Content -->
		<div class="container">

			<!-- Feature Section -->
			<div class="row image-container">
			<?PHP
										
										   while($rows = $result->fetch(PDO::FETCH_ASSOC)) {
										$no_id=$no_id+1;
										?>
				<div class="col-md-4 col-xs-12" data-aos="fade-up" data-aos-duration="600"> <!-- 20181111 edited /// col-md-4 col-sm-12 col-xs-12 edit to col-md-4 col-sm-6 col-xs-6 plr-0 ///  -->
					<div class="icon-wrap icon-effect icon-effect-a">
						<div class="thumbnail">
							<a href="unboxing-content.php?no=<?=$rows["news_no"]; ?>"><img src="./admin1561318/goods_pic/<?=$rows["news_pic_b"]; ?>"/ class="img-responsive img-hover" data-ratio="1"></a>
						</div>
						<div class="block-text mb-50">
							<a href="unboxing-content.php?no=<?=$rows["news_no"]; ?>">
								<h4><?=$rows["news_title"]; ?></h4>
								<p  style=" display: -webkit-box;
					  -webkit-line-clamp: 2; /* 最大顯示行數 */
					  -webkit-box-orient: vertical;
					  overflow: hidden;
					  text-overflow: ellipsis; /* 使用省略號 */;min-height: 48px;"><?=$rows["news_title_en"]; ?></p>
							</a>
						</div>
					</div>
				</div>
				<?php	
				}
				?>
				
			</div>
			<!-- /.row -->
		
		</div>
</section>		
	<?php	
				}
				?>		
	</div>

	<section class="pagination-sec">
	<!-- Page Content -->
		<div class="container">
			<div class="row"> <!-- 20181111 edited /// remove mt-30 mb-50 ///  -->
				<div>
				<?php
					
					if($counts>$pagesize){
						echo $getpageinfo['pagecode'];//顯示分頁的html代碼
					}
					?>
					<style>
					/*分頁樣式表*/

	.page{font-family:Tahoma; font-size:16px;}
	
	.page {
	
		PADDING-RIGHT: 7px; PADDING-LEFT: 7px; PADDING-BOTTOM: 7px; MARGIN: 3px; PADDING-TOP: 7px; TEXT-ALIGN: center;
	
	}
	
	.page A {
	
		BORDER-RIGHT: #898989 1px solid; PADDING-RIGHT: 10px; BORDER-TOP: #898989 1px solid; PADDING-LEFT: 10px; PADDING-BOTTOM: 5px; MARGIN: 2px; BORDER-LEFT: #898989 1px solid; COLOR: #898989; PADDING-TOP: 5px; BORDER-BOTTOM: #898989 1px solid; TEXT-DECORATION: none;border-radius: 5px;
	
	}
	
	.page A:hover {
	
		BORDER-RIGHT: #898989 1px solid; BORDER-TOP: #898989 1px solid; BORDER-LEFT: #898989 1px solid; COLOR: #fff; BORDER-BOTTOM: #898989 1px solid; BACKGROUND-COLOR: #898989;
	
	}
	
	.page A:active {
	
		BORDER-RIGHT: #898989 1px solid; BORDER-TOP: #898989 1px solid; BORDER-LEFT: #898989 1px solid; COLOR: #fff; BORDER-BOTTOM: #898989 1px solid; BACKGROUND-COLOR: #898989;
	
	}
	
	.page SPAN.current {
	
		BORDER-RIGHT: #898989 1px solid; PADDING-RIGHT: 5px; BORDER-TOP: #898989 1px solid; PADDING-LEFT: 5px; FONT-WEIGHT: bold; PADDING-BOTTOM: 2px; MARGIN: 2px; BORDER-LEFT: #898989 1px solid; COLOR: #fff; PADDING-TOP: 2px; BORDER-BOTTOM: #898989 1px solid; BACKGROUND-COLOR: #898989;
	
	}
	
	.page SPAN {
	
		BORDER-RIGHT: #898989 1px solid; PADDING-RIGHT: 10px; BORDER-TOP: #898989 1px solid; PADDING-LEFT: 10px; PADDING-BOTTOM: 5px; MARGIN: 2px; BORDER-LEFT: #898989 1px solid; COLOR: #fff; PADDING-TOP: 5px; BORDER-BOTTOM: #898989 1px solid;
	
	BACKGROUND-COLOR: #898989;border-radius: 5px;
	
	}	
					</style>
				</div>
			</div>
		</div>
	</section>
					
	<aside class="asidebar">
        <ul class="list-unstyled">
          <li><a href="https://www.facebook.com/enbiliving2018" target="_blank"><img class="side_ic" src="./images/side_ic01.png" alt="恩比Facebook官方粉絲團"></a></li>
          <li><a href="tel:02-24321008"><img class="side_ic" src="./images/side_ic02.png" alt="聯絡恩比"></a></li>
        </ul>
    </aside>
	
	<!-- Footer Info Section -->	
	<section class="footer-sec">
	<!-- Page Content -->
		<div class="container">
			<!-- Footer -->
			<footer class="footer-row">
				<?php include icld.'footer.php'; ?>
			</footer>

		</div>
		<!-- /.container -->
	</section>
	
    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
	
	AOS.init({
		easing: 'ease-in-out-sine',
		once: true,
	})

    </script>
<!--圖片等比例-->  
	<!-- 
	在data-ratio属性中设置自定义比例，比如120:150 = 0.8 
	<div class="image-container">
	  <img src="path/to/your/image.jpg" alt="Your Image" data-ratio="0.8">
	</div>
	-->
	<script>
	$(document).ready(function() {
	  // 根據自定義比例計算高度
	  function setCustomHeight() {
		$('.image-container img').each(function() {
		  var $img = $(this);
		  var customRatio = parseFloat($img.data('ratio'));
		  if (!isNaN(customRatio)) {
			var containerWidth = $img.parent().width();
			var newHeight = containerWidth * customRatio;
			$img.height(newHeight);
		  }
		});
	  }

	  // 初始加載時設置高度
	  setCustomHeight();

	  // 窗口大小改變時重新計算並更新高度
	  $(window).resize(function() {
		setCustomHeight();
	  });
	});
	</script>
	<!--圖片等比例-->
</body>

</html>
