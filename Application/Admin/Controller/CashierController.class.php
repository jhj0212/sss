<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/8
 * Time: 16:36
 */
class CashierController extends CommonController {
    public function index(){
        //①、获取用户openid
        $tools = new \WxPayJsApi();
        $openId = $tools->GetOpenid();
        $where['sys_user_openid']=$openId;
        $where['sid']='0000000001';
        $res=M('sys_user')
            ->where($where)
            ->field('sys_user_openid')
            ->find();
        //echo M('sys_user')->_sql();
        //判断是否为系统用户
        if ($res){
            $this->assign('openid',$openId);
            $this->display();
        }else{
            $this->display('error');
        }
    }
    public function orderIndex(){
        $sid = $_GET['sid'];
        $openid = $_GET['sys_user_openid'];
        $this->assign('openid',$openid);
        $this->assign('sid',$sid);
        $this->display();
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
        $openid = $_POST['openid'];
        $sid = $_POST['sid'];
        $this->assign('openid',$openid);
        $this->assign('sid',$sid);
        $this->assign('peopleNumber',$people_number);

        $this->display();
    }

    public function calTableInfo(){
        //获取所需数据
        $day = I('post.day');
        $table_type = $_SESSION['table_type'];
        $sid=$_POST['sid'];
        // 查询餐桌ID
        // 根据商家ID，可预订座位，桌位类型==>可订桌位ID
        $table_result =M('meal_info')
            ->where('sid= '.$sid.' and is_order=1 and table_type='.$table_type)
            ->field('table_id')
            ->select();
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
        $result = array();
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
        $date_result = M('order_number as orn')->fetchSql(false)
            ->join('meal_info  mi ON mi.sid = orn.sid and mi.table_id = orn.table_id')
            ->where('orn.order_state = 1 and substr(orn.order_time, 6, 5) = '.$day.' and orn.table_id = '.$tableNumber)
            ->field('mi.table_id,mi.table_name,substr(orn.order_time,12,5) as begintime')
            ->group('mi.table_id,mi.table_name,orn.order_time')
            ->order('mi.table_id,orn.order_time')
            ->select();
        // 判断是否有预约
        if (empty ( $date_result )) { // 没有预约
            $result=$order_time  ;
        }else { // 有预约
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
        $openid  = $_POST['openid'];
        $person_count =  $_SESSION['person_count'];
        $table_type = $_SESSION['table_type'];
        $name = $_POST['nickName'];
        $phone_number = $_POST['phone'];
        $sex = $_POST['sex'];
        $order_remark = $_POST['remark'];
        $day = $_SESSION['day'];//08-29
        $time = $_POST['time'];
        $sid = $_POST['sid'];
        $table_id = $_POST['tabelNumber'];
        //获取$order_time
        $order_time = date('Y-',time()) . $day . ' ' . $time . ':00';
        $result = M('order_number')
            ->field(' max(order_id) as maxId,substr(max(order_id),1,8) as oldTime')
            ->select();
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
        $this->assign('openid',$openid);
        $this->display();
    }
    //预约订座订单查询
    public function orderQuery(){
        $openid  = $_GET['openid'];
        $query_result = M('order_number')
            ->where('order_state= 1 and order_time>=now() and openid="'.$openid.'"')
            ->field('order_id,order_time,person_count,table_id')
            ->select();
        /*echo M('order_number')->_sql();
        var_dump($query_result);*/
        $this->assign('query_result',$query_result);
        $this->display();
    }
    //订单删除操作
    public function orderDelete(){
        $order_id = $_POST['order_id'];
        $order_time = $_SESSION['order_time'];
//        $delete_sql = "update order_number set order_state='0',order_time='$order_time' where order_id='$order_id'";
//        $delete_result = D('')->execute($delete_sql);
        $id=M('order_number')->where(array('order_state'=>0,'order_id'=>$order_id,'order_time'=>$order_time))->setField('order_state',0);
        print_r($id);
        //$this->ajaxReturn(1);
    }
}