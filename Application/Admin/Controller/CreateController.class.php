<?php
namespace Admin\Controller;

use Think\Controller;

class CreateController extends Controller
{
    protected $appid = "wxc1a493ee94bc9b73";
    protected $appsecret = 'ea983cff34489f8243e9240a3606e879';

    public function addCouponIndex()
    {
        $this->display();
    }

    public function card_type()
    {
        //获取卡券的类型
        $card_type = I('card_type');
        switch ($card_type) {
            case 'GIFT':
                S('card_type', $card_type);
                $this->redirect('admin/create/addCouponDui');
                break;

            case 'DISCOUNT':
                S('card_type', $card_type);
                $this->redirect('admin/create/addCouponDui');
                break;
            case 'GENERAL_COUPON':
                S('card_type', $card_type);
                $this->redirect('admin/create/addCouponDui');
                break;
        }

    }

    public function addCouponDui()
    {

        $this->display();
    }

    public function addCardPic()
    {
        $wechat = D('Wechat');
        $url = "https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=" . $wechat->wx_access_token();
        $data = array(
            'media ' => '@' . $_SERVER['DOCUMENT_ROOT'] . '/kaquan/thinkphp/Public/images/right.png'
        );
        $logo_url = $this->http_curl($url, $data);
        var_dump($logo_url);
        return $logo_url;
    }

    public function make_Gift()
    {
        $wechat = D('Wechat');
        $url = "https://api.weixin.qq.com/card/create?access_token=" . $wechat->wx_access_token();
        $card_type = S('card_type');
        $title = I('baseTitle');
        $color = I('baseColor');
        $description = I('description');
        $limit_type = I('limit');
        $phone = I('phone');
        $type = I('chooseTime');
        $begin_timestamp = strtotime(I('begin_timestamp'));
        $end_timestamp = strtotime(I('end_timestamp'));
        $business_service = I('business_service');
        $share = I('share');
        $begin_time = I('begin_time');
        $end_time = I('end_time');
        $abstract = I('abstract');
        $service_phone = I('phone');

        if ($share == "true")
            $share = true;
        else
            $share = false;


        $pic_url = $this->addCardPic();
        $pic_url = $pic_url['url'];
        $get_limit = (int)I('get_limit');
        $least_cost = (int)I('least_cost');
        var_dump($least_cost);
        $data = [
            "card" => [
                "card_type" => $card_type,
                strtolower($card_type) => [
                    "base_info" => [
                        "logo_url" => $pic_url,
                        "brand_name" => "哈哈",
                        "code_type" => "CODE_TYPE_TEXT",
                        "title" => $title,
                        "color" => $color,
                        //"notice" => $notice,
                        "service_phone" => $phone,
                        "description" => "$description",
                        "date_info" => [
                            "type" => "$type",
                            "begin_timestamp" => "$begin_timestamp",
                            "end_timestamp" => "$end_timestamp"
                        ],
                        "sku" => [
                            "quantity" => $get_limit,
                        ],
                        "use_limit" => 100,
                        "get_limit" => $get_limit,
                        "use_custom_code" => false,
                        "bind_openid" => false,
                        "can_share" => $share,
                        "can_give_friend" => true,
                        "location_id_list" => [
                            123,
                            12321,
                            345345
                        ],
                    ],
                    "advanced_info" => [
                        "use_condition" => [
                            "can_use_with_other_discount" => $share,
                            "least_cost" => $least_cost,

                        ],
                        "abstract" => [
                            "abstract" => $abstract,
                            "icon_url_list" => [
                                "http://mmbiz.qpic.cn/mmbiz/p98FjXy8LacgHxp3sJ3vn97bGLz0ib0Sfz1bjiaoOYA027iasqSG0sjpiby4vce3AtaPu6cIhBHkt6IjlkY9YnDsfw/0"
                            ]
                        ],
                        "time_limit" => [
                            [
                                "type" => "TUESDAY",
                                "begin_hour" => 0,
                                "end_hour" => 10,
                                "begin_minute" => 10,
                                "end_minute" => 59
                            ],
                            [
                                "type" => "HOLIDAY"
                            ]
                        ],
                        "business_service" => $business_service,


                    ],

                    strtolower($card_type) => "可兑换音乐木盒一个"
                ]
            ]
        ];
        if(strtolower($card_type)=="general_coupon")
            unset($data['card'][strtolower($card_type)][strtolower($card_type)]);
            $data['card'][strtolower($card_type)]['default_detail'] = "请到店咨询";
        if (empty($description)) {
            unset($data['card'][strtolower($card_type)]['base_info']['description']);
        }
        // if($data['card'][strtolower($card_type)]['advanced_info']['least_cost']<0 ||  ){
        // 	unset($data['card'][strtolower($card_type)]['advanced_info']['use_condition']['least_cost']);
        // }

        $begin_hour = substr($begin_time[0], 0, 2);
        $end_hour = substr($end_time[0], 0, 2);
        $begin_minute = substr($begin_time[0], 3, 2);
        $end_minute = substr($end_time[0], 3, 2);

        $begin_hour_1 = substr($begin_time[1], 0, 2);
        $end_hour_1 = substr($end_time[1], 0, 2);
        $begin_minute_1 = substr($begin_time[1], 3, 2);
        $end_minute_1 = substr($end_time[1], 3, 2);
        if (!empty($limit_type)) {
            foreach ($limit_type as $key => $value) {
                if ($value == MONDAY && empty($begin_time)) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                    ];
                } elseif ($value == MONDAY && !empty($begin_time[0]) && empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];
                } elseif ($value == MONDAY && !empty($begin_time[0]) && !empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];

                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour_1,
                        "end_hour" => $end_hour_1,
                        "begin_minute" => $begin_minute_1,
                        "end_minute" => $end_minute_1
                    ];

                }


                /************************************************************************************/
                if ($value == TUESDAY && empty($begin_time)) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                    ];
                } elseif ($value == TUESDAY && !empty($begin_time[0]) && empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];
                } elseif ($value == TUESDAY && !empty($begin_time[0]) && !empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];

                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour_1,
                        "end_hour" => $end_hour_1,
                        "begin_minute" => $begin_minute_1,
                        "end_minute" => $end_minute_1
                    ];

                }
                /************************************************************************************/
                if ($value == WEDNESDAY && empty($begin_time)) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                    ];
                } elseif ($value == WEDNESDAY && !empty($begin_time[0]) && empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];
                } elseif ($value == WEDNESDAY && !empty($begin_time[0]) && !empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];

                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour_1,
                        "end_hour" => $end_hour_1,
                        "begin_minute" => $begin_minute_1,
                        "end_minute" => $end_minute_1
                    ];
                }
                /************************************************************************************/

                if ($value == THURSDAY && empty($begin_time)) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                    ];
                } elseif ($value == THURSDAY && !empty($begin_time[0]) && empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];
                } elseif ($value == THURSDAY && !empty($begin_time[0]) && !empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];

                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour_1,
                        "end_hour" => $end_hour_1,
                        "begin_minute" => $begin_minute_1,
                        "end_minute" => $end_minute_1
                    ];
                }
                /************************************************************************************/
                if ($value == FRIDAY && empty($begin_time)) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                    ];
                } elseif ($value == FRIDAY && !empty($begin_time[0]) && empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];
                } elseif ($value == FRIDAY && !empty($begin_time[0]) && !empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];

                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour_1,
                        "end_hour" => $end_hour_1,
                        "begin_minute" => $begin_minute_1,
                        "end_minute" => $end_minute_1
                    ];
                }
                /************************************************************************************/
                if ($value == SATURDAY && empty($begin_time)) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                    ];
                } elseif ($value == SATURDAY && !empty($begin_time[0]) && empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];
                } elseif ($value == SATURDAY && !empty($begin_time[0]) && !empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];

                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour_1,
                        "end_hour" => $end_hour_1,
                        "begin_minute" => $begin_minute_1,
                        "end_minute" => $end_minute_1
                    ];
                }
                /************************************************************************************/
                if ($value == SUNDAY && empty($begin_time)) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                    ];
                } elseif ($value == SUNDAY && !empty($begin_time[0]) && empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];
                } elseif ($value == SUNDAY && !empty($begin_time[0]) && !empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];

                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour_1,
                        "end_hour" => $end_hour_1,
                        "begin_minute" => $begin_minute_1,
                        "end_minute" => $end_minute_1
                    ];
                }

            }
        }
        if (empty($least_cost)) {
            unset($data['card'][strtolower($card_type)]['advanced_info']['least_cost']);
        }


        $data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        print_r($data);
        var_dump($this->http_curl($url, $data));
        $message = $this->http_curl($url, $data);
        $card_id = $message['card_id'];
        var_dump($card_id);
        //marker
        $brand_name = "tengfangkeji";
        $notice = "ceshi";
        $base_info = [
            'card_type'=>$card_type,
            'base_id'=>$card_id,
            'sid'=>'1111',
            'logo_url'=>$pic_url,
            'code_type'=>'CODE_TYPE_TEXT',
            'is_swipe_card'=>'true',
            'brand_name'=>$brand_name,
            'title'=>$title,
            'color'=>$color,
            'notice'=>$notice,
            'description'=>$description,
            'quantity'=>$get_limit,
            'type'=>$type,
            'begin_timestamp'=>$begin_timestamp,
            'end_timestamp'=>$end_timestamp,
            'use_custom_code'=>false,
            'service_phone'=>$service_phone,
            'get_limit'=>$get_limit,
            'can_share'=>$share,
        ];
        M('base_info')->add($base_info);
        $advanced_info = [
            'advanced_id'=>$card_id,
            'least_cost'=>$least_cost,
            'can_use_with_other_discount'=>$share,
            'abstract'=>$abstract,
            'icon_url_list'=>'',//没写呢
            'image_url'=>'',//没写呢
            'text'=>'',//没写呢
            'business_service'=>$business_service,
            'type'=>$type,
            'begin_hour'=>$begin_hour,
            'begin_minute'=>$begin_minute,
            'end_hour'=>$end_hour,
            'end_minute'=>$end_minute
        ];

        M('advanced_info')->add($advanced_info);
        switch ($card_type){
            case 'GIFT':
                $data = [
                    'coin_id'=>$card_id,
                    'card_type'=>$card_type
                ];
                M('coin_certificate')->add($data);
                break;
            case 'DISCOUNT':
                $data = [
                    'discount_id'=>$card_id,
                    'card_type'=>$card_type,
                    'discount'=>$discount
                ];
                M('discount_coupon')->add($data);
                break;
            case 'GENERAL_COUPON':
                $data = [
                    'coupon_id'=>$card_id,
                    'card_type'=>$card_type
                ];
                M('coupon')->add($data);
                break;
        }
    }

    public function getAccess_token()
    {
        //缓存access_token的方法
        $access_token = S('access_token');

        if (empty($access_token)) {
            $data = $this->http_curl("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->appid . "&secret=" . $this->appsecret);
            S('access_token', $data['access_token'], 7000);
        }
        return S('access_token');
    }

    function http_curl($url, $data = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($ch);
        curl_close($ch);
        if ($res === false) {
            echo curl_error($ch);
            echo curl_getinfo($ch);
        }
        return json_decode($res, true);
    }

    public function addShop()
    {
        $this->display();
    }

    public function createShop()
    {


        if ($_FILES['shopLogo']['error'] == 0) {

            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Public/uploads/'; // 设置附件上传根目录
            // 上传单个文件
            $info = $upload->uploadOne($_FILES['shopLogo']);

            //echo '/uploads/' . $info['savepath'] . $info['savename'];
            //echo "< img src='" . 'http://' . $_SERVER['HTTP_HOST'] . '/htdocs/public/uploads/' . $info['savepath'] . $info['savename'] . "'>";
            $imaAddress = '/uploads/' . $info['savepath'] . $info['savename'];

            $data = array(
                'media ' => '@' . $_SERVER['DOCUMENT_ROOT'] . '/xhy/Public' . $imaAddress
            );

            $url_img = "https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=" . $this->getAccess_token();
            $url = $this->http_curl($url_img, $data);

        }
        S('logo_url', $url['url']);
        $business_name = I('business_name');
        $branch_name = I('branch_name');
        $province = I('province');
        $city = I('city');
        $district = I('district');
        $address = I('map');
        $telephone = I('telephone');
        $categories = [I('categories')];
        $time_1 = I('time_1');
        $time_2 = I('time_1');
        $open_time = $time_1 . "-" . $time_2;
        $lng = I('lng');
        $lat = I('lat');


        $data = array(
            "business" => array(
                "base_info" => array(
                    "sid" => "",
                    "business_name" => $business_name,
                    "branch_name" => $branch_name,
                    "province" => $province,
                    "city" => $city,
                    "district" => $district,
                    "address" => $address,
                    "telephone" => $telephone,
                    "categories" => $categories,
                    "offset_type" => 1,
                    "longitude" => $lng,
                    "latitude" => $lat,
                    "photo_list" => [
                        array(
                            'photo_url' => $url['url']
                        ),
                        array(
                            "photo_url" => $url['url']
                        )
                    ],
                    "recommend" => "",
                    "special" => "",
                    "introduction" => "",
                    "open_time" => $open_time,
                    "avg_price" => 0
                )
            )
        );
        print_r($data);
        $wechat = D('Wechat');
        $data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $mendian_url = "http://api.weixin.qq.com/cgi-bin/poi/addpoi?access_token=" . $wechat->wx_access_token();
        $message = $this->http_curl($mendian_url, $data);
        var_dump($message);
    }

    public function cate()
    {

        $url = "http://api.weixin.qq.com/cgi-bin/poi/getwxcategory?access_token=" . $this->getAccess_token();
        $file = file_get_contents($url);
        print_r($file);
        file_put_contents('__ROOT__/public/cate.txt', $file);

    }

    public function addMemberCard()
    {
        $this->display();
    }

    public function createMember()
    {
        //auto_activate字段，设置会员卡自动激活
        var_dump($_POST);
        $color = I('baseColor');
        $title = I('title');
        $logo_url = S('logo_url');
        $service_phone = I('service_phone');
        $begin_timestamp = strtotime(I('begin_timestamp'));
        $end_timestamp = strtotime(I('end_timestamp'));
        $begin_time = I('begin_time');
        $end_time = I('end_time');
        $begin_hour = substr($begin_time[0], 0, 2);
        $end_hour = substr($end_time[0], 0, 2);
        $begin_minute = substr($begin_time[0], 3, 2);
        $end_minute = substr($end_time[0], 3, 2);

        $begin_hour_1 = substr($begin_time[1], 0, 2);
        $end_hour_1 = substr($end_time[1], 0, 2);
        $begin_minute_1 = substr($begin_time[1], 3, 2);
        $end_minute_1 = substr($end_time[1], 3, 2);
        $supply_bonus = I('supply_bonus');

        //$discount = I('supply_discount');
        $cost_money_unit = (int)I('cost_money_unit');
        $increase_bonus = (int)I('increase_bonus');//否
        $max_increase_bonus = (int)I('max_increase_bonus');//否
        $cost_bonus_unit = (int)I('cost_bonus_unit');//否
        $reduce_money = I('reduce_money');//否
        $least_money_to_use_bonus = I('least_money_to_use_bonus');//否
        $max_reduce_bonus = I('max_reduce_bonus');//否
        $discount = (int)I('discount');//否
        $prerogative = I('prerogative');
        $type = I('chooseTime');
        $limit_type = I('limit');
        $business_service = I('business_service');
        var_dump($limit_type);

        if ($supply_bonus == true) {
            $supply_bonus = TRUE;
        }
        var_dump($color);
        //pay_info 设置会员卡支付 supply_balance支持储值
        $data = [
            "card" => [
                "card_type" => "MEMBER_CARD",
                "member_card" => [
                    "background_pic_url" => "https://mmbiz.qlogo.cn/mmbiz/",
                    "base_info" => [
                        "pay_info" =>
                        [
                          "swipe_card" =>
                            [
                            "is_swipe_card" => true
                            ]
                        ],
                        "logo_url" => "http://mmbiz.qpic.cn/mmbiz/iaL1LJM1mF9aRKPZ/0",
                        "brand_name" => "海底捞",
                        "code_type" => "CODE_TYPE_TEXT",
                        "title" => "$title",
                        "color" => "$color",
                        "notice" => "使用时向服务员出示此券",
                        "service_phone" => $service_phone,
                        "description" => $description,
                        "date_info" => [
                            "type" => $type,
                            "begin_timestamp" => "$begin_timestamp",
                            "end_timestamp" => "$end_timestamp"
                        ],
                        "sku" => [
                            "quantity" => 50000000
                        ],
                        "get_limit" => 3,
                        "use_custom_code" => false,
                        "can_give_friend" => true,
                        "location_id_list" => [
                            123,
                            12321
                        ],
                        "custom_url_name" => "立即使用",
                        "custom_url" => "http://weixin.qq.com",
                        "custom_url_sub_title" => "6个汉字tips",
                        "promotion_url_name" => "营销入口1",
                        "promotion_url" => "http://www.qq.com",
                        "need_push_on_view" => true
                    ],
                    "advanced_info" => [
                        "use_condition" => [
                            "accept_category" => "鞋类",
                            "reject_category" => "阿迪达斯",
                            "can_use_with_other_discount" => true
                        ],
                        "abstract" => [
                            "abstract" => "微信餐厅推出多种新季菜品，期待您的光临",
                            "icon_url_list" => [
                                "http://mmbiz.qpic.cn/mmbiz/p98FjXy8LacgHxp3sJ3vn97bGLz0ib0Sfz1bjiaoOYA027iasqSG0sj  piby4vce3AtaPu6cIhBHkt6IjlkY9YnDsfw/0"
                            ]
                        ],
                        "text_image_list" => [
                            [
                                "image_url" => "http://mmbiz.qpic.cn/mmbiz/p98FjXy8LacgHxp3sJ3vn97bGLz0ib0Sfz1bjiaoOYA027iasqSG0sjpiby4vce3AtaPu6cIhBHkt6IjlkY9YnDsfw/0",
                                "text" => "此菜品精选食材，以独特的烹饪方法，最大程度地刺激食 客的味蕾"
                            ],
                            [
                                "image_url" => "http://mmbiz.qpic.cn/mmbiz/p98FjXy8LacgHxp3sJ3vn97bGLz0ib0Sfz1bjiaoOYA027iasqSG0sj piby4vce3AtaPu6cIhBHkt6IjlkY9YnDsfw/0",
                                "text" => "此菜品迎合大众口味，老少皆宜，营养均衡"
                            ]
                        ],
                        "time_limit" => [

                            [
                                "type" => "HOLIDAY"
                            ]
                        ],
                        "business_service" => $business_service,
                    ],
                    "supply_bonus" => $supply_bonus,
                    "supply_balance" => true,
                    "prerogative" => "test_prerogative",
                    "auto_activate" => true,
                    "custom_field1" => [
                        "name_type" => "FIELD_NAME_TYPE_LEVEL",
                        "url" => "http://www.qq.com"
                    ],
                    "activate_url" => "http://www.qq.com",
                    "custom_cell1" => [
                        "name" => "使用入口2",
                        "tips" => "激活后显示",
                        "url" => "http://www.xxx.com"
                    ],
                    "bonus_rule" => [
                        "cost_money_unit" => $cost_money_unit,
                        "increase_bonus" => $increase_bonus,
                        "max_increase_bonus" => $max_increase_bonus,
                        "init_increase_bonus" => 10,
                        "cost_bonus_unit" => $cost_bonus_unit,
                        "reduce_money" => $reduce_money,
                        "least_money_to_use_bonus" => $least_money_to_use_bonus,
                        "max_reduce_bonus" => $max_reduce_bonus
                    ],
                    "discount" => $discount
                ]
            ]
        ];
        $card_type = 'member_card';
        if (!empty($limit_type)) {
            foreach ($limit_type as $key => $value) {
                if ($value == MONDAY && empty($begin_time)) {
                    $data['card']['member_card']['advanced_info']['time_limit'][] = [
                        'type' => $value,
                    ];
                } elseif ($value == MONDAY && !empty($begin_time[0]) && empty($begin_time[1])) {
                    $data['card']['member_card']['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];
                } elseif ($value == MONDAY && !empty($begin_time[0]) && !empty($begin_time[1])) {
                    $data['card']['member_card']['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];
                    $data['card']['member_card']['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour_1,
                        "end_hour" => $end_hour_1,
                        "begin_minute" => $begin_minute_1,
                        "end_minute" => $end_minute_1
                    ];

                }


                /************************************************************************************/
                if ($value == TUESDAY && empty($begin_time)) {
                    $data['card']['member_card']['advanced_info']['time_limit'][] = [
                        'type' => $value,
                    ];
                } elseif ($value == TUESDAY && !empty($begin_time[0]) && empty($begin_time[1])) {
                    $data['card']['member_card']['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];
                } elseif ($value == TUESDAY && !empty($begin_time[0]) && !empty($begin_time[1])) {
                    $data['card']['member_card']['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];

                    $data['card']['member_card']['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour_1,
                        "end_hour" => $end_hour_1,
                        "begin_minute" => $begin_minute_1,
                        "end_minute" => $end_minute_1
                    ];

                }
                /************************************************************************************/
                if ($value == WEDNESDAY && empty($begin_time)) {
                    $data['card']['member_card']['advanced_info']['time_limit'][] = [
                        'type' => $value,
                    ];
                } elseif ($value == WEDNESDAY && !empty($begin_time[0]) && empty($begin_time[1])) {
                    $data['card']['member_card']['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];
                } elseif ($value == WEDNESDAY && !empty($begin_time[0]) && !empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];

                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour_1,
                        "end_hour" => $end_hour_1,
                        "begin_minute" => $begin_minute_1,
                        "end_minute" => $end_minute_1
                    ];
                }
                /************************************************************************************/

                if ($value == THURSDAY && empty($begin_time)) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                    ];
                } elseif ($value == THURSDAY && !empty($begin_time[0]) && empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];
                } elseif ($value == THURSDAY && !empty($begin_time[0]) && !empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];

                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour_1,
                        "end_hour" => $end_hour_1,
                        "begin_minute" => $begin_minute_1,
                        "end_minute" => $end_minute_1
                    ];
                }
                /************************************************************************************/
                if ($value == FRIDAY && empty($begin_time)) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                    ];
                } elseif ($value == FRIDAY && !empty($begin_time[0]) && empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];
                } elseif ($value == FRIDAY && !empty($begin_time[0]) && !empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];

                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour_1,
                        "end_hour" => $end_hour_1,
                        "begin_minute" => $begin_minute_1,
                        "end_minute" => $end_minute_1
                    ];
                }
                /************************************************************************************/
                if ($value == SATURDAY && empty($begin_time)) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                    ];
                } elseif ($value == SATURDAY && !empty($begin_time[0]) && empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];
                } elseif ($value == SATURDAY && !empty($begin_time[0]) && !empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];

                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour_1,
                        "end_hour" => $end_hour_1,
                        "begin_minute" => $begin_minute_1,
                        "end_minute" => $end_minute_1
                    ];
                }
                /************************************************************************************/
                if ($value == SUNDAY && empty($begin_time)) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                    ];
                } elseif ($value == SUNDAY && !empty($begin_time[0]) && empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];
                } elseif ($value == SUNDAY && !empty($begin_time[0]) && !empty($begin_time[1])) {
                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour,
                        "end_hour" => $end_hour,
                        "begin_minute" => $begin_minute,
                        "end_minute" => $end_minute
                    ];

                    $data['card'][strtolower($card_type)]['advanced_info']['time_limit'][] = [
                        'type' => $value,
                        "begin_hour" => $begin_hour_1,
                        "end_hour" => $end_hour_1,
                        "begin_minute" => $begin_minute_1,
                        "end_minute" => $end_minute_1
                    ];
                }

            }
        }

        if (!$discount) {
            unset($data['card']['member_card']['discount']);
        }
        print_r($data);
        $data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $url = "https://api.weixin.qq.com/card/create?access_token=" . $this->getAccess_token();
        $message = $this->http_curl($url, $data);

        print_r($message);
    }

    public function memberManage()
    {
        $this->display();
    }

    public function memberFiles()
    {
        $data = M('user');
        $res = $data->field('username,	member_level,birthday,phone_number,openid')->select();

        if ($res['member_level'] = 1) {
            $res[0]['member_level'] = "超级会员";
        }
//		var_dump($res);
        $this->assign('res', $res);
        $this->display();
    }

    public function memberMsg()
    {
        $sid = I('get.openid');
        $user = M('user');
        $res = $user->field('username,sex,phone_number,member_level,birthday,card_id')->select();
        if ($res[0]['member_level'] == 1) {
            $res[0]['member_level'] = "超级会员";
        }
//		var_dump($res);
        $this->assign('res', $res);
        $this->display();
    }


    public function memberRechange()
    {
        //会员充值记录
        $recharge_record = M('recharge_record');
        $res = $recharge_record->field('recharge_amount,current_balance,recharge_time,name')->select();
//		var_dump($res);
        $this->assign('res', $res);
        $this->display();

    }

    public function memberPay()
    {
        $consumption_details = M('consumption_details');
        $res = $consumption_details->field('name,consumption_time,consumption_balance,card_type')->select();
        $this->assign('res', $res);
        $this->display();
    }

    public function memberRank()
    {

        $this->display();
    }

    public function memberRecord()
    {

        // $record_sql="SELECT rr.recharge_time,rr.name,cd.consumption_balance,cd.modify_bonus,(rr.integral_balance+cd.modify_bonus) AS last_record,ABS(cd.modify_bonus) as con_money  FROM consumption_details cd
        // LEFT JOIN recharge_record rr ON cd.openid=rr.openid AND cd.card_id=rr.card_id WHERE cd.openid='123321'
        // ORDER BY cd.consumption_time desc
        // ";
        //会员积分记录
        $record_sql = "select cd.name,cd.consumption_time,cd.consumption_balance,cd.modify_bonus,rr.integral_balance from consumption_details cd 
  left join recharge_record rr on rr.user_card_code=cd.user_card_code
  left join card_information ci on ci.card_id=cd.user_card_code
    where ci.sid='1234234'";
//积分兑换记录
        $change_sql = "select cd.name,cd.consumption_time,cd.modify_bonus,gi.gift_name,rr.integral_balance from consumption_details cd 
  left join card_information ci on ci.card_id=cd.user_card_code
  left join gift_info gi on gi.sid=ci.sid 
  left join recharge_record rr on rr.user_card_code=cd.user_card_code 
   where ci.sid='1234234'";

        $result = D('')->query($record_sql);
        $res = D()->query($change_sql);

        $this->assign('res', $res);
        //var_dump($result);
        $this->assign('result', $result);
        $this->display();
    }

    public function memberCenter()
    {
        $user_card_info = M('user');
        $openid = "156412q43wdas";
        //缓存openid
        $result = $user_card_info->field('card_id')->where('	openid = "' . $openid . '"')->select();
        S('sid', $result[0]['sid']);
        $user_card_code = $result[0]['card_id'];
        S('user_card_code', $user_card_code);

        $this->assign('result', $result);
        $this->display();
    }

    public function memberPrivilege()
    {
        $this->display();
    }

    public function exchangeShop()
    {
        $recharge_record = M('recharge_record');
        $openid = "156412q43wdas";
        //缓存openid
        $result = $recharge_record->field('integral_balance')->where('	openid = "' . $openid . '"')->select();
        // var_dump($result);
        $this->assign('result', $result);
        $this->display();
    }

    public function exchangeRecord()
    {
        $this->display();
    }

        public function payExchange()
    {
        $consumption_details = M('consumption_details');
        $openid = "21scdaxasda";
        $result = $consumption_details->field('consumption_time,consumption_balance,modify_bonus')->select();
        $this->assign('result', $result);


        $this->display();
    }

    public function coupon()
    {
        $this->display();
    }

    public function applyShop()
    {
        $sid = S('sid');
        $sid = "1";
        $store_info = M('store_info');
        $result = $store_info->field('business_name,province,city,district,address,telephone')->where('sid = "' . $sid . '"')->select();
        $this->assign('result', $result);
        $this->display();
    }

    public function sign()
    {
        $openid = "1237";
        $user = M('user');
        $result = $user->field('nickname,headimgurl')->where('openid = "' . $openid . '"')->select();
        $res = M('recharge_record')->field('integral_balance')->where('openid = "' . $openid . '"')->select();
        $this->assign(['result' => $result, 'res' => $res]);
        $this->display();
    }

    public function sign_info()
    {
        $user_card_code = S('user_card_code');
        $openid = "1237";
        $sid = S('sid');
        $date = date('Y-m-d');
        $today = substr($date, 0, 10);
        $res = M('sign_info')->field('user_card_code')->where('sign_date = "' . $today . '"')->select();
        if ($res) {
            echo "111";
            return false;
        } else {
            $data['sid'] = $sid;
            $data['openid'] = $openid;
            $data['user_card_code'] = $user_card_code;
            $data['sign_date'] = $date;
            var_dump($data);
            $res = M('sign_info')->add($data);
            var_dump($res);
            echo "222";
        }
        //select 1 from sign_info where user_card_code = $user_card_code and sign_date =
    }

    public function cardManage()
    {
        //卡券管理
        $record_sql = "select ci.card_id,bi.base_status from card_information ci 
   LEFT JOIN base_info bi on bi.base_id = ci.card_id 
   WHERE bi.base_status = 'card_pass_check'";
        $result = D('')->query($record_sql);
        $card_id = $result[0]['card_id'];
        $event = $result[0]['base_status'];
        if($event == "card_pass_check"){
            $event = "待投放";
        }
        $this->assign(['card_id'=>$card_id,'event'=>$event]);
        $this->display();
    }

        public function shopManage()
    {
		/*
		*sid 是门店id，需要写一个方法 保证sid唯一性
		*/
		
        $record_sql = "select si.sid,si.poi_id,si.business_name,si.city,si.district,si.address,ssi.open_time,ssi.photo_list from store_info si 
   LEFT JOIN store_service_info ssi on ssi.sid = si.sid where ssi.sid = si.sid";
        $res = D()->query($record_sql);
		$this->assign('res',$res);
        $this->display();
    }

    public function rec()
    {
        require("token.php");
        $wx = new \WeiXinConfirm();

        $wx->valid();

        $postStr = isset($GLOBALS["HTTP_RAW_POST_DATA"]) ? $GLOBALS["HTTP_RAW_POST_DATA"] : "";
        if (!empty($postStr)) {
            //解析xml
            $postObj = json_decode(json_encode(simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
            switch ($postObj['Event']){
                case "subscribe":
                /*
                 * 关注时拉取用户信息，存入user表
                 */
                    $openid = $postObj['FromUserName'];
                    $access_token = D('Wechat')->wx_access_token();
                    $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN ";
                    $res = file_get_contents($url);
                    $res = json_decode($res,true);

                    M('user')->add($res);
                break;
                case "unsubscribe":
                    /*
                     * 取消关注在user表里改 subscribe字段状态
                     */
                    $openid = $postObj['FromUserName'];
                    $data = [
                        'subscribe'=>'0'
                    ];
                    M('user')->where('	openid = "' . $openid . '"')->save($data);
                break;
                case "card_pass_check":
                    $Event = $postObj['z'];
                    $CardId = $postObj['CardId'];
                    $data['base_status'] = $Event;
                    M('base_info')->where('	base_id = "' . $CardId . '"')->save($data);
                    $data['xml'] = $postStr;
                    $data['xml_load'] = serialize($postObj);
                    //unserialize($data['xml_load']);
                    M('xml')->add($data);
                break;
                case "card_not_pass_check":
                    $Event = $postObj['z'];
                    $CardId = $postObj['CardId'];
                    $data['base_status'] = $Event;
                    M('base_info')->where('	base_id = "' . $CardId . '"')->save($data);
                    $data['xml'] = $postStr;
                    $data['xml_load'] = serialize($postObj);
                    //unserialize($data['xml_load']);
                    M('xml')->add($data);
                break;
                case "user_get_card":
                    /*
                     * 用户领取卡券 返回code
                     */
                    $code = $postObj['UserCardCode'];
                    $data['code'] = $code;
                    $CardId = $postObj['CardId'];
                    M('base_info')->where('	base_id = "' . $CardId . '"')->save($data);
                break;

            }
//            if($postObj['Event'] == "subscribe"){
//                /*
//                 * 关注时拉取用户信息，存入user表
//                 */
//                $openid = $postObj['FromUserName'];
//                $access_token = D('Wechat')->wx_access_token();
//                $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN ";
//                $res = file_get_contents($url);
//                $res = json_decode($res,true);
//
//                M('user')->add($res);
//            }elseif ($postObj['Event'] == "unsubscribe"){
//                /*
//                 * 取消关注在user表里改 subscribe字段状态
//                 */
//                $openid = $postObj['FromUserName'];
//                $data = [
//                    'subscribe'=>'0'
//                ];
//                M('user')->where('	openid = "' . $openid . '"')->save($data);
//            }
//            $Event = $postObj['z'];
//            $CardId = $postObj['CardId'];
////            $data_status = [
////                "event" => $Event,
////                "card_id" => $CardId
////            ];
//            //将卡券的id，卡券审核结果的状态存入表中
//            $data['base_status'] = $Event;
//            M('base_info')->where('	base_id = "' . $CardId . '"')->save($data);
//            $data['xml'] = $postStr;
//            $data['xml_load'] = serialize($postObj);
//            //unserialize($data['xml_load']);
//            M('xml')->add($data);

        }
    }

    public function xml()
    {
        //测试
        $openid = "oGcQ7wTdkUrYqYhxVSjYFpjd6wRo";
       $access_token = D('Wechat')->wx_access_token();
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN ";
        $res = file_get_contents($url);
        $res = json_decode($res,true);
        var_dump($res);
    }

    /*******************************************************
     * 微信卡券：设置白名单
     *******************************************************/
    public function wxCardWhiteList()
    {
        $wechat = D('Wechat');
        $wxAccessToken = $wechat->wx_access_token();
        //$openid = $this->GetOpenid();
        $data = [
            "username" => "jian111"

        ];
        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $url = "https://api.weixin.qq.com/card/testwhitelist/set?access_token=" . $wxAccessToken;

        $result = $this->http_curl($url, $jsonData);
        $jsoninfo = json_decode($result, true);
        var_dump($result);
        return $jsoninfo;
    }

    public function readBarcode()
    {
        /*
         * 会员卡投放、普通卡券投放
         * 需要传入card_id
         * 扫码领取二维码
         */
        $card_id = $_GET['card_id'];
        Vendor('WxpayAPI.lib.WxPayApi');
        Vendor('WxpayAPI.example.WxPayJsApi');
        Vendor('WxpayAPI.lib.WxPayConfig');
        $wechat = D('Wechat');
        $tools = new \WxPayJsApi();
        $openId = $tools->GetOpenid();

        $data = [
            "action_name" => "QR_CARD",
            "expire_seconds" => 1800,
            "action_info" => [
                "card" => [
                    "card_id" => "$card_id",
                    "code" => "",
                    "openid" => $openId,
                    "is_unique_code" => false,
                ]
            ]
        ];
        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $url = "https://api.weixin.qq.com/card/qrcode/create?access_token=" . $wechat->wx_access_token();
        $info = $this->http_curl($url, $jsonData);
        var_dump($info['ticket']);
        $url_ticket = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" . UrlEncode($info['ticket']);
        var_dump($url_ticket);

        header("location:" . $url_ticket);
    }
    public function updateUser(){
        /*
         * 更新会员卡信息
         * HTTP请求方式: POST
         * URL:https://api.weixin.qq.com/card/membercard/updateuser?access_token=TOKEN
         * 将几个参数传入，调用接口更新
         */
        $card_id = "";

        $data = [
            "code" => "$code",
            "card_id" => "$card_id",
            "background_pic_url" => "https://mmbiz.qlogo.cn/mmbiz/0?wx_fmt=jpeg",
            "record_bonus" => "消费30元，获得3积分",
            "bonus" => 3000,
            "add_bonus" => 30,
            "balance" => 3000,
            "add_balance" => -30,
            "record_balance" => "购买焦糖玛琪朵一杯，扣除金额30元。",
            "custom_field_value1" => "xxxxx",
            "custom_field_value2"=> "xxxxx",
            "notify_optional"=> [
            "is_notify_bonus" => true,
            "is_notify_balance" => true,
            "is_notify_custom_field1" => true
        ]
];

    }
    public function member_card_Recharge(){
        /*
         * 会员卡充值
         */
        Vendor('WxpayAPI.lib.WxPayApi');
        Vendor('WxpayAPI.example.WxPayJsApi');
        Vendor('WxpayAPI.lib.WxPayConfig');
        $tools = new \WxPayJsApi();
        $openId = $tools->GetOpenid();
        $result = M('recharge_record')->field('user_card_code,sid,name,current_balance,integral_balance')->where('	openid = "' . $openId . '"')->select();
        $user_card_code = $result[0]['user_card_code'];
        $name = $result[0]['name'];
        $recharge_amount = I('recharge_amount');//单次充值金额
        $current_balance = $result[0]['current_balance'] + $recharge_amount;//余额
        $recharge_time = time();
        $integral_balance = $result[0]['integral_balance'] + (int)$recharge_amount/10;//积分余额
        $data = [
            'openid'=>$openId,
            'name' =>$name,
            'user_card_code'=>$user_card_code,
            'recharge_amount'=>$recharge_amount,
            'current_balance'=>$current_balance,
            'recharge_time'=>$recharge_time,
            'integral_balance'=>$integral_balance
        ];
        M('recharge_record')->add($data);
    }
    public function consumption_details(){
        /*
         * 会员消费明细
         */
        $sid = "";
        Vendor('WxpayAPI.lib.WxPayApi');
        Vendor('WxpayAPI.example.WxPayJsApi');
        Vendor('WxpayAPI.lib.WxPayConfig');
        $tools = new \WxPayJsApi();
        $openId = $tools->GetOpenid();
        $user_card_code = "";
        $consumption_time = time();
        $consumption_balance = I('consumption_balance');//当前消费金额
        $modify_bonus = (int)$consumption_balance/10;//积分变动 消费为增长积分 为正整数
        $base_id = "";//可以为空
        $gift_id = "";//如果未兑换礼品 为空
        $data = [
            'sid'=>$sid,
            'openid'=>$openId,
            'user_card_code'=>$user_card_code,
            'consumption_time'=>$consumption_time,
            'consumption_balance'=>$consumption_balance,
            'card_type'=>$card_type,
            'modify_bonus'=>$modify_bonus,
            'base_id'=>$base_id,
            'gift_id'=>$gift_id
        ];
        M('consumption_details')->add($data);

    }
    public function couponFunction(){
        $result = M('base_info')->field('base_id,card_type,begin_timestamp,end_timestamp')->select();

        foreach ($result as $key=>$val){
            if($val['end_timestamp']>time()){
                $result[$key]['status'] = "已过期";
            }else{
                $result[$key]['status'] = "已过期";
            }
            switch ($val['card_type']){
                case "GIFT":
                    $result[$key]['card_type'] = "兑换券";
                    break;
                case "GENERAL_COUPON":
                    $result[$key]['card_type'] = "优惠券";
                    break;
                case "DISCOUNT":
                    $result[$key]['card_type'] = "折扣券";

            }

        }

        $this->assign('res',$result);
        $this->display();
    }
    public function shop_delete(){
        $wechat = D('Wechat');
        $url = "https://api.weixin.qq.com/cgi-bin/poi/delpoi?access_token=".$wechat->wx_access_token;
        $poi_id = $_GET['poi_id'];
        $data = [
            'poi_id'=>$poi_id
        ];
        $data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $this->http_curl($url,$data);
    }
    public function change_card_type(){
        $card_type = $_POST['card_type'];

        if($card_type == "ALL" || $card_type==""){
            switch($card_type){
                case "ALL":
                    $result = M('base_info')->field('base_id,card_type,begin_timestamp,end_timestamp')->select();
                    $this->ajaxReturn($result);
                    break;
                case "":
                    $result = "";
                    $this->ajaxReturn($result);
                    break;
            }
        }
        $result = M('base_info')->field('base_id,card_type,begin_timestamp,end_timestamp')->where('	card_type = "' . $card_type . '"')->select();
        $this->ajaxReturn($result);
    }
    public function register(){
        $this->display();
    }
    public function register_act(){
        Vendor('WxpayAPI.lib.WxPayApi');
        Vendor('WxpayAPI.example.WxPayJsApi');
        Vendor('WxpayAPI.lib.WxPayConfig');
        $tools = new \WxPayJsApi();
        $openId = $tools->GetOpenid();
        $result = M('user')->field('subscribe')->where('	openid = "' . $openId . '"')->select();
        $name = I('nickName');
        $sex = I('sex');
        $birthday = I('birthday');
        $phone = I('phone');

        if($result[0]['subscribe'] == '0'){
            return "您没有关注";
        }else{
            $data = [
                'nickname'=>$name,
                'sex'=>$sex,
                'birthday'=>$birthday,
                'phone_number'=>$phone
            ];
            M('user')->where('	openid = "' . $openId . '"')->save($data);
        }
        $this->display();
    }

}