<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/common/db.php";

$loginID = $_POST['loginID'];
$loginPW = $_POST['loginPW'];

//이전페이지가 없거나 회원가입 과정에서 로그인했을 때
if(!$_POST['returnUrl']||$_POST['returnUrl']=="http://test.hackers.com/member/index.php?mode=complete"||$_POST['returnUrl']=="http://test.hackers.com/member/index.php?mode=step_01"||$_POST['returnUrl']=="http://test.hackers.com/member/index.php?mode=step_02"||$_POST['returnUrl']=="http://test.hackers.com/member/index.php?mode=step_03"){
    $returnUrl = '/index.html';
}
else{
    $returnUrl = $_POST['returnUrl'];
}

if (!$loginID || !$loginPW ) {
    echo "<script>alert('아이디 또는 비밀번호가 입력되지 않았습니다.');";

    echo "history.back();</script>";
}
else {

    $password = base64_encode(hash('sha256', $loginPW, true));
    $result = mysqli_query($conn, "select * from member where id = '".$loginID."' AND pw = '".$password."' ");
    $row = mysqli_fetch_assoc($result);

    // 아이디 비밀번호 잘못 입력된 경우
    if(!$row){
        echo "<script>alert('아이디 또는 비밀번호가 잘못 입력되었습니다.');";

        echo "history.back();</script>";
    }
    else {
        session_start();
        $_SESSION['loginID'] = $loginID;
        $_SESSION['isAdmin'] = $row['isAdmin'];
        $_SESSION['loginName'] = $row['name'];
        $_SESSION['loginPhoneNum'] = $row['phoneNum'];

        mysqli_free_result($result);
        mysqli_close($conn);
        header ("Location: {$returnUrl}");
    }
}

?>