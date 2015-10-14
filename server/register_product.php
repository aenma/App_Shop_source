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
$productName = iconv( "UTF-8", "EUC-KR",  $productName);
$price = iconv( "UTF-8", "EUC-KR",  $price);
$productImage = iconv( "UTF-8", "EUC-KR",  $productImage);
$category = iconv( "UTF-8", "EUC-KR",  $category);
$info = iconv( "UTF-8", "EUC-KR",  $info);

$sql = "INSERT INTO market_product 
		(reg_user_id,
		 product_name,
		 info,
		 price,
		 image1,
		 alpha,
		 category
		) VALUES (
		'{$userId}',
		'{$productName}',
		'{$info}',
		'{$price}',
		'{$productImage}',
		'{$alpha}',
		'{$category}' ) ";
		
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