-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 02 月 07 日 06:57
-- 服务器版本: 5.0.45
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `work_b2c`
--

-- --------------------------------------------------------

--
-- 表的结构 `w_activities`
--

DROP TABLE IF EXISTS `w_activities`;
CREATE TABLE IF NOT EXISTS `w_activities` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `start_time` int(4) unsigned NOT NULL default '0',
  `end_time` int(4) unsigned NOT NULL default '0',
  `published` tinyint(1) unsigned NOT NULL default '0',
  `act_type` tinyint(2) unsigned NOT NULL default '0',
  `remark` varchar(255) default NULL,
  `params` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `w_activities`
--

INSERT INTO `w_activities` (`id`, `name`, `start_time`, `end_time`, `published`, `act_type`, `remark`, `params`) VALUES
(2, 'asfasf23', 0, 0, 0, 2, 'asdf', 'a:2:{s:5:"money";s:1:"2";s:3:"lev";a:2:{i:0;s:1:"1";i:1;s:1:"2";}}'),
(3, '', 0, 0, 1, 1, '', 'a:4:{s:5:"money";s:0:"";s:13:"products_name";s:9:"新建 12";s:11:"products_id";s:2:"74";s:5:"thumb";s:0:"";}'),
(5, '全场购物金额大于100元，免运费', 1307577600, 1307750400, 1, 3, '', 'a:1:{s:5:"money";s:3:"100";}');

-- --------------------------------------------------------

--
-- 表的结构 `w_advers`
--

DROP TABLE IF EXISTS `w_advers`;
CREATE TABLE IF NOT EXISTS `w_advers` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(200) NOT NULL COMMENT '链接名称',
  `img` varchar(200) NOT NULL COMMENT '图片路径',
  `url` varchar(200) NOT NULL COMMENT '网址',
  `params` text NOT NULL COMMENT '参数',
  `description` text NOT NULL COMMENT '链接简介',
  `hot` tinyint(4) NOT NULL COMMENT '推荐（1推荐，0不推荐）',
  `clicks` int(4) NOT NULL default '0',
  `published` tinyint(4) NOT NULL COMMENT '是否发布（1发布，0不发布）',
  `ordering` int(11) NOT NULL,
  `type_id` int(11) NOT NULL COMMENT '链接分类ID',
  `linkid` mediumint(4) NOT NULL default '0' COMMENT '内部链接ID',
  `uid` int(11) NOT NULL COMMENT '所属用户ID',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- 转存表中的数据 `w_advers`
--

INSERT INTO `w_advers` (`id`, `name`, `img`, `url`, `params`, `description`, `hot`, `clicks`, `published`, `ordering`, `type_id`, `linkid`, `uid`) VALUES
(41, '加湿器', '/media/1/oriks.jpg', '', '', '', 0, 0, 1, 1, 15, 23, 1),
(42, '干衣机', '/media/1/750x200d.jpg', '', '', '', 0, 0, 1, 2, 15, 34, 1),
(43, '电暖器', '/media/1/20110311-750x200aa.jpg', '', '', '', 0, 0, 1, 3, 15, 49, 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_adver_types`
--

DROP TABLE IF EXISTS `w_adver_types`;
CREATE TABLE IF NOT EXISTS `w_adver_types` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT '分类名称',
  `parent_id` int(11) NOT NULL COMMENT '父分类ID',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `published` tinyint(4) NOT NULL COMMENT '是否发布（1发布，0不发布）',
  `params` text NOT NULL COMMENT '分类参数',
  `ordering` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- 转存表中的数据 `w_adver_types`
--

INSERT INTO `w_adver_types` (`id`, `name`, `parent_id`, `uid`, `published`, `params`, `ordering`) VALUES
(15, '首页主图广告', 0, 1, 1, '4|580|220', 7),
(16, '首页插图1', 0, 1, 0, '1|980|110', 2),
(17, '首页插图2', 0, 1, 1, '1|980|110', 3),
(18, '产品中心(banner)', 0, 1, 1, '1|980|60', 6),
(19, '新品上架(banner)', 0, 1, 1, '1|980|320', 4),
(20, '特价产品(banner)', 0, 1, 1, '1|980|300', 1),
(21, '限时抢购', 0, 1, 1, '1|980|330', 5);

-- --------------------------------------------------------

--
-- 表的结构 `w_area`
--

DROP TABLE IF EXISTS `w_area`;
CREATE TABLE IF NOT EXISTS `w_area` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) default '',
  `alias` varchar(20) default NULL,
  `lft` int(10) unsigned NOT NULL default '0',
  `rgt` int(10) unsigned NOT NULL default '0',
  `parent_id` int(11) NOT NULL default '0',
  `depth` tinyint(4) NOT NULL default '1',
  `published` tinyint(1) NOT NULL default '0',
  `default_uid` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=395 ;

--
-- 转存表中的数据 `w_area`
--

INSERT INTO `w_area` (`id`, `name`, `alias`, `lft`, `rgt`, `parent_id`, `depth`, `published`, `default_uid`) VALUES
(1, '中国', 'china', 1, 786, 0, 1, 0, 0),
(2, '北京', '', 2, 3, 1, 2, 1, 0),
(3, '上海', '', 4, 5, 1, 2, 1, 0),
(4, '天津', '', 6, 7, 1, 2, 1, 0),
(5, '重庆', '', 8, 9, 1, 2, 1, 0),
(6, '河北', '', 10, 33, 1, 2, 1, 0),
(7, '石家庄市', '', 11, 12, 6, 3, 1, 0),
(8, '唐山市', '', 13, 14, 6, 3, 1, 0),
(9, '秦皇岛市', '', 15, 16, 6, 3, 1, 0),
(10, '邯郸市', '', 17, 18, 6, 3, 1, 0),
(11, '邢台市', '', 19, 20, 6, 3, 1, 0),
(12, '保定市', '', 21, 22, 6, 3, 1, 0),
(13, '张家口市', '', 23, 24, 6, 3, 1, 0),
(14, '承德市', '', 25, 26, 6, 3, 1, 0),
(15, '沧州市', '', 27, 28, 6, 3, 1, 0),
(16, '廊坊市', '', 29, 30, 6, 3, 1, 0),
(17, '衡水市', '', 31, 32, 6, 3, 1, 0),
(18, '山西', '', 34, 57, 1, 2, 1, 0),
(19, '太原市', '', 35, 36, 18, 3, 1, 0),
(20, '大同市', '', 37, 38, 18, 3, 1, 0),
(21, '阳泉市', '', 39, 40, 18, 3, 1, 0),
(22, '长治市', '', 41, 42, 18, 3, 1, 0),
(23, '晋城市', '', 43, 44, 18, 3, 1, 0),
(24, '朔州市', '', 45, 46, 18, 3, 1, 0),
(25, '晋中市', '', 47, 48, 18, 3, 1, 0),
(26, '运城市', '', 49, 50, 18, 3, 1, 0),
(27, '忻州市', '', 51, 52, 18, 3, 1, 0),
(28, '临汾市', '', 53, 54, 18, 3, 1, 0),
(29, '吕梁市', '', 55, 56, 18, 3, 1, 0),
(30, '内蒙古', '', 58, 83, 1, 2, 1, 0),
(31, '呼和浩特市', '', 59, 60, 30, 3, 1, 0),
(32, '包头市', '', 61, 62, 30, 3, 1, 0),
(33, '乌海市', '', 63, 64, 30, 3, 1, 0),
(34, '赤峰市', '', 65, 66, 30, 3, 1, 0),
(35, '通辽市', '', 67, 68, 30, 3, 1, 0),
(36, '鄂尔多斯市', '', 69, 70, 30, 3, 1, 0),
(37, '呼伦贝尔市', '', 71, 72, 30, 3, 1, 0),
(38, '巴彦淖尔市', '', 73, 74, 30, 3, 1, 0),
(39, '乌兰察布市', '', 75, 76, 30, 3, 1, 0),
(40, '兴安盟', '', 77, 78, 30, 3, 1, 0),
(41, '锡林郭勒盟', '', 79, 80, 30, 3, 1, 0),
(42, '阿拉善盟', '', 81, 82, 30, 3, 1, 0),
(43, '辽宁', '', 84, 113, 1, 2, 1, 0),
(44, '沈阳市', '', 85, 86, 43, 3, 1, 0),
(45, '大连市', '', 87, 88, 43, 3, 1, 0),
(46, '鞍山市', '', 89, 90, 43, 3, 1, 0),
(47, '抚顺市', '', 91, 92, 43, 3, 1, 0),
(48, '本溪市', '', 93, 94, 43, 3, 1, 0),
(49, '丹东市', '', 95, 96, 43, 3, 1, 0),
(50, '锦州市', '', 97, 98, 43, 3, 1, 0),
(51, '营口市', '', 99, 100, 43, 3, 1, 0),
(52, '阜新市', '', 101, 102, 43, 3, 1, 0),
(53, '辽阳市', '', 103, 104, 43, 3, 1, 0),
(54, '盘锦市', '', 105, 106, 43, 3, 1, 0),
(55, '铁岭市', '', 107, 108, 43, 3, 1, 0),
(56, '朝阳市', '', 109, 110, 43, 3, 1, 0),
(57, '葫芦岛市', '', 111, 112, 43, 3, 1, 0),
(58, '吉林', '', 114, 133, 1, 2, 1, 0),
(59, '长春市', '', 115, 116, 58, 3, 1, 0),
(60, '吉林市', '', 117, 118, 58, 3, 1, 0),
(61, '四平市', '', 119, 120, 58, 3, 1, 0),
(62, '辽源市', '', 121, 122, 58, 3, 1, 0),
(63, '通化市', '', 123, 124, 58, 3, 1, 0),
(64, '白山市', '', 125, 126, 58, 3, 1, 0),
(65, '松原市', '', 127, 128, 58, 3, 1, 0),
(66, '白城市', '', 129, 130, 58, 3, 1, 0),
(67, '延边朝鲜族自治州', '', 131, 132, 58, 3, 1, 0),
(68, '黑龙江', '', 134, 161, 1, 2, 1, 0),
(69, '哈尔滨市', '', 135, 136, 68, 3, 1, 0),
(70, '齐齐哈尔市', '', 137, 138, 68, 3, 1, 0),
(71, '鸡西市', '', 139, 140, 68, 3, 1, 0),
(72, '鹤岗市', '', 141, 142, 68, 3, 1, 0),
(73, '双鸭山市', '', 143, 144, 68, 3, 1, 0),
(74, '大庆市', '', 145, 146, 68, 3, 1, 0),
(75, '伊春市', '', 147, 148, 68, 3, 1, 0),
(76, '佳木斯市', '', 149, 150, 68, 3, 1, 0),
(77, '七台河市', '', 151, 152, 68, 3, 1, 0),
(78, '牡丹江市', '', 153, 154, 68, 3, 1, 0),
(79, '黑河市', '', 155, 156, 68, 3, 1, 0),
(80, '绥化市', '', 157, 158, 68, 3, 1, 0),
(81, '大兴安岭地区', '', 159, 160, 68, 3, 1, 0),
(82, '江苏', '', 162, 189, 1, 2, 1, 0),
(83, '南京市', '', 163, 164, 82, 3, 1, 0),
(84, '无锡市', '', 165, 166, 82, 3, 1, 0),
(85, '徐州市', '', 167, 168, 82, 3, 1, 0),
(86, '常州市', '', 169, 170, 82, 3, 1, 0),
(87, '苏州市', '', 171, 172, 82, 3, 1, 0),
(88, '南通市', '', 173, 174, 82, 3, 1, 0),
(89, '连云港市', '', 175, 176, 82, 3, 1, 0),
(90, '淮安市', '', 177, 178, 82, 3, 1, 0),
(91, '盐城市', '', 179, 180, 82, 3, 1, 0),
(92, '扬州市', '', 181, 182, 82, 3, 1, 0),
(93, '镇江市', '', 183, 184, 82, 3, 1, 0),
(94, '泰州市', '', 185, 186, 82, 3, 1, 0),
(95, '宿迁市', '', 187, 188, 82, 3, 1, 0),
(96, '浙江', '', 190, 213, 1, 2, 1, 0),
(97, '杭州市', '', 191, 192, 96, 3, 1, 0),
(98, '宁波市', '', 193, 194, 96, 3, 1, 0),
(99, '温州市', '', 195, 196, 96, 3, 1, 0),
(100, '嘉兴市', '', 197, 198, 96, 3, 1, 0),
(101, '湖州市', '', 199, 200, 96, 3, 1, 0),
(102, '绍兴市', '', 201, 202, 96, 3, 1, 0),
(103, '金华市', '', 203, 204, 96, 3, 1, 0),
(104, '衢州市', '', 205, 206, 96, 3, 1, 0),
(105, '舟山市', '', 207, 208, 96, 3, 1, 0),
(106, '台州市', '', 209, 210, 96, 3, 1, 0),
(107, '丽水市', '', 211, 212, 96, 3, 1, 0),
(108, '安徽', '', 214, 249, 1, 2, 1, 0),
(109, '合肥市', '', 215, 216, 108, 3, 1, 0),
(110, '芜湖市', '', 217, 218, 108, 3, 1, 0),
(111, '蚌埠市', '', 219, 220, 108, 3, 1, 0),
(112, '淮南市', '', 221, 222, 108, 3, 1, 0),
(113, '马鞍山市', '', 223, 224, 108, 3, 1, 0),
(114, '淮北市', '', 225, 226, 108, 3, 1, 0),
(115, '铜陵市', '', 227, 228, 108, 3, 1, 0),
(116, '安庆市', '', 229, 230, 108, 3, 1, 0),
(117, '黄山市', '', 231, 232, 108, 3, 1, 0),
(118, '滁州市', '', 233, 234, 108, 3, 1, 0),
(119, '阜阳市', '', 235, 236, 108, 3, 1, 0),
(120, '宿州市', '', 237, 238, 108, 3, 1, 0),
(121, '巢湖市', '', 239, 240, 108, 3, 1, 0),
(122, '六安市', '', 241, 242, 108, 3, 1, 0),
(123, '亳州市', '', 243, 244, 108, 3, 1, 0),
(124, '池州市', '', 245, 246, 108, 3, 1, 0),
(125, '宣城市', '', 247, 248, 108, 3, 1, 0),
(126, '福建', '', 250, 269, 1, 2, 1, 0),
(127, '福州市', '', 251, 252, 126, 3, 1, 0),
(128, '厦门市', '', 253, 254, 126, 3, 1, 0),
(129, '莆田市', '', 255, 256, 126, 3, 1, 0),
(130, '三明市', '', 257, 258, 126, 3, 1, 0),
(131, '泉州市', '', 259, 260, 126, 3, 1, 0),
(132, '漳州市', '', 261, 262, 126, 3, 1, 0),
(133, '南平市', '', 263, 264, 126, 3, 1, 0),
(134, '龙岩市', '', 265, 266, 126, 3, 1, 0),
(135, '宁德市', '', 267, 268, 126, 3, 1, 0),
(136, '江西', 'jiangxi', 760, 783, 1, 2, 1, 0),
(137, '南昌市', '', 761, 762, 136, 3, 1, 0),
(138, '景德镇市', '', 763, 764, 136, 3, 1, 0),
(139, '萍乡市', '', 765, 766, 136, 3, 1, 0),
(140, '九江市', '', 767, 768, 136, 3, 1, 0),
(141, '新余市', '', 769, 770, 136, 3, 1, 0),
(142, '鹰潭市', '', 771, 772, 136, 3, 1, 0),
(143, '赣州市', '', 773, 774, 136, 3, 1, 0),
(144, '吉安市', '', 775, 776, 136, 3, 1, 0),
(145, '宜春市', '', 777, 778, 136, 3, 1, 0),
(146, '抚州市', '', 779, 780, 136, 3, 1, 0),
(147, '上饶市', '', 781, 782, 136, 3, 1, 0),
(148, '山东', '', 270, 305, 1, 2, 1, 0),
(149, '济南市', '', 271, 272, 148, 3, 1, 0),
(150, '青岛市', '', 273, 274, 148, 3, 1, 0),
(151, '淄博市', '', 275, 276, 148, 3, 1, 0),
(152, '枣庄市', '', 277, 278, 148, 3, 1, 0),
(153, '东营市', '', 279, 280, 148, 3, 1, 0),
(154, '烟台市', '', 281, 282, 148, 3, 1, 0),
(155, '潍坊市', '', 283, 284, 148, 3, 1, 0),
(156, '济宁市', '', 285, 286, 148, 3, 1, 0),
(157, '泰安市', '', 287, 288, 148, 3, 1, 0),
(158, '威海市', '', 289, 290, 148, 3, 1, 0),
(159, '日照市', '', 291, 292, 148, 3, 1, 0),
(160, '莱芜市', '', 293, 294, 148, 3, 1, 0),
(161, '临沂市', '', 295, 296, 148, 3, 1, 0),
(162, '德州市', '', 297, 298, 148, 3, 1, 0),
(163, '聊城市', '', 299, 300, 148, 3, 1, 0),
(164, '滨州市', '', 301, 302, 148, 3, 1, 0),
(165, '荷泽市', '', 303, 304, 148, 3, 1, 0),
(166, '河南', '', 306, 341, 1, 2, 1, 0),
(167, '郑州市', '', 307, 308, 166, 3, 1, 0),
(168, '开封市', '', 309, 310, 166, 3, 1, 0),
(169, '洛阳市', '', 311, 312, 166, 3, 1, 0),
(170, '平顶山市', '', 313, 314, 166, 3, 1, 0),
(171, '安阳市', '', 315, 316, 166, 3, 1, 0),
(172, '鹤壁市', '', 317, 318, 166, 3, 1, 0),
(173, '新乡市', '', 319, 320, 166, 3, 1, 0),
(174, '焦作市', '', 321, 322, 166, 3, 1, 0),
(175, '濮阳市', '', 323, 324, 166, 3, 1, 0),
(176, '许昌市', '', 325, 326, 166, 3, 1, 0),
(177, '漯河市', '', 327, 328, 166, 3, 1, 0),
(178, '三门峡市', '', 329, 330, 166, 3, 1, 0),
(179, '南阳市', '', 331, 332, 166, 3, 1, 0),
(180, '商丘市', '', 333, 334, 166, 3, 1, 0),
(181, '信阳市', '', 335, 336, 166, 3, 1, 0),
(182, '周口市', '', 337, 338, 166, 3, 1, 0),
(183, '驻马店市', '', 339, 340, 166, 3, 1, 0),
(184, '湖北', '', 342, 377, 1, 2, 1, 0),
(185, '武汉市', '', 343, 344, 184, 3, 1, 0),
(186, '黄石市', '', 345, 346, 184, 3, 1, 0),
(187, '十堰市', '', 347, 348, 184, 3, 1, 0),
(188, '宜昌市', '', 349, 350, 184, 3, 1, 0),
(189, '襄樊市', 'xf', 351, 352, 184, 3, 1, 0),
(190, '鄂州市', '', 353, 354, 184, 3, 1, 0),
(191, '荆门市', '', 355, 356, 184, 3, 1, 0),
(192, '孝感市', '', 357, 358, 184, 3, 1, 0),
(193, '荆州市', '', 359, 360, 184, 3, 1, 0),
(194, '黄冈市', '', 361, 362, 184, 3, 1, 0),
(195, '咸宁市', '', 363, 364, 184, 3, 1, 0),
(196, '随州市', '', 365, 366, 184, 3, 1, 0),
(197, '恩施土家族苗族自治州', '', 367, 368, 184, 3, 1, 0),
(198, '仙桃市', '', 369, 370, 184, 3, 1, 0),
(199, '潜江市', '', 371, 372, 184, 3, 1, 0),
(200, '天门市', '', 373, 374, 184, 3, 1, 0),
(201, '神农架林区', '', 375, 376, 184, 3, 1, 0),
(202, '湖南', '', 378, 407, 1, 2, 1, 0),
(203, '长沙市', '', 379, 380, 202, 3, 1, 0),
(204, '株洲市', '', 381, 382, 202, 3, 1, 0),
(205, '湘潭市', '', 383, 384, 202, 3, 1, 0),
(206, '衡阳市', '', 385, 386, 202, 3, 1, 0),
(207, '邵阳市', '', 387, 388, 202, 3, 1, 0),
(208, '岳阳市', '', 389, 390, 202, 3, 1, 0),
(209, '常德市', '', 391, 392, 202, 3, 1, 0),
(210, '张家界市', '', 393, 394, 202, 3, 1, 0),
(211, '益阳市', '', 395, 396, 202, 3, 1, 0),
(212, '郴州市', '', 397, 398, 202, 3, 1, 0),
(213, '永州市', '', 399, 400, 202, 3, 1, 0),
(214, '怀化市', '', 401, 402, 202, 3, 1, 0),
(215, '娄底市', '', 403, 404, 202, 3, 1, 0),
(216, '湘西土家族苗族自治州', '', 405, 406, 202, 3, 1, 0),
(217, '广东', '', 408, 451, 1, 2, 1, 0),
(218, '广州市', 'gz', 409, 410, 217, 3, 1, 116),
(219, '韶关市', '', 411, 412, 217, 3, 1, 0),
(220, '深圳市', 'sz', 413, 414, 217, 3, 1, 89),
(221, '珠海市', '', 415, 416, 217, 3, 1, 0),
(222, '汕头市', '', 417, 418, 217, 3, 1, 0),
(223, '佛山市', '', 419, 420, 217, 3, 1, 0),
(224, '江门市', '', 421, 422, 217, 3, 1, 0),
(225, '湛江市', '', 423, 424, 217, 3, 1, 0),
(226, '茂名市', '', 425, 426, 217, 3, 1, 0),
(227, '肇庆市', '', 427, 428, 217, 3, 1, 0),
(228, '惠州市', '', 429, 430, 217, 3, 1, 0),
(229, '梅州市', '', 431, 432, 217, 3, 1, 0),
(230, '汕尾市', '', 433, 434, 217, 3, 1, 0),
(231, '河源市', '', 435, 436, 217, 3, 1, 0),
(232, '阳江市', '', 437, 438, 217, 3, 1, 0),
(233, '清远市', '', 439, 440, 217, 3, 1, 0),
(234, '东莞市', '', 441, 442, 217, 3, 1, 0),
(235, '中山市', '', 443, 444, 217, 3, 1, 0),
(236, '潮州市', '', 445, 446, 217, 3, 1, 0),
(237, '揭阳市', '', 447, 448, 217, 3, 1, 0),
(238, '云浮市', '', 449, 450, 217, 3, 1, 0),
(239, '广西', '', 452, 481, 1, 2, 1, 0),
(240, '南宁市', '', 453, 454, 239, 3, 1, 0),
(241, '柳州市', '', 455, 456, 239, 3, 1, 0),
(242, '桂林市', '', 457, 458, 239, 3, 1, 0),
(243, '梧州市', '', 459, 460, 239, 3, 1, 0),
(244, '北海市', '', 461, 462, 239, 3, 1, 0),
(245, '防城港市', '', 463, 464, 239, 3, 1, 0),
(246, '钦州市', '', 465, 466, 239, 3, 1, 0),
(247, '贵港市', '', 467, 468, 239, 3, 1, 0),
(248, '玉林市', '', 469, 470, 239, 3, 1, 0),
(249, '百色市', '', 471, 472, 239, 3, 1, 0),
(250, '贺州市', '', 473, 474, 239, 3, 1, 0),
(251, '河池市', '', 475, 476, 239, 3, 1, 0),
(252, '来宾市', '', 477, 478, 239, 3, 1, 0),
(253, '崇左市', '', 479, 480, 239, 3, 1, 0),
(254, '海南', '', 482, 519, 1, 2, 1, 0),
(255, '海口市', '', 483, 484, 254, 3, 1, 0),
(256, '三亚市', '', 485, 486, 254, 3, 1, 0),
(257, '五指山市', '', 487, 488, 254, 3, 1, 0),
(258, '琼海市', '', 489, 490, 254, 3, 1, 0),
(259, '儋州市', '', 491, 492, 254, 3, 1, 0),
(260, '文昌市', '', 493, 494, 254, 3, 1, 0),
(261, '万宁市', '', 495, 496, 254, 3, 1, 0),
(262, '东方市', '', 497, 498, 254, 3, 1, 0),
(263, '定安县', '', 499, 500, 254, 3, 1, 0),
(264, '屯昌县', '', 501, 502, 254, 3, 1, 0),
(265, '澄迈县', '', 503, 504, 254, 3, 1, 0),
(266, '临高县', '', 505, 506, 254, 3, 1, 0),
(267, '白沙黎族自治县', '', 507, 508, 254, 3, 1, 0),
(268, '昌江黎族自治县', '', 509, 510, 254, 3, 1, 0),
(269, '乐东黎族自治县', '', 511, 512, 254, 3, 1, 0),
(270, '陵水黎族自治县', '', 513, 514, 254, 3, 1, 0),
(271, '保亭黎族苗族自治县', '', 515, 516, 254, 3, 1, 0),
(272, '琼中黎族苗族自治县', '', 517, 518, 254, 3, 1, 0),
(273, '四川', '', 520, 563, 1, 2, 1, 0),
(274, '成都市', '', 521, 522, 273, 3, 1, 0),
(275, '自贡市', '', 523, 524, 273, 3, 1, 0),
(276, '攀枝花市', '', 525, 526, 273, 3, 1, 0),
(277, '泸州市', '', 527, 528, 273, 3, 1, 0),
(278, '德阳市', '', 529, 530, 273, 3, 1, 0),
(279, '绵阳市', '', 531, 532, 273, 3, 1, 0),
(280, '广元市', '', 533, 534, 273, 3, 1, 0),
(281, '遂宁市', '', 535, 536, 273, 3, 1, 0),
(282, '内江市', '', 537, 538, 273, 3, 1, 0),
(283, '乐山市', '', 539, 540, 273, 3, 1, 0),
(284, '南充市', '', 541, 542, 273, 3, 1, 0),
(285, '眉山市', '', 543, 544, 273, 3, 1, 0),
(286, '宜宾市', '', 545, 546, 273, 3, 1, 0),
(287, '广安市', '', 547, 548, 273, 3, 1, 0),
(288, '达州市', '', 549, 550, 273, 3, 1, 0),
(289, '雅安市', '', 551, 552, 273, 3, 1, 0),
(290, '巴中市', '', 553, 554, 273, 3, 1, 0),
(291, '资阳市', '', 555, 556, 273, 3, 1, 0),
(292, '阿坝藏族羌族自治州', '', 557, 558, 273, 3, 1, 0),
(293, '甘孜藏族自治州', '', 559, 560, 273, 3, 1, 0),
(294, '凉山彝族自治州', '', 561, 562, 273, 3, 1, 0),
(295, '贵州', '', 564, 583, 1, 2, 1, 0),
(296, '贵阳市', '', 565, 566, 295, 3, 1, 0),
(297, '六盘水市', '', 567, 568, 295, 3, 1, 0),
(298, '遵义市', '', 569, 570, 295, 3, 1, 0),
(299, '安顺市', '', 571, 572, 295, 3, 1, 0),
(300, '铜仁地区', '', 573, 574, 295, 3, 1, 0),
(301, '黔西南布依族苗族自治州', '', 575, 576, 295, 3, 1, 0),
(302, '毕节地区', '', 577, 578, 295, 3, 1, 0),
(303, '黔东南苗族侗族自治州', '', 579, 580, 295, 3, 1, 0),
(304, '黔南布依族苗族自治州', '', 581, 582, 295, 3, 1, 0),
(305, '云南', '', 584, 617, 1, 2, 1, 0),
(306, '昆明市', '', 585, 586, 305, 3, 1, 0),
(307, '曲靖市', '', 587, 588, 305, 3, 1, 0),
(308, '玉溪市', '', 589, 590, 305, 3, 1, 0),
(309, '保山市', '', 591, 592, 305, 3, 1, 0),
(310, '昭通市', '', 593, 594, 305, 3, 1, 0),
(311, '丽江市', '', 595, 596, 305, 3, 1, 0),
(312, '思茅市', '', 597, 598, 305, 3, 1, 0),
(313, '临沧市', '', 599, 600, 305, 3, 1, 0),
(314, '楚雄彝族自治州', '', 601, 602, 305, 3, 1, 0),
(315, '红河哈尼族彝族自治州', '', 603, 604, 305, 3, 1, 0),
(316, '文山壮族苗族自治州', '', 605, 606, 305, 3, 1, 0),
(317, '西双版纳傣族自治州', '', 607, 608, 305, 3, 1, 0),
(318, '大理白族自治州', '', 609, 610, 305, 3, 1, 0),
(319, '德宏傣族景颇族自治州', '', 611, 612, 305, 3, 1, 0),
(320, '怒江傈僳族自治州', '', 613, 614, 305, 3, 1, 0),
(321, '迪庆藏族自治州', '', 615, 616, 305, 3, 1, 0),
(322, '西藏', '', 618, 633, 1, 2, 1, 0),
(323, '拉萨市', '', 619, 620, 322, 3, 1, 0),
(324, '昌都地区', '', 621, 622, 322, 3, 1, 0),
(325, '山南地区', '', 623, 624, 322, 3, 1, 0),
(326, '日喀则地区', '', 625, 626, 322, 3, 1, 0),
(327, '那曲地区', '', 627, 628, 322, 3, 1, 0),
(328, '阿里地区', '', 629, 630, 322, 3, 1, 0),
(329, '林芝地区', '', 631, 632, 322, 3, 1, 0),
(330, '陕西', '', 634, 655, 1, 2, 1, 0),
(331, '西安市', '', 635, 636, 330, 3, 1, 0),
(332, '铜川市', '', 637, 638, 330, 3, 1, 0),
(333, '宝鸡市', '', 639, 640, 330, 3, 1, 0),
(334, '咸阳市', '', 641, 642, 330, 3, 1, 0),
(335, '渭南市', '', 643, 644, 330, 3, 1, 0),
(336, '延安市', '', 645, 646, 330, 3, 1, 0),
(337, '汉中市', '', 647, 648, 330, 3, 1, 0),
(338, '榆林市', '', 649, 650, 330, 3, 1, 0),
(339, '安康市', '', 651, 652, 330, 3, 1, 0),
(340, '商洛市', '', 653, 654, 330, 3, 1, 0),
(341, '甘肃', '', 656, 685, 1, 2, 1, 0),
(342, '兰州市', '', 657, 658, 341, 3, 1, 0),
(343, '嘉峪关市', '', 659, 660, 341, 3, 1, 0),
(344, '金昌市', '', 661, 662, 341, 3, 1, 0),
(345, '白银市', '', 663, 664, 341, 3, 1, 0),
(346, '天水市', '', 665, 666, 341, 3, 1, 0),
(347, '武威市', '', 667, 668, 341, 3, 1, 0),
(348, '张掖市', '', 669, 670, 341, 3, 1, 0),
(349, '平凉市', '', 671, 672, 341, 3, 1, 0),
(350, '酒泉市', '', 673, 674, 341, 3, 1, 0),
(351, '庆阳市', '', 675, 676, 341, 3, 1, 0),
(352, '定西市', '', 677, 678, 341, 3, 1, 0),
(353, '陇南市', '', 679, 680, 341, 3, 1, 0),
(354, '临夏回族自治州', '', 681, 682, 341, 3, 1, 0),
(355, '甘南藏族自治州', '', 683, 684, 341, 3, 1, 0),
(356, '青海', '', 686, 703, 1, 2, 1, 0),
(357, '西宁市', '', 687, 688, 356, 3, 1, 0),
(358, '海东地区', '', 689, 690, 356, 3, 1, 0),
(359, '海北藏族自治州', '', 691, 692, 356, 3, 1, 0),
(360, '黄南藏族自治州', '', 693, 694, 356, 3, 1, 0),
(361, '海南藏族自治州', '', 695, 696, 356, 3, 1, 0),
(362, '果洛藏族自治州', '', 697, 698, 356, 3, 1, 0),
(363, '玉树藏族自治州', '', 699, 700, 356, 3, 1, 0),
(364, '海西蒙古族藏族自治州', '', 701, 702, 356, 3, 1, 0),
(365, '宁夏', '', 704, 715, 1, 2, 1, 0),
(366, '银川市', '', 705, 706, 365, 3, 1, 0),
(367, '石嘴山市', '', 707, 708, 365, 3, 1, 0),
(368, '吴忠市', '', 709, 710, 365, 3, 1, 0),
(369, '固原市', '', 711, 712, 365, 3, 1, 0),
(370, '中卫市', '', 713, 714, 365, 3, 1, 0),
(371, '新疆', '', 716, 753, 1, 2, 1, 0),
(372, '乌鲁木齐市', '', 717, 718, 371, 3, 1, 0),
(373, '克拉玛依市', '', 719, 720, 371, 3, 1, 0),
(374, '吐鲁番地区', '', 721, 722, 371, 3, 1, 0),
(375, '哈密地区', '', 723, 724, 371, 3, 1, 0),
(376, '昌吉回族自治州', '', 725, 726, 371, 3, 1, 0),
(377, '博尔塔拉蒙古自治州', '', 727, 728, 371, 3, 1, 0),
(378, '巴音郭楞蒙古自治州', '', 729, 730, 371, 3, 1, 0),
(379, '阿克苏地区', '', 731, 732, 371, 3, 1, 0),
(380, '克孜勒苏柯尔克孜自治州', '', 733, 734, 371, 3, 1, 0),
(381, '喀什地区', '', 735, 736, 371, 3, 1, 0),
(382, '和田地区', '', 737, 738, 371, 3, 1, 0),
(383, '伊犁哈萨克自治州', '', 739, 740, 371, 3, 1, 0),
(384, '塔城地区', '', 741, 742, 371, 3, 1, 0),
(385, '阿勒泰地区', '', 743, 744, 371, 3, 1, 0),
(386, '石河子市', '', 745, 746, 371, 3, 1, 0),
(387, '阿拉尔市', '', 747, 748, 371, 3, 1, 0),
(388, '图木舒克市', '', 749, 750, 371, 3, 1, 0),
(389, '五家渠市', '', 751, 752, 371, 3, 1, 0),
(390, '台湾', 'taiwan', 758, 759, 1, 2, 0, 0),
(391, '香港', '', 754, 755, 1, 2, 1, 0),
(392, '澳门', '', 756, 757, 1, 2, 1, 0),
(393, '法国', 'faguo', 761, 788, 0, 1, 1, NULL),
(394, '桂平市', 'guipingshi', 784, 785, 1, 2, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `w_banners`
--

DROP TABLE IF EXISTS `w_banners`;
CREATE TABLE IF NOT EXISTS `w_banners` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `tid` int(4) NOT NULL default '0',
  `ordering` tinyint(4) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  `params` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `w_banners`
--

INSERT INTO `w_banners` (`id`, `uid`, `tid`, `ordering`, `published`, `params`) VALUES
(1, 0, 15, 0, 0, 'a:4:{i:0;a:3:{s:5:"title";s:3:"111";s:4:"http";s:1:"/";s:5:"thumb";s:27:"/media/1/banners/thumb1.jpg";}i:1;a:3:{s:5:"title";s:0:"";s:4:"http";s:1:"/";s:5:"thumb";s:27:"/media/1/banners/thumb2.jpg";}i:2;a:3:{s:5:"title";s:0:"";s:4:"http";s:1:"/";s:5:"thumb";s:27:"/media/1/banners/thumb3.jpg";}i:3;a:3:{s:5:"title";s:0:"";s:4:"http";s:1:"/";s:5:"thumb";s:27:"/media/1/banners/thumb4.jpg";}}'),
(2, 0, 16, 0, 0, 'a:1:{i:0;a:3:{s:5:"title";s:0:"";s:4:"http";s:0:"";s:5:"thumb";s:27:"/media/1/banners/hthum1.jpg";}}'),
(3, 0, 17, 0, 0, 'a:1:{i:0;a:3:{s:5:"title";s:0:"";s:4:"http";s:0:"";s:5:"thumb";s:27:"/media/1/banners/hthum2.jpg";}}'),
(4, 0, 19, 0, 0, 'a:1:{i:0;a:3:{s:5:"title";s:0:"";s:4:"http";s:0:"";s:5:"thumb";s:29:"/media/1/banners/newthumb.jpg";}}'),
(5, 0, 20, 0, 0, 'a:1:{i:0;a:3:{s:5:"title";s:0:"";s:4:"http";s:0:"";s:5:"thumb";s:29:"/media/1/banners/tethumb2.jpg";}}'),
(6, 0, 21, 0, 0, 'a:1:{i:0;a:3:{s:5:"title";s:0:"";s:4:"http";s:0:"";s:5:"thumb";s:30:"/media/1/banners/flashsale.jpg";}}');

-- --------------------------------------------------------

--
-- 表的结构 `w_brand`
--

DROP TABLE IF EXISTS `w_brand`;
CREATE TABLE IF NOT EXISTS `w_brand` (
  `brand_id` smallint(5) unsigned NOT NULL auto_increment,
  `brand_name` varchar(60) NOT NULL default '',
  `brand_logo` varchar(80) NOT NULL default '',
  `brand_desc` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `ordering` tinyint(3) unsigned NOT NULL default '50',
  `published` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`brand_id`),
  KEY `published` (`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- 转存表中的数据 `w_brand`
--

INSERT INTO `w_brand` (`brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `url`, `ordering`, `published`) VALUES
(12, '格力', '/media/1/1295335747.jpg', 'asfd23', '2', 255, 1),
(13, '格力2', '/media/1/d6cae8f785eb165e.jpg', '', '', 5, 1),
(14, '', '/media/1/3.jpg', '', '', 1, 1),
(15, '', '', '', '', 0, 1),
(16, '', '', '', '', 0, 1),
(17, '', '', '', '', 0, 1),
(18, '', '', '', '', 0, 1),
(19, '', '', '', '', 0, 1),
(20, '', '', '', '', 0, 1),
(21, '', '', '', '', 0, 1),
(22, '', '', '', '', 0, 1),
(23, '', '', '', '', 0, 1),
(24, '', '', '', '', 0, 1),
(25, '', '', '', '', 0, 1),
(26, '', '', '', '', 0, 1),
(27, '', '', '', '', 0, 1),
(28, '', '', '', '', 0, 1),
(29, '', '', '', '', 0, 1),
(30, '', '', '', '', 0, 1),
(31, '', '', '', '', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_buys`
--

DROP TABLE IF EXISTS `w_buys`;
CREATE TABLE IF NOT EXISTS `w_buys` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL COMMENT '产品名称',
  `introtext` text NOT NULL,
  `isfront` tinyint(2) NOT NULL default '0' COMMENT '1为推荐到首页',
  `catid` int(11) NOT NULL default '0',
  `created` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '创建时间',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '修改时间',
  `thumbnail` varchar(255) default NULL COMMENT '缩略图',
  `ordering` int(11) NOT NULL default '0' COMMENT '排序值',
  `metakey` text NOT NULL COMMENT '关键字',
  `metadesc` text NOT NULL COMMENT '描述',
  `hits` int(11) unsigned NOT NULL default '0' COMMENT '点击数',
  `uid` int(11) NOT NULL default '0' COMMENT '会员ID',
  `published` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=136 ;

--
-- 转存表中的数据 `w_buys`
--

INSERT INTO `w_buys` (`id`, `title`, `introtext`, `isfront`, `catid`, `created`, `modified`, `thumbnail`, `ordering`, `metakey`, `metadesc`, `hits`, `uid`, `published`) VALUES
(134, 'asfd', '<p>asfdasfd</p>', 1, 3, '2010-07-02 10:30:44', '2010-07-03 02:16:47', '/media/89/1278066642.gif', 16, '', '', 0, 89, 1),
(135, 'asfd', '<p>asfd</p>', 0, 6, '2010-07-02 10:31:30', '2010-07-03 02:16:42', '', 17, '', '', 0, 89, 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_category`
--

DROP TABLE IF EXISTS `w_category`;
CREATE TABLE IF NOT EXISTS `w_category` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) default '',
  `alias` varchar(50) NOT NULL,
  `type_id` smallint(4) default NULL COMMENT '商品类型',
  `spec_ids` varchar(255) default NULL COMMENT '规格列表',
  `deposit` float(6,2) NOT NULL default '0.00',
  `lft` int(10) unsigned NOT NULL default '0',
  `rgt` int(10) unsigned NOT NULL default '0',
  `parent_id` int(11) NOT NULL default '0',
  `params` text,
  `published` tinyint(1) NOT NULL default '0',
  `title` varchar(255) default NULL,
  `metakey` varchar(255) default NULL,
  `metadesc` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `w_category`
--

INSERT INTO `w_category` (`id`, `name`, `alias`, `type_id`, `spec_ids`, `deposit`, `lft`, `rgt`, `parent_id`, `params`, `published`, `title`, `metakey`, `metadesc`) VALUES
(1, '电磁炉', 'diancilu', 1, NULL, 0.00, 11, 12, 0, NULL, 1, '', '', ''),
(2, '电饭煲 ', 'dianfan', 1, NULL, 0.00, 15, 16, 0, NULL, 1, '', '', ''),
(3, '电风扇', 'dianfengshan', 1, '', 0.00, 3, 4, 0, NULL, 1, '', '', ''),
(4, '空调扇', 'kongdiaoshan', 1, NULL, 0.00, 9, 10, 0, NULL, 1, '', '', ''),
(5, '电水壶', 'dianshuihu', 1, '', 0.00, 1, 2, 0, NULL, 1, '', '', ''),
(6, '加湿器', 'jiashiqi', 1, '', 0.00, 5, 6, 0, NULL, 1, '', '', ''),
(13, '干衣机', 'ganyiji', 1, '', 0.00, 13, 14, 0, NULL, 1, '', '', ''),
(8, '电暖器', 'diannuanqi', 1, '', 0.00, 7, 8, 0, NULL, 1, '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `w_companies`
--

DROP TABLE IF EXISTS `w_companies`;
CREATE TABLE IF NOT EXISTS `w_companies` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `company_name` varchar(100) default NULL COMMENT '公司名称',
  `contact_name` varchar(50) default NULL COMMENT '联系人',
  `contact_sex` tinyint(1) NOT NULL default '1',
  `contact_jobs` varchar(100) default NULL COMMENT '联系人的职位',
  `phone` varchar(13) default NULL COMMENT '电话',
  `mobile` varchar(15) default NULL COMMENT '手机号码',
  `fax` varchar(100) default NULL COMMENT '传真',
  `http` varchar(100) default NULL COMMENT '公司网址',
  `address` varchar(255) default NULL COMMENT '公司地址',
  `uid` int(11) NOT NULL default '0' COMMENT '用户ID',
  `intro` text,
  `introimg` varchar(255) default NULL COMMENT '公司简介图片',
  `uname` varchar(50) NOT NULL,
  `catid` int(11) default NULL COMMENT '行业ID',
  `email` varchar(255) default NULL COMMENT '邮箱地址',
  `contact_department` varchar(255) default NULL COMMENT '所属部门',
  `contact_post` varchar(255) default NULL COMMENT '职位',
  `country` int(11) default NULL COMMENT '国家ID',
  `province` int(11) default NULL COMMENT '省ID',
  `city` int(11) default NULL COMMENT '城字ID',
  `zip` int(6) default NULL COMMENT '邮编',
  `company_type` int(6) default NULL COMMENT '公司类型',
  `keywords` varchar(100) default NULL COMMENT '公司关键词',
  `employees_number` int(6) default NULL COMMENT '员工人数',
  `turnover` int(6) default NULL COMMENT '营业额',
  `logo` varchar(255) default NULL COMMENT '公司图标',
  `trademark` varchar(255) default NULL COMMENT '商标',
  `join_date` datetime default NULL,
  `name` varchar(50) NOT NULL,
  `contact` varchar(60) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `w_companies`
--

INSERT INTO `w_companies` (`id`, `company_name`, `contact_name`, `contact_sex`, `contact_jobs`, `phone`, `mobile`, `fax`, `http`, `address`, `uid`, `intro`, `introimg`, `uname`, `catid`, `email`, `contact_department`, `contact_post`, `country`, `province`, `city`, `zip`, `company_type`, `keywords`, `employees_number`, `turnover`, `logo`, `trademark`, `join_date`, `name`, `contact`) VALUES
(3, '天津金禾美轴承有限公司', 'asfd', 1, '经理', '372222777', '13556873697', '', '', '', 89, '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 座落于现代进口轴承销售中心-天津的金禾美轴承有限公司,凭借着优越的地理位置,以及成型的销售理念,已经迅速的成长为中国北方进口轴承屈指可数真正可以 信赖的经销商.金禾美秉承了SKF，INA，FAG等国外经典轴承厂家严谨的作风，把为客户提供经典进口轴承放在了公司的首位。  多年来已与瑞典SKF轴承、德国FAG轴承、INA轴承，日本NSK轴承、NTN轴承、 KOYO轴承、THK轴承，  美国TIMKEN轴承等多家公司建立了良好的合作关系.</p>', '/media/89/1278054224.jpg', 'testtest', 0, '', '', '', 0, 0, 0, 0, 0, '', 0, 0, '', '', '2010-07-03 00:00:00', '', ''),
(12, '', '', 1, '', '0755-2780 888', '', '', 'www.greeonline.com ', '', 1, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, '', 0, 0, '', '', '0000-00-00 00:00:00', '格力在线', '');

-- --------------------------------------------------------

--
-- 表的结构 `w_components`
--

DROP TABLE IF EXISTS `w_components`;
CREATE TABLE IF NOT EXISTS `w_components` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(50) NOT NULL COMMENT '组件名称',
  `link` varchar(255) NOT NULL COMMENT '前台组件链接',
  `menuid` int(11) unsigned NOT NULL default '0' COMMENT '菜单分类ID',
  `parent` int(11) unsigned NOT NULL default '0' COMMENT '后台子菜单',
  `admin_menu_link` varchar(255) NOT NULL COMMENT '后台管理菜单链接',
  `option` varchar(50) NOT NULL COMMENT '组件名称',
  `ordering` int(11) NOT NULL default '0' COMMENT '排序',
  `iscore` tinyint(4) NOT NULL default '0' COMMENT '排序值',
  `params` text NOT NULL COMMENT '参数值',
  `enabled` tinyint(4) NOT NULL default '1' COMMENT '是否可用',
  `uid` int(11) NOT NULL default '0' COMMENT '用户ID',
  `menu_com` tinyint(1) NOT NULL default '0' COMMENT '是否以菜单为分类的信息',
  `cache` tinyint(1) NOT NULL default '0' COMMENT '是否需要更新缓存',
  PRIMARY KEY  (`id`),
  KEY `parent_option` (`parent`,`option`(32)),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=143 ;

--
-- 转存表中的数据 `w_components`
--

INSERT INTO `w_components` (`id`, `name`, `link`, `menuid`, `parent`, `admin_menu_link`, `option`, `ordering`, `iscore`, `params`, `enabled`, `uid`, `menu_com`, `cache`) VALUES
(20, '文章', 'com=contents', 0, 0, '', 'contents', 0, 1, 'show_noauth=1\nshow_title=1\nlink_titles=1\nshow_intro=1\nshow_section=0\nlink_section=1\nshow_category=0\nlink_category=1\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=1\nshow_readmore=1\nshow_vote=1\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\nfeed_summary=1\nfilter_tags=\nfilter_attritbutes=\n\n', 1, 1, 1, 1),
(140, '会员组件', 'com=users', 0, 0, 'com=users', 'users', 0, 0, '', 1, 2, 0, 0),
(137, '产品', 'com=products', 0, 0, 'com=products', 'products', 0, 0, 'a:3:{s:7:"payment";s:7703:"<p>1、格力在线提供的网上支付方式<br />\r\n我们为您提供银行卡在线支付（工商银行、招商银行、建设银行、深圳发展银行、农业银行）、银联支付、财付通支付、快钱网上支付、快钱信用卡支付、支付宝支付、由首信支付平台支持的国外信用卡支付网上支付方式。 银行卡在线支付所支持的卡种有：</p>\r\n<table width=\\"50%\\" cellspacing=\\"0\\" cellpadding=\\"5\\" border=\\"1\\" style=\\"font: 12px/22px 宋体; border-collapse: collapse; text-align: center\\">\r\n    <tbody>\r\n        <tr>\r\n            <td><span style=\\"font-weight: bold; font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\" class=\\"Apple-style-span\\">银行名称</span></td>\r\n            <td><span style=\\"font-weight: bold; font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\" class=\\"Apple-style-span\\">支持网上支付的银行卡名称</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img src=\\"/media/1/products/button_jdx081126_12.jpg\\" alt=\\"\\" /></td>\r\n            <td><span style=\\"font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\" class=\\"Apple-style-span\\">一卡通、信用卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img src=\\"/media/1/products/button_jdx081126_9.jpg\\" alt=\\"\\" /></td>\r\n            <td><span style=\\"font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\" class=\\"Apple-style-span\\">借记卡、信用卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img src=\\"/media/1/products/button_jdx081126_10.jpg\\" alt=\\"\\" /></td>\r\n            <td><span style=\\"font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\" class=\\"Apple-style-span\\">龙卡储蓄卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img src=\\"/media/1/products/button_jdx081126_11.jpg\\" alt=\\"\\" /></td>\r\n            <td><span style=\\"font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\" class=\\"Apple-style-span\\">借记卡、信用卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img src=\\"/media/1/products/weibiaoti-1.gif\\" alt=\\"\\" /></td>\r\n            <td><span style=\\"font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\" class=\\"Apple-style-span\\">借记卡、准贷记卡</span></td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p><br />\r\n网上支付平台所支持的银行卡种有：</p>\r\n<table width=\\"50%\\" cellspacing=\\"0\\" cellpadding=\\"5\\" border=\\"1\\" style=\\"font: 12px/22px 宋体; border-collapse: collapse; text-align: center\\">\r\n    <tbody>\r\n        <tr>\r\n            <td><font face=\\"Simsun\\" color=\\"#404040\\" class=\\"Apple-style-span\\"><span style=\\"font-size: 12px; border-collapse: separate\\" class=\\"Apple-style-span\\"><b>支付平台名称</b></span></font></td>\r\n            <td><span style=\\"font-weight: bold; font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\" class=\\"Apple-style-span\\">支持网上支付的银行卡名称</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img src=\\"/media/1/products/yinlianbiaozhi.jpg\\" alt=\\"\\" /></td>\r\n            <td><font face=\\"Simsun\\" color=\\"#404040\\" class=\\"Apple-style-span\\"><span style=\\"font-size: 12px; border-collapse: separate\\" class=\\"Apple-style-span\\">银联支付</span></font></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img src=\\"/media/1/products/alipay.jpg\\" alt=\\"\\" /></td>\r\n            <td><font face=\\"Simsun\\" color=\\"#404040\\" class=\\"Apple-style-span\\"><span style=\\"font-size: 12px; border-collapse: separate\\" class=\\"Apple-style-span\\">支付宝支付</span></font></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img src=\\"/media/1/products/button_jdx081126_6.jpg\\" alt=\\"\\" /></td>\r\n            <td><font face=\\"Simsun\\" color=\\"#404040\\" class=\\"Apple-style-span\\"><span style=\\"font-size: 12px; border-collapse: separate\\" class=\\"Apple-style-span\\">快钱网上支付</span></font></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img src=\\"/media/1/products/cft_lxq090312.JPG\\" alt=\\"\\" /></td>\r\n            <td><font face=\\"Simsun\\" color=\\"#404040\\" class=\\"Apple-style-span\\"><span style=\\"font-size: 12px; border-collapse: separate\\" class=\\"Apple-style-span\\">财付通支付</span></font></td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<p>温馨提示：<br />\r\n1）目前使用快钱网上支付单笔支付金额最高可达到1万元（不同的银行的支付金额不同）<br />\r\n2）快钱网上大金额支付支持的银行有：工商银行、招商银行、建设银行、农业银行、广东发展银行、兴业银行<br />\r\n2、银行卡的开通手续</p>\r\n<p>因各地银行政策不同，建议您在网上支付前拨打所在地银行电话，咨询该行可供网上支付的银行卡种类及开通手续。</p>\r\n<table width=\\"100%\\" cellspacing=\\"0\\" cellpadding=\\"5\\" border=\\"1\\" style=\\"font: 12px/22px 宋体; border-collapse: collapse; text-align: center\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>银行名称</td>\r\n            <td>服务热线</td>\r\n            <td>银行名称</td>\r\n            <td>服务热线</td>\r\n            <td>银行名称</td>\r\n            <td>服务热线</td>\r\n        </tr>\r\n        <tr>\r\n            <td>招商银行</td>\r\n            <td>95555</td>\r\n            <td>中国银行</td>\r\n            <td>95566</td>\r\n            <td>交通银行</td>\r\n            <td>95559</td>\r\n        </tr>\r\n        <tr>\r\n            <td>中国工商银行</td>\r\n            <td>95588</td>\r\n            <td>北京银行</td>\r\n            <td>96169</td>\r\n            <td>光大银行</td>\r\n            <td>95595</td>\r\n        </tr>\r\n        <tr>\r\n            <td>中国建设银行</td>\r\n            <td>95533</td>\r\n            <td>中国农业银行</td>\r\n            <td>95599</td>\r\n            <td>深圳发展银行</td>\r\n            <td>95501</td>\r\n        </tr>\r\n        <tr>\r\n            <td>上海浦东发展银行</td>\r\n            <td>95528</td>\r\n            <td>广东发展银行</td>\r\n            <td>95508</td>\r\n            <td>中国邮政</td>\r\n            <td>11185</td>\r\n        </tr>\r\n        <tr>\r\n            <td>民生银行</td>\r\n            <td>95568</td>\r\n            <td>华夏银行</td>\r\n            <td>95577</td>\r\n            <td>中信银行</td>\r\n            <td>86668888</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p>3、支付金额上限<br />\r\n目前各银行对于网上支付均有一定金额的限制，由于各银行政策不同，建议您在申请网上支付功能时向银行咨询相关事宜。</p>\r\n<p>4、怎样判断网上支付是否成功？<br />\r\n1)当您完成网上在线支付过程后，系统应提示支付成功；如果系统没有提示支付失败或成功，您可通过电话、ATM 、柜台或登录网上银行等各种方式查询银行卡余额，如果款项已被扣除，说明您已支付成功。<br />\r\n2)如果出现信用卡超额透支、存折余额不足、意外断线等导致支付不成功，请您登录格力在线&quot;我的帐户&quot;，找到该张未支付成功的订单，重新完成支付。</p>\r\n<p>5、造成&quot;支付被拒绝&quot;的原因有哪些？<br />\r\n1）所持银行卡尚未开通网上在线支付功能；<br />\r\n2）所持银行卡已过期、作废、挂失；<br />\r\n3）所持银行卡内余额不足；<br />\r\n4）输入银行卡卡号或密码不符；<br />\r\n5）输入证件号不符；<br />\r\n6）银行系统数据传输出现异常；<br />\r\n7）网络中断。</p>";s:12:"distribution";s:2811:"<p><strong>1、格力空调免费送货上门，免费安装。</strong><br />\r\n凡在线购买格力空调用户，格力同城市专营店会直接免费送货上门，免费安装调试。</p>\r\n<p><strong>2、格力小家电快递送货</strong><br />\r\n格力小家电由格力省级代理商直接同省市快递配货方式或自行上门提货方式配送。<br />\r\n快递运货见具体产品详细页配送运货</p>\r\n<p><strong>3.自提</strong><br />\r\n支持全国30个城市用户上门自提，免收运费。查看自提信息。</p>\r\n<p>&nbsp;</p>\r\n<p><strong>如何正确选择加急配送服务</strong><br />\r\n北京、天津、上海、广州、深圳、廊坊6个城市地区的用户，并且为当地发货订单，用户可在结算中心&ldquo;送货方式&rdquo;部分选择加急快递送货上门服务。</p>\r\n<p><strong>常见问题解答：<br />\r\n</strong><br />\r\n1. 我的订单什么时候可以送到？<br />\r\n具体配送时间根据不同城市略有不同，请查看配送范围、时间及运费<br />\r\n<br />\r\n2. &quot;加急快递送货上门&quot;的费收取标准？<br />\r\n北京、天津、上海、广州、深圳、廊坊6个城市的&ldquo;加急快递送货上门&rdquo;配送费为10元/单。</p>\r\n<p>&nbsp;</p>\r\n<p><strong>快递送货上门的订单 </strong><br />\r\n1、签收时仔细核对：商品及配件、商品数量、格力在线的发货清单、发票（如有）、三包凭证（如有）等 <br />\r\n2、若存在包装破损、商品错误、商品少发、商品有表面质量问题等影响签收的因素，请您一定要当面向送货员说明情况并当场整单退货</p>\r\n<p><strong>邮局邮寄的订单 </strong><br />\r\n1、请您一定要小心开包，以免尖锐物件损伤到包裹内的商品 <br />\r\n2、签收时仔细核对：商品及配件、商品数量、格力在线的发货清单、发票（如有）、三包凭证（如有）等 <br />\r\n3、若包装破损、商品错误、商品少发、商品存在表面质量问题等，您可以选择整单退货；或是求邮局开具相关证明后签收，然后登陆格力在线申请退货或申请换货</p>\r\n<p><strong>温馨提示 </strong><br />\r\n1、货到付款的订单送达时，请您当面与送货员核兑商品与款项，确保货款两清；若事后发现款项有误，格力在线将无法为您处理 <br />\r\n2、请收货时务必认真核对，若您或您的委托人已签收，则说明订单商品正确无误且不存在影响使用的因素，格力在线有权不受理因包装或商品破损、商品错漏发、商品表面质量问题、商品附带品及赠品少发为由的退换货申请 <br />\r\n3、部分商品由商店街的商家提供,这部分商品的验货验收不在格力在线承诺的范围内</p>\r\n<p>&nbsp;</p>";s:7:"service";s:4532:"<p>&nbsp;</p>\r\n<p><strong>服务宗旨：用户满意！<br />\r\n服务理念：用户的每一件小事，都是格力的大事</strong></p>\r\n<p><strong>（一）产品三包政策</strong><br />\r\n<br />\r\n<strong>1.包修政策</strong><br />\r\n2010年度家用空调（制冷量小于或等于14000W）、除湿机包修政策为整机包修六年。<br />\r\n2005年1月1日至2009年12月31日所购买的家用空调器整机包修六年。<br />\r\n2005年1月1日之前所购买的家用空调器的包修政策：按其当年的包修规定执行。</p>\r\n<p>以下情况之一的不属于包修范围，将按有关规定实行收费维修： <br />\r\n1.1消费者因使用、维护、保管不当造成损坏的；<br />\r\n1.2非格力电器指定的特约服务网点所安装、维修造成损坏的（包括消费者自行安装或拆动维修的）；<br />\r\n1.3无包修凭证及有效发票或有效购买凭证的；<br />\r\n1.4有效凭证、包修凭证不符或涂改的；<br />\r\n1.5因不可抗拒的自然灾害或使用环境恶劣造成损坏的；<br />\r\n1.6处理品、已超过包修期的产品。</p>\r\n<p><strong>2.包换政策 </strong><br />\r\n按国家规定的三包期限，在包修期内，符合下列条件，而且用户拒绝维修时，可以换机。 <br />\r\n2.1产品自售出之日起15日内，发生主要性能故障，不能正常工作的，可以换机； <br />\r\n2.2按国家规定的三包期限，在包修期内，主要性能故障连续维修二次，不能正常工作的，可以换机，并按国家三包规定，重新起算包修期限（仅限更换部分）。</p>\r\n<p><strong>3、包退政策 </strong><br />\r\n按国家规定的三包期限，符合下列条件，而且用户拒绝维修或换机时，可以退机。<br />\r\n3.1产品自售出之日起10日内，发生主要性能故障，如压缩机故障、换热器内漏等,可以退机。 <br />\r\n3.2自售出之日起一年以内，连续二次以上仍无法修好（指主要性能）用户坚持退机的。</p>\r\n<p><strong>（二）免费安装政策</strong></p>\r\n<p><strong>1. 免费安装范围 </strong><br />\r\n格力电器家用空调，包括分体式、立柜式、吊顶式、天井式空调均实行免费安装。免费安装费用由特约服务网点按《安装费结算管理制度》要求向格力电器结算，不得向用户收取，但下列情况可与用户协商好后额外收费： <br />\r\n1.1 需加长连接管； <br />\r\n1.2 使用吊车、吊绳安装的；超过四楼在墙外进行施工（在阳台施工不另行收费）； <br />\r\n1.3 在厚度超过120mm 的钢筋水泥墙上钻洞和超过1个以上的墙洞； <br />\r\n1.4 拆除防盗网才能安装的；搬拆移位重安装的； <br />\r\n1.5 安装铁架等所有材料费。</p>\r\n<p><strong>2.下列情况实行收费安装：</strong> <br />\r\n2.1 安装窗式空调器； <br />\r\n2.2 移动空调钻排气口洞； <br />\r\n2.3 无有效发票或有效购买凭证，又无免费安装凭证、无条形码的。</p>\r\n<p>注：对被抽取安装结算条形码的情况，若空调上有条形码的可以免费安装，并记录条形码。如机器上的条形码也被撕去的情况，则不能实行免费安装。由用户向购买商店协商，协商未果的应及时向销售公司申报情况。</p>\r\n<p><strong>退货说明：</strong><br />\r\n格力在线承诺自顾客收到商品之日起7日内（以发票日期为准，如无发票以格力在线发货清单的日期为准），如符合以下条件，我们将提供全款退货的服务。<br />\r\n&nbsp;</p>\r\n<p>1、商品及商品本身的外包装没有损坏，保持格力在线出售时的原质原样；<br />\r\n2、注明退货原因，如果商品存在质量问题，请务必说明；<br />\r\n3、确保商品及配件、附带品或者赠品、保修卡、三包凭证、发票、格力在线发货清单齐全；<br />\r\n4、如果成套商品中有部分商品存在质量问题，在办理退货时，必须提供成套商品；</p>\r\n<p><strong>以下情况不予办理退货：<br />\r\n</strong><br />\r\n1、任何非由格力在线出售的商品；<br />\r\n2、任何已使用过的商品，但有质量问题除外；<br />\r\n3、任何因非正常使用及保管导致出现质量问题的商品。</p>\r\n<p>商品如出现质量问题，请先行按照说明书上的联系方式与厂家的售后部门联系，如果确认属于质量问题，持厂家出具质量问题检测报告与当当客服中心联系办理退货事宜。</p>";}', 1, 1, 1, 1),
(138, '单页信息', 'com=pages', 0, 0, 'com=pages', 'pages', 0, 0, '', 1, 1, 0, 0),
(141, '留言板', 'com=feedbacks', 0, 0, 'com=feedbacks', 'feedbacks', 0, 0, '', 1, 1, 0, 0),
(142, '团购信息', 'com=tuans', 0, 0, 'com=tuans', 'tuans', 0, 0, '', 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `w_configs`
--

DROP TABLE IF EXISTS `w_configs`;
CREATE TABLE IF NOT EXISTS `w_configs` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) default NULL COMMENT '网站名称',
  `email` char(255) default NULL COMMENT '网站管理员邮箱',
  `published` tinyint(1) NOT NULL default '0' COMMENT '站点是否发布',
  `attribs` text NOT NULL COMMENT '配置相关信息',
  `metakey` text NOT NULL COMMENT '网站关键字',
  `metadesc` text NOT NULL COMMENT '描述信息',
  `template` varchar(50) NOT NULL COMMENT '选择的模板文件',
  `uid` int(11) NOT NULL default '0',
  `logo` varchar(255) default NULL,
  `banner` text,
  `bannertype` tinyint(2) NOT NULL default '1',
  `column` tinyint(2) NOT NULL default '3',
  `options` text,
  PRIMARY KEY  (`id`),
  KEY `idx_state` (`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `w_configs`
--

INSERT INTO `w_configs` (`id`, `title`, `email`, `published`, `attribs`, `metakey`, `metadesc`, `template`, `uid`, `logo`, `banner`, `bannertype`, `column`, `options`) VALUES
(32, '格力在线', 'whl_whm@126.com', 0, '', '格力在线关键字', '格力在线网站描述', 'default', 1, '/media/1/webtitle.gif', '', 1, 2, 'a:9:{s:10:"thumbwidth";s:3:"180";s:11:"thumbheight";s:3:"180";s:8:"imgwidth";s:3:"350";s:9:"imgheight";s:3:"350";s:7:"deposit";s:3:"100";s:12:"price_format";s:1:"1";s:11:"integralway";s:1:"2";s:12:"integralrate";s:0:"";s:5:"cache";s:1:"0";}');

-- --------------------------------------------------------

--
-- 表的结构 `w_configs_option`
--

DROP TABLE IF EXISTS `w_configs_option`;
CREATE TABLE IF NOT EXISTS `w_configs_option` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(60) NOT NULL,
  `com_name` varchar(20) default NULL,
  `spec_type` tinyint(1) NOT NULL default '0' COMMENT '显示类型',
  `spec_show_type` tinyint(1) NOT NULL default '0' COMMENT '显示方式',
  `published` tinyint(1) unsigned NOT NULL default '1',
  `attr_group` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `w_configs_option`
--

INSERT INTO `w_configs_option` (`id`, `name`, `com_name`, `spec_type`, `spec_show_type`, `published`, `attr_group`) VALUES
(1, '商品设置', '', 1, 1, 1, 'a:5:{s:9:"opt_field";a:6:{i:0;s:10:"thumbwidth";i:1;s:11:"thumbheight";i:2;s:8:"imgwidth";i:3;s:9:"imgheight";i:4;s:7:"deposit";i:5;s:12:"price_format";}s:8:"opt_name";a:6:{i:0;s:15:"缩略图宽度";i:1;s:15:"缩略图高度";i:2;s:18:"商品图片宽度";i:3;s:18:"商品图片高度";i:4;s:15:"产品预付款";i:5;s:18:"货币显示方式";}s:7:"opt_way";a:6:{i:0;s:1:"0";i:1;s:1:"0";i:2;s:1:"0";i:3;s:1:"0";i:4;s:1:"0";i:5;s:1:"1";}s:9:"opt_value";a:6:{i:0;s:1:"3";i:1;s:1:"4";i:2;s:0:"";i:3;s:0:"";i:4;s:0:"";i:5;s:160:"0:保留两位小数,1: 保留不为 0 的尾数,2:不四舍五入，保留1位,3:直接取整,4:四舍五入，保留 1 位,5:先四舍五入，不保留小数";}s:10:"opt_remark";a:6:{i:0;s:45:"上传商品图片时生成缩略图的宽度";i:1;s:111:" 如果您的服务器支持GD，在您上传商品图片的时候将自动将图片缩小到指定的尺寸。";i:2;s:33:"前台商品大图显示的宽度";i:3;s:0:"";i:4;s:31:" 客户可以选择预付定金";i:5;s:0:"";}}'),
(2, '产品配送/支付/售后说明', 'products', 0, 0, 0, 'a:5:{s:9:"opt_field";a:3:{i:0;s:7:"payment";i:1;s:12:"distribution";i:2;s:7:"service";}s:8:"opt_name";a:3:{i:0;s:18:"支付方式说明";i:1;s:12:"配送说明";i:2;s:12:"售后服务";}s:7:"opt_way";a:3:{i:0;s:1:"5";i:1;s:1:"5";i:2;s:1:"5";}s:9:"opt_value";a:3:{i:0;s:0:"";i:1;s:0:"";i:2;s:0:"";}s:10:"opt_remark";a:3:{i:0;s:0:"";i:1;s:0:"";i:2;s:0:"";}}'),
(3, '积分设置', '', 0, 0, 1, 'a:5:{s:9:"opt_field";a:2:{i:0;s:11:"integralway";i:1;s:12:"integralrate";}s:8:"opt_name";a:2:{i:0;s:18:"积分计算方式";i:1;s:18:"积分换算比率";}s:7:"opt_way";a:2:{i:0;s:1:"1";i:1;s:1:"0";}s:9:"opt_value";a:2:{i:0;s:87:"0:不使用积分,1:按订单商品总价格计算积分 ,2:为商品单独设置积分";i:1;s:0:"";}s:10:"opt_remark";a:2:{i:0;s:0:"";i:1;s:95:"使用订单积分时有效<br/>订单所得积分 = 订单商品总价格 X 积分换算比率";}}'),
(4, '商品显示设置', '', 1, 1, 0, ''),
(5, '缓存设置', '', 0, 0, 1, 'a:5:{s:9:"opt_field";a:1:{i:0;s:5:"cache";}s:8:"opt_name";a:1:{i:0;s:24:"是否开启模块缓存";}s:7:"opt_way";a:1:{i:0;s:1:"1";}s:9:"opt_value";a:1:{i:0;s:11:"0:否,1:是";}s:10:"opt_remark";a:1:{i:0;s:0:"";}}');

-- --------------------------------------------------------

--
-- 表的结构 `w_contents`
--

DROP TABLE IF EXISTS `w_contents`;
CREATE TABLE IF NOT EXISTS `w_contents` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `title_alias` varchar(255) NOT NULL default '',
  `introtext` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `isfront` tinyint(2) default NULL,
  `attr` tinyint(2) NOT NULL default '0',
  `menuid` int(11) unsigned NOT NULL default '0',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `author` varchar(50) default NULL,
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` text NOT NULL,
  `version` int(11) unsigned NOT NULL default '1',
  `parentid` int(11) unsigned NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(11) unsigned NOT NULL default '0',
  `hits` int(11) unsigned NOT NULL default '0',
  `metadata` text NOT NULL,
  `uid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`menuid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=243 ;

--
-- 转存表中的数据 `w_contents`
--

INSERT INTO `w_contents` (`id`, `title`, `alias`, `title_alias`, `introtext`, `content`, `published`, `isfront`, `attr`, `menuid`, `created`, `modified`, `author`, `images`, `urls`, `attribs`, `version`, `parentid`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`, `uid`) VALUES
(185, '发票制度', '', '', '', '<p>　　在格力在线购物时均开具正规机打发票。发票是用户用于商品的保修、退换货的凭证，请妥善保存。请在订单提交之前确认好发票抬头，订单生成后发票抬头将无法修改。</p>\r\n<p><strong>格力在线发票注意事项</strong><br />\r\n<br />\r\n<strong>一、个人购买：</strong><br />\r\n1、个人开具普通发票，如您购买商品需要填写公司名称，请您在下订单时填好备注，把公司的&ldquo;完整名称&rdquo;填写好。</p>\r\n<p><strong>二、公司购买：</strong><br />\r\n<br />\r\n（一）公司需开具增值税发票<br />\r\n1.公司需开具增值税发票，在格力在线购买商品下订单时勾选增值税发票，并且填写增值税发票相关信息；<br />\r\n2.填写订单信息时选择增值税发票，完成付款并收货15天内，寄送以下相关证件至格力在线换取增值税专用发票，我们将在您的订单付款成功并收到相关证件后，原则上3到5个工作日内开具增值税发票并邮寄至贵单位，如遇到特殊情况顺延，最终解释权为格力在线所有。<br />\r\n<br />\r\n公司开增值税发票相关证件：<br />\r\n（1）增值税专用发票领取通知单原件。<br />\r\n（2）税务登记证副本复印件并加盖公章。<br />\r\n寄送地址：广东省深圳市南山区创新科技园留学生创业大厦应收账款部。<br />\r\n电话：0755-84418888-885062或885155<br />\r\n联系人：应收账款部销售开票组<br />\r\n<br />\r\n3.客户如选择换开增值税发票，所开货物名称只能为实际购买货物明细，不得随意更改其他开票项目。<br />\r\n<br />\r\n4.您在寄换开增票的相关资料到格力在线深圳服务中心应收账款部的时候，产生的相关邮寄费用由您自行承担，如果您选择&ldquo;到付&rdquo;我司将拒签此快件，因此原因造成换票时间延误，由您自行承担责任。<br />\r\n<br />\r\n5.您在网上商城购买商品时请详细正确填写寄送地址与联系方式，如因未填写或填写错误造成无法寄送或寄送错误，由您自行承担。</p>\r\n<p><strong>（二）公司需开具增值税发票并参加以旧换新活动</strong><br />\r\n<br />\r\n1、省内公司参加以旧换新开增值税发票<br />\r\n<br />\r\n（1）省内公司开增值税发票，开具的前提条件是企业单位而非个人，填写订单信息时选择参加以旧换新、普通发票（发票抬头必须填写公司名称）；<br />\r\n（2）凭普通发票在收货城市门店领取以旧换新补贴，并在普通发票开具日期起一个月之内，寄送以下证件至格力在线换取增值税专用发票。我们将在您的订单付款成功并收到相关证件后，原则上3到5个工作日内开具增值税发票并邮寄至贵单位，如遇到特殊情况顺延，最终解释权为格力在线所有。</p>\r\n<p><strong>广东省内增值税发票开具相关证件：<br />\r\n</strong><br />\r\n1）格力在线普通发票原件。要求普通发票上的单位名称须与换开税票单位名称一致。<br />\r\n2）税务登记证副本复印件并加盖公章。<br />\r\n3）单位出具购买商品自用证明并加盖公章。<br />\r\n4）在格力在网站下载并填写开票信息单内容。</p>\r\n<p><strong>开票信息单</strong><br />\r\n按照下表格式，填写开票信息单后打印。</p>\r\n<table width="90%" border="1" cellpadding="10" cellspacing="0" style="border-collapse:collapse; font:normal 12px/20px ''宋体'';">\r\n    <tbody>\r\n        <tr>\r\n            <td colspan="2">开 票 信 息 单</td>\r\n        </tr>\r\n        <tr>\r\n            <td>单位名称：</td>\r\n            <td>纳税人识别号：</td>\r\n        </tr>\r\n        <tr>\r\n            <td>开户银行：</td>\r\n            <td>银行帐号：</td>\r\n        </tr>\r\n        <tr>\r\n            <td>单位地址:</td>\r\n            <td>联系电话：</td>\r\n        </tr>\r\n        <tr>\r\n            <td>邮寄地址：</td>\r\n            <td>经办人姓名：</td>\r\n        </tr>\r\n        <tr>\r\n            <td>身份证号码：</td>\r\n            <td>SAP订单号：</td>\r\n        </tr>\r\n        <tr>\r\n            <td>购货日期：</td>\r\n            <td>普通发票号码：</td>\r\n        </tr>\r\n        <tr>\r\n            <td>发票金额：</td>\r\n            <td>付款方式：      1、现金     2、网银    3、支票      4、其他:</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p>&nbsp;</p>', 1, 0, 0, 380, '2010-12-03 03:24:55', '2011-02-21 11:24:23', '', '', '', '', 1, 0, 4, '格力在线 发票制度 以旧换新', '格力在线购物发票制度说明', 0, 50, '', 1),
(186, '网站订购流程', '', '', '', '<p><img alt="" src="/media/1/products/gt.gif" /></p>\r\n<p>1、搜索商品<br />\r\n格力在线为您提供了方便快捷的商品搜索功能：<br />\r\n（1）您可以通过在首页输入关键字的方法来搜索您想要购买的商品<br />\r\n（2）您还可以通过当当的分类导航栏来找到您想要购买的商品分类，根据分类找到您的商品<br />\r\n（3）观看 搜索商品 演示</p>\r\n<p>2、放入购物车               <br />\r\n在您想要购买的商品的详情页点击&ldquo;购买&rdquo;，商品会添加到您的购物车中；您还可以继续挑选商品放入购物车，一起结算。<br />\r\n（1）在购物车中，系统默认每件商品的订购数量为一件，如果您想购买多件商品，可修改购买数量<br />\r\n（2）在购物车中，您可以将商品 移至收藏 ，或是选择删除<br />\r\n（3）在购物车中，您可以直接查看到商品的优惠折和参加促销活动的商品名称、促销主题<br />\r\n（4）购物车页面下方的商品是格力在线根据您挑选的商品为您作出的推荐，若有您喜爱的商品，点击&ldquo;放入购物车&rdquo;即可<br />\r\n<br />\r\n温馨提示：<br />\r\n（1）商品价格会不定期调整，最终价格以您提交订单后订单中的价格为准<br />\r\n（2）优惠政策、配送时间、运费收取标准等都有可能进行调整，最终成交信息以您提交订单时网站公布的最新信息为准</p>\r\n<p>3、选择订单                       <br />\r\n（1）格力在线和 商家 的商品需要分别提交订单订购<br />\r\n（2）不同 商家 的商品需要分别提交订单订购</p>\r\n<p>4、注册登陆<br />\r\n（1）老顾客：请在&ldquo;登陆 &rdquo;页面输入Email地址或昵称、注册密码进行登陆<br />\r\n（2）新顾客：请在&ldquo;新用户注册 &rdquo;页面按照提示完成注册</p>\r\n<p>5、填写收货人信息                                                <br />\r\n（1）请填写正确完整的收货人姓名、收货人联系方式、详细的收货地址和邮编，否则将会影响您订单的处理或配送<br />\r\n（2）您可以进入&ldquo;我的当当&mdash;帐户管理&mdash;收货地址簿&rdquo;编辑常用收货地址，保存成功后，再订购时，可以直接选择使用</p>\r\n<p>6、选择收货方式<br />\r\n格力在线提供多种收货方式：<br />\r\n（1）普通快递送货上门<br />\r\n（2）加急快递送货上门<br />\r\n（3）普通邮递<br />\r\n（4）邮政特快专递(EMS)</p>\r\n<p>7、选择支付方式                        <br />\r\n格力在线提供多种支付方式，订购过程中您可以选择：<br />\r\n（1）货到付款<br />\r\n（2）网上支付<br />\r\n（3）银行转帐<br />\r\n（4）邮局汇款</p>\r\n<p>8、索取发票            <br />\r\n请点击&ldquo;索取发票&rdquo;，填写正确的发票抬头、选择正确的发票内容，发票选择成功后，将于订单货物一起送达<br />\r\n<a href="xinshouzhinan/185.html">       点击查看 发票制度         </a></p>\r\n<p>9、提交订单<br />\r\n（1）以上信息核实无误后，请点击&ldquo;提交订单&rdquo;，系统生成一个订单号，就说明您已经成功提交订单<br />\r\n（2）订单提交成功后，您可以登陆&ldquo;我的当当 &rdquo;查看订单信息或为订单进行 网上支付</p>\r\n<p>&nbsp;</p>\r\n<p>特别提示         <br />\r\n1、若您帐户中有礼品卡，可以在&ldquo;支付方式&rdquo;处选择使用礼品卡支付，详情请点击查看 当当礼品卡<br />\r\n2、若您帐户中有符合支付该订单的礼券，在结算页面会有&ldquo;使用礼券&rdquo;按钮，您点击选择礼券即可，点击查看 礼券使用规则       当您选择了礼券并点击&ldquo;确定使用&rdquo;后，便无法再取消使用该礼券<br />\r\n3、在订单提交高峰时段，新订单可能一段时间之后才会在&ldquo;我的当当&rdquo;中显示。如果您在&ldquo;我的当当&rdquo;中暂未找到这张订单，请您耐心等待</p>', 1, 0, 0, 380, '2010-12-03 03:25:04', '2011-02-21 11:41:00', '', '', '', '', 1, 0, 3, '', '', 0, 62, '', 1),
(187, '注册新用户', '', '', '', '<p>欢迎注册格力在线！<br />\r\n请点击 <a href="/index.php?com=users&amp;layout=registor">新用户注册</a> ，按照流程提示操作即可！</p>\r\n<p>注册步骤详解如下：<br />\r\n1、进入格力在线首页，点击左上角的&ldquo;免费注册&rdquo;<br />\r\n<br />\r\n<img alt="" src="/media/1/products/top.gif" /></p>\r\n<p>2、按照网页提示，填写准确的注册信息后点击&ldquo;提交注册&rdquo; <br />\r\n<img alt="" src="/media/1/products/registor.gif" /></p>\r\n<p>&nbsp;</p>\r\n<p>温馨提示：<br />\r\n（1）请务必填写正确有效的注册邮箱地址，否则当您忘记注册密码时，无法成功找回，只能重新注册新用户<br />\r\n（2）注册成功后，您可以 修改EMAIL地址、修改昵称、修改密码</p>', 1, 0, 0, 380, '2010-12-03 03:25:12', '2011-02-21 12:02:44', '', '', '', '', 1, 0, 2, '', '', 0, 36, '', 1),
(188, '验货和签收', '', '', '', '<p><strong>快递送货上门的订单 </strong><br />\r\n1、签收时仔细核对：商品及配件、商品数量、格力在线的发货清单、发票（如有）、三包凭证（如有）等  <br />\r\n2、若存在包装破损、商品错误、商品少发、商品有表面质量问题等影响签收的因素，请您一定要当面向送货员说明情况并当场整单退货</p>\r\n<p><strong>邮局邮寄的订单 </strong><br />\r\n1、请您一定要小心开包，以免尖锐物件损伤到包裹内的商品 <br />\r\n2、签收时仔细核对：商品及配件、商品数量、格力在线的发货清单、发票（如有）、三包凭证（如有）等  <br />\r\n3、若包装破损、商品错误、商品少发、商品存在表面质量问题等，您可以选择整单退货；或是求邮局开具相关证明后签收，然后登陆格力在线申请退货或申请换货</p>\r\n<p><strong>温馨提示 </strong> <br />\r\n1、货到付款的订单送达时，请您当面与送货员核兑商品与款项，确保货款两清；若事后发现款项有误，格力在线将无法为您处理 <br />\r\n2、请收货时务必认真核对，若您或您的委托人已签收，则说明订单商品正确无误且不存在影响使用的因素，格力在线有权不受理因包装或商品破损、商品错漏发、商品表面质量问题、商品附带品及赠品少发为由的退换货申请 <br />\r\n3、部分商品由商店街的商家提供,这部分商品的验货验收不在格力在线承诺的范围内</p>', 1, 0, 0, 381, '2010-12-03 03:25:36', '2011-02-21 14:09:38', '', '', '', '', 1, 0, 5, '', '', 0, 35, '', 1),
(189, '配送方式及运费', '', '', '', '<p><strong>1、格力空调免费送货上门，免费安装。</strong><br />\r\n凡在线购买格力空调用户，格力同城市专营店会直接免费送货上门，免费安装调试。</p>\r\n<p><strong>2、格力小家电快递送货</strong><br />\r\n格力小家电由格力省级代理商直接同省市快递配货方式或自行上门提货方式配送。<br />\r\n快递运货见具体产品详细页配送运货</p>\r\n<p><strong>3.自提</strong><br />\r\n支持全国30个城市用户上门自提，免收运费。查看自提信息。</p>', 1, 0, 0, 381, '2010-12-03 03:25:45', '2011-02-21 14:22:27', '', '', '', '', 1, 0, 6, '', '', 0, 29, '', 1),
(190, '网上支付', '', '', '', '<p>1、格力在线提供的网上支付方式<br />\r\n我们为您提供银行卡在线支付（工商银行、招商银行、建设银行、深圳发展银行、农业银行）、银联支付、财付通支付、快钱网上支付、快钱信用卡支付、支付宝支付、由首信支付平台支持的国外信用卡支付网上支付方式。 银行卡在线支付所支持的卡种有：</p>\r\n<table width="50%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; text-align:center; font:normal 12px/22px 宋体;">\r\n    <tbody>\r\n        <tr>\r\n            <td><span class="Apple-style-span" style="color: rgb(64, 64, 64); font-size: 12px; font-weight: bold; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; ">银行名称</span></td>\r\n            <td><span class="Apple-style-span" style="color: rgb(64, 64, 64); font-size: 12px; font-weight: bold; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; ">支持网上支付的银行卡名称</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt="" src="/media/1/products/button_jdx081126_12.jpg" /></td>\r\n            <td><span class="Apple-style-span" style="color: rgb(64, 64, 64); font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; ">一卡通、信用卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt="" src="/media/1/products/button_jdx081126_9.jpg" /></td>\r\n            <td><span class="Apple-style-span" style="color: rgb(64, 64, 64); font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; ">借记卡、信用卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt="" src="/media/1/products/button_jdx081126_10.jpg" /></td>\r\n            <td><span class="Apple-style-span" style="color: rgb(64, 64, 64); font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; ">龙卡储蓄卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt="" src="/media/1/products/button_jdx081126_11.jpg" /></td>\r\n            <td><span class="Apple-style-span" style="color: rgb(64, 64, 64); font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; ">借记卡、信用卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt="" src="/media/1/products/weibiaoti-1.gif" /></td>\r\n            <td><span class="Apple-style-span" style="color: rgb(64, 64, 64); font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; ">借记卡、准贷记卡</span></td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p><br />\r\n网上支付平台所支持的银行卡种有：</p>\r\n<table width="50%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; text-align:center;  font:normal 12px/22px 宋体;">\r\n    <tbody>\r\n        <tr>\r\n            <td><font class="Apple-style-span" color="#404040" face="Simsun"><span class="Apple-style-span" style="border-collapse: separate; font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px;"><b>支付平台名称</b></span></font></td>\r\n            <td><span class="Apple-style-span" style="color: rgb(64, 64, 64); font-size: 12px; font-weight: bold; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; ">支持网上支付的银行卡名称</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt="" src="/media/1/products/yinlianbiaozhi.jpg" /></td>\r\n            <td><font class="Apple-style-span" color="#404040" face="Simsun"><span class="Apple-style-span" style="border-collapse: separate; font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px;">银联支付</span></font></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt="" src="/media/1/products/alipay.jpg" /></td>\r\n            <td><font class="Apple-style-span" color="#404040" face="Simsun"><span class="Apple-style-span" style="border-collapse: separate; font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px;">支付宝支付</span></font></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt="" src="/media/1/products/button_jdx081126_6.jpg" /></td>\r\n            <td><font class="Apple-style-span" color="#404040" face="Simsun"><span class="Apple-style-span" style="border-collapse: separate; font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px;">快钱网上支付</span></font></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt="" src="/media/1/products/cft_lxq090312.JPG" /></td>\r\n            <td><font class="Apple-style-span" color="#404040" face="Simsun"><span class="Apple-style-span" style="border-collapse: separate; font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px;">财付通支付</span></font></td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<p>温馨提示：<br />\r\n1）目前使用快钱网上支付单笔支付金额最高可达到1万元（不同的银行的支付金额不同）<br />\r\n2）快钱网上大金额支付支持的银行有：工商银行、招商银行、建设银行、农业银行、广东发展银行、兴业银行<br />\r\n2、银行卡的开通手续</p>\r\n<p>因各地银行政策不同，建议您在网上支付前拨打所在地银行电话，咨询该行可供网上支付的银行卡种类及开通手续。</p>\r\n<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; text-align:center;  font:normal 12px/22px 宋体;">\r\n    <tbody>\r\n        <tr>\r\n            <td>银行名称</td>\r\n            <td>服务热线</td>\r\n            <td>银行名称</td>\r\n            <td>服务热线</td>\r\n            <td>银行名称</td>\r\n            <td>服务热线</td>\r\n        </tr>\r\n        <tr>\r\n            <td>招商银行</td>\r\n            <td>95555</td>\r\n            <td>中国银行</td>\r\n            <td>95566</td>\r\n            <td>交通银行</td>\r\n            <td>95559</td>\r\n        </tr>\r\n        <tr>\r\n            <td>中国工商银行</td>\r\n            <td>95588</td>\r\n            <td>北京银行</td>\r\n            <td>96169</td>\r\n            <td>光大银行</td>\r\n            <td>95595</td>\r\n        </tr>\r\n        <tr>\r\n            <td>中国建设银行</td>\r\n            <td>95533</td>\r\n            <td>中国农业银行</td>\r\n            <td>95599</td>\r\n            <td>深圳发展银行</td>\r\n            <td>95501</td>\r\n        </tr>\r\n        <tr>\r\n            <td>上海浦东发展银行</td>\r\n            <td>95528</td>\r\n            <td>广东发展银行</td>\r\n            <td>95508</td>\r\n            <td>中国邮政</td>\r\n            <td>11185</td>\r\n        </tr>\r\n        <tr>\r\n            <td>民生银行</td>\r\n            <td>95568</td>\r\n            <td>华夏银行</td>\r\n            <td>95577</td>\r\n            <td>中信银行</td>\r\n            <td>86668888</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p>3、支付金额上限<br />\r\n目前各银行对于网上支付均有一定金额的限制，由于各银行政策不同，建议您在申请网上支付功能时向银行咨询相关事宜。</p>\r\n<p>4、怎样判断网上支付是否成功？<br />\r\n1)当您完成网上在线支付过程后，系统应提示支付成功；如果系统没有提示支付失败或成功，您可通过电话、ATM 、柜台或登录网上银行等各种方式查询银行卡余额，如果款项已被扣除，说明您已支付成功。<br />\r\n2)如果出现信用卡超额透支、存折余额不足、意外断线等导致支付不成功，请您登录格力在线&quot;我的帐户&quot;，找到该张未支付成功的订单，重新完成支付。</p>\r\n<p>5、造成&quot;支付被拒绝&quot;的原因有哪些？<br />\r\n1）所持银行卡尚未开通网上在线支付功能；<br />\r\n2）所持银行卡已过期、作废、挂失；<br />\r\n3）所持银行卡内余额不足；<br />\r\n4）输入银行卡卡号或密码不符；<br />\r\n5）输入证件号不符；<br />\r\n6）银行系统数据传输出现异常；<br />\r\n7）网络中断。</p>', 1, 0, 0, 382, '2010-12-03 03:26:00', '2011-02-21 14:48:02', '', '', '', '', 1, 0, 7, '', '', 0, 19, '', 1),
(191, '先付订金', '', '', '', '<p>&nbsp;<strong>先付定金：您在线购买空调，可以在格力在线购物平台上支付要求的产品购买定金，在免费上门安装时再支付余下货款</strong></p>\r\n<p>&nbsp;</p>\r\n<p><br />\r\n温馨提示：<br />\r\n1、货到付款仅限支付现金<br />\r\n2、签收时，请您仔细核兑款项、务必作到货款两清，若事后发现款项错误，我们将无法再核实确认  <br />\r\n3、部分格力小家电不支持货到付款，请您通过 网上支付、邮局汇款、银行转帐方式支付</p>', 1, 0, 0, 382, '2010-12-03 03:26:09', '2011-02-21 15:14:01', '', '', '', '', 1, 0, 8, '', '', 0, 13, '', 1),
(192, '退换货说明', '', '', '', '<p><strong>退货说明：</strong><br />\r\n格力在线承诺自顾客收到商品之日起7日内（以发票日期为准，如无发票以格力在线发货清单的日期为准），如符合以下条件，我们将提供全款退货的服务。<br />\r\n&nbsp;</p>\r\n<p>1、商品及商品本身的外包装没有损坏，保持格力在线出售时的原质原样；<br />\r\n2、注明退货原因，如果商品存在质量问题，请务必说明；<br />\r\n3、确保商品及配件、附带品或者赠品、保修卡、三包凭证、发票、格力在线发货清单齐全；<br />\r\n4、如果成套商品中有部分商品存在质量问题，在办理退货时，必须提供成套商品；<br />\r\n</p>\r\n<p><strong>以下情况不予办理退货：<br />\r\n</strong><br />\r\n1、任何非由格力在线出售的商品；<br />\r\n2、任何已使用过的商品，但有质量问题除外；<br />\r\n3、任何因非正常使用及保管导致出现质量问题的商品。</p>\r\n<p>商品如出现质量问题，请先行按照说明书上的联系方式与厂家的售后部门联系，如果确认属于质量问题，持厂家出具质量问题检测报告与当当客服中心联系办理退货事宜。</p>', 1, 0, 0, 383, '2010-12-03 03:26:21', '2011-02-21 15:45:37', '', '', '', '', 1, 0, 9, '', '', 0, 8, '', 1),
(193, '空调维护', '', '', '', '<p><img src="/media/1/index_20110228l.jpg" alt="" /></p>\r\n<p><strong>服务宗旨：用户满意！<br />\r\n服务理念：用户的每一件小事，都是格力的大事</strong></p>\r\n<p><strong>（一）产品三包政策</strong><br />\r\n<br />\r\n<strong>1.包修政策</strong><br />\r\n2010年度家用空调（制冷量小于或等于14000W）、除湿机包修政策为整机包修六年。<br />\r\n2005年1月1日至2009年12月31日所购买的家用空调器整机包修六年。<br />\r\n2005年1月1日之前所购买的家用空调器的包修政策：按其当年的包修规定执行。</p>\r\n<p>以下情况之一的不属于包修范围，将按有关规定实行收费维修：	<br />\r\n1.1消费者因使用、维护、保管不当造成损坏的；<br />\r\n1.2非格力电器指定的特约服务网点所安装、维修造成损坏的（包括消费者自行安装或拆动维修的）；<br />\r\n1.3无包修凭证及有效发票或有效购买凭证的；<br />\r\n1.4有效凭证、包修凭证不符或涂改的；<br />\r\n1.5因不可抗拒的自然灾害或使用环境恶劣造成损坏的；<br />\r\n1.6处理品、已超过包修期的产品。</p>\r\n<p><strong>2.包换政策 </strong><br />\r\n按国家规定的三包期限，在包修期内，符合下列条件，而且用户拒绝维修时，可以换机。 <br />\r\n2.1产品自售出之日起15日内，发生主要性能故障，不能正常工作的，可以换机； <br />\r\n2.2按国家规定的三包期限，在包修期内，主要性能故障连续维修二次，不能正常工作的，可以换机，并按国家三包规定，重新起算包修期限（仅限更换部分）。</p>\r\n<p><strong>3、包退政策 </strong><br />\r\n按国家规定的三包期限，符合下列条件，而且用户拒绝维修或换机时，可以退机。<br />\r\n3.1产品自售出之日起10日内，发生主要性能故障，如压缩机故障、换热器内漏等,可以退机。 <br />\r\n3.2自售出之日起一年以内，连续二次以上仍无法修好（指主要性能）用户坚持退机的。</p>\r\n<p><strong>（二）免费安装政策</strong></p>\r\n<p><strong>1. 免费安装范围 </strong><br />\r\n格力电器家用空调，包括分体式、立柜式、吊顶式、天井式空调均实行免费安装。免费安装费用由特约服务网点按《安装费结算管理制度》要求向格力电器结算，不得向用户收取，但下列情况可与用户协商好后额外收费： <br />\r\n1.1 需加长连接管； <br />\r\n1.2 使用吊车、吊绳安装的；超过四楼在墙外进行施工（在阳台施工不另行收费）； <br />\r\n1.3 在厚度超过120mm 的钢筋水泥墙上钻洞和超过1个以上的墙洞； <br />\r\n1.4 拆除防盗网才能安装的；搬拆移位重安装的； <br />\r\n1.5 安装铁架等所有材料费。</p>\r\n<p><strong>2.下列情况实行收费安装：</strong> <br />\r\n2.1 安装窗式空调器； <br />\r\n2.2 移动空调钻排气口洞； <br />\r\n2.3 无有效发票或有效购买凭证，又无免费安装凭证、无条形码的。</p>\r\n<p>注：对被抽取安装结算条形码的情况，若空调上有条形码的可以免费安装，并记录条形码。如机器上的条形码也被撕去的情况，则不能实行免费安装。由用户向购买商店协商，协商未果的应及时向销售公司申报情况。</p>', 1, 0, 0, 383, '2010-12-03 03:26:39', '2011-03-23 15:39:14', '', '', '', '', 1, 0, 10, '', '', 0, 8, '', 1),
(194, '维修预约', '', '', '', '', 1, 0, 0, 383, '2010-12-03 03:26:50', '2011-02-17 13:57:26', '', '', '', '', 1, 0, 11, '', '', 0, 1, '', 1),
(195, '常见问题', '', '', '', '', 1, 0, 0, 384, '2010-12-03 03:27:26', '2011-02-17 13:57:56', '', '', '', '', 1, 0, 12, '', '', 0, 42, '', 1),
(196, '积分说明', '', '', '', '<p>所有会员在格力在线购物均可获得积分，积分可以用来参与兑换活动。格力在线会不定期推出各类积分兑换活动，请随时关注关于积分的活动告知。详情请点击查看以下各项说明。</p>\r\n<p><strong>积分获得 </strong><br />\r\n1、每一张成功交易的订单，所付现金部分都可获得积分，不同商品积分标准不同，获得积分以订单提交时所注明的积分为准。<br />\r\n2、贵宾会员购物时，将额外获得相应级别的级别赠分。 <br />\r\n3、阶段性的积分促销活动，也会给您带来额外的促销赠分，详见积分活动。 <br />\r\n4、促销商品不能获得积分。</p>\r\n<p>&middot;积分会在订单状态变为&quot;交易成功&quot;的次日记入您的帐户。如发生退货，将扣除由于退货部分产生的积分；</p>\r\n<p><strong>积分有效期</strong><br />\r\n积分有效期：获得之日起到次年年底。</p>\r\n<p>查询积分                                                                                           积分有效期：获得之日起到次年年底。 您可以在&quot;会员中心-我的积分 &quot;中，查看您的累计积分。</p>\r\n<p><strong>积分活动</strong><br />\r\n格力在线会不定期地推出各种积分活动，请随时关注关于积分促销的告知。<br />\r\n1、会员可以用积分参与格力在线指定的各种活动，参与后会扣减相应的积分。<br />\r\n2、积分不可用于兑换现金，仅限参加格力在线指定兑换物品、参与抽奖等各种活动。</p>\r\n<p><strong>会员积分计划细则</strong><br />\r\n不同帐户积分不可合并使用；<br />\r\n&middot;本计划只适用于个人用途而进行的购物，不适用于团体购物、以营利或销售为目的的购买行为、其他非个人用途购买行为。 <br />\r\n&middot;会员积分计划及原VIP制度的最终解释权归格力在线所有。</p>\r\n<p><strong>免责条款</strong> <br />\r\n感谢您访问格力在线的会员积分计划，本计划由深圳格力在线信息技术有限公司/或其关联企业提供。以上计划条款和条件，连同计划有关的任何促销内容的相应条款和条件，构成本计划会员与格力在线之间关于制度的完整协议。如果您使用格力在线，您就参加了本计划并接受了这些条款、条件、限制和要求。请注意，您对格力在线站的使用以及您的会员资格还受制于格力在线站上时常更新的所有条款、条件、限制和要求，请仔细阅读这些条款和条件。</p>\r\n<p><strong>协议的变更</strong> <br />\r\n格力在线可以在没有特殊通知的情况下自行变更本条款、格力在线的任何其它条款和条件、或您的计划会员资格的任何方面。 对这些条款的任何修改将被包含在格力在线的更新的条款中。如果任何变更被认定为无效、废止或因任何原因不可执行，则该变更是可分割的，且不影响其它变更或条件的有效性或可执行性。在我们变更这些条款后，您对格力在线的继续使用，构成您对变更的接受。</p>\r\n<p><strong>终止</strong></p>\r\n<p>格力在线可以不经通知而自行决定终止全部或部分计划，或终止您的计划会员资格。即使格力在线没有要求或强制您严格遵守这些条款，也并不构成对属于格力在线的任何权利的放弃。如果您在格力在线的客户帐户被关闭，那么您也将丧失您的会员资格。对于该会员资格的丧失，您对格力在线不能主张任何权利或为此索赔。</p>\r\n<p><strong>责任限制</strong></p>\r\n<p>除了格力在线的使用条件中规定的其它限制和除外情况之外，在中国法律法规所允许的限度内，对于因会员积分计划而引起的或与之有关的任何直接的、间接的、特殊的、附带的、后果性的或惩罚性的损害，或任何其它性质的损害， 格力在线、格力在线的董事、管理人员、雇员、代理或其它代表在任何情况下都不承担责任。格力在线的全部责任，不论是合同、保证、侵权（包括过失）项下的还是其它的责任，均不超过您所购买的与该索赔有关的商品价值额。这些责任排除和限制条款将在法律所允许的最大限度内适用，并在您的计划会员资格被撤销或终止后仍继续有效。</p>', 1, 0, 0, 380, '2011-02-17 13:54:37', '2011-02-21 14:03:06', '', '', '', '', 1, 0, 1, '会员积分,积分获得,积分有效期,积分活动，免责条款', '', 0, 19, '', 1),
(197, '加急配送', '', '', '', '<p><strong>如何正确选择加急配送服务</strong><br />\r\n北京、天津、上海、广州、深圳、廊坊6个城市地区的用户，并且为当地发货订单，用户可在结算中心&ldquo;送货方式&rdquo;部分选择加急快递送货上门服务。</p>\r\n<p><strong>常见问题解答：<br />\r\n</strong><br />\r\n1. 我的订单什么时候可以送到？<br />\r\n具体配送时间根据不同城市略有不同，请查看配送范围、时间及运费<br />\r\n<br />\r\n2. &quot;加急快递送货上门&quot;的费收取标准？<br />\r\n北京、天津、上海、广州、深圳、廊坊6个城市的&ldquo;加急快递送货上门&rdquo;配送费为10元/单。</p>', 1, 0, 0, 381, '2011-02-17 13:55:47', '2011-02-21 14:13:06', '', '', '', '', 1, 0, 13, '', '', 0, 7, '', 1),
(198, '邮政汇款', '', '', '', '<p>1、邮局汇款的到款时间：一般自您办理邮局汇款手续之日起2-7个工作日。<br />\r\n2、邮局汇款单填写说明：（您只需填写以下信息即可）如下图所示：<br />\r\n<img alt="" src="/media/1/products/button_jdx081124_1.jpg" /></p>\r\n<p>（1）在客户签名处填写：您的姓名<br />\r\n（2）在汇款金额处填写：您的汇款金额（小写）<br />\r\n（3）在商务汇款处：&ldquo;&radic;&rdquo;；同时商户客户号要填写：110700150<br />\r\n（4）在汇款人地址/电话处填写：您的详细地址和您的联系电话<br />\r\n（5）在汇款人邮编处填写：您的邮政编码<br />\r\n（6）在汇款人姓名处填写：您的姓名<br />\r\n（7）在附言栏处：&ldquo;&radic;&rdquo;；同时一定要填写：您的订单号</p>\r\n<p>注意事项：<br />\r\n（1）自订单提交之日起7日我们未收到您的货款，订单将被取消，若您还需要其中的商品，需重新提交一张订单。<br />\r\n（2）请您尽量不要采用&ldquo;加密汇款&rdquo;方式,因为该汇款方式的取款速度较慢，会耽误订单的处理进程<br />\r\n（3）如您未注明订单号，请您汇款后将汇款凭证（注明订单号）传真至010-59222799，或扫描以附件形式发邮件至chuxushukuan@dangdang.com，以便我们核实您的款项。若没有接到您的汇款凭证，您的订单将无法处理。<br />\r\n（4）如果汇款一段时间之后，您的订单仍为&ldquo;等待付款&rdquo;状态，请进入&ldquo;汇款单招领&rdquo;查询，并尽快与我们联系。</p>', 1, 0, 0, 382, '2011-02-17 13:56:26', '2011-02-21 15:06:20', '', '', '', '', 1, 0, 14, '', '', 0, 4, '', 1),
(199, '银行转帐', '', '', '', '<p>1、国内顾客可以通过全国任何一家银行，向格力在线在光大银行、建设银行、农业银行、招商银行开立的账户汇款。</p>\r\n<p>2、到款时间一般为办理转帐手续之后的1-5个工作日内。</p>\r\n<p>3、银行转帐单的填写方法请参考下图：<br />\r\n<img alt="" src="/media/1/products/han007.JPG" /></p>\r\n<p>温馨提示：<br />\r\n（1）除招商银行接受外币汇款之外，其余银行均无法接受外币汇款。<br />\r\n（2）办理银行转账时，请您务必在电汇单的用途栏内注明订单号和用户名（收货人的用户名）。</p>\r\n<p>&nbsp;</p>', 1, 0, 0, 382, '2011-02-17 13:56:36', '2011-02-21 15:02:31', '', '', '', '', 1, 0, 15, '', '', 0, 5, '', 1),
(200, '投诉及预约查询', '', '', '', '', 1, 0, 0, 383, '2011-02-17 13:57:37', '2011-02-21 15:55:33', '', '', '', '', 1, 0, 16, '', '', 0, 1, '', 1),
(201, '找回密码', '', '', '', '', 1, 0, 0, 384, '2011-02-17 13:58:04', '2011-02-17 13:58:04', '', '', '', '', 1, 0, 17, '', '', 0, 5, '', 1),
(202, '联系客服', '', '', '', '', 1, 0, 0, 384, '2011-02-17 13:58:12', '2011-02-17 13:58:12', '', '', '', '', 1, 0, 18, '', '', 0, 3, '', 1),
(203, '退订邮件/短信', '', '', '', '', 1, 0, 0, 384, '2011-02-17 13:58:24', '2011-02-17 13:58:24', '', '', '', '', 1, 0, 19, '', '', 0, 2, '', 1),
(204, '新版商城上线了！！', '', '', '', '<p>新版商城上线了！！</p>', 1, 0, 2, 408, '2011-02-17 15:11:26', '2011-06-02 15:21:41', NULL, '', '', '', 1, 0, 21, '', '', 0, 26, '', 1),
(205, '格力深圳三月活动进行中', '', '', '', '', 1, 0, 0, 408, '2011-03-04 14:37:59', '2011-03-04 14:37:59', '', '', '', '', 1, 0, 22, '', '', 0, 9, '', 1),
(206, '格力夏季推出最新节能空调！', '', '', '', '', 1, 0, 0, 408, '2011-03-04 14:38:28', '2011-03-04 14:38:28', '', '', '', '', 1, 0, 24, '', '', 0, 9, '', 1),
(207, '今夏您“扇”了吗？', '', '', '', '', 1, 0, 1, 408, '2011-03-04 14:39:17', '2011-06-02 15:25:06', NULL, '', '', '', 1, 0, 27, '', '', 0, 4, '', 1),
(208, '晒单：您的完美变频睡美人空调', '', '', '', '', 1, 0, 0, 408, '2011-03-04 14:40:21', '2011-03-04 14:40:21', '', '', '', '', 1, 0, 29, '', '', 0, 12, '', 1),
(209, '三月格力“团购”开团啦！', '', '', '', '', 1, 0, 0, 408, '2011-03-04 14:46:49', '2011-03-31 11:43:19', NULL, '', '', '', 1, 0, 31, '', '', 0, 8, '', 1),
(210, '团购超省又好用，准备抢抢抢！！', '', '', '', '', 1, 0, 0, 408, '2011-03-04 14:47:58', '2011-06-10 15:45:14', NULL, '', '', '', 1, 0, 32, '', '', 0, 14, '', 1),
(211, '新版商城上线了！！', '', '', '', '<p>新版商城上线了！！</p>', 1, 0, 0, 422, '2011-02-17 15:11:26', '2011-04-29 12:00:35', NULL, '', '', '', 1, 0, 20, '', '', 0, 26, '', 1),
(212, '格力深圳三月活动进行中', '', '', '', '', 1, 0, 0, 422, '2011-03-04 14:37:59', '2011-04-29 12:00:30', NULL, '', '', '', 1, 0, 23, '', '', 0, 10, '', 1),
(213, '格力夏季推出最新节能空调！', '', '', '', '', 1, 0, 0, 422, '2011-03-04 14:38:28', '2011-04-29 12:00:24', NULL, '', '', '', 1, 0, 25, '', '', 0, 8, '', 1),
(214, '今夏您“扇”了吗？', '', '', '', '', 1, 0, 0, 422, '2011-03-04 14:39:17', '2011-04-29 12:00:14', NULL, '', '', '', 1, 0, 26, '', '', 0, 5, '', 1),
(215, '晒单：您的完美变频睡美人空调', '', '', '', '', 1, 0, 0, 422, '2011-03-04 14:40:21', '2011-04-29 12:00:10', NULL, '', '', '', 1, 0, 28, '', '', 0, 15, '', 1),
(216, '三月格力“团购”开团啦！', '', '', '', '', 1, 0, 0, 422, '2011-03-04 14:46:49', '2011-04-29 12:00:03', NULL, '', '', '', 1, 0, 30, '', '', 0, 10, '', 1),
(217, ' 团购超省又好用，准备抢抢抢！', '', '', '', '', 1, 0, 0, 422, '2011-03-04 14:47:58', '2011-04-29 11:59:58', NULL, '', '', '', 1, 0, 33, '', '', 0, 13, '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_coupons`
--

DROP TABLE IF EXISTS `w_coupons`;
CREATE TABLE IF NOT EXISTS `w_coupons` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `start_time` int(4) unsigned NOT NULL default '0',
  `end_time` int(4) unsigned NOT NULL default '0',
  `published` tinyint(1) unsigned NOT NULL default '0',
  `act_type` tinyint(2) unsigned NOT NULL default '0',
  `remark` varchar(255) default NULL,
  `params` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `w_coupons`
--

INSERT INTO `w_coupons` (`id`, `name`, `start_time`, `end_time`, `published`, `act_type`, `remark`, `params`) VALUES
(1, 'asdfasdf', 1302566400, 1302739200, 0, 1, 'asdf', 'a:5:{s:5:"money";s:2:"12";s:13:"products_name";s:9:"sadfasdf2";s:11:"products_id";s:1:"1";s:5:"thumb";s:23:"/media/1/1297835373.jpg";s:3:"lev";a:2:{i:0;s:1:"1";i:1;s:1:"2";}}'),
(3, '买满200即送电饭煲', 1307664000, 1308096000, 1, 1, '', 'a:5:{s:5:"money";s:3:"200";s:13:"products_name";s:44:"新建 格力电饭煲 GD-303A 新品上市 ";s:11:"products_id";s:2:"80";s:5:"thumb";s:32:"/media/1/products/1298428582.jpg";s:3:"lev";a:2:{i:0;s:1:"1";i:1;s:1:"2";}}');

-- --------------------------------------------------------

--
-- 表的结构 `w_delivery_items`
--

DROP TABLE IF EXISTS `w_delivery_items`;
CREATE TABLE IF NOT EXISTS `w_delivery_items` (
  `rec_id` mediumint(8) unsigned NOT NULL auto_increment,
  `delivery_id` mediumint(8) unsigned NOT NULL default '0',
  `product_id` mediumint(8) unsigned default '0',
  `product_sn` varchar(60) default NULL,
  `product_name` varchar(120) default NULL,
  `brand_name` varchar(60) default NULL,
  `is_real` tinyint(1) unsigned default '0',
  `extension_code` varchar(30) default NULL,
  `parent_id` mediumint(8) unsigned default '0',
  `send_number` smallint(5) unsigned default '0',
  `product_attr` text,
  PRIMARY KEY  (`rec_id`),
  KEY `delivery_id` (`delivery_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `w_delivery_items`
--

INSERT INTO `w_delivery_items` (`rec_id`, `delivery_id`, `product_id`, `product_sn`, `product_name`, `brand_name`, `is_real`, `extension_code`, `parent_id`, `send_number`, `product_attr`) VALUES
(8, 7, 29, NULL, '格力电风扇 KYTB-25 台式转页扇 日月造型 正品特价 ', NULL, 0, NULL, 0, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";s:5:"23.00";s:12:"actual_price";s:5:"23.00";s:8:"act_type";i:2;}'),
(2, 2, 426, '', '格力电暖器 NSW-8  二管 石英管 取暖器', '', 0, '', 0, 1, 'a:4:{s:6:"params";b:0;s:4:"pays";s:1:"1";s:5:"price";s:3:"100";s:12:"actual_price";N;}'),
(9, 8, 11, NULL, '格力电饭煲 GD-3016 饭粥两用全国正品 新一代节能产品', NULL, 0, NULL, 0, 3, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";s:6:"523.00";s:12:"actual_price";s:6:"523.00";s:8:"act_type";i:0;}'),
(10, 9, 80, NULL, '新建 格力电饭煲 GD-303A 新品上市 ', NULL, 0, NULL, 0, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";N;s:12:"actual_price";N;s:8:"act_type";i:0;}'),
(11, 10, 80, NULL, '新建 格力电饭煲 GD-303A 新品上市 ', NULL, 0, NULL, 0, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";N;s:12:"actual_price";N;s:8:"act_type";i:0;}'),
(13, 12, 25, NULL, '格力电风扇FSJ-1802 迷你 学生扇 摇头台夹两用扇 ', NULL, 0, NULL, 0, 1, 'a:5:{s:6:"params";s:12:"限时促销";s:4:"pays";i:2;s:5:"price";s:5:"30.00";s:12:"actual_price";s:5:"30.00";s:8:"act_type";i:2;}'),
(17, 16, 25, NULL, '格力电风扇FSJ-1802 迷你 学生扇 摇头台夹两用扇 ', NULL, 0, NULL, 0, 1, 'a:5:{s:6:"params";s:12:"限时促销";s:4:"pays";i:2;s:5:"price";s:5:"30.00";s:12:"actual_price";s:5:"30.00";s:8:"act_type";i:2;}'),
(18, 17, 49, NULL, '格力电水壶 GK-CS1512DA 不锈钢 磨砂表面 ', NULL, 0, NULL, 0, 1, 'a:5:{s:6:"params";s:6:"团购";s:4:"pays";i:2;s:5:"price";s:5:"90.00";s:12:"actual_price";s:5:"90.00";s:8:"act_type";i:1;}'),
(19, 18, 49, NULL, '格力电水壶 GK-CS1512DA 不锈钢 磨砂表面 ', NULL, 0, NULL, 0, 1, 'a:5:{s:6:"params";s:6:"团购";s:4:"pays";i:2;s:5:"price";s:5:"90.00";s:12:"actual_price";s:5:"90.00";s:8:"act_type";i:1;}');

-- --------------------------------------------------------

--
-- 表的结构 `w_delivery_order`
--

DROP TABLE IF EXISTS `w_delivery_order`;
CREATE TABLE IF NOT EXISTS `w_delivery_order` (
  `delivery_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '发货单ID',
  `delivery_sn` varchar(20) NOT NULL COMMENT '发货单号',
  `order_sn` varchar(20) NOT NULL COMMENT '订单号',
  `order_id` mediumint(8) unsigned NOT NULL default '0' COMMENT '订单ID',
  `type` enum('back','delivery') NOT NULL default 'delivery',
  `invoice_no` varchar(50) default NULL COMMENT '发票号',
  `add_time` int(10) unsigned default '0' COMMENT '添加时间',
  `shipping_id` tinyint(3) unsigned default '0' COMMENT '物流公司ID',
  `shipping_name` varchar(120) default NULL COMMENT '物流公司名称',
  `shipping_sn` varchar(20) default NULL COMMENT '货运单号',
  `uid` mediumint(8) unsigned default '0' COMMENT '会员ID',
  `mid` mediumint(8) NOT NULL default '0',
  `action_user` varchar(30) default NULL COMMENT '发货人',
  `consignee` varchar(60) default NULL COMMENT '收货人',
  `address` varchar(250) default NULL COMMENT '收货地址',
  `country` smallint(5) unsigned default '0' COMMENT '国家',
  `province` smallint(5) unsigned default '0' COMMENT '省',
  `city` smallint(5) unsigned default '0' COMMENT '市',
  `district` smallint(5) unsigned default '0' COMMENT '区',
  `email` varchar(60) default NULL COMMENT 'email',
  `zipcode` varchar(60) default NULL COMMENT '邮编',
  `tel` varchar(60) default NULL COMMENT '电话',
  `mobile` varchar(60) default NULL COMMENT '手机',
  `best_time` varchar(120) default NULL COMMENT '在家收货时间',
  `postscript` varchar(255) default NULL COMMENT '描述',
  `how_oos` varchar(120) default NULL,
  `insure` tinyint(1) NOT NULL default '0' COMMENT '是否投保',
  `insure_fee` decimal(10,2) unsigned default '0.00' COMMENT '投保费用',
  `shipping_fee` decimal(10,2) unsigned default '0.00' COMMENT '货运费用',
  `update_time` int(10) unsigned default '0' COMMENT '更新时间',
  `suppliers_id` smallint(5) default '0' COMMENT '提供商ID',
  `status` tinyint(1) unsigned NOT NULL default '0' COMMENT '状态',
  `agency_id` smallint(5) unsigned default '0',
  `reason` varchar(255) default NULL,
  PRIMARY KEY  (`delivery_id`),
  KEY `user_id` (`uid`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `w_delivery_order`
--

INSERT INTO `w_delivery_order` (`delivery_id`, `delivery_sn`, `order_sn`, `order_id`, `type`, `invoice_no`, `add_time`, `shipping_id`, `shipping_name`, `shipping_sn`, `uid`, `mid`, `action_user`, `consignee`, `address`, `country`, `province`, `city`, `district`, `email`, `zipcode`, `tel`, `mobile`, `best_time`, `postscript`, `how_oos`, `insure`, `insure_fee`, `shipping_fee`, `update_time`, `suppliers_id`, `status`, `agency_id`, `reason`) VALUES
(7, '', '20110509174051', 35, 'delivery', NULL, 1306919901, NULL, '无', '', 1, 0, 'china', 'asfd', 'asfdasfdasfd', 0, 148, 149, 0, 'whl308221710@163.com', 'asfd', '', 'asfd', NULL, '', '', 0, '0.00', '20.00', 1306919901, NULL, 0, 0, NULL),
(8, '', '20110503113119', 33, 'delivery', NULL, 1306920114, NULL, '无', '', 1, 0, 'china', 'asfd', 'asfdasfdasfd', 0, 148, 149, 0, 'whl308221710@163.com', 'asfd', '', 'asfd', NULL, '', '', 0, '0.00', '20.00', 1306920114, NULL, 0, 0, NULL),
(9, '', '20110610091703', 66, 'delivery', NULL, 1307671309, NULL, '无', '', 1, 0, 'luoqin', '', '', 0, 0, 0, 0, 'luoqin2007@163.com', '', '', '', NULL, '', '', 0, '0.00', '20.00', 1307671309, NULL, 0, 0, NULL),
(12, '', '20110526092158', 57, 'delivery', NULL, 1307673464, NULL, '无', '', 1, 0, 'china', 'asfd', 'asfdasfdasfd', 0, 148, 149, 0, 'whl308221710@163.com', 'asfd', '', 'asfd', NULL, '', '', 0, '0.00', '20.00', 1307673464, NULL, 0, 0, NULL),
(16, '', '20110526092158', 57, 'back', NULL, 1307676594, NULL, '顺丰速运', '', 1, 0, 'china', 'asfd', 'asfdasfdasfd', 0, 148, 149, 0, 'whl308221710@163.com', 'asfd', '', 'asfd', NULL, '', '', 0, '0.00', '20.00', 1307676594, NULL, 0, 0, ''),
(17, '', '20110608103930', 60, 'delivery', NULL, 1307676613, NULL, '无', '', 1, 0, 'luoqin', '', '', 0, 0, 0, 0, 'luoqin2007@163.com', '', '', '', NULL, '', '', 0, '0.00', '20.00', 1307676613, NULL, 0, 0, NULL),
(18, '', '20110608103930', 60, 'back', NULL, 1307676616, NULL, '顺丰速运', '', 1, 0, 'luoqin', '', '', 0, 0, 0, 0, 'luoqin2007@163.com', '', '', '', NULL, '', '', 0, '0.00', '20.00', 1307676616, NULL, 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `w_elite_re`
--

DROP TABLE IF EXISTS `w_elite_re`;
CREATE TABLE IF NOT EXISTS `w_elite_re` (
  `products_id` mediumint(8) unsigned NOT NULL default '0',
  `elite_id` tinyint(4) unsigned NOT NULL default '0',
  `ordering` tinyint(4) unsigned NOT NULL default '0',
  UNIQUE KEY `products_id` (`products_id`,`elite_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_elite_re`
--

INSERT INTO `w_elite_re` (`products_id`, `elite_id`, `ordering`) VALUES
(29, 2, 50),
(52, 3, 50),
(54, 3, 50),
(55, 3, 50),
(30, 2, 50),
(64, 3, 50),
(69, 3, 50),
(70, 3, 50),
(71, 3, 50),
(31, 2, 50),
(18, 2, 50),
(19, 2, 50),
(20, 2, 50),
(21, 2, 50),
(22, 2, 50),
(53, 2, 50),
(54, 2, 50),
(39, 2, 50),
(40, 2, 50),
(73, 3, 50),
(80, 3, 50),
(41, 2, 50),
(81, 3, 50),
(49, 2, 50),
(36, 2, 50),
(81, 2, 50),
(8, 2, 50),
(80, 2, 50),
(67, 2, 50),
(28, 2, 50),
(27, 2, 50),
(62, 2, 50),
(61, 2, 50),
(60, 2, 50),
(59, 2, 50),
(58, 2, 50),
(57, 2, 50),
(38, 2, 50),
(37, 2, 50),
(61, 3, 50),
(62, 3, 50),
(70, 2, 50),
(69, 2, 50),
(56, 2, 50),
(55, 2, 50),
(52, 2, 50),
(51, 2, 50),
(26, 2, 50),
(25, 2, 50),
(24, 2, 50),
(23, 2, 50),
(14, 2, 50),
(13, 2, 50),
(12, 2, 50),
(11, 2, 50),
(10, 2, 50),
(9, 2, 50),
(35, 2, 50),
(34, 2, 50),
(33, 2, 50),
(50, 2, 50),
(48, 2, 50),
(47, 2, 50),
(46, 2, 50),
(45, 2, 50),
(44, 2, 50),
(43, 2, 50),
(42, 2, 50),
(32, 2, 50),
(2, 2, 50),
(1, 2, 50),
(57, 3, 50),
(58, 3, 50),
(59, 3, 50),
(60, 3, 50),
(57, 1, 50),
(58, 1, 50),
(59, 1, 50),
(60, 1, 50),
(61, 1, 50),
(62, 1, 50);

-- --------------------------------------------------------

--
-- 表的结构 `w_evaluation`
--

DROP TABLE IF EXISTS `w_evaluation`;
CREATE TABLE IF NOT EXISTS `w_evaluation` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `uname` varchar(20) NOT NULL,
  `product_id` varchar(11) NOT NULL default '0',
  `star` tinyint(2) NOT NULL default '0',
  `created` datetime NOT NULL,
  `contents` varchar(255) NOT NULL,
  `useful` mediumint(4) unsigned NOT NULL default '0',
  `useless` mediumint(4) unsigned NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0' COMMENT '是否锁定',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `w_evaluation`
--

INSERT INTO `w_evaluation` (`id`, `uid`, `uname`, `product_id`, `star`, `created`, `contents`, `useful`, `useless`, `published`) VALUES
(8, 109, 'testtest2', '65', 3, '2011-05-11 17:17:41', '很不错，下次再来！', 0, 0, 0),
(7, 109, 'testtest2', '25', 3, '2011-04-29 14:34:22', '很赞，是正品行货~', 0, 0, 1),
(12, 123, 'luoqin', '49', 2, '2011-06-08 11:02:35', '订单', 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_feedbacks`
--

DROP TABLE IF EXISTS `w_feedbacks`;
CREATE TABLE IF NOT EXISTS `w_feedbacks` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `username` varchar(20) default NULL,
  `uid` int(11) NOT NULL default '0',
  `mid` int(11) NOT NULL default '0',
  `author` varchar(20) default NULL,
  `release_date` date NOT NULL,
  `company` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `mobile` varchar(15) default NULL,
  `email` varchar(50) default NULL,
  `address` varchar(200) NOT NULL,
  `reply_content` text,
  `reply_date` date default NULL,
  `reply_author` varchar(20) default NULL,
  `published` int(1) NOT NULL default '0',
  `type` tinyint(2) default NULL,
  `order_sn` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `w_feedbacks`
--

INSERT INTO `w_feedbacks` (`id`, `title`, `content`, `username`, `uid`, `mid`, `author`, `release_date`, `company`, `phone`, `mobile`, `email`, `address`, `reply_content`, `reply_date`, `reply_author`, `published`, `type`, `order_sn`) VALUES
(9, 'asdfasf', 'asfdasfd', 'asdfasdf', 89, 1, '', '2011-02-22', '', '', '', '', '', 'sadf', '0000-00-00', NULL, 0, 1, ''),
(10, '王柳', 'adfadf', 'afadf', 89, 1, '王珊珊', '2011-02-24', '', '', '', '', '', 'asdf', '0000-00-00', NULL, 0, 1, ''),
(11, '123', '你叫什么名字', NULL, 0, 0, '2222', '0000-00-00', '', '', NULL, '', '', '我的名字叫lgeiga', '0000-00-00', NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `w_group`
--

DROP TABLE IF EXISTS `w_group`;
CREATE TABLE IF NOT EXISTS `w_group` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) default '',
  `lft` int(10) unsigned NOT NULL default '0',
  `rgt` int(10) unsigned NOT NULL default '0',
  `parent_id` int(11) NOT NULL default '0',
  `params` text,
  `published` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `w_group`
--

INSERT INTO `w_group` (`id`, `name`, `lft`, `rgt`, `parent_id`, `params`, `published`) VALUES
(22, '系统管理员', 1, 4, 0, '', 1),
(21, '管理员', 2, 3, 22, '', 1),
(17, '经销商', 5, 8, 0, '', 1),
(16, '经销商管理员', 6, 7, 17, '', 1),
(15, '五星级会员', 9, 18, 0, '', 1),
(14, '四星级', 10, 17, 15, '', 1),
(13, '三星级', 11, 16, 14, '', 1),
(12, '二星级', 12, 15, 13, '', 1),
(11, '一星级', 13, 14, 12, '', 1),
(1, '注册会员', 19, 20, 0, '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_languages`
--

DROP TABLE IF EXISTS `w_languages`;
CREATE TABLE IF NOT EXISTS `w_languages` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `params` text,
  `ordering` tinyint(4) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  `isdefault` tinyint(1) NOT NULL default '0',
  `uid` int(11) NOT NULL default '0',
  `img` varchar(255) NOT NULL default '',
  `mark` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `w_languages`
--

INSERT INTO `w_languages` (`id`, `name`, `params`, `ordering`, `published`, `isdefault`, `uid`, `img`, `mark`) VALUES
(1, '字段名称', 'a:20:{i:0;s:4:"home";i:1;s:3:"adf";i:2;s:8:"w_halsfd";i:3;s:3:"adf";i:4;s:3:"adf";i:5;s:3:"adf";i:6;s:3:"adf";i:7;s:3:"adf";i:8;s:3:"adf";i:9;s:3:"adf";i:10;s:3:"adf";i:11;s:3:"adf";i:12;s:3:"adf";i:13;s:3:"adf";i:14;s:3:"adf";i:15;s:3:"adf";i:16;s:3:"adf";i:17;s:3:"adf";i:18;s:3:"adf";i:19;s:3:"adf";}', 1, 1, 0, 1, '', ''),
(2, '中文版', 'a:20:{i:0;s:6:"首页";i:1;s:4:"asfd";i:2;s:1:"c";i:3;s:4:"asfd";i:4;s:4:"asfd";i:5;s:4:"asfd";i:6;s:4:"asfd";i:7;s:4:"asfd";i:8;s:0:"";i:9;s:4:"asfd";i:10;s:4:"asfd";i:11;s:4:"asfd";i:12;s:4:"asfd";i:13;s:4:"asfd";i:14;s:4:"asfd";i:15;s:4:"asfd";i:16;s:4:"asfd";i:17;s:4:"asfd";i:18;s:4:"asfd";i:19;s:0:"";}', 2, 1, 1, 1, '/media/1/icon.gif', 'cn'),
(4, '韩语版', 'a:20:{i:0;s:6:"首页";i:1;s:4:"asfd";i:2;s:1:"d";i:3;s:4:"asfd";i:4;s:4:"asfd";i:5;s:4:"asfd";i:6;s:4:"asfd";i:7;s:4:"asfd";i:8;s:0:"";i:9;s:4:"asfd";i:10;s:4:"asfd";i:11;s:4:"asfd";i:12;s:4:"asfd";i:13;s:4:"asfd";i:14;s:4:"asfd";i:15;s:4:"asfd";i:16;s:4:"asfd";i:17;s:4:"asfd";i:18;s:4:"asfd";i:19;s:0:"";}', 4, 0, 0, 1, '/media/1/kr.jpg', 'kr'),
(5, '日语版', 'a:20:{i:0;s:6:"首页";i:1;s:8:"asfdasfd";i:2;s:1:"e";i:3;s:8:"asfdasfd";i:4;s:8:"asfdasfd";i:5;s:8:"asfdasfd";i:6;s:8:"asfdasfd";i:7;s:8:"asfdasfd";i:8;s:8:"asfdasfd";i:9;s:8:"asfdasfd";i:10;s:8:"asfdasfd";i:11;s:8:"asfdasfd";i:12;s:8:"asfdasfd";i:13;s:8:"asfdasfd";i:14;s:8:"asfdasfd";i:15;s:8:"asfdasfd";i:16;s:8:"asfdasfd";i:17;s:8:"asfdasfd";i:18;s:8:"asfdasfd";i:19;s:8:"asfdasfd";}', 5, 0, 0, 1, '', ''),
(3, 'English', 'a:20:{i:0;s:4:"Home";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;s:0:"";i:8;s:0:"";i:9;s:0:"";i:10;s:0:"";i:11;s:0:"";i:12;s:0:"";i:13;s:0:"";i:14;s:0:"";i:15;s:0:"";i:16;s:0:"";i:17;s:0:"";i:18;s:0:"";i:19;s:0:"";}', 3, 0, 0, 1, '/media/1/icon_en.gif', 'en');

-- --------------------------------------------------------

--
-- 表的结构 `w_latest`
--

DROP TABLE IF EXISTS `w_latest`;
CREATE TABLE IF NOT EXISTS `w_latest` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) default NULL COMMENT '会员名',
  `photo` varchar(100) default NULL COMMENT '头象',
  `uid` int(11) NOT NULL default '0' COMMENT '会员ID',
  `http_name` varchar(50) default NULL COMMENT '网址名称',
  `http` varchar(255) default NULL COMMENT '网址',
  `adddate` datetime default NULL COMMENT '时间',
  `action` tinyint(2) NOT NULL default '0' COMMENT '添加或者是修改',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=141 ;

--
-- 转存表中的数据 `w_latest`
--

INSERT INTO `w_latest` (`id`, `username`, `photo`, `uid`, `http_name`, `http`, `adddate`, `action`) VALUES
(140, 'china', '/member/media/photo/kt2.jpg', 1, '新站2', 'http://www.ppczy.cn/', '2010-11-19 20:07:21', 2),
(135, 'testtest4', '/member/media/photo/kt1.jpg', 110, '天涯', 'http://www.tianya.cn', '2010-11-17 16:45:07', 2),
(136, 'testtest', '/member/media/photo/kt28.jpg', 89, '酷看影院', 'http://www.cc161.com/', '2010-11-17 20:45:08', 2),
(137, 'testtest', '/member/media/photo/kt28.jpg', 89, '乐缘高清影院', 'http://www.im163.net/', '2010-11-17 20:48:08', 2),
(138, 'testtest', '/member/media/photo/kt28.jpg', 89, '124', 'http://2124', '2010-11-17 20:52:55', 1),
(139, 'china', '/member/media/photo/kt2.jpg', 1, 'testtest', 'http://test', '2010-11-19 20:07:14', 2);

-- --------------------------------------------------------

--
-- 表的结构 `w_level`
--

DROP TABLE IF EXISTS `w_level`;
CREATE TABLE IF NOT EXISTS `w_level` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(60) NOT NULL,
  `discount` tinyint(4) unsigned NOT NULL default '0',
  `point` mediumint(4) unsigned NOT NULL default '0',
  `defaulted` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `published` (`defaulted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `w_level`
--

INSERT INTO `w_level` (`id`, `name`, `discount`, `point`, `defaulted`) VALUES
(1, '普通会员', 0, 0, 0),
(2, '高级会员', 1, 1000000, 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_links`
--

DROP TABLE IF EXISTS `w_links`;
CREATE TABLE IF NOT EXISTS `w_links` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(200) NOT NULL COMMENT '链接名称',
  `img` varchar(200) NOT NULL COMMENT '图片路径',
  `url` varchar(200) NOT NULL COMMENT '网址',
  `params` text NOT NULL COMMENT '参数',
  `description` text NOT NULL COMMENT '链接简介',
  `hot` tinyint(4) NOT NULL COMMENT '推荐（1推荐，0不推荐）',
  `published` tinyint(4) NOT NULL COMMENT '是否发布（1发布，0不发布）',
  `ordering` int(11) NOT NULL,
  `type_id` int(11) NOT NULL COMMENT '链接分类ID',
  `uid` int(11) NOT NULL COMMENT '所属用户ID',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `w_links`
--

INSERT INTO `w_links` (`id`, `name`, `img`, `url`, `params`, `description`, `hot`, `published`, `ordering`, `type_id`, `uid`) VALUES
(1, '', '', '', '', '', 0, 1, 1, 3, 1),
(2, '格力小家电', '', '', '', '', 0, 1, 2, 3, 1),
(3, '', '', '', '', '', 0, 1, 3, 3, 1),
(4, '', '', '', '', '', 0, 1, 4, 4, 1),
(8, '', '', '', '', '', 0, 0, 5, 3, 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_link_types`
--

DROP TABLE IF EXISTS `w_link_types`;
CREATE TABLE IF NOT EXISTS `w_link_types` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT '分类名称',
  `parent_id` int(11) NOT NULL COMMENT '父分类ID',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `published` tinyint(4) NOT NULL COMMENT '是否发布（1发布，0不发布）',
  `params` text NOT NULL COMMENT '分类参数',
  `ordering` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `w_link_types`
--

INSERT INTO `w_link_types` (`id`, `name`, `parent_id`, `uid`, `published`, `params`, `ordering`) VALUES
(4, '格力在线', 0, 1, 1, '', 2),
(3, '格力在线', 0, 1, 1, '', 1),
(11, '百度', 0, 1, 1, '', 3),
(12, '百度', 0, 1, 1, '', 4);

-- --------------------------------------------------------

--
-- 表的结构 `w_menu`
--

DROP TABLE IF EXISTS `w_menu`;
CREATE TABLE IF NOT EXISTS `w_menu` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `component` varchar(50) NOT NULL default '',
  `name` varchar(50) default '',
  `icon` varchar(255) default NULL COMMENT '菜单图标',
  `alias` varchar(50) NOT NULL default '',
  `link` varchar(255) NOT NULL default '',
  `type` varchar(50) NOT NULL default '',
  `lft` int(10) unsigned NOT NULL default '0',
  `rgt` int(10) unsigned NOT NULL default '0',
  `parent_id` int(11) NOT NULL default '0',
  `tid` int(11) NOT NULL default '0',
  `uid` int(11) NOT NULL default '0',
  `params` text,
  `view_path` varchar(255) default NULL,
  `published` tinyint(1) NOT NULL default '0',
  `home` tinyint(1) NOT NULL default '0',
  `metakey` varchar(255) default NULL,
  `metadesc` varchar(255) default NULL,
  `elite` tinyint(1) NOT NULL default '0',
  `iscontent` tinyint(2) NOT NULL default '0' COMMENT '该菜单是否有内容',
  PRIMARY KEY  (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `tid` (`tid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=438 ;

--
-- 转存表中的数据 `w_menu`
--

INSERT INTO `w_menu` (`id`, `component`, `name`, `icon`, `alias`, `link`, `type`, `lft`, `rgt`, `parent_id`, `tid`, `uid`, `params`, `view_path`, `published`, `home`, `metakey`, `metadesc`, `elite`, `iscontent`) VALUES
(354, 'products', '限时抢购', '/media/1/aboutus.jpg', 'limitedtime', 'index.php?com=products&view=limitedtime&id=354', 'component', 4, 5, 15, 1, 1, 'orderby_sec=\n\n', '商品 > 限时抢购 > 限时抢购列表样式', 1, 0, '产品页面关键词', '产品页面描述', 0, 0),
(7, 'products', '特价产品', '', 'specials', 'index.php?com=products&view=special&id=7', 'component', 9, 10, 0, 1, 1, 'orderby_sec=\n\n', '产品 > 特价产品 > 默认的列表样式', 1, 0, 'asdf', '', 0, 0),
(15, 'pages', '首 页', '', 'home', 'index.php?com=pages&view=homepage&id=15', 'component', 1, 6, 0, 1, 1, 'image=/media/1/logodd.jpg\nid=0\n\n', '单页信息 > 网站首页 > 显示首页模块信息', 1, 1, '', '', 0, 0),
(408, 'contents', '导购资讯', '/media/1/contact.jpg', 'daogouzixun', 'index.php?com=contents&view=category&id=408', 'component', 14, 15, 407, 1, 1, 'setstyle=1\n\n', '文章 > 文章列表 > 默认的列表样式', 1, 0, '', '', 1, 0),
(407, 'pages', '知识堂', '/media/1/contact.jpg', 'zhishitang', 'index.php?com=pages&view=services&id=407', 'component', 13, 22, 0, 1, 1, 'image=\nid=0\n\n', '单页信息 > 服务信息页 > 服务信息页', 1, 0, '', '', 0, 0),
(429, 'contents', '会员咨讯', '', 'huiyuanzixun', 'index.php?com=contents&view=category&id=429', 'component', 18, 19, 407, 1, 1, 'setstyle=2\n\n', '文章 > 文章列表 > 默认的列表样式', 1, 0, '', '', 1, 0),
(380, 'contents', '新手指南', '/media/1/contact.jpg', 'xinshouzhinan', 'index.php?com=contents&view=category&id=380', 'component', 1, 2, 0, 10, 1, 'setstyle=0\n\n', '文章 > 文章列表 > 默认的列表样式', 1, 0, '', '', 1, 0),
(369, 'tuans', '团购', '/media/1/contact2.jpg', 'groupbuy', 'index.php?com=tuans&view=category&id=369', 'component', 11, 12, 0, 1, 1, 'show_headings=1\nshow_date=0\ndate_format=\nfilter=1\nfilter_type=title\n\n', '团购管理 > 团购信息列表 > 默认的列表样式', 1, 0, '', '', 0, 0),
(381, 'contents', '配送方式', '/media/1/t2.jpg', 'peisongfangshi', 'index.php?com=contents&view=category&id=381', 'component', 3, 4, 0, 10, 1, 'show_title=1\nshow_closebtn=1\nshow_hits=1\n\n', '文章 > 文章列表 > 默认的列表样式', 1, 0, '', '', 0, 0),
(382, 'contents', '支付方式', '/media/1/t3.jpg', 'zhifufangshi', 'index.php?com=contents&view=category&id=382', 'component', 5, 6, 0, 10, 1, 'show_title=1\nshow_closebtn=1\nshow_hits=1\n\n', '文章 > 文章列表 > 默认的列表样式', 1, 0, '', '', 0, 0),
(383, 'contents', '售后服务', '/media/1/t4.jpg', 'shouhoufuwu', 'index.php?com=contents&view=category&id=383', 'component', 7, 8, 0, 10, 1, 'show_title=1\nshow_closebtn=1\nshow_hits=1\n\n', '文章 > 文章列表 > 默认的列表样式', 1, 0, '', '', 0, 0),
(384, 'contents', '帮助中心', '/media/1/t5.jpg', 'bangzhuzhongxin', 'index.php?com=contents&view=category&id=384', 'component', 9, 10, 0, 10, 1, 'show_title=1\nshow_closebtn=1\nshow_hits=1\n\n', '文章 > 文章列表 > 默认的列表样式', 1, 0, '', '', 0, 0),
(419, 'pages', '格力简介', '', '20101202083111', 'index.php?com=pages&view=page&id=419', 'component', 1, 2, 0, 11, 1, 'image=\nid=0\n\n', '单页信息 > 单页内容 > 显示内容展示', 1, 0, '', '', 0, 0),
(420, 'pages', '关于我们', '', '20101202083121', 'index.php?com=pages&view=page&id=420', 'component', 3, 4, 0, 11, 1, 'image=\nid=0\n\n', '单页信息 > 单页内容 > 显示内容展示', 1, 0, '', '', 0, 0),
(418, 'products', '新品上架', '', 'new-products', 'index.php?com=products&view=latest&id=418', 'component', 7, 8, 0, 1, 1, 'orderby_sec=\n\n', '产品 > 最新产品 > 默认的列表样式', 1, 0, '', '', 0, 0),
(422, 'contents', '最新公告', '', 'zuixingonggao', 'index.php?com=contents&view=category&id=422', 'component', 16, 17, 407, 1, 1, 'setstyle=1\n\n', '文章 > 文章列表 > 默认的列表样式', 1, 0, '', '', 1, 0),
(423, 'pages', '服务网点', '', 'fuwuwangdian', 'index.php?com=pages&view=page&id=423', 'component', 5, 6, 0, 11, 1, 'image=\nid=0\n\n', '单页信息 > 单页内容 > 显示内容展示', 1, 0, '', '', 0, 0),
(424, 'pages', '网站地图', '', 'wangzhanditu', 'index.php?com=pages&view=page&id=424', 'component', 7, 8, 0, 11, 1, 'image=\nid=0\n\n', '单页信息 > 单页内容 > 显示内容展示', 1, 0, '', '', 0, 0),
(425, 'pages', '最新通告', '', 'zuixintonggao', 'index.php?com=pages&view=page&id=425', 'component', 9, 10, 0, 11, 1, 'image=\nid=0\n\n', '单页信息 > 单页内容 > 显示内容展示', 1, 0, '', '', 0, 0),
(426, 'pages', '格力团购', '', '20110222133926', 'index.php?com=pages&view=page&id=426', 'component', 11, 12, 0, 11, 1, 'image=\nid=0\n\n', '单页信息 > 单页内容 > 显示内容展示', 1, 0, '', '', 0, 0),
(427, '', '在线咨询', '', '20110222133939', '/maintenance.html?a=cons', 'url', 13, 14, 0, 11, 1, '', '外部链接', 1, 0, '', '', 0, 0),
(428, 'pages', '联系我们', '', '20110222133951', 'index.php?com=pages&view=page&id=428', 'component', 15, 16, 0, 11, 1, 'image=\nid=0\n\n', '单页信息 > 单页内容 > 显示内容展示', 1, 0, '', '', 0, 0),
(430, 'contents', '会员评价', '', 'huiyuanpingjia', 'index.php?com=contents&view=category&id=430', 'component', 20, 21, 407, 1, 1, 'setstyle=3\n\n', '文章 > 文章列表 > 默认的列表样式', 1, 0, '', '', 0, 0),
(431, 'products', '秒杀专区', '', 'seckill', 'index.php?com=products&view=seckill&id=431', 'component', 2, 3, 15, 1, 1, 'orderby_sec=\n\n', '商品 > 秒杀信息 > 秒杀信息样式', 1, 0, '', '', 0, 0),
(432, '', '首页2', '', '20110602170852', 'index.php?itemid=15', 'menulink', 1, 2, 0, 14, 1, 'menu_item=15\n\n', '菜单别名', 1, 0, '', '', 0, 0),
(433, '', '123', '', '20110602171428', 'index.php?itemid=15', 'menulink', 3, 4, 0, 14, 1, 'menu_item=15\n\n', '菜单别名', 1, 0, '', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `w_menu_types`
--

DROP TABLE IF EXISTS `w_menu_types`;
CREATE TABLE IF NOT EXISTS `w_menu_types` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `menutype` varchar(75) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `ordering` tinyint(4) NOT NULL default '0',
  `uid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `w_menu_types`
--

INSERT INTO `w_menu_types` (`id`, `menutype`, `title`, `description`, `ordering`, `uid`) VALUES
(1, '', '网站导航', '顶部菜单', 1, 1),
(10, '', '帮助中心', '', 2, 1),
(11, '', '服务与支持', '', 3, 1),
(14, '', '网站导航2', '', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_message`
--

DROP TABLE IF EXISTS `w_message`;
CREATE TABLE IF NOT EXISTS `w_message` (
  `id` int(11) NOT NULL auto_increment,
  `to_id` int(11) NOT NULL default '0' COMMENT '接收用户ID',
  `from_id` int(11) NOT NULL default '0' COMMENT '发送用户ID',
  `contents` varchar(255) default NULL COMMENT '内容',
  `createdate` datetime default NULL COMMENT '添加时间',
  `isview` tinyint(2) NOT NULL default '0' COMMENT '是否查已查看',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `w_message`
--

INSERT INTO `w_message` (`id`, `to_id`, `from_id`, `contents`, `createdate`, `isview`) VALUES
(1, 1, 89, 'asdf', '0000-00-00 00:00:00', 1),
(2, 1, 89, 'sadf', '0000-00-00 00:00:00', 1),
(3, 89, 89, 'asdf', '0000-00-00 00:00:00', 1),
(4, 89, 89, 'asfd', '2010-11-15 15:29:01', 1),
(5, 1, 1, 'asdf', '2010-11-15 15:49:54', 1),
(6, 1, 1, 'asdf', '2010-11-15 15:52:51', 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_modules`
--

DROP TABLE IF EXISTS `w_modules`;
CREATE TABLE IF NOT EXISTS `w_modules` (
  `id` int(11) NOT NULL auto_increment COMMENT '主键',
  `title` text NOT NULL COMMENT '模块名称',
  `content` text NOT NULL COMMENT '内容(自定义模块)',
  `ordering` int(11) NOT NULL default '0' COMMENT '排序',
  `position` varchar(50) default NULL COMMENT '位置',
  `published` tinyint(1) NOT NULL default '0' COMMENT '是否发布',
  `module` varchar(50) default NULL COMMENT '模块目录名称',
  `numnews` int(11) NOT NULL default '0',
  `showtitle` tinyint(3) unsigned NOT NULL default '1',
  `params` text NOT NULL,
  `iscore` tinyint(4) NOT NULL default '0' COMMENT '是否为核心',
  `client_id` tinyint(4) NOT NULL default '0' COMMENT '应用ID,前台为1,后台为2',
  `control` text NOT NULL,
  `uid` int(11) NOT NULL default '0',
  `cust` tinyint(1) NOT NULL default '0' COMMENT '是否为自定义的内容',
  `cache_way` tinyint(2) NOT NULL default '0' COMMENT '缓存方式',
  `cid` mediumint(4) NOT NULL default '0' COMMENT '组件ID',
  PRIMARY KEY  (`id`),
  KEY `published` (`published`),
  KEY `newsfeeds` (`module`,`published`),
  KEY `position` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=617 ;

--
-- 转存表中的数据 `w_modules`
--

INSERT INTO `w_modules` (`id`, `title`, `content`, `ordering`, `position`, `published`, `module`, `numnews`, `showtitle`, `params`, `iscore`, `client_id`, `control`, `uid`, `cust`, `cache_way`, `cid`) VALUES
(12, '后台导航菜单', '', 4, 'menu', 1, 'mod_menu', 0, 1, 'menu_style=custom\nstartLevel=33\nendLevel=23\nshowAllChildren=1\nwindow_open=2好样的\n\n', 0, 1, '', 1, 0, 0, 0),
(13, '控制面板快捷菜单', '', 1, 'cleft', 1, 'mod_shortcutmenu', 0, 1, 'menu_style=custom\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=好样的\n\n', 0, 1, '', 1, 0, 0, 0),
(14, '快捷按钮', '', 1, 'status', 1, 'mod_status', 0, 1, 'menu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\n\n', 0, 1, '', 1, 0, 0, 0),
(195, '主菜单', '', 2, 'navigation', 1, 'mod_menu', 0, 1, 'menutype=1\nmenu_style=list\ndelkey=\nmoduleclass_sfx=\n\n', 0, 0, '', 1, 0, 0, 0),
(206, '版权信息', '<p>@2007-2010 GREE CORPORATION. ALL RIGHTS RESERVED. 格力集团股份有限公司版权所有 粤ICP备0568987-2号</p>', 6, 'footer', 1, 'mod_copyright', 0, 1, 'num_products=8\nshow_whitespace=0\ncache=1\n\n', 0, 0, '', 1, 1, 0, 0),
(593, '首页产品分类', '', 1, 'navigation', 1, 'mod_categorys', 0, 1, 'moduleclass_sfx=\n\n', 0, 0, '', 1, 0, 0, 0),
(580, '搜索框', '', 3, 'navigation', 0, 'mod_search', 0, 1, '', 0, 0, '', 1, 0, 0, 0),
(582, '顶部工具条内容', '', 2, 'top', 1, 'mod_topbar', 0, 1, '', 0, 0, '', 1, 0, 0, 0),
(583, '产品分类', '', 4, 'left', 0, 'mod_categorys', 0, 1, 'moduleclass_sfx=\n\n', 0, 0, '', 1, 0, 0, 0),
(584, '浏览历史记录', '', 5, 'left', 1, 'mod_history', 0, 1, 'moduleclass_sfx=mg-tmenu\n\n', 0, 0, '', 1, 0, 0, 0),
(585, '路径', '', 1, 'breadcrumbs', 1, 'mod_breadcrumbs', 0, 1, '', 0, 0, '', 1, 0, 0, 0),
(586, '会员菜单', '', 1, 'userleft', 1, 'mod_membermenu', 0, 1, '', 0, 0, '', 1, 0, 0, 0),
(587, '团购展示', '', 3, 'hcenter', 1, 'mod_buy', 0, 1, 'catid=0\n\n', 0, 0, '', 1, 0, 0, 0),
(207, 'LOGO', '', 4, 'header', 1, 'mod_logo', 0, 1, 'logo=/media/1/logo.gif\n\n', 0, 0, '', 1, 0, 0, 0),
(209, '显示会员信息', '', 3, 'left', 0, 'mod_user', 0, 1, 'num_products=8\nshow_whitespace=0\ncache=1\n\n', 0, 1, '', 1, 0, 0, 0),
(210, '管理底部信息', '', 2, 'footer', 1, 'mod_footer', 0, 1, 'num_products=8\nshow_whitespace=0\ncache=1\n\n', 0, 1, '', 1, 0, 0, 0),
(553, '版权信息', '', 4, 'footer', 1, 'mod_copyright', 0, 1, 'num_products=8\nshow_whitespace=0\ncache=1\n\n', 0, 2, '', 1, 0, 0, 0),
(579, '首页主图banner', '', 1, 'hcenter', 1, 'mod_banners', 0, 1, 'width=580\nheight=220\nshowway=0\ncatid=15\nnum=1\nshowtitle=0\ntitlelink=\nmoduleclass_sfx=\n\n', 0, 0, '', 1, 0, 0, 0),
(576, '新建 工具条', '', 1, 'top', 1, 'mod_topbar', 0, 1, '', 0, 2, '', 1, 0, 0, 0),
(577, '新建 企业LOGO', '', 3, 'header', 1, 'mod_logo', 0, 1, 'logo=\n\n', 0, 2, '', 1, 0, 0, 0),
(578, '友情链接', '', 1, 'footer', 1, 'mod_links', 0, 1, 'width=\nheight=\nshowway=1\ncatid=1\nnum=36\nshowtitle=0\nmoduleclass_sfx=\n\n', 0, 0, '', 1, 0, 0, 0),
(588, '最新资讯', '', 1, 'hrgt', 1, 'mod_latestarticle', 0, 1, 'num=7\ncatid=408\nlength=12\ncatlink=0\nshowauthor=0\ntitlelink=0\ntitle_sfx=\nmoduleclass_sfx=\n\n', 0, 0, '', 1, 0, 2, 20),
(589, '最新产品', '', 1, 'hlft', 1, 'mod_product', 0, 1, 'num_products=3\ncatid=0\nshowway=1\n\n', 0, 0, '', 1, 0, 2, 137),
(590, '热销产品', '', 4, 'main', 1, 'mod_product', 0, 1, 'num_products=10\ncatid=0\nshowway=2\n\n', 0, 0, '', 1, 0, 2, 137),
(591, '特价商品', '', 2, 'main', 1, 'mod_product', 0, 1, 'num_products=10\ncatid=0\nshowway=3\n\n', 0, 0, '', 1, 0, 0, 137),
(592, '底部快捷导航', '', 5, 'footer', 1, 'mod_quicknav', 0, 1, '', 0, 0, '', 1, 0, 0, 0),
(594, '首页插图1', '', 1, 'main', 1, 'mod_banners', 0, 1, 'width=980\nheight=110\nshowway=2\ncatid=16\nnum=1\nshowtitle=0\ntitlelink=\nmoduleclass_sfx=\n\n', 0, 0, '', 1, 0, 0, 0),
(595, '首页插图2', '', 3, 'main', 1, 'mod_banners', 0, 1, 'width=980\nheight=110\nshowway=2\ncatid=17\nnum=1\nshowtitle=0\ntitlelink=\nmoduleclass_sfx=\n\n', 0, 0, '', 1, 0, 0, 0),
(596, '限时抢购模块', '', 2, 'hcenter', 1, 'mod_limitedtime', 0, 1, 'catid=0\n\n', 0, 0, '', 1, 0, 0, 0),
(597, '秒杀活动展示模块', '', 2, 'hrgt', 1, 'mod_seckill', 0, 1, 'catid=0\n\n', 0, 0, '', 1, 0, 0, 0),
(598, '浏览历史记录', '', 2, 'right', 1, 'mod_history', 0, 1, 'moduleclass_sfx=mg-t10\n\n', 0, 0, '', 1, 0, 0, 0),
(599, '热卖推荐', '', 1, 'right', 1, 'mod_product', 0, 1, 'num_products=5\ncatid=0\nshowway=4\n\n', 0, 0, '', 1, 0, 2, 137),
(600, '千讯公司信息', '', 1, 'home', 0, 'mod_company', 0, 1, 'num_products=8\n\n', 0, 0, '', 1, 0, 0, 0),
(601, '新建 公司信息', '', 2, 'home', 0, 'mod_company', 0, 1, 'num_products=8\n\n', 0, 0, '', 1, 0, 0, 0),
(615, '新建 会员登陆', '', 3, 'right', 0, 'mod_login', 0, 1, '', 0, 0, '', 1, 0, 0, 0),
(607, '新建 限时抢购模块', '', 4, 'hcenter', 0, 'mod_limitedtime', 0, 1, 'catid=0\n\n', 0, 0, '', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `w_modules_menu`
--

DROP TABLE IF EXISTS `w_modules_menu`;
CREATE TABLE IF NOT EXISTS `w_modules_menu` (
  `moduleid` int(11) NOT NULL default '0',
  `menuid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`moduleid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_modules_menu`
--

INSERT INTO `w_modules_menu` (`moduleid`, `menuid`) VALUES
(16, 0),
(17, 0),
(18, 0),
(19, 0),
(21, 0),
(22, 1),
(22, 2),
(22, 4),
(22, 27),
(22, 36),
(25, 0),
(27, 0),
(28, 0),
(29, 0),
(30, 1),
(31, 0),
(32, 0),
(33, 0),
(34, 0),
(35, 0),
(36, 0),
(38, 0),
(39, 0),
(40, 0),
(45, 0),
(50, 0),
(51, 0),
(52, 0),
(53, 1),
(54, 0),
(59, 0),
(60, 0),
(61, 1),
(62, 1),
(63, 1),
(64, 0),
(65, 0),
(66, 0),
(67, 0),
(68, 0),
(69, 0),
(70, 0),
(71, 0),
(72, 0),
(73, 1),
(74, 0),
(75, 0),
(76, 1),
(77, 1),
(78, 0),
(79, 1),
(80, 0),
(81, 0),
(82, 0),
(83, 0),
(84, 0),
(85, 1),
(86, 0),
(87, 0),
(88, 0),
(90, 0),
(91, 0),
(92, 0),
(93, 0),
(94, 0),
(95, 0),
(96, 1),
(97, 1),
(98, 1),
(99, 0),
(100, 0),
(195, 0),
(202, 0),
(206, 0),
(207, 0),
(208, 0),
(248, 0),
(249, 0),
(541, 0),
(542, 0),
(543, 0),
(544, 0),
(545, 0),
(546, 0),
(547, 0),
(548, 0),
(549, 0),
(550, 0),
(551, 0),
(552, 0),
(553, 0),
(554, 0),
(555, 0),
(556, 0),
(557, 0),
(558, 0),
(559, 0),
(560, 0),
(561, 0),
(562, 0),
(563, 0),
(564, 0),
(565, 0),
(566, 0),
(567, 0),
(568, 0),
(569, 0),
(570, 0),
(571, 0),
(572, 0),
(573, 0),
(574, 0),
(575, 0),
(576, 0),
(577, 0),
(579, 0),
(580, 0),
(581, 0),
(582, 0),
(583, 0),
(584, 0),
(585, 0),
(586, 0),
(587, 0),
(588, 0),
(589, 0),
(590, 0),
(591, 0),
(592, 0),
(593, 0),
(594, 0),
(595, 0),
(596, 0),
(597, 0),
(598, 0),
(599, 0),
(600, 0),
(601, 0),
(614, 0),
(615, 380),
(616, 0);

-- --------------------------------------------------------

--
-- 表的结构 `w_navigations`
--

DROP TABLE IF EXISTS `w_navigations`;
CREATE TABLE IF NOT EXISTS `w_navigations` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `component` varchar(50) NOT NULL,
  `name` varchar(50) default '',
  `alias` varchar(50) NOT NULL,
  `link` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `lft` int(10) unsigned NOT NULL default '0',
  `rgt` int(10) unsigned NOT NULL default '0',
  `parent_id` int(11) NOT NULL default '0',
  `tid` int(11) NOT NULL,
  `uid` int(11) NOT NULL default '0',
  `params` text,
  `view_path` varchar(255) default NULL,
  `published` tinyint(1) NOT NULL default '0',
  `home` tinyint(1) NOT NULL default '0',
  `metakey` varchar(255) default NULL,
  `metadesc` varchar(255) default NULL,
  `isfront` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `tid` (`tid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- 转存表中的数据 `w_navigations`
--

INSERT INTO `w_navigations` (`id`, `component`, `name`, `alias`, `link`, `type`, `lft`, `rgt`, `parent_id`, `tid`, `uid`, `params`, `view_path`, `published`, `home`, `metakey`, `metadesc`, `isfront`) VALUES
(1, 'pages', '关于天亿', 'guanyutianyi', '', '', 7, 10, 0, 0, 89, '', '', 1, 0, '', '', 0),
(2, 'pages', '关于我们', 'guanyuwomen', '', '', 3, 4, 0, 0, 89, '', '', 1, 0, '', '', 0),
(3, 'pages', '产品目录', 'chanpinmulu', '', '', 1, 2, 0, 0, 89, '', '', 1, 0, '', '', 0),
(20, 'products', '产品介绍', 'chanpinjieshao', '', '', 1, 2, 0, 0, 98, '', '', 1, 0, '', '', 0),
(19, 'news', '推荐阅读', 'tuijianyuedu', '', '', 5, 6, 0, 0, 89, '', '', 1, 0, '', '', 0),
(7, 'pages', '首页', 'shouye', '', '', 1, 2, 0, 0, 90, '', '', 0, 0, '', '', 0),
(8, 'pages', '公司简介', 'gongsijianjie', '', '', 3, 4, 0, 0, 90, '', '', 0, 0, '', '', 0),
(11, 'feedbacks', '留言板 ', 'liuyanban ', '', '', 11, 12, 0, 0, 89, '', '', 1, 0, '', '', 0),
(12, 'products', '产品信息', 'chanpinxinxi', '', '', 8, 9, 1, 0, 89, '', '', 1, 0, '', '', 0),
(13, 'news', '动态', 'dongtai', '', '', 13, 14, 0, 0, 89, '', '', 1, 0, '', '', 0),
(14, 'products', '产品列表', 'chanpinliebiao', '', '', 3, 4, 0, 0, 1, '', '', 1, 0, '', '', 0),
(17, 'company', '公司信息', 'gongsixinxi', '', '', 5, 6, 0, 0, 1, '', '', 1, 0, '', '', 0),
(16, 'pages', '关于我们', 'guanyuwomen', '', '', 1, 2, 0, 0, 1, '', '', 1, 0, '', '', 0),
(18, 'feedbacks', '客户留言', 'kehuliuyan', '', '', 7, 8, 0, 0, 1, '', '', 1, 0, '', '', 0),
(21, 'pages', '公司简介', 'gongsijianjie', '', '', 3, 4, 0, 0, 98, '', '', 1, 0, '', '', 0),
(22, 'company', '公司信息', 'gongsixinxi', '', '', 5, 6, 0, 0, 98, '', '', 1, 0, '', '', 0),
(23, 'company', '公司介绍', 'gongsijieshao', '', '', 1, 2, 0, 0, 103, '', '', 1, 0, '', '', 0),
(24, 'products', '供应产品', 'gongyingchanpin', '', '', 3, 4, 0, 0, 103, '', '', 1, 0, '', '', 0),
(25, 'news', '公司博客', 'gongsiboke', '', '', 5, 6, 0, 0, 103, '', '', 1, 0, '', '', 0),
(26, 'feedbacks', '客户反馈', 'kehufankui', '', '', 7, 8, 0, 0, 103, '', '', 1, 0, '', '', 0),
(27, 'pages', '联系我们', 'lianxiwomen', '', '', 9, 10, 0, 0, 103, '', '', 1, 0, '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `w_navigations_des`
--

DROP TABLE IF EXISTS `w_navigations_des`;
CREATE TABLE IF NOT EXISTS `w_navigations_des` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL default '',
  `fulltext` mediumtext NOT NULL,
  `hits` int(11) unsigned NOT NULL default '0',
  `uid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_navigations_des`
--

INSERT INTO `w_navigations_des` (`id`, `alias`, `fulltext`, `hits`, `uid`) VALUES
(1, '', '<p>asdfasfd</p>', 0, 89),
(3, '', '<p>asfdasfd</p>', 0, 89),
(16, '', '<p>asfdasfdasfdasfd</p>', 0, 1),
(21, '', '<p>asfdasfdasfd</p>', 0, 98);

-- --------------------------------------------------------

--
-- 表的结构 `w_news`
--

DROP TABLE IF EXISTS `w_news`;
CREATE TABLE IF NOT EXISTS `w_news` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `fulltext` mediumtext,
  `published` tinyint(1) NOT NULL default '0',
  `isfront` tinyint(2) NOT NULL default '0',
  `menuid` int(11) unsigned NOT NULL default '0',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `metakey` text,
  `metadesc` text,
  `hits` int(11) unsigned NOT NULL default '0',
  `uid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`menuid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `w_news`
--

INSERT INTO `w_news` (`id`, `title`, `fulltext`, `published`, `isfront`, `menuid`, `created`, `modified`, `ordering`, `metakey`, `metadesc`, `hits`, `uid`) VALUES
(7, '怎样之市场营销计划能获得老板认同？', '<p>在大多数老板眼里，市场营销部门是花钱的主，销售部才是赚钱的机器。所以我们常常见到一个公司有一大堆销售人员，少有市场营销人员。</p>\r\n<p>如果您负责市场营销，您可要小心，您在公司获得的支持远比销售部弱。</p>\r\n<p>营销工作，计划先行。策略性地规划您每一份营 销计划，最大程度地获得上司认同和支持。</p>\r\n<p>首先，您得向公司的老板、其他部门经理、您周围的所有人灌输一个正确的理念，那就是，</p>\r\n<p><b>市场营销的投入不能只看作生意运作的成本，更应被认为是一种市场投资。它有投入、有产出，有投资回报，也存在风险。</b></p>\r\n<p>其次，营销计划必须说明对公司财务的影响。譬如营销投入后，公司的销售预期有怎样的增长，用户数、客户数会有怎样的增长。</p>\r\n<p>对应一个市场活动对销售的影响非常困难，可是从长远来看，市场营销对整体销售的贡献显而易见。</p>\r\n<p>第三，市 场营销计划必须直观明确，尤其是投入产出风险机会等关键点。如何让人相信，投入一份将有两份三份的回报。让老板一目了然、心动并支持您的行动。</p>\r\n<p>第四，营销计划必须是周密的，并且文笔有煽动性，使人读来心动又可信。好的有吸引力的标 题、创新想法、清晰思路，正确的操作，如怎样的工具技术被运用，如何丈量、控制过程。营销对现有市场产生怎样的影响。</p>\r\n<p>正如前面所说，市场营销是一种投资，好的市场营销计划好似周详的投资计划，可能它没有商业计划书那样面面俱到，但同样需要您的智慧、策略和手段。</p>\r\n<p>获得老板的支持花钱做市场决不是一件容易的事。如果您觉得力不从心，不妨找专业公司协助您一起做市场营销计划，实现您的营销梦想。</p>', 1, 0, 19, '2010-06-29 09:50:52', '2010-06-29 09:52:29', 0, '', '', 0, 89);

-- --------------------------------------------------------

--
-- 表的结构 `w_order`
--

DROP TABLE IF EXISTS `w_order`;
CREATE TABLE IF NOT EXISTS `w_order` (
  `id` int(11) NOT NULL auto_increment,
  `order_sn` varchar(20) default NULL COMMENT '订单号',
  `uid` int(11) NOT NULL default '0' COMMENT '会员ID',
  `mid` mediumint(8) NOT NULL default '0',
  `order_type` tinyint(1) NOT NULL default '0' COMMENT '订单类型',
  `order_status` enum('active','dead','finish') NOT NULL default 'active' COMMENT '订单状态',
  `pay_status` enum('0','1','2','3','4','5') NOT NULL default '0' COMMENT '支付状态',
  `ship_status` enum('0','1','2','3','4') NOT NULL default '0' COMMENT '发货状态',
  `user_status` enum('null','payed','shipped') NOT NULL COMMENT '会员的操作状态',
  `created_date` datetime default NULL COMMENT '创建时间',
  `consignee` varchar(60) default NULL COMMENT '收货人',
  `province` mediumint(4) NOT NULL default '0' COMMENT '城市',
  `city` mediumint(4) NOT NULL default '0',
  `city_text` varchar(255) default NULL,
  `goods_address` varchar(120) default NULL COMMENT '地址',
  `zipcode` varchar(60) default NULL COMMENT '邮编',
  `goods_mobile` varchar(15) default NULL,
  `tel` varchar(60) default NULL COMMENT '电话',
  `email` varchar(60) default NULL COMMENT 'email',
  `integral` int(8) NOT NULL default '0',
  `amount` decimal(10,2) NOT NULL default '0.00' COMMENT '总价格',
  `quantity` int(4) NOT NULL default '0' COMMENT '总数量',
  `weight` decimal(10,2) NOT NULL COMMENT '商品重量',
  `total_deposit` decimal(10,2) NOT NULL default '0.00',
  `postage` tinyint(4) unsigned NOT NULL default '0' COMMENT '货运方式',
  `postage_free` float(6,2) NOT NULL default '0.00' COMMENT '运费',
  `pay` tinyint(4) unsigned NOT NULL default '0' COMMENT '支付方式',
  `remark` varchar(255) default NULL COMMENT '说明',
  `shipping_free` decimal(10,2) NOT NULL default '0.00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- 转存表中的数据 `w_order`
--

INSERT INTO `w_order` (`id`, `order_sn`, `uid`, `mid`, `order_type`, `order_status`, `pay_status`, `ship_status`, `user_status`, `created_date`, `consignee`, `province`, `city`, `city_text`, `goods_address`, `zipcode`, `goods_mobile`, `tel`, `email`, `integral`, `amount`, `quantity`, `weight`, `total_deposit`, `postage`, `postage_free`, `pay`, `remark`, `shipping_free`) VALUES
(36, '20110509175228', 89, 1, 0, 'active', '1', '0', 'payed', '2011-05-09 17:52:28', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '40.00', 1, '0.00', '40.00', 2, 17.00, 8, NULL, '0.00'),
(35, '20110509174051', 89, 1, 0, 'dead', '1', '1', 'shipped', '2011-05-09 17:40:51', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '40.00', 1, '0.00', '40.00', 2, 17.00, 8, NULL, '0.00'),
(33, '20110503113119', 89, 1, 0, 'finish', '2', '1', 'shipped', '2011-05-03 11:31:19', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '1586.00', 3, '0.00', '1586.00', 2, 17.00, 8, NULL, '0.00'),
(34, '20110509161523', 89, 1, 0, 'active', '0', '0', 'null', '2011-05-09 16:15:23', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '47.00', 1, '0.00', '47.00', 2, 17.00, 8, NULL, '0.00'),
(32, '20110429143408', 89, 109, 0, 'active', '0', '0', 'null', '2011-04-29 14:34:08', '小军', 184, 185, '湖北:武汉市', '中心南区24街道', '12341234', '1234123412', '', NULL, 0, '24.11', 1, '0.00', '24.00', 2, 17.00, 8, NULL, '0.00'),
(31, '20110429125348', 89, 1, 0, 'active', '0', '0', 'null', '2011-04-29 12:53:48', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '64.13', 1, '0.00', '64.00', 1, 25.00, 8, NULL, '0.00'),
(30, '20110427151517', 89, 109, 0, 'active', '0', '0', 'null', '2011-04-27 15:15:17', '小军', 184, 185, '湖北:武汉市', '中心南区24街道', '12341234', '1234123412', '', NULL, 0, '47.00', 1, '0.00', '47.00', 2, 17.00, 8, NULL, '0.00'),
(37, '20110509175414', 89, 1, 0, 'active', '0', '0', 'null', '2011-05-09 17:54:14', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '40.00', 1, '0.00', '40.00', 2, 17.00, 8, NULL, '0.00'),
(38, '20110509175449', 89, 1, 0, 'active', '0', '0', 'null', '2011-05-09 17:54:49', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '40.00', 1, '0.00', '40.00', 2, 17.00, 8, NULL, '0.00'),
(39, '20110509175452', 89, 1, 0, 'active', '0', '0', 'null', '2011-05-09 17:54:52', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '40.00', 1, '0.00', '40.00', 2, 17.00, 8, NULL, '0.00'),
(40, '20110510144158', 89, 1, 0, 'active', '0', '0', 'null', '2011-05-10 14:41:58', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '40.00', 1, '0.00', '40.00', 2, 17.00, 8, NULL, '0.00'),
(41, '20110510144326', 89, 1, 0, 'active', '0', '0', 'null', '2011-05-10 14:43:26', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '40.00', 1, '0.00', '40.00', 2, 17.00, 8, NULL, '0.00'),
(42, '20110510154531', 89, 1, 0, 'active', '0', '0', 'null', '2011-05-10 15:45:31', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '526.00', 1, '0.00', '526.00', 2, 17.00, 8, NULL, '0.00'),
(43, '20110510175212', 89, 119, 0, 'active', '0', '0', 'null', '2011-05-10 17:52:12', '张强', 2, 0, '北京', '中心区三栋702', '10000', '13413123213', '', NULL, 0, '749.00', 1, '0.00', '17.00', 2, 17.00, 8, NULL, '0.00'),
(44, '20110511171711', 89, 109, 0, 'dead', '0', '0', 'null', '2011-05-11 17:17:11', '小军', 184, 185, '湖北:武汉市', '中心南区24街道', '12341234', '1234123412', '', NULL, 0, '345.00', 2, '0.00', '345.00', 2, 17.00, 8, NULL, '0.00'),
(45, '20110511172229', 89, 1, 0, 'active', '0', '0', 'null', '2011-05-11 17:22:29', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '1549.00', 3, '0.00', '107.00', 2, 17.00, 8, NULL, '0.00'),
(46, '20110512101938', 89, 120, 0, 'active', '0', '0', 'null', '2011-05-12 10:19:38', 'dfsdf', 0, 0, NULL, 'ddfsdfs', 'dfsdf', 'asdfas', 'dfsdf', NULL, 0, '526.00', 1, '0.00', '17.00', 2, 17.00, 8, NULL, '0.00'),
(47, '20110512103931', 89, 120, 0, 'active', '0', '0', 'null', '2011-05-12 10:39:31', 'ghghgh', 0, 0, NULL, 'fgfgghgh', 'ghghgh', 'ghghgh', 'ghghghgh', NULL, 0, '599.00', 2, '0.00', '107.00', 2, 17.00, 8, NULL, '0.00'),
(48, '20110512104358', 89, 109, 0, 'active', '0', '0', 'null', '2011-05-12 10:43:58', '张强', 0, 0, NULL, 'asdf', 'asdf', 'asdf', 'asdf', NULL, 0, '47.00', 1, '0.00', '47.00', 2, 17.00, 8, NULL, '0.00'),
(49, '20110512104504', 89, 109, 0, 'active', '0', '0', 'null', '2011-05-12 10:45:04', '张强', 0, 0, NULL, 'asdf', 'asdf', 'sadf', 'asdf', NULL, 0, '47.00', 1, '0.00', '47.00', 2, 17.00, 8, NULL, '0.00'),
(50, '20110512105139', 89, 109, 0, 'active', '0', '0', 'null', '2011-05-12 10:51:39', 'sadfasdf', 30, 34, '内蒙古:赤峰市', 'asdf', 'asdf', 'asdf', 'asdf', NULL, 0, '47.00', 1, '0.00', '47.00', 2, 17.00, 8, NULL, '0.00'),
(51, '20110512123242', 89, 120, 0, 'active', '0', '0', 'null', '2011-05-12 12:32:42', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '509.00', 1, '0.00', '17.00', 2, 17.00, 8, NULL, '0.00'),
(52, '20110520165059', 89, 123, 0, 'active', '0', '0', 'null', '2011-05-20 16:50:59', 'AA', 217, 227, '广东:肇庆市', 'EEWE', 'AADS', '2122', '', NULL, 0, '47.00', 1, '0.00', '47.00', 2, 17.00, 8, NULL, '0.00'),
(53, '20110525105617', 89, 124, 0, 'dead', '0', '0', 'null', '2011-05-25 10:56:17', 'dd', 3, 0, '上海', 'dd', 'dd', 'dd', '', NULL, 0, '179.00', 3, '0.00', '179.00', 2, 17.00, 8, NULL, '0.00'),
(58, '20110608102620', 89, 124, 0, 'dead', '0', '0', 'null', '2011-06-08 10:26:20', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '47.00', 1, '0.00', '47.00', 2, 17.00, 8, NULL, '0.00'),
(55, '20110525143011', 89, 124, 0, 'active', '0', '0', 'null', '2011-05-25 14:30:11', '33', 2, 0, '北京', 'd', 'e', '11', '', NULL, 0, '63.00', 2, '0.00', '63.00', 2, 17.00, 8, NULL, '0.00'),
(56, '20110525143146', 89, 124, 0, 'active', '0', '0', 'null', '2011-05-25 14:31:46', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '40.00', 1, '0.00', '40.00', 2, 17.00, 8, NULL, '0.00'),
(57, '20110526092158', 89, 1, 0, 'active', '0', '2', 'shipped', '2011-05-26 09:21:58', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '47.00', 1, '0.00', '47.00', 2, 17.00, 8, NULL, '0.00'),
(59, '20110608103841', 89, 123, 0, 'active', '0', '0', 'null', '2011-06-08 10:38:41', '1111', 2, 0, '北京', '111', '111', '11', '', NULL, 0, '107.00', 1, '0.00', '107.00', 2, 17.00, 8, NULL, '0.00'),
(60, '20110608103930', 89, 123, 0, 'active', '1', '2', 'shipped', '2011-06-08 10:39:30', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '107.00', 1, '0.00', '107.00', 2, 17.00, 8, NULL, '0.00'),
(61, '20110608104852', 89, 124, 0, 'active', '0', '0', 'null', '2011-06-08 10:48:52', '33', 2, 0, '北京', 'd', 'e', '11', '', NULL, 0, '107.00', 1, '0.00', '107.00', 2, 17.00, 8, NULL, '0.00'),
(62, '20110608114923', 89, 123, 0, 'active', '0', '0', 'null', '2011-06-08 11:49:23', '1111', 2, 0, '北京', '111', '111', '11', '', NULL, 0, '898.00', 1, '0.00', '17.00', 2, 17.00, 8, NULL, '0.00'),
(63, '20110608160431', 89, 123, 0, 'active', '2', '0', 'payed', '2011-06-08 16:04:31', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '107.00', 1, '0.00', '107.00', 2, 17.00, 8, NULL, '0.00'),
(64, '20110609170935', 89, 123, 0, 'active', '0', '0', 'null', '2011-06-09 17:09:35', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '10017.00', 5, '0.00', '10017.00', 2, 17.00, 8, NULL, '0.00'),
(66, '20110610091703', 89, 123, 0, 'active', '1', '2', 'shipped', '2011-06-10 09:17:03', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '784.00', 1, '0.00', '17.00', 2, 17.00, 8, NULL, '0.00'),
(68, '20110610170802', 89, 1, 0, 'active', '0', '0', 'null', '2011-06-10 17:08:02', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '2916.00', 3, '0.00', '0.00', 0, 0.00, 33, NULL, '0.00'),
(69, '20110610170816', 89, 1, 0, 'active', '0', '0', 'null', '2011-06-10 17:08:16', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '1850.00', 10, '0.00', '0.00', 0, 0.00, 33, NULL, '0.00'),
(70, '20110610170831', 89, 1, 0, 'active', '0', '0', 'null', '2011-06-10 17:08:31', 'asfd', 148, 149, '山东:济南市', 'asfdasfdasfd', 'asfd', 'asfd', '', '', 0, '2860.00', 20, '0.00', '0.00', 0, 0.00, 33, NULL, '0.00');

-- --------------------------------------------------------

--
-- 表的结构 `w_order_action`
--

DROP TABLE IF EXISTS `w_order_action`;
CREATE TABLE IF NOT EXISTS `w_order_action` (
  `action_id` mediumint(8) unsigned NOT NULL auto_increment,
  `order_id` mediumint(8) unsigned NOT NULL default '0',
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `action_user` varchar(30) NOT NULL default '',
  `behavior` varchar(20) default NULL,
  `action_note` varchar(255) NOT NULL default '',
  `log_time` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`action_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- 转存表中的数据 `w_order_action`
--

INSERT INTO `w_order_action` (`action_id`, `order_id`, `uid`, `action_user`, `behavior`, `action_note`, `log_time`) VALUES
(74, 60, 1, 'china', '退货', '填写退货单，并确认退货', 1307676616),
(65, 63, 1, 'china', '付款', '填写付款单，并确认付款', 1307673684),
(63, 57, 1, 'china', '发货', '填写发货单，并确认发货', 1307673464),
(59, 66, 1, 'china', '发货', '填写发货单，并确认发货', 1307671309),
(58, 66, 1, 'china', '付款', '填写付款单，并确认付款', 1307671304),
(60, 66, 1, 'china', '退货', '填写退货单，并确认退货', 1307671322),
(57, 33, 1, 'china', '退款', '填写退款单，并确认退款', 1306920208),
(55, 33, 1, 'china', '付款', '填写付款单，并确认付款', 1306920044),
(56, 33, 1, 'china', '发货', '填写发货单，并确认发货', 1306920114),
(52, 36, 1, 'china', '付款', '填写付款单，并确认付款', 1306912166),
(53, 35, 1, 'china', '付款', '填写付款单，并确认付款', 1306917182),
(54, 35, 1, 'china', '发货', '填写发货单，并确认发货', 1306919901),
(66, 63, 1, 'china', '退款', '填写退款单，并确认退款', 1307673803),
(71, 57, 1, 'china', '退货', '填写退货单，并确认退货', 1307676594),
(72, 60, 1, 'china', '付款', '填写付款单，并确认付款', 1307676609),
(73, 60, 1, 'china', '发货', '填写发货单，并确认发货', 1307676613);

-- --------------------------------------------------------

--
-- 表的结构 `w_order_goods`
--

DROP TABLE IF EXISTS `w_order_goods`;
CREATE TABLE IF NOT EXISTS `w_order_goods` (
  `product_id` int(11) NOT NULL default '0',
  `order_id` int(11) NOT NULL default '0',
  `product_name` varchar(60) default NULL,
  `product_thumb` varchar(255) default NULL COMMENT '产品缩略图',
  `product_quanlity` int(4) default NULL,
  `product_price` decimal(10,2) NOT NULL,
  `act_type` tinyint(2) NOT NULL default '0' COMMENT '是否为活动产品',
  `uid` int(11) NOT NULL default '0',
  `params` text,
  `iscomment` tinyint(1) NOT NULL default '0',
  `send_number` tinyint(4) NOT NULL default '0' COMMENT '已发货',
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_order_goods`
--

INSERT INTO `w_order_goods` (`product_id`, `order_id`, `product_name`, `product_thumb`, `product_quanlity`, `product_price`, `act_type`, `uid`, `params`, `iscomment`, `send_number`) VALUES
(29, 35, '格力电风扇 KYTB-25 台式转页扇 日月造型 正品特价 ', '/media/1/products/1298445546_s.jpg', 1, '23.00', 2, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";s:5:"23.00";s:12:"actual_price";s:5:"23.00";s:8:"act_type";i:2;}', 0, 0),
(25, 32, '格力电风扇 FD-4003B 红外遥控落地扇', '/media/1/products/1298440635_s.jpg', 1, '7.11', 0, 109, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";s:4:"7.11";s:12:"actual_price";s:4:"7.11";s:8:"act_type";i:0;}', 1, 0),
(11, 33, '格力电饭煲 GD-3016 饭粥两用全国正品 新一代节能产品', '/media/1/products/1298364741_s.jpg', 3, '523.00', 0, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";s:6:"523.00";s:12:"actual_price";s:6:"523.00";s:8:"act_type";i:0;}', 0, 0),
(25, 34, '格力电风扇FSJ-1802 迷你 学生扇 摇头台夹两用扇 ', '/media/1/products/1298440635_s.jpg', 1, '30.00', 2, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";s:5:"30.00";s:12:"actual_price";s:5:"30.00";s:8:"act_type";i:2;}', 0, 0),
(25, 30, '电风扇', '/media/1/products/1298440635_s.jpg', 1, '30.00', 2, 109, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";s:5:"30.00";s:12:"actual_price";s:5:"30.00";s:8:"act_type";i:2;}', 1, 0),
(18, 31, '微电脑格力电饭煲 GDF-502DA 24小时预约', '/media/1/products/1298429771_s.jpg', 1, '39.13', 0, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";s:5:"39.13";s:12:"actual_price";s:5:"39.13";s:8:"act_type";i:0;}', 0, 0),
(29, 36, '格力电风扇 KYTB-25 台式转页扇 日月造型 正品特价 ', '/media/1/products/1298445546_s.jpg', 1, '23.00', 2, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";s:5:"23.00";s:12:"actual_price";s:5:"23.00";s:8:"act_type";i:2;}', 0, 0),
(29, 37, '格力电风扇 KYTB-25 台式转页扇 日月造型 正品特价 ', '/media/1/products/1298445546_s.jpg', 1, '23.00', 2, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";s:5:"23.00";s:12:"actual_price";s:5:"23.00";s:8:"act_type";i:2;}', 0, 0),
(29, 38, '格力电风扇 KYTB-25 台式转页扇 日月造型 正品特价 ', '/media/1/products/1298445546_s.jpg', 1, '23.00', 2, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";s:5:"23.00";s:12:"actual_price";s:5:"23.00";s:8:"act_type";i:2;}', 0, 0),
(29, 39, '格力电风扇 KYTB-25 台式转页扇 日月造型 正品特价 ', '/media/1/products/1298445546_s.jpg', 1, '23.00', 2, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";s:5:"23.00";s:12:"actual_price";s:5:"23.00";s:8:"act_type";i:2;}', 0, 0),
(22, 40, '格力电饭煲 GDF-302DA 全新正品 电脑煲 ', '/media/1/products/1298432807_s.jpg', 1, '23.00', 3, 1, 'a:5:{s:6:"params";s:6:"秒杀";s:4:"pays";i:2;s:5:"price";s:5:"23.00";s:12:"actual_price";s:5:"23.00";s:8:"act_type";i:3;}', 0, 0),
(22, 41, '格力电饭煲 GDF-302DA 全新正品 电脑煲 ', '/media/1/products/1298432807_s.jpg', 1, '23.00', 3, 1, 'a:5:{s:6:"params";s:6:"秒杀";s:4:"pays";i:2;s:5:"price";s:5:"23.00";s:12:"actual_price";s:5:"23.00";s:8:"act_type";i:3;}', 0, 0),
(13, 42, '格力电饭煲 GD-3016全新正品 ', '/media/1/products/1298368041_s.jpg', 1, '509.00', 0, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";s:6:"509.00";s:12:"actual_price";s:6:"509.00";s:8:"act_type";i:0;}', 0, 0),
(49, 43, '格力电水壶 GK-CS1512DA 不锈钢 磨砂表面 ', '/media/1/products/1298619030_s.jpg', 1, '732.00', 1, 119, 'a:5:{s:6:"params";s:6:"团购";s:4:"pays";i:2;s:5:"price";s:4:"0.00";s:12:"actual_price";s:4:"0.00";s:8:"act_type";i:1;}', 0, 0),
(65, 44, '格力电油汀取暖器NDY20K送加湿盒晾衣架 ', '/media/1/products/1299141517_s.jpg', 1, '298.00', 3, 109, 'a:5:{s:6:"params";s:6:"秒杀";s:4:"pays";i:2;s:5:"price";s:6:"298.00";s:12:"actual_price";s:6:"298.00";s:8:"act_type";i:3;}', 1, 0),
(25, 44, '格力电风扇FSJ-1802 迷你 学生扇 摇头台夹两用扇 ', '/media/1/products/1298440635_s.jpg', 1, '30.00', 2, 109, 'a:5:{s:6:"params";s:12:"限时促销";s:4:"pays";i:2;s:5:"price";s:5:"30.00";s:12:"actual_price";s:5:"30.00";s:8:"act_type";i:2;}', 1, 0),
(49, 45, '格力电水壶 GK-CS1512DA 不锈钢 磨砂表面 ', '/media/1/products/1298619030_s.jpg', 1, '90.00', 1, 1, 'a:5:{s:6:"params";s:6:"团购";s:4:"pays";i:2;s:5:"price";s:5:"90.00";s:12:"actual_price";s:5:"90.00";s:8:"act_type";i:1;}', 0, 0),
(16, 45, '格力 GD-305Z 电饭煲 3升 煮饭煲粥两用 新一代节能 ', '/media/1/products/1298427264_s.jpg', 1, '933.00', 0, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";N;s:12:"actual_price";N;s:8:"act_type";i:0;}', 0, 0),
(13, 45, '格力电饭煲 GD-3016全新正品 ', '/media/1/products/1298368041_s.jpg', 1, '509.00', 0, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";N;s:12:"actual_price";N;s:8:"act_type";i:0;}', 0, 0),
(13, 46, '格力电饭煲 GD-3016全新正品 ', '/media/1/products/1298368041_s.jpg', 1, '509.00', 0, 120, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";N;s:12:"actual_price";N;s:8:"act_type";i:0;}', 0, 0),
(49, 47, '格力电水壶 GK-CS1512DA 不锈钢 磨砂表面 ', '/media/1/products/1298619030_s.jpg', 1, '90.00', 1, 120, 'a:5:{s:6:"params";s:6:"团购";s:4:"pays";i:2;s:5:"price";s:5:"90.00";s:12:"actual_price";s:5:"90.00";s:8:"act_type";i:1;}', 0, 0),
(9, 47, '格力 GDF-502CB 格力 微电脑 电饭煲 GDF-302CB 正品全国联保 ', '/media/1/products/1298364741_s.jpg', 1, '492.00', 0, 120, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";N;s:12:"actual_price";N;s:8:"act_type";i:0;}', 0, 0),
(25, 48, '格力电风扇FSJ-1802 迷你 学生扇 摇头台夹两用扇 ', '/media/1/products/1298440635_s.jpg', 1, '30.00', 2, 109, 'a:5:{s:6:"params";s:12:"限时促销";s:4:"pays";i:2;s:5:"price";s:5:"30.00";s:12:"actual_price";s:5:"30.00";s:8:"act_type";i:2;}', 0, 0),
(25, 49, '格力电风扇FSJ-1802 迷你 学生扇 摇头台夹两用扇 ', '/media/1/products/1298440635_s.jpg', 1, '30.00', 2, 109, 'a:5:{s:6:"params";s:12:"限时促销";s:4:"pays";i:2;s:5:"price";s:5:"30.00";s:12:"actual_price";s:5:"30.00";s:8:"act_type";i:2;}', 0, 0),
(25, 50, '格力电风扇FSJ-1802 迷你 学生扇 摇头台夹两用扇 ', '/media/1/products/1298440635_s.jpg', 1, '30.00', 2, 109, 'a:5:{s:6:"params";s:12:"限时促销";s:4:"pays";i:2;s:5:"price";s:5:"30.00";s:12:"actual_price";s:5:"30.00";s:8:"act_type";i:2;}', 0, 0),
(9, 51, '格力 GDF-502CB 格力 微电脑 电饭煲 GDF-302CB 正品全国联保 ', '/media/1/products/1298364741_s.jpg', 1, '492.00', 0, 120, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";N;s:12:"actual_price";N;s:8:"act_type";i:0;}', 0, 0),
(25, 52, '格力电风扇FSJ-1802 迷你 学生扇 摇头台夹两用扇 ', '/media/1/products/1298440635_s.jpg', 1, '30.00', 2, 123, 'a:5:{s:6:"params";s:12:"限时促销";s:4:"pays";i:2;s:5:"price";s:5:"30.00";s:12:"actual_price";s:5:"30.00";s:8:"act_type";i:2;}', 1, 0),
(25, 53, '格力电风扇FSJ-1802 迷你 学生扇 摇头台夹两用扇 ', '/media/1/products/1298440635_s.jpg', 1, '30.00', 2, 124, 'a:5:{s:6:"params";s:12:"限时促销";s:4:"pays";i:2;s:5:"price";s:5:"30.00";s:12:"actual_price";s:5:"30.00";s:8:"act_type";i:2;}', 1, 0),
(64, 53, '格力电暖器FGK-12 格力红外线取暖器 节能环保 ', '/media/1/products/1299140697_s.jpg', 2, '66.00', 2, 124, 'a:5:{s:6:"params";s:12:"限时促销";s:4:"pays";i:2;s:5:"price";s:5:"66.00";s:12:"actual_price";s:5:"66.00";s:8:"act_type";i:2;}', 0, 0),
(25, 58, '格力电风扇FSJ-1802 迷你 学生扇 摇头台夹两用扇 ', '/media/1/products/1298440635_s.jpg', 1, '30.00', 2, 124, 'a:5:{s:6:"params";s:12:"限时促销";s:4:"pays";i:2;s:5:"price";s:5:"30.00";s:12:"actual_price";s:5:"30.00";s:8:"act_type";i:2;}', 0, 0),
(29, 55, '格力电风扇 KYTB-25 台式转页扇 日月造型 正品特价 ', '/media/1/products/1298445546_s.jpg', 2, '23.00', 2, 124, 'a:5:{s:6:"params";s:12:"限时促销";s:4:"pays";i:2;s:5:"price";s:5:"23.00";s:12:"actual_price";s:5:"23.00";s:8:"act_type";i:2;}', 0, 0),
(29, 56, '格力电风扇 KYTB-25 台式转页扇 日月造型 正品特价 ', '/media/1/products/1298445546_s.jpg', 1, '23.00', 2, 124, 'a:5:{s:6:"params";s:12:"限时促销";s:4:"pays";i:2;s:5:"price";s:5:"23.00";s:12:"actual_price";s:5:"23.00";s:8:"act_type";i:2;}', 0, 0),
(25, 57, '格力电风扇FSJ-1802 迷你 学生扇 摇头台夹两用扇 ', '/media/1/products/1298440635_s.jpg', 1, '30.00', 2, 1, 'a:5:{s:6:"params";s:12:"限时促销";s:4:"pays";i:2;s:5:"price";s:5:"30.00";s:12:"actual_price";s:5:"30.00";s:8:"act_type";i:2;}', 0, 0),
(49, 59, '格力电水壶 GK-CS1512DA 不锈钢 磨砂表面 ', '/media/1/products/1298619030_s.jpg', 1, '90.00', 1, 123, 'a:5:{s:6:"params";s:6:"团购";s:4:"pays";i:2;s:5:"price";s:5:"90.00";s:12:"actual_price";s:5:"90.00";s:8:"act_type";i:1;}', 1, 0),
(49, 60, '格力电水壶 GK-CS1512DA 不锈钢 磨砂表面 ', '/media/1/products/1298619030_s.jpg', 1, '90.00', 1, 123, 'a:5:{s:6:"params";s:6:"团购";s:4:"pays";i:2;s:5:"price";s:5:"90.00";s:12:"actual_price";s:5:"90.00";s:8:"act_type";i:1;}', 1, 0),
(49, 61, '格力电水壶 GK-CS1512DA 不锈钢 磨砂表面 ', '/media/1/products/1298619030_s.jpg', 1, '90.00', 1, 124, 'a:5:{s:6:"params";s:6:"团购";s:4:"pays";i:2;s:5:"price";s:5:"90.00";s:12:"actual_price";s:5:"90.00";s:8:"act_type";i:1;}', 0, 0),
(67, 62, '格力电暖器 NSW-8 二管 石英管 取暖器 ', '/media/1/products/1299143354-1_s.jpg', 1, '881.00', 0, 123, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";N;s:12:"actual_price";N;s:8:"act_type";i:0;}', 0, 0),
(49, 63, '格力电水壶 GK-CS1512DA 不锈钢 磨砂表面 ', '/media/1/products/1298619030_s.jpg', 1, '90.00', 1, 123, 'a:5:{s:6:"params";s:6:"团购";s:4:"pays";i:2;s:5:"price";s:5:"90.00";s:12:"actual_price";s:5:"90.00";s:8:"act_type";i:1;}', 0, 0),
(24, 69, '格力电风扇FSJ-1801 密集安全网强韧风叶 强劲电机 安全实用 ', '/media/1/products/1298436490_s.jpg', 10, '185.00', 0, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";N;s:12:"actual_price";N;s:8:"act_type";i:0;}', 0, 0),
(80, 66, '新建 格力电饭煲 GD-303A 新品上市 ', '/media/1/products/1298428582_s.jpg', 1, '767.00', 0, 123, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";N;s:12:"actual_price";N;s:8:"act_type";i:0;}', 0, 0),
(23, 68, '格力电风扇FSLD-40 扇头360°循环送风 低压启动 优质材料 ', '/media/1/products/1298441497_s.jpg', 3, '972.00', 0, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";N;s:12:"actual_price";N;s:8:"act_type";i:0;}', 0, 0),
(29, 70, '格力电风扇 KYTB-25 台式转页扇 日月造型 正品特价 ', '/media/1/products/1298445546_s.jpg', 20, '143.00', 0, 1, 'a:5:{s:6:"params";N;s:4:"pays";i:2;s:5:"price";N;s:12:"actual_price";N;s:8:"act_type";i:0;}', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `w_pages`
--

DROP TABLE IF EXISTS `w_pages`;
CREATE TABLE IF NOT EXISTS `w_pages` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `alias` varchar(255) NOT NULL default '',
  `introtext` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `menuid` int(11) unsigned NOT NULL default '0',
  `images` text NOT NULL,
  `attribs` text NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `hits` int(11) unsigned NOT NULL default '0',
  `metadata` text NOT NULL,
  `uid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`menuid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `w_pages`
--

INSERT INTO `w_pages` (`id`, `alias`, `introtext`, `content`, `published`, `menuid`, `images`, `attribs`, `metakey`, `metadesc`, `hits`, `metadata`, `uid`) VALUES
(7, '', '', '<p>\r\n	<span style="color: rgb(255, 0, 0); font-weight: bold;">UI58.com&nbsp;</span> 专注于提供优秀的网站欣赏，网址个性收藏，定义个性导航页面。</p>\r\n', 0, 24, '', '', '', '', 0, '', 1),
(8, '', '', '<p>\r\n	<strong>1，UI58提供那些功能？</strong></p>\r\n<p>\r\n	答： 主要提供自定义网址导航功能，和优秀网站收藏的功能。</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<strong>2，怎样拥有自己的网址导航？</strong></p>\r\n<p>\r\n	答： 首先注册一个用户，然后进入我的导航，添加一个分组，在分组框的右下方有个添加网址的按钮，点击后，可添加自己的网址，多个网址和分组可拖动排序。</p>\r\n<p>\r\n	<strong><br />\r\n	</strong></p>\r\n<p>\r\n	<strong>3，如何选择个性的皮服？</strong></p>\r\n<p>\r\n	答：会员登陆后可以看到换皮服的按钮，点击后，可以选择自己喜欢的皮服，再应用即可。</p>\r\n', 0, 32, '', '', '', '', 0, '', 1),
(9, '', '', '<p>asfdasfd</p>\r\n<hr />\r\n<p><img src="/plugins/editors/fckeditor_2_6/editor/images/smiley/26.gif" alt="" /><img src="/plugins/editors/fckeditor_2_6/editor/images/smiley/32.gif" alt="" /></p>', 0, 15, '', '', '', '', 0, '', 1),
(11, '', '', '<p>adfadf</p>', 0, 419, '', '', '', '', 0, '', 1),
(12, '', '', '<p>恩恩</p>', 0, 407, '', '', '', '', 0, '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_pages_description`
--

DROP TABLE IF EXISTS `w_pages_description`;
CREATE TABLE IF NOT EXISTS `w_pages_description` (
  `menu_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '1',
  `content` text,
  PRIMARY KEY  (`menu_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_pages_description`
--

INSERT INTO `w_pages_description` (`menu_id`, `language_id`, `content`) VALUES
(354, 2, ''),
(354, 3, ''),
(354, 4, '<p>\r\n	asdf22</p>\r\n'),
(15, 2, ''),
(15, 3, ''),
(7, 2, ''),
(7, 3, ''),
(380, 2, ''),
(380, 3, '<p>asdfasdf</p>'),
(408, 2, ''),
(408, 3, ''),
(407, 2, ''),
(407, 3, '');

-- --------------------------------------------------------

--
-- 表的结构 `w_payments`
--

DROP TABLE IF EXISTS `w_payments`;
CREATE TABLE IF NOT EXISTS `w_payments` (
  `payment_id` mediumint(8) NOT NULL auto_increment COMMENT '付款单序号',
  `order_id` bigint(20) unsigned default NULL COMMENT '订单ID',
  `order_sn` varchar(20) NOT NULL,
  `uid` mediumint(8) unsigned default NULL COMMENT '会员ID',
  `account` varchar(50) default NULL COMMENT '收款账号',
  `bank` varchar(50) default NULL COMMENT '收款银行',
  `pay_account` varchar(50) default NULL COMMENT '付款人',
  `currency` varchar(10) default NULL COMMENT '货币',
  `money` decimal(20,3) NOT NULL default '0.000' COMMENT '金额',
  `paycost` decimal(20,3) default NULL COMMENT '手续费',
  `cur_money` decimal(20,3) NOT NULL default '0.000' COMMENT '支付金额',
  `pay_type` enum('online','offline','deposit','recharge','joinfee') NOT NULL default 'online' COMMENT '支付类型',
  `payment` mediumint(8) unsigned NOT NULL default '0' COMMENT '支付方式',
  `paymethod` varchar(100) default NULL,
  `op_id` mediumint(8) unsigned default NULL,
  `ip` varchar(20) default NULL,
  `t_begin` int(10) unsigned default NULL COMMENT '下单时间',
  `t_end` int(10) unsigned default NULL COMMENT '付款时间',
  `status` enum('succ','failed','cancel','error','invalid','progress','timeout','ready') NOT NULL default 'ready' COMMENT '状态',
  `memo` longtext COMMENT '备注',
  `disabled` enum('true','false') default 'false',
  `trade_no` varchar(30) default NULL COMMENT '支付返回的序号',
  PRIMARY KEY  (`payment_id`),
  KEY `ind_disabled` (`disabled`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `w_payments`
--

INSERT INTO `w_payments` (`payment_id`, `order_id`, `order_sn`, `uid`, `account`, `bank`, `pay_account`, `currency`, `money`, `paycost`, `cur_money`, `pay_type`, `payment`, `paymethod`, `op_id`, `ip`, `t_begin`, `t_end`, `status`, `memo`, `disabled`, `trade_no`) VALUES
(7, 36, '20110509175228', 1, '', '', '', 'CNY', '40.000', NULL, '40.000', 'online', 0, NULL, NULL, NULL, 1306912166, 1306912166, 'succ', '', 'false', NULL),
(8, 35, '20110509174051', 1, '11', '11', '22', 'CNY', '40.000', NULL, '40.000', 'online', 0, NULL, NULL, NULL, 1306917182, 1306917182, 'succ', '', 'false', NULL),
(9, 33, '20110503113119', 1, '', '', '', 'CNY', '1586.000', NULL, '1586.000', 'online', 0, NULL, NULL, NULL, 1306920044, 1306920044, 'succ', '', 'false', NULL),
(10, 66, '20110610091703', 1, '', '', '', 'CNY', '784.000', NULL, '784.000', 'online', 0, NULL, NULL, NULL, 1307671304, 1307671304, 'succ', '', 'false', NULL),
(13, 63, '20110608160431', 1, '', '1111', '', 'CNY', '107.000', NULL, '107.000', 'online', 0, NULL, NULL, NULL, 1307673684, 1307673684, 'succ', '', 'false', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `w_plugins`
--

DROP TABLE IF EXISTS `w_plugins`;
CREATE TABLE IF NOT EXISTS `w_plugins` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `element` varchar(100) NOT NULL default '',
  `folder` varchar(100) NOT NULL default '',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `published` tinyint(3) NOT NULL default '0',
  `iscore` tinyint(3) NOT NULL default '0',
  `client_id` tinyint(3) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- 转存表中的数据 `w_plugins`
--

INSERT INTO `w_plugins` (`id`, `name`, `element`, `folder`, `access`, `ordering`, `published`, `iscore`, `client_id`, `checked_out`, `checked_out_time`, `params`) VALUES
(6, 'Search - Content', 'content', 'search', 0, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\nsearch_content=1\nsearch_uncategorised=1\nsearch_archived=1\n\n'),
(33, '财付通', 'tenpay', 'pay', 0, 7, 1, 1, 0, 0, '0000-00-00 00:00:00', 'accout=12341234\nkey=\nrates=\nlogo=/media/1/onlinepay_29[1].gif\ndesc=腾讯旗下在线支付平台，支持各大银行网上支付\n\n'),
(34, '快钱', '99bill', 'pay', 0, 1, 1, 0, 0, 0, '2009-07-31 15:27:02', 'accout=1234\nkey=\nrates=\nlogo=/media/1/onlinepay_7[1].gif\ndesc=快钱旗下在线支付平台，支持各大银行网上支付，还有手机支付\n\n'),
(36, 'Editor - FCKEditor', 'fckeditor', 'editors', 0, 4, 1, 0, 0, 0, '0000-00-00 00:00:00', 'theme=advanced\n'),
(37, 'wpagebreak', 'wpagebreak', 'content', 0, 3, 1, 0, 0, 0, '0000-00-00 00:00:00', 'enable=1\n\n'),
(38, '相关文章列表', 'related', 'content', 0, 6, 1, 0, 0, 0, '0000-00-00 00:00:00', 'count=12\n\n'),
(39, '文章天亿标志', 'articledaybillion', 'content', 0, 2, 1, 0, 0, 0, '0000-00-00 00:00:00', 'count=10\n\n'),
(40, 'ucenter for daybillion 会员同步接口', 'user_ucenter', 'authentication', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', 'uc_dbhost=localhost\nuc_dbuser=root\nuc_dbpw=test\nuc_dbname=test_dzhome\nuc_dbtablepre=uc_\nuc_key=123456\nuc_api=http://localhost:60001/ucenter\nuc_appid=3\nuc_client_php=home/uc_client/client.php\n\n'),
(41, 'Ucenter 会员登陆插件', 'ucenter', 'user', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(42, 'admincache', 'admincache', 'cache', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(1, '货到付款', 'money', 'pay', 0, 4, 1, 0, 0, 0, '0000-00-00 00:00:00', 'logo=\ndesc=货到付款，先验货再付款，安全放心！\n\n');

-- --------------------------------------------------------

--
-- 表的结构 `w_point_log`
--

DROP TABLE IF EXISTS `w_point_log`;
CREATE TABLE IF NOT EXISTS `w_point_log` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `related_id` mediumint(8) unsigned NOT NULL default '0' COMMENT '积分关联的ID',
  `points` mediumint(4) NOT NULL default '0',
  `note` varchar(50) default NULL,
  `created` int(10) unsigned NOT NULL default '0',
  `act_type` tinyint(2) unsigned NOT NULL default '0' COMMENT '积分类型',
  `uid` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `w_point_log`
--

INSERT INTO `w_point_log` (`id`, `related_id`, `points`, `note`, `created`, `act_type`, `uid`) VALUES
(1, 0, 23, 'asdfasdf', 0, 0, 109),
(2, 0, 213, 'asdfasdf', 0, 0, 109);

-- --------------------------------------------------------

--
-- 表的结构 `w_products`
--

DROP TABLE IF EXISTS `w_products`;
CREATE TABLE IF NOT EXISTS `w_products` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(60) NOT NULL COMMENT '产品名称',
  `introtext` mediumtext COMMENT '产品简介',
  `fulltext` text,
  `packaging` mediumtext COMMENT '包装清单',
  `model` varchar(200) default NULL COMMENT '产品详细信息',
  `shop_price` decimal(10,2) NOT NULL COMMENT '价格',
  `market_price` decimal(10,2) NOT NULL default '0.00' COMMENT '市场价',
  `weight` decimal(10,2) NOT NULL default '0.00' COMMENT '重量',
  `store` mediumint(8) NOT NULL default '0' COMMENT '库存',
  `sales` mediumint(8) unsigned NOT NULL default '0',
  `give_integral` mediumint(4) unsigned NOT NULL default '0',
  `market_time` date NOT NULL,
  `price_s` decimal(10,2) default NULL COMMENT '不低于的价格',
  `price_e` decimal(10,2) default NULL COMMENT '不高于的价格',
  `unit` varchar(10) default NULL COMMENT '价格单位',
  `isfront` tinyint(2) NOT NULL default '0' COMMENT '1为推荐到首页',
  `menuid` int(11) unsigned NOT NULL default '0' COMMENT '菜单及分类ID',
  `catid` int(11) NOT NULL default '0',
  `brand_id` mediumint(4) unsigned NOT NULL default '0',
  `created` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '创建时间',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '修改时间',
  `thumbnail` varchar(255) default NULL COMMENT '缩略图',
  `images` text NOT NULL COMMENT '产品图片',
  `brand` varchar(200) default NULL,
  `attribs` text NOT NULL COMMENT '相关属性',
  `specs` text COMMENT '相关规格信息',
  `ordering` int(11) NOT NULL default '0' COMMENT '排序值',
  `title` varchar(120) default NULL COMMENT 'seo标题',
  `metakey` text NOT NULL COMMENT '关键字',
  `metadesc` text NOT NULL COMMENT '描述',
  `access` tinyint(4) unsigned NOT NULL default '0' COMMENT '访问级别',
  `mini` int(11) default NULL COMMENT '最少批发数量',
  `hits` int(11) unsigned NOT NULL default '0' COMMENT '点击数',
  `uid` int(11) NOT NULL default '0' COMMENT '会员ID',
  `published` tinyint(1) NOT NULL default '0',
  `additional` varchar(255) default NULL COMMENT '产品相关图片',
  `star` tinyint(2) NOT NULL default '0' COMMENT '评价等级',
  `postnum` mediumint(4) NOT NULL default '0' COMMENT '评价人数',
  PRIMARY KEY  (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_catid` (`menuid`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

--
-- 转存表中的数据 `w_products`
--

INSERT INTO `w_products` (`id`, `name`, `introtext`, `fulltext`, `packaging`, `model`, `shop_price`, `market_price`, `weight`, `store`, `sales`, `give_integral`, `market_time`, `price_s`, `price_e`, `unit`, `isfront`, `menuid`, `catid`, `brand_id`, `created`, `modified`, `thumbnail`, `images`, `brand`, `attribs`, `specs`, `ordering`, `title`, `metakey`, `metadesc`, `access`, `mini`, `hits`, `uid`, `published`, `additional`, `star`, `postnum`) VALUES
(1, '格力 GCT-1900 电磁炉 火锅城专用 台嵌两用 单炉 全国联保 ', '', '<p>主要功能特点：</p>\r\n<p>◆ 复底强聚磁均磁线盘<br />\r\n◆ 外观设计简洁大方，台嵌两用专用火锅电磁炉<br />\r\n◆ 1900W高效火力，人多火更旺<br />\r\n◆ 线控操作随心所欲<br />\r\n◆ 法国技术防滑黑晶板、外观大方、耐磨、抗冲击、不变色<br />\r\n◆ 超宽工作电压<br />\r\n◆ 十种自动保护检测功能：过压/欠压/器件故障保护/过热/超时/超温 /延时散热保护/浪涌自动保护/无锅具检测/小物体检测/安全可靠 <br />\r\n<br />\r\n<font><font><font><font><font size="1"><font color="#000000"><font style="background-color: rgb(255, 255, 255);"><font size="1"><strong><font size="4">基本参数：</font></strong><span style="font-size: 15pt;"><br />\r\n<font size="4">额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：1900W<br />\r\n毛重：2.9KG</font></span></font></font></font></font></font></font></font></font></p>\r\n<p><img src="/media/1/products/T2liNxXfRXXXXXXXXX_!!423452989.jpg" alt="" /><br />\r\n<br />\r\n<img src="/media/1/products/T2lIxXXjdaXXXXXXXX_!!325409321.jpg" alt="" /><br />\r\n<br />\r\n<img src="/media/1/products/T23ZBXXadaXXXXXXXX_!!325409321.jpg" alt="" /></p>', '', 'GCT-1900', '124.52', '260.00', '0.00', 0, 0, 0, '0000-00-00', '201.00', '300.00', '', 0, 0, 1, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298357616_s.jpg', '/media/1/products/1298357616.jpg|1', '', '', NULL, 2, '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', 0, 0, 60, 1, 1, '', 0, 0),
(2, '格力电磁炉 GC-21600 朗钻黑晶板 全国联保 ', '', '<p>主要功能特点：<br />\r\n◆ 复底强聚磁均磁线盘<br />\r\n◆ RAINTRY朗钻黑晶板、外观大方、耐磨、抗冲击、不变色<br />\r\n◆ 火锅、煎炸、炒菜、煲汤、煲粥、蒸煮、童锁等七大功能<br />\r\n◆ 2600W超大功率、猛火爆炒、多档自由调节、美味随心<br />\r\n◆ 四位数码管、LED显示一目了然<br />\r\n◆ 高档优质微晶板、外观大方、柔美、耐磨、抗冲击、不变色 <br />\r\n◆ 24小时定时、24小时预约功能、控时精准、使用更方便 <br />\r\n◆ 特设童锁，人性化设计，多一份关心保护 <br />\r\n◆ 十种自动保护检测功能：过压/欠压/器件故障保护/过热/超时/超温/延时散热保护/浪涌自动保护/无锅具检测/小物体检测/安全可靠<br />\r\n<br />\r\n<img src="/media/1/products/GC-21600.jpg" alt="" /></p>', '', 'GC-21600', '854.85', '500.00', '0.00', 10, 0, 0, '0000-00-00', '300.00', '500.00', '', 0, 0, 1, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298358872_s.jpg', '/media/1/products/1298358872.jpg|1', '', '', NULL, 3, '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', 0, 0, 15, 1, 1, '', 0, 0),
(3, '格力 GC-2160 电磁炉 送汤锅+炒锅 含发票 全国联保 ', '', '<p>主要功能特点：</p>\r\n<p>◆ 复底强聚磁均磁线盘<br />\r\n◆ 法国技术彩晶透明板，时尚美观耐温高，高档耐用<br />\r\n◆ 创新性数码显示设定功率或温度，火力LED指示实际加热功率 <br />\r\n◆ 创新性各功能可定时可预约，烹饪更方便、更快捷<br />\r\n◆ 火锅、炒菜、温奶、煲汤、煲粥、蒸煮、定时、预约、火力调节九种智能厨艺功能<br />\r\n◆ 无锅自动保护，独到的防干烧保护<br />\r\n◆ 多种功能故障自动检测，电磁炉使用更安全<br />\r\n◆ 采用优质品牌微电脑控制芯片，更可靠，更省心<br />\r\n◆ 24小时定时、24小时预约功能<br />\r\n◆ 十种自动保护检测功能：过压/欠压/器件故障保护/过热/超时/超温/延时散热保护/浪涌自动保护/无锅具检测/小物体检测/安全可靠</p>\r\n<p><img alt="" src="/media/1/products/GC-2160.jpg" /><br />\r\n<br />\r\n<img alt="" src="/media/1/products/T2lIxXXjdaXXXXXXXX_!!325409321.jpg" /><br />\r\n<img alt="" src="/media/1/products/T2NsBXXcxaXXXXXXXX_!!325409321.jpg" /></p>', '', 'GC-2160', '900.72', '457.00', '0.00', 0, 0, 0, '0000-00-00', '400.00', '500.00', '', 0, 0, 1, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298359288_s.jpg', '/media/1/products/1298359288.jpg', '', '', NULL, 4, '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', 0, 0, 11, 1, 1, '', 0, 0),
(4, '格力 电磁炉 GC-2108 触摸面板 朗钻黑晶板 ', '', '<p><strong>主要功能特点：<br />\r\n</strong></p>\r\n<p>◆ 复底强聚磁均磁线盘<br />\r\n◆ RAINTRY朗钻黑晶板、外观大方、耐磨、抗冲击、不变色<br />\r\n◆ 火锅、温奶、爆炒、煲汤、煲粥、蒸煮、童锁等七大功能<br />\r\n◆ 2100W爆炒火力、多档自由调节、烹饪无限制<br />\r\n◆ 四位数码管、LED显示一目了然<br />\r\n◆ 纯平触摸式感应控制、时尚大方、舞动自由<br />\r\n◆ 自动卷线功能、无&ldquo;牵挂&rdquo;、方便省心<br />\r\n◆ 2小时定时、24小时预约功能、控时精准、使用更方便 <br />\r\n◆ 特设童锁，人性化设计，多一份关心保护 <br />\r\n◆ 十种自动保护检测功能：过压/欠压/器件故障保护/过热/超时/超温 /延时散热保护/浪涌自动保护/无锅具检测/小物体检测/安全可靠  <br />\r\n<br />\r\n<img src="/media/1/products/20095161211494295.jpg" alt="" /><br />\r\n<img src="/media/1/products/T2lIxXXjdaXXXXXXXX_!!325409321.jpg" alt="" /><br />\r\n<img src="/media/1/products/325409321.jpg" alt="" /></p>', '', 'GC-2108', '939.02', '439.00', '0.00', 30, 0, 0, '0000-00-00', '400.00', '500.00', '', 0, 0, 1, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298359962_s.jpg', '/media/1/products/1298359962.jpg|1', '', '', NULL, 5, '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', 0, 0, 21, 1, 1, '', 0, 0),
(5, '格力 GC-2106 电磁炉 送汤锅+炒锅 含机打发票，全国联保 ', '', '<p><strong>主要功能特点：<br />\r\n</strong></p>\r\n<p>◆ 复底强聚磁均磁线盘<br />\r\n◆ 四位数码显示，工作状态一目了然<br />\r\n◆ RAINTRY朗钻黑晶板、外观大方、耐磨、抗冲击、不变色 <br />\r\n◆ 2100W爆炒火力，爆炒随心所欲<br />\r\n◆ 面贴采用大按键，防滑凸点人性化设计 <br />\r\n◆ 爆炒、火锅、温奶、煲粥、蒸煮、煲汤、煎炸等七大功能<br />\r\n◆ 2小时定时、24小时预约功能，使用更方便<br />\r\n◆ 多重故障检知功能，使用更安全可靠<br />\r\n◆ 特设童锁，给您的孩子多一层保护<br />\r\n◆ 十种自动保护检测功能：过压/欠压/器件故障保护/过热/超时/超温<br />\r\n/延时散热保护/浪涌自动保护/无锅具检测/小物体检测/安全可靠 <br />\r\n<br />\r\n<img src="/media/1/products/T1fKFBXflnXXbVrwPa_091240.jpg_310x310.jpg" alt="" /><br />\r\n<img alt="" src="/media/1/products/T2lIxXXjdaXXXXXXXX_!!325409321.jpg" /><br />\r\n<img alt="" src="/media/1/products/325409321.jpg" /></p>', '', 'GC-2106', '992.94', '315.00', '50.00', 50, 0, 0, '0000-00-00', '300.00', '500.00', '', 0, 0, 1, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298360947_s.jpg', '/media/1/products/1298360947.jpg|1', '', '', NULL, 7, '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', 0, 0, 20, 1, 1, '', 0, 0),
(6, '格力电磁炉 GC-2091 黑色微晶面板 送汤锅 全国联保 ', '', '<p><strong><br />\r\n</strong><strong>GC-2091功能描述：</strong><br />\r\n<br />\r\n★耐高温、抗冲击、超大进口技术朗钻优质优质黑晶面板<br />\r\n★面贴采用大按键，防滑人性化设计<br />\r\n★多段火力调节，烹饪功能齐全<br />\r\n★多重故障检知保护功能，更安全可靠<br />\r\n★超宽电压110V～273V设计<br />\r\n★独特定温煎炸功能、炸出美味<br />\r\n★三级能效控制，用户烹饪更实惠,独特的风道设计,噪音低,带来优雅的烹饪环境<br />\r\n★人性化设计开机默认功率1200W、烹饪省心<br />\r\n★最低100W功率加热，思用户所需 <br />\r\n<br />\r\n<img alt="" src="/media/1/products/T1pdBBXlRBXXa5Rw33_050206.jpg_310x310.jpg" /><br />\r\n<img alt="" src="/media/1/products/T2lIxXXjdaXXXXXXXX_!!325409321.jpg" /><br />\r\n<img alt="" src="/media/1/products/325409321.jpg" /></p>', '', 'GC-2091', '147.65', '249.00', '0.00', 0, 0, 0, '0000-00-00', '200.00', '300.00', '', 0, 0, 1, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298361394_s.jpg', '/media/1/products/1298361394.jpg|1', '', '', NULL, 8, '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', 0, 0, 19, 1, 1, '', 0, 0),
(7, '格力GC-2172纯平板 触摸感应式电磁炉 送汤锅+炒锅 全国联保 ', '', '<p><strong><br />\r\n</strong><strong>GC-2172功能描述：</strong><br />\r\n<br />\r\n★功率2100W、三级能效控制，用户烹饪更实惠<br />\r\n★4位数码显示,工作状态一目了然<br />\r\n★采用进口技术朗钻优质防滑，耐高温,耐磨,抗冲击,不变色,外观大方的黑晶板<br />\r\n★煲汤,煲粥,爆炒,火锅等烹饪功能<br />\r\n★24小时定时,预约功能,控时精准,使用更方便<br />\r\n★童锁功能人性化设计,令家人倍感呵护；无锅自动保护，独特的防干烧保护<br />\r\n★采用优质品牌微电脑控制芯片,更可靠,更省心<br />\r\n★超宽电压110V～273V设计<br />\r\n★纯平触摸式整板感应控制，时尚大方<br />\r\n★独特的风道设计,噪音低,带来优雅的烹饪环境；400W-2100W功率可调，采用复底强聚磁磁线圈盘<br />\r\n★十重自动保护检测功能：过压/欠压/器件故障保护/过热/超时/超温/智能测温散热保护/浪涌自动保护/无锅具检测/小物体检测<br />\r\n<br />\r\n基本参数:<br />\r\n额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：2100W<br />\r\n毛重：5.96KG<br />\r\n<br />\r\n<img src="/media/1/products/T1rtFBXdFAXXciXhQ3_050305.jpg_310x310.jpg" alt="" /><br />\r\n<img alt="" src="/media/1/products/T2lIxXXjdaXXXXXXXX_!!325409321.jpg" /><br />\r\n<img alt="" src="/media/1/products/325409321.jpg" /></p>', '', 'GC-2172', '759.42', '288.00', '0.00', 0, 0, 0, '0000-00-00', '200.00', '300.00', '', 0, 0, 1, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298361969_s.jpg', '/media/1/products/1298361969.jpg|1', '', '', NULL, 9, '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', 0, 0, 28, 1, 1, '', 0, 0),
(8, '格力 GC-2105 朗钻黑晶板 电磁炉 全国联保 ', NULL, '<p>null</p>', '', 'GC-2105', '354.16', '459.00', '0.00', 0, 0, 0, '0000-00-00', '0.00', '0.00', '', 0, 0, 1, 0, '2011-04-20 00:00:00', '2011-04-26 10:42:50', '/media/1/products/1298362672_s.jpg', '/media/1/products/1298362671.jpg,/media/1/products/1298362672.jpg|1', '', 'a:2:{s:4:"attr";a:2:{i:1;a:1:{i:0;s:4:"5-6L";}i:2;a:1:{i:0;s:3:"60W";}}s:4:"aimg";N;}', 'a:0:{}', 6, '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', 0, 0, 31, 1, 1, '', 0, 0),
(9, '格力 GDF-502CB 格力 微电脑 电饭煲 GDF-302CB 正品全国联保 ', '', '<p>功能说明：<br />\r\n1、螺纹聚能式高效发热盘；<br />\r\n2、智能微电脑控制，超大液晶显示介面；<br />\r\n3、原生态精钢鼎不锈钢复合内锅，无涂层更健康，更多内锅任您选；<br />\r\n4、24小时定时预约，炊煮更方便；<br />\r\n5、特有停电记忆功能，炊煮更无忧；<br />\r\n6、蒸煮、炖汤、蛋糕、煲仔饭等多种炊煮方式；<br />\r\n7、IMD整体注塑豪华大面板，美观大方耐用；<br />\r\n8、创新保洁功能，防霉去异味；<br />\r\n9、彩色装饰板，外观清新靓丽；<br />\r\n10、特有易拆洗接水盒，清洁更方便；<br />\r\n11、特有易拆洗保温盖板，去除污渍更方便；<br />\r\n12、创新式小球微压蒸汽阀，有效防溢保湿。</p>\r\n<p>创新式小球微压蒸汽阀 有效防溢保湿 另外加送内锅一个，一锅双胆！</p>\r\n<p>&nbsp;</p>\r\n<p align="center"><img src="/media/1/products/GDF-302CB.jpg" alt="" /><br />\r\n<br />\r\n<br />\r\n<img src="/media/1/products/GDF-302CB-4.jpg" alt="" /><br />\r\n<img src="/media/1/products/GDF-302CB-2.jpg" alt="" /><br />\r\n<br />\r\n<br />\r\n<img src="/media/1/products/GDF-302CB-3.jpg" alt="" /></p>', '', 'GDF-302CB', '492.53', '510.00', '0.00', 0, 0, 0, '0000-00-00', '250.00', '600.00', '', 0, 0, 2, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298364741_s.jpg', '/media/1/products/1298364741.jpg|1,/media/1/products/1298364744.jpg,/media/1/products/1298364780.jpg,/media/1/products/1298365034.jpg', '', '', NULL, 10, '', '', '', 0, 0, 134, 1, 1, '', 0, 0),
(10, '格力 GDF-502CB 格力 微电脑 电饭煲 GDF-302CB 正品全国联保 ', '', '<p>功能说明：<br />\r\n1、螺纹聚能式高效发热盘；<br />\r\n2、智能微电脑控制，超大液晶显示介面；<br />\r\n3、原生态精钢鼎不锈钢复合内锅，无涂层更健康，更多内锅任您选；<br />\r\n4、24小时定时预约，炊煮更方便；<br />\r\n5、特有停电记忆功能，炊煮更无忧；<br />\r\n6、蒸煮、炖汤、蛋糕、煲仔饭等多种炊煮方式；<br />\r\n7、IMD整体注塑豪华大面板，美观大方耐用；<br />\r\n8、创新保洁功能，防霉去异味；<br />\r\n9、彩色装饰板，外观清新靓丽；<br />\r\n10、特有易拆洗接水盒，清洁更方便；<br />\r\n11、特有易拆洗保温盖板，去除污渍更方便；<br />\r\n12、创新式小球微压蒸汽阀，有效防溢保湿。</p>\r\n<p>创新式小球微压蒸汽阀 有效防溢保湿 另外加送内锅一个，一锅双胆！</p>\r\n<p>&nbsp;</p>\r\n<p align="center"><img src="/media/1/products/GDF-302CB.jpg" alt="" /><br />\r\n<br />\r\n<br />\r\n<img src="/media/1/products/GDF-302CB-4.jpg" alt="" /><br />\r\n<img src="/media/1/products/GDF-302CB-2.jpg" alt="" /><br />\r\n<br />\r\n<br />\r\n<img src="/media/1/products/GDF-302CB-3.jpg" alt="" /></p>', '', 'GDF-402CB', '400.17', '510.00', '0.00', 0, 0, 0, '0000-00-00', '300.00', '600.00', '', 0, 0, 2, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298364741_s.jpg', '/media/1/products/1298364741.jpg|1,/media/1/products/1298364744.jpg,/media/1/products/1298364780.jpg,/media/1/products/1298365034.jpg', '', '', NULL, 11, '', '', '', 0, 0, 32, 1, 1, '', 0, 0),
(11, '格力电饭煲 GD-3016 饭粥两用全国正品 新一代节能产品', NULL, '<p>功能说明：<br />\r\n1、螺纹聚能式高效发热盘；<br />\r\n2、智能微电脑控制，超大液晶显示介面；<br />\r\n3、原生态精钢鼎不锈钢复合内锅，无涂层更健康，更多内锅任您选；<br />\r\n4、24小时定时预约，炊煮更方便；<br />\r\n5、特有停电记忆功能，炊煮更无忧；<br />\r\n6、蒸煮、炖汤、蛋糕、煲仔饭等多种炊煮方式；<br />\r\n7、IMD整体注塑豪华大面板，美观大方耐用；<br />\r\n8、创新保洁功能，防霉去异味；<br />\r\n9、彩色装饰板，外观清新靓丽；<br />\r\n10、特有易拆洗接水盒，清洁更方便；<br />\r\n11、特有易拆洗保温盖板，去除污渍更方便；<br />\r\n12、创新式小球微压蒸汽阀，有效防溢保湿。</p>\r\n<p>创新式小球微压蒸汽阀 有效防溢保湿 另外加送内锅一个，一锅双胆！</p>\r\n<p>&nbsp;</p>\r\n<p align="center"><img src="/media/1/products/GDF-302CB.jpg" alt="" /><br />\r\n<br />\r\n<br />\r\n<img src="/media/1/products/GDF-302CB-4.jpg" alt="" /><br />\r\n<img src="/media/1/products/GDF-302CB-2.jpg" alt="" /><br />\r\n<br />\r\n<br />\r\n<img src="/media/1/products/GDF-302CB-3.jpg" alt="" /></p>', '', 'GDF-502CB', '523.26', '600.00', '0.00', 0, 0, 0, '0000-00-00', '0.00', '0.00', '', 0, 0, 2, 0, '2011-04-20 00:00:00', '2011-04-15 14:51:39', '/media/1/products/1298364741_s.jpg', '/media/1/products/1298364741.jpg|1,/media/1/products/1298364780.jpg,/media/1/products/1298365034.jpg,/media/1/products/1298366416.jpg', '', 'a:2:{s:4:"attr";a:0:{}s:4:"aimg";N;}', 'a:0:{}', 12, '', '', '', 0, 0, 179, 1, 1, '', 0, 0),
(12, '格力 GDF-302DB 微电脑式 电饭煲 ', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n1、螺纹聚能式高效发热盘；<br />\r\n2、智能微电脑控制，高级LED显示界面；<br />\r\n3、2.0mm超厚黑金刚内锅，美国华福健康耐磨不粘涂层；<br />\r\n4、15小时定时预约，炊煮更方便；<br />\r\n5、特有停电记忆功能，炊煮更方便；<br />\r\n6、蒸煮、超快煮、煲仔饭等多种炊煮方式；<br />\r\n7、IMD整体注塑豪华大面板，美观大方耐用；<br />\r\n8、创新保洁功能，防霉去异味；<br />\r\n9、彩色装饰板，外观清新靓丽；<br />\r\n10、特有易拆洗接水盒，清洁更方便；<br />\r\n11、特有易拆洗保温盖板，彻底去除污渍；<br />\r\n12、创新式小球微压蒸汽阀，有效防溢保湿。<br />\r\n<br />\r\n<img alt="" src="/media/1/products/GDF-302Db.jpg" /></p>', '', 'GDF-302DB', '415.80', '235.00', '0.00', 0, 0, 0, '0000-00-00', '200.00', '300.00', '', 0, 0, 2, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298367126_s.jpg', '/media/1/products/1298367126.jpg|1', '', '', NULL, 13, '', '', '', 0, 0, 49, 1, 1, '', 0, 0),
(13, '格力电饭煲 GD-3016全新正品 ', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n1、优质聚能发热盘，实现快速烹煮；<br />\r\n2、1.0mm新一代高强度合金内锅，美国华福健康耐磨不粘涂层；<br />\r\n3、创新焖烧保温功能，营养丰富；<br />\r\n4、全新晶格防凝露保温座板；<br />\r\n5、自动限温，更安全、更省心。 <br />\r\n<br />\r\n<img alt="" src="/media/1/products/GD-3016-2.jpg" /></p>', '', 'GD-3016', '509.22', '125.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 2, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298368041_s.jpg', '/media/1/products/1298368041.jpg|1', '', '', NULL, 14, '', '', '', 0, 0, 30, 1, 1, '', 0, 0),
(14, '格力电饭煲 GD-161A 格力的品质您放心 ', '', '<p>主要功能特点：<br />\r\n1.6升，功率：400W，适合1-4人；<br />\r\n1.0mm 新一代高强度不粘涂层合金铝内锅；<br />\r\n特有气泡型内盖板，加热均匀，有效保鲜防凝露。<br />\r\n创新防凝露保温盖板，<br />\r\n小巧玲珑人见人爱。<br />\r\n&nbsp;</p>\r\n<p><img alt="" src="/media/1/products/GD-161A.jpg" /></p>', '', 'GD-161A', '298.70', '147.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 2, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298427928_s.jpg', '/media/1/products/1298427928.jpg|1', '', '', NULL, 17, '', '', '', 0, 0, 10, 1, 1, '', 0, 0),
(15, '格力电饭煲 GD-305A(3L) 机械式电饭煲 ', '', '<p>主要功能特点：<br />\r\n<br />\r\n1、 螺纹聚能式高效发热盘；<br />\r\n2、 1.0mm高强度合金铝内锅，美国华福健康耐磨不粘涂层；<br />\r\n3、 煮饭保温，自动切换；<br />\r\n4、 一体化顶盖，全新保温效果；<br />\r\n5、 安全防漏电底座。 <br />\r\n<br />\r\n&nbsp;</p>\r\n<p><img alt="" src="/media/1/products/GD-305A.jpg" /></p>', '', 'GD-305A', '965.82', '118.00', '0.00', 0, 0, 0, '0000-00-00', '60.00', '200.00', '', 0, 0, 2, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298424885_s.jpg', '/media/1/products/1298424885.jpg|1', '', '', NULL, 15, '', '', '', 0, 0, 16, 1, 1, '', 0, 0),
(16, '格力 GD-305Z 电饭煲 3升 煮饭煲粥两用 新一代节能 ', '', '<p>主要功能特点：<br />\r\n1、 螺纹聚能式高效发热盘；<br />\r\n2、 1.0mm高强度合金铝内锅，美国华福健康耐磨不粘涂层；<br />\r\n3、 煮饭煮粥双重功能选择；<br />\r\n4、 一体化顶盖，全新保温效果；<br />\r\n5、 安全防漏电底座。<br />\r\n&nbsp;</p>\r\n<p><img alt="" src="/media/1/products/GD-305Z-6.jpg" />&nbsp;&nbsp; &nbsp;&nbsp;<img alt="" src="/media/1/products/GD-305Z-3.jpg" /><br />\r\n<br />\r\n<img alt="" src="/media/1/products/GD-305Z-4.jpg" />&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;<img alt="" src="/media/1/products/GD-305Z-2.jpg" /><br />\r\n<br />\r\n<img alt="" src="/media/1/products/GD-305Z-5.jpg" /></p>', '', 'GD-305Z', '933.02', '168.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 2, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298427264_s.jpg', '/media/1/products/1298427197.jpg,/media/1/products/1298427198.jpg,/media/1/products/1298427199.jpg,/media/1/products/1298427264.jpg|1', '', '', NULL, 16, '', '', '', 0, 0, 12, 1, 1, '', 0, 0),
(17, '格力电饭煲 GD-303A 新品上市 ', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n1、首创&ldquo;省电精煮&rdquo;和&ldquo;省时快煮&rdquo;两种模式，节能又省心<br />\r\n2、螺纹聚能式高效发热盘<br />\r\n3、一体式气辅注塑增强性上盖厚达6.0mm, 耐温耐压不变形<br />\r\n4、创新小球式微压力蒸汽阀, 防溢有新招<br />\r\n5、点阵式防疑露保温座板, 水滴难烂饭<br />\r\n6、煮饭煮粥双重功能选择<br />\r\n7、2.0mm黑厚金刚内锅, 硬质氧化表面超级耐磨, 美国华福健康不粘涂层<br />\r\n<br />\r\n<strong>基本参数：</strong><br />\r\n额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：500W</p>\r\n<p>&nbsp;</p>\r\n<p><strong>保修政策：</strong><br />\r\n1、整机包修一年<br />\r\n2、产品附件包修期：购买产品赠送的附件，包修三个月<br />\r\n3、下列情况不属于包修服务范围，但可实行收费维修<br />\r\n（1）消费者因使用、维护、保管不当及不可抗拒力造成损坏的。<br />\r\n（2）非格力特约服务网点拆动、修理造成损坏的（包括消费者自动拆动、修理）。<br />\r\n（3）无有效凭证及购机凭证型号与修理产品型号不符的。<br />\r\n（4）工厂或经销单位已注明作降价处理的&ldquo;处理品&rdquo;、&ldquo;特价品&rdquo;以及已超过包修期的产品。<br />\r\n（5）由于电源电压不稳定及超出正常电压范围或电源线路安装不符合国家电气安装要求而造成产品损坏的。<br />\r\n4、包修期界定：以开具发票（或有效售货凭证的）时间开始进行计算；没有的，以出厂日期顺延三个月为包修期起算时间。<br />\r\n<br />\r\n<strong>包换政策：</strong><br />\r\n包修有效期内，符合下列条件，而且用户拒绝维修的，可以换机。换机后的三包有效期自换机之日起重新计算<br />\r\n1、产品自售出之日起15日内，发生主要性能故障，不能正常使用；<br />\r\n2、主要性能故障连续修理二次，仍不能正常使用的；<br />\r\n3、自用户送修之日起因厂家原因超过30日（国家规定为90天）未能修复的；<br />\r\n4、因修理者自身原因使修理超过30日的，由其免费为消费者调换同型号同规格的产品，费用由修理者承担；<br />\r\n5、对有争议的，经销售公司及办事处售后经理核准的；<br />\r\n6、换货只换主机，其他附件、赠品和包装不在换货范围之内；<br />\r\n<br />\r\n<strong>包退政策：</strong><br />\r\n包修有效期内，符合下列条件，且用户拒绝维修或换机的，可以退机；<br />\r\n1、产品自售出之日起7日内，发生主要性能故障，不能正常使用的；<br />\r\n2、主要性能连续二次以上无法修复，用户坚持退机的；<br />\r\n3、对有争议，情况特殊的，经销售公司及办事处售后经理核准的。<br />\r\n<br />\r\n备注<br />\r\n1、国家&ldquo;三包&rdquo;政策仅适用于产品本身质量问题；由于火灾、地震等不可抗拒因素及其他人为因素而造成的产品损坏或使用 不满意等均不属于三包处理范围；<br />\r\n2、赠品：享受同等的三包服务政策。购买其它商品赠送格力小家电产品的，以相关商品的有效购买单据出据日为三包计算起止 日，具体机型以单据上注明的小家电赠品名称、型号规格、数量为依据。</p>', '', 'GD-303A', '767.64', '119.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 2, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298428582_s.jpg', '/media/1/products/1298428582.jpg|1', '', '', NULL, 19, '', '', '', 0, 0, 10, 1, 1, '', 0, 0),
(18, '格力电饭堡 GD-301D 3L节能电脑电饭煲 卓越品质 ', '', '<p>主要功能特点：<br/>\r\n\r\n功率：3L/500W、4L/650W、5L/650W；<br/>\r\n国家节能认证，行业领先；<br/>\r\n创新防凝露保温盖板；<br/>\r\n新AI智能微电脑控制，智能煮饭全过程；<br/>\r\n蓝色液晶显示，界面一目了然；<br/>\r\n24小时预约定时功能，炊煮更方便；<br/>\r\n特有中间吸水，新鲜保温功能； <br/>\r\n创新焖烧，营养丰富；<br/>\r\n新一代环保太空节能保温技术，省电更多；<br/>\r\n2.0mm 新一代高强度不粘涂层合金铝内锅；<br/>\r\n大直径优质加热盘，快速烹煮，省时省电。<br/><br/>\r\n</p>', '', 'GD-301D', '39.13', '350.00', '0.00', 0, 0, 0, '0000-00-00', '200.00', '500.00', '', 0, 0, 2, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298429771_s.jpg', '/media/1/products/1298429771.jpg|1', '', '', NULL, 20, '', '', '', 0, 0, 10, 1, 1, '', 0, 0),
(19, '格力 GDF-401DA 微电脑电饭煲(4L) 液晶显示 ', '', '<p><strong>主要功能特点： </strong><br />\r\n<br />\r\n4升，功率：750W，适合3-9人；<br />\r\n新AI智能微电脑控制，智能煮饭全过程；<br />\r\n2.0mm双面喷涂, 新一代高强度不粘涂层合金铝内锅；<br />\r\nIMD大面板设计，界面一目了然；<br />\r\n特有可拆保湿防溢阀，防止溢出，保湿效果好等；<br />\r\n独创鲜美保温模式，保温时充分保留米饭水份，防止细菌滋生；<br />\r\n三维立体加热功能，加热均匀；<br />\r\n24小时预约定时功能，炊煮更方便 ；<br />\r\n特设停电两小时记忆功能，停电重新启动时，设定照样生效；<br />\r\n创新防凝露保温座板。<br />\r\n&nbsp;</p>\r\n<p>&nbsp; <img alt="" src="/media/1/products/GDF-401DA-3.jpg" /><br />\r\n<br />\r\n<img alt="" src="/media/1/products/GDF-401DA-4.jpg" /></p>', '', 'GDF-401DA', '892.72', '620.00', '0.00', 0, 0, 0, '0000-00-00', '500.00', '800.00', '', 0, 0, 2, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298430619_s.jpg', '/media/1/products/1298430619.jpg|1,/media/1/products/1298430629.jpg,/media/1/products/1298430639.jpg', '', '', NULL, 21, '', '', '', 0, 0, 10, 1, 1, '', 0, 0),
(20, '格力电饭煲 GD-308Z 雅香煲 ', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n1、气辅注塑增强型面盖<br />\r\n2、三维立体测温加热<br />\r\n3、微动轴承控温<br />\r\n4、螺纹聚能式发热盘<br />\r\n5、小球式微压力大蒸汽阀<br />\r\n6、煮粥、煮饭随意选<br />\r\n<br />\r\n<br />\r\n<img src="/media/1/products/GD-308Z-2.jpg" alt="" /></p>', '', 'GD-308Z', '346.24', '219.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '300.00', '', 0, 0, 2, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298431240_s.jpg', '/media/1/products/1298431240.jpg|1', '', '', NULL, 22, '', '', '', 0, 0, 37, 1, 1, '', 0, 0),
(21, '格力电饭煲 GD-306 机械式 3L ', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n1、微动轴承控温技术<br />\r\n2、气辅注塑增强型面盖<br />\r\n3、双电热管发热<br />\r\n4、螺纹聚能式发热盘<br />\r\n5、创新小球微压蒸汽阀<br />\r\n6、外形秀丽清雅<br />\r\n7、具备煮粥功能<br />\r\n&nbsp;</p>\r\n<p><strong>基本参数：</strong><br />\r\n额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：500W<br />\r\n毛重：3.3KG<br />\r\n<br />\r\n<img src="/media/1/products/GD-306Z-4.jpg" alt="" /><br />\r\n<br />\r\n<img src="/media/1/products/GD-306Z-5.jpg" alt="" /><br />\r\n<br />\r\n<img src="/media/1/products/GD-306Z-3.jpg" alt="" /><br />\r\n<br />\r\n<img src="/media/1/products/GD-306Z-2.jpg" alt="" /><br />\r\n<br />\r\n<img src="/media/1/products/GD-306Z-6.jpg" alt="" /></p>', '', 'GD-306', '53.02', '120.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 2, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298432208_s.jpg', '/media/1/products/1298432208.jpg|1,/media/1/products/1298432222.jpg,/media/1/products/1298432231.jpg', '', '', NULL, 23, '', '', '', 0, 0, 11, 1, 1, '', 0, 0),
(22, '格力电饭煲 GDF-302DA 全新正品 电脑煲 ', NULL, '<p>1、螺纹聚能式高效率发热盘，发热迅速均匀，炊煮就是快<br />\r\n2、电子控制，高级LED显示界面<br />\r\n3.、超厚黑金刚内锅，华福健康不粘涂层超级耐磨<br />\r\n<br />\r\n4、15小时定时预约，炊煮更方便 <br />\r\n5、特有停电记忆功能，炊煮更无忧 6、蒸煮、超快煮、煲仔饭等炊煮方式<br />\r\n7、创新保洁功能，防霉去异味<br />\r\n8、彩色装饰板，外观清新靓丽 <br />\r\n9、特有易拆洗接水盒，清洁更方便<br />\r\n10、特有易拆洗保温盖板，彻底去除污渍<br />\r\n11、创新式小球微压蒸汽阀，有效防溢保湿<br />\r\n<br />\r\n注：不同的产品，可能有所区别！</p>\r\n<p><img alt="" src="/media/1/products/GD-306Z-6.jpg" /></p>', '', 'GDF-302DA', '226.38', '190.00', '0.00', 0, 0, 0, '0000-00-00', '0.00', '0.00', '', 0, 0, 2, 0, '2011-04-20 00:00:00', '2011-06-07 14:47:37', '/media/1/products/200/1298432807_s.jpg', '/media/1/products/200/1298432807.jpg|1', '', 'a:2:{s:4:"attr";a:2:{i:1;a:1:{i:0;s:4:"3-4L";}i:2;a:1:{i:0;s:3:"60W";}}s:4:"aimg";N;}', 'a:0:{}', 24, '', '', '', 0, 0, 22, 1, 1, '', 0, 0),
(23, '格力电风扇FSLD-40 扇头360°循环送风 低压启动 优质材料 ', '', '<p><strong><br />\r\n<br />\r\n产品简介：</strong><br />\r\n<br />\r\n美国普马威克电机润滑油；<br />\r\n采用科学工艺，精工细作；<br />\r\n优质机身塑料材料；<br />\r\n优越的低压启动性能；<br />\r\n3片PP透明强韧风叶；<br />\r\n摇头360度循环送风；<br />\r\n强，中，弱三档风速调节；<br />\r\n强劲电机，超低噪音</p>', '', 'FSLD-40', '972.86', '169.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 3, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298441497_s.jpg', '/media/1/products/1298441497.jpg,/media/1/products/1298441498.jpg,/media/1/products/1298441606.jpg|1', '', '', NULL, 25, '', '', '', 0, 0, 28, 1, 1, '', 0, 0),
(24, '格力电风扇FSJ-1801 密集安全网强韧风叶 强劲电机 安全实用 ', '', '<p><strong>产品特点：</strong><br />\r\n<br />\r\n.  时尚外观设计<br />\r\n.  强，弱两档风速可调<br />\r\n.  360度旋转功能，密集安全网<br />\r\n.  3片强韧PP风叶，送风柔和<br />\r\n.  扇头俯仰角自由调节，水平摇头送风<br />\r\n.  清新绿色风格外型小巧使用方便<br />\r\n.  强劲电机：优越的低压启动性能<br />\r\n.  美国普马威电机润滑油<br />\r\n<br />\r\n<img src="/media/1/products/FSJ-1801-2.jpg" alt="" /></p>', '', 'FSJ-1801 ', '185.14', '99.00', '0.00', 0, 0, 0, '0000-00-00', '50.00', '100.00', '', 0, 0, 3, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298436490_s.jpg', '/media/1/products/1298436490.jpg|1', '', '', NULL, 26, '', '', '', 0, 0, 41, 1, 1, '', 0, 0),
(25, '格力电风扇FSJ-1802 迷你 学生扇 摇头台夹两用扇 ', '', '<p>主要功能特点：\r\n<br/>\r\n时尚外观设计，磨砂装饰底盘<br/>\r\n强、弱二档风速可调<br/>\r\n360度旋转功能，密集安全网<br/>\r\n3片强韧PP风叶，送风柔和<br/>\r\n扇头俯仰角自由调节，水平摇头送风<br/>\r\n清新绿色外型小巧使用方便<br/>\r\n强劲电机，优越的低压启动性能<br/>\r\n美国普马威克电机润滑油<br/><br/>\r\n\r\n</p>\r\n', '', 'FSJ-1802', '7.11', '90.00', '0.00', 0, 0, 0, '0000-00-00', '50.00', '100.00', '', 0, 0, 3, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298440635_s.jpg', '/media/1/products/1298440635.jpg|1', '', '', NULL, 27, '', '', '', 0, 0, 367, 1, 1, '', 2, 3),
(26, '格力电风扇 FB-40B1 转页扇 超静音壁扇 ', '', '<p><strong>主要功能特点：</strong> <br />\r\n<br />\r\n1.全功能红外摇控；微电脑智能化程序控制<br />\r\n2.强、中、弱三档风速调节<br />\r\n3.优质机身塑料材料<br />\r\n4.优越的低压启动性能<br />\r\n5.强劲电机，超低噪音<br />\r\n7.5小时定时关机<br />\r\n8.扇头俯仰角手动调节<br />\r\n9.水平摇头送风<br />\r\n<br />\r\n<strong>基本参数：</strong><br />\r\n额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：55W<br />\r\n毛重：3.9KG<br />\r\n净重：2.8KG<br />\r\n<br />\r\n<img src="/media/1/products/FB-40B1-3.jpg" alt="" /><br />\r\n&nbsp;</p>', '', 'FB-40B1', '480.13', '168.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 3, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298442503_s.jpg', '/media/1/products/1298442503.jpg|1,/media/1/products/1298442503-1.jpg', '', '', NULL, 28, '', '', '', 0, 0, 11, 1, 1, '', 0, 0),
(27, '格力电风扇 KYTF-25 转页扇正品电风扇 台扇 ', '', '<p>★时尚外观设计，双拉线控制；<br />\r\n★强、中、弱三档风速可调；<br />\r\n★扇头俯仰角手动调节；<br />\r\n★3片强韧PP风叶；<br />\r\n★水平摇头送风；<br />\r\n★清新风格印花装饰板；<br />\r\n★强劲电机；优越的低压启动性能；<br />\r\n★美国普马威克电机润滑油；<br />\r\n(具体商品以实物为准，以上图片仅供参考)。<br />\r\n<br />\r\n功率(W): 55<br />\r\n扇页直径(mm): 400<br />\r\n净重(kg): 2.9<br />\r\n毛重(kg): 3.75<br />\r\n包装尺寸(mm)： 465*235*458<br />\r\n外包装材料：单瓦楞纸</p>\r\n<p>&nbsp;</p>\r\n<p align="center"><img alt="" src="/media/1/products/KYTF-25-2.jpg" /><br />\r\n<img alt="" src="/media/1/products/KYTF-25-4.jpg" /><br />\r\n<img alt="" src="/media/1/products/KYTF-25-7.jpg" /><br />\r\n<img alt="" src="/media/1/products/KYTF-25-5.jpg" /><br />\r\n<br />\r\n<img alt="" src="/media/1/products/KYTF-25-6.jpg" /></p>', '', 'KYTF-25', '379.34', '75.00', '0.00', 0, 0, 0, '0000-00-00', '50.00', '100.00', '', 0, 0, 3, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298443614_s.jpg', '/media/1/products/1298443611.jpg,/media/1/products/1298443612.jpg,/media/1/products/1298443612-1.jpg,/media/1/products/1298443613.jpg,/media/1/products/1298443614.jpg|1', '', '', NULL, 29, '', '', '', 0, 0, 9, 1, 1, '', 0, 0),
(28, '格力电风扇 KYTJ-30 台式扇 转页扇 有定时功能风扇 ', '', '<p>总高44CM  宽37.5CM 厚5.2CM  <br />\r\n额定电压220V <br />\r\n额定频率50HZ <br />\r\n额定功率50W <br />\r\n使用值0.8m&sup3;/min*W  扇叶直径30CM<br />\r\n噪音值（声功率级）：56dB（A)<br />\r\n彩盒<br />\r\n毛重2.7KG 净重2.3KG <br />\r\n可拆洗后网结构<br />\r\n*120分钟定时选择<br />\r\n*强中弱三档风速调节<br />\r\n<img alt="" src="/media/1/products/KYTJ-30-6.jpg" /><br />\r\n<img alt="" src="/media/1/products/KYTJ-30-2.jpg" /><img alt="" src="/media/1/products/KYTJ-30-3.jpg" /><img alt="" src="/media/1/products/KYTJ-30-7.jpg" /></p>', '', 'KYTJ-30', '456.30', '108.00', '0.00', 0, 0, 0, '0000-00-00', '50.00', '200.00', '', 0, 0, 3, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298444610_s.jpg', '/media/1/products/1298444609.jpg,/media/1/products/1298444610.jpg|1,/media/1/products/1298444610-1.jpg,/media/1/products/1298444611.jpg', '', '', NULL, 30, '', '', '', 0, 0, 16, 1, 1, '', 0, 0),
(29, '格力电风扇 KYTB-25 台式转页扇 日月造型 正品特价 ', '', '<p>功能介绍：<br />\r\n★日月造型，台、壁两用<br />\r\n★强/中/弱三档风速可调<br />\r\n★跌倒自停，安全可靠<br />\r\n★扇头俯仰角自由调节<br />\r\n★120分钟定时关机；5片强韧PP风叶<br />\r\n★强劲电机,优越的低压启动性能<br />\r\n★美国普马威克电机润滑油<br />\r\n<br />\r\n型号：KYTB-25(黄）<br />\r\n电源：220V/50HZ<br />\r\n额定功率：45W<br />\r\n风叶直径：250(mm)<br />\r\n毛重：2.3KG<br />\r\n外包装尺寸：367*160*365(mm)<br />\r\n<br />\r\n<img src="/media/1/products/KYTB-25-5.jpg" alt="" /><img src="/media/1/products/KYTB-25-4.jpg" alt="" /><br />\r\n<img src="/media/1/products/KYTB-25-2.jpg" alt="" /></p>', '', 'KYTB-25', '143.49', '145.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 3, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298445546_s.jpg', '/media/1/products/1298445545.jpg,/media/1/products/1298445545-1.jpg,/media/1/products/1298445546.jpg|1,/media/1/products/1298445547.jpg', '', '', NULL, 31, '', '', '', 0, 0, 60, 1, 1, '', 0, 0),
(30, '格力电风扇 FSW-30BC 平薄系列 遥控 落地扇 轴承电机 全国联保 ', '', '<p><strong>型号: FSW-30Bc 台地扇</strong><br />\r\n<br />\r\n★全功能红外遥控，特有一键关灯功能<br />\r\n★特有平背式机头设计，机身更纤细更省空间<br />\r\n★优质滚珠轴承电机，性能更卓越<br />\r\n★豪华大屏幕数码显示<br />\r\n★8小定时关机/8小时预约开机<br />\r\n★强/中/弱/柔四档风速可调<br />\r\n★普通风/睡眠风/自然风三种模式可选<br />\r\n★5片AS风叶，送风柔和；双色装饰板<br />\r\n★特设锁扣式网罩圈，方便拆洗<br />\r\n★优越的低压启动性能<br />\r\n★美国普马威克电机润滑油<br />\r\n<br />\r\n★柔风档适合老人儿童使用<br />\r\n(具体商品以实物为准，以上图片仅供参考)。<br />\r\n<br />\r\n功率(W): 40<br />\r\n扇页直径(mm): 300<br />\r\n净重(kg): 3.8<br />\r\n毛重(kg): 5<br />\r\n包装尺寸(mm)： 708*212*425<br />\r\n外包装材料：单瓦楞纸<br />\r\n<br />\r\n<img alt="" src="/media/1/products/FSW-30Bc-2.jpg" /><br />\r\n<img alt="" src="/media/1/products/FSW-30Bc-3.jpg" /></p>', '', 'FSW-30BC', '348.53', '349.00', '0.00', 0, 0, 0, '0000-00-00', '300.00', '500.00', '', 0, 0, 3, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298446297_s.jpg', '/media/1/products/1298446296.jpg,/media/1/products/1298446297.jpg|1,/media/1/products/1298446297-1.jpg', '', '', NULL, 32, '', '', '', 0, 0, 13, 1, 1, '', 0, 0),
(31, '格力电风扇 FSO-30 落地扇 台立两用 ', '', '<p><strong>产品概述：</strong><br />\r\n<br />\r\n1、4S高效电机，劲风、静音、耐用<br />\r\n2、强、中、弱三档风速可调<br />\r\n3、5片强韧PP风叶，送风柔和<br />\r\n4、水平摇头送风，扇头自由升降<br />\r\n5、优越的低压启动性能<br />\r\n6、120分钟定时关机<br />\r\n7、美国普马威克电机润滑油<br />\r\n<br />\r\n<strong>产品参数：</strong><br />\r\n<br />\r\n扇页直径(CM)：30<br />\r\n额定电压：220V      <br />\r\n额定频率：55W    <br />\r\n包装尺寸(MM)：585*198*425<br />\r\n<br />\r\n<img src="/media/1/products/FSO-30-2.jpg" alt="" /></p>', '', 'FSO-30', '312.19', '182.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 3, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298446735_s.jpg', '/media/1/products/1298446735.jpg|1', '', '', NULL, 33, '', '', '', 0, 0, 8, 1, 1, '', 0, 0),
(32, '格力电风扇 FDK-40 机械式落地扇 畅销型号 ', '', '<p>格力落地扇（扇叶直径：16寸）<br />\r\n<br />\r\n主要功能特点：<br />\r\n1、强、中、弱三档一键通实现风速调节<br />\r\n2、外形简洁和精致<br />\r\n3、扇头俯仰角自由调节<br />\r\n4、水平摇头送风<br />\r\n5、扇头自由升降<br />\r\n基本参数:<br />\r\n额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：55W<br />\r\n毛重：6.7KG<br />\r\n净重：5.7KG<br />\r\n<img src="/media/1/products/FDK-40-3.jpg" alt="" /></p>', '', 'FDK-40', '515.35', '118.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 3, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298447321_s.jpg', '/media/1/products/1298447321.jpg|1', '', '', NULL, 34, '', '', '', 0, 0, 14, 1, 1, '', 0, 0),
(33, '格力遥控落地 电风扇 FSD-40B 直径40CM ', NULL, '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n强中弱三档风速可调<br />\r\n优越的低压启动性能<br />\r\n强劲电机，超低噪音<br />\r\n扇头俯仰角自由调节<br />\r\n水平摇头送风<br />\r\n扇头自由升降<br />\r\n120分钟小时定时关机<br />\r\n<br />\r\n<img alt="" src="/media/1/products/FSD-40B-2.jpg" /><br />\r\n<img alt="" src="/media/1/products/FSD-40B-4.jpg" /><br />\r\n<img alt="" src="/media/1/products/FSD-40B-5.jpg" /></p>', '', 'FSD-40B', '640.19', '199.00', '0.00', 0, 0, 0, '2011-06-07', '0.00', '0.00', '', 0, 0, 3, 0, '2011-04-20 00:00:00', '2011-06-10 17:06:47', '/media/1/products/200/1298448079_s.jpg', '/media/1/products/200/1298448079.jpg|1', '', 'a:2:{s:4:"attr";a:0:{}s:4:"aimg";N;}', 'a:0:{}', 35, '', '', '', 0, 0, 10, 1, 1, '', 0, 0),
(34, '格力 电风扇 落地 FDD-40 全国联保电机包用10年 ', '', '主要功能特点：<br/><br/>\r\n\r\n强、中、弱三档风速调节<br/>\r\n扇头俯仰角自由调节<br/>\r\n水平摇头送风<br/>\r\n优越的低压启动性能<br/>\r\n强劲电机，超低噪音<br/>\r\n美国进口“普马威克”电机润滑油<br/>\r\n扇头自由升降<br/>\r\n120分钟定时关机<br/>\r\n经典蓝白配 <br/>\r\n底盘可换<br/>', '', 'FDD-40', '654.89', '139.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 3, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298448567_s.jpg', '/media/1/products/1298448567.jpg|1', '', '', NULL, 36, '', '', '', 0, 0, 7, 1, 1, '', 0, 0),
(35, '格力电风扇 FDE-40 格力落地扇 低压启动 定时关机 ', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n强、中、弱三档风速调节<br />\r\n扇头俯仰角自由调节<br />\r\n水平摇头送风<br />\r\n优越的低压启动性能<br />\r\n强劲电机，超低噪音<br />\r\n美国进口&ldquo;普马威克&rdquo;电机润滑油<br />\r\n优质机身塑料材料<br />\r\n3片PP透明风叶<br />\r\n扇头自由升降<br />\r\n120分钟定时关机<br />\r\n经典黄白配 <br />\r\n底盘可拆 </p>', '', 'FDE-40', '353.89', '125.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 3, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298448875_s.jpg', '/media/1/products/1298448875.jpg|1', '', '', NULL, 37, '', '', '', 0, 0, 11, 1, 1, '', 0, 0),
(36, '格力电风扇 FDG-40B 遥控 落地扇 红外遥控 7.5小时定时 ', NULL, '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n全功能红外遥控；微电脑程序控制<br />\r\n强、中、弱风三档风速调节<br />\r\n普通风自然风睡眠风可选择<br />\r\n优越的低压启动性能<br />\r\n强劲电机，超低噪音<br />\r\n美国进口&ldquo;普马威克&rdquo;电机润滑油<br />\r\n优质机身塑料材料<br />\r\n扇头俯仰角自由调节<br />\r\n水平摇头送风<br />\r\n3片PP透明风叶<br />\r\n扇头自由升降<br />\r\n7.5小时定时关机<br />\r\n经典黑白配 <br />\r\n按键电镀<br />\r\n底盘可拆</p>\r\n<p><img alt="" src="/media/1/products/FDG-40B.jpg" /></p>', '', 'FDG-40B', '804.79', '228.00', '0.00', 0, 0, 0, '0000-00-00', '0.00', '0.00', '', 0, 0, 3, 0, '2011-04-20 00:00:00', '2011-04-15 14:57:48', '/media/1/products/1298452323_s.jpg', '/media/1/products/1298452323.jpg|1', '', 'a:2:{s:4:"attr";a:0:{}s:4:"aimg";N;}', 'a:0:{}', 38, '', '', '', 0, 0, 45, 1, 1, '', 0, 0),
(37, '格力电暖器 冷暖 空调扇KS-0701RD 带遥控 冬天夏天都可用 ', '', '<p>主要功能特点：<br />\r\n1.冷暖两用，四季皆宜（RD）;<br />\r\n2.双离心风轮，超大风量；<br />\r\n3.三位数码显示屏,智能湿度控制；<br />\r\n4.创新侧进风方式，空气循环更高效；<br />\r\n5.自动闭合防尘风口、上下左右自动扫风，120度广角送风；<br />\r\n6. 15小时定时预约功能，适合夜间睡眠使用；<br />\r\n7.全开式钢化玻璃门设计，全抽式水箱，加水、清洗、拆装更方便；<br />\r\n8.超强吸水纤维蒸发器，吸水更充分，加湿更凉爽；<br />\r\n9.八档风速调节，自然风、睡眠风、普通风多种风类选择；<br />\r\n10. 缺水保护、过热保护、断电保护，人性化设计，使用更安全；<br />\r\n11.优质滚珠轴承电机，110V低压启动，保用10年；<br />\r\n<br />\r\n<img alt="" src="/media/1/products/0701RD 2.jpg" /><br />\r\n<img alt="" src="/media/1/products/0701RD 3.jpg" /><br />\r\n<img alt="" src="/media/1/products/kongdiaoshanneibujiegou3.jpg" /><br />\r\n<img alt="" src="/media/1/products/0701RD 4.jpg" /></p>', '', 'KS-0701RD', '962.27', '1298.00', '0.00', 0, 0, 0, '0000-00-00', '1000.00', '1500.00', '', 0, 0, 4, 0, '2011-04-20 00:00:00', '2011-03-03 14:28:55', '/media/1/products/1298614000_s.jpg', '/media/1/products/1298614000.jpg|1', '', '', NULL, 39, '', '', '', 0, 0, 34, 1, 1, '', 0, 0),
(38, '格力空调扇 KS-0502 单冷 秒杀 电机保十年 前开门 ', '', '<p>主要功能特点：<br />\r\n<br />\r\n1.蒸发加湿，高效降温；<br />\r\n2.双离心风轮，超大风量；<br />\r\n3.LED星光显示屏，远距离遥控(0502D)；<br />\r\n4.创新侧进风方式，空气循环更高效；<br />\r\n5. 上下手动导风，左右自动扫风，120度广角送风；  <br />\r\n6. 15小时定时预约(0502D)，2小时定时(0502) ；<br />\r\n7.全开门设计，全抽式水箱，加水、清洗、拆装更方便； <br />\r\n8.超强吸水纤维蒸发器，吸水更充分，加湿更凉爽；<br />\r\n9.强、中、弱、柔四档风速调节；<br />\r\n10.自然风、睡眠风、普通风三种风类选择(0502D);<br />\r\n11.缺水保护、断电保护，人性化设计，使用更安全;<br />\r\n12.优质滚珠轴承电机，110V低压启动，保用10年；<br />\r\n&nbsp;</p>\r\n<p>l<img alt="" src="/media/1/products/KS-0502.jpg" /><br />\r\n<img alt="" src="/media/1/products/KS-0502-2.jpg" /><br />\r\n<img alt="" src="/media/1/products/KS-0502-3.jpg" /></p>', '', 'KS-0502', '396.99', '399.00', '0.00', 0, 0, 0, '0000-00-00', '200.00', '500.00', '', 0, 0, 4, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298614831_s.jpg', '/media/1/products/1298614831.jpg|1', '', '', NULL, 40, '', '', '', 0, 0, 9, 1, 1, '', 0, 0),
(39, '格力 KS-0601RD 冷暖空调扇系列 ', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n冷暖两用，暖风2000W<br />\r\n抽拉式水箱，清洗方便<br />\r\n蒸发式加温/降温<br />\r\n三档风速可调，负离子清新功能<br />\r\n8小时定时，100度广角送风<br />\r\n大功率主电机，送风量大<br />\r\n彩色LED显示<br />\r\n过滤网/蒸发器易装拆易清洗<br />\r\n出风口自动闭合防尘功能（配冰盒）</p>', '', 'KS-0601RD', '98.13', '765.00', '0.00', 0, 0, 0, '0000-00-00', '500.00', '800.00', '', 0, 0, 4, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298615513_s.jpg', '/media/1/products/1298615513.jpg|1', '', '', NULL, 41, '', '', '', 0, 0, 5, 1, 1, '', 0, 0),
(40, '格力空调扇 冷风扇 单冷扇 KS-0601D ', '', '<p>主要功能特点：<br />\r\n<br />\r\n1 .智能加湿型；<br />\r\n2 .抽拉式水箱，清洗更方便；<br />\r\n3 .蒸发式加湿/降温；<br />\r\n4 .三档风速可调节，三种风类选择；<br />\r\n5 .8小时定时；<br />\r\n6 .大功率主电机智，送风量大；<br />\r\n7.过滤网/蒸发器易装拆易清洗；<br />\r\n8.100度广角自动左右送风；<br />\r\n9.出风口可闭合防尘功能（配冰盒）；<br />\r\n10.彩色LED显示；<br />\r\n11.强劲电机，优越的低压启动性能；<br />\r\n12.美国普马威克电机润滑油。<br />\r\n<br />\r\n基本参数:<br />\r\n额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：65W<br />\r\n毛重：11.5KG<br />\r\n净重：8.5KG<br />\r\n&nbsp;</p>\r\n<p><img alt="" src="/media/1/products/KS-0601D.jpg" /></p>', '', 'KS-0601D', '299.66', '599.00', '0.00', 0, 0, 0, '0000-00-00', '500.00', '800.00', '', 0, 0, 4, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298616082_s.jpg', '/media/1/products/1298616082.jpg|1', '', '', NULL, 42, '', '', '', 0, 0, 7, 1, 1, '', 0, 0);
INSERT INTO `w_products` (`id`, `name`, `introtext`, `fulltext`, `packaging`, `model`, `shop_price`, `market_price`, `weight`, `store`, `sales`, `give_integral`, `market_time`, `price_s`, `price_e`, `unit`, `isfront`, `menuid`, `catid`, `brand_id`, `created`, `modified`, `thumbnail`, `images`, `brand`, `attribs`, `specs`, `ordering`, `title`, `metakey`, `metadesc`, `access`, `mini`, `hits`, `uid`, `published`, `additional`, `star`, `postnum`) VALUES
(41, '格力空调扇 KS-305D 红外遥控 易清洗 ', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n1、单冷、超薄遥控器、负离子<br />\r\n2、0.5-7.5小时定时、三档风速<br />\r\n3、4D立体全方位送风<br />\r\n4、关机自动合闭、三种风类选择 <br />\r\n5、全新、可抽拉式水箱<br />\r\n6、过滤网/蒸发器易装拆易清洗 <br />\r\n&nbsp;</p>\r\n<p><img alt="" src="/media/1/products/KS-305D-2.jpg" /><img alt="" src="/media/1/products/KS-305D-3.jpg" /><img alt="" src="/media/1/products/KS-305D-4.jpg" /></p>', '', 'KS-305D', '203.95', '569.00', '0.00', 0, 0, 0, '0000-00-00', '500.00', '800.00', '', 0, 0, 4, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298616389_s.jpg', '/media/1/products/1298616389.jpg|1', '', '', NULL, 43, '', '', '', 0, 0, 8, 1, 1, '', 0, 0),
(42, '格力电水壶 GK-CS1825DA 不锈钢电水壶 加厚超好用 ', NULL, '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n◆ 优质不锈钢壶体，卫生健康<br />\r\n◆ 隐式大功率不锈钢发热盘，加热快速<br />\r\n◆ 360&deg;旋转、分体式设计，取放方便<br />\r\n◆ 蒸汽感应式自动断电，双重防干烧保护<br />\r\n◆ 内外镜面抛光壶体，不易结水垢<br />\r\n◆ 外形小巧玲珑，方便携带<br />\r\n◆ 易拆卸式滤网，方便清洁<br />\r\n◆ 英国STRIX温控器，精确可靠耐用 <br />\r\n&nbsp;</p>', '', 'GK-CS1825DA', '120.74', '219.00', '0.00', 0, 0, 0, '0000-00-00', '0.00', '0.00', '', 0, 0, 5, 0, '2011-04-20 00:00:00', '2011-04-15 15:10:28', '/media/1/products/1298617124_s.jpg', '/media/1/products/1298617124.jpg|1', '', 'a:2:{s:4:"attr";a:0:{}s:4:"aimg";N;}', 'a:0:{}', 44, '', '', '', 0, 0, 15, 1, 1, '', 0, 0),
(43, '格力 热水壶 GK-CS1310DA1 典雅时尚 lL 防干烧 ', '', '<p>&nbsp;<span class="Apple-style-span" style="font-family: 宋体, Arial; font-size: 12px; line-height: normal; "><span class="Apple-style-span" style="color: rgb(51, 51, 51); font-size: 13px; font-weight: bold; line-height: 26px; ">主要功能特点：</span>\r\n<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 10px; line-height: 20px; color: rgb(102, 102, 102); text-align: left; ">◆&nbsp;全新外观造型，典雅时尚<br />\r\n◆&nbsp;优质温控器，双重安全保护<br />\r\n◆&nbsp;水沸腾自动关机，无水干烧自动断电<br />\r\n◆&nbsp;高级不锈钢隐藏式发热盘&nbsp;<br />\r\n◆&nbsp;360&deg;旋转、分体式设计，取放方便<br />\r\n◆&nbsp;透明水尺设计，水位显示一目了然<br />\r\n◆&nbsp;易拆卸式滤网，方便清洁<br />\r\n◆&nbsp;1350W大功率，1.0L小容量设计，省时省电</p>\r\n</span></p>', '', 'GK-CS1310DA1', '991.84', '199.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '300.00', '', 0, 0, 5, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298617394_s.jpg', '/media/1/products/1298617394.jpg|1', '', '', NULL, 45, '', '', '', 0, 0, 7, 1, 1, '', 0, 0),
(44, '格力电水壶 GK-CS1818DB 不锈钢 大功率电水壶 ', '', '<p>&nbsp;<span class="Apple-style-span" style="font-family: 宋体, Arial; font-size: 12px; line-height: normal; "><span class="Apple-style-span" style="color: rgb(51, 51, 51); font-size: 13px; font-weight: bold; line-height: 26px; ">主要功能特点：</span>\r\n<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 10px; line-height: 20px; color: rgb(102, 102, 102); text-align: left; ">◆&nbsp;优质不锈钢壶体，卫生健康<br />\r\n◆&nbsp;隐式大功率不锈钢发热盘，加热快速<br />\r\n◆&nbsp;360&deg;旋转、分体式设计，取放方便<br />\r\n◆&nbsp;蒸汽感应式自动断电，双重防干烧保护<br />\r\n◆&nbsp;内外镜面抛光壶体，不易结水垢<br />\r\n◆&nbsp;透明水尺设计，水位一目了然<br />\r\n◆&nbsp;易拆卸式滤网，方便清洁<br />\r\n◆&nbsp;英国STRIX温控器，精确可靠耐用&nbsp;</p>\r\n</span></p>', '', 'GK-CS1818DB', '597.00', '269.00', '0.00', 0, 0, 0, '0000-00-00', '200.00', '500.00', '', 0, 0, 5, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298617623_s.jpg', '/media/1/products/1298617623.jpg|1', '', '', NULL, 46, '', '', '', 0, 0, 10, 1, 1, '', 0, 0),
(45, '格力电热水壶 GK-CS1818DA 加热快速 方便清洁 ', '', '<p>&nbsp;<span class="Apple-style-span" style="font-family: 宋体, Arial; font-size: 12px; line-height: normal; "><span class="Apple-style-span" style="color: rgb(51, 51, 51); font-size: 13px; font-weight: bold; line-height: 26px; ">主要功能特点：</span>\r\n<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 10px; line-height: 20px; color: rgb(102, 102, 102); text-align: left; ">◆&nbsp;优质耐高温塑料壶体，卫生健康<br />\r\n◆&nbsp;隐式大功率不锈钢发热盘，加热快速<br />\r\n◆&nbsp;360&deg;旋转、分体式设计，取放方便<br />\r\n◆&nbsp;蒸汽感应式自动断电，双重防干烧保护<br />\r\n◆&nbsp;整体小巧玲珑，方便携带<br />\r\n◆&nbsp;透明水尺设计，水位一目了然<br />\r\n◆&nbsp;易拆卸式滤网，方便清洁<br />\r\n◆&nbsp;优质温控器，精确安全耐用</p>\r\n</span></p>', '', 'GK-CS1818DA', '9.48', '210.00', '0.00', 0, 0, 0, '0000-00-00', '200.00', '400.00', '', 0, 0, 5, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298618007_s.jpg', '/media/1/products/1298618007.jpg|1', '', '', NULL, 47, '', '', '', 0, 0, 15, 1, 1, '', 0, 0),
(46, '格力电水壶 GK-CS1815DA 不锈钢电水壶 不易结水垢 ', '', '<p>&nbsp;<span class="Apple-style-span" style="font-family: 宋体, Arial; font-size: 12px; line-height: normal; "><span class="Apple-style-span" style="color: rgb(51, 51, 51); font-size: 13px; font-weight: bold; line-height: 26px; ">主要功能特点：</span>\r\n<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 10px; line-height: 20px; color: rgb(102, 102, 102); text-align: left; ">◆&nbsp;优质不锈钢壶体，卫生健康<br />\r\n◆&nbsp;隐式大功率不锈钢发热盘，加热快速<br />\r\n◆&nbsp;360&deg;旋转、分体式设计，取放方便<br />\r\n◆&nbsp;蒸汽感应式自动断电，双重防干烧保护<br />\r\n◆&nbsp;内外镜面抛光壶体，不易结水垢<br />\r\n◆&nbsp;透明水尺设计，水位一目了然<br />\r\n◆&nbsp;易拆卸式滤网，方便清洁<br />\r\n◆&nbsp;英国STRIX温控器，精确可靠耐用&nbsp;</p>\r\n</span></p>', '', 'GK-CS1815DA', '256.41', '319.00', '0.00', 0, 0, 0, '0000-00-00', '200.00', '500.00', '', 0, 0, 5, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298618265_s.jpg', '/media/1/products/1298618265.jpg|1', '', '', NULL, 48, '', '', '', 0, 0, 19, 1, 1, '', 0, 0),
(47, '格力电水壶 GK-CS0808PA1 洁净白色 造型时尚 ', '', '<p>&nbsp;<span class="Apple-style-span" style="font-family: 宋体, Arial; font-size: 12px; line-height: normal; "><span class="Apple-style-span" style="color: rgb(51, 51, 51); font-size: 13px; font-weight: bold; line-height: 26px; ">主要功能特点：</span>\r\n<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 10px; line-height: 20px; color: rgb(102, 102, 102); text-align: left; ">◆&nbsp;全新外观造型，典雅时尚<br />\r\n◆&nbsp;优质温控器，双重安全保护<br />\r\n◆&nbsp;防干烧保护及高温熔断保护<br />\r\n◆&nbsp;分离式电源底座，安全方便<br />\r\n◆&nbsp;不锈钢发热管，永不生锈</p>\r\n</span></p>', '', 'GK-CS0808PA1', '253.59', '120.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '300.00', '', 0, 0, 5, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298618642_s.jpg', '/media/1/products/1298618642.jpg|1', '', '', NULL, 49, '', '', '', 0, 0, 5, 1, 1, '', 0, 0),
(48, '格力电水壶 GK-CS1520DA 2升 大功率电水壶 ', NULL, '<p>&nbsp;<span style="line-height: normal; font-family: 宋体, Arial; font-size: 12px" class="Apple-style-span"><span style="line-height: 26px; color: rgb(51,51,51); font-size: 13px; font-weight: bold" class="Apple-style-span">主要功能特点：</span> </span>\r\n<p>&nbsp;</p>\r\n</p>\r\n<p style="text-align: left; padding-bottom: 0px; line-height: 20px; margin: 0px; padding-left: 10px; padding-right: 0px; color: rgb(102,102,102); padding-top: 0px">◆&nbsp;优质耐高温塑料壶体，卫生健康<br />\r\n◆&nbsp;隐式大功率不锈钢发热盘，加热快速<br />\r\n◆&nbsp;360&deg;旋转、分体式设计，取放方便<br />\r\n◆&nbsp;蒸汽感应式自动断电，双重防干烧保护<br />\r\n◆&nbsp;壶体透明设计，水位显示一目了然<br />\r\n◆&nbsp;整体流线造型，美观时尚<br />\r\n◆&nbsp;易拆卸式滤网，方便清洁<br />\r\n◆&nbsp;优质温控器，精确安全耐用&nbsp;</p>', '', 'GK-CS1520DA', '498.73', '265.00', '0.00', 0, 0, 0, '2011-06-03', '0.00', '0.00', '', 0, 0, 5, 0, '2011-04-20 00:00:00', '2011-06-10 17:06:29', '/media/1/products/200/1298618863_s.jpg', '/media/1/products/200/1298618863.jpg|1', '', 'a:2:{s:4:"attr";a:0:{}s:4:"aimg";N;}', 'a:0:{}', 50, '', '', '', 0, 0, 5, 1, 1, '', 0, 0),
(49, '格力电水壶 GK-CS1512DA 不锈钢 磨砂表面 ', NULL, '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n360度旋转任意旋转<br />\r\n煲身不锈钢材料，磨砂表面<br />\r\n不锈钢大功率发热盘，制热水快（3-6分钟）<br />\r\n英国进口STRIX温控器三重安全保护<br />\r\n隐藏式电源底座，分体设计<br />\r\n防滑断手柄设计<br />\r\n分体无绳式设计，360度随意取放<br />\r\n出水口带滤网设计，使用更安全，饮水更卫生</p>', '', 'GK-CS1512DA', '732.86', '199.00', '0.00', 0, 0, 0, '2011-06-01', '0.00', '0.00', '', 0, 0, 5, 0, '2011-04-20 00:00:00', '2011-06-10 17:06:02', '/media/1/products/200/1298619030_s.jpg', '/media/1/products/200/1298619030.jpg|1', '', 'a:2:{s:4:"attr";a:0:{}s:4:"aimg";N;}', 'a:0:{}', 51, '', '', '', 0, 0, 13, 1, 1, '', 2, 0),
(50, '格力加湿器 GS-5002 负离子超声波加湿器 经典超值 ', '', '<p>功能介绍：<br />\r\n<br />\r\n★产品外观流畅，5L大容量水箱<br />\r\n★出雾口可360度旋转<br />\r\n★负离子功能，改善空气质量<br />\r\n★缺水自动断电及提示功能，使用安全<br />\r\n★换能片采用玻璃釉工艺制造，有效防止水垢<br />\r\n★先进抑噪技术，超静音运行。<br />\r\n<br />\r\n型号：GS-5002<br />\r\n电源：220V/50HZ<br />\r\n额定功率：45W<br />\r\n冷雾：&ge;300ml/h<br />\r\n噪声：&le;35db<br />\r\n水箱容积：5L<br />\r\n毛重：2.85KG<br />\r\n外包装尺寸：263*260*361(mm)<br />\r\n适用面积：12-20平方</p>\r\n<p>&nbsp;</p>\r\n<table width="90%" cellspacing="0" cellpadding="0" border="0" style="font-size: 12px;">\r\n    <tbody>\r\n        <tr>\r\n            <td><img src="/media/1/products/GS-5002-2.jpg" alt="" /></td>\r\n            <td><span style="color: rgb(102, 102, 102); font-family: ''arial helvetica sans-serif''; line-height: 19px;" class="Apple-style-span">产品特性：<br />\r\n            ★按钮式开关，手动调节雾量大小&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />\r\n            ★先进抑噪技术，超静音运行；</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><span style="color: rgb(102, 102, 102); font-family: ''arial helvetica sans-serif''; line-height: 21px;" class="Apple-style-span">★负离子功能，改善空气质量<br />\r\n            ★换能片采用玻璃釉工艺制造，有效防止水垢<br />\r\n            ★缺水自动断电及提示功能，使用安全；</span></td>\r\n            <td><img src="/media/1/products/GS-5002-3.jpg" alt="" /></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img src="/media/1/products/GS-5002-4.jpg" alt="" /></td>\r\n            <td><span style="color: rgb(102, 102, 102); font-family: ''arial helvetica sans-serif''; line-height: 21px;" class="Apple-style-span">\r\n            <p align="left" style="margin: 1.12em 0px; padding: 0px; line-height: 1.4;">★产品外观流畅，5L大容量水箱 ★出雾口可360度旋转；</p>\r\n            容量:5.0L<br />\r\n            颜色:蓝色<br />\r\n            额定功率:45W<br />\r\n            额定电压:220V-50HZ<br />\r\n            雾化量:&nbsp;冷雾&gt;=&nbsp;300ml/h<br />\r\n            噪音:&lt;35dB(A)<br />\r\n            尺寸:&nbsp;263mm*262mm*366mm</span></td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '', 'GS-5002', '168.12', '218.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '300.00', '', 0, 0, 6, 0, '2011-04-20 00:00:00', '2011-03-07 16:49:15', '/media/1/products/1298857534_s.jpg', '/media/1/products/1298857534.jpg|1', '', '', NULL, 52, '', '', '', 0, 0, 26, 1, 1, '', 0, 0),
(51, '格力加湿器 负离子 GS-3503 缺水自动保护', '', '<p>主要功能特点：<br/><br/>\r\n◆出气盖360°旋转，加湿方向随心所欲。<br/>\r\n◆ 缺水自动保护，风机同步停转，安全节能。<br/>\r\n◆雾量大小可自由调节。<br/>\r\n◆优化风道设计，出雾更细微，加湿更有效。<br/>\r\n◆第四代换能片技术，耐酸碱，不易结水垢。<br/>\r\n◆阳离子交换树脂，大大减少了“白粉“、水垢的形成。\r\n</p>\r\n<p>\r\n额定电源： 220V-50Hz<br/>\r\n\r\n额定功率： 35W<br/>\r\n\r\n水箱容积： 3.5L<br/>\r\n\r\n加湿量： ≥300ml/h<br/>\r\n\r\n净重： 2.1kg  <br/> \r\n\r\n毛重：2.8kg<br/>\r\n\r\n体积：334 x 213 x 323mm<br/>\r\n</p>', '', 'GS-3503', '642.00', '168.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 6, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298858583_s.jpg', '/media/1/products/1298858583.jpg|1', '', '', NULL, 53, '', '', '', 0, 0, 7, 1, 1, '', 0, 0),
(52, '格力 负离子超声波 加湿器 GS-3501 3.5L ', '', '<p>主要功能特点：<br />\r\n<br />\r\n◆ 太空概念造型，线条流畅。<br />\r\n<br />\r\n◆ 高浓度负离子，改善空气质量。<br />\r\n<br />\r\n◆ 防干烧自动断电保护。<br />\r\n<br />\r\n◆ 先进抑噪技术，超静音&le;34 dB(A)运行。<br />\r\n<br />\r\n◆ 牢固壳体，优良分拆性，易装水设计。<br />\r\n<br />\r\n◆ 纳米抗菌技术，防霉、防菌。<br />\r\n&nbsp;</p>\r\n<p><img alt="" src="/media/1/products/GS-3501.jpg" /><img alt="" src="/media/1/products/GS-3501-2.jpg" /><img alt="" src="/media/1/products/GS-3501-3.jpg" /><img alt="" src="/media/1/products/GS-3501-4.jpg" /><img alt="" src="/media/1/products/GS-3501-5.jpg" /></p>', '', 'GS-3501', '705.67', '180.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '300.00', '', 0, 0, 6, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298859022_s.jpg', '/media/1/products/1298859022.jpg|1,/media/1/products/1298859054.jpg,/media/1/products/1298859060.jpg', '', '', NULL, 54, '', '', '', 0, 0, 7, 1, 1, '', 0, 0),
(53, '格力加湿器 GS-3502 纳米抗菌技术 太空概念造型 ', '', '<p>&nbsp;<span class="Apple-style-span" style="font-family: 宋体, Arial; font-size: 12px; line-height: normal; "><span class="Apple-style-span" style="color: rgb(51, 51, 51); font-size: 13px; font-weight: bold; line-height: 26px; ">主要功能特点：</span>\r\n<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 10px; line-height: 20px; color: rgb(102, 102, 102); text-align: left; ">使用面积：30--40平方米<br />\r\n最大功率：45W&nbsp;，噪声≦34dB(A)<br />\r\n太空概念造型，型条流畅<br />\r\n高浓度负离子，改善空气质量<br />\r\n防干烧自动断电保护<br />\r\n先进抑噪技术，超静音≦34dB(A)运行<br />\r\n牢固壳体，优良分拆性，易装水设计<br />\r\n纳米抗菌技术，防霉、防菌</p>\r\n</span></p>', '', 'GS-3502', '602.32', '199.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 6, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298859463_s.jpg', '/media/1/products/1298859463.jpg|1', '', '', NULL, 55, '', '', '', 0, 0, 8, 1, 1, '', 0, 0),
(54, '格力加湿器 GS-1001A 迷你型 超声波加湿器 ', '', '<p>主要功能特点：<br/><br/>\r\n1、外形简洁大方，人性化设计。<br/><br/>\r\n\r\n2、旋钮式开关和雾量选择，操作方便。<br/><br/>\r\n\r\n3、缺水自动断电保护，安全无忧。<br/><br/>\r\n\r\n4、先进抑噪设计，超静音运行。<br/><br/>\r\n\r\n5、纳米抗菌技术，防霉，防菌，健康安心。<br/><br/>\r\n\r\n6、水瓶形式多样，个性十足<br/><br/>\r\n\r\n7、改善空气质量，舒适，健康<br/><br/>\r\n\r\n8、换能片采用陶瓷与钛合金制造，使用常久。<br/><br/>\r\n\r\n9、标准螺口设计，可使用其它类型矿泉水瓶<br/><br/>\r\n</p>', '', 'GS-1001A', '894.61', '135.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 6, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298859837_s.jpg', '/media/1/products/1298859837.jpg|1', '', '', NULL, 56, '', '', '', 0, 0, 54, 1, 1, '', 0, 0),
(55, '格力SC-1501 天籁超声波 加湿器青花瓷外观 缺水自动断电 ', '', '<p>格力加湿器的优势 <br />\r\n<br />\r\n★改善空气质量，舒适健康<br />\r\n★缺水自动保护功能，安全可靠<br />\r\n★先进抑噪技术，超静音<br />\r\n★超声波雾化量随意调节<br />\r\n★水箱提起保护，加湿安全无忧</p>\r\n<table border="0" width="90%" stype="font-size:12px;">\r\n    <tbody>\r\n        <tr>\r\n            <td><img alt="" src="/media/1/products/SC-1501-3.jpg" /></td>\r\n            <td><span class="Apple-style-span" style="color: rgb(102, 102, 102); font-family: ''arial helvetica sans-serif''; line-height: 21px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; ">产品特性：<br />\r\n            ★内带七彩灯，夜灯和装饰两用设计<br />\r\n            ★按键模式，操作便捷</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><span class="Apple-style-span" style="color: rgb(102, 102, 102); font-family: ''arial helvetica sans-serif''; line-height: 21px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; ">★出雾口可360度旋转，全方位加湿<br />\r\n            ★先进抑噪技术，超静音运行。</span></td>\r\n            <td><img alt="" src="/media/1/products/SC-1501-4.jpg" /></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt="" src="/media/1/products/SC-1501-5.jpg" /></td>\r\n            <td><span class="Apple-style-span" style="color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 21px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; ">\r\n            <div style="padding-bottom: 7px; line-height: 1.5em; padding-left: 15px; padding-right: 15px; font-family: ''arial helvetica sans-serif''; font-size: 14px; padding-top: 7px; ">★玻璃釉陶瓷雾化片，雾化量大，雾量均匀。<br />\r\n            ★缺水自动断电保护和水箱提起断电保护功能，使用安全可靠</div>\r\n            <div style="padding-bottom: 7px; line-height: 1.5em; padding-left: 15px; padding-right: 15px; font-family: ''arial helvetica sans-serif''; font-size: 14px; padding-top: 7px; ">\r\n            <table border="0" cellspacing="1" cellpadding="0" width="100%" style="border-collapse: separate; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; display: table; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; text-align: left; ">\r\n                <tbody>\r\n                    <tr>\r\n                        <td style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; ">箱容积</td>\r\n                        <td style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; ">1.50L</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; ">加湿量</td>\r\n                        <td style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; ">200ml/h</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; ">功率</td>\r\n                        <td style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; ">20w</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; ">外型尺寸</td>\r\n                        <td style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; ">248&times;213&times;345mm</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; ">净重</td>\r\n                        <td style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; ">0.99kg</td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </div>\r\n            </span></td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '', 'SC-1501', '666.08', '0.00', '0.00', 0, 0, 0, '0000-00-00', '0.00', '0.00', '', 0, 0, 6, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298860547_s.jpg', '/media/1/products/1298860547.jpg|1,/media/1/products/1298860554.jpg', '', '', NULL, 57, '', '', '', 0, 0, 14, 1, 1, '', 0, 0),
(56, '格力 GSZ-3001 纯净型加湿器 3.0L 淡蓝色 正品 联保 ', '', '<p><img src="/media/1/products/GSZ-3001A-2.jpg" alt="" />&nbsp;</p>\r\n<p>基本参数 <br />\r\n<br />\r\n水箱容量：3L <br />\r\n加湿量：&ge;380ml/h <br />\r\n电源：220V/50Hz <br />\r\n功率：330W <br />\r\n重量：3.6kg <br />\r\n噪音&le;30dB（A）(睡眠模式) <br />\r\n功能描述：标准、强加湿、睡眠、省电四种模式自由选择； 独有蒸发滤芯更换指示，使用更省心； 缺水自动保护功能，安全可靠； 超长定时功能，满足人们睡眠使用需要； 智能恒湿系统实时显示室内湿度，自动调节室内湿度环境，使用更舒心； 进风口高效活性炭过滤网，过滤空气中的粉尘和杂质； 新一代蒸发滤芯，加湿无&ldquo;白粉&rdquo;，耐酸碱，易清洁； 银离子杀菌网，有效保持加湿洁净、无菌； 释放高浓度负离子，改善空气质量。</p>', '', 'GSZ-3001', '646.55', '560.00', '0.00', 0, 0, 0, '0000-00-00', '500.00', '800.00', '', 0, 0, 6, 0, '2011-04-20 00:00:00', '2011-03-07 16:49:54', '/media/1/products/1298861260_s.jpg', '/media/1/products/1298861260.jpg|1,/media/1/products/1298861268.jpg', '', '', NULL, 58, '', '', '', 0, 0, 23, 1, 1, '', 0, 0),
(57, '格力超静音加湿器 GS-2501 超声波 负离子全新正品加湿器 ', '', '<p>容量:2.5L<br />\r\n颜色:蓝色<br />\r\n额定电压:220V-50HZ<br />\r\n额定功率:30W<br />\r\n雾化量: 冷雾&gt;=180ml/h<br />\r\n噪音:&lt;35dB(A)<br />\r\n<!--35dB--> 格力加湿器的优势 <br />\r\n★改善空气质量，舒适健康<br />\r\n★独有蒸发滤芯更换指示，使用更省心 <br />\r\n★缺水自动保护功能，安全可靠 <br />\r\n★先进抑噪技术，超静音 <br />\r\n★牢固壳体，优良分拆性，易装水设计 <br />\r\n★人性化注水口结构，方便实用<br />\r\n★新一代蒸发滤芯，加湿无&ldquo;白粉&rdquo;，耐酸碱，易清洁<br />\r\n★纳米抗菌技术，防霉、防菌<br />\r\n★超声波雾化量随意调节</p>\r\n<table width="90%" cellspacing="0" border="0" style="font-size:12px;">\r\n    <tbody>\r\n        <tr>\r\n            <td><img alt="" src="/media/1/products/GS-2501-4.jpg" /></td>\r\n            <td><span class="Apple-style-span" style="border-collapse: collapse; font-family: ''arial helvetica sans-serif''; line-height: 21px; ">★旋钮开关设计，雾量可任意调节&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />\r\n            ★缺水自动断电保护，使用安全；</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><span class="Apple-style-span" style="border-collapse: collapse; font-family: ''arial helvetica sans-serif''; line-height: 21px; ">★换能片采用玻璃釉工艺制造，有效防止水垢<br />\r\n            ★先进抑噪技术，超静音运行；</span></td>\r\n            <td><img alt="" src="/media/1/products/GS-2501-5.jpg" /></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt="" src="/media/1/products/GS-2501-6.jpg" /></td>\r\n            <td><span class="Apple-style-span" style="border-collapse: collapse; font-family: 宋体; line-height: 21px; ">★防积水设计，有效防止因残留积水而滋生细菌</span></td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '', 'GS-2501', '234.54', '175.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 6, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298878041_s.jpg', '/media/1/products/1298878040.jpg|1,/media/1/products/1298878041.jpg,', '', '', NULL, 59, '', '', '', 0, 0, 14, 1, 1, '', 0, 0),
(58, '格力 GSP20 干衣机 2KG滚筒式 电热冷风烘干机 静音 省电 除菌 ', NULL, '<p><img src="/media/1/products/GSP20-2.jpg" alt="" />&nbsp;<img src="/media/1/products/GSP20-31.jpg" alt="" /><img src="/media/1/products/GSP20-3.jpg" alt="" /><img src="/media/1/products/GSP20-33.jpg" alt="" /><img src="/media/1/products/GSP20-5.jpg" alt="" /></p>\r\n<p>&nbsp;</p>\r\n<p>型号：格力小太阳干衣机 GSP20<br />\r\n体积：500mm*415mm*595mm(长/宽/高)<br />\r\n重量：17KG<br />\r\n干衣容量：2.0KG<br />\r\n额定输入功率：热风：700W；<br />\r\n冷风：100W；<br />\r\n额定电压：220V额定频率：50Hz<br />\r\n定时器设定范围：<br />\r\n1、电热干燥：180分钟热风+20分钟冷风<br />\r\n2、冷风干燥：80分钟<br />\r\n<br />\r\n功能介绍：<br />\r\n1、外观新颖、小巧精致、操作方便、安全可靠；<br />\r\n2、静音运转、快速干衣、省电省时；<br />\r\n3、定时控制装置，走时精确无需守候；<br />\r\n4、采用PTC电子加热器，整体发热、温升迅速、干燥衣服迅速快捷；<br />\r\n5、可根据衣物耐热程度选定冷风或者热风干燥；<br />\r\n6、结束工作前，会自动转为冷风工作状态，迅速将衣物降至正常温度。</p>', '', 'GSP20', '233.04', '880.00', '0.00', 0, 0, 0, '0000-00-00', '0.00', '0.00', '', 0, 0, 7, 0, '2011-04-20 00:00:00', '2011-05-04 14:50:04', '/media/1/products/200/1298959749_s.jpg', '/media/1/products/200/1298959749.jpg|1', '', 'a:2:{s:4:"attr";a:0:{}s:4:"aimg";N;}', 'a:0:{}', 60, '', '', '', 0, 0, 41, 1, 1, '', 0, 0),
(59, '格力干衣机 GSP10B 干被机 滚筒式 高贵美观 ', '', '<p>&nbsp;<img alt="" src="/media/1/products/GSP10B-62.jpg" /><br />\r\n<img alt="" src="/media/1/products/GSP10B-63.jpg" /></p>\r\n<p>&nbsp;</p>\r\n<p>1、外观新颖、小巧精致、操作方便、安全可靠<br />\r\n2、静音运转、快速干衣、省电省时<br />\r\n3、定时控制装置，走时精确无需守候<br />\r\n4、采用PTC电子加热器，整体发热、温升迅速、干燥衣服迅速快捷<br />\r\n5、可根据衣物耐热程度选定冷风或者热风干燥<br />\r\n6、结束工作前，会自动转为冷风工作状态，迅速将衣物降至正常温度<br />\r\n<br />\r\n格力干衣机主要技术参数表:<br />\r\n型号 ：    GSP10B       <br />\r\n体积  ：  450mm*327 mm*545mm(长/宽/高)<br />\r\n重量 ：       11.6KG    <br />\r\n毛重  ：      16公斤 <br />\r\n马达输入功率 ：  110W<br />\r\n额定电压    220V      <br />\r\n电热器功率  ：   510W                       额定频率    50Hz   <br />\r\n干衣容量  ：    1.0KG<br />\r\n定时器设定范围   <br />\r\n电热干燥  ：   100分+8分钟冷风<br />\r\n冷风干燥  ：   60分钟</p>', '', 'GSP10B', '461.57', '568.00', '0.00', 0, 0, 0, '0000-00-00', '500.00', '800.00', '', 0, 0, 7, 0, '2011-04-20 00:00:00', '2011-03-01 14:35:41', '/media/1/products/1298961332_s.jpg', '/media/1/products/1298961015.jpg|1,/media/1/products/1298961015-1.jpg,/media/1/products/1298961016.jpg,/media/1/products/1298961332.jpg', '', '', NULL, 61, '', '', '', 0, 0, 103, 1, 1, '', 0, 0),
(60, '格力电暖器暖风机 电暖器 浴居两用KNT-15 ', NULL, '<p>主要功能特点：<br />\r\n<br />\r\n◆ 浴室居室两用设计，IP&times;4防水级机身;<br />\r\n◆ 精良正温度系数陶瓷发热体加热，即开即暖<br />\r\n◆ 超温，过热多重安全保护装置<br />\r\n◆ 高温摆页送暖功能设计，送暖范围广<br />\r\n◆ 冷风,低热,高热功率可调<br />\r\n◆ 可手动调节出风口的方向<br />\r\n◆ 适用面积:14-16平米<br />\r\n<br />\r\n基本参数:<br />\r\n额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：1500W</p>\r\n<table border="0" width="90%">\r\n    <tbody>\r\n        <tr>\r\n            <td><img src="/media/1/products/NT-15-5.jpg" alt="" /></td>\r\n            <td><span style="border-collapse: collapse; color: rgb(204, 51, 0); font-family: ''arial helvetica sans-serif''; line-height: 21px;" class="Apple-style-span">产品特性：<br />\r\n            ★高温摆页送暖功能设计，送暖范围广<span>&nbsp;</span><br />\r\n            ★可手动调节出风口的方向</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><span style="border-collapse: collapse; color: rgb(204, 51, 0); font-family: ''arial helvetica sans-serif''; line-height: 21px;" class="Apple-style-span">★冷风,低热,高热功率可调<br />\r\n            ★超温，过热多重安全保护装置<br />\r\n            ★先进的PTC陶瓷材料，加热效果好，耐老化耐衰减，节能省电；</span></td>\r\n            <td><img src="/media/1/products/NT-15-6.jpg" alt="" /></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img src="/media/1/products/NT-15-7.jpg" alt="" /></td>\r\n            <td><span style="border-collapse: collapse; color: rgb(204, 51, 0); font-family: ''arial helvetica sans-serif''; line-height: 21px;" class="Apple-style-span">★浴室居室两用设计，IP&times;4防水级机身<br />\r\n            ★精良正温度系数陶瓷发热体加热，即开即暖<br />\r\n            ★可壁挂使用，方便实用 ；</span></td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '', 'KNT-15', '608.76', '150.00', '0.00', 0, 0, 0, '0000-00-00', '0.00', '0.00', '', 0, 0, 8, 0, '2011-04-20 00:00:00', '2011-05-04 14:47:50', '/media/1/products/200/1299137697_s.jpg', '/media/1/products/200/1299137697.jpg|1,/media/1/products/200/1299137697-1.jpg,/media/1/products/200/1299137698.jpg', '', 'a:2:{s:4:"attr";a:0:{}s:4:"aimg";N;}', 'a:0:{}', 62, '', '', '', 0, 0, 14, 1, 1, '', 0, 0),
(68, '11', NULL, '', '', '', '0.00', '0.00', '0.00', 0, 0, 0, '0000-00-00', '0.00', '0.00', NULL, 0, 0, 1, 0, '2011-05-26 14:16:24', '0000-00-00 00:00:00', '', '', NULL, 'a:2:{s:4:"attr";a:0:{}s:4:"aimg";N;}', 'a:0:{}', 71, '', '', '', 0, NULL, 6, 1, 0, NULL, 0, 0),
(61, '格力防水防火防漏电浴居两用暖风机取暖器/电暖器NBFB-21 ', '', '<p><img alt="" src="/media/1/products/NT-21-2.jpg" /><br />\r\n<img alt="" src="/media/1/products/NT-21-3.jpg" /><br />\r\n<img alt="" src="/media/1/products/NT-21-4.jpg" /><br />\r\n<img alt="" src="/media/1/products/NT-21-5.jpg" /><br />\r\n&nbsp;</p>\r\n<p>1.采用PTC发热体，电热转换效率高，升温迅速，无火，不耗氧，并能随室温的提高而自动降低输入功率，具有良好的温度自限，节能效果；<br />\r\n2.优化风道设计，进风量大，静压低，风速大，取暖效果好；<br />\r\n3.专门的防溅水设计，防水等级1P*4，使该暖风机可允许在浴室工作；<br />\r\n4.设有专门的双重过热保护功能，具有可靠的安全保障；<br />\r\n5.手动摆叶设计，实现送风方向手动调节；<br />\r\n6.整机可平放，壁挂方式使用，占用空间小；<br />\r\n7.三种工作模式可调：冷风，低热，高热；<br />\r\n<br />\r\n尺寸：346*280*168<br />\r\n重量：2.52<br />\r\n功率：35/1100~1400/2100（W)</p>', '', 'NBFB-21', '659.07', '165.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 8, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1299138542_s.jpg', '/media/1/products/1299138542.jpg|1', '', '', NULL, 63, '', '', '', 0, 0, 13, 1, 1, '', 0, 0),
(62, '格力取暖器 电暖器 PTC暖风机 QG20D 居浴两用 ', NULL, '<p>&nbsp;<img alt="" src="/media/1/products/QG20D-2.jpg" /><br />\r\n<img alt="" src="/media/1/products/QG20D-3.jpg" /><br />\r\n<img alt="" src="/media/1/products/QG20D-4.jpg" /></p>\r\n<p>浴室居室两用设计，IP*4防水级机身<br />\r\n.  精良正温度系数陶瓷发热体加热，即开即暖<br />\r\n.  壁挂空调式设计，时尚美观<br />\r\n.  专利外形设计<br />\r\n.  高/低热功率可调，冷/热风可供选择，风力强劲<br />\r\n.  1200W/2000W两档功率可调<br />\r\n<br />\r\n11、豪华时尚液晶显示，尽显尊贵。<br />\r\n12、快热：格力快热炉采用快热蒸发器作为发热元件，空气自然对流加热，特有的发热原理能快速实现热交换，取暖效果自然不错；<br />\r\n<br />\r\n升温时间 5（min）<br />\r\n型号 NDYB-18B<br />\r\n重量 9.94（kg）<br />\r\n外形尺寸 858*192*725（mm）<br />\r\n温度范围 0-100（℃）<br />\r\n电源频率 50（Hz）<br />\r\n电源电压 220（V）<br />\r\n额定功率 1800（W）</p>', '', 'QG20D', '469.07', '218.00', '0.00', 0, 0, 0, '0000-00-00', '0.00', '0.00', '', 0, 0, 8, 0, '2011-04-20 00:00:00', '2011-05-04 14:47:37', '/media/1/products/200/1299139434_s.jpg', '/media/1/products/200/1299139434.jpg|1', '', 'a:2:{s:4:"attr";a:0:{}s:4:"aimg";N;}', 'a:0:{}', 64, '', '', '', 0, 0, 9, 1, 1, '', 0, 0),
(63, '格力取暖器 小太阳 远红外线电暖器 NSF-8 倾倒防护 ', NULL, '<p><img style="width: 740px; height: 740px;" alt="" src="/media/1/products/NSF-8-1.jpg" /><img alt="" src="/media/1/products/NSF-8-2.jpg" /><img alt="" src="/media/1/products/NSF-8-3.jpg" /><img alt="" src="/media/1/products/NSF-8-4.jpg" /><img alt="" src="/media/1/products/NSF-8-5.jpg" /><img alt="" src="/media/1/products/NSF-8-6.jpg" /><br />\r\n&nbsp;</p>\r\n<p>额定电源：220V/50HZ<br />\r\n额定功率：800W<br />\r\n体    积：490X360X440mm<br />\r\n1.超远距离及大角度摇头送暖<br />\r\n2.抛物面聚能反射，热力强劲<br />\r\n3.远红外线加热，升温迅速<br />\r\n4.倾倒防护，确保安全无忧<br />\r\n5.可俯视角调节</p>', '', 'NSF-8', '368.13', '148.00', '0.00', 0, 0, 0, '0000-00-00', '0.00', '0.00', '', 0, 0, 8, 0, '2011-04-20 00:00:00', '2011-04-14 16:27:11', '/media/1/products/1299140209_s.jpg', '/media/1/products/1299140208.jpg,/media/1/products/1299140209.jpg|1,/media/1/products/1299140209-1.jpg', '', 'a:2:{s:4:"attr";a:0:{}s:4:"aimg";N;}', 'a:0:{}', 65, '', '', '', 0, 0, 18, 1, 1, '', 0, 0),
(64, '格力电暖器FGK-12 格力红外线取暖器 节能环保 ', '', '<p>1.卤素管过压信赖测试超5000小时，水淋不裂<br />\r\n2.高亮度镜面反射罩，热量反射均匀强劲<br />\r\n3.水平宽幅自动摇头送暖，温馨居室暖洋洋<br />\r\n4.400W∕800W∕1200W高中低功率自由选择<br />\r\n5.跌倒自动关机保护</p>\r\n<p>产品型号：格力FGK-12<br />\r\n适用面积：&lt;20平米<br />\r\n<!--20--> 额定电压：220V~50hz<br />\r\n额定功率：1200W</p>', '', 'FGK-12', '433.45', '188.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 8, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1299140697_s.jpg', '/media/1/products/1299140697.jpg|1', '', '', NULL, 66, '1', '2', '3', 0, 0, 63, 1, 1, '', 0, 0),
(67, '格力电暖器 NSW-8 二管 石英管 取暖器 ', NULL, '<p><img src="/media/1/products/NSK-9-1.jpg" alt="" /><img src="/media/1/products/NSK-9-2.jpg" alt="" /><img src="/media/1/products/NSK-9-4.jpg" alt="" /><img src="/media/1/products/NSK-9-5.jpg" alt="" /><br />\r\n&nbsp;</p>\r\n<p><strong>产品特性：</strong><br />\r\n<br />\r\n★400W/800W两档功率可调<br />\r\n★石英管发热体，即开即暖<br />\r\n★镜面反射板，辐射范围广，热量传递效率高<br />\r\n★体积小巧，放置自由；<br />\r\n★电源插头配置内胆，更安全<br />\r\n★跌倒自动关机保护，安全可靠<br />\r\n★高稳定性，置于15&deg;斜台上不翻到<br />\r\n★全封闭结构设计，符合国家安全标准。<br />\r\n经过严格的测试，安全性能好；<br />\r\n<br />\r\n* 型号/规格：NSW-8<br />\r\n* 额定电压及定额频率：220V~50hz<br />\r\n* 输入/输出功率：800W<br />\r\n* 尺寸：180mm*225mm*430mm<br />\r\n* 毛重：2.30<br />\r\n* 净重: 1.60<br />\r\n* 适用面积:&lt;15平米<br />\r\n<!--15--></p>', '', 'NSW-8 ', '881.19', '65.00', '0.00', 2, 0, 0, '0000-00-00', '0.00', '0.00', '', 0, 0, 8, 0, '2011-04-20 00:00:00', '2011-05-04 12:53:51', '/media/1/products/1299143354-1_s.jpg', '/media/1/products/1299143353.jpg,/media/1/products/1299143353-1.jpg,/media/1/products/1299143354.jpg,/media/1/products/1299143354-1.jpg|1', '', 'a:2:{s:4:"attr";a:2:{i:1;a:1:{i:0;s:4:"1-2L";}i:2;a:1:{i:0;s:4:"200W";}}s:4:"aimg";N;}', 'a:0:{}', 67, 'asdf', 'asdf', 'asdf', 0, 0, 171, 1, 1, '', 2, 0),
(69, '12', NULL, '', '', '', '0.00', '0.00', '0.00', 0, 0, 0, '2011-05-25', '0.00', '0.00', NULL, 0, 0, 8, 0, '2011-05-26 14:30:43', '2011-05-26 16:09:44', '', '', NULL, 'a:2:{s:4:"attr";a:0:{}s:4:"aimg";N;}', 'a:0:{}', 69, '', '', '', 0, NULL, 6, 1, 0, NULL, 0, 0),
(70, '新建 12', '', '', '', '', '0.00', '0.00', '0.00', 0, 0, 0, '2010-06-02', '0.00', '0.00', NULL, 0, 0, 1, 0, '2011-05-26 14:30:43', '0000-00-00 00:00:00', '', '', NULL, 'a:2:{s:4:"attr";a:0:{}s:4:"aimg";N;}', 'a:0:{}', 1, '', '', '', 0, NULL, 6, 1, 0, NULL, 0, 0),
(73, '新建 格力电暖器 NSW-8 二管 石英管 取暖器 ', '', '<p><img src="/media/1/products/NSK-9-1.jpg" alt="" /><img src="/media/1/products/NSK-9-2.jpg" alt="" /><img src="/media/1/products/NSK-9-4.jpg" alt="" /><img src="/media/1/products/NSK-9-5.jpg" alt="" /><br />\r\n&nbsp;</p>\r\n<p><strong>产品特性：</strong><br />\r\n<br />\r\n★400W/800W两档功率可调<br />\r\n★石英管发热体，即开即暖<br />\r\n★镜面反射板，辐射范围广，热量传递效率高<br />\r\n★体积小巧，放置自由；<br />\r\n★电源插头配置内胆，更安全<br />\r\n★跌倒自动关机保护，安全可靠<br />\r\n★高稳定性，置于15&deg;斜台上不翻到<br />\r\n★全封闭结构设计，符合国家安全标准。<br />\r\n经过严格的测试，安全性能好；<br />\r\n<br />\r\n* 型号/规格：NSW-8<br />\r\n* 额定电压及定额频率：220V~50hz<br />\r\n* 输入/输出功率：800W<br />\r\n* 尺寸：180mm*225mm*430mm<br />\r\n* 毛重：2.30<br />\r\n* 净重: 1.60<br />\r\n* 适用面积:&lt;15平米<br />\r\n<!--15--></p>', '', 'NSW-8 ', '881.19', '65.00', '0.00', 20, 0, 0, '0000-00-00', '0.00', '0.00', '', 0, 0, 1, 0, '2011-04-20 00:00:00', '2011-05-04 12:53:51', '/media/1/products/1299143354-1_s.jpg', '/media/1/products/1299143353.jpg,/media/1/products/1299143353-1.jpg,/media/1/products/1299143354.jpg,/media/1/products/1299143354-1.jpg|1', '', 'a:2:{s:4:"attr";a:2:{i:1;a:1:{i:0;s:4:"1-2L";}i:2;a:1:{i:0;s:4:"200W";}}s:4:"aimg";N;}', 'a:0:{}', 70, 'asdf', 'asdf', 'asdf', 0, 0, 153, 1, 1, '', 2, 0),
(80, '新建 格力电饭煲 GD-303A 新品上市 ', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n1、首创&ldquo;省电精煮&rdquo;和&ldquo;省时快煮&rdquo;两种模式，节能又省心<br />\r\n2、螺纹聚能式高效发热盘<br />\r\n3、一体式气辅注塑增强性上盖厚达6.0mm, 耐温耐压不变形<br />\r\n4、创新小球式微压力蒸汽阀, 防溢有新招<br />\r\n5、点阵式防疑露保温座板, 水滴难烂饭<br />\r\n6、煮饭煮粥双重功能选择<br />\r\n7、2.0mm黑厚金刚内锅, 硬质氧化表面超级耐磨, 美国华福健康不粘涂层<br />\r\n<br />\r\n<strong>基本参数：</strong><br />\r\n额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：500W</p>\r\n<p>&nbsp;</p>\r\n<p><strong>保修政策：</strong><br />\r\n1、整机包修一年<br />\r\n2、产品附件包修期：购买产品赠送的附件，包修三个月<br />\r\n3、下列情况不属于包修服务范围，但可实行收费维修<br />\r\n（1）消费者因使用、维护、保管不当及不可抗拒力造成损坏的。<br />\r\n（2）非格力特约服务网点拆动、修理造成损坏的（包括消费者自动拆动、修理）。<br />\r\n（3）无有效凭证及购机凭证型号与修理产品型号不符的。<br />\r\n（4）工厂或经销单位已注明作降价处理的&ldquo;处理品&rdquo;、&ldquo;特价品&rdquo;以及已超过包修期的产品。<br />\r\n（5）由于电源电压不稳定及超出正常电压范围或电源线路安装不符合国家电气安装要求而造成产品损坏的。<br />\r\n4、包修期界定：以开具发票（或有效售货凭证的）时间开始进行计算；没有的，以出厂日期顺延三个月为包修期起算时间。<br />\r\n<br />\r\n<strong>包换政策：</strong><br />\r\n包修有效期内，符合下列条件，而且用户拒绝维修的，可以换机。换机后的三包有效期自换机之日起重新计算<br />\r\n1、产品自售出之日起15日内，发生主要性能故障，不能正常使用；<br />\r\n2、主要性能故障连续修理二次，仍不能正常使用的；<br />\r\n3、自用户送修之日起因厂家原因超过30日（国家规定为90天）未能修复的；<br />\r\n4、因修理者自身原因使修理超过30日的，由其免费为消费者调换同型号同规格的产品，费用由修理者承担；<br />\r\n5、对有争议的，经销售公司及办事处售后经理核准的；<br />\r\n6、换货只换主机，其他附件、赠品和包装不在换货范围之内；<br />\r\n<br />\r\n<strong>包退政策：</strong><br />\r\n包修有效期内，符合下列条件，且用户拒绝维修或换机的，可以退机；<br />\r\n1、产品自售出之日起7日内，发生主要性能故障，不能正常使用的；<br />\r\n2、主要性能连续二次以上无法修复，用户坚持退机的；<br />\r\n3、对有争议，情况特殊的，经销售公司及办事处售后经理核准的。<br />\r\n<br />\r\n备注<br />\r\n1、国家&ldquo;三包&rdquo;政策仅适用于产品本身质量问题；由于火灾、地震等不可抗拒因素及其他人为因素而造成的产品损坏或使用 不满意等均不属于三包处理范围；<br />\r\n2、赠品：享受同等的三包服务政策。购买其它商品赠送格力小家电产品的，以相关商品的有效购买单据出据日为三包计算起止 日，具体机型以单据上注明的小家电赠品名称、型号规格、数量为依据。</p>', '', 'GD-303A', '767.64', '119.00', '0.00', 0, 0, 0, '0000-00-00', '100.00', '200.00', '', 0, 0, 2, 0, '2011-04-20 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298428582_s.jpg', '/media/1/products/1298428582.jpg|1', '', '', NULL, 18, '', '', '', 0, 0, 25, 1, 1, '', 0, 0),
(81, '格力电暖器 NSW-9 二管 石英管 取暖器 ', '', '<p><img src="/media/1/products/NSK-9-1.jpg" alt="" /><img src="/media/1/products/NSK-9-2.jpg" alt="" /><img src="/media/1/products/NSK-9-4.jpg" alt="" /><img src="/media/1/products/NSK-9-5.jpg" alt="" /><br />\r\n&nbsp;</p>\r\n<p><strong>产品特性：</strong><br />\r\n<br />\r\n★400W/800W两档功率可调<br />\r\n★石英管发热体，即开即暖<br />\r\n★镜面反射板，辐射范围广，热量传递效率高<br />\r\n★体积小巧，放置自由；<br />\r\n★电源插头配置内胆，更安全<br />\r\n★跌倒自动关机保护，安全可靠<br />\r\n★高稳定性，置于15&deg;斜台上不翻到<br />\r\n★全封闭结构设计，符合国家安全标准。<br />\r\n经过严格的测试，安全性能好；<br />\r\n<br />\r\n* 型号/规格：NSW-8<br />\r\n* 额定电压及定额频率：220V~50hz<br />\r\n* 输入/输出功率：800W<br />\r\n* 尺寸：180mm*225mm*430mm<br />\r\n* 毛重：2.30<br />\r\n* 净重: 1.60<br />\r\n* 适用面积:&lt;15平米<br />\r\n<!--15--></p>', '', 'NSW-9', '881.19', '75.00', '0.00', 2, 0, 0, '0000-00-00', '0.00', '0.00', '', 0, 0, 8, 0, '2011-04-20 00:00:00', '2011-05-04 12:53:51', '/media/1/products/1299143354-1_s.jpg', '/media/1/products/1299143353.jpg,/media/1/products/1299143353-1.jpg,/media/1/products/1299143354.jpg,/media/1/products/1299143354-1.jpg|1', '', 'a:2:{s:4:"attr";a:2:{i:1;a:1:{i:0;s:4:"1-2L";}i:2;a:1:{i:0;s:4:"200W";}}s:4:"aimg";N;}', 'a:0:{}', 68, 'asdf', 'asdf', 'asdf', 0, 0, 198, 1, 1, '', 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `w_products_activity`
--

DROP TABLE IF EXISTS `w_products_activity`;
CREATE TABLE IF NOT EXISTS `w_products_activity` (
  `act_id` mediumint(8) unsigned NOT NULL auto_increment,
  `act_name` varchar(255) NOT NULL,
  `act_remark` varchar(255) default NULL,
  `act_desc` text NOT NULL,
  `act_type` tinyint(3) unsigned NOT NULL,
  `products_id` mediumint(8) unsigned NOT NULL,
  `catid` mediumint(8) NOT NULL default '0',
  `products_name` varchar(255) NOT NULL,
  `img` varchar(50) default NULL,
  `product_amount` mediumint(4) NOT NULL default '0',
  `purchase_num` mediumint(4) NOT NULL default '0' COMMENT '已购买数量',
  `purchase_people` mediumint(4) NOT NULL default '0' COMMENT '购买人数',
  `market_price` float(8,2) NOT NULL default '0.00',
  `shop_price` float(8,2) NOT NULL default '0.00',
  `start_time` int(10) unsigned NOT NULL,
  `end_time` int(10) unsigned NOT NULL,
  `is_finished` tinyint(3) unsigned NOT NULL,
  `ext_info` text NOT NULL,
  `uid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`act_id`),
  KEY `act_name` (`act_name`,`act_type`,`products_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `w_products_activity`
--

INSERT INTO `w_products_activity` (`act_id`, `act_name`, `act_remark`, `act_desc`, `act_type`, `products_id`, `catid`, `products_name`, `img`, `product_amount`, `purchase_num`, `purchase_people`, `market_price`, `shop_price`, `start_time`, `end_time`, `is_finished`, `ext_info`, `uid`) VALUES
(15, '格力电风扇FSLD-40 扇头360°循环送风 低压启动', NULL, '', 2, 25, 3, '电风扇', '/media/1/products/1298440635.jpg', 5, 0, 0, 0.00, 30.00, 1302825600, 1309305600, 0, 'a:5:{s:7:"deposit";i:0;s:15:"restrict_amount";i:0;s:13:"gift_integral";i:0;s:13:"ladder_amount";N;s:12:"ladder_price";N;}', 1),
(16, '格力暖风机取暖器NBFB-21', NULL, '', 2, 64, 8, '电暖器', '/media/1/products/1299140697.jpg', 50, 0, 0, 0.00, 66.00, 1306281600, 1307607840, 4, 'a:5:{s:7:"deposit";i:0;s:15:"restrict_amount";i:0;s:13:"gift_integral";i:0;s:13:"ladder_amount";N;s:12:"ladder_price";N;}', 1),
(20, 'asdfasdf', NULL, '', 5, 67, 0, '电暖器', '/media/1/products/1299143354-1_s.jpg', 23, 0, 0, 0.00, 234234.00, 1303084800, 1310947200, 0, 'a:5:{s:7:"deposit";i:0;s:15:"restrict_amount";i:0;s:13:"gift_integral";i:0;s:13:"ladder_amount";N;s:12:"ladder_price";N;}', 1),
(13, '格力(GREE) 变频王者之尊系列 家用空调KFR-72LW(72561)Ab-2', '变频王者之尊系列 家用空调KFR-72LW(72561)Ab-2', '<p>asdfasfd</p>', 1, 419, 0, '格力防水防火防漏电浴居两用暖风机取暖器/电暖器NBFB-21', '/media/1/products/1299138542.jpg', 0, 0, 4, 99.99, 2000.00, 1306886400, 1307750400, 0, 'a:5:{s:7:"deposit";i:122;s:15:"restrict_amount";i:5;s:13:"gift_integral";i:0;s:13:"ladder_amount";a:1:{i:0;s:3:"100";}s:12:"ladder_price";a:1:{i:0;s:4:"2000";}}', 1),
(26, '格力防水防火防漏电浴居两用暖风机取暖器/电暖器NBFB-21 ', NULL, '', 3, 61, 8, '格力防水防火防漏电浴居两用暖风机取暖器/电暖器NBFB-21 ', '/media/1/products/1299138542.jpg', 5, 1, 1, 0.00, 155.00, 1307692800, 1307707200, 0, 'a:5:{s:7:"deposit";i:0;s:15:"restrict_amount";i:0;s:13:"gift_integral";i:5;s:13:"ladder_amount";N;s:12:"ladder_price";N;}', 1),
(17, '格力电风扇FSLD-40 扇头360°循环送风 低压启动', NULL, '', 2, 29, 3, '电风扇', '/media/1/products/1298445546.jpg', 30, 0, 0, 0.00, 23.00, 1302825600, 1307404800, 3, 'a:5:{s:7:"deposit";i:0;s:15:"restrict_amount";i:0;s:13:"gift_integral";i:0;s:13:"ladder_amount";N;s:12:"ladder_price";N;}', 1),
(28, '格力防水防火防漏电浴居两用暖风机取暖器/电暖器NBFB-21 ', NULL, '', 3, 61, 8, '格力防水防火防漏电浴居两用暖风机取暖器/电暖器NBFB-21 ', '/media/1/products/1299138542_s.jpg', 20, 0, 0, 0.00, 188.00, 1307613600, 1307620800, 0, 'a:5:{s:7:"deposit";i:0;s:15:"restrict_amount";i:0;s:13:"gift_integral";i:0;s:13:"ladder_amount";N;s:12:"ladder_price";N;}', 1),
(23, '', NULL, '', 2, 62, 8, '格力取暖器 电暖器 PTC暖风机 QG20D 居浴两用 ', '/media/1/products/200/1299139434.jpg', 0, 0, 0, 0.00, 0.00, 0, 0, 0, 'a:5:{s:7:"deposit";i:0;s:15:"restrict_amount";i:0;s:13:"gift_integral";i:0;s:13:"ladder_amount";N;s:12:"ladder_price";N;}', 1),
(24, '', NULL, '', 2, 5, 1, '格力 GC-2106 电磁炉 送汤锅+炒锅 含机打发票，全国联保 ', '/media/1/products/1298360947.jpg', 0, 0, 0, 0.00, 0.00, 0, 0, 0, 'a:5:{s:7:"deposit";i:0;s:15:"restrict_amount";i:0;s:13:"gift_integral";i:0;s:13:"ladder_amount";N;s:12:"ladder_price";N;}', 1),
(25, '格力电饭煲 GD-303A 新品上市 ', NULL, '', 3, 80, 2, '新建 格力电饭煲 GD-303A 新品上市 ', '/media/1/products/1298428582.jpg', 20, 3, 3, 0.00, 88.00, 1307606400, 1307613900, 0, 'a:5:{s:7:"deposit";i:0;s:15:"restrict_amount";i:0;s:13:"gift_integral";i:0;s:13:"ladder_amount";N;s:12:"ladder_price";N;}', 1),
(22, '格力电暖器FGK-12 格力红外线取暖器 节能环保', NULL, '', 3, 64, 8, '格力电暖器FGK-12 格力红外线取暖器 节能环保 ', '/media/1/products/1299140697.jpg', 10, 0, 0, 355.00, 350.00, 1307422800, 1307433600, 0, 'a:5:{s:7:"deposit";i:0;s:15:"restrict_amount";i:0;s:13:"gift_integral";i:0;s:13:"ladder_amount";N;s:12:"ladder_price";N;}', 1),
(29, '', NULL, '', 5, 60, 8, '格力电暖器暖风机 电暖器 浴居两用KNT-15 ', '/media/1/products/200/1299137697_s.jpg', 20, 0, 0, 600.00, 250.00, 1307664000, 1308096000, 0, 'a:5:{s:7:"deposit";i:0;s:15:"restrict_amount";i:0;s:13:"gift_integral";i:0;s:13:"ladder_amount";N;s:12:"ladder_price";N;}', 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_products_attribute`
--

DROP TABLE IF EXISTS `w_products_attribute`;
CREATE TABLE IF NOT EXISTS `w_products_attribute` (
  `attr_id` smallint(5) unsigned NOT NULL auto_increment,
  `type_id` smallint(5) unsigned NOT NULL default '0',
  `attr_name` varchar(60) NOT NULL default '',
  `attr_input_type` tinyint(1) unsigned NOT NULL default '1',
  `attr_type` tinyint(1) unsigned NOT NULL default '1',
  `attr_values` text NOT NULL,
  `attr_index` tinyint(1) unsigned NOT NULL default '0',
  `ordering` tinyint(3) unsigned NOT NULL default '0',
  `is_linked` tinyint(1) unsigned NOT NULL default '0',
  `attr_group` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`attr_id`),
  KEY `cat_id` (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `w_products_attribute`
--

INSERT INTO `w_products_attribute` (`attr_id`, `type_id`, `attr_name`, `attr_input_type`, `attr_type`, `attr_values`, `attr_index`, `ordering`, `is_linked`, `attr_group`) VALUES
(1, 1, '容量', 0, 1, '1:1-2L\n2: 3-4L\n3: 4-5L \n4:5-6L', 0, 0, 0, 0),
(2, 1, '功率', 0, 1, '5:60W\n6:200W\n7:1000W\n8:2000W', 0, 0, 0, 0),
(10, 1, '订单', 1, 0, '12:订单1\n13:订单2', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `w_products_attr_v`
--

DROP TABLE IF EXISTS `w_products_attr_v`;
CREATE TABLE IF NOT EXISTS `w_products_attr_v` (
  `products_id` mediumint(8) unsigned NOT NULL default '0',
  `attr_id` smallint(5) unsigned NOT NULL default '0',
  `attr_value_id` mediumint(8) unsigned NOT NULL default '0',
  KEY `goods_id` (`products_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_products_attr_v`
--

INSERT INTO `w_products_attr_v` (`products_id`, `attr_id`, `attr_value_id`) VALUES
(67, 1, 1),
(67, 2, 6),
(8, 1, 4),
(8, 2, 5),
(62, 2, 0),
(60, 2, 0),
(58, 2, 0),
(68, 2, 0),
(69, 2, 0),
(49, 2, 0),
(22, 1, 2),
(22, 2, 5),
(33, 2, 0),
(48, 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `w_products_attr_values`
--

DROP TABLE IF EXISTS `w_products_attr_values`;
CREATE TABLE IF NOT EXISTS `w_products_attr_values` (
  `value_id` mediumint(8) unsigned NOT NULL auto_increment,
  `attr_id` mediumint(8) unsigned NOT NULL default '0',
  `value` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `ordering` mediumint(8) unsigned NOT NULL default '50',
  PRIMARY KEY  (`value_id`,`value`),
  KEY `fk_spec_value` (`attr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `w_products_attr_values`
--

INSERT INTO `w_products_attr_values` (`value_id`, `attr_id`, `value`, `image`, `ordering`) VALUES
(1, 1, '1-2L', '', 0),
(2, 1, ' 3-4L', '', 1),
(3, 1, ' 4-5L ', '', 2),
(4, 1, '5-6L', '', 3),
(5, 2, '60W', '', 0),
(6, 2, '200W', '', 1),
(7, 2, '1000W', '', 2),
(8, 2, '2000W', '', 3),
(9, 4, '', '', 0),
(10, 4, '', '', 1),
(11, 9, '效率1', '', 0),
(12, 10, '订单1', '', 0),
(13, 10, '订单2', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_products_cat`
--

DROP TABLE IF EXISTS `w_products_cat`;
CREATE TABLE IF NOT EXISTS `w_products_cat` (
  `products_id` mediumint(8) unsigned NOT NULL default '0',
  `cat_id` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`products_id`,`cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_products_cat`
--

INSERT INTO `w_products_cat` (`products_id`, `cat_id`) VALUES
(1, 1),
(1, 2),
(68, 1),
(69, 2),
(78, 2);

-- --------------------------------------------------------

--
-- 表的结构 `w_products_comment`
--

DROP TABLE IF EXISTS `w_products_comment`;
CREATE TABLE IF NOT EXISTS `w_products_comment` (
  `comment_id` int(10) unsigned NOT NULL auto_increment,
  `comment_type` tinyint(3) unsigned NOT NULL default '0',
  `products_id` mediumint(8) unsigned NOT NULL default '0',
  `email` varchar(60) NOT NULL default '',
  `author` varchar(60) NOT NULL,
  `content` text NOT NULL,
  `comment_rank` tinyint(1) unsigned NOT NULL default '0',
  `created` int(11) NOT NULL default '0',
  `ip_address` varchar(15) NOT NULL default '',
  `published` tinyint(1) unsigned NOT NULL default '0',
  `parent_id` int(10) unsigned NOT NULL default '0',
  `uid` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`comment_id`),
  KEY `parent_id` (`parent_id`),
  KEY `id_value` (`products_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `w_products_comment`
--

INSERT INTO `w_products_comment` (`comment_id`, `comment_type`, `products_id`, `email`, `author`, `content`, `comment_rank`, `created`, `ip_address`, `published`, `parent_id`, `uid`) VALUES
(17, 0, 30, 'whl308221710@163.com', 'china', '大得多', 0, 1307587468, '', 0, 16, 1),
(16, 0, 30, '', 'luoqin', '电热水壶GK-CS1310DA用电多少', 0, 1307436198, '', 0, 0, 123),
(13, 0, 9, 'whl308221710@163.com', 'china', '您好，这个商品包修时间是一年，请放心购买，谢谢！', 0, 1304058715, '', 0, 12, 1),
(15, 0, 60, 'whl308221710@163.com', 'china', '收购个恩恩订单', 0, 1307586777, '', 0, 14, 1),
(14, 0, 60, '', 'test12', '是大噶送哥哥', 0, 1306294984, '', 1, 0, 124),
(12, 0, 9, '', 'testtest2', '你好，请问一下，这个商品包修时间是多长', 0, 1303958542, '', 1, 0, 109);

-- --------------------------------------------------------

--
-- 表的结构 `w_products_fav`
--

DROP TABLE IF EXISTS `w_products_fav`;
CREATE TABLE IF NOT EXISTS `w_products_fav` (
  `id` int(11) NOT NULL auto_increment,
  `products_id` int(11) NOT NULL default '0' COMMENT '产品ID',
  `mid` int(11) NOT NULL default '0' COMMENT '经销商ID',
  `uid` int(11) NOT NULL default '0' COMMENT '会员ID',
  `created` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `products_id` (`products_id`,`mid`,`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- 转存表中的数据 `w_products_fav`
--

INSERT INTO `w_products_fav` (`id`, `products_id`, `mid`, `uid`, `created`) VALUES
(20, 212, 0, 1, '2011-02-24 12:12:11'),
(19, 218, 0, 1, '2011-02-24 12:12:09'),
(18, 222, 0, 1, '2011-02-24 12:12:06'),
(17, 227, 0, 1, '2011-02-24 12:12:03'),
(16, 129, 0, 1, '2011-02-23 15:50:15'),
(25, 288, 1, 89, '2011-02-28 17:41:36'),
(23, 152, 1, 1, '2011-02-25 10:13:20'),
(26, 312, 1, 89, '2011-03-01 16:36:54'),
(27, 311, 89, 89, '2011-03-01 16:39:02'),
(28, 311, 1, 89, '2011-03-01 17:26:43'),
(29, 317, 1, 89, '2011-03-02 10:12:49'),
(30, 316, 1, 89, '2011-03-02 10:25:25'),
(32, 155, 89, 89, '2011-03-02 10:35:08'),
(33, 426, 1, 89, '2011-03-04 14:11:53'),
(35, 259, 89, 89, '2011-03-16 11:29:54'),
(36, 293, 116, 89, '2011-03-16 11:40:20'),
(37, 425, 116, 89, '2011-03-16 11:46:56'),
(49, 267, 89, 89, '2011-03-17 12:33:49'),
(48, 293, 1, 89, '2011-03-16 17:27:53'),
(62, 11, 1, 89, '2011-04-29 13:43:34'),
(61, 65, 1, 89, '2011-04-26 15:39:24'),
(60, 10, 1, 89, '2011-04-25 11:11:18'),
(63, 37, 1, 89, '2011-04-29 13:44:19'),
(66, 42, 123, 89, '2011-05-24 10:11:21');

-- --------------------------------------------------------

--
-- 表的结构 `w_products_group`
--

DROP TABLE IF EXISTS `w_products_group`;
CREATE TABLE IF NOT EXISTS `w_products_group` (
  `parent_id` mediumint(8) unsigned NOT NULL default '0',
  `products_id` mediumint(8) unsigned NOT NULL default '0',
  `products_price` decimal(10,2) unsigned NOT NULL default '0.00',
  `admin_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`parent_id`,`products_id`,`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_products_group`
--

INSERT INTO `w_products_group` (`parent_id`, `products_id`, `products_price`, `admin_id`) VALUES
(9, 4, '58.00', 1),
(9, 3, '68.00', 1),
(9, 7, '100.00', 1),
(14, 5, '20.00', 1),
(14, 6, '42.00', 1),
(14, 7, '100.00', 1),
(141, 135, '0.00', 0),
(129, 142, '232.32', 0),
(129, 143, '0.00', 0),
(144, 129, '23.00', 0),
(144, 130, '32.00', 0),
(144, 135, '2618.00', 0),
(144, 144, '12.00', 0),
(143, 140, '0.00', 0),
(143, 143, '0.00', 0),
(143, 144, '0.00', 0);

-- --------------------------------------------------------

--
-- 表的结构 `w_products_link`
--

DROP TABLE IF EXISTS `w_products_link`;
CREATE TABLE IF NOT EXISTS `w_products_link` (
  `products_id` mediumint(8) unsigned NOT NULL default '0',
  `products_link_id` mediumint(8) unsigned NOT NULL default '0',
  `is_double` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`products_id`,`products_link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_products_link`
--

INSERT INTO `w_products_link` (`products_id`, `products_link_id`, `is_double`) VALUES
(11, 37, 1),
(11, 1, 1),
(11, 36, 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_products_series`
--

DROP TABLE IF EXISTS `w_products_series`;
CREATE TABLE IF NOT EXISTS `w_products_series` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(60) NOT NULL COMMENT '产品名称',
  `introtext` mediumtext COMMENT '产品简介',
  `thumbnail` varchar(255) default NULL COMMENT '缩略图',
  `images` text NOT NULL COMMENT '产品图片',
  `attribs` text NOT NULL COMMENT '相关属性',
  `published` tinyint(1) NOT NULL default '0',
  `quantily` tinyint(4) NOT NULL default '0',
  `uid` int(11) NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=193 ;

--
-- 转存表中的数据 `w_products_series`
--

INSERT INTO `w_products_series` (`id`, `name`, `introtext`, `thumbnail`, `images`, `attribs`, `published`, `quantily`, `uid`, `ordering`) VALUES
(156, 'KFR-23GW/Q(23550)FdNA1-N4', '', '/media/1/products/1298428343_s.jpg', '/media/1/products/1298428343.jpg', '', 1, 1, 1, 11),
(155, 'KFR-35GW/(3550)FNAa-3 ', '', '/media/1/products/1298426926_s.jpg', '/media/1/products/1298426926.jpg', '', 1, 1, 1, 10),
(154, 'KFR-32GW/(32550)FNAa-3', '', '/media/1/products/1298425585.jpg', '/media/1/products/1298425585.jpg', '', 1, 1, 1, 9),
(139, '睡美人系列', '', '/media/1/products/1298968092_s.jpg', '/media/1/products/1298968092.jpg|1,/media/1/products/1298968093.jpg,/media/1/products/1298968201.jpg,/media/1/products/1298968216.jpg', '', 1, 4, 0, 1),
(147, 'KFR-26GW/E(26541)', '', '/media/1/products/1298342898_s.jpg', '/media/1/products/1298342898.jpg|1', '', 1, 1, 1, 3),
(148, 'KFR-26GW/K(26538)Fd', '', '/media/1/products/1298345900_s.jpg', '/media/1/products/1298345900.jpg', '', 1, 1, 1, 5),
(149, 'KFR-35GW/E(3554)FdNA1-N1', '', '/media/1/products/1298356705_s.jpg', '/media/1/products/1298356705.jpg', '', 1, 1, 1, 2),
(150, ' KFR-35GN/E(35541)FdNA', '', '/media/1/products/1298359933_s.jpg', '/media/1/products/1298359933.jpg', '', 1, 1, 1, 4),
(151, '睡梦宝系列', '', '/media/1/products/1298362912_s.jpg', '/media/1/products/1298362912.jpg,/media/1/products/1299031621.jpg,/media/1/products/1299031621-1.jpg,/media/1/products/1299031745.jpg', '', 1, 4, 1, 6),
(152, 'KFR-23GW/(23550)FNAa-3', '', '/media/1/products/1298364755_s.jpg', '/media/1/products/1298364755.jpg', '', 1, 1, 1, 7),
(153, 'KFR-26GW/(26550)FNAa-3', '', '/media/1/products/1298424310_s.jpg', '/media/1/products/1298424310.jpg', '', 1, 1, 1, 8),
(157, 'KFR-26GW/Q(26550)FdNA1-N4 ', '', '/media/1/products/1298430668_s.jpg', '/media/1/products/1298430668.jpg', '', 1, 1, 1, 12),
(158, 'KFR-26GW/(26556)FNFa-3', '', '/media/1/products/1298433925_s.jpg', '/media/1/products/1298433925.jpg', '', 1, 1, 1, 13),
(159, 'KFR-32GW/(32556)FNFa-3', '', '/media/1/products/1298440107_s.jpg', '/media/1/products/1298440107.jpg', '', 1, 1, 1, 14),
(160, 'KFR-26GW/(26556)FNDc-3', '', '/media/1/products1298441871_s.jpg', '/media/1/products1298441871.jpg', '', 1, 1, 1, 15),
(161, 'KFR-26GW/(26556)FNAe-3', '', '/media/1/products/1298444868_s.jpg', '/media/1/products/1298444868.jpg', '', 1, 1, 1, 16),
(162, 'KFR-26GW/(26556)FNPa-4', '', '/media/1/products/1298447087_s.jpg', '/media/1/products/1298447087.jpg', '', 1, 1, 1, 17),
(163, 'U酷 KFR-26GW/(26561)FNAa-3', '', '/media/1/products/1298454105_s.jpg', '/media/1/products/1298454105.jpg,/media/1/products/1298454106.jpg|1,/media/1/products/1298454107.jpg|1', '', 1, 3, 1, 18),
(164, 'U雅 KFR-26GW/(26561)FNCa-2', '', '/media/1/products/1298602728_s.jpg', '/media/1/products/1298602728.jpg|1,/media/1/products/1298602729.jpg,/media/1/products/1298602729-1.jpg', '', 1, 3, 1, 19),
(165, 'U铂 KFR-26GW/(26561)FNBa-2 ', '', '/media/1/products/1298613153_s.jpg', '/media/1/products/1298613153.jpg|1,/media/1/products/1298613154.jpg,/media/1/products/1298613155.jpg', '', 1, 3, 1, 20),
(166, 'i铂', '', '/media/1/products/1298621255_s.jpg', '/media/1/products/1298621255.jpg|1,/media/1/products/1298621264.jpg,/media/1/products/1298621274.jpg', '', 1, 3, 1, 21),
(167, 'i酷', '', '/media/1/products/1298624625_s.jpg', '/media/1/products/1298624625.jpg|1,/media/1/products/1298624639.jpg,/media/1/products/1298624648.jpg', '', 1, 3, 1, 22),
(169, '变频王者之尊系列 ', '', '/media/1/products/1298872469_s.jpg', '/media/1/products/1298872469.jpg|1,/media/1/products/1298872470.jpg,/media/1/products/1298872471.jpg,/media/1/products/1298872472.jpg', '', 1, 4, 1, 23),
(170, '变频王者风尚系列', '', '/media/1/products/1298875304_s.jpg', '/media/1/products/1298875304.jpg|1,/media/1/products/1298875305.jpg,/media/1/products/1298875305-1.jpg', '', 1, 3, 1, 24),
(171, '变频王者风度系列', '', '/media/1/products/1298877278_s.jpg', '/media/1/products/1298877278.jpg|1,/media/1/products/1298877279.jpg', '', 1, 2, 1, 25),
(172, '变频悦轩风系列', '', '/media/1/products/1298879951_s.jpg', '/media/1/products/1298879951.jpg|1,/media/1/products/1298879952.jpg', '', 1, 2, 1, 26),
(173, '变频风影系列', '', '/media/1/products/1298881639_s.jpg', '/media/1/products/1298881639.jpg|1,/media/1/products/1298881639-1.jpg,', '', 1, 2, 1, 27),
(174, '变频蓝海湾系列', '', '/media/1/products/1298882914_s.jpg', '/media/1/products/1298882914.jpg|1,/media/1/products/1298882915.jpg', '', 1, 2, 1, 28),
(175, '变频蓝精灵系列', '', '/media/1/products/1298884655_s.jpg', '/media/1/products/1298884655.jpg|1,/media/1/products/1298884656.jpg', '', 1, 2, 1, 29),
(176, '变频凯迪斯', '', '/media/1/products/1298885912_s.jpg', '/media/1/products/1298885912.jpg|1', '', 1, 1, 1, 30),
(177, '节能王子系列', '', '/media/1/products/1299043024-1_s.jpg', '/media/1/products/1299043023.jpg|1,/media/1/products/1299043024.jpg,/media/1/products/1299043024-1.jpg,/media/1/products/1299043025.jpg,/media/1/products/1299043043.jpg', '', 1, 5, 1, 31),
(178, '玉堂春(新品)', '', '/media/1/products/1299048224_s.jpg', '/media/1/products/1299048224.jpg|1,/media/1/products/1299048233.jpg', '', 1, 2, 1, 32),
(179, '绿满园系列', '', '/media/1/products/1299050293_s.jpg', '/media/1/products/1299050271.jpg|1,/media/1/products/1299050293.jpg', '', 1, 2, 1, 33),
(180, '绿嘉园系列', '', '/media/1/products/1299053870_s.jpg', '/media/1/products/1299053870.jpg|1,/media/1/products/1299053876.jpg', '', 1, 2, 1, 34),
(181, '凉之夏系列', '', '/media/1/products/1299056159_s.jpg', '/media/1/products/1299056146.jpg|1,/media/1/products/1299056159.jpg', '', 1, 2, 1, 35),
(182, '清巧系列', '', '/media/1/products/1299058743_s.jpg', '/media/1/products/1299058728.jpg|1,/media/1/products/1299058743.jpg', '', 1, 2, 1, 36),
(183, '玉雅春(新品)系列', '', '/media/1/products/1299125270_s.jpg', '/media/1/products/1299125270.jpg|1,/media/1/products/1299125271.jpg,/media/1/products/1299125283.jpg', '', 1, 3, 1, 37),
(184, '悦风系列', '', '/media/1/products/1299131149_s.jpg', '/media/1/products/1299131141.jpg|1,/media/1/products/1299131149.jpg', '', 1, 2, 1, 38),
(185, '王者独尊系列', '', '/media/1/products/1299136781_s.jpg', '/media/1/products/1299136781.jpg|1,/media/1/products/1299136782.jpg,/media/1/products/1299136782-1.jpg,/media/1/products/1299136783.jpg,/media/1/products/1299136796.jpg', '', 1, 5, 1, 39),
(186, '王者之尊系列', '', '/media/1/products/1299138874_s.jpg', '/media/1/products/1299138874.jpg|1,/media/1/products/1299138876.jpg,/media/1/products/1299138877.jpg,/media/1/products/1299138878.jpg,/media/1/products/1299138886.jpg', '', 1, 5, 1, 40),
(187, '王者风尚定频系列', '', '/media/1/products/1299219338_s.jpg', '/media/1/products/1299219338.jpg|1,/media/1/products/1299219339.jpg,/media/1/products/1299219340.jpg,/media/1/products/1299219352.jpg', '', 1, 4, 1, 41),
(188, '花开富贵系列', '', '/media/1/products/1299224095_s.jpg', '/media/1/products/1299224095.jpg|1,/media/1/products/1299224110.jpg', '', 1, 2, 1, 42),
(189, '御景风系列', '', '/media/1/products/1299228709_s.jpg', '/media/1/products/1299228709.jpg|1,/media/1/products/1299228709-1.jpg,/media/1/products/1299228712.jpg,/media/1/products/1299228751.jpg', '', 1, 4, 1, 43),
(190, '风和系列', '', '/media/1/products/1299462871_s.jpg', '/media/1/products/1299462811.jpg|1,/media/1/products/1299462871.jpg', '', 1, 2, 1, 44),
(191, '清新风系列', '', '/media/1/products/1299465810_s.jpg', '/media/1/products/1299465794.jpg|1,/media/1/products/1299465810.jpg', '', 1, 2, 1, 45),
(192, '定频蓝精灵系列', '', '/media/1/products/1299481144_s.jpg', '/media/1/products/1299481144.jpg|1,/media/1/products/1299481195.jpg,/media/1/products/1299481298.jpg', '', 1, 3, 1, 46);

-- --------------------------------------------------------

--
-- 表的结构 `w_products_spec`
--

DROP TABLE IF EXISTS `w_products_spec`;
CREATE TABLE IF NOT EXISTS `w_products_spec` (
  `products_spec_id` int(10) unsigned NOT NULL auto_increment,
  `products_id` mediumint(8) unsigned NOT NULL default '0',
  `pn` varchar(50) default NULL,
  `spec_value` text NOT NULL,
  `spec_price` varchar(255) NOT NULL,
  `cost` float NOT NULL COMMENT '成本价',
  `weight` float NOT NULL COMMENT '重量',
  `store` varchar(20) default NULL COMMENT '库存',
  PRIMARY KEY  (`products_spec_id`),
  KEY `goods_id` (`products_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `w_products_spec`
--

INSERT INTO `w_products_spec` (`products_spec_id`, `products_id`, `pn`, `spec_value`, `spec_price`, `cost`, `weight`, `store`) VALUES
(1, 142, '1', '0,0,0,0,0,0', '21', 123, 32, '12'),
(13, 142, '32', '0,0,0,0,0,0', '23', 23, 23, '3'),
(16, 144, '23', '0', '12', 0, 0, ''),
(15, 144, 'sa', '0', '23', 0, 0, ''),
(14, 142, '23', '0,0,0,0,0,0', '23', 23, 23, '2'),
(8, 141, '1', 'aswdf,safd,0,0,0,0', '23', 123, 32, '23'),
(9, 141, '2', 'asdf,safd,0,0,0,0', '23', 0, 0, '12'),
(10, 141, '3', 'asfd,safd,asfd,0,0,0', '23', 0, 0, ''),
(11, 141, '4', 'asfd222,safd,0,0,0,0', '23', 0, 0, ''),
(17, 143, '', '0', '', 0, 0, ''),
(18, 146, '234214', '0', '', 0, 0, ''),
(19, 146, 'safaw', '0', '', 0, 0, ''),
(20, 146, 'sadf', '0', '', 0, 0, ''),
(21, 171, '', '0', '', 0, 0, ''),
(22, 318, '', '2', '', 0, 0, ''),
(23, 518, 'asdf', '0,', '', 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `w_products_specification`
--

DROP TABLE IF EXISTS `w_products_specification`;
CREATE TABLE IF NOT EXISTS `w_products_specification` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(60) NOT NULL,
  `spec_type` tinyint(1) NOT NULL default '0' COMMENT '显示类型',
  `spec_show_type` tinyint(1) NOT NULL default '0' COMMENT '显示方式',
  `published` tinyint(1) unsigned NOT NULL default '1',
  `attr_group` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `w_products_specification`
--

INSERT INTO `w_products_specification` (`id`, `name`, `spec_type`, `spec_show_type`, `published`, `attr_group`) VALUES
(4, '机型', 1, 1, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `w_products_spec_values`
--

DROP TABLE IF EXISTS `w_products_spec_values`;
CREATE TABLE IF NOT EXISTS `w_products_spec_values` (
  `spec_value_id` mediumint(8) unsigned NOT NULL auto_increment,
  `spec_id` mediumint(8) unsigned NOT NULL default '0',
  `spec_value` varchar(100) NOT NULL default '',
  `spec_image` varchar(255) NOT NULL default '',
  `ordering` mediumint(8) unsigned NOT NULL default '50',
  PRIMARY KEY  (`spec_value_id`,`spec_value`),
  KEY `fk_spec_value` (`spec_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- 转存表中的数据 `w_products_spec_values`
--

INSERT INTO `w_products_spec_values` (`spec_value_id`, `spec_id`, `spec_value`, `spec_image`, `ordering`) VALUES
(32, 4, 'asfd', '', 1),
(33, 4, 'asfd', '', 2),
(38, 4, '1', '', 0),
(42, 4, '', '', 3);

-- --------------------------------------------------------

--
-- 表的结构 `w_products_tag_relation`
--

DROP TABLE IF EXISTS `w_products_tag_relation`;
CREATE TABLE IF NOT EXISTS `w_products_tag_relation` (
  `tags_id` int(11) NOT NULL COMMENT '标签ID',
  `products_id` int(11) NOT NULL COMMENT '产品ID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_products_tag_relation`
--

INSERT INTO `w_products_tag_relation` (`tags_id`, `products_id`) VALUES
(1, 133),
(2, 133),
(1, 130),
(3, 130),
(4, 134),
(5, 135),
(6, 136),
(6, 137),
(6, 138);

-- --------------------------------------------------------

--
-- 表的结构 `w_products_type`
--

DROP TABLE IF EXISTS `w_products_type`;
CREATE TABLE IF NOT EXISTS `w_products_type` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(60) NOT NULL,
  `published` tinyint(1) unsigned NOT NULL default '1',
  `attr_group` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `w_products_type`
--

INSERT INTO `w_products_type` (`id`, `name`, `published`, `attr_group`) VALUES
(1, '小家电', 1, ''),
(4, '家电', 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `w_questions`
--

DROP TABLE IF EXISTS `w_questions`;
CREATE TABLE IF NOT EXISTS `w_questions` (
  `id` mediumint(8) NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `contents` text,
  `ordering` int(4) unsigned NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '1',
  `defaulted` smallint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `w_questions`
--

INSERT INTO `w_questions` (`id`, `title`, `contents`, `ordering`, `published`, `defaulted`) VALUES
(1, '吃冰淇淋不解渴主要是因为它', 'a:3:{i:0;s:12:"含蛋白质";i:1;s:9:"含脂肪";i:2;s:6:"含糖";}', 1, 1, 2),
(4, '下列哪种球类没有"越位"的规则?', 'a:3:{i:0;s:6:"足球";i:1;s:6:"篮球";i:2;s:6:"冰球";}', 3, 0, 0),
(5, '满汉全席起兴于', 'a:4:{i:0;s:6:"清代";i:1;s:6:"唐代";i:2;s:6:"宋代";i:3;s:6:"两汉";}', 2, 0, 0),
(6, '下列哪项是人体的造血器官?', 'a:3:{i:0;s:6:"心脏";i:1;s:6:"骨髓";i:2;s:6:"肾脏";}', 1, 0, 1),
(7, '我国铁路部门规定身高多少的儿童要买全票?', 'a:3:{i:0;s:7:"1.20米";i:1;s:7:"1.30米";i:2;s:7:"1.40米";}', 0, 0, 0),
(8, '人体含水量百分比最高的器官是', 'a:3:{i:0;s:3:"肝";i:1;s:3:"肾";i:2;s:6:"眼球";}', 0, 0, 0),
(9, '人体含水量百分比最高的器官是', 'a:2:{i:0;s:3:"肝";i:1;s:3:"脾";}', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `w_refunds`
--

DROP TABLE IF EXISTS `w_refunds`;
CREATE TABLE IF NOT EXISTS `w_refunds` (
  `refund_id` bigint(20) unsigned NOT NULL auto_increment,
  `order_id` bigint(20) unsigned default NULL,
  `order_sn` varchar(20) NOT NULL,
  `uid` mediumint(8) unsigned default NULL,
  `account` varchar(50) default NULL,
  `bank` varchar(50) default NULL,
  `pay_account` varchar(250) default NULL,
  `currency` varchar(8) default NULL,
  `money` decimal(20,3) NOT NULL default '0.000',
  `pay_type` enum('online','offline','deposit','recharge') default 'offline',
  `payment` mediumint(8) unsigned NOT NULL default '0',
  `paymethod` varchar(100) default NULL,
  `ip` varchar(20) default NULL,
  `t_ready` int(10) unsigned NOT NULL default '0',
  `t_sent` int(10) unsigned default NULL,
  `t_received` int(10) unsigned default NULL,
  `status` enum('ready','progress','sent','received','cancel') NOT NULL default 'ready',
  `memo` longtext,
  `title` varchar(255) NOT NULL default '',
  `send_op_id` mediumint(8) unsigned default NULL,
  `disabled` enum('true','false') NOT NULL default 'false',
  PRIMARY KEY  (`refund_id`),
  KEY `ind_disabled` (`disabled`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `w_refunds`
--

INSERT INTO `w_refunds` (`refund_id`, `order_id`, `order_sn`, `uid`, `account`, `bank`, `pay_account`, `currency`, `money`, `pay_type`, `payment`, `paymethod`, `ip`, `t_ready`, `t_sent`, `t_received`, `status`, `memo`, `title`, `send_op_id`, `disabled`) VALUES
(1, 33, '20110503113119', 1, '', '', '', 'CNY', '1586.000', 'online', 1, NULL, NULL, 1306920208, 1306920208, NULL, 'ready', NULL, '', NULL, 'false');

-- --------------------------------------------------------

--
-- 表的结构 `w_seckill_board`
--

DROP TABLE IF EXISTS `w_seckill_board`;
CREATE TABLE IF NOT EXISTS `w_seckill_board` (
  `id` mediumint(8) NOT NULL auto_increment,
  `act_id` mediumint(8) NOT NULL default '0',
  `uname` varchar(50) NOT NULL,
  `uid` mediumint(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `w_seckill_board`
--

INSERT INTO `w_seckill_board` (`id`, `act_id`, `uname`, `uid`, `created`) VALUES
(1, 19, 'testtest2', 109, '2011-05-11 17:07:43'),
(2, 19, 'china', 1, '2011-05-11 17:52:13'),
(3, 25, 'luoqin', 123, '2011-06-09 17:52:35'),
(4, 25, 'luoqin', 123, '2011-06-09 17:59:39'),
(5, 25, 'china', 1, '2011-06-09 18:02:49'),
(6, 26, 'china', 1, '2011-06-10 17:00:27');

-- --------------------------------------------------------

--
-- 表的结构 `w_session`
--

DROP TABLE IF EXISTS `w_session`;
CREATE TABLE IF NOT EXISTS `w_session` (
  `username` varchar(150) default '',
  `time` varchar(14) default '',
  `session_id` varchar(200) NOT NULL default '0',
  `guest` tinyint(4) default '1',
  `userid` int(11) default '0',
  `usertype` varchar(50) default '',
  `gid` tinyint(3) unsigned NOT NULL default '0',
  `client_id` tinyint(3) unsigned NOT NULL default '0',
  `data` longtext,
  PRIMARY KEY  (`session_id`(64)),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_session`
--

INSERT INTO `w_session` (`username`, `time`, `session_id`, `guest`, `userid`, `usertype`, `gid`, `client_id`, `data`) VALUES
('', '1262605772', '17eed03538e9f4254315640144ceb7da', 1, 0, '', 0, 0, '__default|a:7:{s:22:"session.client.browser";s:88:"Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6";s:15:"session.counter";i:2;s:8:"registry";O:9:"WRegistry":3:{s:17:"_defaultNameSpace";s:7:"session";s:9:"_registry";a:1:{s:7:"session";a:1:{s:4:"data";O:8:"stdClass":0:{}}}s:7:"_errors";a:0:{}}s:4:"user";O:5:"WUser":19:{s:2:"id";i:0;s:4:"name";N;s:8:"username";N;s:5:"email";N;s:8:"password";N;s:14:"password_clear";s:0:"";s:8:"usertype";N;s:5:"block";N;s:9:"sendEmail";i:0;s:3:"gid";i:0;s:12:"registerDate";N;s:13:"lastvisitDate";N;s:10:"activation";N;s:6:"params";N;s:3:"aid";i:0;s:5:"guest";i:1;s:7:"_params";O:10:"WParameter":7:{s:4:"_raw";s:0:"";s:4:"_xml";N;s:9:"_elements";a:0:{}s:12:"_elementPath";a:1:{i:0;s:72:"E:\\www\\mysystem\\frameworktwo\\_code\\libraries\\core\\html\\parameter\\element";}s:17:"_defaultNameSpace";s:8:"_default";s:9:"_registry";a:1:{s:8:"_default";a:1:{s:4:"data";O:8:"stdClass":0:{}}}s:7:"_errors";a:0:{}}s:9:"_errorMsg";N;s:7:"_errors";a:0:{}}s:19:"session.timer.start";i:1262605772;s:18:"session.timer.last";i:1262605772;s:17:"session.timer.now";i:1262605772;}');

-- --------------------------------------------------------

--
-- 表的结构 `w_shipping`
--

DROP TABLE IF EXISTS `w_shipping`;
CREATE TABLE IF NOT EXISTS `w_shipping` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `config` longtext,
  `expressions` longtext,
  `desc` text COMMENT '描述信息',
  `price` longtext NOT NULL,
  `type` enum('0','1') NOT NULL default '1',
  `gateway` mediumint(8) unsigned default '0',
  `protect` enum('0','1') NOT NULL default '0' COMMENT '是否保价',
  `protect_rate` float(6,2) default NULL COMMENT '保价费率',
  `ordernum` smallint(4) default '0',
  `has_cod` enum('0','1') NOT NULL default '0' COMMENT '货到付款',
  `minprice` float(10,2) NOT NULL default '0.00',
  `ordering` int(4) NOT NULL default '0',
  `corp_id` int(10) unsigned default NULL,
  `published` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `ind_disabled` (`ordering`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `w_shipping`
--

INSERT INTO `w_shipping` (`id`, `name`, `config`, `expressions`, `desc`, `price`, `type`, `gateway`, `protect`, `protect_rate`, `ordernum`, `has_cod`, `minprice`, `ordering`, `corp_id`, `published`) VALUES
(1, 'EMS-中国邮政', 'a:7:{s:10:"firstprice";d:25;s:9:"firstunit";i:5000;s:13:"continueprice";d:10;s:12:"continueunit";i:500;s:7:"setting";s:11:"setting_sda";s:9:"dt_useexp";s:1:"0";s:10:"defAreaFee";s:1:"1";}', '{{w-0}-0.4}*{{{500-w}-0.4}+1}*20+ {{w-500}-0.6}*[(w-500)/500]*9', '<p>EMS 国内邮政特快专递</p>', '0', '1', 0, '0', 0.00, 50, '0', 0.00, 2, 1, 1),
(9, '货到付款', 'a:7:{s:10:"firstprice";d:10;s:9:"firstunit";i:1000;s:13:"continueprice";d:2;s:12:"continueunit";i:1000;s:7:"setting";s:11:"setting_sda";s:9:"dt_useexp";s:1:"0";s:10:"defAreaFee";N;}', '{{w-0}-0.4}*{{{1000-w}-0.4}+1}*10+ {{w-1000}-0.6}*[(w-1000)/1000]*2', '<div class="uarea">货到付款，先验货再付款，安全放心！ <a target="_blank" href="#">查看开通区域</a></div>', '0', '1', 0, '0', 0.00, 2, '1', 0.00, 3, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_shopping_area`
--

DROP TABLE IF EXISTS `w_shopping_area`;
CREATE TABLE IF NOT EXISTS `w_shopping_area` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `shipping_id` mediumint(8) unsigned default NULL,
  `price` varchar(100) default '0',
  `has_cod` tinyint(1) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL,
  `areaname_group` longtext,
  `areaid_group` longtext,
  `config` varchar(255) default NULL,
  `expressions` varchar(255) default NULL,
  `ordernum` smallint(4) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `w_shopping_area`
--

INSERT INTO `w_shopping_area` (`id`, `shipping_id`, `price`, `has_cod`, `name`, `areaname_group`, `areaid_group`, `config`, `expressions`, `ordernum`) VALUES
(1, 1, '0', 0, '全国', '湖北,北京,重庆', '184,2,5', 'a:3:{s:8:"firstFee";s:1:"1";s:11:"continueFee";s:1:"2";s:6:"useexp";N;}', NULL, NULL),
(3, 9, '0', 0, '主要省市', '北京,上海,天津,重庆,浙江,武汉市,襄樊市,广东,长沙市', '2,3,4,5,96,185,189,217,203', 'a:3:{s:8:"firstFee";s:2:"15";s:11:"continueFee";s:1:"5";s:6:"useexp";N;}', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `w_subscribe`
--

DROP TABLE IF EXISTS `w_subscribe`;
CREATE TABLE IF NOT EXISTS `w_subscribe` (
  `id` mediumint(11) NOT NULL auto_increment,
  `email` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `w_subscribe`
--

INSERT INTO `w_subscribe` (`id`, `email`, `created`, `enabled`) VALUES
(1, 'werqwe@126.com', '2011-03-03 14:45:29', 1),
(2, 'sadf', '2011-03-03 14:57:06', 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_s_products`
--

DROP TABLE IF EXISTS `w_s_products`;
CREATE TABLE IF NOT EXISTS `w_s_products` (
  `id` int(11) NOT NULL auto_increment,
  `products_id` int(11) NOT NULL default '0',
  `price` float NOT NULL default '0',
  `inventory` mediumint(4) NOT NULL default '0' COMMENT '库存数量',
  `new` tinyint(1) NOT NULL default '0',
  `hot` tinyint(1) NOT NULL default '0' COMMENT '热卖',
  `spe` tinyint(1) NOT NULL default '0' COMMENT '特价',
  `sales` int(4) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  `ordering` int(4) default NULL,
  `ord` mediumint(4) NOT NULL default '0',
  `uid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `products_id` (`products_id`,`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=923 ;

--
-- 转存表中的数据 `w_s_products`
--

INSERT INTO `w_s_products` (`id`, `products_id`, `price`, `inventory`, `new`, `hot`, `spe`, `sales`, `published`, `ordering`, `ord`, `uid`) VALUES
(91, 130, 232, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(88, 135, 1234, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(87, 139, 1234, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(86, 140, 1233, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(85, 141, 1234, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(84, 142, 1234, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(83, 143, 12, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(82, 144, 223, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(81, 145, 123, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(80, 146, 23, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(68, 129, 232, 0, 0, 1, 0, 0, 1, 1, 0, 89),
(67, 130, 232, 0, 0, 0, 0, 0, 0, 0, 0, 89),
(66, 135, 1234, 0, 0, 0, 0, 0, 0, 0, 0, 89),
(65, 139, 1234, 0, 0, 0, 0, 0, 0, 0, 0, 89),
(64, 140, 1233, 0, 0, 0, 0, 0, 0, 0, 0, 89),
(63, 141, 1234, 0, 0, 0, 0, 0, 0, 0, 0, 89),
(62, 142, 1234, 0, 0, 0, 0, 0, 0, 0, 0, 89),
(61, 143, 322, 0, 0, 0, 0, 0, 0, 0, 0, 89),
(60, 144, 223, 0, 0, 0, 0, 0, 0, 0, 0, 89),
(59, 145, 1233, 0, 0, 0, 0, 0, 0, 0, 0, 89),
(58, 146, 23, 0, 0, 0, 0, 0, 0, 0, 0, 89),
(93, 149, 11888, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(95, 151, 11888, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(217, 290, 500, 0, 0, 1, 0, 0, 1, 0, 0, 89),
(218, 289, 0, 0, 0, 1, 0, 0, 1, 0, 0, 89),
(219, 288, 100, 0, 0, 1, 0, 0, 1, 0, 0, 89),
(220, 287, 100, 0, 0, 1, 0, 0, 1, 0, 0, 89),
(221, 286, 100, 0, 0, 1, 0, 0, 1, 503, 0, 89),
(222, 285, 100, 0, 0, 1, 0, 0, 1, 501, 0, 89),
(223, 284, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(224, 283, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(225, 282, 100, 0, 0, 1, 0, 0, 1, 500, 0, 89),
(226, 281, 2666, 0, 0, 1, 0, 0, 1, 0, 0, 89),
(227, 280, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(228, 279, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(229, 278, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(230, 277, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(231, 276, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(232, 275, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(233, 274, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(234, 273, 100, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(235, 272, 200, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(236, 271, 100, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(237, 270, 200, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(238, 269, 200, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(239, 268, 200, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(240, 267, 100, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(241, 266, 2666, 0, 0, 0, 0, 0, 0, 0, 0, 89),
(242, 265, 200, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(243, 264, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(244, 263, 2666, 0, 0, 0, 0, 0, 0, 0, 0, 89),
(245, 262, 500, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(246, 261, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(247, 260, 500, 0, 0, 1, 0, 0, 1, 0, 0, 89),
(248, 259, 2666, 0, 0, 1, 0, 0, 1, 0, 0, 89),
(249, 258, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(250, 257, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(251, 256, 500, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(252, 255, 200, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(253, 254, 2666, 0, 0, 1, 0, 0, 1, 0, 0, 89),
(254, 253, 2666, 0, 0, 1, 0, 0, 1, 0, 0, 89),
(255, 252, 1000, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(256, 251, 2666, 0, 0, 1, 0, 0, 1, 1, 0, 89),
(257, 250, 2666, 0, 0, 1, 0, 0, 1, 0, 0, 89),
(258, 249, 2666, 0, 0, 1, 0, 0, 1, 0, 0, 89),
(259, 247, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(260, 246, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(261, 245, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(262, 244, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(263, 243, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(264, 242, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(265, 241, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(266, 240, 2666, 0, 0, 1, 0, 0, 1, 0, 0, 89),
(267, 239, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(268, 238, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(269, 237, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(270, 236, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(271, 235, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(272, 234, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(273, 233, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(274, 232, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(275, 231, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(276, 230, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(277, 229, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(278, 228, 2666, 0, 0, 0, 1, 0, 1, 1, 0, 89),
(279, 227, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(280, 226, 200, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(281, 225, 100, 0, 0, 0, 1, 0, 0, 0, 0, 89),
(282, 224, 100, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(283, 223, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(284, 222, 100, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(285, 221, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(286, 220, 100, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(287, 219, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(288, 218, 100, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(289, 217, 300, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(290, 216, 100, 0, 0, 0, 1, 0, 1, 0, 0, 89),
(291, 215, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(292, 214, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(293, 213, 50, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(294, 212, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(295, 211, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(296, 210, 50, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(297, 209, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(298, 208, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(299, 207, 100, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(300, 206, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(301, 205, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(302, 204, 2666, 0, 0, 0, 1, 0, 1, 1, 0, 89),
(303, 203, 2666, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(304, 202, 50, 0, 0, 0, 1, 0, 1, 0, 0, 89),
(305, 201, 50, 0, 0, 0, 0, 0, 1, 0, 0, 89),
(439, 294, 2666, 0, 0, 0, 0, 0, 1, 101, 0, 89),
(440, 293, 2666, 0, 1, 0, 0, 0, 1, 102, 0, 89),
(441, 199, 2666, 0, 1, 0, 0, 0, 1, 103, 0, 89),
(442, 196, 2666, 0, 1, 0, 0, 0, 1, 104, 0, 89),
(443, 194, 2666, 0, 1, 0, 0, 0, 1, 105, 0, 89),
(444, 191, 2666, 0, 1, 0, 0, 0, 1, 106, 0, 89),
(445, 189, 2666, 0, 1, 0, 0, 0, 1, 107, 0, 89),
(446, 181, 2666, 0, 1, 0, 0, 0, 1, 108, 0, 89),
(447, 180, 2666, 0, 1, 0, 0, 0, 1, 109, 0, 89),
(448, 178, 2666, 0, 1, 0, 0, 0, 1, 110, 0, 89),
(449, 171, 2666, 0, 1, 0, 0, 0, 1, 111, 0, 89),
(450, 167, 2666, 0, 1, 0, 0, 0, 1, 112, 0, 89),
(451, 162, 2666, 0, 1, 0, 0, 0, 1, 113, 0, 89),
(452, 157, 2666, 0, 1, 0, 0, 0, 1, 114, 0, 89),
(453, 156, 5400, 0, 1, 0, 0, 0, 1, 115, 0, 89),
(454, 155, 5400, 0, 1, 0, 0, 0, 1, 116, 0, 89),
(455, 154, 2666, 0, 1, 0, 0, 0, 1, 1, 0, 89),
(456, 153, 5400, 0, 1, 0, 0, 0, 1, 118, 0, 89),
(457, 152, 2666, 0, 1, 0, 0, 0, 1, 119, 0, 89),
(458, 292, 2666, 0, 1, 0, 0, 0, 1, 2, 0, 89),
(459, 291, 2666, 0, 1, 0, 0, 0, 1, 121, 0, 89),
(462, 296, 2666, 0, 0, 0, 0, 0, 1, 122, 0, 89),
(463, 295, 2666, 0, 0, 0, 0, 0, 1, 123, 0, 89),
(464, 299, 2666, 0, 0, 0, 0, 0, 1, 124, 0, 89),
(465, 297, 2666, 0, 0, 0, 0, 0, 1, 125, 0, 89),
(466, 161, 400, 0, 0, 0, 0, 0, 1, 126, 0, 89),
(467, 160, 400, 0, 0, 0, 0, 0, 1, 127, 0, 89),
(468, 159, 300, 0, 0, 0, 0, 0, 1, 128, 0, 89),
(469, 158, 201, 0, 0, 0, 0, 0, 1, 129, 0, 89),
(470, 300, 100, 0, 0, 0, 0, 0, 1, 130, 0, 89),
(471, 200, 100, 0, 0, 0, 0, 0, 1, 131, 0, 89),
(472, 198, 100, 0, 0, 0, 0, 0, 1, 132, 0, 89),
(473, 197, 100, 0, 0, 0, 0, 0, 1, 133, 0, 89),
(474, 195, 100, 0, 0, 0, 0, 0, 1, 134, 0, 89),
(475, 192, 500, 0, 0, 0, 1, 0, 1, 135, 0, 89),
(476, 190, 200, 0, 0, 0, 0, 0, 1, 136, 0, 89),
(346, 290, 500, 0, 0, 0, 1, 0, 1, 2, 0, 116),
(347, 289, 0, 0, 0, 0, 1, 0, 1, 0, 0, 116),
(348, 288, 100, 0, 0, 0, 1, 0, 1, 0, 0, 116),
(349, 287, 100, 0, 0, 0, 1, 0, 1, 0, 0, 116),
(350, 286, 100, 0, 0, 1, 1, 0, 1, 0, 0, 116),
(351, 285, 100, 0, 0, 1, 1, 0, 1, 0, 0, 116),
(352, 284, 2666, 0, 0, 0, 1, 0, 1, 0, 0, 116),
(353, 283, 2666, 0, 0, 0, 1, 0, 1, 0, 0, 116),
(354, 282, 100, 0, 0, 1, 0, 0, 1, 0, 0, 116),
(355, 281, 2666, 0, 0, 0, 0, 0, 0, 0, 0, 116),
(356, 280, 2666, 0, 0, 0, 0, 0, 0, 0, 0, 116),
(357, 279, 2666, 0, 0, 0, 0, 0, 0, 0, 0, 116),
(358, 278, 2666, 0, 0, 0, 0, 0, 0, 0, 0, 116),
(359, 277, 2666, 0, 0, 1, 0, 0, 1, 0, 0, 116),
(360, 276, 2666, 0, 0, 1, 0, 0, 1, 0, 0, 116),
(361, 275, 2666, 0, 0, 0, 0, 0, 0, 0, 0, 116),
(362, 274, 2666, 0, 0, 0, 0, 0, 0, 0, 0, 116),
(363, 273, 100, 0, 0, 0, 0, 0, 0, 0, 0, 116),
(364, 272, 200, 0, 0, 1, 0, 0, 1, 1, 0, 116),
(365, 271, 100, 0, 0, 0, 0, 0, 0, 2, 0, 116),
(366, 270, 200, 0, 0, 0, 0, 0, 0, 0, 0, 116),
(367, 269, 0, 0, 0, 0, 0, 0, 0, 22, 0, 116),
(368, 268, 0, 0, 0, 0, 0, 0, 0, 23, 0, 116),
(369, 267, 100, 0, 0, 0, 0, 0, 0, 23, 0, 116),
(370, 266, 2666, 0, 0, 0, 0, 0, 0, 24, 0, 116),
(371, 265, 200, 0, 0, 0, 1, 0, 1, 26, 0, 116),
(372, 264, 2666, 0, 0, 0, 0, 0, 0, 27, 0, 116),
(373, 263, 2666, 0, 1, 0, 0, 0, 1, 1, 0, 116),
(377, 224, 100, 0, 0, 0, 0, 0, 0, 29, 0, 116),
(378, 223, 2666, 0, 0, 0, 0, 0, 0, 30, 0, 116),
(379, 222, 100, 0, 0, 0, 0, 0, 0, 31, 0, 116),
(380, 221, 2666, 0, 0, 0, 0, 0, 0, 32, 0, 116),
(381, 220, 100, 0, 0, 0, 0, 0, 0, 33, 0, 116),
(382, 219, 2666, 0, 0, 0, 0, 0, 0, 34, 0, 116),
(383, 218, 100, 0, 0, 0, 0, 0, 0, 35, 0, 116),
(384, 217, 300, 0, 0, 0, 0, 0, 0, 36, 0, 116),
(385, 216, 100, 0, 0, 0, 0, 0, 0, 37, 0, 116),
(386, 215, 2666, 0, 0, 0, 0, 0, 0, 38, 0, 116),
(387, 214, 2666, 0, 0, 0, 0, 0, 0, 39, 0, 116),
(388, 213, 50, 0, 1, 0, 0, 0, 1, 40, 0, 116),
(389, 212, 2666, 0, 0, 0, 0, 0, 0, 41, 0, 116),
(390, 211, 2666, 0, 1, 0, 0, 0, 1, 42, 0, 116),
(391, 210, 50, 0, 1, 0, 0, 0, 1, 43, 0, 116),
(392, 209, 2666, 0, 0, 0, 0, 0, 0, 44, 0, 116),
(393, 208, 2666, 0, 0, 1, 0, 0, 1, 45, 0, 116),
(394, 207, 100, 0, 1, 1, 0, 0, 1, 46, 0, 116),
(395, 206, 2666, 0, 0, 0, 0, 0, 0, 47, 0, 116),
(396, 205, 2666, 0, 0, 0, 0, 0, 0, 48, 0, 116),
(397, 293, 2666, 0, 0, 0, 0, 0, 0, 49, 0, 116),
(398, 292, 2666, 0, 0, 0, 0, 0, 0, 50, 0, 116),
(399, 291, 2666, 0, 0, 0, 0, 0, 0, 51, 0, 116),
(400, 262, 500, 0, 0, 0, 0, 0, 0, 52, 0, 116),
(401, 261, 2666, 0, 0, 1, 0, 0, 1, 53, 0, 116),
(402, 260, 500, 0, 0, 1, 0, 0, 1, 54, 0, 116),
(403, 259, 2666, 0, 0, 0, 0, 0, 0, 55, 0, 116),
(404, 258, 2666, 0, 0, 1, 0, 0, 1, 56, 0, 116),
(405, 257, 2666, 0, 0, 0, 0, 0, 0, 57, 0, 116),
(406, 256, 500, 0, 0, 1, 0, 0, 1, 58, 0, 116),
(407, 255, 200, 0, 0, 0, 0, 0, 0, 59, 0, 116),
(408, 254, 2666, 0, 0, 1, 0, 0, 1, 60, 0, 116),
(409, 253, 2666, 0, 0, 0, 0, 0, 0, 61, 0, 116),
(410, 252, 1000, 0, 0, 0, 0, 0, 0, 62, 0, 116),
(411, 251, 2666, 0, 0, 0, 0, 0, 0, 63, 0, 116),
(412, 250, 2666, 0, 0, 0, 0, 0, 0, 64, 0, 116),
(413, 249, 2666, 0, 0, 0, 0, 0, 0, 65, 0, 116),
(414, 247, 2666, 0, 0, 0, 0, 0, 0, 66, 0, 116),
(415, 246, 2666, 0, 0, 0, 0, 0, 0, 67, 0, 116),
(416, 245, 2666, 0, 0, 0, 0, 0, 0, 68, 0, 116),
(417, 244, 2666, 0, 0, 0, 0, 0, 1, 69, 0, 116),
(418, 243, 2666, 0, 0, 0, 0, 0, 0, 70, 0, 116),
(419, 242, 2666, 0, 0, 0, 0, 0, 0, 71, 0, 116),
(420, 241, 2666, 0, 0, 0, 0, 0, 0, 72, 0, 116),
(421, 240, 2666, 0, 0, 0, 0, 0, 0, 73, 0, 116),
(422, 239, 2666, 0, 0, 0, 0, 0, 1, 74, 0, 116),
(423, 238, 2666, 0, 0, 0, 0, 0, 1, 75, 0, 116),
(424, 237, 2666, 0, 0, 0, 0, 0, 1, 76, 0, 116),
(425, 236, 2666, 0, 0, 0, 0, 0, 1, 77, 0, 116),
(426, 235, 2666, 0, 0, 0, 0, 0, 1, 78, 0, 116),
(427, 234, 2666, 0, 0, 0, 0, 0, 1, 79, 0, 116),
(428, 233, 2666, 0, 0, 0, 0, 0, 1, 80, 0, 116),
(429, 232, 2666, 0, 0, 1, 0, 0, 1, 81, 0, 116),
(430, 231, 2666, 0, 0, 0, 0, 0, 1, 82, 0, 116),
(431, 230, 2666, 0, 0, 0, 0, 0, 1, 83, 0, 116),
(432, 229, 2666, 0, 0, 0, 0, 0, 1, 84, 0, 116),
(433, 228, 2666, 0, 0, 0, 0, 0, 1, 85, 0, 116),
(434, 227, 2666, 0, 0, 1, 0, 0, 1, 86, 0, 116),
(435, 226, 200, 0, 0, 1, 0, 0, 1, 87, 0, 116),
(436, 225, 100, 0, 0, 1, 0, 0, 1, 88, 0, 116),
(477, 188, 100, 0, 0, 0, 0, 0, 1, 137, 0, 89),
(478, 187, 100, 0, 0, 0, 0, 0, 1, 138, 0, 89),
(479, 186, 100, 0, 0, 0, 0, 0, 1, 139, 0, 89),
(480, 179, 60, 0, 0, 0, 0, 0, 1, 140, 0, 89),
(481, 176, 100, 0, 0, 0, 0, 0, 1, 141, 0, 89),
(482, 172, 200, 0, 0, 0, 0, 0, 1, 142, 0, 89),
(483, 170, 500, 0, 0, 0, 0, 0, 1, 143, 0, 89),
(484, 169, 300, 0, 0, 0, 0, 0, 1, 144, 0, 89),
(485, 168, 250, 0, 0, 0, 0, 0, 1, 145, 0, 89),
(486, 166, 300, 0, 0, 0, 0, 0, 0, 146, 0, 89),
(487, 165, 200, 0, 0, 0, 0, 0, 0, 147, 0, 89),
(488, 164, 200, 0, 0, 0, 0, 0, 0, 148, 0, 89),
(489, 163, 300, 0, 0, 0, 0, 0, 0, 149, 0, 89),
(490, 304, 2666, 0, 0, 0, 0, 0, 0, 150, 0, 89),
(491, 303, 2666, 0, 0, 0, 0, 0, 0, 151, 0, 89),
(492, 302, 2666, 0, 0, 0, 0, 0, 0, 152, 0, 89),
(493, 301, 2666, 0, 0, 0, 0, 0, 0, 153, 0, 89),
(502, 306, 2666, 0, 0, 0, 0, 0, 0, 154, 0, 89),
(503, 305, 2666, 0, 0, 0, 0, 0, 0, 155, 0, 89),
(629, 445, 2666, 0, 1, 0, 0, 0, 0, 14, 2, 1),
(630, 444, 2666, 0, 1, 0, 0, 0, 0, 15, 3, 1),
(508, 310, 2666, 0, 0, 0, 0, 0, 0, 156, 0, 89),
(509, 309, 2666, 0, 0, 0, 0, 0, 0, 157, 0, 89),
(510, 308, 2666, 0, 0, 0, 0, 0, 0, 158, 0, 89),
(511, 307, 2666, 0, 0, 0, 0, 0, 0, 159, 0, 89),
(512, 312, 500, 0, 0, 0, 0, 0, 1, 160, 0, 89),
(513, 311, 800, 0, 0, 0, 0, 0, 1, 161, 0, 89),
(628, 446, 0, 0, 1, 0, 0, 0, 0, 13, 1, 1),
(515, 313, 2666, 0, 0, 0, 0, 0, 0, 162, 0, 89),
(516, 318, 2666, 0, 0, 0, 0, 0, 0, 163, 0, 89),
(517, 317, 2666, 0, 0, 0, 0, 0, 0, 164, 0, 89),
(518, 316, 2666, 0, 0, 0, 0, 0, 0, 165, 0, 89),
(519, 315, 2666, 0, 0, 0, 0, 0, 0, 166, 0, 89),
(520, 314, 2666, 0, 0, 0, 0, 0, 0, 167, 0, 89),
(521, 340, 2666, 0, 0, 0, 0, 0, 0, 168, 0, 89),
(522, 339, 2666, 0, 0, 0, 0, 0, 0, 169, 0, 89),
(523, 338, 2666, 0, 0, 0, 0, 0, 0, 170, 0, 89),
(524, 337, 2666, 0, 0, 0, 0, 0, 0, 171, 0, 89),
(525, 336, 2666, 0, 0, 0, 0, 0, 0, 172, 0, 89),
(526, 335, 2666, 0, 0, 0, 0, 0, 0, 173, 0, 89),
(527, 334, 2666, 0, 0, 0, 0, 0, 0, 174, 0, 89),
(528, 333, 2666, 0, 0, 0, 0, 0, 0, 175, 0, 89),
(529, 332, 2666, 0, 0, 0, 0, 0, 0, 176, 0, 89),
(530, 331, 2666, 0, 0, 0, 0, 0, 0, 177, 0, 89),
(531, 330, 2666, 0, 0, 0, 0, 0, 0, 178, 0, 89),
(532, 329, 2666, 0, 0, 0, 0, 0, 0, 179, 0, 89),
(533, 328, 2666, 0, 0, 0, 0, 0, 0, 180, 0, 89),
(534, 327, 2666, 0, 0, 0, 0, 0, 0, 181, 0, 89),
(535, 326, 2666, 0, 0, 0, 0, 0, 0, 182, 0, 89),
(536, 325, 2666, 0, 0, 0, 0, 0, 0, 183, 0, 89),
(537, 324, 2666, 0, 0, 0, 0, 0, 0, 184, 0, 89),
(538, 323, 2666, 0, 0, 0, 0, 0, 0, 185, 0, 89),
(539, 322, 2666, 0, 0, 0, 0, 0, 0, 186, 0, 89),
(540, 321, 2666, 0, 0, 0, 0, 0, 0, 187, 0, 89),
(541, 320, 2666, 0, 0, 0, 0, 0, 0, 188, 0, 89),
(542, 319, 2666, 0, 0, 0, 0, 0, 0, 189, 0, 89),
(543, 360, 2666, 0, 0, 0, 0, 0, 0, 190, 0, 89),
(544, 359, 2666, 0, 0, 0, 0, 0, 0, 191, 0, 89),
(545, 358, 2666, 0, 0, 0, 0, 0, 0, 192, 0, 89),
(546, 357, 2666, 0, 0, 0, 0, 0, 0, 193, 0, 89),
(547, 356, 2666, 0, 0, 0, 0, 0, 1, 194, 0, 89),
(548, 355, 2666, 0, 0, 0, 0, 0, 1, 195, 0, 89),
(549, 354, 2666, 0, 0, 0, 0, 0, 1, 196, 0, 89),
(550, 353, 2666, 0, 0, 0, 0, 0, 1, 197, 0, 89),
(551, 352, 2666, 0, 0, 0, 0, 0, 1, 198, 0, 89),
(552, 351, 2666, 0, 0, 0, 0, 0, 1, 199, 0, 89),
(553, 350, 2666, 0, 0, 0, 0, 0, 1, 200, 0, 89),
(554, 349, 2666, 0, 0, 0, 0, 0, 1, 201, 0, 89),
(555, 348, 2666, 0, 0, 0, 0, 0, 1, 202, 0, 89),
(556, 347, 2666, 0, 0, 0, 0, 0, 1, 203, 0, 89),
(557, 346, 2666, 0, 0, 0, 0, 0, 1, 204, 0, 89),
(558, 345, 2666, 0, 0, 0, 0, 0, 1, 205, 0, 89),
(559, 344, 2666, 0, 0, 0, 0, 0, 1, 206, 0, 89),
(560, 343, 2666, 0, 0, 0, 0, 0, 1, 207, 0, 89),
(561, 342, 2666, 0, 0, 0, 0, 0, 1, 208, 0, 89),
(562, 341, 2666, 0, 0, 0, 0, 0, 1, 209, 0, 89),
(563, 393, 2666, 0, 0, 0, 0, 0, 1, 210, 0, 89),
(564, 392, 2666, 0, 0, 0, 0, 0, 1, 211, 0, 89),
(565, 391, 2666, 0, 0, 0, 0, 0, 1, 212, 0, 89),
(566, 390, 2666, 0, 0, 0, 0, 0, 1, 213, 0, 89),
(567, 389, 2666, 0, 0, 0, 0, 0, 1, 214, 0, 89),
(568, 388, 2666, 0, 0, 0, 0, 0, 1, 215, 0, 89),
(569, 387, 2666, 0, 0, 0, 0, 0, 1, 216, 0, 89),
(570, 386, 2666, 0, 0, 0, 0, 0, 1, 217, 0, 89),
(571, 385, 2666, 0, 0, 0, 0, 0, 1, 218, 0, 89),
(572, 384, 2666, 0, 0, 0, 0, 0, 1, 219, 0, 89),
(573, 382, 2666, 0, 0, 0, 0, 0, 1, 220, 0, 89),
(574, 381, 2666, 0, 0, 0, 0, 0, 1, 221, 0, 89),
(575, 380, 2666, 0, 0, 0, 0, 0, 1, 222, 0, 89),
(576, 379, 2666, 0, 0, 0, 0, 0, 1, 223, 0, 89),
(577, 378, 2666, 0, 0, 0, 0, 0, 1, 224, 0, 89),
(578, 377, 2666, 0, 0, 0, 0, 0, 1, 225, 0, 89),
(579, 376, 2666, 0, 0, 0, 0, 0, 1, 226, 0, 89),
(580, 375, 2666, 0, 0, 0, 0, 0, 1, 227, 0, 89),
(581, 374, 2666, 0, 0, 0, 0, 0, 1, 228, 0, 89),
(582, 373, 2666, 0, 0, 0, 0, 0, 1, 229, 0, 89),
(583, 372, 2666, 0, 0, 0, 0, 0, 1, 230, 0, 89),
(584, 371, 2666, 0, 0, 0, 0, 0, 1, 231, 0, 89),
(585, 370, 2666, 0, 0, 0, 0, 0, 1, 232, 0, 89),
(586, 369, 2666, 0, 0, 0, 0, 0, 1, 233, 0, 89),
(587, 368, 2666, 0, 0, 0, 0, 0, 1, 234, 0, 89),
(588, 367, 2666, 0, 0, 0, 0, 0, 1, 235, 0, 89),
(589, 366, 2666, 0, 0, 0, 0, 0, 1, 236, 0, 89),
(590, 365, 2666, 0, 0, 0, 0, 0, 1, 237, 0, 89),
(591, 364, 2666, 0, 0, 0, 0, 0, 1, 238, 0, 89),
(592, 363, 2666, 0, 0, 0, 0, 0, 1, 239, 0, 89),
(593, 362, 2666, 0, 0, 0, 0, 0, 1, 240, 0, 89),
(594, 361, 2666, 0, 0, 0, 0, 0, 1, 241, 0, 89),
(595, 399, 2666, 0, 0, 0, 0, 0, 1, 242, 0, 89),
(596, 398, 2666, 0, 0, 0, 0, 0, 1, 243, 0, 89),
(597, 397, 2666, 0, 0, 0, 0, 0, 1, 244, 0, 89),
(598, 396, 2666, 0, 0, 0, 0, 0, 1, 245, 0, 89),
(599, 395, 2666, 0, 0, 0, 0, 0, 1, 246, 0, 89),
(600, 394, 2666, 0, 0, 0, 0, 0, 1, 247, 0, 89),
(601, 415, 2666, 0, 0, 0, 0, 0, 0, 248, 0, 89),
(602, 414, 2666, 0, 0, 0, 0, 0, 1, 249, 0, 89),
(603, 413, 2666, 0, 0, 0, 0, 0, 1, 250, 0, 89),
(604, 412, 2666, 0, 0, 0, 0, 0, 1, 251, 0, 89),
(605, 411, 2666, 0, 0, 0, 0, 0, 1, 252, 0, 89),
(606, 410, 2666, 0, 0, 0, 0, 0, 1, 253, 0, 89),
(607, 409, 2666, 0, 0, 0, 0, 0, 1, 254, 0, 89),
(608, 408, 2666, 0, 0, 0, 0, 0, 1, 255, 0, 89),
(609, 407, 2666, 0, 0, 0, 0, 0, 1, 256, 0, 89),
(610, 406, 2666, 0, 0, 0, 0, 0, 1, 257, 0, 89),
(611, 405, 2666, 0, 0, 0, 0, 0, 1, 258, 0, 89),
(612, 404, 2666, 0, 0, 0, 0, 0, 1, 259, 0, 89),
(613, 403, 2666, 0, 0, 0, 0, 0, 1, 260, 0, 89),
(614, 402, 2666, 0, 0, 0, 0, 0, 1, 261, 0, 89),
(615, 401, 2666, 0, 0, 0, 0, 0, 1, 262, 0, 89),
(616, 400, 2666, 0, 0, 0, 0, 0, 1, 263, 0, 89),
(617, 417, 0, 0, 0, 0, 0, 0, 1, 264, 0, 89),
(618, 419, 0, 0, 0, 0, 0, 0, 1, 265, 0, 89),
(619, 422, 100, 0, 0, 0, 0, 0, 1, 266, 0, 89),
(620, 421, 200, 0, 0, 0, 0, 0, 1, 267, 0, 89),
(621, 423, 100, 0, 0, 0, 0, 0, 1, 268, 0, 89),
(622, 426, 50, 0, 0, 0, 0, 0, 1, 269, 0, 89),
(623, 425, 200, 0, 0, 0, 0, 0, 1, 270, 0, 89),
(624, 424, 200, 0, 0, 0, 0, 0, 1, 271, 0, 89),
(625, 420, 2666, 0, 0, 0, 0, 0, 1, 272, 0, 89),
(626, 418, 2666, 0, 0, 0, 0, 0, 1, 273, 0, 89),
(627, 416, 2666, 0, 0, 0, 0, 0, 1, 274, 0, 89),
(631, 451, 2666, 0, 0, 0, 0, 0, 0, 16, 16, 1),
(632, 452, 2666, 0, 0, 0, 0, 0, 0, 17, 17, 1),
(633, 456, 2666, 0, 0, 0, 0, 0, 0, 18, 18, 1),
(634, 455, 2666, 0, 0, 0, 0, 0, 0, 19, 19, 1),
(635, 454, 2666, 0, 0, 0, 0, 0, 0, 20, 20, 1),
(636, 453, 2666, 0, 0, 0, 0, 0, 0, 21, 21, 1),
(637, 450, 2666, 0, 0, 0, 0, 0, 0, 22, 22, 1),
(638, 449, 2666, 0, 0, 0, 0, 0, 0, 23, 23, 1),
(639, 448, 2666, 0, 0, 0, 0, 0, 0, 24, 24, 1),
(640, 447, 2666, 0, 0, 0, 0, 0, 0, 25, 25, 1),
(641, 443, 2666, 0, 0, 0, 0, 0, 0, 26, 26, 1),
(642, 442, 2666, 0, 0, 0, 0, 0, 0, 27, 27, 1),
(643, 441, 2666, 0, 0, 0, 0, 0, 0, 28, 28, 1),
(644, 440, 2666, 0, 0, 0, 0, 0, 0, 29, 29, 1),
(645, 439, 2666, 0, 0, 0, 0, 0, 0, 30, 30, 1),
(646, 438, 2666, 0, 0, 0, 0, 0, 0, 31, 31, 1),
(647, 437, 2666, 0, 0, 0, 0, 0, 0, 32, 32, 1),
(648, 436, 2666, 0, 0, 0, 0, 0, 0, 33, 33, 1),
(649, 435, 2666, 0, 0, 0, 0, 0, 0, 34, 34, 1),
(650, 434, 2666, 0, 0, 0, 0, 0, 0, 35, 35, 1),
(651, 433, 2666, 0, 0, 0, 0, 0, 0, 36, 36, 1),
(652, 432, 2666, 0, 0, 0, 0, 0, 0, 37, 37, 1),
(653, 431, 2666, 0, 0, 0, 0, 0, 0, 38, 38, 1),
(654, 429, 2666, 0, 0, 0, 0, 0, 0, 39, 39, 1),
(655, 428, 2666, 0, 0, 0, 0, 0, 0, 40, 40, 1),
(656, 427, 2666, 0, 0, 0, 0, 0, 0, 41, 41, 1),
(657, 420, 2666, 0, 0, 0, 0, 0, 0, 42, 42, 1),
(658, 418, 2666, 0, 0, 0, 0, 0, 0, 43, 43, 1),
(659, 416, 2666, 0, 0, 0, 0, 0, 0, 44, 44, 1),
(660, 415, 2666, 0, 0, 0, 0, 0, 0, 45, 45, 1),
(661, 414, 2666, 0, 0, 0, 0, 0, 0, 46, 46, 1),
(662, 413, 2666, 0, 0, 0, 0, 0, 0, 47, 47, 1),
(663, 412, 2666, 0, 0, 0, 0, 0, 0, 48, 48, 1),
(664, 411, 2666, 0, 0, 0, 0, 0, 0, 49, 49, 1),
(665, 410, 2666, 0, 0, 0, 0, 0, 0, 50, 50, 1),
(666, 409, 2666, 0, 0, 0, 0, 0, 0, 51, 51, 1),
(667, 408, 2666, 0, 0, 0, 0, 0, 0, 52, 52, 1),
(668, 407, 2666, 0, 0, 0, 0, 0, 0, 53, 53, 1),
(669, 406, 2666, 0, 0, 0, 0, 0, 0, 54, 54, 1),
(670, 405, 2666, 0, 0, 0, 0, 0, 0, 55, 55, 1),
(671, 456, 2666, 0, 0, 0, 0, 0, 1, 275, 275, 89),
(672, 455, 2666, 0, 0, 0, 0, 0, 1, 276, 276, 89),
(673, 454, 2666, 0, 0, 0, 0, 0, 1, 277, 277, 89),
(674, 453, 2666, 0, 0, 0, 0, 0, 1, 278, 278, 89),
(675, 452, 2666, 0, 0, 0, 0, 0, 1, 279, 279, 89),
(676, 451, 2666, 0, 0, 0, 0, 0, 1, 280, 280, 89),
(677, 450, 2666, 0, 0, 0, 0, 0, 1, 281, 281, 89),
(678, 449, 2666, 0, 0, 0, 0, 0, 1, 282, 282, 89),
(679, 448, 2666, 0, 0, 0, 0, 0, 1, 283, 283, 89),
(680, 447, 2666, 0, 0, 0, 0, 0, 1, 284, 284, 89),
(681, 446, 2666, 0, 0, 0, 0, 0, 1, 285, 285, 89),
(682, 445, 2666, 0, 0, 0, 0, 0, 1, 286, 286, 89),
(683, 444, 2666, 0, 0, 0, 0, 0, 1, 287, 287, 89),
(684, 443, 2666, 0, 0, 0, 0, 0, 1, 288, 288, 89),
(685, 442, 2666, 0, 0, 0, 0, 0, 1, 289, 289, 89),
(686, 441, 2666, 0, 0, 0, 0, 0, 1, 290, 290, 89),
(687, 440, 2666, 0, 0, 0, 0, 0, 0, 291, 291, 89),
(688, 439, 2666, 0, 0, 0, 0, 0, 0, 292, 292, 89),
(689, 438, 2666, 0, 0, 0, 0, 0, 0, 293, 293, 89),
(690, 437, 2666, 0, 0, 0, 0, 0, 0, 294, 294, 89),
(691, 436, 2666, 0, 0, 0, 0, 0, 0, 295, 295, 89),
(692, 435, 2666, 0, 0, 0, 0, 0, 0, 296, 296, 89),
(693, 434, 2666, 0, 0, 0, 0, 0, 0, 297, 297, 89),
(694, 433, 2666, 0, 0, 0, 0, 0, 0, 298, 298, 89),
(695, 432, 2666, 0, 0, 0, 0, 0, 0, 299, 299, 89),
(696, 431, 2666, 0, 0, 0, 0, 0, 0, 300, 300, 89),
(697, 429, 2666, 0, 0, 0, 0, 0, 0, 301, 301, 89),
(698, 428, 2666, 0, 0, 0, 0, 0, 0, 302, 302, 89),
(699, 427, 2666, 0, 0, 0, 0, 0, 0, 303, 303, 89),
(700, 153, 5400, 0, 0, 0, 0, 0, 0, 56, 56, 1),
(701, 468, 2666, 0, 0, 0, 0, 0, 0, 57, 57, 1),
(702, 467, 2666, 0, 0, 0, 0, 0, 0, 58, 58, 1),
(703, 466, 2666, 0, 0, 0, 0, 0, 0, 59, 59, 1),
(704, 465, 2666, 0, 0, 0, 0, 0, 0, 60, 60, 1),
(705, 464, 2666, 0, 0, 0, 0, 0, 0, 61, 61, 1),
(706, 463, 2666, 0, 0, 0, 0, 0, 0, 62, 62, 1),
(707, 462, 2666, 0, 0, 0, 0, 0, 0, 63, 63, 1),
(708, 461, 2666, 0, 0, 0, 0, 0, 0, 64, 64, 1),
(709, 460, 2666, 0, 0, 0, 0, 0, 0, 65, 65, 1),
(710, 459, 2666, 0, 0, 0, 0, 0, 0, 66, 66, 1),
(711, 458, 2666, 0, 0, 0, 0, 0, 0, 67, 67, 1),
(712, 457, 2666, 0, 0, 0, 0, 0, 0, 68, 68, 1),
(713, 426, 50, 0, 0, 0, 0, 0, 0, 69, 69, 1),
(714, 425, 200, 0, 0, 0, 0, 0, 0, 70, 70, 1),
(715, 424, 200, 0, 0, 0, 0, 0, 0, 71, 71, 1),
(716, 423, 100, 0, 0, 0, 0, 0, 0, 72, 72, 1),
(717, 422, 100, 0, 0, 0, 0, 0, 0, 73, 73, 1),
(718, 421, 200, 0, 0, 0, 0, 0, 0, 74, 74, 1),
(719, 419, 100, 0, 0, 0, 0, 0, 0, 75, 75, 1),
(720, 417, 100, 0, 0, 0, 0, 0, 0, 76, 76, 1),
(721, 404, 2666, 0, 0, 0, 0, 0, 0, 77, 77, 1),
(722, 403, 2666, 0, 0, 0, 0, 0, 0, 78, 78, 1),
(723, 402, 2666, 0, 0, 0, 0, 0, 0, 79, 79, 1),
(724, 401, 2666, 0, 0, 0, 0, 0, 0, 80, 80, 1),
(725, 400, 2666, 0, 0, 0, 0, 0, 0, 81, 81, 1),
(726, 399, 2666, 0, 0, 0, 0, 0, 0, 82, 82, 1),
(727, 398, 2666, 0, 0, 0, 0, 0, 0, 83, 83, 1),
(728, 397, 2666, 0, 0, 0, 0, 0, 0, 84, 84, 1),
(729, 396, 2666, 0, 0, 0, 0, 0, 0, 85, 85, 1),
(730, 395, 2666, 0, 0, 0, 0, 0, 0, 86, 86, 1),
(731, 394, 2666, 0, 0, 0, 0, 0, 0, 87, 87, 1),
(732, 393, 2666, 0, 0, 0, 0, 0, 0, 88, 88, 1),
(733, 392, 2666, 0, 0, 0, 0, 0, 0, 89, 89, 1),
(734, 391, 2666, 0, 0, 0, 0, 0, 0, 90, 90, 1),
(735, 390, 2666, 0, 0, 0, 0, 0, 0, 91, 91, 1),
(736, 389, 2666, 0, 0, 0, 0, 0, 0, 92, 92, 1),
(737, 388, 2666, 0, 0, 0, 0, 0, 0, 93, 93, 1),
(738, 387, 2666, 0, 0, 0, 0, 0, 0, 94, 94, 1),
(739, 386, 2666, 0, 0, 0, 0, 0, 0, 95, 95, 1),
(740, 385, 2666, 0, 0, 0, 0, 0, 0, 96, 96, 1),
(741, 384, 2666, 0, 0, 0, 0, 0, 0, 97, 97, 1),
(742, 382, 2666, 0, 0, 0, 0, 0, 0, 98, 98, 1),
(743, 381, 2666, 0, 0, 0, 0, 0, 0, 99, 99, 1),
(744, 380, 2666, 0, 0, 0, 0, 0, 0, 100, 100, 1),
(745, 379, 2666, 0, 0, 0, 0, 0, 0, 101, 101, 1),
(746, 378, 2666, 0, 0, 0, 0, 0, 0, 102, 102, 1),
(747, 377, 2666, 0, 0, 0, 0, 0, 0, 103, 103, 1),
(748, 376, 2666, 0, 0, 0, 0, 0, 0, 104, 104, 1),
(749, 375, 2666, 0, 0, 0, 0, 0, 0, 105, 105, 1),
(750, 374, 2666, 0, 0, 0, 0, 0, 0, 106, 106, 1),
(751, 373, 2666, 0, 0, 0, 0, 0, 0, 107, 107, 1),
(752, 372, 2666, 0, 0, 0, 0, 0, 0, 108, 108, 1),
(753, 371, 2666, 0, 0, 0, 0, 0, 0, 109, 109, 1),
(754, 370, 2666, 0, 0, 0, 0, 0, 0, 110, 110, 1),
(755, 369, 2666, 0, 0, 0, 0, 0, 0, 111, 111, 1),
(756, 368, 2666, 0, 0, 0, 0, 0, 0, 112, 112, 1),
(757, 367, 2666, 0, 0, 0, 0, 0, 0, 113, 113, 1),
(758, 366, 2666, 0, 0, 0, 0, 0, 0, 114, 114, 1),
(759, 365, 2666, 0, 0, 0, 0, 0, 0, 115, 115, 1),
(760, 364, 2666, 0, 0, 0, 0, 0, 0, 116, 116, 1),
(761, 363, 2666, 0, 0, 0, 0, 0, 0, 117, 117, 1),
(762, 362, 2666, 0, 0, 0, 0, 0, 0, 118, 118, 1),
(763, 361, 2666, 0, 0, 0, 0, 0, 0, 119, 119, 1),
(764, 360, 2666, 0, 0, 0, 0, 0, 0, 120, 120, 1),
(765, 359, 2666, 0, 0, 0, 0, 0, 0, 121, 121, 1),
(766, 358, 2666, 0, 0, 0, 0, 0, 0, 122, 122, 1),
(767, 357, 2666, 0, 0, 0, 0, 0, 0, 123, 123, 1),
(768, 356, 2666, 0, 0, 0, 0, 0, 0, 124, 124, 1),
(769, 355, 2666, 0, 0, 0, 0, 0, 0, 125, 125, 1),
(770, 354, 2666, 0, 0, 0, 0, 0, 0, 126, 126, 1),
(771, 353, 2666, 0, 0, 0, 0, 0, 0, 127, 127, 1),
(772, 352, 2666, 0, 0, 0, 0, 0, 0, 128, 128, 1),
(773, 351, 2666, 0, 0, 0, 0, 0, 0, 129, 129, 1),
(774, 350, 2666, 0, 0, 0, 0, 0, 0, 130, 130, 1),
(775, 349, 2666, 0, 0, 0, 0, 0, 0, 131, 131, 1),
(776, 348, 2666, 0, 0, 0, 0, 0, 0, 132, 132, 1),
(777, 347, 2666, 0, 0, 0, 0, 0, 0, 133, 133, 1),
(778, 346, 2666, 0, 0, 0, 0, 0, 0, 134, 134, 1),
(779, 345, 2666, 0, 0, 0, 0, 0, 0, 135, 135, 1),
(780, 344, 2666, 0, 0, 0, 0, 0, 0, 136, 136, 1),
(781, 343, 2666, 0, 0, 0, 0, 0, 0, 137, 137, 1),
(782, 342, 2666, 0, 0, 0, 0, 0, 0, 138, 138, 1),
(783, 341, 2666, 0, 0, 0, 0, 0, 0, 139, 139, 1),
(784, 340, 2666, 0, 0, 0, 0, 0, 0, 140, 140, 1),
(785, 339, 2666, 0, 0, 0, 0, 0, 0, 141, 141, 1),
(786, 338, 2666, 0, 0, 0, 0, 0, 0, 142, 142, 1),
(787, 337, 2666, 0, 0, 0, 0, 0, 0, 143, 143, 1),
(788, 336, 2666, 0, 0, 0, 0, 0, 0, 144, 144, 1),
(789, 335, 2666, 0, 0, 0, 0, 0, 0, 145, 145, 1),
(790, 334, 2666, 0, 0, 0, 0, 0, 0, 146, 146, 1),
(791, 333, 2666, 0, 0, 0, 0, 0, 0, 147, 147, 1),
(792, 332, 2666, 0, 0, 0, 0, 0, 0, 148, 148, 1),
(793, 331, 2666, 0, 0, 0, 0, 0, 0, 149, 149, 1),
(794, 330, 2666, 0, 0, 0, 0, 0, 0, 150, 150, 1),
(795, 329, 2666, 0, 0, 0, 0, 0, 0, 151, 151, 1),
(796, 328, 2666, 0, 0, 0, 0, 0, 0, 152, 152, 1),
(797, 327, 2666, 0, 0, 0, 0, 0, 0, 153, 153, 1),
(798, 326, 2666, 0, 0, 0, 0, 0, 0, 154, 154, 1),
(799, 325, 2666, 0, 0, 0, 0, 0, 0, 155, 155, 1),
(800, 324, 2666, 0, 0, 0, 0, 0, 0, 156, 156, 1),
(801, 468, 2666, 0, 0, 0, 0, 0, 0, 304, 304, 89),
(802, 467, 2666, 0, 0, 0, 0, 0, 0, 305, 305, 89),
(803, 466, 2666, 0, 0, 0, 0, 0, 0, 306, 306, 89),
(804, 465, 2666, 0, 0, 0, 0, 0, 0, 307, 307, 89),
(805, 464, 2666, 0, 0, 0, 0, 0, 0, 308, 308, 89),
(806, 463, 2666, 0, 0, 0, 0, 0, 0, 309, 309, 89),
(807, 462, 2666, 0, 0, 0, 0, 0, 0, 310, 310, 89),
(808, 461, 2666, 0, 0, 0, 0, 0, 0, 311, 311, 89),
(809, 460, 2666, 0, 0, 0, 0, 0, 0, 312, 312, 89),
(810, 459, 2666, 0, 0, 0, 0, 0, 0, 313, 313, 89),
(811, 458, 2666, 0, 0, 0, 0, 0, 0, 314, 314, 89),
(812, 457, 2666, 0, 0, 0, 0, 0, 0, 315, 315, 89),
(813, 518, 2666, 0, 0, 0, 0, 0, 1, 157, 157, 1),
(814, 517, 2666, 0, 0, 0, 0, 0, 1, 158, 158, 1),
(815, 516, 2666, 0, 0, 0, 0, 0, 0, 159, 159, 1),
(816, 515, 2666, 0, 0, 0, 0, 0, 0, 160, 160, 1),
(817, 514, 2666, 0, 0, 0, 0, 0, 0, 161, 161, 1),
(818, 513, 2666, 0, 0, 0, 0, 0, 0, 162, 162, 1),
(819, 512, 2666, 0, 0, 0, 0, 0, 0, 163, 163, 1),
(820, 511, 2666, 0, 0, 0, 0, 0, 0, 164, 164, 1),
(821, 510, 2666, 0, 0, 0, 0, 0, 0, 165, 165, 1),
(822, 509, 2666, 0, 0, 0, 0, 0, 0, 166, 166, 1),
(823, 508, 2666, 0, 0, 0, 0, 0, 0, 167, 167, 1),
(824, 507, 2666, 0, 0, 0, 0, 0, 0, 168, 168, 1),
(825, 506, 2666, 0, 0, 0, 0, 0, 0, 169, 169, 1),
(826, 505, 2666, 0, 0, 0, 0, 0, 0, 170, 170, 1),
(827, 504, 2666, 0, 0, 0, 0, 0, 0, 171, 171, 1),
(828, 503, 2666, 0, 0, 0, 0, 0, 0, 172, 172, 1),
(829, 502, 2666, 0, 0, 0, 0, 0, 0, 173, 173, 1),
(830, 501, 2666, 0, 0, 0, 0, 0, 0, 174, 174, 1),
(831, 500, 2666, 0, 0, 0, 0, 0, 0, 175, 175, 1),
(832, 499, 2666, 0, 0, 0, 0, 0, 0, 176, 176, 1),
(833, 498, 2666, 0, 0, 0, 0, 0, 0, 177, 177, 1),
(834, 497, 2666, 0, 0, 0, 0, 0, 0, 178, 178, 1),
(835, 496, 2666, 0, 0, 0, 0, 0, 0, 179, 179, 1),
(836, 495, 2666, 0, 0, 0, 0, 0, 0, 180, 180, 1),
(837, 494, 2666, 0, 0, 0, 0, 0, 0, 181, 181, 1),
(838, 493, 2666, 0, 0, 0, 0, 0, 0, 182, 182, 1),
(839, 492, 2666, 0, 0, 0, 0, 0, 0, 183, 183, 1),
(840, 491, 2666, 0, 0, 0, 0, 0, 0, 184, 184, 1),
(841, 490, 2666, 0, 0, 0, 0, 0, 0, 185, 185, 1),
(842, 489, 2666, 0, 0, 0, 0, 0, 0, 186, 186, 1),
(843, 488, 2666, 0, 0, 0, 0, 0, 0, 187, 187, 1),
(844, 487, 2666, 0, 0, 0, 0, 0, 0, 188, 188, 1),
(845, 486, 2666, 0, 0, 0, 0, 0, 0, 189, 189, 1),
(846, 485, 2666, 0, 0, 0, 0, 0, 0, 190, 190, 1),
(847, 484, 2666, 0, 0, 0, 0, 0, 0, 191, 191, 1),
(848, 483, 2666, 0, 0, 0, 0, 0, 0, 192, 192, 1),
(849, 482, 2666, 0, 0, 0, 0, 0, 0, 193, 193, 1),
(850, 481, 2666, 0, 0, 0, 0, 0, 0, 194, 194, 1),
(851, 480, 2666, 0, 0, 0, 0, 0, 0, 195, 195, 1),
(852, 479, 2666, 0, 0, 0, 0, 0, 0, 196, 196, 1),
(853, 478, 2666, 0, 0, 0, 0, 0, 0, 197, 197, 1),
(854, 477, 2666, 0, 0, 0, 0, 0, 0, 198, 198, 1),
(855, 476, 2666, 0, 0, 0, 0, 0, 0, 199, 199, 1),
(856, 475, 2666, 0, 0, 0, 0, 0, 0, 200, 200, 1),
(857, 474, 2666, 0, 0, 0, 0, 0, 0, 201, 201, 1),
(858, 473, 2666, 0, 0, 0, 0, 0, 0, 202, 202, 1),
(859, 472, 2666, 0, 0, 0, 0, 0, 0, 203, 203, 1),
(860, 471, 2666, 0, 0, 0, 0, 0, 0, 204, 204, 1),
(861, 470, 2666, 0, 0, 0, 0, 0, 0, 205, 205, 1),
(862, 469, 2666, 0, 0, 0, 0, 0, 0, 206, 206, 1),
(863, 323, 2666, 0, 0, 0, 0, 0, 0, 207, 207, 1),
(864, 322, 2666, 0, 0, 0, 0, 0, 0, 208, 208, 1),
(865, 321, 2666, 0, 0, 0, 0, 0, 0, 209, 209, 1),
(866, 320, 2666, 0, 0, 0, 0, 0, 0, 210, 210, 1),
(867, 319, 2666, 0, 0, 0, 0, 0, 0, 211, 211, 1),
(868, 318, 2666, 0, 0, 0, 0, 0, 0, 212, 212, 1),
(869, 317, 2666, 0, 0, 0, 0, 0, 0, 213, 213, 1),
(870, 316, 2666, 0, 0, 0, 0, 0, 0, 214, 214, 1),
(871, 315, 2666, 0, 0, 0, 0, 0, 0, 215, 215, 1),
(872, 314, 2666, 0, 0, 0, 0, 0, 0, 216, 216, 1),
(873, 518, 2666, 0, 0, 1, 0, 0, 1, 316, 316, 89),
(874, 517, 2666, 0, 0, 1, 0, 0, 1, 317, 317, 89),
(875, 516, 2666, 0, 0, 0, 0, 0, 0, 318, 318, 89),
(876, 515, 2666, 0, 0, 0, 0, 0, 0, 319, 319, 89),
(877, 514, 2666, 0, 0, 0, 0, 0, 0, 320, 320, 89),
(878, 513, 2666, 0, 0, 0, 0, 0, 0, 321, 321, 89),
(879, 512, 2666, 0, 0, 0, 0, 0, 0, 322, 322, 89),
(880, 511, 2666, 0, 0, 0, 0, 0, 0, 323, 323, 89),
(881, 510, 2666, 0, 0, 0, 0, 0, 0, 324, 324, 89),
(882, 509, 2666, 0, 0, 0, 0, 0, 0, 325, 325, 89),
(883, 508, 2666, 0, 0, 0, 0, 0, 0, 326, 326, 89),
(884, 507, 2666, 0, 0, 0, 0, 0, 0, 327, 327, 89),
(885, 506, 2666, 0, 0, 0, 0, 0, 0, 328, 328, 89),
(886, 505, 2666, 0, 0, 0, 0, 0, 0, 329, 329, 89),
(887, 504, 2666, 0, 0, 0, 0, 0, 0, 330, 330, 89),
(888, 503, 2666, 0, 0, 0, 0, 0, 0, 331, 331, 89),
(889, 502, 2666, 0, 0, 0, 0, 0, 0, 332, 332, 89),
(890, 501, 2666, 0, 0, 0, 0, 0, 0, 333, 333, 89),
(891, 500, 2666, 0, 0, 0, 0, 0, 0, 334, 334, 89),
(892, 499, 2666, 0, 0, 0, 0, 0, 0, 335, 335, 89),
(893, 498, 2666, 0, 0, 0, 0, 0, 0, 336, 336, 89),
(894, 497, 2666, 0, 0, 0, 0, 0, 0, 337, 337, 89),
(895, 496, 2666, 0, 0, 0, 0, 0, 0, 338, 338, 89),
(896, 495, 2666, 0, 0, 0, 0, 0, 0, 339, 339, 89),
(897, 494, 2666, 0, 0, 0, 0, 0, 0, 340, 340, 89),
(898, 493, 2666, 0, 0, 0, 0, 0, 0, 341, 341, 89),
(899, 492, 2666, 0, 0, 0, 0, 0, 0, 342, 342, 89),
(900, 491, 2666, 0, 0, 0, 0, 0, 0, 343, 343, 89),
(901, 490, 2666, 0, 0, 0, 0, 0, 0, 344, 344, 89),
(902, 489, 2666, 0, 0, 0, 0, 0, 0, 345, 345, 89),
(903, 488, 2666, 0, 0, 0, 0, 0, 0, 346, 346, 89),
(904, 487, 2666, 0, 0, 0, 0, 0, 0, 347, 347, 89),
(905, 486, 2666, 0, 0, 0, 0, 0, 0, 348, 348, 89),
(906, 485, 2666, 0, 0, 0, 0, 0, 0, 349, 349, 89),
(907, 484, 2666, 0, 0, 0, 0, 0, 0, 350, 350, 89),
(908, 483, 2666, 0, 0, 0, 0, 0, 0, 351, 351, 89),
(909, 482, 2666, 0, 0, 0, 0, 0, 0, 352, 352, 89),
(910, 481, 2666, 0, 0, 0, 0, 0, 0, 353, 353, 89),
(911, 480, 2666, 0, 0, 0, 0, 0, 0, 354, 354, 89),
(912, 479, 2666, 0, 0, 0, 0, 0, 0, 355, 355, 89),
(913, 478, 2666, 0, 0, 0, 0, 0, 0, 356, 356, 89),
(914, 477, 2666, 0, 0, 0, 0, 0, 0, 357, 357, 89),
(915, 476, 2666, 0, 0, 0, 0, 0, 0, 358, 358, 89),
(916, 475, 2666, 0, 0, 0, 0, 0, 0, 359, 359, 89),
(917, 474, 2666, 0, 0, 0, 0, 0, 0, 360, 360, 89),
(918, 473, 2666, 0, 0, 0, 0, 0, 0, 361, 361, 89),
(919, 472, 2666, 0, 0, 0, 0, 0, 0, 362, 362, 89),
(920, 471, 2666, 0, 0, 0, 0, 0, 0, 363, 363, 89),
(921, 470, 2666, 0, 0, 0, 0, 0, 0, 364, 364, 89),
(922, 469, 2666, 0, 0, 0, 0, 0, 0, 365, 365, 89);

-- --------------------------------------------------------

--
-- 表的结构 `w_s_pro_attr`
--

DROP TABLE IF EXISTS `w_s_pro_attr`;
CREATE TABLE IF NOT EXISTS `w_s_pro_attr` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自动ID',
  `product_id` mediumint(8) NOT NULL default '0' COMMENT '产品ID ',
  `pro_attr_id` mediumint(8) unsigned NOT NULL default '0' COMMENT '产品属性ID，如色的auto ID',
  `uid` mediumint(8) unsigned NOT NULL default '0' COMMENT '该会员的ID',
  `price` float unsigned NOT NULL default '0' COMMENT '价格',
  `enabled` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否可用这个属性',
  PRIMARY KEY  (`id`,`uid`),
  KEY `fk_spec_value` (`pro_attr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `w_s_pro_attr`
--

INSERT INTO `w_s_pro_attr` (`id`, `product_id`, `pro_attr_id`, `uid`, `price`, `enabled`) VALUES
(1, 153, 112, 89, 32, 0),
(2, 153, 124, 89, 222, 1),
(3, 153, 125, 89, 233, 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_tags`
--

DROP TABLE IF EXISTS `w_tags`;
CREATE TABLE IF NOT EXISTS `w_tags` (
  `id` int(11) NOT NULL auto_increment,
  `tag` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `w_tags`
--

INSERT INTO `w_tags` (`id`, `tag`) VALUES
(1, 'asdf'),
(2, 'asfd'),
(3, 'test'),
(4, '手机'),
(5, '戴尔'),
(6, '黑陶');

-- --------------------------------------------------------

--
-- 表的结构 `w_templates_menu`
--

DROP TABLE IF EXISTS `w_templates_menu`;
CREATE TABLE IF NOT EXISTS `w_templates_menu` (
  `template` varchar(255) NOT NULL default '',
  `menuid` int(11) NOT NULL default '0',
  `client_id` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`menuid`,`client_id`,`template`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_templates_menu`
--

INSERT INTO `w_templates_menu` (`template`, `menuid`, `client_id`) VALUES
('daybillion', 0, 0),
('default', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_tree`
--

DROP TABLE IF EXISTS `w_tree`;
CREATE TABLE IF NOT EXISTS `w_tree` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) default '',
  `lft` int(10) unsigned NOT NULL default '0',
  `rgt` int(10) unsigned NOT NULL default '0',
  `parent_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `w_tree`
--

INSERT INTO `w_tree` (`id`, `name`, `lft`, `rgt`, `parent_id`) VALUES
(1, '关于我们', 1, 4, 0),
(2, '产品介绍', 5, 10, 0),
(3, '联系方式', 2, 3, 1),
(4, '电子产品', 6, 7, 2),
(5, '软件系列', 8, 9, 2);

-- --------------------------------------------------------

--
-- 表的结构 `w_users`
--

DROP TABLE IF EXISTS `w_users`;
CREATE TABLE IF NOT EXISTS `w_users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(150) NOT NULL default '',
  `nickname` varchar(30) default NULL,
  `email` varchar(100) NOT NULL default '',
  `password` varchar(100) NOT NULL default '',
  `usertype` varchar(25) NOT NULL default '',
  `block` tinyint(4) NOT NULL default '0',
  `sendEmail` tinyint(4) default '0',
  `gid` tinyint(3) unsigned NOT NULL default '1',
  `registerDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL default '',
  `params` text NOT NULL,
  `friend_auth` tinyint(2) default NULL COMMENT '是否需要验证好友添加申请',
  `subscribe` tinyint(2) default NULL COMMENT '邮件定阅',
  `favorites_num` int(4) NOT NULL default '0' COMMENT '收藏网址的数量',
  `photo` varchar(255) default NULL COMMENT '会员头像',
  `slogan` varchar(255) default NULL COMMENT '标语',
  `hits` int(4) NOT NULL default '0' COMMENT '点击人气',
  `uid` int(11) NOT NULL default '0',
  `province` int(11) NOT NULL default '0',
  `city` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `usertype` (`usertype`),
  KEY `gid_block` (`gid`,`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=126 ;

--
-- 转存表中的数据 `w_users`
--

INSERT INTO `w_users` (`id`, `username`, `nickname`, `email`, `password`, `usertype`, `block`, `sendEmail`, `gid`, `registerDate`, `lastvisitDate`, `activation`, `params`, `friend_auth`, `subscribe`, `favorites_num`, `photo`, `slogan`, `hits`, `uid`, `province`, `city`) VALUES
(89, 'testtest', '', 'day@126.com2', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', 0, 0, 17, '2010-04-14 11:02:42', '2011-04-09 23:40:22', '', '', 1, 2, 67, '/member/media/photo/kt28.jpg', '电影导航', 819, 0, 217, 220),
(1, 'china', 'asfd', 'whl308221710@163.com', 'c4033bff94b567a190e33faa551f411caef444f2', '', 0, 0, 22, '0000-00-00 00:00:00', '2011-06-03 14:43:09', '', '', 0, 3, 48, '/member/media/photo/kt2.jpg', '中国导航网', 3450, 0, 0, 0),
(105, 'tanggsh', '', 'tanggsh@tom.com2', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', 0, 0, 1, '2010-09-01 21:05:23', '2010-11-20 14:39:01', '', '', 0, 0, 9, '/member/media/photo/kt25.jpg', '设计师专用导航', 103, 0, 0, 0),
(108, 'mteddy', '', 'mteddy@126.com', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', 0, 0, 14, '2010-09-07 17:28:42', '2010-11-20 11:51:56', '', '', 0, 0, 0, '/member/media/photo/kt1.jpg', '', 118, 0, 0, 0),
(112, 'testtest5', '', 'daybillion@yahoo.com.cn', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', 1, 0, 1, '2010-11-18 08:58:46', '0000-00-00 00:00:00', '', '', 0, 0, 0, '', '', 0, 0, 0, 0),
(115, 'testtest33', '', 'whl30822710@163.com', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', 1, 0, 17, '2011-01-21 14:57:05', '0000-00-00 00:00:00', '', '', 0, 0, 0, '', '', 0, 0, 184, 189),
(116, 'test8882', '', 'whl30822710@163.com', '69c5fcebaa65b560eaf06c3fbeb481ae44b8d618', '', 0, 0, 17, '2011-01-21 15:17:01', '2011-03-22 14:05:19', '', '', 0, 0, 0, '', '', 0, 0, 217, 218),
(117, 'testtest333', '', 'werqwe@126.com', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', 0, 0, 1, '2011-03-15 16:27:02', '0000-00-00 00:00:00', '', '', 0, 0, 0, '', '', 0, 0, 0, 0),
(118, 'newuser1', '', 'whl_whm@126.com', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', 0, 0, 1, '2011-03-25 09:11:22', '2011-03-25 09:11:39', '', '', 0, 0, 0, '', '', 0, 0, 0, 0),
(119, 'testtest23', NULL, 'whl_whm@126.com', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', 0, 0, 1, '2011-05-10 17:46:20', '2011-05-10 17:48:45', '', '', NULL, NULL, 0, NULL, NULL, 0, 0, 0, NULL),
(120, 'yuejieyu', NULL, 'tanggsh@tom.com', '5a09a9529d102315d38ced62be2fff8dfe6354d3', '', 0, 0, 1, '2011-05-12 09:57:17', '2011-05-12 10:14:24', '', '', NULL, NULL, 0, NULL, NULL, 0, 0, 0, NULL),
(123, 'luoqin', '是否', 'luoqin2007@163.com', '69c5fcebaa65b560eaf06c3fbeb481ae44b8d618', '', 0, 0, 1, '2011-05-20 15:06:08', '2011-06-15 15:27:11', '', '', NULL, NULL, 0, NULL, NULL, 0, 0, 0, NULL),
(124, 'test12', '小小', 'luoqin2007@163.com', 'a70df52314ccb1f6cb2cf471e9d9cab93ed0aa9b', '', 0, 0, 1, '2011-05-24 15:58:31', '2011-06-08 10:48:27', '', '', NULL, NULL, 0, NULL, NULL, 0, 0, 0, NULL),
(125, 'lqskyer', NULL, 'luoqin2007@163.com', '69c5fcebaa65b560eaf06c3fbeb481ae44b8d618', '', 0, 0, 1, '2011-06-08 11:41:16', '2011-06-08 11:42:45', '', '', NULL, NULL, 0, NULL, NULL, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `w_users_address`
--

DROP TABLE IF EXISTS `w_users_address`;
CREATE TABLE IF NOT EXISTS `w_users_address` (
  `address_id` int(11) NOT NULL auto_increment,
  `address_name` varchar(50) NOT NULL default '',
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `consignee` varchar(60) NOT NULL default '',
  `email` varchar(60) default NULL,
  `country` smallint(5) NOT NULL default '1',
  `province` smallint(4) NOT NULL default '0',
  `city` smallint(5) NOT NULL default '0',
  `district` smallint(5) default NULL,
  `goods_address` varchar(120) NOT NULL,
  `zipcode` varchar(60) NOT NULL default '',
  `tel` varchar(60) NOT NULL default '',
  `goods_mobile` varchar(60) NOT NULL,
  `sign_building` varchar(120) NOT NULL default '',
  `best_time` varchar(120) NOT NULL default '',
  `defaulted` tinyint(1) default NULL,
  PRIMARY KEY  (`address_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `w_users_address`
--

INSERT INTO `w_users_address` (`address_id`, `address_name`, `uid`, `consignee`, `email`, `country`, `province`, `city`, `district`, `goods_address`, `zipcode`, `tel`, `goods_mobile`, `sign_building`, `best_time`, `defaulted`) VALUES
(2, '', 4, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0),
(3, '', 5, 'asdfasf', '', 0, 0, 0, 0, '', '', '', '', '', '', 0),
(4, '', 1, 'safdasf23', '', 0, 166, 167, 0, 'asfdasfd', 'asfd', '', 'asfd', '', '', 0),
(7, '', 1, 'asfd', '', 0, 148, 149, 0, 'asfdasfdasfd', 'asfd', '', 'asfd', '', '', 1),
(8, '', 1, '新天地', '', 0, 136, 137, 0, 'asfdasfd', 'afd', '', 'asfd', '', '', 0),
(20, '', 109, '张强', NULL, 0, 5, 0, NULL, 'asdf', 'asdf', 'asdf', 'sadf', '', '', 0),
(10, '', 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0),
(11, '', 0, 'asdf', '', 0, 2, 0, 0, 'asdf', 'asdfasfd', 'asdf', 'sadf', '', '', 0),
(12, '', 89, 'asdf', '', 0, 2, 0, 0, 'asdf', 'asdfasfd', 'asdf', 'sadf', '', '', 0),
(13, '', 89, 'asdf', '', 0, 2, 0, 0, 'asdf', 'asdfasfd', 'asdf', 'sadf', '', '', 0),
(14, '', 118, '小明', '', 0, 2, 0, 0, '北京市中心区', '12341234', '', '12342134', '', '', 0),
(21, '', 109, 'sadfasdf', NULL, 0, 30, 34, NULL, 'asdf', 'asdf', 'asdf', 'asdf', '', '', 0),
(17, '', 119, '张强', NULL, 0, 2, 0, NULL, '中心区三栋702', '10000', '', '13413123213', '', '', 0),
(18, '', 120, 'dfsdf', NULL, 0, 0, 0, NULL, 'ddfsdfs', 'dfsdf', 'dfsdf', 'asdfas', '', '', 0),
(19, '', 120, 'ghghgh', NULL, 0, 0, 0, NULL, 'fgfgghgh', 'ghghgh', 'ghghghgh', 'ghghgh', '', '', 0),
(23, '', 124, 'dd', NULL, 0, 3, 0, NULL, 'dd', 'dd', '', 'dd', '', '', 0),
(24, '', 124, '33', NULL, 0, 2, 0, NULL, 'd', 'e', '', '11', '', '', 0),
(25, '', 123, '1111', NULL, 0, 2, 0, NULL, '111', '111', '', '11', '', '', 0),
(26, '', 123, '1111', NULL, 0, 2, 0, NULL, '111', '111', '', '11', '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `w_user_friend`
--

DROP TABLE IF EXISTS `w_user_friend`;
CREATE TABLE IF NOT EXISTS `w_user_friend` (
  `uid` int(11) NOT NULL default '0',
  `fid` int(11) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_user_friend`
--

INSERT INTO `w_user_friend` (`uid`, `fid`) VALUES
(1, 89),
(105, 111),
(109, 105),
(0, 89),
(0, 89),
(0, 89),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 89),
(0, 89),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(89, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(89, 105),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(0, 1),
(1, 111),
(0, 111),
(89, 111),
(0, 111),
(0, 1),
(0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `w_user_info`
--

DROP TABLE IF EXISTS `w_user_info`;
CREATE TABLE IF NOT EXISTS `w_user_info` (
  `uid` int(11) NOT NULL COMMENT '会员ID',
  `sex` tinyint(4) default NULL COMMENT '性别',
  `year` int(4) default NULL COMMENT '出生年',
  `month` int(2) default NULL COMMENT '出生月',
  `day` int(2) default NULL COMMENT '出生日',
  `province` int(11) NOT NULL COMMENT '省ID',
  `city` int(11) default NULL COMMENT '市ID',
  `intro` varchar(255) default NULL COMMENT '简介',
  `contact_name` varchar(100) default NULL COMMENT '联系人姓名',
  `mobile` varchar(20) default NULL COMMENT '手机',
  `phone` varchar(20) default NULL COMMENT '电话',
  `address` varchar(255) default NULL COMMENT '地址',
  `zip` varchar(6) default NULL COMMENT '邮编',
  `c_name` varchar(60) default NULL COMMENT '公司名称',
  `c_contact_name` varchar(30) default NULL COMMENT '联系人',
  `c_contact_jobs` varchar(30) default NULL COMMENT '职位',
  `c_phone` varchar(20) default NULL COMMENT '电话',
  `c_fax` varchar(20) default NULL COMMENT '传真',
  `c_address` varchar(100) default NULL COMMENT '公司地址',
  `c_http` varchar(100) default NULL COMMENT '网址',
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_user_info`
--

INSERT INTO `w_user_info` (`uid`, `sex`, `year`, `month`, `day`, `province`, `city`, `intro`, `contact_name`, `mobile`, `phone`, `address`, `zip`, `c_name`, `c_contact_name`, `c_contact_jobs`, `c_phone`, `c_fax`, `c_address`, `c_http`) VALUES
(89, 1, 1984, 8, 18, 217, 220, 'adfasfdaf', 'dfasfd', '23423', '32', '43', '23', '23', '23', '23', '23', '23', '23', '23'),
(1, 1, 1975, 4, 1, 0, 0, '2222safd', '', 's23', 'we23', 'w2', '5', '', '', '', '', '', '', ''),
(110, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(114, 1, 1973, 3, 9, 30, 37, 'sadfa2', '1', '2', '3', '4', '5', 'asdf', '23', '23', '23', '23', '23', '23'),
(109, 0, 1985, 1, 1, 0, NULL, '', NULL, '', '', 'asdf', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113, 0, 1967, 1, 1, 0, 0, 'asfd', '', '', '', '', '', '2', '23', '23', '23', '23', '23', '23'),
(112, 0, 1967, 1, 1, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(115, 0, 1967, 1, 1, 184, 189, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(116, 0, 1967, 1, 1, 217, 218, '23', '1', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13'),
(124, 0, 1967, 1, 1, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
