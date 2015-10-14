<?php

require_once 'db_connect.php';  // 디비 연결하기
// post 값이 없으면 정상경로가 아니다.
if(isset($_POST) === false){
	// 메인 페이지로 이동한다.
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
CREATE TABLE IF NOT EXISTS `carpool_user` (
  `seq` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '인덱스',
  `user_name` varchar(255) NOT NULL COMMENT '유저명',
  `user_id` varchar(255) NOT NULL COMMENT '학번',
  `phone` varchar(255) NOT NULL COMMENT '연락처',
  `pwd` varchar(255) NOT NULL COMMENT '비밀번호',
  `reg_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록일',
  `user_flag` varchar(255) NOT NULL COMMENT '구분',
  `start_place` varchar(255) NOT NULL COMMENT '출발일',
  `want_time` varchar(255) NOT NULL COMMENT '카풀 원하는 시간',
  `user_image` varchar(255) NOT NULL COMMENT '유저이미지',
  `car_name` varchar(255) NOT NULL COMMENT '차종명',
  PRIMARY KEY (`seq`)
) ENGINE=MyISAM DEFAULT CHARSET=euckr COMMENT='카풀 유저정보' AUTO_INCREMENT=1 ;
*/
$sql = "UPDATE carpool_user SET
		 user_name = '{$userName}'
		, user_class = '{$userClass}'
		, phone = '{$phone}'
		WHERE
		user_id = '{$userId}' ";
		
$result = mysql_query($sql);
$resultArray = array();
if(mysql_affected_rows() > 0){		// 가입성공
	$resultArray['success'] = 'success';
}else{
	$resultArray['success'] = 'fail';
}
echo $_GET['callback'] . '('.json_encode($resultArray).')';
exit;	

?>