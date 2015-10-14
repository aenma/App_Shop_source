<?php
 
 session_start();
// 디비 접속
require_once 'db_connect.php';
if(isset($_POST) ){	// get 가 있으면 처리
	extract($_POST);
	$userId = $_SESSION['user_id'];	
	
	// 이미 장바구니에 있는지 체크 
    $sql = "SELECT * FROM market_basket 
    			WHERE user_id = '{$userId}'
    			AND product_seq = {$seq} ";
	// 쿼리 수행 		
    $result = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($result) > 0){
		$resultArray = array();
		$resultArray['success'] = 'has';
		echo $_GET['callback'] . '('.json_encode($resultArray).')';
		exit;
	}
	
	
    $sql = "INSERT market_basket 
    			(user_id,
    			 product_seq)
    		VALUES
    		( '{$userId}',
    		   '{$seq}'
   		 	)";
			
	// 쿼리 수행 		
    $result = mysql_query($sql) or die(mysql_error());
	$resultArray = array();
	$resultArray['success'] = 'success';
	echo $_GET['callback'] . '('.json_encode($resultArray).')';
	exit;
}else{  // 첫번째 파일이 없으면 종료
    die("error");
    exit;   
}


?>