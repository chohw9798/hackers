<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/common/db.php";
include_once  $_SERVER['DOCUMENT_ROOT'].'/header.php';
?>
    <div id="container" class="container">
        <?php
        include_once $_SERVER['DOCUMENT_ROOT'].'/left.php';
        ?>

        <div id="content" class="content">
            <div class="tit-box-h3">
                <h3 class="tit-h3">수강후기</h3>
                <div class="sub-depth">
                    <span><i class="icon-home"><span>홈</span></i></span>
                    <span>직무교육 안내</span>
                    <strong>수강후기</strong>
                </div>
            </div>

            <div class="user-notice">
                <strong class="fs16">유의사항 안내</strong>
                <ul class="list-guide mt15">
                    <li class="tc-brand">수강후기는 신청하신 강의의 학습진도율 25%이상 달성시 작성가능합니다. </li>
                    <li>욕설(욕설을 표현하는 자음어/기호표현 포함) 및 명예훼손, 비방,도배글, 상업적 목적의 홍보성 게시글 등 사회상규에 반하는 게시글 및 강의내용과 상관없는 서비스에 대해 작성한 글들은 삭제 될 수 있으며, 법적 책임을 질 수 있습니다.</li>
                </ul>
            </div>

            <form id="tx_editor_form" name="tx_editor_form" method="POST" action="/lecture_board/index.php?mode=edit">
                <input name="reviewIdx" type="hidden" value="<?php echo $_GET['reviewIdx'];?>"/>
                <table border="0" cellpadding="0" cellspacing="0" class="tbl-col">
                    <caption class="hidden">강의정보</caption>
                    <colgroup>
                        <col style="width:15%"/>
                        <col style="*"/>
                    </colgroup>

                    <tbody>
                    <tr>
                        <th scope="col">강의</th>
                        <td>
                            <select id="category" name="category" class="input-sel" style="width:160px">
                                <option value="분류">분류</option>
                                <option value="일반직무">일반직무</option>
                                <option value="산업직무">산업직무</option>
                                <option value="공통역량">공통역량</option>
                                <option value="어학 및 자격증">어학 및 자격증</option>
                            </select>
                            <select id="lectureTitle" name="lectureTitle" class="input-sel ml5" style="width:454px">
                                <option value="강의명">강의명</option>
                                <?php
                                $result = mysqli_query($conn, "select * from lecture");

                                $i=0;
                                while($row = mysqli_fetch_assoc($result)){

                                    if($row['lectureCategory']=='일반직무'){
                                        echo "<option class='general' value='{$row['lectureTitle']}' style='display: none'>{$row['lectureTitle']}</option>";
                                    }
                                    else if($row['lectureCategory']=='산업직무'){
                                        echo "<option class='industry' value='{$row['lectureTitle']}' style='display: none'>{$row['lectureTitle']}</option>";
                                    }
                                    else if($row['lectureCategory']=='공통역량'){
                                        echo "<option class='common' value='{$row['lectureTitle']}' style='display: none'>{$row['lectureTitle']}</option>";
                                    }
                                    else if($row['lectureCategory']=='어학 및 자격증'){
                                        echo "<option class='certificate' value='{$row['lectureTitle']}' style='display: none'>{$row['lectureTitle']}</option>";
                                    }

                                    $i++;
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">제목</th>
                        <td><input id="reviewTitle" name="reviewTitle" type="text" class="input-text" value=<?php echo $_GET['reviewTitle'];?> style="width:611px"/></td>
                    </tr>
                    <tr>

                        <input type="hidden" id="satisfaction" name="satisfaction" value="5"/>
                        <th scope="col">강의만족도</th>
                        <td>
                            <ul class="list-rating-choice">
                                <li>
                                    <label class="input-sp ico">
                                        <input type="radio" name="radio" id="" value="5" checked="checked"/>
                                        <span class="input-txt">만점</span>
                                    </label>
                                    <span class="star-rating">
									<span class="star-inner" style="width:100%"></span>
								</span>
                                </li>
                                <li>
                                    <label class="input-sp ico">
                                        <input type="radio" name="radio" value="4" id=""/>
                                        <span class="input-txt"></span>
                                    </label>
                                    <span class="star-rating">
									<span class="star-inner" style="width:80%"></span>
								</span>
                                </li>
                                <li>
                                    <label class="input-sp ico">
                                        <input type="radio" name="radio" value="3" id=""/>
                                        <span class="input-txt"></span>
                                    </label>
                                    <span class="star-rating">
									<span class="star-inner" style="width:60%"></span>
								</span>
                                </li>
                                <li>
                                    <label class="input-sp ico">
                                        <input type="radio" name="radio" value="2" id=""/>
                                        <span class="input-txt"></span>
                                    </label>
                                    <span class="star-rating">
									<span class="star-inner" style="width:40%"></span>
								</span>
                                </li>
                                <li>
                                    <label class="input-sp ico">
                                        <input type="radio" name="radio" value="1" id=""/>
                                        <span class="input-txt"></span>
                                    </label>
                                    <span class="star-rating">
									<span class="star-inner" style="width:20%"></span>
								</span>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>

            <div class="editor-wrap">
                <?php
                include_once $_SERVER['DOCUMENT_ROOT'].'/daumEditor/editor.html';
                ?>
                <input type="hidden" name="editorContent" id="editorContent"/>
            </div>

            <div class="box-btn t-r">
                <a href="/lecture_board/index.php?mode=list" class="btn-m-gray">목록</a>
                <a href="#" class="btn-m ml5" onclick="editBtn();">수정 </a>
            </div>
            </form>
        </div>
    </div>
<script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script type="text/javascript">
    function editBtn() {
        Editor.save();

    }

    $('#category').change(
        function (){
            $('#lectureTitle').val("강의명");
            switch ($(this).val()){
                case '분류' :
                    $('.general').hide();
                    $('.industry').hide();
                    $('.common').hide();
                    $('.certificate').hide();
                    break;
                case '일반직무' :
                    $('.general').show();
                    $('.industry').hide();
                    $('.common').hide();
                    $('.certificate').hide();
                    break;
                case '산업직무' :
                    $('.general').hide();
                    $('.industry').show();
                    $('.common').hide();
                    $('.certificate').hide();
                    break;
                case '공통역량' :
                    $('.general').hide();
                    $('.industry').hide();
                    $('.common').show();
                    $('.certificate').hide();
                    break;
                case '어학 및 자격증' :
                    $('.general').hide();
                    $('.industry').hide();
                    $('.common').hide();
                    $('.certificate').show();
                    break;
            }
        }
    )

    $('input[name="radio"]').change(
        function (){
            $('#satisfaction').val($(this).val());
        }
    );
</script>
<?php
include_once  $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>

<!--<script type="text/javascript">
                    $(document).ready(function (){
                        Editor.setContent();
                    })
                </script>-->
<!--$_GET['reviewContent']-->