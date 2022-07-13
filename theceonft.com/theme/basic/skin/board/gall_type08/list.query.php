<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


$wz_sql_search = "";
if ($sql_search) { 
    $wz_sql_search .= ""; 
} 


$wz_sql_search .= "";


$sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE {$sql_search} {$wz_sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산

$from_record = 0;
$sql_order = " order by wr_num asc, wr_datetime desc ";

if ($sca || $stx) {
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} {$wz_sql_search} {$sql_order} limit {$from_record}, $page_rows ";
} else {
    $sql = " select * from {$write_table} where wr_is_comment = 0 {$wz_sql_search} ";
    if(!empty($notice_array))
        $sql .= " and wr_id not in (".implode(', ', $notice_array).") ";
    $sql .= " {$sql_order} limit {$from_record}, $page_rows ";
}
?>