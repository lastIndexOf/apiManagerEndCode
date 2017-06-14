/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : api_manage

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2017-06-13 22:15:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for api
-- ----------------------------
DROP TABLE IF EXISTS `api`;
CREATE TABLE `api` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `docsid` int(255) NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `desc` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `docsid` (`docsid`),
  CONSTRAINT `api_ibfk_1` FOREIGN KEY (`docsid`) REFERENCES `docs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of api
-- ----------------------------

-- ----------------------------
-- Table structure for api_info
-- ----------------------------
DROP TABLE IF EXISTS `api_info`;
CREATE TABLE `api_info` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8_bin NOT NULL,
  `type` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `rank` int(255) DEFAULT NULL COMMENT '0表好第一级别，  \r\n1是他的子级别，，，，',
  `parent` int(255) DEFAULT NULL,
  `api_id` int(255) NOT NULL,
  `required` int(2) NOT NULL COMMENT '0表示false    1表示true',
  PRIMARY KEY (`id`),
  KEY `api_id` (`api_id`),
  KEY `parent` (`parent`),
  CONSTRAINT `api_info_ibfk_2` FOREIGN KEY (`api_id`) REFERENCES `api` (`id`),
  CONSTRAINT `api_info_ibfk_3` FOREIGN KEY (`parent`) REFERENCES `api_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of api_info
-- ----------------------------

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `docsid` int(255) NOT NULL,
  `comment_id` int(255) DEFAULT NULL,
  `fromuser` int(255) NOT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `time` datetime NOT NULL COMMENT '评论时间',
  `preview` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fromuser` (`fromuser`),
  KEY `docsid` (`docsid`),
  KEY `comment_ibfk_2` (`comment_id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`),
  CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`fromuser`) REFERENCES `user` (`id`),
  CONSTRAINT `comment_ibfk_4` FOREIGN KEY (`docsid`) REFERENCES `docs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('3', '1', null, '8', '您好', '0000-00-00 00:00:00', '年后');
INSERT INTO `comment` VALUES ('4', '1', null, '8', '您好', '2017-06-13 12:08:22', '年后');
INSERT INTO `comment` VALUES ('6', '1', '3', '8', '您好', '2017-06-13 12:12:51', '年后');

-- ----------------------------
-- Table structure for commit
-- ----------------------------
DROP TABLE IF EXISTS `commit`;
CREATE TABLE `commit` (
  `id` int(255) NOT NULL,
  `time` datetime NOT NULL,
  `docsid` int(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `preview` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `docsid` (`docsid`),
  CONSTRAINT `commit_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`),
  CONSTRAINT `commit_ibfk_3` FOREIGN KEY (`docsid`) REFERENCES `docs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of commit
-- ----------------------------

-- ----------------------------
-- Table structure for docs
-- ----------------------------
DROP TABLE IF EXISTS `docs`;
CREATE TABLE `docs` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `public_time` datetime NOT NULL,
  `group_id` int(255) NOT NULL,
  `desc` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '文档描述',
  `type` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '00单人，web\r\n10多人，web',
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `docs_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of docs
-- ----------------------------
INSERT INTO `docs` VALUES ('1', 'title', '2017-06-02 19:58:52', '8', 'desc', '00');

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `headman` int(255) NOT NULL,
  PRIMARY KEY (`id`,`headman`),
  KEY `headman` (`headman`),
  CONSTRAINT `group_ibfk_1` FOREIGN KEY (`headman`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of group
-- ----------------------------
INSERT INTO `group` VALUES ('6', '1111', '9');
INSERT INTO `group` VALUES ('7', '1111', '9');
INSERT INTO `group` VALUES ('8', '1111', '8');
INSERT INTO `group` VALUES ('9', '1111', '9');
INSERT INTO `group` VALUES ('10', '1111', '8');
INSERT INTO `group` VALUES ('11', '1111', '9');
INSERT INTO `group` VALUES ('12', '1111', '8');
INSERT INTO `group` VALUES ('13', '1111', '8');
INSERT INTO `group` VALUES ('14', '1111', '8');
INSERT INTO `group` VALUES ('15', '1111', '9');
INSERT INTO `group` VALUES ('16', '1111', '9');
INSERT INTO `group` VALUES ('17', '1111', '9');

-- ----------------------------
-- Table structure for group_chat
-- ----------------------------
DROP TABLE IF EXISTS `group_chat`;
CREATE TABLE `group_chat` (
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `time` datetime NOT NULL,
  `user_id` int(255) NOT NULL,
  `group_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of group_chat
-- ----------------------------

-- ----------------------------
-- Table structure for group_user
-- ----------------------------
DROP TABLE IF EXISTS `group_user`;
CREATE TABLE `group_user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `groupid` int(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_user_ibfk_2` (`userid`),
  KEY `group_user_ibfk_3` (`groupid`),
  CONSTRAINT `group_user_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`),
  CONSTRAINT `group_user_ibfk_3` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of group_user
-- ----------------------------
INSERT INTO `group_user` VALUES ('10', '11', '8', '2017-06-13 12:03:44');
INSERT INTO `group_user` VALUES ('11', '12', '8', '2017-06-13 15:52:57');
INSERT INTO `group_user` VALUES ('12', '13', '8', '2017-06-13 15:53:07');
INSERT INTO `group_user` VALUES ('13', '15', '9', '2017-06-13 15:53:08');
INSERT INTO `group_user` VALUES ('14', '15', '9', '2017-06-13 15:53:08');
INSERT INTO `group_user` VALUES ('15', '16', '9', '2017-06-13 15:53:08');
INSERT INTO `group_user` VALUES ('16', '17', '9', '2017-06-13 15:55:23');
INSERT INTO `group_user` VALUES ('17', '9', '9', '2017-06-13 16:20:27');
INSERT INTO `group_user` VALUES ('18', '8', '9', '2017-06-13 16:20:38');

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `api_id` int(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `api_id` (`api_id`),
  CONSTRAINT `log_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `log_ibfk_2` FOREIGN KEY (`api_id`) REFERENCES `api` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of log
-- ----------------------------

-- ----------------------------
-- Table structure for note
-- ----------------------------
DROP TABLE IF EXISTS `note`;
CREATE TABLE `note` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  `content` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `mtitle` varchar(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `preview` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  CONSTRAINT `note_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of note
-- ----------------------------

-- ----------------------------
-- Table structure for request_head
-- ----------------------------
DROP TABLE IF EXISTS `request_head`;
CREATE TABLE `request_head` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `head` varchar(255) COLLATE utf8_bin NOT NULL,
  `api_id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `api_id` (`api_id`),
  CONSTRAINT `request_head_ibfk_1` FOREIGN KEY (`api_id`) REFERENCES `api` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of request_head
-- ----------------------------

-- ----------------------------
-- Table structure for response_api
-- ----------------------------
DROP TABLE IF EXISTS `response_api`;
CREATE TABLE `response_api` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `desc` varchar(255) COLLATE utf8_bin NOT NULL,
  `api_id` int(255) NOT NULL,
  `required` int(255) NOT NULL COMMENT '0表示不必要，1表示必要',
  `param` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of response_api
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `phone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `regist_time` datetime NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `job` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `logouttime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('8', '#(111)', '1111', '13222', '178726', '2017-06-09 08:58:24', '/apiManagerEndCode/imgs/avatar/default.jpg', 'jinglui', 'li', null);
INSERT INTO `user` VALUES ('9', 'lyh11111', '123123121111', '11343@1111111.com', '1786270111101611', '2017-06-13 03:04:31', '/apiManagerEndCode/imgs/avatar/default.jpg', null, null, null);

-- ----------------------------
-- Table structure for user_char
-- ----------------------------
DROP TABLE IF EXISTS `user_char`;
CREATE TABLE `user_char` (
  `from` int(255) NOT NULL,
  `to` int(255) NOT NULL,
  `time` datetime NOT NULL,
  `content` varchar(255) NOT NULL,
  KEY `from` (`from`),
  KEY `to` (`to`),
  CONSTRAINT `user_char_ibfk_1` FOREIGN KEY (`from`) REFERENCES `user` (`id`),
  CONSTRAINT `user_char_ibfk_2` FOREIGN KEY (`to`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_char
-- ----------------------------
