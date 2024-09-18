<?php 

	if(strpos($_SERVER['REQUEST_URI'],'story.php') || strpos($_SERVER['REQUEST_URI'],'agent.php') ){
		$htmlMenuClass1 = 'active';
	}else if(strpos($_SERVER['REQUEST_URI'],'news.php') || strpos($_SERVER['REQUEST_URI'],'news-content.php') ){
		$htmlMenuClass2 = 'class="active"';
	}else if(strpos($_SERVER['REQUEST_URI'],'products.php') || strpos($_SERVER['REQUEST_URI'],'products-content.php') ){
		$htmlMenuClass3 = 'active';
	}else if(strpos($_SERVER['REQUEST_URI'],'stores.php') || strpos($_SERVER['REQUEST_URI'],'storelist.php')){
		$htmlMenuClass4 = 'active';
	}else if(strpos($_SERVER['REQUEST_URI'],'service.php') || strpos($_SERVER['REQUEST_URI'],'clean.php') ){
		$htmlMenuClass5 = 'active';
	}else if(strpos($_SERVER['REQUEST_URI'],'unboxing.php') || strpos($_SERVER['REQUEST_URI'],'unboxing-content.php') ){
		$htmlMenuClass6 = 'active';
	}else if(strpos($_SERVER['REQUEST_URI'],'contact_us.php')){
		$htmlMenuClass7 = 'active';
	}

	if(strpos($_SERVER['REQUEST_URI'],'index.php') || !strpos($_SERVER['REQUEST_URI'],'.php') ){
		$htmlLogo = '<a class="navbar-brand" href="index.php"><img src="images/logo.png" class="img-responsive" /> </a>';
	}else{
		$htmlLogo = '<a class="navbar-brand" href="index.php"><img src="images/logo-gray.png" class="img-responsive d-show" /><img src="images/logo.png" class="img-responsive m-show" /> </a>';
	}


	$ary_categoryMenu = $obj_category->fetchAll_join('*' , " order by sort DESC ");

	foreach($ary_categoryMenu as $value){
		if($value['data_pkey'] == 0){
			$ary_mainCategoryMenu[] = $value;
		}
	}



?>


		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->

			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php echo $htmlLogo?>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" >
				<ul class="nav navbar-nav">

					<!-- <li <?php echo $htmlMenuClass1?>>
						<a href="story.php">品牌故事</a>
					</li>
					<li <?php echo $htmlMenuClass2?>>
						<a href="news.php">活動訊息</a>
					</li>
					<li <?php echo $htmlMenuClass3?>>
						<a href="products.php">商品專區</a>
					</li>
					<li <?php echo $htmlMenuClass5?>>
						<a href="service.php">專屬服務</a>
					</li>
					<li <?php echo $htmlMenuClass4?>>
						<a href="stores.php">門市資訊</a>
					</li> -->




					<!--<li class="m-none  <?php echo $htmlMenuClass1?>" >
						<a href="story.php">品牌故事</a>
					</li>
					<li class="d-none m-block">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">品牌故事 <span class="caret"></span></a>
						<ul class="dropdown-menu multi-level">
							<li><a href="story.php">品牌故事</a></li>
							<li><a href="agent.php">代理品牌</a></li>
						</ul>
					</li>-->
					<li <?php echo $htmlMenuClass2?>>
						<a href="news.php">活動快訊</a>
					</li>
					<li class="m-none <?php echo $htmlMenuClass3?>">
						<a href="products.php">商品專區</a>
					</li>
					<li class="d-none m-block">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">商品專區 <span class="caret"></span></a>
						<ul class="dropdown-menu multi-level">
							<?php 								foreach($ary_mainCategoryMenu as $value){

							?>
							<li class="dropdown-submenu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $value['title']?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<?php 										foreach($ary_categoryMenu as $value2){
											if($value2['data_pkey'] == $value['pkey']){
									?>
									<li><a href="products.php?c=<?php echo $value2['pkey']?>"><?php echo $value2['title']?></a></li>
									<?php 											}
										}
									?>
								</ul>
							</li>
							<?php 								}
							?>
						</ul>
					</li>
					<li  class="<?php echo $htmlMenuClass6?>">
                        <a href="unboxing.php">開箱特輯</a>
                    </li>
                    
					<!--<li class="m-none <?php echo $htmlMenuClass5?>">
						<a href="service.php">專屬服務</a>
					</li>
					<li class="d-none m-block">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">專屬服務 <span class="caret"></span></a>
						<ul class="dropdown-menu multi-level">
							<li><a href="service.php">客製化刺繡</a></li>
							<li><a href="clean.php">到府除塵蟎</a></li>
						</ul>
					</li>-->
					<li class="m-none <?php echo $htmlMenuClass4?>">
						<a href="stores.php">經銷據點</a>
					</li>
					<li class="d-none m-block">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">經銷據點 <span class="caret"></span></a>
						<ul class="dropdown-menu multi-level">
							<li><a href="storelist.php?a=1">北區</a></li>
							<li><a href="storelist.php?a=2">中區</a></li>
							<li><a href="storelist.php?a=3">南區</a></li>
						</ul>
					</li>

					<li  class="<?php echo $htmlMenuClass7?>">
                        <a href="contact_us.php">合作洽談</a>
                    </li>






					

				</ul>
				<div class="col-md-3 col-sm-12 col-xs-12  pull-right">
					<form class="navbar-form" role="search" action="search.php">
						<div class="input-group">
							<input name="s" type="text" class="form-control search-form" placeholder="搜尋" style="color: #666">
							<div class="input-group-btn">
								<button class="btn btn-default search-btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
