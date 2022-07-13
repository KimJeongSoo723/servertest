<?
	include_once("_common.php");
	
	if($type == "1"){
		// 회원정보 삭제
		$sql = "delete from g5_member where 1=1 and mb_id != 'admin'";
		sql_query($sql);
		$sql = "alter table g5_member auto_increment=2;";
		sql_query($sql);
	}
	
	if($type == "2"){
		// 소셜 제거
		$sql = "delete from g5_member_social_profiles ";
		sql_query($sql);
	}
	
	if($type == "3"){
		// 게시판 삭제
		$sql = "select * from g5_board";
		$result =  sql_query($sql);
		for($i = 0; $row = sql_fetch_array($result); $i++){
			$sql = "drop table g5_write_".$row['bo_table'];
			sql_query($sql);
		}
		$sql = "delete from g5_board";
		sql_query($sql);
		$sql = "alter table g5_board auto_increment=1;";
		sql_query($sql);
	}

	if($type == "4"){
		// new_win 삭제
		$sql = "delete from g5_new_win";
		sql_query($sql);
		$sql = "alter table g5_new_win auto_increment=1;";
		sql_query($sql);
	}

	if($type == "5"){
		// 포인트 삭제
		$sql = "delete from g5_point";
		sql_query($sql);
		$sql = "alter table g5_point auto_increment=1;";
		sql_query($sql);
		$sql = "update g5_member set mb_point = 0 where 1=1 and mb_id = 'admin'";
		sql_query($sql);
	}

	if($type == "6"){
		// 로그인 삭제
		$sql = "delete from g5_login";
		sql_query($sql);
		$sql = "alter table g5_login auto_increment=1;";
		sql_query($sql);
	}
	if($type == "7"){
		// 방문자 삭제
		$sql = "delete from g5_visit";
		sql_query($sql);
		$sql = "alter table g5_visit auto_increment=1;";
		sql_query($sql);
	}

	if($type == "8"){
		// 방문자 삭제
		$sql = "delete from g5_visit_sum";
		sql_query($sql);
		$sql = "alter table g5_visit_sum auto_increment=1;";
		sql_query($sql);
	}
	if($type == "9"){
		// faq 삭제
		$sql = "delete from g5_faq";
		sql_query($sql);
		$sql = "alter table g5_faq auto_increment=1;";
		sql_query($sql);
		// faq 삭제
		$sql = "delete from g5_faq_master";
		sql_query($sql);
		$sql = "alter table g5_faq_master auto_increment=1;";
		sql_query($sql);
	}
	alert("정상적으로 처리되었습니다.");
?>