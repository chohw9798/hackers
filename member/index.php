<?php
$mode=$_GET['mode'];
if($mode=='step_01') include_once $_SERVER['DOCUMENT_ROOT'].'/member/join01.php';
else if($mode=='step_02') include_once $_SERVER['DOCUMENT_ROOT'].'/member/join02.php';
else if($mode=='step_03') include_once $_SERVER['DOCUMENT_ROOT'].'/member/join03.php';
else if($mode=='regist') include_once $_SERVER['DOCUMENT_ROOT'].'/member/proc.php';
else if($mode=='complete') include_once $_SERVER['DOCUMENT_ROOT'].'/member/join04.php';
else if($mode=='find_id') include_once $_SERVER['DOCUMENT_ROOT'].'/member/find_id.php';
else if($mode=='find_pass') include_once $_SERVER['DOCUMENT_ROOT'].'/member/find_pass.php';
else if($mode=='find_id_complete') include_once $_SERVER['DOCUMENT_ROOT'].'/member/find_id_complete.php';
else if($mode=='find_pw_complete') include_once $_SERVER['DOCUMENT_ROOT'].'/member/find_pw_complete.php';
else if($mode=='modify') include_once $_SERVER['DOCUMENT_ROOT'].'/member/modify.php';
else if($mode=='edit') include_once $_SERVER['DOCUMENT_ROOT'].'/member/proc.php';
?>