/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2017/9/27 星期三 下午 12:58:55                    */
/*==============================================================*/


drop table if exists advanced_info;

drop table if exists app_info;

drop table if exists base_info;

drop table if exists card_information;

drop table if exists carte_info;

drop table if exists cash_coupon;

drop table if exists coin_certificate;

drop table if exists consumption_details;

drop table if exists coupon;

drop table if exists discount_coupon;

drop table if exists gift_info;

drop table if exists meal_info;

drop table if exists meal_usage;

drop index IDX_ORDER_INFO_ORDER_ID on order_info;

drop table if exists order_info;

drop table if exists order_number;

drop table if exists queue_number;

drop table if exists recharge_record;

drop table if exists session_info;

drop table if exists sign_info;

drop table if exists store_info;

drop table if exists store_service_info;

drop table if exists sys_user;

drop table if exists throw_in_coupons;

drop table if exists user;

drop index IDX_USER_CARD_INFO_ID on user_card_info;

drop table if exists user_card_info;

drop table if exists user_permission;

/*==============================================================*/
/* Table: advanced_info                                         */
/*==============================================================*/
create table advanced_info
(
   advanced_id          varchar(30) not null,
   advanced_info        varchar(200),
   use_condition        varchar(200),
   accept_category      varchar(512),
   reject_category      varchar(512),
   least_cost           int,
   object_use_for       varchar(512),
   can_use_with_other_discount tinyint(1),
   abstract_name        varchar(200),
   abstract             varchar(24),
   icon_url_list        varchar(128),
   text_image_list      varchar(200),
   image_url            varchar(128),
   text                 varchar(512),
   business_service     varchar(30),
   time_limit           varchar(200),
   type                 varchar(24),
   begin_hour           int,
   begin_minute         int,
   end_hour             int,
   end_minute           int,
   primary key (advanced_id)
);

/*==============================================================*/
/* Table: app_info                                              */
/*==============================================================*/
create table app_info
(
   sid                  varchar(10) not null,
   appid                varchar(50) not null,
   appsecret            varchar(200) not null,
   app_label            varchar(1) not null,
   primary key (appid)
);

/*==============================================================*/
/* Table: base_info                                             */
/*==============================================================*/
create table base_info
(
   base_id              varchar(30) not null,
   sid                  varchar(10) not null,
   logo_url             blob not null,
   code_type            varchar(16) not null,
   pay_info             varchar(200),
   swipe_card           varchar(200),
   is_swipe_card        tinyint(1),
   is_pay_and_qrcode    tinyint(1),
   brand_name           varchar(24) not null,
   title                varchar(18) not null,
   color                varchar(8) not null,
   notice               varchar(32) not null,
   description          varchar(2048) not null,
   sku                  varchar(200) not null,
   quantity             int not null,
   date_info            varchar(200) not null,
   type                 varchar(20) not null,
   begin_timestamp      int,
   end_timestamp        int,
   fixed_term           int,
   fixed_begin_term     int,
   use_custom_code      tinyint(1),
   bind_openid          tinyint(1),
   service_phone        varchar(24),
   location_id_list     varchar(200),
   use_all_locations    tinyint(1),
   center_title         varchar(18),
   center_sub_title     varchar(24),
   center_url           varchar(128),
   custom_url_name      varchar(15),
   custom_url           varchar(128),
   custom_url_sub_title varchar(18),
   promotion_url_name   varchar(15),
   promotion_url        varchar(128),
   promotion_url_sub_title varchar(18),
   get_limit            int,
   can_share            tinyint(1),
   can_give_friend      tinyint(1),
   need_push_on_view    tinyint(1),
   get_custom_code_mode varchar(32),
   center_app_brand_user_name varchar(128),
   center_app_brand_pass varchar(128),
   custom_app_brand_user_name varchar(128),
   custom_app_brand_pass varchar(128),
   promotion_app_brand_user_name varchar(128),
   promotion_app_brand_pass varchar(128),
   use_limit            int,
   primary key (base_id)
);

/*==============================================================*/
/* Table: card_information                                      */
/*==============================================================*/
create table card_information
(
   card_id              int not null,
   sid                  varchar(10) not null,
   card_state           varchar(20) not null,
   delete_card_state    varchar(1) not null,
   card_code            varchar(32),
   card_type            varchar(30) not null,
   background_pic_url   varchar(128),
   prerogative          varchar(3072) not null,
   auto_activate        tinyint(1),
   wx_activate          tinyint(1),
   supply_bonus         tinyint(1) not null,
   bonus_url            varchar(128),
   supply_balance       tinyint(1) not null,
   balance_url          varchar(128),
   custom_field1        varchar(200),
   custom_field2        varchar(200),
   custom_field3        varchar(200),
   name_type            varchar(24),
   field_name           varchar(24),
   field_url            varchar(128),
   bonus_cleared        varchar(128),
   bonus_rules          varchar(128),
   balance_rules        varchar(128),
   activate_url         varchar(128),
   activate_app_brand_user_name varchar(128),
   activate_app_brand_pass varchar(128),
   custom_cell1         varchar(200),
   inlet_name           varchar(15) not null,
   inlet_tips           varchar(18) not null,
   inlet_url            varchar(128) not null,
   bonus_rule           varchar(200),
   cost_money_unit      int,
   increase_bonus       int,
   max_increase_bonus   int,
   init_increase_bonus  int,
   cost_bonus_unit      int,
   reduce_money         int,
   least_money_to_use_bonus int,
   max_reduce_bonus     int,
   discount             int,
   primary key ()
);

/*==============================================================*/
/* Table: carte_info                                            */
/*==============================================================*/
create table carte_info
(
   menu_id              int not null comment '菜品ID',
   sid                  varchar(10) not null comment '商户ID',
   menu_name            varchar(30) not null comment '菜品名称',
   menu_pag_url         varchar(200) not null comment '菜品图片地址',
   unit_price           double not null comment '单价',
   menu_type            varchar(20) not null comment '菜品类型',
   primary key (menu_id, sid)
);

/*==============================================================*/
/* Table: cash_coupon                                           */
/*==============================================================*/
create table cash_coupon
(
   cash_id              int not null,
   base_id              varchar(30) not null,
   card_type            varchar(24) not null,
   base_info            varchar(200) not null,
   least_cost           int not null,
   reduce_cost          int not null,
   primary key (cash_id)
);

/*==============================================================*/
/* Table: coin_certificate                                      */
/*==============================================================*/
create table coin_certificate
(
   coin_id              int not null,
   base_id              varchar(30) not null,
   card_type            varchar(24) not null,
   base_info            varchar(200) not null,
   gift                 varchar(3072) not null,
   primary key (coin_id)
);

/*==============================================================*/
/* Table: consumption_details                                   */
/*==============================================================*/
create table consumption_details
(
   consumption_id       int not null,
   sid                  varchar(10) not null,
   openid               varchar(32) not null,
   user_card_code       varchar(32) not null,
   consumption_time     timestamp not null,
   consumption_balance  double not null,
   card_type            varchar(24),
   modify_bonus         int,
   base_id              varchar(200),
   gift_id              int,
   primary key (consumption_id)
);

/*==============================================================*/
/* Table: coupon                                                */
/*==============================================================*/
create table coupon
(
   coupon_id            int not null,
   base_id              varchar(30) not null,
   card_type            varchar(24) not null,
   base_info            varchar(200) not null,
   default_detail       varchar(3072) not null,
   primary key (coupon_id)
);

/*==============================================================*/
/* Table: discount_coupon                                       */
/*==============================================================*/
create table discount_coupon
(
   discount_id          int not null,
   base_id              varchar(30) not null,
   card_type            varchar(24) not null,
   base_info            varchar(200) not null,
   discount             int not null,
   primary key (discount_id)
);

/*==============================================================*/
/* Table: gift_info                                             */
/*==============================================================*/
create table gift_info
(
   gift_id              int not null,
   sid                  varchar(10) not null,
   gift_name            varchar(50) not null,
   gift_url             varchar(200) not null,
   gift_bonus           int not null,
   gift_type            varchar(1) not null,
   primary key (gift_id)
);

/*==============================================================*/
/* Table: meal_info                                             */
/*==============================================================*/
create table meal_info
(
   sid                  varchar(10) not null,
   table_id             varchar(2) not null,
   table_name           varchar(20),
   person_count         int not null,
   table_type           varchar(1) not null,
   is_order             varchar(1) not null,
   primary key (sid, table_id)
);

/*==============================================================*/
/* Table: meal_usage                                            */
/*==============================================================*/
create table meal_usage
(
   sid                  varchar(10) not null,
   table_id             varchar(2) not null,
   is_order             varchar(1) not null,
   order_time           timestamp,
   state                varchar(1) not null,
   primary key (sid, table_id)
);

/*==============================================================*/
/* Table: order_info                                            */
/*==============================================================*/
create table order_info
(
   order_id             int not null,
   sid                  varchar(10) not null,
   table_id             varchar(2) not null,
   pay_time             date not null,
   is_discount          varchar(1) not null,
   discount_type        varchar(1) not null,
   money                double not null,
   pay_money            double not null,
   user_card_code       varchar(32),
   open_id              varchar(32) not null,
   out_trade_no         varchar(32) not null,
   return_cache         varchar(200),
   trade_state          varchar(20) not null,
   transaction_id       varchar(32),
   primary key (order_id)
);


/*==============================================================*/
/* Table: order_number                                          */
/*==============================================================*/
create table order_number
(
   order_id             bigint not null,
   sid                  varchar(10) not null,
   openid               varchar(32) not null,
   table_id             varchar(2) not null,
   phone_number         varchar(11) not null,
   person_count         int not null,
   table_type           varchar(1) not null,
   order_time           timestamp not null,
   order_state          varchar(1) not null,
   primary key (order_id)
);

/*==============================================================*/
/* Table: queue_number                                          */
/*==============================================================*/
create table queue_number
(
   queue_id             bigint not null,
   sid                  varchar(10) not null,
   openid               varchar(32) not null,
   phone_number         varchar(11) not null,
   person_count         int not null,
   table_type           varchar(2) not null,
   start_time           date not null,
   end_time             date,
   state                varchar(1) not null,
   name                 varchar(30) not null,
   sex                  varchar(1) not null,
   order_remark         varchar(500),
   primary key (queue_id)
);

/*==============================================================*/
/* Table: recharge_record                                       */
/*==============================================================*/
create table recharge_record
(
   recharge_id          int not null,
   openid               varchar(32) not null,
   user_card_code       varchar(32) not null,
   name                 varchar(40) not null,
   recharge_amount      double not null,
   current_balance      double not null,
   recharge_time        timestamp not null,
   integral_balance     int,
   primary key (recharge_id)
);

/*==============================================================*/
/* Table: session_info                                          */
/*==============================================================*/
create table session_info
(
   appid                varchar(50) not null,
   access_token         varchar(200) not null,
   create_time          timestamp not null,
   primary key (appid, create_time)
);

/*==============================================================*/
/* Table: sign_info                                             */
/*==============================================================*/
create table sign_info
(
   sign_id              int not null,
   openid               varchar(32) not null,
   sid                  varchar(10) not null,
   user_card_code       varchar(32) not null,
   sign_date            date not null,
   primary key (sign_id)
);

/*==============================================================*/
/* Table: store_info                                            */
/*==============================================================*/
create table store_info
(
   sid                  varchar(10) not null,
   mer_id               varchar(8) not null,
   poi_id               varchar(9) not null,
   business_name        varchar(30) not null,
   branch_name          varchar(40) not null,
   province             varchar(20) not null,
   city                 varchar(20) not null,
   district             varchar(20) not null,
   address              varchar(200) not null,
   telephone            varchar(20) not null,
   categories           varchar(200) not null,
   offset_type          varchar(1) not null,
   longitude            decimal(14.10) not null,
   latitude             decimal(14.10) not null,
   primary key (sid)
);

/*==============================================================*/
/* Table: store_service_info                                    */
/*==============================================================*/
create table store_service_info
(
   sid                  varchar(10) not null,
   photo_list           varchar(200),
   recommend            varchar(400),
   special              varchar(100),
   introduction         varchar(600),
   open_time            varchar(16),
   avg_price            int,
   primary key (sid)
);

/*==============================================================*/
/* Table: sys_user                                              */
/*==============================================================*/
create table sys_user
(
   sys_user_openid      varchar(32) not null,
   sid                  varchar(10) not null,
   sys_nickname         varchar(20) not null,
   sys_user_name        varchar(30) not null,
   sys_user_sex         varchar(2) not null,
   sys_user_birthday    date not null,
   sys_phone_number     varchar(11) not null,
   sys_user_headimgurl  varchar(200) not null,
   sys_attention_time   datetime not null,
   sys_user_level       varchar(1) not null,
   sys_user_position    varchar(20),
   sys_user_remark      varchar(200),
   primary key (sys_user_openid)
);

/*==============================================================*/
/* Table: throw_in_coupons                                      */
/*==============================================================*/
create table throw_in_coupons
(
   code                 varchar(20) not null,
   base_id              varchar(30) not null,
   openid               varchar(32),
   expire_seconds       int,
   is_unique_code       tinyint(1),
   outer_id             int,
   outer_str            varchar(128),
   primary key (code)
);

/*==============================================================*/
/* Table: user                                                  */
/*==============================================================*/
create table user
(
   subscribe            varchar(2) not null comment '关注标识',
   openid               varchar(32) not null comment '用户标识',
   card_id              varchar(0) comment 'int',
   nickname             varchar(20) not null comment '昵称',
   username             varchar(30) not null comment '用户姓名',
   birthday             date not null comment '用户生日',
   member_identifying   varchar(1) not null comment '会员标识',
   member_level         varchar(1) not null comment '会员等级',
   phone_number         varchar(11) not null comment '手机号码',
   sex                  varchar(2) not null comment '性别',
   country              varchar(30) not null comment '国家',
   province             varchar(20) not null comment '省份',
   city                 varchar(20) not null comment '城市',
   language             varchar(20) not null comment '用户语言',
   headimgurl           varchar(200) not null comment '头像',
   subscribe_time       date not null comment '关注时间',
   unionid              varchar(20) not null comment '公众号开放平台ID',
   remark               varchar(200) comment '备注',
   groupid              varchar(10) not null comment '用户组',
   tagid_list           varchar(20) not null comment '用户标签',
   primary key (openid)
);

/*==============================================================*/
/* Table: user_card_info                                        */
/*==============================================================*/
create table user_card_info
(
   id                   int not null,
   openid               varchar(32) not null,
   base_id              varchar(30) not null,
   sid                  varchar(10) not null,
   user_card_code       varchar(32),
   to_username          varchar(32) not null,
   from_username        varchar(32) not null,
   create_time          varchar(20) not null,
   msgtype              tinyint(1) not null,
   event                varchar(20) not null,
   cardid               varchar(32) not null,
   refuse_reason        varchar(200),
   is_give_by_friend    tinyint(1) not null,
   friend_username      varchar(32),
   old_user_card_code   varchar(32),
   outer_str            varchar(200) not null,
   is_restoremember_card tinyint(1) not null,
   is_return_back       tinyint(1),
   is_chat_room         tinyint(1) not null,
   Consume_source       varchar(20),
   location_name        varchar(20),
   staff_openid         varchar(32),
   verify_code          varchar(6),
   remark_amount        double,
   outerstr             varchar(20),
   trans_id             varchar(20),
   location_id          varchar(10),
   fee                  double,
   original_fee         double,
   modify_bonus         int,
   modify_balance       int,
   detail               varchar(200),
   status               varchar(30),
   create_order_time    timestamp,
   pay_finish_time      timestamp,
   is_desc              varchar(1),
   free_coin_count      int,
   pay_coin_count       int,
   refund_free_coin_count int,
   refund_pay_coin_count int,
   order_type           varchar(20),
   memo                 varchar(200),
   receipt_info         varchar(200),
   primary key (id)
);


/*==============================================================*/
/* Table: user_permission                                       */
/*==============================================================*/
create table user_permission
(
   sid                  varchar(10) not null,
   sys_user_level       varchar(1) not null,
   sys_user_levelname   varchar(20) not null,
   primary key (sys_user_level, sid)
);