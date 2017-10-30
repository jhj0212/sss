<?php
use think\Log;
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);
Vendor('WxpayAPI.lib.WxPayApi');
//require_once "../lib/WxPayApi.php";
//require_once '../lib/WxPay.Notify.php';
Vendor('WxpayAPI.lib.WxPayNotify');
//require_once 'log.php';

//初始化日志
//$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
//$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		Log::DEBUG("query:" . json_encode($result));
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
//		/Log::DEBUG("call back:" . json_encode($data));
        Log::order_log(json_encode($data),'回调记录');
        $data['data'] = json_encode($data);
        M('test')->add($data);
		$notfiyOutput = array();
        $update = array();

        if(!array_key_exists("transaction_id", $data)){
            $msg = "输入参数不正确";
            Log::order_log($msg,'参数校验');
            return false;
        }

        if(!$this->Queryorder($data["transaction_id"])){
            $msg = "订单查询失败";
            Log::order_log($msg,'订单校验');
            return false;
        }
		//查询订单，判断订单真实性

        $data_add['out_trade_no'] = $data['out_trade_no'];
        $order_info = M('order_info')->where($data_add)->select();
        if (!$order_info){
            $msg = '本地订单不存在'.$data['out_trade_no'];
            Log::order_log($msg,'订单校验');
            return false;
        }
        if ($order_info['trade_state']=='SUCCESS')
            return  true;
        if ($order_info['pay_money']!=$data['total_fee']){
            Log::order_log('本地单号:'.$order_info['out_trade_no'].' 微信单号:'.$data['out_trade_no'],'金额异常');
            $update['remark'] = '金额异常';
            $update['trade_state'] = 'PAYERROR';
        }else{
            $update['trade_state'] = 'SUCCESS';
        }
        $update['pay_time'] = strtotime($data['time_end']);
        $update['return_cache'] = json_encode($data);
        $update['attach'] = $data['attach'];
        $update['transaction_id'] = $data['transaction_id'];
        Db::startTrans();
        try {
            $where['out_trade_no'] = $data['out_trade_no'];
            $res    = M('order_info')->where($where)->save($update);
            if ($res){
                Db::commit();
                Log::order_log('订单更新成功'.$order_info['out_trade_no'],'成功');
                return true;
            }
            else
            {
                Db::rollback();
                Log::order_log('订单更新数据库失败'.$order_info['out_trade_no'],'失败');
                return false;
            }
        } catch (Exception $e) {
            Log::order_log(json_encode($e),'抛异常');
            Db::rollback();
            return false;

        }
    }
}

//Log::DEBUG("begin notify");
//$notify = new PayNotifyCallBack();
//$notify->Handle(false);
