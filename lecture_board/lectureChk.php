<?php
header("Content-Type: application/json");
$category = $_GET['category'];

include_once $_SERVER['DOCUMENT_ROOT'] . "/common/db.php";

$result = mysqli_query($conn, "select * from lecture where lectureCategory='{$category}'");

$result2 = array ();
$i=0;
while($row = mysqli_fetch_assoc($result)){
    $result2[$i]=$row['lectureTitle'];
    $i++;
}

mysqli_free_result($result);
mysqli_close($conn);

$result3 = array (
    'success' => $result2
);

echo json_encode($result3);
exit;

?>