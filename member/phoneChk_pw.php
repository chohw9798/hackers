<?php
header("Content-Type: application/json");
$chkMode=$_POST['chkMode'];
$uName=$_POST['uName'];

$uID=$_POST['uID'];

$phoneNum1=$_POST['phoneNum1'];
$phoneNum2=$_POST['phoneNum2'];
$phoneNum3=$_POST['phoneNum3'];
$phoneNum=$phoneNum1.$phoneNum2.$phoneNum3;

$email1=$_POST['email1'];
$email2=$_POST['email2'];

$email=$email1."@".$email2;

include_once $_SERVER['DOCUMENT_ROOT'] . "/common/db.php";

//비밀번호 찾기 할 때 인증 기능
//휴대폰 인증일 경우
if($chkMode==0){
    $result = mysqli_query($conn, "select * from member where name = '".$uName."' AND phoneNum = '".$phoneNum."' AND id = '".$uID."' ");
    $row = mysqli_fetch_assoc($result);
    if(!$row){
        $result2 = array (
            'success' => "no"
        );

        mysqli_free_result($result);
        mysqli_close($conn);

        echo json_encode($result2);
        exit;

    }
    else {

        $result2 = array (
            'id' => $row['id']

        );

        mysqli_free_result($result);
        mysqli_close($conn);

        echo json_encode($result2);
        exit;


    }
}

//이메일 인증일 경우
else {

    $result3 = mysqli_query($conn, "select * from member where name = '".$uName."' AND email = '".$email."'AND id = '".$uID."' ");
    $row2 = mysqli_fetch_assoc($result3);
    if(!$row2){
        $result4 = array (
            'success' => "no"
        );

        mysqli_free_result($result3);
        mysqli_close($conn);

        echo json_encode($result4);
        exit;

    }
    else {

        $result4 = array (
            'id' => $row2['id']
        );

        mysqli_free_result($result3);
        mysqli_close($conn);

        echo json_encode($result4);
        exit;


    }
}

?>