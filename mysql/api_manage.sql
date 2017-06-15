/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : api_manage

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2017-06-15 20:35:43
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
  KEY `api_ibfk_1` (`docsid`),
  CONSTRAINT `api_ibfk_1` FOREIGN KEY (`docsid`) REFERENCES `docs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
  KEY `api_info_ibfk_2` (`api_id`),
  KEY `api_info_ibfk_3` (`parent`),
  CONSTRAINT `api_info_ibfk_3` FOREIGN KEY (`parent`) REFERENCES `api_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `api_info_ibfk_2` FOREIGN KEY (`api_id`) REFERENCES `api` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  KEY `comment_ibfk_2` (`comment_id`),
  KEY `comment_ibfk_4` (`docsid`),
  KEY `comment_ibfk_3` (`fromuser`),
  CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`fromuser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comment_ibfk_4` FOREIGN KEY (`docsid`) REFERENCES `docs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for commit
-- ----------------------------
DROP TABLE IF EXISTS `commit`;
CREATE TABLE `commit` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  `docsid` int(255) NOT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `userid` int(255) NOT NULL,
  `preview` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `commit_ibfk_2` (`userid`),
  KEY `commit_ibfk_3` (`docsid`),
  CONSTRAINT `commit_ibfk_3` FOREIGN KEY (`docsid`) REFERENCES `docs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `commit_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

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
  KEY `docs_ibfk_1` (`group_id`),
  CONSTRAINT `docs_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
  KEY `id` (`id`),
  CONSTRAINT `group_ibfk_1` FOREIGN KEY (`headman`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for group_chat
-- ----------------------------
DROP TABLE IF EXISTS `group_chat`;
CREATE TABLE `group_chat` (
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `time` datetime NOT NULL,
  `user_id` int(255) NOT NULL,
  `group_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`time`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `group_chat_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `group_chat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  CONSTRAINT `group_user_ibfk_3` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `group_user_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

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
  KEY `log_ibfk_2` (`api_id`),
  CONSTRAINT `log_ibfk_2` FOREIGN KEY (`api_id`) REFERENCES `api` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `log_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  KEY `note_ibfk_1` (`userid`),
  CONSTRAINT `note_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
  KEY `request_head_ibfk_1` (`api_id`),
  CONSTRAINT `request_head_ibfk_1` FOREIGN KEY (`api_id`) REFERENCES `api` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for response_api
-- ----------------------------
DROP TABLE IF EXISTS `response_api`;
CREATE TABLE `response_api` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_bin NOT NULL,
  `desc` varchar(255) COLLATE utf8_bin NOT NULL,
  `type` int(255) NOT NULL COMMENT '0表示不必要，1表示必要',
  `rank` int(255) DEFAULT NULL,
  `parent` int(255) DEFAULT NULL,
  `api_id` int(255) NOT NULL,
  `required` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `response_api_ibfk_1` (`parent`),
  KEY `response_api_ibfk_2` (`api_id`),
  CONSTRAINT `response_api_ibfk_2` FOREIGN KEY (`api_id`) REFERENCES `api` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `response_api_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `response_api` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
-- Table structure for user_char
-- ----------------------------
DROP TABLE IF EXISTS `user_char`;
CREATE TABLE `user_char` (
  `from` int(255) NOT NULL,
  `to` int(255) NOT NULL,
  `time` datetime NOT NULL,
  `content` varchar(255) NOT NULL,
  KEY `user_char_ibfk_1` (`from`),
  KEY `user_char_ibfk_2` (`to`),
  CONSTRAINT `user_char_ibfk_2` FOREIGN KEY (`to`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_char_ibfk_1` FOREIGN KEY (`from`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
