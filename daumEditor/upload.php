<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="./js/popup.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="./css/popup.css" type="text/css"  charset="utf-8"/>
</head>
<body onload="initUploader();">

<?php
// 파일 업로드
$file = $_FILES['upload_file'];
$file_name = $_FILES['upload_file']['name'];                // 업로드한 파일명
$file_tmp_name = $_FILES['upload_file']['tmp_name'];   		// 임시 디렉토리에 저장된 파일명
$file_size = $_FILES['upload_file']['size'];                 // 업로드한 파일의 크기
$mimeType = $_FILES['upload_file']['type'];                 // 업로드한 파일의 MIME Type
$file_type = substr($file['name'], strrpos($file['name'], '.') + 1);
// 이미지 파일이 저장될 서버 디렉토리 지정
$save_dir = $_SERVER['DOCUMENT_ROOT'] .'/img/';
// 업로드 파일 확장자 검사 (필요시 추가)
if($file_type=="html" || $file_type=="htm" || $file_type=="php" || $file_type=="php3" || $file_type=="inc" || $file_type=="pl" || $file_type=="cgi"
    || $file_type=="txt" || $file_type=="TXT" || $file_type=="asp" || $file_type=="jsp" || $file_type=="phtml" || $file_type=="js" || $file_type=="") {
    echo '<script> alert("업로드를 할 수 없는 파일형식입니다."); document.location.href = "pages/trex/file.html"; </script>';
    exit;
}

// 파일명 변경 (실제 업로드되는 파일명을 별도로 생성하고 원래 파일명을 별도로 변수에 지정하여 DB에 기록할 수 있습니다.)
$real_name = $file_name;
$arr = explode(".", $real_name);	 // 파일의 확장자명을 가져와서 그대로 사용	 $file_exe
$arr1 = $arr[0];
$arr2 = $arr[1];
$arr3 = $arr[2];
$arr4 = $arr[3];
if($arr4) {
    $file_exe = $arr4;
} else if($arr3 && !$arr4) {
    $file_exe = $arr3;
} else if($arr2 && !$arr3) {
    $file_exe = $arr2;
}

$file_time = time();
$file_Name = "file_".$file_time.".".$file_exe;	// 실제 업로드 될 파일명 생성	(본인이 원하는 스타일로 파일명 지정 가능)
$change_file_name = $file_Name;					// 변경된 파일명을 변수에 지정
$real_name = addslashes($real_name);			// 업로드 되는 원래 파일명
$real_size = $file_size;                        // 업로드 되는 파일 크기


//파일을 저장할 디렉토리 및 파일명
$dest_url = $save_dir . $change_file_name;

//파일을 지정한 디렉토리에 저장
if(!move_uploaded_file($file_tmp_name, $dest_url))
{
    die("파일을 지정한 디렉토리에 업로드하는데 실패했습니다.");
}


// DB에 기록할 파일 변수 (DB에 저장이 필요한 경우 아래 변수명을 기록하시면 됩니다.)
/*
	$change_file_name : 실제 서버에 업로드 된 파일명. 예: image_145736478766.gif
	$real_name : 원래 파일명. 예: 풍경사진.gif
	$real_size : 파일 크기(byte)
*/
$download = '/daumEditor/downLoad.php?file='.$change_file_name;
?>

<script type="text/javascript">
    // <![CDATA[
    function initUploader(){
        var _opener = PopupUtil.getOpener();
        if (!_opener) {
            alert('잘못된 경로로 접근하셨습니다.');
            return;
        }

        var _attacher = getAttacher('file', _opener);
        registerAction(_attacher);


        if (typeof(execAttach) == 'undefined') { //Virtual Function
            return;
        }

        var _mockdata = {
            'attachurl': '<?php echo $download; ?>',
            'filemime': '<?php echo $mimeType; ?>',
            'filename': '<?php echo $change_file_name; ?>',
            'filesize': <?php echo $file_size; ?>
        };
        execAttach(_mockdata);
        closeWindow();
    }
    // ]]>
</script>
</body>
</html>
