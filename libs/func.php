<?php
//函式
// include_once('class.phpmailer.php');

require(libs.'PHPMailerV2/PHPMailer.php');
require(libs.'PHPMailerV2/SMTP.php');
require(libs.'PHPMailerV2/Exception.php');



	function safe($content){  
    
		if (!get_magic_quotes_gpc()) {
			if (is_array($content)) {
				foreach ($content as $key=>$value) {
					$content[$key] = addslashes(trim($value));
				}
			}else{
				$content = addslashes(trim($content));
			}
		}else{
		}
		return $content;	
	
  
	}
  
  
 
	function Md5This($passwd_fun){

		$md5Pwd_fun = md5( '↙帝↗第'.$passwd_fun.'9qU♀8rK♪J0♂' );
		return $md5Pwd_fun ;
		
	}


	function showUserIp() {
		 if (isset($_SERVER)) {
			  if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				   $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			  } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
				   $realip = $_SERVER['HTTP_CLIENT_IP'];
			  } else {
				   $realip = $_SERVER['REMOTE_ADDR'];
			  }
		 } else {
			  if (getenv("HTTP_X_FORWARDED_FOR")) {
				   $realip = getenv("HTTP_X_FORWARDED_FOR");
			  } elseif (getenv("HTTP_CLIENT_IP")) {
				   $realip = getenv("HTTP_CLIENT_IP");
			  } else {
				   $realip = getenv("REMOTE_ADDR");
			  }
		 }
		 return $realip;
	}
	
	
	function set_session_time($expire = 0){
		if($expire == 0){
			$expire = ini_get('session.gc_maxlifetime');
		}else{
			ini_set('session.gc_maxlifetime', $expire);
		}

		if(empty($_COOKIE['PHPSESSID'])){
			session_set_cookie_params($expire);
			session_start();
		}else{
			session_start();
			setcookie('PHPSESSID', session_id(), time() + $expire);
		}
	}	
	
	
	function cutString($string, $max = 25) {
	        $strlen = mb_strlen($string, 'UTF-8');
	        $cutLen = 0;
	        $retval = "";
	        for ($i = 0; $i < $strlen; $i++) {
	            $s = mb_substr($string, $i, 1, 'UTF-8');
	            if (strlen($s) == 1) {
	                $cutLen++;
	            } else {
	                $cutLen++;
	            }
	            $retval .= $s;
	            if ($cutLen >= $max) {
	                return $retval.= '...';
	            }
	        }
	 
	        return $retval;
	}
	

	function cut_content($a,$b){
		$sub_content = mb_substr($a, 0, $b, 'UTF-8');
		if (strlen($a) > strlen($sub_content)){
			$sub_content .= '...';
		}
		return $sub_content;
	}	


	
	
	
	
	
	

	function send_mail( $subject = 'No subject', $body , $to='' , $cc='', $bcc='' ) {
		//global $mailname_from, $mail_from;

		$mail= new PHPMailer\PHPMailer\PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;     
		$mail->SMTPSecure = "ssl";
		$mail->Encoding  = "base64";
		$mail->Host = "smtp.gmail.com";       
		$mail->Port = 465;      
		$mail->CharSet = "UTF-8";
		$mail->Username = mail_login_name; 
		$mail->Password = mail_login_pass; 
		$mail->From = mail_login_name; 
		$mail->FromName = mail_login_name;
		$mail->IsHTML(true);


		// $mail             = new PHPMailer(); // defaults to using php "mail()"
		// $mail->IsSMTP(); // telling the class to use SMTP
		// $mail->SetLanguage("zh");
		// $mail->Host     = mail_server;   
		// $mail->Mailer   = "SMTP";   
		// $mail->CharSet = "UTF-8";
		// $mail->Encoding  = "base64";
		// $mail->SMTPAuth   = false;                  // enable SMTP authentication
		// $mail->Username   = mail_login_name;  // GMAIL username
		// $mail->Password   = mail_login_pass;            // GMAIL password
		// $mail->Port       = smtp_port;  


		$mail->From       = mail_login_name;
		$mail->FromName   = mail_login_name;
		
		$mail->Subject    = "=?UTF-8?B?" . base64_encode($subject) . "?=";
		
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->MsgHTML($body);
		//$mail->AddAttachment($path, $name);
		
		
		
		$toemail = explode (";", $to.";");
		foreach($toemail as $email){
			if(strlen($email)>1)
				$mail->AddAddress($email,$email);
		}

		$bccemail = explode (";", $bcc.";");
		foreach($bccemail as $email){
			if(strlen($email)>1)
				// $mail->addCustomHeader("BCC: ".$email); 
				$mail->AddBCC($email,$email);
		}
		 
		$ccemail = explode (";", $cc.";");
		foreach($ccemail as $email){
			if(strlen($email)>1)
				$mail->AddCC($email,$email);
		}
		

		
		$mail->IsHTML(true); // send as HTML
		
		//$mail->AddAttachment("images/phpmailer.gif");             // attachment
		
		if(!$mail->Send()) {
			return "Mailer Error: " . $mail->ErrorInfo;
		} else {
			return "Message sent!";
		}
		
	}	
	
	
	function pic_upload_proc($file_name , $file_temp_name , $limitW = 0 , $limitH = 0 ){
	
	
		global $server_root;
		//$file_name= $_FILES['pic']['name']; //檔案名字
		//$file_temp_name = $_FILES['pic']['tmp_name']; //伺服器上暫存檔名
		 
		$filename = $file_temp_name;
		list($width, $height,$type,$attr) = getimagesize($filename);
		if($width != $limitW && $limitW != 0){
			return 'sizeErr';
			exit;
		}
		if($height != $limitH && $limitH != 0){
			return 'sizeErr';
			exit;
		}


		//對檔名作處理
		//分開前檔名與副檔名
		$File_Extension = explode(".", $file_name);
		//最後一個點後的才是真正的副檔名
		$File_Extension = $File_Extension[count($File_Extension)-1];
		 
		//新的檔名
		$new_filename = md5(uniqid(mt_rand(), true));		//產生獨一無二的id
		$ServerFilename = $new_filename.".".$File_Extension;
		//放到伺服器上的哪裡
		$DestDIR = $server_root.$ServerFilename;
		 //這就是圖片引用的URL
		//$ServerFilename = 'http://............../'.$ServerFilename;
		 
		if(is_uploaded_file($file_temp_name)){
		 
		//搬移檔案到指定的目錄下
		move_uploaded_file($file_temp_name, $DestDIR);
		
		return $ServerFilename;
		 
		}
		

	
	}


	
	
	
	
	
	
	function file_upload_proc($file_name , $file_temp_name ){
	
	
		global $server_root;
		//$file_name= $_FILES['pic']['name']; //檔案名字
		//$file_temp_name = $_FILES['pic']['tmp_name']; //伺服器上暫存檔名
		 
		//對檔名作處理
		//分開前檔名與副檔名
		$File_Extension = explode(".", $file_name);
		//最後一個點後的才是真正的副檔名
		$File_Extension = $File_Extension[count($File_Extension)-1];
		 
		//新的檔名
		$new_filename = md5(uniqid(mt_rand(), true));		//產生獨一無二的id
		$ServerFilename = $new_filename.".".$File_Extension;
		//放到伺服器上的哪裡
		$DestDIR = $server_root.$ServerFilename;
		 //這就是圖片引用的URL
		//$ServerFilename = 'http://............../'.$ServerFilename;
		 
		if(is_uploaded_file($file_temp_name)){
		 
		//搬移檔案到指定的目錄下
		move_uploaded_file($file_temp_name, $DestDIR);
		
		return $ServerFilename;
		 
		}
		

	
	}
	

	function linkifyYouTubeURLs($text) {
		$text = preg_replace('~(?#!js YouTubeId Rev:20160125_1800)
			# Match non-linked youtube URL in the wild. (Rev:20130823)
			https?://          # Required scheme. Either http or https.
			(?:[0-9A-Z-]+\.)?  # Optional subdomain.
			(?:                # Group host alternatives.
			  youtu\.be/       # Either youtu.be,
			| youtube          # or youtube.com or
			  (?:-nocookie)?   # youtube-nocookie.com
			  \.com            # followed by
			  \S*?             # Allow anything up to VIDEO_ID,
			  [^\w\s-]         # but char before ID is non-ID char.
			)                  # End host alternatives.
			([\w-]{11})        # $1: VIDEO_ID is exactly 11 chars.
			(?=[^\w-]|$)       # Assert next char is non-ID or EOS.
			(?!                # Assert URL is not pre-linked.
			  [?=&+%\w.-]*     # Allow URL (query) remainder.
			  (?:              # Group pre-linked alternatives.
				[\'"][^<>]*>   # Either inside a start tag,
			  | </a>           # or inside <a> element text contents.
			  )                # End recognized pre-linked alts.
			)                  # End negative lookahead assertion.
			[?=&+%\w.-]*       # Consume any URL (query) remainder.
			~ix', '$1',
			$text);
		return $text;
	}

	function covYoutubeTime($youtube_time) {
		preg_match_all('/(\d+)/',$youtube_time,$parts);

		// Put in zeros if we have less than 3 numbers.
		if (count($parts[0]) == 1) {
			array_unshift($parts[0], "0", "0");
		} elseif (count($parts[0]) == 2) {
			array_unshift($parts[0], "0");
		}

		$sec_init = $parts[0][2];
		$seconds = $sec_init%60;
		$seconds_overflow = floor($sec_init/60);

		$min_init = $parts[0][1] + $seconds_overflow;
		$minutes = ($min_init)%60;
		$minutes_overflow = floor(($min_init)/60);

		$hours = $parts[0][0] + $minutes_overflow;

		if($hours != 0)
			return ($hours*60*60)+($minutes*60)+$seconds;
		else
			return ($minutes*60)+$seconds;
	}

	function Ucs2Code($str,$encode="UTF-8"){
		$jumpbit=strtoupper($encode)=='GB2312'?2:3;//跳转位数
		$strlen=strlen($str);//字符串长度
		$pos=0;//位置
		$buffer=array();
		for($pos=0;$pos<$strlen;){
			if(ord(substr($str,$pos,1))>=0xa1){//0xa1（161）汉字编码开始
				$tmpChar=substr($str,$pos,$jumpbit);
				$pos+=$jumpbit;
			}else{
				$tmpChar=substr($str,$pos,1);
				++$pos;
			}
				$buffer[]=bin2hex(iconv("UTF-8","UCS-2",$tmpChar));
		}
		return strtoupper(join("",$buffer));
	}
	
	
	function strip_magic_slashes($str) {    
		return get_magic_quotes_gpc() ? stripslashes($str) : $str; 
	}


?>