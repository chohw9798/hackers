<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/common/db.php";

//삭제일 경우
if($_GET['mode'] == 'delete'){
    $sql=" select id
            from member
            where idx = (
                select reviewMember from review where reviewIdx={$_GET['reviewIdx']}
            )
         ";
    $result=mysqli_query($conn, $sql);
    $row=mysqli_fetch_row($result);

    if($row[0]!=$_SESSION['loginID']){

        $alertMessage = "본인이 작성한 글만 삭제할 수 있습니다.";
        $returnUrl = "/lecture_board/index.php?mode=list";
        echo "<script>
            alert('".$alertMessage."');
            location.href='".$returnUrl."';
        </script>";
        exit;

    }
    else{
        $sql = "DELETE FROM review
            WHERE reviewIdx={$_GET['reviewIdx']}
        ";

        //AUTO_INCREMENT 값 초기화 후, 모든 reviewIdx 조정
        $sql2 ="ALTER TABLE review AUTO_INCREMENT=1";
        $sql3 ="SET @COUNT = 0";
        $sql4="UPDATE review SET reviewIdx = @COUNT:=@COUNT+1";


        $alertMessage = "수강후기가 삭제되었습니다.";
        $returnUrl = "/lecture_board/index.php?mode=list";

        $result = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sql2);
        $result3 = mysqli_query($conn, $sql3);
        $result4 = mysqli_query($conn, $sql4);
        if(mysqli_error($conn)){
            echo mysqli_error($conn);
            exit;
        }else{
            mysqli_free_result($result4);
            mysqli_free_result($result3);
            mysqli_free_result($result2);
            mysqli_free_result($result);
            mysqli_close($conn);

            echo"
            <script>
                alert('".$alertMessage."');
                location.href='".$returnUrl."';
            </script>
            ";
        }
        exit;
    }

}

//상세보기에서 수정버튼 눌렀을 경우
if($_GET['mode'] == 'modifyChk'){
    $sql=" select id
            from member
            where idx = (
                select reviewMember from review where reviewIdx={$_GET['reviewIdx']}
            )
         ";
    $result=mysqli_query($conn, $sql);
    $row=mysqli_fetch_row($result);

    if($row[0]!=$_SESSION['loginID']){

        $alertMessage = "본인이 작성한 글만 수정할 수 있습니다.";
        $returnUrl = "/lecture_board/index.php?mode=list";
        echo "<script>
            alert('".$alertMessage."');
            location.href='".$returnUrl."';
        </script>";
        exit;

    }
    else {
        $sql=" select * from review where reviewIdx={$_GET['reviewIdx']}
         ";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);

        $sqlLecture = "SELECT lectureCategory, lectureTitle FROM lecture WHERE lectureIdx={$row['reviewLecture']}";
        $resultLecture = mysqli_query($conn, $sqlLecture);
        $rowLecture = mysqli_fetch_row($resultLecture);
        $category = $rowLecture[0]; //분류
        $lecTitle = $rowLecture[1]; //강의명
        mysqli_free_result($resultLecture);

        $returnUrl = "/lecture_board/index.php?mode=modify&reviewIdx={$_GET['reviewIdx']}&category=$category&lectureTitle=$lecTitle&reviewTitle=".$row['reviewTitle']."&reviewSatisfaction=".$row['reviewSatisfaction']."&reviewContent=".$row['reviewContent'];
        echo "<script>
            location.href='".$returnUrl."';
        </script>";
        exit;
    }

}

//등록 또는 수정일 경우
$data=null;
foreach($_POST as $key => $value){
    if($value == null){
        switch ($key){
            case 'category':
                $data='분류';
                break;
            case 'lectureTitle':
                $data='강의명';
                break;
            case 'reviewTitle':
                $data='제목';
                break;
            case 'editor':
                $data='내용';
                break;

        }
        echo"<script>
                    alert('$data 입력해주세요.');
                    history.back();
                 </script>";
        exit;
    }

}

$sqlLecture="SELECT lectureIdx FROM lecture WHERE lectureTitle='{$_POST['lectureTitle']}'";
$resultLecture = mysqli_query($conn, $sqlLecture);
$rowLecture = mysqli_fetch_row($resultLecture);
mysqli_free_result($resultLecture);

$sqlMember="SELECT idx FROM member WHERE id='{$_SESSION['loginID']}'";
$resultMember = mysqli_query($conn, $sqlMember);
$rowMember = mysqli_fetch_row($resultMember);
mysqli_free_result($resultMember);

$dateStr=date("Y-m-d", time());

$attach_file = $_POST['attach_file'];
$explode = explode('=', $attach_file);
$file = $explode[1];

if($_GET['mode'] == 'regist'){
    //AUTO_INCREMENT 값 초기화 후, 모든 reviewIdx 조정
    $sql2 ="ALTER TABLE review AUTO_INCREMENT=1";
    $sql3 ="SET @COUNT = 0";
    $sql4="UPDATE review SET reviewIdx = @COUNT:=@COUNT+1";

    $result2 = mysqli_query($conn, $sql2);
    $result3 = mysqli_query($conn, $sql3);
    $result4 = mysqli_query($conn, $sql4);
    mysqli_free_result($result4);
    mysqli_free_result($result3);
    mysqli_free_result($result2);

    if(isset($attach_file)){
        $sql = "INSERT INTO review SET
            reviewLecture = {$rowLecture[0]} ,
            reviewTitle = '{$_POST['reviewTitle']}' ,
            reviewSatisfaction = {$_POST['satisfaction']} ,
            reviewMember = {$rowMember[0]} ,
            reviewDate = '{$dateStr}',
            reviewContent = '{$_POST['editorContent']}',
            reviewFile = '{$file}'
        ";
    }
    else{
        $sql = "INSERT INTO review SET
            reviewLecture = {$rowLecture[0]} ,
            reviewTitle = '{$_POST['reviewTitle']}' ,
            reviewSatisfaction = {$_POST['satisfaction']} ,
            reviewMember = {$rowMember[0]} ,
            reviewDate = '{$dateStr}',
            reviewContent = '{$_POST['editorContent']}'
        ";
    }

    $alertMessage = "수강후기가 등록되었습니다.";
    $returnUrl = "/lecture_board/index.php?mode=list";
}
else if($_GET['mode'] == 'edit'){
    if(isset($attach_file)){
        $sql = "UPDATE review SET
            reviewLecture = {$rowLecture[0]} ,
            reviewTitle = '{$_POST['reviewTitle']}' ,
            reviewSatisfaction = {$_POST['satisfaction']} ,
            reviewMember = {$rowMember[0]} ,
            reviewContent = '{$_POST['editorContent']}',
            reviewFile = '{$file}'
            WHERE reviewIdx = {$_POST['reviewIdx']}
            ";
    }
    else{
        $sql = "UPDATE review SET
            reviewLecture = {$rowLecture[0]} ,
            reviewTitle = '{$_POST['reviewTitle']}' ,
            reviewSatisfaction = {$_POST['satisfaction']} ,
            reviewMember = {$rowMember[0]} ,
            reviewContent = '{$_POST['editorContent']}'
            WHERE reviewIdx = {$_POST['reviewIdx']}
            ";
    }

    $alertMessage = "수강후기가 수정되었습니다.";
    $returnUrl = "/lecture_board/index.php?mode=list";
}

$result = mysqli_query($conn, $sql);
if(mysqli_error($conn)){
    echo $sql;
    echo "<hr>";
    echo mysqli_error($conn);
    exit;
}else{
    mysqli_free_result($result);
    mysqli_close($conn);

    echo"
            <script>
                alert('".$alertMessage."');
                location.href='".$returnUrl."';
            </script>
            ";
}




?>
