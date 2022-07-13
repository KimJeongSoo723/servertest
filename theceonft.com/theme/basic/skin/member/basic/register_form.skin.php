<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

if( $member['mb_recommend']){
    $recommender = $member['mb_recommend'];
}else{
    $recommender = $recommender;
}
?>
<!-- 회원정보 입력/수정 시작 { -->
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js?v=<?php echo G5_JS_VER; ?>"></script>
<?php } ?>

<form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
    <input type="hidden" name="agree" value="<?php echo $agree ?>">
    <input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
    <input type="hidden" name="cert_no" value="">
    <?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
    <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
        <input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
        <input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
    <?php }  ?>
    <?if($w == 'u'){?>
    <input type="hidden" name="mb_8" value="<?php echo $member['mb_8']; ?>">
    <input type="hidden" name="mb_9" value="<?php echo $member['mb_9']; ?>">
    <input type="hidden" name="mb_10" value="<?php echo $member['mb_10']; ?>">
    <?}?>



    <div id="register_form"  class="form_01">
        <div>
            <h2>필수 정보<span class="text_required"><i class="icon_required"></i>필수 입력 항목입니다.</span></h2>
            <ul class="register_list">
                <li>
                    <div class="form_name"><p>아이디</p></div>
                    <label for="reg_mb_id" class="sound_only">아이디<strong>필수</strong></label>
                    <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="frm_input half_input <?php echo $required ?> <?php echo $readonly ?>" minlength="3" maxlength="20">
                    <?php if ($w=='') {?> <button type="button" class="btn_overlap" id="idcheck">중복확인</button><?}?>
                    <span id="msg_mb_id"></span>
                    <!--                <span class="frm_info">영문자, 숫자, _ 만 입력 가능. 최소 3자이상 입력하세요.</span>-->
                </li>
                <li>
                    <div class="form_name"><p>이름</p></div>
                    <label for="reg_mb_name" class="sound_only">이름<strong>필수</strong></label>
                    <input type="text" id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="frm_input half_input <?php echo $required ?> <?php echo $readonly ?>" size="10">
                    <?php
                    if($config['cf_cert_use']) {
                        if($config['cf_cert_ipin'])
                            echo '<button type="button" id="win_ipin_cert" class="btn_frmline">아이핀 본인확인</button>'.PHP_EOL;
                        if($config['cf_cert_hp'])
                            echo '<button type="button" id="win_hp_cert" class="btn_frmline">휴대폰 본인확인</button>'.PHP_EOL;

                        echo '<noscript>본인확인을 위해서는 자바스크립트 사용이 가능해야합니다.</noscript>'.PHP_EOL;
                    }
                    ?>
                    <?php
                    if ($config['cf_cert_use'] && $member['mb_certify']) {
                        if($member['mb_certify'] == 'ipin')
                            $mb_cert = '아이핀';
                        else
                            $mb_cert = '휴대폰';
                        ?>

                        <div id="msg_certify">
                            <strong><?php echo $mb_cert; ?> 본인확인</strong><?php if ($member['mb_adult']) { ?> 및 <strong>성인인증</strong><?php } ?> 완료
                        </div>
                    <?php } ?>
                    <?php if ($config['cf_cert_use']) { ?>
                        <span class="frm_info">아이핀 본인확인 후에는 이름이 자동 입력되고 휴대폰 본인확인 후에는 이름과 휴대폰번호가 자동 입력되어 수동으로 입력할수 없게 됩니다.</span>
                    <?php } ?>


                </li>
                <?php if ($req_nick) {  ?>
                    <li style="display:none">
                        <div class="form_name"><p>닉네임</p></div>
                        <label for="reg_mb_nick" class="sound_only">닉네임<strong>필수</strong></label>

                        <input type="hidden" name="mb_nick_default" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>">
                        <input type="text" name="mb_nick" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):"Nick".date("YmdHisB"); ?>" id="reg_mb_nick" required class="frm_input required nospace  half_input" size="10" maxlength="20">
                        <?php if ($w=='') {?>  <button type="button" class="btn_overlap" id="nickcheck">중복확인</button><?}?>
                        <span id="msg_mb_nick"></span>
                    </li>
                <?php }  ?>
                <li>
                    <div class="form_name"><p>비밀번호</p></div>
                    <label for="reg_mb_password" class="sound_only">비밀번호<strong class="sound_only">필수</strong></label>
                    <input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="frm_input half_input <?php echo $required ?>" minlength="3" maxlength="20">
                </li>
                <li>
                    <div class="form_name"><p>비밀번호 확인</p></div>
                    <label for="reg_mb_password_re" class="sound_only">비밀번호 확인<strong>필수</strong></label>
                    <input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="frm_input half_input <?php echo $required ?>" minlength="3" maxlength="20">
                </li>
				<?php //if($config['cf_use_hp']){?>
                <li>
                    <div class="form_name"><p>연락처</p></div>
					<input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> class="frm_input half_input <?php echo ($config['cf_req_hp'])?"required":""; ?>" maxlength="20">
					<?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
					<input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
					<?php } ?>
                </li>
				<?php //} ?>
                <li>
                    <div class="form_name"><p>이메일</p></div>
                    <label for="reg_mb_email" class="sound_only">E-mail<strong>필수</strong></label>

                    <?php if ($config['cf_use_email_certify']) {  ?>
                        <span class="frm_info">
							<?php if ($w=='') { echo "E-mail 로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다."; }  ?>
							<?php if ($w=='u') { echo "E-mail 주소를 변경하시면 다시 인증하셔야 합니다."; }  ?>
						</span>
                    <?php }  ?>
                    <div class="form_input">
                        <div class="emailbox">
                            <input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
                            <input type="text" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="frm_input email full_input required" size="250" maxlength="100" >
                        </div>
                        <span class="frm_info">· 기업 그룹웨어 메일인 경우 문자가 깨질 수도 있습니다. </span>
                    </div>

                </li>
				<?php if ($config['cf_use_addr']) { ?>
				<li style="padding-bottom:5px;min-height:0;border:0;">
					<div class="form_name"><p>주소</p></div>
					<?php if ($config['cf_req_addr']) { ?><strong class="sound_only">필수</strong><?php }  ?>
					<label for="reg_mb_zip" class="sound_only">우편번호<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
					<input type="text" name="mb_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="reg_mb_zip" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input <?php echo $config['cf_req_addr']?"required":""; ?>" size="5" maxlength="6"  placeholder="우편번호">
					<button type="button" class="btn_frmline" onclick="win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
				</li>
				<li style="padding-bottom:5px;min-height:0;border:0;">
					<div class="form_name"><p></p></div>
					<input type="text" name="mb_addr1" value="<?php echo get_text($member['mb_addr1']) ?>" id="reg_mb_addr1" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input half_input required <?php echo $config['cf_req_addr']?"required":""; ?>" size="50"  placeholder="기본주소">
					<label for="reg_mb_addr1" class="sound_only">기본주소<?php echo $config['cf_req_addr']?'<strong> 필수</strong>':''; ?></label>
				</li>
				<li style="padding-bottom:5px;min-height:0;border:0;">
					<div class="form_name"><p></p></div>
					<input type="text" name="mb_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="reg_mb_addr2" class="frm_input half_input required" size="50"  placeholder="상세주소">
					<label for="reg_mb_addr2" class="sound_only">상세주소</label>
				</li>
				<li>
					<div class="form_name"><p></p></div>
					<input type="text" name="mb_addr3" value="<?php echo get_text($member['mb_addr3']) ?>" id="reg_mb_addr3" class="frm_input half_input required" size="50" readonly="readonly"  placeholder="참고항목">
					<label for="reg_mb_addr3" class="sound_only">참고항목</label>
					<input type="hidden" name="mb_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
					
				</li>
				<?php }  ?>
                <li>
                    <div class="form_name"><p>생년월일</p></div>
                    <div class="datebox">
                        <input type="text" class="frm_input required nospace" required maxlength="10" alt="생년월일" size="13" name="mb_4" id="mb_4" readonly value="<?php echo isset($member['mb_4'])?get_text($member['mb_4']):''; ?>"  >
                    </div>

                    <script>
                        $(function(){
                            $("#mb_4").datepicker({
                                changeMonth: true,
                                changeYear: true,
                                dateFormat: "yy-mm-dd",
                                showButtonPanel: true,
                                yearRange: "c-99:c+99",
                                maxDate: "0",
                            });
                        });
                    </script>
                </li>
                <li>
                    <div class="form_name"><p>성별</p></div>
                    <div class="r_gender">
                        <input type="radio" id="mb_5" name="mb_5" value="F" <?php if($member['mb_5'] == 'F') {echo "checked"; } ?>/>
                        <label for="mb_5"><span>여자</span></label>

                        <input type="radio" id="mb_55" name="mb_5" value="M" <?php if($member['mb_5'] == 'M') {echo "checked"; } ?>/>
                        <label for="mb_55"><span>남자</span></label>
                    </div>
                </li>
                <li>
                    <div class="form_name"><p>이메일 수신동의</p></div>
                    <div class="form_agree_q">
                        <p>이벤트 및 컨텐츠 업데이트 등 피키 정보성 E-mail/SMS 받아 보시겠습니까?</p>
                        <div class="r_agree">
                            <span>
                                <input type="radio" id="mb_mailling" name="mb_mailling" value="1" <?php if($member['mb_mailling'] == '1') {echo "checked"; } ?>/>
                                <label for="mb_mailling"><span>동의</span></label>
                            </span>
                            <span>
                                <input type="radio" id="mb_mailling2" name="mb_mailling" value="0" <?php if($member['mb_mailling'] == '0') {echo "checked"; } ?>/>
                                <label for="mb_mailling2"><span>동의 안함</span></label>
                            </span>
                        </div>
                    </div>
                </li>

                <?php if ($config['cf_use_member_icon'] && $member['mb_level'] >= $config['cf_icon_level']) {  ?>
                    <li>
                        <div class="form_name"><p>회원아이콘</p></div>
                        <div class="form_agree_q0" >
                            <p>이미지 크기는 가로 <?php echo $config['cf_member_icon_width'] ?>픽셀, 세로 <?php echo $config['cf_member_icon_height'] ?>픽셀 이하로 해주세요.(gif, jpg, png파일만 가능)</p>
                            <span style="margin-top:8px;display:table;">
                             <?php if ($w == 'u' && file_exists($mb_icon_path)) {  ?>
                                 <img src="<?php echo $mb_icon_url ?>" alt="회원아이콘" width="<?php echo $config['cf_member_icon_width'] ?>" height="auto">
                                 <input type="checkbox" name="del_mb_icon" value="1" id="del_mb_icon">
                                 <label for="del_mb_icon" id="del_mb_icon1">삭제</label>
                             <?php }  ?>
                                <input type="file" name="mb_icon" id="reg_mb_icon" >
                            </span>
                        </div>
                    </li>
                <?php }  ?>

                <?  if($member['mb_level'] >= '4'){?>
                  <li id="myshopimg1">

                        <div class="form_name"><p style="line-height:1.5">마이샵 상단이미지<br>(pc)</p></div>
                        <div class="form_agree_q" >
                            <p class="img_">이미지 크기는 가로 <?php echo $config['cf_member_img_width'] ?> 픽셀, 세로 <?php echo $config['cf_member_img_height'] ?>픽셀 이하로 해주세요.(gif, jpg, png파일만 가능)</p>
                            <span style="margin-top:8px;display:table;">
                            <input type="file" name="mb_img" id="reg_mb_img" >
                            <?php if ($w == 'u' && file_exists($mb_img_path)) {  ?>
                                <br>
                                <img src="<?php echo $mb_img_url ?>" alt="마이샵 상단이미지" >
                                <input type="checkbox" name="del_mb_img" value="1" id="del_mb_img">
                                <label for="del_mb_img">삭제</label>
                            <?php }  ?>
                            </span>
                        </div>
                    </li>
                <?php } ?>
                <?  if($member['mb_level'] >= '4'){?>
                    <li>

                        <div class="form_name"><p style="line-height:1.5">마이샵 상단이미지<br>(mobile)</p></div>
                        <div class="form_agree_q" >
                            <p class="img_">이미지 크기는 가로 <?php echo $config['cf_member_img_width2'] ?> 픽셀, 세로 <?php echo $config['cf_member_img_height2'] ?>픽셀 이하로 해주세요.(gif, jpg, png파일만 가능)</p>
                            <span style="margin-top:8px;display:table;">
                            <input type="file" name="mb_img2" id="reg_mb_img2" >
                            <?php if ($w == 'u' && file_exists($mb_img_path2)) {  ?>
                                <br>
                                <img src="<?php echo $mb_img_url2 ?>" alt="마이샵 상단이미지" >
                                <input type="checkbox" name="del_mb_img2" value="1" id="del_mb_img2">
                                <label for="del_mb_img2">삭제</label>
                            <?php }  ?>
                            </span>
                        </div>
                    </li>
                <?php } ?>


                <li class="is_captcha_use">
                    <div class="form_name"><p>자동등록방지</p></div>

                    <?php echo captcha_html(); ?>
                </li>
                <?php
                //회원정보 수정인 경우 소셜 계정 출력
                if( $w == 'u' && function_exists('social_member_provider_manage') ){
                    social_member_provider_manage();
                }
                ?>

            </ul>
        </div>

    </div>
    <div class="btn_confirm">
        <input type="submit" value="<?php echo $w==''?'가입하기':'정보수정'; ?>" id="btn_submit" class="btn_submit" accesskey="s">
    </div>
</form>

<script>
    $(function() {



        $("#reg_zip_find").css("display", "inline-block");

        <?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
        // 아이핀인증
        $("#win_ipin_cert").click(function() {
            if(!cert_confirm())
                return false;

            var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
            certify_win_open('kcb-ipin', url);
            return;
        });

        <?php } ?>
        <?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
        // 휴대폰인증
        $("#win_hp_cert").click(function() {
            if(!cert_confirm())
                return false;

            <?php
            switch($config['cf_cert_hp']) {
                case 'kcb':
                    $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                    $cert_type = 'kcb-hp';
                    break;
                case 'kcp':
                    $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                    $cert_type = 'kcp-hp';
                    break;
                case 'lg':
                    $cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
                    $cert_type = 'lg-hp';
                    break;
                default:
                    echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                    echo 'return false;';
                    break;
            }
            ?>

            certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>");
            return;
        });
        <?php } ?>
    });

    // submit 최종 폼체크
    function fregisterform_submit(f)
    {
        // 회원아이디 검사
        if (f.w.value == "") {
            var msg = reg_mb_id_check();
            if (msg) {
                alert(msg);
                f.mb_id.select();
                return false;
            }
        }

        if (f.w.value == "") {
            if (f.mb_password.value.length < 3) {
                alert("비밀번호를 3글자 이상 입력하십시오.");
                f.mb_password.focus();
                return false;
            }
        }

        if (f.mb_password.value != f.mb_password_re.value) {
            alert("비밀번호가 같지 않습니다.");
            f.mb_password_re.focus();
            return false;
        }

        if (f.mb_password.value.length > 0) {
            if (f.mb_password_re.value.length < 3) {
                alert("비밀번호를 3글자 이상 입력하십시오.");
                f.mb_password_re.focus();
                return false;
            }
        }

        // 이름 검사
        if (f.w.value=="") {
            if (f.mb_name.value.length < 1) {
                alert("이름을 입력하십시오.");
                f.mb_name.focus();
                return false;
            }

            /*
            var pattern = /([^가-힣\x20])/i;
            if (pattern.test(f.mb_name.value)) {
                alert("이름은 한글로 입력하십시오.");
                f.mb_name.select();
                return false;
            }
            */
        }

        <?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
        // 본인확인 체크
        if(f.cert_no.value=="") {
            alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
            return false;
        }
        <?php } ?>

        // 닉네임 검사
        if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
            var msg = reg_mb_nick_check();
            if (msg) {
                alert(msg);
                f.reg_mb_nick.select();
                return false;
            }
        }

        // E-mail 검사
        if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
            var msg = reg_mb_email_check();
            if (msg) {
                alert(msg);
                f.reg_mb_email.select();
                return false;
            }
        }

        <?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
        // 휴대폰번호 체크
        var msg = reg_mb_hp_check();
        if (msg) {
            alert(msg);
            f.reg_mb_hp.select();
            return false;
        }
        <?php } ?>

        if (typeof f.mb_icon != "undefined") {
            if (f.mb_icon.value) {
                if (!f.mb_icon.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
                    alert("회원아이콘이 이미지 파일이 아닙니다.");
                    f.mb_icon.focus();
                    return false;
                }
            }
        }

        if (typeof f.mb_img != "undefined") {
            if (f.mb_img.value) {
                if (!f.mb_img.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
                    alert("회원이미지가 이미지 파일이 아닙니다.");
                    f.mb_img.focus();
                    return false;
                }
            }
        }

        if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
            if (f.mb_id.value == f.mb_recommend.value) {
                alert("본인을 추천할 수 없습니다.");
                f.mb_recommend.focus();
                return false;
            }

            /*
            var msg = reg_mb_recommend_check();
            if (msg) {
                alert(msg);
                f.mb_recommend.select();
                return false;
            }
             */

        }

        <?php echo chk_captcha_js();  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }


    /*    //selectbox 스크립트
        $('#listmenu01 > ul').navToSelect();
        jQuery(function($){
            $("#listmenu01 > ul").navToSelecct({
                activeClass: 'active',
                indentString: '&ndash;',
                defaultText: 'Navigate to..'
            });
        });*/




    $("#idcheck").click(function(){
        var msg = reg_mb_id_check();
        if(msg == "" || msg == null){
            if(!confirm("가입할 수 있는 아이디입니다.\n현재 아이디를 사용하시겠습니까?")){
                document.getElementById("reg_mb_id").value = "";
            }
        }
        else
        {
            alert(msg);
        }
    });


    $("#nickcheck").click(function(){
        var msg = reg_mb_nick_check();
        if(msg == "" || msg == null){
            if(!confirm("가입할 수 있는 닉네임입니다.\n현재 닉네임을 사용하시겠습니까?")){
                document.getElementById("reg_mb_nick").value = "";
            }
        }
        else
        {
            alert(msg);
        }
    });

</script>

<!-- } 회원정보 입력/수정 끝 -->

