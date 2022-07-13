<?
	include_once("_common.php");
	include_once(G5_LIB_PATH.'/thumbnail.lib.php');

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

	$sql = " select * from g5_board where 1=1 and bo_table = '{$bo_table}' ";
	$board = sql_fetch($sql);
	
	$limit = 8;
	if($mobile != ""){ $limit = 2; }
	$sql = " select * from g5_write_{$bo_table} where 1=1 order by wr_num asc, wr_datetime desc limit {$more}, {$limit} ";
	$result = sql_query($sql);
	for($i=0; $row=sql_fetch_array($result); $i++){
?>
<li class="gall_li col-gn-4">
	<div class="gall_box">
		<div class="gall_chk chk_box">
			<?php if ($is_admin) { ?>
			<input type="checkbox" name="chk_wr_id[]" value="<?php echo $row['wr_id'] ?>" id="chk_wr_id_more_<?=$row['wr_id']?>" class="selec_chk">
			<label for="chk_wr_id_more_<?=$row['wr_id']?>">
				<span></span>
				<b class="sound_only"><?php echo $row['wr_subject'] ?></b>
			</label>
			<?php } ?>
		</div>
		<div class="gall_con">
			<div class="gall_img">
				<?if($is_admin){?>
				<a href="<?=G5_BBS_URL?>/board.php?bo_table=<?=$bo_table?>&wr_id=<?=$row['wr_id']?>">
				<?}else{?>
				<a onClick="fnGoSlide('<?=$i+$more?>');">						 
				<?}?>
				<?php
					$v = "";
					$mov_link = "";
					$img_content = "";
					$mov_link = $row['wr_10'];
					$youtube_url = parse_url($mov_link);
					parse_str($youtube_url['query']);
					$thumb = get_list_thumbnail($board['bo_table'], $row['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);

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
			<?if($is_admin){?>
			<a href="<?=G5_BBS_URL?>/board.php?bo_table=<?=$bo_table?>&wr_id=<?=$row['wr_id']?>" class="gall_text_href">
			<?}else{?>
			<a onClick="fnGoSlide('<?=$i+$more?>');" class="gall_text_href">
			<?}?>
				<span class="tit"> <?php echo $row['wr_subject'] ?></span>
				<?
					$wr_content = str_replace("&nbsp;"," ",$row['wr_content']);  // &nbsp;를 빈칸으로 대체
					$wr_content = strip_tags($wr_content);
					$wr_content = cut_str(strip_tags($wr_content),60,'...'); 
				 ?>
			</a>
		</div>
	</div>
</li>
<?}?>