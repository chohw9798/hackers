<?php
session_start();
$newPW=$_POST['newPW'];
$hashedPW = base64_encode(hash('sha256', $newPW, true));

include_once $_SERVER['DOCUMENT_ROOT'] . "/common/db.php";

$sql = "UPDATE member SET PW = '{$hashedPW}'
        ";

$result = mysqli_query($conn, $sql);

echo"
    <script>
        alert('비밀번호 수정이 완료되었습니다.');
        location.href='/index.html';
    </script>
";
?>
