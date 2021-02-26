<?php
session_start();
$_SESSION['confirm'] = "123456";
?>

    <?php
    include_once  $_SERVER['DOCUMENT_ROOT'].'/header.php';
    ?>
    <div id="container" class="container-full">
        <div id="content" class="content">
            <input name="correctNum" type="hidden" value="<?=$_SESSION['confirm']?>" />

            <div class="inner">
                <div class="tit-box-h3">
                    <h3 class="tit-h3">회원가입</h3>
                    <div class="sub-depth">
                        <span><i class="icon-home"><span>홈</span></i></span>
                        <strong>회원가입 완료</strong>
                    </div>
                </div>

                <div class="join-step-bar">
                    <ul>
                        <li><i class="icon-join-agree"></i> 약관동의</li>
                        <li class="on"><i class="icon-join-chk"></i> 본인확인</li>
                        <li class="last"><i class="icon-join-inp"></i> 정보입력</li>
                    </ul>
                </div>

                <div class="tit-box-h4">
                    <h3 class="tit-h4">본인인증</h3>
                </div>

                <div class="section-content after">
                    <div class="identify-box" style="width:100%;height:190px;">
                        <div class="identify-inner">
                            <strong>휴대폰 인증</strong>
                            <p>주민번호 없이 메시지 수신가능한 휴대폰으로 1개 아이디만 회원가입이 가능합니다. </p>

                            <br />
                            <input name="phoneNum1" type="text" class="input-text" style="width:50px"/> -
                            <input name="phoneNum2" type="text" class="input-text" style="width:50px"/> -
                            <input name="phoneNum3" type="text" class="input-text" style="width:50px"/>
                            <a href="#" class="btn-s-line" onclick="getNum();">인증번호 받기</a>

                            <br /><br />
                            <input name="confirmedNum" type="text" class="input-text" style="width:200px"/>
                            <a href="#" class="btn-s-line" onclick="confirmNum();">인증번호 확인</a>
                        </div>
                        <i class="graphic-phon"><span>휴대폰 인증</span></i>
                    </div>
                </div>

            </div>
        </div>
    </div>

<script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    function getNum() {
        var chk = /^01[016789]{1}-?([0-9]{3,4})-?[0-9]{4}$/;
        var value = $('input[name="phoneNum1"]').val()+"-"+$('input[name="phoneNum2"]').val()+"-"+$('input[name="phoneNum3"]').val();
        if(!chk.test(value)){
            alert('휴대폰 번호를 올바르게 입력해주세요.');
        }
        else {
            alert('인증번호가 전송되었습니다.');
        }
    }
    function confirmNum() {
        if($('input[name="confirmedNum"]').val() === $('input[name="correctNum"]').val()) {
            alert('휴대폰 인증에 성공했습니다!');
            location.href="/member/index.php?mode=step_03";

        }else {
            alert('인증번호가 일치하지 않습니다.');
        }
    }
</script>

<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>


<!--
!($('input[name="phoneNum1"]').val())||!($('input[name="phoneNum2"]').val())||!($('input[name="phoneNum3"]').val())
!preg_match('/^01[016789]{1}-?([0-9]{3,4})-?[0-9]{4}$/', $('input[name="phoneNum1"]').val()+"-"+$('input[name="phoneNum2"]').val()+"-"+$('input[name="phoneNum3"]').val())
-->