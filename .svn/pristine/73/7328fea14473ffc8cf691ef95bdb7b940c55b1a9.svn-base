<?php
namespace Admin\Controller;
use Think\Controller;
//use Think\Template\Driver\Mobile;
require './ThinkPHP/Library/Vendor/Wechat/Wechat.class.php';
require './ThinkPHP/Library/Vendor/Wechat/WechatOauth.class.php';
require './ThinkPHP/Library/Vendor/Wechat/HttpCurl.class.php';
class OrderController extends Controller {

	
	public function map($res='麦当劳',$branch=''){
	
		//0.由删除跳转到地图页时删除数据库
		$order_id = $_GET['order_id'];
		if(isset($order_id)){
			$delSql = "update order_number set order_state='0' where order_id='$order_id'";
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
	
	
    public function orderIndex(){
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
    	$openid = '1237';
    	$sid = $_GET['sid'];
    	session('sid',$sid);
    	session('openid',$openid);
    	$this->display();
    	/* $this->success('gfh', 'Order/orderConfirm'); */
    }
    
    public function orderConfirm(){
    	
    	//获取当前时间-7天后时间,并输出到前端
    	$tomorrow['0'] = date("m-d");
    	$tomorrow['1'] = date("m-d",strtotime("+1 day"));
    	$tomorrow['2'] = date("m-d",strtotime("+2 day"));
    	$tomorrow['3'] = date("m-d",strtotime("+3 day"));
    	$tomorrow['4'] = date("m-d",strtotime("+4 day"));
    	$tomorrow['5'] = date("m-d",strtotime("+5 day"));
    	$tomorrow['6'] = date("m-d",strtotime("+6 day"));
    	$this->assign('tomorrow',$tomorrow);
    	
    	//前端输入的预订人数
    	$people_number = intval($_POST['peopleNumber']);
    	//通过人数计算出对应的餐桌类型:0,1,2,3,4
    	if($people_number>8){
    		$table_type = 0 ;
    	}if($people_number<=8){
    		if($people_number%2==0){
    			$table_type = $people_number/2;
    		}else{
    		$table_type = ($people_number+1)/2;
    		}
    	}
    	//计算出可容纳人数
    	if($people_number%2==1){
    		$person_count = $people_number++;
    	}else{
    		$person_count = $people_number;
    	}
    	
    	session('person_count',$person_count);
    	session('table_type',$table_type);
   		
		
    	
    	$this->assign('peopleNumber',$people_number);
    	
    	$this->display();
    }
    
    public function calTableInfo(){
    	//获取所需数据
    	$day = I('post.day');
   		
    	$sid = $_SESSION['sid'];
		$table_type = $_SESSION['table_type'];
		
		// 查询餐桌ID
		// 根据商家ID，可预订座位，桌位类型==>可订桌位ID
		$table_sql = "select mi.table_id from meal_info mi where mi.sid='$sid' and mi.is_order='1' and mi.table_type='{$table_type}'";
		$table_result = D ( '' )->query ($table_sql);
		// 组装可用桌位
	 	foreach ( $table_result as $key => $val ) {
			$table_id[] = $val['table_id'];
		}
		// 统计可用桌位数目
		$table_num = count ( $table_id );
		// 组装桌位信息（桌号，桌位总数）
		$table_inf = array(
				'table_num' => $table_num,
				'table_id' => $table_id,
				//'table_time' => $result_time 
		);
		//保存到会话范围
		session('day',$day);
		session('table_id',$table_id);
		// 返回结果数组
		$res = array( 
				'status' => 0,
				'msg' => 'done',
				'data' => $table_inf 
		);
		$this->ajaxReturn ( $res, 'JSON' );
	}
    
	public function calTimeInfo(){
		//获取所需数据
		$tableNumber = $_POST['tabelNumber'];//01
		$day = $_SESSION['day'];
		$sid = $_SESSION['sid'];
		$table_type = $_SESSION['table_type'];
		$table_id = $_SESSION['table_id'];
		
		$order_time = array (
				$tableNumber =>
								array(
								0 => '9:00',
								1 => '9:30',
								2 => '10:00',
								3 => '10:30',
								4 => '11:00',
								5 => '11:30',
								6 => '12:00',
								7 => '12:30',
								8 => '13:00',
								9 => '13:30',
								10 => '14:00',
								11 => '14:30',
								12 => '15:00',
								13 => '15:30',
								14 => '16:00',
								15 => '16:30',
								16 => '17:00',
								17 => '17:30',
								18 => '18:00',
								19 => '18:30',
								20 => '19:00'
								)
		);
		
		// 查询用户想预约的那天每个桌位ID对应的已预约时间
		// 根据用户想预定的那天，可预订的桌位，已知类型，商家ID
		$sql = "select mi.table_id,substr(orn.order_time,12,5) as begintime from order_number orn
				left join meal_info mi on mi.sid=orn.sid and mi.table_id=orn.table_id
				where substr(orn.order_time,6,5)= '{$day}'
				and orn.order_state='1'
				and orn.table_id ='{$tableNumber}'
				and mi.sid='{$sid}'
				group by mi.table_id,mi.table_name,orn.order_time
				order by mi.table_id,orn.order_time";
		$date_result = D ( '' )->query($sql);
		// 判断是否有预约
		$result = array();
		if (empty ( $date_result )) { // 没有预约
				$result=$order_time  ;
		} 
		else { // 有预约
			$num = array();
			foreach ( $date_result as $key => $value ) {
				$k = $value ['table_id'];//01
				$num[$k][]= $value ['begintime'];
			}
			$result_time = array();
			foreach ( $num as $k => $time ) {
				$result [$k] = $order_time[$k];
				foreach ( $time as $value ) { //value 9:30
					$min = str_replace ( ':', '', $value ) - 300;
					$max = str_replace ( ':', '', $value ) + 300;
					foreach ( $order_time as $order_key => $order_val ) { // end_time 12:00
						foreach ($order_val as $kk => $val){
							if ($min < str_replace ( ':', '', $val ) && $max > str_replace ( ':', '', $val )) {
								unset ( $result [$k] [$kk] );
							}
						} 
					}
				} 
			}
		}
		$this->ajaxReturn ( $result[$tableNumber], 'JSON' );
		
	}
	
	
    
    public function orderSuccess(){
    	$openid  = $_SESSION['openid'];
    	$person_count =  $_SESSION['person_count'];
    	$table_type = $_SESSION['table_type'];
    	$name = $_POST['nickName'];
    	$phone_number = $_POST['phone'];
    	$sex = $_POST['sex'];
    	$order_remark = $_POST['remark'];
    	$day = $_SESSION['day'];//08-29
    	$time = $_POST['time'];
    	$sid = $_SESSION['sid'];
    	$table_id = $_POST['tabelNumber'];
    	//获取$order_time
    	$order_time = date('Y-',time()) . $day . ' ' . $time . ':00';
    	$orderId_sql = "select max(order_id) as maxId,substr(max(order_id),1,8) as oldTime from order_number ";
    	$result = D('')->query($orderId_sql);
    	$maxId = $result[0]['maxid'];
    	$oldTime = $result[0]['oldtime'];
    	if($oldTime == date("Ymd")){
    		$order_id=$maxId+1;//获取当天queue_id
    	}else{
    		$order_id=date("Ymd").'001';//获取0点第一个queue_id
    	}
    	//保存到会话范围
    	session('order_time',$order_time);
    	session('person_count',$person_count);
    	session('order_id',$order_id);
    	session('table_id',$table_id);
    	
    	$data['order_id'] = $order_id;
    	$data['sid']=$sid;
    	$data['openid']=$openid;
    	$data['table_id']=$table_id;
    	$data['name']=$name;
    	$data['sex']=$sex;
    	$data['order_remark']=$order_remark;
    	$data['phone_number']=$phone_number;
    	$data['person_count']=$person_count;
    	$data['table_type']=$table_type;
    	$data['order_time']=$order_time;
    	$data['order_state']='1';
    	$insert_result = D('order_number')->add($data);
    	$this->display();
    }
    //预约订座订单查询
    public function orderQuery(){
    	$openid  = $_SESSION['openid'];
    	$query_sql = "SELECT order_id,order_time,person_count,table_id  FROM order_number WHERE order_state='1' and openid='$openid' and order_time>=now()";
    	$query_result = D('')->query($query_sql);
    	$this->assign('query_result',$query_result);
    	$this->display();
    }
    //订单删除操作
    public function orderDelete(){
    	$order_id = $_POST['order_id'];
    	$order_time = $_SESSION['order_time'];
    	$delete_sql = "update order_number set order_state='0',order_time='$order_time' where order_id='$order_id'";
    	$delete_result = D('')->execute($delete_sql);
    }
    
}