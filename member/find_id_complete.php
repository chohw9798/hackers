<?php
session_start();
$findID=$_POST['checkedID'];
$findName=$_POST['checkedName'];

include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';

?>
    <div id="container" class="container-full">
        <div id="content" class="content">
            <div class="inner">
                <div class="tit-box-h3">
                    <h3 class="tit-h3">아이디/비밀번호 찾기</h3>
                    <div class="sub-depth">
                        <span><i class="icon-home"><span>홈</span></i></span>
                        <strong>아이디/비밀번호 찾기</strong>
                    </div>
                </div>

                <ul class="tab-list">
                    <li class="on"><a href="#">아이디 찾기</a></li>
                    <li><a href="/member/index.php?mode=find_pass">비밀번호 찾기</a></li>
                </ul>

                <div class="tit-box-h4">
                    <h3 class="tit-h4">아이디 조회결과</h3>
                </div>

                <div class="guide-box">
                    <p class="fs16 mb5"><?php echo $findName; ?> 회원님의 아이디는 아래와 같습니다.</p>
                    <strong class="big-title tc-brand"><?php echo $findID; ?></strong>
                </div>

                <div class="box-btn mt30">
                    <a href="#" class="btn-l">로그인하러 가기</a>
                    <a href="/member/index.php?mode=find_pass" class="btn-l-line ml5">비밀번호 찾기</a>
                </div>

            </div>
        </div>
    </div>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>