<?php 	require_once 'config.php';


	$ary_data = $obj_story->fetch('*' , " type = '3' ");

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
	
	<section class="sidebar">
		<!-- Page Content -->
		<div class="container">

			<!-- Feature Section -->
			<div class="row">
				<div class="col-md-2 col-sm-12 col-xs-12">
					<div class="list-group">
						<a href="service.php" class="list-group-item active">客製化刺繡</a>
						<a href="clean.php" class="list-group-item">到府除塵蟎</a>
					</div>
				</div>
				<div class="col-md-10 col-sm-12 col-xs-12">
					<div class="editor">
						
						<?php echo $ary_data['info']?>						
						
					</div>
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
		$('.editor img').addClass('img-responsive img-hover');
	});

    </script>

</body>

</html>
