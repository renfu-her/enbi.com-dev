<?PHP
include "./common.func.php";

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?PHP
//取出資料庫中no的最大值
$sql="
SELECT MAX(news_no) FROM `news` 
";

$result = $db->prepare("$sql");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
$result->execute();
$rows = $result->fetch(PDO::FETCH_ASSOC);
$max_no = $rows["MAX(news_no)"];//取出資料庫中no的最大值;
//取出資料庫中no的最大值

//取出資料庫中no的最小值
$sql="
SELECT MIN(news_no) FROM `news` 
";
$result = $db->prepare("$sql");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
$result->execute();
$rows = $result->fetch(PDO::FETCH_ASSOC);
$min_no = $rows["MIN(news_no)"];//取出資料庫中no的最小值


//跑回圈抓取回傳的編號對應的值
for ($no=$min_no;$no<=$max_no;$no++){
	$ck_no='ck_'.$no;
	$news_sort_ck	=	$_POST["$ck_no"];//取原本資料庫的值
	$news_sort	=	$_POST["$no"];//取設定的值
	
	if($news_sort_ck<>$news_sort){//如果原值和傳遞值不同，代表排序有變，則更新排序
	//echo '編號'.$no.'-'.$ck_no.'值等於='.$goods_item_sort.'原值='.$goods_item_sort_ck.'<br>';
		$sql="UPDATE `news` SET 
	`news_sort` =:news_sort
	WHERE `news_no` =:no ;";

	$result = $db->prepare("$sql");//防sql注入攻擊
	// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
	$result->bindValue(':news_sort', $news_sort, PDO::PARAM_INT);
	$result->bindValue(':no', $no, PDO::PARAM_INT);
	$result->execute();
	}
}

$db = null;// 關閉連線
?>
<script language="javascript">
	top.location.href='./index.php?ct=ind_unboxing&msg=updata';
</script>





