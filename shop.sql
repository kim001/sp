/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : shop

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2016-04-25 17:41:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sp_admin
-- ----------------------------
DROP TABLE IF EXISTS `sp_admin`;
CREATE TABLE `sp_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(30) DEFAULT NULL,
  `admin_pwd` char(32) DEFAULT NULL,
  `last_ip` varchar(20) DEFAULT NULL,
  `last_time` int(11) DEFAULT NULL,
  `vist_num` int(11) DEFAULT NULL,
  `realname` varchar(30) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_admin
-- ----------------------------
INSERT INTO `sp_admin` VALUES ('1', 'admin', 'c32d8debbab5e7bf725b31796f1678e7', '0.0.0.0', '1461573969', '206', '管理员', '15112533123', '502675585@qq.com', '1');

-- ----------------------------
-- Table structure for sp_button
-- ----------------------------
DROP TABLE IF EXISTS `sp_button`;
CREATE TABLE `sp_button` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `event` varchar(20) DEFAULT NULL,
  `sortnum` int(11) DEFAULT NULL,
  `desc` varchar(30) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_button
-- ----------------------------

-- ----------------------------
-- Table structure for sp_module
-- ----------------------------
DROP TABLE IF EXISTS `sp_module`;
CREATE TABLE `sp_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `sortnum` int(11) DEFAULT NULL,
  `button` varchar(200) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `button` (`button`)
) ENGINE=InnoDB AUTO_INCREMENT=295 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_module
-- ----------------------------
INSERT INTO `sp_module` VALUES ('1', '系统设置', '-0-1-', 'iframe', '0', '0', '', '');

-- ----------------------------
-- Table structure for sp_role
-- ----------------------------
DROP TABLE IF EXISTS `sp_role`;
CREATE TABLE `sp_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `tyname` varchar(30) DEFAULT NULL,
  `desc` varchar(50) DEFAULT NULL,
  `module` text,
  `button` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_role
-- ----------------------------
INSERT INTO `sp_role` VALUES ('1', '超级管理员', '系统角色', '超级管理员', '', '');
