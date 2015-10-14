<?php
session_start();
require_once 'db_connect.php';  // 디비 연결하기

$userId = $_SESSION['user_id'];
// array  벗겨내기
extract($_POST);

$sql = "DELETE FROM market_reply 
			WHERE user_id = '{$userId}'
			AND seq = {$seq} ";
		
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