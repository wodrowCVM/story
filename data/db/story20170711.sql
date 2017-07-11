/*
Navicat MySQL Data Transfer

Source Server         : cvm
Source Server Version : 50633
Source Host           : 123.207.92.60:3306
Source Database       : story

Target Server Type    : MYSQL
Target Server Version : 50633
File Encoding         : 65001

Date: 2017-07-11 14:22:14
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
INSERT INTO `auth_assignment` VALUES ('super', '29', '1499131516');

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
INSERT INTO `auth_item` VALUES ('/tag', '2', null, null, null, '1499327125', '1499327125');
INSERT INTO `auth_item` VALUES ('/tag/*', '2', null, null, null, '1499327118', '1499327118');
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
-- Table structure for bind_essay_tag
-- ----------------------------
DROP TABLE IF EXISTS `bind_essay_tag`;
CREATE TABLE `bind_essay_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `essay_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bind_essay_tag_unique` (`essay_id`,`tag_id`) USING BTREE,
  KEY `bind_essay_tag_from_tag` (`tag_id`),
  KEY `bind_essay_tag_created_by` (`created_by`),
  KEY `bind_essay_tag_updated_by` (`updated_by`),
  KEY `bind_essay_tag_from_essay` (`essay_id`) USING BTREE,
  CONSTRAINT `bind_essay_tag_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bind_essay_tag_from_essay` FOREIGN KEY (`essay_id`) REFERENCES `essay` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bind_essay_tag_from_tag` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bind_essay_tag_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bind_essay_tag
-- ----------------------------
INSERT INTO `bind_essay_tag` VALUES ('80', '55492', '3460122', '1499663332', '31', '1499663332', '31');
INSERT INTO `bind_essay_tag` VALUES ('81', '55492', '3460128', '1499663332', '31', '1499663332', '31');
INSERT INTO `bind_essay_tag` VALUES ('82', '55492', '3460121', '1499663332', '31', '1499663332', '31');
INSERT INTO `bind_essay_tag` VALUES ('83', '55492', '3460132', '1499663332', '31', '1499663332', '31');
INSERT INTO `bind_essay_tag` VALUES ('84', '55499', '3460128', '1499664473', '31', '1499664473', '31');
INSERT INTO `bind_essay_tag` VALUES ('85', '55500', '3460128', '1499675597', '29', '1499675597', '29');

-- ----------------------------
-- Table structure for essay
-- ----------------------------
DROP TABLE IF EXISTS `essay`;
CREATE TABLE `essay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '10',
  `status` tinyint(4) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `need_money` int(11) NOT NULL DEFAULT '0',
  `need_integral` int(11) NOT NULL DEFAULT '0',
  `need_xp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `essay_user_title_unique` (`title`,`created_by`) USING BTREE,
  KEY `essay_created_by` (`created_by`),
  KEY `essay_updated_by` (`updated_by`),
  CONSTRAINT `essay_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `essay_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55506 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of essay
-- ----------------------------
INSERT INTO `essay` VALUES ('55492', 'test', 'test', '<p>test</p>', '10', '10', '1499403284', '31', '1499663331', '31', '0', '0', '0');
INSERT INTO `essay` VALUES ('55499', 'test1', 'test1', '<p>test1</p>', '10', '10', '1499415259', '31', '1499664473', '31', '0', '0', '0');
INSERT INTO `essay` VALUES ('55500', 'test2', 'test2', '<p>test2</p>', '10', '10', '1499415277', '31', '1499675597', '29', '0', '1', '0');
INSERT INTO `essay` VALUES ('55501', 'test3', 'test3', '<p>test3</p>', '10', '10', '1499563964', '29', '1499676264', '29', '0', '1000', '1');
INSERT INTO `essay` VALUES ('55502', 'test4', 'test4', '<p>test4</p>', '10', '10', '1499663353', '31', '1499663353', '31', '0', '0', '0');
INSERT INTO `essay` VALUES ('55503', 'test5', 'test5', '<p>test5</p>', '10', '10', '1499664402', '31', '1499743134', '31', '0', '1000', '0');
INSERT INTO `essay` VALUES ('55504', 'test6', 'test6', 'test6', '10', '10', '1499669832', '29', '1499669832', '29', '0', '2', '0');
INSERT INTO `essay` VALUES ('55505', 'test8', 'test8', '<p>test8</p>', '10', '10', '1499675504', '29', '1499675504', '29', '0', '0', '0');

-- ----------------------------
-- Table structure for essay_reply
-- ----------------------------
DROP TABLE IF EXISTS `essay_reply`;
CREATE TABLE `essay_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `essay_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '10',
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `essay_reply_for_essay` (`essay_id`),
  KEY `essay_reply_created_by` (`created_by`),
  KEY `essay_reply_updated_by` (`updated_by`),
  CONSTRAINT `essay_reply_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `essay_reply_for_essay` FOREIGN KEY (`essay_id`) REFERENCES `essay` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `essay_reply_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of essay_reply
-- ----------------------------
INSERT INTO `essay_reply` VALUES ('1', '55505', '31', '1499683407', '31', '1499683407', '10', 'gasdfasdfgsadgf');
INSERT INTO `essay_reply` VALUES ('2', '55505', '31', '1499683471', '31', '1499683471', '10', 'gasdfasdfgsadgf');
INSERT INTO `essay_reply` VALUES ('3', '55505', '31', '1499683499', '31', '1499683499', '10', 'gasdfasdfgsadgf');
INSERT INTO `essay_reply` VALUES ('7', '55505', '31', '1499740133', '31', '1499740133', '10', 'safdasdfagasefsa');
INSERT INTO `essay_reply` VALUES ('8', '55505', '31', '1499740186', '31', '1499740186', '10', 'adgagasdfasdf');
INSERT INTO `essay_reply` VALUES ('9', '55505', '31', '1499740227', '31', '1499740227', '10', 'gfadgadfasdf');
INSERT INTO `essay_reply` VALUES ('10', '55504', '31', '1499742460', '31', '1499742460', '10', 'dsafasdfasgfasd');
INSERT INTO `essay_reply` VALUES ('11', '55503', '31', '1499749609', '31', '1499749609', '10', 'fagasdffasdfasdf');
INSERT INTO `essay_reply` VALUES ('12', '55505', '31', '1499749647', '31', '1499749647', '10', 'gasdfasfaesfasfd');
INSERT INTO `essay_reply` VALUES ('13', '55505', '31', '1499749658', '31', '1499749658', '10', 'gasdfasfdasdf');
INSERT INTO `essay_reply` VALUES ('14', '55505', '31', '1499750367', '31', '1499750367', '10', 'sadfasdgasdfasdf');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '权限管理', null, '/admin', null, null);
INSERT INTO `menu` VALUES ('2', '用户管理', null, '/user', null, null);
INSERT INTO `menu` VALUES ('3', '授权码', '2', '/user/auth-code', null, null);
INSERT INTO `menu` VALUES ('4', '标签管理', null, '/tag', null, null);

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
-- Table structure for novel
-- ----------------------------
DROP TABLE IF EXISTS `novel`;
CREATE TABLE `novel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `desc` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '10',
  `status` tinyint(4) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of novel
-- ----------------------------

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '10',
  `status` tinyint(4) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name_unique` (`name`) USING BTREE,
  KEY `tag_created_by` (`created_by`),
  KEY `tag_updated_by` (`updated_by`),
  CONSTRAINT `tag_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tag_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3460133 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag
-- ----------------------------
INSERT INTO `tag` VALUES ('3460121', 'test', 'test', '10', '10', '1499403263', '29', '1499403470', '29');
INSERT INTO `tag` VALUES ('3460122', 'test1', 'test1', '10', '10', '1499403550', '29', '1499403550', '29');
INSERT INTO `tag` VALUES ('3460128', 'tes', null, '10', '10', '1499408760', '31', '1499408760', '31');
INSERT INTO `tag` VALUES ('3460132', 'tt', null, '10', '10', '1499409595', '31', '1499409595', '31');

-- ----------------------------
-- Table structure for tips
-- ----------------------------
DROP TABLE IF EXISTS `tips`;
CREATE TABLE `tips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tips_created_by_suer` (`created_by`),
  KEY `tips_updated_by_user` (`updated_by`),
  CONSTRAINT `tips_created_by_suer` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tips_updated_by_user` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tips
-- ----------------------------

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
  `mobile` char(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qq` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weibo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `birthday` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('29', 'wodrow', 'fSxElzKRRUhME07iQICC3vGYFjkLEleX', '$2y$13$hi9WX2U1DJzZb8gtB7Ujd.jtS.EgSOF8LYmuA4OdOIa7MLLcUM.Jy', null, 'wodrow451611cv@gmail.com', '10', '0', '1499750613', '0', '8', '10', '', '', '', '', '1', null);
INSERT INTO `user` VALUES ('31', '1173957281', 'a7DQ0-ejT-7Dn-9_HdSrIRfUyy4265XT', '$2y$13$YzPdOsMzw23NHeGPH.Eu6OBS5ZerkV5aw1pCYHFg5hsUdoOPMApIi', null, '1173957281@qq.com', '10', '1499403066', '1499750613', '0', '23', '39', null, null, null, null, null, null);

-- ----------------------------
-- Table structure for user_alert
-- ----------------------------
DROP TABLE IF EXISTS `user_alert`;
CREATE TABLE `user_alert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '10',
  `title` varchar(200) NOT NULL,
  `content` text,
  `other_data` text,
  `updated_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `item_type` tinyint(4) NOT NULL DEFAULT '10',
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_alert_created_by` (`created_by`),
  KEY `user_alert_updated_by` (`updated_by`),
  KEY `user_alert_to_user` (`to_user`),
  CONSTRAINT `user_alert_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_alert_to_user` FOREIGN KEY (`to_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_alert_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_alert
-- ----------------------------
INSERT INTO `user_alert` VALUES ('4', '31', '1499742460', '11', '你的随笔[test6]有新的回复', null, null, '29', '1499750426', '29', '10', '55505');
INSERT INTO `user_alert` VALUES ('5', '31', '1499749609', '10', '你的随笔[test5]有新的回复', null, null, '31', '1499749609', '31', '10', '55501');
INSERT INTO `user_alert` VALUES ('6', '31', '1499749647', '10', '你的随笔[test8]有新的回复', null, null, '31', '1499749647', '29', '10', '55505');
INSERT INTO `user_alert` VALUES ('7', '31', '1499749658', '10', '你的随笔[test8]有新的回复', null, null, '31', '1499749658', '29', '10', '55505');
INSERT INTO `user_alert` VALUES ('8', '31', '1499750367', '11', '你的随笔[test8]有新的回复', null, null, '29', '1499750401', '29', '10', '55505');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_auth_code
-- ----------------------------
INSERT INTO `user_auth_code` VALUES ('2', 'gt5i9ZZ9TF-6IloZwdvLXdjXcIbKEoKedDumHbTD1499403034', '31', '1499403066', '29', '1499403035', '31', '1499403067', '10');

-- ----------------------------
-- Table structure for user_essay
-- ----------------------------
DROP TABLE IF EXISTS `user_essay`;
CREATE TABLE `user_essay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `essay_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` tinyint(6) NOT NULL DEFAULT '6',
  `buy_log` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_essay_buy` (`essay_id`,`created_by`) USING BTREE,
  KEY `user_essay_created_by` (`created_by`),
  KEY `user_essay_updated_by` (`updated_by`),
  CONSTRAINT `user_essay_buy_essay` FOREIGN KEY (`essay_id`) REFERENCES `essay` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_essay_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_essay_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_essay
-- ----------------------------
INSERT INTO `user_essay` VALUES ('6', '55504', '1499676885', '31', '1499676885', '31', '10', '{\"essay\":{\"id\":55504,\"title\":\"test6\",\"desc\":\"test6\",\"content\":\"test6\",\"type\":10,\"status\":10,\"created_at\":1499669832,\"created_by\":29,\"updated_at\":1499669832,\"updated_by\":29,\"need_money\":0,\"need_integral\":2,\"need_xp\":0}}');
INSERT INTO `user_essay` VALUES ('7', '55505', '1499678038', '31', '1499678038', '31', '10', '{\"essay\":{\"id\":55505,\"title\":\"test8\",\"desc\":\"test8\",\"content\":\"<p>test8<\\/p>\",\"type\":10,\"status\":10,\"created_at\":1499675504,\"created_by\":29,\"updated_at\":1499675504,\"updated_by\":29,\"need_money\":0,\"need_integral\":0,\"need_xp\":0}}');
INSERT INTO `user_essay` VALUES ('8', '55500', '1499750613', '29', '1499750613', '29', '10', '{\"essay\":{\"id\":55500,\"title\":\"test2\",\"desc\":\"test2\",\"content\":\"<p>test2<\\/p>\",\"type\":10,\"status\":10,\"created_at\":1499415277,\"created_by\":31,\"updated_at\":1499675597,\"updated_by\":29,\"need_money\":0,\"need_integral\":1,\"need_xp\":0}}');

-- ----------------------------
-- Table structure for user_signin
-- ----------------------------
DROP TABLE IF EXISTS `user_signin`;
CREATE TABLE `user_signin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date` char(8) NOT NULL,
  `message` varchar(200) NOT NULL,
  `c_days` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `signin_user_date_unique` (`created_by`,`date`) USING BTREE,
  CONSTRAINT `signin_by_user` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54217 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_signin
-- ----------------------------
INSERT INTO `user_signin` VALUES ('54206', '1499402397', '29', '20170707', '今天是个好日子，心想的事儿都能成', '1');
INSERT INTO `user_signin` VALUES ('54208', '1499600000', '31', '20170709', '发的萨芬撒打发士大夫撒个', '1');
INSERT INTO `user_signin` VALUES ('54216', '1499664330', '31', '20170710', 'dfasdfsadfgasdf', '2');

-- ----------------------------
-- Table structure for user_story
-- ----------------------------
DROP TABLE IF EXISTS `user_story`;
CREATE TABLE `user_story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `essay_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` tinyint(6) NOT NULL DEFAULT '6',
  `buy_log` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_story
-- ----------------------------

-- ----------------------------
-- View structure for item_tag
-- ----------------------------
DROP VIEW IF EXISTS `item_tag`;
CREATE ALGORITHM=UNDEFINED DEFINER=`wodrow`@`%` SQL SECURITY DEFINER VIEW `item_tag` AS select `essay`.`title` AS `title`,`essay`.`status` AS `status`,`essay`.`created_at` AS `created_at`,`essay`.`created_by` AS `created_by`,`essay`.`updated_at` AS `updated_at`,`essay`.`updated_by` AS `updated_by`,`essay`.`need_money` AS `need_money`,`essay`.`need_integral` AS `need_integral`,`essay`.`need_xp` AS `need_xp`,`tag`.`id` AS `tag_id`,`tag`.`name` AS `tag_name`,10 AS `item_type`,`essay`.`id` AS `item_id` from ((`essay` join `bind_essay_tag` on((`bind_essay_tag`.`essay_id` = `essay`.`id`))) join `tag` on((`bind_essay_tag`.`tag_id` = `tag`.`id`))) ;
