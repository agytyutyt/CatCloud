<?php
/**
 * 功能：获取文件信息
 * 编辑：www.jbxue.com
 */

//设置默认时区
date_default_timezone_set('PRC');

function getFileInfo($filePath){
    if(!file_exists($filePath)){
        echo '指定的文件不存在！';
        return;
    }
    if(is_file($filePath)){
        echo $filePath.'是一个文件'.'<br>';
    }
    if(is_dir($filePath)){
        echo $filePath.'是一个目录'.'<br>';
    }

    echo '文件的形态：'.getFileType($filePath).'<br>';
    echo '文件的大小：'.getFileSize($filePath).'<br>';


    if(is_readable($filePath)){
        echo '文件可读'.'<br>';
    }else{
        echo '文件不可读'.'<br>';
    }

    if(is_writeable($filePath)){
        echo '文件可写'.'<br>';
    }else{
        echo '文件不可写'.'<br>';
    }

    echo '文件建立的时间：'.date('Y年m月d日',filectime($filePath)).'<br>';
    echo '文件最后修改的时间：'.date('Y年m月d日',filemtime($filePath)).'<br>';
    echo '文件最后访问的时间：'.date('Y年m月d日',fileatime($filePath)).'<br>';
}

function getFileType($filePath){
    switch(filetype($filePath)){
        case 'file':
            $type.='普通文件';
            break;
        case 'dir':
            $type.='目录文件';
            break;
        case 'block':
            $type.='块设备文件';
            break;
        case 'char':
            $type.='字符设备文件';
            break;
        case 'fifo':
            $type.='命名管道文件';
            break;
        case 'link':
            $type.='符号链接';
            break;
        case 'unknown':
            $type.='未知文件类型';
            break;
        default:
            $type.='没有检测到文件类型';
    }
    return $type;
}

function getFileSize($filePath){
    $bytes=filesize($filePath);
    //1TB=1024GB 1GB=1024MB 1MB=1024KB 1KB=1024B
    if($bytes > pow(2,40)){
        $size = round($bytes/pow(1024,4),2);
        $unit = 'TB';
    }elseif($bytes > pow(2,30)){
        $size = round($bytes/pow(1024,3),2);
        $unit = 'GB';
    }elseif($bytes > pow(2,20)){
        $size = round($bytes/pow(1024,2),2);
        $unit = 'MB';
    }elseif($bytes > pow(2,10)){
        $size = round($bytes/pow(1024,1),2);
        $unit = 'KB';
    }else{
        $size = $bytes;
        $unit = 'Byte';
    }
    return $size.' '.$unit;
}
$filePath = $_SERVER['DOCUMENT_ROOT'].'/test/editor.php';
getFileInfo($filePath);
?>