<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

/* 유투브 주소에서 Video ID를 추출합니다.  */
if ( ! function_exists( 'get_video_id' ) )
{
    function get_video_id( $str )
    {
        if( substr( $str, 0, 4 ) == 'http' )
        {
            if( strpos( $str, 'youtu.be' ) )
            {
                return array_pop( explode( '/', $str ) );
            }
            else if( strpos( $str, '/embed/' ) )
            {
                return array_pop( explode( '/', $str ) );
            }
            else if( strpos( $str, '/v/' ) )
            {
                return array_pop( explode( '/', $str ) );
            }
            else
            {
                $params = explode( '&', array_shift( explode( '#', array_pop( explode( '?', $str ) ) ) ) );
                foreach( $params as $data )
                {
                    $arr = explode( '=', $data );
                    if( $arr[ 0 ] == 'v' )
                    {
                        return $arr[ 1 ];
                    }
                }
            }
        }
        else
        {
            return $str;
        }
 
        return '';
    }
}
 
/* 썸네일 주소를 가져옵니다. 기본값은 default 입니다. */
if ( ! function_exists( 'get_yt_thumb' ) )
{
    function get_yt_thumb( $url_or_id, $type )
    {
        switch( $type )
        {
            case '0' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/0.jpg';
                break;
            case '1' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/1.jpg';
                break;
            case '2' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/2.jpg';
                break;
            case '3' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/3.jpg';
                break;
            case 'hq' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/hqdefault.jpg';
                break;
            case 'mq' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/mqdefault.jpg';
                break;
            case 'sd' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/sddefault.jpg';
                break;
            case 'maxres' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/maxresdefault.jpg';
                break;
            default :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/default.jpg';
        }
    }
}
?>


<!-- 게시판 목록 시작 { -->
<div id="bo_gall" style="width:<?php echo $width; ?>">

    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>

    <form name="fboardlist"  id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
     <div id="bo_btn_top">
		<?php if ($rss_href || $write_href) { ?>
		<ul class="btn_bo_user">
			<?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01 btn"><i class="fa fa-rss" aria-hidden="true"></i> RSS</a></li><?php } ?>
			<?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn">관리자</a></li><?php } ?>
			<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02 btn btn_write">글쓰기</a></li><?php } ?>
		</ul>
		<?php } ?>
	</div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <?php if ($is_checkbox) { ?>
    <div id="gall_allchk" class="all_chk chk_box">
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" class="selec_chk">
    	<label for="chkall">
        	<span></span>
        	<b class="sound_only">현재 페이지 게시물 </b> 전체선택
        </label>
    </div>
    <?php } ?>

    <ul id="gall_ul" class="gall_row">
        <?php for ($i=0; $i<count($list); $i++) {

            $classes = array();
            
            $classes[] = 'gall_li';
            $classes[] = 'col-gn-'.$bo_gallery_cols;

            if( $i && ($i % $bo_gallery_cols == 0) ){
                $classes[] = 'box_clear';
            }

            if( $wr_id && $wr_id == $list[$i]['wr_id'] ){
                $classes[] = 'gall_now';
            }
         ?>
        <li class="<?php echo implode(' ', $classes); ?>">
            <div class="gall_box">
                <div class="gall_chk chk_box">
	                <?php if ($is_checkbox) { ?>
					<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" class="selec_chk">
	                <label for="chk_wr_id_<?php echo $i ?>">
	                	<span></span>
	                	<b class="sound_only"><?php echo $list[$i]['subject'] ?></b>
	                </label>
	                
	                <?php } ?>
	                <span class="sound_only">
	                    <?php
	                    if ($wr_id == $list[$i]['wr_id'])
	                        echo "<span class=\"bo_current\">열람중</span>";
	                    else
	                        echo $list[$i]['num'];
	                     ?>
	                </span>
                </div>
                <div class="gall_con">
                    <div class="gall_img">
						 <a href="<?php echo $list[$i]['href'] ?>">
						<?php
							$v = "";
							$mov_link = "";
							$img_content = "";
							$mov_link = $list[$i]['wr_10'];
							$youtube_url = parse_url($mov_link);
							parse_str($youtube_url['query']);
							$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);

							if($v){
								$img_content = '<img src="'.get_yt_thumb( 'http://youtu.be/'.$v, 'mq' ).'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'">';
							}else if($thumb['src']) {
								$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" >';
							} else {
								$img_content = '<img src="'.G5_THEME_IMG_URL.'/not_image2.jpg" alt="" >';
							}

							echo run_replace('thumb_image_tag', $img_content, $thumb);
						 ?>
						</a>
                    </div>
					<a href="<?php echo $list[$i]['href'] ?>" class="gall_text_href">
						<span class="tit"> <?php echo $list[$i]['subject'] ?></span>
						<?
							$wr_content = str_replace("&nbsp;"," ",$list[$i]['wr_content']);  // &nbsp;를 빈칸으로 대체
							$wr_content = strip_tags($wr_content);
							$wr_content = cut_str(strip_tags($wr_content),60,'...'); 
						 ?>
						<!-- <span class="cont"> <?php echo $wr_content ?></span> -->
					</a>

                    <!--div class="gall_info">
                    	<span class="sound_only">작성자 </span><?php echo $list[$i]['name'] ?>
                        <span class="gall_date"><span class="sound_only">작성일 </span><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $list[$i]['datetime2'] ?></span>
                    	<span class="gall_view"><span class="sound_only">조회 </span><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $list[$i]['wr_hit'] ?></span>
                    </div-->
                </div>
            </div>
        </li>
        <?php } ?>
        <?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>
    </ul>	

	
	<?php if ($list_href || $is_checkbox || $write_href) { ?>
	<div class="bo_fx">
		<div class="clearfix">
			<?php if ($list_href || $write_href) { ?>
			<ul class="btn_bo_user">
				<?php if ($is_checkbox) { ?>
				<li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_admin btn_change2">선택삭제</button></li>
				<li><button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="btn btn_admin btn_change2">선택복사</button></li>
				<li><button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="btn btn_admin btn_change2">선택이동</button></li>
				<?php } ?>
				<?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01 btn btn_list">목록</a></li><?php } ?>
				<?php if ($write_href) { ?><li class="bo_fx_write"><a href="<?php echo $write_href ?>" class="btn_b02 btn btn_write">글쓰기</a></li><?php } ?>
			</ul>
			<?php } ?>
		</div>                
	</div>
	<?php } ?>
    </form>

    <!-- 게시판 검색 시작 { -->
    <div class="bo_sch_wrap">	
        <fieldset class="bo_sch">
            <h3>검색</h3>
            <form name="fsearch" method="get">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="sca" value="<?php echo $sca ?>">
            <input type="hidden" name="sop" value="and">
            <label for="sfl" class="sound_only">검색대상</label>
            <select name="sfl" id="sfl">
                <?php echo get_board_sfl_select_options($sfl); ?>
            </select>
            <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <div class="sch_bar">
                <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input" size="25" maxlength="20" placeholder="검색어를 입력해주세요">
                <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
            </div>
            <button type="button" class="bo_sch_cls"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only">닫기</span></button>
            </form>
        </fieldset>
        <div class="bo_sch_bg"></div>
    </div>
    <script>
        // 게시판 검색
        $(".btn_bo_sch").on("click", function() {
            $(".bo_sch_wrap").toggle();
        })
        $('.bo_sch_bg, .bo_sch_cls').click(function(){
            $('.bo_sch_wrap').hide();
        });
    </script>
    <!-- } 게시판 검색 끝 -->
</div>

<?
	$sql_c = " select count(*) cnt from g5_write_{$bo_table} where 1=1 ";
	$row_c = sql_fetch($sql_c);
?>
<input type="hidden" id="more" value="12">
<script>
window.__scrollPosition = document.documentElement.scrollTop || 0;
var timer;

window.onpageshow = function(event) {
	if ( event.persisted || (window.performance && window.performance.navigation.type == 2)) {
		// Back Forward Cache로 브라우저가 로딩될 경우 혹은 브라우저 뒤로가기 했을 경우
		$("#more").val(0);
	}
}

$(document).scroll(function(){
	let _documentY = document.documentElement.scrollTop;
	let _direction = _documentY - window.__scrollPosition >= 0 ? 1 : -1;
	//console.log(_direction); // 콘솔창에 스크롤 방향을 출력

	window.__scrollPosition = _documentY; // Update scrollY

	var scrolltop = parseInt ( $(window).scrollTop() );
	var a = $(document).height();
	var b = $(window).height();
	var more = ($("#more").val())*1;

	if(_direction == 1){
		if("<?=$row_c['cnt']?>"*1 > more){
			if( scrolltop >= a - b - 50){
				
				if( !timer ){
					//추가할 내용 1
					//실행되고 설정된시간(1000)후에 재실행된다. 1000초이내 중복실행 방지
					setTimeout(function() {	
						fnMore();
					},500);
					timer = setTimeout(function() {
						timer = null;
						//추가할 내용 2
						//설정된 시간(1000) 후에 실행됨
					}, 700);
					//시간은 150~ 으로 알맞은 시간을 찾아야함
				}
			}
		}
	}

	function fnMore(){
		$.ajax({
			type: "POST",
			url: "<?=G5_URL?>/sub/ajax.gall_type.more.php",
			data: {bo_table:"<?=$bo_table?>", more:more}, 
			cache: false,
			async: false,
			contentType : "application/x-www-form-urlencoded; charset=UTF-8",
			success: function(data) {
				$("#gall_ul").append(data);
				$("#more").val(more+8);
			}
		});
		return false;
	}

});
</script>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == 'copy')
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}

// 게시판 리스트 관리자 옵션
jQuery(function($){
    $(".btn_more_opt.is_list_btn").on("click", function(e) {
        e.stopPropagation();
        $(".more_opt.is_list_btn").toggle();
    });
    $(document).on("click", function (e) {
        if(!$(e.target).closest('.is_list_btn').length) {
            $(".more_opt.is_list_btn").hide();
        }
    });
});
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
