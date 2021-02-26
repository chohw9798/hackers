<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/common/db.php";
include_once  $_SERVER['DOCUMENT_ROOT'].'/header.php';
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

            <ul id="tab" class="tab-list tab5">
                <li class="on"><a href="/lecture_board/index.php?mode=list&tab=all&page=1">전체</a></li>
                <li><a href="/lecture_board/index.php?mode=list&tab=general&page=1">일반직무</a></li>
                <li><a href="/lecture_board/index.php?mode=list&tab=industry&page=1">산업직무</a></li>
                <li><a href="/lecture_board/index.php?mode=list&tab=common&page=1">공통역량</a></li>
                <li><a href="/lecture_board/index.php?mode=list&tab=certificate&page=1">어학 및 자격증</a></li>
            </ul>

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

            <div class='box-btn t-r'> <a href='/lecture_board/index.php?mode=write' class='btn-m'>후기 작성</a> </div>
        </div>
    </div>



<?php
include_once  $_SERVER['DOCUMENT_ROOT'].'/footer.php';
mysqli_free_result($result);
mysqli_close($conn);
?>

<!--function pageBtn(){
        $(this).attr('class', 'active');
    }-->