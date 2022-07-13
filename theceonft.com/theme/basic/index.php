<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>


<section id="main">
	<article class="section main1" data-anchor="main-1">
		<div class="inner">
			<div class="tit font_ex">"BE THE CEO,</div>
			<div class="tit font_ex">BE THE GREATEST"</div>
		</div>
	</article>
	<article class="section main3" data-anchor="main-3">
		<div class="inner">
			<div class="main_tit font_ex faf">THE Roadmap</div>
			<div class="timeline main3ul fau">
				<div class="timeline-row">
					<div class="timeline-time">
						<li>
							<div class="cate">THE TAKING-OFF</div>
							<div class="tit">Q4 2021</div>
							<ul class="desc">
								<li>THE Research</li>
								<li>THE Team</li>
								<li>THE Modeling</li>
							</ul>
						</li>
					</div>
					<div class="timeline-content">
						<img src="<?=G5_THEME_IMG_URL?>/main3_img_1.jpg" width="60%" height="" alt="">
					</div>
				</div>
				<div class="timeline-row">
					<div class="timeline-time">
						<li>
							<div class="cate">THE Community</div>
							<div class="tit">Q1 2022</div>
							<ul class="desc">
								<li>THE Investment</li>
								<li>THE Members</li>
								<li>THE Launching</li>
							</ul>
						</li>
					</div>
					<div class="timeline-content">
						<img src="<?=G5_THEME_IMG_URL?>/main3_img_2.png" alt="">
					</div>
				</div>
				<div class="timeline-row">
					<div class="timeline-time">
						<li>
							<div class="cate">THE Minting</div>
							<div class="tit">Q2 2022</div>
							<ul class="desc">
								<li>THE CEO NFT</li>
								<li>THE Backers</li>
							</ul>
						</li>
					</div>
					<div class="timeline-content">
						<img src="<?=G5_THEME_IMG_URL?>/main3_img_3.png"  alt="">
					</div>
				</div>
				<div class="timeline-row">
					<div class="timeline-time">
						<li>
							<div class="cate">THE Docking</div>
							<div class="tit">Q3 2022</div>
							<ul class="desc">
								<li>THE CEO Token</li>
								<li>THE Vision</li>
								<li>THE Expasion</li>
							</ul>
						</li>
					</div>
					<div class="timeline-content">
						<img src="<?=G5_THEME_IMG_URL?>/main3_img_4.png" alt="">
					</div>
				</div>
				<div class="timeline-row">
					<div class="timeline-time">
						<li>
							<div class="cate">THE Blooming</div>
							<div class="tit">Q4 2022</div>
							<ul class="desc">
								<li>THE OFFICE</li>
								<li>THE ? (Secret)</li>
								<li>THE Partnership</li>
							</ul>
						</li>
					</div>
					<div class="timeline-content">
						<img src="<?=G5_THEME_IMG_URL?>/main3_img_51.png" alt="">
					</div>
				</div>
				<div class="timeline-row">
					<div class="timeline-time">
						<li>
							<div class="cate">THE DAO</div>
							<div class="tit">Q1 &amp; Q2 2023</div>
							<ul class="desc">
								<li>THE CEO VC</li>
								<li>THE Partner</li>
								<!-- <li>Migration or Cross-Chain Development</li> -->
								<li>THE Meet Up</li>
							</ul>
						</li>
					</div>
					<div class="timeline-content">
						<img src="<?=G5_THEME_IMG_URL?>/main3_img_6.png" alt="">
					</div>
				</div>
			</div>
			<div class="main3box">
				<div class="tit font_mt">THE CEO DAO</div>
				<ul class="desc">
					<li>THE CEO VC</li>
					<li>THE CEO Governance</li>
					<li>THE CEO Partner</li>
					<!-- <li>Migration or Cross-Chain Development</li> -->
					<li>THE CEO Holdings</li>
				</ul>	
			</div>
		</div>
	</article>
	<article class="section main4" data-anchor="main-4">
		<div class="inner">
			<div class="main_tit font_ex faf">Information</div>
			<div class="cont fau">
				'The CEO' is an NFT project based on the Solana blockchain.<br>
				To sybolize that the CEOs of all fields are working together to build a new world, 10 representative fields were selected and personified into 10 animal species that fit the characteristics of each field. 1000 CEOs in each field, a total of 10,000 CEOs, were made into NFTs with their own unique personalities.<br><br>

				※Initial Supply: Mythic(0%), SSR(0%), SR(5%), R(95%)
			</div>
			<div class="maincont fau">
				<div class="m4_sd_arr m4_sd_prev"><i class="xi-angle-left-thin"></i></div>
				<div class="m4_sd_arr m4_sd_next"><i class="xi-angle-right-thin"></i></div>
				<div class="swiper-container m4_sd">
					<ul class="swiper-wrapper">
						<?for($i=1;$i<=20;$i++){?>
						<li class="swiper-slide"><img src="<?=G5_THEME_IMG_URL?>/sec6_img_<?=$i?>.jpg" alt=""></li>
						<?}?>
					</ul>
				</div>
			</div>
			
		</div>
	</article>
	<article class="section main2" data-anchor="main-2">
		<div class="inner" style="overflow: hidden;">
			<div class="main_tit font_ex faf">Universe</div>
			<div class="cont fau">
				The CEO is a DAO governance against centralized Bullstreet & Silicon Bear.<br>
				<br>
				All the CEOs who participate in The CEO Projects can expand Organizations through carrying out projects operated as DAO.<br>
				<br>
				Against Exisiting corrupted organizations, The CEO will create a new world in Metaverse through decentralized, fair & righteous activities.<br>
				<br>
				CEO Tokens will be distributed to The CEO NFT holders, when the goal is achieved each time.<br>
				<br>
				<span class="main2_color">WE WANT YOU FOR THE CEO DAO!</span>
				<div>
					<a href="https://medium.com/@theceonft/%EC%A0%9C-1%ED%99%94-r-vd-6c6a0a29866">
						<img src="<?=G5_THEME_IMG_URL?>/CEOuniverse.png" alt="" style="width:50%; padding:2rem 0 2rem 0;">
					</a>
				</div>
				<a href="https://medium.com/@theceonft/%EC%A0%9C-1%ED%99%94-r-vd-6c6a0a29866">If you want to know more about THE CEO, Click here for our story!</a>
			</div>
		</div>
	</article>	
	<article class="section main5" data-anchor="main-5">
		<div class="inner">
			<div class="main_tit font_ex faf">Team</div>

			<div class="maincont fau">
				<div class="swiper-container m5_sd">
					<ul class="swiper-wrapper">

						<li class="swiper-slide">
							<div class="thum">
								<img src="<?=G5_THEME_IMG_URL?>/sec7_img_1.png" alt="">
							</div>
							<div class="desc"><b>Prodo</b><br><span>Lead Designer Artist</span></div>
						</li>

						<li class="swiper-slide">
							<div class="thum">
								<img src="<?=G5_THEME_IMG_URL?>/sec7_img_2.png" alt="">
							</div>
							<div class="desc"><b>Felix</b><br><span>Team Leader</span></div>
						</li>

						<li class="swiper-slide">
							<div class="thum">
								<img src="<?=G5_THEME_IMG_URL?>/sec7_img_3.png" alt="">
							</div>
							<div class="desc"><b>Patrick</b><br><span>Global Marketing</span></div>
						</li>

						<li class="swiper-slide">
							<div class="thum">
								<img src="<?=G5_THEME_IMG_URL?>/sec7_img_4.png" alt="">
							</div>
							<div class="desc"><b>Rugal</b><br><span>Lead Developer</span></div>
						</li>

						<li class="swiper-slide">
							<div class="thum">
								<img src="<?=G5_THEME_IMG_URL?>/sec7_img_5.png" alt="">
							</div>
							<div class="desc"><b>Hailey</b><br><span>Chief-Visionary</span></div>
						</li>

						<li class="swiper-slide">
							<div class="thum">
								<img src="<?=G5_THEME_IMG_URL?>/sec7_img_6.png" alt="">
							</div>
							<div class="desc"><b>Neon</b><br><span>Operating Officer</span></div>
						</li>

						<li class="swiper-slide">
							<div class="thum">
								<img src="<?=G5_THEME_IMG_URL?>/sec7_img_7.png" alt="">
							</div>
							<div class="desc"><b>Elsa</b><br><span>Product Designer</span></div>
						</li>

						<li class="swiper-slide">
							<div class="thum">
								<img src="<?=G5_THEME_IMG_URL?>/sec7_img_8.png" alt="">
							</div>
							<div class="desc"><b>Jager</b><br><span>Project Moderator</span></div>
						</li>

						<li class="swiper-slide">
							<div class="thum">
								<img src="<?=G5_THEME_IMG_URL?>/sec7_img_9.png" alt="">
							</div>
							<div class="desc"><b>Jose</b><br><span>Strategic Advisor</span></div>
						</li>

						<li class="swiper-slide">
							<div class="thum">
								<img src="<?=G5_THEME_IMG_URL?>/sec7_img_11.png" alt="">
							</div>
							<div class="desc"><b>Kris</b><br><span>Technical Advisor</span></div>
						</li>
						<li class="swiper-slide">
							<div class="thum">
								<img src="<?=G5_THEME_IMG_URL?>/sec_img_10.jpg" alt="">
							</div>
							<div class="desc"><b>Iron</b><br><span>Executive Advisor</span></div>
						</li>
					</ul>
				</div>
			</div>

		</div>
	</article>
	<!-- <article class="section main6" data-anchor="main-6">
		<div class="inner">
			<div class="main_tit font_ex faf">Partners</div>
			<ul class="main6ul fau">
				<li><a href=""><img src="<?=G5_THEME_IMG_URL?>/main6_logo1.png" alt=""></a></li>
				<li><a href=""><img src="<?=G5_THEME_IMG_URL?>/main6_logo2.png" alt=""></a></li>
			</ul>
		</div>
	</article> -->
	<article class="section main7" data-anchor="main-7">
		<div class="inner">
			<div class="main_tit font_ex faf">Community</div>
			<ul class="main7ul fau">
				<!-- <li><a href=""><img src="<?=G5_THEME_IMG_URL?>/tele.png" alt=""></a></li> -->
				<!-- <li><a href="https://www.instagram.com/thesajangnft/" target="_blank"><img src="<?=G5_THEME_IMG_URL?>/insta.png" alt=""></a></li> -->
				<li><a href="https://twitter.com/THECEO_NFT" target="_blank"><img src="<?=G5_THEME_IMG_URL?>/twitter.png" alt=""></a></li>
				<li><a href="https://discord.gg/theceonft" target="_blank"><img src="<?=G5_THEME_IMG_URL?>/dco.png" alt=""></a></li>
				<li><a href="https://medium.com/@theceonft" target="_blank"><img src="<?=G5_THEME_IMG_URL?>/midum.png" alt=""></a></li>
			</ul>
			<div class="main7thum fau2"><img src="<?=G5_THEME_IMG_URL?>/com_bg.png" alt=""></div>
			<div class="ft_copy">
				theceonft@gmail.com <br><span>Copyright 2022 TheCEO. All rights reserved</span>
			</div>
		</div>
	</article>		
</section>


<script>
$(document).ready(function() {
	$('.header').addClass('ani');
	$('#main').fullpage({
		//options here
		autoScrolling:true,
		scrollHorizontally: true,
		navigation:true,
		scrollingSpeed: 1000,
		scrollOverflow:true,
		showActiveTooltip: true,
		
		/*afterLoad: function(anchorLink, index){
			deleteLog = true;
			if(index == "1") {
				$('.main1').addClass('ani');
			}
			if(index == "2") {
				$('.main2').addClass('ani');
			}
			if(index == "3") {
				$('.main3').addClass('ani');
			}
			if(index == "4") {
				$('.main4').addClass('ani');
			}
			if(index == "5") {
				$('.main5').addClass('ani');
			}
			if(index == "6") {
				$('.main6').addClass('ani');
			}
			if(index == "7") {
				$('.main7').addClass('ani');
			}
		},*/
	});

	

});
</script>



<script>
var swiper = new Swiper('.m4_sd', {
	autoplay: {
		delay: 1000,
		disableOnInteraction: false,
	},
	slidesPerView: 4,
	spaceBetween: 10,
	speed:1500,
	loop: true,
	navigation: {
		nextEl: '.m4_sd_next',
		prevEl: '.m4_sd_prev',
	},
	breakpoints: { 
        390: {
			slidesPerView: 1,
        },
        768: {
			slidesPerView: 2,
        },
    }
});

var swiper2 = new Swiper('.m5_sd', {
	autoplay: {
		delay: 500,
		disableOnInteraction: false,
	},
	slidesPerView: 4,
	spaceBetween: 30,
	speed:2000,
	loop: true,
	breakpoints: { 
        390: {
			slidesPerView: 1,
        },
        768: {
			slidesPerView: 2,
			spaceBetween: 10,
        },
		1200: {
			slidesPerView: 3,
			spaceBetween: 20,
        },
    }
});
</script>



<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
