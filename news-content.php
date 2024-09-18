<?php 	require_once 'config.php';

	if(!$ary_get['p']){
		header("Location:./news.php");
		exit;
	}

	$ary_data = $obj_news->fetch('*' , " pkey = '".$ary_get['p']."' ");
	if(!$ary_data){
		header("Location:./news.php");
		exit;
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
		<?php include icld.'nav.php'; ?>
    </nav>
	
	<section class="news-wrapper">
		<!-- Page Content -->
		<div class="container">
			<!-- Feature Section -->
			<div class="row">
				<div class="col-md-12">
					<div class="news panel">
						<div class="panel-heading no-border">
							<div class="row">
								<div class="col-md-1 col-sm-1 col-xs-2 date-row">
									<span class="month"><?php echo date('M',strtotime($ary_data['newsdate']))?></span>
									<span class="date"><?php echo date('d',strtotime($ary_data['newsdate']))?></span>
								</div>
								<div class="col-md-11 col-sm-11 col-xs-10 new-info">
									<h4><?php echo $ary_data['title']?></h4>
								</div>								
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-12 editorImg">
					<?php echo $ary_data['info']?>
				</div>
			</div>
			<!-- /.row -->
		</div>
	</section>
	
	<section class="back-sec">
	<!-- Page Content -->
		<div class="container">
			<div class="row mt-30 mb-50">
				<div class="col-md-12 text-center">
					<button class="btn btn-default" onclick="history.back()" >返回</button>
				</div>
			</div>
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
		once: true,
	})
	$(function(){
		$('.editorImg img').addClass('img-responsive img-hover');
	});

    </script>

</body>

</html>
