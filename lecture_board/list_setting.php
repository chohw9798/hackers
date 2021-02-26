<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/common/db.php";
$c='전체';
switch ($_GET['tab']){
    case all :

        break;
    case general :
        $c='일반직무';
        break;
    case industry :
        $c='산업직무';
        break;
    case common :
        $c='공통역량';
        break;
    case certificate :
        $c='어학 및 자격증';
        break;
}

if(!$_GET['search']){
    //상단의 탭을 눌러서 이동했을 때

    if(!$_GET['tab']||$_GET['tab']=='all'){
        $sql = "select * from review";
    }
    else {
        $sql="select * 
                              from review
                              where reviewLecture in(
                                    select lectureIdx
                                    from lecture
                                    where lectureCategory='".$c."' 
                                )";
    }
}

else {
    //검색창에 검색했을 때

    if ($_GET['search']=='title'){
        //강의명으로 검색했을 때

        if(!$_GET['tab']||$_GET['tab']=='all'){
            //분류가 전체일 때
            $sql = "select * 
                                    from review
                                    where reviewLecture in(
                                        select lectureIdx
                                        from lecture
                                        where lectureTitle='".$_GET['val']."'
                                    )";
        }
        else {
            // 분류가 전체가 아닐 때
            $sql="select * 
                                  from review
                                  where reviewLecture in(
                                    select lectureIdx
                                    from lecture
                                    where lectureCategory='".$c."' AND lectureTitle='".$_GET['val']."'
                                )";
        }
    }

    else {
        //작성자로 검색했을 때

        if($_GET['tab']=='all'){
            //분류가 전체일 때
            $sql = "select * 
                                    from review
                                    where reviewMember in(
                                        select idx
                                        from member
                                        where name ='".$_GET['val']."'
                                    )";
        }
        else {
            // 분류가 전체가 아닐 때
            $sql="select * 
                                  from review
                                  where reviewLecture=(
                                    select lectureIdx
                                    from lecture
                                    where lectureCategory='".$c."'
                                  ) AND reviewMember in(
                                        select idx
                                        from member
                                        where 'name' ='".$_GET['val']."'
                                    )";
        }

    }
}



$result = mysqli_query($conn, $sql);
$rowNum = mysqli_num_rows($result);

if($rowNum==0){
    mysqli_free_result($result);
    exit;
}

if(isset($_GET['page'])){
    $page=$_GET['page'];
}
else {
    $page=1;
}

// 베스트 글 표시
if(!$_GET['search']&&$_GET['tab']=='all'&&$page==1){

    $sqlBest="select * from review order by reviewBest DESC ";
    $resultBest = mysqli_query($conn, $sqlBest);

    $j=0;
    while($row = mysqli_fetch_assoc($resultBest)){
        if($j>2){
            break;
        }

        $idx = $row['reviewIdx'];

        $sqlLecture = "SELECT lectureCategory, lectureTitle FROM lecture WHERE lectureIdx={$row['reviewLecture']}";
        $resultLecture = mysqli_query($conn, $sqlLecture);
        $rowLecture = mysqli_fetch_row($resultLecture);
        $category = $rowLecture[0]; //분류
        $lecTitle = $rowLecture[1]; //강의명
        mysqli_free_result($resultLecture);


        $sqlMember = "SELECT name FROM member WHERE idx={$row['reviewMember']}";
        $resultMember = mysqli_query($conn, $sqlMember);
        $rowMember = mysqli_fetch_row($resultMember);
        $member = $rowMember[0]; // 작성자
        mysqli_free_result($resultMember);

        $revTitle = $row['reviewTitle']; //리뷰 제목
        $satisfaction = $row['reviewSatisfaction']*20; //만족도


        echo"
                            <tr class='bbs-sbj'>
                    <td><span class='txt-icon-line'><em>BEST</em></span></td>
                    <td>$category</td>
                    <td>
                        <a href='/lecture_board/index.php?mode=view&reviewIdx=$idx'>
                            <span class='tc-gray ellipsis_line'>수강 강의명 : $lecTitle</span>
                            <strong class='ellipsis_line'>$revTitle</strong>
                        </a>
                    </td>
                    <td>
						<span class='star-rating'>
							<span class='star-inner' style='width:$satisfaction%'></span>
						</span>
                    </td>
                    <td class='last'>$member</td>
                </tr>
                        ";
        $j++;
    }
}

//페이지에 따라 다르게 표시
$start=($page-1)*20;
$i=0;
while($row=mysqli_fetch_assoc($result)) {
    if($i<$start){
        $i++;
        continue;
    }
    if($i>=$start+20){
        break;
    }

    $idx = $row['reviewIdx'];

    $sqlLecture = "SELECT lectureCategory, lectureTitle FROM lecture WHERE lectureIdx={$row['reviewLecture']}";
    $resultLecture = mysqli_query($conn, $sqlLecture);
    $rowLecture = mysqli_fetch_row($resultLecture);
    $category = $rowLecture[0]; //분류
    $lecTitle = $rowLecture[1]; //강의명
    mysqli_free_result($resultLecture);


    $sqlMember = "SELECT name FROM member WHERE idx={$row['reviewMember']}";
    $resultMember = mysqli_query($conn, $sqlMember);
    $rowMember = mysqli_fetch_row($resultMember);
    $member = $rowMember[0]; // 작성자
    mysqli_free_result($resultMember);

    $revTitle = $row['reviewTitle']; //리뷰 제목
    $satisfaction = $row['reviewSatisfaction']*20; //만족도

    echo "
                    <tr class='bbs-sbj'>
                    <td>$idx</td>
                    <td>$category</td>
                    <td>
                        <a href='/lecture_board/index.php?mode=view&reviewIdx=$idx'>
                            <span class='tc-gray ellipsis_line'>수강 강의명 : $lecTitle</span>
                            <strong class='ellipsis_line'>$revTitle</strong>
                        </a>
                    </td>
                    <td>
						<span class='star-rating'>
							<span class='star-inner' style='width:$satisfaction%'></span>
						</span>
                    </td>
                    <td class='last'>$member</td>
                </tr>
                            ";
    $i++;
}
?>