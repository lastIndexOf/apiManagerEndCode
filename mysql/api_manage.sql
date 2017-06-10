/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : api_manage

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2017-06-10 22:22:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for api
-- ----------------------------
DROP TABLE IF EXISTS `api`;
CREATE TABLE `api` (
  `id` int(255) NOT NULL,
  `docsid` int(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `query` varchar(255) NOT NULL,
  `body` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `docsid` (`docsid`),
  CONSTRAINT `api_ibfk_1` FOREIGN KEY (`docsid`) REFERENCES `docs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of api
-- ----------------------------

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(255) NOT NULL,
  `docsid` int(255) NOT NULL,
  `touser` int(255) NOT NULL,
  `fromuser` int(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `time` datetime NOT NULL COMMENT '评论时间',
  PRIMARY KEY (`id`),
  KEY `docsid` (`docsid`),
  KEY `touser` (`touser`),
  KEY `fromuser` (`fromuser`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`docsid`) REFERENCES `docs` (`id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`touser`) REFERENCES `user` (`id`),
  CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`fromuser`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of comment
-- ----------------------------

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
  PRIMARY KEY (`id`),
  KEY `docsid` (`docsid`),
  KEY `userid` (`userid`),
  CONSTRAINT `commit_ibfk_1` FOREIGN KEY (`docsid`) REFERENCES `docs` (`id`),
  CONSTRAINT `commit_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of commit
-- ----------------------------

-- ----------------------------
-- Table structure for docs
-- ----------------------------
DROP TABLE IF EXISTS `docs`;
CREATE TABLE `docs` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `public_time` datetime NOT NULL,
  `group_id` int(255) NOT NULL,
  `desc` varchar(255) NOT NULL COMMENT '文档描述',
  `type` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '00单人，web\r\n10多人，web',
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `docs_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of docs
-- ----------------------------

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `headman` int(255) NOT NULL,
  PRIMARY KEY (`id`,`headman`),
  KEY `headman` (`headman`),
  CONSTRAINT `group_ibfk_1` FOREIGN KEY (`headman`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of group
-- ----------------------------

-- ----------------------------
-- Table structure for group_chat
-- ----------------------------
DROP TABLE IF EXISTS `group_chat`;
CREATE TABLE `group_chat` (
  `user_group_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
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
  PRIMARY KEY (`id`),
  KEY `group_user_ibfk_3` (`groupid`),
  KEY `group_user_ibfk_2` (`userid`),
  CONSTRAINT `group_user_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `group_user_ibfk_3` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of group_user
-- ----------------------------

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
  CONSTRAINT `log_ibfk_2` FOREIGN KEY (`api_id`) REFERENCES `api` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of log
-- ----------------------------

-- ----------------------------
-- Table structure for note
-- ----------------------------
DROP TABLE IF EXISTS `note`;
CREATE TABLE `note` (
  `id` int(255) NOT NULL,
  `time` datetime NOT NULL,
  `content` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `mtitle` varchar(255) NOT NULL,
  `userid` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  CONSTRAINT `note_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of note
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('8', '#(111)', '1111', '13222', '178726', '2017-06-09 08:58:24', '/apiManagerEndCode/imgs/avatar/default.jpg', 'jinglui', 'li');

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
