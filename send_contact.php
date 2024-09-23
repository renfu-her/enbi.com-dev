<?PHP
if (!isset($_SESSION)) {
	session_start();
}

exit;
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
include "./admin1561318/common.func.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);
$contact_name 		=	$_POST["contact_name"];
$contact_email 		=	$_POST["contact_email"];
$contact_tel 		=	$_POST["contact_tel"];
$contact_objects	=	$_POST["contact_objects"];
$contact_message 	=	$_POST["contact_message"];

$contact_company	=	$_POST["contact_company"];
$contact_address	=	$_POST["contact_address"];

//google我不是機器人
$captcha = $_POST['g-recaptcha-response'];
$secretKey = "$google_secretKey";
$ip = $_SERVER['REMOTE_ADDR'];

$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
$response = file_get_contents($url);
$responseKeys = json_decode($response, true);

if ($responseKeys["success"]) { // success//google我不是機器人


	$edittime   =	date("Y-m-d H:i:s"); //新增時間

	if (!empty($_SERVER['HTTP_CLIENT_IP']))
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else
		$ip = $_SERVER['REMOTE_ADDR'];






	$send_email = 'enbiliving@gmail.com,amiwu2012@gmail.com'; //收件者


	//新增
	$sql = "insert into mail (
`name` ,
`mail` ,
`tel` ,
`company` ,
`address` ,
`objects` ,
`message` ,
`date` ,
`ip`
)	VALUES (
:contact_name,
:contact_email,
:contact_tel,
:contact_company,
:contact_address,
:contact_objects,
:contact_message,
:edittime,
:ip
)";


	$result = $db->prepare("$sql"); //防sql注入攻擊
	// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
	$result->bindValue(':contact_name', $contact_name, PDO::PARAM_STR);
	$result->bindValue(':contact_email', $contact_email, PDO::PARAM_STR);
	$result->bindValue(':contact_tel', $contact_tel, PDO::PARAM_STR);
	$result->bindValue(':contact_objects', $contact_objects, PDO::PARAM_STR);
	$result->bindValue(':contact_message', $contact_message, PDO::PARAM_STR);

	$result->bindValue(':contact_company', $contact_company, PDO::PARAM_STR);
	$result->bindValue(':contact_address', $contact_address, PDO::PARAM_STR);

	$result->bindValue(':edittime', $edittime, PDO::PARAM_STR);
	$result->bindValue(':ip', $ip, PDO::PARAM_STR);


	$result->execute();


	$db = null; // 關閉連線



	//Mail
	$message  = "
		<table width='700' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td align='left'>姓名 ：$contact_name</td>
  </tr>
  <tr>
    <td align='left'>公司名稱 ：$contact_company</td>
  </tr>
   <tr>
    <td align='left'>連絡電話 ： $contact_tel </td>
  </tr>
  <tr>
    <td align='left'>電子郵件   ： $contact_email</td>
  </tr> 
  <tr>
    <td align='left'>地址   ： $contact_address</td>
  </tr>
  <tr>
    <td align='left'>詢問項目   ： $contact_objects</td>
  </tr>
 
  <tr>
    <td align='left'>留言   ： </td>
  </tr>

    <tr>
      <td align='left'>" . nl2br($contact_message) . "</td>
    </tr>
</table>
";

	//mail發送
	//mail發送
	//設定time out
	set_time_limit(120);
	//echo !extension_loaded('openssl')?"Not Available":"Available";

	$send_email_array = explode(",", $send_email); //根据逗号分割存入数组
	foreach ($send_email_array as $recipient) {
		$recipient = trim($recipient); // 移除可能的空格
		if (filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
			// $mail->addAddress($recipient);
			$emails[] = $recipient;
		}
	}

	$emails[] = 'renfu.her@gmail.com';

	$postData = [
		'emails' => $emails,
		'message' => $message,
		'subject' => '[恩比寢飾官網] 網站來信諮詢',
		'mail_username' => 'enbiservice@gmail.com',
		'mail_password' => 'ubqfiteepubjbgou',
	];

	var_dump($postData);
	exit;

	$ch = curl_init('https://message-sent.dev-vue.com/api/send-mail');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

	$response = curl_exec($ch);
	curl_close($ch);

	if (!$mail->send()) {
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		echo "<Script Language =\"Javascript\">";
		echo "alert('伺服器寄送失敗，或請直接來信或來電連繫，謝謝您!');";
		echo "location='./';";
		echo "</script>";
	} else {
		echo "<Script Language =\"Javascript\">";
		echo "alert('已順利送出資訊，我們將會盡快與您做聯繫，謝謝您!');";
		echo "location='./';";
		echo "</script>";
	}
	//mail發送



} else { // error//google我不是機器人
	echo '<script language="javascript">';
	echo 'alert("請勾選 我不是機器人");';
	echo "history.back();";
	echo '</script>';
	exit();
}
//google我不是機器人
