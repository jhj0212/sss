<?php
namespace Admin\Controller;
use Think\Controller;
//use Think\Template\Driver\Mobile;
require './ThinkPHP/Library/Vendor/Wechat/Wechat.class.php';
require './ThinkPHP/Library/Vendor/Wechat/WechatOauth.class.php';
require './ThinkPHP/Library/Vendor/Wechat/HttpCurl.class.php';
class IndexController extends Controller {

	public function game(){
		$this->display();
	}
	public function map($res='麦当劳',$branch=''){
		//0.由删除跳转到地图页时删除数据库
		$queue_id = $_GET['queue_id'];
		if(isset($queue_id)){
			$delSql = "update queue_number set state='1' where queue_id='$queue_id'";
			$result = D('')->execute($delSql);
		}
		
		//1.展示所有的门店信息  
		 if ($res === ''){
		 	$where['business_name']=array('like','%'.$res.'%');
		 }else {
		 	$where['business_name'] = array('like','%'.$res.'%');
		 	$where['branch_name'] = array('like','%'.$branch.'%');
		 }
		//2.模糊查询门店名称
		$info = D('store_info')->field("sid,business_name,branch_name,province,city,district,address,telephone")->where($where)->select();
		
		$this->assign('info',$info);
		$this->display();
		
	}
	/**
	 * 获取排队取号信息,将数据库信息返回页面
	 */
    public function getNumber(){
    	//通过微信端获取openid
     	/* $appid = 'wxa1aad45f1d586221';
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
     		if(!empty($_SESSION['openid'])){
     			$openid = $_SESSION['openid'];
     		}else{
     			$openid = $wechatoauth->Openid($appid,$secret,$code,$scope);
     	//设置session 中的openid
		//session('openid',$openid);
     		}
     	}else{
     		//从定向url获取code
     		$url= $wechatoauth->Code($appid,$hosturl,$scope);
     		redirect($url);
     	} */
     	$openid='1237';
     	session('openid',$openid);
    	//从数据库获取值
    	$store_info = M("store_info");
    	$where['sid']=I('get.sid');
    	$sid=I('get.sid');
    	$data = $store_info->field('sid,address,telephone,province,city,district')->where($where)->select();
    	//将数据库查到的数据存入session
    	$_SESSION['sid']=$sid;
    	$this->assign('sid',$sid);
    	//将数据存到前端
    	$this->assign('data',$data);
    	//执行前端操作
    	$this->display('getNumber');
    	
    }
    /**
     * 验证30分钟之内是否重复取号
     */
    public function proveStartTime(){
    	//获取数据
    	$openid  = $_SESSION['openid'];
    	$phone_number=$_POST['tel'];//从前端获取电话
    	$person_count=$_POST['people'];//从前端获取人数
    	session('phone_number',$phone_number);
    	session('person_count',$person_count);
    	$sid = $_SESSION['sid'];
    	
    	$queueIdSql = "SELECT openid,max(start_time) as stime FROM `queue_number` WHERE openid='$openid' and sid='$sid' and state='0'";
    	$idResult = D('')->query($queueIdSql);
    	$sysUser=$idResult[0]['openid'];
    	$startTime = $idResult[0]['stime'];
    	/* print_r($idResult);
    	print_r(strtotime($startTime)+30*60);
    	print_r('>'.time().'应该满足'); */
    	print_r(isset($startTime));
    	if(!empty($sysUser)){
    		if(isset($startTime) && strtotime($startTime)+30*60>time()){
    			echo "<script>alert('请在30分钟之后排队');history.go(-1);</script>";
    		}
    		else{
	    		$this->redirect(setQueueNumber);
    		}
    	}
    	else{
    		$this->redirect(setQueueNumber);
    	}
    }
    
    /**
     * 将计算出来的排队信息返回到取号成功页面
     * 前面等待，预计等待，排队取号号码
     */
    public function setQueueNumber(){
    	$openid  = $_SESSION['openid'];
    	$person_count=$_SESSION['person_count'];
    	$phone_number=$_SESSION['phone_number'];
    	$sid = $_SESSION['sid'];
    	
    	//获取排队取号ID
    	$queueSql = 'select queue_id,date_format(max(start_time),"20%y%m%d") as maxtime,start_time from queue_number group by start_time DESC limit 1';
    	$result= D('')->query($queueSql);
    	$maxTime=$result[0]['maxtime'];
    	$oldId=$result[0]['queue_id'];
    	if($maxTime == date("Ymd")){
    		$queue_id=$oldId+1;//获取当天queue_id
    	}else{
    		$queue_id=date("Ymd").'0001';//获取0点第一个queue_id
    	}
    	
    	//获取桌位类型
    	if($person_count<=2){
    		$table_type = '1';
    	}else if($person_count>2&&$person_count<=4){
    		$table_type = '2';
    	}else if($person_count>4&&$person_count<=6){
    		$table_type = '3';
    	}else if($person_count>6&&$person_count<=8){
    		$table_type = '4';
    	}
    	//获取当前时间
    	$start_time = date('Y-m-d H:i:s');
    	//获取当前状态
    	$state=0;
    	//存入数据库
    	$data = array(
    		'queue_id'=>$queue_id,
    		'sid'=>$sid,
    		'phone_number'=>$phone_number,
    		'openid'=>$openid,
    		'person_count'=>$person_count,
    		'table_type'=>$table_type,
    		'start_time'=>$start_time,
    		'state'=>$state,
    	);
    	$result= M('queue_number')->add($data);
    	//存入会话范围
    	session('queue_id',$queue_id);
    	session('start_time',$start_time);
    	session('table_type',$table_type);
		session('sid',$sid);
		session('person_count',$person_count);
		session('table_type',$table_type);
		session('start_time',$start_time);
		session('state',$state);
    	//跳转到排队取号成功页面
		if($result){
			$this->redirect(numberSuccess);
		}
	
    }
    
    
    /**
     * 输出数据到成功页面
     * 前面等待，预计等待，排队取号号码
     */
    public function numberSuccess(){
    	
    	$start_time = $_SESSION['start_time'];
    	$openid = $_SESSION['openid'];
    	$sid = $_SESSION['sid'];
  		$table_type = $_SESSION['table_type'];
  		
    	//手机号验证
    	$phone_number=session('phone_number');
    	$res = preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,5,6,7,8]{1}\d{8}$|^18[\d]{9}$#',$phone_number);
    	if($res==0){
    	 echo "<script>alert('请输入正确的手机号码');history.go(-1);</script>";
    	} 
    	//排队取号的号码
    	$session_sql = "select count(1) as countcode  
					   from queue_number 
				       where sid='$sid' 
				       and state='0'
				       and substr(start_time,1,10)=substr(now(),1,10)
				       and start_time<='$start_time'";
    	$result = D('')->query($session_sql);
    	$a = $result[0]['countcode'];
    	$queue_temp_num='A'.$result[0]['countcode'];
  		
  		
  		//前面等待桌数
  		$wait_num="select table_type,count(queue_id) as num from queue_number where sid = '{$sid}' 
	  				and substr(start_time,1,10)=substr(now(),1,10)
	  				and state = '0'
	  				and table_type = '$table_type'
	  				group by table_type";
  		$wait_result = D('')->query($wait_num); 
  		$num = $wait_result[0]['num']-1;//前面同餐桌类型(自己除外)的数量
  		$this->assign('wait_num',$num);
  		
  		//预计等待时间
  		$query = "select (case when table_type='1' then '$num'*10 when table_type='2' then '$num'*15 when table_type='3' then '$num'*20 when table_type='4' then '$num'*30 else 0 end ) as waitingtime 
					from queue_number 
					where sid='$sid'
					and table_type ='$table_type' 
					and state='0'
					and now()>(select max(start_time) from queue_number where openid='$openid')";
  		
		$result= D('')->query($query);
  		$wait_time = $result[0]['waitingtime'];
  		$this->assign('waitingtime',$wait_time);
  		$this->assign('queue_no',$queue_temp_num);
    	$this->display();
    }

  
    /**
     * 取消排队页面
     */
    public function numberCancel(){
    	$queue_id = $_SESSION['queue_id'];
    	$this->assign('queue_id',$queue_id);
    	$this->display();
    }
   
    /* public function insertQueueNumber(){
    	//$openid  = session('openid');

    	$queue_id = session('queue_id');
    	$sid = session('sid');
    	$openid = session('openid');
    	$phone_number = session('phone_number');
    	$person_count = session('person_count');
    	$table_type = session('table_type');
    	$start_time = session('start_time');
    	//$state = session('state');
    	
    	$insert_sql="insert into queue_number
    	(queue_id,sid,openid,phone_number,person_count,table_type,start_time,end_time,state)
    	values({$queue_id},{$sid},{$openid},{$phone_number},{$person_count},{$table_type},{$start_time},'','0')";
    	$insert_result = D('')->save($insert_sql);
    			$this->display();
    	 
    } */
    
     public function numberFoods(){
    	$sid = $_SESSION['sid'];
    	//查询菜单
    	$menu_sql = "SELECT menu_id,sid,menu_name,menu_pag_url,unit_price,menu_type from carte_info where sid = {$sid} ";
		$menu_result = D('carte_info')->query($menu_sql);
		//查询菜品类
		$menu_type_sql = "select distinct menu_type from carte_info where sid = {$sid}";
    	$type_result = D('carte_info')->query($menu_type_sql);
		$this->assign('type_result',$type_result); 
    	$this->assign('menu_info',$menu_result); 
    	
    	$this->display();
    }
 	
}