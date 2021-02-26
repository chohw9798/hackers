<?php

//print_r($_GET);
//exit;

header("Content-Type: application/json");
$uID = $_GET['myID'];

include_once $_SERVER['DOCUMENT_ROOT'] . "/common/db.php";
$result = mysqli_query($conn, "select * from member");
$rowNum = mysqli_num_rows($result);
$idChk = 0;


if ($rowNum != 0) {
    for ($i = 0; $i < $rowNum; $i++) {
        $result2 = mysqli_query($conn, "select * from member where idx=$i+1");
        $row = mysqli_fetch_assoc($result2);
        if ($row['id'] == $uID) {
            $idChk = 1; //중복된 아이디 있는 경우
            break;
        }

    }
    if($idChk == 0){
        $idChk=2; // 중복된 아이디 없는 경우
    }
}

mysqli_free_result($result);
mysqli_close($conn);


$result = array (
    'success' => $idChk
);

echo json_encode($result);
exit;
?>