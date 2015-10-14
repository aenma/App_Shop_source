<?php
 
 session_start();
// 디비 접속
require_once 'db_connect.php';
if(isset($_POST) ){	// get 가 있으면 처리
	extract($_POST);
	$userId = $_SESSION['user_id'];
	// array  벗겨내기
	extract($_POST);
	$productName = iconv( "UTF-8", "EUC-KR",  $productName);
	$price = iconv( "UTF-8", "EUC-KR",  $price);
	$productImage = iconv( "UTF-8", "EUC-KR",  $productImage);
	$category = iconv( "UTF-8", "EUC-KR",  $category);
	$info = iconv( "UTF-8", "EUC-KR",  $info);


	$sql = "UPDATE market_product SET 
				product_name = '{$productName}',
				info = '{$info}',
				price = '{$price}',
				image1 = '{$productImage}',
				alpha = '{$alpha}',
				category = '{$category}' 
			WHERE seq = '{$seq}' ";
	
	// 쿼리 수행 		
    $result = mysql_query($sql) or die(mysql_error());
	$resultArray = array();
	$resultArray['success'] = 'success';
	echo $_GET['callback'] . '('.json_encode($resultArray).')';
}else{  // 첫번째 파일이 없으면 종료
    die("error");
    exit;   
}


?>