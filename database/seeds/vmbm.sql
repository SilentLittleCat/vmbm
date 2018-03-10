-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2018-02-28 02:12:45
-- 服务器版本： 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vmbm`
--

-- --------------------------------------------------------

--
-- 表的结构 `account_logs`
--

DROP TABLE IF EXISTS `account_logs`;
CREATE TABLE IF NOT EXISTS `account_logs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `from_id` int(10) UNSIGNED NOT NULL COMMENT '来源对象id',
  `from_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源对象名称',
  `op` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作，charge：冲值，support：消耗，withdraw：提现',
  `from_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作类型，1、余额，2、梦想币，3、现金',
  `from_amount` int(10) UNSIGNED NOT NULL COMMENT '操作金额from',
  `to_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作类型，1、余额，2、梦想币，3、现金',
  `to_id` int(10) UNSIGNED NOT NULL COMMENT '目标对象id',
  `to_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源目标对象名称',
  `to_amount` int(10) UNSIGNED NOT NULL COMMENT '操作金额to',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_from` (`from_id`),
  KEY `idx_to` (`to_id`),
  KEY `idx_from_type` (`from_type`),
  KEY `idx_to_type` (`to_type`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `admin_access`
--

DROP TABLE IF EXISTS `admin_access`;
CREATE TABLE IF NOT EXISTS `admin_access` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT '角色的ID',
  `menu_id` int(11) NOT NULL COMMENT '菜单ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_access_role_id` (`role_id`),
  KEY `idx_deleted_at` (`deleted_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `admin_menus`
--

DROP TABLE IF EXISTS `admin_menus`;
CREATE TABLE IF NOT EXISTS `admin_menus` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `path` char(60) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'URL',
  `name` char(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '节点的名字',
  `display` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1为显示为菜单，0则不显示',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `level` tinyint(4) NOT NULL DEFAULT '1' COMMENT '第几级菜单',
  `ico` char(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '菜单图标',
  `mark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_deleted_at` (`deleted_at`)
) ENGINE=MyISAM AUTO_INCREMENT=624 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_menus`
--

INSERT INTO `admin_menus` (`id`, `pid`, `path`, `name`, `display`, `sort`, `level`, `ico`, `mark`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, '#', '系统管理', 1, 2, 1, 'fa-globe', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(2, 0, '#', '用户管理', 0, 99, 1, 'fa-bar-chart-o', '', '2016-12-31 16:00:00', '2018-02-02 08:34:36', NULL),
(3, 0, '#', '商品管理', 0, 98, 1, 'fa-calendar', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(5, 0, '#', '公共权限', 0, 0, 1, 'fa-cart-plus', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(6, 0, '#', '缓存管理', 0, 94, 1, 'fa-magic', '', '2016-12-31 16:00:00', '2018-02-02 08:35:07', NULL),
(7, 0, '#', '数据报表', 0, 96, 1, 'fa-globe', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(9, 0, '#', '参数设置', 0, 95, 1, 'fa-bar-chart-o', '', '2017-01-04 10:32:17', '2018-02-02 08:34:57', NULL),
(103, 1, 'Base/Menus/index', '菜单管理', 1, 0, 1, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(104, 1, 'Base/Role/index', '角色管理', 1, 0, 2, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(105, 1, 'Base/User/index', '账号管理', 1, 0, 2, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(501, 5, 'Base/Index/index', '首页（必选）', 0, 0, 2, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(502, 5, 'Base/Index/welcome', '欢迎页', 0, 0, 1, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(503, 5, 'Base/Login/logout', '退出页', 0, 0, 1, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(519, 103, 'Base/Menus/create', '添加菜单', 0, 0, 3, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(520, 103, 'Base/Menus/update', '修改菜单', 0, 0, 3, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(521, 103, 'Base/Menus/destroy', '删除菜单', 0, 0, 3, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(522, 104, 'Base/Role/create', '添加角色', 0, 0, 3, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(523, 104, 'Base/Role/update', '修改角色', 0, 0, 3, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(524, 104, 'Base/Role/auth', '角色授权', 0, 0, 3, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(525, 104, 'Base/Role/destroy', '删除角色', 0, 0, 3, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(526, 105, 'Base/User/update', '编辑用户', 0, 0, 3, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(543, 5, 'Base/Attachment/upload', '编辑器上传', 0, 0, 2, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(544, 105, 'Base/User/auth', '为用户授权', 0, 1, 3, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(578, 1, 'Base/Crud/create', 'Crud', 1, 0, 1, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(579, 6, 'Cache/File/clearcache', '清空缓存', 1, 0, 1, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(580, 6, 'Cache/File/clearview', '清空模板缓存', 1, 0, 1, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(581, 6, 'Cache/File/clearsessions', '强制在线用户下线', 1, 0, 1, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(582, 6, 'Cache/File/index', '文件管理', 1, 0, 1, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(583, 6, 'Cache/File/view', '文件查看', 0, 0, 1, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(596, 1, 'Base/Settings/index', '系统配置', 1, 0, 2, '', '', '2016-03-29 11:42:29', '2016-03-29 11:42:29', NULL),
(597, 2, 'User/Info/index', '用户列表', 1, 1, 1, '', '', '2017-04-04 22:39:13', '2017-04-04 22:39:13', NULL),
(598, 597, 'User/Info/create', '添加', 0, 1, 1, '', '', '2017-04-04 22:39:13', '2017-04-04 22:39:13', NULL),
(599, 597, 'User/Info/update', '修改', 0, 1, 1, '', '', '2017-04-04 22:39:13', '2017-04-04 22:39:13', NULL),
(600, 597, 'User/Info/destroy', '删除', 0, 1, 1, '', '', '2017-04-04 22:39:13', '2017-04-04 22:39:13', NULL),
(601, 597, 'User/Info/view', '查看', 0, 1, 1, '', '', '2017-04-04 22:39:13', '2017-04-04 22:39:13', NULL),
(602, 597, 'User/Info/check', '选择数据', 0, 1, 1, '', '', '2017-04-04 22:39:13', '2017-04-04 22:39:13', NULL),
(542, 5, 'Foundation/Attachment/webupload', '文件上传', 0, 0, 2, '', '', '2016-12-31 16:00:00', '2016-12-31 16:00:00', NULL),
(604, 596, 'Base/Settings/create', '添加', 0, 1, 1, '', ' ', '2017-05-30 20:56:09', '2017-05-30 20:56:09', NULL),
(605, 596, 'Base/Settings/update', '修改', 0, 1, 1, '', ' ', '2017-05-30 20:56:09', '2017-05-30 20:56:09', NULL),
(606, 596, 'Base/Settings/destroy', '删除', 0, 1, 1, '', ' ', '2017-05-30 20:56:09', '2017-05-30 20:56:09', NULL),
(607, 596, 'Base/Settings/view', '查看', 0, 1, 1, '', ' ', '2017-05-30 20:56:09', '2017-05-30 20:56:09', NULL),
(608, 596, 'Base/Settings/check', '选择数据', 0, 1, 1, '', ' ', '2017-05-30 20:56:09', '2017-05-30 20:56:09', NULL),
(609, 1, 'Base/Photos/index', '图片管理', 1, 1, 2, '', '图片管理', '2017-08-01 22:43:20', '2017-08-01 22:43:21', NULL),
(610, 0, '#', '设备管理', 1, 1000, 1, 'fa-laptop', '设备管理', '2018-01-29 22:17:12', '2018-01-29 23:49:28', NULL),
(611, 610, 'Device/index', '设备列表', 1, 100, 2, '', '设备列表', '2018-01-29 23:50:15', '2018-01-29 23:50:15', NULL),
(612, 0, '#', '客户管理', 1, 900, 1, 'fa-users', '客户管理', '2018-02-02 07:37:33', '2018-02-02 07:37:33', NULL),
(613, 612, 'Client/index', '客户列表', 1, 100, 2, '', '客户列表', '2018-02-02 07:40:17', '2018-02-02 07:40:17', NULL),
(614, 0, '#', '广告管理', 1, 800, 1, 'fa-adn', '广告管理', '2018-02-07 04:08:32', '2018-02-07 04:08:32', NULL),
(615, 614, 'AD/index', '广告列表', 1, 100, 2, '', '广告列表', '2018-02-07 04:13:00', '2018-02-07 04:13:00', NULL),
(616, 0, '#', '粉丝管理', 1, 700, 1, 'fa-user', '粉丝管理', '2018-02-07 21:38:17', '2018-02-07 21:38:17', NULL),
(617, 616, 'Fan/index', '粉丝列表', 1, 100, 2, '', '粉丝列表', '2018-02-07 21:38:53', '2018-02-07 21:58:49', NULL),
(618, 0, '#', '纸巾管理', 1, 600, 1, 'fa-paper-plane', '纸巾管理', '2018-02-07 21:39:34', '2018-02-07 21:39:34', NULL),
(619, 618, 'Tissue/index', '纸巾列表', 1, 100, 2, '', '纸巾列表', '2018-02-07 21:40:17', '2018-02-07 21:40:17', NULL),
(620, 0, '', '统计管理', 1, 1100, 1, 'fa-bar-chart-o', '统计管理', '2018-02-10 05:59:27', '2018-02-10 05:59:37', NULL),
(622, 0, '#', '参数管理', 1, 500, 1, 'fa-cog', '参数管理', '2018-02-21 03:24:23', '2018-02-21 03:24:23', NULL),
(623, 622, 'Setting/index', '参数设置', 1, 100, 2, '', '参数设置', '2018-02-21 03:25:40', '2018-02-21 03:25:40', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_operate_logs`
--

DROP TABLE IF EXISTS `admin_operate_logs`;
CREATE TABLE IF NOT EXISTS `admin_operate_logs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` char(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'GET',
  `request_data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `md5` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `admin_roles`
--

DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE IF NOT EXISTS `admin_roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` char(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色名称',
  `mark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '备注',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '是否禁用',
  `level` smallint(6) NOT NULL COMMENT '用户组等级，低等级的不能对高等级的用户做修改',
  `department_id` char(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '部门ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_deleted_at` (`deleted_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `real_name` char(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '实名',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '密码',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'EMAIL',
  `mobile` char(11) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '手机号',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户头像',
  `type` tinyint(4) NOT NULL COMMENT '类型,0:用户,1:员工',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后一次登录时间',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态，1启用0禁用',
  `is_root` tinyint(4) DEFAULT NULL COMMENT '是否是超级管理员',
  `admin_role_id` text COLLATE utf8mb4_unicode_ci COMMENT '角色',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_deleted_at` (`deleted_at`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `real_name`, `password`, `remember_token`, `email`, `mobile`, `avatar`, `type`, `last_login_time`, `status`, `is_root`, `admin_role_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user1', 'user1', '$2y$10$UoV98gi6hkodz8nWezLCDekcEPgRHKB91tufTacsI.v/Cw91qCqRe', NULL, 'user1@163.com', '123456', 'http://webimg-handle.liweijia.com/upload/avatar/avatar_0.jpg', 0, NULL, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ads`
--

DROP TABLE IF EXISTS `ads`;
CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `wechat_id` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信/公众号ID',
  `wechat_name` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信/公众号名',
  `name` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商家名称',
  `tel` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商家电话',
  `money` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '投放充值金额',
  `limit` int(10) UNSIGNED DEFAULT '0' COMMENT '吸粉数量上限',
  `num` int(10) UNSIGNED DEFAULT '0' COMMENT '已吸粉数量',
  `day_limit` int(10) UNSIGNED DEFAULT '0' COMMENT '每日吸粉数量上限',
  `day_num` int(10) UNSIGNED DEFAULT '0' COMMENT '每日关注量',
  `begin_date` date DEFAULT NULL COMMENT '投放开始日期',
  `end_date` date DEFAULT NULL COMMENT '投放截止日期',
  `flag` tinyint(4) DEFAULT '0' COMMENT '轮换标志：0为默认；1为正在轮换',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态：0为下架；1为上架',
  `info` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
  `back_code` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '自动回复信息',
  `url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '自动回复信息',
  `img` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '二维码地址',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `a_d_clients`
--

DROP TABLE IF EXISTS `a_d_clients`;
CREATE TABLE IF NOT EXISTS `a_d_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ad_id` int(10) UNSIGNED DEFAULT '0',
  `client_id` int(10) UNSIGNED DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `base_area`
--

DROP TABLE IF EXISTS `base_area`;
CREATE TABLE IF NOT EXISTS `base_area` (
  `id` int(11) NOT NULL COMMENT '编号',
  `name` char(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `pid` int(11) NOT NULL COMMENT '父级',
  `short_name` char(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '简称',
  `grade` tinyint(4) NOT NULL COMMENT '层级关系',
  `city_code` smallint(6) NOT NULL COMMENT '区号',
  `zip_code` int(11) NOT NULL COMMENT '邮编',
  `merger_name` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '关系值',
  `lng` double(8,2) NOT NULL COMMENT '精度',
  `lat` double(8,2) NOT NULL COMMENT '维度',
  `pinyin` char(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '拼音',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pid` (`pid`),
  KEY `idx_deleted_at` (`deleted_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `base_attachments`
--

DROP TABLE IF EXISTS `base_attachments`;
CREATE TABLE IF NOT EXISTS `base_attachments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '附件名称',
  `md5` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'md5码',
  `path` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '附件路径',
  `url` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '附件url',
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '未分类' COMMENT '分类',
  `size` bigint(20) UNSIGNED DEFAULT NULL,
  `file_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `klass` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '关联模型',
  `objid` int(10) UNSIGNED DEFAULT NULL COMMENT '关联id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_md5` (`md5`),
  KEY `idx_klass_objid` (`klass`,`objid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `base_dictionary_option`
--

DROP TABLE IF EXISTS `base_dictionary_option`;
CREATE TABLE IF NOT EXISTS `base_dictionary_option` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dictionary_table_code` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '数据字典表',
  `dictionary_code` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '数据字典代码',
  `key` varchar(21) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '程序中使用，数据库使用value',
  `value` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '编码',
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `input_code` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '输入码，通常用于保留拼音',
  `sort` int(11) NOT NULL COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_table_code` (`dictionary_table_code`,`dictionary_code`),
  KEY `idx_deleted_at` (`deleted_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `base_settings`
--

DROP TABLE IF EXISTS `base_settings`;
CREATE TABLE IF NOT EXISTS `base_settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置代码',
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置名称',
  `sort` int(10) UNSIGNED NOT NULL COMMENT '排序',
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置类型',
  `pid` int(10) UNSIGNED NOT NULL COMMENT '父id',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '图片状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_category` (`category`),
  KEY `idx_code` (`key`),
  KEY `idx_pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  UNIQUE KEY `cache_key_unique` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `class` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `classes`
--

INSERT INTO `classes` (`id`, `class`, `created_at`, `updated_at`) VALUES
(1, '未分类', '2018-02-24 11:33:33', '2018-02-24 11:33:33');

-- --------------------------------------------------------

--
-- 表的结构 `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '用户名',
  `password` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '密码',
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_phone_unique` (`phone`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT '0' COMMENT '所属客户',
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '无' COMMENT '名称',
  `type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '无' COMMENT '型号',
  `location` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '无' COMMENT '地点',
  `IMEI` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '无' COMMENT '编码，IMEI地址',
  `code` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT '无' COMMENT '二维码',
  `ticket` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '获取二维码的ticket',
  `auth_status` tinyint(4) DEFAULT '0' COMMENT '审核状态：0，未审核；1，审核通过；2，审核不过',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态：0，离线；1，在线；2，缺纸；3，故障',
  `tissue_num` int(11) DEFAULT '0' COMMENT '纸巾数',
  `status_date_time` datetime DEFAULT NULL COMMENT '状态日期标志',
  `out` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'no' COMMENT '是否出纸：yes,no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `fans`
--

DROP TABLE IF EXISTS `fans`;
CREATE TABLE IF NOT EXISTS `fans` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `wechat_id` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信ID',
  `wechat_name` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信名',
  `status` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '状态：0未关注；1已关注',
  `money` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '消费金额',
  `num` int(10) UNSIGNED DEFAULT '0' COMMENT '获得纸巾数',
  `buy_num` int(10) UNSIGNED DEFAULT '0' COMMENT '购买纸巾数',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(4, '2016_06_01_000004_create_oauth_clients_table', 1),
(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(6, '2017_04_02_113151_create_account_logs_table', 1),
(7, '2017_05_30_203519_create_admin_access_table', 1),
(8, '2017_05_30_203520_create_admin_menus_table', 1),
(9, '2017_05_30_203521_create_admin_operate_logs_table', 1),
(10, '2017_05_30_203521_create_admin_roles_table', 1),
(11, '2017_05_30_203522_create_admin_users_table', 1),
(12, '2017_05_30_203523_create_base_area_table', 1),
(13, '2017_05_30_203523_create_base_attachments_table', 1),
(14, '2017_05_30_203524_create_base_dictionary_option_table', 1),
(15, '2017_05_30_203524_create_base_settings_table', 1),
(16, '2017_05_30_203526_create_user_info_table', 1),
(17, '2017_08_02_143732_create_classes_table', 1),
(18, '2017_11_10_145204_create_cache_table', 1),
(19, '2018_01_30_062312_create_devices_table', 1),
(20, '2018_02_02_153323_create_clients_table', 1),
(21, '2018_02_07_073806_create_a_ds_table', 1),
(22, '2018_02_07_094408_create_fans_table', 1),
(23, '2018_02_07_094521_create_tissues_table', 1),
(24, '2018_02_08_065812_add_info_to_tissue', 1),
(25, '2018_02_11_194152_add_ticket_to_devices', 1),
(26, '2018_02_11_194500_add_status_to_fans', 1),
(27, '2018_02_11_194755_create_records_table', 1),
(28, '2018_02_11_221228_add_img_to_ads', 1),
(29, '2018_02_12_085648_create_tissue_records_table', 1),
(30, '2018_02_12_205504_add_back_code_to_ads', 1),
(31, '2018_02_12_214622_add_password_to_clients_table', 1),
(32, '2018_02_19_093442_create_a_d_clients_table', 1),
(33, '2018_02_19_133951_add_day_num_to_ads_table', 1),
(34, '2018_02_21_112837_create_settings_table', 1),
(35, '2018_02_24_191154_add_out_to_devices_table', 1),
(36, '2018_02_27_213831_create_wechat_orders_table', 2);

-- --------------------------------------------------------

--
-- 表的结构 `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `records`
--

DROP TABLE IF EXISTS `records`;
CREATE TABLE IF NOT EXISTS `records` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fan_id` int(10) UNSIGNED NOT NULL COMMENT '购买的微信用户ID',
  `device_id` int(10) UNSIGNED NOT NULL COMMENT '设备ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '键',
  `value` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '值',
  `show_key` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '显示键',
  `show_value` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '显示值',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `tissues`
--

DROP TABLE IF EXISTS `tissues`;
CREATE TABLE IF NOT EXISTS `tissues` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fan_id` int(10) UNSIGNED NOT NULL COMMENT '购买的微信用户ID',
  `device_id` int(10) UNSIGNED NOT NULL COMMENT '设备ID',
  `ad_id` int(10) UNSIGNED DEFAULT NULL COMMENT '领取时点击了哪个广告',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态：0领取；1购买',
  `num` int(10) UNSIGNED DEFAULT '0' COMMENT '份数',
  `money` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '付款金额',
  `info` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '备注',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `tissue_records`
--

DROP TABLE IF EXISTS `tissue_records`;
CREATE TABLE IF NOT EXISTS `tissue_records` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fan_id` int(10) UNSIGNED DEFAULT NULL COMMENT '购买/领取的微信用户ID',
  `ad_id` int(10) UNSIGNED DEFAULT NULL COMMENT '关注的广告ID',
  `type` tinyint(4) DEFAULT '0' COMMENT '类型：0领取；1购买',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态：0创建；1使用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='领取/购买预记录';

-- --------------------------------------------------------

--
-- 表的结构 `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `site_id` int(11) DEFAULT NULL COMMENT '站点ID',
  `username` char(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '登录名',
  `real_name` char(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '姓名',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '密码',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'EMAIL',
  `mobile` char(11) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '手机号',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户头像',
  `gender` tinyint(4) NOT NULL COMMENT '性别,1:男,2:女,参照数据字典',
  `province` int(11) DEFAULT NULL COMMENT '居住地址省',
  `city` int(11) DEFAULT NULL COMMENT '居住地址市',
  `county` int(11) DEFAULT NULL COMMENT '居住地址区县',
  `work_type` tinyint(4) DEFAULT NULL COMMENT '工作类型：上班，自由职业者',
  `other_info` text COLLATE utf8mb4_unicode_ci COMMENT '配偶或其他信息',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '详细地址',
  `address_time` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '居住时长',
  `home_type` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '居住类型',
  `idcard` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '身份证号',
  `idcard_positive` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '身份证正面',
  `idcard_back` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '身份证背面',
  `photo` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '正面照',
  `zhima_img` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '芝麻信用',
  `other_img` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_img` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `educational` tinyint(4) DEFAULT NULL COMMENT '学历',
  `marital` tinyint(4) DEFAULT NULL COMMENT '婚姻状况',
  `contact_bind` tinyint(4) DEFAULT NULL COMMENT '直系亲属联系人关系',
  `contact_name` char(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '直系亲属联系人姓名',
  `contact_mobile` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '直系亲属联系人手机',
  `other_contact_bind` tinyint(4) DEFAULT NULL COMMENT '其他联系人关系',
  `other_contact_name` char(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '直系亲属联系人姓名',
  `other_contact_mobile` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '直系亲属联系人手机',
  `xuexin_account` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '学信网账号',
  `xuexin_password` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '学信网密码',
  `carrieroperator_mobile` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '运营商手机',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后一次登录时间',
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_deleted_at` (`deleted_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `wechat_orders`
--

DROP TABLE IF EXISTS `wechat_orders`;
CREATE TABLE IF NOT EXISTS `wechat_orders` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fan_id` int(10) UNSIGNED DEFAULT NULL COMMENT '购买的微信用户ID',
  `device_id` int(10) UNSIGNED DEFAULT NULL COMMENT '设备ID',
  `transaction_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '微信内部订单ID',
  `total_fee` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '总金额：分',
  `cash_fee` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '现金金额：分',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态：0创建；1支付成功；2支付失败',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
