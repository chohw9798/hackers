<?php
$mode=$_GET['mode'];
if($mode=='list') include_once $_SERVER['DOCUMENT_ROOT'].'/admin/lecture_list.php';
else if($mode=='write') include_once $_SERVER['DOCUMENT_ROOT'].'/admin/lecture_write.php';
else if($mode=='modify') include_once $_SERVER['DOCUMENT_ROOT'].'/admin/lecture_modify.php';
else if($mode=='regist'||$mode=='edit'||$mode=='delete') include_once $_SERVER['DOCUMENT_ROOT'].'/admin/lecture_proc.php';

?>