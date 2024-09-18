<?php 	
include "./admin1561318/common.func.php";
require_once 'config.php';


	$ary_banner = $obj_banner->fetchAll_join('*' , " order by sort DESC ");
	$dotCount = 0;
	foreach($ary_banner as $key => $value){
		if($value['type'] == '1'){
			// $htmlBanner .= '<a class="item" href="'.$value['url'].'" target="_blank"><img src="uploads/'.$value['pic'].'" class="img-responsive" /></a>';
			$dotActive = ($dotCount==0) ? 'active' : '';
			$htmlBanner .= '<div class="item '.$dotActive.'"><a class="fill" href="'.$value['url'].'" target="_blank"><img src="uploads/'.$value['pic'].'" class="img-responsive" /></a></div>';
			$htmlBannerDot .= '<li data-target="#myCarousel" data-slide-to="'.$dotCount.'" class="'.$dotActive.'"></li>';
			$dotCount++;
		}else if($value['type'] == '2'){
			$htmlAD .= '<a href="'.$value['url'].'"><div class="img-block"><img src="uploads/'.$value['pic'].'" class="img-responsive"/></div></a>';
		}
	}


	$ary_prod = $obj_products->fetchAll_join('*' , " order by createdate DESC limit 4 ");

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<?php include icld.'head.php'; ?>
<style>
	.sub-page .nav.navbar-nav li a {
    color: #fff; 
}
</style>
</head>

<body class="sub-page">

        <nav class="navbar navbar-inverse navbar-bg navbar-static-top" role="navigation">

		<?php include icld.'nav.php'; ?>

    </nav>
	
	<!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide carousel-fullscreen carousel-fade" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php echo $htmlBannerDot?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php echo $htmlBanner?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </header>
	
	
	<section class="s1 py-6">
		<!-- Page Content -->
		<div class="container">

			<!-- Feature Section -->
			<div class="row"> <!-- 20181111 edited /// remove h640 ///  -->
				<div class="col-lg-12 text-center">
					<h2 class="page-title">
						<span class="pr-2">舒適生活</span> <span>平價時尚</span> <!-- 20181111 edited /// 中翻英 ///  -->
					</h2>
					<h3 class="page-subtitle">Comfortable Life, Cheap Fashion</h3>
					<p>
						您挑選最舒適的睡眠伴侶，透過視覺美學，生活習慣，打造不同主題環境的書是睡眠空間<br>
						我們將多年成功經驗最安心的品質提供最平實的價格
					</p>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4" data-aos="zoom-in" data-aos-duration="100"> <!-- 20181111 edited /// col-md-2 col-sm-6 col-xs-6 change to col-md-2 col-sm-4 col-xs-4 ///  -->
					<div class="text-center icon-wrap icon-effect icon-effect-a">
						<div class="thumbnail hi-icon">
							<img src="images/f1.png" class="img-responsive" />
						</div>
						<div class="caption">
							<p>品質嚴選</p>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4" data-aos="zoom-in" data-aos-delay="150" data-aos-duration="350"> <!-- 20181111 edited /// col-md-2 col-sm-6 col-xs-6 change to col-md-2 col-sm-4 col-xs-4 ///  -->
					<div class="text-center icon-wrap icon-effect icon-effect-a">
						<div class="thumbnail hi-icon">
							<img src="images/f2.png" class="img-responsive" />
						</div>
						<div class="caption">
							<p>天然純淨</p>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="500"> <!-- 20181111 edited /// col-md-2 col-sm-6 col-xs-6 change to col-md-2 col-sm-4 col-xs-4 ///  -->
					<div class="text-center icon-wrap icon-effect icon-effect-a">
						<div class="thumbnail hi-icon">
							<img src="images/f3.png" class="img-responsive" />
						</div>
						<div class="caption">
							<p>居家美學</p>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4" data-aos="zoom-in" data-aos-delay="450" data-aos-duration="650"> <!-- 20181111 edited /// col-md-2 col-sm-6 col-xs-6 change to col-md-2 col-sm-4 col-xs-4 ///  -->
					<div class="text-center icon-wrap icon-effect icon-effect-a">
						<div class="thumbnail hi-icon">
							<img src="images/f4.png" class="img-responsive" />
						</div>
						<div class="caption">
							<p>客製化服務</p>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4" data-aos="zoom-in" data-aos-delay="600" data-aos-duration="800"> <!-- 20181111 edited /// col-md-2 col-sm-6 col-xs-6 change to col-md-2 col-sm-4 col-xs-4 ///  -->
					<div class="text-center icon-wrap icon-effect icon-effect-a">
						<div class="thumbnail hi-icon">
							<img src="images/f5.png" class="img-responsive" />
						</div>
						<div class="caption">
							<p>貼心服務</p>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4" data-aos="zoom-in" data-aos-delay="750" data-aos-duration="950"> <!-- 20181111 edited /// col-md-2 col-sm-6 col-xs-6 change to col-md-2 col-sm-4 col-xs-4 ///  -->
					<div class="text-center icon-wrap icon-effect icon-effect-a">
						<div class="thumbnail hi-icon">
							<img src="images/f6.png" class="img-responsive" />
						</div>
						<div class="caption">
							<p>商品多樣性</p>
						</div>
					</div>
				</div>
				
			</div>
			<!-- /.row -->
		</div>
	</section>
		
			<!-- New Item Section -->
			<section class="sec-product">
			<div class="container">
			<div class="row m-mt-15"><!-- 20181111 edited /// remove h560 /// -->
				<div class="col-lg-12 text-center">
					<h2 class="sec-title">最新商品</h2>
					<h6 class="sec-subtitle">New Products</h6>
				</div>
				<?php 					$divDuration = 1000;
					$divDataaosdelay = 0;
					foreach($ary_prod as $key => $value){
				?>
				<div class="col-md-3 col-sm-3 col-xs-6 mb-15 px-1" data-aos="fade-right" data-aos-delay="<?php echo $divDataaosdelay?>" data-aos-duration="<?php echo $divDuration?>">
					<a href="products-content.php?p=<?php echo $value['pkey']?>">
						<div class="cards icon-wrap icon-effect icon-effect-a">
							<div class="thumbnail">
								<img class="img-responsive img-hover" src="uploads/<?php echo $value['pic']?>" alt="">
							</div>
							<div class="caption">
								<p><?php echo cut_content($value['title'],16)?></p>
							</div>
						</div>
					</a>
				</div>
				<?php 						$divDuration += 150;
						$divDataaosdelay += 150;
					}
				?>
			
			</div>
			
			
<?PHP
$banner_o=0;
$sql_banner="
SELECT * FROM news 
ORDER BY `news_sort` ASC ,`news_no` DESC 
LIMIT 0 , 3
";//DESC是遞減
$result_banner = $db->prepare("$sql_banner");//防sql注入攻擊
$result_banner->execute();
$total_banner=$result_banner->rowCount();//算出總筆數
//列出內容
if($total_banner<>0){//如果判斷結果有值才跑回圈抓資?>			
			<div class="row unboxing-row py-5" data-aos="zoom-in" data-aos-duration="500">
				<div id="carousel-unboxing" class="carousel carousel-moveone slide" data-ride="carousel">
            
					<div class="col-md-2 col-xs-12">
						<h2 class="sec-title">網紅開箱</h2>
						<h6 class="sec-subtitle">Unboxing Share</h6>
						<ol class="carousel-indicators">
							
<?PHP 

   while($rows_banner = $result_banner->fetch(PDO::FETCH_ASSOC))
{ 
?>
    <li data-target="#carousel-unboxing" data-slide-to="<?=$banner_o?>" <?PHP if($banner_o==0) echo 'class="active"';?>></li>
 <?PHP
$banner_o=$banner_o+1;//判斷第一次要給li style值
}
?>  
						</ol>	
					</div>
					<div class="col-md-10 col-xs-12">
						<div class="carousel-inner">
<?PHP 
$banner_o=0;
$sql_banner="
SELECT * FROM news 
ORDER BY `news_sort` ASC ,`news_no` DESC 
LIMIT 0 ,10
";//DESC是遞減
$result_banner = $db->prepare("$sql_banner");//防sql注入攻擊
$result_banner->execute();
$total_banner=$result_banner->rowCount();//算出總筆數
//列出內容
if($total_banner<>0){//如果判斷結果有值才跑回圈抓資
   while($rows_banner = $result_banner->fetch(PDO::FETCH_ASSOC))
{ 
$banner_o=$banner_o+1;//判斷第一次要給li style值
?>  
							<div class="item  <?PHP if($banner_o==1) echo 'active';?>">
								<div class="col-xs-12 col-md-4">
									<div class="image-block">
										<a href="unboxing-content.php?no=<?=$rows_banner["news_no"]; ?>"><img src="./admin1561318/goods_pic/<?=$rows_banner["news_pic_b"]; ?>"/ class="img-responsive"></a>
									</div>
									<div class="block-text">
										<a href="unboxing-content.php?no=<?=$rows_banner["news_no"]; ?>">
											<h4><?=$rows_banner["news_title"]; ?></h4>
											
											<p  style=" display: -webkit-box;
					  -webkit-line-clamp: 2; /* 最大顯示行數 */
					  -webkit-box-orient: vertical;
					  overflow: hidden;
					  text-overflow: ellipsis; /* 使用省略號 */"><?=$rows_banner["news_title_en"]; ?></p>
										</a>
									</div>
								</div>
							</div>
<?PHP
}}
?> 	
										
						</div>
						<a class="left carousel-control" href="#carousel-unboxing" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
						<a class="right carousel-control" href="#carousel-unboxing" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
					</div>
				</div>
			</div>

<?PHP
}
?>			
						
									
															
			</div>
			</section>
			<!-- /.row -->

		<section class="py-5">
		<div class="container">			
							
			<!-- Slogan Section -->
		<section>	
		 <!--banner-->
<?PHP
$banner_o=0;
$sql_banner="
SELECT * FROM banner 
ORDER BY `banner_sort` ASC ,`banner_no` DESC 
LIMIT 0 , 100
";//DESC是遞減
$result_banner = $db->prepare("$sql_banner");//防sql注入攻擊
$result_banner->execute();
$total_banner=$result_banner->rowCount();//算出總筆數
//列出內容
if($total_banner<>0){//如果判斷結果有值才跑回圈抓資?>		
		<div id="myCarousel2" class="carousel slide  carousel-fade mb-15" data-ride="carousel" >
        <!-- Indicators -->
        <ol class="carousel-indicators">
           
          <?PHP 

   while($rows_banner = $result_banner->fetch(PDO::FETCH_ASSOC))
{ 
?>
    <li data-target="#myCarousel2" data-slide-to="<?=$banner_o?>" <?PHP if($banner_o==0) echo 'class="active"';?>></li>
 <?PHP
$banner_o=$banner_o+1;//判斷第一次要給li style值
}
?> 
        </ol>
		
		<!-- 20191228 又改回原來樣式 /// rewrited start here ///  -->
		<!-- 20181111 edited /// rewrited start here ///  -->
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <?PHP 
$banner_o=0;
$sql_banner="
SELECT * FROM banner 
ORDER BY `banner_sort` ASC ,`banner_no` DESC 
LIMIT 0 , 100
";//DESC是遞減
$result_banner = $db->prepare("$sql_banner");//防sql注入攻擊
$result_banner->execute();
$total_banner=$result_banner->rowCount();//算出總筆數
//列出內容
if($total_banner<>0){//如果判斷結果有值才跑回圈抓資
   while($rows_banner = $result_banner->fetch(PDO::FETCH_ASSOC))
{ 
$banner_o=$banner_o+1;//判斷第一次要給li style值
?> 
           <div class="item <?PHP if($banner_o==1) echo 'active';?>">
			   <?PHP if($rows_banner["banner_link"]<>""){ ?>
			   <a href="<?=$rows_banner["banner_link"]; ?>">
			   <?PHP } ?>
			 	  <img src="./admin1561318/goods_pic/<?=$rows_banner["banner_pic_b"]; ?>" alt="<?=$rows_banner["banner_title"]; ?>">
			   <?PHP if($rows_banner["banner_link"]<>""){ ?>
			   </a>
			   <?PHP } ?>
			</div>
<?PHP
}}
?> 				
        </div>
		<!-- 20181111 edited /// rewrited end here ///  -->
		<!-- 20191228 又改回原來樣式 /// rewrited start here ///  -->

		<!-- Controls -->
        <a class="left carousel-control" href="#myCarousel2" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel2" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
	</div>
<?PHP
}
?>	
 <!--banner-->
			<!-- /.row -->
	
			<!-- Sale Section -->
			<div class="row">
				<div class="col-lg-12"> <!-- 20181111 edited /// add class=> p4 ///  !--> 
					<a href="#">
						<div class="img-block">
							<?php echo $htmlAD?>
						</div>
					</a>
				</div>
			</div>
			<!-- /.row -->
			
		</div>
	</section>
		<aside class="asidebar">
        <ul class="list-unstyled">
          <li><a href="https://www.facebook.com/enbiliving2018" target="_blank"><img class="side_ic" src="./images/side_ic01.png" alt="恩比Facebook官方粉絲團"></a></li>
          <li><a href="tel:02-24321008"><img class="side_ic" src="./images/side_ic02.png" alt="聯絡恩比"></a></li>
        </ul>
    </aside>
			
			
	

		
	

					
	<section class="footer-sec">
	<!-- Page Content -->
		<div class="container">
			<hr>
		
			<!-- Footer -->
			<footer class="footer-row">

				<?php include icld.'footer.php'; ?>

			</footer>

		</div>
		<!-- /.container -->
	</section>
	
    <!-- Script to Activate the Carousel -->
     <script>

	//add this function start here
	/*var $item = $('.item'); 
	var $wHeight = $(window).height();
	$item.eq(0).addClass('active');
	$item.height($wHeight); 
	$item.addClass('full-screen');

	$('.carousel img').each(function() {
		var $src = $(this).attr('src');
		var $color = $(this).attr('data-color');
		$(this).parent().css({
			'background-image' : 'url(' + $src + ')',
			'background-color' : $color
		});
		$(this).remove();
	});

	$(window).on('resize', function (){
		$wHeight = $(window).height();
		$item.height($wHeight);
	});*/
	//add this function end here


    $('.carousel').carousel({
        interval: 3000 //changes the speed
    })

    
	AOS.init({
		easing: 'ease-in-out-sine',
		// remove once: true,
	})

	$('.carousel-moveone .item').each(function(){
		var itemToClone = $(this);

		for (var i=1;i<3;i++) {
		itemToClone = itemToClone.next();

		// wrap around if at end of item collection
		if (!itemToClone.length) {
			itemToClone = $(this).siblings(':first');
		}

		// grab item, clone, add marker class, add to collection
		itemToClone.children(':first-child').clone()
			.addClass("cloneditem-"+(i))
			.appendTo($(this));
		}
	});

    </script>

</body>

</html>
