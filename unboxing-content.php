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
<?PHP
$edit_no	=	$_GET['no'];


$sql_main="SELECT * 
FROM `news` 
WHERE  news_no=:edit_no;
";

$result_main = $db->prepare("$sql_main");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
$result_main->bindValue(':edit_no', $edit_no, PDO::PARAM_INT);
$result_main->execute();
$rows_main = $result_main->fetch(PDO::FETCH_ASSOC);
$counts_main=$result_main->rowCount();//算出總筆數

if($counts_main<=0){
	echo '<meta charset="UTF-8">';
	echo '<script language="javascript">';
	echo 'alert("抱歉！資料已經下架或移除囉，網站將轉回首頁！");';
	echo "location='./';";
	echo '</script>';	
	exit();
}
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
	
	<section class="sidebar"><!-- 20181111 edited /// remove mt-50 ///  -->
		<!-- Page Content -->
		<div class="container">

			<!-- Feature Section -->
			<div class="row">
				<div class="col-md-12 mb-30"> <!-- 20181111 edited /// add mb-30 ///  -->
					<div class="row">
						<div class="col-md-12 mb-30"> <!-- 20181111 edited /// remove mb-30 ///  -->
							<h2 class="prod-header"><?=$rows_main["news_title"]; ?></h2>
							<p><?=$rows_main["news_title_en"]; ?></p>
						</div>
						<div class="col-md-12"  id="img-responsive">
							  <!-- 編輯器 -->
								 <?=$rows_main["news_content"]; ?>
							  <!-- 編輯器 -->
						</div>
					</div>
				</div>				
			</div>
			<!-- /.row -->
		</div>
	</div>

	<section class="back-sec">
	<!-- Page Content -->
		<div class="container">
			<div class="row"><!-- 20181111 edited /// remove mt-30 mb-50 ///  -->
				<div class="col-md-12 text-center">
					<button class="btn btn-default" onclick="history.back()" >返回</button>
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
<!--變更圖片和frame ID成為響應式大小-->
<script type="text/javascript">
	$(document).ready(function() {
		$("#img-responsive img")
			.addClass("img-responsive")//增加bootstrap內健RWD寬度
			.css("height",'');//高度清除
		
	});
</script>
<!--變更圖片和frame ID成為響應式大小-->
<style>
#img-responsive,#img-responsive>img,#img-responsive a>img{display:block;max-width:100%;height:auto}
#img-responsive iframe {  width: 100%; height: auto; aspect-ratio: 16/9;}/*youtube崁入自動100%*/
</style>
</body>

</html>
