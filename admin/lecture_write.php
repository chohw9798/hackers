<?php
include_once  $_SERVER['DOCUMENT_ROOT'].'/header.php';
?>
<div id="container" class="container-full">
    <div id="content" class="content">
        <div class="inner">
            <div class="tit-box-h3">
                <h3 class="tit-h3">강의 등록</h3>
                <div class="sub-depth">
                    <span><i class="icon-home"><span>홈</span></i></span>
                    <span>강의 Admin</span>
                    <strong>강의 등록</strong>
                </div>
            </div>

            <form id="lectureWriteForm" action="/admin/index.php?mode=regist" method="post" enctype="multipart/form-data">
                <div class="section-content">
                    <table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
                        <caption class="hidden">강의정보</caption>
                        <colgroup>
                            <col style="width:15%"/>
                            <col style="*"/>
                        </colgroup>

                        <tbody>
                        <tr>
                            <th scope="col">강의 분류</th>
                            <td>
                                <select name="category" class="input-sel" style="width:160px">
                                    <option value="일반직무">일반직무</option>
                                    <option value="산업직무">산업직무</option>
                                    <option value="공통역량">공통역량</option>
                                    <option value="어학 및 자격증">어학 및 자격증</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">강의명</th>
                            <td><input name="title" type="text" class="input-text" style="width:611px"/></td>
                        </tr>
                        <tr>
                            <th scope="col">강사명</th>
                            <td><input name="teacher" type="text" class="input-text" style="width:611px"/></td>
                        </tr>
                        <tr>
                            <th scope="col">학습 난이도</th>
                            <td>
                                <select name="level" class="input-sel" style="width:160px">
                                    <option value="상">상</option>
                                    <option value="중">중</option>
                                    <option value="하">하</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">썸네일 이미지</th>
                            <td><input name="thumbnail" type="file" style="width:611px"/></td>
                        </tr>
                        <tr>
                            <th scope="col">강의 시간</th>
                            <td><input name="time" type="text" class="input-text" style="width:611px"/></td>
                        </tr>
                        <tr>
                            <th scope="col">강의 수</th>
                            <td><input name="num" type="text" class="input-text" style="width:611px"/></td>
                        </tr>

                        </tbody>
                    </table>

                    <div class="box-btn">
                        <a href="#" class="btn-l" onclick="writeBtn();">강의 등록</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script type="text/javascript">

    function writeBtn() {
        var extArr = new Array('bmp', 'rle', 'dib', 'jpg', 'gif', 'png', 'tif', 'tiff', 'raw');
        var path = $('input[name="thumbnail"]').val();
        var chkNum = /^[0-9]{1,10}$/;

        if(!$('input[name="title"]').val()){
            alert('강의명을 입력해주세요.');
            $('input[name="title"]').focus();
            return;
        }
        else if(!$('input[name="teacher"]').val()){
            alert('강사명을 입력해주세요.');
            $('input[name="teacher"]').focus();
            return;
        }
        else if(!path){
            alert('썸네일 이미지를 등록해주세요.');
            $('input[name="thumbnail"]').focus();
            return;
        }
        else if(path.indexOf(".")<0){
            alert("확장자가 없는 파일입니다.");
            return;
        }
        else if(!$('input[name="time"]').val()){
            alert('강의 시간을 입력해주세요.');
            $('input[name="time"]').focus();
            return;
        }
        else if(!$('input[name="num"]').val()){
            alert('강의 수를 입력해주세요.');
            $('input[name="num"]').focus();
            return;
        }
        else if(!chkNum.test($('input[name="time"]').val())){
            alert('강의 시간의 형식이 올바르지 않습니다.');
            $('input[name="time"]').focus();
            return;
        }
        else if(!chkNum.test($('input[name="num"]').val())){
            alert('강의 수의 형식이 올바르지 않습니다.');
            $('input[name="num"]').focus();
            return;
        }

        var ext = path.slice(path.indexOf(".")+1).toLowerCase();
        var chkExt = false;
        for(var i=0; i<extArr.length; i++){
            if(ext==extArr[i]){
                chkExt=true;
                break;
            }
        }
        if(chkExt==false){
            alert('업로드할 수 없는 파일 확장자입니다.');
            return false;
        }


        $('#lectureWriteForm').submit();
    }

</script>
<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>


