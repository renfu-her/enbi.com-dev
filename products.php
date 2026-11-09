<?php 	require_once 'config.php';


	$ary_category = $obj_category->fetchAll_join('*' , " order by sort DESC ");
	$categoryGet = isset($ary_get['c']) ? $ary_get['c'] : '';
	$ary_mainCategory = array();
	$categoryOpenPkey = null;

	foreach($ary_category as $value){
		$ary_categoryRe[$value['pkey']] = $value;
		if($categoryGet !== '' && $categoryGet == $value['pkey']){
			$categoryOpenPkey = $value['data_pkey'];
		}
		if($value['data_pkey'] == 0){
			$ary_mainCategory[] = $value;
		}
	}

	if(empty($categoryOpenPkey) && !empty($ary_mainCategory[0]['pkey'])){
		$categoryOpenPkey = $ary_mainCategory[0]['pkey'];
	}
	if($categoryGet === ''){
		$ary_mainCategoryItem = array();
		foreach($ary_category as $value){
			if(!empty($ary_mainCategory[0]['pkey']) && $value['data_pkey'] == $ary_mainCategory[0]['pkey']){
				$ary_mainCategoryItem[] = $value;
			}
		}
		$categoryItemActive = !empty($ary_mainCategoryItem[0]['pkey']) ? $ary_mainCategoryItem[0]['pkey'] : '';
	}else{
		$categoryItemActive = $categoryGet;
	}


	$pageNow = (isset($_GET['p']) and $_GET['p'] != '') ? intval($_GET['p']) : 1;

	$pageNum = 12;			//每頁呈現最大筆數

	$ary_data = $obj_products->fetchAll('*' , " data_pkey = '".$categoryItemActive."' order by sort DESC ",True , array($pageNow-1 , $pageNum));


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
				<div class="col-md-2 col-sm-12 col-xs-12 hidden-sm hidden-xs">
					<div class="panel-group" id="accordion">
						<?php 							foreach($ary_mainCategory as $value){
								$htmlClassOpen = ($categoryOpenPkey==$value['pkey'])?'in':'';
						?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $value['pkey']?>"><?php echo $value['title']?></a>
								</h4>
							</div>
							<div id="collapse<?php echo $value['pkey']?>" class="panel-collapse collapse <?php echo $htmlClassOpen?>">
								<div class="panel-body">
									<?php 										foreach($ary_category as $value2){
											if($value2['data_pkey'] == $value['pkey']){
												$htmlCatagoryItemClass = ($categoryItemActive == $value2['pkey']) ? 'active' : '';

									?>
									<a href="products.php?c=<?php echo $value2['pkey']?>" class="list-group-item accordion-item-list <?php echo $htmlCatagoryItemClass?>"><?php echo $value2['title']?></a>
									<?php 											}
										}
									?>
								</div>
							</div>
						</div>
						<?php 							}
						?>
					</div>
				</div>
				<div class="col-md-10 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-md-12">
							<h2 class="prod-header"><?php echo $ary_categoryRe[$categoryOpenPkey]['title']?> / <span class="color-txt"><?php echo $ary_categoryRe[$categoryItemActive]['title']?></span></h2>
						</div>
						<?php 							$divDataaosdelay = 0;
							foreach($ary_data as $value){
						?>
						<div class="col-md-4 col-sm-6 col-xs-6 plr-0" data-aos="fade-up" data-aos-delay="<?php echo $divDataaosdelay?>" data-aos-duration="600">
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
	</div>

	<section class="pagination-sec">
	<!-- Page Content -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<a class="btn btn-default" href="products.php?c=<?php echo $categoryItemActive?>&p=<?php echo $prvePage?>">
						<i class="glyphicon glyphicon-chevron-left"></i>
					</a>
					<div class="btn-group dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<span class="page-num"> <?php echo $pageNow?> </span>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<?php 								for($i=1 ; $i<=$totalPage ; $i++){
									echo '<li><a href="products.php?c='.$categoryItemActive.'&p='.$i.'">'.$i.'</a></li>';
								}
							?>
						 </ul>
						
					</div>
					<a class="btn btn-default" href="products.php?c=<?php echo $categoryItemActive?>&p=<?php echo $nextPage?>">
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

    <style type="text/css">

    .sub-page .list-group-item:hover, .sub-page .list-group-item.active, .sub-page .list-group-item.active:hover{
    	border-bottom: none;
    }

    </style>

</body>

</html>
