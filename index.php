<?php 
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

</head>

<body class="homepage">

    <!-- Navigation -->
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
	
	<section class="s1">
		<!-- Page Content -->
		<div class="container">

			<!-- Feature Section -->
			<div class="row">
				<div class="col-lg-12 text-center">
					<h2 class="page-header">
						<span class="under-decor">Our Features</span>
					</h2>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4" data-aos="zoom-in" data-aos-duration="100">
					<div class="text-center icon-wrap icon-effect icon-effect-a">
						<div class="thumbnail hi-icon">
							<img src="images/f1.png" class="img-responsive" />
						</div>
						<div class="caption">
							<p>品質嚴選</p>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4" data-aos="zoom-in" data-aos-delay="150" data-aos-duration="350">
					<div class="text-center icon-wrap icon-effect icon-effect-a">
						<div class="thumbnail hi-icon">
							<img src="images/f2.png" class="img-responsive" />
						</div>
						<div class="caption">
							<p>天然純淨</p>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="500">
					<div class="text-center icon-wrap icon-effect icon-effect-a">
						<div class="thumbnail hi-icon">
							<img src="images/f3.png" class="img-responsive" />
						</div>
						<div class="caption">
							<p>居家美學</p>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4" data-aos="zoom-in" data-aos-delay="450" data-aos-duration="650">
					<div class="text-center icon-wrap icon-effect icon-effect-a">
						<div class="thumbnail hi-icon">
							<img src="images/f4.png" class="img-responsive" />
						</div>
						<div class="caption">
							<p>客製化服務</p>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4" data-aos="zoom-in" data-aos-delay="600" data-aos-duration="800">
					<div class="text-center icon-wrap icon-effect icon-effect-a">
						<div class="thumbnail hi-icon">
							<img src="images/f5.png" class="img-responsive" />
						</div>
						<div class="caption">
							<p>貼心服務</p>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4" data-aos="zoom-in" data-aos-delay="750" data-aos-duration="950">
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

			<!-- New Item Section -->
			<div class="row">
				<div class="col-lg-12 text-center">
					<h2 class="page-header ptb-20">
						<span class="under-decor">New Products</span>
					</h2>
				</div>
				<?php 					$divDuration = 1000;
					$divDataaosdelay = 0;
					foreach($ary_prod as $key => $value){
				?>
				<div class="col-md-3 col-sm-3 col-xs-6 plr-0" data-aos="fade-right" data-aos-delay="<?php echo $divDataaosdelay?>" data-aos-duration="<?php echo $divDuration?>">
					<a href="products-content.php?p=<?php echo $value['pkey']?>">
						<div class="icon-wrap icon-effect icon-effect-a">
							<div class="thumbnail">
								<img class="img-responsive img-hover" src="uploads/<?php echo $value['pic']?>" alt="">
							</div>
							<div class="caption">
								<p class="decro-line"><?php echo cut_content($value['title'],16)?></p>
							</div>
						</div>
					</a>
				</div>
				<?php 						$divDuration += 150;
						$divDataaosdelay += 150;
					}
				?>
			</div>
			<!-- /.row -->

			<!-- Slogan Section -->
			<div class="row">
				<div class="col-lg-12">
					<div class="slogan-block">
						<h2 class="text-center" data-aos="zoom-in" data-aos-duration="800">Sleeping In The Healing Night</h2>
						<h3 class="text-center" data-aos="fade-right" data-aos-delay="150" >
							After work in the evening, unloading the exhaustion <br/>
							Hug in midsummer, sleep in the quiet moonlight
						</h3>
					</div>
				</div>
			</div>
			<!-- /.row -->
			
			<!-- Sale Section -->
			<div class="row">
				<div class="col-lg-12 p4">
					<?php echo $htmlAD?>
				</div>
			</div>
			<!-- /.row -->
			
			<!-- New Item Section -->
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-6 plr-0" data-aos="fade-right" data-aos-duration="1000">
					<a href="/products.php?c=55">
						<div class="icon-wrap icon-effect icon-effect-a">
							<div class="thumbnail">
								<img class="img-responsive img-hover" src="images/item01.png" alt="">
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 plr-0" data-aos="fade-right" data-aos-delay="150" data-aos-duration="1150">
					<a href="/products.php?c=51">
						<div class="icon-wrap icon-effect icon-effect-a">
							<div class="thumbnail">
								<img class="img-responsive img-hover" src="images/item02.png" alt="">
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 plr-0" data-aos="fade-right" data-aos-delay="300" data-aos-duration="1300">
					<a href="/products.php?c=53">
						<div class="icon-wrap icon-effect icon-effect-a">
							<div class="thumbnail">
								<img class="img-responsive img-hover" src="images/item03.png" alt="">
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 plr-0" data-aos="fade-right" data-aos-delay="450" data-aos-duration="1450">
					<a href="/products.php?c=60">
						<div class="icon-wrap icon-effect icon-effect-a">
							<div class="thumbnail">
								<img class="img-responsive img-hover" src="images/item04.png" alt="">
							</div>
						</div>
					</a>
				</div>
			</div>
			<!-- /.row -->
			
			<!-- Brand Story Section -->
			<div class="row">
				<div class="col-lg-12 plr-0">
					<a href="#">
						<div class="img-block">
							<img src="images/brand-story.png" class="img-responsive"/>
						</div>
					</a>
				</div>
			</div>
			<!-- /.row -->

			<!-- Footer Info Section -->
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-6 plr-0">
					<a href="https://www.momomall.com.tw/store/Main.jsp?entp_code=102441" target="_blank">
						<div class="icon-wrap icon-effect icon-effect-a">
							<div class="thumbnail">
								<img class="img-responsive img-hover" src="images/footer01.png" alt="">
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 plr-0">
					<a href="https://www.facebook.com/ENBI-%E6%81%A9%E6%AF%94-2136359593261410/" target="_blank">
						<div class="icon-wrap icon-effect icon-effect-a">
							<div class="thumbnail">
								<img class="img-responsive img-hover" src="images/footer02.png" alt="">
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 plr-0">
					<a href="https://www.facebook.com/enbiliving2018/" target="_blank">
						<div class="icon-wrap icon-effect icon-effect-a">
							<div class="thumbnail">
								<img class="img-responsive img-hover" src="images/footer03.png" alt="">
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 plr-0">
					<a href="https://line.me/ti/p/@pnq6802i/" target="_blank">
						<div class="icon-wrap icon-effect icon-effect-a">
							<div class="thumbnail">
								<img class="img-responsive img-hover" src="images/footer04.png" alt="">
							</div>
						</div>
					</a>
				</div>
			</div>
			<!-- /.row -->
		</div>
	</section>
					
	<section class="footer-sec">
	<!-- Page Content -->
		<div class="container">
			<hr>
		
			<!-- Footer -->
			<footer>

				<?php include icld.'footer.php'; ?>

			</footer>

		</div>
		<!-- /.container -->
	</section>
	
		
    <!-- Script to Activate the Carousel -->
    <script>

	//add this function start here
	// var $item = $('.item'); 
	// var $wHeight = $(window).height();
	// $item.eq(0).addClass('active');
	// $item.height($wHeight); 
	// $item.addClass('full-screen');

	// $('.carousel img').each(function() {
	// 	var $src = $(this).attr('src');
	// 	var $color = $(this).attr('data-color');
	// 	$(this).parent().css({
	// 		'background-image' : 'url(' + $src + ')',
	// 		'background-color' : $color
	// 	});
	// 	$(this).remove();
	// });

	// $(window).on('resize', function (){
	// 	$wHeight = $(window).height();
	// 	$item.height($wHeight);
	// });
	//add this function end here


    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
	
	AOS.init({
		easing: 'ease-in-out-sine',
		// remove once: true,
	})

    </script>

</body>

</html>
