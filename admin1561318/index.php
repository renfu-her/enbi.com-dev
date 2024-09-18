<?php
require_once '../config.php';



$url_explode = explode("&",$_SERVER['QUERY_STRING']);
unset($_SESSION['redirectPageUrl']);
if(is_array($url_explode)){
  foreach($url_explode as $keyurl => $valueurl){
    if(strstr($url_explode[$keyurl],"msg") == false and $url_explode[$keyurl] != '' and strstr($url_explode[$keyurl],"ooooo") == false){
      $_SESSION['redirectPageUrl'] .= $url_explode[$keyurl].'&';
    }
  }
  $_SESSION['redirectPageUrl'] .= '&ooooo='.time().'&';
}


include "include/head.php";

?>
<body>
<div class="container">
  <div class="top-navbar header b-b"> <a data-original-title="Toggle navigation" class="toggle-side-nav pull-left" href="#"><i class="icon-reorder"></i> </a>
    <div class="brand pull-left"> <a>ENBI</a></div>
  
    <ul class="nav navbar-nav navbar-right  hidden-xs">
      <li class="dropdown user  hidden-xs"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="icon-male"></i><i class="icon-caret-down small"></i> </a>
        <ul class="dropdown-menu">
          <li><a href="log_process.php?logout=1"><i class="icon-key"></i> 登出</a></li>
        </ul>
      </li>
    </ul>

  </div>
</div>

<?php
if($_SESSION['AdminLogin'] != true ){

  include ("./login.php");
  
}else if($_SESSION['AdminLogin'] == true ){



  switch($_GET['ct']) {
    case '1':
    include ("ind_1.php");
    break;

    case '2':
    include ("ind_2.php");
    break;

    case '3':
    include ("ind_3.php");
    break;

    case '4':
    include ("ind_4.php");
    break;

    case '5':
    include ("ind_5.php");
    break;

    case '6':
    include ("ind_6.php");
    break;

    case '7':
    include ("ind_7.php");
    break;

    case '8':
    include ("ind_8.php");
    break;

    case '9':
    include ("ind_9.php");
    break;


    

    case '10':
    include ("ind_10.php");
    break;

    case '11':
    include ("ind_11.php");
    break;

    case '12':
    include ("ind_12.php");
    break;

    case '13':
    include ("ind_13.php");
    break;

    case '14':
    include ("ind_14.php");
    break;

    case '15':
    include ("ind_15.php");
    break;

    case '16':
    include ("ind_16.php");
    break;

    case '17':
    include ("ind_17.php");
    break;

    case '18':
    include ("ind_18.php");
    break;

    case '19':
    include ("ind_19.php");
    break;

    
    default:
?>
    <script type="text/javascript">
    location.href="index.php?ct=1&p=1";
    </script>
<?php
    exit;
    break;
  }

}
?>



</body>
</html>
