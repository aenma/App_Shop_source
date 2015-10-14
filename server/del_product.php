<?php
session_start();
require_once 'db_connect.php';  // 디비 연결하기
$userId = $_SESSION['user_id'];
// array  벗겨내기
extract($_POST);
 
$sql = "DELETE FROM market_product
		 WHERE seq = $seq 
		 AND reg_user_id = '{$userId}' ";
		 
$result = mysql_query($sql);
$resultArray = array();
$resultArray['success'] = 'success';
echo $_GET['callback'] . '('.json_encode($resultArray).')';
exit;	

?>