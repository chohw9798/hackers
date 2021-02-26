<?php
$mode=$_GET['mode'];
if($mode=='list') include_once $_SERVER['DOCUMENT_ROOT'].'/lecture_board/course_review_list.php';
else if($mode=='write') include_once $_SERVER['DOCUMENT_ROOT'].'/lecture_board/course_review_write.php';
else if($mode=='view') include_once $_SERVER['DOCUMENT_ROOT'].'/lecture_board/course_review_view.php';
else if($mode=='modify') include_once $_SERVER['DOCUMENT_ROOT'].'/lecture_board/course_review_modify.php';
else if($mode=='regist'||$mode='modifyChk'||$mode=='edit'||$mode=='delete') include_once $_SERVER['DOCUMENT_ROOT'].'/lecture_board/course_review_proc.php';

?>
