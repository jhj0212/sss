<?php
/**
 * description: 递归菜单
 * @author: wuyanwen(2016年8月7日)
 * @param unknown $array
 * @param number $fid
 * @param number $level
 * @param number $type 1:顺序菜单 2树状菜单
 * @return multitype:number
 */
function get_column($array,$type=1,$fid=0,$level=0)
{
    $column = [];
    if($type == 2){
	    foreach($array as $key => $vo){
	        if($vo['pid'] == $fid){
	            $vo['level'] = $level;
	            $column[$key] = $vo;
	            $column [$key][$vo['id']] = get_column($array,$type=2,$vo['id'],$level+1);
	        }
	    }
    }else{
        foreach($array as $key => $vo){
            if($vo['pid'] == $fid){
                $vo['level'] = $level;
                $column[] = $vo;
                $column = array_merge($column, get_column($array,$type=1,$vo['id'],$level+1));
            }
        }
    }
    return $column;
}
/**
 * CURL模拟POST提交数据
 */
function postData($url = '', $data = array()){
	$ch = curl_init ();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

function showMessage($message, $type = false){
	if($type){
		$imgpath = '/Public/home/img/success.png';
	}else{
		$imgpath = '/Public/home/img/error.png';
	}
	$html = '<!DOCTYPE html>
<html>
	<head>
		<title>友情提示</title>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<style>
			body{margin:0; padding:0; height:100%;font-family: "微软雅黑"; font-size: 14px;}
			.errorcon{padding-top: 80px;}
			.errorimg{width:48px; height:48px; margin: 0 auto; padding-bottom: 30px; }
			.errorimg img{width:48px; height:48px;}
			.errorfont{width:80%; margin:0 auto; text-align: center; color: #f00; padding-bottom: 60px; font-size:18px;}
			.errorbutton input{padding:5px 20px; margin:0 auto; border: 1px solid #ccc; border-radius: 5px; -webkit-border-radius: 5px; -moz-border-radius: 5px; -ms-border-radius: 5px; -o-border-radius: 5px; background: #eee; -webkit-appearance: none; display: block; color: #2e2e2e; font-size: 16px;}
		</style>
	</head>
	<body>
		<div class="errorcon">
			<div class="errorimg"><img src="'.$imgpath.'" /></div>
			<div class="errorfont">'.$message.'</div>
		</div>
	</body>
</html>';
	echo $html;exit;
}

function get_url() {
	$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
	$php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
	$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
	$relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
	return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}