<?php

require_once 'db_connect.php';  // 디비 연결하기
// post 값이 없으면 정상경로가 아니다.
if(isset($_POST) === false){
	// 메인 페이지로 이동한다.
	$url = "../index.html";
	echo '
			<script>
				window.location.href = "'.$url.'";
			</script>';
	exit;	
}

// array  벗겨내기
extract($_POST);

$userImage = iconv( "UTF-8", "EUC-KR",  $userImage);
$userName = iconv( "UTF-8", "EUC-KR",  $userName);
$userClass = iconv( "UTF-8", "EUC-KR",   $userClass);

$sql = "insert market_user 
		( 
		  user_image
		, user_name
		, user_id
		, user_class
		, phone
		, pwd
		) values(
		  '{$userImage}'
		,  '{$userName}'
		, '{$userId}'
		, '{$userClass}'
		, '{$phone}'
		, password('{$pwd}') )";
		
$result = mysql_query($sql);
$resultArray = array();
if(mysql_affected_rows() > 0){		// 가입성공
	$resultArray['success'] = 'success';
}else{
	$resultArray['success'] = 'fail';
}
echo $_GET['callback'] . '('.json_encode($resultArray).')';
exit;	

?>