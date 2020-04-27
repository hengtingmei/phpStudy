/*
Navicat MySQL Data Transfer

Source Server         : 192.168.0.234
Source Server Version : 50540
Source Host           : 192.168.0.234:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2020-04-27 17:55:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mall_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `mall_admin_user`;
CREATE TABLE `mall_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '后端用戶主键ID',
  `username` varchar(100) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '用户密码',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态1正常0待审核99删除',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `last_login_time` int(10) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` varchar(100) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `operate_user` varchar(100) NOT NULL DEFAULT '' COMMENT '操作人',
  PRIMARY KEY (`id`),
  KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='后台用户表';

-- ----------------------------
-- Records of mall_admin_user
-- ----------------------------
INSERT INTO `mall_admin_user` VALUES ('1', 'admin', '58224a228ce7b6b795f893e3c6556672', '1', '0', '1587377936', '1587377936', '127.0.0.1', 'admin');

-- ----------------------------
-- Table structure for mall_demo
-- ----------------------------
DROP TABLE IF EXISTS `mall_demo`;
CREATE TABLE `mall_demo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mall_demo
-- ----------------------------

-- ----------------------------
-- Table structure for mall_user
-- ----------------------------
DROP TABLE IF EXISTS `mall_user`;
CREATE TABLE `mall_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '后端用戶主键ID',
  `username` varchar(100) NOT NULL DEFAULT '' COMMENT '用户名',
  `phone_number` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '用户密码',
  `ltype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '登录方式1手机号2用户名密码',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '回话保存天数',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别0保密1男2女',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态1正常0待审核99删除',
  `operate_user` varchar(100) NOT NULL DEFAULT '' COMMENT '操作人',
  PRIMARY KEY (`id`),
  KEY `username` (`username`) USING BTREE,
  KEY `phone_number` (`phone_number`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

-- ----------------------------
-- Records of mall_user
-- ----------------------------
INSERT INTO `mall_user` VALUES ('2', 'MM', '18655138114', 'd716cbda249b78cefad6e0850856de2f', '2', '2', '2', '1586931943', '0', '1', '');
INSERT INTO `mall_user` VALUES ('3', 'singwa粉-11', '11', '', '0', '2', '0', '1586932015', '1586932015', '1', '');
