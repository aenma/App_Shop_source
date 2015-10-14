<?php

session_start();
// 디비 접속
require_once 'db_connect.php';
extract($_POST);

$userId = $_SESSION['user_id'];

$sql = "SELECT * FROM market_user 
				WHERE user_id = '{$userId}'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$pointUser = iconv("EUC-KR",  "UTF-8",  $row[point_user]);

// array  벗겨내기

if($pointUser == '0' ){
$sql2 = "UPDATE market_user SET user_point = '1000', point_user = '1' WHERE user_id = '{$userId}' ";
			// 쿼리 수행 		
$result2 = mysql_query($sql2);
$resultArray = array();
$succ = '1';
}

if($succ == '1'){
$resultArray['success'] = 'success';
}else{
	$resultArray['success'] = 'fail';
}
echo $_GET['callback'] . '('.json_encode($resultArray).')';
exit;

?>