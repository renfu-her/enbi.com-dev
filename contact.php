<?php 	require_once 'config.php';
	include "uploads/captcha/simple-php-captcha.php";
	$_SESSION['captcha'] = simple_php_captcha();


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
	
	<section class="mt-15">
		<!-- Page Content -->
		<div class="container">
			<!-- Feature Section -->
			<div class="row">
				<div class="col-md-3 hidden-sm hidden-xs"></div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<h2 class="text-center">如何聯繫</h2>
					<p class="text-center mb-50">您好，若想詢問相關商品需求，可於下方表單進行留言，我們將會有專人與您聯絡或直接撥打 (02)2581-3521  (服務時間上午10:30~下午20:00)</p>
					
					<form class="form-horizontal" name="sentMessage" id="contactForm" enctype="multipart/form-data" onsubmit="return checkform();">
						<div class="control-group form-group">
							<div class="controls">
								<label class="col-sm-2 control-label text-right">姓名:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="name" required="">
									<p class="help-block"></p>	
								</div>
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label class="col-sm-2 control-label text-right">性別:</label>
								<div class="col-sm-10">
									<label class="radio-inline">
										<input type="radio" name="gender" value="1" checked>男
									</label>
									<label class="radio-inline">
										<input type="radio" name="gender" value="2">女
									</label>
									<p class="help-block"></p>
								</div>
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label class="col-sm-2 control-label text-right">電話:</label>
								<div class="col-sm-10">
									<input type="tel" class="form-control" id="phone" required="">
									<p class="help-block"></p>
								</div>
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label class="col-sm-2 control-label text-right">Email:</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" id="email" required="">
									<p class="help-block"></p>
								</div>
							</div>	
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label class="col-sm-2 control-label text-right">留言:</label>
								<div class="col-sm-10">
									<textarea rows="5" cols="50" class="form-control" id="message" maxlength="999" style="resize:none"></textarea>
									<p class="help-block"></p>	
								</div>
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label class="col-sm-2 control-label text-right">驗證碼:</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="captcha">
								</div>
								<div class="col-sm-4">
									<img class="captchaImg" width="68px" src="uploads/captcha/<?php echo $_SESSION['captcha']['image_src']?>"/>
									<label class="refresh">
										<a class="btn btn-refresh" >刷新 <i class="glyphicon glyphicon-refresh"></i> </a>
									</label>
								</div>
							</div>
						</div>
						<div id="success"></div>
						<!-- For success/fail messages -->
								
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="botton" class="btn btn-send btn-block">確認送出</button>
								<button type="reset" class="btn btn-reset btn-block">取消重填</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-3 hidden-sm hidden-xs"></div>
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


	function checkform () {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if($('#name').val() != '' && $('#phone').val() != '' && re.test(String($('#email').val()).toLowerCase()) ){
			$('#loading').fadeIn(300,function(){
					$.ajax({
							type: "POST",
							url: 'proc.php?proc=contact',
							data: 'uname='+$('#name').val()+
									'&gender='+$('input[name="gender"]:checked').val()+
									'&tel='+$('#phone').val()+
									'&email='+$('#email').val()+
									'&info='+$('#message').val()+
									'&captcha='+$('#captcha').val(),
							error: function(xhr) {
								$('#loading').fadeOut();
								alert('網路錯誤');
							},
							success: function (data, status, xhr) {
								$('#loading').fadeOut();
								if(data == 'succ'){
									alert('資料成功送出!');
									top.location.href = "./contact.php";
								}else if(data == 'captcha'){
									alert('驗證碼錯誤!');
								}else{
									// top.location.href = "./";
								}

							}
					});
			});
		}
		return false;
	}

	$(function(){
		$('.btn-refresh').click(function(){
			$('#loading').fadeIn(300,function(){
					$.ajax({
							type: "POST",
							url: 'proc.php?proc=captcha',
							data: '',
							error: function(xhr) {
								$('#loading').fadeOut();
								alert('網路錯誤');
							},
							success: function (data, status, xhr) {
								$('#loading').fadeOut();
								$('.captchaImg').attr('src','uploads/captcha/'+data);

							}
					});
			});
		});
	});

    </script>
	<div style="display: none;" id="loading" >
			<div class="image">
					<img src="images/loading.svg">
			</div>
	</div>
	<style>
	#loading {
			background-color: #000000;
			display: none;
			height: 100%;
			left: 0;
			position: fixed;
			top: 0;
			width: 100%;
			z-index: 10000;
			opacity: 0.8;
	}
	#loading .image {
			left: 50%;
			margin: -60px 0 0 -60px;
			position: absolute;
			top: 50%;
	}



	</style>

</body>

</html>
