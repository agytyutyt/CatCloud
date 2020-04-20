<?php
//$file_name = "/home/drcat/demo";
//$file_name = "demo";     //下载文件名
//$file_dir = "/home/drcat/";        //下载文件存放目录
////检查文件是否存在
//
//if (! file_exists ( $file_dir . $file_name )) {
//    header('HTTP/1.1 404 NOT FOUND');
//    error_log("????????????");
//} else {
//    error_log("!!!!!!!!!!!!");
//    //以只读和二进制模式打开文件
//    $file = fopen ( $file_dir . $file_name, "rb" );
//
//    $filesize=filesize ( $file_dir . $file_name );
//
//    //告诉浏览器这是一个文件流格式的文件
//    Header ( "Content-type: application/octet-stream" );
//    //请求范围的度量单位
//    Header ( "Accept-Ranges: bytes" );
//    //Content-Length是指定包含于请求或响应中数据的字节长度
//    Header ( "Accept-Length: " . $filesize);
//    //用来告诉浏览器，文件是可以当做附件被下载，下载后的文件名称为$file_name该变量的值。
//    Header ( "Content-Disposition: attachment; filename=" . $file_name );
//
//    $read_buffer = 4096;
////    $handle = fopen($file_name, 'rb');
////总的缓冲的字节数
//    $sum_buffer = 0;
////只要没到文件尾，就一直读取
//    while(!feof($file) && $sum_buffer<$filesize) {
//        echo fread($file,$read_buffer);
//        $sum_buffer += $read_buffer;
//    }
//    //读取文件内容并直接输出到浏览器
//    fclose ( $file ); //打开的时候要进行关闭这个文件
//    exit ();
//}
//
//$filename="/home/drcat/demp";
//
////获取文件信息
//$fileExt = pathinfo($filename);
//
////设置脚本的最大执行时间，设置为0则无时间限制
//set_time_limit(0);
//ini_set('max_execution_time', '0');
//
////通过header()发送头信息
////因为不知道文件是什么类型的，告诉浏览器输出的是字节流
//header('content-type:application/octet-stream');
//
////告诉浏览器返回的文件大小类型是字节
//header('Accept-Ranges:bytes');
//
////获得文件大小
////$filesize = filesize($filename);//(此方法无法获取到远程文件大小)
//$header_array = get_headers($filename, true);
//$filesize = $header_array['Content-Length'];
//
////告诉浏览器返回的文件大小
//header('Accept-Length:'.$filesize);
////告诉浏览器文件作为附件处理并且设定最终下载完成的文件名称
//header('content-disposition:attachment;filename='.basename($filename));
//
////针对大文件，规定每次读取文件的字节数为4096字节，直接输出数据
//$read_buffer = 4096;
//$handle = fopen($filename, 'rb');
////总的缓冲的字节数
//$sum_buffer = 0;
////只要没到文件尾，就一直读取
//while(!feof($handle) && $sum_buffer<$filesize) {
//    echo fread($handle,$read_buffer);
//    $sum_buffer += $read_buffer;
//}
//
////关闭句柄
//fclose($handle);
//exit;