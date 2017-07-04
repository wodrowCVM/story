/*
Navicat MySQL Data Transfer

Source Server         : cvm
Source Server Version : 50633
Source Host           : 123.207.92.60:3306
Source Database       : story

Target Server Type    : MYSQL
Target Server Version : 50633
File Encoding         : 65001

Date: 2017-07-04 15:15:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('super', '9', '1499131516');

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('/*', '2', null, null, null, '1499131798', '1499131798');
INSERT INTO `auth_item` VALUES ('/admin', '2', null, null, null, '1499131847', '1499131847');
INSERT INTO `auth_item` VALUES ('/admin/*', '2', null, null, null, '1499131842', '1499131842');
INSERT INTO `auth_item` VALUES ('/user', '2', null, null, null, '1499135596', '1499135596');
INSERT INTO `auth_item` VALUES ('/user/*', '2', null, null, null, '1499135606', '1499135606');
INSERT INTO `auth_item` VALUES ('/user/auth-code', '2', null, null, null, '1499136481', '1499136481');
INSERT INTO `auth_item` VALUES ('super', '1', null, null, null, '1499131498', '1499131498');

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('super', '/*');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '权限管理', null, '/admin', null, null);
INSERT INTO `menu` VALUES ('2', '用户管理', null, '/user', null, null);
INSERT INTO `menu` VALUES ('3', '授权码', '2', '/user/auth-code', null, null);

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1499063961');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1499063964');
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', '1499129141');
INSERT INTO `migration` VALUES ('m140602_111327_create_menu_table', '1499129097');
INSERT INTO `migration` VALUES ('m160312_050000_create_user', '1499129098');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '9',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `money` int(11) unsigned NOT NULL DEFAULT '0',
  `integral` int(11) unsigned NOT NULL DEFAULT '0',
  `xp` int(11) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('9', 'wodrow', '-3_wNthQXyVCm3gRclyvu1WqmxIS30Of', '$2y$13$HLltyvZrB6Ae60jaff5z2eBq0i3Ftz5G6ZBuQIt3MpJSgaVzNXEyO', null, '1173957281@qq.com', '10', '1499074619', '1499079950', '0', '0', '0', null);
INSERT INTO `user` VALUES ('20', 'admin', '02w4Zp-7Tua9P42vdDzJbZNoojQD-ZRK', '$2y$13$ZheUdfWObo5IMEFBOyPzLeEGQ8VJFluTIp.fEXbt/arN7b39goYw2', null, 'wodrow451611cv@gmail.com', '10', '1499152107', '1499152305', '0', '0', '0', null);

-- ----------------------------
-- Table structure for user_auth_code
-- ----------------------------
DROP TABLE IF EXISTS `user_auth_code`;
CREATE TABLE `user_auth_code` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(50) NOT NULL,
  `bind_user` int(11) DEFAULT NULL,
  `bind_at` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `auth_code_bind_user` (`bind_user`),
  KEY `auth_code_created_by` (`created_by`),
  KEY `auth_code_updated_by` (`updated_by`),
  CONSTRAINT `auth_code_bind_user` FOREIGN KEY (`bind_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_code_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_code_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_auth_code
-- ----------------------------
INSERT INTO `user_auth_code` VALUES ('73', 'PAVHV11Pu7G67Xatb64Xs7pY91GM2dpazKYTaKtN1499144869', null, null, '9', '1499144870', '9', '1499147923', '10');
INSERT INTO `user_auth_code` VALUES ('98', 'wy_xCRUY8iGYbPygWOxSy__OO4PDF-2UZBrMC6T81499148679', null, null, '9', '1499148680', '9', '1499148680', '10');
INSERT INTO `user_auth_code` VALUES ('99', 'xOlfa3n7kdZ9sNaeZaVlmIbUN1fX-m8dD0hJbUMu1499151726', null, null, '9', '1499151727', '9', '1499151761', '10');
INSERT INTO `user_auth_code` VALUES ('101', 'ErbTnYsbhzkw40jS-HZDt5wEVOcatUWqQPoizMtN1499151795', '20', null, '9', '1499151796', '20', '1499152107', '10');
