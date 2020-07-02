--------------------堂扫退菜与打印----------------------------------------------
CREATE TABLE `pigcms_foodshop_refund_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `detail_id` int(10) unsigned NOT NULL COMMENT '订单的商品详情对应的ID',
  `order_id` int(10) unsigned NOT NULL COMMENT '订单ID',
  `host_goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '附属商品关联的主商品ID 主商品为0',
  `uniqueness_number` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goods_id` int(10) unsigned NOT NULL COMMENT '商品ID',
  `refund_id` int(10) unsigned NOT NULL COMMENT '店铺ID',
  `name` varchar(38) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `unit` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num` smallint(6) NOT NULL DEFAULT '1' COMMENT '数量',
  `spec` varchar(268) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_time` int(10) unsigned NOT NULL COMMENT '下单创建时间',
  `spec_id` varchar(66) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(66) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `refund_id` (`refund_id`),
  KEY `detail_id` (`detail_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='堂食单个商品退单详情';

CREATE TABLE `pigcms_foodshop_order_refund` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `staff_id` int(10) unsigned NOT NULL COMMENT '店员id',
  `price` decimal(8,2) NOT NULL COMMENT '退款金额',
  `merchant_money` decimal(8,2) NOT NULL COMMENT '商户抵扣金额',
  `reason` varchar(66) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL COMMENT '退款状态(0:未退款，1：已退款)',
  `create_time` int(10) unsigned NOT NULL COMMENT '申请时间',
  `refund_time` int(10) unsigned NOT NULL COMMENT '申请时间',
  `payment_money` decimal(10,2) NOT NULL COMMENT '本次退在线支付的金额',
  `balance_pay` decimal(10,2) NOT NULL COMMENT '本次退余额支付的金额',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='堂食单个商品退款';

alter TABLE `pigcms_foodshop_order_detail` add column `refundNum` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '退款的数量';
alter TABLE `pigcms_foodshop_order` add column `refund_money`  decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '退款金额';
alter TABLE `pigcms_foodshop_order` add column `refund_time`  int(11) unsigned NOT NULL DEFAULT '0' COMMENT '  退款时间';


ALTER TABLE `pigcms_merchant_store_foodshop_data` add primary key (store_id);
------------------------------【ID1002503】定制--三级推广用户中的一级推广用户消费后，推广人获得平台随机金额。--------------------
alter TABLE `pigcms_user_spread_list` add column `is_rand` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否随机奖励';
INSERT INTO `pigcms_config` (`name`, `type`, `value`, `info`, `desc`, `tab_id`, `tab_name`, `gid`, `sort`, `status`, `is_lang`, `value_english`, `value_traditional`, `value_korean`) VALUES ('spread_rand_max', 'type=text&size=10', '0', '每次随机金额最大值', '每次随机金额最大值', 'reg_reward', '注册/推荐奖励管理', '2', '98', '1', '0', '', '', '');
INSERT INTO `pigcms_config` (`name`, `type`, `value`, `info`, `desc`, `tab_id`, `tab_name`, `gid`, `sort`, `status`, `is_lang`, `value_english`, `value_traditional`, `value_korean`) VALUES ('spread_rand_min', 'type=text&size=10', '0', '每次随机金额最小值', '每次随机金额最小值', 'reg_reward', '注册/推荐奖励管理', '2', '99', '1', '0', '', '', '');
INSERT INTO `pigcms_config` (`name`, `type`, `value`, `info`, `desc`, `tab_id`, `tab_name`, `gid`, `sort`, `status`, `is_lang`, `value_english`, `value_traditional`, `value_korean`) VALUES ('open_spread_rand', 'type=radio&value=1:开启|0:关闭', '0', '是否开启一级推广随机奖励', '是否开启一级推广随机奖励', 'reg_reward', '注册/推荐奖励管理', '2', '100', '1', '0', '', '', '');



------------------------------【ID1002503】定制--三级推广用户中的一级推广用户消费后，推广人获得平台随机金额。--------------------
-- 设置主键

ALTER TABLE `pigcms_merchant_store_foodshop_data` add primary key (store_id);
ALTER TABLE `pigcms_merchant_store_foodshop` add primary key (store_id);

-- 添加视图
-- http://www.group.com/appapi.php?c=Lang&a=fast_view
-- merchant_store_foodshop_data
-- store_id,preferential_name,cat_hot_name,cat_hot_desc,cat_discount_name,cat_discount_desc


------------------------------【ID1002527】哈客堂扫定制修改色调等需求--------------------


CREATE TABLE `pigcms_foodshop_customer_form` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `store_id` int(11) unsigned NOT NULL COMMENT '店铺ID',
  `mer_id` int(11) unsigned NOT NULL COMMENT '商家ID',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_must` tinyint(1) unsigned NOT NULL COMMENT '是否必填',
  `sort` int(11) unsigned NOT NULL COMMENT '排序值',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`),
  KEY `mer_id` (`mer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='餐饮堂扫自定义表单填写项';


alter TABLE `pigcms_foodshop_order` add column `customer_form` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '堂扫自定义表单填写项';



-- 添加视图
-- http://www.group.com/appapi.php?c=Lang&a=fast_view
-- foodshop_customer_form
-- id,name
-- 刷新视图
-- /admin.php?g=System&c=Lang&a=service_lang



------------------------------【ID1002584】堂扫商家后台的桌台分类与桌台号做多语言--------------------
-- 添加视图
-- http://www.group.com/appapi.php?c=Lang&a=fast_view
-- foodshop_table_type
-- id,name
-- foodshop_table
-- id,name
-- 刷新视图
-- /admin.php?g=System&c=Lang&a=service_lang



------------------------------【ID1002595】堂扫店铺主页的公告做多语言 --------------------
-- 添加视图
-- http://www.group.com/appapi.php?c=Lang&a=fast_view
-- merchant_store_foodshop
-- store_id,store_notice
-- 刷新视图
-- /admin.php?g=System&c=Lang&a=service_lang


------------------------------【ID1002573】类似外卖一样的专题店铺列表页功能-----哈客堂扫定制 --------------------
INSERT INTO `pigcms_system_menu` (`fid`, `name`, `icon`, `module`, `action`, `sort`, `show`, `status`, `area_access`, `galias`, `is_auth_menu`) VALUES ( '48', '餐饮专题', '', 'Special', 'foodshop', '0', '1', '1', '0', '', '0');


 alter TABLE `pigcms_special` modify column `type` tinyint(1) NOT NULL COMMENT '1代表快店，2代表团购，3代表商城 4代表批发 5代表预约 6代表餐饮';


CREATE TABLE `pigcms_foodshop_customer_label` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `store_id` int(11) unsigned NOT NULL COMMENT '店铺ID',
  `mer_id` int(11) unsigned NOT NULL COMMENT '商家ID',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) unsigned NOT NULL COMMENT '排序值',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`),
  KEY `mer_id` (`mer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='餐饮堂扫自定义标签';

-- 添加视图
-- http://www.group.com/appapi.php?c=Lang&a=fast_view
-- foodshop_customer_label
-- id,name



------------------------------【ID1002636】店铺增加取餐方式功能-----哈客堂扫定制 --------------------

 alter TABLE `pigcms_merchant_store_foodshop` add column `dining_method` tinyint(1) DEFAULT '1' NOT NULL COMMENT '取餐方式1送餐到桌2柜台自取';
 alter TABLE `pigcms_merchant_store_foodshop` add column `dining_notice` varchar(255) NOT NULL COMMENT '柜台取餐方式提示语';

 alter TABLE `pigcms_foodshop_order` add column `phone_country_type` char(14) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '手机号区号';
 alter TABLE `pigcms_foodshop_order` add column `dining_method` tinyint(1) DEFAULT '1' NOT NULL COMMENT '取餐方式1送餐到桌2柜台自取';
 alter TABLE `pigcms_merchant_store_foodshop` add column  `open_take_meals_sms` tinyint(1) NOT NULL DEFAULT '0' COMMENT '柜台自取是否开启短信通知1-通知0-不通知';


-- 刷新视图
-- /admin.php?g=System&c=Lang&a=service_lang

http://www.group.com/index.php?c=Image&a=show_fetch_number_image&img_url=foodshop_1122


------------------------------餐饮h5改版 --------------------
INSERT INTO `pigcms_adver_category` (`cat_name`, `cat_key`, `cat_type`, `is_system`, `size_info`) VALUES ('wap站餐饮首页中间图片', 'wap_foodshop_center', '0', '1', '690*150');

INSERT INTO `pigcms_config` (`name`, `type`, `value`, `info`, `desc`, `tab_id`, `tab_name`, `gid`, `sort`, `status`, `is_lang`, `value_english`, `value_traditional`, `value_korean`) VALUES ('open_meal_activity', 'type=radio&value=1:开启|0:关闭', '0', '是否开启餐饮活动', '是否开启餐饮活动', 'base', '基础配置', '5', '0', '1', '0', '', '', '');

CREATE TABLE `pigcms_foodshop_activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `store_id` int(11) unsigned NOT NULL COMMENT '店铺ID',
  `mer_id` int(11) unsigned NOT NULL COMMENT '商家ID',
  `activity_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动名称',
  `activity_price` decimal(10,2) NOT NULL COMMENT '活动价格', 
  `activity_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动标签',
  `activity_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动描述',
  `activity_image` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动图片',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`),
  KEY `mer_id` (`mer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='餐饮活动定制';


------------------------------猜你喜欢首页改版 --------------------
INSERT INTO `pigcms_adver_category` (`cat_name`, `cat_key`, `cat_type`, `is_system`, `size_info`) VALUES ('首页一大三小式布局广告列表', 'app_index_center_four_big_and_small', '0', '0', '第1张180*180；第2张310*103；第3张与第4张均为150*103；显示顺序按照排序值由高到低，从上往下，从左往右原则排序。');


INSERT INTO `pigcms_config` (`name`, `type`, `value`, `info`, `desc`, `tab_id`, `tab_name`, `gid`, `sort`, `status`, `is_lang`, `value_english`, `value_traditional`, `value_korean`) VALUES ('app_index_center_four_show_type', 'type=radio&value=1:开启|0:关闭', '0', '首页中间四张图显示模式', '首页中间四张图显示模式', '', '', '', '0', '0', '0', '', '', '');

 alter TABLE `pigcms_plat_buy_active_group` add column `column_type` tinyint(1) DEFAULT '0' NOT NULL COMMENT '活动布局形式0：一行3个，2：一行2个';
 alter TABLE `pigcms_plat_buy_active_group` add column `row_num` tinyint(1) DEFAULT '0' NOT NULL COMMENT '最多展示几行';

CREATE TABLE `pigcms_system_guess_like_activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `store_id` int(11) unsigned NOT NULL COMMENT '店铺ID',
  `mer_id` int(11) unsigned NOT NULL COMMENT '商家ID',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动名称',
  `price` decimal(10,2) NOT NULL COMMENT '活动价格', 
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动标签',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动描述',
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动图片',
  `show_type` tinyint(1) DEFAULT '0' NOT NULL COMMENT '活动图片布局形式0平铺1一大两小',
  `business_type` char(50) DEFAULT '' COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动业务plat-猜你喜欢，shop-外卖',
  `sort` int(11) unsigned NOT NULL COMMENT '活动排序',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`),
  KEY `mer_id` (`mer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='平台猜你喜欢活动';

CREATE TABLE `pigcms_system_find_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `goods_id` int(11) unsigned NOT NULL COMMENT '商品ID',
  `business_type` char(50) DEFAULT '' COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动业务plat-猜你喜欢，shop-外卖',
  `goods_sort` int(11) unsigned NOT NULL COMMENT '商品排序',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='发现好菜';

INSERT INTO `pigcms_config` (`name`, `type`, `value`, `info`, `desc`, `tab_id`, `tab_name`, `gid`, `sort`, `status`, `is_lang`, `value_english`, `value_traditional`, `value_korean`) VALUES ('shop_index_find_good_goods_show', 'type=radio&value=1:开启|0:关闭', '0', '外卖首页是否显示发现好菜。', '外卖首页是否显示发现好菜。', '', '', '', '0', '0', '0', '', '', '');


优惠券id 249092
0477193994
overseas_support@service.alibaba.com

2881036850@qq.com

https://openhome.alipay.com/platform/home.htm
leon.liang@harkhark.com.au
harkhark2016

https://openhome.alipay.com

今日工作总结
【ID1002708】pc端与移动端商家后台餐饮商品的批量操作 已完成
【ID1002722】pc端商家后台餐饮店铺的商品管理界面交互整体优化，类似外卖商品管理 完成33%

待完成
商品添加修改 以及完成之后跳转

今日工作总结
【ID1002722】pc端商家后台餐饮店铺的商品管理界面交互整体优化，类似外卖商品管理 已完成


txtintro
txtimage


SELECT * FROM `pigcms_area` WHERE ( `area_pid`= '16' AND (`area_name`="O'Connor" OR `area_name`="O'Connor") ) LIMIT 1 

SELECT * FROM `pigcms_area` WHERE ( `area_pid`= '11' AND (`area_name`="O'Connor" OR `area_name`="O'Connor") ) LIMIT 1 


------------------------------【ID1002746】给每个外卖分类加个开关状态，包含三级分类 --------------------
alter TABLE `pigcms_shop_goods_sort` add column  `sort_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '分类状态1开启0关闭';



UPDATE `pigcms_adver_category` SET `size_info`='第1张180*180；第2张310*103；第3张与第4张均为150*103；显示顺序按照排序值由高到低，从上往下，从左往右原则排序。',`cat_name`='首页1大3小式布局广告列表' WHERE (`cat_key`='app_index_center_four_big_and_small');

UPDATE `pigcms_adver_category` SET `size_info`='4张均为160*105' WHERE (`cat_key`='app_index_center_four');

INSERT INTO `pigcms_config` (`name`, `type`, `value`, `info`, `desc`, `tab_id`, `tab_name`, `gid`, `sort`, `status`, `is_lang`, `value_english`, `value_traditional`, `value_korean`) VALUES ('shop_index_find_good_goods_title', 'type=text', '', '外卖首页是否显示发现好菜别称。', '外卖首页是否显示发现好菜别称。', '', '', '', '0', '0', '0', '', '', '');


UPDATE `pigcms_shop_goods_sort` set  `sort_status` = '1';


alter TABLE `pigcms_shop_goods_sort` modify column  `sort_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '分类状态1开启0关闭';


有脚本  update_shop_sort_week

deploy.hsby365.com
ip: 114.115.234.22
user: root
password: ry8MeH$Y10HFiQ9@
账号hangshanadmin
密码 JTTUoyHa5q*F3Myu


------------------------------【ID1002793】外卖3.0--限时优惠的库存必须用户访问才能更新库存的优化 --------------------

INSERT INTO `pigcms_process_plan` (`param`, `add_time`, `plan_time`, `space_time`, `error_count`, `url`, `file`, `time_type`, `sub_process_num`) VALUES ( '', '1586764207', '1587916800', '86400', '0', '', 'update_shop_goods_stock', '0', '3');


INSERT INTO `pigcms_process_plan` (`param`, `add_time`, `plan_time`, `space_time`, `error_count`, `url`, `file`, `time_type`, `sub_process_num`) VALUES ( '', '1586764207', '1586793600', '86400', '0', '', 'update_shop_goods_seckill_stock', '0', '3');


------------------------------【ID1002751】外卖起送价的读取配置等优化 --------------------
alter TABLE `pigcms_merchant_store_shop` modify column `s_basic_price` decimal(8,2) NOT NULL DEFAULT '-1' COMMENT '平台的起送价';
alter TABLE `pigcms_merchant_store_shop` modify column `s_basic_price1` decimal(8,2) NOT NULL DEFAULT '-1' COMMENT '时段一起送价';
alter TABLE `pigcms_merchant_store_shop` modify column  `s_basic_price2` decimal(8,2) NOT NULL DEFAULT '-1' COMMENT '时段二起送价';
alter TABLE `pigcms_merchant_store_shop` modify column  `s_basic_price3` decimal(8,2) NOT NULL DEFAULT '-1' COMMENT '时段三起送价';




------------------------------ --------------------
alter TABLE `pigcms_merchant_money_list` add column `pay_money` decimal(10,2) NOT NULL COMMENT '实付金额';



------------------------------【ID1002887】【Bug转需求】www.dudukeji2008.com商家自有支付，安卓手机扫优惠买单二维码支付，一直在跳转，IOS正常 --------------------
alter TABLE `pigcms_weixin_bind_user` add column `plat_openid` varchar(136) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户平台openid';




------------------------------【ID1002876】app、小程序、h5跑腿帮我买的功能里添加自定义商家名称功能 --------------------
alter TABLE `pigcms_service_auto_category` add column  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=商品 1=店铺';


alter TABLE `pigcms_service_auto_goods` add column `store_id` int(11) unsigned NOT NULL COMMENT '店铺id';




------------------------------【ID1002928】新版跑腿指定商家支持指定基础运费与商家后台跑腿订单查询功能 --------------------
alter TABLE `pigcms_service_auto_goods` add column `delivery_fee` decimal(10,2) NOT NULL COMMENT '起送费';
alter TABLE `pigcms_service_user_publish` add column `auto_goods_id` int(11) NOT NULL COMMENT '自定义商品id';
alter table `pigcms_service_user_publish` add index auto_goods_id(`auto_goods_id`);

INSERT INTO `pigcms_new_merchant_menu` (`id`, `fid`, `name`, `module`, `action`, `select_module`, `select_action`, `icon`, `sort`, `show`, `status`, `price`) VALUES ('10067', '2', '跑腿合作统计', 'Service', 'auto_store_order_list', 'Service', 'auto_store_order_list', 'fa-bar-chart-o', '0', '1', '1', '0.00');


INSERT INTO `pigcms_config` (`name`, `type`, `value`, `info`, `desc`, `tab_id`, `tab_name`, `gid`, `sort`, `status`, `is_lang`, `value_english`, `value_traditional`, `value_korean`) VALUES ('hide_purchase_nearby', 'type=radio&value=1:开启|0:关闭', '0', '是否隐藏就近购买', '是否隐藏就近购买', 'time', '帮我买配置', '42', '200', '1', '0', '', '', '');

------------------------------【ID1002972】优化外卖订单导出Excel格式为csv格式与整单打印不打印未绑定打印机的商品功能--------------------
INSERT INTO `pigcms_config` (`name`, `type`, `value`, `info`, `desc`, `tab_id`, `tab_name`, `gid`, `sort`, `status`, `is_lang`, `value_english`, `value_traditional`, `value_korean`) VALUES ('print_belong_goods', 'type=radio&value=1:开启|0:关闭', '0', '餐饮整单打印不打印未勾选打印机的商品', '', '', '', '0', '0', '0', '0', '', '', '');


alter TABLE `pigcms_process_sub_plan` modify column  `unique_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL;


------------------------------猜你喜欢添加配送方式--------------------

alter TABLE `pigcms_plat_recommend` add column  `delivery_type` tinyint(1) NOT NULL COMMENT '配送方式：1、4-商家配送；0、3-平台配送；5-快递配送。';
alter TABLE `pigcms_plat_recommend` add column  `delivery_name` varchar(100) NOT NULL COMMENT '配送方式名称';





------------------------------【ID1003018】【Bug转需求】www.uqartori.com 飞鹅打印机，打印不出维吾尔文--------------------
alter TABLE `pigcms_orderprinter` add column `language` varchar(50) NOT NULL DEFAULT '' COMMENT '打印语言格式（Uyghur：维文）';



------------------------------v20--------------------
alter TABLE `pigcms_system_menu` add column `component` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '对应组件名';

alter TABLE `pigcms_system_menu` add column `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'v20版本用户端显示路由，示例：/common/platform.iframe/xxxxxx';

alter TABLE `pigcms_system_menu` add column `is_hide` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'v20版本是否在左侧菜单隐藏';


------------------------------【ID1003109】老版餐饮需求---堂扫取餐方式的开发--------------------

 alter TABLE `pigcms_foodshop_order` add column  `user_lang` varchar(100) NOT NULL DEFAULT '' COMMENT '用户语言';


 UPDATE `pigcms_config` SET `desc`='先在一个指定商家下设置客服，然后平台再绑定该商家ID，最后用户即可在通过个人中心等入口来与平台客服沟通咨询。注意：绑定该商家ID后，该商家旗下所有商城店铺的全部商品上都会显示标签【自营】2字，即代表该商家属于平台自营商城商家，仅对快店、商城业务有效；且该商家的自定义店铺装修页面里可以添加平台优惠券、平台所有商家的店铺。' WHERE (`name`='kefu_mer_id');


 INSERT INTO `pigcms_config` (`name`, `type`, `value`, `info`, `desc`, `tab_id`, `tab_name`, `gid`, `sort`, `status`, `is_lang`, `value_english`, `value_traditional`, `value_korean`) VALUES ('open_deliver_reminder', 'type=radio&value=1:开启|0:关闭', '0', '是否开启用户催单配送员', '用户可在订单已超过送达时间时催单配送员，一个用户一个订单最多只可催单3次，每次间隔2分钟', 'deliver_condition', '配送条件', '20', '0', '1', '0', '', '', '');


INSERT INTO `pigcms_process_plan` (`param`, `add_time`, `plan_time`, `space_time`, `error_count`, `url`, `file`, `time_type`, `sub_process_num`) VALUES ( '', '1468834688', '1574909632', '86400', '0', '', 'mer_revenue_statistics', '0', '3');


INSERT INTO `pigcms_system_menu` (`id`, `fid`, `name`, `icon`, `module`, `action`, `sort`, `show`, `status`, `area_access`, `galias`, `is_auth_menu`) VALUES ('413', '250', '营业分析', '', 'Analysis', 'revenueStatistics', '0', '1', '1', '1', '', '0');
INSERT INTO `pigcms_new_merchant_menu` (`id`, `fid`, `name`, `module`, `action`, `select_module`, `select_action`, `icon`, `sort`, `show`, `status`, `price`) VALUES ('10052', '2', '经营分析', 'Analysis', 'revenueStatistics', 'Analysis', 'revenueStatistics', '', '0', '1', '1', '0.00');

-- 添加索引
alter table pigcms_shop_order add index status (status) ;
alter table pigcms_shop_order add index paid (paid) ;
alter table pigcms_deliver_supply add index item (item) ;
alter table pigcms_deliver_supply add index order_from (order_from) ;


487bec0f429728e1b2ad1c5c7c9f5ba06c3f53b4 
e9a46a70196c8dfb9539d598c4f4a7274ff87490 



alter table `pigcms_foodshop_book_time_check` add column `create_time` int(11) unsigned NOT NULL COMMENT '创建时间';



 alter TABLE `pigcms_foodshop_order` add column  `user_lang` varchar(100) NOT NULL DEFAULT '' COMMENT '用户语言';
 
 alter TABLE `pigcms_foodshop_order` add column  `take_meals_sms` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否开启短信自取通知';
 ce8f9bfe8f881d2b32c70b6bd91181f3858675d4

今日工作总结
餐饮订单--列表、详情、导出 完成66%


alter TABLE pigcms_service_auto_goods modify column `delivery_fee` char(20) NOT NULL DEFAULT '' COMMENT '起送费';


