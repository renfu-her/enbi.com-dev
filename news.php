<?php 	require_once 'config.php';

	$pageNow = (isset($_GET['p']) and $_GET['p'] != '') ? intval($_GET['p']) : 1;

	$pageNum = 6;			//每頁呈現最大筆數

	$ary_data = $obj_news->fetchAll_join('*' , " order by newsdate DESC ",True , array($pageNow-1 , $pageNum));


	$totalPage = ceil(($obj_news->num) / $pageNum);
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
	
    <?php     	foreach($ary_data as $key => $value){
    		if( ($key%2) == 0 ){
	?>
	<section class="news-left" data-aos="zoom-in" data-aos-duration="600">
		<!-- Page Content -->
		<div class="container">
			<!-- Feature Section -->
			<div class="row" data-aos="fade-left" data-aos-delay="500" data-aos-offset="0" data-aos-duration="600">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<a href="news-content.php?p=<?php echo $value['pkey']?>">
						<img class="img-responsive img-hover" src="uploads/<?php echo $value['pic']?>" alt="">
					</a>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<a href="news-content.php?p=<?php echo $value['pkey']?>">
						<div class="news panel">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-2 col-sm-1 col-xs-2 date-row">
										<span class="month"><?php echo date('M',strtotime($value['newsdate']))?></span>
										<span class="date"><?php echo date('d',strtotime($value['newsdate']))?></span>
									</div>
									<div class="col-md-10 col-sm-11 col-xs-10 new-info">
										<h4><?php echo cut_content($value['title'],14)?></h4>
									</div>
								</div>
							</div>
							<div class="panel-body">
								<p><?php echo cut_content(strip_tags($value['info']),180)?></p>
							</div>							
						</div>
					</a>
				</div>				
			</div>
			<!-- /.row -->
		</div>
	</section>
	<?php     		}else{
    ?>
	<section class="news-right" data-aos="zoom-in" data-aos-duration="600">
		<!-- Page Content -->
		<div class="container">
			<!-- Feature Section -->
			<div class="row" data-aos="fade-right" data-aos-delay="500" data-aos-offset="0" data-aos-duration="600">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<a href="news-content.php?p=<?php echo $value['pkey']?>">
						<div class="news panel">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-2 col-sm-1 col-xs-2 date-row">
										<span class="month"><?php echo date('M',strtotime($value['newsdate']))?></span>
										<span class="date"><?php echo date('d',strtotime($value['newsdate']))?></span>
									</div>
									<div class="col-md-10 col-sm-11 col-xs-10 new-info">
										<h4><?php echo cut_content($value['title'],14)?></h4>
									</div>
								</div>
							</div>
							<div class="panel-body">
								<p><?php echo cut_content(strip_tags($value['info']),180)?></p>
							</div>							
						</div>
					</a>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<a href="news-content.php?p=<?php echo $value['pkey']?>">
						<img class="img-responsive img-hover" src="uploads/<?php echo $value['pic']?>" alt="">
					</a>
				</div>				
			</div>
			<!-- /.row -->
		</div>
	</section>
    <?php     		}
    	}
    ?>

	
	<section class="pagination-sec">
	<!-- Page Content -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<a class="btn btn-default" href="news.php?p=<?php echo $prvePage?>">
						<i class="glyphicon glyphicon-chevron-left"></i>
					</a>
					<div class="btn-group dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<span class="page-num"> <?php echo $pageNow?> </span>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<?php 								for($i=1 ; $i<=$totalPage ; $i++){
									echo '<li><a href="news.php?p='.$i.'">'.$i.'</a></li>';
								}
							?>
						 </ul>
						
					</div>
					<a class="btn btn-default" href="news.php?p=<?php echo $nextPage?>">
						<i class="glyphicon glyphicon-chevron-right"></i>
					</a>
				</div>
			</div>
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
