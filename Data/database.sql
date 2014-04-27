-- --------------------------------------------------------------
--
-- FileName: database.sql
-- Description: QgjyCMS系统数据库源码
-- Database: MySQL5.6.12
-- DatabaseName: `qgjy`
-- Charset: utf-8
-- TablePrefix: qgjy_
-- Author: WangNan
-- Verison: 0.1
-- Since: 2013-12-27 19:48:37
-- Alter Date: 
--
-- --------------------------------------------------------------


-- --------------------------------------------------------------
-- Database: `qgjy`
-- Description: 系统数据库创建
-- --------------------------------------------------------------
DROP DATABASE IF EXISTS `qgjy`;
CREATE DATABASE `qgjy` CHARSET=UTF8;
USE qgjy;


-- --------------------------------------------------------------
-- Table(1): `qgjy_module`
-- Description: 模型信息表
--
DROP TABLE IF EXISTS `qgjy_module`;
CREATE TABLE `qgjy_module`(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,          -- 主键(ID)
    `classify` varchar(10)  NOT NULL DEFAULT '',            -- 分类 Classify
    `type` tinyint(1) NOT NULL DEFAULT '0',                 -- 类型(0:正常, 1:URL)
    `url` varchar(255) NOT NULL DEFAULT '',                 -- 连接到的 URL
    `admid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',     -- 添加人 ID
    `admname` VARCHAR(30) NOT NULL DEFAULT '',              -- 添加人名称
    `title` VARCHAR(100) NOT NULL DEFAULT '',               -- 文章标题
    `img` VARCHAR(100) NOT NULL DEFAULT '',                 -- 文章封面
    `summary` VARCHAR(255) NOT NULL DEFAULT '',             -- 摘要
    `author` VARCHAR(100) NOT NULL DEFAULT '',              -- 作者
    `copyfrom` VARCHAR(100) NOT NULL DEFAULT '',            -- 来源
    `readnum` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',   -- 浏览数量
    `addtime` INT(10) UNSIGNED NOT NULL DEFAULT '0',        -- 添加时间
    `updatetime` INT(10) UNSIGNED NOT NULL DEFAULT '0',     -- 最后修改时间
    `isrec` TINYINT(1) NOT NULL DEFAULT '0',                -- 是否推荐
    `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',      -- 状态
    `content` TEXT NOT NULL,                                -- 内容
    PRIMARY KEY(`id`),
    KEY `title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

-- --------------------------------------------------------------
-- Table(2): `qgjy_user`
-- Description: 用户基本信息表
--
DROP TABLE IF EXISTS `qgjy_user`;
CREATE TABLE `qgjy_user`(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,          -- 主键(ID) 
    `loginname` VARCHAR(60) NOT NULL DEFAULT '',            -- 登录名
    `password` CHAR(32) NOT NULL DEFAULT '',                -- 密码 MD5
    `rank` tinyint(1) NOT NULL DEFAULT '0',                 -- 级别
    `nickname` VARCHAR(30) NOT NULL DEFAULT '',             -- 昵称
    `lastlogintime` INT(10) NOT NULL DEFAULT '0',           -- 最后登录时间
    `lastloginip` CHAR(15) NOT NULL DEFAULT '',             -- 最后登录IP
    `loginnum` INT(10) UNSIGNED NOT NULL DEFAULT '0',       -- 登录次数
    `regtime` INT(10) UNSIGNED NOT NULL DEFAULT '0',        -- 注册时间
    `realname` VARCHAR(20) NOT NULL DEFAULT '',             -- 真实姓名
    `sex` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',         -- 性别
    `email` VARCHAR(60) NOT NULL DEFAULT '',                -- E-mail
    `birthday` date NOT NULL DEFAULT '0000-00-00',          -- 生日
    `phone` CHAR(11) NOT NULL DEFAULT '',                   -- 电话
    `qq` VARCHAR(20) NOT NULL DEFAULT '',                   -- QQ
    `q1` VARCHAR(100) NOT NULL DEFAULT '',                  -- 密保问题1
    `a1` VARCHAR(100) NOT NULL DEFAULT '',                  -- 密保回答1
    `q2` VARCHAR(100) NOT NULL DEFAULT '',                  -- 密保问题2
    `a2` VARCHAR(100) NOT NULL DEFAULT '',                  -- 密保回答2
    `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',      -- 状态
    PRIMARY KEY(`id`),
    UNIQUE KEY(`loginname`),
    UNIQUE KEY(`nickname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------------
-- Table(3): `qgjy_message`
-- Description: 留言信息表
--
DROP TABLE IF EXISTS `qgjy_message`;
CREATE TABLE `qgjy_message`(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,   -- 主键 ID
    `userid` INT(10) UNSIGNED NOT NULL DEFAULT '0',  -- 留言的用户ID
    `title` VARCHAR(255) NOT NULL DEFAULT '',        -- 评论标题
    `loginname` VARCHAR(60) NOT NULL DEFAULT '',     -- 登录名
    `nickname` VARCHAR(60) NOT NULL DEFAULT '',      -- 评论的用户昵称
    `ischeck` TINYINT(1) NOT NULL DEFAULT '0',       -- 是否通过审核
    `isreply` TINYINT(1) NOT NULL DEFAULT '0',       -- 是否回复
    `addtime` INT(10) NOT NULL DEFAULT '0',          -- 评论时间
    `addip` CHAR(15) NOT NULL DEFAULT '',            -- 评论IP
    `content` TINYTEXT NOT NULL,                     -- 评论内容
    PRIMARY KEY(`id`),
    KEY `userid` (`userid`),
    KEY `ischeck` (`ischeck`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

-- --------------------------------------------------------------
-- Table(4): `qgjy_config`
-- Description: 系统配置信息表
--
DROP TABLE IF EXISTS `qgjy_config`;
CREATE TABLE `qgjy_config`(
    `key` VARCHAR(60) NOT NULL DEFAULT '',    -- 配置键
    `value` TINYTEXT NOT NULL,                -- 配置值
    PRIMARY KEY(`key`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

-- --------------------------------------------------------------
-- Table(5): `qgjy_teacher`
-- Description: 师资信息表
--
DROP TABLE IF EXISTS `qgjy_teacher`;
CREATE TABLE `qgjy_teacher`(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,          -- 主键(ID)
    `name` VARCHAR(100)  NOT NULL DEFAULT '',               -- 教师姓名
    `sex` TINYINT(1) NOT NULL DEFAULT '0',                  -- 性别(0:女, 1:男)
    `age` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',         -- 年龄
    `img` VARCHAR(100) NOT NULL DEFAULT '',                 -- 教师封面图
    `teachage` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',    -- 教龄
    `edubg` VARCHAR(100) NOT NULL DEFAULT '',               -- 学历
    `teachbg` VARCHAR(100) NOT NULL DEFAULT '',             -- 资历
    `course` VARCHAR(100) NOT NULL DEFAULT '',              -- 所带科目
    `department` VARCHAR(100) NOT NULL DEFAULT '',          -- 所属部门
    `addtime` INT(10) UNSIGNED NOT NULL DEFAULT '0',        -- 添加时间
    `summary` VARCHAR(255) NOT NULL DEFAULT '',             -- 简介
    `isrec` TINYINT(1) NOT NULL DEFAULT '0',                -- 是否推荐
    `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',      -- 状态
    `content` TEXT NOT NULL,                                -- 介绍
    PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

-- --------------------------------------------------------------
-- Table(6): `qgjy_exam`
-- Description: 招考信息表
--
DROP TABLE IF EXISTS `qgjy_exam`;
CREATE TABLE `qgjy_exam`(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,          -- 主键(ID)
    `title` VARCHAR(100)  NOT NULL DEFAULT '',              -- 标题
    `who` VARCHAR(100) NOT NULL DEFAULT '',                 -- 招考对象
    `job` VARCHAR(100) NOT NULL DEFAULT '',                 -- 招考职位
    `area` VARCHAR(100) NOT NULL DEFAULT '',                -- 招考区域
    `starttime` VARCHAR(30) NOT NULL DEFAULT '',            -- 招考开始时间
    `endtime` VARCHAR(30) NOT NULL DEFAULT '',              -- 招考结束时间
    `summary` VARCHAR(255) NOT NULL DEFAULT '',             -- 简介
    `admid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',     -- 添加人 ID
    `admname` VARCHAR(30) NOT NULL DEFAULT '',              -- 添加人名称
    `addtime` INT(10) UNSIGNED NOT NULL DEFAULT '0',        -- 添加时间
    `isrec` TINYINT(1) NOT NULL DEFAULT '0',                -- 是否推荐
    `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',      -- 状态
    `content` TEXT NOT NULL,                                -- 介绍
    PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

-- --------------------------------------------------------------
-- Table(7): `qgjy_admin`
-- Description: 系统管理员信息表
--
DROP TABLE IF EXISTS `qgjy_admin`;
CREATE TABLE `qgjy_admin` (
    `id` mediumint(8) unsigned NOT NULL auto_increment,     
    `loginname` varchar(60) NOT NULL default '',            
    `password` char(32) NOT NULL default '',                
    `power` tinyint(1) NOT NULL default '0',                
    `cardid` varchar(18) NOT NULL default '',               
    `realname` varchar(60) NOT NULL default '',             
    `sex` tinyint(1) unsigned NOT NULL default '0',         
    `addtime` int(10) unsigned NOT NULL default '0',        
    `lasttime` int(10) unsigned NOT NULL default '0',       
    `lastip` char(15) NULL default '',                      
    `logincount` smallint(5) unsigned NOT NULL default '0', 
    `phone` varchar(20) NOT NULL default '',                
    `qq` varchar(20) NOT NULL default '',                   
    `email` varchar(60) NOT NULL default '',                
    `address` varchar(255) NOT NULL default '',             
    `rubbish` tinyint(1) NOT NULL default '-1',             
    `status` tinyint(1) NOT NULL default '1',               
    `remark` varchar(255) NOT NULL default '',              
    PRIMARY KEY (`id`),
    UNIQUE KEY (`loginname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------------
-- Table(8): `qgjy_down`
-- Description: 系统资料下载数据表
--
DROP TABLE IF EXISTS `qgjy_down`;
CREATE TABLE `qgjy_down`(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,       -- 主键(ID)
    `title` VARCHAR(100) NOT NULL DEFAULT '',             -- 标题
    `summary` VARCHAR(255) NOT NULL DEFAULT '',           -- 摘要
	`downpath` VARCHAR(255) NOT NULL,                     -- 下载地址
    `downum` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',  -- 下载数量
    `admid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',   -- 添加人 ID
    `admname` VARCHAR(30) NOT NULL DEFAULT '',            -- 添加人名称
    `addtime` INT(10) UNSIGNED NOT NULL DEFAULT '0',      -- 添加时间
    `power` TINYINT(1) NOT NULL DEFAULT '0',              -- 下载权限
    `content` TEXT NOT NULL,                              -- 内容
    `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',    -- 状态
    PRIMARY KEY(`id`),
    KEY `title` (`title`),
    KEY `addtime` (`addtime`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

-- --------------------------------------------------------------
-- Table(9): `qgjy_company`
-- Description: 企业文化数据信息表
--
DROP TABLE IF EXISTS `qgjy_company`;
CREATE TABLE `qgjy_company`(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,       -- 主键(ID)
    `title` VARCHAR(100) NOT NULL DEFAULT '',            -- 标题
    `img` VARCHAR(100) NOT NULL DEFAULT '',              -- 封面图
    `admid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',  -- 添加人 ID
    `admname` VARCHAR(30) NOT NULL DEFAULT '',           -- 添加人名称
    `addtime` INT(10) UNSIGNED NOT NULL DEFAULT '0',     -- 添加时间
    `summary` VARCHAR(255) NOT NULL DEFAULT '',          -- 摘要
    `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',   -- 状态
    `content` TEXT NOT NULL,                             -- 内容
    PRIMARY KEY(`id`),
    KEY `title` (`title`),
    KEY `addtime` (`addtime`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;


-- --------------------------------------------------------------
-- 初始化数据
-- --------------------------------------------------------------
-- Table(4): `qgjy_config`
insert into `qgjy_config`(`key`,`value`) values('phone',''),('url',''),('post',''),('qq',''),('qqg',''),('addr',''),('icp','');
