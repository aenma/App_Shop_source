<?php

require_once 'db_connect.php';  // 디비 연결하기
// post 값이 없으면 정상경로가 아니다.
if(isset($_POST) === false){
	// 에러 페이지로 이동한다.
	$url = "../index.html";
	echo '
			<script>
				window.location.href = "'.$url.'";
			</script>';
	exit;	
}

// array  벗겨내기
extract($_POST);
/*
	CREATE TABLE  `household_ledger` (
	`f_index` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
	`f_in_out` VARCHAR( 10 ) NOT NULL ,
	`f_category` VARCHAR( 255 ) NOT NULL ,
	`f_money` INT UNSIGNED NOT NULL ,
	`f_desc` VARCHAR( 255 ) NOT NULL ,
	`f_reg_date` DATETIME NOT NULL ,
	`f_date` VARCHAR( 255 ) NOT NULL ,
	PRIMARY KEY (  `f_index` )
	) ENGINE = MYISAM COMMENT =  '가계부어플'

 */
 
$sql = "DELETE FROM household_ledger";
$result = mysql_query($sql);
$resultArray = array();
$resultArray['success'] = 'success';
echo $_GET['callback'] . '('.json_encode($resultArray).')';
exit;	

?>