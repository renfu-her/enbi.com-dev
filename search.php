<?php 	require_once 'config.php';

	if(!$ary_get['s']){
		header("Location:./products.php");
		exit;
	}

	$pageNow = (isset($_GET['p']) and $_GET['p'] != '') ? intval($_GET['p']) : 1;

	$pageNum = 12;			//每頁呈現最大筆數

	$ary_data = $obj_products->fetchAll('*' , " title like '%".$ary_get['s']."%' OR info like '%".$ary_get['s']."%' order by sort DESC ",True , array($pageNow-1 , $pageNum));

	$totalPage = ceil(($obj_products->num) / $pageNum);
	$prvePage = (($pageNow-1) <= 0) ? 1 : $pageNow-1;
	$nextPage = (($pageNow+1) >= $totalPage) ? $totalPage : $pageNow+1;


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
				<div class="col-md-12">
					<h2 class="prod-header"><span class="color-txt"></span></h2>
				</div>
				
				<div class="col-md-12">
					<div class="row">
						<?php 							$divDataaosdelay = 0;
							foreach($ary_data as $value){
						?>
						<div class="col-md-3 col-sm-6 col-xs-6 plr-0" data-aos="fade-up" data-aos-delay="<?php echo $divDataaosdelay?>" data-aos-duration="600">
							<a href="products-content.php?p=<?php echo $value['pkey']?>">
								<div class="icon-wrap icon-effect icon-effect-a">
									<div class="thumbnail">
										<img class="img-responsive img-hover" src="uploads/<?php echo $value['pic']?>" alt="<?php echo $value['title']?>">
									</div>
									<div class="caption">
										<h4><b><?php echo cut_content($value['title'],16)?></b></h4>
										<p><?php echo cut_content(strip_tags($value['info']),40)?></p>
									</div>
								</div>
							</a>
						</div>
						<?php 								$divDataaosdelay += 150;
							}
						?>
					</div>
					
				</div>				
			</div>
			<!-- /.row -->
		</div>
	</section>

	<section class="pagination-sec">
	<!-- Page Content -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<a class="btn btn-default" href="search.php?s=<?php echo $ary_get['s']?>&p=<?php echo $prvePage?>">
						<i class="glyphicon glyphicon-chevron-left"></i>
					</a>
					<div class="btn-group dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<span class="page-num"> <?php echo $pageNow?> </span>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<?php 								for($i=1 ; $i<=$totalPage ; $i++){
									echo '<li><a href="search.php?s='.$ary_get['s'].'&p='.$i.'">'.$i.'</a></li>';
								}
							?>
						 </ul>
						
					</div>
					<a class="btn btn-default" href="search.php?s=<?php echo $ary_get['s']?>&p=<?php echo $nextPage?>">
						<i class="glyphicon glyphicon-chevron-right"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
					
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
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
	
	AOS.init({
		easing: 'ease-in-out-sine',
		once: true,
	})
	
    </script>

</body>

</html>
