<?php//公共函数库/** * 图片裁剪函数 * @param string $picname 被裁剪的图片名称。 如："a.jpg" * @param string $path 被裁剪图片的存放路径。如："uploads/images"目录 * @param int $sx 被裁图片的起始坐标位置x值 * @param int $sy 被裁图片的起始坐标位置y值 * @param int $sw 被裁图片的宽度 * @param int $sh 被裁图片的高度 * @param string $prix 裁剪后图片名的前缀名。默认为: "s_" * @return 无返回值 */ function cropImage($picname,$path,$sx,$sy,$sw,$sh,$prix="s_"){	//1. 定义获取基本信息	$path = rtrim($path,"/"); //去除后面多余的"/"	$info = getimagesize($path."/".$picname);  //获取图片文件的属性信息	//$width = $info[0]; //原图片的宽度	//$height = $info[1]; //原图片的高度		//2. 创建图像源	$newim =imagecreateTrueColor($sw,$sh); //新图片源	//根据原图片类型来创建图片源	switch($info[2]){		case 1: //gif格式			$srcim = imageCreateFromgif($path."/".$picname);			break;		case 2: //jpeg格式			$srcim = imageCreateFromjpeg($path."/".$picname);			break;		case 3: //png格式			$srcim = imageCreateFrompng($path."/".$picname);			break;		default:			exit("无效的图片格式!");			break;	}	//3. 执行缩放处理	imagecopyresampled($newim,$srcim,0,0,$sx,$sy,$sw,$sh,$sw,$sh);	//4. 输出保存绘画	//header("Content-Type:".$info['mime']); //设置响应类型为图片格式	//根据原图片类型来保存新图片	switch($info[2]){		case 1: //gif格式			imagegif($newim,$path."/".$prix.$picname); //保存			//imagegif($newim);//输出			break;		case 2: //jpeg格式			imagejpeg($newim,$path."/".$prix.$picname);			//imagejpeg($newim);			break;		case 3: //png格式			imagepng($newim,$path."/".$prix.$picname);			//imagepng($newim);			break;	}		//5. 销毁资源	imageDestroy($newim);	imageDestroy($srcim);	}function demo($data){	var_dump($data);    exit;}