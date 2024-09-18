<?PHP
include "./common.func.php";

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?PHP
//取出資料庫中no的最大值
$sql="
SELECT MAX(banner_no) FROM `banner` 
";

$result = $db->prepare("$sql");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
$result->execute();
$rows = $result->fetch(PDO::FETCH_ASSOC);
$max_no = $rows["MAX(banner_no)"];//取出資料庫中no的最大值;
//取出資料庫中no的最大值

//取出資料庫中no的最小值
$sql="
SELECT MIN(banner_no) FROM `banner` 
";
$result = $db->prepare("$sql");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
$result->execute();
$rows = $result->fetch(PDO::FETCH_ASSOC);
$min_no = $rows["MIN(banner_no)"];//取出資料庫中no的最小值


//跑回圈抓取回傳的編號對應的值
for ($no=$min_no;$no<=$max_no;$no++){
	$ck_no='ck_'.$no;
	$banner_sort_ck	=	$_POST["$ck_no"];//取原本資料庫的值
	$banner_sort	=	$_POST["$no"];//取設定的值
	
	if($banner_sort_ck<>$banner_sort){//如果原值和傳遞值不同，代表排序有變，則更新排序
	//echo '編號'.$no.'-'.$ck_no.'值等於='.$goods_item_sort.'原值='.$goods_item_sort_ck.'<br>';
		$sql="UPDATE `banner` SET 
	`banner_sort` =:banner_sort
	WHERE `banner_no` =:no ;";

	$result = $db->prepare("$sql");//防sql注入攻擊
	// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
	$result->bindValue(':banner_sort', $banner_sort, PDO::PARAM_INT);
	$result->bindValue(':no', $no, PDO::PARAM_INT);
	$result->execute();
	}
}

$db = null;// 關閉連線
?>
<script language="javascript">
	top.location.href='./index.php?ct=ind_banner&msg=updata';
</script>





