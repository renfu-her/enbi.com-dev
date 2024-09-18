<?php 	require_once 'config.php';

	if(!$ary_get['a']){
		header("Location:./store.php");
		exit;
	}

	$ary_menuActive1['1'] = 'active';
	$ary_menuActive2['2'] = 'active';
	$ary_menuActive3['3'] = 'active';

	$ary_areaTitle['1'] = '北區';
	$ary_areaTitle['2'] = '中區';
	$ary_areaTitle['3'] = '南區';

	$pageNow = (isset($_GET['p']) and $_GET['p'] != '') ? intval($_GET['p']) : 1;

	$pageNum = 6;			//每頁呈現最大筆數

	$ary_data = $obj_store -> fetchAll('*' , " area = '".$ary_get['a']."' order by sort DESC ",True , array($pageNow-1 , $pageNum));


	$totalPage = ceil(($obj_store->num) / $pageNum);
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
	
	<section class="store-sec sidebar">
		<!-- Page Content -->
		<div class="container">
			<!-- Feature Section -->
			<div class="row">
				<div class="col-md-2 col-sm-12 col-xs-12 hidden-sm hidden-xs">
					<div class="list-group">
						<a href="storelist.php?a=1" class="list-group-item <?php echo $ary_menuActive1[$ary_get['a']]?>">北區</a>
						<a href="storelist.php?a=2" class="list-group-item <?php echo $ary_menuActive2[$ary_get['a']]?>">中區</a>
						<a href="storelist.php?a=3" class="list-group-item <?php echo $ary_menuActive3[$ary_get['a']]?>">南區</a>
					</div>
				</div>
				
				<div class="col-md-10 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="location-block">
								<h2><?php echo $ary_areaTitle[$ary_get['a']]?></h2>
							</div>
						</div>

						<?php 							$divDataaosdelay = 0;
							foreach($ary_data as $key => $value){
								if(($key+1)%2 == 1){
									$htmlDivLeftRight = 'left';
								}else{
									$htmlDivLeftRight = 'right';
								}
						?>

						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="store-<?php echo $htmlDivLeftRight?> row" data-aos="fade-up" data-aos-delay="<?php echo $divDataaosdelay?>" data-aos-offset="0" data-aos-duration="600">
								<div class="col-md-3 col-sm-12 col-xs-12 pr-10">
									<div class="store-info-block">
										<h4><?php echo $value['title']?></h4>
										<?if($value['addr']){?><p><?php echo $value['addr']?></p><?}?>
										<?if($value['tel']){?><p>電話 : <?php echo $value['tel']?></p><?}?>
										<?if($value['fax']){?><p>傳真 : <?php echo $value['fax']?></p><?}?>
									</div>
								</div>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12 plr-10">
											<div class="img-block">
												<?php 													if($value['pic']){
												?>
												<img src="uploads/<?php echo $value['pic']?>" class="img-responsive"/>
												<?		
													}
												?>
											</div>
										</div>
										<div class="col-md-6 col-sm-12 col-xs-12 plr-10">
											<div class="map-block">
												<?php 													if($value['addr']){
												?>
												<iframe src="https://www.google.com/maps/embed/v1/place?q=<?php echo $value['addr']?>&key=AIzaSyAG6cLmDhRV4f7XnnEY6g5yfnebkfv7Wb8" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>	
												<?		
													}
												?>
											</div>
										</div>
									</div>
								</div>	
							</div>
						</div>
						<?php 								$divDataaosdelay += 150;
							}
						?>
						
					</div>
					
					<div class="row">
						<div class="col-md-12 text-center">
							<a class="btn btn-default" href="storelist.php?a=<?php echo $ary_get['a']?>&p=<?php echo $prvePage?>">
								<i class="glyphicon glyphicon-chevron-left"></i>
							</a>
							<div class="btn-group dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<span class="page-num"> <?php echo $pageNow?> </span>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
								<?php 									for($i=1 ; $i<=$totalPage ; $i++){
										echo '<li><a href="storelist.php?a='.$ary_get['a'].'&p='.$i.'">'.$i.'</a></li>';
									}
								?>
								 </ul>
								
							</div>
							<a class="btn btn-default" href="storelist.php?a=<?php echo $ary_get['a']?>&p=<?php echo $nextPage?>">
								<i class="glyphicon glyphicon-chevron-right"></i>
							</a>
						</div>
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
			<footer>
				<?php include icld.'footer.php'; ?>
			</footer>

		</div>
		<!-- /.container -->
	</section>
	
	<script src="js/lazysizes.min.js" async=""></script>

		
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
