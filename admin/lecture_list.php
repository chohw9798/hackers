<?php
session_start();

include_once  $_SERVER['DOCUMENT_ROOT'].'/header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . "/common/db.php";

?>
    <div id="container" class="container-full">
        <div id="content" class="content">
            <div class="inner">
                <div class="tit-box-h3">
                    <h3 class="tit-h3">강의 목록</h3>
                    <div class="sub-depth">
                        <span><i class="icon-home"><span>홈</span></i></span>
                        <span>강의 Admin</span>
                        <strong>강의 목록</strong>
                    </div>
                </div>

                <!--
                <ul class="tab-list tab5">
                    <li class="on"><a href="#">전체</a></li>
                    <li><a href="#">일반직무</a></li>
                    <li><a href="#">산업직무</a></li>
                    <li><a href="#">공통역량</a></li>
                    <li><a href="#">어학 및 자격증</a></li>
                </ul>

                <div class="search-info">
                    <div class="search-form f-r">
                        <select id="category" name="category" class="input-sel" style="width:158px">
                            <option value="">분류</option>
                            <option value="일반직무">일반직무</option>
                            <option value="산업직무">산업직무</option>
                            <option value="공통역량">공통역량</option>
                            <option value="어학 및 자격증">어학 및 자격증</option>
                        </select>
                        <select class="input-sel" style="width:158px">
                            <option value="">강의명</option>
                            <option value="">작성자</option>
                        </select>
                        <input type="text" class="input-text" placeholder="강의명을 입력하세요." style="width:158px"/>
                        <button type="button" class="btn-s-dark">검색</button>
                    </div>
                </div>

                -->

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
                        <th scope="col">강의명</th>
                        <th scope="col">학습난이도</th>
                        <th scope="col">강사명</th>
                        <th >  </th>
                        <th > </th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php
                    $result = mysqli_query($conn, "select * from lecture");
                    $rowNum = mysqli_num_rows($result);

                    if ($rowNum != 0) {
                        for ($i = 0; $i < $rowNum; $i++) {
                            $result2 = mysqli_query($conn, "select * from lecture where lectureIdx=$i+1");
                            $row = mysqli_fetch_assoc($result2);

                            $idx = $row['lectureIdx'];
                            $category = $row['lectureCategory'];
                            $title = $row['lectureTitle'];
                            $level = $row['lectureLevel'];
                            $teacher = $row['lectureTeacher'];
                            $thumbnail = $row['lectureThumbnail'];
                            $time = $row['lectureTime'];
                            $num = $row['lectureNum'];

                            echo"
                                <tr class='bbs-sbj'>
                                    <td><em>$idx</em></td>
                                    <td>$category</td>
                                    <td>
                                        
                                        $title
                                        <!--<span class='tc-gray ellipsis_line'></span>
                                            <strong class='ellipsis_line'>절대 후회 없는 강의 예요!</strong>-->
                                    </td>
                                    
                                    <td>
                                    $level
                                    <!--
						            <span class='star-rating'>
							            <span class='star-inner' style='width:80%'></span>
						            </span>-->
                                    </td>
                                    <td >$teacher</td>
                                    <td>
                                        <a style='background:skyblue; text-align:center;' href='/admin/index.php?mode=modify&idx=$idx&category=$category&title=$title&level=$level&teacher=$teacher&thumbnail=$thumbnail&time=$time&num=$num' width='100'>
                                          <b>수정하기</b>
                                        </a>
                                    </td>
                                    <td class='last'>
                                        <a style='background:lightpink; text-align:center;' href='/admin/index.php?mode=delete&idx=$idx&category=$category&title=$title&level=$level&teacher=$teacher&thumbnail=$thumbnail&time=$time&num=$num'>
                                         <b>삭제하기</b>
                                        </a>
                                    </td>
                                </tr>
                            ";
                        }
                    }

                    mysqli_free_result($result2);
                    mysqli_free_result($result);
                    mysqli_close($conn);
                    ?>
                    <!-- set -->

                    <!-- //set -->
                    <!-- set -->

                    <!-- //set -->
                    </tbody>
                </table>

                <!--
                <div class="box-paging">
                    <a href="#"><i class="icon-first"><span class="hidden">첫페이지</span></i></a>
                    <a href="#"><i class="icon-prev"><span class="hidden">이전페이지</span></i></a>
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#">6</a>
                    <a href="#"><i class="icon-next"><span class="hidden">다음페이지</span></i></a>
                    <a href="#"><i class="icon-last"><span class="hidden">마지막페이지</span></i></a>
                </div>
                -->

                <div class="box-btn t-r">
                    <a href="/admin/index.php?mode=write"; class="btn-m">등록</a>
                </div>

            </div>
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script type="text/javascript">

    </script>
<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>