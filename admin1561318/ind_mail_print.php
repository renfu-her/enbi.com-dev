<?php
include_once libs.'pageAD.php';
include "./common.func.php";
##$pageNow = (isset($_GET['p']) and $_GET['p'] != '') ? intval($_GET['p']) : 1;
?>
<?PHP
$edit_no	=	$_GET['no'];

$sql="SELECT * 
FROM `mail` 
where no=:edit_no;";

$result = $db->prepare("$sql");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
$result->bindValue(':edit_no', $edit_no, PDO::PARAM_INT);
$result->execute();
$rows = $result->fetch(PDO::FETCH_ASSOC);
?>
<div class="wrapper">
<?php
include "include/menu.php";
?>
	<div class="page-content">
		<div class="content container">
			<div class="row">
				<div class="col-lg-12">
					<div class="widget">
						<div class="widget-header"> <i class="icon-list-ol"></i>
							<h3>合作洽談</h3>



						</div>
						<div class="widget-content">
							<div class="body">
								

     
<div class="text-right" style="padding-right: 15px;"><i class="fa fa-clock-o"></i>發送時間：<?=$rows["date"];?></div>    
            <!-- /.box-header -->
            
            <div class="box-body no-padding">
             <style>
				td, th {
					padding: 3px  !important;
				}
				</style>
              <table width="100%" align="center">   
                 <tr>
                  <td  width="100" valign="top" class="text-right">姓名：</td>
                  <td><?=$rows["name"];?></td>                 
                </tr>
                <tr>
                  <td  width="100" valign="top" class="text-right">公司名稱：</td>
                  <td><?=$rows["company"];?></td>                 
                </tr>               
                 <tr>
                  <td  width="100" valign="top" class="text-right">連絡電話：</td>
                  <td><?=$rows["tel"];?></td>                 
                </tr>
                 <tr>
                  <td  width="100" valign="top" class="text-right">電子郵件：</td>
                  <td><?=$rows["mail"];?></td>                 
                </tr>
                 <tr>
                  <td  width="100" valign="top" class="text-right">地址：</td>
                  <td><?=$rows["address"];?></td>                 
                </tr>
                 <tr>
                  <td  width="100" valign="top" class="text-right">詢問項目：</td>
                  <td><?=$rows["objects"];?></td>                 
                </tr>                 
                 <tr>
                  <td  width="100" valign="top" class="text-right">留言：</td>
                  <td><?=nl2br($rows["message"]);?></div>
                  	 
                  </td>                 
                </tr>
               
               
              </table>
            </div>
            
            <!-- /.box-body -->
     <div class="text-right"  style="margin-bottom: 20px;">發送IP位置：<?=$rows["ip"];?></div>
          
								<div class="clearfix">

										<input type="button" value="返回" class="btn btn-default btn_bt"  onclick="location.href='./index.php?ct=ind_mail'"/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="bottom-nav footer"></div>
 

<div style="display: none;" id="loading" >
		<div class="image">
				<img src="images/ring.svg">
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
		z-index: 4;
		opacity: 0.8;
}
#loading .image {
		left: 50%;
		margin: -60px 0 0 -60px;
		position: absolute;
		top: 50%;
}



</style>
