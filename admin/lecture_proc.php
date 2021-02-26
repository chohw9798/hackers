<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/common/db.php";

//AUTO_INCREMENT 값 초기화 후, 모든 lectureIdx 조정
$sql2 ="ALTER TABLE lecture AUTO_INCREMENT=1";
$sql3 ="SET @COUNT = 0";
$sql4="UPDATE lecture SET lectureIdx = @COUNT:=@COUNT+1";

$result2 = mysqli_query($conn, $sql2);
if(mysqli_error($conn)){
    echo mysqli_error($conn);
    exit;
}else{
    mysqli_free_result($result2);
}

$result3 = mysqli_query($conn, $sql3);
if(mysqli_error($conn)){
    echo mysqli_error($conn);
    exit;
}else{
    mysqli_free_result($result3);
}

$result4 = mysqli_query($conn, $sql4);
if(mysqli_error($conn)){
    echo mysqli_error($conn);
    exit;
}else{
    mysqli_free_result($result4);
}



//삭제일 경우
if($_GET['mode'] == 'delete'){
    $sql = "DELETE FROM lecture
            WHERE lectureIdx={$_GET['idx']}
        ";


    $alertMessage = "강의가 삭제되었습니다.";
    $returnUrl = "/admin/index.php?mode=list";

    $result = mysqli_query($conn, $sql);
    if(mysqli_error($conn)){
        echo mysqli_error($conn);
        exit;
    }else{
        mysqli_free_result($result);

    }

    //AUTO_INCREMENT 값 초기화 후, 모든 lectureIdx 조정
    $sql2 ="ALTER TABLE lecture AUTO_INCREMENT=1";
    $sql3 ="SET @COUNT = 0";
    $sql4="UPDATE lecture SET lectureIdx = @COUNT:=@COUNT+1";

    $result2 = mysqli_query($conn, $sql2);
    if(mysqli_error($conn)){
        echo mysqli_error($conn);
        exit;
    }else{
        mysqli_free_result($result2);
    }

    $result3 = mysqli_query($conn, $sql3);
    if(mysqli_error($conn)){
        echo mysqli_error($conn);
        exit;
    }else{
        mysqli_free_result($result3);
    }

    $result4 = mysqli_query($conn, $sql4);
    if(mysqli_error($conn)){
        echo mysqli_error($conn);
        exit;
    }else{
        mysqli_free_result($result4);
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

//등록 또는 수정일 경우
$data=null;
foreach($_POST as $key => $value){
    if($value == null){
        switch ($key){
            case 'title':
                $data='강의명';
                break;
            case 'teacher':
                $data='강사명';
                break;
            case 'thumbnail':
                $data='썸네일 이미지';
                break;
            case 'time':
                $data='강의 시간';
                break;
            case 'num':
                $data='강의 수';
                break;
        }
        echo"<script>
                    alert('$data 입력해주세요.');
                    history.back();
                 </script>";
        exit;
    }

}

$tmp_name = $_FILES['thumbnail']['tmp_name']; //임시로 이미지가 저장되는 경로
$img_dir  = $_SERVER['DOCUMENT_ROOT']."/img/"; // 이미지 여기에 저장할 것
$img_name = $_FILES['thumbnail']['name']; //이미지 이름

$img_ext = explode("." , $img_name);
$img_ext = $img_ext[1];
$img_name = 'lecture_thumb_'.date('YmdHis').".".$img_ext; //이미지 이름
$target = $img_dir.$img_name; //이미지를 저장할 경로

// 임시 경로에 있는 파일을 원하는 경로로 이동
if(move_uploaded_file($tmp_name, $target)){
    if($_GET['mode'] == 'regist'){
        $sql = "INSERT INTO lecture SET
            lectureCategory = '{$_POST['category']}' ,
            lectureTitle = '{$_POST['title']}' ,
            lectureTeacher = '{$_POST['teacher']}' ,
            lectureLevel = '{$_POST['level']}' ,
            lectureThumbnail = '{$img_name}',
            lectureTime = '{$_POST['time']}',
            lectureNum = '{$_POST['num']}'
        ";
        $alertMessage = "강의가 등록되었습니다.";
        $returnUrl = "/admin/index.php?mode=list";
    }
    else if($_GET['mode'] == 'edit'){
        $sql = "UPDATE lecture SET
            lectureCategory = '{$_POST['category']}' ,
            lectureTitle = '{$_POST['title']}' ,
            lectureTeacher = '{$_POST['teacher']}' ,
            lectureLevel = '{$_POST['level']}' ,
            lectureThumbnail = '{$img_name}',
            lectureTime = '{$_POST['time']}',
            lectureNum = '{$_POST['num']}'
            WHERE lectureIdx={$_POST['idx']}
        ";
        $alertMessage = "강의가 수정되었습니다.";
        $returnUrl = "/admin/index.php?mode=list";
    }

    $result = mysqli_query($conn, $sql);
    if(mysqli_error($conn)){
        echo $sql;
        echo "<br>";
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

}else {
    echo"
            <script>
                alert('파일 업로드 실패');
                history.back();
            </script>
            ";
}




?>



<!--
if(isset($_FILES['thumbnail'])&& $_FILES['thumbnail']['name']!=""){
    $file=$_FILES['thumbnail'];
    $img_dir = $_SERVER['DOCUMENT_ROOT']."/img/";
    $ext_str = "bmp,rle,dib,jpg,gif,png,tif,tiff,raw";
    $allowed_extensions = explode(',', $ext_str);
    $ext = substr($file['name'], strrpos($file['name'], '.') + 1);

    if(!in_array($ext, $allowed_extensions)) {

        echo "<script>
                    alert('업로드할 수 없는 확장자입니다.');
                    history.back();
                 </script>";

    }

    $path = md5(microtime()).'.'.$ext; //저장되는 파일 이름
    if(move_uploaded_file($file['tmp_name'], $img_dir.$path)){
        $img_id=md5(uniqid(rand(),true));
        $name_orig = $file['name']; // 원래 파일 이름
        $name_save = $path; // 저장되는 파일 이름

        if($_GET['mode'] == 'regist'){
            $sql="INSERT INTO upload_img SET
            imgID = '{$img_id}' ,
            nameOrig = '{$name_orig}' ,
            nameSave = '{$name_save}'
            ";
        }
        else if($_GET['mode'] == 'edit'){
            $sql="";
        }
        else{
            $sql="";
        }

    }

    $result = mysqli_query($conn, $sql);
    if(mysqli_error($conn)){
        echo $sql;
        echo "<br>";
        echo mysqli_error($conn);
        exit;
    }else {
        mysqli_free_result($result);
        mysqli_close($conn);

        echo "
            <script>
                alert('이미지 등록 성공');
                location.href='/admin/index.php?mode=list';
            </script>
            ";
    }
}
-->