<?php



if(!$obj_admin->fetch('*' , " pkey = '".$_SESSION['AdminPkey']."' AND is_main = '1' ")){
  $menuAdminHide = 'style="display:none;"';
}


?>

  <div class="left-nav">
    <div id="side-nav">
      <ul id="nav">
        <li <?if($_GET['ct']=='1'){ echo 'class="current"';}?>> <a href="index.php?ct=1"> 首頁輪播banner </a> </li>
        <li <?if($_GET['ct']=='2'){ echo 'class="current"';}?>> <a href="index.php?ct=2"> 廣告banner </a> </li>
    		<li>
    			<a class="fancybox" data-fancybox-type="iframe" href="proc.php?proc=edit&ct=91&pk=1">品牌故事</a>
    		</li>
    		<li>
    			<a class="fancybox" data-fancybox-type="iframe" href="proc.php?proc=edit&ct=91&pk=2">代理品牌</a>
    		</li>
        <li <?if($_GET['ct']=='3'){ echo 'class="current"';}?>> <a href="index.php?ct=3"> 活動訊息 </a> </li>
        <li <?if($_GET['ct']=='4'){ echo 'class="current"';}?>> <a href="index.php?ct=4"> 產品大類 </a> </li>
        <li <?if($_GET['ct']=='5'){ echo 'class="current"';}?>> <a href="index.php?ct=5"> 產品子類 </a> </li>
        <li <?if($_GET['ct']=='6'){ echo 'class="current"';}?>> <a href="index.php?ct=6"> 產品 </a> </li>

        <li>
          <a class="fancybox" data-fancybox-type="iframe" href="proc.php?proc=edit&ct=91&pk=3">客製化刺繡</a>
        </li>
        <li>
          <a class="fancybox" data-fancybox-type="iframe" href="proc.php?proc=edit&ct=91&pk=4">到府除塵蟎</a>
        </li>

        <li <?if($_GET['ct']=='9'){ echo 'class="current"';}?>> <a href="index.php?ct=9"> 門市資訊 </a> </li>
        <li <?if($_GET['ct']=='8'){ echo 'class="current"';}?> <?php echo $menuAdminHide?>> <a href="index.php?ct=8"> 管理者 </a> </li>
      </ul>
    </div>
  </div>
