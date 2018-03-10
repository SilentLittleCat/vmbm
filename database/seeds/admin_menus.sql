-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2018-02-21 03:33:40
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
