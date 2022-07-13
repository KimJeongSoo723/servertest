<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
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
						<?if($is_admin){?>
						 <a href="<?php echo $list[$i]['href'] ?>">
						 <?}else{?>
						 <a onClick="fnGoSlide('<?=$i+$from_record?>');">						 
						 <?}?>
						<?php
							$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);

							if($thumb['src']) {
								$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" >';
							} else {
								$img_content = '<img src="'.G5_THEME_IMG_URL.'/not_image.jpg" alt="" >';
							}

							echo run_replace('thumb_image_tag', $img_content, $thumb);
						 ?>
						</a>
                    </div>
					<?if($is_admin){?>
					<a href="<?php echo $list[$i]['href'] ?>" class="gall_text_href">
					 <?}else{?>
					 <a onClick="fnGoSlide('<?=$i+$from_record?>');" class="gall_text_href">					 
					 <?}?>					
						<span class="tit"> <?php echo $list[$i]['subject'] ?></span>
						<?
							$wr_content = str_replace("&nbsp;"," ",$list[$i]['wr_content']);  // &nbsp;를 빈칸으로 대체
							$wr_content = strip_tags($wr_content);
							$wr_content = cut_str(strip_tags($wr_content),60,'...'); 
						 ?>
					</a>
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

	<!-- 페이지 -->
	<?php echo $write_pages; ?>
	<!-- 페이지 -->

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

<div class="type6_popbg"></div>
	<div class="type6_popbox">
		<a class="type6_popbox_x"></a>
		<div class="type6_scr">
			<div class="swiper-container type6_swiper2">
				<ul class="swiper-wrapper">
					<?
						$sql = " select * from g5_write_{$bo_table} where 1=1 and wr_is_comment = '0' order by wr_num asc, wr_datetime asc ";
						$result = sql_query($sql);
						for($i=0; $row=sql_fetch_array($result); $i++){
					?>
					<li class="swiper-slide sub02_slide sub02_slide2_<?=$i?> slideActive">
						<div class="type6_pop_wrap">
							<p class="tit"><?=$row['wr_subject']?></p>
							<p class="txt"><?=$row['wr_content']?></p>
						</div>
					</li>
					<?}?>
				</ul>
				<div class="swiper-button-next type6_arr type6_next  type6_next2"></div>
				<div class="swiper-button-prev type6_arr type6_prev type6_prev2"></div>
			</div>			
		</div>
	</div>
</div>
<script>
var swiper2 = new Swiper('.type6_swiper2', {
	loop: true,
	navigation: {
		nextEl: '.type6_next2',
		prevEl: '.type6_prev2',
	},
	observer: true,
    observeParents: true,
});

function fnGoSlide(v){
	$(".type6_popbox").show();
	$(".type6_popbg").show();
	swiper2.slideTo(v*1+1, 500);
	$(".slideActive").removeClass('active')
	$("sub02_slide2_"+v).addClass("active");
}

$(".type6_popbox_x").click(function(){
	$(".type6_popbg").hide();
	$(".type6_popbox").hide();
});
</script>