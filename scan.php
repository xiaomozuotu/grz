<?php
header("Content-Type: application/json;charset=utf-8");
$folder = $_GET['folder'] ?? '';
// 安全过滤，只允许你这8个文件夹
$allow = ["纯文字厅头","带头像厅头","福利图","厅站图","厅背景","歌单","关系卡","直播框"];
if(!in_array($folder,$allow)){
    echo json_encode([]);
    exit;
}
$path = $folder . '/';
$files = [];
$imgExt = ['jpg','jpeg','png','webp'];
$dir = scandir($path);
foreach($dir as $f){
    $full = $path.$f;
    if(is_file($full)){
        $ext = strtolower(pathinfo($f,PATHINFO_EXTENSION));
        if(in_array($ext,$imgExt)){
            $files[] = $full;
        }
    }
}
// 按文件名升序排序
sort($files, SORT_NATURAL);
echo json_encode($files);
?>
