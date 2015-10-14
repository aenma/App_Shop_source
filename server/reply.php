<?php
session_start();
require_once 'db_connect.php';  // 디비 연결하기
// post 값이 없으면 정상경로가 아니다.
if(isset($_POST) === false){
	$resultArray = array();
	$resultArray['success'] = 'fail';
	echo $_GET['callback'] . '('.json_encode($resultArray).')';
	exit;	
}

$userId = $_SESSION['user_id'];
// array  벗겨내기
extract($_POST);
$msg = iconv( "UTF-8", "EUC-KR",  $msg);

$sql = "INSERT INTO market_reply 
	(	user_id,
		product_seq,
		msg
	) VALUES (
		'{$userId}',
		'{$productSeq}',
		'{$msg}' ) ";
		
$result = mysql_query($sql);
$resultArray = array();
if(mysql_affected_rows() > 0){		// 업데이트 성공
	$resultArray['success'] = 'success';
}else{
	$resultArray['success'] = 'fail';
}
echo $_GET['callback'] . '('.json_encode($resultArray).')';

exit;	
?>