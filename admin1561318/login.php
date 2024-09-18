<!DOCTYPE html>
<html>
<head>
<title>Thin Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet" media="screen" />
<link href="css/thin-admin.css" rel="stylesheet" media="screen" />
<link href="css/font-awesome.css" rel="stylesheet" media="screen" />
<link href="style/style.css" rel="stylesheet" />



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
<div class="login-logo">
	<!-- <img src="images/logo.png" width="77" height="27" />  -->
    </div>

<div class="widget">
<div class="login-content">
  <div class="widget-content" style="padding-bottom:0;">
  <form method="POST" action="log_process.php" class="no-margin" />
                <h3 class="form-title">登入</h3>
                
                <fieldset>
                    <div class="form-group no-margin">
                        <label for="email">帳號</label>

                        <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="icon-user"></i>
                                </span>
                            <input type="text" placeholder="請輸入帳號" class="form-control input-lg" id="email" name="acc" />
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="password">密碼</label>

                        <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="icon-lock"></i>
                                </span>
                            <input type="password" placeholder="請輸入密碼" class="form-control input-lg" id="password" name="pwd" />
                        </div>

                    </div>
                </fieldset>
               <div class="form-actions">
				<label class="checkbox">
				<div class="checker">
				</label>
				<button class="btn btn-warning pull-right" type="submit">
				登入 <i class="m-icon-swapright m-icon-white"></i>
				</button> 
                <div class="forgot"></div>           
			</div>
            
            
            </form>
  
  
  </div>
   </div>
</div>








<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script> 



 

</body>
</html>
