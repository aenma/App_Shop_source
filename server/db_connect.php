<?php
require_once 'config.inc';
// MYSQL 접속
$conn = mysql_connect(DB_HOST, DB_ID, DB_PASSWORD) or die('서버접속에러');
if (!$conn) {
    die("error");
    exit;
}
// DB 선택
mysql_select_db(DB_NAME, $conn);


// GCM 발송
function sendGCM($registatoin_ids, $message)
{
   	  // 구글 푸시 발송 주소
     $url = 'https://android.googleapis.com/gcm/send';
   
     // 등록 아이디  및 메시지 를 배열에 넣어준다.ㄴ
     $fields = array(
         'registration_ids' => $registatoin_ids,
         'data' => array("CALPOOL" => $message),
         );
   
   		 // 인증 키를 헤더에 넣어준다.
         $headers = array(
             'Authorization: key=AIzaSyDb-VzHAx7WdVYZ9bSRSrH4eh8sFX5VQ_0',
    	     'Content-Type: application/json'
     );
	 // curl 라이브러리를 이용하여 구글 gcm에 push 요청을 수행한다.
 	 // 연결 초기화 
     $ch = curl_init();
     // Set the url, number of POST vars, POST data
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_POST, true);

	 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     // Disabling SSL Certificate support temporarly
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	 // 내용을 json으로 인코딩하여 전송 
     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
   
     // post 로 실행수행 
     $result = curl_exec($ch);
     if ($result === FALSE) {
         die('Curl failed: ' . curl_error($ch));
     }
   
     // 실행 수행후 연결을 종료한다.  
     curl_close($ch);
     //echo $result;	
	
}

?>