<?php
	//服务器设置
	$ServerVersion = '0.2.2'; //服务器处理程序版本
	
	$LastestVersion_Release = '1.0.0.0'; //最后的Release版本
	$LastestVersion_Beta = '1.0.0.0'; //最后的Beta版本
	$LastestVersion_Debug = '1.0.0.0'; //最后的Debug版本
	
	$LastestBuild_Release = '0'; //最后的Release Build
	$LastestBuild_Beta = '0'; //最后的Beta Build
	$LastestBuild_Debug = '0'; //最后的Debug Build
	
	//处理请求
	switch (@$_GET['Command']){
		case 'GetServerVersion': //查询更新服务器版本
			echo $ServerVersion;
			break;
		case 'GetLastestVersion': //查询最后客户端版本
			switch (@$_GET['Version']){
				case 'Release':
					echo $LastestVersion_Release;
					break;
				case 'Beta':
					echo $LastestVersion_Beta;
					break;
				case 'Debug':
					echo $LastestVersion_Debug;
					break;
				default:
					echo 'Unknown Parameter';
			}
			break;
		case 'Download': //下载文件
			//打开文件
			$file_path = "./Download/" . @$_GET['Version'] . "/" . @$_GET['Version'] . ".exe";
			$file_size = filesize ( "./Download/" . @$_GET['Version'] . "/" . @$_GET['Version'] . ".exe" );
			$file = fopen ( $file_path , "r" );
			//输入文件标签
			Header( "Content-type: application/octet-stream" );
			Header( "Accept-Ranges: bytes" );
			Header( "Accept-Length: " . $file_size );
			Header( "Content-Disposition: attachment; filename=" . @$_GET['Version'] . ".exe" );
			//输出文件内容
			//读取文件内容并直接输出到浏览器
			echo fread( $file, $file_size );
			fclose( $file );
			exit();
			break;
		case 'WhatShouldIdo': //获取更新脚本
			if (@$_GET['Build']!=$LastestBuild_Debug){
				echo 'ask(发现新版本V1.0.0.0是否更新？,end);';
				echo 'mkdir(.\doubitemp);';
				echo 'download(http://update.dreamerstudio.net:50003/update/DoubiLauncher/Download/1.0.0.0/1.0.0.0.exe,.\doubitemp\DoubiLauncher-CSharp-1.0.0.0.exe);';
				echo 'move(.\doubitemp\DoubiLauncher-CSharp-1.0.0.0.exe,.\DoubiLauncher-CSharp-1.0.0.0.exe);';
				echo 'delete(.\doubitemp);';
				echo 'start(.\DoubiLauncher-CSharp-1.0.0.0.exe,,false);';
				echo 'deleteme();';
				echo 'sign(end);';
			}
			break;
		case 'GetNotice':
			echo '公告测试';
			break;
		default:
			echo 'Unknown Command';
	}
	
	//生成脚本语句函数
	//（暂时假装有内容（¯﹃¯））

?>
