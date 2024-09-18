<?php 	require_once 'config.php';




?>
<!DOCTYPE html>
<html lang="en">

<head>

	<?php include icld.'head.php'; ?>

</head>

<body class="sub-page">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-bg-white navbar-static-top" role="navigation">
		<?php include icld.'nav.php'; ?>
    </nav>
	
	<section class="sidebar"> <!-- 20181111 edited /// mt-50 edit to mt-20 ///  --><!-- 20181121 edited /// mt-20 edit to sidebar ///  -->
		<!-- Page Content -->
		<div class="container">
			<!-- Feature Section -->
			<div class="row">
				
				
				<!-- 20181121 edited /// mt-20 edit to sidebar ///  -->
				<div class="col-md-2 col-sm-12 col-xs-12 hidden-sm hidden-xs">
					<div class="list-group">
						<a href="storelist.php?a=1" class="list-group-item ">北區</a>
						<a href="storelist.php?a=2" class="list-group-item ">中區</a>
						<a href="storelist.php?a=3" class="list-group-item ">南區</a>
					</div>
				</div>
				
				
				<div class="col-md-10 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-md-6 col-sm-12 col-xs-12">
							<img class="img-responsive img-hover" src="images/store.png" alt="">
						</div>
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="stores panel">
								<div class="panel-heading">
									<h2>恩比寢飾</h2>
									<p>您好，歡迎來店參觀商品，我們將會有專人為您服務 </p>
								</div>
								<div class="panel-body">
									<p>營業時間 :  周一~周六上午10:30~下午20:00</p>
									<p>地址 :  基隆市安樂區麥金路781號</p>
									<p>電話 :  (02)25813521</p>
									
								</div>							
							</div>
						</div>	
						
						<div class="col-md-12 col-sm-12 col-xs-12 mb-15">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3612.0362793789527!2d121.71841551500826!3d25.13446428392541!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x345d4e0a6f4db7e3%3A0xe1ad9f6aa0152ceb!2zMjA05Z-66ZqG5biC5a6J5qiC5Y2A6bql6YeR6LevNzgx6Jmf!5e0!3m2!1szh-TW!2stw!4v1539188112272" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
					</div>
				</div>
				<!-- 20181121 edited /// mt-20 edit to sidebar ///  -->
				
				
			</div>
			<!-- /.row -->
		</div>
	</section>
					
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
