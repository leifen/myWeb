-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-03-27 16:26:03
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myweb`
--

-- --------------------------------------------------------

--
-- 表的结构 `dou_admin_log`
--

CREATE TABLE IF NOT EXISTS `dou_admin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `action` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `create_time` (`create_time`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- 转存表中的数据 `dou_admin_log`
--

INSERT INTO `dou_admin_log` (`id`, `create_time`, `user_id`, `action`, `ip`) VALUES
(1, 1459068089, 1, '添加分类 : 路由器', '127.0.0.1'),
(2, 1459068165, 1, '添加分类 : 交换机', '127.0.0.1'),
(3, 1459068622, 1, '添加商品 : 华为（HUAWEI）AR1220-S 8口百兆企业级VPN路由器', '127.0.0.1'),
(4, 1459068656, 1, '添加案例分类 : 酒店', '127.0.0.1'),
(5, 1459068679, 1, '添加案例分类 : 网吧', '127.0.0.1'),
(6, 1459068715, 1, '添加案例 : 星港酒店', '127.0.0.1'),
(7, 1459068753, 1, '添加分类 : 企业新闻', '127.0.0.1'),
(8, 1459068772, 1, '添加分类 : 行业新闻', '127.0.0.1'),
(9, 1459068801, 1, '添加方案分类 : 酒店解决方案', '127.0.0.1'),
(10, 1459068827, 1, '添加方案分类 : 网吧解决方案', '127.0.0.1'),
(11, 1459068853, 1, '添加导航 : 产品中心', '127.0.0.1'),
(12, 1459068861, 1, '添加导航 : 客户案例', '127.0.0.1'),
(13, 1459068881, 1, '添加导航 : 新闻资讯', '127.0.0.1'),
(14, 1459068890, 1, '添加导航 : 解决方案', '127.0.0.1'),
(15, 1459068900, 1, '添加导航 : 留言反馈', '127.0.0.1'),
(16, 1459068975, 1, '添加单页面 : 关于我们', '127.0.0.1'),
(17, 1459068975, 1, '添加单页面 : 关于我们', '127.0.0.1'),
(18, 1459068981, 1, '删除单页面 : 关于我们', '127.0.0.1'),
(19, 1459069011, 1, '添加单页面 : 服务于支持', '127.0.0.1'),
(20, 1459069031, 1, '添加导航 : 关于我们', '127.0.0.1'),
(21, 1459069047, 1, '编辑导航 : 关于我们', '127.0.0.1'),
(22, 1459069052, 1, '编辑导航 : 关于我们', '127.0.0.1'),
(23, 1459069061, 1, '添加导航 : 服务于支持', '127.0.0.1'),
(24, 1459069099, 1, '编辑导航 : 留言反馈', '127.0.0.1'),
(25, 1459069107, 1, '编辑导航 : 关于我们', '127.0.0.1'),
(26, 1459069121, 1, '编辑导航 : 服务于支持', '127.0.0.1'),
(27, 1459069127, 1, '编辑导航 : 关于我们', '127.0.0.1'),
(28, 1459069368, 1, '编辑商品 : 华为（HUAWEI）AR1220-S 8口百兆企业级VPN路由器', '127.0.0.1'),
(29, 1459069448, 1, '编辑商品 : 华为（HUAWEI）AR1220-S 8口百兆企业级VPN路由器', '127.0.0.1'),
(30, 1459076741, 1, '管理员登录 : 登录成功！', '127.0.0.1'),
(31, 1459076768, 1, '添加幻灯 : 幻灯1', '127.0.0.1'),
(32, 1459076793, 1, '添加幻灯 : 幻灯2', '127.0.0.1'),
(33, 1459080473, 1, '添加方案 : 移动互联网产品设计的核心要素有哪些？', '127.0.0.1'),
(34, 1459080728, 1, '添加文章 : 移动互联网产品设计的核心要素有哪些？', '127.0.0.1'),
(35, 1459080788, 1, '编辑文章 : 移动互联网产品设计的核心要素有哪些？', '127.0.0.1'),
(36, 1459081307, 1, '添加方案 : 详解如何利用RSS进行网络推广', '127.0.0.1'),
(37, 1459083155, 1, '添加案例分类 : 网吧', '127.0.0.1'),
(38, 1459083187, 1, '添加案例分类 : 酒店', '127.0.0.1'),
(39, 1459083381, 1, '编辑案例分类 : 网吧1', '127.0.0.1'),
(40, 1459083438, 1, '编辑案例分类 : 酒店1', '127.0.0.1'),
(41, 1459083536, 1, '添加案例分类 : test', '127.0.0.1'),
(42, 1459083544, 1, '删除案例分类 : test', '127.0.0.1'),
(43, 1459084297, 1, '添加案例 : 星港酒店', '127.0.0.1'),
(44, 1459085213, 1, '编辑客户案例 : 星港酒店1', '127.0.0.1'),
(45, 1459085247, 1, '编辑客户案例 : 星港酒店', '127.0.0.1'),
(46, 1459085262, 1, '编辑案例分类 : 酒店', '127.0.0.1'),
(47, 1459085270, 1, '编辑客户案例 : 星港酒店', '127.0.0.1'),
(48, 1459085311, 1, '添加案例分类 : 网吧', '127.0.0.1'),
(49, 1459085404, 1, 'CASE_DEL : 星港酒店', '127.0.0.1'),
(50, 1459085470, 1, '添加案例 : test', '127.0.0.1'),
(51, 1459085487, 1, '添加案例 : 时发生地方', '127.0.0.1'),
(52, 1459085502, 1, '添加案例 : 士大夫似的发顺丰', '127.0.0.1'),
(53, 1459085523, 1, '编辑客户案例 : 士大夫似的发顺丰', '127.0.0.1'),
(54, 1459086172, 1, '批量修改所属分类 : 客户案例 IN ( 5,4,3 )', '127.0.0.1'),
(55, 1459086198, 1, '批量修改所属分类 : 客户案例 IN ( 5,4,3 )', '127.0.0.1'),
(56, 1459086238, 1, '批量删除 : 客户案例 IN ( 5,4 )', '127.0.0.1'),
(57, 1459086325, 1, '添加案例 : test2', '127.0.0.1'),
(58, 1459087249, 1, '添加案例 : test3', '127.0.0.1'),
(59, 1459087303, 1, '添加案例 : 移动互联网产品设计的核心要素有哪些？', '127.0.0.1'),
(60, 1459088228, 1, '编辑客户案例 : 移动互联网产品设计的核心要素有哪些？', '127.0.0.1'),
(61, 1459088527, 1, '编辑客户案例 : 移动互联网产品设计的核心要素有哪些？', '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `dou_article`
--

CREATE TABLE IF NOT EXISTS `dou_article` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` smallint(5) NOT NULL DEFAULT '0',
  `title` varchar(150) NOT NULL DEFAULT '',
  `defined` text,
  `content` longtext,
  `image` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `click` smallint(6) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `dou_article`
--

INSERT INTO `dou_article` (`id`, `cat_id`, `title`, `defined`, `content`, `image`, `keywords`, `add_time`, `click`, `description`, `sort`) VALUES
(1, 1, '移动互联网产品设计的核心要素有哪些？', '', '移动互联网和传统互联网的设计有很多不同&lt;br /&gt;\r\n\r\n移动互联网和传统互联网的设计有很多不同，针对前者有哪些关键的设计重点、考虑要素、交互或体验要特别注意的呢？本文来自知乎网友可风的回答。&lt;br /&gt;\r\n&lt;br /&gt;\r\n可风&lt;br /&gt;\r\n&lt;br /&gt;\r\n最近越来越多的圈内人开始随大潮进入移动互联网领域，从传统的web或者桌面端设计开始学习移动互联网产品的设计。在很多人眼里，设计移动互联网产品和传\r\n统互联网产品的区别无非就是载体从电脑变成了手机，所以只要熟悉一下各个手机中不同的规范和特性就算是完成了过渡，学习了下ios human \r\nguideline，了解了一下拟物化设计和扁平化设计，就以为是了解了移动互联网的设计方法。其实这种思想完全是只看到表现而没看到本质的错误，移动互\r\n联网和传统互联网的区别不光是设计标准和设计规范的变化，而应该从整个物理环境的变化来重新全面的认识。那么我们分析一下，移动互联网产品的用户体验和传\r\n统互联网产品有什么区别呢？&lt;br /&gt;\r\n&lt;br /&gt;\r\n一、使用场景的复杂&lt;br /&gt;\r\n&lt;br /&gt;\r\n用户在使用桌面客户端或者访问web页面的时候，多半是坐在电脑前，固定的盯着屏幕和使用键鼠操作，这个时候对于用户来说，使用场景是简单而固定的。但是\r\n在使用手机的时候，用户可能在地铁中，在公交上，在电梯中，无聊等待时或者边走路边用。如此复杂的场景，需要产品的设计者考虑的要素也自然非常的复杂。&lt;br /&gt;\r\n&lt;br /&gt;\r\n比如在公交车上拥挤和摇晃时，用户如果才能顺畅的单手操作？比如在地铁或者电梯的信号不好的情况下，是否要考虑各种网络情况带来的问题？比如用户在无聊等待玩游戏，或者在床上睡前时，又变成了深入沉浸的体验？不同的场景不同的情况在设计时是否都有考虑清楚？&lt;br /&gt;\r\n&lt;br /&gt;\r\n二、使用时间碎片化&lt;br /&gt;\r\n&lt;br /&gt;\r\n用户在使用电脑时，大部分时间还是固定的，无非可能因为工作和同事沟通一下，或者起身上个厕所，一般都有10-20分钟完整的时间片在操作电脑。但是移动\r\n端就不一样了，用户既然在移动，使用手机时要随时随地观察周围的情况，随时可能中断现在的操作，锁屏，再继续刚才的操作。所以用户使用移动产品的时间不是\r\n连成片的，而是一段一段的，有的时候中断回再回来，有的时候中断就不会回来了。&lt;br /&gt;\r\n&lt;br /&gt;\r\n三、屏幕尺寸的缩小&lt;br /&gt;\r\n&lt;br /&gt;\r\n用户使用电脑产品的屏幕尺寸是可以很大的，小则13寸大到27寸，这样使得桌面产品和web产品有充足的区域展现信息，整个界面利用率就可以很高。我们在\r\n做交互设计的时候会有一种方法，如果一个次要信息的出现不会影响大部分用户的时候，那么这个次要信息是可以放在界面上的，这就是为什么网站可以加入很多广\r\n告banner的原因，因为只要保持到一个度不影响正常的使用就不会破坏整体的用户体验。但是在移动端，这个度是非常的小的，因为屏幕尺寸的限制，本身需\r\n要你展现的必要信息都需要有一个合理的规划和抉择，次要的信息再一出来肯定破坏体验。将前2条结合你会发现，用户在使用移动产品是需要非常追求效率的，所\r\n以移动端产品的设计难道会大大增加。&lt;br /&gt;\r\n&lt;br /&gt;\r\n四、无法多任务的处理信息&lt;br /&gt;\r\n&lt;br /&gt;\r\n用户在使用桌面产品时，是更加容易的进行多任务操作和处理的，比如我正在浏览web查资料，又正在进行文档的整理，还可能开着QQ和朋友聊天。因为大屏幕\r\n的关系和系统机制让用户能够高效的同时处理多个信息，当然，还得益于固定的使用场景和完整的时间片。但是因为前面也提到的问题，移动端的产品往往是沉浸式\r\n的，用户在同一时期只可能使用一个应用，完成一个流程，然后结束，再去开启另一个应用和另一个流程，所以大部分移动产品设计时往往讲求遵循的是单一的任务\r\n流，期间结束和跳转的设计非常的少。&lt;br /&gt;\r\n&lt;br /&gt;\r\n五、平台的设计规范和特性&lt;br /&gt;\r\n&lt;br /&gt;\r\n最后才是各自的平台规范和标准，比如什么ios \r\nhuman \r\nguideline或者WindowsPhone的metro理念，纵观知乎和各大网站，很多人每天关注的都是这些比如拟物化设计和扁平化设计的风格，返\r\n回按钮的逻辑或者隐藏title之类的方法论细节。的确你了解这些信息是可以快速方便的设计出一个可用的移动产品的，但是如果没有了解之前所说的几条移动\r\n产品和传统互联网产品在用户体验上的区别，你可能永远也无法参透移动互联网用户体验的规律和本质。&lt;br /&gt;', './images/article/56f7ce180709d.jpg', '', 1459080788, 2, '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dou_article_category`
--

CREATE TABLE IF NOT EXISTS `dou_article_category` (
  `cat_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(30) NOT NULL DEFAULT '',
  `cat_name` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `parent_id` smallint(5) NOT NULL DEFAULT '0',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '50',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `dou_article_category`
--

INSERT INTO `dou_article_category` (`cat_id`, `unique_id`, `cat_name`, `keywords`, `description`, `parent_id`, `sort`) VALUES
(1, 'news', '企业新闻', '企业新闻', '企业新闻', 0, 1),
(2, 'news', '行业新闻', '行业新闻', '行业新闻', 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `dou_case`
--

CREATE TABLE IF NOT EXISTS `dou_case` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` smallint(5) NOT NULL DEFAULT '0',
  `name` varchar(150) NOT NULL DEFAULT '',
  `defined` text,
  `content` longtext,
  `image` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) DEFAULT NULL,
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `dou_case`
--

INSERT INTO `dou_case` (`id`, `cat_id`, `name`, `defined`, `content`, `image`, `keywords`, `add_time`, `description`, `sort`) VALUES
(3, 6, 'test', '颜色：test', 'test', './images/Case/56f7e09e07180.jpg', 'test', 1459085470, 'test', 0),
(8, 4, '移动互联网产品设计的核心要素有哪些？', '颜色：', '移动互联网和传统互联网的设计有很多不同&lt;br /&gt;\r\n移动互联网和传统互联网的设计有很多不同，针对前者有哪些关键的设计重点、考虑要素、交互或体验要特别注意的呢？本文来自知乎网友可风的回答。&lt;br /&gt;\r\n&lt;br /&gt;\r\n可风&lt;br /&gt;\r\n&lt;br /&gt;\r\n最近越来越多的圈内人开始随大潮进入移动互联网领域，从传统的web或者桌面端设计开始学习移动互联网产品的设计。在很多人眼里，设计移动互联网产品和传\r\n统互联网产品的区别无非就是载体从电脑变成了手机，所以只要熟悉一下各个手机中不同的规范和特性就算是完成了过渡，学习了下ios human \r\nguideline，了解了一下拟物化设计和扁平化设计，就以为是了解了移动互联网的设计方法。其实这种思想完全是只看到表现而没看到本质的错误，移动互\r\n联网和传统互联网的区别不光是设计标准和设计规范的变化，而应该从整个物理环境的变化来重新全面的认识。那么我们分析一下，移动互联网产品的用户体验和传\r\n统互联网产品有什么区别呢？&lt;br /&gt;\r\n&lt;br /&gt;\r\n一、使用场景的复杂&lt;br /&gt;\r\n&lt;br /&gt;\r\n用户在使用桌面客户端或者访问web页面的时候，多半是坐在电脑前，固定的盯着屏幕和使用键鼠操作，这个时候对于用户来说，使用场景是简单而固定的。但是\r\n在使用手机的时候，用户可能在地铁中，在公交上，在电梯中，无聊等待时或者边走路边用。如此复杂的场景，需要产品的设计者考虑的要素也自然非常的复杂。&lt;br /&gt;\r\n&lt;br /&gt;\r\n比如在公交车上拥挤和摇晃时，用户如果才能顺畅的单手操作？比如在地铁或者电梯的信号不好的情况下，是否要考虑各种网络情况带来的问题？比如用户在无聊等待玩游戏，或者在床上睡前时，又变成了深入沉浸的体验？不同的场景不同的情况在设计时是否都有考虑清楚？&lt;br /&gt;\r\n&lt;br /&gt;\r\n二、使用时间碎片化&lt;br /&gt;\r\n&lt;br /&gt;\r\n用户在使用电脑时，大部分时间还是固定的，无非可能因为工作和同事沟通一下，或者起身上个厕所，一般都有10-20分钟完整的时间片在操作电脑。但是移动\r\n端就不一样了，用户既然在移动，使用手机时要随时随地观察周围的情况，随时可能中断现在的操作，锁屏，再继续刚才的操作。所以用户使用移动产品的时间不是\r\n连成片的，而是一段一段的，有的时候中断回再回来，有的时候中断就不会回来了。&lt;br /&gt;\r\n&lt;br /&gt;\r\n三、屏幕尺寸的缩小&lt;br /&gt;\r\n&lt;br /&gt;\r\n用户使用电脑产品的屏幕尺寸是可以很大的，小则13寸大到27寸，这样使得桌面产品和web产品有充足的区域展现信息，整个界面利用率就可以很高。我们在\r\n做交互设计的时候会有一种方法，如果一个次要信息的出现不会影响大部分用户的时候，那么这个次要信息是可以放在界面上的，这就是为什么网站可以加入很多广\r\n告banner的原因，因为只要保持到一个度不影响正常的使用就不会破坏整体的用户体验。但是在移动端，这个度是非常的小的，因为屏幕尺寸的限制，本身需\r\n要你展现的必要信息都需要有一个合理的规划和抉择，次要的信息再一出来肯定破坏体验。将前2条结合你会发现，用户在使用移动产品是需要非常追求效率的，所\r\n以移动端产品的设计难道会大大增加。&lt;br /&gt;\r\n&lt;br /&gt;\r\n四、无法多任务的处理信息&lt;br /&gt;\r\n&lt;br /&gt;\r\n用户在使用桌面产品时，是更加容易的进行多任务操作和处理的，比如我正在浏览web查资料，又正在进行文档的整理，还可能开着QQ和朋友聊天。因为大屏幕\r\n的关系和系统机制让用户能够高效的同时处理多个信息，当然，还得益于固定的使用场景和完整的时间片。但是因为前面也提到的问题，移动端的产品往往是沉浸式\r\n的，用户在同一时期只可能使用一个应用，完成一个流程，然后结束，再去开启另一个应用和另一个流程，所以大部分移动产品设计时往往讲求遵循的是单一的任务\r\n流，期间结束和跳转的设计非常的少。&lt;br /&gt;\r\n&lt;br /&gt;\r\n五、平台的设计规范和特性&lt;br /&gt;\r\n&lt;br /&gt;\r\n最后才是各自的平台规范和标准，比如什么ios \r\nhuman \r\nguideline或者WindowsPhone的metro理念，纵观知乎和各大网站，很多人每天关注的都是这些比如拟物化设计和扁平化设计的风格，返\r\n回按钮的逻辑或者隐藏title之类的方法论细节。的确你了解这些信息是可以快速方便的设计出一个可用的移动产品的，但是如果没有了解之前所说的几条移动\r\n产品和传统互联网产品在用户体验上的区别，你可能永远也无法参透移动互联网用户体验的规律和本质。', './images/Case/56f7e7c71287d.jpg', '网用户体验的规律和本质。', 1459088527, '网用户体验的规律和本质。网用户体验的规律和本质。网用户体验的规律和本质网用户体验的规律和本质。网用户体验的规律和本质网用户体验的规律和本质。网用户体验的规律和本质网用户体验的规律和本质。网用户体验的规律和本质网用户体验的规律和本质。', 0),
(6, 6, 'test2', '颜色：', 'test', './images/Case/56f7e3f589efe.jpg', 'test', 1459086325, 'test', 0),
(7, 4, 'test3', '颜色：test3', 'test3', './images/Case/56f7e7915df3e.png', 'test3', 1459087249, 'test3', 0);

-- --------------------------------------------------------

--
-- 表的结构 `dou_case_category`
--

CREATE TABLE IF NOT EXISTS `dou_case_category` (
  `cat_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(30) NOT NULL DEFAULT '',
  `cat_name` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `parent_id` smallint(5) NOT NULL DEFAULT '0',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '50',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `dou_case_category`
--

INSERT INTO `dou_case_category` (`cat_id`, `unique_id`, `cat_name`, `keywords`, `description`, `parent_id`, `sort`) VALUES
(4, 'hotel', '酒店', '酒店', '酒店', 0, 1),
(6, 'network', '网吧', '网吧', '网吧', 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `dou_config`
--

CREATE TABLE IF NOT EXISTS `dou_config` (
  `name` varchar(80) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT '',
  `box` varchar(255) NOT NULL DEFAULT '',
  `tab` varchar(10) NOT NULL DEFAULT 'main',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dou_config`
--

INSERT INTO `dou_config` (`name`, `value`, `type`, `box`, `tab`, `sort`) VALUES
('site_name', 'DouPHP轻量级企业网站管理系统', 'text', '', 'main', 1),
('site_title', 'DouPHP轻量级企业网站管理系统', 'text', '', 'main', 2),
('site_keywords', 'DouPHP,轻量级企业网站管理系统', 'text', '', 'main', 3),
('site_description', 'DouPHP,轻量级企业网站管理系统', 'text', '', 'main', 4),
('site_logo', './data/logo.gif', 'file', '', 'main', 5),
('site_address', '福建省漳州市芗城区', 'text', '', 'main', 6),
('site_closed', '0', 'radio', '', 'main', 7),
('icp', '京ICP证030173号 ', 'text', '', 'main', 8),
('tel', '0596-8888888', 'text', '', 'main', 9),
('fax', '0596-6666666', 'text', '', 'main', 10),
('qq', '287715706/雷锋,110234567', 'text', '', 'main', 11),
('email', 'your@domain.com1', 'text', '', 'main', 12),
('language', 'zh-cn', 'select', '', 'main', 13),
('captcha', '0', 'radio', '', 'main', 16),
('code', '', 'textarea', '', 'main', 18),
('thumb_width', '135', 'text', '', 'display', 1),
('thumb_height', '135', 'text', '', 'display', 2),
('price_decimal', '2', 'text', '', 'display', 3),
('display', 'a:4:{s:7:"article";s:2:"10";s:12:"home_article";s:1:"5";s:7:"product";s:2:"10";s:12:"home_product";s:1:"4";}', 'array', '', 'display', 4),
('defined', 'a:4:{s:7:"article";s:0:"";s:4:"case";s:6:"颜色";s:7:"product";s:0:"";s:7:"project";s:0:"";}', 'array', '', 'defined', 1),
('mail_service', '1', 'radio', '', 'mail', 1),
('mail_host', 'smtp.qq.com ', 'text', '', 'mail', 2),
('mail_port', '25', 'text', '', 'mail', 3),
('mail_ssl', '0', 'radio', '', 'mail', 4),
('mail_username', '287715706@qq.com', 'text', '', 'mail', 5),
('mail_password', 'hy/19840322', 'text', '', 'mail', 6),
('mobile_name', 'DouPHP', 'text', '', 'mobile', 1),
('mobile_title', 'DouPHP触屏版', 'text', '', 'mobile', 2),
('mobile_keywords', 'DouPHP,DouPHP触屏版', 'text', '', 'mobile', 3),
('mobile_description', 'DouPHP,DouPHP触屏版', 'text', '', 'mobile', 4),
('mobile_logo', '', 'file', '', 'mobile', 5),
('mobile_closed', '0', 'radio', '', 'mobile', 6),
('mobile_display', 'a:4:{s:7:"article";i:10;s:12:"home_article";i:5;s:7:"product";i:10;s:12:"home_product";i:4;}', 'array', '', 'mobile', 7),
('site_theme', 'default', 'hidden', '', '', 100),
('mobile_theme', 'default', 'hidden', '', '', 101),
('build_date', '1453785019', 'hidden', '', '', 102),
('update_number', 'a:6:{s:6:"update";s:1:"1";s:5:"patch";s:1:"0";s:6:"module";s:1:"0";s:6:"plugin";s:1:"0";s:5:"theme";s:1:"0";s:6:"mobile";N;}', 'hidden', '', '', 103),
('update_date', 'a:2:{s:6:"system";a:2:{s:6:"update";i:20151109;s:5:"patch";i:20151109;}s:6:"module";a:2:{s:7:"article";i:20151109;s:7:"product";i:20151109;}}', 'hidden', '', '', 104),
('cloud_account', '', 'hidden', '', '', 105),
('hash_code', '00a8609f47ed3c6d38e17ee38b4a9547', 'hidden', '', '', 106),
('douphp_version', 'v1.3 Release 20151109', 'hidden', '', '', 107);

-- --------------------------------------------------------

--
-- 表的结构 `dou_guest_book`
--

CREATE TABLE IF NOT EXISTS `dou_guest_book` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `contact_type` varchar(30) NOT NULL DEFAULT '',
  `contact` varchar(150) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `if_show` tinyint(1) NOT NULL DEFAULT '0',
  `if_read` tinyint(1) NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `reply_id` smallint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `dou_manager`
--

CREATE TABLE IF NOT EXISTS `dou_manager` (
  `user_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `password` char(40) NOT NULL DEFAULT '',
  `action_list` text NOT NULL,
  `add_time` int(11) NOT NULL DEFAULT '0',
  `last_login` int(11) NOT NULL DEFAULT '0',
  `last_ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- 转存表中的数据 `dou_manager`
--

INSERT INTO `dou_manager` (`user_id`, `user_name`, `email`, `password`, `action_list`, `add_time`, `last_login`, `last_ip`) VALUES
(1, 'admin', '287715706@qq.com', 'e978b416fc4278b6c6d5498c2b945113db83cabe', 'ALL', 1453785018, 1459076741, '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `dou_nav`
--

CREATE TABLE IF NOT EXISTS `dou_nav` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `module` varchar(20) NOT NULL,
  `nav_name` varchar(255) NOT NULL,
  `guide` varchar(255) NOT NULL,
  `parent_id` smallint(5) NOT NULL DEFAULT '0',
  `type` varchar(10) NOT NULL,
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '50',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `dou_nav`
--

INSERT INTO `dou_nav` (`id`, `module`, `nav_name`, `guide`, `parent_id`, `type`, `sort`) VALUES
(1, 'product_category', '产品中心', '0', 0, 'middle', 1),
(2, 'case_category', '客户案例', '0', 0, 'middle', 2),
(3, 'article_category', '新闻资讯', '0', 0, 'middle', 3),
(4, 'project_category', '解决方案', '0', 0, 'middle', 4),
(5, 'GuestBook', '留言反馈', '0', 0, 'middle', 7),
(6, 'page', '关于我们', '1', 0, 'middle', 6),
(7, 'page', '服务于支持', '3', 0, 'middle', 5);

-- --------------------------------------------------------

--
-- 表的结构 `dou_page`
--

CREATE TABLE IF NOT EXISTS `dou_page` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(30) NOT NULL DEFAULT '',
  `parent_id` smallint(5) NOT NULL DEFAULT '0',
  `page_name` varchar(150) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `dou_page`
--

INSERT INTO `dou_page` (`id`, `unique_id`, `parent_id`, `page_name`, `content`, `keywords`, `description`) VALUES
(1, 'test', 0, '关于我们', '关于我们', '关于我们', '关于我们'),
(3, 'serve', 0, '服务于支持', '服务于支持', '服务于支持', '服务于支持');

-- --------------------------------------------------------

--
-- 表的结构 `dou_product`
--

CREATE TABLE IF NOT EXISTS `dou_product` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` smallint(5) NOT NULL DEFAULT '0',
  `name` varchar(150) NOT NULL DEFAULT '',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `defined` text,
  `content` longtext,
  `image` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) DEFAULT NULL,
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `dou_product`
--

INSERT INTO `dou_product` (`id`, `cat_id`, `name`, `price`, `defined`, `content`, `image`, `keywords`, `add_time`, `description`, `sort`) VALUES
(1, 1, '华为（HUAWEI）AR1220-S 8口百兆企业级VPN路由器', '0.00', '', '&lt;img src=&quot;/images/image/20160327/20160327110205_35183.jpg&quot; alt=&quot;&quot; /&gt;', './images/product/56f7a1b808903.jpg', '路由器', 1459069448, '华为（HUAWEI）AR1220-S 8口百兆企业级VPN路由器', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dou_product_category`
--

CREATE TABLE IF NOT EXISTS `dou_product_category` (
  `cat_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(30) NOT NULL DEFAULT '',
  `cat_name` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `parent_id` smallint(5) NOT NULL DEFAULT '0',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '50',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `dou_product_category`
--

INSERT INTO `dou_product_category` (`cat_id`, `unique_id`, `cat_name`, `keywords`, `description`, `parent_id`, `sort`) VALUES
(1, 'route', '路由器', '路由器', '网吧酒店千兆企业级路由器', 0, 1),
(2, 'switch', '交换机', '交换机', '酒店网吧万兆交换机', 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `dou_project`
--

CREATE TABLE IF NOT EXISTS `dou_project` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` smallint(5) NOT NULL DEFAULT '0',
  `title` varchar(150) NOT NULL DEFAULT '',
  `defined` text,
  `content` longtext,
  `image` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `click` smallint(6) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `dou_project`
--

INSERT INTO `dou_project` (`id`, `cat_id`, `title`, `defined`, `content`, `image`, `keywords`, `add_time`, `click`, `description`, `sort`) VALUES
(1, 1, '移动互联网产品设计的核心要素有哪些？', '', '移动互联网和传统互联网的设计有很多不同&lt;br /&gt;\r\n&lt;br /&gt;\r\n移动互联网和传统互联网的设计有很多不同，针对前者有哪些关键的设计重点、考虑要素、交互或体验要特别注意的呢？本文来自知乎网友可风的回答。&lt;br /&gt;\r\n&lt;br /&gt;\r\n可风&lt;br /&gt;\r\n&lt;br /&gt;\r\n最近越来越多的圈内人开始随大潮进入移动互联网领域，从传统的web或者桌面端设计开始学习移动互联网产品的设计。在很多人眼里，设计移动互联网产品和传\r\n统互联网产品的区别无非就是载体从电脑变成了手机，所以只要熟悉一下各个手机中不同的规范和特性就算是完成了过渡，学习了下ios human \r\nguideline，了解了一下拟物化设计和扁平化设计，就以为是了解了移动互联网的设计方法。其实这种思想完全是只看到表现而没看到本质的错误，移动互\r\n联网和传统互联网的区别不光是设计标准和设计规范的变化，而应该从整个物理环境的变化来重新全面的认识。那么我们分析一下，移动互联网产品的用户体验和传\r\n统互联网产品有什么区别呢？&lt;br /&gt;\r\n&lt;br /&gt;\r\n一、使用场景的复杂&lt;br /&gt;\r\n&lt;br /&gt;\r\n用户在使用桌面客户端或者访问web页面的时候，多半是坐在电脑前，固定的盯着屏幕和使用键鼠操作，这个时候对于用户来说，使用场景是简单而固定的。但是\r\n在使用手机的时候，用户可能在地铁中，在公交上，在电梯中，无聊等待时或者边走路边用。如此复杂的场景，需要产品的设计者考虑的要素也自然非常的复杂。&lt;br /&gt;\r\n&lt;br /&gt;\r\n比如在公交车上拥挤和摇晃时，用户如果才能顺畅的单手操作？比如在地铁或者电梯的信号不好的情况下，是否要考虑各种网络情况带来的问题？比如用户在无聊等待玩游戏，或者在床上睡前时，又变成了深入沉浸的体验？不同的场景不同的情况在设计时是否都有考虑清楚？&lt;br /&gt;\r\n&lt;br /&gt;\r\n二、使用时间碎片化&lt;br /&gt;\r\n&lt;br /&gt;\r\n用户在使用电脑时，大部分时间还是固定的，无非可能因为工作和同事沟通一下，或者起身上个厕所，一般都有10-20分钟完整的时间片在操作电脑。但是移动\r\n端就不一样了，用户既然在移动，使用手机时要随时随地观察周围的情况，随时可能中断现在的操作，锁屏，再继续刚才的操作。所以用户使用移动产品的时间不是\r\n连成片的，而是一段一段的，有的时候中断回再回来，有的时候中断就不会回来了。&lt;br /&gt;\r\n&lt;br /&gt;\r\n三、屏幕尺寸的缩小&lt;br /&gt;\r\n&lt;br /&gt;\r\n用户使用电脑产品的屏幕尺寸是可以很大的，小则13寸大到27寸，这样使得桌面产品和web产品有充足的区域展现信息，整个界面利用率就可以很高。我们在\r\n做交互设计的时候会有一种方法，如果一个次要信息的出现不会影响大部分用户的时候，那么这个次要信息是可以放在界面上的，这就是为什么网站可以加入很多广\r\n告banner的原因，因为只要保持到一个度不影响正常的使用就不会破坏整体的用户体验。但是在移动端，这个度是非常的小的，因为屏幕尺寸的限制，本身需\r\n要你展现的必要信息都需要有一个合理的规划和抉择，次要的信息再一出来肯定破坏体验。将前2条结合你会发现，用户在使用移动产品是需要非常追求效率的，所\r\n以移动端产品的设计难道会大大增加。&lt;br /&gt;\r\n&lt;br /&gt;\r\n四、无法多任务的处理信息&lt;br /&gt;\r\n&lt;br /&gt;\r\n用户在使用桌面产品时，是更加容易的进行多任务操作和处理的，比如我正在浏览web查资料，又正在进行文档的整理，还可能开着QQ和朋友聊天。因为大屏幕\r\n的关系和系统机制让用户能够高效的同时处理多个信息，当然，还得益于固定的使用场景和完整的时间片。但是因为前面也提到的问题，移动端的产品往往是沉浸式\r\n的，用户在同一时期只可能使用一个应用，完成一个流程，然后结束，再去开启另一个应用和另一个流程，所以大部分移动产品设计时往往讲求遵循的是单一的任务\r\n流，期间结束和跳转的设计非常的少。&lt;br /&gt;\r\n&lt;br /&gt;\r\n五、平台的设计规范和特性&lt;br /&gt;\r\n&lt;br /&gt;\r\n最后才是各自的平台规范和标准，比如什么ios \r\nhuman \r\nguideline或者WindowsPhone的metro理念，纵观知乎和各大网站，很多人每天关注的都是这些比如拟物化设计和扁平化设计的风格，返\r\n回按钮的逻辑或者隐藏title之类的方法论细节。的确你了解这些信息是可以快速方便的设计出一个可用的移动产品的，但是如果没有了解之前所说的几条移动\r\n产品和传统互联网产品在用户体验上的区别，你可能永远也无法参透移动互联网用户体验的规律和本质。&lt;br /&gt;', './images/project/56f7cd196ee7d.jpg', '移动互联网', 1459080473, 14, '移动互联网', 0),
(2, 2, '详解如何利用RSS进行网络推广', '', '网络推广方法有很多，RSS推广就是其中的一种，RSS订阅能够为网站增加访问量，这是众人皆知的事实。不过，如何推广RSS，让更多人知道并促使更多人订阅RSS，却是一个很大的问题。下面就有我给大家讲解一下什么事RSS推广，如何利用RSS进行网络推广。&lt;br /&gt;\r\n&lt;br /&gt;\r\n首先来说说什么是RSS？&lt;br /&gt;\r\n&lt;br /&gt;\r\nRSS是在线共享内容的一种简单方式（也叫聚合内容，Really Simple \r\nSyndication）。通常在时效性比较强的内容上使用RSS订阅能更快速获取信息。网站提供RSS输出，有利于让用户获取网站内容的最新信息。网络\r\n用户可以在客户端借助于支持RSS的聚合工具软件（如SharpReader，NwezCrawler，FeedDemon），在不打开网站内容页面的情\r\n况下阅读支持RSS输出的网站内容。&lt;br /&gt;\r\n&lt;br /&gt;\r\n那么RSS有什么用途呢？&lt;br /&gt;\r\n&lt;br /&gt;\r\n订阅BLOG，可以订阅工作中所需的技术文章，也可以订阅与你有共同爱好的作者的Blog，总之，对什么感兴趣就可以订什么。&lt;br /&gt;\r\n&lt;br /&gt;\r\n订阅新闻，无论是奇闻怪事、明星消息、体坛风云，只要你想知道的，都可以订阅。&lt;br /&gt;\r\n&lt;br /&gt;\r\n你再也不用一个网站一个网站，一个网页一个网页去逛了。只要这将你需要的内容订阅在一个RSS阅读器中，这些内容就会自动出现你的阅读器里，你也不必为了一个急切想知道的消息而不断的刷新网页，因为一旦有了更新，RSS阅读器就会自己通知你。&lt;br /&gt;\r\n&lt;br /&gt;\r\n什么是RSS推广？&lt;br /&gt;\r\n&lt;br /&gt;\r\nRSS推广即指利用RSS这一互联网工具传递营销信息的网络营销推广模式。RSS推广通常是与EDM（电子邮件营销）配合使用的。因为RSS的特点比\r\nEDM具有更多的优势，可以对后者进行替代和补充。且RSS与EDM也有许多相似之处，它们之间的根本区别是向用户传递有价值信息的方式不同。RSS和\r\nEDM相比，主要有一下几个有点：&lt;br /&gt;\r\n&lt;br /&gt;\r\n1、多样性、个性化信息的聚合。RSS是一种基于XML（Extensible Markup \r\nLanguage，扩展性标识语言）标准，是一种互联网上被广泛采用的内容包装和投递协议，任何内容源都可以采用这种方式来发布，包括专业新闻、网络营\r\n销、企业、甚至个人等站点。若在用户端安装了RSS阅读器软件，用户就可以按照喜好、有选择性地将感兴趣的内容来源聚合到该软件的界面中，为用户提供多来\r\n源信息的“一站式”服务。&lt;br /&gt;\r\n&lt;br /&gt;\r\n2、信息发布的时效强、成本低廉。由于用户端RSS阅读器中的信息是随着订阅源信息的更新而及时更新的，所以极大地提高了信息的时效性和价值。此外，服务\r\n器端信息的RSS包装在技术实现上极为简单，而且是一次性的工作，使长期的信息发布边际成本几乎降为零，这完全是传统的电子邮件、互联网浏览等发布方式所\r\n无法比拟的。&lt;br /&gt;\r\n&lt;br /&gt;\r\n3、无“垃圾”信息和信息量过大的问题。RSS阅读器中的信息是完全由用户订阅的，对于用户没有订阅的内容，以及弹出式广告、垃圾邮件等无关信息则会被完\r\n全屏蔽掉。因而不会有令人烦恼的“噪音”干扰。此外，在用户端获取信息并不需要专用的类似电子邮箱那样的“RSS \r\n信箱”来存储，因而不必担心信息内容的过大问题。&lt;br /&gt;\r\n&lt;br /&gt;\r\n4、没有病毒邮件的影响。在RSS阅读器中保存的只是所订阅信息的摘要，要查看其详细内容与到网站上通过浏览器阅读没有太大差异，因而不必担心病毒邮件的危害。&lt;br /&gt;\r\n&lt;br /&gt;\r\n5、本地内容管理便利。对下载到RSS阅读器里订阅内容，用户可以进行离线阅读、存档保留、搜索排序及相关分类等多种管理操作，使阅读器软件不仅是一个“阅读”器，而且还是一个用户随身的“资料库”。&lt;br /&gt;\r\n&lt;br /&gt;\r\n虽然RSS的有点很多，但是缺点也很明显。RSS营销的定位性不如EDM强，我们很难主动选择让谁订阅我们的RSS，因此RSS很难实现个性化营销。同时RSS也不容易做到像EDM那样跟踪营销的效果。&lt;br /&gt;\r\n&lt;br /&gt;\r\n总之，RSS与EDM相比具有很大的优势，特别是克服了EDM中常出现的垃圾邮件、病毒、信息即时性差等致命缺点，因而将有力地促进RSS的推广应用。所\r\n以，网络推广者者一定要加以足够地重视，以增强自己的竞争优势。当然RSS营销模式还有很多的问题要面对，对于如何有效地利用更需深入地研究探讨。&lt;br /&gt;\r\n&lt;br /&gt;\r\n前面说过RSS推广处于刚起步阶段，是一种新式的网络推广方法，下面我在介绍一下RSS推广实战操作的方法，主要有以下几种简单方法：&lt;br /&gt;\r\n&lt;br /&gt;\r\n1、提交RSS&lt;br /&gt;\r\n&lt;br /&gt;\r\n提交到哪里呢？网络上有很多专门针对RSS的搜索引擎和RSS分类目录，我们贺姨将网站的RSS提交给这些站点。这样不仅可以促进搜索引擎收录、增加RSS曝光率，还能为网站增加链接广度；既可以带来流量，又能加快搜索引擎收录与信息的推广。&lt;br /&gt;\r\n&lt;br /&gt;\r\n2、RSS图标&lt;br /&gt;\r\n&lt;br /&gt;\r\n有条件的话给你的网站增加RSS订阅吧，并将网站RSS订阅图标放在醒目的位置。&lt;br /&gt;\r\n&lt;br /&gt;\r\n3、量身定制内容&lt;br /&gt;\r\n&lt;br /&gt;\r\n针对不同的用户推送不同的内容，让用户愿意去订阅他们想要的内容。&lt;br /&gt;\r\n&lt;br /&gt;\r\n4、邮件中增加RSS订阅链接&lt;br /&gt;\r\n&lt;br /&gt;\r\n一种不错的病毒式推广，一方面是EDM的补充，随着网民网龄的增加，使用RSS代替EDM的会越来越多。&lt;br /&gt;\r\n&lt;br /&gt;\r\n5、多功能应用&lt;br /&gt;\r\n&lt;br /&gt;\r\n比如让用户通过RSS订阅的方式获取天气预报、订阅感兴趣的分类广告信息，网络商城还可以用它来传递物流跟踪信息、传递商品打折通知、拍卖商品的实时竞价情况等等。&lt;br /&gt;', NULL, '详解如何利用RSS进行网络推广', 1459081307, 3, '详解如何利用RSS进行网络推广', 0);

-- --------------------------------------------------------

--
-- 表的结构 `dou_project_category`
--

CREATE TABLE IF NOT EXISTS `dou_project_category` (
  `cat_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(30) NOT NULL DEFAULT '',
  `cat_name` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `parent_id` smallint(5) NOT NULL DEFAULT '0',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '50',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `dou_project_category`
--

INSERT INTO `dou_project_category` (`cat_id`, `unique_id`, `cat_name`, `keywords`, `description`, `parent_id`, `sort`) VALUES
(1, 'hotel', '酒店解决方案', '酒店解决方案', '酒店解决方案', 0, 1),
(2, 'network', '网吧解决方案', '网吧解决方案', '网吧解决方案', 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `dou_show`
--

CREATE TABLE IF NOT EXISTS `dou_show` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `show_name` varchar(60) NOT NULL DEFAULT '',
  `show_link` varchar(255) NOT NULL DEFAULT '',
  `show_img` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '50',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `dou_show`
--

INSERT INTO `dou_show` (`id`, `show_name`, `show_link`, `show_img`, `type`, `sort`) VALUES
(1, '幻灯1', '', './images/slide/56f7bea02dfb3.png', 'pc', 0),
(2, '幻灯2', '', './images/slide/56f7beb93c00d.png', 'pc', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
