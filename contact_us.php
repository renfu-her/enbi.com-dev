<?php 	require_once 'config.php';

	$pageNow = (isset($_GET['p']) and $_GET['p'] != '') ? intval($_GET['p']) : 1;

	$pageNum = 6;			//每頁呈現最大筆數

	$ary_data = $obj_news->fetchAll_join('*' , " order by newsdate DESC ",True , array($pageNow-1 , $pageNum));


	$totalPage = ceil(($obj_news->num) / $pageNum);
	$prvePage = (($pageNow-1) <= 0) ? 1 : $pageNow-1;
	$nextPage = (($pageNow+1) >= $totalPage) ? $totalPage : $pageNow+1;

include "./admin1561318/common.func.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<?php include icld.'head.php'; ?>

</head>

<body class="sub-page">

    <nav class="navbar navbar-inverse navbar-bg-white navbar-static-top" role="navigation">
        <?php include './include/nav.php'; ?>
    </nav>
	
	<section style="background-color: #f6f7f7;"> <!-- 20181111 edited /// mt-50 mb-50 edit to mt-15 ///  -->
		<!-- Page Content -->
		<div class="container">
			<!-- Feature Section -->
			<div class="row">
				<div class="col-md-offset-2 col-md-8 col-sm-12 col-xs-12 py-5">
					<h2 class="text-center">填寫表單</h2> <!-- 20181111 edited /// remove mb-30 ///  -->
					<p class="text-center mb-50">請填寫以下資料，我們將有專人與您聯絡</p>
					
					<form name="form_sendmail" id="form_sendmail" action="send_contact_2.php" method="post" >
						<div class="control-group form-group form-group-lg">
							<div class="controls">
								<label class="col-sm-12 control-label"><span style="color:red">*</span>聯絡人</label>
								<div class="col-sm-12 mb-30">
									<input type="text" class="form-control" id="contact_name" name="contact_name" required="">
									<p class="help-block"></p>	
								</div>
							</div>
						</div>
						<div class="control-group form-group form-group-lg">
							<div class="controls">
								<label class="col-sm-12 control-label">公司名稱</label>
								<div class="col-sm-12 mb-30">
									<input type="text" class="form-control" id="contact_company" name="contact_company">
									<p class="help-block"></p>	
								</div>
							</div>
						</div>
						<div class="control-group form-group form-group-lg">
							<div class="controls">
								<label class="col-sm-12 control-label"><span style="color:red">*</span>聯絡電話</label>
								<div class="col-sm-12 mb-30">
									<input type="tel" class="form-control" id="contact_tel" name="contact_tel" required="">
									<p class="help-block"></p>
								</div>
							</div>
						</div>
						<div class="control-group form-group form-group-lg">
							<div class="controls">
								<label class="col-sm-12 control-label">地址</label>
								<div class="col-sm-12 mb-30">
									<input type="text" class="form-control" id="contact_address" name="contact_address">
									<p class="help-block"></p>	
								</div>
							</div>
						</div>
						<div class="control-group form-group form-group-lg">
							<div class="controls">
								<label class="col-sm-12 control-label"><span style="color:red">*</span>電子郵件</label>
								<div class="col-sm-12 mb-30">
									<input type="email" class="form-control" id="contact_email" name="contact_email" required="">
									<p class="help-block"></p>
								</div>
							</div>
						</div>
						<div class="control-group form-group form-group-lg">
							<div class="controls">
								<label class="col-sm-12 control-label"><span style="color:red">*</span>詢問項目</label>
								<div class="col-sm-12 mb-30">
									<select class="form-control" id="contact_objects" name="contact_objects" required>
										<option value="">請選擇</option>
										<option value="產品諮詢">產品諮詢</option>
										<option value="經銷合作">經銷合作</option>
										<option value="體驗開箱">體驗開箱</option>
										<option value="批發諮詢">批發諮詢</option>
										<option value="其他">其他</option>
									</select>
								</div>
							</div>
						</div>
						<div class="control-group form-group form-group-lg">
							<div class="controls">
								<label class="col-sm-12 control-label">內容:</label>
								<div class="col-sm-12 mb-30">
									<textarea rows="5" cols="50" class="form-control" id="contact_message" name="contact_message" maxlength="999" style="resize:none"></textarea>
									<p class="help-block"></p>	
								</div>
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label class="col-sm-12 control-label"></label>
								<div class="col-sm-12 mb-30">
									<script src='https://www.google.com/recaptcha/api.js'></script>	   
									<div class="g-recaptcha wow fadeInDown animated" data-sitekey="<?=$google_data_sitekey?>"></div>
								</div>
							</div>
						</div>

						<div id="success"></div>
						<!-- For success/fail messages -->
								
						<div class="form-group">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-send btn-block">確認送出</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-3 hidden-sm hidden-xs"></div>
			</div>
			<!-- /.row -->
		</div>
	</section>
		
	<aside class="asidebar">
        <ul class="list-unstyled">
          <li><a href="https://www.facebook.com/enbiliving2018" target="_blank"><img class="side_ic" src="./images/side_ic01.png" alt="恩比Facebook官方粉絲團"></a></li>
          <li><a href="tel:02-24321008"><img class="side_ic" src="./images/side_ic02.png" alt="聯絡恩比"></a></li>
        </ul>
    </aside>
	
	<!-- Footer Info Section -->	
	<section class="footer-sec">
	<!-- Page Content -->
		<div class="container">
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

</body>

</html>
<!-- 表單避免重複提交 -->
<script>
  // 獲取具有 name="form_sendmail" 的表單元素
  const form = document.querySelector('form[name="form_sendmail"]');
  const submitBtn = form.querySelector('[type="submit"]');

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    if (!form.checkValidity()) {
      // 如果表單未通過驗證，不執行後續代碼
    } else {
      submitBtn.disabled = true;
      submitBtn.value = '上傳中...';
      // 在這裡添加文件上傳的代碼
      form.submit(); // 手動提交表單
    }
  });
</script>
<!-- 表單避免重複發送 -->