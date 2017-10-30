<?php
namespace Home\Controller;
use Think\Controller;
require './ThinkPHP/Library/Vendor/Wechat/Wechat.class.php';
require './ThinkPHP/Library/Vendor/Wechat/WechatOauth.class.php';
require './ThinkPHP/Library/Vendor/Wechat/HttpCurl.class.php';
class IndexController extends Controller {
    public function index()
    {
 	$appid = 'wxa1aad45f1d586221';
     	$secret = '226550ce140228f076b7358d59c83e72';
     	//获取当前页面url并urlencode
     	$hosturl =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
     	$wechatoauth= new \WechatOauth();
     	//定义微信302不显示授权页面
     	$scope = 'snsapi_base';
     	//判读code是否存在不存在获取
     	if(!empty($_GET['code']))
     	{
    		$code = $_GET['code'];
     		//判读openid是否存在，不存在获取，并保存在session内
     		if(session(‘openid’) != null){
     			$openid = session(‘openid’);
     		}else{
     		$openid = $wechatoauth->Openid($appid,$secret,$code,$scope);
     		//设置session 中的openid
            	session(‘openid’,$openid);
     		}

		echo $openid;
     		//查表操作
                if(I('get.id')){
                $sid = I('get.id');
                session('sid',$sid);
                $data = D('store_info')->field('address,telephone')->where("sid = $sid")->find();
                //将数据存到前端
                $this->assign('data',$data);
                }else {
                    echo '非法访问';
                    exit();
                }

     	}else{
     		//从定向url获取code
     		$url= $wechatoauth->Code($appid,$hosturl,$scope);
     		redirect($url);
     	}
   }
}