<?php

session_start();

include_once  $_SERVER['DOCUMENT_ROOT'].'/header.php';

?>
    <div id="container" class="container-full">
        <div id="content" class="content">
            <div class="inner">
                <div class="tit-box-h3">
                    <h3 class="tit-h3">회원가입</h3>
                    <div class="sub-depth">
                        <span><i class="icon-home"><span>홈</span></i></span>
                        <strong>회원가입</strong>
                    </div>
                </div>

                <div class="join-step-bar">
                    <ul>
                        <li><i class="icon-join-agree"></i> 약관동의</li>
                        <li><i class="icon-join-chk"></i> 본인확인</li>
                        <li class="last on"><i class="icon-join-inp"></i> 정보입력</li>
                    </ul>
                </div>

                <form id="memberJoinForm" action="/member/index.php?mode=regist" method="POST">
                    <input type="hidden" name="dupChk" value="0"/>
                    <div class="section-content">
                        <table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
                            <caption class="hidden">강의정보</caption>
                            <colgroup>
                                <col style="width:15%"/>
                                <col style="*"/>
                            </colgroup>

                            <tbody>
                            <tr>
                                <th scope="col"><span class="icons">*</span>이름</th>
                                <td><input name="uName" type="text" class="input-text" style="width:302px"/></td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>아이디</th>
                                <td><input name="uID" type="text" class="input-text" style="width:302px" placeholder="영문자로 시작하는 4~15자의 영문소문자, 숫자"/><a href="#" class="btn-s-tin ml10" onclick="duplicationChk();">중복확인</a></td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>비밀번호</th>
                                <td><input name="uPW" type="password" class="input-text" style="width:302px" placeholder="8-15자의 영문자/숫자 혼합"/></td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>비밀번호 확인</th>
                                <td><input name="chkPW" type="password" class="input-text" style="width:302px"/></td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>이메일주소</th>
                                <td>
                                    <input name="email1" type="text" class="input-text" style="width:138px"/> @ <input name="email2" type="text" class="input-text" style="width:138px"/>
                                    <!--<select class="input-sel" style="width:160px">
                                        <option value="">선택입력</option>
                                        <option value="">선택입력</option>
                                        <option value="">선택입력</option>
                                        <option value="">선택입력</option>
                                        <option value="">선택입력</option>
                                    </select>-->
                                </td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>휴대폰 번호</th>
                                <td>
                                    <input name="phoneNum1" type="text" class="input-text" style="width:50px" value="010" readonly/> -
                                    <input name="phoneNum2" type="text" class="input-text" style="width:50px" value="3938" readonly/> -
                                    <input name="phoneNum3" type="text" class="input-text" style="width:50px" value="3854" readonly/>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons"></span>일반전화 번호</th>
                                <td><input name="homePhoneNum1" type="text" class="input-text" style="width:88px"/> - <input name="homePhoneNum2" type="text" class="input-text" style="width:88px"/> - <input name="homePhoneNum3" type="text" class="input-text" style="width:88px"/></td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>주소</th>
                                <td>
                                    <p >
                                        <label>우편번호 <input name="postalCode" type="text" class="input-text ml5" style="width:242px" disabled /></label><a href="#" class="btn-s-tin ml10" onclick="findAddress();">주소찾기</a>
                                    </p>
                                    <p class="mt10">
                                        <label>기본주소 <input name="primaryAddress" type="text" class="input-text ml5" style="width:719px"/></label>
                                    </p>
                                    <p class="mt10">
                                        <label>상세주소 <input name="detailedAddress" type="text" class="input-text ml5" style="width:719px"/></label>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>SMS수신</th>
                                <td>
                                    <div class="box-input">
                                        <label class="input-sp">
                                            <input type="radio" name="valSMS" value=1 id="" checked="checked"/>
                                            <span class="input-txt">수신함</span>
                                        </label>
                                        <label class="input-sp">
                                            <input type="radio" name="valSMS" value=0 id="" />
                                            <span class="input-txt">미수신</span>
                                        </label>
                                    </div>
                                    <p>SMS수신 시, 해커스의 혜택 및 이벤트 정보를 받아보실 수 있습니다.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>메일수신</th>
                                <td>
                                    <div class="box-input">
                                        <label class="input-sp">
                                            <input type="radio" name="valMail" value=1 id="" checked="checked"/>
                                            <span class="input-txt">수신함</span>
                                        </label>
                                        <label class="input-sp">
                                            <input type="radio" name="valMail" value=0 id="" />
                                            <span class="input-txt">미수신</span>
                                        </label>
                                    </div>
                                    <p>메일수신 시, 해커스의 혜택 및 이벤트 정보를 받아보실 수 있습니다.</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="box-btn">
<!--                            <input type="submit" value="회원가입">-->
                            <a href="#;" class="btn-l" onclick="joinBtn();">회원가입</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script type="text/javascript">

    function findAddress() {
        new daum.Postcode({
            oncomplete: function(data) {
                var addr = '';

                if(data.userSelectedType ==='R'){
                    addr = data.roadAddress;
                }
                else {
                    addr = data.jibunAddress;
                }

                $('input[name="postalCode"]').val(data.zonecode);
                $('input[name="primaryAddress"]').val(addr);
                $('input[name="detailedAddress"]').focus();
            }
        }).open();

    }

    var checkedID;

    function duplicationChk(){
        var idChk = /^[a-z]{1}[a-z0-9]{3,14}$/;
        var uID = $('input[name="uID"]').val();

        if(!idChk.test(uID)){
            alert('올바르지 않은 아이디 형식입니다.');
            $('input[name="dupChk"]').val(0);
            return;
        }

        $.ajax({
            url:"/member/duplicationChk.php",
            type: "get",
            dataType: "json",
            data:{myID: uID},
            type: "GET",
            success: function(data){
                console.log(data);
                console.log(data.success);

                if(data.success==1){
                    alert('이미 존재하는 아이디입니다.');
                    $('input[name="dupChk"]').val(0);

                }
                else {
                    alert('사용해도 좋은 아이디입니다.');
                    checkedID = uID;
                    $('input[name="dupChk"]').val(1);
                }


            },
            error: function (request, status, error){
                alert('통신 실패');
            }
        })



    }

    function joinBtn(){
        var emailChk = /^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i;
        var pwChk = /^[a-zA-Z0-9]{8,15}$/;

        var uName = $('input[name="uName"]').val();
        var uID = $('input[name="uID"]').val();
        var uPW = $('input[name="uPW"]').val();
        var chkPW = $('input[name="chkPW"]').val();

        var email1 = $('input[name="email1"]').val();
        var email2 = $('input[name="email2"]').val();

        var postalCode = $('input[name="postalCode"]').val();
        //var primaryAddress = $('input[name="primaryAddress"]').val();
        var detailedAddress = $('input[name="detailedAddress"]').val();

        var dupChk = $('input[name="dupChk"]').val();

        if(!uName){
            alert('이름을 입력해주세요.');
            $('input[name="uName"]').focus();
            return;
        }
        else if(!uID){
            alert('아이디를 입력해주세요.');
            $('input[name="uID"]').focus();
            return;
        }

        else if(dupChk==0||checkedID!=uID){
            alert('중복확인을 해주세요.');
            $('.btn-s-tin ml10').focus();
            return;
        }
        else if(!uPW){
            alert('비밀번호를 입력해주세요.');
            $('input[name="uPW"]').focus();
            return;
        }
        else if(!chkPW){
            alert('비밀번호 확인을 입력해주세요.');
            $('input[name="chkPW"]').focus();
            return;
        }
        else if(uPW!=chkPW){
            alert('비밀번호와 비밀번호 확인이 일치하지 않습니다.');
            $('input[name="chkPW"]').focus();
            return;
        }
        else if(!pwChk.test(uPW)) {
            alert('비밀번호 형식이 올바르지 않습니다.');
            $('input[name="uPW"]').focus();
            return;
        }
        else if(!emailChk.test(email1+"@"+email2)){
            alert('이메일 형식이 올바르지 않습니다.');
            $('input[name="email1"]').focus();
            return;
        }
        else if(!postalCode){
            alert('주소찾기를 눌러서 주소를 입력해주세요.');
            return;
        }
        else if(!detailedAddress){
            alert('상세주소를 입력해주세요.');
            $('input[name="detailedAddress"]').focus();
            return;
        }


        $('input[name="postalCode"]').prop('disabled',false);
        $('#memberJoinForm').submit();
    }


</script>
<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>

<!--
-->
