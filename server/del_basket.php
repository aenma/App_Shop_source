<?php

session_start();
require_once 'db_connect.php';  // 디비 연결하기
// array  벗겨내기
extract($_POST);
$userId = $_SESSION['user_id'];
 
$sql = "DELETE FROM market_basket
		 WHERE product_seq = {$seq}
		 AND user_id = '{$userId}' ";
		 
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