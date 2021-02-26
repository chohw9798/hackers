<?php
session_start();
$_SESSION['confirm'] = "123456";
include_once  $_SERVER['DOCUMENT_ROOT'].'/header.php';
?>
    <div id="container" class="container-full">
        <div id="content" class="content">
            <input name="correctNum" type="hidden" value="<?=$_SESSION['confirm']?>" />
            <div class="inner">
                <div class="tit-box-h3">
                    <h3 class="tit-h3">아이디/비밀번호 찾기</h3>
                    <div class="sub-depth">
                        <span><i class="icon-home"><span>홈</span></i></span>
                        <strong>아이디/비밀번호 찾기</strong>
                    </div>
                </div>

                <ul class="tab-list">
                    <li><a href="/member/index.php?mode=find_id">아이디 찾기</a></li>
                    <li class="on"><a href="#">비밀번호 찾기</a></li>
                </ul>

                <div class="tit-box-h4">
                    <h3 class="tit-h4">비밀번호 찾기 방법 선택</h3>
                </div>

                <dl class="find-box">
                    <dt>휴대폰 인증</dt>
                    <dd>
                        고객님이 회원 가입 시 등록한 휴대폰 번호와 입력하신 휴대폰 번호가 동일해야 합니다.
                        <label class="input-sp big">
                            <input type="radio" name="radio" value="P"/>
                            <span class="input-txt"></span>
                        </label>
                    </dd>
                </dl>

                <dl class="find-box">
                    <dt>이메일 인증</dt>
                    <dd>
                        고객님이 회원 가입 시 등록한 이메일 주소와 입력하신 이메일 주소가 동일해야 합니다.
                        <label class="input-sp big">
                            <input type="radio" name="radio" value="email"/>
                            <span class="input-txt"></span>
                        </label>
                    </dd>
                </dl>

                <div class="section-content mt30">
                    <form id="findPWForm" action="/member/index.php?mode=find_pw_complete" method="post">
                        <table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join" style="display:none;">
                            <caption class="hidden">아이디/비밀번호 찾기 개인정보입력</caption>
                            <colgroup>
                                <col style="width:15%"/>
                                <col style="*"/>
                            </colgroup>

                            <tbody>
                            <tr>
                                <th scope="col">성명</th>
                                <td><input type="text" class="input-text" style="width:302px" name="uName" /></td>
                            </tr>
                            <tr>
                                <th scope="col">아이디</th>
                                <td><input type="text" class="input-text" style="width:302px" name="uID"/></td>
                            </tr>
                            <tr class="phone-item" style="display:none;">
                                <th scope="col">휴대폰번호</th>
                                <td>
                                    <input name = "phoneNum1" type="text" class="input-text" style="width:138px"/> - <input name = "phoneNum2" type="text" class="input-text" style="width:138px"/> - <input name = "phoneNum3" type="text" class="input-text" style="width:138px"/>

                                    <a href="#" class="btn-s-tin ml10" onclick="getNum();">인증번호 받기</a>
                                </td>
                            </tr>
                            <tr class="email-item" style="display:none;">
                                <th scope="col">이메일주소</th>
                                <td>
                                    <input name="email1" type="text" class="input-text" style="width:138px"/> @ <input name="email2" type="text" class="input-text" style="width:138px"/>
                                    <select class="input-sel" style="width:160px">
                                        <option value="">선택입력</option>
                                        <option value="">선택입력</option>
                                        <option value="">선택입력</option>
                                        <option value="">선택입력</option>
                                        <option value="">선택입력</option>
                                    </select>

                                    <a href="#" class="btn-s-tin ml10" onclick="getNum();">인증번호 받기</a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">인증번호</th>
                                <td><input name="confirmedNum" type="text" class="input-text" style="width:478px" /><a href="#" class="btn-s-tin ml10" onclick="confirmNum();">인증번호 확인</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </form>


                </div>
            </div>
        </div>
    </div>

<script>
    var chkMode;
    var checkedID;

    var isGotNum;

    function getNum(){
        if(!$('input[name="uName"]').val()){
            alert('성명을 입력해주세요.');
            $('input[name="uName"]').focus();
            return;
        }
        if(!$('input[name="uID"]').val()){
            alert('아이디를 입력해주세요.');
            $('input[name="uID"]').focus();
            return;
        }

        //휴대폰 인증일 경우
        if(chkMode==0){
            if(!$('input[name="phoneNum1"]').val()||!$('input[name="phoneNum2"]').val()||!$('input[name="phoneNum3"]').val()){
                alert('휴대폰번호를 입력해주세요.');
                return;
            }
            else{
                $.ajax({
                    url:"/member/phoneChk_pw.php",
                    dataType: "json",
                    data:{chkMode:chkMode, uName:$('input[name="uName"]').val(), uID:$('input[name="uID"]').val(),phoneNum1:$('input[name="phoneNum1"]').val(), phoneNum2:$('input[name="phoneNum2"]').val(), phoneNum3:$('input[name="phoneNum3"]').val()},
                    type: "POST",
                    success: function(data){
                        console.log(data);
                        console.log(data.success);

                        if(data.success=="no"){
                            alert('성명, 아이디, 휴대폰번호를 정확히 입력해주세요.');
                            isGotNum=0;
                        }
                        else {
                            alert('인증번호가 전송되었습니다.');
                            checkedID = data.id;

                            $('input[name="checkedID"]').val(checkedID);

                            isGotNum=1;
                        }


                    },
                    error: function (request, status, error){

                    }
                })
            }
        }
        //이메일 인증일 경우
        else{
            if(!$('input[name="email1"]').val()||!$('input[name="email2"]').val()){
                alert('이메일주소를 입력해주세요.');
                return;
            }
            else{
                $.ajax({
                    url:"/member/phoneChk_pw.php",
                    dataType: "json",
                    data:{chkMode:chkMode, uName:$('input[name="uName"]').val(), uID:$('input[name="uID"]').val(),email1:$('input[name="email1"]').val(), email2:$('input[name="email2"]').val()},
                    type: "POST",
                    success: function(data){
                        console.log(data);
                        console.log(data.success);

                        if(data.success=="no"){
                            alert('성명, 아이디 이메일주소를 정확히 입력해주세요.');
                            isGotNum=0;
                        }
                        else {
                            alert('인증번호가 전송되었습니다.');
                            checkedID = data.id;

                            $('input[name="checkedID"]').val(checkedID);

                            isGotNum=1;
                        }


                    },
                    error: function (request, status, error){

                    }
                })
            }
        }

    }
    function confirmNum(){
        if(!isGotNum){
            alert('인증번호 받기 버튼을 먼저 눌러주세요!');
        }
        else if($('input[name="confirmedNum"]').val() === $('input[name="correctNum"]').val()) {
            alert('인증에 성공했습니다!');
            $('#findPWForm').submit();

        }else {
            alert('인증번호가 일치하지 않습니다.');
        }
    }

    $('input[name="radio"]').change(
        function (){
            $('.tbl-col-join').show();
            if($(this).val()=="P"){
                chkMode=0;
                $('input[name="chkMode"]').val(0);
                $('.phone-item').show();
                $('.email-item').hide();
            }else{
                $('input[name="chkMode"]').val(1);
                chkMode=1;
                $('.phone-item').hide();
                $('.email-item').show();
            }

            console.log(chkMode);
            return false;

        }
    );
</script>

<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>
