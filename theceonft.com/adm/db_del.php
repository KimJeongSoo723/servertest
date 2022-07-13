<?
	include_once("_common.php");
	$g5['title'] = 'DB초기화';
	include_once('./admin.head.php');
?>

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
		<th>항목</th>
		<th>테이블</th>
		<th>개수</th>
		<th>관리</th>
	</tr>
	<tr>
		<td>회원</td>
		<td>member</td>
		<td><? $m = sql_fetch(" select count(*) as cnt from g5_member where 1=1 "); echo $m['cnt']; ?></td>
		<td><button type="button" onClick="fnReset('1')" class="btn btn_01">회원 테이블 초기화</button></td>
	</tr>
	<tr>
		<td>회원_SNS</td>
		<td>member_social_profiles</td>
		<td><? $m = sql_fetch(" select count(*) as cnt from g5_member_social_profiles where 1=1 "); echo $m['cnt']; ?></td>
		<td><button type="button" onClick="fnReset('2')" class="btn btn_01">회원SNS 테이블 초기화</button></td>
	</tr>
	<tr>
		<td>게시판</td>
		<td>board</td>
		<td><? $m = sql_fetch(" select count(*) as cnt from g5_board where 1=1 "); echo $m['cnt']; ?></td>
		<td><button type="button" onClick="fnReset('3')" class="btn btn_01">게시판 테이블 초기화</button></td>
	</tr>
	<tr>
		<td>팝업</td>
		<td>new_win</td>
		<td><? $m = sql_fetch(" select count(*) as cnt from g5_new_win where 1=1 "); echo $m['cnt']; ?></td>
		<td><button type="button" onClick="fnReset('4')" class="btn btn_01">팝업 테이블 초기화</button></td>
	</tr>
	<tr>
		<td>포인트</td>
		<td>point</td>
		<td><? $m = sql_fetch(" select count(*) as cnt from g5_point where 1=1 "); echo $m['cnt']; ?></td>
		<td><button type="button" onClick="fnReset('5')" class="btn btn_01">포인트 테이블 초기화</button></td>
	</tr>
	<tr>
		<td>로그인</td>
		<td>login</td>
		<td><? $m = sql_fetch(" select count(*) as cnt from g5_login where 1=1 "); echo $m['cnt']; ?></td>
		<td><button type="button" onClick="fnReset('6')" class="btn btn_01">로그인 테이블 초기화</button></td>
	</tr>
	<tr>
		<td>접속자검색</td>
		<td>visit</td>
		<td><? $m = sql_fetch(" select count(*) as cnt from g5_visit where 1=1 "); echo $m['cnt']; ?></td>
		<td><button type="button" onClick="fnReset('7')" class="btn btn_01">접속자검색 테이블 초기화</button></td>
	</tr>
	<tr>
		<td>접속자집계</td>
		<td>visit_sum</td>
		<td><? $m = sql_fetch(" select count(*) as cnt from g5_visit_sum where 1=1 "); echo $m['cnt']; ?></td>
		<td><button type="button" onClick="fnReset('8')" class="btn btn_01">접속자집계 테이블 초기화</button></td>
	</tr>
	<tr>
		<td>FAQ관리</td>
		<td>faq</td>
		<td><? $m = sql_fetch(" select count(*) as cnt from g5_faq where 1=1 "); echo $m['cnt']; ?></td>
		<td><button type="button" onClick="fnReset('9')" class="btn btn_01">FAQ 테이블 초기화</button></td>
	</tr>
	</tbody>
	</table>
</div>

<script>
function fnReset(x){
	if(confirm("초기화를 진행하시겠습니까?")== true){
		location.href="./db_del.update.php?type="+x;
	}
}
</script>

<?php
include_once ('./admin.tail.php');
?>