<?php
session_start();
$findID=$_POST['checkedID'];

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
                    <li><a href="/member/find_id.php">아이디 찾기</a></li>
                    <li class="on"><a href="#">비밀번호 찾기</a></li>
                </ul>

                <div class="tit-box-h4">
                    <h3 class="tit-h4">비밀번호 재설정</h3>
                </div>

                <div class="section-content mt30">
                    <form id="modifyPWForm" action="/member/modifyPW.php" method="post">
                        <table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
                            <caption class="hidden">비밀번호 재설정</caption>
                            <colgroup>
                                <col style="width:17%"/>
                                <col style="*"/>
                            </colgroup>

                            <tbody>
                            <tr>
                                <th scope="col">신규 비밀번호 입력</th>
                                <td><input name="newPW" type="text" class="input-text" placeholder="영문자로 시작하는 4~15자의 영문소문자,숫자" style="width:302px" /></td>
                            </tr>
                            <tr>
                                <th scope="col">신규 비밀번호 재확인</th>
                                <td><input name="newPWChk" type="text" class="input-text" style="width:302px" /></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="box-btn">
                            <a href="#" class="btn-l" onclick="modifyPW();">확인</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>

        function modifyPW() {
            if(!$('input[name="newPW"]').val()){
                alert('신규 비밀번호를 입력해주세요.');
                $('input[name="newPW"]').focus();
            }
            else if(!$('input[name="newPWChk"]').val()){
                alert('신규 비밀번호 재확인을 입력해주세요.');
                $('input[name="newPWChk"]').focus();
            }
            else if($('input[name="newPW"]').val()!=$('input[name="newPWChk"]').val()){
                alert('비밀번호와 비밀번호 재확인이 일치하지 않습니다.');
                $('input[name="newPWChk"]').focus();
            }
            //비밀번호 형식 올바르지 않을 경우 구현해야 함.
            else {
                $('#modifyPWForm').submit();
            }
        }

    </script>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>