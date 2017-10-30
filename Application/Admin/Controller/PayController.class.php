<?php
namespace Admin\Controller;
use Think\Controller;
Class PayController extends Controller{
	public function index(){
		ini_set('date.timezone','Asia/Shanghai');
		//error_reporting(E_ERROR);
		// require_once "WxpayAPI/lib/WxPay.Api.php";
		//  require_once "WxpayAPI/example/phpqrcode/WxPay.JsApiPay.php";

		//require_once 'log.php';

//		Vendor('WxpayAPI_php_V3.WxPay.Api.php');
		Vendor('WxpayAPI.lib.WxPayApi');
		Vendor('WxpayAPI.example.WxPayJsApi');
	    Vendor('WxpayAPI.lib.WxPayConfig');
		//初始化日志
		// $logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
		// $log = Log::Init($logHandler, 15);

		//打印输出数组信息
//		function printf_info($data)
//		{
//		    foreach($data as $key=>$value){
//		        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
//		    }
//		}

        $order_id = $_GET['order_id'];
        if (!isset($order_id) || empty($order_id) || !is_numeric($order_id))
            $this->error('查询不到正确的订单信息');
        $data['order_id'] = $order_id;
        $order_info = M('order_info')->where($data)->select();
        if (!$order_info || empty($order_info))
            $this->error('查询不到正确的订单信息');
        //①、获取用户openid
		$tools = new \WxPayJsApi();
		$openId = $tools->GetOpenid();
//        $openId = "otmgKwNHJBo1YUnP04M7O30xKEw4";
//        var_dump($openId);
		 //②、统一下单
		 $input = new \WxPayUnifiedOrder();
		 $input->SetBody("test");
		 $input->SetAttach("test");
		 $input->SetOut_trade_no(\WxPayConfig::MCHID.date("YmdHis"));
		 $input->SetTotal_fee($order_info[0]['pay_money']);
		 $input->SetTime_start(date("YmdHis"));
		 $input->SetTime_expire(date("YmdHis", time() + 600));
		 $input->SetGoods_tag($order_info[0]['discount_type']);
		 $input->SetNotify_url(\WxPayConfig::NOTIFY_URL);
		 $input->SetTrade_type("JSAPI");
		 $input->SetOpenid($openId);
		 $order = \WxPayApi::unifiedOrder($input);
		 echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
		 printf_info($order);
		 $jsApiParameters = $tools->GetJsApiParameters($order);

		 //获取共享收货地址js函数参数
		 $editAddress = $tools->GetEditAddressParameters();
		 $this->assign(['jsApiParameters'=>$jsApiParameters,'editAddress'=>$editAddress]);
		 //$this->assign('editAddress',$editAddress);
		 $this->display();
	}
	public function notify(){
        var_dump(Vendor('WxpayAPI.example.notify'));
        $notify = new \PayNotifyCallBack();

        $notify->Handle(false);
    }


}