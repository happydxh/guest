-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2016 年 09 月 25 日 09:39
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 数据库: `guest`
-- 
CREATE DATABASE `guest` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `guest`;

-- --------------------------------------------------------

-- 
-- 表的结构 `tg_article`
-- 

CREATE TABLE `tg_article` (
  `dg_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//ID',
  `dg_username` varchar(20) NOT NULL COMMENT '//发帖人',
  `dg_type` tinyint(2) unsigned NOT NULL COMMENT '//发帖类型',
  `reid` mediumint(8) unsigned NOT NULL default '0' COMMENT '//回帖id',
  `dg_title` varchar(40) NOT NULL COMMENT '//标题',
  `dg_content` text NOT NULL COMMENT '//发帖内容',
  `dg_readcount` smallint(5) NOT NULL default '0' COMMENT '//阅读量',
  `dg_commendcount` smallint(5) NOT NULL default '0' COMMENT '//评论量',
  `dg_date` datetime NOT NULL COMMENT '//发帖时间',
  `dg_last_modify_date` datetime NOT NULL COMMENT '//帖子修改时间',
  PRIMARY KEY  (`dg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

-- 
-- 导出表中的数据 `tg_article`
-- 

INSERT INTO `tg_article` VALUES (1, '刘看山', 1, 0, '我要发帖子了', '把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐。', 0, 0, '2016-08-18 17:36:55', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (2, '刘看山', 1, 0, '我要发帖子了', '把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐。', 0, 0, '2016-08-18 18:41:25', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (3, '刘看山', 1, 0, '我要发帖子了', '把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐。', 0, 0, '2016-08-18 18:44:32', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (4, '刘看山', 1, 0, '我要发表帖子', '我要发表帖子我要发表帖子我要发表帖子我要发表帖子我要发表帖子我要发表帖子', 0, 0, '2016-08-18 19:20:38', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (5, '刘看山', 1, 0, '知识的价值不在于占有，而在于使用', '知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用', 1, 0, '2016-08-18 19:23:04', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (6, '刘看山', 1, 0, '知识的价值不在于占有，而在于使用', '知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐', 1, 0, '2016-08-18 20:37:13', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (7, '刘看山', 1, 0, '知识的价值不在于占有，而在于使用', '知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐', 0, 0, '2016-08-18 20:38:58', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (8, '刘看山', 1, 0, '知识的价值不在于占有，而在于使用', '知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐', 0, 0, '2016-08-18 20:42:27', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (9, '刘看山', 1, 0, '知识的价值不在于占有，而在于使用', '知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐', 0, 0, '2016-08-18 20:45:49', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (10, '刘看山', 1, 0, '知识的价值不在于占有，而在于使用', '知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐', 0, 0, '2016-08-18 20:47:45', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (11, '刘看山', 1, 0, '知识的价值不在于占有，而在于使用', '知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐', 0, 0, '2016-08-18 20:49:30', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (12, '刘看山', 1, 0, '知识的价值不在于占有，而在于使用', '知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐', 0, 0, '2016-08-18 20:50:44', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (13, '刘看山', 1, 0, '知识的价值不在于占有，而在于使用', '知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐', 0, 0, '2016-08-18 20:55:47', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (14, '刘看山', 1, 0, '知识的价值不在于占有，而在于使用', '知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐', 0, 0, '2016-08-18 20:57:18', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (15, '刘看山', 1, 0, '知识的价值不在于占有，而在于使用', '知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐', 1, 0, '2016-08-18 21:03:30', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (16, '刘看山', 10, 0, '发帖', '知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐', 0, 0, '2016-08-18 21:14:18', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (17, '刘看山', 2, 0, '发帖', '知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐', 72, 0, '2016-08-18 21:18:01', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (18, '刘看山', 2, 0, '发帖', '让平凡的生活变得快乐知识的价值不在于占有，而在而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，[/b]\r\n[i]让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于[/i]\r\n[color=#f00]于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐[b]知识的价值不在于占有，[/color]', 2, 0, '2016-08-18 22:04:38', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (19, '刘看山', 2, 0, '发帖', '\r\n[i]让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于[/i]\r\n[color=#f00]于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐[b]知识的价值不在于占有，[/color][b]让平凡的生活变得快乐知识的价值不在于占有，而在而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，[/b]', 2, 0, '2016-08-18 22:05:16', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (20, '刘看山', 2, 0, '发帖', '\r\n[i]让平凡的生活变得快乐知识的价值不在于占有，而在于使用知识的价值不在于占有，而在于[/i]\r\n[color=#f00]于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐[b]知识的价值不在于占有，[/color][b]让平凡的生活变得快乐知识的价值不在于占有，而在而在于使用知识的价值不在于占有，而在于使用把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，[/b]', 6, 2, '2016-08-18 22:05:52', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (21, '刘看山', 2, 0, '发帖', '[b]在而在于使用知识的价值不在于占有[/b]\r\n[i]在而在于使用知识的价值不在于占有[/i]\r\n[color=#f00]在而在于使用知识的价值不在于占有[/color]\r\n', 9, 0, '2016-08-18 22:06:39', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (22, '刘看山', 10, 0, '接力中国男女队同进决赛 美国女队掉棒出局', '修改了乐视体育讯 北京时间8月18日消息，2016年里约奥运会田径男子4×100接力预赛，中国队跑出37秒82打破亚洲纪录排名小组第二顺利晋级决赛。不过稍后出场的日本队以37秒68又改写了新的亚洲纪录。中国女队受益美国队的掉棒，以预赛第8进入决赛。\r\n男子4×100接力一直是中国男队最为看重的项目，也是最有希望在奥运赛场上实现突破的项目，因为这项比赛不仅需要运动员的个人能力，还要看彼此间的配合，许多世界强队都曾在奥运赛场上出现交接棒的失误。去年的北京世锦赛，中国队拿到接力亚军，这让人更期待他们在里约的表现。\r\n预赛里中国队被分在第1小组的第4道，同组对手包括了美国、加拿大、法国。小组前三名将直接晋级，剩余队伍中成绩最好的两个将拿到决赛权。中国队派出了汤星强、谢震业、苏炳添和张培萌，美国队没有派出加特林，预赛登场的是罗杰斯、科尔曼、盖伊和劳森，法国队是雷尼、杜塔姆拜、泽泽和维考特，加拿大队是海恩斯、布朗、罗尼和阿乔马尔。\r\n第一枪，位于第1道的多米尼加选手德奥莱罗抢跑，他们无奈被罚下。第二枪比赛顺利开始，汤星强第一棒跑得不错，他和谢震业的交接棒也没有问题，这是中国队和第3道的美国队差距不大。苏炳添和盖伊几乎是同时进入弯道，美国队率先完成第4棒交接，劳森一马当先冲向终点，美国队拿到第一，成绩是37秒65。张培萌接棒时，中国队的名次掉到第3被加拿大队超越，但张培萌跑得相当不错，他成功反超第二个冲过终点，成绩是37秒82，这创造了新的亚洲纪录。加拿大队以37秒89排名第三，这三支队伍都直接晋级决赛。', 241, 11, '2016-08-19 07:56:23', '2016-08-19 21:35:29');
INSERT INTO `tg_article` VALUES (30, '刘看山', 1, 22, 'RE:RE:4×100接力中国男女队同进决赛 美国女队掉棒出局', '[img]qpic/2/1.gif[/img]', 0, 0, '2016-08-19 17:03:16', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (24, '三毛', 1, 22, 'RE:4×100接力中国男女队同进决赛 美国女队掉棒出局', '中国队，加油！[img]qpic/1/41.gif[/img]\r\n[img]qpic/2/10.gif[/img]', 0, 0, '2016-08-19 10:03:42', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (25, '阿童木', 1, 22, 'RE:4×100接力中国男女队同进决赛 美国女队掉棒出局', '永远支持你\r\n[img]qpic/3/13.gif[/img][img]qpic/3/2.gif[/img]', 0, 0, '2016-08-19 10:04:57', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (26, '小破孩', 1, 22, 'RE:4×100接力中国男女队同进决赛 美国女队掉棒出局', '我是小破孩，中国队好样的！\r\n[img]qpic/1/40.gif[/img][img]qpic/1/18.gif[/img]', 0, 0, '2016-08-19 10:06:19', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (27, '孙悟饭', 1, 22, 'RE:4×100接力中国男女队同进决赛 美国女队掉棒出局', '加油，中国队！\r\n[img]qpic/2/1.gif[/img]', 0, 0, '2016-08-19 10:07:49', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (28, '一休哥', 1, 22, 'RE:4×100接力中国男女队同进决赛 美国女队掉棒出局', '中国队冲击金牌\r\n[img]qpic/1/21.gif[/img]', 0, 0, '2016-08-19 10:09:05', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (29, '阿狸', 1, 22, 'RE:4×100接力中国男女队同进决赛 美国女队掉棒出局', '中国越来越强大了！\r\n[img]qpic/1/18.gif[/img]', 0, 0, '2016-08-19 10:10:29', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (31, '刘看山', 1, 22, 'RE:RE:4×100接力中国男女队同进决赛 美国女队掉棒出局', '[img]qpic/1/13.gif[/img][img]qpic/1/16.gif[/img][img]qpic/1/17.gif[/img]', 0, 0, '2016-08-19 17:03:37', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (32, '刘看山', 1, 22, 'RE:4×100接力中国男女队同进决赛 美国女队掉棒出局', '[img]qpic/1/6.gif[/img][img]qpic/1/3.gif[/img]', 0, 0, '2016-08-19 17:07:22', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (33, '刘看山', 1, 22, 'RE:4×100接力中国男女队同进决赛 美国女队掉棒出局', '[img]qpic/2/6.gif[/img][img]qpic/2/5.gif[/img][img]qpic/2/1.gif[/img]', 0, 0, '2016-08-19 17:07:36', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (34, '刘看山', 1, 22, 'RE:4×100接力中国男女队同进决赛 美国女队掉棒出局', '[img]qpic/1/5.gif[/img][img]qpic/1/8.gif[/img]', 0, 0, '2016-08-19 17:23:45', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (35, '刘看山', 1, 22, 'RE:4×100接力中国男女队同进决赛 美国女队掉棒出局', '[img]qpic/1/14.gif[/img][img]qpic/1/16.gif[/img]', 0, 0, '2016-08-19 17:23:56', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (36, '刘看山', 2, 20, 'RE:发帖', '[img]qpic/3/6.gif[/img][img]qpic/3/8.gif[/img]', 0, 0, '2016-08-19 17:54:02', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (37, '刘看山', 2, 20, 'RE:发帖', '[img]qpic/2/4.gif[/img]', 0, 0, '2016-08-19 17:54:28', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (38, '三毛', 1, 0, '林李终极对决', '[img]qpic/1/6.gif[/img]\r\n林李终极对决\r\n林李终极对决林李终极对决林李终极对决', 2, 0, '2016-08-19 20:26:42', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (39, '刘看山', 1, 22, '回复5楼的孙悟饭', '孙悟饭，我叫你一声你敢答应吗！[img]qpic/1/43.gif[/img]', 0, 0, '2016-08-20 09:49:35', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (40, '刘看山', 10, 0, '第一次发帖', '第一次发帖第一次发帖第一次发帖\r\n[img]qpic/1/5.gif[/img]', 1, 0, '2016-08-20 16:10:52', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (41, '刘看山', 1, 0, '第二次发帖', '第二次发帖第二次发帖第二次发帖', 2, 0, '2016-08-20 16:11:12', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (42, '刘看山', 1, 0, '第一次发帖', '[img]qpic/1/26.gif[/img]\r\n第一次发帖', 1, 0, '2016-08-20 16:14:19', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (43, '刘看山', 1, 22, 'RE:接力中国男女队同进决赛 美国女队掉棒出局', '[img]qpic/1/8.gif[/img][img]qpic/1/13.gif[/img][img]qpic/1/19.gif[/img]', 0, 0, '2016-08-20 16:25:54', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (44, '刘看山', 1, 22, 'RE:接力中国男女队同进决赛 美国女队掉棒出局', '[img]qpic/1/8.gif[/img][img]qpic/1/19.gif[/img]', 0, 0, '2016-08-20 16:26:18', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (45, '刘看山', 1, 22, 'RE:接力中国男女队同进决赛 美国女队掉棒出局', '第一次回帖[img]qpic/1/8.gif[/img][img]qpic/1/5.gif[/img]', 0, 0, '2016-08-21 15:09:38', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (46, '刘看山', 1, 22, 'RE:接力中国男女队同进决赛 美国女队掉棒出局', '第二次回帖[img]qpic/1/8.gif[/img][img]qpic/1/13.gif[/img]', 0, 0, '2016-08-21 15:10:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- 表的结构 `tg_dir`
-- 

CREATE TABLE `tg_dir` (
  `dg_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//相册ID',
  `dg_username` varchar(20) NOT NULL COMMENT '//相册名',
  `dg_type` tinyint(1) unsigned NOT NULL COMMENT '//相册类型',
  `dg_password` char(40) default NULL COMMENT '//相册密码',
  `dg_content` varchar(200) default NULL COMMENT '//相册描述内容',
  `dg_dir` varchar(200) NOT NULL COMMENT '//相册物理路径',
  `dg_face` varchar(200) default NULL COMMENT '//相册封面路径',
  `dg_date` datetime NOT NULL COMMENT '//相册创建日期',
  PRIMARY KEY  (`dg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- 导出表中的数据 `tg_dir`
-- 

INSERT INTO `tg_dir` VALUES (4, '卡通图片', 0, NULL, '海量卡通图片', 'photo/1471827366', '', '2016-08-22 08:56:06');
INSERT INTO `tg_dir` VALUES (5, '私密贴图集', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', '贴图相册修改了', 'photo/1471827401', 'monipic/chinajoy.jpg', '2016-08-22 08:56:41');

-- --------------------------------------------------------

-- 
-- 表的结构 `tg_flower`
-- 

CREATE TABLE `tg_flower` (
  `dg_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//ID',
  `dg_touser` varchar(20) NOT NULL COMMENT '//收花者',
  `dg_fromuser` varchar(20) NOT NULL COMMENT '//送花者',
  `dg_flower` mediumint(8) unsigned NOT NULL COMMENT '//花朵数量',
  `dg_content` varchar(200) NOT NULL COMMENT '//送花赠言',
  `dg_date` datetime NOT NULL COMMENT '//送花时间',
  PRIMARY KEY  (`dg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- 导出表中的数据 `tg_flower`
-- 

INSERT INTO `tg_flower` VALUES (1, '小破孩', '刘看山', 99, '灰常欣赏你哦！给你送花了！！！', '2016-08-17 19:25:26');
INSERT INTO `tg_flower` VALUES (2, '刘看山', '小破孩', 99, '灰常欣赏你哦！给你送花了！！！', '2016-08-17 19:46:46');
INSERT INTO `tg_flower` VALUES (3, '刘看山', '三毛', 18, '灰常欣赏你哦！给你送花了！！！', '2016-08-17 19:47:27');
INSERT INTO `tg_flower` VALUES (4, '刘看山', '三毛', 91, '灰常欣赏你哦！给你送花了！！！', '2016-08-17 19:47:36');
INSERT INTO `tg_flower` VALUES (5, '刘看山', '阿童木', 94, '灰常欣赏你哦！给你送花了！！！', '2016-08-17 19:48:13');

-- --------------------------------------------------------

-- 
-- 表的结构 `tg_friend`
-- 

CREATE TABLE `tg_friend` (
  `dg_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//ID',
  `dg_touser` varchar(20) NOT NULL COMMENT '//被添加的人',
  `dg_fromuser` varchar(20) NOT NULL COMMENT '//添加方',
  `dg_content` varchar(200) NOT NULL COMMENT '//验证信息',
  `dg_state` tinyint(1) NOT NULL default '0' COMMENT '//状态',
  `dg_date` datetime NOT NULL COMMENT '//添加时间',
  PRIMARY KEY  (`dg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

-- 
-- 导出表中的数据 `tg_friend`
-- 

INSERT INTO `tg_friend` VALUES (1, '孙悟饭', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 09:23:08');
INSERT INTO `tg_friend` VALUES (2, '花千骨', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 09:24:54');
INSERT INTO `tg_friend` VALUES (9, '猪八戒', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:07:15');
INSERT INTO `tg_friend` VALUES (10, '光头强', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:09:41');
INSERT INTO `tg_friend` VALUES (11, '半杯水', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:09:50');
INSERT INTO `tg_friend` VALUES (12, '中丸子', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:10:08');
INSERT INTO `tg_friend` VALUES (13, '千百度', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:10:13');
INSERT INTO `tg_friend` VALUES (14, '大黄峰', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:10:18');
INSERT INTO `tg_friend` VALUES (15, '草长莺飞', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:10:23');
INSERT INTO `tg_friend` VALUES (16, '变形金刚', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:10:28');
INSERT INTO `tg_friend` VALUES (17, '水娃', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:10:37');
INSERT INTO `tg_friend` VALUES (18, '梅长苏', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:10:41');
INSERT INTO `tg_friend` VALUES (19, '隐身娃', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:10:45');
INSERT INTO `tg_friend` VALUES (21, '阿童木', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:10:56');
INSERT INTO `tg_friend` VALUES (34, '刘看山', '一休哥', '我是一休哥,我想和你交朋友,可以吗！', 1, '2016-08-17 10:33:35');
INSERT INTO `tg_friend` VALUES (23, '柯南', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:11:03');
INSERT INTO `tg_friend` VALUES (33, '刘看山', '小破孩', '我是小破孩,我想和你交朋友', 1, '2016-08-17 10:32:33');
INSERT INTO `tg_friend` VALUES (25, '机器猫', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:11:14');
INSERT INTO `tg_friend` VALUES (27, '阿狸', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:11:21');
INSERT INTO `tg_friend` VALUES (28, '米老鼠', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:11:26');
INSERT INTO `tg_friend` VALUES (29, '冒险王', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:11:31');
INSERT INTO `tg_friend` VALUES (30, '超级玛丽', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:11:34');
INSERT INTO `tg_friend` VALUES (31, '七月天', '刘看山', '我是刘看山,我想和你交朋友', 1, '2016-08-17 10:11:38');
INSERT INTO `tg_friend` VALUES (32, '大魔王', '刘看山', '我是刘看山,我想和你交朋友', 0, '2016-08-17 10:11:45');

-- --------------------------------------------------------

-- 
-- 表的结构 `tg_message`
-- 

CREATE TABLE `tg_message` (
  `dg_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//发信人id',
  `dg_touser` varchar(20) NOT NULL COMMENT '//收信人',
  `dg_fromuser` varchar(20) NOT NULL COMMENT '//发信人',
  `dg_content` varchar(200) NOT NULL COMMENT '//发信内容',
  `dg_state` tinyint(1) NOT NULL default '0' COMMENT '//消息状态',
  `dg_date` datetime NOT NULL COMMENT '//发信时间',
  PRIMARY KEY  (`dg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- 
-- 导出表中的数据 `tg_message`
-- 

INSERT INTO `tg_message` VALUES (1, '银角大王', '刘看山', '银角大王，我们可以做朋友吗', 0, '2016-08-15 17:26:08');
INSERT INTO `tg_message` VALUES (2, '花千骨', '刘看山', '骨头，我们可以做朋友吗', 0, '2016-08-15 17:27:24');
INSERT INTO `tg_message` VALUES (3, '牛魔王', '刘看山', '牛魔王，交个朋友怎么样！', 0, '2016-08-15 17:30:49');
INSERT INTO `tg_message` VALUES (4, '花千骨', '刘看山', '骨头，我们交个朋友好吗！', 0, '2016-08-15 18:16:04');
INSERT INTO `tg_message` VALUES (5, '刘看山', '小破孩', '把昨天的烦恼交给风，让今天的感动化作笑容，给忙碌的心情放个假，让平凡的生活变得快乐。', 0, '2016-08-15 22:59:46');
INSERT INTO `tg_message` VALUES (6, '刘看山', '阿童木', '大海因浪花而美丽，人生因友谊而充实，我把快乐的音符作为礼物送给你,愿爱你的人更爱你,你爱的人更懂你! ', 0, '2016-08-15 23:01:16');
INSERT INTO `tg_message` VALUES (7, '刘看山', '一休哥', '方寸间，历数世上桑田沧海；时空里，细问人间暑往寒来；是朋友，星移斗转情不改；是知音，天涯海角记心怀。 ', 0, '2016-08-15 23:02:20');
INSERT INTO `tg_message` VALUES (8, '刘看山', '柯南', '风是透明的，雨是滴答的，云是流动的，歌是自由的，爱是用心的，恋是疯狂的，天是永恒的，你是难忘的。', 0, '2016-08-15 23:03:21');
INSERT INTO `tg_message` VALUES (9, '刘看山', '孙悟饭', '花是牡丹最美，人为朋友最亲，交友不交金和银，只交朋友一颗心。水流千里归大海，人走千里友谊在，大树之间根连根，朋友之间心连心。 ', 0, '2016-08-15 23:04:28');
INSERT INTO `tg_message` VALUES (10, '刘看山', '三毛', '见到你很开心，星空里万颗星，有一颗是我心，想我时看星星，失眠时数星星，许愿时等流星，好朋友天天要开心。 ', 0, '2016-08-15 23:05:47');
INSERT INTO `tg_message` VALUES (11, '刘看山', '机器猫', '夜色茫茫照四周，天边新月如钩。往事恍如梦，梦境何处求。人隔千里，路悠悠，请明月，代问候。', 1, '2016-08-15 23:06:51');
INSERT INTO `tg_message` VALUES (12, '刘看山', '龙猫', '日给你温暖，月给你温馨，星给你浪漫，风给你清爽，雨给你滋润，雪给你完美，霜给你晶莹，我给你祝福！ ', 1, '2016-08-15 23:07:41');
INSERT INTO `tg_message` VALUES (25, '冒险王', '阿童木', '大海因浪花而美丽，人生因友谊而充实，我把快乐的音符作为礼物送给你,愿爱你的人更爱你,你爱的人更懂你!.', 0, '2016-08-16 15:15:04');
INSERT INTO `tg_message` VALUES (19, '刘看山', '狂派金刚', '把生活酿成酒浆，用快乐作瓶，用微笑命名，用和谐构图，用舒畅着色，聘请看短信的你，做永远的品酒师。', 1, '2016-08-15 23:13:56');
INSERT INTO `tg_message` VALUES (20, '刘看山', '变形金刚', '初遇你的心情是温馨的，和你交友的时候是真心的，与你在一起的时候是开心的，认识你这个朋友是无怨无悔的。 ', 1, '2016-08-15 23:14:54');
INSERT INTO `tg_message` VALUES (24, '一休哥', '刘看山', '大海因浪花而美丽，人生因友谊而充实，我把快乐的音符作为礼物送给你,愿爱你的人更爱你,你爱的人更懂你!.', 0, '2016-08-16 15:10:45');

-- --------------------------------------------------------

-- 
-- 表的结构 `tg_photo`
-- 

CREATE TABLE `tg_photo` (
  `dg_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `dg_name` varchar(20) NOT NULL COMMENT '//图片名',
  `dg_url` varchar(200) NOT NULL COMMENT '//图片地址',
  `dg_content` varchar(200) NOT NULL COMMENT '//图片描述',
  `dg_sid` mediumint(8) unsigned NOT NULL COMMENT '//图片所在的目录',
  `dg_username` varchar(200) NOT NULL COMMENT '//上传者',
  `dg_readcount` mediumint(8) NOT NULL default '0' COMMENT '//浏览量',
  `dg_commendcount` mediumint(8) NOT NULL default '0' COMMENT '//评论量',
  `dg_date` datetime NOT NULL COMMENT '//图片上传时间',
  PRIMARY KEY  (`dg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- 
-- 导出表中的数据 `tg_photo`
-- 

INSERT INTO `tg_photo` VALUES (3, '女孩1', 'photo/1471827401/1471914109.jpg', '女孩写真', 5, '刘看山', 22, 0, '2016-08-23 09:02:33');
INSERT INTO `tg_photo` VALUES (4, '女孩2', 'photo/1471827401/1471914182.jpg', '写真女孩', 5, '刘看山', 8, 0, '2016-08-23 09:03:08');
INSERT INTO `tg_photo` VALUES (5, '写真女孩3', 'photo/1471827401/1471914202.jpg', '写真女孩', 5, '刘看山', 8, 0, '2016-08-23 09:03:25');
INSERT INTO `tg_photo` VALUES (6, '写真女孩4', 'photo/1471827401/1471914221.jpg', '写真女孩', 5, '刘看山', 8, 0, '2016-08-23 09:03:43');
INSERT INTO `tg_photo` VALUES (7, '写真女孩5', 'photo/1471827401/1471914239.jpg', '写真女孩', 5, '刘看山', 6, 0, '2016-08-23 09:04:02');
INSERT INTO `tg_photo` VALUES (8, '写真女孩6', 'photo/1471827401/1471914258.jpg', '写真女孩', 5, '刘看山', 5, 0, '2016-08-23 09:04:21');
INSERT INTO `tg_photo` VALUES (9, '写真女孩7', 'photo/1471827401/1471914277.jpg', '写真女孩', 5, '刘看山', 5, 0, '2016-08-23 09:04:40');
INSERT INTO `tg_photo` VALUES (10, '写真女孩8', 'photo/1471827401/1471914297.jpg', '写真女孩', 5, '刘看山', 5, 0, '2016-08-23 09:05:00');
INSERT INTO `tg_photo` VALUES (11, '写真女孩9', 'photo/1471827401/1471914322.jpg', '写真女孩', 5, '刘看山', 6, 0, '2016-08-23 09:05:24');
INSERT INTO `tg_photo` VALUES (12, '写真女孩10', 'photo/1471827401/1471914342.jpg', '写真女孩', 5, '刘看山', 159, 8, '2016-08-23 09:05:46');
INSERT INTO `tg_photo` VALUES (13, '卡通图片1', 'photo/1471827366/1471914402.jpg', '卡通图片', 4, '刘看山', 1, 0, '2016-08-23 09:06:45');
INSERT INTO `tg_photo` VALUES (14, '卡通图片2', 'photo/1471827366/1471914419.jpg', '卡通图片', 4, '刘看山', 2, 0, '2016-08-23 09:07:02');
INSERT INTO `tg_photo` VALUES (15, '卡通图片3', 'photo/1471827366/1471914440.jpg', '卡通图片', 4, '刘看山', 2, 0, '2016-08-23 09:07:22');
INSERT INTO `tg_photo` VALUES (16, '卡通图片4', 'photo/1471827366/1471914467.jpg', '卡通图片', 4, '刘看山', 2, 0, '2016-08-23 09:07:52');
INSERT INTO `tg_photo` VALUES (17, '卡通图片5', 'photo/1471827366/1471914491.jpg', '卡通图片', 4, '刘看山', 3, 0, '2016-08-23 09:08:13');
INSERT INTO `tg_photo` VALUES (18, '卡通图片6', 'photo/1471827366/1471914507.jpg', '卡通图片', 4, '刘看山', 3, 0, '2016-08-23 09:08:30');
INSERT INTO `tg_photo` VALUES (19, '卡通图片7', 'photo/1471827366/1471914524.jpg', '卡通图片', 4, '刘看山', 2, 0, '2016-08-23 09:08:49');
INSERT INTO `tg_photo` VALUES (20, '卡通图片8', 'photo/1471827366/1471914545.jpg', '卡通图片', 4, '刘看山', 2, 0, '2016-08-23 09:09:07');
INSERT INTO `tg_photo` VALUES (21, '卡通图片9', 'photo/1471827366/1471914567.jpg', '卡通图片', 4, '刘看山', 4, 0, '2016-08-23 09:09:30');
INSERT INTO `tg_photo` VALUES (22, '卡通图片10', 'photo/1471827366/1471914588.jpg', '卡通图片', 4, '刘看山', 4, 0, '2016-08-23 09:09:50');
INSERT INTO `tg_photo` VALUES (23, '动画图片11', 'photo/1471827366/1471915699.jpg', '动画图片11', 4, '刘看山', 6, 0, '2016-08-23 09:28:39');

-- --------------------------------------------------------

-- 
-- 表的结构 `tg_photo_comment`
-- 

CREATE TABLE `tg_photo_comment` (
  `dg_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `dg_title` varchar(20) NOT NULL COMMENT '//评论标题',
  `dg_content` text NOT NULL COMMENT '//评论内容',
  `dg_sid` mediumint(8) unsigned NOT NULL COMMENT '//图片id',
  `dg_username` varchar(20) NOT NULL COMMENT '//评论者',
  `dg_date` datetime NOT NULL COMMENT '//评论时间',
  PRIMARY KEY  (`dg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- 导出表中的数据 `tg_photo_comment`
-- 

INSERT INTO `tg_photo_comment` VALUES (1, 'RE:写真女孩10', '[img]qpic/1/5.gif[/img][img]qpic/1/8.gif[/img]\r\n好漂亮啊！[img]qpic/1/9.gif[/img]', 12, '刘看山', '2016-08-23 16:03:15');
INSERT INTO `tg_photo_comment` VALUES (2, 'RE:写真女孩10', '[img]qpic/1/8.gif[/img][img]qpic/1/5.gif[/img][img]qpic/1/4.gif[/img][img]qpic/1/15.gif[/img][img]qpic/1/3.gif[/img]', 12, '刘看山', '2016-08-23 16:03:51');
INSERT INTO `tg_photo_comment` VALUES (3, 'RE:写真女孩10', '[img]qpic/1/13.gif[/img][img]qpic/1/10.gif[/img][img]qpic/1/2.gif[/img]', 12, '刘看山', '2016-08-23 16:04:09');
INSERT INTO `tg_photo_comment` VALUES (4, 'RE:写真女孩10', '[img]qpic/1/9.gif[/img][img]qpic/1/13.gif[/img][img]qpic/1/10.gif[/img]', 12, '刘看山', '2016-08-23 16:04:38');
INSERT INTO `tg_photo_comment` VALUES (5, 'RE:写真女孩10', '[img]qpic/2/5.gif[/img][img]qpic/2/1.gif[/img][img]qpic/2/3.gif[/img]', 12, '刘看山', '2016-08-23 16:05:29');
INSERT INTO `tg_photo_comment` VALUES (6, 'RE:写真女孩10', '[img]qpic/1/13.gif[/img][img]qpic/1/19.gif[/img][img]qpic/1/18.gif[/img]', 12, '刘看山', '2016-08-23 16:05:49');
INSERT INTO `tg_photo_comment` VALUES (7, 'RE:写真女孩10', '[img]qpic/3/5.gif[/img][img]qpic/3/4.gif[/img][img]qpic/3/13.gif[/img][img]qpic/3/10.gif[/img][img]qpic/3/16.gif[/img][img]qpic/3/32.gif[/img][img]qpic/3/35.gif[/img]', 12, '刘看山', '2016-08-23 16:06:08');
INSERT INTO `tg_photo_comment` VALUES (8, 'RE:写真女孩10', '[img]qpic/1/13.gif[/img][img]qpic/1/8.gif[/img][img]qpic/1/15.gif[/img][img]qpic/1/18.gif[/img]', 12, '刘看山', '2016-08-23 16:33:36');

-- --------------------------------------------------------

-- 
-- 表的结构 `tg_system`
-- 

CREATE TABLE `tg_system` (
  `dg_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `dg_webname` varchar(20) NOT NULL COMMENT '//网站名称',
  `dg_article` tinyint(2) unsigned NOT NULL default '0' COMMENT '//文章分页数',
  `dg_blog` tinyint(2) unsigned NOT NULL default '0' COMMENT '//博友分页数',
  `dg_photo` tinyint(2) unsigned NOT NULL default '0' COMMENT '//相册分页数',
  `dg_skin` tinyint(1) unsigned NOT NULL default '0' COMMENT '//网站皮肤',
  `dg_string` varchar(200) NOT NULL COMMENT '//网站敏感字符',
  `dg_post` tinyint(3) unsigned NOT NULL default '0' COMMENT '//发帖限制',
  `dg_re` tinyint(3) unsigned NOT NULL default '0' COMMENT '//回帖限制',
  `dg_code` tinyint(1) unsigned NOT NULL default '0' COMMENT '//是否启用验证码',
  `dg_register` tinyint(1) unsigned NOT NULL default '0' COMMENT '//是否开放会员',
  PRIMARY KEY  (`dg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `tg_system`
-- 

INSERT INTO `tg_system` VALUES (1, '51web论坛', 10, 15, 12, 1, '我操,你妹的,搞毛啊,扯淡吧,傻蛋', 60, 15, 1, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `tg_user`
-- 

CREATE TABLE `tg_user` (
  `dg_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//自动编号',
  `dg_uniqid` char(40) NOT NULL COMMENT '//验证登录唯一标识符',
  `dg_active` char(40) NOT NULL COMMENT '//激活账户的唯一标识符',
  `dg_username` varchar(20) NOT NULL COMMENT '//用户名',
  `dg_password` char(40) NOT NULL COMMENT '//密码',
  `dg_question` varchar(20) NOT NULL COMMENT '//问题',
  `dg_answer` char(40) NOT NULL COMMENT '//答案',
  `dg_email` varchar(40) default NULL COMMENT '//邮件',
  `dg_qq` varchar(10) default NULL COMMENT '//QQ',
  `dg_url` varchar(40) default NULL COMMENT '//网址',
  `dg_sex` char(1) NOT NULL COMMENT '//性别',
  `dg_face` char(12) NOT NULL COMMENT '//头像',
  `dg_switch` tinyint(1) unsigned NOT NULL default '1' COMMENT '//个性签名开关',
  `dg_autograph` varchar(200) default NULL COMMENT '//个性签名',
  `dg_level` tinyint(1) unsigned NOT NULL default '0' COMMENT '//会员等级',
  `dg_reg_time` datetime NOT NULL COMMENT '//注册时间',
  `dg_last_time` datetime NOT NULL COMMENT '//最后登录时间',
  `dg_last_ip` varchar(20) NOT NULL COMMENT '//最后登录的IP',
  `tg_login_count` smallint(4) unsigned NOT NULL default '0' COMMENT '//登录次数统计',
  PRIMARY KEY  (`dg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

-- 
-- 导出表中的数据 `tg_user`
-- 

INSERT INTO `tg_user` VALUES (1, '8313781d3b315cbd110d3093f162ce86bb8c325c', '', '千百度', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456''', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m01.gif', 1, NULL, 0, '2016-08-11 17:18:14', '2016-08-11 17:18:14', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (2, '6449547be54f52b4173d20754931ad21f9cefc39', '', '半杯水', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456''', '976d3005cf91cbd39ea2fcaf599abecf48a3a256', '', '', 'http://www.baidu.com', '女', 'face/m01.gif', 1, NULL, 0, '2016-08-11 17:32:44', '2016-08-11 17:32:44', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (3, '197d5f8633a752fc6e80e0e4e093b3c308c9472c', '', '阳阳', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456''', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '女', 'face/m02.gif', 1, NULL, 0, '2016-08-11 17:40:32', '2016-08-11 17:40:32', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (4, '98d8c63476ac574747246ae4e28904291cf88cae', '51986ad9a9a5c538218579a9b1bf196e972b3e66', '小丸子', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456''', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '女', 'face/m03.gif', 1, NULL, 0, '2016-08-12 11:08:25', '2016-08-12 11:08:25', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (5, '560266ac754ce4b5ce0a42007b52a1904c097358', '00fb7f2e7ec559a28b6083a14c4457ae20ca79e8', '大丸子', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '111111', '7b52009b64fd0a2a49e6d8a939753077792b0554', '1109747853@qq.com', '12345678', 'http://www.baidu.com', '男', 'face/m01.gif', 1, NULL, 0, '2016-08-12 12:02:59', '2016-08-12 12:02:59', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (6, '5f4067246c5648e296df9f31e6a4530315003ce1', '', '中丸子', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111111', '7b52009b64fd0a2a49e6d8a939753077792b0554', '123456@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m01.gif', 1, NULL, 0, '2016-08-12 12:08:15', '2016-08-12 12:08:15', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (7, 'ce17127e7b82a6a4f82c3e19f8b00741aec778e7', '', '胖丸子', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '11111111', '7b52009b64fd0a2a49e6d8a939753077792b0554', '123456@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m01.gif', 1, NULL, 0, '2016-08-12 15:19:25', '2016-08-12 15:19:25', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (8, '2c7c64ee2f68c5f4511facaea34d02e5e4730df7', '', '刘看山', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '20eabe5d64b0e216796e834f52d61fd0b70332fc', '1109747853@qq.com', '123456789', 'http://www.baidu.com', '男', 'face/m01.gif', 0, '我是刘看山！', 1, '2016-08-12 17:16:50', '2016-09-02 11:31:28', '127.0.0.1', 36);
INSERT INTO `tg_user` VALUES (9, '331df5b88dd551ea16365dddfec7fa39cdcdac7f', '', '吃瓜群众', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8', '1111111', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1109747853@qq.com', '123456789', 'http://www.baidu.com', '女', 'face/m08.gif', 1, NULL, 0, '2016-08-12 22:41:31', '2016-08-12 22:41:31', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (11, '3b1f85b84a9bac02fbed53c3a61ea776c21fa926', '', '奥特man', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8', '1234''54454''', 'c00125a37e0a0ef2f0e0657cbc55f1aafb60b453', '1109747853@qq.com', '123456789', 'http://www.baidu.com', '女', 'face/m06.gif', 1, NULL, 0, '2016-08-12 22:46:17', '2016-08-12 22:46:17', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (12, 'c5a230650dd7cd9f62405e23faca18feae13b5c1', '', '喜洋洋', 'b47d926911d4e6b8201f801a151f5b82d513cf09', '123654789', 'f21c4a5372e695e5ec75701121805b80cd04e72b', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m05.gif', 1, NULL, 0, '2016-08-12 22:47:16', '2016-08-12 22:47:16', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (13, '52f47ebd763a193c6b0602a2eab579a4a9a6f266', '', '懒洋洋', 'b2ee60370ad57d9bc3877e9024c507ab99303a64', '123654789', 'a68b17f0f9e45601040d132f7bf8aec0c479d4f2', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '女', 'face/m11.gif', 1, NULL, 0, '2016-08-12 22:48:01', '2016-08-12 22:48:01', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (14, '12970447251c44b92e19670ca55b98d260de7d03', '', '美洋洋', '97ef30b919ff7e5d7fdc19967a31387fa22ce42e', '1246465165', 'fc09b924659a903e4ab358b97cb503a18cfff249', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m06.gif', 1, NULL, 0, '2016-08-12 22:49:05', '2016-08-12 22:49:05', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (15, '73a2859ebd84949a8125b184fad5069fca9882c8', '', '灰太狼', '268898dece5052735352eb754d75d2e45eb73c57', '147859357', '0b7b1bf867f45174a700b76570b21a928f92f722', '1109747853@qq.com', '14785247', 'http://www.baidu.com', '男', 'face/m07.gif', 1, NULL, 0, '2016-08-12 22:51:00', '2016-08-12 22:51:00', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (16, 'ec5a0afd921180e276e9137f3c7abe0323149103', '', '光头强', '104c513b93ae69b9f1da75e38857930426e1722c', '14785247', '24f6ee4aa0d2b4a61896bd58364ae2fab80ebedf', '1109747853@qq.com', '1478595472', 'http://www.baidu.com', '女', 'face/m01.gif', 1, NULL, 0, '2016-08-12 22:52:01', '2016-08-12 22:52:01', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (17, '8f9532f3866ebcfd8d07db352164c0f2cd3529a9', '', '熊大', '8cd22e557953f508da6598f9b4ccdc1089a774c3', '123456', '976d3005cf91cbd39ea2fcaf599abecf48a3a256', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m26.gif', 1, NULL, 0, '2016-08-12 22:53:26', '2016-08-12 22:53:26', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (18, '42906b87801de13a98c5940cedb49502941228b2', '', '熊二', 'c59653f8f5ad8afb58a12bb681ce09811feaf576', '654978478648', 'af7178ba3118c49db70b9719932a05f924c61275', '1109747853@qq.com', '14785247', 'http://www.baidu.com', '男', 'face/m01.gif', 1, NULL, 0, '2016-08-12 22:55:05', '2016-08-12 22:55:05', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (19, 'd2547f94d2a8dbe6dd7c9d4591b94749660f1eb7', '', '孙悟空', '3a41af6a661b7b8afdadf1fd3d3da2ac1ad64aba', '354646349', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m43.gif', 1, NULL, 0, '2016-08-12 22:56:12', '2016-08-12 22:56:12', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (20, '85a340458be83fc6970dde222985609fb3d0bde8', '', '猪八戒', 'b2ee60370ad57d9bc3877e9024c507ab99303a64', '1478529', '5e27890eaca7796af66ed80c1137fd3b2f6b0da6', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m48.gif', 1, NULL, 0, '2016-08-12 22:57:38', '2016-08-12 22:57:38', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (21, '582383d5e37b841ac8cd64aeae4cbd00c62d4fc9', '', '牛魔王', '7c4a8d09ca3762af61e59520943dc26494f8941b', '12587489', '20146f8de76f6e521a6971a66ff8c1c23e6d9111', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m01.gif', 1, NULL, 0, '2016-08-12 23:00:28', '2016-08-12 23:00:28', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (22, '57468fdf284e0f49f79533d35d5b3571d4d9f1ba', '', '花千骨', 'b2ee60370ad57d9bc3877e9024c507ab99303a64', '123456', '20eabe5d64b0e216796e834f52d61fd0b70332fc', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '女', 'face/m28.gif', 1, NULL, 0, '2016-08-12 23:01:48', '2016-08-12 23:01:48', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (23, '34a2c505bdb7376645ae4b1b0998ac7cccb37b80', '', '梅长苏', '40c5169448af7279279c2b4041455ee4b0ab5cd1', '1478529', 'fd5c5936fefc2526da7466a043fe9f8375b56279', '1109747853@qq.com', '14785296', 'http://www.baidu.com', '男', 'face/m01.gif', 1, NULL, 0, '2016-08-12 23:04:10', '2016-08-12 23:04:10', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (24, 'd063b869a96e2e9f4d0a4adab5ac8cd7db4a2dce', '', '聂风', '88e7a34c720a7cfce1b89e3a65192d5b5e87082e', '123456', '1ada44ee0ee309f5100eda6e89d1c2f9994b65f2', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m01.gif', 1, NULL, 0, '2016-08-12 23:05:35', '2016-08-12 23:05:35', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (25, '8d046bc6b1f67d7c7c8000a2b51b21dc1622d998', '', '水娃', 'b2ee60370ad57d9bc3877e9024c507ab99303a64', '5646136598', '095b3029bcfe736775b40bf23f6eb10efbc7458e', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m01.gif', 1, NULL, 0, '2016-08-12 23:09:09', '2016-08-12 23:09:09', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (26, '276db6026282ae786d5de5559c7359d83e87f678', '', '火娃', 'b2ee60370ad57d9bc3877e9024c507ab99303a64', '658494657', '039eefc5e95a32d6da001a9fec29712b11bb663a', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m42.gif', 1, NULL, 0, '2016-08-12 23:10:03', '2016-08-12 23:10:03', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (27, '5f1cb89503def7a40db9035078ce81d6fbb45d9c', '', '隐身娃', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1236547', '0a11ab54a97201096012af4f1550b2ab765031c8', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m22.gif', 1, NULL, 0, '2016-08-12 23:10:51', '2016-08-12 23:10:51', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (28, '6c99673999d22c98d8ca265bfedfbabb5b939312', '', '大娃', 'b62e62eaca035c179a63c4e868ca930fffb7e682', '56461265898', '8b7fecda8a5c392b9ce0e03ef57566520722f2a0', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m29.gif', 1, NULL, 0, '2016-08-12 23:12:14', '2016-08-12 23:12:14', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (29, 'ab5467c5945a9740ab13ab3ed9f1e88b3b6d3080', '', '二娃', 'b2ee60370ad57d9bc3877e9024c507ab99303a64', '354661654984', '40429974fb28fb1500a9611746abf85aa8e81d59', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m01.gif', 1, NULL, 0, '2016-08-12 23:12:59', '2016-08-12 23:12:59', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (35, '7cbb488ba9d413931957eeafeafbb0ef806237e4', '', '三娃', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1234567', '48f63a52665c46e2a5596eafda2d4b858c17804f', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m34.gif', 1, NULL, 0, '2016-08-13 16:21:58', '2016-08-13 16:21:58', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (32, '45b9f08b4163cda1b0a400236ed6b4409054f78b', '', '金角大王', '7c4a8d09ca3762af61e59520943dc26494f8941b', '12365478', 'cf6795da1ef2ab0d009f075c796e5773327e4699', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m01.gif', 1, NULL, 0, '2016-08-13 15:51:57', '2016-08-13 15:51:57', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (33, '078556c468bc75b3a0f9d7f9768a6c0c6604bacf', '', '银角大王', '7c4a8d09ca3762af61e59520943dc26494f8941b', '56461678', 'c646c394aca5965e3594c984ce9b56cfac5d67cd', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m01.gif', 1, NULL, 0, '2016-08-13 15:52:48', '2016-08-13 15:52:48', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (34, 'adb445c93bf11af281c6d8f2e49d88806b2421e1', '', '二狗', '268898dece5052735352eb754d75d2e45eb73c57', '1234''54454''', '976d3005cf91cbd39ea2fcaf599abecf48a3a256', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m28.gif', 1, NULL, 0, '2016-08-13 15:54:54', '2016-08-13 15:54:54', '127.0.0.1', 0);
INSERT INTO `tg_user` VALUES (36, '550ae036c0812f5fb46bf6ab00e86312dc3cea74', '', '小蜜蜂', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1234567', '67599011287248250be4f05830867b25fba88bef', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '女', 'face/m47.gif', 1, NULL, 0, '2016-08-15 22:29:16', '2016-08-15 23:17:17', '127.0.0.1', 1);
INSERT INTO `tg_user` VALUES (37, '7ac23d095fb33052eebea9dd9bf04ad55e1c0126', '', '草长莺飞', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '39cebfad161e838026b367a33659e709a3bc8b6b', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '女', 'face/m26.gif', 1, NULL, 0, '2016-08-15 22:31:28', '2016-08-15 23:16:20', '127.0.0.1', 1);
INSERT INTO `tg_user` VALUES (38, '0d4650f21a0c44c3df83ca3e91640efe454039b5', '', '大黄峰', '7c4a8d09ca3762af61e59520943dc26494f8941b', '546135478', 'c2e4758727b5372602d69e64885d84ea6129314c', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '女', 'face/m01.gif', 1, NULL, 0, '2016-08-15 22:33:11', '2016-08-15 23:15:20', '127.0.0.1', 1);
INSERT INTO `tg_user` VALUES (39, 'ab0310f99f04baa07f3de6f07403e7272d76cf7a', '', '变形金刚', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1236547', 'f40e2cb1be77f012f54e74f8d9bc564c927bc2f3', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m41.gif', 1, NULL, 0, '2016-08-15 22:34:21', '2016-08-15 23:14:28', '127.0.0.1', 1);
INSERT INTO `tg_user` VALUES (40, '77bcf5cafe42abb4d07b623b7f634186dac90dfc', '', '狂派金刚', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1236547', '0fba381cde378431c7f4f1c9d0e10839a6107678', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m08.gif', 1, NULL, 0, '2016-08-15 22:35:32', '2016-08-15 23:13:35', '127.0.0.1', 1);
INSERT INTO `tg_user` VALUES (41, '975b05448fa91a3e625251e4dc646e636618e6e2', '', '大魔王', '7c4a8d09ca3762af61e59520943dc26494f8941b', '65461687', 'dbf39de1d4e7a8e807a2e2cb9e8cf07e13551659', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m47.gif', 1, NULL, 0, '2016-08-15 22:36:36', '2016-08-15 23:12:46', '127.0.0.1', 1);
INSERT INTO `tg_user` VALUES (42, '7ff64c5e8f1acab5b1d344fc6aaf868b210037cb', '', '七月天', '7c4a8d09ca3762af61e59520943dc26494f8941b', '654946298', '885097936f4b8021b16e897b0079ad2d022e3bc3', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m37.gif', 1, NULL, 0, '2016-08-15 22:37:51', '2016-08-15 23:11:42', '127.0.0.1', 1);
INSERT INTO `tg_user` VALUES (43, 'd64999596747f811eae4a85aad7984296e600b55', '', '超级玛丽', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1234587', '564a588f866b8aa79683160c770b2226fa0220bd', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m58.gif', 1, NULL, 0, '2016-08-15 22:39:50', '2016-08-15 23:10:50', '127.0.0.1', 1);
INSERT INTO `tg_user` VALUES (44, '362dc36043a842a1e9cdabacd31695e320a46da4', '', '冒险王', '7c4a8d09ca3762af61e59520943dc26494f8941b', '654986167/', '6f057f059d2ffb499d19260375e3fcc9afefca1a', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m45.gif', 1, NULL, 0, '2016-08-15 22:41:01', '2016-08-15 23:10:03', '127.0.0.1', 1);
INSERT INTO `tg_user` VALUES (45, '006546a012be5677e538737262d34dfb66b92473', '', '米老鼠', '7c4a8d09ca3762af61e59520943dc26494f8941b', '56496298451', '5d730305a465b41d1efd4bebdaa103f49f96fadf', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m19.gif', 1, NULL, 0, '2016-08-15 22:42:22', '2016-08-15 23:09:08', '127.0.0.1', 1);
INSERT INTO `tg_user` VALUES (46, '9db6e745e729e7f3a13fd513a4b7a527b5d02537', '', '阿狸', '7c4a8d09ca3762af61e59520943dc26494f8941b', '35146846165', '7f41e0d6ae6e5d310115daf98ec507178e8b5567', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '女', 'face/m46.gif', 1, NULL, 0, '2016-08-15 22:43:33', '2016-08-24 09:34:58', '127.0.0.1', 8);
INSERT INTO `tg_user` VALUES (47, '81b4921e33709ee6d17fb7919786975ad090f1f7', '', '龙猫', '7c4a8d09ca3762af61e59520943dc26494f8941b', '541943067', 'b720b60a4c6654a76b27ba049883e5223a5e539f', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m41.gif', 1, NULL, 0, '2016-08-15 22:44:58', '2016-08-15 23:07:21', '127.0.0.1', 1);
INSERT INTO `tg_user` VALUES (48, 'ae1e15d9f714c4ce93597c78fad64bd05e95a65c', '', '机器猫', '7c4a8d09ca3762af61e59520943dc26494f8941b', '12345789', 'fd5bc0e6f0ffd0bfd3b7dfe02d9e8844fc8d5d10', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m59.gif', 1, NULL, 0, '2016-08-15 22:46:54', '2016-08-15 23:06:20', '127.0.0.1', 1);
INSERT INTO `tg_user` VALUES (49, 'a52975482288ed206c7b8fadbf33891ab1483d38', '', '三毛', '7c4a8d09ca3762af61e59520943dc26494f8941b', '351630137984', '40f82fa52aae8536928b5932f43d855e89a65a41', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m01.gif', 0, '我是三毛啊', 1, '2016-08-15 22:48:27', '2016-08-20 21:37:25', '127.0.0.1', 11);
INSERT INTO `tg_user` VALUES (50, '30787185df198d12ca87bd03bb2bbbd202c1836a', '', '孙悟饭', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2316531298746', '7d5467dea5708338540dc44a178bcb11f0a449f2', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m59.gif', 1, NULL, 0, '2016-08-15 22:50:04', '2016-08-19 10:07:00', '127.0.0.1', 2);
INSERT INTO `tg_user` VALUES (51, 'b9948d102530d9c2c5f8547da1f37d6b84f1a6b0', '', '柯南', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1234567', '2fc50bc49c77eb2fca1833f491e5fc21c236792a', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m07.gif', 1, NULL, 0, '2016-08-15 22:51:46', '2016-08-15 23:02:57', '127.0.0.1', 1);
INSERT INTO `tg_user` VALUES (52, '33200c40066c4e3d1ed4fc055b25b0b66465ab5d', '', '一休哥', '7c4a8d09ca3762af61e59520943dc26494f8941b', '5191365494', '922733d180404c4e915f1eae07beef05611dc7f5', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m60.gif', 1, NULL, 0, '2016-08-15 22:56:20', '2016-08-19 10:08:19', '127.0.0.1', 3);
INSERT INTO `tg_user` VALUES (53, '41a8c0e4770d0963165f1f249e77e72398fc0309', '', '阿童木', '7c4a8d09ca3762af61e59520943dc26494f8941b', '168498', '2dec7d7619c55ea368a76b69e05a404b4974cb78', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m44.gif', 1, NULL, 1, '2016-08-15 22:57:21', '2016-08-19 10:04:16', '127.0.0.1', 5);
INSERT INTO `tg_user` VALUES (54, '81ebbf435d4235213800c90958ba921ee1db075a', '', '小破孩', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123654', '0cd23fb93f15c8a49d14bdd3f8008015403f73dd', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '男', 'face/m47.gif', 1, NULL, 1, '2016-08-15 22:58:47', '2016-08-21 20:56:19', '127.0.0.1', 5);
INSERT INTO `tg_user` VALUES (55, '8673b9c6717e9f2456729722229ef24d8056ac75', '', '洪荒少女', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '639833f35e84ce844f21066914b371db2daca961', '1109747853@qq.com', '1109747853', 'http://www.baidu.com', '女', 'face/m59.gif', 1, NULL, 0, '2016-08-17 21:35:32', '2016-08-17 21:35:32', '127.0.0.1', 0);
