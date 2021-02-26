<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/common/db.php";
include_once  $_SERVER['DOCUMENT_ROOT'].'/header.php';

$reviewIdx=$_GET['reviewIdx'];
$result=mysqli_query($conn, "select * from review where reviewIdx={$reviewIdx}");
$row=mysqli_fetch_assoc($result);

$sqlLecture = "SELECT lectureCategory, lectureTitle, lectureTeacher, lectureLevel, lectureTime, lectureNum, lectureThumbnail FROM lecture WHERE lectureIdx={$row['reviewLecture']}";
$resultLecture = mysqli_query($conn, $sqlLecture);
$rowLecture = mysqli_fetch_row($resultLecture);
$category = $rowLecture[0]; //분류
$lecTitle = $rowLecture[1]; //강의명
$lecTeacher = $rowLecture[2]; //강사
$lecLevel = $rowLecture[3]; //학습난이도
$lecTime= $rowLecture[4]; //교육시간
$lecNum= $rowLecture[5]; // 강의 수
$lecThumbnail = $rowLecture[6]; //썸네일
mysqli_free_result($resultLecture);


$sqlMember = "SELECT name FROM member WHERE idx={$row['reviewMember']}";
$resultMember = mysqli_query($conn, $sqlMember);
$rowMember = mysqli_fetch_row($resultMember);
$member = $rowMember[0]; //작성자 이름
mysqli_free_result($resultMember);

$reviewTitle = $row['reviewTitle']; //리뷰 제목
$numOfViews = $row['numOfViews']; // 조회수
$reviewDate = $row['reviewDate']; //등록일
$reviewSatisfaction = $row['reviewSatisfaction']; // 만족도
$reviewContent = $row['reviewContent']; //내용
$reviewFile = $row['reviewFile']; //파일

?>
<script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
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

            <table border="0" cellpadding="0" cellspacing="0" class="tbl-bbs-view">
                <caption class="hidden">수강후기</caption>
                <colgroup>
                    <col style="*"/>
                    <col style="width:20%"/>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="col">제목 : <?php echo $reviewTitle;?></th>
                    <th scope="col" class="user-id">작성자 | <?php echo $member;?></th>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="box-rating">
                            <span class="tit_rating">강의만족도</span>
                            <span class="star-rating">
								<span class="star-inner" style="width:<?php echo $reviewSatisfaction*20?>%"></span>
							</span>
                        </div>
                        <?php
                            echo $reviewContent;
                        ?>
                    </td>
                </tr>
                </tbody>
            </table>


            <p class="mb15"><strong class="tc-brand fs16"><?php echo $member;?>님의 수강하신 강의 정보</strong></p>

            <table border="0" cellpadding="0" cellspacing="0" class="tbl-lecture-list">
                <caption class="hidden">강의정보</caption>
                <colgroup>
                    <col style="width:166px"/>
                    <col style="*"/>
                    <col style="width:110px"/>
                </colgroup>
                <tbody>
                <tr>
                    <td>
                        <a href="#" class="sample-lecture">
                            <img src="/img/<?php echo $lecThumbnail?>" alt="" width="144" height="101" />
                            <span class="tc-brand">샘플강의 ▶</span>
                        </a>
                    </td>
                    <td class="lecture-txt">
                        <em class="tit mt10"><?php echo $lecTitle?></em>
                        <p class="tc-gray mt20">강사: <?php echo $lecTeacher?> | 학습난이도 : <?php echo $lecLevel?> | 교육시간: <?php echo $lecTime?>시간 (<?php echo $lecNum?>강)</p>
                    </td>
                    <td class="t-r"><a href="#" class="btn-square-line">강의<br />상세</a></td>
                </tr>
                </tbody>
            </table>

            <div class="box-btn t-r">
                <a href="/lecture_board/index.php?mode=list" class="btn-m-gray">목록</a>
                <a href="/lecture_board/index.php?mode=modifyChk&reviewIdx=<?php echo $reviewIdx?>" class="btn-m ml5">수정</a>
                <a href="/lecture_board/index.php?mode=delete&reviewIdx=<?php echo $reviewIdx?>" class="btn-m-dark">삭제</a>
            </div>

            <div class="search-info">
                <div class="search-form f-r">
                    <select id="category" name="category" class="input-sel" style="width:158px">
                        <option value="category">분류</option>
                        <option value="all">전체</option>
                        <option value="general">일반직무</option>
                        <option value="industry">산업직무</option>
                        <option value="common">공통역량</option>
                        <option value="certificate">어학 및 자격증</option>
                    </select>
                    <select id="searchSel" name="searchSel" class="input-sel" style="width:158px">
                        <option value="검색 조건">검색 조건</option>
                        <option value="강의명">강의명</option>
                        <option value="작성자">작성자</option>
                    </select>
                    <input id="searchVal" name="searchVal" type="text" class="input-text" placeholder="" style="width:158px"/>
                    <button onclick="searchBtn();" type="button" class="btn-s-dark">검색</button>
                    <script>
                        function searchBtn() {
                            var tabVal=$('#category').val();
                            var searchMod = '';

                            switch ($('#searchSel').val()){
                                case '검색 조건' :
                                    alert('검색 조건을 선택해주세요.');
                                    return;
                                case '강의명' :
                                    searchMod='title';
                                    break;
                                case '작성자' :
                                    searchMod='member';
                                    break;
                            }

                            location.href='/lecture_board/index.php?mode=list&tab='+tabVal+'&search='+searchMod+'&val='+$('#searchVal').val()+'&page=1';
                        }

                        $('#searchSel').change(

                            function (){
                                var sel='';
                                switch ($(this).val()){
                                    case '검색 조건' :
                                        sel='';
                                    case '강의명' :
                                        sel='강의명을 입력하세요'
                                        break;
                                    case '작성자' :
                                        sel='작성자를 입력하세요'
                                        break;

                                }
                                $('#searchVal').attr('placeholder', sel);
                            }
                        )

                    </script>
                </div>
            </div>

            <table border="0" cellpadding="0" cellspacing="0" class="tbl-bbs">
                <caption class="hidden">수강후기</caption>
                <colgroup>
                    <col style="width:8%"/>
                    <col style="width:8%"/>
                    <col style="*"/>
                    <col style="width:15%"/>
                    <col style="width:12%"/>
                </colgroup>

                <thead>
                <tr>
                    <th scope="col">번호</th>
                    <th scope="col">분류</th>
                    <th scope="col">제목</th>
                    <th scope="col">강좌만족도</th>
                    <th scope="col">작성자</th>
                </tr>
                </thead>

                <tbody>
                <!-- set -->
                <!-- //set -->
                <!-- set -->
                <?php
                include_once  $_SERVER['DOCUMENT_ROOT'].'/lecture_board/list_setting.php';
                ?>
                <!-- //set -->
                </tbody>
            </table>

            <div class="box-paging">
                <a href="/lecture_board/index.php?mode=list&page=1"><i class="icon-first"><span class="hidden">첫페이지</span></i></a>
                <a href="/lecture_board/index.php?mode=list&page=<?php echo $page-1;?>"><i class="icon-prev"><span class="hidden">이전페이지</span></i></a>
                <?php
                include_once  $_SERVER['DOCUMENT_ROOT'].'/lecture_board/list_paging.php';
                ?>
                <a href="/lecture_board/index.php?mode=list&page=<?php echo $page+1;?>"><i class="icon-next"><span class="hidden">다음페이지</span></i></a>
                <a href="/lecture_board/index.php?mode=list&page=<?php echo $pageSum;?>"><i class="icon-last"><span class="hidden">마지막페이지</span></i></a>
            </div>
        </div>
    </div>


<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/left.php';
?>

