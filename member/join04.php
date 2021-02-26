<?php
include_once  $_SERVER['DOCUMENT_ROOT'].'/header.php';
?>
    <div id="container" class="container-full">
        <div id="content" class="content">
            <div class="inner">
                <div class="tit-box-h3">
                    <h3 class="tit-h3">회원가입 완료</h3>
                    <div class="sub-depth">
                        <span><i class="icon-home"><span>홈</span></i></span>
                        <strong>회원가입 완료</strong>
                    </div>
                </div>

                <div class="guide-box">
                    <i class="graphic-join"></i>
                    <p class="big-title">해커스HRD 회원이 되신것을 환영합니다!</p>
                    <p class="mt10">해커스에서 제공하는 다양한 컨텐츠를 누리세요!<br/>해커스는 언제나 여러분의 목표달성을 응원합니다.</p>
                </div>

                <div class="box-btn mt30">
                    <a href="#" class="btn-l" onclick="login();">로그인</a>
                    <a href="#" class="btn-l-line ml5">수강신청</a>
                </div>

            </div>
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        function login() {
            location.href="/member/login.php";
        }
    </script>
    <?php
        include_once $_SERVER['DOCUMENT_ROOT'].'/footer.php';
    ?>
