<?php
 
 session_start();
// 디비 접속
require_once 'db_connect.php';
if(isset($_POST) ){	// get 가 있으면 처리
	extract($_POST);
	$userId = $_SESSION['user_id'];		
	
	$userImage = iconv( "UTF-8", "EUC-KR",  $userImage);
	$userName = iconv( "UTF-8", "EUC-KR",  $userName);
	$userClass = iconv( "UTF-8", "EUC-KR",   $userClass);
	
	
    $sql = "UPDATE market_user 
    			SET phone = '{$phone}', ";
	if(!empty($pwd)){			
		$sql .= "	pwd = password('{$pwd}'), ";
	}

    $sql .= "   user_class = '{$userClass}', ";
    $sql .= "   user_name = '{$userName}', ";
    $sql .= "   user_image = '{$userImage}'  
				WHERE user_id = '{$userId}' ";
	
	// 쿼리 수행 		
    $result = mysql_query($sql);
	$resultArray = array();
	if(mysql_affected_rows() > 0){		// 가입성공
		$resultArray['success'] = 'success';
	}else{	
		$resultArray['success'] = 'fail';
	}
	echo $_GET['callback'] . '('.json_encode($resultArray).')';
	exit;
	
	
}else{  // 첫번째 파일이 없으면 종료
    die("error");
    exit;   
}
?>