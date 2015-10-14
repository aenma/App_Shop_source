<?php
// 정상경로가 아니면 나가기
if(isset($_POST) === false){
	die('invaild access');
	exit;
}

session_start();
require_once 'db_connect.php';
// array  벗겨내기
extract($_POST);
$query = "SELECT * FROM market_user 
				WHERE user_id = '{$userId}' 
				AND pwd = password('{$pwd}') ";
				
$result = mysql_query($query);

$resultArray = array();
$arr = mysql_fetch_array($result);
if(@mysql_num_rows($result) > 0){		// 인증성공

	$resultArray['success'] = 'success';
	$_SESSION['user_id'] = $userId;
	$_SESSION['login'] = true;
	$_SESSION['user_flag'] = $arr['user_flag'];
	$_SESSION['user_image'] =  $arr['user_image'];
	// 카풀 응답자만
	$_SESSION['car_name'] = $arr['car_name'];
	
}else{
	$resultArray['success'] = 'fail';
}

echo $_GET['callback'] . '('.json_encode($resultArray).')';

exit;
?>
