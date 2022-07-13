<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');


?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
<link rel="stylesheet" href="<?=G5_CSS_URL?>/noto-sans.css">
<link href="https://fonts.googleapis.com/css2?family=Exo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/static/pretendard.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/moonspam/NanumSquare/master/nanumsquare.css">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/notosanskr.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

<link rel="stylesheet" href="<?=G5_CSS_URL?>/swiper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo G5_CSS_URL ?>/fullPage.css">
<script type="text/javascript" src="<?php echo G5_JS_URL ?>/scrolloverflow.min.js"></script>
<script type="text/javascript" src="<?php echo G5_JS_URL ?>/fullPage.js"></script>
<script type="text/javascript" src="<?php echo G5_JS_URL ?>/easings.min.js"></script>




<?php
if(defined('_INDEX_')) { // index에서만 실행
	include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
}
?>

<header class="header">
	<div class="inner">
		<div class="logo"><a href="<?=G5_URL?>"><img src="<?=G5_THEME_IMG_URL?>/logo.png" alt=""></a></div>
		<ul class="menu">
			<li><a href="#main-1">Home</a></li>
			<li><a href="https://the-ceo-nft.gitbook.io/theceo/">Whitepaper</a></li>
			<li><a href="#main-3">Roadmap</a></li>
			<li><a href="#main-4">Information</a></li>
			<li><a href="#main-2">Universe</a></li>
			<li><a href="#main-5">Team</a></li>
			<!-- <li><a href="#main-6">Partners</a></li> -->
			<li><a href="#main-7">Community</a></li>
		</ul>
		<div class="mo_ham">
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
</header>

<div class="mo_head">
	<ul class="mo_head_ul">
		<li><a href="#main-1">Home</a></li>
		<li><a href="https://the-ceo-nft.gitbook.io/theceo/">Whitepaper</a></li>
		<li><a href="#main-3">Roadmap</a></li>
		<li><a href="#main-4">Information</a></li>
		<li><a href="#main-2">Universe</a></li>
		<li><a href="#main-5">Team</a></li>
		<!-- <li><a href="#main-6">Partners</a></li> -->
		<li><a href="#main-7">Community</a></li>
	</ul>
</div>

<script>
	$(document).ready(function(){
		$('.mo_ham').click(function(){
			$('.header').toggleClass('on');
		});

		$('.mo_head_ul > li > a').click(function(){
			$('.header').removeClass('on');
		});
	});
</script>

<?if($basename != "index.php") {?>
<div id="sub_div">
	<div class="inner">
<?}?>
