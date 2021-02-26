<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/common/db.php";
    session_start();

    foreach($_POST as $key => $value){
        if($key == 'homePhoneNum1' || $key == 'homePhoneNum2' || $key == 'homePhoneNum3'){
            break;
        }

        if($value == null){
            echo"<script>
                    alert('필수정보(*)를 모두 입력해주세요. ('.$key.' 누락)');
                    history.back();
                 </script>";
            exit;
        }
    }

    if( $_POST['dupChk']==0){
        echo"<script>
            alert('중복확인을 해주세요.');
            history.back();
        </script>";
        exit;
    }

    $hashedPW = base64_encode(hash('sha256', $_POST['uPW'], true));
    $email=$_POST['email1']."@".$_POST['email2'];
    $phoneNum=$_POST['phoneNum1'].$_POST['phoneNum2'].$_POST['phoneNum3'];
    $homePhoneNum = $_POST['homePhoneNum1'].$_POST['homePhoneNum2'].$_POST['homePhoneNum3'];

    $alertMessage = "회원가입이 완료되었습니다.";
    $returnUrl = "/member/index.php?mode=complete";

    //회원가입
    if($_GET['mode'] == 'regist'){
        $sql = "INSERT INTO member SET
            name = '{$_POST['uName']}' ,
            id = '{$_POST['uID']}' ,
            pw = '{$hashedPW}' ,
            email = '{$email}' ,
            phoneNum = '{$phoneNum}' ,
            homePhoneNum = '{$homePhoneNum}' ,
            uno = '{$_POST['postalCode']}' ,
            address = '{$_POST['primaryAddress']}' ,
            detail_address = '{$_POST['detailedAddress']}',
            chkSMS = {$_POST['valSMS']} ,
            chkMail = {$_POST['valMail']}
        ";
    }else{
        if(!$_SESSION['loginID']){
            echo"<script>
                    alert('정보수정은 로그인 후 가능합니다.');
                    history.back();
                 </script>";
            exit;
        }

            $sql = "UPDATE member SET
            id = '{$_POST['uID']}' ,
            pw = '{$hashedPW}' ,
            email = '{$email}' ,
            homePhoneNum = '{$homePhoneNum}' ,
            uno = '{$_POST['postalCode']}' ,
            address = '{$_POST['primaryAddress']}' ,
            detail_address = '{$_POST['detailedAddress']}',
            chkSMS = {$_POST['valSMS']} ,
            chkMail = {$_POST['valMail']}
            WHERE id='{$_SESSION['loginID']}'
        ";

        $alertMessage = "내 정보 수정이 완료되었습니다.";
        $returnUrl = "/index.html";
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

        if($_GET['mode'] =='edit'){
            $_SESSION['loginID'] = $_POST['uID'];
        }

        echo"
            <script>
                alert('".$alertMessage."');
                location.href='".$returnUrl."';
            </script>
            ";

    }


//    if($_POST['uName']==null||$_POST['uID']==null||$_POST['uPW']==null||$_POST['chkPW']==null||$_POST['email1']==null||$_POST['email2']==null||$_POST['phoneNum1']==null||$_POST['phoneNum2']==null||$_POST['phoneNum3']==null||$_POST['postalCode']==null||$_POST['primaryAddress']==null||$_POST['detailedAddress']==null){
//        echo"<script>
//                alert('필수정보(*)를 모두 입력해주세요.');
//                history.back();
//             </script>";
//    }
//    else if( $_POST['dupChk']==0){
//        echo"<script>
//            alert('중복확인을 해주세요.');
//            history.back();
//        </script>";
//    }
//    else {
//        $hashedPW = base64_encode(hash('sha256', $_POST['uPW'], true));
//        $email=$_POST['email1']."@".$_POST['email2'];
//        $phoneNum=$_POST['phoneNum1'].$_POST['phoneNum2'].$_POST['phoneNum3'];
//        $homePhoneNum = $_POST['homePhoneNum1'].$_POST['homePhoneNum2'].$_POST['homePhoneNum3'];
//
//        //회원가입
//        if($_GET['mode'] == 'regist'){
//            $sql = "INSERT INTO member SET
//                name = '{$_POST['uName']}' ,
//                id = '{$_POST['uID']}' ,
//                pw = '{$hashedPW}' ,
//                email = '{$email}' ,
//                phoneNum = '{$phoneNum}' ,
//                homePhoneNum = '{$homePhoneNum}' ,
//                uno = '{$_POST['postalCode']}' ,
//                address = '{$_POST['primaryAddress']}' ,
//                detail_address = '{$_POST['detailedAddress']}',
//                chkSMS = {$_POST['valSMS']} ,
//                chkMail = {$_POST['valMail']}
//            ";
//        }else{
//            $sql = "UPDATE member SET
//
//            id = '{$_POST['uID']}' ,
//            pw = '{$hashedPW}' ,
//            email = '{$email}' ,
//            homePhoneNum = '{$homePhoneNum}' ,
//            uno = '{$_POST['postalCode']}' ,
//            address = '{$_POST['primaryAddress']}' ,
//            detail_address = '{$_POST['detailedAddress']}',
//            chkSMS = {$_POST['valSMS']} ,
//            chkMail = {$_POST['valMail']}
//
//            WHERE id='{$_SESSION['loginID']}'
//        ";
//        }
//
//
//
//        $result = mysqli_query($conn, $sql);
//
//        if($result){
//            mysqli_free_result($result);
//            mysqli_close($conn);
//
//            echo"
//            <script>
//                alert('회원가입이 완료되었습니다.');
//                location.href='/member/index.php?mode=complete';
//            </script>
//            ";
//        }else{
//            echo $sql;
//            echo "<br>";
//            echo mysqli_error($conn);
//            exit;
//        }
//    }
?>
