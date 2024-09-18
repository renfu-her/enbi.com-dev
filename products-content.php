<?php 	require_once 'config.php';

	if(!$ary_get['p']){
		header("Location:./products.php");
		exit;
	}

	$ary_data = $obj_products -> fetch('*' , " pkey = '".$ary_get['p']."' ");
	if(!$ary_data){
		header("Location:./products.php");
		exit;
	}



	$ary_category = $obj_category -> fetchAll_join('*' , " order by sort DESC ");

	foreach($ary_category as $value){
		$ary_categoryRe[$value['pkey']] = $value;
		if($ary_data['data_pkey'] == $value['pkey']){
			$categoryOpenPkey = $value['data_pkey'];
		}
		if($value['data_pkey'] == 0){
			$ary_mainCategory[] = $value;
		}
	}

	if(!$categoryOpenPkey){
		$categoryOpenPkey = $ary_mainCategory['0']['pkey'];
	}
	$categoryItemActive = $ary_data['data_pkey'];




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
				<div class="col-md-10 col-sm-12 col-xs-12 mb-30">
					<div class="row">
						<div class="col-md-12">
							<h2 class="prod-header"><?php echo $ary_data['title']?></h2>
						</div>
						<div class="col-md-12 editorImg" >
							<?php echo $ary_data['info']?>
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
			<div class="row">
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

    <style type="text/css">

    .sub-page .list-group-item:hover, .sub-page .list-group-item.active, .sub-page .list-group-item.active:hover{
    	border-bottom: none;
    }

    </style>


</body>

</html>
