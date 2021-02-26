<?php

$rowNum = mysqli_num_rows($result);
$pageSum=ceil($rowNum/20);

for($i=1; $i<=$pageSum; $i++){
    echo"<a href='/lecture_board/index.php?mode=list&page=$i' class=''>$i</a>";
}
?>