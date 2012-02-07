drop table if exists w_activities;
CREATE TABLE `w_activities` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `start_time` int(4) unsigned NOT NULL default '0',
  `end_time` int(4) unsigned NOT NULL default '0',
  `published` tinyint(1) unsigned NOT NULL default '0',
  `act_type` tinyint(2) unsigned NOT NULL default '0',
  `remark` varchar(255) default NULL,
  `params` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `w_activities` VALUES ('1', 'asdfasdf', '1302566400', '1302739200', '0', '1', 'asdf', 'a:4:{s:5:\"money\";s:2:\"12\";s:13:\"products_name\";s:9:\"sadfasdf2\";s:11:\"products_id\";s:1:\"1\";s:5:\"thumb\";s:23:\"/media/1/1297835373.jpg\";}');
INSERT INTO `w_activities` VALUES ('2', 'asfasf', '0', '0', '0', '6', 'asdf', 'a:2:{s:8:\"topmoney\";s:3:\"213\";s:5:\"money\";s:2:\"12\";}');
drop table if exists w_adver_types;
CREATE TABLE `w_adver_types` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT '分类名称',
  `parent_id` int(11) NOT NULL COMMENT '父分类ID',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `published` tinyint(4) NOT NULL COMMENT '是否发布（1发布，0不发布）',
  `params` text NOT NULL COMMENT '分类参数',
  `ordering` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

INSERT INTO `w_adver_types` VALUES ('15', '首页主图广告', '0', '1', '1', '4|580|220', '19');
INSERT INTO `w_adver_types` VALUES ('16', '首页插图1', '0', '1', '1', '1|980|110', '21');
INSERT INTO `w_adver_types` VALUES ('17', '首页插图2', '0', '1', '1', '1|980|110', '22');
INSERT INTO `w_adver_types` VALUES ('18', '产品中心(banner)', '0', '1', '1', '1|980|60', '11');
INSERT INTO `w_adver_types` VALUES ('19', '新品上架(banner)', '0', '1', '1', '1|980|300', '12');
INSERT INTO `w_adver_types` VALUES ('20', '特价产品(banner)', '0', '1', '1', '1|980|300', '13');
drop table if exists w_advers;
CREATE TABLE `w_advers` (
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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

INSERT INTO `w_advers` VALUES ('41', '加湿器', '/media/1/oriks.jpg', '', '', '', '0', '0', '1', '1', '15', '23', '1');
INSERT INTO `w_advers` VALUES ('42', '干衣机', '/media/1/750x200d.jpg', '', '', '', '0', '0', '1', '2', '15', '34', '1');
INSERT INTO `w_advers` VALUES ('43', '电暖器', '/media/1/20110311-750x200aa.jpg', '', '', '', '0', '0', '1', '3', '15', '49', '1');
drop table if exists w_area;
CREATE TABLE `w_area` (
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
) ENGINE=MyISAM AUTO_INCREMENT=393 DEFAULT CHARSET=utf8;

INSERT INTO `w_area` VALUES ('1', '中国', 'china', '1', '784', '0', '1', '1', '0');
INSERT INTO `w_area` VALUES ('2', '北京', '', '2', '3', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('3', '上海', '', '4', '5', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('4', '天津', '', '6', '7', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('5', '重庆', '', '8', '9', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('6', '河北', '', '10', '33', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('7', '石家庄市', '', '11', '12', '6', '3', '1', '0');
INSERT INTO `w_area` VALUES ('8', '唐山市', '', '13', '14', '6', '3', '1', '0');
INSERT INTO `w_area` VALUES ('9', '秦皇岛市', '', '15', '16', '6', '3', '1', '0');
INSERT INTO `w_area` VALUES ('10', '邯郸市', '', '17', '18', '6', '3', '1', '0');
INSERT INTO `w_area` VALUES ('11', '邢台市', '', '19', '20', '6', '3', '1', '0');
INSERT INTO `w_area` VALUES ('12', '保定市', '', '21', '22', '6', '3', '1', '0');
INSERT INTO `w_area` VALUES ('13', '张家口市', '', '23', '24', '6', '3', '1', '0');
INSERT INTO `w_area` VALUES ('14', '承德市', '', '25', '26', '6', '3', '1', '0');
INSERT INTO `w_area` VALUES ('15', '沧州市', '', '27', '28', '6', '3', '1', '0');
INSERT INTO `w_area` VALUES ('16', '廊坊市', '', '29', '30', '6', '3', '1', '0');
INSERT INTO `w_area` VALUES ('17', '衡水市', '', '31', '32', '6', '3', '1', '0');
INSERT INTO `w_area` VALUES ('18', '山西', '', '34', '57', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('19', '太原市', '', '35', '36', '18', '3', '1', '0');
INSERT INTO `w_area` VALUES ('20', '大同市', '', '37', '38', '18', '3', '1', '0');
INSERT INTO `w_area` VALUES ('21', '阳泉市', '', '39', '40', '18', '3', '1', '0');
INSERT INTO `w_area` VALUES ('22', '长治市', '', '41', '42', '18', '3', '1', '0');
INSERT INTO `w_area` VALUES ('23', '晋城市', '', '43', '44', '18', '3', '1', '0');
INSERT INTO `w_area` VALUES ('24', '朔州市', '', '45', '46', '18', '3', '1', '0');
INSERT INTO `w_area` VALUES ('25', '晋中市', '', '47', '48', '18', '3', '1', '0');
INSERT INTO `w_area` VALUES ('26', '运城市', '', '49', '50', '18', '3', '1', '0');
INSERT INTO `w_area` VALUES ('27', '忻州市', '', '51', '52', '18', '3', '1', '0');
INSERT INTO `w_area` VALUES ('28', '临汾市', '', '53', '54', '18', '3', '1', '0');
INSERT INTO `w_area` VALUES ('29', '吕梁市', '', '55', '56', '18', '3', '1', '0');
INSERT INTO `w_area` VALUES ('30', '内蒙古', '', '58', '83', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('31', '呼和浩特市', '', '59', '60', '30', '3', '1', '0');
INSERT INTO `w_area` VALUES ('32', '包头市', '', '61', '62', '30', '3', '1', '0');
INSERT INTO `w_area` VALUES ('33', '乌海市', '', '63', '64', '30', '3', '1', '0');
INSERT INTO `w_area` VALUES ('34', '赤峰市', '', '65', '66', '30', '3', '1', '0');
INSERT INTO `w_area` VALUES ('35', '通辽市', '', '67', '68', '30', '3', '1', '0');
INSERT INTO `w_area` VALUES ('36', '鄂尔多斯市', '', '69', '70', '30', '3', '1', '0');
INSERT INTO `w_area` VALUES ('37', '呼伦贝尔市', '', '71', '72', '30', '3', '1', '0');
INSERT INTO `w_area` VALUES ('38', '巴彦淖尔市', '', '73', '74', '30', '3', '1', '0');
INSERT INTO `w_area` VALUES ('39', '乌兰察布市', '', '75', '76', '30', '3', '1', '0');
INSERT INTO `w_area` VALUES ('40', '兴安盟', '', '77', '78', '30', '3', '1', '0');
INSERT INTO `w_area` VALUES ('41', '锡林郭勒盟', '', '79', '80', '30', '3', '1', '0');
INSERT INTO `w_area` VALUES ('42', '阿拉善盟', '', '81', '82', '30', '3', '1', '0');
INSERT INTO `w_area` VALUES ('43', '辽宁', '', '84', '113', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('44', '沈阳市', '', '85', '86', '43', '3', '1', '0');
INSERT INTO `w_area` VALUES ('45', '大连市', '', '87', '88', '43', '3', '1', '0');
INSERT INTO `w_area` VALUES ('46', '鞍山市', '', '89', '90', '43', '3', '1', '0');
INSERT INTO `w_area` VALUES ('47', '抚顺市', '', '91', '92', '43', '3', '1', '0');
INSERT INTO `w_area` VALUES ('48', '本溪市', '', '93', '94', '43', '3', '1', '0');
INSERT INTO `w_area` VALUES ('49', '丹东市', '', '95', '96', '43', '3', '1', '0');
INSERT INTO `w_area` VALUES ('50', '锦州市', '', '97', '98', '43', '3', '1', '0');
INSERT INTO `w_area` VALUES ('51', '营口市', '', '99', '100', '43', '3', '1', '0');
INSERT INTO `w_area` VALUES ('52', '阜新市', '', '101', '102', '43', '3', '1', '0');
INSERT INTO `w_area` VALUES ('53', '辽阳市', '', '103', '104', '43', '3', '1', '0');
INSERT INTO `w_area` VALUES ('54', '盘锦市', '', '105', '106', '43', '3', '1', '0');
INSERT INTO `w_area` VALUES ('55', '铁岭市', '', '107', '108', '43', '3', '1', '0');
INSERT INTO `w_area` VALUES ('56', '朝阳市', '', '109', '110', '43', '3', '1', '0');
INSERT INTO `w_area` VALUES ('57', '葫芦岛市', '', '111', '112', '43', '3', '1', '0');
INSERT INTO `w_area` VALUES ('58', '吉林', '', '114', '133', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('59', '长春市', '', '115', '116', '58', '3', '1', '0');
INSERT INTO `w_area` VALUES ('60', '吉林市', '', '117', '118', '58', '3', '1', '0');
INSERT INTO `w_area` VALUES ('61', '四平市', '', '119', '120', '58', '3', '1', '0');
INSERT INTO `w_area` VALUES ('62', '辽源市', '', '121', '122', '58', '3', '1', '0');
INSERT INTO `w_area` VALUES ('63', '通化市', '', '123', '124', '58', '3', '1', '0');
INSERT INTO `w_area` VALUES ('64', '白山市', '', '125', '126', '58', '3', '1', '0');
INSERT INTO `w_area` VALUES ('65', '松原市', '', '127', '128', '58', '3', '1', '0');
INSERT INTO `w_area` VALUES ('66', '白城市', '', '129', '130', '58', '3', '1', '0');
INSERT INTO `w_area` VALUES ('67', '延边朝鲜族自治州', '', '131', '132', '58', '3', '1', '0');
INSERT INTO `w_area` VALUES ('68', '黑龙江', '', '134', '161', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('69', '哈尔滨市', '', '135', '136', '68', '3', '1', '0');
INSERT INTO `w_area` VALUES ('70', '齐齐哈尔市', '', '137', '138', '68', '3', '1', '0');
INSERT INTO `w_area` VALUES ('71', '鸡西市', '', '139', '140', '68', '3', '1', '0');
INSERT INTO `w_area` VALUES ('72', '鹤岗市', '', '141', '142', '68', '3', '1', '0');
INSERT INTO `w_area` VALUES ('73', '双鸭山市', '', '143', '144', '68', '3', '1', '0');
INSERT INTO `w_area` VALUES ('74', '大庆市', '', '145', '146', '68', '3', '1', '0');
INSERT INTO `w_area` VALUES ('75', '伊春市', '', '147', '148', '68', '3', '1', '0');
INSERT INTO `w_area` VALUES ('76', '佳木斯市', '', '149', '150', '68', '3', '1', '0');
INSERT INTO `w_area` VALUES ('77', '七台河市', '', '151', '152', '68', '3', '1', '0');
INSERT INTO `w_area` VALUES ('78', '牡丹江市', '', '153', '154', '68', '3', '1', '0');
INSERT INTO `w_area` VALUES ('79', '黑河市', '', '155', '156', '68', '3', '1', '0');
INSERT INTO `w_area` VALUES ('80', '绥化市', '', '157', '158', '68', '3', '1', '0');
INSERT INTO `w_area` VALUES ('81', '大兴安岭地区', '', '159', '160', '68', '3', '1', '0');
INSERT INTO `w_area` VALUES ('82', '江苏', '', '162', '189', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('83', '南京市', '', '163', '164', '82', '3', '1', '0');
INSERT INTO `w_area` VALUES ('84', '无锡市', '', '165', '166', '82', '3', '1', '0');
INSERT INTO `w_area` VALUES ('85', '徐州市', '', '167', '168', '82', '3', '1', '0');
INSERT INTO `w_area` VALUES ('86', '常州市', '', '169', '170', '82', '3', '1', '0');
INSERT INTO `w_area` VALUES ('87', '苏州市', '', '171', '172', '82', '3', '1', '0');
INSERT INTO `w_area` VALUES ('88', '南通市', '', '173', '174', '82', '3', '1', '0');
INSERT INTO `w_area` VALUES ('89', '连云港市', '', '175', '176', '82', '3', '1', '0');
INSERT INTO `w_area` VALUES ('90', '淮安市', '', '177', '178', '82', '3', '1', '0');
INSERT INTO `w_area` VALUES ('91', '盐城市', '', '179', '180', '82', '3', '1', '0');
INSERT INTO `w_area` VALUES ('92', '扬州市', '', '181', '182', '82', '3', '1', '0');
INSERT INTO `w_area` VALUES ('93', '镇江市', '', '183', '184', '82', '3', '1', '0');
INSERT INTO `w_area` VALUES ('94', '泰州市', '', '185', '186', '82', '3', '1', '0');
INSERT INTO `w_area` VALUES ('95', '宿迁市', '', '187', '188', '82', '3', '1', '0');
INSERT INTO `w_area` VALUES ('96', '浙江', '', '190', '213', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('97', '杭州市', '', '191', '192', '96', '3', '1', '0');
INSERT INTO `w_area` VALUES ('98', '宁波市', '', '193', '194', '96', '3', '1', '0');
INSERT INTO `w_area` VALUES ('99', '温州市', '', '195', '196', '96', '3', '1', '0');
INSERT INTO `w_area` VALUES ('100', '嘉兴市', '', '197', '198', '96', '3', '1', '0');
INSERT INTO `w_area` VALUES ('101', '湖州市', '', '199', '200', '96', '3', '1', '0');
INSERT INTO `w_area` VALUES ('102', '绍兴市', '', '201', '202', '96', '3', '1', '0');
INSERT INTO `w_area` VALUES ('103', '金华市', '', '203', '204', '96', '3', '1', '0');
INSERT INTO `w_area` VALUES ('104', '衢州市', '', '205', '206', '96', '3', '1', '0');
INSERT INTO `w_area` VALUES ('105', '舟山市', '', '207', '208', '96', '3', '1', '0');
INSERT INTO `w_area` VALUES ('106', '台州市', '', '209', '210', '96', '3', '1', '0');
INSERT INTO `w_area` VALUES ('107', '丽水市', '', '211', '212', '96', '3', '1', '0');
INSERT INTO `w_area` VALUES ('108', '安徽', '', '214', '249', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('109', '合肥市', '', '215', '216', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('110', '芜湖市', '', '217', '218', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('111', '蚌埠市', '', '219', '220', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('112', '淮南市', '', '221', '222', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('113', '马鞍山市', '', '223', '224', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('114', '淮北市', '', '225', '226', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('115', '铜陵市', '', '227', '228', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('116', '安庆市', '', '229', '230', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('117', '黄山市', '', '231', '232', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('118', '滁州市', '', '233', '234', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('119', '阜阳市', '', '235', '236', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('120', '宿州市', '', '237', '238', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('121', '巢湖市', '', '239', '240', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('122', '六安市', '', '241', '242', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('123', '亳州市', '', '243', '244', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('124', '池州市', '', '245', '246', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('125', '宣城市', '', '247', '248', '108', '3', '1', '0');
INSERT INTO `w_area` VALUES ('126', '福建', '', '250', '269', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('127', '福州市', '', '251', '252', '126', '3', '1', '0');
INSERT INTO `w_area` VALUES ('128', '厦门市', '', '253', '254', '126', '3', '1', '0');
INSERT INTO `w_area` VALUES ('129', '莆田市', '', '255', '256', '126', '3', '1', '0');
INSERT INTO `w_area` VALUES ('130', '三明市', '', '257', '258', '126', '3', '1', '0');
INSERT INTO `w_area` VALUES ('131', '泉州市', '', '259', '260', '126', '3', '1', '0');
INSERT INTO `w_area` VALUES ('132', '漳州市', '', '261', '262', '126', '3', '1', '0');
INSERT INTO `w_area` VALUES ('133', '南平市', '', '263', '264', '126', '3', '1', '0');
INSERT INTO `w_area` VALUES ('134', '龙岩市', '', '265', '266', '126', '3', '1', '0');
INSERT INTO `w_area` VALUES ('135', '宁德市', '', '267', '268', '126', '3', '1', '0');
INSERT INTO `w_area` VALUES ('136', '江西', '', '270', '293', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('137', '南昌市', '', '271', '272', '136', '3', '1', '0');
INSERT INTO `w_area` VALUES ('138', '景德镇市', '', '273', '274', '136', '3', '1', '0');
INSERT INTO `w_area` VALUES ('139', '萍乡市', '', '275', '276', '136', '3', '1', '0');
INSERT INTO `w_area` VALUES ('140', '九江市', '', '277', '278', '136', '3', '1', '0');
INSERT INTO `w_area` VALUES ('141', '新余市', '', '279', '280', '136', '3', '1', '0');
INSERT INTO `w_area` VALUES ('142', '鹰潭市', '', '281', '282', '136', '3', '1', '0');
INSERT INTO `w_area` VALUES ('143', '赣州市', '', '283', '284', '136', '3', '1', '0');
INSERT INTO `w_area` VALUES ('144', '吉安市', '', '285', '286', '136', '3', '1', '0');
INSERT INTO `w_area` VALUES ('145', '宜春市', '', '287', '288', '136', '3', '1', '0');
INSERT INTO `w_area` VALUES ('146', '抚州市', '', '289', '290', '136', '3', '1', '0');
INSERT INTO `w_area` VALUES ('147', '上饶市', '', '291', '292', '136', '3', '1', '0');
INSERT INTO `w_area` VALUES ('148', '山东', '', '294', '329', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('149', '济南市', '', '295', '296', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('150', '青岛市', '', '297', '298', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('151', '淄博市', '', '299', '300', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('152', '枣庄市', '', '301', '302', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('153', '东营市', '', '303', '304', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('154', '烟台市', '', '305', '306', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('155', '潍坊市', '', '307', '308', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('156', '济宁市', '', '309', '310', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('157', '泰安市', '', '311', '312', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('158', '威海市', '', '313', '314', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('159', '日照市', '', '315', '316', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('160', '莱芜市', '', '317', '318', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('161', '临沂市', '', '319', '320', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('162', '德州市', '', '321', '322', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('163', '聊城市', '', '323', '324', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('164', '滨州市', '', '325', '326', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('165', '荷泽市', '', '327', '328', '148', '3', '1', '0');
INSERT INTO `w_area` VALUES ('166', '河南', '', '330', '365', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('167', '郑州市', '', '331', '332', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('168', '开封市', '', '333', '334', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('169', '洛阳市', '', '335', '336', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('170', '平顶山市', '', '337', '338', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('171', '安阳市', '', '339', '340', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('172', '鹤壁市', '', '341', '342', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('173', '新乡市', '', '343', '344', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('174', '焦作市', '', '345', '346', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('175', '濮阳市', '', '347', '348', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('176', '许昌市', '', '349', '350', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('177', '漯河市', '', '351', '352', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('178', '三门峡市', '', '353', '354', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('179', '南阳市', '', '355', '356', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('180', '商丘市', '', '357', '358', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('181', '信阳市', '', '359', '360', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('182', '周口市', '', '361', '362', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('183', '驻马店市', '', '363', '364', '166', '3', '1', '0');
INSERT INTO `w_area` VALUES ('184', '湖北', '', '366', '401', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('185', '武汉市', '', '367', '368', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('186', '黄石市', '', '369', '370', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('187', '十堰市', '', '371', '372', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('188', '宜昌市', '', '373', '374', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('189', '襄樊市', 'xf', '375', '376', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('190', '鄂州市', '', '377', '378', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('191', '荆门市', '', '379', '380', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('192', '孝感市', '', '381', '382', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('193', '荆州市', '', '383', '384', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('194', '黄冈市', '', '385', '386', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('195', '咸宁市', '', '387', '388', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('196', '随州市', '', '389', '390', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('197', '恩施土家族苗族自治州', '', '391', '392', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('198', '仙桃市', '', '393', '394', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('199', '潜江市', '', '395', '396', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('200', '天门市', '', '397', '398', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('201', '神农架林区', '', '399', '400', '184', '3', '1', '0');
INSERT INTO `w_area` VALUES ('202', '湖南', '', '402', '431', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('203', '长沙市', '', '403', '404', '202', '3', '1', '0');
INSERT INTO `w_area` VALUES ('204', '株洲市', '', '405', '406', '202', '3', '1', '0');
INSERT INTO `w_area` VALUES ('205', '湘潭市', '', '407', '408', '202', '3', '1', '0');
INSERT INTO `w_area` VALUES ('206', '衡阳市', '', '409', '410', '202', '3', '1', '0');
INSERT INTO `w_area` VALUES ('207', '邵阳市', '', '411', '412', '202', '3', '1', '0');
INSERT INTO `w_area` VALUES ('208', '岳阳市', '', '413', '414', '202', '3', '1', '0');
INSERT INTO `w_area` VALUES ('209', '常德市', '', '415', '416', '202', '3', '1', '0');
INSERT INTO `w_area` VALUES ('210', '张家界市', '', '417', '418', '202', '3', '1', '0');
INSERT INTO `w_area` VALUES ('211', '益阳市', '', '419', '420', '202', '3', '1', '0');
INSERT INTO `w_area` VALUES ('212', '郴州市', '', '421', '422', '202', '3', '1', '0');
INSERT INTO `w_area` VALUES ('213', '永州市', '', '423', '424', '202', '3', '1', '0');
INSERT INTO `w_area` VALUES ('214', '怀化市', '', '425', '426', '202', '3', '1', '0');
INSERT INTO `w_area` VALUES ('215', '娄底市', '', '427', '428', '202', '3', '1', '0');
INSERT INTO `w_area` VALUES ('216', '湘西土家族苗族自治州', '', '429', '430', '202', '3', '1', '0');
INSERT INTO `w_area` VALUES ('217', '广东', '', '432', '475', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('218', '广州市', 'gz', '433', '434', '217', '3', '1', '116');
INSERT INTO `w_area` VALUES ('219', '韶关市', '', '435', '436', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('220', '深圳市', 'sz', '437', '438', '217', '3', '1', '89');
INSERT INTO `w_area` VALUES ('221', '珠海市', '', '439', '440', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('222', '汕头市', '', '441', '442', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('223', '佛山市', '', '443', '444', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('224', '江门市', '', '445', '446', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('225', '湛江市', '', '447', '448', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('226', '茂名市', '', '449', '450', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('227', '肇庆市', '', '451', '452', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('228', '惠州市', '', '453', '454', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('229', '梅州市', '', '455', '456', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('230', '汕尾市', '', '457', '458', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('231', '河源市', '', '459', '460', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('232', '阳江市', '', '461', '462', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('233', '清远市', '', '463', '464', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('234', '东莞市', '', '465', '466', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('235', '中山市', '', '467', '468', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('236', '潮州市', '', '469', '470', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('237', '揭阳市', '', '471', '472', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('238', '云浮市', '', '473', '474', '217', '3', '1', '0');
INSERT INTO `w_area` VALUES ('239', '广西', '', '476', '505', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('240', '南宁市', '', '477', '478', '239', '3', '1', '0');
INSERT INTO `w_area` VALUES ('241', '柳州市', '', '479', '480', '239', '3', '1', '0');
INSERT INTO `w_area` VALUES ('242', '桂林市', '', '481', '482', '239', '3', '1', '0');
INSERT INTO `w_area` VALUES ('243', '梧州市', '', '483', '484', '239', '3', '1', '0');
INSERT INTO `w_area` VALUES ('244', '北海市', '', '485', '486', '239', '3', '1', '0');
INSERT INTO `w_area` VALUES ('245', '防城港市', '', '487', '488', '239', '3', '1', '0');
INSERT INTO `w_area` VALUES ('246', '钦州市', '', '489', '490', '239', '3', '1', '0');
INSERT INTO `w_area` VALUES ('247', '贵港市', '', '491', '492', '239', '3', '1', '0');
INSERT INTO `w_area` VALUES ('248', '玉林市', '', '493', '494', '239', '3', '1', '0');
INSERT INTO `w_area` VALUES ('249', '百色市', '', '495', '496', '239', '3', '1', '0');
INSERT INTO `w_area` VALUES ('250', '贺州市', '', '497', '498', '239', '3', '1', '0');
INSERT INTO `w_area` VALUES ('251', '河池市', '', '499', '500', '239', '3', '1', '0');
INSERT INTO `w_area` VALUES ('252', '来宾市', '', '501', '502', '239', '3', '1', '0');
INSERT INTO `w_area` VALUES ('253', '崇左市', '', '503', '504', '239', '3', '1', '0');
INSERT INTO `w_area` VALUES ('254', '海南', '', '506', '543', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('255', '海口市', '', '507', '508', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('256', '三亚市', '', '509', '510', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('257', '五指山市', '', '511', '512', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('258', '琼海市', '', '513', '514', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('259', '儋州市', '', '515', '516', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('260', '文昌市', '', '517', '518', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('261', '万宁市', '', '519', '520', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('262', '东方市', '', '521', '522', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('263', '定安县', '', '523', '524', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('264', '屯昌县', '', '525', '526', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('265', '澄迈县', '', '527', '528', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('266', '临高县', '', '529', '530', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('267', '白沙黎族自治县', '', '531', '532', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('268', '昌江黎族自治县', '', '533', '534', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('269', '乐东黎族自治县', '', '535', '536', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('270', '陵水黎族自治县', '', '537', '538', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('271', '保亭黎族苗族自治县', '', '539', '540', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('272', '琼中黎族苗族自治县', '', '541', '542', '254', '3', '1', '0');
INSERT INTO `w_area` VALUES ('273', '四川', '', '544', '587', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('274', '成都市', '', '545', '546', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('275', '自贡市', '', '547', '548', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('276', '攀枝花市', '', '549', '550', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('277', '泸州市', '', '551', '552', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('278', '德阳市', '', '553', '554', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('279', '绵阳市', '', '555', '556', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('280', '广元市', '', '557', '558', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('281', '遂宁市', '', '559', '560', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('282', '内江市', '', '561', '562', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('283', '乐山市', '', '563', '564', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('284', '南充市', '', '565', '566', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('285', '眉山市', '', '567', '568', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('286', '宜宾市', '', '569', '570', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('287', '广安市', '', '571', '572', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('288', '达州市', '', '573', '574', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('289', '雅安市', '', '575', '576', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('290', '巴中市', '', '577', '578', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('291', '资阳市', '', '579', '580', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('292', '阿坝藏族羌族自治州', '', '581', '582', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('293', '甘孜藏族自治州', '', '583', '584', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('294', '凉山彝族自治州', '', '585', '586', '273', '3', '1', '0');
INSERT INTO `w_area` VALUES ('295', '贵州', '', '588', '607', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('296', '贵阳市', '', '589', '590', '295', '3', '1', '0');
INSERT INTO `w_area` VALUES ('297', '六盘水市', '', '591', '592', '295', '3', '1', '0');
INSERT INTO `w_area` VALUES ('298', '遵义市', '', '593', '594', '295', '3', '1', '0');
INSERT INTO `w_area` VALUES ('299', '安顺市', '', '595', '596', '295', '3', '1', '0');
INSERT INTO `w_area` VALUES ('300', '铜仁地区', '', '597', '598', '295', '3', '1', '0');
INSERT INTO `w_area` VALUES ('301', '黔西南布依族苗族自治州', '', '599', '600', '295', '3', '1', '0');
INSERT INTO `w_area` VALUES ('302', '毕节地区', '', '601', '602', '295', '3', '1', '0');
INSERT INTO `w_area` VALUES ('303', '黔东南苗族侗族自治州', '', '603', '604', '295', '3', '1', '0');
INSERT INTO `w_area` VALUES ('304', '黔南布依族苗族自治州', '', '605', '606', '295', '3', '1', '0');
INSERT INTO `w_area` VALUES ('305', '云南', '', '608', '641', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('306', '昆明市', '', '609', '610', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('307', '曲靖市', '', '611', '612', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('308', '玉溪市', '', '613', '614', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('309', '保山市', '', '615', '616', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('310', '昭通市', '', '617', '618', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('311', '丽江市', '', '619', '620', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('312', '思茅市', '', '621', '622', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('313', '临沧市', '', '623', '624', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('314', '楚雄彝族自治州', '', '625', '626', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('315', '红河哈尼族彝族自治州', '', '627', '628', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('316', '文山壮族苗族自治州', '', '629', '630', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('317', '西双版纳傣族自治州', '', '631', '632', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('318', '大理白族自治州', '', '633', '634', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('319', '德宏傣族景颇族自治州', '', '635', '636', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('320', '怒江傈僳族自治州', '', '637', '638', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('321', '迪庆藏族自治州', '', '639', '640', '305', '3', '1', '0');
INSERT INTO `w_area` VALUES ('322', '西藏', '', '642', '657', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('323', '拉萨市', '', '643', '644', '322', '3', '1', '0');
INSERT INTO `w_area` VALUES ('324', '昌都地区', '', '645', '646', '322', '3', '1', '0');
INSERT INTO `w_area` VALUES ('325', '山南地区', '', '647', '648', '322', '3', '1', '0');
INSERT INTO `w_area` VALUES ('326', '日喀则地区', '', '649', '650', '322', '3', '1', '0');
INSERT INTO `w_area` VALUES ('327', '那曲地区', '', '651', '652', '322', '3', '1', '0');
INSERT INTO `w_area` VALUES ('328', '阿里地区', '', '653', '654', '322', '3', '1', '0');
INSERT INTO `w_area` VALUES ('329', '林芝地区', '', '655', '656', '322', '3', '1', '0');
INSERT INTO `w_area` VALUES ('330', '陕西', '', '658', '679', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('331', '西安市', '', '659', '660', '330', '3', '1', '0');
INSERT INTO `w_area` VALUES ('332', '铜川市', '', '661', '662', '330', '3', '1', '0');
INSERT INTO `w_area` VALUES ('333', '宝鸡市', '', '663', '664', '330', '3', '1', '0');
INSERT INTO `w_area` VALUES ('334', '咸阳市', '', '665', '666', '330', '3', '1', '0');
INSERT INTO `w_area` VALUES ('335', '渭南市', '', '667', '668', '330', '3', '1', '0');
INSERT INTO `w_area` VALUES ('336', '延安市', '', '669', '670', '330', '3', '1', '0');
INSERT INTO `w_area` VALUES ('337', '汉中市', '', '671', '672', '330', '3', '1', '0');
INSERT INTO `w_area` VALUES ('338', '榆林市', '', '673', '674', '330', '3', '1', '0');
INSERT INTO `w_area` VALUES ('339', '安康市', '', '675', '676', '330', '3', '1', '0');
INSERT INTO `w_area` VALUES ('340', '商洛市', '', '677', '678', '330', '3', '1', '0');
INSERT INTO `w_area` VALUES ('341', '甘肃', '', '680', '709', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('342', '兰州市', '', '681', '682', '341', '3', '1', '0');
INSERT INTO `w_area` VALUES ('343', '嘉峪关市', '', '683', '684', '341', '3', '1', '0');
INSERT INTO `w_area` VALUES ('344', '金昌市', '', '685', '686', '341', '3', '1', '0');
INSERT INTO `w_area` VALUES ('345', '白银市', '', '687', '688', '341', '3', '1', '0');
INSERT INTO `w_area` VALUES ('346', '天水市', '', '689', '690', '341', '3', '1', '0');
INSERT INTO `w_area` VALUES ('347', '武威市', '', '691', '692', '341', '3', '1', '0');
INSERT INTO `w_area` VALUES ('348', '张掖市', '', '693', '694', '341', '3', '1', '0');
INSERT INTO `w_area` VALUES ('349', '平凉市', '', '695', '696', '341', '3', '1', '0');
INSERT INTO `w_area` VALUES ('350', '酒泉市', '', '697', '698', '341', '3', '1', '0');
INSERT INTO `w_area` VALUES ('351', '庆阳市', '', '699', '700', '341', '3', '1', '0');
INSERT INTO `w_area` VALUES ('352', '定西市', '', '701', '702', '341', '3', '1', '0');
INSERT INTO `w_area` VALUES ('353', '陇南市', '', '703', '704', '341', '3', '1', '0');
INSERT INTO `w_area` VALUES ('354', '临夏回族自治州', '', '705', '706', '341', '3', '1', '0');
INSERT INTO `w_area` VALUES ('355', '甘南藏族自治州', '', '707', '708', '341', '3', '1', '0');
INSERT INTO `w_area` VALUES ('356', '青海', '', '710', '727', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('357', '西宁市', '', '711', '712', '356', '3', '1', '0');
INSERT INTO `w_area` VALUES ('358', '海东地区', '', '713', '714', '356', '3', '1', '0');
INSERT INTO `w_area` VALUES ('359', '海北藏族自治州', '', '715', '716', '356', '3', '1', '0');
INSERT INTO `w_area` VALUES ('360', '黄南藏族自治州', '', '717', '718', '356', '3', '1', '0');
INSERT INTO `w_area` VALUES ('361', '海南藏族自治州', '', '719', '720', '356', '3', '1', '0');
INSERT INTO `w_area` VALUES ('362', '果洛藏族自治州', '', '721', '722', '356', '3', '1', '0');
INSERT INTO `w_area` VALUES ('363', '玉树藏族自治州', '', '723', '724', '356', '3', '1', '0');
INSERT INTO `w_area` VALUES ('364', '海西蒙古族藏族自治州', '', '725', '726', '356', '3', '1', '0');
INSERT INTO `w_area` VALUES ('365', '宁夏', '', '728', '739', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('366', '银川市', '', '729', '730', '365', '3', '1', '0');
INSERT INTO `w_area` VALUES ('367', '石嘴山市', '', '731', '732', '365', '3', '1', '0');
INSERT INTO `w_area` VALUES ('368', '吴忠市', '', '733', '734', '365', '3', '1', '0');
INSERT INTO `w_area` VALUES ('369', '固原市', '', '735', '736', '365', '3', '1', '0');
INSERT INTO `w_area` VALUES ('370', '中卫市', '', '737', '738', '365', '3', '1', '0');
INSERT INTO `w_area` VALUES ('371', '新疆', '', '740', '777', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('372', '乌鲁木齐市', '', '741', '742', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('373', '克拉玛依市', '', '743', '744', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('374', '吐鲁番地区', '', '745', '746', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('375', '哈密地区', '', '747', '748', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('376', '昌吉回族自治州', '', '749', '750', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('377', '博尔塔拉蒙古自治州', '', '751', '752', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('378', '巴音郭楞蒙古自治州', '', '753', '754', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('379', '阿克苏地区', '', '755', '756', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('380', '克孜勒苏柯尔克孜自治州', '', '757', '758', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('381', '喀什地区', '', '759', '760', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('382', '和田地区', '', '761', '762', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('383', '伊犁哈萨克自治州', '', '763', '764', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('384', '塔城地区', '', '765', '766', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('385', '阿勒泰地区', '', '767', '768', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('386', '石河子市', '', '769', '770', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('387', '阿拉尔市', '', '771', '772', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('388', '图木舒克市', '', '773', '774', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('389', '五家渠市', '', '775', '776', '371', '3', '1', '0');
INSERT INTO `w_area` VALUES ('390', '台湾', 'taiwan', '782', '783', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('391', '香港', '', '778', '779', '1', '2', '1', '0');
INSERT INTO `w_area` VALUES ('392', '澳门', '', '780', '781', '1', '2', '1', '0');
drop table if exists w_banners;
CREATE TABLE `w_banners` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `tid` int(4) NOT NULL default '0',
  `ordering` tinyint(4) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  `params` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `w_banners` VALUES ('1', '0', '15', '0', '0', 'a:4:{i:0;a:3:{s:5:\"title\";s:0:\"\";s:4:\"http\";s:1:\"/\";s:5:\"thumb\";s:27:\"/media/1/banners/thumb1.jpg\";}i:1;a:3:{s:5:\"title\";s:0:\"\";s:4:\"http\";s:1:\"/\";s:5:\"thumb\";s:27:\"/media/1/banners/thumb2.jpg\";}i:2;a:3:{s:5:\"title\";s:0:\"\";s:4:\"http\";s:1:\"/\";s:5:\"thumb\";s:27:\"/media/1/banners/thumb3.jpg\";}i:3;a:3:{s:5:\"title\";s:0:\"\";s:4:\"http\";s:1:\"/\";s:5:\"thumb\";s:27:\"/media/1/banners/thumb4.jpg\";}}');
INSERT INTO `w_banners` VALUES ('2', '0', '16', '0', '0', 'a:1:{i:0;a:3:{s:5:\"title\";s:0:\"\";s:4:\"http\";s:0:\"\";s:5:\"thumb\";s:27:\"/media/1/banners/hthum1.jpg\";}}');
INSERT INTO `w_banners` VALUES ('3', '0', '17', '0', '0', 'a:1:{i:0;a:3:{s:5:\"title\";s:0:\"\";s:4:\"http\";s:0:\"\";s:5:\"thumb\";s:27:\"/media/1/banners/hthum2.jpg\";}}');
drop table if exists w_brand;
CREATE TABLE `w_brand` (
  `brand_id` smallint(5) unsigned NOT NULL auto_increment,
  `brand_name` varchar(60) NOT NULL default '',
  `brand_logo` varchar(80) NOT NULL default '',
  `brand_desc` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `ordering` tinyint(3) unsigned NOT NULL default '50',
  `published` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`brand_id`),
  KEY `published` (`published`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `w_brand` VALUES ('12', '格力', '/media/1/1295335747.jpg', 'asfd23', '2', '255', '0');
drop table if exists w_buys;
CREATE TABLE `w_buys` (
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
) ENGINE=MyISAM AUTO_INCREMENT=136 DEFAULT CHARSET=utf8;

INSERT INTO `w_buys` VALUES ('134', 'asfd', '<p>asfdasfd</p>', '1', '3', '2010-07-02 10:30:44', '2010-07-03 02:16:47', '/media/89/1278066642.gif', '16', '', '', '0', '89', '1');
INSERT INTO `w_buys` VALUES ('135', 'asfd', '<p>asfd</p>', '0', '6', '2010-07-02 10:31:30', '2010-07-03 02:16:42', '', '17', '', '', '0', '89', '1');
drop table if exists w_category;
CREATE TABLE `w_category` (
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `w_category` VALUES ('1', '电磁炉', 'diancilu', '1', '', '0.00', '1', '2', '0', '', '1', '', '', '');
INSERT INTO `w_category` VALUES ('2', '电饭煲 ', 'dianfan', '1', '', '0.00', '3', '4', '0', '', '1', '', '', '');
INSERT INTO `w_category` VALUES ('3', '电风扇', 'dianfengshan', '1', '', '0.00', '5', '6', '0', '', '1', '', '', '');
INSERT INTO `w_category` VALUES ('4', '空调扇', 'kongdiaoshan', '1', '', '0.00', '7', '8', '0', '', '1', '', '', '');
INSERT INTO `w_category` VALUES ('5', '电水壶', 'dianshuihu', '1', '', '0.00', '9', '10', '0', '', '1', '', '', '');
INSERT INTO `w_category` VALUES ('6', '加湿器', 'jiashiqi', '1', '', '0.00', '11', '12', '0', '', '1', '', '', '');
INSERT INTO `w_category` VALUES ('7', '干衣机', 'ganyiji', '1', '', '0.00', '13', '14', '0', '', '1', '', '', '');
INSERT INTO `w_category` VALUES ('8', '电暖器', 'diannuanqi', '1', '', '0.00', '15', '16', '0', '', '1', '', '', '');
drop table if exists w_companies;
CREATE TABLE `w_companies` (
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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `w_companies` VALUES ('3', '天津金禾美轴承有限公司', 'asfd', '1', '经理', '372222777', '13556873697', '', '', '', '89', '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 座落于现代进口轴承销售中心-天津的金禾美轴承有限公司,凭借着优越的地理位置,以及成型的销售理念,已经迅速的成长为中国北方进口轴承屈指可数真正可以 信赖的经销商.金禾美秉承了SKF，INA，FAG等国外经典轴承厂家严谨的作风，把为客户提供经典进口轴承放在了公司的首位。  多年来已与瑞典SKF轴承、德国FAG轴承、INA轴承，日本NSK轴承、NTN轴承、 KOYO轴承、THK轴承，  美国TIMKEN轴承等多家公司建立了良好的合作关系.</p>', '/media/89/1278054224.jpg', 'testtest', '0', '', '', '', '0', '0', '0', '0', '0', '', '0', '0', '', '', '2010-07-03 00:00:00', '', '');
INSERT INTO `w_companies` VALUES ('12', '', '', '1', '', '0755-2780 888', '', '', 'www.greeonline.com ', '', '1', '', '', '', '0', '', '', '', '0', '0', '0', '0', '0', '', '0', '0', '', '', '0000-00-00 00:00:00', '格力在线', '');
drop table if exists w_components;
CREATE TABLE `w_components` (
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
) ENGINE=MyISAM AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;

INSERT INTO `w_components` VALUES ('20', '文章', 'com=contents', '0', '0', '', 'contents', '0', '1', 'show_noauth=1\nshow_title=1\nlink_titles=1\nshow_intro=1\nshow_section=0\nlink_section=1\nshow_category=0\nlink_category=1\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=1\nshow_readmore=1\nshow_vote=1\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\nfeed_summary=1\nfilter_tags=\nfilter_attritbutes=\n\n', '1', '1', '1', '0');
INSERT INTO `w_components` VALUES ('140', '会员组件', 'com=users', '0', '0', 'com=users', 'users', '0', '0', '', '1', '2', '0', '0');
INSERT INTO `w_components` VALUES ('137', '产品', 'com=products', '0', '0', 'com=products', 'products', '0', '0', 'a:3:{s:7:\"payment\";s:7703:\"<p>1、格力在线提供的网上支付方式<br />\r\n我们为您提供银行卡在线支付（工商银行、招商银行、建设银行、深圳发展银行、农业银行）、银联支付、财付通支付、快钱网上支付、快钱信用卡支付、支付宝支付、由首信支付平台支持的国外信用卡支付网上支付方式。 银行卡在线支付所支持的卡种有：</p>\r\n<table style=\\\"font: 12px/22px 宋体; border-collapse: collapse; text-align: center\\\" cellspacing=\\\"0\\\" cellpadding=\\\"5\\\" width=\\\"50%\\\" border=\\\"1\\\">\r\n    <tbody>\r\n        <tr>\r\n            <td><span class=\\\"Apple-style-span\\\" style=\\\"font-weight: bold; font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\\">银行名称</span></td>\r\n            <td><span class=\\\"Apple-style-span\\\" style=\\\"font-weight: bold; font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\\">支持网上支付的银行卡名称</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\\\"\\\" src=\\\"/media/1/products/button_jdx081126_12.jpg\\\" /></td>\r\n            <td><span class=\\\"Apple-style-span\\\" style=\\\"font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\\">一卡通、信用卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\\\"\\\" src=\\\"/media/1/products/button_jdx081126_9.jpg\\\" /></td>\r\n            <td><span class=\\\"Apple-style-span\\\" style=\\\"font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\\">借记卡、信用卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\\\"\\\" src=\\\"/media/1/products/button_jdx081126_10.jpg\\\" /></td>\r\n            <td><span class=\\\"Apple-style-span\\\" style=\\\"font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\\">龙卡储蓄卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\\\"\\\" src=\\\"/media/1/products/button_jdx081126_11.jpg\\\" /></td>\r\n            <td><span class=\\\"Apple-style-span\\\" style=\\\"font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\\">借记卡、信用卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\\\"\\\" src=\\\"/media/1/products/weibiaoti-1.gif\\\" /></td>\r\n            <td><span class=\\\"Apple-style-span\\\" style=\\\"font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\\">借记卡、准贷记卡</span></td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p><br />\r\n网上支付平台所支持的银行卡种有：</p>\r\n<table style=\\\"font: 12px/22px 宋体; border-collapse: collapse; text-align: center\\\" cellspacing=\\\"0\\\" cellpadding=\\\"5\\\" width=\\\"50%\\\" border=\\\"1\\\">\r\n    <tbody>\r\n        <tr>\r\n            <td><font class=\\\"Apple-style-span\\\" face=\\\"Simsun\\\" color=\\\"#404040\\\"><span class=\\\"Apple-style-span\\\" style=\\\"font-size: 12px; border-collapse: separate\\\"><b>支付平台名称</b></span></font></td>\r\n            <td><span class=\\\"Apple-style-span\\\" style=\\\"font-weight: bold; font-size: 12px; color: rgb(64,64,64); font-family: Simsun; border-collapse: separate\\\">支持网上支付的银行卡名称</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\\\"\\\" src=\\\"/media/1/products/yinlianbiaozhi.jpg\\\" /></td>\r\n            <td><font class=\\\"Apple-style-span\\\" face=\\\"Simsun\\\" color=\\\"#404040\\\"><span class=\\\"Apple-style-span\\\" style=\\\"font-size: 12px; border-collapse: separate\\\">银联支付</span></font></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\\\"\\\" src=\\\"/media/1/products/alipay.jpg\\\" /></td>\r\n            <td><font class=\\\"Apple-style-span\\\" face=\\\"Simsun\\\" color=\\\"#404040\\\"><span class=\\\"Apple-style-span\\\" style=\\\"font-size: 12px; border-collapse: separate\\\">支付宝支付</span></font></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\\\"\\\" src=\\\"/media/1/products/button_jdx081126_6.jpg\\\" /></td>\r\n            <td><font class=\\\"Apple-style-span\\\" face=\\\"Simsun\\\" color=\\\"#404040\\\"><span class=\\\"Apple-style-span\\\" style=\\\"font-size: 12px; border-collapse: separate\\\">快钱网上支付</span></font></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\\\"\\\" src=\\\"/media/1/products/cft_lxq090312.JPG\\\" /></td>\r\n            <td><font class=\\\"Apple-style-span\\\" face=\\\"Simsun\\\" color=\\\"#404040\\\"><span class=\\\"Apple-style-span\\\" style=\\\"font-size: 12px; border-collapse: separate\\\">财付通支付</span></font></td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<p>温馨提示：<br />\r\n1）目前使用快钱网上支付单笔支付金额最高可达到1万元（不同的银行的支付金额不同）<br />\r\n2）快钱网上大金额支付支持的银行有：工商银行、招商银行、建设银行、农业银行、广东发展银行、兴业银行<br />\r\n2、银行卡的开通手续</p>\r\n<p>因各地银行政策不同，建议您在网上支付前拨打所在地银行电话，咨询该行可供网上支付的银行卡种类及开通手续。</p>\r\n<table style=\\\"font: 12px/22px 宋体; border-collapse: collapse; text-align: center\\\" cellspacing=\\\"0\\\" cellpadding=\\\"5\\\" width=\\\"100%\\\" border=\\\"1\\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>银行名称</td>\r\n            <td>服务热线</td>\r\n            <td>银行名称</td>\r\n            <td>服务热线</td>\r\n            <td>银行名称</td>\r\n            <td>服务热线</td>\r\n        </tr>\r\n        <tr>\r\n            <td>招商银行</td>\r\n            <td>95555</td>\r\n            <td>中国银行</td>\r\n            <td>95566</td>\r\n            <td>交通银行</td>\r\n            <td>95559</td>\r\n        </tr>\r\n        <tr>\r\n            <td>中国工商银行</td>\r\n            <td>95588</td>\r\n            <td>北京银行</td>\r\n            <td>96169</td>\r\n            <td>光大银行</td>\r\n            <td>95595</td>\r\n        </tr>\r\n        <tr>\r\n            <td>中国建设银行</td>\r\n            <td>95533</td>\r\n            <td>中国农业银行</td>\r\n            <td>95599</td>\r\n            <td>深圳发展银行</td>\r\n            <td>95501</td>\r\n        </tr>\r\n        <tr>\r\n            <td>上海浦东发展银行</td>\r\n            <td>95528</td>\r\n            <td>广东发展银行</td>\r\n            <td>95508</td>\r\n            <td>中国邮政</td>\r\n            <td>11185</td>\r\n        </tr>\r\n        <tr>\r\n            <td>民生银行</td>\r\n            <td>95568</td>\r\n            <td>华夏银行</td>\r\n            <td>95577</td>\r\n            <td>中信银行</td>\r\n            <td>86668888</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p>3、支付金额上限<br />\r\n目前各银行对于网上支付均有一定金额的限制，由于各银行政策不同，建议您在申请网上支付功能时向银行咨询相关事宜。</p>\r\n<p>4、怎样判断网上支付是否成功？<br />\r\n1)当您完成网上在线支付过程后，系统应提示支付成功；如果系统没有提示支付失败或成功，您可通过电话、ATM 、柜台或登录网上银行等各种方式查询银行卡余额，如果款项已被扣除，说明您已支付成功。<br />\r\n2)如果出现信用卡超额透支、存折余额不足、意外断线等导致支付不成功，请您登录格力在线&quot;我的帐户&quot;，找到该张未支付成功的订单，重新完成支付。</p>\r\n<p>5、造成&quot;支付被拒绝&quot;的原因有哪些？<br />\r\n1）所持银行卡尚未开通网上在线支付功能；<br />\r\n2）所持银行卡已过期、作废、挂失；<br />\r\n3）所持银行卡内余额不足；<br />\r\n4）输入银行卡卡号或密码不符；<br />\r\n5）输入证件号不符；<br />\r\n6）银行系统数据传输出现异常；<br />\r\n7）网络中断。</p>\";s:12:\"distribution\";s:2811:\"<p><strong>1、格力空调免费送货上门，免费安装。</strong><br />\r\n凡在线购买格力空调用户，格力同城市专营店会直接免费送货上门，免费安装调试。</p>\r\n<p><strong>2、格力小家电快递送货</strong><br />\r\n格力小家电由格力省级代理商直接同省市快递配货方式或自行上门提货方式配送。<br />\r\n快递运货见具体产品详细页配送运货</p>\r\n<p><strong>3.自提</strong><br />\r\n支持全国30个城市用户上门自提，免收运费。查看自提信息。</p>\r\n<p>&nbsp;</p>\r\n<p><strong>如何正确选择加急配送服务</strong><br />\r\n北京、天津、上海、广州、深圳、廊坊6个城市地区的用户，并且为当地发货订单，用户可在结算中心&ldquo;送货方式&rdquo;部分选择加急快递送货上门服务。</p>\r\n<p><strong>常见问题解答：<br />\r\n</strong><br />\r\n1. 我的订单什么时候可以送到？<br />\r\n具体配送时间根据不同城市略有不同，请查看配送范围、时间及运费<br />\r\n<br />\r\n2. &quot;加急快递送货上门&quot;的费收取标准？<br />\r\n北京、天津、上海、广州、深圳、廊坊6个城市的&ldquo;加急快递送货上门&rdquo;配送费为10元/单。</p>\r\n<p>&nbsp;</p>\r\n<p><strong>快递送货上门的订单 </strong><br />\r\n1、签收时仔细核对：商品及配件、商品数量、格力在线的发货清单、发票（如有）、三包凭证（如有）等 <br />\r\n2、若存在包装破损、商品错误、商品少发、商品有表面质量问题等影响签收的因素，请您一定要当面向送货员说明情况并当场整单退货</p>\r\n<p><strong>邮局邮寄的订单 </strong><br />\r\n1、请您一定要小心开包，以免尖锐物件损伤到包裹内的商品 <br />\r\n2、签收时仔细核对：商品及配件、商品数量、格力在线的发货清单、发票（如有）、三包凭证（如有）等 <br />\r\n3、若包装破损、商品错误、商品少发、商品存在表面质量问题等，您可以选择整单退货；或是求邮局开具相关证明后签收，然后登陆格力在线申请退货或申请换货</p>\r\n<p><strong>温馨提示 </strong><br />\r\n1、货到付款的订单送达时，请您当面与送货员核兑商品与款项，确保货款两清；若事后发现款项有误，格力在线将无法为您处理 <br />\r\n2、请收货时务必认真核对，若您或您的委托人已签收，则说明订单商品正确无误且不存在影响使用的因素，格力在线有权不受理因包装或商品破损、商品错漏发、商品表面质量问题、商品附带品及赠品少发为由的退换货申请 <br />\r\n3、部分商品由商店街的商家提供,这部分商品的验货验收不在格力在线承诺的范围内</p>\r\n<p>&nbsp;</p>\";s:7:\"service\";s:4532:\"<p>&nbsp;</p>\r\n<p><strong>服务宗旨：用户满意！<br />\r\n服务理念：用户的每一件小事，都是格力的大事</strong></p>\r\n<p><strong>（一）产品三包政策</strong><br />\r\n<br />\r\n<strong>1.包修政策</strong><br />\r\n2010年度家用空调（制冷量小于或等于14000W）、除湿机包修政策为整机包修六年。<br />\r\n2005年1月1日至2009年12月31日所购买的家用空调器整机包修六年。<br />\r\n2005年1月1日之前所购买的家用空调器的包修政策：按其当年的包修规定执行。</p>\r\n<p>以下情况之一的不属于包修范围，将按有关规定实行收费维修： <br />\r\n1.1消费者因使用、维护、保管不当造成损坏的；<br />\r\n1.2非格力电器指定的特约服务网点所安装、维修造成损坏的（包括消费者自行安装或拆动维修的）；<br />\r\n1.3无包修凭证及有效发票或有效购买凭证的；<br />\r\n1.4有效凭证、包修凭证不符或涂改的；<br />\r\n1.5因不可抗拒的自然灾害或使用环境恶劣造成损坏的；<br />\r\n1.6处理品、已超过包修期的产品。</p>\r\n<p><strong>2.包换政策 </strong><br />\r\n按国家规定的三包期限，在包修期内，符合下列条件，而且用户拒绝维修时，可以换机。 <br />\r\n2.1产品自售出之日起15日内，发生主要性能故障，不能正常工作的，可以换机； <br />\r\n2.2按国家规定的三包期限，在包修期内，主要性能故障连续维修二次，不能正常工作的，可以换机，并按国家三包规定，重新起算包修期限（仅限更换部分）。</p>\r\n<p><strong>3、包退政策 </strong><br />\r\n按国家规定的三包期限，符合下列条件，而且用户拒绝维修或换机时，可以退机。<br />\r\n3.1产品自售出之日起10日内，发生主要性能故障，如压缩机故障、换热器内漏等,可以退机。 <br />\r\n3.2自售出之日起一年以内，连续二次以上仍无法修好（指主要性能）用户坚持退机的。</p>\r\n<p><strong>（二）免费安装政策</strong></p>\r\n<p><strong>1. 免费安装范围 </strong><br />\r\n格力电器家用空调，包括分体式、立柜式、吊顶式、天井式空调均实行免费安装。免费安装费用由特约服务网点按《安装费结算管理制度》要求向格力电器结算，不得向用户收取，但下列情况可与用户协商好后额外收费： <br />\r\n1.1 需加长连接管； <br />\r\n1.2 使用吊车、吊绳安装的；超过四楼在墙外进行施工（在阳台施工不另行收费）； <br />\r\n1.3 在厚度超过120mm 的钢筋水泥墙上钻洞和超过1个以上的墙洞； <br />\r\n1.4 拆除防盗网才能安装的；搬拆移位重安装的； <br />\r\n1.5 安装铁架等所有材料费。</p>\r\n<p><strong>2.下列情况实行收费安装：</strong> <br />\r\n2.1 安装窗式空调器； <br />\r\n2.2 移动空调钻排气口洞； <br />\r\n2.3 无有效发票或有效购买凭证，又无免费安装凭证、无条形码的。</p>\r\n<p>注：对被抽取安装结算条形码的情况，若空调上有条形码的可以免费安装，并记录条形码。如机器上的条形码也被撕去的情况，则不能实行免费安装。由用户向购买商店协商，协商未果的应及时向销售公司申报情况。</p>\r\n<p><strong>退货说明：</strong><br />\r\n格力在线承诺自顾客收到商品之日起7日内（以发票日期为准，如无发票以格力在线发货清单的日期为准），如符合以下条件，我们将提供全款退货的服务。<br />\r\n&nbsp;</p>\r\n<p>1、商品及商品本身的外包装没有损坏，保持格力在线出售时的原质原样；<br />\r\n2、注明退货原因，如果商品存在质量问题，请务必说明；<br />\r\n3、确保商品及配件、附带品或者赠品、保修卡、三包凭证、发票、格力在线发货清单齐全；<br />\r\n4、如果成套商品中有部分商品存在质量问题，在办理退货时，必须提供成套商品；</p>\r\n<p><strong>以下情况不予办理退货：<br />\r\n</strong><br />\r\n1、任何非由格力在线出售的商品；<br />\r\n2、任何已使用过的商品，但有质量问题除外；<br />\r\n3、任何因非正常使用及保管导致出现质量问题的商品。</p>\r\n<p>商品如出现质量问题，请先行按照说明书上的联系方式与厂家的售后部门联系，如果确认属于质量问题，持厂家出具质量问题检测报告与当当客服中心联系办理退货事宜。</p>\";}', '1', '1', '1', '1');
INSERT INTO `w_components` VALUES ('138', '单页信息', 'com=pages', '0', '0', 'com=pages', 'pages', '0', '0', '', '1', '1', '0', '0');
INSERT INTO `w_components` VALUES ('141', '留言板', 'com=feedbacks', '0', '0', 'com=feedbacks', 'feedbacks', '0', '0', '', '1', '1', '0', '0');
INSERT INTO `w_components` VALUES ('142', '团购信息', 'com=tuans', '0', '0', 'com=tuans', 'tuans', '0', '0', '', '1', '0', '1', '0');
drop table if exists w_configs;
CREATE TABLE `w_configs` (
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
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

INSERT INTO `w_configs` VALUES ('32', '格力在线', '', '0', '', '格力在线关键字', '格力在线网站描述', 'default', '1', '/media/1/logo.jpg', '', '1', '2', 'a:10:{s:10:\"dateformat\";s:11:\"Y-m-d H:i:s\";s:14:\"currencyformat\";s:8:\"￥%s元\";s:10:\"thumbwidth\";s:3:\"180\";s:11:\"thumbheight\";s:3:\"180\";s:8:\"imgwidth\";s:3:\"350\";s:9:\"imgheight\";s:3:\"350\";s:7:\"deposit\";s:3:\"100\";s:11:\"integralway\";s:1:\"2\";s:12:\"integralrate\";s:0:\"\";s:5:\"cache\";s:1:\"0\";}');
drop table if exists w_configs_option;
CREATE TABLE `w_configs_option` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(60) NOT NULL,
  `com_name` varchar(20) default NULL,
  `spec_type` tinyint(1) NOT NULL default '0' COMMENT '显示类型',
  `spec_show_type` tinyint(1) NOT NULL default '0' COMMENT '显示方式',
  `published` tinyint(1) unsigned NOT NULL default '1',
  `attr_group` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `w_configs_option` VALUES ('1', '商品设置', '', '1', '1', '1', 'a:5:{s:9:\"opt_field\";a:7:{i:0;s:10:\"dateformat\";i:1;s:14:\"currencyformat\";i:2;s:10:\"thumbwidth\";i:3;s:11:\"thumbheight\";i:4;s:8:\"imgwidth\";i:5;s:9:\"imgheight\";i:6;s:7:\"deposit\";}s:8:\"opt_name\";a:7:{i:0;s:12:\"时间格式\";i:1;s:12:\"货币格式\";i:2;s:15:\"缩略图宽度\";i:3;s:15:\"缩略图高度\";i:4;s:18:\"商品图片宽度\";i:5;s:18:\"商品图片高度\";i:6;s:15:\"产品预付款\";}s:7:\"opt_way\";a:7:{i:0;s:1:\"0\";i:1;s:1:\"0\";i:2;s:1:\"0\";i:3;s:1:\"0\";i:4;s:1:\"0\";i:5;s:1:\"0\";i:6;s:1:\"0\";}s:9:\"opt_value\";a:7:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";i:4;s:0:\"\";i:5;s:0:\"\";i:6;s:0:\"\";}s:10:\"opt_remark\";a:7:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:111:\" 如果您的服务器支持GD，在您上传商品图片的时候将自动将图片缩小到指定的尺寸。\";i:4;s:0:\"\";i:5;s:0:\"\";i:6;s:31:\" 客户可以选择预付定金\";}}');
INSERT INTO `w_configs_option` VALUES ('2', '产品配送/支付/售后说明', 'products', '0', '0', '1', 'a:5:{s:9:\"opt_field\";a:3:{i:0;s:7:\"payment\";i:1;s:12:\"distribution\";i:2;s:7:\"service\";}s:8:\"opt_name\";a:3:{i:0;s:18:\"支付方式说明\";i:1;s:12:\"配送说明\";i:2;s:12:\"售后服务\";}s:7:\"opt_way\";a:3:{i:0;s:1:\"5\";i:1;s:1:\"5\";i:2;s:1:\"5\";}s:9:\"opt_value\";a:3:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";}s:10:\"opt_remark\";a:3:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";}}');
INSERT INTO `w_configs_option` VALUES ('3', '积分设置', '', '0', '0', '1', 'a:5:{s:9:\"opt_field\";a:2:{i:0;s:11:\"integralway\";i:1;s:12:\"integralrate\";}s:8:\"opt_name\";a:2:{i:0;s:18:\"积分计算方式\";i:1;s:18:\"积分换算比率\";}s:7:\"opt_way\";a:2:{i:0;s:1:\"1\";i:1;s:1:\"0\";}s:9:\"opt_value\";a:2:{i:0;s:87:\"0:不使用积分,1:按订单商品总价格计算积分 ,2:为商品单独设置积分\";i:1;s:0:\"\";}s:10:\"opt_remark\";a:2:{i:0;s:0:\"\";i:1;s:95:\"使用订单积分时有效<br/>订单所得积分 = 订单商品总价格 X 积分换算比率\";}}');
INSERT INTO `w_configs_option` VALUES ('4', '商品显示设置', '', '1', '1', '0', '');
INSERT INTO `w_configs_option` VALUES ('5', '缓存设置', '', '0', '0', '1', 'a:5:{s:9:\"opt_field\";a:1:{i:0;s:5:\"cache\";}s:8:\"opt_name\";a:1:{i:0;s:24:\"是否开启模块缓存\";}s:7:\"opt_way\";a:1:{i:0;s:1:\"1\";}s:9:\"opt_value\";a:1:{i:0;s:11:\"0:否,1:是\";}s:10:\"opt_remark\";a:1:{i:0;s:0:\"\";}}');
drop table if exists w_contents;
CREATE TABLE `w_contents` (
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
) ENGINE=MyISAM AUTO_INCREMENT=211 DEFAULT CHARSET=utf8;

INSERT INTO `w_contents` VALUES ('185', '发票制度', '', '', '', '<p>　　在格力在线购物时均开具正规机打发票。发票是用户用于商品的保修、退换货的凭证，请妥善保存。请在订单提交之前确认好发票抬头，订单生成后发票抬头将无法修改。</p>\r\n<p><strong>格力在线发票注意事项</strong><br />\r\n<br />\r\n<strong>一、个人购买：</strong><br />\r\n1、个人开具普通发票，如您购买商品需要填写公司名称，请您在下订单时填好备注，把公司的&ldquo;完整名称&rdquo;填写好。</p>\r\n<p><strong>二、公司购买：</strong><br />\r\n<br />\r\n（一）公司需开具增值税发票<br />\r\n1.公司需开具增值税发票，在格力在线购买商品下订单时勾选增值税发票，并且填写增值税发票相关信息；<br />\r\n2.填写订单信息时选择增值税发票，完成付款并收货15天内，寄送以下相关证件至格力在线换取增值税专用发票，我们将在您的订单付款成功并收到相关证件后，原则上3到5个工作日内开具增值税发票并邮寄至贵单位，如遇到特殊情况顺延，最终解释权为格力在线所有。<br />\r\n<br />\r\n公司开增值税发票相关证件：<br />\r\n（1）增值税专用发票领取通知单原件。<br />\r\n（2）税务登记证副本复印件并加盖公章。<br />\r\n寄送地址：广东省深圳市南山区创新科技园留学生创业大厦应收账款部。<br />\r\n电话：0755-84418888-885062或885155<br />\r\n联系人：应收账款部销售开票组<br />\r\n<br />\r\n3.客户如选择换开增值税发票，所开货物名称只能为实际购买货物明细，不得随意更改其他开票项目。<br />\r\n<br />\r\n4.您在寄换开增票的相关资料到格力在线深圳服务中心应收账款部的时候，产生的相关邮寄费用由您自行承担，如果您选择&ldquo;到付&rdquo;我司将拒签此快件，因此原因造成换票时间延误，由您自行承担责任。<br />\r\n<br />\r\n5.您在网上商城购买商品时请详细正确填写寄送地址与联系方式，如因未填写或填写错误造成无法寄送或寄送错误，由您自行承担。</p>\r\n<p><strong>（二）公司需开具增值税发票并参加以旧换新活动</strong><br />\r\n<br />\r\n1、省内公司参加以旧换新开增值税发票<br />\r\n<br />\r\n（1）省内公司开增值税发票，开具的前提条件是企业单位而非个人，填写订单信息时选择参加以旧换新、普通发票（发票抬头必须填写公司名称）；<br />\r\n（2）凭普通发票在收货城市门店领取以旧换新补贴，并在普通发票开具日期起一个月之内，寄送以下证件至格力在线换取增值税专用发票。我们将在您的订单付款成功并收到相关证件后，原则上3到5个工作日内开具增值税发票并邮寄至贵单位，如遇到特殊情况顺延，最终解释权为格力在线所有。</p>\r\n<p><strong>广东省内增值税发票开具相关证件：<br />\r\n</strong><br />\r\n1）格力在线普通发票原件。要求普通发票上的单位名称须与换开税票单位名称一致。<br />\r\n2）税务登记证副本复印件并加盖公章。<br />\r\n3）单位出具购买商品自用证明并加盖公章。<br />\r\n4）在格力在网站下载并填写开票信息单内容。</p>\r\n<p><strong>开票信息单</strong><br />\r\n按照下表格式，填写开票信息单后打印。</p>\r\n<table width=\"90%\" border=\"1\" cellpadding=\"10\" cellspacing=\"0\" style=\"border-collapse:collapse; font:normal 12px/20px \'宋体\';\">\r\n    <tbody>\r\n        <tr>\r\n            <td colspan=\"2\">开 票 信 息 单</td>\r\n        </tr>\r\n        <tr>\r\n            <td>单位名称：</td>\r\n            <td>纳税人识别号：</td>\r\n        </tr>\r\n        <tr>\r\n            <td>开户银行：</td>\r\n            <td>银行帐号：</td>\r\n        </tr>\r\n        <tr>\r\n            <td>单位地址:</td>\r\n            <td>联系电话：</td>\r\n        </tr>\r\n        <tr>\r\n            <td>邮寄地址：</td>\r\n            <td>经办人姓名：</td>\r\n        </tr>\r\n        <tr>\r\n            <td>身份证号码：</td>\r\n            <td>SAP订单号：</td>\r\n        </tr>\r\n        <tr>\r\n            <td>购货日期：</td>\r\n            <td>普通发票号码：</td>\r\n        </tr>\r\n        <tr>\r\n            <td>发票金额：</td>\r\n            <td>付款方式：      1、现金     2、网银    3、支票      4、其他:</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p>&nbsp;</p>', '1', '0', '0', '380', '2010-12-03 03:24:55', '2011-02-21 11:24:23', '', '', '', '', '1', '0', '4', '格力在线 发票制度 以旧换新', '格力在线购物发票制度说明', '0', '30', '', '1');
INSERT INTO `w_contents` VALUES ('186', '网站订购流程', '', '', '', '<p><img alt=\"\" src=\"/media/1/products/gt.gif\" /></p>\r\n<p>1、搜索商品<br />\r\n格力在线为您提供了方便快捷的商品搜索功能：<br />\r\n（1）您可以通过在首页输入关键字的方法来搜索您想要购买的商品<br />\r\n（2）您还可以通过当当的分类导航栏来找到您想要购买的商品分类，根据分类找到您的商品<br />\r\n（3）观看 搜索商品 演示</p>\r\n<p>2、放入购物车               <br />\r\n在您想要购买的商品的详情页点击&ldquo;购买&rdquo;，商品会添加到您的购物车中；您还可以继续挑选商品放入购物车，一起结算。<br />\r\n（1）在购物车中，系统默认每件商品的订购数量为一件，如果您想购买多件商品，可修改购买数量<br />\r\n（2）在购物车中，您可以将商品 移至收藏 ，或是选择删除<br />\r\n（3）在购物车中，您可以直接查看到商品的优惠折和参加促销活动的商品名称、促销主题<br />\r\n（4）购物车页面下方的商品是格力在线根据您挑选的商品为您作出的推荐，若有您喜爱的商品，点击&ldquo;放入购物车&rdquo;即可<br />\r\n<br />\r\n温馨提示：<br />\r\n（1）商品价格会不定期调整，最终价格以您提交订单后订单中的价格为准<br />\r\n（2）优惠政策、配送时间、运费收取标准等都有可能进行调整，最终成交信息以您提交订单时网站公布的最新信息为准</p>\r\n<p>3、选择订单                       <br />\r\n（1）格力在线和 商家 的商品需要分别提交订单订购<br />\r\n（2）不同 商家 的商品需要分别提交订单订购</p>\r\n<p>4、注册登陆<br />\r\n（1）老顾客：请在&ldquo;登陆 &rdquo;页面输入Email地址或昵称、注册密码进行登陆<br />\r\n（2）新顾客：请在&ldquo;新用户注册 &rdquo;页面按照提示完成注册</p>\r\n<p>5、填写收货人信息                                                <br />\r\n（1）请填写正确完整的收货人姓名、收货人联系方式、详细的收货地址和邮编，否则将会影响您订单的处理或配送<br />\r\n（2）您可以进入&ldquo;我的当当&mdash;帐户管理&mdash;收货地址簿&rdquo;编辑常用收货地址，保存成功后，再订购时，可以直接选择使用</p>\r\n<p>6、选择收货方式<br />\r\n格力在线提供多种收货方式：<br />\r\n（1）普通快递送货上门<br />\r\n（2）加急快递送货上门<br />\r\n（3）普通邮递<br />\r\n（4）邮政特快专递(EMS)</p>\r\n<p>7、选择支付方式                        <br />\r\n格力在线提供多种支付方式，订购过程中您可以选择：<br />\r\n（1）货到付款<br />\r\n（2）网上支付<br />\r\n（3）银行转帐<br />\r\n（4）邮局汇款</p>\r\n<p>8、索取发票            <br />\r\n请点击&ldquo;索取发票&rdquo;，填写正确的发票抬头、选择正确的发票内容，发票选择成功后，将于订单货物一起送达<br />\r\n<a href=\"xinshouzhinan/185.html\">       点击查看 发票制度         </a></p>\r\n<p>9、提交订单<br />\r\n（1）以上信息核实无误后，请点击&ldquo;提交订单&rdquo;，系统生成一个订单号，就说明您已经成功提交订单<br />\r\n（2）订单提交成功后，您可以登陆&ldquo;我的当当 &rdquo;查看订单信息或为订单进行 网上支付</p>\r\n<p>&nbsp;</p>\r\n<p>特别提示         <br />\r\n1、若您帐户中有礼品卡，可以在&ldquo;支付方式&rdquo;处选择使用礼品卡支付，详情请点击查看 当当礼品卡<br />\r\n2、若您帐户中有符合支付该订单的礼券，在结算页面会有&ldquo;使用礼券&rdquo;按钮，您点击选择礼券即可，点击查看 礼券使用规则       当您选择了礼券并点击&ldquo;确定使用&rdquo;后，便无法再取消使用该礼券<br />\r\n3、在订单提交高峰时段，新订单可能一段时间之后才会在&ldquo;我的当当&rdquo;中显示。如果您在&ldquo;我的当当&rdquo;中暂未找到这张订单，请您耐心等待</p>', '1', '0', '0', '380', '2010-12-03 03:25:04', '2011-02-21 11:41:00', '', '', '', '', '1', '0', '3', '', '', '0', '50', '', '1');
INSERT INTO `w_contents` VALUES ('187', '注册新用户', '', '', '', '<p>欢迎注册格力在线！<br />\r\n请点击 <a href=\"/index.php?com=users&amp;layout=registor\">新用户注册</a> ，按照流程提示操作即可！</p>\r\n<p>注册步骤详解如下：<br />\r\n1、进入格力在线首页，点击左上角的&ldquo;免费注册&rdquo;<br />\r\n<br />\r\n<img alt=\"\" src=\"/media/1/products/top.gif\" /></p>\r\n<p>2、按照网页提示，填写准确的注册信息后点击&ldquo;提交注册&rdquo; <br />\r\n<img alt=\"\" src=\"/media/1/products/registor.gif\" /></p>\r\n<p>&nbsp;</p>\r\n<p>温馨提示：<br />\r\n（1）请务必填写正确有效的注册邮箱地址，否则当您忘记注册密码时，无法成功找回，只能重新注册新用户<br />\r\n（2）注册成功后，您可以 修改EMAIL地址、修改昵称、修改密码</p>', '1', '0', '0', '380', '2010-12-03 03:25:12', '2011-02-21 12:02:44', '', '', '', '', '1', '0', '2', '', '', '0', '22', '', '1');
INSERT INTO `w_contents` VALUES ('188', '验货和签收', '', '', '', '<p><strong>快递送货上门的订单 </strong><br />\r\n1、签收时仔细核对：商品及配件、商品数量、格力在线的发货清单、发票（如有）、三包凭证（如有）等  <br />\r\n2、若存在包装破损、商品错误、商品少发、商品有表面质量问题等影响签收的因素，请您一定要当面向送货员说明情况并当场整单退货</p>\r\n<p><strong>邮局邮寄的订单 </strong><br />\r\n1、请您一定要小心开包，以免尖锐物件损伤到包裹内的商品 <br />\r\n2、签收时仔细核对：商品及配件、商品数量、格力在线的发货清单、发票（如有）、三包凭证（如有）等  <br />\r\n3、若包装破损、商品错误、商品少发、商品存在表面质量问题等，您可以选择整单退货；或是求邮局开具相关证明后签收，然后登陆格力在线申请退货或申请换货</p>\r\n<p><strong>温馨提示 </strong> <br />\r\n1、货到付款的订单送达时，请您当面与送货员核兑商品与款项，确保货款两清；若事后发现款项有误，格力在线将无法为您处理 <br />\r\n2、请收货时务必认真核对，若您或您的委托人已签收，则说明订单商品正确无误且不存在影响使用的因素，格力在线有权不受理因包装或商品破损、商品错漏发、商品表面质量问题、商品附带品及赠品少发为由的退换货申请 <br />\r\n3、部分商品由商店街的商家提供,这部分商品的验货验收不在格力在线承诺的范围内</p>', '1', '0', '0', '381', '2010-12-03 03:25:36', '2011-02-21 14:09:38', '', '', '', '', '1', '0', '5', '', '', '0', '22', '', '1');
INSERT INTO `w_contents` VALUES ('189', '配送方式及运费', '', '', '', '<p><strong>1、格力空调免费送货上门，免费安装。</strong><br />\r\n凡在线购买格力空调用户，格力同城市专营店会直接免费送货上门，免费安装调试。</p>\r\n<p><strong>2、格力小家电快递送货</strong><br />\r\n格力小家电由格力省级代理商直接同省市快递配货方式或自行上门提货方式配送。<br />\r\n快递运货见具体产品详细页配送运货</p>\r\n<p><strong>3.自提</strong><br />\r\n支持全国30个城市用户上门自提，免收运费。查看自提信息。</p>', '1', '0', '0', '381', '2010-12-03 03:25:45', '2011-02-21 14:22:27', '', '', '', '', '1', '0', '6', '', '', '0', '6', '', '1');
INSERT INTO `w_contents` VALUES ('190', '网上支付', '', '', '', '<p>1、格力在线提供的网上支付方式<br />\r\n我们为您提供银行卡在线支付（工商银行、招商银行、建设银行、深圳发展银行、农业银行）、银联支付、财付通支付、快钱网上支付、快钱信用卡支付、支付宝支付、由首信支付平台支持的国外信用卡支付网上支付方式。 银行卡在线支付所支持的卡种有：</p>\r\n<table width=\"50%\" cellpadding=\"5\" cellspacing=\"0\" border=\"1\" style=\"border-collapse:collapse; text-align:center; font:normal 12px/22px 宋体;\">\r\n    <tbody>\r\n        <tr>\r\n            <td><span class=\"Apple-style-span\" style=\"color: rgb(64, 64, 64); font-size: 12px; font-weight: bold; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; \">银行名称</span></td>\r\n            <td><span class=\"Apple-style-span\" style=\"color: rgb(64, 64, 64); font-size: 12px; font-weight: bold; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; \">支持网上支付的银行卡名称</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\"\" src=\"/media/1/products/button_jdx081126_12.jpg\" /></td>\r\n            <td><span class=\"Apple-style-span\" style=\"color: rgb(64, 64, 64); font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; \">一卡通、信用卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\"\" src=\"/media/1/products/button_jdx081126_9.jpg\" /></td>\r\n            <td><span class=\"Apple-style-span\" style=\"color: rgb(64, 64, 64); font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; \">借记卡、信用卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\"\" src=\"/media/1/products/button_jdx081126_10.jpg\" /></td>\r\n            <td><span class=\"Apple-style-span\" style=\"color: rgb(64, 64, 64); font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; \">龙卡储蓄卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\"\" src=\"/media/1/products/button_jdx081126_11.jpg\" /></td>\r\n            <td><span class=\"Apple-style-span\" style=\"color: rgb(64, 64, 64); font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; \">借记卡、信用卡</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\"\" src=\"/media/1/products/weibiaoti-1.gif\" /></td>\r\n            <td><span class=\"Apple-style-span\" style=\"color: rgb(64, 64, 64); font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; \">借记卡、准贷记卡</span></td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p><br />\r\n网上支付平台所支持的银行卡种有：</p>\r\n<table width=\"50%\" cellpadding=\"5\" cellspacing=\"0\" border=\"1\" style=\"border-collapse:collapse; text-align:center;  font:normal 12px/22px 宋体;\">\r\n    <tbody>\r\n        <tr>\r\n            <td><font class=\"Apple-style-span\" color=\"#404040\" face=\"Simsun\"><span class=\"Apple-style-span\" style=\"border-collapse: separate; font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px;\"><b>支付平台名称</b></span></font></td>\r\n            <td><span class=\"Apple-style-span\" style=\"color: rgb(64, 64, 64); font-size: 12px; font-weight: bold; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; border-collapse: separate; font-family: Simsun; \">支持网上支付的银行卡名称</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\"\" src=\"/media/1/products/yinlianbiaozhi.jpg\" /></td>\r\n            <td><font class=\"Apple-style-span\" color=\"#404040\" face=\"Simsun\"><span class=\"Apple-style-span\" style=\"border-collapse: separate; font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px;\">银联支付</span></font></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\"\" src=\"/media/1/products/alipay.jpg\" /></td>\r\n            <td><font class=\"Apple-style-span\" color=\"#404040\" face=\"Simsun\"><span class=\"Apple-style-span\" style=\"border-collapse: separate; font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px;\">支付宝支付</span></font></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\"\" src=\"/media/1/products/button_jdx081126_6.jpg\" /></td>\r\n            <td><font class=\"Apple-style-span\" color=\"#404040\" face=\"Simsun\"><span class=\"Apple-style-span\" style=\"border-collapse: separate; font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px;\">快钱网上支付</span></font></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\"\" src=\"/media/1/products/cft_lxq090312.JPG\" /></td>\r\n            <td><font class=\"Apple-style-span\" color=\"#404040\" face=\"Simsun\"><span class=\"Apple-style-span\" style=\"border-collapse: separate; font-size: 12px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px;\">财付通支付</span></font></td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<p>温馨提示：<br />\r\n1）目前使用快钱网上支付单笔支付金额最高可达到1万元（不同的银行的支付金额不同）<br />\r\n2）快钱网上大金额支付支持的银行有：工商银行、招商银行、建设银行、农业银行、广东发展银行、兴业银行<br />\r\n2、银行卡的开通手续</p>\r\n<p>因各地银行政策不同，建议您在网上支付前拨打所在地银行电话，咨询该行可供网上支付的银行卡种类及开通手续。</p>\r\n<table width=\"100%\" cellpadding=\"5\" cellspacing=\"0\" border=\"1\" style=\"border-collapse:collapse; text-align:center;  font:normal 12px/22px 宋体;\">\r\n    <tbody>\r\n        <tr>\r\n            <td>银行名称</td>\r\n            <td>服务热线</td>\r\n            <td>银行名称</td>\r\n            <td>服务热线</td>\r\n            <td>银行名称</td>\r\n            <td>服务热线</td>\r\n        </tr>\r\n        <tr>\r\n            <td>招商银行</td>\r\n            <td>95555</td>\r\n            <td>中国银行</td>\r\n            <td>95566</td>\r\n            <td>交通银行</td>\r\n            <td>95559</td>\r\n        </tr>\r\n        <tr>\r\n            <td>中国工商银行</td>\r\n            <td>95588</td>\r\n            <td>北京银行</td>\r\n            <td>96169</td>\r\n            <td>光大银行</td>\r\n            <td>95595</td>\r\n        </tr>\r\n        <tr>\r\n            <td>中国建设银行</td>\r\n            <td>95533</td>\r\n            <td>中国农业银行</td>\r\n            <td>95599</td>\r\n            <td>深圳发展银行</td>\r\n            <td>95501</td>\r\n        </tr>\r\n        <tr>\r\n            <td>上海浦东发展银行</td>\r\n            <td>95528</td>\r\n            <td>广东发展银行</td>\r\n            <td>95508</td>\r\n            <td>中国邮政</td>\r\n            <td>11185</td>\r\n        </tr>\r\n        <tr>\r\n            <td>民生银行</td>\r\n            <td>95568</td>\r\n            <td>华夏银行</td>\r\n            <td>95577</td>\r\n            <td>中信银行</td>\r\n            <td>86668888</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p>3、支付金额上限<br />\r\n目前各银行对于网上支付均有一定金额的限制，由于各银行政策不同，建议您在申请网上支付功能时向银行咨询相关事宜。</p>\r\n<p>4、怎样判断网上支付是否成功？<br />\r\n1)当您完成网上在线支付过程后，系统应提示支付成功；如果系统没有提示支付失败或成功，您可通过电话、ATM 、柜台或登录网上银行等各种方式查询银行卡余额，如果款项已被扣除，说明您已支付成功。<br />\r\n2)如果出现信用卡超额透支、存折余额不足、意外断线等导致支付不成功，请您登录格力在线&quot;我的帐户&quot;，找到该张未支付成功的订单，重新完成支付。</p>\r\n<p>5、造成&quot;支付被拒绝&quot;的原因有哪些？<br />\r\n1）所持银行卡尚未开通网上在线支付功能；<br />\r\n2）所持银行卡已过期、作废、挂失；<br />\r\n3）所持银行卡内余额不足；<br />\r\n4）输入银行卡卡号或密码不符；<br />\r\n5）输入证件号不符；<br />\r\n6）银行系统数据传输出现异常；<br />\r\n7）网络中断。</p>', '1', '0', '0', '382', '2010-12-03 03:26:00', '2011-02-21 14:48:02', '', '', '', '', '1', '0', '7', '', '', '0', '17', '', '1');
INSERT INTO `w_contents` VALUES ('191', '先付订金', '', '', '', '<p>&nbsp;<strong>先付定金：您在线购买空调，可以在格力在线购物平台上支付要求的产品购买定金，在免费上门安装时再支付余下货款</strong></p>\r\n<p>&nbsp;</p>\r\n<p><br />\r\n温馨提示：<br />\r\n1、货到付款仅限支付现金<br />\r\n2、签收时，请您仔细核兑款项、务必作到货款两清，若事后发现款项错误，我们将无法再核实确认  <br />\r\n3、部分格力小家电不支持货到付款，请您通过 网上支付、邮局汇款、银行转帐方式支付</p>', '1', '0', '0', '382', '2010-12-03 03:26:09', '2011-02-21 15:14:01', '', '', '', '', '1', '0', '8', '', '', '0', '12', '', '1');
INSERT INTO `w_contents` VALUES ('192', '退换货说明', '', '', '', '<p><strong>退货说明：</strong><br />\r\n格力在线承诺自顾客收到商品之日起7日内（以发票日期为准，如无发票以格力在线发货清单的日期为准），如符合以下条件，我们将提供全款退货的服务。<br />\r\n&nbsp;</p>\r\n<p>1、商品及商品本身的外包装没有损坏，保持格力在线出售时的原质原样；<br />\r\n2、注明退货原因，如果商品存在质量问题，请务必说明；<br />\r\n3、确保商品及配件、附带品或者赠品、保修卡、三包凭证、发票、格力在线发货清单齐全；<br />\r\n4、如果成套商品中有部分商品存在质量问题，在办理退货时，必须提供成套商品；<br />\r\n</p>\r\n<p><strong>以下情况不予办理退货：<br />\r\n</strong><br />\r\n1、任何非由格力在线出售的商品；<br />\r\n2、任何已使用过的商品，但有质量问题除外；<br />\r\n3、任何因非正常使用及保管导致出现质量问题的商品。</p>\r\n<p>商品如出现质量问题，请先行按照说明书上的联系方式与厂家的售后部门联系，如果确认属于质量问题，持厂家出具质量问题检测报告与当当客服中心联系办理退货事宜。</p>', '1', '0', '0', '383', '2010-12-03 03:26:21', '2011-02-21 15:45:37', '', '', '', '', '1', '0', '9', '', '', '0', '6', '', '1');
INSERT INTO `w_contents` VALUES ('193', '空调维护', '', '', '', '<p><img src=\"/media/1/index_20110228l.jpg\" alt=\"\" /></p>\r\n<p><strong>服务宗旨：用户满意！<br />\r\n服务理念：用户的每一件小事，都是格力的大事</strong></p>\r\n<p><strong>（一）产品三包政策</strong><br />\r\n<br />\r\n<strong>1.包修政策</strong><br />\r\n2010年度家用空调（制冷量小于或等于14000W）、除湿机包修政策为整机包修六年。<br />\r\n2005年1月1日至2009年12月31日所购买的家用空调器整机包修六年。<br />\r\n2005年1月1日之前所购买的家用空调器的包修政策：按其当年的包修规定执行。</p>\r\n<p>以下情况之一的不属于包修范围，将按有关规定实行收费维修：	<br />\r\n1.1消费者因使用、维护、保管不当造成损坏的；<br />\r\n1.2非格力电器指定的特约服务网点所安装、维修造成损坏的（包括消费者自行安装或拆动维修的）；<br />\r\n1.3无包修凭证及有效发票或有效购买凭证的；<br />\r\n1.4有效凭证、包修凭证不符或涂改的；<br />\r\n1.5因不可抗拒的自然灾害或使用环境恶劣造成损坏的；<br />\r\n1.6处理品、已超过包修期的产品。</p>\r\n<p><strong>2.包换政策 </strong><br />\r\n按国家规定的三包期限，在包修期内，符合下列条件，而且用户拒绝维修时，可以换机。 <br />\r\n2.1产品自售出之日起15日内，发生主要性能故障，不能正常工作的，可以换机； <br />\r\n2.2按国家规定的三包期限，在包修期内，主要性能故障连续维修二次，不能正常工作的，可以换机，并按国家三包规定，重新起算包修期限（仅限更换部分）。</p>\r\n<p><strong>3、包退政策 </strong><br />\r\n按国家规定的三包期限，符合下列条件，而且用户拒绝维修或换机时，可以退机。<br />\r\n3.1产品自售出之日起10日内，发生主要性能故障，如压缩机故障、换热器内漏等,可以退机。 <br />\r\n3.2自售出之日起一年以内，连续二次以上仍无法修好（指主要性能）用户坚持退机的。</p>\r\n<p><strong>（二）免费安装政策</strong></p>\r\n<p><strong>1. 免费安装范围 </strong><br />\r\n格力电器家用空调，包括分体式、立柜式、吊顶式、天井式空调均实行免费安装。免费安装费用由特约服务网点按《安装费结算管理制度》要求向格力电器结算，不得向用户收取，但下列情况可与用户协商好后额外收费： <br />\r\n1.1 需加长连接管； <br />\r\n1.2 使用吊车、吊绳安装的；超过四楼在墙外进行施工（在阳台施工不另行收费）； <br />\r\n1.3 在厚度超过120mm 的钢筋水泥墙上钻洞和超过1个以上的墙洞； <br />\r\n1.4 拆除防盗网才能安装的；搬拆移位重安装的； <br />\r\n1.5 安装铁架等所有材料费。</p>\r\n<p><strong>2.下列情况实行收费安装：</strong> <br />\r\n2.1 安装窗式空调器； <br />\r\n2.2 移动空调钻排气口洞； <br />\r\n2.3 无有效发票或有效购买凭证，又无免费安装凭证、无条形码的。</p>\r\n<p>注：对被抽取安装结算条形码的情况，若空调上有条形码的可以免费安装，并记录条形码。如机器上的条形码也被撕去的情况，则不能实行免费安装。由用户向购买商店协商，协商未果的应及时向销售公司申报情况。</p>', '1', '0', '0', '383', '2010-12-03 03:26:39', '2011-03-23 15:39:14', '', '', '', '', '1', '0', '10', '', '', '0', '8', '', '1');
INSERT INTO `w_contents` VALUES ('194', '维修预约', '', '', '', '', '1', '0', '0', '383', '2010-12-03 03:26:50', '2011-02-17 13:57:26', '', '', '', '', '1', '0', '11', '', '', '0', '1', '', '1');
INSERT INTO `w_contents` VALUES ('195', '常见问题', '', '', '', '', '1', '0', '0', '384', '2010-12-03 03:27:26', '2011-02-17 13:57:56', '', '', '', '', '1', '0', '12', '', '', '0', '41', '', '1');
INSERT INTO `w_contents` VALUES ('196', '积分说明', '', '', '', '<p>所有会员在格力在线购物均可获得积分，积分可以用来参与兑换活动。格力在线会不定期推出各类积分兑换活动，请随时关注关于积分的活动告知。详情请点击查看以下各项说明。</p>\r\n<p><strong>积分获得 </strong><br />\r\n1、每一张成功交易的订单，所付现金部分都可获得积分，不同商品积分标准不同，获得积分以订单提交时所注明的积分为准。<br />\r\n2、贵宾会员购物时，将额外获得相应级别的级别赠分。 <br />\r\n3、阶段性的积分促销活动，也会给您带来额外的促销赠分，详见积分活动。 <br />\r\n4、促销商品不能获得积分。</p>\r\n<p>&middot;积分会在订单状态变为&quot;交易成功&quot;的次日记入您的帐户。如发生退货，将扣除由于退货部分产生的积分；</p>\r\n<p><strong>积分有效期</strong><br />\r\n积分有效期：获得之日起到次年年底。</p>\r\n<p>查询积分                                                                                           积分有效期：获得之日起到次年年底。 您可以在&quot;会员中心-我的积分 &quot;中，查看您的累计积分。</p>\r\n<p><strong>积分活动</strong><br />\r\n格力在线会不定期地推出各种积分活动，请随时关注关于积分促销的告知。<br />\r\n1、会员可以用积分参与格力在线指定的各种活动，参与后会扣减相应的积分。<br />\r\n2、积分不可用于兑换现金，仅限参加格力在线指定兑换物品、参与抽奖等各种活动。</p>\r\n<p><strong>会员积分计划细则</strong><br />\r\n不同帐户积分不可合并使用；<br />\r\n&middot;本计划只适用于个人用途而进行的购物，不适用于团体购物、以营利或销售为目的的购买行为、其他非个人用途购买行为。 <br />\r\n&middot;会员积分计划及原VIP制度的最终解释权归格力在线所有。</p>\r\n<p><strong>免责条款</strong> <br />\r\n感谢您访问格力在线的会员积分计划，本计划由深圳格力在线信息技术有限公司/或其关联企业提供。以上计划条款和条件，连同计划有关的任何促销内容的相应条款和条件，构成本计划会员与格力在线之间关于制度的完整协议。如果您使用格力在线，您就参加了本计划并接受了这些条款、条件、限制和要求。请注意，您对格力在线站的使用以及您的会员资格还受制于格力在线站上时常更新的所有条款、条件、限制和要求，请仔细阅读这些条款和条件。</p>\r\n<p><strong>协议的变更</strong> <br />\r\n格力在线可以在没有特殊通知的情况下自行变更本条款、格力在线的任何其它条款和条件、或您的计划会员资格的任何方面。 对这些条款的任何修改将被包含在格力在线的更新的条款中。如果任何变更被认定为无效、废止或因任何原因不可执行，则该变更是可分割的，且不影响其它变更或条件的有效性或可执行性。在我们变更这些条款后，您对格力在线的继续使用，构成您对变更的接受。</p>\r\n<p><strong>终止</strong></p>\r\n<p>格力在线可以不经通知而自行决定终止全部或部分计划，或终止您的计划会员资格。即使格力在线没有要求或强制您严格遵守这些条款，也并不构成对属于格力在线的任何权利的放弃。如果您在格力在线的客户帐户被关闭，那么您也将丧失您的会员资格。对于该会员资格的丧失，您对格力在线不能主张任何权利或为此索赔。</p>\r\n<p><strong>责任限制</strong></p>\r\n<p>除了格力在线的使用条件中规定的其它限制和除外情况之外，在中国法律法规所允许的限度内，对于因会员积分计划而引起的或与之有关的任何直接的、间接的、特殊的、附带的、后果性的或惩罚性的损害，或任何其它性质的损害， 格力在线、格力在线的董事、管理人员、雇员、代理或其它代表在任何情况下都不承担责任。格力在线的全部责任，不论是合同、保证、侵权（包括过失）项下的还是其它的责任，均不超过您所购买的与该索赔有关的商品价值额。这些责任排除和限制条款将在法律所允许的最大限度内适用，并在您的计划会员资格被撤销或终止后仍继续有效。</p>', '1', '0', '0', '380', '2011-02-17 13:54:37', '2011-02-21 14:03:06', '', '', '', '', '1', '0', '1', '会员积分,积分获得,积分有效期,积分活动，免责条款', '', '0', '13', '', '1');
INSERT INTO `w_contents` VALUES ('197', '加急配送', '', '', '', '<p><strong>如何正确选择加急配送服务</strong><br />\r\n北京、天津、上海、广州、深圳、廊坊6个城市地区的用户，并且为当地发货订单，用户可在结算中心&ldquo;送货方式&rdquo;部分选择加急快递送货上门服务。</p>\r\n<p><strong>常见问题解答：<br />\r\n</strong><br />\r\n1. 我的订单什么时候可以送到？<br />\r\n具体配送时间根据不同城市略有不同，请查看配送范围、时间及运费<br />\r\n<br />\r\n2. &quot;加急快递送货上门&quot;的费收取标准？<br />\r\n北京、天津、上海、广州、深圳、廊坊6个城市的&ldquo;加急快递送货上门&rdquo;配送费为10元/单。</p>', '1', '0', '0', '381', '2011-02-17 13:55:47', '2011-02-21 14:13:06', '', '', '', '', '1', '0', '13', '', '', '0', '4', '', '1');
INSERT INTO `w_contents` VALUES ('198', '邮政汇款', '', '', '', '<p>1、邮局汇款的到款时间：一般自您办理邮局汇款手续之日起2-7个工作日。<br />\r\n2、邮局汇款单填写说明：（您只需填写以下信息即可）如下图所示：<br />\r\n<img alt=\"\" src=\"/media/1/products/button_jdx081124_1.jpg\" /></p>\r\n<p>（1）在客户签名处填写：您的姓名<br />\r\n（2）在汇款金额处填写：您的汇款金额（小写）<br />\r\n（3）在商务汇款处：&ldquo;&radic;&rdquo;；同时商户客户号要填写：110700150<br />\r\n（4）在汇款人地址/电话处填写：您的详细地址和您的联系电话<br />\r\n（5）在汇款人邮编处填写：您的邮政编码<br />\r\n（6）在汇款人姓名处填写：您的姓名<br />\r\n（7）在附言栏处：&ldquo;&radic;&rdquo;；同时一定要填写：您的订单号</p>\r\n<p>注意事项：<br />\r\n（1）自订单提交之日起7日我们未收到您的货款，订单将被取消，若您还需要其中的商品，需重新提交一张订单。<br />\r\n（2）请您尽量不要采用&ldquo;加密汇款&rdquo;方式,因为该汇款方式的取款速度较慢，会耽误订单的处理进程<br />\r\n（3）如您未注明订单号，请您汇款后将汇款凭证（注明订单号）传真至010-59222799，或扫描以附件形式发邮件至chuxushukuan@dangdang.com，以便我们核实您的款项。若没有接到您的汇款凭证，您的订单将无法处理。<br />\r\n（4）如果汇款一段时间之后，您的订单仍为&ldquo;等待付款&rdquo;状态，请进入&ldquo;汇款单招领&rdquo;查询，并尽快与我们联系。</p>', '1', '0', '0', '382', '2011-02-17 13:56:26', '2011-02-21 15:06:20', '', '', '', '', '1', '0', '14', '', '', '0', '4', '', '1');
INSERT INTO `w_contents` VALUES ('199', '银行转帐', '', '', '', '<p>1、国内顾客可以通过全国任何一家银行，向格力在线在光大银行、建设银行、农业银行、招商银行开立的账户汇款。</p>\r\n<p>2、到款时间一般为办理转帐手续之后的1-5个工作日内。</p>\r\n<p>3、银行转帐单的填写方法请参考下图：<br />\r\n<img alt=\"\" src=\"/media/1/products/han007.JPG\" /></p>\r\n<p>温馨提示：<br />\r\n（1）除招商银行接受外币汇款之外，其余银行均无法接受外币汇款。<br />\r\n（2）办理银行转账时，请您务必在电汇单的用途栏内注明订单号和用户名（收货人的用户名）。</p>\r\n<p>&nbsp;</p>', '1', '0', '0', '382', '2011-02-17 13:56:36', '2011-02-21 15:02:31', '', '', '', '', '1', '0', '15', '', '', '0', '3', '', '1');
INSERT INTO `w_contents` VALUES ('200', '投诉及预约查询', '', '', '', '', '1', '0', '0', '383', '2011-02-17 13:57:37', '2011-02-21 15:55:33', '', '', '', '', '1', '0', '16', '', '', '0', '1', '', '1');
INSERT INTO `w_contents` VALUES ('201', '找回密码', '', '', '', '', '1', '0', '0', '384', '2011-02-17 13:58:04', '2011-02-17 13:58:04', '', '', '', '', '1', '0', '17', '', '', '0', '4', '', '1');
INSERT INTO `w_contents` VALUES ('202', '联系客服', '', '', '', '', '1', '0', '0', '384', '2011-02-17 13:58:12', '2011-02-17 13:58:12', '', '', '', '', '1', '0', '18', '', '', '0', '3', '', '1');
INSERT INTO `w_contents` VALUES ('203', '退订邮件/短信', '', '', '', '', '1', '0', '0', '384', '2011-02-17 13:58:24', '2011-02-17 13:58:24', '', '', '', '', '1', '0', '19', '', '', '0', '2', '', '1');
INSERT INTO `w_contents` VALUES ('204', '新版商城上线了！！', '', '', '', '<p>新版商城上线了！！</p>', '1', '0', '0', '408', '2011-02-17 15:11:26', '2011-02-24 14:06:48', '', '', '', '', '1', '0', '20', '', '', '0', '21', '', '1');
INSERT INTO `w_contents` VALUES ('205', '格力深圳三月活动进行中', '', '', '', '', '1', '0', '0', '408', '2011-03-04 14:37:59', '2011-03-04 14:37:59', '', '', '', '', '1', '0', '21', '', '', '0', '1', '', '1');
INSERT INTO `w_contents` VALUES ('206', '格力夏季推出最新节能空调！', '', '', '', '', '1', '0', '0', '408', '2011-03-04 14:38:28', '2011-03-04 14:38:28', '', '', '', '', '1', '0', '22', '', '', '0', '2', '', '1');
INSERT INTO `w_contents` VALUES ('207', '今夏您“扇”了吗？', '', '', '', '', '1', '0', '0', '408', '2011-03-04 14:39:17', '2011-03-31 11:18:10', '', '', '', '', '1', '0', '23', '', '', '0', '0', '', '1');
INSERT INTO `w_contents` VALUES ('208', '晒单：您的完美变频睡美人空调', '', '', '', '', '1', '0', '0', '408', '2011-03-04 14:40:21', '2011-03-04 14:40:21', '', '', '', '', '1', '0', '24', '', '', '0', '1', '', '1');
INSERT INTO `w_contents` VALUES ('209', '三月格力“团购”开团啦！', '', '', '', '', '1', '0', '0', '408', '2011-03-04 14:46:49', '2011-03-31 11:43:19', '', '', '', '', '1', '0', '25', '', '', '0', '2', '', '1');
INSERT INTO `w_contents` VALUES ('210', '团购超省又好用，准备抢抢抢！', '', '', '', '', '1', '0', '0', '408', '2011-03-04 14:47:58', '2011-03-31 12:35:14', '', '', '', '', '1', '0', '26', '', '', '0', '0', '', '1');
drop table if exists w_delivery_items;
CREATE TABLE `w_delivery_items` (
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `w_delivery_items` VALUES ('2', '2', '426', '', '格力电暖器 NSW-8  二管 石英管 取暖器', '', '0', '', '0', '1', 'a:4:{s:6:\"params\";b:0;s:4:\"pays\";s:1:\"1\";s:5:\"price\";s:3:\"100\";s:12:\"actual_price\";N;}');
drop table if exists w_delivery_order;
CREATE TABLE `w_delivery_order` (
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

drop table if exists w_elite_re;
CREATE TABLE `w_elite_re` (
  `products_id` mediumint(8) unsigned NOT NULL default '0',
  `elite_id` tinyint(4) unsigned NOT NULL default '0',
  `ordering` tinyint(4) unsigned NOT NULL default '0',
  UNIQUE KEY `products_id` (`products_id`,`elite_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `w_elite_re` VALUES ('20', '2', '2');
INSERT INTO `w_elite_re` VALUES ('47', '3', '1');
INSERT INTO `w_elite_re` VALUES ('48', '3', '2');
INSERT INTO `w_elite_re` VALUES ('49', '3', '0');
INSERT INTO `w_elite_re` VALUES ('36', '1', '50');
INSERT INTO `w_elite_re` VALUES ('42', '1', '50');
INSERT INTO `w_elite_re` VALUES ('65', '3', '0');
INSERT INTO `w_elite_re` VALUES ('44', '3', '0');
INSERT INTO `w_elite_re` VALUES ('45', '3', '0');
INSERT INTO `w_elite_re` VALUES ('46', '3', '0');
INSERT INTO `w_elite_re` VALUES ('54', '2', '50');
INSERT INTO `w_elite_re` VALUES ('23', '2', '50');
INSERT INTO `w_elite_re` VALUES ('32', '2', '1');
INSERT INTO `w_elite_re` VALUES ('33', '2', '50');
INSERT INTO `w_elite_re` VALUES ('11', '1', '3');
INSERT INTO `w_elite_re` VALUES ('34', '2', '50');
INSERT INTO `w_elite_re` VALUES ('35', '2', '50');
INSERT INTO `w_elite_re` VALUES ('36', '2', '50');
INSERT INTO `w_elite_re` VALUES ('37', '2', '50');
INSERT INTO `w_elite_re` VALUES ('52', '2', '3');
INSERT INTO `w_elite_re` VALUES ('19', '3', '0');
INSERT INTO `w_elite_re` VALUES ('18', '3', '0');
INSERT INTO `w_elite_re` VALUES ('13', '3', '0');
INSERT INTO `w_elite_re` VALUES ('12', '3', '0');
INSERT INTO `w_elite_re` VALUES ('9', '3', '0');
INSERT INTO `w_elite_re` VALUES ('50', '2', '50');
drop table if exists w_evaluation;
CREATE TABLE `w_evaluation` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `uname` varchar(20) NOT NULL,
  `product_id` varchar(11) NOT NULL default '0',
  `star` tinyint(2) NOT NULL default '0',
  `created` datetime NOT NULL,
  `contents` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `w_evaluation` VALUES ('1', '1', 'china', '155', '3', '2011-02-25 15:18:15', 'asdfasdf');
INSERT INTO `w_evaluation` VALUES ('2', '1', 'china', '155', '2', '2011-02-25 17:27:38', 'asdfasdf');
INSERT INTO `w_evaluation` VALUES ('3', '1', 'china', '152', '2', '2011-02-25 17:27:46', 'asdfasdf');
INSERT INTO `w_evaluation` VALUES ('4', '109', 'testtest2', '426', '2', '2011-03-28 11:48:04', 'asfsad');
INSERT INTO `w_evaluation` VALUES ('5', '109', 'testtest2', '424', '3', '2011-03-28 11:49:08', '产品很不错。我很喜欢，谢谢格力团队的热情服务！一天就送货上门了。');
drop table if exists w_feedbacks;
CREATE TABLE `w_feedbacks` (
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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO `w_feedbacks` VALUES ('9', '', 'asfdasfd', 'asdfasdf', '89', '1', '', '2011-02-22', '', '', '', '', '', '', '0000-00-00', '', '0', '1', '');
INSERT INTO `w_feedbacks` VALUES ('10', '', 'adfadf', 'afadf', '89', '1', '', '2011-02-24', '', '', '', '', '', 'asdf', '2011-03-28', 'testtest', '0', '1', '');
drop table if exists w_group;
CREATE TABLE `w_group` (
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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO `w_group` VALUES ('22', '系统管理员', '1', '4', '0', '', '1');
INSERT INTO `w_group` VALUES ('21', '管理员', '2', '3', '22', '', '1');
INSERT INTO `w_group` VALUES ('17', '经销商', '5', '8', '0', '', '1');
INSERT INTO `w_group` VALUES ('16', '经销商管理员', '6', '7', '17', '', '1');
INSERT INTO `w_group` VALUES ('15', '五星级会员', '9', '18', '0', '', '1');
INSERT INTO `w_group` VALUES ('14', '四星级', '10', '17', '15', '', '1');
INSERT INTO `w_group` VALUES ('13', '三星级', '11', '16', '14', '', '1');
INSERT INTO `w_group` VALUES ('12', '二星级', '12', '15', '13', '', '1');
INSERT INTO `w_group` VALUES ('11', '一星级', '13', '14', '12', '', '1');
INSERT INTO `w_group` VALUES ('1', '注册会员', '19', '20', '0', '', '1');
drop table if exists w_languages;
CREATE TABLE `w_languages` (
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `w_languages` VALUES ('1', '字段名称', 'a:20:{i:0;s:4:\"home\";i:1;s:3:\"adf\";i:2;s:8:\"w_halsfd\";i:3;s:3:\"adf\";i:4;s:3:\"adf\";i:5;s:3:\"adf\";i:6;s:3:\"adf\";i:7;s:3:\"adf\";i:8;s:3:\"adf\";i:9;s:3:\"adf\";i:10;s:3:\"adf\";i:11;s:3:\"adf\";i:12;s:3:\"adf\";i:13;s:3:\"adf\";i:14;s:3:\"adf\";i:15;s:3:\"adf\";i:16;s:3:\"adf\";i:17;s:3:\"adf\";i:18;s:3:\"adf\";i:19;s:3:\"adf\";}', '1', '1', '0', '1', '', '');
INSERT INTO `w_languages` VALUES ('2', '中文版', 'a:20:{i:0;s:6:\"首页\";i:1;s:4:\"asfd\";i:2;s:1:\"c\";i:3;s:4:\"asfd\";i:4;s:4:\"asfd\";i:5;s:4:\"asfd\";i:6;s:4:\"asfd\";i:7;s:4:\"asfd\";i:8;s:0:\"\";i:9;s:4:\"asfd\";i:10;s:4:\"asfd\";i:11;s:4:\"asfd\";i:12;s:4:\"asfd\";i:13;s:4:\"asfd\";i:14;s:4:\"asfd\";i:15;s:4:\"asfd\";i:16;s:4:\"asfd\";i:17;s:4:\"asfd\";i:18;s:4:\"asfd\";i:19;s:0:\"\";}', '2', '1', '1', '1', '/media/1/icon.gif', 'cn');
INSERT INTO `w_languages` VALUES ('4', '韩语版', 'a:20:{i:0;s:6:\"首页\";i:1;s:4:\"asfd\";i:2;s:1:\"d\";i:3;s:4:\"asfd\";i:4;s:4:\"asfd\";i:5;s:4:\"asfd\";i:6;s:4:\"asfd\";i:7;s:4:\"asfd\";i:8;s:0:\"\";i:9;s:4:\"asfd\";i:10;s:4:\"asfd\";i:11;s:4:\"asfd\";i:12;s:4:\"asfd\";i:13;s:4:\"asfd\";i:14;s:4:\"asfd\";i:15;s:4:\"asfd\";i:16;s:4:\"asfd\";i:17;s:4:\"asfd\";i:18;s:4:\"asfd\";i:19;s:0:\"\";}', '4', '0', '0', '1', '/media/1/kr.jpg', 'kr');
INSERT INTO `w_languages` VALUES ('5', '日语版', 'a:20:{i:0;s:6:\"首页\";i:1;s:8:\"asfdasfd\";i:2;s:1:\"e\";i:3;s:8:\"asfdasfd\";i:4;s:8:\"asfdasfd\";i:5;s:8:\"asfdasfd\";i:6;s:8:\"asfdasfd\";i:7;s:8:\"asfdasfd\";i:8;s:8:\"asfdasfd\";i:9;s:8:\"asfdasfd\";i:10;s:8:\"asfdasfd\";i:11;s:8:\"asfdasfd\";i:12;s:8:\"asfdasfd\";i:13;s:8:\"asfdasfd\";i:14;s:8:\"asfdasfd\";i:15;s:8:\"asfdasfd\";i:16;s:8:\"asfdasfd\";i:17;s:8:\"asfdasfd\";i:18;s:8:\"asfdasfd\";i:19;s:8:\"asfdasfd\";}', '5', '0', '0', '1', '', '');
INSERT INTO `w_languages` VALUES ('3', 'English', 'a:20:{i:0;s:4:\"Home\";i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";i:4;s:0:\"\";i:5;s:0:\"\";i:6;s:0:\"\";i:7;s:0:\"\";i:8;s:0:\"\";i:9;s:0:\"\";i:10;s:0:\"\";i:11;s:0:\"\";i:12;s:0:\"\";i:13;s:0:\"\";i:14;s:0:\"\";i:15;s:0:\"\";i:16;s:0:\"\";i:17;s:0:\"\";i:18;s:0:\"\";i:19;s:0:\"\";}', '3', '0', '0', '1', '/media/1/icon_en.gif', 'en');
drop table if exists w_latest;
CREATE TABLE `w_latest` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) default NULL COMMENT '会员名',
  `photo` varchar(100) default NULL COMMENT '头象',
  `uid` int(11) NOT NULL default '0' COMMENT '会员ID',
  `http_name` varchar(50) default NULL COMMENT '网址名称',
  `http` varchar(255) default NULL COMMENT '网址',
  `adddate` datetime default NULL COMMENT '时间',
  `action` tinyint(2) NOT NULL default '0' COMMENT '添加或者是修改',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=141 DEFAULT CHARSET=utf8;

INSERT INTO `w_latest` VALUES ('140', 'china', '/member/media/photo/kt2.jpg', '1', '新站2', 'http://www.ppczy.cn/', '2010-11-19 20:07:21', '2');
INSERT INTO `w_latest` VALUES ('135', 'testtest4', '/member/media/photo/kt1.jpg', '110', '天涯', 'http://www.tianya.cn', '2010-11-17 16:45:07', '2');
INSERT INTO `w_latest` VALUES ('136', 'testtest', '/member/media/photo/kt28.jpg', '89', '酷看影院', 'http://www.cc161.com/', '2010-11-17 20:45:08', '2');
INSERT INTO `w_latest` VALUES ('137', 'testtest', '/member/media/photo/kt28.jpg', '89', '乐缘高清影院', 'http://www.im163.net/', '2010-11-17 20:48:08', '2');
INSERT INTO `w_latest` VALUES ('138', 'testtest', '/member/media/photo/kt28.jpg', '89', '124', 'http://2124', '2010-11-17 20:52:55', '1');
INSERT INTO `w_latest` VALUES ('139', 'china', '/member/media/photo/kt2.jpg', '1', 'testtest', 'http://test', '2010-11-19 20:07:14', '2');
drop table if exists w_level;
CREATE TABLE `w_level` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(60) NOT NULL,
  `discount` tinyint(4) unsigned NOT NULL default '0',
  `point` mediumint(4) unsigned NOT NULL default '0',
  `defaulted` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `published` (`defaulted`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `w_level` VALUES ('1', '普通会员', '0', '0', '0');
INSERT INTO `w_level` VALUES ('2', '高级会员', '1', '1000000', '1');
drop table if exists w_link_types;
CREATE TABLE `w_link_types` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT '分类名称',
  `parent_id` int(11) NOT NULL COMMENT '父分类ID',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `published` tinyint(4) NOT NULL COMMENT '是否发布（1发布，0不发布）',
  `params` text NOT NULL COMMENT '分类参数',
  `ordering` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

drop table if exists w_links;
CREATE TABLE `w_links` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

drop table if exists w_menu;
CREATE TABLE `w_menu` (
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
) ENGINE=MyISAM AUTO_INCREMENT=430 DEFAULT CHARSET=utf8;

INSERT INTO `w_menu` VALUES ('354', 'products', '产品中心', '/media/1/aboutus.jpg', 'products', 'index.php?com=products&view=category&id=354', 'component', '3', '4', '0', '1', '1', 'orderby_sec=\n\n', '产品 > 产品列表 > 默认的列表样式', '0', '0', '产品页面关键词', '产品页面描述', '0', '0');
INSERT INTO `w_menu` VALUES ('7', 'products', '特价产品', '', 'specials', 'index.php?com=products&view=special&id=7', 'component', '7', '8', '0', '1', '1', 'orderby_sec=\n\n', '产品 > 特价产品 > 默认的列表样式', '1', '0', 'asdf', '', '0', '0');
INSERT INTO `w_menu` VALUES ('15', 'pages', '首 页', '', 'home', 'index.php?com=pages&view=homepage&id=15', 'component', '1', '2', '0', '1', '1', 'image=/media/1/logodd.jpg\nid=0\n\n', '单页信息 > 网站首页 > 显示首页模块信息', '1', '1', '培训', '好的', '0', '0');
INSERT INTO `w_menu` VALUES ('408', 'contents', '资讯', '/media/1/contact.jpg', 'Contactus', 'index.php?com=contents&view=category&id=408', 'component', '13', '14', '0', '1', '1', 'setstyle=1\n\n', '文章 > 文章列表 > 默认的列表样式', '1', '0', '', '', '1', '0');
INSERT INTO `w_menu` VALUES ('407', 'pages', '知识堂', '/media/1/contact.jpg', 'zhishitang', 'index.php?com=pages&view=services&id=407', 'component', '11', '12', '0', '1', '1', 'image=\nid=0\n\n', '单页信息 > 服务信息页 > 服务信息页', '1', '0', '', '', '0', '0');
INSERT INTO `w_menu` VALUES ('429', 'products', '促销快报', '', 'cuxiaokuaibao', 'index.php?com=products&view=special&id=429', 'component', '17', '18', '0', '1', '1', 'orderby_sec=\n\n', '产品 > 特价产品 > 默认的列表样式', '1', '0', '', '', '1', '0');
INSERT INTO `w_menu` VALUES ('380', 'contents', '新手指南', '/media/1/contact.jpg', 'xinshouzhinan', 'index.php?com=contents&view=category&id=380', 'component', '1', '2', '0', '10', '1', 'show_title=1\nshow_closebtn=1\nshow_hits=1\n\n', '文章 > 文章列表 > 默认的列表样式', '1', '0', '', '', '1', '0');
INSERT INTO `w_menu` VALUES ('369', 'tuans', '团购', '/media/1/contact2.jpg', 'groupbuy', 'index.php?com=tuans&view=category&id=369', 'component', '9', '10', '0', '1', '1', 'show_headings=1\nshow_date=0\ndate_format=\nfilter=1\nfilter_type=title\n\n', '团购管理 > 团购信息列表 > 默认的列表样式', '1', '0', '', '', '0', '0');
INSERT INTO `w_menu` VALUES ('381', 'contents', '配送方式', '/media/1/t2.jpg', 'peisongfangshi', 'index.php?com=contents&view=category&id=381', 'component', '3', '4', '0', '10', '1', 'show_title=1\nshow_closebtn=1\nshow_hits=1\n\n', '文章 > 文章列表 > 默认的列表样式', '1', '0', '', '', '0', '0');
INSERT INTO `w_menu` VALUES ('382', 'contents', '支付方式', '/media/1/t3.jpg', 'zhifufangshi', 'index.php?com=contents&view=category&id=382', 'component', '5', '6', '0', '10', '1', 'show_title=1\nshow_closebtn=1\nshow_hits=1\n\n', '文章 > 文章列表 > 默认的列表样式', '1', '0', '', '', '0', '0');
INSERT INTO `w_menu` VALUES ('383', 'contents', '售后服务', '/media/1/t4.jpg', 'shouhoufuwu', 'index.php?com=contents&view=category&id=383', 'component', '7', '8', '0', '10', '1', 'show_title=1\nshow_closebtn=1\nshow_hits=1\n\n', '文章 > 文章列表 > 默认的列表样式', '1', '0', '', '', '0', '0');
INSERT INTO `w_menu` VALUES ('384', 'contents', '帮助中心', '/media/1/t5.jpg', 'bangzhuzhongxin', 'index.php?com=contents&view=category&id=384', 'component', '9', '10', '0', '10', '1', 'show_title=1\nshow_closebtn=1\nshow_hits=1\n\n', '文章 > 文章列表 > 默认的列表样式', '1', '0', '', '', '0', '0');
INSERT INTO `w_menu` VALUES ('419', 'pages', '格力简介', '', '20101202083111', 'index.php?com=pages&view=page&id=419', 'component', '1', '2', '0', '11', '1', 'image=\nid=0\n\n', '单页信息 > 单页内容 > 显示内容展示', '1', '0', '', '', '0', '0');
INSERT INTO `w_menu` VALUES ('420', 'pages', '关于我们', '', '20101202083121', 'index.php?com=pages&view=page&id=420', 'component', '3', '4', '0', '11', '1', 'image=\nid=0\n\n', '单页信息 > 单页内容 > 显示内容展示', '1', '0', '', '', '0', '0');
INSERT INTO `w_menu` VALUES ('418', 'products', '新品上架', '', 'new-products', 'index.php?com=products&view=latest&id=418', 'component', '5', '6', '0', '1', '1', 'orderby_sec=\n\n', '产品 > 最新产品 > 默认的列表样式', '1', '0', '', '', '0', '0');
INSERT INTO `w_menu` VALUES ('422', 'contents', '一周新品', '', 'changjianwenti', 'index.php?com=contents&view=category&id=422', 'component', '15', '16', '0', '1', '1', 'setstyle=0\n\n', '文章 > 文章列表 > 默认的列表样式', '1', '0', '', '', '1', '0');
INSERT INTO `w_menu` VALUES ('423', 'pages', '服务网点', '', 'fuwuwangdian', 'index.php?com=pages&view=page&id=423', 'component', '5', '6', '0', '11', '1', 'image=\nid=0\n\n', '单页信息 > 单页内容 > 显示内容展示', '1', '0', '', '', '0', '0');
INSERT INTO `w_menu` VALUES ('424', 'pages', '网站地图', '', 'wangzhanditu', 'index.php?com=pages&view=page&id=424', 'component', '7', '8', '0', '11', '1', 'image=\nid=0\n\n', '单页信息 > 单页内容 > 显示内容展示', '1', '0', '', '', '0', '0');
INSERT INTO `w_menu` VALUES ('425', 'pages', '最新通告', '', 'zuixintonggao', 'index.php?com=pages&view=page&id=425', 'component', '9', '10', '0', '11', '1', 'image=\nid=0\n\n', '单页信息 > 单页内容 > 显示内容展示', '1', '0', '', '', '0', '0');
INSERT INTO `w_menu` VALUES ('426', 'pages', '格力团购', '', '20110222133926', 'index.php?com=pages&view=page&id=426', 'component', '11', '12', '0', '11', '1', 'image=\nid=0\n\n', '单页信息 > 单页内容 > 显示内容展示', '1', '0', '', '', '0', '0');
INSERT INTO `w_menu` VALUES ('427', '', '在线咨询', '', '20110222133939', '/maintenance.html?a=cons', 'url', '13', '14', '0', '11', '1', '', '外部链接', '1', '0', '', '', '0', '0');
INSERT INTO `w_menu` VALUES ('428', 'pages', '联系我们', '', '20110222133951', 'index.php?com=pages&view=page&id=428', 'component', '15', '16', '0', '11', '1', 'image=\nid=0\n\n', '单页信息 > 单页内容 > 显示内容展示', '1', '0', '', '', '0', '0');
drop table if exists w_menu_types;
CREATE TABLE `w_menu_types` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `menutype` varchar(75) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `ordering` tinyint(4) NOT NULL default '0',
  `uid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO `w_menu_types` VALUES ('1', '', '网站导航', '顶部菜单', '1', '1');
INSERT INTO `w_menu_types` VALUES ('10', '', '帮助中心', '', '2', '1');
INSERT INTO `w_menu_types` VALUES ('11', '', '服务与支持', '', '3', '1');
drop table if exists w_message;
CREATE TABLE `w_message` (
  `id` int(11) NOT NULL auto_increment,
  `to_id` int(11) NOT NULL default '0' COMMENT '接收用户ID',
  `from_id` int(11) NOT NULL default '0' COMMENT '发送用户ID',
  `contents` varchar(255) default NULL COMMENT '内容',
  `createdate` datetime default NULL COMMENT '添加时间',
  `isview` tinyint(2) NOT NULL default '0' COMMENT '是否查已查看',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `w_message` VALUES ('1', '1', '89', 'asdf', '0000-00-00 00:00:00', '1');
INSERT INTO `w_message` VALUES ('2', '1', '89', 'sadf', '0000-00-00 00:00:00', '1');
INSERT INTO `w_message` VALUES ('3', '89', '89', 'asdf', '0000-00-00 00:00:00', '1');
INSERT INTO `w_message` VALUES ('4', '89', '89', 'asfd', '2010-11-15 15:29:01', '1');
INSERT INTO `w_message` VALUES ('5', '1', '1', 'asdf', '2010-11-15 15:49:54', '1');
INSERT INTO `w_message` VALUES ('6', '1', '1', 'asdf', '2010-11-15 15:52:51', '1');
drop table if exists w_modules;
CREATE TABLE `w_modules` (
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
) ENGINE=MyISAM AUTO_INCREMENT=598 DEFAULT CHARSET=utf8;

INSERT INTO `w_modules` VALUES ('12', '后台导航菜单', '', '4', 'menu', '1', 'mod_menu', '0', '1', 'menu_style=custom\nstartLevel=33\nendLevel=23\nshowAllChildren=1\nwindow_open=2好样的\n\n', '0', '1', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('13', '控制面板快捷菜单', '', '1', 'cleft', '1', 'mod_shortcutmenu', '0', '1', 'menu_style=custom\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=好样的\n\n', '0', '1', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('14', '快捷按钮', '', '1', 'status', '1', 'mod_status', '0', '1', 'menu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\n\n', '0', '1', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('195', '主菜单', '', '1', 'navigation', '1', 'mod_menu', '0', '1', 'menutype=1\nmenu_style=list\ndelkey=\nmoduleclass_sfx=\n\n', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('206', '版权信息', '<p>@2007-2010 GREE CORPORATION. ALL RIGHTS RESERVED. 格力集团股份有限公司版权所有 粤ICP备0568987-2号</p>', '6', 'footer', '1', 'mod_copyright', '0', '1', 'num_products=8\nshow_whitespace=0\ncache=1\n\n', '0', '0', '', '1', '1', '0', '0');
INSERT INTO `w_modules` VALUES ('593', '首页产品分类', '', '1', 'hlft', '1', 'mod_categorys', '0', '1', 'moduleclass_sfx=\n\n', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('580', '搜索框', '', '2', 'navigation', '0', 'mod_search', '0', '1', '', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('581', '产品快速链接', '', '1', 'banners', '1', 'mod_quicklinks', '0', '1', '', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('582', '顶部工具条内容', '', '2', 'top', '1', 'mod_topbar', '0', '1', '', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('583', '产品分类', '', '4', 'left', '1', 'mod_categorys', '0', '1', 'moduleclass_sfx=\n\n', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('584', '浏览历史记录', '', '5', 'left', '1', 'mod_history', '0', '1', '', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('585', '路径', '', '1', 'breadcrumbs', '1', 'mod_breadcrumbs', '0', '1', '', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('586', '会员菜单', '', '1', 'userleft', '1', 'mod_membermenu', '0', '1', '', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('587', '团购展示', '', '3', 'hcenter', '1', 'mod_buy', '0', '1', 'catid=0\n\n', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('207', 'LOGO', '', '4', 'header', '1', 'mod_logo', '0', '1', 'logo=/media/1/logo.gif\n\n', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('209', '显示会员信息', '', '3', 'left', '0', 'mod_user', '0', '1', 'num_products=8\nshow_whitespace=0\ncache=1\n\n', '0', '1', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('210', '管理底部信息', '', '2', 'footer', '1', 'mod_footer', '0', '1', 'num_products=8\nshow_whitespace=0\ncache=1\n\n', '0', '1', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('553', '版权信息', '', '4', 'footer', '1', 'mod_copyright', '0', '1', 'num_products=8\nshow_whitespace=0\ncache=1\n\n', '0', '2', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('579', '首页主图banner', '', '1', 'hcenter', '1', 'mod_banners', '0', '1', 'width=580\nheight=220\nshowway=0\ncatid=15\nnum=1\nshowtitle=0\ntitlelink=\nmoduleclass_sfx=\n\n', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('576', '新建 工具条', '', '1', 'top', '1', 'mod_topbar', '0', '1', '', '0', '2', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('577', '新建 企业LOGO', '', '3', 'header', '1', 'mod_logo', '0', '1', 'logo=\n\n', '0', '2', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('543', '底部Menu', '', '3', 'footer', '0', 'mod_menu', '0', '1', 'menutype=3\nmenu_style=list\ndelkey=\nmoduleclass_sfx=foot_menu\n\n', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('578', '友情链接', '', '1', 'footer', '1', 'mod_links', '0', '1', 'width=\nheight=\nshowway=1\ncatid=1\nnum=36\nshowtitle=0\nmoduleclass_sfx=\n\n', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('588', '最新资讯', '', '1', 'hrgt', '1', 'mod_latestarticle', '0', '1', 'num=6\ncatid=0\nlength=14\ncatlink=0\nshowauthor=0\ntitlelink=0\ntitle_sfx=\nmoduleclass_sfx=\n\n', '0', '0', '', '1', '0', '2', '20');
INSERT INTO `w_modules` VALUES ('589', '最新产品', '', '2', 'hlft', '1', 'mod_product', '0', '1', 'num_products=3\ncatid=0\nshowway=0\n\n', '0', '0', '', '1', '0', '2', '137');
INSERT INTO `w_modules` VALUES ('590', '热销产品', '', '4', 'main', '1', 'mod_product', '0', '1', 'num_products=10\ncatid=0\nshowway=1\n\n', '0', '0', '', '1', '0', '2', '137');
INSERT INTO `w_modules` VALUES ('591', '特价商品', '', '2', 'main', '1', 'mod_product', '0', '1', 'num_products=10\ncatid=0\nshowway=2\n\n', '0', '0', '', '1', '0', '0', '137');
INSERT INTO `w_modules` VALUES ('592', '底部快捷导航', '', '5', 'footer', '1', 'mod_quicknav', '0', '1', '', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('594', '首页插图1', '', '1', 'main', '1', 'mod_banners', '0', '1', 'width=980\nheight=110\nshowway=2\ncatid=16\nnum=1\nshowtitle=0\ntitlelink=\nmoduleclass_sfx=\n\n', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('595', '首页插图2', '', '3', 'main', '1', 'mod_banners', '0', '1', 'width=980\nheight=110\nshowway=2\ncatid=17\nnum=1\nshowtitle=0\ntitlelink=\nmoduleclass_sfx=\n\n', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('596', '限时抢购模块', '', '2', 'hcenter', '1', 'mod_limitedtime', '0', '1', 'catid=0\n\n', '0', '0', '', '1', '0', '0', '0');
INSERT INTO `w_modules` VALUES ('597', '秒杀活动展示模块', '', '2', 'hrgt', '1', 'mod_seckill', '0', '1', 'catid=0\n\n', '0', '0', '', '1', '0', '0', '0');
drop table if exists w_modules_menu;
CREATE TABLE `w_modules_menu` (
  `moduleid` int(11) NOT NULL default '0',
  `menuid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`moduleid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `w_modules_menu` VALUES ('16', '0');
INSERT INTO `w_modules_menu` VALUES ('17', '0');
INSERT INTO `w_modules_menu` VALUES ('18', '0');
INSERT INTO `w_modules_menu` VALUES ('19', '0');
INSERT INTO `w_modules_menu` VALUES ('21', '0');
INSERT INTO `w_modules_menu` VALUES ('22', '1');
INSERT INTO `w_modules_menu` VALUES ('22', '2');
INSERT INTO `w_modules_menu` VALUES ('22', '4');
INSERT INTO `w_modules_menu` VALUES ('22', '27');
INSERT INTO `w_modules_menu` VALUES ('22', '36');
INSERT INTO `w_modules_menu` VALUES ('25', '0');
INSERT INTO `w_modules_menu` VALUES ('27', '0');
INSERT INTO `w_modules_menu` VALUES ('28', '0');
INSERT INTO `w_modules_menu` VALUES ('29', '0');
INSERT INTO `w_modules_menu` VALUES ('30', '1');
INSERT INTO `w_modules_menu` VALUES ('31', '0');
INSERT INTO `w_modules_menu` VALUES ('32', '0');
INSERT INTO `w_modules_menu` VALUES ('33', '0');
INSERT INTO `w_modules_menu` VALUES ('34', '0');
INSERT INTO `w_modules_menu` VALUES ('35', '0');
INSERT INTO `w_modules_menu` VALUES ('36', '0');
INSERT INTO `w_modules_menu` VALUES ('38', '0');
INSERT INTO `w_modules_menu` VALUES ('39', '0');
INSERT INTO `w_modules_menu` VALUES ('40', '0');
INSERT INTO `w_modules_menu` VALUES ('45', '0');
INSERT INTO `w_modules_menu` VALUES ('50', '0');
INSERT INTO `w_modules_menu` VALUES ('51', '0');
INSERT INTO `w_modules_menu` VALUES ('52', '0');
INSERT INTO `w_modules_menu` VALUES ('53', '1');
INSERT INTO `w_modules_menu` VALUES ('54', '0');
INSERT INTO `w_modules_menu` VALUES ('59', '0');
INSERT INTO `w_modules_menu` VALUES ('60', '0');
INSERT INTO `w_modules_menu` VALUES ('61', '1');
INSERT INTO `w_modules_menu` VALUES ('62', '1');
INSERT INTO `w_modules_menu` VALUES ('63', '1');
INSERT INTO `w_modules_menu` VALUES ('64', '0');
INSERT INTO `w_modules_menu` VALUES ('65', '0');
INSERT INTO `w_modules_menu` VALUES ('66', '0');
INSERT INTO `w_modules_menu` VALUES ('67', '0');
INSERT INTO `w_modules_menu` VALUES ('68', '0');
INSERT INTO `w_modules_menu` VALUES ('69', '0');
INSERT INTO `w_modules_menu` VALUES ('70', '0');
INSERT INTO `w_modules_menu` VALUES ('71', '0');
INSERT INTO `w_modules_menu` VALUES ('72', '0');
INSERT INTO `w_modules_menu` VALUES ('73', '1');
INSERT INTO `w_modules_menu` VALUES ('74', '0');
INSERT INTO `w_modules_menu` VALUES ('75', '0');
INSERT INTO `w_modules_menu` VALUES ('76', '1');
INSERT INTO `w_modules_menu` VALUES ('77', '1');
INSERT INTO `w_modules_menu` VALUES ('78', '0');
INSERT INTO `w_modules_menu` VALUES ('79', '1');
INSERT INTO `w_modules_menu` VALUES ('80', '0');
INSERT INTO `w_modules_menu` VALUES ('81', '0');
INSERT INTO `w_modules_menu` VALUES ('82', '0');
INSERT INTO `w_modules_menu` VALUES ('83', '0');
INSERT INTO `w_modules_menu` VALUES ('84', '0');
INSERT INTO `w_modules_menu` VALUES ('85', '1');
INSERT INTO `w_modules_menu` VALUES ('86', '0');
INSERT INTO `w_modules_menu` VALUES ('87', '0');
INSERT INTO `w_modules_menu` VALUES ('88', '0');
INSERT INTO `w_modules_menu` VALUES ('90', '0');
INSERT INTO `w_modules_menu` VALUES ('91', '0');
INSERT INTO `w_modules_menu` VALUES ('92', '0');
INSERT INTO `w_modules_menu` VALUES ('93', '0');
INSERT INTO `w_modules_menu` VALUES ('94', '0');
INSERT INTO `w_modules_menu` VALUES ('95', '0');
INSERT INTO `w_modules_menu` VALUES ('96', '1');
INSERT INTO `w_modules_menu` VALUES ('97', '1');
INSERT INTO `w_modules_menu` VALUES ('98', '1');
INSERT INTO `w_modules_menu` VALUES ('99', '0');
INSERT INTO `w_modules_menu` VALUES ('100', '0');
INSERT INTO `w_modules_menu` VALUES ('195', '0');
INSERT INTO `w_modules_menu` VALUES ('202', '0');
INSERT INTO `w_modules_menu` VALUES ('206', '0');
INSERT INTO `w_modules_menu` VALUES ('207', '0');
INSERT INTO `w_modules_menu` VALUES ('208', '0');
INSERT INTO `w_modules_menu` VALUES ('248', '0');
INSERT INTO `w_modules_menu` VALUES ('249', '0');
INSERT INTO `w_modules_menu` VALUES ('541', '0');
INSERT INTO `w_modules_menu` VALUES ('542', '0');
INSERT INTO `w_modules_menu` VALUES ('543', '0');
INSERT INTO `w_modules_menu` VALUES ('544', '0');
INSERT INTO `w_modules_menu` VALUES ('545', '0');
INSERT INTO `w_modules_menu` VALUES ('546', '0');
INSERT INTO `w_modules_menu` VALUES ('547', '0');
INSERT INTO `w_modules_menu` VALUES ('548', '0');
INSERT INTO `w_modules_menu` VALUES ('549', '0');
INSERT INTO `w_modules_menu` VALUES ('550', '0');
INSERT INTO `w_modules_menu` VALUES ('551', '0');
INSERT INTO `w_modules_menu` VALUES ('552', '0');
INSERT INTO `w_modules_menu` VALUES ('553', '0');
INSERT INTO `w_modules_menu` VALUES ('554', '0');
INSERT INTO `w_modules_menu` VALUES ('555', '0');
INSERT INTO `w_modules_menu` VALUES ('556', '0');
INSERT INTO `w_modules_menu` VALUES ('557', '0');
INSERT INTO `w_modules_menu` VALUES ('558', '0');
INSERT INTO `w_modules_menu` VALUES ('559', '0');
INSERT INTO `w_modules_menu` VALUES ('560', '0');
INSERT INTO `w_modules_menu` VALUES ('561', '0');
INSERT INTO `w_modules_menu` VALUES ('562', '0');
INSERT INTO `w_modules_menu` VALUES ('563', '0');
INSERT INTO `w_modules_menu` VALUES ('564', '0');
INSERT INTO `w_modules_menu` VALUES ('565', '0');
INSERT INTO `w_modules_menu` VALUES ('566', '0');
INSERT INTO `w_modules_menu` VALUES ('567', '0');
INSERT INTO `w_modules_menu` VALUES ('568', '0');
INSERT INTO `w_modules_menu` VALUES ('569', '0');
INSERT INTO `w_modules_menu` VALUES ('570', '0');
INSERT INTO `w_modules_menu` VALUES ('571', '0');
INSERT INTO `w_modules_menu` VALUES ('572', '0');
INSERT INTO `w_modules_menu` VALUES ('573', '0');
INSERT INTO `w_modules_menu` VALUES ('574', '0');
INSERT INTO `w_modules_menu` VALUES ('575', '0');
INSERT INTO `w_modules_menu` VALUES ('576', '0');
INSERT INTO `w_modules_menu` VALUES ('577', '0');
INSERT INTO `w_modules_menu` VALUES ('579', '0');
INSERT INTO `w_modules_menu` VALUES ('580', '0');
INSERT INTO `w_modules_menu` VALUES ('581', '0');
INSERT INTO `w_modules_menu` VALUES ('582', '0');
INSERT INTO `w_modules_menu` VALUES ('583', '0');
INSERT INTO `w_modules_menu` VALUES ('584', '0');
INSERT INTO `w_modules_menu` VALUES ('585', '0');
INSERT INTO `w_modules_menu` VALUES ('586', '0');
INSERT INTO `w_modules_menu` VALUES ('587', '0');
INSERT INTO `w_modules_menu` VALUES ('588', '0');
INSERT INTO `w_modules_menu` VALUES ('589', '0');
INSERT INTO `w_modules_menu` VALUES ('590', '0');
INSERT INTO `w_modules_menu` VALUES ('591', '0');
INSERT INTO `w_modules_menu` VALUES ('592', '0');
INSERT INTO `w_modules_menu` VALUES ('593', '0');
INSERT INTO `w_modules_menu` VALUES ('594', '0');
INSERT INTO `w_modules_menu` VALUES ('595', '0');
INSERT INTO `w_modules_menu` VALUES ('596', '0');
INSERT INTO `w_modules_menu` VALUES ('597', '0');
drop table if exists w_navigations;
CREATE TABLE `w_navigations` (
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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

INSERT INTO `w_navigations` VALUES ('1', 'pages', '关于天亿', 'guanyutianyi', '', '', '7', '10', '0', '0', '89', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('2', 'pages', '关于我们', 'guanyuwomen', '', '', '3', '4', '0', '0', '89', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('3', 'pages', '产品目录', 'chanpinmulu', '', '', '1', '2', '0', '0', '89', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('20', 'products', '产品介绍', 'chanpinjieshao', '', '', '1', '2', '0', '0', '98', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('19', 'news', '推荐阅读', 'tuijianyuedu', '', '', '5', '6', '0', '0', '89', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('7', 'pages', '首页', 'shouye', '', '', '1', '2', '0', '0', '90', '', '', '0', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('8', 'pages', '公司简介', 'gongsijianjie', '', '', '3', '4', '0', '0', '90', '', '', '0', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('11', 'feedbacks', '留言板 ', 'liuyanban ', '', '', '11', '12', '0', '0', '89', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('12', 'products', '产品信息', 'chanpinxinxi', '', '', '8', '9', '1', '0', '89', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('13', 'news', '动态', 'dongtai', '', '', '13', '14', '0', '0', '89', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('14', 'products', '产品列表', 'chanpinliebiao', '', '', '3', '4', '0', '0', '1', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('17', 'company', '公司信息', 'gongsixinxi', '', '', '5', '6', '0', '0', '1', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('16', 'pages', '关于我们', 'guanyuwomen', '', '', '1', '2', '0', '0', '1', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('18', 'feedbacks', '客户留言', 'kehuliuyan', '', '', '7', '8', '0', '0', '1', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('21', 'pages', '公司简介', 'gongsijianjie', '', '', '3', '4', '0', '0', '98', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('22', 'company', '公司信息', 'gongsixinxi', '', '', '5', '6', '0', '0', '98', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('23', 'company', '公司介绍', 'gongsijieshao', '', '', '1', '2', '0', '0', '103', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('24', 'products', '供应产品', 'gongyingchanpin', '', '', '3', '4', '0', '0', '103', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('25', 'news', '公司博客', 'gongsiboke', '', '', '5', '6', '0', '0', '103', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('26', 'feedbacks', '客户反馈', 'kehufankui', '', '', '7', '8', '0', '0', '103', '', '', '1', '0', '', '', '0');
INSERT INTO `w_navigations` VALUES ('27', 'pages', '联系我们', 'lianxiwomen', '', '', '9', '10', '0', '0', '103', '', '', '1', '0', '', '', '0');
drop table if exists w_navigations_des;
CREATE TABLE `w_navigations_des` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL default '',
  `fulltext` mediumtext NOT NULL,
  `hits` int(11) unsigned NOT NULL default '0',
  `uid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `w_navigations_des` VALUES ('1', '', '<p>asdfasfd</p>', '0', '89');
INSERT INTO `w_navigations_des` VALUES ('3', '', '<p>asfdasfd</p>', '0', '89');
INSERT INTO `w_navigations_des` VALUES ('16', '', '<p>asfdasfdasfdasfd</p>', '0', '1');
INSERT INTO `w_navigations_des` VALUES ('21', '', '<p>asfdasfdasfd</p>', '0', '98');
drop table if exists w_news;
CREATE TABLE `w_news` (
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `w_news` VALUES ('7', '怎样之市场营销计划能获得老板认同？', '<p>在大多数老板眼里，市场营销部门是花钱的主，销售部才是赚钱的机器。所以我们常常见到一个公司有一大堆销售人员，少有市场营销人员。</p>\r\n<p>如果您负责市场营销，您可要小心，您在公司获得的支持远比销售部弱。</p>\r\n<p>营销工作，计划先行。策略性地规划您每一份营 销计划，最大程度地获得上司认同和支持。</p>\r\n<p>首先，您得向公司的老板、其他部门经理、您周围的所有人灌输一个正确的理念，那就是，</p>\r\n<p><b>市场营销的投入不能只看作生意运作的成本，更应被认为是一种市场投资。它有投入、有产出，有投资回报，也存在风险。</b></p>\r\n<p>其次，营销计划必须说明对公司财务的影响。譬如营销投入后，公司的销售预期有怎样的增长，用户数、客户数会有怎样的增长。</p>\r\n<p>对应一个市场活动对销售的影响非常困难，可是从长远来看，市场营销对整体销售的贡献显而易见。</p>\r\n<p>第三，市 场营销计划必须直观明确，尤其是投入产出风险机会等关键点。如何让人相信，投入一份将有两份三份的回报。让老板一目了然、心动并支持您的行动。</p>\r\n<p>第四，营销计划必须是周密的，并且文笔有煽动性，使人读来心动又可信。好的有吸引力的标 题、创新想法、清晰思路，正确的操作，如怎样的工具技术被运用，如何丈量、控制过程。营销对现有市场产生怎样的影响。</p>\r\n<p>正如前面所说，市场营销是一种投资，好的市场营销计划好似周详的投资计划，可能它没有商业计划书那样面面俱到，但同样需要您的智慧、策略和手段。</p>\r\n<p>获得老板的支持花钱做市场决不是一件容易的事。如果您觉得力不从心，不妨找专业公司协助您一起做市场营销计划，实现您的营销梦想。</p>', '1', '0', '19', '2010-06-29 09:50:52', '2010-06-29 09:52:29', '0', '', '', '0', '89');
drop table if exists w_order;
CREATE TABLE `w_order` (
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
  `total_deposit` decimal(10,2) NOT NULL default '0.00',
  `postage` varchar(50) default NULL COMMENT '货运方式',
  `pay` varchar(50) default NULL COMMENT '支付方式',
  `remark` varchar(255) default NULL COMMENT '说明',
  `shipping_free` decimal(10,2) NOT NULL default '0.00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

drop table if exists w_order_action;
CREATE TABLE `w_order_action` (
  `action_id` mediumint(8) unsigned NOT NULL auto_increment,
  `order_id` mediumint(8) unsigned NOT NULL default '0',
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `action_user` varchar(30) NOT NULL default '',
  `behavior` varchar(20) default NULL,
  `action_note` varchar(255) NOT NULL default '',
  `log_time` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`action_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

INSERT INTO `w_order_action` VALUES ('25', '17', '0', 'admin', '0', '', '1245048189');
INSERT INTO `w_order_action` VALUES ('26', '17', '0', 'admin', '0', '退货', '1245048212');
INSERT INTO `w_order_action` VALUES ('27', '19', '0', 'admin', '0', '', '1245384050');
INSERT INTO `w_order_action` VALUES ('28', '17', '0', 'admin', '0', 'asdfasdf', '1299744786');
INSERT INTO `w_order_action` VALUES ('29', '17', '0', 'admin', '0', 'asdf', '1299744796');
INSERT INTO `w_order_action` VALUES ('30', '17', '0', 'admin', '0', '[售后] asfdasdf', '1299744807');
INSERT INTO `w_order_action` VALUES ('31', '17', '0', 'admin', '0', 'sadfadf', '1299744818');
INSERT INTO `w_order_action` VALUES ('32', '18', '0', 'admin', '0', 'asdfasdf', '1299824523');
INSERT INTO `w_order_action` VALUES ('33', '18', '0', 'admin', '0', 'asfd', '1299824534');
INSERT INTO `w_order_action` VALUES ('34', '18', '0', 'admin', '0', '[售后] asdf', '1299824611');
INSERT INTO `w_order_action` VALUES ('35', '18', '0', 'admin', '0', '[售后] asdfsad', '1299824619');
INSERT INTO `w_order_action` VALUES ('36', '17', '0', 'admin', '0', 'asdf', '1299825102');
INSERT INTO `w_order_action` VALUES ('37', '17', '0', 'admin', '0', 'asdfasdf', '1299825122');
INSERT INTO `w_order_action` VALUES ('38', '17', '0', 'admin', '1', 'sadf', '1299825176');
INSERT INTO `w_order_action` VALUES ('39', '19', '0', 'admin', '0', 'asfsad', '1299825212');
INSERT INTO `w_order_action` VALUES ('40', '19', '0', 'admin', '0', 'asfda', '1299825510');
INSERT INTO `w_order_action` VALUES ('41', '19', '0', 'admin', '0', 'asdf', '1299826689');
INSERT INTO `w_order_action` VALUES ('44', '17', '0', 'admin', '0', 'asdfasdf', '1299826971');
drop table if exists w_order_goods;
CREATE TABLE `w_order_goods` (
  `product_id` int(11) NOT NULL default '0',
  `order_id` int(11) NOT NULL default '0',
  `product_name` varchar(60) default NULL,
  `product_thumb` varchar(255) default NULL COMMENT '产品缩略图',
  `product_quanlity` int(4) default NULL,
  `product_price` int(4) default NULL,
  `uid` int(11) NOT NULL default '0',
  `params` text,
  `iscomment` tinyint(1) NOT NULL default '0',
  `send_number` tinyint(4) NOT NULL default '0' COMMENT '已发货',
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `w_order_goods` VALUES ('221', '1', '格力(GREE) 变频空调 凯迪斯KFR-32GW/(32556)FNPa-4', '/media/1/products/1298447087.jpg', '2', '900', '89', 'a:1:{s:6:\"params\";s:6:\"团购\";}', '0', '0');
INSERT INTO `w_order_goods` VALUES ('221', '2', '格力(GREE) 变频空调 凯迪斯KFR-32GW/(32556)FNPa-4', '/media/1/products/1298447087.jpg', '1', '900', '89', 'a:1:{s:6:\"params\";s:6:\"团购\";}', '0', '0');
INSERT INTO `w_order_goods` VALUES ('221', '3', '格力(GREE) 变频空调 凯迪斯KFR-32GW/(32556)FNPa-4', '/media/1/products/1298447087.jpg', '1', '900', '89', 'a:1:{s:6:\"params\";s:6:\"团购\";}', '0', '0');
INSERT INTO `w_order_goods` VALUES ('221', '4', '格力(GREE) 变频空调 凯迪斯KFR-32GW/(32556)FNPa-4', '/media/1/products/1298447087.jpg', '1', '900', '89', 'a:1:{s:6:\"params\";s:6:\"团购\";}', '0', '0');
INSERT INTO `w_order_goods` VALUES ('221', '5', '格力(GREE) 变频空调 凯迪斯KFR-32GW/(32556)FNPa-4', '/media/1/products/1298447087.jpg', '1', '900', '89', 'a:1:{s:6:\"params\";s:6:\"团购\";}', '0', '0');
INSERT INTO `w_order_goods` VALUES ('221', '6', '格力(GREE) 变频空调 凯迪斯KFR-32GW/(32556)FNPa-4', '/media/1/products/1298447087.jpg', '1', '900', '109', 'a:1:{s:6:\"params\";s:6:\"团购\";}', '0', '0');
INSERT INTO `w_order_goods` VALUES ('426', '7', '格力电暖器 NSW-8  二管 石英管 取暖器', '/media/1/products/1299143354-1_s.jpg', '1', '50', '109', 'a:4:{s:6:\"params\";b:0;s:4:\"pays\";s:1:\"1\";s:5:\"price\";s:3:\"100\";s:12:\"actual_price\";N;}', '1', '0');
INSERT INTO `w_order_goods` VALUES ('221', '8', '格力(GREE) 变频空调 凯迪斯KFR-32GW/(32556)FNPa-4', '/media/1/products/1298447087.jpg', '1', '900', '1', 'a:1:{s:6:\"params\";s:6:\"团购\";}', '0', '0');
INSERT INTO `w_order_goods` VALUES ('426', '9', '格力电暖器 NSW-8  二管 石英管 取暖器', '/media/1/products/1299143354-1_s.jpg', '10', '50', '1', 'a:4:{s:6:\"params\";b:0;s:4:\"pays\";s:1:\"1\";s:5:\"price\";s:3:\"100\";s:12:\"actual_price\";N;}', '0', '0');
INSERT INTO `w_order_goods` VALUES ('289', '9', '格力SC-1501 天籁超声波 加湿器青花瓷外观 缺水自动断电', '/media/1/products/1298860547_s.jpg', '9', '0', '1', 'a:4:{s:6:\"params\";b:0;s:4:\"pays\";s:1:\"1\";s:5:\"price\";s:3:\"100\";s:12:\"actual_price\";N;}', '0', '0');
INSERT INTO `w_order_goods` VALUES ('289', '10', '格力SC-1501 天籁超声波 加湿器青花瓷外观 缺水自动断电', '/media/1/products/1298860547_s.jpg', '1', '0', '1', 'a:4:{s:6:\"params\";b:0;s:4:\"pays\";s:1:\"1\";s:5:\"price\";s:3:\"100\";s:12:\"actual_price\";N;}', '0', '0');
INSERT INTO `w_order_goods` VALUES ('426', '11', '格力电暖器 NSW-8  二管 石英管 取暖器', '/media/1/products/1299143354-1_s.jpg', '1', '50', '109', 'a:4:{s:6:\"params\";b:0;s:4:\"pays\";s:1:\"1\";s:5:\"price\";s:3:\"100\";s:12:\"actual_price\";N;}', '1', '0');
INSERT INTO `w_order_goods` VALUES ('426', '12', '格力电暖器 NSW-8  二管 石英管 取暖器', '/media/1/products/1299143354-1_s.jpg', '1', '50', '109', 'a:4:{s:6:\"params\";b:0;s:4:\"pays\";s:1:\"1\";s:5:\"price\";s:3:\"100\";s:12:\"actual_price\";N;}', '1', '0');
INSERT INTO `w_order_goods` VALUES ('424', '12', '格力电油汀取暖器NDY20K送加湿盒晾衣架', '/media/1/products/1299141517_s.jpg', '1', '200', '109', 'a:4:{s:6:\"params\";b:0;s:4:\"pays\";s:1:\"1\";s:5:\"price\";s:3:\"100\";s:12:\"actual_price\";N;}', '1', '0');
INSERT INTO `w_order_goods` VALUES ('426', '13', '格力电暖器 NSW-8  二管 石英管 取暖器', '/media/1/products/1299143354-1_s.jpg', '1', '50', '1', 'a:4:{s:6:\"params\";b:0;s:4:\"pays\";s:1:\"1\";s:5:\"price\";s:3:\"100\";s:12:\"actual_price\";N;}', '0', '0');
INSERT INTO `w_order_goods` VALUES ('425', '14', '格力 NTSA-7 取暖器 格力电暖器 格力红外线取暖器', '/media/1/products/1299141949_s.jpg', '1', '200', '1', 'a:4:{s:6:\"params\";b:0;s:4:\"pays\";s:1:\"1\";s:5:\"price\";s:3:\"100\";s:12:\"actual_price\";N;}', '0', '0');
INSERT INTO `w_order_goods` VALUES ('152', '15', '格力(GREE) 变频空调 睡美人(金色)  KFR-26GW/E(26541)', '/media/1/products/1298341076_s.jpg', '1', '2666', '118', 'a:4:{s:6:\"params\";b:0;s:4:\"pays\";s:1:\"1\";s:5:\"price\";s:3:\"100\";s:12:\"actual_price\";N;}', '0', '0');
INSERT INTO `w_order_goods` VALUES ('156', '16', '格力U酷 定频超溥空调 KFR-23GW/(23561)Ca-2', '/media/1/products/1298347027_s.jpg', '1', '1', '109', 'a:4:{s:6:\"params\";s:11:\"1匹,银色\";s:4:\"pays\";s:1:\"1\";s:5:\"price\";s:3:\"100\";s:12:\"actual_price\";s:1:\"1\";}', '0', '0');
drop table if exists w_pages;
CREATE TABLE `w_pages` (
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO `w_pages` VALUES ('7', '', '', '<p>\r\n	<span style=\"color: rgb(255, 0, 0); font-weight: bold;\">UI58.com&nbsp;</span> 专注于提供优秀的网站欣赏，网址个性收藏，定义个性导航页面。</p>\r\n', '0', '24', '', '', '', '', '0', '', '1');
INSERT INTO `w_pages` VALUES ('8', '', '', '<p>\r\n	<strong>1，UI58提供那些功能？</strong></p>\r\n<p>\r\n	答： 主要提供自定义网址导航功能，和优秀网站收藏的功能。</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<strong>2，怎样拥有自己的网址导航？</strong></p>\r\n<p>\r\n	答： 首先注册一个用户，然后进入我的导航，添加一个分组，在分组框的右下方有个添加网址的按钮，点击后，可添加自己的网址，多个网址和分组可拖动排序。</p>\r\n<p>\r\n	<strong><br />\r\n	</strong></p>\r\n<p>\r\n	<strong>3，如何选择个性的皮服？</strong></p>\r\n<p>\r\n	答：会员登陆后可以看到换皮服的按钮，点击后，可以选择自己喜欢的皮服，再应用即可。</p>\r\n', '0', '32', '', '', '', '', '0', '', '1');
INSERT INTO `w_pages` VALUES ('9', '', '', '<p>asfdasfd</p>\r\n<hr />\r\n<p><img src=\"/plugins/editors/fckeditor_2_6/editor/images/smiley/26.gif\" alt=\"\" /><img src=\"/plugins/editors/fckeditor_2_6/editor/images/smiley/32.gif\" alt=\"\" /></p>', '0', '15', '', '', '', '', '0', '', '1');
INSERT INTO `w_pages` VALUES ('11', '', '', '<p>adfadf</p>', '0', '419', '', '', '', '', '0', '', '1');
drop table if exists w_pages_description;
CREATE TABLE `w_pages_description` (
  `menu_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '1',
  `content` text,
  PRIMARY KEY  (`menu_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `w_pages_description` VALUES ('354', '2', '');
INSERT INTO `w_pages_description` VALUES ('354', '3', '');
INSERT INTO `w_pages_description` VALUES ('354', '4', '<p>\r\n	asdf22</p>\r\n');
INSERT INTO `w_pages_description` VALUES ('15', '2', '');
INSERT INTO `w_pages_description` VALUES ('15', '3', '');
INSERT INTO `w_pages_description` VALUES ('7', '2', '');
INSERT INTO `w_pages_description` VALUES ('7', '3', '');
INSERT INTO `w_pages_description` VALUES ('380', '2', '');
INSERT INTO `w_pages_description` VALUES ('380', '3', '<p>asdfasdf</p>');
INSERT INTO `w_pages_description` VALUES ('408', '2', '');
INSERT INTO `w_pages_description` VALUES ('408', '3', '');
INSERT INTO `w_pages_description` VALUES ('407', '2', '');
INSERT INTO `w_pages_description` VALUES ('407', '3', '');
drop table if exists w_payments;
CREATE TABLE `w_payments` (
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

drop table if exists w_plugins;
CREATE TABLE `w_plugins` (
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
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

INSERT INTO `w_plugins` VALUES ('6', 'Search - Content', 'content', 'search', '0', '1', '1', '1', '0', '0', '0000-00-00 00:00:00', 'search_limit=50\nsearch_content=1\nsearch_uncategorised=1\nsearch_archived=1\n\n');
INSERT INTO `w_plugins` VALUES ('8', '支付宝', 'alipay', 'pay', '0', '4', '1', '0', '0', '0', '0000-00-00 00:00:00', 'accout=13530253280\nkey=x0tibk2qs2ubq2wq8x4t7j19dw9q4yer\npartner=2088302448712140\nrates=1%\ndesc=支付宝作为诚信中立的第三方机构，充分保障货款安全及买卖双方利益,支持各大银行网上支付。\n\n');
INSERT INTO `w_plugins` VALUES ('33', '财付通', 'tenpay', 'pay', '0', '7', '1', '1', '0', '0', '0000-00-00 00:00:00', 'accout=12341234\nkey=\nrates=\ndesc=腾讯旗下在线支付平台，支持各大银行网上支付 \n\n');
INSERT INTO `w_plugins` VALUES ('34', '快钱', '99bill', 'pay', '0', '1', '0', '0', '0', '0', '2009-07-31 15:27:02', 'accout=123412\nkey=\nrates=\ndesc=快钱旗下在线支付平台，支持各大银行网上支付\n\n');
INSERT INTO `w_plugins` VALUES ('36', 'Editor - FCKEditor', 'fckeditor', 'editors', '0', '4', '1', '0', '0', '0', '0000-00-00 00:00:00', 'theme=advanced\n');
INSERT INTO `w_plugins` VALUES ('37', 'wpagebreak', 'wpagebreak', 'content', '0', '3', '1', '0', '0', '0', '0000-00-00 00:00:00', 'enable=1\n\n');
INSERT INTO `w_plugins` VALUES ('38', '相关文章列表', 'related', 'content', '0', '6', '1', '0', '0', '0', '0000-00-00 00:00:00', 'count=12\n\n');
INSERT INTO `w_plugins` VALUES ('39', '文章天亿标志', 'articledaybillion', 'content', '0', '2', '1', '0', '0', '0', '0000-00-00 00:00:00', 'count=10\n\n');
INSERT INTO `w_plugins` VALUES ('40', 'ucenter for daybillion 会员同步接口', 'user_ucenter', 'authentication', '0', '0', '1', '0', '0', '0', '0000-00-00 00:00:00', 'uc_dbhost=localhost\nuc_dbuser=root\nuc_dbpw=test\nuc_dbname=test_dzhome\nuc_dbtablepre=uc_\nuc_key=123456\nuc_api=http://localhost:60001/ucenter\nuc_appid=3\nuc_client_php=home/uc_client/client.php\n\n');
INSERT INTO `w_plugins` VALUES ('41', 'Ucenter 会员登陆插件', 'ucenter', 'user', '0', '0', '1', '0', '0', '0', '0000-00-00 00:00:00', '');
INSERT INTO `w_plugins` VALUES ('42', 'admincache', 'admincache', 'cache', '0', '0', '1', '0', '0', '0', '0000-00-00 00:00:00', '');
drop table if exists w_products;
CREATE TABLE `w_products` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(60) NOT NULL COMMENT '产品名称',
  `introtext` mediumtext COMMENT '产品简介',
  `fulltext` text,
  `packaging` mediumtext COMMENT '包装清单',
  `model` varchar(200) default NULL COMMENT '产品详细信息',
  `shop_price` float(8,2) default NULL COMMENT '价格',
  `market_price` float(8,2) NOT NULL default '0.00' COMMENT '市场价',
  `weight` decimal(10,2) NOT NULL default '0.00' COMMENT '重量',
  `store` mediumint(8) NOT NULL default '0' COMMENT '库存',
  `sales` mediumint(8) unsigned NOT NULL default '0',
  `give_integral` mediumint(4) unsigned NOT NULL default '0',
  `market_time` date NOT NULL,
  `price_s` float default NULL COMMENT '不低于的价格',
  `price_e` float default NULL COMMENT '不高于的价格',
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
  `access` int(11) unsigned NOT NULL default '0' COMMENT '访问级别',
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
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

INSERT INTO `w_products` VALUES ('1', '电磁炉', '', '<p>主要功能特点：</p>\r\n<p>◆ 复底强聚磁均磁线盘<br />\r\n◆ 外观设计简洁大方，台嵌两用专用火锅电磁炉<br />\r\n◆ 1900W高效火力，人多火更旺<br />\r\n◆ 线控操作随心所欲<br />\r\n◆ 法国技术防滑黑晶板、外观大方、耐磨、抗冲击、不变色<br />\r\n◆ 超宽工作电压<br />\r\n◆ 十种自动保护检测功能：过压/欠压/器件故障保护/过热/超时/超温 /延时散热保护/浪涌自动保护/无锅具检测/小物体检测/安全可靠 <br />\r\n<br />\r\n<font><font><font><font><font size=\"1\"><font color=\"#000000\"><font style=\"background-color: rgb(255, 255, 255);\"><font size=\"1\"><strong><font size=\"4\">基本参数：</font></strong><span style=\"font-size: 15pt;\"><br />\r\n<font size=\"4\">额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：1900W<br />\r\n毛重：2.9KG</font></span></font></font></font></font></font></font></font></font></p>\r\n<p><img src=\"/media/1/products/T2liNxXfRXXXXXXXXX_!!423452989.jpg\" alt=\"\" /><br />\r\n<br />\r\n<img src=\"/media/1/products/T2lIxXXjdaXXXXXXXX_!!325409321.jpg\" alt=\"\" /><br />\r\n<br />\r\n<img src=\"/media/1/products/T23ZBXXadaXXXXXXXX_!!325409321.jpg\" alt=\"\" /></p>', '', 'GCT-1900', '0.00', '260.00', '0.00', '0', '0', '0', '0000-00-00', '201', '300', '', '0', '0', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298357616_s.jpg', '/media/1/products/1298357616.jpg|1', '', '', '', '32', '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', '0', '0', '20', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('2', '电磁炉', '', '<p>主要功能特点：<br />\r\n◆ 复底强聚磁均磁线盘<br />\r\n◆ RAINTRY朗钻黑晶板、外观大方、耐磨、抗冲击、不变色<br />\r\n◆ 火锅、煎炸、炒菜、煲汤、煲粥、蒸煮、童锁等七大功能<br />\r\n◆ 2600W超大功率、猛火爆炒、多档自由调节、美味随心<br />\r\n◆ 四位数码管、LED显示一目了然<br />\r\n◆ 高档优质微晶板、外观大方、柔美、耐磨、抗冲击、不变色 <br />\r\n◆ 24小时定时、24小时预约功能、控时精准、使用更方便 <br />\r\n◆ 特设童锁，人性化设计，多一份关心保护 <br />\r\n◆ 十种自动保护检测功能：过压/欠压/器件故障保护/过热/超时/超温/延时散热保护/浪涌自动保护/无锅具检测/小物体检测/安全可靠<br />\r\n<br />\r\n<img src=\"/media/1/products/GC-21600.jpg\" alt=\"\" /></p>', '', 'GC-21600', '0.00', '500.00', '0.00', '0', '0', '0', '0000-00-00', '300', '500', '', '0', '0', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298358872_s.jpg', '/media/1/products/1298358872.jpg|1', '', '', '', '33', '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', '0', '0', '2', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('3', '电磁炉', '', '<p>主要功能特点：</p>\r\n<p>◆ 复底强聚磁均磁线盘<br />\r\n◆ 法国技术彩晶透明板，时尚美观耐温高，高档耐用<br />\r\n◆ 创新性数码显示设定功率或温度，火力LED指示实际加热功率 <br />\r\n◆ 创新性各功能可定时可预约，烹饪更方便、更快捷<br />\r\n◆ 火锅、炒菜、温奶、煲汤、煲粥、蒸煮、定时、预约、火力调节九种智能厨艺功能<br />\r\n◆ 无锅自动保护，独到的防干烧保护<br />\r\n◆ 多种功能故障自动检测，电磁炉使用更安全<br />\r\n◆ 采用优质品牌微电脑控制芯片，更可靠，更省心<br />\r\n◆ 24小时定时、24小时预约功能<br />\r\n◆ 十种自动保护检测功能：过压/欠压/器件故障保护/过热/超时/超温/延时散热保护/浪涌自动保护/无锅具检测/小物体检测/安全可靠</p>\r\n<p><img alt=\"\" src=\"/media/1/products/GC-2160.jpg\" /><br />\r\n<br />\r\n<img alt=\"\" src=\"/media/1/products/T2lIxXXjdaXXXXXXXX_!!325409321.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/T2NsBXXcxaXXXXXXXX_!!325409321.jpg\" /></p>', '', 'GC-2160', '0.00', '457.00', '0.00', '0', '0', '0', '0000-00-00', '400', '500', '', '0', '0', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298359288_s.jpg', '/media/1/products/1298359288.jpg', '', '', '', '34', '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', '0', '0', '3', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('4', '电磁炉', '', '<p><strong>主要功能特点：<br />\r\n</strong></p>\r\n<p>◆ 复底强聚磁均磁线盘<br />\r\n◆ RAINTRY朗钻黑晶板、外观大方、耐磨、抗冲击、不变色<br />\r\n◆ 火锅、温奶、爆炒、煲汤、煲粥、蒸煮、童锁等七大功能<br />\r\n◆ 2100W爆炒火力、多档自由调节、烹饪无限制<br />\r\n◆ 四位数码管、LED显示一目了然<br />\r\n◆ 纯平触摸式感应控制、时尚大方、舞动自由<br />\r\n◆ 自动卷线功能、无&ldquo;牵挂&rdquo;、方便省心<br />\r\n◆ 2小时定时、24小时预约功能、控时精准、使用更方便 <br />\r\n◆ 特设童锁，人性化设计，多一份关心保护 <br />\r\n◆ 十种自动保护检测功能：过压/欠压/器件故障保护/过热/超时/超温 /延时散热保护/浪涌自动保护/无锅具检测/小物体检测/安全可靠  <br />\r\n<br />\r\n<img src=\"/media/1/products/20095161211494295.jpg\" alt=\"\" /><br />\r\n<img src=\"/media/1/products/T2lIxXXjdaXXXXXXXX_!!325409321.jpg\" alt=\"\" /><br />\r\n<img src=\"/media/1/products/325409321.jpg\" alt=\"\" /></p>', '', 'GC-2108', '0.00', '439.00', '0.00', '0', '0', '0', '0000-00-00', '400', '500', '', '0', '0', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298359962_s.jpg', '/media/1/products/1298359962.jpg|1', '', '', '', '35', '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', '0', '0', '13', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('5', '电磁炉', '', '<p><strong>主要功能特点：<br />\r\n</strong></p>\r\n<p>◆ 复底强聚磁均磁线盘<br />\r\n◆ 四位数码显示，工作状态一目了然<br />\r\n◆ RAINTRY朗钻黑晶板、外观大方、耐磨、抗冲击、不变色 <br />\r\n◆ 2100W爆炒火力，爆炒随心所欲<br />\r\n◆ 面贴采用大按键，防滑凸点人性化设计 <br />\r\n◆ 爆炒、火锅、温奶、煲粥、蒸煮、煲汤、煎炸等七大功能<br />\r\n◆ 2小时定时、24小时预约功能，使用更方便<br />\r\n◆ 多重故障检知功能，使用更安全可靠<br />\r\n◆ 特设童锁，给您的孩子多一层保护<br />\r\n◆ 十种自动保护检测功能：过压/欠压/器件故障保护/过热/超时/超温<br />\r\n/延时散热保护/浪涌自动保护/无锅具检测/小物体检测/安全可靠 <br />\r\n<br />\r\n<img src=\"/media/1/products/T1fKFBXflnXXbVrwPa_091240.jpg_310x310.jpg\" alt=\"\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/T2lIxXXjdaXXXXXXXX_!!325409321.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/325409321.jpg\" /></p>', '', 'GC-2106', '0.00', '315.00', '0.00', '0', '0', '0', '0000-00-00', '300', '500', '', '0', '0', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298360947_s.jpg', '/media/1/products/1298360947.jpg|1', '', '', '', '37', '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', '0', '0', '11', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('6', '电磁炉', '', '<p><strong><br />\r\n</strong><strong>GC-2091功能描述：</strong><br />\r\n<br />\r\n★耐高温、抗冲击、超大进口技术朗钻优质优质黑晶面板<br />\r\n★面贴采用大按键，防滑人性化设计<br />\r\n★多段火力调节，烹饪功能齐全<br />\r\n★多重故障检知保护功能，更安全可靠<br />\r\n★超宽电压110V～273V设计<br />\r\n★独特定温煎炸功能、炸出美味<br />\r\n★三级能效控制，用户烹饪更实惠,独特的风道设计,噪音低,带来优雅的烹饪环境<br />\r\n★人性化设计开机默认功率1200W、烹饪省心<br />\r\n★最低100W功率加热，思用户所需 <br />\r\n<br />\r\n<img alt=\"\" src=\"/media/1/products/T1pdBBXlRBXXa5Rw33_050206.jpg_310x310.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/T2lIxXXjdaXXXXXXXX_!!325409321.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/325409321.jpg\" /></p>', '', 'GC-2091', '0.00', '249.00', '0.00', '0', '0', '0', '0000-00-00', '200', '300', '', '0', '0', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298361394_s.jpg', '/media/1/products/1298361394.jpg|1', '', '', '', '38', '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', '0', '0', '12', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('7', '电磁炉', '', '<p><strong><br />\r\n</strong><strong>GC-2172功能描述：</strong><br />\r\n<br />\r\n★功率2100W、三级能效控制，用户烹饪更实惠<br />\r\n★4位数码显示,工作状态一目了然<br />\r\n★采用进口技术朗钻优质防滑，耐高温,耐磨,抗冲击,不变色,外观大方的黑晶板<br />\r\n★煲汤,煲粥,爆炒,火锅等烹饪功能<br />\r\n★24小时定时,预约功能,控时精准,使用更方便<br />\r\n★童锁功能人性化设计,令家人倍感呵护；无锅自动保护，独特的防干烧保护<br />\r\n★采用优质品牌微电脑控制芯片,更可靠,更省心<br />\r\n★超宽电压110V～273V设计<br />\r\n★纯平触摸式整板感应控制，时尚大方<br />\r\n★独特的风道设计,噪音低,带来优雅的烹饪环境；400W-2100W功率可调，采用复底强聚磁磁线圈盘<br />\r\n★十重自动保护检测功能：过压/欠压/器件故障保护/过热/超时/超温/智能测温散热保护/浪涌自动保护/无锅具检测/小物体检测<br />\r\n<br />\r\n基本参数:<br />\r\n额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：2100W<br />\r\n毛重：5.96KG<br />\r\n<br />\r\n<img src=\"/media/1/products/T1rtFBXdFAXXciXhQ3_050305.jpg_310x310.jpg\" alt=\"\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/T2lIxXXjdaXXXXXXXX_!!325409321.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/325409321.jpg\" /></p>', '', 'GC-2172', '0.00', '288.00', '0.00', '0', '0', '0', '0000-00-00', '200', '300', '', '0', '0', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298361969_s.jpg', '/media/1/products/1298361969.jpg|1', '', '', '', '39', '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', '0', '0', '12', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('8', '电磁炉', '', '<p>null</p>', '', 'GC-2105', '0.00', '459.00', '0.00', '0', '0', '0', '0000-00-00', '0', '0', '', '0', '0', '1', '0', '0000-00-00 00:00:00', '2011-04-15 09:08:01', '/media/1/products/1298362672_s.jpg', '/media/1/products/1298362671.jpg,/media/1/products/1298362672.jpg|1', '', 'a:2:{s:4:\"attr\";a:0:{}s:4:\"aimg\";N;}', 'a:0:{}', '36', '电磁炉，厨房电器', '电磁炉，厨房电器，生活电器', '', '0', '0', '13', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('9', '电饭煲', '', '<p>功能说明：<br />\r\n1、螺纹聚能式高效发热盘；<br />\r\n2、智能微电脑控制，超大液晶显示介面；<br />\r\n3、原生态精钢鼎不锈钢复合内锅，无涂层更健康，更多内锅任您选；<br />\r\n4、24小时定时预约，炊煮更方便；<br />\r\n5、特有停电记忆功能，炊煮更无忧；<br />\r\n6、蒸煮、炖汤、蛋糕、煲仔饭等多种炊煮方式；<br />\r\n7、IMD整体注塑豪华大面板，美观大方耐用；<br />\r\n8、创新保洁功能，防霉去异味；<br />\r\n9、彩色装饰板，外观清新靓丽；<br />\r\n10、特有易拆洗接水盒，清洁更方便；<br />\r\n11、特有易拆洗保温盖板，去除污渍更方便；<br />\r\n12、创新式小球微压蒸汽阀，有效防溢保湿。</p>\r\n<p>创新式小球微压蒸汽阀 有效防溢保湿 另外加送内锅一个，一锅双胆！</p>\r\n<p>&nbsp;</p>\r\n<p align=\"center\"><img src=\"/media/1/products/GDF-302CB.jpg\" alt=\"\" /><br />\r\n<br />\r\n<br />\r\n<img src=\"/media/1/products/GDF-302CB-4.jpg\" alt=\"\" /><br />\r\n<img src=\"/media/1/products/GDF-302CB-2.jpg\" alt=\"\" /><br />\r\n<br />\r\n<br />\r\n<img src=\"/media/1/products/GDF-302CB-3.jpg\" alt=\"\" /></p>', '', 'GDF-302CB', '0.00', '510.00', '0.00', '0', '0', '0', '0000-00-00', '250', '600', '', '0', '0', '2', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298364741_s.jpg', '/media/1/products/1298364741.jpg|1,/media/1/products/1298364744.jpg,/media/1/products/1298364780.jpg,/media/1/products/1298365034.jpg', '', '', '', '47', '', '', '', '0', '0', '10', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('10', '电饭煲', '', '<p>功能说明：<br />\r\n1、螺纹聚能式高效发热盘；<br />\r\n2、智能微电脑控制，超大液晶显示介面；<br />\r\n3、原生态精钢鼎不锈钢复合内锅，无涂层更健康，更多内锅任您选；<br />\r\n4、24小时定时预约，炊煮更方便；<br />\r\n5、特有停电记忆功能，炊煮更无忧；<br />\r\n6、蒸煮、炖汤、蛋糕、煲仔饭等多种炊煮方式；<br />\r\n7、IMD整体注塑豪华大面板，美观大方耐用；<br />\r\n8、创新保洁功能，防霉去异味；<br />\r\n9、彩色装饰板，外观清新靓丽；<br />\r\n10、特有易拆洗接水盒，清洁更方便；<br />\r\n11、特有易拆洗保温盖板，去除污渍更方便；<br />\r\n12、创新式小球微压蒸汽阀，有效防溢保湿。</p>\r\n<p>创新式小球微压蒸汽阀 有效防溢保湿 另外加送内锅一个，一锅双胆！</p>\r\n<p>&nbsp;</p>\r\n<p align=\"center\"><img src=\"/media/1/products/GDF-302CB.jpg\" alt=\"\" /><br />\r\n<br />\r\n<br />\r\n<img src=\"/media/1/products/GDF-302CB-4.jpg\" alt=\"\" /><br />\r\n<img src=\"/media/1/products/GDF-302CB-2.jpg\" alt=\"\" /><br />\r\n<br />\r\n<br />\r\n<img src=\"/media/1/products/GDF-302CB-3.jpg\" alt=\"\" /></p>', '', 'GDF-402CB', '0.00', '510.00', '0.00', '0', '0', '0', '0000-00-00', '300', '600', '', '0', '0', '2', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298364741_s.jpg', '/media/1/products/1298364741.jpg|1,/media/1/products/1298364744.jpg,/media/1/products/1298364780.jpg,/media/1/products/1298365034.jpg', '', '', '', '48', '', '', '', '0', '0', '7', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('11', '格力电饭煲 GD-3016 饭粥两用全国正品 新一代节能产品', '', '<p>功能说明：<br />\r\n1、螺纹聚能式高效发热盘；<br />\r\n2、智能微电脑控制，超大液晶显示介面；<br />\r\n3、原生态精钢鼎不锈钢复合内锅，无涂层更健康，更多内锅任您选；<br />\r\n4、24小时定时预约，炊煮更方便；<br />\r\n5、特有停电记忆功能，炊煮更无忧；<br />\r\n6、蒸煮、炖汤、蛋糕、煲仔饭等多种炊煮方式；<br />\r\n7、IMD整体注塑豪华大面板，美观大方耐用；<br />\r\n8、创新保洁功能，防霉去异味；<br />\r\n9、彩色装饰板，外观清新靓丽；<br />\r\n10、特有易拆洗接水盒，清洁更方便；<br />\r\n11、特有易拆洗保温盖板，去除污渍更方便；<br />\r\n12、创新式小球微压蒸汽阀，有效防溢保湿。</p>\r\n<p>创新式小球微压蒸汽阀 有效防溢保湿 另外加送内锅一个，一锅双胆！</p>\r\n<p>&nbsp;</p>\r\n<p align=\"center\"><img src=\"/media/1/products/GDF-302CB.jpg\" alt=\"\" /><br />\r\n<br />\r\n<br />\r\n<img src=\"/media/1/products/GDF-302CB-4.jpg\" alt=\"\" /><br />\r\n<img src=\"/media/1/products/GDF-302CB-2.jpg\" alt=\"\" /><br />\r\n<br />\r\n<br />\r\n<img src=\"/media/1/products/GDF-302CB-3.jpg\" alt=\"\" /></p>', '', 'GDF-502CB', '0.00', '600.00', '0.00', '0', '0', '0', '0000-00-00', '0', '0', '', '0', '0', '2', '0', '0000-00-00 00:00:00', '2011-04-15 14:51:39', '/media/1/products/1298364741_s.jpg', '/media/1/products/1298364741.jpg|1,/media/1/products/1298364780.jpg,/media/1/products/1298365034.jpg,/media/1/products/1298366416.jpg', '', 'a:2:{s:4:\"attr\";a:0:{}s:4:\"aimg\";N;}', 'a:0:{}', '49', '', '', '', '0', '0', '6', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('12', '电饭煲', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n1、螺纹聚能式高效发热盘；<br />\r\n2、智能微电脑控制，高级LED显示界面；<br />\r\n3、2.0mm超厚黑金刚内锅，美国华福健康耐磨不粘涂层；<br />\r\n4、15小时定时预约，炊煮更方便；<br />\r\n5、特有停电记忆功能，炊煮更方便；<br />\r\n6、蒸煮、超快煮、煲仔饭等多种炊煮方式；<br />\r\n7、IMD整体注塑豪华大面板，美观大方耐用；<br />\r\n8、创新保洁功能，防霉去异味；<br />\r\n9、彩色装饰板，外观清新靓丽；<br />\r\n10、特有易拆洗接水盒，清洁更方便；<br />\r\n11、特有易拆洗保温盖板，彻底去除污渍；<br />\r\n12、创新式小球微压蒸汽阀，有效防溢保湿。<br />\r\n<br />\r\n<img alt=\"\" src=\"/media/1/products/GDF-302Db.jpg\" /></p>', '', 'GDF-302DB', '0.00', '235.00', '0.00', '0', '0', '0', '0000-00-00', '200', '300', '', '0', '0', '2', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298367126_s.jpg', '/media/1/products/1298367126.jpg|1', '', '', '', '51', '', '', '', '0', '0', '5', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('13', '电饭煲', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n1、优质聚能发热盘，实现快速烹煮；<br />\r\n2、1.0mm新一代高强度合金内锅，美国华福健康耐磨不粘涂层；<br />\r\n3、创新焖烧保温功能，营养丰富；<br />\r\n4、全新晶格防凝露保温座板；<br />\r\n5、自动限温，更安全、更省心。 <br />\r\n<br />\r\n<img alt=\"\" src=\"/media/1/products/GD-3016-2.jpg\" /></p>', '', 'GD-3016', '0.00', '125.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '2', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298368041_s.jpg', '/media/1/products/1298368041.jpg|1', '', '', '', '52', '', '', '', '0', '0', '6', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('14', '电饭煲', '', '<p>主要功能特点：<br />\r\n1.6升，功率：400W，适合1-4人；<br />\r\n1.0mm 新一代高强度不粘涂层合金铝内锅；<br />\r\n特有气泡型内盖板，加热均匀，有效保鲜防凝露。<br />\r\n创新防凝露保温盖板，<br />\r\n小巧玲珑人见人爱。<br />\r\n&nbsp;</p>\r\n<p><img alt=\"\" src=\"/media/1/products/GD-161A.jpg\" /></p>', '', 'GD-161A', '0.00', '147.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '2', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298427928_s.jpg', '/media/1/products/1298427928.jpg|1', '', '', '', '58', '', '', '', '0', '0', '2', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('15', '电饭煲', '', '<p>主要功能特点：<br />\r\n<br />\r\n1、 螺纹聚能式高效发热盘；<br />\r\n2、 1.0mm高强度合金铝内锅，美国华福健康耐磨不粘涂层；<br />\r\n3、 煮饭保温，自动切换；<br />\r\n4、 一体化顶盖，全新保温效果；<br />\r\n5、 安全防漏电底座。 <br />\r\n<br />\r\n&nbsp;</p>\r\n<p><img alt=\"\" src=\"/media/1/products/GD-305A.jpg\" /></p>', '', 'GD-305A', '0.00', '118.00', '0.00', '0', '0', '0', '0000-00-00', '60', '200', '', '0', '0', '2', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298424885_s.jpg', '/media/1/products/1298424885.jpg|1', '', '', '', '54', '', '', '', '0', '0', '9', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('16', '电饭煲', '', '<p>主要功能特点：<br />\r\n1、 螺纹聚能式高效发热盘；<br />\r\n2、 1.0mm高强度合金铝内锅，美国华福健康耐磨不粘涂层；<br />\r\n3、 煮饭煮粥双重功能选择；<br />\r\n4、 一体化顶盖，全新保温效果；<br />\r\n5、 安全防漏电底座。<br />\r\n&nbsp;</p>\r\n<p><img alt=\"\" src=\"/media/1/products/GD-305Z-6.jpg\" />&nbsp;&nbsp; &nbsp;&nbsp;<img alt=\"\" src=\"/media/1/products/GD-305Z-3.jpg\" /><br />\r\n<br />\r\n<img alt=\"\" src=\"/media/1/products/GD-305Z-4.jpg\" />&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"\" src=\"/media/1/products/GD-305Z-2.jpg\" /><br />\r\n<br />\r\n<img alt=\"\" src=\"/media/1/products/GD-305Z-5.jpg\" /></p>', '', 'GD-305Z', '0.00', '168.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '2', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298427264_s.jpg', '/media/1/products/1298427197.jpg,/media/1/products/1298427198.jpg,/media/1/products/1298427199.jpg,/media/1/products/1298427264.jpg|1', '', '', '', '57', '', '', '', '0', '0', '3', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('17', '电饭煲', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n1、首创&ldquo;省电精煮&rdquo;和&ldquo;省时快煮&rdquo;两种模式，节能又省心<br />\r\n2、螺纹聚能式高效发热盘<br />\r\n3、一体式气辅注塑增强性上盖厚达6.0mm, 耐温耐压不变形<br />\r\n4、创新小球式微压力蒸汽阀, 防溢有新招<br />\r\n5、点阵式防疑露保温座板, 水滴难烂饭<br />\r\n6、煮饭煮粥双重功能选择<br />\r\n7、2.0mm黑厚金刚内锅, 硬质氧化表面超级耐磨, 美国华福健康不粘涂层<br />\r\n<br />\r\n<strong>基本参数：</strong><br />\r\n额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：500W</p>\r\n<p>&nbsp;</p>\r\n<p><strong>保修政策：</strong><br />\r\n1、整机包修一年<br />\r\n2、产品附件包修期：购买产品赠送的附件，包修三个月<br />\r\n3、下列情况不属于包修服务范围，但可实行收费维修<br />\r\n（1）消费者因使用、维护、保管不当及不可抗拒力造成损坏的。<br />\r\n（2）非格力特约服务网点拆动、修理造成损坏的（包括消费者自动拆动、修理）。<br />\r\n（3）无有效凭证及购机凭证型号与修理产品型号不符的。<br />\r\n（4）工厂或经销单位已注明作降价处理的&ldquo;处理品&rdquo;、&ldquo;特价品&rdquo;以及已超过包修期的产品。<br />\r\n（5）由于电源电压不稳定及超出正常电压范围或电源线路安装不符合国家电气安装要求而造成产品损坏的。<br />\r\n4、包修期界定：以开具发票（或有效售货凭证的）时间开始进行计算；没有的，以出厂日期顺延三个月为包修期起算时间。<br />\r\n<br />\r\n<strong>包换政策：</strong><br />\r\n包修有效期内，符合下列条件，而且用户拒绝维修的，可以换机。换机后的三包有效期自换机之日起重新计算<br />\r\n1、产品自售出之日起15日内，发生主要性能故障，不能正常使用；<br />\r\n2、主要性能故障连续修理二次，仍不能正常使用的；<br />\r\n3、自用户送修之日起因厂家原因超过30日（国家规定为90天）未能修复的；<br />\r\n4、因修理者自身原因使修理超过30日的，由其免费为消费者调换同型号同规格的产品，费用由修理者承担；<br />\r\n5、对有争议的，经销售公司及办事处售后经理核准的；<br />\r\n6、换货只换主机，其他附件、赠品和包装不在换货范围之内；<br />\r\n<br />\r\n<strong>包退政策：</strong><br />\r\n包修有效期内，符合下列条件，且用户拒绝维修或换机的，可以退机；<br />\r\n1、产品自售出之日起7日内，发生主要性能故障，不能正常使用的；<br />\r\n2、主要性能连续二次以上无法修复，用户坚持退机的；<br />\r\n3、对有争议，情况特殊的，经销售公司及办事处售后经理核准的。<br />\r\n<br />\r\n备注<br />\r\n1、国家&ldquo;三包&rdquo;政策仅适用于产品本身质量问题；由于火灾、地震等不可抗拒因素及其他人为因素而造成的产品损坏或使用 不满意等均不属于三包处理范围；<br />\r\n2、赠品：享受同等的三包服务政策。购买其它商品赠送格力小家电产品的，以相关商品的有效购买单据出据日为三包计算起止 日，具体机型以单据上注明的小家电赠品名称、型号规格、数量为依据。</p>', '', 'GD-303A', '0.00', '119.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '2', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298428582_s.jpg', '/media/1/products/1298428582.jpg|1', '', '', '', '59', '', '', '', '0', '0', '2', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('18', '电饭煲', '', '<p>主要功能特点：<br/>\r\n\r\n功率：3L/500W、4L/650W、5L/650W；<br/>\r\n国家节能认证，行业领先；<br/>\r\n创新防凝露保温盖板；<br/>\r\n新AI智能微电脑控制，智能煮饭全过程；<br/>\r\n蓝色液晶显示，界面一目了然；<br/>\r\n24小时预约定时功能，炊煮更方便；<br/>\r\n特有中间吸水，新鲜保温功能； <br/>\r\n创新焖烧，营养丰富；<br/>\r\n新一代环保太空节能保温技术，省电更多；<br/>\r\n2.0mm 新一代高强度不粘涂层合金铝内锅；<br/>\r\n大直径优质加热盘，快速烹煮，省时省电。<br/><br/>\r\n</p>', '', 'GD-301D', '0.00', '350.00', '0.00', '0', '0', '0', '0000-00-00', '200', '500', '', '0', '0', '2', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298429771_s.jpg', '/media/1/products/1298429771.jpg|1', '', '', '', '61', '', '', '', '0', '0', '2', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('19', '电饭煲', '', '<p><strong>主要功能特点： </strong><br />\r\n<br />\r\n4升，功率：750W，适合3-9人；<br />\r\n新AI智能微电脑控制，智能煮饭全过程；<br />\r\n2.0mm双面喷涂, 新一代高强度不粘涂层合金铝内锅；<br />\r\nIMD大面板设计，界面一目了然；<br />\r\n特有可拆保湿防溢阀，防止溢出，保湿效果好等；<br />\r\n独创鲜美保温模式，保温时充分保留米饭水份，防止细菌滋生；<br />\r\n三维立体加热功能，加热均匀；<br />\r\n24小时预约定时功能，炊煮更方便 ；<br />\r\n特设停电两小时记忆功能，停电重新启动时，设定照样生效；<br />\r\n创新防凝露保温座板。<br />\r\n&nbsp;</p>\r\n<p>&nbsp; <img alt=\"\" src=\"/media/1/products/GDF-401DA-3.jpg\" /><br />\r\n<br />\r\n<img alt=\"\" src=\"/media/1/products/GDF-401DA-4.jpg\" /></p>', '', 'GDF-401DA', '0.00', '620.00', '0.00', '0', '0', '0', '0000-00-00', '500', '800', '', '0', '0', '2', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298430619_s.jpg', '/media/1/products/1298430619.jpg|1,/media/1/products/1298430629.jpg,/media/1/products/1298430639.jpg', '', '', '', '73', '', '', '', '0', '0', '2', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('20', '电饭煲', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n1、气辅注塑增强型面盖<br />\r\n2、三维立体测温加热<br />\r\n3、微动轴承控温<br />\r\n4、螺纹聚能式发热盘<br />\r\n5、小球式微压力大蒸汽阀<br />\r\n6、煮粥、煮饭随意选<br />\r\n<br />\r\n<br />\r\n<img src=\"/media/1/products/GD-308Z-2.jpg\" alt=\"\" /></p>', '', 'GD-308Z', '0.00', '219.00', '0.00', '0', '0', '0', '0000-00-00', '100', '300', '', '0', '0', '2', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298431240_s.jpg', '/media/1/products/1298431240.jpg|1', '', '', '', '74', '', '', '', '0', '0', '3', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('21', '电饭煲', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n1、微动轴承控温技术<br />\r\n2、气辅注塑增强型面盖<br />\r\n3、双电热管发热<br />\r\n4、螺纹聚能式发热盘<br />\r\n5、创新小球微压蒸汽阀<br />\r\n6、外形秀丽清雅<br />\r\n7、具备煮粥功能<br />\r\n&nbsp;</p>\r\n<p><strong>基本参数：</strong><br />\r\n额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：500W<br />\r\n毛重：3.3KG<br />\r\n<br />\r\n<img src=\"/media/1/products/GD-306Z-4.jpg\" alt=\"\" /><br />\r\n<br />\r\n<img src=\"/media/1/products/GD-306Z-5.jpg\" alt=\"\" /><br />\r\n<br />\r\n<img src=\"/media/1/products/GD-306Z-3.jpg\" alt=\"\" /><br />\r\n<br />\r\n<img src=\"/media/1/products/GD-306Z-2.jpg\" alt=\"\" /><br />\r\n<br />\r\n<img src=\"/media/1/products/GD-306Z-6.jpg\" alt=\"\" /></p>', '', 'GD-306', '0.00', '120.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '2', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298432208_s.jpg', '/media/1/products/1298432208.jpg|1,/media/1/products/1298432222.jpg,/media/1/products/1298432231.jpg', '', '', '', '75', '', '', '', '0', '0', '3', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('22', '电饭煲', '', '<p>1、螺纹聚能式高效率发热盘，发热迅速均匀，炊煮就是快<br />\r\n2、电子控制，高级LED显示界面<br />\r\n3.、超厚黑金刚内锅，华福健康不粘涂层超级耐磨<br />\r\n<br />\r\n4、15小时定时预约，炊煮更方便 <br />\r\n5、特有停电记忆功能，炊煮更无忧  6、蒸煮、超快煮、煲仔饭等炊煮方式<br />\r\n7、创新保洁功能，防霉去异味<br />\r\n8、彩色装饰板，外观清新靓丽 <br />\r\n9、特有易拆洗接水盒，清洁更方便<br />\r\n10、特有易拆洗保温盖板，彻底去除污渍<br />\r\n11、创新式小球微压蒸汽阀，有效防溢保湿<br />\r\n<br />\r\n注：不同的产品，可能有所区别！</p>\r\n<p><img src=\"/media/1/products/GD-306Z-6.jpg\" alt=\"\" /></p>', '', 'GDF-302DA', '0.00', '190.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '2', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298432807_s.jpg', '/media/1/products/1298432807.jpg|1', '', '', '', '76', '', '', '', '0', '0', '3', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('23', '电风扇', '', '<p><strong><br />\r\n<br />\r\n产品简介：</strong><br />\r\n<br />\r\n美国普马威克电机润滑油；<br />\r\n采用科学工艺，精工细作；<br />\r\n优质机身塑料材料；<br />\r\n优越的低压启动性能；<br />\r\n3片PP透明强韧风叶；<br />\r\n摇头360度循环送风；<br />\r\n强，中，弱三档风速调节；<br />\r\n强劲电机，超低噪音</p>', '', 'FSLD-40', '0.00', '169.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '3', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298441497_s.jpg', '/media/1/products/1298441497.jpg,/media/1/products/1298441498.jpg,/media/1/products/1298441606.jpg|1', '', '', '', '77', '', '', '', '0', '0', '5', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('24', '电风扇', '', '<p><strong>产品特点：</strong><br />\r\n<br />\r\n.  时尚外观设计<br />\r\n.  强，弱两档风速可调<br />\r\n.  360度旋转功能，密集安全网<br />\r\n.  3片强韧PP风叶，送风柔和<br />\r\n.  扇头俯仰角自由调节，水平摇头送风<br />\r\n.  清新绿色风格外型小巧使用方便<br />\r\n.  强劲电机：优越的低压启动性能<br />\r\n.  美国普马威电机润滑油<br />\r\n<br />\r\n<img src=\"/media/1/products/FSJ-1801-2.jpg\" alt=\"\" /></p>', '', 'FSJ-1801 ', '0.00', '99.00', '0.00', '0', '0', '0', '0000-00-00', '50', '100', '', '0', '0', '3', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298436490_s.jpg', '/media/1/products/1298436490.jpg|1', '', '', '', '78', '', '', '', '0', '0', '24', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('25', '电风扇', '', '<p>主要功能特点：\r\n<br/>\r\n时尚外观设计，磨砂装饰底盘<br/>\r\n强、弱二档风速可调<br/>\r\n360度旋转功能，密集安全网<br/>\r\n3片强韧PP风叶，送风柔和<br/>\r\n扇头俯仰角自由调节，水平摇头送风<br/>\r\n清新绿色外型小巧使用方便<br/>\r\n强劲电机，优越的低压启动性能<br/>\r\n美国普马威克电机润滑油<br/><br/>\r\n\r\n</p>\r\n', '', 'FSJ-1802', '0.00', '90.00', '0.00', '0', '0', '0', '0000-00-00', '50', '100', '', '0', '0', '3', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298440635_s.jpg', '/media/1/products/1298440635.jpg|1', '', '', '', '79', '', '', '', '0', '0', '8', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('26', '电风扇', '', '<p><strong>主要功能特点：</strong> <br />\r\n<br />\r\n1.全功能红外摇控；微电脑智能化程序控制<br />\r\n2.强、中、弱三档风速调节<br />\r\n3.优质机身塑料材料<br />\r\n4.优越的低压启动性能<br />\r\n5.强劲电机，超低噪音<br />\r\n7.5小时定时关机<br />\r\n8.扇头俯仰角手动调节<br />\r\n9.水平摇头送风<br />\r\n<br />\r\n<strong>基本参数：</strong><br />\r\n额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：55W<br />\r\n毛重：3.9KG<br />\r\n净重：2.8KG<br />\r\n<br />\r\n<img src=\"/media/1/products/FB-40B1-3.jpg\" alt=\"\" /><br />\r\n&nbsp;</p>', '', 'FB-40B1', '0.00', '168.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '3', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298442503_s.jpg', '/media/1/products/1298442503.jpg|1,/media/1/products/1298442503-1.jpg', '', '', '', '80', '', '', '', '0', '0', '3', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('27', '电风扇', '', '<p>★时尚外观设计，双拉线控制；<br />\r\n★强、中、弱三档风速可调；<br />\r\n★扇头俯仰角手动调节；<br />\r\n★3片强韧PP风叶；<br />\r\n★水平摇头送风；<br />\r\n★清新风格印花装饰板；<br />\r\n★强劲电机；优越的低压启动性能；<br />\r\n★美国普马威克电机润滑油；<br />\r\n(具体商品以实物为准，以上图片仅供参考)。<br />\r\n<br />\r\n功率(W): 55<br />\r\n扇页直径(mm): 400<br />\r\n净重(kg): 2.9<br />\r\n毛重(kg): 3.75<br />\r\n包装尺寸(mm)： 465*235*458<br />\r\n外包装材料：单瓦楞纸</p>\r\n<p>&nbsp;</p>\r\n<p align=\"center\"><img alt=\"\" src=\"/media/1/products/KYTF-25-2.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/KYTF-25-4.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/KYTF-25-7.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/KYTF-25-5.jpg\" /><br />\r\n<br />\r\n<img alt=\"\" src=\"/media/1/products/KYTF-25-6.jpg\" /></p>', '', 'KYTF-25', '0.00', '75.00', '0.00', '0', '0', '0', '0000-00-00', '50', '100', '', '0', '0', '3', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298443614_s.jpg', '/media/1/products/1298443611.jpg,/media/1/products/1298443612.jpg,/media/1/products/1298443612-1.jpg,/media/1/products/1298443613.jpg,/media/1/products/1298443614.jpg|1', '', '', '', '81', '', '', '', '0', '0', '3', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('28', '电风扇', '', '<p>总高44CM  宽37.5CM 厚5.2CM  <br />\r\n额定电压220V <br />\r\n额定频率50HZ <br />\r\n额定功率50W <br />\r\n使用值0.8m&sup3;/min*W  扇叶直径30CM<br />\r\n噪音值（声功率级）：56dB（A)<br />\r\n彩盒<br />\r\n毛重2.7KG 净重2.3KG <br />\r\n可拆洗后网结构<br />\r\n*120分钟定时选择<br />\r\n*强中弱三档风速调节<br />\r\n<img alt=\"\" src=\"/media/1/products/KYTJ-30-6.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/KYTJ-30-2.jpg\" /><img alt=\"\" src=\"/media/1/products/KYTJ-30-3.jpg\" /><img alt=\"\" src=\"/media/1/products/KYTJ-30-7.jpg\" /></p>', '', 'KYTJ-30', '0.00', '108.00', '0.00', '0', '0', '0', '0000-00-00', '50', '200', '', '0', '0', '3', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298444610_s.jpg', '/media/1/products/1298444609.jpg,/media/1/products/1298444610.jpg|1,/media/1/products/1298444610-1.jpg,/media/1/products/1298444611.jpg', '', '', '', '195', '', '', '', '0', '0', '3', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('29', '电风扇', '', '<p>功能介绍：<br />\r\n★日月造型，台、壁两用<br />\r\n★强/中/弱三档风速可调<br />\r\n★跌倒自停，安全可靠<br />\r\n★扇头俯仰角自由调节<br />\r\n★120分钟定时关机；5片强韧PP风叶<br />\r\n★强劲电机,优越的低压启动性能<br />\r\n★美国普马威克电机润滑油<br />\r\n<br />\r\n型号：KYTB-25(黄）<br />\r\n电源：220V/50HZ<br />\r\n额定功率：45W<br />\r\n风叶直径：250(mm)<br />\r\n毛重：2.3KG<br />\r\n外包装尺寸：367*160*365(mm)<br />\r\n<br />\r\n<img src=\"/media/1/products/KYTB-25-5.jpg\" alt=\"\" /><img src=\"/media/1/products/KYTB-25-4.jpg\" alt=\"\" /><br />\r\n<img src=\"/media/1/products/KYTB-25-2.jpg\" alt=\"\" /></p>', '', 'KYTB-25', '0.00', '145.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '3', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298445546_s.jpg', '/media/1/products/1298445545.jpg,/media/1/products/1298445545-1.jpg,/media/1/products/1298445546.jpg|1,/media/1/products/1298445547.jpg', '', '', '', '196', '', '', '', '0', '0', '8', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('30', '电风扇', '', '<p><strong>型号: FSW-30Bc 台地扇</strong><br />\r\n<br />\r\n★全功能红外遥控，特有一键关灯功能<br />\r\n★特有平背式机头设计，机身更纤细更省空间<br />\r\n★优质滚珠轴承电机，性能更卓越<br />\r\n★豪华大屏幕数码显示<br />\r\n★8小定时关机/8小时预约开机<br />\r\n★强/中/弱/柔四档风速可调<br />\r\n★普通风/睡眠风/自然风三种模式可选<br />\r\n★5片AS风叶，送风柔和；双色装饰板<br />\r\n★特设锁扣式网罩圈，方便拆洗<br />\r\n★优越的低压启动性能<br />\r\n★美国普马威克电机润滑油<br />\r\n<br />\r\n★柔风档适合老人儿童使用<br />\r\n(具体商品以实物为准，以上图片仅供参考)。<br />\r\n<br />\r\n功率(W): 40<br />\r\n扇页直径(mm): 300<br />\r\n净重(kg): 3.8<br />\r\n毛重(kg): 5<br />\r\n包装尺寸(mm)： 708*212*425<br />\r\n外包装材料：单瓦楞纸<br />\r\n<br />\r\n<img alt=\"\" src=\"/media/1/products/FSW-30Bc-2.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/FSW-30Bc-3.jpg\" /></p>', '', 'FSW-30BC', '0.00', '349.00', '0.00', '0', '0', '0', '0000-00-00', '300', '500', '', '0', '0', '3', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298446297_s.jpg', '/media/1/products/1298446296.jpg,/media/1/products/1298446297.jpg|1,/media/1/products/1298446297-1.jpg', '', '', '', '197', '', '', '', '0', '0', '6', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('31', '电风扇', '', '<p><strong>产品概述：</strong><br />\r\n<br />\r\n1、4S高效电机，劲风、静音、耐用<br />\r\n2、强、中、弱三档风速可调<br />\r\n3、5片强韧PP风叶，送风柔和<br />\r\n4、水平摇头送风，扇头自由升降<br />\r\n5、优越的低压启动性能<br />\r\n6、120分钟定时关机<br />\r\n7、美国普马威克电机润滑油<br />\r\n<br />\r\n<strong>产品参数：</strong><br />\r\n<br />\r\n扇页直径(CM)：30<br />\r\n额定电压：220V      <br />\r\n额定频率：55W    <br />\r\n包装尺寸(MM)：585*198*425<br />\r\n<br />\r\n<img src=\"/media/1/products/FSO-30-2.jpg\" alt=\"\" /></p>', '', 'FSO-30', '0.00', '182.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '3', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298446735_s.jpg', '/media/1/products/1298446735.jpg|1', '', '', '', '198', '', '', '', '0', '0', '4', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('32', '电风扇', '', '<p>格力落地扇（扇叶直径：16寸）<br />\r\n<br />\r\n主要功能特点：<br />\r\n1、强、中、弱三档一键通实现风速调节<br />\r\n2、外形简洁和精致<br />\r\n3、扇头俯仰角自由调节<br />\r\n4、水平摇头送风<br />\r\n5、扇头自由升降<br />\r\n基本参数:<br />\r\n额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：55W<br />\r\n毛重：6.7KG<br />\r\n净重：5.7KG<br />\r\n<img src=\"/media/1/products/FDK-40-3.jpg\" alt=\"\" /></p>', '', 'FDK-40', '0.00', '118.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '3', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298447321_s.jpg', '/media/1/products/1298447321.jpg|1', '', '', '', '199', '', '', '', '0', '0', '2', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('33', '电风扇', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n强中弱三档风速可调<br />\r\n优越的低压启动性能<br />\r\n强劲电机，超低噪音<br />\r\n扇头俯仰角自由调节<br />\r\n水平摇头送风<br />\r\n扇头自由升降<br />\r\n120分钟小时定时关机<br />\r\n<br />\r\n<img src=\"/media/1/products/FSD-40B-2.jpg\" alt=\"\" /><br />\r\n<img src=\"/media/1/products/FSD-40B-4.jpg\" alt=\"\" /><br />\r\n<img src=\"/media/1/products/FSD-40B-5.jpg\" alt=\"\" /></p>', '', 'FSD-40B', '0.00', '199.00', '0.00', '0', '0', '0', '0000-00-00', '100', '300', '', '0', '0', '3', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298448079_s.jpg', '/media/1/products/1298448079.jpg|1', '', '', '', '200', '', '', '', '0', '0', '6', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('34', '电风扇', '', '主要功能特点：<br/><br/>\r\n\r\n强、中、弱三档风速调节<br/>\r\n扇头俯仰角自由调节<br/>\r\n水平摇头送风<br/>\r\n优越的低压启动性能<br/>\r\n强劲电机，超低噪音<br/>\r\n美国进口“普马威克”电机润滑油<br/>\r\n扇头自由升降<br/>\r\n120分钟定时关机<br/>\r\n经典蓝白配 <br/>\r\n底盘可换<br/>', '', 'FDD-40', '0.00', '139.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '3', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298448567_s.jpg', '/media/1/products/1298448567.jpg|1', '', '', '', '201', '', '', '', '0', '0', '1', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('35', '电风扇', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n强、中、弱三档风速调节<br />\r\n扇头俯仰角自由调节<br />\r\n水平摇头送风<br />\r\n优越的低压启动性能<br />\r\n强劲电机，超低噪音<br />\r\n美国进口&ldquo;普马威克&rdquo;电机润滑油<br />\r\n优质机身塑料材料<br />\r\n3片PP透明风叶<br />\r\n扇头自由升降<br />\r\n120分钟定时关机<br />\r\n经典黄白配 <br />\r\n底盘可拆 </p>', '', 'FDE-40', '0.00', '125.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '3', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298448875_s.jpg', '/media/1/products/1298448875.jpg|1', '', '', '', '202', '', '', '', '0', '0', '6', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('36', '格力电风扇FSLD-40 扇头360°循环送风 低压启动', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n全功能红外遥控；微电脑程序控制<br />\r\n强、中、弱风三档风速调节<br />\r\n普通风自然风睡眠风可选择<br />\r\n优越的低压启动性能<br />\r\n强劲电机，超低噪音<br />\r\n美国进口&ldquo;普马威克&rdquo;电机润滑油<br />\r\n优质机身塑料材料<br />\r\n扇头俯仰角自由调节<br />\r\n水平摇头送风<br />\r\n3片PP透明风叶<br />\r\n扇头自由升降<br />\r\n7.5小时定时关机<br />\r\n经典黑白配 <br />\r\n按键电镀<br />\r\n底盘可拆</p>\r\n<p><img alt=\"\" src=\"/media/1/products/FDG-40B.jpg\" /></p>', '', 'FDG-40B', '0.00', '228.00', '0.00', '0', '0', '0', '0000-00-00', '0', '0', '', '0', '0', '3', '0', '0000-00-00 00:00:00', '2011-04-15 14:57:48', '/media/1/products/1298452323_s.jpg', '/media/1/products/1298452323.jpg|1', '', 'a:2:{s:4:\"attr\";a:0:{}s:4:\"aimg\";N;}', 'a:0:{}', '203', '', '', '', '0', '0', '4', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('37', '空调扇', '', '<p>主要功能特点：<br />\r\n1.冷暖两用，四季皆宜（RD）;<br />\r\n2.双离心风轮，超大风量；<br />\r\n3.三位数码显示屏,智能湿度控制；<br />\r\n4.创新侧进风方式，空气循环更高效；<br />\r\n5.自动闭合防尘风口、上下左右自动扫风，120度广角送风；<br />\r\n6. 15小时定时预约功能，适合夜间睡眠使用；<br />\r\n7.全开式钢化玻璃门设计，全抽式水箱，加水、清洗、拆装更方便；<br />\r\n8.超强吸水纤维蒸发器，吸水更充分，加湿更凉爽；<br />\r\n9.八档风速调节，自然风、睡眠风、普通风多种风类选择；<br />\r\n10. 缺水保护、过热保护、断电保护，人性化设计，使用更安全；<br />\r\n11.优质滚珠轴承电机，110V低压启动，保用10年；<br />\r\n<br />\r\n<img alt=\"\" src=\"/media/1/products/0701RD 2.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/0701RD 3.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/kongdiaoshanneibujiegou3.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/0701RD 4.jpg\" /></p>', '', 'KS-0701RD', '0.00', '1298.00', '0.00', '0', '0', '0', '0000-00-00', '1000', '1500', '', '0', '0', '4', '0', '0000-00-00 00:00:00', '2011-03-03 14:28:55', '/media/1/products/1298614000_s.jpg', '/media/1/products/1298614000.jpg|1', '', '', '', '204', '', '', '', '0', '0', '2', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('38', '空调扇', '', '<p>主要功能特点：<br />\r\n<br />\r\n1.蒸发加湿，高效降温；<br />\r\n2.双离心风轮，超大风量；<br />\r\n3.LED星光显示屏，远距离遥控(0502D)；<br />\r\n4.创新侧进风方式，空气循环更高效；<br />\r\n5. 上下手动导风，左右自动扫风，120度广角送风；  <br />\r\n6. 15小时定时预约(0502D)，2小时定时(0502) ；<br />\r\n7.全开门设计，全抽式水箱，加水、清洗、拆装更方便； <br />\r\n8.超强吸水纤维蒸发器，吸水更充分，加湿更凉爽；<br />\r\n9.强、中、弱、柔四档风速调节；<br />\r\n10.自然风、睡眠风、普通风三种风类选择(0502D);<br />\r\n11.缺水保护、断电保护，人性化设计，使用更安全;<br />\r\n12.优质滚珠轴承电机，110V低压启动，保用10年；<br />\r\n&nbsp;</p>\r\n<p>l<img alt=\"\" src=\"/media/1/products/KS-0502.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/KS-0502-2.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/KS-0502-3.jpg\" /></p>', '', 'KS-0502', '0.00', '399.00', '0.00', '0', '0', '0', '0000-00-00', '200', '500', '', '0', '0', '4', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298614831_s.jpg', '/media/1/products/1298614831.jpg|1', '', '', '', '205', '', '', '', '0', '0', '4', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('39', '空调扇', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n冷暖两用，暖风2000W<br />\r\n抽拉式水箱，清洗方便<br />\r\n蒸发式加温/降温<br />\r\n三档风速可调，负离子清新功能<br />\r\n8小时定时，100度广角送风<br />\r\n大功率主电机，送风量大<br />\r\n彩色LED显示<br />\r\n过滤网/蒸发器易装拆易清洗<br />\r\n出风口自动闭合防尘功能（配冰盒）</p>', '', 'KS-0601RD', '0.00', '765.00', '0.00', '0', '0', '0', '0000-00-00', '500', '800', '', '0', '0', '4', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298615513_s.jpg', '/media/1/products/1298615513.jpg|1', '', '', '', '206', '', '', '', '0', '0', '1', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('40', '空调扇', '', '<p>主要功能特点：<br />\r\n<br />\r\n1 .智能加湿型；<br />\r\n2 .抽拉式水箱，清洗更方便；<br />\r\n3 .蒸发式加湿/降温；<br />\r\n4 .三档风速可调节，三种风类选择；<br />\r\n5 .8小时定时；<br />\r\n6 .大功率主电机智，送风量大；<br />\r\n7.过滤网/蒸发器易装拆易清洗；<br />\r\n8.100度广角自动左右送风；<br />\r\n9.出风口可闭合防尘功能（配冰盒）；<br />\r\n10.彩色LED显示；<br />\r\n11.强劲电机，优越的低压启动性能；<br />\r\n12.美国普马威克电机润滑油。<br />\r\n<br />\r\n基本参数:<br />\r\n额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：65W<br />\r\n毛重：11.5KG<br />\r\n净重：8.5KG<br />\r\n&nbsp;</p>\r\n<p><img alt=\"\" src=\"/media/1/products/KS-0601D.jpg\" /></p>', '', 'KS-0601D', '0.00', '599.00', '0.00', '0', '0', '0', '0000-00-00', '500', '800', '', '0', '0', '4', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298616082_s.jpg', '/media/1/products/1298616082.jpg|1', '', '', '', '207', '', '', '', '0', '0', '3', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('41', '空调扇', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n1、单冷、超薄遥控器、负离子<br />\r\n2、0.5-7.5小时定时、三档风速<br />\r\n3、4D立体全方位送风<br />\r\n4、关机自动合闭、三种风类选择 <br />\r\n5、全新、可抽拉式水箱<br />\r\n6、过滤网/蒸发器易装拆易清洗 <br />\r\n&nbsp;</p>\r\n<p><img alt=\"\" src=\"/media/1/products/KS-305D-2.jpg\" /><img alt=\"\" src=\"/media/1/products/KS-305D-3.jpg\" /><img alt=\"\" src=\"/media/1/products/KS-305D-4.jpg\" /></p>', '', 'KS-305D', '0.00', '569.00', '0.00', '0', '0', '0', '0000-00-00', '500', '800', '', '0', '0', '4', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298616389_s.jpg', '/media/1/products/1298616389.jpg|1', '', '', '', '208', '', '', '', '0', '0', '3', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('42', 'KBO2001 icona早餐系列电水壶', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n◆ 优质不锈钢壶体，卫生健康<br />\r\n◆ 隐式大功率不锈钢发热盘，加热快速<br />\r\n◆ 360&deg;旋转、分体式设计，取放方便<br />\r\n◆ 蒸汽感应式自动断电，双重防干烧保护<br />\r\n◆ 内外镜面抛光壶体，不易结水垢<br />\r\n◆ 外形小巧玲珑，方便携带<br />\r\n◆ 易拆卸式滤网，方便清洁<br />\r\n◆ 英国STRIX温控器，精确可靠耐用 <br />\r\n&nbsp;</p>', '', 'GK-CS1825DA', '0.00', '219.00', '0.00', '0', '0', '0', '0000-00-00', '0', '0', '', '0', '0', '5', '0', '0000-00-00 00:00:00', '2011-04-15 15:10:28', '/media/1/products/1298617124_s.jpg', '/media/1/products/1298617124.jpg|1', '', 'a:2:{s:4:\"attr\";a:0:{}s:4:\"aimg\";N;}', 'a:0:{}', '209', '', '', '', '0', '0', '1', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('43', '电水壶', '', '<p>&nbsp;<span class=\"Apple-style-span\" style=\"font-family: 宋体, Arial; font-size: 12px; line-height: normal; \"><span class=\"Apple-style-span\" style=\"color: rgb(51, 51, 51); font-size: 13px; font-weight: bold; line-height: 26px; \">主要功能特点：</span>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 10px; line-height: 20px; color: rgb(102, 102, 102); text-align: left; \">◆&nbsp;全新外观造型，典雅时尚<br />\r\n◆&nbsp;优质温控器，双重安全保护<br />\r\n◆&nbsp;水沸腾自动关机，无水干烧自动断电<br />\r\n◆&nbsp;高级不锈钢隐藏式发热盘&nbsp;<br />\r\n◆&nbsp;360&deg;旋转、分体式设计，取放方便<br />\r\n◆&nbsp;透明水尺设计，水位显示一目了然<br />\r\n◆&nbsp;易拆卸式滤网，方便清洁<br />\r\n◆&nbsp;1350W大功率，1.0L小容量设计，省时省电</p>\r\n</span></p>', '', 'GK-CS1310DA1', '0.00', '199.00', '0.00', '0', '0', '0', '0000-00-00', '100', '300', '', '0', '0', '5', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298617394_s.jpg', '/media/1/products/1298617394.jpg|1', '', '', '', '210', '', '', '', '0', '0', '1', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('44', '电水壶', '', '<p>&nbsp;<span class=\"Apple-style-span\" style=\"font-family: 宋体, Arial; font-size: 12px; line-height: normal; \"><span class=\"Apple-style-span\" style=\"color: rgb(51, 51, 51); font-size: 13px; font-weight: bold; line-height: 26px; \">主要功能特点：</span>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 10px; line-height: 20px; color: rgb(102, 102, 102); text-align: left; \">◆&nbsp;优质不锈钢壶体，卫生健康<br />\r\n◆&nbsp;隐式大功率不锈钢发热盘，加热快速<br />\r\n◆&nbsp;360&deg;旋转、分体式设计，取放方便<br />\r\n◆&nbsp;蒸汽感应式自动断电，双重防干烧保护<br />\r\n◆&nbsp;内外镜面抛光壶体，不易结水垢<br />\r\n◆&nbsp;透明水尺设计，水位一目了然<br />\r\n◆&nbsp;易拆卸式滤网，方便清洁<br />\r\n◆&nbsp;英国STRIX温控器，精确可靠耐用&nbsp;</p>\r\n</span></p>', '', 'GK-CS1818DB', '0.00', '269.00', '0.00', '0', '0', '0', '0000-00-00', '200', '500', '', '0', '0', '5', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298617623_s.jpg', '/media/1/products/1298617623.jpg|1', '', '', '', '211', '', '', '', '0', '0', '0', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('45', '电水壶', '', '<p>&nbsp;<span class=\"Apple-style-span\" style=\"font-family: 宋体, Arial; font-size: 12px; line-height: normal; \"><span class=\"Apple-style-span\" style=\"color: rgb(51, 51, 51); font-size: 13px; font-weight: bold; line-height: 26px; \">主要功能特点：</span>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 10px; line-height: 20px; color: rgb(102, 102, 102); text-align: left; \">◆&nbsp;优质耐高温塑料壶体，卫生健康<br />\r\n◆&nbsp;隐式大功率不锈钢发热盘，加热快速<br />\r\n◆&nbsp;360&deg;旋转、分体式设计，取放方便<br />\r\n◆&nbsp;蒸汽感应式自动断电，双重防干烧保护<br />\r\n◆&nbsp;整体小巧玲珑，方便携带<br />\r\n◆&nbsp;透明水尺设计，水位一目了然<br />\r\n◆&nbsp;易拆卸式滤网，方便清洁<br />\r\n◆&nbsp;优质温控器，精确安全耐用</p>\r\n</span></p>', '', 'GK-CS1818DA', '0.00', '210.00', '0.00', '0', '0', '0', '0000-00-00', '200', '400', '', '0', '0', '5', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298618007_s.jpg', '/media/1/products/1298618007.jpg|1', '', '', '', '212', '', '', '', '0', '0', '2', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('46', '电水壶', '', '<p>&nbsp;<span class=\"Apple-style-span\" style=\"font-family: 宋体, Arial; font-size: 12px; line-height: normal; \"><span class=\"Apple-style-span\" style=\"color: rgb(51, 51, 51); font-size: 13px; font-weight: bold; line-height: 26px; \">主要功能特点：</span>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 10px; line-height: 20px; color: rgb(102, 102, 102); text-align: left; \">◆&nbsp;优质不锈钢壶体，卫生健康<br />\r\n◆&nbsp;隐式大功率不锈钢发热盘，加热快速<br />\r\n◆&nbsp;360&deg;旋转、分体式设计，取放方便<br />\r\n◆&nbsp;蒸汽感应式自动断电，双重防干烧保护<br />\r\n◆&nbsp;内外镜面抛光壶体，不易结水垢<br />\r\n◆&nbsp;透明水尺设计，水位一目了然<br />\r\n◆&nbsp;易拆卸式滤网，方便清洁<br />\r\n◆&nbsp;英国STRIX温控器，精确可靠耐用&nbsp;</p>\r\n</span></p>', '', 'GK-CS1815DA', '0.00', '319.00', '0.00', '0', '0', '0', '0000-00-00', '200', '500', '', '0', '0', '5', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298618265_s.jpg', '/media/1/products/1298618265.jpg|1', '', '', '', '213', '', '', '', '0', '0', '1', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('47', '电水壶', '', '<p>&nbsp;<span class=\"Apple-style-span\" style=\"font-family: 宋体, Arial; font-size: 12px; line-height: normal; \"><span class=\"Apple-style-span\" style=\"color: rgb(51, 51, 51); font-size: 13px; font-weight: bold; line-height: 26px; \">主要功能特点：</span>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 10px; line-height: 20px; color: rgb(102, 102, 102); text-align: left; \">◆&nbsp;全新外观造型，典雅时尚<br />\r\n◆&nbsp;优质温控器，双重安全保护<br />\r\n◆&nbsp;防干烧保护及高温熔断保护<br />\r\n◆&nbsp;分离式电源底座，安全方便<br />\r\n◆&nbsp;不锈钢发热管，永不生锈</p>\r\n</span></p>', '', 'GK-CS0808PA1', '0.00', '120.00', '0.00', '0', '0', '0', '0000-00-00', '100', '300', '', '0', '0', '5', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298618642_s.jpg', '/media/1/products/1298618642.jpg|1', '', '', '', '214', '', '', '', '0', '0', '1', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('48', '电水壶', '', '<p>&nbsp;<span class=\"Apple-style-span\" style=\"font-family: 宋体, Arial; font-size: 12px; line-height: normal; \"><span class=\"Apple-style-span\" style=\"color: rgb(51, 51, 51); font-size: 13px; font-weight: bold; line-height: 26px; \">主要功能特点：</span>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 10px; line-height: 20px; color: rgb(102, 102, 102); text-align: left; \">◆&nbsp;优质耐高温塑料壶体，卫生健康<br />\r\n◆&nbsp;隐式大功率不锈钢发热盘，加热快速<br />\r\n◆&nbsp;360&deg;旋转、分体式设计，取放方便<br />\r\n◆&nbsp;蒸汽感应式自动断电，双重防干烧保护<br />\r\n◆&nbsp;壶体透明设计，水位显示一目了然<br />\r\n◆&nbsp;整体流线造型，美观时尚<br />\r\n◆&nbsp;易拆卸式滤网，方便清洁<br />\r\n◆&nbsp;优质温控器，精确安全耐用&nbsp;</p>\r\n</span></p>', '', 'GK-CS1520DA', '0.00', '265.00', '0.00', '0', '0', '0', '0000-00-00', '200', '500', '', '0', '0', '5', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298618863_s.jpg', '/media/1/products/1298618863.jpg|1', '', '', '', '215', '', '', '', '0', '0', '0', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('49', '电水壶', '', '<p><strong>主要功能特点：</strong><br />\r\n<br />\r\n360度旋转任意旋转<br />\r\n煲身不锈钢材料，磨砂表面<br />\r\n不锈钢大功率发热盘，制热水快（3-6分钟）<br />\r\n英国进口STRIX温控器三重安全保护<br />\r\n隐藏式电源底座，分体设计<br />\r\n防滑断手柄设计<br />\r\n分体无绳式设计，360度随意取放<br />\r\n出水口带滤网设计，使用更安全，饮水更卫生</p>', '', 'GK-CS1512DA', '0.00', '199.00', '0.00', '0', '0', '0', '0000-00-00', '100', '300', '', '0', '0', '5', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298619030_s.jpg', '/media/1/products/1298619030.jpg|1', '', '', '', '216', '', '', '', '0', '0', '1', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('50', '加湿器', '', '<p>功能介绍：<br />\r\n<br />\r\n★产品外观流畅，5L大容量水箱<br />\r\n★出雾口可360度旋转<br />\r\n★负离子功能，改善空气质量<br />\r\n★缺水自动断电及提示功能，使用安全<br />\r\n★换能片采用玻璃釉工艺制造，有效防止水垢<br />\r\n★先进抑噪技术，超静音运行。<br />\r\n<br />\r\n型号：GS-5002<br />\r\n电源：220V/50HZ<br />\r\n额定功率：45W<br />\r\n冷雾：&ge;300ml/h<br />\r\n噪声：&le;35db<br />\r\n水箱容积：5L<br />\r\n毛重：2.85KG<br />\r\n外包装尺寸：263*260*361(mm)<br />\r\n适用面积：12-20平方</p>\r\n<p>&nbsp;</p>\r\n<table width=\"90%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"font-size: 12px;\">\r\n    <tbody>\r\n        <tr>\r\n            <td><img src=\"/media/1/products/GS-5002-2.jpg\" alt=\"\" /></td>\r\n            <td><span style=\"color: rgb(102, 102, 102); font-family: \'arial helvetica sans-serif\'; line-height: 19px;\" class=\"Apple-style-span\">产品特性：<br />\r\n            ★按钮式开关，手动调节雾量大小&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />\r\n            ★先进抑噪技术，超静音运行；</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><span style=\"color: rgb(102, 102, 102); font-family: \'arial helvetica sans-serif\'; line-height: 21px;\" class=\"Apple-style-span\">★负离子功能，改善空气质量<br />\r\n            ★换能片采用玻璃釉工艺制造，有效防止水垢<br />\r\n            ★缺水自动断电及提示功能，使用安全；</span></td>\r\n            <td><img src=\"/media/1/products/GS-5002-3.jpg\" alt=\"\" /></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img src=\"/media/1/products/GS-5002-4.jpg\" alt=\"\" /></td>\r\n            <td><span style=\"color: rgb(102, 102, 102); font-family: \'arial helvetica sans-serif\'; line-height: 21px;\" class=\"Apple-style-span\">\r\n            <p align=\"left\" style=\"margin: 1.12em 0px; padding: 0px; line-height: 1.4;\">★产品外观流畅，5L大容量水箱 ★出雾口可360度旋转；</p>\r\n            容量:5.0L<br />\r\n            颜色:蓝色<br />\r\n            额定功率:45W<br />\r\n            额定电压:220V-50HZ<br />\r\n            雾化量:&nbsp;冷雾&gt;=&nbsp;300ml/h<br />\r\n            噪音:&lt;35dB(A)<br />\r\n            尺寸:&nbsp;263mm*262mm*366mm</span></td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '', 'GS-5002', '0.00', '218.00', '0.00', '0', '0', '0', '0000-00-00', '100', '300', '', '0', '0', '6', '0', '0000-00-00 00:00:00', '2011-03-07 16:49:15', '/media/1/products/1298857534_s.jpg', '/media/1/products/1298857534.jpg|1', '', '', '', '338', '', '', '', '0', '0', '4', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('51', '加湿器', '', '<p>主要功能特点：<br/><br/>\r\n◆出气盖360°旋转，加湿方向随心所欲。<br/>\r\n◆ 缺水自动保护，风机同步停转，安全节能。<br/>\r\n◆雾量大小可自由调节。<br/>\r\n◆优化风道设计，出雾更细微，加湿更有效。<br/>\r\n◆第四代换能片技术，耐酸碱，不易结水垢。<br/>\r\n◆阳离子交换树脂，大大减少了“白粉“、水垢的形成。\r\n</p>\r\n<p>\r\n额定电源： 220V-50Hz<br/>\r\n\r\n额定功率： 35W<br/>\r\n\r\n水箱容积： 3.5L<br/>\r\n\r\n加湿量： ≥300ml/h<br/>\r\n\r\n净重： 2.1kg  <br/> \r\n\r\n毛重：2.8kg<br/>\r\n\r\n体积：334 x 213 x 323mm<br/>\r\n</p>', '', 'GS-3503', '0.00', '168.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '6', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298858583_s.jpg', '/media/1/products/1298858583.jpg|1', '', '', '', '339', '', '', '', '0', '0', '1', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('52', '加湿器', '', '<p>主要功能特点：<br />\r\n<br />\r\n◆ 太空概念造型，线条流畅。<br />\r\n<br />\r\n◆ 高浓度负离子，改善空气质量。<br />\r\n<br />\r\n◆ 防干烧自动断电保护。<br />\r\n<br />\r\n◆ 先进抑噪技术，超静音&le;34 dB(A)运行。<br />\r\n<br />\r\n◆ 牢固壳体，优良分拆性，易装水设计。<br />\r\n<br />\r\n◆ 纳米抗菌技术，防霉、防菌。<br />\r\n&nbsp;</p>\r\n<p><img alt=\"\" src=\"/media/1/products/GS-3501.jpg\" /><img alt=\"\" src=\"/media/1/products/GS-3501-2.jpg\" /><img alt=\"\" src=\"/media/1/products/GS-3501-3.jpg\" /><img alt=\"\" src=\"/media/1/products/GS-3501-4.jpg\" /><img alt=\"\" src=\"/media/1/products/GS-3501-5.jpg\" /></p>', '', 'GS-3501', '0.00', '180.00', '0.00', '0', '0', '0', '0000-00-00', '100', '300', '', '0', '0', '6', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298859022_s.jpg', '/media/1/products/1298859022.jpg|1,/media/1/products/1298859054.jpg,/media/1/products/1298859060.jpg', '', '', '', '340', '', '', '', '0', '0', '0', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('53', '加湿器', '', '<p>&nbsp;<span class=\"Apple-style-span\" style=\"font-family: 宋体, Arial; font-size: 12px; line-height: normal; \"><span class=\"Apple-style-span\" style=\"color: rgb(51, 51, 51); font-size: 13px; font-weight: bold; line-height: 26px; \">主要功能特点：</span>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 10px; line-height: 20px; color: rgb(102, 102, 102); text-align: left; \">使用面积：30--40平方米<br />\r\n最大功率：45W&nbsp;，噪声≦34dB(A)<br />\r\n太空概念造型，型条流畅<br />\r\n高浓度负离子，改善空气质量<br />\r\n防干烧自动断电保护<br />\r\n先进抑噪技术，超静音≦34dB(A)运行<br />\r\n牢固壳体，优良分拆性，易装水设计<br />\r\n纳米抗菌技术，防霉、防菌</p>\r\n</span></p>', '', 'GS-3502', '0.00', '199.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '6', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298859463_s.jpg', '/media/1/products/1298859463.jpg|1', '', '', '', '341', '', '', '', '0', '0', '0', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('54', '加湿器', '', '<p>主要功能特点：<br/><br/>\r\n1、外形简洁大方，人性化设计。<br/><br/>\r\n\r\n2、旋钮式开关和雾量选择，操作方便。<br/><br/>\r\n\r\n3、缺水自动断电保护，安全无忧。<br/><br/>\r\n\r\n4、先进抑噪设计，超静音运行。<br/><br/>\r\n\r\n5、纳米抗菌技术，防霉，防菌，健康安心。<br/><br/>\r\n\r\n6、水瓶形式多样，个性十足<br/><br/>\r\n\r\n7、改善空气质量，舒适，健康<br/><br/>\r\n\r\n8、换能片采用陶瓷与钛合金制造，使用常久。<br/><br/>\r\n\r\n9、标准螺口设计，可使用其它类型矿泉水瓶<br/><br/>\r\n</p>', '', 'GS-1001A', '0.00', '135.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '6', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298859837_s.jpg', '/media/1/products/1298859837.jpg|1', '', '', '', '342', '', '', '', '0', '0', '47', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('55', '加湿器', '', '<p>格力加湿器的优势 <br />\r\n<br />\r\n★改善空气质量，舒适健康<br />\r\n★缺水自动保护功能，安全可靠<br />\r\n★先进抑噪技术，超静音<br />\r\n★超声波雾化量随意调节<br />\r\n★水箱提起保护，加湿安全无忧</p>\r\n<table border=\"0\" width=\"90%\" stype=\"font-size:12px;\">\r\n    <tbody>\r\n        <tr>\r\n            <td><img alt=\"\" src=\"/media/1/products/SC-1501-3.jpg\" /></td>\r\n            <td><span class=\"Apple-style-span\" style=\"color: rgb(102, 102, 102); font-family: \'arial helvetica sans-serif\'; line-height: 21px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; \">产品特性：<br />\r\n            ★内带七彩灯，夜灯和装饰两用设计<br />\r\n            ★按键模式，操作便捷</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><span class=\"Apple-style-span\" style=\"color: rgb(102, 102, 102); font-family: \'arial helvetica sans-serif\'; line-height: 21px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; \">★出雾口可360度旋转，全方位加湿<br />\r\n            ★先进抑噪技术，超静音运行。</span></td>\r\n            <td><img alt=\"\" src=\"/media/1/products/SC-1501-4.jpg\" /></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\"\" src=\"/media/1/products/SC-1501-5.jpg\" /></td>\r\n            <td><span class=\"Apple-style-span\" style=\"color: rgb(102, 102, 102); font-family: tahoma, arial, 宋体, sans-serif; line-height: 21px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; \">\r\n            <div style=\"padding-bottom: 7px; line-height: 1.5em; padding-left: 15px; padding-right: 15px; font-family: \'arial helvetica sans-serif\'; font-size: 14px; padding-top: 7px; \">★玻璃釉陶瓷雾化片，雾化量大，雾量均匀。<br />\r\n            ★缺水自动断电保护和水箱提起断电保护功能，使用安全可靠</div>\r\n            <div style=\"padding-bottom: 7px; line-height: 1.5em; padding-left: 15px; padding-right: 15px; font-family: \'arial helvetica sans-serif\'; font-size: 14px; padding-top: 7px; \">\r\n            <table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" width=\"100%\" style=\"border-collapse: separate; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; display: table; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; text-align: left; \">\r\n                <tbody>\r\n                    <tr>\r\n                        <td style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; \">箱容积</td>\r\n                        <td style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; \">1.50L</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; \">加湿量</td>\r\n                        <td style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; \">200ml/h</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; \">功率</td>\r\n                        <td style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; \">20w</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; \">外型尺寸</td>\r\n                        <td style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; \">248&times;213&times;345mm</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; \">净重</td>\r\n                        <td style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-color: black; border-right-color: black; border-bottom-color: black; border-left-color: black; \">0.99kg</td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </div>\r\n            </span></td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '', 'SC-1501', '0.00', '0.00', '0.00', '0', '0', '0', '0000-00-00', '0', '0', '', '0', '0', '6', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298860547_s.jpg', '/media/1/products/1298860547.jpg|1,/media/1/products/1298860554.jpg', '', '', '', '343', '', '', '', '0', '0', '9', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('56', '加湿器', '', '<p><img src=\"/media/1/products/GSZ-3001A-2.jpg\" alt=\"\" />&nbsp;</p>\r\n<p>基本参数 <br />\r\n<br />\r\n水箱容量：3L <br />\r\n加湿量：&ge;380ml/h <br />\r\n电源：220V/50Hz <br />\r\n功率：330W <br />\r\n重量：3.6kg <br />\r\n噪音&le;30dB（A）(睡眠模式) <br />\r\n功能描述：标准、强加湿、睡眠、省电四种模式自由选择； 独有蒸发滤芯更换指示，使用更省心； 缺水自动保护功能，安全可靠； 超长定时功能，满足人们睡眠使用需要； 智能恒湿系统实时显示室内湿度，自动调节室内湿度环境，使用更舒心； 进风口高效活性炭过滤网，过滤空气中的粉尘和杂质； 新一代蒸发滤芯，加湿无&ldquo;白粉&rdquo;，耐酸碱，易清洁； 银离子杀菌网，有效保持加湿洁净、无菌； 释放高浓度负离子，改善空气质量。</p>', '', 'GSZ-3001', '0.00', '560.00', '0.00', '0', '0', '0', '0000-00-00', '500', '800', '', '0', '0', '6', '0', '0000-00-00 00:00:00', '2011-03-07 16:49:54', '/media/1/products/1298861260_s.jpg', '/media/1/products/1298861260.jpg|1,/media/1/products/1298861268.jpg', '', '', '', '344', '', '', '', '0', '0', '16', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('57', '加湿器', '', '<p>容量:2.5L<br />\r\n颜色:蓝色<br />\r\n额定电压:220V-50HZ<br />\r\n额定功率:30W<br />\r\n雾化量: 冷雾&gt;=180ml/h<br />\r\n噪音:&lt;35dB(A)<br />\r\n<!--35dB--> 格力加湿器的优势 <br />\r\n★改善空气质量，舒适健康<br />\r\n★独有蒸发滤芯更换指示，使用更省心 <br />\r\n★缺水自动保护功能，安全可靠 <br />\r\n★先进抑噪技术，超静音 <br />\r\n★牢固壳体，优良分拆性，易装水设计 <br />\r\n★人性化注水口结构，方便实用<br />\r\n★新一代蒸发滤芯，加湿无&ldquo;白粉&rdquo;，耐酸碱，易清洁<br />\r\n★纳米抗菌技术，防霉、防菌<br />\r\n★超声波雾化量随意调节</p>\r\n<table width=\"90%\" cellspacing=\"0\" border=\"0\" style=\"font-size:12px;\">\r\n    <tbody>\r\n        <tr>\r\n            <td><img alt=\"\" src=\"/media/1/products/GS-2501-4.jpg\" /></td>\r\n            <td><span class=\"Apple-style-span\" style=\"border-collapse: collapse; font-family: \'arial helvetica sans-serif\'; line-height: 21px; \">★旋钮开关设计，雾量可任意调节&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />\r\n            ★缺水自动断电保护，使用安全；</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><span class=\"Apple-style-span\" style=\"border-collapse: collapse; font-family: \'arial helvetica sans-serif\'; line-height: 21px; \">★换能片采用玻璃釉工艺制造，有效防止水垢<br />\r\n            ★先进抑噪技术，超静音运行；</span></td>\r\n            <td><img alt=\"\" src=\"/media/1/products/GS-2501-5.jpg\" /></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\"\" src=\"/media/1/products/GS-2501-6.jpg\" /></td>\r\n            <td><span class=\"Apple-style-span\" style=\"border-collapse: collapse; font-family: 宋体; line-height: 21px; \">★防积水设计，有效防止因残留积水而滋生细菌</span></td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '', 'GS-2501', '0.00', '175.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '6', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '/media/1/products/1298878040_s.jpg', '/media/1/products/1298878040.jpg|1,/media/1/products/1298878040-1.jpg,/media/1/products/1298878041.jpg', '', '', '', '345', '', '', '', '0', '0', '2', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('58', '干衣机', '', '<p><img alt=\"\" src=\"/media/1/products/GSP20-2.jpg\" />&nbsp;<img alt=\"\" src=\"/media/1/products/GSP20-31.jpg\" /><img alt=\"\" src=\"/media/1/products/GSP20-3.jpg\" /><img alt=\"\" src=\"/media/1/products/GSP20-33.jpg\" /><img alt=\"\" src=\"/media/1/products/GSP20-5.jpg\" /></p>\r\n<p>&nbsp;</p>\r\n<p>型号：格力小太阳干衣机 GSP20<br />\r\n体积：500mm*415mm*595mm(长/宽/高)<br />\r\n重量：17KG<br />\r\n干衣容量：2.0KG<br />\r\n额定输入功率：热风：700W；<br />\r\n冷风：100W；<br />\r\n额定电压：220V额定频率：50Hz<br />\r\n定时器设定范围：<br />\r\n1、电热干燥：180分钟热风+20分钟冷风<br />\r\n2、冷风干燥：80分钟<br />\r\n<br />\r\n功能介绍：<br />\r\n1、外观新颖、小巧精致、操作方便、安全可靠；<br />\r\n2、静音运转、快速干衣、省电省时；<br />\r\n3、定时控制装置，走时精确无需守候；<br />\r\n4、采用PTC电子加热器，整体发热、温升迅速、干燥衣服迅速快捷；<br />\r\n5、可根据衣物耐热程度选定冷风或者热风干燥；<br />\r\n6、结束工作前，会自动转为冷风工作状态，迅速将衣物降至正常温度。</p>', '', 'GSP20', '0.00', '880.00', '0.00', '0', '0', '0', '0000-00-00', '800', '1000', '', '0', '0', '7', '0', '2011-03-01 14:09:12', '2011-03-01 14:17:44', '/media/1/products/1298959749_s.jpg', '/media/1/products/1298959749.jpg|1', '', '', '', '346', '', '', '', '0', '0', '26', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('59', '干衣机', '', '<p>&nbsp;<img alt=\"\" src=\"/media/1/products/GSP10B-62.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/GSP10B-63.jpg\" /></p>\r\n<p>&nbsp;</p>\r\n<p>1、外观新颖、小巧精致、操作方便、安全可靠<br />\r\n2、静音运转、快速干衣、省电省时<br />\r\n3、定时控制装置，走时精确无需守候<br />\r\n4、采用PTC电子加热器，整体发热、温升迅速、干燥衣服迅速快捷<br />\r\n5、可根据衣物耐热程度选定冷风或者热风干燥<br />\r\n6、结束工作前，会自动转为冷风工作状态，迅速将衣物降至正常温度<br />\r\n<br />\r\n格力干衣机主要技术参数表:<br />\r\n型号 ：    GSP10B       <br />\r\n体积  ：  450mm*327 mm*545mm(长/宽/高)<br />\r\n重量 ：       11.6KG    <br />\r\n毛重  ：      16公斤 <br />\r\n马达输入功率 ：  110W<br />\r\n额定电压    220V      <br />\r\n电热器功率  ：   510W                       额定频率    50Hz   <br />\r\n干衣容量  ：    1.0KG<br />\r\n定时器设定范围   <br />\r\n电热干燥  ：   100分+8分钟冷风<br />\r\n冷风干燥  ：   60分钟</p>', '', 'GSP10B', '0.00', '568.00', '0.00', '0', '0', '0', '0000-00-00', '500', '800', '', '0', '0', '7', '0', '2011-03-01 14:35:08', '2011-03-01 14:35:41', '/media/1/products/1298961332_s.jpg', '/media/1/products/1298961015.jpg|1,/media/1/products/1298961015-1.jpg,/media/1/products/1298961016.jpg,/media/1/products/1298961332.jpg', '', '', '', '347', '', '', '', '0', '0', '94', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('60', '电暖器', '', '<p>主要功能特点：<br />\r\n<br />\r\n◆ 浴室居室两用设计，IP&times;4防水级机身;<br />\r\n◆ 精良正温度系数陶瓷发热体加热，即开即暖<br />\r\n◆ 超温，过热多重安全保护装置<br />\r\n◆ 高温摆页送暖功能设计，送暖范围广<br />\r\n◆ 冷风,低热,高热功率可调<br />\r\n◆ 可手动调节出风口的方向<br />\r\n◆ 适用面积:14-16平米<br />\r\n<br />\r\n基本参数:<br />\r\n额定电压：220V<br />\r\n额定频率：50HZ<br />\r\n输入功率：1500W<br />\r\n</p>\r\n<table width=\"90%\" border=\"0\">\r\n    <tbody>\r\n        <tr>\r\n            <td><img alt=\"\" src=\"/media/1/products/NT-15-5.jpg\" /></td>\r\n            <td><span class=\"Apple-style-span\" style=\"border-collapse: collapse; color: rgb(204, 51, 0); font-family: \'arial helvetica sans-serif\'; line-height: 21px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; \">产品特性：<br />\r\n            ★高温摆页送暖功能设计，送暖范围广<span>&nbsp;</span><br />\r\n            ★可手动调节出风口的方向</span></td>\r\n        </tr>\r\n        <tr>\r\n            <td><span class=\"Apple-style-span\" style=\"border-collapse: collapse; color: rgb(204, 51, 0); font-family: \'arial helvetica sans-serif\'; line-height: 21px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; \">★冷风,低热,高热功率可调<br />\r\n            ★超温，过热多重安全保护装置<br />\r\n            ★先进的PTC陶瓷材料，加热效果好，耐老化耐衰减，节能省电；</span></td>\r\n            <td><img alt=\"\" src=\"/media/1/products/NT-15-6.jpg\" /></td>\r\n        </tr>\r\n        <tr>\r\n            <td><img alt=\"\" src=\"/media/1/products/NT-15-7.jpg\" /></td>\r\n            <td><span class=\"Apple-style-span\" style=\"border-collapse: collapse; color: rgb(204, 51, 0); font-family: \'arial helvetica sans-serif\'; line-height: 21px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; \">★浴室居室两用设计，IP&times;4防水级机身<br />\r\n            ★精良正温度系数陶瓷发热体加热，即开即暖<br />\r\n            ★可壁挂使用，方便实用 ；</span></td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '', 'KNT-15', '0.00', '150.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '8', '0', '2011-03-03 15:38:25', '0000-00-00 00:00:00', '/media/1/products/1299137697_s.jpg', '/media/1/products/1299137697.jpg|1,/media/1/products/1299137697-1.jpg,/media/1/products/1299137698.jpg', '', '', '', '348', '', '', '', '0', '0', '1', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('61', '电暖器', '', '<p><img alt=\"\" src=\"/media/1/products/NT-21-2.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/NT-21-3.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/NT-21-4.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/NT-21-5.jpg\" /><br />\r\n&nbsp;</p>\r\n<p>1.采用PTC发热体，电热转换效率高，升温迅速，无火，不耗氧，并能随室温的提高而自动降低输入功率，具有良好的温度自限，节能效果；<br />\r\n2.优化风道设计，进风量大，静压低，风速大，取暖效果好；<br />\r\n3.专门的防溅水设计，防水等级1P*4，使该暖风机可允许在浴室工作；<br />\r\n4.设有专门的双重过热保护功能，具有可靠的安全保障；<br />\r\n5.手动摆叶设计，实现送风方向手动调节；<br />\r\n6.整机可平放，壁挂方式使用，占用空间小；<br />\r\n7.三种工作模式可调：冷风，低热，高热；<br />\r\n<br />\r\n尺寸：346*280*168<br />\r\n重量：2.52<br />\r\n功率：35/1100~1400/2100（W)</p>', '', 'NBFB-21', '0.00', '165.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '8', '0', '2011-03-03 15:51:07', '0000-00-00 00:00:00', '/media/1/products/1299138542_s.jpg', '/media/1/products/1299138542.jpg|1', '', '', '', '349', '', '', '', '0', '0', '4', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('62', '电暖器', '', '<p>&nbsp;<img alt=\"\" src=\"/media/1/products/QG20D-2.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/QG20D-3.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/QG20D-4.jpg\" /></p>\r\n<p>浴室居室两用设计，IP*4防水级机身<br />\r\n.  精良正温度系数陶瓷发热体加热，即开即暖<br />\r\n.  壁挂空调式设计，时尚美观<br />\r\n.  专利外形设计<br />\r\n.  高/低热功率可调，冷/热风可供选择，风力强劲<br />\r\n.  1200W/2000W两档功率可调<br />\r\n<br />\r\n11、豪华时尚液晶显示，尽显尊贵。<br />\r\n12、快热：格力快热炉采用快热蒸发器作为发热元件，空气自然对流加热，特有的发热原理能快速实现热交换，取暖效果自然不错；<br />\r\n<br />\r\n升温时间 5（min）<br />\r\n型号 NDYB-18B<br />\r\n重量 9.94（kg）<br />\r\n外形尺寸 858*192*725（mm）<br />\r\n温度范围 0-100（℃）<br />\r\n电源频率 50（Hz）<br />\r\n电源电压 220（V）<br />\r\n额定功率 1800（W）</p>', '', 'QG20D', '0.00', '218.00', '0.00', '0', '0', '0', '0000-00-00', '200', '300', '', '0', '0', '8', '0', '2011-03-03 16:05:42', '0000-00-00 00:00:00', '/media/1/products/1299139434_s.jpg', '/media/1/products/1299139434.jpg|1', '', '', '', '350', '', '', '', '0', '0', '2', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('63', '电暖器', '', '<p><img style=\"width: 740px; height: 740px;\" alt=\"\" src=\"/media/1/products/NSF-8-1.jpg\" /><img alt=\"\" src=\"/media/1/products/NSF-8-2.jpg\" /><img alt=\"\" src=\"/media/1/products/NSF-8-3.jpg\" /><img alt=\"\" src=\"/media/1/products/NSF-8-4.jpg\" /><img alt=\"\" src=\"/media/1/products/NSF-8-5.jpg\" /><img alt=\"\" src=\"/media/1/products/NSF-8-6.jpg\" /><br />\r\n&nbsp;</p>\r\n<p>额定电源：220V/50HZ<br />\r\n额定功率：800W<br />\r\n体    积：490X360X440mm<br />\r\n1.超远距离及大角度摇头送暖<br />\r\n2.抛物面聚能反射，热力强劲<br />\r\n3.远红外线加热，升温迅速<br />\r\n4.倾倒防护，确保安全无忧<br />\r\n5.可俯视角调节</p>', '', 'NSF-8', '123.00', '148.00', '0.00', '0', '0', '0', '0000-00-00', '0', '0', '', '0', '0', '8', '0', '2011-03-03 16:18:44', '2011-04-14 16:27:11', '/media/1/products/1299140209_s.jpg', '/media/1/products/1299140208.jpg,/media/1/products/1299140209.jpg|1,/media/1/products/1299140209-1.jpg', '', 'a:2:{s:4:\"attr\";a:0:{}s:4:\"aimg\";N;}', 'a:0:{}', '351', '', '', '', '0', '0', '8', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('64', '电暖器', '', '<p>1.卤素管过压信赖测试超5000小时，水淋不裂<br />\r\n2.高亮度镜面反射罩，热量反射均匀强劲<br />\r\n3.水平宽幅自动摇头送暖，温馨居室暖洋洋<br />\r\n4.400W∕800W∕1200W高中低功率自由选择<br />\r\n5.跌倒自动关机保护</p>\r\n<p>产品型号：格力FGK-12<br />\r\n适用面积：&lt;20平米<br />\r\n<!--20--> 额定电压：220V~50hz<br />\r\n额定功率：1200W</p>', '', 'FGK-12', '0.00', '188.00', '0.00', '0', '0', '0', '0000-00-00', '100', '200', '', '0', '0', '8', '0', '2011-03-03 16:25:37', '0000-00-00 00:00:00', '/media/1/products/1299140697_s.jpg', '/media/1/products/1299140697.jpg|1', '', '', '', '352', '', '', '', '0', '0', '3', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('65', '电暖器', '', '<p><img alt=\"\" src=\"/media/1/products/NDY20K-3.jpg\" /><img alt=\"\" src=\"/media/1/products/NDY20K-4.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/NDY20K-5.jpg\" /><br />\r\n<br />\r\n&nbsp;</p>\r\n<p>双发热管加热，有效防止漏电<br />\r\n优质超厚内胆钢板，数控双卷边技术一次成型<br />\r\n独特的散热片装置，自然对流加热更温和<br />\r\n3挡温度调节，温度随心控制<br />\r\n具有超温、过载多重自动断电保护功能<br />\r\n高级导热油，传温好，无损耗，不挥发<br />\r\n无明火，无辐射，无噪音，自动控温<br />\r\n传热快，3-5分钟即发热<br />\r\n敞开式结构，造型新颖别致<br />\r\n独特绕线设计,方便实用<br />\r\n随即赠送精美凉衣架<br />\r\n万向脚轮，移动方便;</p>', '', 'NDY20K', '0.00', '285.00', '0.00', '0', '0', '0', '0000-00-00', '200', '300', '', '0', '0', '8', '0', '2011-03-03 16:40:55', '2011-03-03 16:41:12', '/media/1/products/1299141517_s.jpg', '/media/1/products/1299141516.jpg,/media/1/products/1299141517.jpg|1', '', '', '', '353', '', '', '', '0', '0', '5', '1', '1', '', '3', '0');
INSERT INTO `w_products` VALUES ('66', '电暖器', '', '<p><img alt=\"\" src=\"/media/1/products/NTSA-7-1.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/NTSA-7-2.jpg\" /><br />\r\n<img alt=\"\" src=\"/media/1/products/NTSA-7-3.jpg\" /><br />\r\n&nbsp;</p>\r\n<p>1. 倾斜15度不倾倒，反光方向手动可调<br />\r\n2. 安全可靠，通过IEC60335-1标准非正常试验<br />\r\n3. 选用优质耐温材料，通过IEC60335-1标准&ldquo;球压&rdquo;试验<br />\r\n4. 电源插头配置内胆，安全可靠<br />\r\n5. 配置IEC245标准认可的耐候性能良好的53号橡胶线<br />\r\n6. 加大反射罩，辐射范围广，热量传递效率高<br />\r\n7. 银合金触点开关，电阻小，寿命长<br />\r\n8. 跌倒断电功能，安全保障<br />\r\n9. 碳素管耐冷热聚变冲击，即开即热<br />\r\n10. 350W/700W强弱二档可选<br />\r\n11.寿命长，可在额定电压及正常工况条件下工作，实际寿命可达1万小时以上；<br />\r\n12.抛物线形镜面反射板，辐射范围广，热量传递效率高；<br />\r\n13.碳素灯管发光暗淡柔和，电热转换效率高；<br />\r\n14.碳素灯管发光具有良好的穿透能力，容易激活细胞，起到疏筋络骨的保健作用；<br />\r\n15.反射方向手动调节。</p>', '', 'NTSA-7', '0.00', '245.00', '0.00', '0', '0', '0', '0000-00-00', '200', '300', '', '0', '0', '8', '0', '2011-03-03 16:55:19', '0000-00-00 00:00:00', '/media/1/products/1299141949_s.jpg', '/media/1/products/1299141949.jpg|1', '', '', '', '354', '', '', '', '0', '0', '13', '1', '1', '', '0', '0');
INSERT INTO `w_products` VALUES ('67', '电暖器', '', '<p><img alt=\"\" src=\"/media/1/products/NSK-9-1.jpg\" /><img alt=\"\" src=\"/media/1/products/NSK-9-2.jpg\" /><img alt=\"\" src=\"/media/1/products/NSK-9-4.jpg\" /><img alt=\"\" src=\"/media/1/products/NSK-9-5.jpg\" /><br />\r\n&nbsp;</p>\r\n<p><strong>产品特性：</strong><br />\r\n<br />\r\n★400W/800W两档功率可调<br />\r\n★石英管发热体，即开即暖<br />\r\n★镜面反射板，辐射范围广，热量传递效率高<br />\r\n★体积小巧，放置自由；<br />\r\n★电源插头配置内胆，更安全<br />\r\n★跌倒自动关机保护，安全可靠<br />\r\n★高稳定性，置于15&deg;斜台上不翻到<br />\r\n★全封闭结构设计，符合国家安全标准。<br />\r\n经过严格的测试，安全性能好；<br />\r\n<br />\r\n* 型号/规格：NSW-8<br />\r\n* 额定电压及定额频率：220V~50hz<br />\r\n* 输入/输出功率：800W<br />\r\n* 尺寸：180mm*225mm*430mm<br />\r\n* 毛重：2.30<br />\r\n* 净重: 1.60<br />\r\n* 适用面积:&lt;15平米<br />\r\n<!--15--></p>', '', 'NSW-8 ', '0.00', '65.00', '0.00', '0', '0', '0', '0000-00-00', '50', '100', '', '0', '0', '8', '0', '2011-03-03 17:09:18', '2011-03-03 17:12:03', '/media/1/products/1299143354-1_s.jpg', '/media/1/products/1299143353.jpg,/media/1/products/1299143353-1.jpg,/media/1/products/1299143354.jpg,/media/1/products/1299143354-1.jpg|1', '', '', '', '355', '', '', '', '0', '0', '122', '1', '1', '', '2', '0');
drop table if exists w_products_activity;
CREATE TABLE `w_products_activity` (
  `act_id` mediumint(8) unsigned NOT NULL auto_increment,
  `act_name` varchar(255) NOT NULL,
  `act_desc` text NOT NULL,
  `act_type` tinyint(3) unsigned NOT NULL,
  `products_id` mediumint(8) unsigned NOT NULL,
  `products_name` varchar(255) NOT NULL,
  `img` varchar(50) default NULL,
  `product_amount` mediumint(4) NOT NULL default '0',
  `purchase_num` mediumint(4) NOT NULL default '0' COMMENT '已购买数量',
  `purchase_people` mediumint(4) NOT NULL default '0' COMMENT '购买人数',
  `market_price` float(4,2) NOT NULL default '0.00',
  `shop_price` float(4,2) NOT NULL default '0.00',
  `start_time` int(10) unsigned NOT NULL,
  `end_time` int(10) unsigned NOT NULL,
  `is_finished` tinyint(3) unsigned NOT NULL,
  `ext_info` text NOT NULL,
  `uid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`act_id`),
  KEY `act_name` (`act_name`,`act_type`,`products_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

INSERT INTO `w_products_activity` VALUES ('15', '格力电风扇FSLD-40 扇头360°循环送风 低压启动', '', '2', '23', '电风扇', '/media/1/products/1298441606.jpg', '0', '0', '0', '0.00', '0.00', '1302825600', '1304035200', '0', 'a:5:{s:7:\"deposit\";i:0;s:15:\"restrict_amount\";i:0;s:13:\"gift_integral\";i:0;s:13:\"ladder_amount\";N;s:12:\"ladder_price\";N;}', '1');
INSERT INTO `w_products_activity` VALUES ('16', '格力暖风机取暖器NBFB-21', '', '2', '64', '电暖器', '/media/1/products/1299140697.jpg', '0', '0', '0', '0.00', '0.00', '1302825600', '1303430400', '0', 'a:5:{s:7:\"deposit\";i:0;s:15:\"restrict_amount\";i:0;s:13:\"gift_integral\";i:0;s:13:\"ladder_amount\";N;s:12:\"ladder_price\";N;}', '1');
INSERT INTO `w_products_activity` VALUES ('13', '格力(GREE) 变频王者之尊系列 家用空调KFR-72LW(72561)Ab-2', '<p>asdfasfd</p>', '1', '419', '格力防水防火防漏电浴居两用暖风机取暖器/电暖器NBFB-21', '/media/1/products/1299138542.jpg', '0', '0', '32', '99.99', '0.00', '1298937600', '1298937600', '0', 'a:5:{s:7:\"deposit\";i:122;s:15:\"restrict_amount\";i:12;s:13:\"gift_integral\";i:0;s:13:\"ladder_amount\";a:1:{i:0;s:3:\"100\";}s:12:\"ladder_price\";a:1:{i:0;s:4:\"2000\";}}', '1');
INSERT INTO `w_products_activity` VALUES ('14', '格力电水壶 GK-CS1512DA 不锈钢 磨砂表面3', '<p>格力电水壶 GK-CS1512DA 不锈钢 磨砂表面</p>', '1', '273', '格力电水壶 GK-CS1512DA 不锈钢 磨砂表面', '/media/1/products/1298619030_s.jpg', '0', '0', '12', '99.99', '0.00', '1300161780', '1300320000', '4', 'a:5:{s:7:\"deposit\";i:0;s:15:\"restrict_amount\";i:888;s:13:\"gift_integral\";i:0;s:13:\"ladder_amount\";a:1:{i:0;s:3:\"100\";}s:12:\"ladder_price\";a:1:{i:0;s:2:\"90\";}}', '1');
INSERT INTO `w_products_activity` VALUES ('17', '格力电风扇FSLD-40 扇头360°循环送风 低压启动', '', '2', '29', '格力电风扇FSLD-40 扇头360°循环送风 低压启动', '/media/1/products/1298445546.jpg', '0', '0', '0', '0.00', '0.00', '1302825600', '1306540800', '0', 'a:5:{s:7:\"deposit\";i:0;s:15:\"restrict_amount\";i:0;s:13:\"gift_integral\";i:0;s:13:\"ladder_amount\";N;s:12:\"ladder_price\";N;}', '1');
INSERT INTO `w_products_activity` VALUES ('18', '电饭煲', '', '3', '17', '电饭煲', '/media/1/products/1298428582.jpg', '0', '0', '0', '0.00', '23.00', '1302865320', '1303344000', '0', 'a:5:{s:7:\"deposit\";i:0;s:15:\"restrict_amount\";i:213;s:13:\"gift_integral\";i:0;s:13:\"ladder_amount\";N;s:12:\"ladder_price\";N;}', '1');
INSERT INTO `w_products_activity` VALUES ('19', '电暖器', '', '3', '65', '电暖器', '/media/1/products/1299141517.jpg', '0', '0', '0', '0.00', '0.00', '1303470000', '0', '0', 'a:5:{s:7:\"deposit\";i:0;s:15:\"restrict_amount\";i:0;s:13:\"gift_integral\";i:0;s:13:\"ladder_amount\";N;s:12:\"ladder_price\";N;}', '1');
drop table if exists w_products_attr_v;
CREATE TABLE `w_products_attr_v` (
  `products_id` mediumint(8) unsigned NOT NULL default '0',
  `attr_id` smallint(5) unsigned NOT NULL default '0',
  `attr_value_id` mediumint(8) unsigned NOT NULL default '0',
  KEY `goods_id` (`products_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

drop table if exists w_products_attr_values;
CREATE TABLE `w_products_attr_values` (
  `value_id` mediumint(8) unsigned NOT NULL auto_increment,
  `attr_id` mediumint(8) unsigned NOT NULL default '0',
  `value` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `ordering` mediumint(8) unsigned NOT NULL default '50',
  PRIMARY KEY  (`value_id`,`value`),
  KEY `fk_spec_value` (`attr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

drop table if exists w_products_attribute;
CREATE TABLE `w_products_attribute` (
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `w_products_attribute` VALUES ('1', '1', 'asdfasdf', '0', '0', '', '0', '0', '0', '0');
drop table if exists w_products_cat;
CREATE TABLE `w_products_cat` (
  `products_id` mediumint(8) unsigned NOT NULL default '0',
  `cat_id` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`products_id`,`cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `w_products_cat` VALUES ('1', '1');
INSERT INTO `w_products_cat` VALUES ('1', '2');
drop table if exists w_products_comment;
CREATE TABLE `w_products_comment` (
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `w_products_comment` VALUES ('1', '0', '154', '', 'china', 'sadfasdf', '0', '1299662500', '', '0', '0', '1');
INSERT INTO `w_products_comment` VALUES ('2', '0', '154', '', 'china', '不错的产品！', '0', '1299662574', '', '0', '0', '1');
INSERT INTO `w_products_comment` VALUES ('3', '0', '154', 'whl308221710@163.com', 'china', '谢谢支持！', '0', '1299662594', '', '0', '2', '1');
INSERT INTO `w_products_comment` VALUES ('4', '0', '426', '', 'china', '下下gggggggggggggggggggggggg', '0', '1299747590', '', '0', '0', '1');
INSERT INTO `w_products_comment` VALUES ('5', '0', '426', '', 'testtest2', 'asfdsadf', '0', '1299824439', '', '0', '0', '109');
INSERT INTO `w_products_comment` VALUES ('6', '0', '168', '', 'testtest', 'sadfasdf', '0', '1300245820', '', '0', '0', '89');
drop table if exists w_products_fav;
CREATE TABLE `w_products_fav` (
  `id` int(11) NOT NULL auto_increment,
  `products_id` int(11) NOT NULL default '0' COMMENT '产品ID',
  `mid` int(11) NOT NULL default '0' COMMENT '经销商ID',
  `uid` int(11) NOT NULL default '0' COMMENT '会员ID',
  `created` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `products_id` (`products_id`,`mid`,`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

INSERT INTO `w_products_fav` VALUES ('20', '212', '0', '1', '2011-02-24 12:12:11');
INSERT INTO `w_products_fav` VALUES ('19', '218', '0', '1', '2011-02-24 12:12:09');
INSERT INTO `w_products_fav` VALUES ('18', '222', '0', '1', '2011-02-24 12:12:06');
INSERT INTO `w_products_fav` VALUES ('17', '227', '0', '1', '2011-02-24 12:12:03');
INSERT INTO `w_products_fav` VALUES ('16', '129', '0', '1', '2011-02-23 15:50:15');
INSERT INTO `w_products_fav` VALUES ('25', '288', '1', '89', '2011-02-28 17:41:36');
INSERT INTO `w_products_fav` VALUES ('23', '152', '1', '1', '2011-02-25 10:13:20');
INSERT INTO `w_products_fav` VALUES ('26', '312', '1', '89', '2011-03-01 16:36:54');
INSERT INTO `w_products_fav` VALUES ('27', '311', '89', '89', '2011-03-01 16:39:02');
INSERT INTO `w_products_fav` VALUES ('28', '311', '1', '89', '2011-03-01 17:26:43');
INSERT INTO `w_products_fav` VALUES ('29', '317', '1', '89', '2011-03-02 10:12:49');
INSERT INTO `w_products_fav` VALUES ('30', '316', '1', '89', '2011-03-02 10:25:25');
INSERT INTO `w_products_fav` VALUES ('32', '155', '89', '89', '2011-03-02 10:35:08');
INSERT INTO `w_products_fav` VALUES ('33', '426', '1', '89', '2011-03-04 14:11:53');
INSERT INTO `w_products_fav` VALUES ('35', '259', '89', '89', '2011-03-16 11:29:54');
INSERT INTO `w_products_fav` VALUES ('36', '293', '116', '89', '2011-03-16 11:40:20');
INSERT INTO `w_products_fav` VALUES ('37', '425', '116', '89', '2011-03-16 11:46:56');
INSERT INTO `w_products_fav` VALUES ('49', '267', '89', '89', '2011-03-17 12:33:49');
INSERT INTO `w_products_fav` VALUES ('48', '293', '1', '89', '2011-03-16 17:27:53');
drop table if exists w_products_group;
CREATE TABLE `w_products_group` (
  `parent_id` mediumint(8) unsigned NOT NULL default '0',
  `products_id` mediumint(8) unsigned NOT NULL default '0',
  `products_price` decimal(10,2) unsigned NOT NULL default '0.00',
  `admin_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`parent_id`,`products_id`,`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `w_products_group` VALUES ('9', '4', '58.00', '1');
INSERT INTO `w_products_group` VALUES ('9', '3', '68.00', '1');
INSERT INTO `w_products_group` VALUES ('9', '7', '100.00', '1');
INSERT INTO `w_products_group` VALUES ('14', '5', '20.00', '1');
INSERT INTO `w_products_group` VALUES ('14', '6', '42.00', '1');
INSERT INTO `w_products_group` VALUES ('14', '7', '100.00', '1');
INSERT INTO `w_products_group` VALUES ('141', '135', '0.00', '0');
INSERT INTO `w_products_group` VALUES ('129', '142', '232.32', '0');
INSERT INTO `w_products_group` VALUES ('129', '143', '0.00', '0');
INSERT INTO `w_products_group` VALUES ('144', '129', '23.00', '0');
INSERT INTO `w_products_group` VALUES ('144', '130', '32.00', '0');
INSERT INTO `w_products_group` VALUES ('144', '135', '2618.00', '0');
INSERT INTO `w_products_group` VALUES ('144', '144', '12.00', '0');
INSERT INTO `w_products_group` VALUES ('143', '140', '0.00', '0');
INSERT INTO `w_products_group` VALUES ('143', '143', '0.00', '0');
INSERT INTO `w_products_group` VALUES ('143', '144', '0.00', '0');
drop table if exists w_products_link;
CREATE TABLE `w_products_link` (
  `products_id` mediumint(8) unsigned NOT NULL default '0',
  `products_link_id` mediumint(8) unsigned NOT NULL default '0',
  `is_double` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`products_id`,`products_link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `w_products_link` VALUES ('144', '141', '0');
INSERT INTO `w_products_link` VALUES ('144', '140', '0');
INSERT INTO `w_products_link` VALUES ('144', '139', '0');
INSERT INTO `w_products_link` VALUES ('144', '135', '0');
INSERT INTO `w_products_link` VALUES ('144', '130', '0');
INSERT INTO `w_products_link` VALUES ('144', '129', '0');
INSERT INTO `w_products_link` VALUES ('141', '142', '1');
INSERT INTO `w_products_link` VALUES ('141', '141', '0');
INSERT INTO `w_products_link` VALUES ('141', '139', '0');
INSERT INTO `w_products_link` VALUES ('146', '145', '0');
INSERT INTO `w_products_link` VALUES ('146', '144', '0');
INSERT INTO `w_products_link` VALUES ('146', '143', '0');
INSERT INTO `w_products_link` VALUES ('146', '140', '0');
INSERT INTO `w_products_link` VALUES ('144', '142', '0');
INSERT INTO `w_products_link` VALUES ('144', '143', '0');
INSERT INTO `w_products_link` VALUES ('144', '144', '0');
INSERT INTO `w_products_link` VALUES ('146', '146', '0');
drop table if exists w_products_series;
CREATE TABLE `w_products_series` (
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
) ENGINE=MyISAM AUTO_INCREMENT=193 DEFAULT CHARSET=utf8;

INSERT INTO `w_products_series` VALUES ('156', 'KFR-23GW/Q(23550)FdNA1-N4', '', '/media/1/products/1298428343_s.jpg', '/media/1/products/1298428343.jpg', '', '1', '1', '1', '11');
INSERT INTO `w_products_series` VALUES ('155', 'KFR-35GW/(3550)FNAa-3 ', '', '/media/1/products/1298426926_s.jpg', '/media/1/products/1298426926.jpg', '', '1', '1', '1', '10');
INSERT INTO `w_products_series` VALUES ('154', 'KFR-32GW/(32550)FNAa-3', '', '/media/1/products/1298425585.jpg', '/media/1/products/1298425585.jpg', '', '1', '1', '1', '9');
INSERT INTO `w_products_series` VALUES ('139', '睡美人系列', '', '/media/1/products/1298968092_s.jpg', '/media/1/products/1298968092.jpg|1,/media/1/products/1298968093.jpg,/media/1/products/1298968201.jpg,/media/1/products/1298968216.jpg', '', '1', '4', '0', '1');
INSERT INTO `w_products_series` VALUES ('147', 'KFR-26GW/E(26541)', '', '/media/1/products/1298342898_s.jpg', '/media/1/products/1298342898.jpg|1', '', '1', '1', '1', '3');
INSERT INTO `w_products_series` VALUES ('148', 'KFR-26GW/K(26538)Fd', '', '/media/1/products/1298345900_s.jpg', '/media/1/products/1298345900.jpg', '', '1', '1', '1', '5');
INSERT INTO `w_products_series` VALUES ('149', 'KFR-35GW/E(3554)FdNA1-N1', '', '/media/1/products/1298356705_s.jpg', '/media/1/products/1298356705.jpg', '', '1', '1', '1', '2');
INSERT INTO `w_products_series` VALUES ('150', ' KFR-35GN/E(35541)FdNA', '', '/media/1/products/1298359933_s.jpg', '/media/1/products/1298359933.jpg', '', '1', '1', '1', '4');
INSERT INTO `w_products_series` VALUES ('151', '睡梦宝系列', '', '/media/1/products/1298362912_s.jpg', '/media/1/products/1298362912.jpg,/media/1/products/1299031621.jpg,/media/1/products/1299031621-1.jpg,/media/1/products/1299031745.jpg', '', '1', '4', '1', '6');
INSERT INTO `w_products_series` VALUES ('152', 'KFR-23GW/(23550)FNAa-3', '', '/media/1/products/1298364755_s.jpg', '/media/1/products/1298364755.jpg', '', '1', '1', '1', '7');
INSERT INTO `w_products_series` VALUES ('153', 'KFR-26GW/(26550)FNAa-3', '', '/media/1/products/1298424310_s.jpg', '/media/1/products/1298424310.jpg', '', '1', '1', '1', '8');
INSERT INTO `w_products_series` VALUES ('157', 'KFR-26GW/Q(26550)FdNA1-N4 ', '', '/media/1/products/1298430668_s.jpg', '/media/1/products/1298430668.jpg', '', '1', '1', '1', '12');
INSERT INTO `w_products_series` VALUES ('158', 'KFR-26GW/(26556)FNFa-3', '', '/media/1/products/1298433925_s.jpg', '/media/1/products/1298433925.jpg', '', '1', '1', '1', '13');
INSERT INTO `w_products_series` VALUES ('159', 'KFR-32GW/(32556)FNFa-3', '', '/media/1/products/1298440107_s.jpg', '/media/1/products/1298440107.jpg', '', '1', '1', '1', '14');
INSERT INTO `w_products_series` VALUES ('160', 'KFR-26GW/(26556)FNDc-3', '', '/media/1/products1298441871_s.jpg', '/media/1/products1298441871.jpg', '', '1', '1', '1', '15');
INSERT INTO `w_products_series` VALUES ('161', 'KFR-26GW/(26556)FNAe-3', '', '/media/1/products/1298444868_s.jpg', '/media/1/products/1298444868.jpg', '', '1', '1', '1', '16');
INSERT INTO `w_products_series` VALUES ('162', 'KFR-26GW/(26556)FNPa-4', '', '/media/1/products/1298447087_s.jpg', '/media/1/products/1298447087.jpg', '', '1', '1', '1', '17');
INSERT INTO `w_products_series` VALUES ('163', 'U酷 KFR-26GW/(26561)FNAa-3', '', '/media/1/products/1298454105_s.jpg', '/media/1/products/1298454105.jpg,/media/1/products/1298454106.jpg|1,/media/1/products/1298454107.jpg|1', '', '1', '3', '1', '18');
INSERT INTO `w_products_series` VALUES ('164', 'U雅 KFR-26GW/(26561)FNCa-2', '', '/media/1/products/1298602728_s.jpg', '/media/1/products/1298602728.jpg|1,/media/1/products/1298602729.jpg,/media/1/products/1298602729-1.jpg', '', '1', '3', '1', '19');
INSERT INTO `w_products_series` VALUES ('165', 'U铂 KFR-26GW/(26561)FNBa-2 ', '', '/media/1/products/1298613153_s.jpg', '/media/1/products/1298613153.jpg|1,/media/1/products/1298613154.jpg,/media/1/products/1298613155.jpg', '', '1', '3', '1', '20');
INSERT INTO `w_products_series` VALUES ('166', 'i铂', '', '/media/1/products/1298621255_s.jpg', '/media/1/products/1298621255.jpg|1,/media/1/products/1298621264.jpg,/media/1/products/1298621274.jpg', '', '1', '3', '1', '21');
INSERT INTO `w_products_series` VALUES ('167', 'i酷', '', '/media/1/products/1298624625_s.jpg', '/media/1/products/1298624625.jpg|1,/media/1/products/1298624639.jpg,/media/1/products/1298624648.jpg', '', '1', '3', '1', '22');
INSERT INTO `w_products_series` VALUES ('169', '变频王者之尊系列 ', '', '/media/1/products/1298872469_s.jpg', '/media/1/products/1298872469.jpg|1,/media/1/products/1298872470.jpg,/media/1/products/1298872471.jpg,/media/1/products/1298872472.jpg', '', '1', '4', '1', '23');
INSERT INTO `w_products_series` VALUES ('170', '变频王者风尚系列', '', '/media/1/products/1298875304_s.jpg', '/media/1/products/1298875304.jpg|1,/media/1/products/1298875305.jpg,/media/1/products/1298875305-1.jpg', '', '1', '3', '1', '24');
INSERT INTO `w_products_series` VALUES ('171', '变频王者风度系列', '', '/media/1/products/1298877278_s.jpg', '/media/1/products/1298877278.jpg|1,/media/1/products/1298877279.jpg', '', '1', '2', '1', '25');
INSERT INTO `w_products_series` VALUES ('172', '变频悦轩风系列', '', '/media/1/products/1298879951_s.jpg', '/media/1/products/1298879951.jpg|1,/media/1/products/1298879952.jpg', '', '1', '2', '1', '26');
INSERT INTO `w_products_series` VALUES ('173', '变频风影系列', '', '/media/1/products/1298881639_s.jpg', '/media/1/products/1298881639.jpg|1,/media/1/products/1298881639-1.jpg,', '', '1', '2', '1', '27');
INSERT INTO `w_products_series` VALUES ('174', '变频蓝海湾系列', '', '/media/1/products/1298882914_s.jpg', '/media/1/products/1298882914.jpg|1,/media/1/products/1298882915.jpg', '', '1', '2', '1', '28');
INSERT INTO `w_products_series` VALUES ('175', '变频蓝精灵系列', '', '/media/1/products/1298884655_s.jpg', '/media/1/products/1298884655.jpg|1,/media/1/products/1298884656.jpg', '', '1', '2', '1', '29');
INSERT INTO `w_products_series` VALUES ('176', '变频凯迪斯', '', '/media/1/products/1298885912_s.jpg', '/media/1/products/1298885912.jpg|1', '', '1', '1', '1', '30');
INSERT INTO `w_products_series` VALUES ('177', '节能王子系列', '', '/media/1/products/1299043024-1_s.jpg', '/media/1/products/1299043023.jpg|1,/media/1/products/1299043024.jpg,/media/1/products/1299043024-1.jpg,/media/1/products/1299043025.jpg,/media/1/products/1299043043.jpg', '', '1', '5', '1', '31');
INSERT INTO `w_products_series` VALUES ('178', '玉堂春(新品)', '', '/media/1/products/1299048224_s.jpg', '/media/1/products/1299048224.jpg|1,/media/1/products/1299048233.jpg', '', '1', '2', '1', '32');
INSERT INTO `w_products_series` VALUES ('179', '绿满园系列', '', '/media/1/products/1299050293_s.jpg', '/media/1/products/1299050271.jpg|1,/media/1/products/1299050293.jpg', '', '1', '2', '1', '33');
INSERT INTO `w_products_series` VALUES ('180', '绿嘉园系列', '', '/media/1/products/1299053870_s.jpg', '/media/1/products/1299053870.jpg|1,/media/1/products/1299053876.jpg', '', '1', '2', '1', '34');
INSERT INTO `w_products_series` VALUES ('181', '凉之夏系列', '', '/media/1/products/1299056159_s.jpg', '/media/1/products/1299056146.jpg|1,/media/1/products/1299056159.jpg', '', '1', '2', '1', '35');
INSERT INTO `w_products_series` VALUES ('182', '清巧系列', '', '/media/1/products/1299058743_s.jpg', '/media/1/products/1299058728.jpg|1,/media/1/products/1299058743.jpg', '', '1', '2', '1', '36');
INSERT INTO `w_products_series` VALUES ('183', '玉雅春(新品)系列', '', '/media/1/products/1299125270_s.jpg', '/media/1/products/1299125270.jpg|1,/media/1/products/1299125271.jpg,/media/1/products/1299125283.jpg', '', '1', '3', '1', '37');
INSERT INTO `w_products_series` VALUES ('184', '悦风系列', '', '/media/1/products/1299131149_s.jpg', '/media/1/products/1299131141.jpg|1,/media/1/products/1299131149.jpg', '', '1', '2', '1', '38');
INSERT INTO `w_products_series` VALUES ('185', '王者独尊系列', '', '/media/1/products/1299136781_s.jpg', '/media/1/products/1299136781.jpg|1,/media/1/products/1299136782.jpg,/media/1/products/1299136782-1.jpg,/media/1/products/1299136783.jpg,/media/1/products/1299136796.jpg', '', '1', '5', '1', '39');
INSERT INTO `w_products_series` VALUES ('186', '王者之尊系列', '', '/media/1/products/1299138874_s.jpg', '/media/1/products/1299138874.jpg|1,/media/1/products/1299138876.jpg,/media/1/products/1299138877.jpg,/media/1/products/1299138878.jpg,/media/1/products/1299138886.jpg', '', '1', '5', '1', '40');
INSERT INTO `w_products_series` VALUES ('187', '王者风尚定频系列', '', '/media/1/products/1299219338_s.jpg', '/media/1/products/1299219338.jpg|1,/media/1/products/1299219339.jpg,/media/1/products/1299219340.jpg,/media/1/products/1299219352.jpg', '', '1', '4', '1', '41');
INSERT INTO `w_products_series` VALUES ('188', '花开富贵系列', '', '/media/1/products/1299224095_s.jpg', '/media/1/products/1299224095.jpg|1,/media/1/products/1299224110.jpg', '', '1', '2', '1', '42');
INSERT INTO `w_products_series` VALUES ('189', '御景风系列', '', '/media/1/products/1299228709_s.jpg', '/media/1/products/1299228709.jpg|1,/media/1/products/1299228709-1.jpg,/media/1/products/1299228712.jpg,/media/1/products/1299228751.jpg', '', '1', '4', '1', '43');
INSERT INTO `w_products_series` VALUES ('190', '风和系列', '', '/media/1/products/1299462871_s.jpg', '/media/1/products/1299462811.jpg|1,/media/1/products/1299462871.jpg', '', '1', '2', '1', '44');
INSERT INTO `w_products_series` VALUES ('191', '清新风系列', '', '/media/1/products/1299465810_s.jpg', '/media/1/products/1299465794.jpg|1,/media/1/products/1299465810.jpg', '', '1', '2', '1', '45');
INSERT INTO `w_products_series` VALUES ('192', '定频蓝精灵系列', '', '/media/1/products/1299481144_s.jpg', '/media/1/products/1299481144.jpg|1,/media/1/products/1299481195.jpg,/media/1/products/1299481298.jpg', '', '1', '3', '1', '46');
drop table if exists w_products_spec;
CREATE TABLE `w_products_spec` (
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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

INSERT INTO `w_products_spec` VALUES ('1', '142', '1', '0,0,0,0,0,0', '21', '123', '32', '12');
INSERT INTO `w_products_spec` VALUES ('13', '142', '32', '0,0,0,0,0,0', '23', '23', '23', '3');
INSERT INTO `w_products_spec` VALUES ('16', '144', '23', '0', '12', '0', '0', '');
INSERT INTO `w_products_spec` VALUES ('15', '144', 'sa', '0', '23', '0', '0', '');
INSERT INTO `w_products_spec` VALUES ('14', '142', '23', '0,0,0,0,0,0', '23', '23', '23', '2');
INSERT INTO `w_products_spec` VALUES ('8', '141', '1', 'aswdf,safd,0,0,0,0', '23', '123', '32', '23');
INSERT INTO `w_products_spec` VALUES ('9', '141', '2', 'asdf,safd,0,0,0,0', '23', '0', '0', '12');
INSERT INTO `w_products_spec` VALUES ('10', '141', '3', 'asfd,safd,asfd,0,0,0', '23', '0', '0', '');
INSERT INTO `w_products_spec` VALUES ('11', '141', '4', 'asfd222,safd,0,0,0,0', '23', '0', '0', '');
INSERT INTO `w_products_spec` VALUES ('17', '143', '', '0', '', '0', '0', '');
INSERT INTO `w_products_spec` VALUES ('18', '146', '234214', '0', '', '0', '0', '');
INSERT INTO `w_products_spec` VALUES ('19', '146', 'safaw', '0', '', '0', '0', '');
INSERT INTO `w_products_spec` VALUES ('20', '146', 'sadf', '0', '', '0', '0', '');
INSERT INTO `w_products_spec` VALUES ('21', '171', '', '0', '', '0', '0', '');
INSERT INTO `w_products_spec` VALUES ('22', '318', '', '2', '', '0', '0', '');
INSERT INTO `w_products_spec` VALUES ('23', '518', 'asdf', '0,', '', '0', '0', '');
drop table if exists w_products_spec_values;
CREATE TABLE `w_products_spec_values` (
  `spec_value_id` mediumint(8) unsigned NOT NULL auto_increment,
  `spec_id` mediumint(8) unsigned NOT NULL default '0',
  `spec_value` varchar(100) NOT NULL default '',
  `spec_image` varchar(255) NOT NULL default '',
  `ordering` mediumint(8) unsigned NOT NULL default '50',
  PRIMARY KEY  (`spec_value_id`,`spec_value`),
  KEY `fk_spec_value` (`spec_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

INSERT INTO `w_products_spec_values` VALUES ('32', '4', 'asfd', '', '1');
INSERT INTO `w_products_spec_values` VALUES ('33', '4', 'asfd', '', '2');
INSERT INTO `w_products_spec_values` VALUES ('38', '4', '1', '', '0');
INSERT INTO `w_products_spec_values` VALUES ('42', '4', '', '', '3');
drop table if exists w_products_specification;
CREATE TABLE `w_products_specification` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(60) NOT NULL,
  `spec_type` tinyint(1) NOT NULL default '0' COMMENT '显示类型',
  `spec_show_type` tinyint(1) NOT NULL default '0' COMMENT '显示方式',
  `published` tinyint(1) unsigned NOT NULL default '1',
  `attr_group` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `w_products_specification` VALUES ('4', '机型', '1', '1', '1', '');
drop table if exists w_products_tag_relation;
CREATE TABLE `w_products_tag_relation` (
  `tags_id` int(11) NOT NULL COMMENT '标签ID',
  `products_id` int(11) NOT NULL COMMENT '产品ID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `w_products_tag_relation` VALUES ('1', '133');
INSERT INTO `w_products_tag_relation` VALUES ('2', '133');
INSERT INTO `w_products_tag_relation` VALUES ('1', '130');
INSERT INTO `w_products_tag_relation` VALUES ('3', '130');
INSERT INTO `w_products_tag_relation` VALUES ('4', '134');
INSERT INTO `w_products_tag_relation` VALUES ('5', '135');
INSERT INTO `w_products_tag_relation` VALUES ('6', '136');
INSERT INTO `w_products_tag_relation` VALUES ('6', '137');
INSERT INTO `w_products_tag_relation` VALUES ('6', '138');
drop table if exists w_products_type;
CREATE TABLE `w_products_type` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(60) NOT NULL,
  `published` tinyint(1) unsigned NOT NULL default '1',
  `attr_group` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `w_products_type` VALUES ('1', '小家电', '1', '');
drop table if exists w_refunds;
CREATE TABLE `w_refunds` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

drop table if exists w_s_pro_attr;
CREATE TABLE `w_s_pro_attr` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自动ID',
  `product_id` mediumint(8) NOT NULL default '0' COMMENT '产品ID ',
  `pro_attr_id` mediumint(8) unsigned NOT NULL default '0' COMMENT '产品属性ID，如色的auto ID',
  `uid` mediumint(8) unsigned NOT NULL default '0' COMMENT '该会员的ID',
  `price` float unsigned NOT NULL default '0' COMMENT '价格',
  `enabled` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否可用这个属性',
  PRIMARY KEY  (`id`,`uid`),
  KEY `fk_spec_value` (`pro_attr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `w_s_pro_attr` VALUES ('1', '153', '112', '89', '32', '0');
INSERT INTO `w_s_pro_attr` VALUES ('2', '153', '124', '89', '222', '1');
INSERT INTO `w_s_pro_attr` VALUES ('3', '153', '125', '89', '233', '1');
drop table if exists w_s_products;
CREATE TABLE `w_s_products` (
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
) ENGINE=MyISAM AUTO_INCREMENT=923 DEFAULT CHARSET=utf8;

INSERT INTO `w_s_products` VALUES ('91', '130', '232', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `w_s_products` VALUES ('88', '135', '1234', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `w_s_products` VALUES ('87', '139', '1234', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `w_s_products` VALUES ('86', '140', '1233', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `w_s_products` VALUES ('85', '141', '1234', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `w_s_products` VALUES ('84', '142', '1234', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `w_s_products` VALUES ('83', '143', '12', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `w_s_products` VALUES ('82', '144', '223', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `w_s_products` VALUES ('81', '145', '123', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `w_s_products` VALUES ('80', '146', '23', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `w_s_products` VALUES ('68', '129', '232', '0', '0', '1', '0', '0', '1', '1', '0', '89');
INSERT INTO `w_s_products` VALUES ('67', '130', '232', '0', '0', '0', '0', '0', '0', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('66', '135', '1234', '0', '0', '0', '0', '0', '0', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('65', '139', '1234', '0', '0', '0', '0', '0', '0', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('64', '140', '1233', '0', '0', '0', '0', '0', '0', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('63', '141', '1234', '0', '0', '0', '0', '0', '0', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('62', '142', '1234', '0', '0', '0', '0', '0', '0', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('61', '143', '322', '0', '0', '0', '0', '0', '0', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('60', '144', '223', '0', '0', '0', '0', '0', '0', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('59', '145', '1233', '0', '0', '0', '0', '0', '0', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('58', '146', '23', '0', '0', '0', '0', '0', '0', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('93', '149', '11888', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `w_s_products` VALUES ('95', '151', '11888', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `w_s_products` VALUES ('217', '290', '500', '0', '0', '1', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('218', '289', '0', '0', '0', '1', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('219', '288', '100', '0', '0', '1', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('220', '287', '100', '0', '0', '1', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('221', '286', '100', '0', '0', '1', '0', '0', '1', '503', '0', '89');
INSERT INTO `w_s_products` VALUES ('222', '285', '100', '0', '0', '1', '0', '0', '1', '501', '0', '89');
INSERT INTO `w_s_products` VALUES ('223', '284', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('224', '283', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('225', '282', '100', '0', '0', '1', '0', '0', '1', '500', '0', '89');
INSERT INTO `w_s_products` VALUES ('226', '281', '2666', '0', '0', '1', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('227', '280', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('228', '279', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('229', '278', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('230', '277', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('231', '276', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('232', '275', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('233', '274', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('234', '273', '100', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('235', '272', '200', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('236', '271', '100', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('237', '270', '200', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('238', '269', '200', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('239', '268', '200', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('240', '267', '100', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('241', '266', '2666', '0', '0', '0', '0', '0', '0', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('242', '265', '200', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('243', '264', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('244', '263', '2666', '0', '0', '0', '0', '0', '0', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('245', '262', '500', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('246', '261', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('247', '260', '500', '0', '0', '1', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('248', '259', '2666', '0', '0', '1', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('249', '258', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('250', '257', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('251', '256', '500', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('252', '255', '200', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('253', '254', '2666', '0', '0', '1', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('254', '253', '2666', '0', '0', '1', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('255', '252', '1000', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('256', '251', '2666', '0', '0', '1', '0', '0', '1', '1', '0', '89');
INSERT INTO `w_s_products` VALUES ('257', '250', '2666', '0', '0', '1', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('258', '249', '2666', '0', '0', '1', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('259', '247', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('260', '246', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('261', '245', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('262', '244', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('263', '243', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('264', '242', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('265', '241', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('266', '240', '2666', '0', '0', '1', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('267', '239', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('268', '238', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('269', '237', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('270', '236', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('271', '235', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('272', '234', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('273', '233', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('274', '232', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('275', '231', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('276', '230', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('277', '229', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('278', '228', '2666', '0', '0', '0', '1', '0', '1', '1', '0', '89');
INSERT INTO `w_s_products` VALUES ('279', '227', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('280', '226', '200', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('281', '225', '100', '0', '0', '0', '1', '0', '0', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('282', '224', '100', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('283', '223', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('284', '222', '100', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('285', '221', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('286', '220', '100', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('287', '219', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('288', '218', '100', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('289', '217', '300', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('290', '216', '100', '0', '0', '0', '1', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('291', '215', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('292', '214', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('293', '213', '50', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('294', '212', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('295', '211', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('296', '210', '50', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('297', '209', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('298', '208', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('299', '207', '100', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('300', '206', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('301', '205', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('302', '204', '2666', '0', '0', '0', '1', '0', '1', '1', '0', '89');
INSERT INTO `w_s_products` VALUES ('303', '203', '2666', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('304', '202', '50', '0', '0', '0', '1', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('305', '201', '50', '0', '0', '0', '0', '0', '1', '0', '0', '89');
INSERT INTO `w_s_products` VALUES ('439', '294', '2666', '0', '0', '0', '0', '0', '1', '101', '0', '89');
INSERT INTO `w_s_products` VALUES ('440', '293', '2666', '0', '1', '0', '0', '0', '1', '102', '0', '89');
INSERT INTO `w_s_products` VALUES ('441', '199', '2666', '0', '1', '0', '0', '0', '1', '103', '0', '89');
INSERT INTO `w_s_products` VALUES ('442', '196', '2666', '0', '1', '0', '0', '0', '1', '104', '0', '89');
INSERT INTO `w_s_products` VALUES ('443', '194', '2666', '0', '1', '0', '0', '0', '1', '105', '0', '89');
INSERT INTO `w_s_products` VALUES ('444', '191', '2666', '0', '1', '0', '0', '0', '1', '106', '0', '89');
INSERT INTO `w_s_products` VALUES ('445', '189', '2666', '0', '1', '0', '0', '0', '1', '107', '0', '89');
INSERT INTO `w_s_products` VALUES ('446', '181', '2666', '0', '1', '0', '0', '0', '1', '108', '0', '89');
INSERT INTO `w_s_products` VALUES ('447', '180', '2666', '0', '1', '0', '0', '0', '1', '109', '0', '89');
INSERT INTO `w_s_products` VALUES ('448', '178', '2666', '0', '1', '0', '0', '0', '1', '110', '0', '89');
INSERT INTO `w_s_products` VALUES ('449', '171', '2666', '0', '1', '0', '0', '0', '1', '111', '0', '89');
INSERT INTO `w_s_products` VALUES ('450', '167', '2666', '0', '1', '0', '0', '0', '1', '112', '0', '89');
INSERT INTO `w_s_products` VALUES ('451', '162', '2666', '0', '1', '0', '0', '0', '1', '113', '0', '89');
INSERT INTO `w_s_products` VALUES ('452', '157', '2666', '0', '1', '0', '0', '0', '1', '114', '0', '89');
INSERT INTO `w_s_products` VALUES ('453', '156', '5400', '0', '1', '0', '0', '0', '1', '115', '0', '89');
INSERT INTO `w_s_products` VALUES ('454', '155', '5400', '0', '1', '0', '0', '0', '1', '116', '0', '89');
INSERT INTO `w_s_products` VALUES ('455', '154', '2666', '0', '1', '0', '0', '0', '1', '1', '0', '89');
INSERT INTO `w_s_products` VALUES ('456', '153', '5400', '0', '1', '0', '0', '0', '1', '118', '0', '89');
INSERT INTO `w_s_products` VALUES ('457', '152', '2666', '0', '1', '0', '0', '0', '1', '119', '0', '89');
INSERT INTO `w_s_products` VALUES ('458', '292', '2666', '0', '1', '0', '0', '0', '1', '2', '0', '89');
INSERT INTO `w_s_products` VALUES ('459', '291', '2666', '0', '1', '0', '0', '0', '1', '121', '0', '89');
INSERT INTO `w_s_products` VALUES ('462', '296', '2666', '0', '0', '0', '0', '0', '1', '122', '0', '89');
INSERT INTO `w_s_products` VALUES ('463', '295', '2666', '0', '0', '0', '0', '0', '1', '123', '0', '89');
INSERT INTO `w_s_products` VALUES ('464', '299', '2666', '0', '0', '0', '0', '0', '1', '124', '0', '89');
INSERT INTO `w_s_products` VALUES ('465', '297', '2666', '0', '0', '0', '0', '0', '1', '125', '0', '89');
INSERT INTO `w_s_products` VALUES ('466', '161', '400', '0', '0', '0', '0', '0', '1', '126', '0', '89');
INSERT INTO `w_s_products` VALUES ('467', '160', '400', '0', '0', '0', '0', '0', '1', '127', '0', '89');
INSERT INTO `w_s_products` VALUES ('468', '159', '300', '0', '0', '0', '0', '0', '1', '128', '0', '89');
INSERT INTO `w_s_products` VALUES ('469', '158', '201', '0', '0', '0', '0', '0', '1', '129', '0', '89');
INSERT INTO `w_s_products` VALUES ('470', '300', '100', '0', '0', '0', '0', '0', '1', '130', '0', '89');
INSERT INTO `w_s_products` VALUES ('471', '200', '100', '0', '0', '0', '0', '0', '1', '131', '0', '89');
INSERT INTO `w_s_products` VALUES ('472', '198', '100', '0', '0', '0', '0', '0', '1', '132', '0', '89');
INSERT INTO `w_s_products` VALUES ('473', '197', '100', '0', '0', '0', '0', '0', '1', '133', '0', '89');
INSERT INTO `w_s_products` VALUES ('474', '195', '100', '0', '0', '0', '0', '0', '1', '134', '0', '89');
INSERT INTO `w_s_products` VALUES ('475', '192', '500', '0', '0', '0', '1', '0', '1', '135', '0', '89');
INSERT INTO `w_s_products` VALUES ('476', '190', '200', '0', '0', '0', '0', '0', '1', '136', '0', '89');
INSERT INTO `w_s_products` VALUES ('346', '290', '500', '0', '0', '0', '1', '0', '1', '2', '0', '116');
INSERT INTO `w_s_products` VALUES ('347', '289', '0', '0', '0', '0', '1', '0', '1', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('348', '288', '100', '0', '0', '0', '1', '0', '1', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('349', '287', '100', '0', '0', '0', '1', '0', '1', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('350', '286', '100', '0', '0', '1', '1', '0', '1', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('351', '285', '100', '0', '0', '1', '1', '0', '1', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('352', '284', '2666', '0', '0', '0', '1', '0', '1', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('353', '283', '2666', '0', '0', '0', '1', '0', '1', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('354', '282', '100', '0', '0', '1', '0', '0', '1', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('355', '281', '2666', '0', '0', '0', '0', '0', '0', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('356', '280', '2666', '0', '0', '0', '0', '0', '0', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('357', '279', '2666', '0', '0', '0', '0', '0', '0', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('358', '278', '2666', '0', '0', '0', '0', '0', '0', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('359', '277', '2666', '0', '0', '1', '0', '0', '1', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('360', '276', '2666', '0', '0', '1', '0', '0', '1', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('361', '275', '2666', '0', '0', '0', '0', '0', '0', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('362', '274', '2666', '0', '0', '0', '0', '0', '0', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('363', '273', '100', '0', '0', '0', '0', '0', '0', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('364', '272', '200', '0', '0', '1', '0', '0', '1', '1', '0', '116');
INSERT INTO `w_s_products` VALUES ('365', '271', '100', '0', '0', '0', '0', '0', '0', '2', '0', '116');
INSERT INTO `w_s_products` VALUES ('366', '270', '200', '0', '0', '0', '0', '0', '0', '0', '0', '116');
INSERT INTO `w_s_products` VALUES ('367', '269', '0', '0', '0', '0', '0', '0', '0', '22', '0', '116');
INSERT INTO `w_s_products` VALUES ('368', '268', '0', '0', '0', '0', '0', '0', '0', '23', '0', '116');
INSERT INTO `w_s_products` VALUES ('369', '267', '100', '0', '0', '0', '0', '0', '0', '23', '0', '116');
INSERT INTO `w_s_products` VALUES ('370', '266', '2666', '0', '0', '0', '0', '0', '0', '24', '0', '116');
INSERT INTO `w_s_products` VALUES ('371', '265', '200', '0', '0', '0', '1', '0', '1', '26', '0', '116');
INSERT INTO `w_s_products` VALUES ('372', '264', '2666', '0', '0', '0', '0', '0', '0', '27', '0', '116');
INSERT INTO `w_s_products` VALUES ('373', '263', '2666', '0', '1', '0', '0', '0', '1', '1', '0', '116');
INSERT INTO `w_s_products` VALUES ('377', '224', '100', '0', '0', '0', '0', '0', '0', '29', '0', '116');
INSERT INTO `w_s_products` VALUES ('378', '223', '2666', '0', '0', '0', '0', '0', '0', '30', '0', '116');
INSERT INTO `w_s_products` VALUES ('379', '222', '100', '0', '0', '0', '0', '0', '0', '31', '0', '116');
INSERT INTO `w_s_products` VALUES ('380', '221', '2666', '0', '0', '0', '0', '0', '0', '32', '0', '116');
INSERT INTO `w_s_products` VALUES ('381', '220', '100', '0', '0', '0', '0', '0', '0', '33', '0', '116');
INSERT INTO `w_s_products` VALUES ('382', '219', '2666', '0', '0', '0', '0', '0', '0', '34', '0', '116');
INSERT INTO `w_s_products` VALUES ('383', '218', '100', '0', '0', '0', '0', '0', '0', '35', '0', '116');
INSERT INTO `w_s_products` VALUES ('384', '217', '300', '0', '0', '0', '0', '0', '0', '36', '0', '116');
INSERT INTO `w_s_products` VALUES ('385', '216', '100', '0', '0', '0', '0', '0', '0', '37', '0', '116');
INSERT INTO `w_s_products` VALUES ('386', '215', '2666', '0', '0', '0', '0', '0', '0', '38', '0', '116');
INSERT INTO `w_s_products` VALUES ('387', '214', '2666', '0', '0', '0', '0', '0', '0', '39', '0', '116');
INSERT INTO `w_s_products` VALUES ('388', '213', '50', '0', '1', '0', '0', '0', '1', '40', '0', '116');
INSERT INTO `w_s_products` VALUES ('389', '212', '2666', '0', '0', '0', '0', '0', '0', '41', '0', '116');
INSERT INTO `w_s_products` VALUES ('390', '211', '2666', '0', '1', '0', '0', '0', '1', '42', '0', '116');
INSERT INTO `w_s_products` VALUES ('391', '210', '50', '0', '1', '0', '0', '0', '1', '43', '0', '116');
INSERT INTO `w_s_products` VALUES ('392', '209', '2666', '0', '0', '0', '0', '0', '0', '44', '0', '116');
INSERT INTO `w_s_products` VALUES ('393', '208', '2666', '0', '0', '1', '0', '0', '1', '45', '0', '116');
INSERT INTO `w_s_products` VALUES ('394', '207', '100', '0', '1', '1', '0', '0', '1', '46', '0', '116');
INSERT INTO `w_s_products` VALUES ('395', '206', '2666', '0', '0', '0', '0', '0', '0', '47', '0', '116');
INSERT INTO `w_s_products` VALUES ('396', '205', '2666', '0', '0', '0', '0', '0', '0', '48', '0', '116');
INSERT INTO `w_s_products` VALUES ('397', '293', '2666', '0', '0', '0', '0', '0', '0', '49', '0', '116');
INSERT INTO `w_s_products` VALUES ('398', '292', '2666', '0', '0', '0', '0', '0', '0', '50', '0', '116');
INSERT INTO `w_s_products` VALUES ('399', '291', '2666', '0', '0', '0', '0', '0', '0', '51', '0', '116');
INSERT INTO `w_s_products` VALUES ('400', '262', '500', '0', '0', '0', '0', '0', '0', '52', '0', '116');
INSERT INTO `w_s_products` VALUES ('401', '261', '2666', '0', '0', '1', '0', '0', '1', '53', '0', '116');
INSERT INTO `w_s_products` VALUES ('402', '260', '500', '0', '0', '1', '0', '0', '1', '54', '0', '116');
INSERT INTO `w_s_products` VALUES ('403', '259', '2666', '0', '0', '0', '0', '0', '0', '55', '0', '116');
INSERT INTO `w_s_products` VALUES ('404', '258', '2666', '0', '0', '1', '0', '0', '1', '56', '0', '116');
INSERT INTO `w_s_products` VALUES ('405', '257', '2666', '0', '0', '0', '0', '0', '0', '57', '0', '116');
INSERT INTO `w_s_products` VALUES ('406', '256', '500', '0', '0', '1', '0', '0', '1', '58', '0', '116');
INSERT INTO `w_s_products` VALUES ('407', '255', '200', '0', '0', '0', '0', '0', '0', '59', '0', '116');
INSERT INTO `w_s_products` VALUES ('408', '254', '2666', '0', '0', '1', '0', '0', '1', '60', '0', '116');
INSERT INTO `w_s_products` VALUES ('409', '253', '2666', '0', '0', '0', '0', '0', '0', '61', '0', '116');
INSERT INTO `w_s_products` VALUES ('410', '252', '1000', '0', '0', '0', '0', '0', '0', '62', '0', '116');
INSERT INTO `w_s_products` VALUES ('411', '251', '2666', '0', '0', '0', '0', '0', '0', '63', '0', '116');
INSERT INTO `w_s_products` VALUES ('412', '250', '2666', '0', '0', '0', '0', '0', '0', '64', '0', '116');
INSERT INTO `w_s_products` VALUES ('413', '249', '2666', '0', '0', '0', '0', '0', '0', '65', '0', '116');
INSERT INTO `w_s_products` VALUES ('414', '247', '2666', '0', '0', '0', '0', '0', '0', '66', '0', '116');
INSERT INTO `w_s_products` VALUES ('415', '246', '2666', '0', '0', '0', '0', '0', '0', '67', '0', '116');
INSERT INTO `w_s_products` VALUES ('416', '245', '2666', '0', '0', '0', '0', '0', '0', '68', '0', '116');
INSERT INTO `w_s_products` VALUES ('417', '244', '2666', '0', '0', '0', '0', '0', '1', '69', '0', '116');
INSERT INTO `w_s_products` VALUES ('418', '243', '2666', '0', '0', '0', '0', '0', '0', '70', '0', '116');
INSERT INTO `w_s_products` VALUES ('419', '242', '2666', '0', '0', '0', '0', '0', '0', '71', '0', '116');
INSERT INTO `w_s_products` VALUES ('420', '241', '2666', '0', '0', '0', '0', '0', '0', '72', '0', '116');
INSERT INTO `w_s_products` VALUES ('421', '240', '2666', '0', '0', '0', '0', '0', '0', '73', '0', '116');
INSERT INTO `w_s_products` VALUES ('422', '239', '2666', '0', '0', '0', '0', '0', '1', '74', '0', '116');
INSERT INTO `w_s_products` VALUES ('423', '238', '2666', '0', '0', '0', '0', '0', '1', '75', '0', '116');
INSERT INTO `w_s_products` VALUES ('424', '237', '2666', '0', '0', '0', '0', '0', '1', '76', '0', '116');
INSERT INTO `w_s_products` VALUES ('425', '236', '2666', '0', '0', '0', '0', '0', '1', '77', '0', '116');
INSERT INTO `w_s_products` VALUES ('426', '235', '2666', '0', '0', '0', '0', '0', '1', '78', '0', '116');
INSERT INTO `w_s_products` VALUES ('427', '234', '2666', '0', '0', '0', '0', '0', '1', '79', '0', '116');
INSERT INTO `w_s_products` VALUES ('428', '233', '2666', '0', '0', '0', '0', '0', '1', '80', '0', '116');
INSERT INTO `w_s_products` VALUES ('429', '232', '2666', '0', '0', '1', '0', '0', '1', '81', '0', '116');
INSERT INTO `w_s_products` VALUES ('430', '231', '2666', '0', '0', '0', '0', '0', '1', '82', '0', '116');
INSERT INTO `w_s_products` VALUES ('431', '230', '2666', '0', '0', '0', '0', '0', '1', '83', '0', '116');
INSERT INTO `w_s_products` VALUES ('432', '229', '2666', '0', '0', '0', '0', '0', '1', '84', '0', '116');
INSERT INTO `w_s_products` VALUES ('433', '228', '2666', '0', '0', '0', '0', '0', '1', '85', '0', '116');
INSERT INTO `w_s_products` VALUES ('434', '227', '2666', '0', '0', '1', '0', '0', '1', '86', '0', '116');
INSERT INTO `w_s_products` VALUES ('435', '226', '200', '0', '0', '1', '0', '0', '1', '87', '0', '116');
INSERT INTO `w_s_products` VALUES ('436', '225', '100', '0', '0', '1', '0', '0', '1', '88', '0', '116');
INSERT INTO `w_s_products` VALUES ('477', '188', '100', '0', '0', '0', '0', '0', '1', '137', '0', '89');
INSERT INTO `w_s_products` VALUES ('478', '187', '100', '0', '0', '0', '0', '0', '1', '138', '0', '89');
INSERT INTO `w_s_products` VALUES ('479', '186', '100', '0', '0', '0', '0', '0', '1', '139', '0', '89');
INSERT INTO `w_s_products` VALUES ('480', '179', '60', '0', '0', '0', '0', '0', '1', '140', '0', '89');
INSERT INTO `w_s_products` VALUES ('481', '176', '100', '0', '0', '0', '0', '0', '1', '141', '0', '89');
INSERT INTO `w_s_products` VALUES ('482', '172', '200', '0', '0', '0', '0', '0', '1', '142', '0', '89');
INSERT INTO `w_s_products` VALUES ('483', '170', '500', '0', '0', '0', '0', '0', '1', '143', '0', '89');
INSERT INTO `w_s_products` VALUES ('484', '169', '300', '0', '0', '0', '0', '0', '1', '144', '0', '89');
INSERT INTO `w_s_products` VALUES ('485', '168', '250', '0', '0', '0', '0', '0', '1', '145', '0', '89');
INSERT INTO `w_s_products` VALUES ('486', '166', '300', '0', '0', '0', '0', '0', '0', '146', '0', '89');
INSERT INTO `w_s_products` VALUES ('487', '165', '200', '0', '0', '0', '0', '0', '0', '147', '0', '89');
INSERT INTO `w_s_products` VALUES ('488', '164', '200', '0', '0', '0', '0', '0', '0', '148', '0', '89');
INSERT INTO `w_s_products` VALUES ('489', '163', '300', '0', '0', '0', '0', '0', '0', '149', '0', '89');
INSERT INTO `w_s_products` VALUES ('490', '304', '2666', '0', '0', '0', '0', '0', '0', '150', '0', '89');
INSERT INTO `w_s_products` VALUES ('491', '303', '2666', '0', '0', '0', '0', '0', '0', '151', '0', '89');
INSERT INTO `w_s_products` VALUES ('492', '302', '2666', '0', '0', '0', '0', '0', '0', '152', '0', '89');
INSERT INTO `w_s_products` VALUES ('493', '301', '2666', '0', '0', '0', '0', '0', '0', '153', '0', '89');
INSERT INTO `w_s_products` VALUES ('502', '306', '2666', '0', '0', '0', '0', '0', '0', '154', '0', '89');
INSERT INTO `w_s_products` VALUES ('503', '305', '2666', '0', '0', '0', '0', '0', '0', '155', '0', '89');
INSERT INTO `w_s_products` VALUES ('629', '445', '2666', '0', '1', '0', '0', '0', '0', '14', '2', '1');
INSERT INTO `w_s_products` VALUES ('630', '444', '2666', '0', '1', '0', '0', '0', '0', '15', '3', '1');
INSERT INTO `w_s_products` VALUES ('508', '310', '2666', '0', '0', '0', '0', '0', '0', '156', '0', '89');
INSERT INTO `w_s_products` VALUES ('509', '309', '2666', '0', '0', '0', '0', '0', '0', '157', '0', '89');
INSERT INTO `w_s_products` VALUES ('510', '308', '2666', '0', '0', '0', '0', '0', '0', '158', '0', '89');
INSERT INTO `w_s_products` VALUES ('511', '307', '2666', '0', '0', '0', '0', '0', '0', '159', '0', '89');
INSERT INTO `w_s_products` VALUES ('512', '312', '500', '0', '0', '0', '0', '0', '1', '160', '0', '89');
INSERT INTO `w_s_products` VALUES ('513', '311', '800', '0', '0', '0', '0', '0', '1', '161', '0', '89');
INSERT INTO `w_s_products` VALUES ('628', '446', '0', '0', '1', '0', '0', '0', '0', '13', '1', '1');
INSERT INTO `w_s_products` VALUES ('515', '313', '2666', '0', '0', '0', '0', '0', '0', '162', '0', '89');
INSERT INTO `w_s_products` VALUES ('516', '318', '2666', '0', '0', '0', '0', '0', '0', '163', '0', '89');
INSERT INTO `w_s_products` VALUES ('517', '317', '2666', '0', '0', '0', '0', '0', '0', '164', '0', '89');
INSERT INTO `w_s_products` VALUES ('518', '316', '2666', '0', '0', '0', '0', '0', '0', '165', '0', '89');
INSERT INTO `w_s_products` VALUES ('519', '315', '2666', '0', '0', '0', '0', '0', '0', '166', '0', '89');
INSERT INTO `w_s_products` VALUES ('520', '314', '2666', '0', '0', '0', '0', '0', '0', '167', '0', '89');
INSERT INTO `w_s_products` VALUES ('521', '340', '2666', '0', '0', '0', '0', '0', '0', '168', '0', '89');
INSERT INTO `w_s_products` VALUES ('522', '339', '2666', '0', '0', '0', '0', '0', '0', '169', '0', '89');
INSERT INTO `w_s_products` VALUES ('523', '338', '2666', '0', '0', '0', '0', '0', '0', '170', '0', '89');
INSERT INTO `w_s_products` VALUES ('524', '337', '2666', '0', '0', '0', '0', '0', '0', '171', '0', '89');
INSERT INTO `w_s_products` VALUES ('525', '336', '2666', '0', '0', '0', '0', '0', '0', '172', '0', '89');
INSERT INTO `w_s_products` VALUES ('526', '335', '2666', '0', '0', '0', '0', '0', '0', '173', '0', '89');
INSERT INTO `w_s_products` VALUES ('527', '334', '2666', '0', '0', '0', '0', '0', '0', '174', '0', '89');
INSERT INTO `w_s_products` VALUES ('528', '333', '2666', '0', '0', '0', '0', '0', '0', '175', '0', '89');
INSERT INTO `w_s_products` VALUES ('529', '332', '2666', '0', '0', '0', '0', '0', '0', '176', '0', '89');
INSERT INTO `w_s_products` VALUES ('530', '331', '2666', '0', '0', '0', '0', '0', '0', '177', '0', '89');
INSERT INTO `w_s_products` VALUES ('531', '330', '2666', '0', '0', '0', '0', '0', '0', '178', '0', '89');
INSERT INTO `w_s_products` VALUES ('532', '329', '2666', '0', '0', '0', '0', '0', '0', '179', '0', '89');
INSERT INTO `w_s_products` VALUES ('533', '328', '2666', '0', '0', '0', '0', '0', '0', '180', '0', '89');
INSERT INTO `w_s_products` VALUES ('534', '327', '2666', '0', '0', '0', '0', '0', '0', '181', '0', '89');
INSERT INTO `w_s_products` VALUES ('535', '326', '2666', '0', '0', '0', '0', '0', '0', '182', '0', '89');
INSERT INTO `w_s_products` VALUES ('536', '325', '2666', '0', '0', '0', '0', '0', '0', '183', '0', '89');
INSERT INTO `w_s_products` VALUES ('537', '324', '2666', '0', '0', '0', '0', '0', '0', '184', '0', '89');
INSERT INTO `w_s_products` VALUES ('538', '323', '2666', '0', '0', '0', '0', '0', '0', '185', '0', '89');
INSERT INTO `w_s_products` VALUES ('539', '322', '2666', '0', '0', '0', '0', '0', '0', '186', '0', '89');
INSERT INTO `w_s_products` VALUES ('540', '321', '2666', '0', '0', '0', '0', '0', '0', '187', '0', '89');
INSERT INTO `w_s_products` VALUES ('541', '320', '2666', '0', '0', '0', '0', '0', '0', '188', '0', '89');
INSERT INTO `w_s_products` VALUES ('542', '319', '2666', '0', '0', '0', '0', '0', '0', '189', '0', '89');
INSERT INTO `w_s_products` VALUES ('543', '360', '2666', '0', '0', '0', '0', '0', '0', '190', '0', '89');
INSERT INTO `w_s_products` VALUES ('544', '359', '2666', '0', '0', '0', '0', '0', '0', '191', '0', '89');
INSERT INTO `w_s_products` VALUES ('545', '358', '2666', '0', '0', '0', '0', '0', '0', '192', '0', '89');
INSERT INTO `w_s_products` VALUES ('546', '357', '2666', '0', '0', '0', '0', '0', '0', '193', '0', '89');
INSERT INTO `w_s_products` VALUES ('547', '356', '2666', '0', '0', '0', '0', '0', '1', '194', '0', '89');
INSERT INTO `w_s_products` VALUES ('548', '355', '2666', '0', '0', '0', '0', '0', '1', '195', '0', '89');
INSERT INTO `w_s_products` VALUES ('549', '354', '2666', '0', '0', '0', '0', '0', '1', '196', '0', '89');
INSERT INTO `w_s_products` VALUES ('550', '353', '2666', '0', '0', '0', '0', '0', '1', '197', '0', '89');
INSERT INTO `w_s_products` VALUES ('551', '352', '2666', '0', '0', '0', '0', '0', '1', '198', '0', '89');
INSERT INTO `w_s_products` VALUES ('552', '351', '2666', '0', '0', '0', '0', '0', '1', '199', '0', '89');
INSERT INTO `w_s_products` VALUES ('553', '350', '2666', '0', '0', '0', '0', '0', '1', '200', '0', '89');
INSERT INTO `w_s_products` VALUES ('554', '349', '2666', '0', '0', '0', '0', '0', '1', '201', '0', '89');
INSERT INTO `w_s_products` VALUES ('555', '348', '2666', '0', '0', '0', '0', '0', '1', '202', '0', '89');
INSERT INTO `w_s_products` VALUES ('556', '347', '2666', '0', '0', '0', '0', '0', '1', '203', '0', '89');
INSERT INTO `w_s_products` VALUES ('557', '346', '2666', '0', '0', '0', '0', '0', '1', '204', '0', '89');
INSERT INTO `w_s_products` VALUES ('558', '345', '2666', '0', '0', '0', '0', '0', '1', '205', '0', '89');
INSERT INTO `w_s_products` VALUES ('559', '344', '2666', '0', '0', '0', '0', '0', '1', '206', '0', '89');
INSERT INTO `w_s_products` VALUES ('560', '343', '2666', '0', '0', '0', '0', '0', '1', '207', '0', '89');
INSERT INTO `w_s_products` VALUES ('561', '342', '2666', '0', '0', '0', '0', '0', '1', '208', '0', '89');
INSERT INTO `w_s_products` VALUES ('562', '341', '2666', '0', '0', '0', '0', '0', '1', '209', '0', '89');
INSERT INTO `w_s_products` VALUES ('563', '393', '2666', '0', '0', '0', '0', '0', '1', '210', '0', '89');
INSERT INTO `w_s_products` VALUES ('564', '392', '2666', '0', '0', '0', '0', '0', '1', '211', '0', '89');
INSERT INTO `w_s_products` VALUES ('565', '391', '2666', '0', '0', '0', '0', '0', '1', '212', '0', '89');
INSERT INTO `w_s_products` VALUES ('566', '390', '2666', '0', '0', '0', '0', '0', '1', '213', '0', '89');
INSERT INTO `w_s_products` VALUES ('567', '389', '2666', '0', '0', '0', '0', '0', '1', '214', '0', '89');
INSERT INTO `w_s_products` VALUES ('568', '388', '2666', '0', '0', '0', '0', '0', '1', '215', '0', '89');
INSERT INTO `w_s_products` VALUES ('569', '387', '2666', '0', '0', '0', '0', '0', '1', '216', '0', '89');
INSERT INTO `w_s_products` VALUES ('570', '386', '2666', '0', '0', '0', '0', '0', '1', '217', '0', '89');
INSERT INTO `w_s_products` VALUES ('571', '385', '2666', '0', '0', '0', '0', '0', '1', '218', '0', '89');
INSERT INTO `w_s_products` VALUES ('572', '384', '2666', '0', '0', '0', '0', '0', '1', '219', '0', '89');
INSERT INTO `w_s_products` VALUES ('573', '382', '2666', '0', '0', '0', '0', '0', '1', '220', '0', '89');
INSERT INTO `w_s_products` VALUES ('574', '381', '2666', '0', '0', '0', '0', '0', '1', '221', '0', '89');
INSERT INTO `w_s_products` VALUES ('575', '380', '2666', '0', '0', '0', '0', '0', '1', '222', '0', '89');
INSERT INTO `w_s_products` VALUES ('576', '379', '2666', '0', '0', '0', '0', '0', '1', '223', '0', '89');
INSERT INTO `w_s_products` VALUES ('577', '378', '2666', '0', '0', '0', '0', '0', '1', '224', '0', '89');
INSERT INTO `w_s_products` VALUES ('578', '377', '2666', '0', '0', '0', '0', '0', '1', '225', '0', '89');
INSERT INTO `w_s_products` VALUES ('579', '376', '2666', '0', '0', '0', '0', '0', '1', '226', '0', '89');
INSERT INTO `w_s_products` VALUES ('580', '375', '2666', '0', '0', '0', '0', '0', '1', '227', '0', '89');
INSERT INTO `w_s_products` VALUES ('581', '374', '2666', '0', '0', '0', '0', '0', '1', '228', '0', '89');
INSERT INTO `w_s_products` VALUES ('582', '373', '2666', '0', '0', '0', '0', '0', '1', '229', '0', '89');
INSERT INTO `w_s_products` VALUES ('583', '372', '2666', '0', '0', '0', '0', '0', '1', '230', '0', '89');
INSERT INTO `w_s_products` VALUES ('584', '371', '2666', '0', '0', '0', '0', '0', '1', '231', '0', '89');
INSERT INTO `w_s_products` VALUES ('585', '370', '2666', '0', '0', '0', '0', '0', '1', '232', '0', '89');
INSERT INTO `w_s_products` VALUES ('586', '369', '2666', '0', '0', '0', '0', '0', '1', '233', '0', '89');
INSERT INTO `w_s_products` VALUES ('587', '368', '2666', '0', '0', '0', '0', '0', '1', '234', '0', '89');
INSERT INTO `w_s_products` VALUES ('588', '367', '2666', '0', '0', '0', '0', '0', '1', '235', '0', '89');
INSERT INTO `w_s_products` VALUES ('589', '366', '2666', '0', '0', '0', '0', '0', '1', '236', '0', '89');
INSERT INTO `w_s_products` VALUES ('590', '365', '2666', '0', '0', '0', '0', '0', '1', '237', '0', '89');
INSERT INTO `w_s_products` VALUES ('591', '364', '2666', '0', '0', '0', '0', '0', '1', '238', '0', '89');
INSERT INTO `w_s_products` VALUES ('592', '363', '2666', '0', '0', '0', '0', '0', '1', '239', '0', '89');
INSERT INTO `w_s_products` VALUES ('593', '362', '2666', '0', '0', '0', '0', '0', '1', '240', '0', '89');
INSERT INTO `w_s_products` VALUES ('594', '361', '2666', '0', '0', '0', '0', '0', '1', '241', '0', '89');
INSERT INTO `w_s_products` VALUES ('595', '399', '2666', '0', '0', '0', '0', '0', '1', '242', '0', '89');
INSERT INTO `w_s_products` VALUES ('596', '398', '2666', '0', '0', '0', '0', '0', '1', '243', '0', '89');
INSERT INTO `w_s_products` VALUES ('597', '397', '2666', '0', '0', '0', '0', '0', '1', '244', '0', '89');
INSERT INTO `w_s_products` VALUES ('598', '396', '2666', '0', '0', '0', '0', '0', '1', '245', '0', '89');
INSERT INTO `w_s_products` VALUES ('599', '395', '2666', '0', '0', '0', '0', '0', '1', '246', '0', '89');
INSERT INTO `w_s_products` VALUES ('600', '394', '2666', '0', '0', '0', '0', '0', '1', '247', '0', '89');
INSERT INTO `w_s_products` VALUES ('601', '415', '2666', '0', '0', '0', '0', '0', '0', '248', '0', '89');
INSERT INTO `w_s_products` VALUES ('602', '414', '2666', '0', '0', '0', '0', '0', '1', '249', '0', '89');
INSERT INTO `w_s_products` VALUES ('603', '413', '2666', '0', '0', '0', '0', '0', '1', '250', '0', '89');
INSERT INTO `w_s_products` VALUES ('604', '412', '2666', '0', '0', '0', '0', '0', '1', '251', '0', '89');
INSERT INTO `w_s_products` VALUES ('605', '411', '2666', '0', '0', '0', '0', '0', '1', '252', '0', '89');
INSERT INTO `w_s_products` VALUES ('606', '410', '2666', '0', '0', '0', '0', '0', '1', '253', '0', '89');
INSERT INTO `w_s_products` VALUES ('607', '409', '2666', '0', '0', '0', '0', '0', '1', '254', '0', '89');
INSERT INTO `w_s_products` VALUES ('608', '408', '2666', '0', '0', '0', '0', '0', '1', '255', '0', '89');
INSERT INTO `w_s_products` VALUES ('609', '407', '2666', '0', '0', '0', '0', '0', '1', '256', '0', '89');
INSERT INTO `w_s_products` VALUES ('610', '406', '2666', '0', '0', '0', '0', '0', '1', '257', '0', '89');
INSERT INTO `w_s_products` VALUES ('611', '405', '2666', '0', '0', '0', '0', '0', '1', '258', '0', '89');
INSERT INTO `w_s_products` VALUES ('612', '404', '2666', '0', '0', '0', '0', '0', '1', '259', '0', '89');
INSERT INTO `w_s_products` VALUES ('613', '403', '2666', '0', '0', '0', '0', '0', '1', '260', '0', '89');
INSERT INTO `w_s_products` VALUES ('614', '402', '2666', '0', '0', '0', '0', '0', '1', '261', '0', '89');
INSERT INTO `w_s_products` VALUES ('615', '401', '2666', '0', '0', '0', '0', '0', '1', '262', '0', '89');
INSERT INTO `w_s_products` VALUES ('616', '400', '2666', '0', '0', '0', '0', '0', '1', '263', '0', '89');
INSERT INTO `w_s_products` VALUES ('617', '417', '0', '0', '0', '0', '0', '0', '1', '264', '0', '89');
INSERT INTO `w_s_products` VALUES ('618', '419', '0', '0', '0', '0', '0', '0', '1', '265', '0', '89');
INSERT INTO `w_s_products` VALUES ('619', '422', '100', '0', '0', '0', '0', '0', '1', '266', '0', '89');
INSERT INTO `w_s_products` VALUES ('620', '421', '200', '0', '0', '0', '0', '0', '1', '267', '0', '89');
INSERT INTO `w_s_products` VALUES ('621', '423', '100', '0', '0', '0', '0', '0', '1', '268', '0', '89');
INSERT INTO `w_s_products` VALUES ('622', '426', '50', '0', '0', '0', '0', '0', '1', '269', '0', '89');
INSERT INTO `w_s_products` VALUES ('623', '425', '200', '0', '0', '0', '0', '0', '1', '270', '0', '89');
INSERT INTO `w_s_products` VALUES ('624', '424', '200', '0', '0', '0', '0', '0', '1', '271', '0', '89');
INSERT INTO `w_s_products` VALUES ('625', '420', '2666', '0', '0', '0', '0', '0', '1', '272', '0', '89');
INSERT INTO `w_s_products` VALUES ('626', '418', '2666', '0', '0', '0', '0', '0', '1', '273', '0', '89');
INSERT INTO `w_s_products` VALUES ('627', '416', '2666', '0', '0', '0', '0', '0', '1', '274', '0', '89');
INSERT INTO `w_s_products` VALUES ('631', '451', '2666', '0', '0', '0', '0', '0', '0', '16', '16', '1');
INSERT INTO `w_s_products` VALUES ('632', '452', '2666', '0', '0', '0', '0', '0', '0', '17', '17', '1');
INSERT INTO `w_s_products` VALUES ('633', '456', '2666', '0', '0', '0', '0', '0', '0', '18', '18', '1');
INSERT INTO `w_s_products` VALUES ('634', '455', '2666', '0', '0', '0', '0', '0', '0', '19', '19', '1');
INSERT INTO `w_s_products` VALUES ('635', '454', '2666', '0', '0', '0', '0', '0', '0', '20', '20', '1');
INSERT INTO `w_s_products` VALUES ('636', '453', '2666', '0', '0', '0', '0', '0', '0', '21', '21', '1');
INSERT INTO `w_s_products` VALUES ('637', '450', '2666', '0', '0', '0', '0', '0', '0', '22', '22', '1');
INSERT INTO `w_s_products` VALUES ('638', '449', '2666', '0', '0', '0', '0', '0', '0', '23', '23', '1');
INSERT INTO `w_s_products` VALUES ('639', '448', '2666', '0', '0', '0', '0', '0', '0', '24', '24', '1');
INSERT INTO `w_s_products` VALUES ('640', '447', '2666', '0', '0', '0', '0', '0', '0', '25', '25', '1');
INSERT INTO `w_s_products` VALUES ('641', '443', '2666', '0', '0', '0', '0', '0', '0', '26', '26', '1');
INSERT INTO `w_s_products` VALUES ('642', '442', '2666', '0', '0', '0', '0', '0', '0', '27', '27', '1');
INSERT INTO `w_s_products` VALUES ('643', '441', '2666', '0', '0', '0', '0', '0', '0', '28', '28', '1');
INSERT INTO `w_s_products` VALUES ('644', '440', '2666', '0', '0', '0', '0', '0', '0', '29', '29', '1');
INSERT INTO `w_s_products` VALUES ('645', '439', '2666', '0', '0', '0', '0', '0', '0', '30', '30', '1');
INSERT INTO `w_s_products` VALUES ('646', '438', '2666', '0', '0', '0', '0', '0', '0', '31', '31', '1');
INSERT INTO `w_s_products` VALUES ('647', '437', '2666', '0', '0', '0', '0', '0', '0', '32', '32', '1');
INSERT INTO `w_s_products` VALUES ('648', '436', '2666', '0', '0', '0', '0', '0', '0', '33', '33', '1');
INSERT INTO `w_s_products` VALUES ('649', '435', '2666', '0', '0', '0', '0', '0', '0', '34', '34', '1');
INSERT INTO `w_s_products` VALUES ('650', '434', '2666', '0', '0', '0', '0', '0', '0', '35', '35', '1');
INSERT INTO `w_s_products` VALUES ('651', '433', '2666', '0', '0', '0', '0', '0', '0', '36', '36', '1');
INSERT INTO `w_s_products` VALUES ('652', '432', '2666', '0', '0', '0', '0', '0', '0', '37', '37', '1');
INSERT INTO `w_s_products` VALUES ('653', '431', '2666', '0', '0', '0', '0', '0', '0', '38', '38', '1');
INSERT INTO `w_s_products` VALUES ('654', '429', '2666', '0', '0', '0', '0', '0', '0', '39', '39', '1');
INSERT INTO `w_s_products` VALUES ('655', '428', '2666', '0', '0', '0', '0', '0', '0', '40', '40', '1');
INSERT INTO `w_s_products` VALUES ('656', '427', '2666', '0', '0', '0', '0', '0', '0', '41', '41', '1');
INSERT INTO `w_s_products` VALUES ('657', '420', '2666', '0', '0', '0', '0', '0', '0', '42', '42', '1');
INSERT INTO `w_s_products` VALUES ('658', '418', '2666', '0', '0', '0', '0', '0', '0', '43', '43', '1');
INSERT INTO `w_s_products` VALUES ('659', '416', '2666', '0', '0', '0', '0', '0', '0', '44', '44', '1');
INSERT INTO `w_s_products` VALUES ('660', '415', '2666', '0', '0', '0', '0', '0', '0', '45', '45', '1');
INSERT INTO `w_s_products` VALUES ('661', '414', '2666', '0', '0', '0', '0', '0', '0', '46', '46', '1');
INSERT INTO `w_s_products` VALUES ('662', '413', '2666', '0', '0', '0', '0', '0', '0', '47', '47', '1');
INSERT INTO `w_s_products` VALUES ('663', '412', '2666', '0', '0', '0', '0', '0', '0', '48', '48', '1');
INSERT INTO `w_s_products` VALUES ('664', '411', '2666', '0', '0', '0', '0', '0', '0', '49', '49', '1');
INSERT INTO `w_s_products` VALUES ('665', '410', '2666', '0', '0', '0', '0', '0', '0', '50', '50', '1');
INSERT INTO `w_s_products` VALUES ('666', '409', '2666', '0', '0', '0', '0', '0', '0', '51', '51', '1');
INSERT INTO `w_s_products` VALUES ('667', '408', '2666', '0', '0', '0', '0', '0', '0', '52', '52', '1');
INSERT INTO `w_s_products` VALUES ('668', '407', '2666', '0', '0', '0', '0', '0', '0', '53', '53', '1');
INSERT INTO `w_s_products` VALUES ('669', '406', '2666', '0', '0', '0', '0', '0', '0', '54', '54', '1');
INSERT INTO `w_s_products` VALUES ('670', '405', '2666', '0', '0', '0', '0', '0', '0', '55', '55', '1');
INSERT INTO `w_s_products` VALUES ('671', '456', '2666', '0', '0', '0', '0', '0', '1', '275', '275', '89');
INSERT INTO `w_s_products` VALUES ('672', '455', '2666', '0', '0', '0', '0', '0', '1', '276', '276', '89');
INSERT INTO `w_s_products` VALUES ('673', '454', '2666', '0', '0', '0', '0', '0', '1', '277', '277', '89');
INSERT INTO `w_s_products` VALUES ('674', '453', '2666', '0', '0', '0', '0', '0', '1', '278', '278', '89');
INSERT INTO `w_s_products` VALUES ('675', '452', '2666', '0', '0', '0', '0', '0', '1', '279', '279', '89');
INSERT INTO `w_s_products` VALUES ('676', '451', '2666', '0', '0', '0', '0', '0', '1', '280', '280', '89');
INSERT INTO `w_s_products` VALUES ('677', '450', '2666', '0', '0', '0', '0', '0', '1', '281', '281', '89');
INSERT INTO `w_s_products` VALUES ('678', '449', '2666', '0', '0', '0', '0', '0', '1', '282', '282', '89');
INSERT INTO `w_s_products` VALUES ('679', '448', '2666', '0', '0', '0', '0', '0', '1', '283', '283', '89');
INSERT INTO `w_s_products` VALUES ('680', '447', '2666', '0', '0', '0', '0', '0', '1', '284', '284', '89');
INSERT INTO `w_s_products` VALUES ('681', '446', '2666', '0', '0', '0', '0', '0', '1', '285', '285', '89');
INSERT INTO `w_s_products` VALUES ('682', '445', '2666', '0', '0', '0', '0', '0', '1', '286', '286', '89');
INSERT INTO `w_s_products` VALUES ('683', '444', '2666', '0', '0', '0', '0', '0', '1', '287', '287', '89');
INSERT INTO `w_s_products` VALUES ('684', '443', '2666', '0', '0', '0', '0', '0', '1', '288', '288', '89');
INSERT INTO `w_s_products` VALUES ('685', '442', '2666', '0', '0', '0', '0', '0', '1', '289', '289', '89');
INSERT INTO `w_s_products` VALUES ('686', '441', '2666', '0', '0', '0', '0', '0', '1', '290', '290', '89');
INSERT INTO `w_s_products` VALUES ('687', '440', '2666', '0', '0', '0', '0', '0', '0', '291', '291', '89');
INSERT INTO `w_s_products` VALUES ('688', '439', '2666', '0', '0', '0', '0', '0', '0', '292', '292', '89');
INSERT INTO `w_s_products` VALUES ('689', '438', '2666', '0', '0', '0', '0', '0', '0', '293', '293', '89');
INSERT INTO `w_s_products` VALUES ('690', '437', '2666', '0', '0', '0', '0', '0', '0', '294', '294', '89');
INSERT INTO `w_s_products` VALUES ('691', '436', '2666', '0', '0', '0', '0', '0', '0', '295', '295', '89');
INSERT INTO `w_s_products` VALUES ('692', '435', '2666', '0', '0', '0', '0', '0', '0', '296', '296', '89');
INSERT INTO `w_s_products` VALUES ('693', '434', '2666', '0', '0', '0', '0', '0', '0', '297', '297', '89');
INSERT INTO `w_s_products` VALUES ('694', '433', '2666', '0', '0', '0', '0', '0', '0', '298', '298', '89');
INSERT INTO `w_s_products` VALUES ('695', '432', '2666', '0', '0', '0', '0', '0', '0', '299', '299', '89');
INSERT INTO `w_s_products` VALUES ('696', '431', '2666', '0', '0', '0', '0', '0', '0', '300', '300', '89');
INSERT INTO `w_s_products` VALUES ('697', '429', '2666', '0', '0', '0', '0', '0', '0', '301', '301', '89');
INSERT INTO `w_s_products` VALUES ('698', '428', '2666', '0', '0', '0', '0', '0', '0', '302', '302', '89');
INSERT INTO `w_s_products` VALUES ('699', '427', '2666', '0', '0', '0', '0', '0', '0', '303', '303', '89');
INSERT INTO `w_s_products` VALUES ('700', '153', '5400', '0', '0', '0', '0', '0', '0', '56', '56', '1');
INSERT INTO `w_s_products` VALUES ('701', '468', '2666', '0', '0', '0', '0', '0', '0', '57', '57', '1');
INSERT INTO `w_s_products` VALUES ('702', '467', '2666', '0', '0', '0', '0', '0', '0', '58', '58', '1');
INSERT INTO `w_s_products` VALUES ('703', '466', '2666', '0', '0', '0', '0', '0', '0', '59', '59', '1');
INSERT INTO `w_s_products` VALUES ('704', '465', '2666', '0', '0', '0', '0', '0', '0', '60', '60', '1');
INSERT INTO `w_s_products` VALUES ('705', '464', '2666', '0', '0', '0', '0', '0', '0', '61', '61', '1');
INSERT INTO `w_s_products` VALUES ('706', '463', '2666', '0', '0', '0', '0', '0', '0', '62', '62', '1');
INSERT INTO `w_s_products` VALUES ('707', '462', '2666', '0', '0', '0', '0', '0', '0', '63', '63', '1');
INSERT INTO `w_s_products` VALUES ('708', '461', '2666', '0', '0', '0', '0', '0', '0', '64', '64', '1');
INSERT INTO `w_s_products` VALUES ('709', '460', '2666', '0', '0', '0', '0', '0', '0', '65', '65', '1');
INSERT INTO `w_s_products` VALUES ('710', '459', '2666', '0', '0', '0', '0', '0', '0', '66', '66', '1');
INSERT INTO `w_s_products` VALUES ('711', '458', '2666', '0', '0', '0', '0', '0', '0', '67', '67', '1');
INSERT INTO `w_s_products` VALUES ('712', '457', '2666', '0', '0', '0', '0', '0', '0', '68', '68', '1');
INSERT INTO `w_s_products` VALUES ('713', '426', '50', '0', '0', '0', '0', '0', '0', '69', '69', '1');
INSERT INTO `w_s_products` VALUES ('714', '425', '200', '0', '0', '0', '0', '0', '0', '70', '70', '1');
INSERT INTO `w_s_products` VALUES ('715', '424', '200', '0', '0', '0', '0', '0', '0', '71', '71', '1');
INSERT INTO `w_s_products` VALUES ('716', '423', '100', '0', '0', '0', '0', '0', '0', '72', '72', '1');
INSERT INTO `w_s_products` VALUES ('717', '422', '100', '0', '0', '0', '0', '0', '0', '73', '73', '1');
INSERT INTO `w_s_products` VALUES ('718', '421', '200', '0', '0', '0', '0', '0', '0', '74', '74', '1');
INSERT INTO `w_s_products` VALUES ('719', '419', '100', '0', '0', '0', '0', '0', '0', '75', '75', '1');
INSERT INTO `w_s_products` VALUES ('720', '417', '100', '0', '0', '0', '0', '0', '0', '76', '76', '1');
INSERT INTO `w_s_products` VALUES ('721', '404', '2666', '0', '0', '0', '0', '0', '0', '77', '77', '1');
INSERT INTO `w_s_products` VALUES ('722', '403', '2666', '0', '0', '0', '0', '0', '0', '78', '78', '1');
INSERT INTO `w_s_products` VALUES ('723', '402', '2666', '0', '0', '0', '0', '0', '0', '79', '79', '1');
INSERT INTO `w_s_products` VALUES ('724', '401', '2666', '0', '0', '0', '0', '0', '0', '80', '80', '1');
INSERT INTO `w_s_products` VALUES ('725', '400', '2666', '0', '0', '0', '0', '0', '0', '81', '81', '1');
INSERT INTO `w_s_products` VALUES ('726', '399', '2666', '0', '0', '0', '0', '0', '0', '82', '82', '1');
INSERT INTO `w_s_products` VALUES ('727', '398', '2666', '0', '0', '0', '0', '0', '0', '83', '83', '1');
INSERT INTO `w_s_products` VALUES ('728', '397', '2666', '0', '0', '0', '0', '0', '0', '84', '84', '1');
INSERT INTO `w_s_products` VALUES ('729', '396', '2666', '0', '0', '0', '0', '0', '0', '85', '85', '1');
INSERT INTO `w_s_products` VALUES ('730', '395', '2666', '0', '0', '0', '0', '0', '0', '86', '86', '1');
INSERT INTO `w_s_products` VALUES ('731', '394', '2666', '0', '0', '0', '0', '0', '0', '87', '87', '1');
INSERT INTO `w_s_products` VALUES ('732', '393', '2666', '0', '0', '0', '0', '0', '0', '88', '88', '1');
INSERT INTO `w_s_products` VALUES ('733', '392', '2666', '0', '0', '0', '0', '0', '0', '89', '89', '1');
INSERT INTO `w_s_products` VALUES ('734', '391', '2666', '0', '0', '0', '0', '0', '0', '90', '90', '1');
INSERT INTO `w_s_products` VALUES ('735', '390', '2666', '0', '0', '0', '0', '0', '0', '91', '91', '1');
INSERT INTO `w_s_products` VALUES ('736', '389', '2666', '0', '0', '0', '0', '0', '0', '92', '92', '1');
INSERT INTO `w_s_products` VALUES ('737', '388', '2666', '0', '0', '0', '0', '0', '0', '93', '93', '1');
INSERT INTO `w_s_products` VALUES ('738', '387', '2666', '0', '0', '0', '0', '0', '0', '94', '94', '1');
INSERT INTO `w_s_products` VALUES ('739', '386', '2666', '0', '0', '0', '0', '0', '0', '95', '95', '1');
INSERT INTO `w_s_products` VALUES ('740', '385', '2666', '0', '0', '0', '0', '0', '0', '96', '96', '1');
INSERT INTO `w_s_products` VALUES ('741', '384', '2666', '0', '0', '0', '0', '0', '0', '97', '97', '1');
INSERT INTO `w_s_products` VALUES ('742', '382', '2666', '0', '0', '0', '0', '0', '0', '98', '98', '1');
INSERT INTO `w_s_products` VALUES ('743', '381', '2666', '0', '0', '0', '0', '0', '0', '99', '99', '1');
INSERT INTO `w_s_products` VALUES ('744', '380', '2666', '0', '0', '0', '0', '0', '0', '100', '100', '1');
INSERT INTO `w_s_products` VALUES ('745', '379', '2666', '0', '0', '0', '0', '0', '0', '101', '101', '1');
INSERT INTO `w_s_products` VALUES ('746', '378', '2666', '0', '0', '0', '0', '0', '0', '102', '102', '1');
INSERT INTO `w_s_products` VALUES ('747', '377', '2666', '0', '0', '0', '0', '0', '0', '103', '103', '1');
INSERT INTO `w_s_products` VALUES ('748', '376', '2666', '0', '0', '0', '0', '0', '0', '104', '104', '1');
INSERT INTO `w_s_products` VALUES ('749', '375', '2666', '0', '0', '0', '0', '0', '0', '105', '105', '1');
INSERT INTO `w_s_products` VALUES ('750', '374', '2666', '0', '0', '0', '0', '0', '0', '106', '106', '1');
INSERT INTO `w_s_products` VALUES ('751', '373', '2666', '0', '0', '0', '0', '0', '0', '107', '107', '1');
INSERT INTO `w_s_products` VALUES ('752', '372', '2666', '0', '0', '0', '0', '0', '0', '108', '108', '1');
INSERT INTO `w_s_products` VALUES ('753', '371', '2666', '0', '0', '0', '0', '0', '0', '109', '109', '1');
INSERT INTO `w_s_products` VALUES ('754', '370', '2666', '0', '0', '0', '0', '0', '0', '110', '110', '1');
INSERT INTO `w_s_products` VALUES ('755', '369', '2666', '0', '0', '0', '0', '0', '0', '111', '111', '1');
INSERT INTO `w_s_products` VALUES ('756', '368', '2666', '0', '0', '0', '0', '0', '0', '112', '112', '1');
INSERT INTO `w_s_products` VALUES ('757', '367', '2666', '0', '0', '0', '0', '0', '0', '113', '113', '1');
INSERT INTO `w_s_products` VALUES ('758', '366', '2666', '0', '0', '0', '0', '0', '0', '114', '114', '1');
INSERT INTO `w_s_products` VALUES ('759', '365', '2666', '0', '0', '0', '0', '0', '0', '115', '115', '1');
INSERT INTO `w_s_products` VALUES ('760', '364', '2666', '0', '0', '0', '0', '0', '0', '116', '116', '1');
INSERT INTO `w_s_products` VALUES ('761', '363', '2666', '0', '0', '0', '0', '0', '0', '117', '117', '1');
INSERT INTO `w_s_products` VALUES ('762', '362', '2666', '0', '0', '0', '0', '0', '0', '118', '118', '1');
INSERT INTO `w_s_products` VALUES ('763', '361', '2666', '0', '0', '0', '0', '0', '0', '119', '119', '1');
INSERT INTO `w_s_products` VALUES ('764', '360', '2666', '0', '0', '0', '0', '0', '0', '120', '120', '1');
INSERT INTO `w_s_products` VALUES ('765', '359', '2666', '0', '0', '0', '0', '0', '0', '121', '121', '1');
INSERT INTO `w_s_products` VALUES ('766', '358', '2666', '0', '0', '0', '0', '0', '0', '122', '122', '1');
INSERT INTO `w_s_products` VALUES ('767', '357', '2666', '0', '0', '0', '0', '0', '0', '123', '123', '1');
INSERT INTO `w_s_products` VALUES ('768', '356', '2666', '0', '0', '0', '0', '0', '0', '124', '124', '1');
INSERT INTO `w_s_products` VALUES ('769', '355', '2666', '0', '0', '0', '0', '0', '0', '125', '125', '1');
INSERT INTO `w_s_products` VALUES ('770', '354', '2666', '0', '0', '0', '0', '0', '0', '126', '126', '1');
INSERT INTO `w_s_products` VALUES ('771', '353', '2666', '0', '0', '0', '0', '0', '0', '127', '127', '1');
INSERT INTO `w_s_products` VALUES ('772', '352', '2666', '0', '0', '0', '0', '0', '0', '128', '128', '1');
INSERT INTO `w_s_products` VALUES ('773', '351', '2666', '0', '0', '0', '0', '0', '0', '129', '129', '1');
INSERT INTO `w_s_products` VALUES ('774', '350', '2666', '0', '0', '0', '0', '0', '0', '130', '130', '1');
INSERT INTO `w_s_products` VALUES ('775', '349', '2666', '0', '0', '0', '0', '0', '0', '131', '131', '1');
INSERT INTO `w_s_products` VALUES ('776', '348', '2666', '0', '0', '0', '0', '0', '0', '132', '132', '1');
INSERT INTO `w_s_products` VALUES ('777', '347', '2666', '0', '0', '0', '0', '0', '0', '133', '133', '1');
INSERT INTO `w_s_products` VALUES ('778', '346', '2666', '0', '0', '0', '0', '0', '0', '134', '134', '1');
INSERT INTO `w_s_products` VALUES ('779', '345', '2666', '0', '0', '0', '0', '0', '0', '135', '135', '1');
INSERT INTO `w_s_products` VALUES ('780', '344', '2666', '0', '0', '0', '0', '0', '0', '136', '136', '1');
INSERT INTO `w_s_products` VALUES ('781', '343', '2666', '0', '0', '0', '0', '0', '0', '137', '137', '1');
INSERT INTO `w_s_products` VALUES ('782', '342', '2666', '0', '0', '0', '0', '0', '0', '138', '138', '1');
INSERT INTO `w_s_products` VALUES ('783', '341', '2666', '0', '0', '0', '0', '0', '0', '139', '139', '1');
INSERT INTO `w_s_products` VALUES ('784', '340', '2666', '0', '0', '0', '0', '0', '0', '140', '140', '1');
INSERT INTO `w_s_products` VALUES ('785', '339', '2666', '0', '0', '0', '0', '0', '0', '141', '141', '1');
INSERT INTO `w_s_products` VALUES ('786', '338', '2666', '0', '0', '0', '0', '0', '0', '142', '142', '1');
INSERT INTO `w_s_products` VALUES ('787', '337', '2666', '0', '0', '0', '0', '0', '0', '143', '143', '1');
INSERT INTO `w_s_products` VALUES ('788', '336', '2666', '0', '0', '0', '0', '0', '0', '144', '144', '1');
INSERT INTO `w_s_products` VALUES ('789', '335', '2666', '0', '0', '0', '0', '0', '0', '145', '145', '1');
INSERT INTO `w_s_products` VALUES ('790', '334', '2666', '0', '0', '0', '0', '0', '0', '146', '146', '1');
INSERT INTO `w_s_products` VALUES ('791', '333', '2666', '0', '0', '0', '0', '0', '0', '147', '147', '1');
INSERT INTO `w_s_products` VALUES ('792', '332', '2666', '0', '0', '0', '0', '0', '0', '148', '148', '1');
INSERT INTO `w_s_products` VALUES ('793', '331', '2666', '0', '0', '0', '0', '0', '0', '149', '149', '1');
INSERT INTO `w_s_products` VALUES ('794', '330', '2666', '0', '0', '0', '0', '0', '0', '150', '150', '1');
INSERT INTO `w_s_products` VALUES ('795', '329', '2666', '0', '0', '0', '0', '0', '0', '151', '151', '1');
INSERT INTO `w_s_products` VALUES ('796', '328', '2666', '0', '0', '0', '0', '0', '0', '152', '152', '1');
INSERT INTO `w_s_products` VALUES ('797', '327', '2666', '0', '0', '0', '0', '0', '0', '153', '153', '1');
INSERT INTO `w_s_products` VALUES ('798', '326', '2666', '0', '0', '0', '0', '0', '0', '154', '154', '1');
INSERT INTO `w_s_products` VALUES ('799', '325', '2666', '0', '0', '0', '0', '0', '0', '155', '155', '1');
INSERT INTO `w_s_products` VALUES ('800', '324', '2666', '0', '0', '0', '0', '0', '0', '156', '156', '1');
INSERT INTO `w_s_products` VALUES ('801', '468', '2666', '0', '0', '0', '0', '0', '0', '304', '304', '89');
INSERT INTO `w_s_products` VALUES ('802', '467', '2666', '0', '0', '0', '0', '0', '0', '305', '305', '89');
INSERT INTO `w_s_products` VALUES ('803', '466', '2666', '0', '0', '0', '0', '0', '0', '306', '306', '89');
INSERT INTO `w_s_products` VALUES ('804', '465', '2666', '0', '0', '0', '0', '0', '0', '307', '307', '89');
INSERT INTO `w_s_products` VALUES ('805', '464', '2666', '0', '0', '0', '0', '0', '0', '308', '308', '89');
INSERT INTO `w_s_products` VALUES ('806', '463', '2666', '0', '0', '0', '0', '0', '0', '309', '309', '89');
INSERT INTO `w_s_products` VALUES ('807', '462', '2666', '0', '0', '0', '0', '0', '0', '310', '310', '89');
INSERT INTO `w_s_products` VALUES ('808', '461', '2666', '0', '0', '0', '0', '0', '0', '311', '311', '89');
INSERT INTO `w_s_products` VALUES ('809', '460', '2666', '0', '0', '0', '0', '0', '0', '312', '312', '89');
INSERT INTO `w_s_products` VALUES ('810', '459', '2666', '0', '0', '0', '0', '0', '0', '313', '313', '89');
INSERT INTO `w_s_products` VALUES ('811', '458', '2666', '0', '0', '0', '0', '0', '0', '314', '314', '89');
INSERT INTO `w_s_products` VALUES ('812', '457', '2666', '0', '0', '0', '0', '0', '0', '315', '315', '89');
INSERT INTO `w_s_products` VALUES ('813', '518', '2666', '0', '0', '0', '0', '0', '1', '157', '157', '1');
INSERT INTO `w_s_products` VALUES ('814', '517', '2666', '0', '0', '0', '0', '0', '1', '158', '158', '1');
INSERT INTO `w_s_products` VALUES ('815', '516', '2666', '0', '0', '0', '0', '0', '0', '159', '159', '1');
INSERT INTO `w_s_products` VALUES ('816', '515', '2666', '0', '0', '0', '0', '0', '0', '160', '160', '1');
INSERT INTO `w_s_products` VALUES ('817', '514', '2666', '0', '0', '0', '0', '0', '0', '161', '161', '1');
INSERT INTO `w_s_products` VALUES ('818', '513', '2666', '0', '0', '0', '0', '0', '0', '162', '162', '1');
INSERT INTO `w_s_products` VALUES ('819', '512', '2666', '0', '0', '0', '0', '0', '0', '163', '163', '1');
INSERT INTO `w_s_products` VALUES ('820', '511', '2666', '0', '0', '0', '0', '0', '0', '164', '164', '1');
INSERT INTO `w_s_products` VALUES ('821', '510', '2666', '0', '0', '0', '0', '0', '0', '165', '165', '1');
INSERT INTO `w_s_products` VALUES ('822', '509', '2666', '0', '0', '0', '0', '0', '0', '166', '166', '1');
INSERT INTO `w_s_products` VALUES ('823', '508', '2666', '0', '0', '0', '0', '0', '0', '167', '167', '1');
INSERT INTO `w_s_products` VALUES ('824', '507', '2666', '0', '0', '0', '0', '0', '0', '168', '168', '1');
INSERT INTO `w_s_products` VALUES ('825', '506', '2666', '0', '0', '0', '0', '0', '0', '169', '169', '1');
INSERT INTO `w_s_products` VALUES ('826', '505', '2666', '0', '0', '0', '0', '0', '0', '170', '170', '1');
INSERT INTO `w_s_products` VALUES ('827', '504', '2666', '0', '0', '0', '0', '0', '0', '171', '171', '1');
INSERT INTO `w_s_products` VALUES ('828', '503', '2666', '0', '0', '0', '0', '0', '0', '172', '172', '1');
INSERT INTO `w_s_products` VALUES ('829', '502', '2666', '0', '0', '0', '0', '0', '0', '173', '173', '1');
INSERT INTO `w_s_products` VALUES ('830', '501', '2666', '0', '0', '0', '0', '0', '0', '174', '174', '1');
INSERT INTO `w_s_products` VALUES ('831', '500', '2666', '0', '0', '0', '0', '0', '0', '175', '175', '1');
INSERT INTO `w_s_products` VALUES ('832', '499', '2666', '0', '0', '0', '0', '0', '0', '176', '176', '1');
INSERT INTO `w_s_products` VALUES ('833', '498', '2666', '0', '0', '0', '0', '0', '0', '177', '177', '1');
INSERT INTO `w_s_products` VALUES ('834', '497', '2666', '0', '0', '0', '0', '0', '0', '178', '178', '1');
INSERT INTO `w_s_products` VALUES ('835', '496', '2666', '0', '0', '0', '0', '0', '0', '179', '179', '1');
INSERT INTO `w_s_products` VALUES ('836', '495', '2666', '0', '0', '0', '0', '0', '0', '180', '180', '1');
INSERT INTO `w_s_products` VALUES ('837', '494', '2666', '0', '0', '0', '0', '0', '0', '181', '181', '1');
INSERT INTO `w_s_products` VALUES ('838', '493', '2666', '0', '0', '0', '0', '0', '0', '182', '182', '1');
INSERT INTO `w_s_products` VALUES ('839', '492', '2666', '0', '0', '0', '0', '0', '0', '183', '183', '1');
INSERT INTO `w_s_products` VALUES ('840', '491', '2666', '0', '0', '0', '0', '0', '0', '184', '184', '1');
INSERT INTO `w_s_products` VALUES ('841', '490', '2666', '0', '0', '0', '0', '0', '0', '185', '185', '1');
INSERT INTO `w_s_products` VALUES ('842', '489', '2666', '0', '0', '0', '0', '0', '0', '186', '186', '1');
INSERT INTO `w_s_products` VALUES ('843', '488', '2666', '0', '0', '0', '0', '0', '0', '187', '187', '1');
INSERT INTO `w_s_products` VALUES ('844', '487', '2666', '0', '0', '0', '0', '0', '0', '188', '188', '1');
INSERT INTO `w_s_products` VALUES ('845', '486', '2666', '0', '0', '0', '0', '0', '0', '189', '189', '1');
INSERT INTO `w_s_products` VALUES ('846', '485', '2666', '0', '0', '0', '0', '0', '0', '190', '190', '1');
INSERT INTO `w_s_products` VALUES ('847', '484', '2666', '0', '0', '0', '0', '0', '0', '191', '191', '1');
INSERT INTO `w_s_products` VALUES ('848', '483', '2666', '0', '0', '0', '0', '0', '0', '192', '192', '1');
INSERT INTO `w_s_products` VALUES ('849', '482', '2666', '0', '0', '0', '0', '0', '0', '193', '193', '1');
INSERT INTO `w_s_products` VALUES ('850', '481', '2666', '0', '0', '0', '0', '0', '0', '194', '194', '1');
INSERT INTO `w_s_products` VALUES ('851', '480', '2666', '0', '0', '0', '0', '0', '0', '195', '195', '1');
INSERT INTO `w_s_products` VALUES ('852', '479', '2666', '0', '0', '0', '0', '0', '0', '196', '196', '1');
INSERT INTO `w_s_products` VALUES ('853', '478', '2666', '0', '0', '0', '0', '0', '0', '197', '197', '1');
INSERT INTO `w_s_products` VALUES ('854', '477', '2666', '0', '0', '0', '0', '0', '0', '198', '198', '1');
INSERT INTO `w_s_products` VALUES ('855', '476', '2666', '0', '0', '0', '0', '0', '0', '199', '199', '1');
INSERT INTO `w_s_products` VALUES ('856', '475', '2666', '0', '0', '0', '0', '0', '0', '200', '200', '1');
INSERT INTO `w_s_products` VALUES ('857', '474', '2666', '0', '0', '0', '0', '0', '0', '201', '201', '1');
INSERT INTO `w_s_products` VALUES ('858', '473', '2666', '0', '0', '0', '0', '0', '0', '202', '202', '1');
INSERT INTO `w_s_products` VALUES ('859', '472', '2666', '0', '0', '0', '0', '0', '0', '203', '203', '1');
INSERT INTO `w_s_products` VALUES ('860', '471', '2666', '0', '0', '0', '0', '0', '0', '204', '204', '1');
INSERT INTO `w_s_products` VALUES ('861', '470', '2666', '0', '0', '0', '0', '0', '0', '205', '205', '1');
INSERT INTO `w_s_products` VALUES ('862', '469', '2666', '0', '0', '0', '0', '0', '0', '206', '206', '1');
INSERT INTO `w_s_products` VALUES ('863', '323', '2666', '0', '0', '0', '0', '0', '0', '207', '207', '1');
INSERT INTO `w_s_products` VALUES ('864', '322', '2666', '0', '0', '0', '0', '0', '0', '208', '208', '1');
INSERT INTO `w_s_products` VALUES ('865', '321', '2666', '0', '0', '0', '0', '0', '0', '209', '209', '1');
INSERT INTO `w_s_products` VALUES ('866', '320', '2666', '0', '0', '0', '0', '0', '0', '210', '210', '1');
INSERT INTO `w_s_products` VALUES ('867', '319', '2666', '0', '0', '0', '0', '0', '0', '211', '211', '1');
INSERT INTO `w_s_products` VALUES ('868', '318', '2666', '0', '0', '0', '0', '0', '0', '212', '212', '1');
INSERT INTO `w_s_products` VALUES ('869', '317', '2666', '0', '0', '0', '0', '0', '0', '213', '213', '1');
INSERT INTO `w_s_products` VALUES ('870', '316', '2666', '0', '0', '0', '0', '0', '0', '214', '214', '1');
INSERT INTO `w_s_products` VALUES ('871', '315', '2666', '0', '0', '0', '0', '0', '0', '215', '215', '1');
INSERT INTO `w_s_products` VALUES ('872', '314', '2666', '0', '0', '0', '0', '0', '0', '216', '216', '1');
INSERT INTO `w_s_products` VALUES ('873', '518', '2666', '0', '0', '1', '0', '0', '1', '316', '316', '89');
INSERT INTO `w_s_products` VALUES ('874', '517', '2666', '0', '0', '1', '0', '0', '1', '317', '317', '89');
INSERT INTO `w_s_products` VALUES ('875', '516', '2666', '0', '0', '0', '0', '0', '0', '318', '318', '89');
INSERT INTO `w_s_products` VALUES ('876', '515', '2666', '0', '0', '0', '0', '0', '0', '319', '319', '89');
INSERT INTO `w_s_products` VALUES ('877', '514', '2666', '0', '0', '0', '0', '0', '0', '320', '320', '89');
INSERT INTO `w_s_products` VALUES ('878', '513', '2666', '0', '0', '0', '0', '0', '0', '321', '321', '89');
INSERT INTO `w_s_products` VALUES ('879', '512', '2666', '0', '0', '0', '0', '0', '0', '322', '322', '89');
INSERT INTO `w_s_products` VALUES ('880', '511', '2666', '0', '0', '0', '0', '0', '0', '323', '323', '89');
INSERT INTO `w_s_products` VALUES ('881', '510', '2666', '0', '0', '0', '0', '0', '0', '324', '324', '89');
INSERT INTO `w_s_products` VALUES ('882', '509', '2666', '0', '0', '0', '0', '0', '0', '325', '325', '89');
INSERT INTO `w_s_products` VALUES ('883', '508', '2666', '0', '0', '0', '0', '0', '0', '326', '326', '89');
INSERT INTO `w_s_products` VALUES ('884', '507', '2666', '0', '0', '0', '0', '0', '0', '327', '327', '89');
INSERT INTO `w_s_products` VALUES ('885', '506', '2666', '0', '0', '0', '0', '0', '0', '328', '328', '89');
INSERT INTO `w_s_products` VALUES ('886', '505', '2666', '0', '0', '0', '0', '0', '0', '329', '329', '89');
INSERT INTO `w_s_products` VALUES ('887', '504', '2666', '0', '0', '0', '0', '0', '0', '330', '330', '89');
INSERT INTO `w_s_products` VALUES ('888', '503', '2666', '0', '0', '0', '0', '0', '0', '331', '331', '89');
INSERT INTO `w_s_products` VALUES ('889', '502', '2666', '0', '0', '0', '0', '0', '0', '332', '332', '89');
INSERT INTO `w_s_products` VALUES ('890', '501', '2666', '0', '0', '0', '0', '0', '0', '333', '333', '89');
INSERT INTO `w_s_products` VALUES ('891', '500', '2666', '0', '0', '0', '0', '0', '0', '334', '334', '89');
INSERT INTO `w_s_products` VALUES ('892', '499', '2666', '0', '0', '0', '0', '0', '0', '335', '335', '89');
INSERT INTO `w_s_products` VALUES ('893', '498', '2666', '0', '0', '0', '0', '0', '0', '336', '336', '89');
INSERT INTO `w_s_products` VALUES ('894', '497', '2666', '0', '0', '0', '0', '0', '0', '337', '337', '89');
INSERT INTO `w_s_products` VALUES ('895', '496', '2666', '0', '0', '0', '0', '0', '0', '338', '338', '89');
INSERT INTO `w_s_products` VALUES ('896', '495', '2666', '0', '0', '0', '0', '0', '0', '339', '339', '89');
INSERT INTO `w_s_products` VALUES ('897', '494', '2666', '0', '0', '0', '0', '0', '0', '340', '340', '89');
INSERT INTO `w_s_products` VALUES ('898', '493', '2666', '0', '0', '0', '0', '0', '0', '341', '341', '89');
INSERT INTO `w_s_products` VALUES ('899', '492', '2666', '0', '0', '0', '0', '0', '0', '342', '342', '89');
INSERT INTO `w_s_products` VALUES ('900', '491', '2666', '0', '0', '0', '0', '0', '0', '343', '343', '89');
INSERT INTO `w_s_products` VALUES ('901', '490', '2666', '0', '0', '0', '0', '0', '0', '344', '344', '89');
INSERT INTO `w_s_products` VALUES ('902', '489', '2666', '0', '0', '0', '0', '0', '0', '345', '345', '89');
INSERT INTO `w_s_products` VALUES ('903', '488', '2666', '0', '0', '0', '0', '0', '0', '346', '346', '89');
INSERT INTO `w_s_products` VALUES ('904', '487', '2666', '0', '0', '0', '0', '0', '0', '347', '347', '89');
INSERT INTO `w_s_products` VALUES ('905', '486', '2666', '0', '0', '0', '0', '0', '0', '348', '348', '89');
INSERT INTO `w_s_products` VALUES ('906', '485', '2666', '0', '0', '0', '0', '0', '0', '349', '349', '89');
INSERT INTO `w_s_products` VALUES ('907', '484', '2666', '0', '0', '0', '0', '0', '0', '350', '350', '89');
INSERT INTO `w_s_products` VALUES ('908', '483', '2666', '0', '0', '0', '0', '0', '0', '351', '351', '89');
INSERT INTO `w_s_products` VALUES ('909', '482', '2666', '0', '0', '0', '0', '0', '0', '352', '352', '89');
INSERT INTO `w_s_products` VALUES ('910', '481', '2666', '0', '0', '0', '0', '0', '0', '353', '353', '89');
INSERT INTO `w_s_products` VALUES ('911', '480', '2666', '0', '0', '0', '0', '0', '0', '354', '354', '89');
INSERT INTO `w_s_products` VALUES ('912', '479', '2666', '0', '0', '0', '0', '0', '0', '355', '355', '89');
INSERT INTO `w_s_products` VALUES ('913', '478', '2666', '0', '0', '0', '0', '0', '0', '356', '356', '89');
INSERT INTO `w_s_products` VALUES ('914', '477', '2666', '0', '0', '0', '0', '0', '0', '357', '357', '89');
INSERT INTO `w_s_products` VALUES ('915', '476', '2666', '0', '0', '0', '0', '0', '0', '358', '358', '89');
INSERT INTO `w_s_products` VALUES ('916', '475', '2666', '0', '0', '0', '0', '0', '0', '359', '359', '89');
INSERT INTO `w_s_products` VALUES ('917', '474', '2666', '0', '0', '0', '0', '0', '0', '360', '360', '89');
INSERT INTO `w_s_products` VALUES ('918', '473', '2666', '0', '0', '0', '0', '0', '0', '361', '361', '89');
INSERT INTO `w_s_products` VALUES ('919', '472', '2666', '0', '0', '0', '0', '0', '0', '362', '362', '89');
INSERT INTO `w_s_products` VALUES ('920', '471', '2666', '0', '0', '0', '0', '0', '0', '363', '363', '89');
INSERT INTO `w_s_products` VALUES ('921', '470', '2666', '0', '0', '0', '0', '0', '0', '364', '364', '89');
INSERT INTO `w_s_products` VALUES ('922', '469', '2666', '0', '0', '0', '0', '0', '0', '365', '365', '89');
drop table if exists w_session;
CREATE TABLE `w_session` (
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

INSERT INTO `w_session` VALUES ('', '1262605772', '17eed03538e9f4254315640144ceb7da', '1', '0', '', '0', '0', '__default|a:7:{s:22:\"session.client.browser\";s:88:\"Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6\";s:15:\"session.counter\";i:2;s:8:\"registry\";O:9:\"WRegistry\":3:{s:17:\"_defaultNameSpace\";s:7:\"session\";s:9:\"_registry\";a:1:{s:7:\"session\";a:1:{s:4:\"data\";O:8:\"stdClass\":0:{}}}s:7:\"_errors\";a:0:{}}s:4:\"user\";O:5:\"WUser\":19:{s:2:\"id\";i:0;s:4:\"name\";N;s:8:\"username\";N;s:5:\"email\";N;s:8:\"password\";N;s:14:\"password_clear\";s:0:\"\";s:8:\"usertype\";N;s:5:\"block\";N;s:9:\"sendEmail\";i:0;s:3:\"gid\";i:0;s:12:\"registerDate\";N;s:13:\"lastvisitDate\";N;s:10:\"activation\";N;s:6:\"params\";N;s:3:\"aid\";i:0;s:5:\"guest\";i:1;s:7:\"_params\";O:10:\"WParameter\":7:{s:4:\"_raw\";s:0:\"\";s:4:\"_xml\";N;s:9:\"_elements\";a:0:{}s:12:\"_elementPath\";a:1:{i:0;s:72:\"E:\\www\\mysystem\\frameworktwo\\_code\\libraries\\core\\html\\parameter\\element\";}s:17:\"_defaultNameSpace\";s:8:\"_default\";s:9:\"_registry\";a:1:{s:8:\"_default\";a:1:{s:4:\"data\";O:8:\"stdClass\":0:{}}}s:7:\"_errors\";a:0:{}}s:9:\"_errorMsg\";N;s:7:\"_errors\";a:0:{}}s:19:\"session.timer.start\";i:1262605772;s:18:\"session.timer.last\";i:1262605772;s:17:\"session.timer.now\";i:1262605772;}');
drop table if exists w_shipping;
CREATE TABLE `w_shipping` (
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
  `published` enum('0','1') default '1',
  PRIMARY KEY  (`id`),
  KEY `ind_disabled` (`ordering`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO `w_shipping` VALUES ('1', 'EMS-中国邮政（示范）2', 'a:7:{s:10:\"firstprice\";d:10;s:9:\"firstunit\";i:5000;s:13:\"continueprice\";d:9;s:12:\"continueunit\";i:500;s:7:\"setting\";s:11:\"setting_sda\";s:9:\"dt_useexp\";s:1:\"0\";s:10:\"defAreaFee\";s:1:\"1\";}', '{{w-0}-0.4}*{{{500-w}-0.4}+1}*20+ {{w-500}-0.6}*[(w-500)/500]*9', '', '0', '1', '0', '0', '0.00', '50', '0', '0.00', '1', '1', '1');
INSERT INTO `w_shipping` VALUES ('2', '快递-申通深圳（示范）2', 'a:7:{s:10:\"firstprice\";d:17;s:9:\"firstunit\";i:1000;s:13:\"continueprice\";d:12;s:12:\"continueunit\";i:1000;s:7:\"setting\";s:11:\"setting_sda\";s:9:\"dt_useexp\";s:1:\"0\";s:10:\"defAreaFee\";s:1:\"1\";}', '{{w-0}-0.4}*{{{1000-w}-0.4}+1}*15+ {{w-1000}-0.6}*[(w-1000)/1000]*10', '<div class=\"uarea\">国内一般1-2天送达</div>', '0', '1', '0', '1', '1.00', '50', '0', '2.00', '2', '2', '0');
INSERT INTO `w_shipping` VALUES ('3', '快递-顺丰上海（示范）', 'a:7:{s:10:\"firstprice\";d:20;s:9:\"firstunit\";i:1000;s:13:\"continueprice\";d:10;s:12:\"continueunit\";i:1000;s:7:\"setting\";s:11:\"setting_sda\";s:9:\"dt_useexp\";s:1:\"0\";s:10:\"defAreaFee\";s:1:\"1\";}', '{{w-0}-0.4}*{{{1000-w}-0.4}+1}*20+ {{w-1000}-0.6}*[(w-1000)/1000]*10', '<div class=\"uarea\">\r\n<p>江浙沪当日送达，其他地区隔日送达</p>\r\n</div>', '0', '1', '0', '0', '0.00', '50', '0', '0.00', '2', '4', '1');
INSERT INTO `w_shipping` VALUES ('4', '上海同城快递（示范）', 'a:7:{s:10:\"firstprice\";d:0;s:9:\"firstunit\";i:1000;s:13:\"continueprice\";d:0;s:12:\"continueunit\";i:1000;s:7:\"setting\";s:11:\"setting_sda\";s:9:\"dt_useexp\";s:1:\"0\";s:10:\"defAreaFee\";N;}', '{{w-0}-0.4}*{{{1000-w}-0.4}+1}*+ {{w-1000}-0.6}*[(w-1000)/1000]*', '<div class=\"uarea\">当日到达</div>', '0', '1', '0', '0', '0.00', '50', '0', '0.00', '2', '0', '1');
INSERT INTO `w_shipping` VALUES ('8', '平邮（示范）', 'a:9:{s:10:\"firstprice\";s:1:\"5\";s:9:\"firstunit\";s:3:\"500\";s:13:\"continueprice\";s:1:\"2\";s:12:\"continueunit\";s:3:\"500\";s:15:\"confexpressions\";s:0:\"\";s:7:\"setting\";s:11:\"setting_hda\";s:9:\"dt_useexp\";i:0;s:7:\"has_cod\";s:1:\"0\";s:10:\"defAreaFee\";i:0;}', '{{w-0}-0.4}*{{{500-w}-0.4}+1}*5+ {{w-500}-0.6}*[(w-500)/500]*2', '', '0', '1', '0', '0', '0.00', '50', '0', '0.00', '2', '0', '1');
INSERT INTO `w_shipping` VALUES ('9', '货到付款（示范）', 'a:9:{s:10:\"firstprice\";s:2:\"10\";s:9:\"firstunit\";s:4:\"1000\";s:13:\"continueprice\";s:1:\"2\";s:12:\"continueunit\";s:4:\"1000\";s:15:\"confexpressions\";s:0:\"\";s:7:\"setting\";s:11:\"setting_hda\";s:9:\"dt_useexp\";i:0;s:7:\"has_cod\";s:1:\"1\";s:10:\"defAreaFee\";i:0;}', '{{w-0}-0.4}*{{{1000-w}-0.4}+1}*10+ {{w-1000}-0.6}*[(w-1000)/1000]*2', '<DIV class=uarea>测试使用，不要删除</DIV>', '0', '1', '0', '0', '0.00', '2', '1', '0.00', '2', '0', '1');
INSERT INTO `w_shipping` VALUES ('10', '上门自取（示范）', 'a:9:{s:10:\"firstprice\";s:1:\"0\";s:9:\"firstunit\";s:4:\"1000\";s:13:\"continueprice\";s:1:\"0\";s:12:\"continueunit\";s:4:\"1000\";s:15:\"confexpressions\";s:0:\"\";s:7:\"setting\";s:11:\"setting_hda\";s:9:\"dt_useexp\";i:0;s:7:\"has_cod\";s:1:\"0\";s:10:\"defAreaFee\";i:0;}', '{{w-0}-0.4}*{{{1000-w}-0.4}+1}*0+ {{w-1000}-0.6}*[(w-1000)/1000]*0', '<div class=\"uarea\">到指定门店自取</div>', '0', '1', '0', '1', '0.00', '50', '0', '0.00', '2', '0', '1');
drop table if exists w_shopping_area;
CREATE TABLE `w_shopping_area` (
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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

INSERT INTO `w_shopping_area` VALUES ('1', '2', '', '0', 'asfd', '石家庄市', '7', 'a:3:{s:8:\"firstFee\";s:1:\"8\";s:11:\"continueFee\";s:1:\"2\";s:6:\"useexp\";s:1:\"0\";}', '{{w-0}-0.4}*{{{1000-w}-0.4}+1}*8+ {{w-1000}-0.6}*[(w-1000)/1000]*2', '0');
INSERT INTO `w_shopping_area` VALUES ('2', '2', '', '0', 'asfd', '中国', '1', 'a:3:{s:8:\"firstFee\";s:2:\"12\";s:11:\"continueFee\";s:1:\"2\";s:6:\"useexp\";s:1:\"0\";}', '{{w-0}-0.4}*{{{1000-w}-0.4}+1}*12+ {{w-1000}-0.6}*[(w-1000)/1000]*2', '0');
INSERT INTO `w_shopping_area` VALUES ('17', '4', '0', '0', 'sadfsadf', '河北,内蒙古,辽宁', '6,30,43', 'a:3:{s:8:\"firstFee\";s:0:\"\";s:11:\"continueFee\";s:0:\"\";s:6:\"useexp\";s:1:\"0\";}', '', '0');
INSERT INTO `w_shopping_area` VALUES ('20', '4', '0', '0', 'sadf', '山西,北京,上海,内蒙古', '18,2,3,30', 'a:3:{s:8:\"firstFee\";s:0:\"\";s:11:\"continueFee\";s:0:\"\";s:6:\"useexp\";s:1:\"0\";}', '', '0');
INSERT INTO `w_shopping_area` VALUES ('3', '2', '', '0', 'asdf', '香港,河北', '10,6', 'a:3:{s:8:\"firstFee\";s:2:\"30\";s:11:\"continueFee\";s:1:\"3\";s:6:\"useexp\";s:1:\"0\";}', '{{w-0}-0.4}*{{{1000-w}-0.4}+1}*30+ {{w-1000}-0.6}*[(w-1000)/1000]*3', '0');
INSERT INTO `w_shopping_area` VALUES ('4', '3', '', '0', 'asdf', '上海,河北,秦皇岛市', '6,9', 'a:3:{s:8:\"firstFee\";s:1:\"8\";s:11:\"continueFee\";s:1:\"2\";s:6:\"useexp\";s:1:\"0\";}', '{{w-0}-0.4}*{{{1000-w}-0.4}+1}*8+ {{w-1000}-0.6}*[(w-1000)/1000]*2', '0');
INSERT INTO `w_shopping_area` VALUES ('5', '3', '', '0', 'asdf', '江苏,浙江', '', 'a:5:{s:8:\"firstFee\";s:2:\"15\";s:11:\"continueFee\";s:1:\"2\";s:6:\"hasCod\";N;s:11:\"expressions\";s:0:\"\";s:6:\"useexp\";s:1:\"0\";}', '{{w-0}-0.4}*{{{1000-w}-0.4}+1}*15+ {{w-1000}-0.6}*[(w-1000)/1000]*2', '0');
INSERT INTO `w_shopping_area` VALUES ('16', '4', '0', '0', 'asdfasdf', '天津,山西,辽宁', '4,18,43', 'a:3:{s:8:\"firstFee\";s:3:\"213\";s:11:\"continueFee\";s:2:\"12\";s:6:\"useexp\";s:1:\"0\";}', '', '0');
INSERT INTO `w_shopping_area` VALUES ('12', '9', '', '0', '', '上海,江苏,浙江', ',21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,1643,1644,1645,1646,1647,1648,1649,1650,1651,1652,1653,1654,1655,1656,1657,1658,1659,1660,1661,1662,1663,1664,1665,1666,1667,1668,1669,1670,1671,1672,1673,1674,1675,1676,1677,1678,1679,1680,1681,1682,1683,1684,1685,1686,1687,1688,1689,1690,1691,1692,1693,1694,1695,1696,1697,1698,1699,1700,1701,1702,1703,1704,1705,1706,1707,1708,1709,1710,1711,1712,1713,1714,1715,1716,1717,1718,1719,1720,1721,1722,1723,1724,1725,1726,1727,1728,1729,1730,1731,1732,1733,1734,1735,1736,1737,1738,1739,1740,1741,1742,1743,1744,1745,1746,1747,1748,1749,1750,1751,1752,1753,1754,1755,1756,1757,1758,1759,1760,1761,1762,3133,3134,3135,3136,3137,3138,3139,3140,3141,3142,3143,3144,3145,3146,3147,3148,3149,3150,3151,3152,3153,3154,3155,3156,3157,3158,3159,3160,3161,3162,3163,3164,3165,3166,3167,3168,3169,3170,3171,3172,3173,3174,3175,3176,3177,3178,3179,3180,3181,3182,3183,3184,3185,3186,3187,3188,3189,3190,3191,3192,3193,3194,3195,3196,3197,3198,3199,3200,3201,3202,3203,3204,3205,3206,3207,3208,3209,3210,3211,3212,3213,3214,3215,3216,3217,3218,3219,3220,3221,3222,3223,3224,3225,3226,3227,3228,3229,3230,3231,3232,3233,3234,', 'a:5:{s:8:\"firstFee\";s:2:\"12\";s:11:\"continueFee\";s:1:\"2\";s:6:\"hasCod\";N;s:11:\"expressions\";s:0:\"\";s:6:\"useexp\";s:1:\"0\";}', '{{w-0}-0.4}*{{{1000-w}-0.4}+1}*12+ {{w-1000}-0.6}*[(w-1000)/1000]*2', '0');
INSERT INTO `w_shopping_area` VALUES ('13', '9', '', '0', '', '﻿北京,天津,广东', ',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437,438,439,440,441,442,443,444,445,446,447,448,449,450,451,452,453,454,455,456,457,458,459,460,461,462,463,464,465,466,467,468,469,470,471,472,473,474,475,476,477,478,479,480,481,482,483,484,485,486,487,488,489,490,491,492,493,494,495,496,497,498,499,500,501,502,503,504,505,506,507,508,509,510,511,512,513,514,515,516,517,518,519,520,521,522,523,524,525,526,527,528,529,530,531,532,533,534,535,536,537,538,539,540,541,542,543,544,545,546,547,548,549,550,551,552,553,554,555,556,557,558,559,560,561,562,563,564,565,', 'a:5:{s:8:\"firstFee\";s:2:\"20\";s:11:\"continueFee\";s:1:\"3\";s:6:\"hasCod\";N;s:11:\"expressions\";s:0:\"\";s:6:\"useexp\";s:1:\"0\";}', '{{w-0}-0.4}*{{{1000-w}-0.4}+1}*20+ {{w-1000}-0.6}*[(w-1000)/1000]*3', '0');
INSERT INTO `w_shopping_area` VALUES ('14', '1', '0', '0', '上海，辽宁', '上海,邯郸市,天津,内蒙古', '3,10,4,30', 'a:5:{s:8:\"firstFee\";s:2:\"12\";s:11:\"continueFee\";s:2:\"23\";s:6:\"hasCod\";N;s:11:\"expressions\";s:0:\"\";s:6:\"useexp\";s:1:\"0\";}', '{{w-0}-0.4}*{{{500-w}-0.4}+1}*12+ {{w-500}-0.6}*[(w-500)/500]*23', '0');
INSERT INTO `w_shopping_area` VALUES ('15', '1', '0', '0', '天津', '天津,上海,秦皇岛市', '4,3,9', 'a:5:{s:8:\"firstFee\";s:2:\"20\";s:11:\"continueFee\";s:1:\"9\";s:6:\"hasCod\";N;s:11:\"expressions\";s:0:\"\";s:6:\"useexp\";s:1:\"0\";}', '{{w-0}-0.4}*{{{500-w}-0.4}+1}*20+ {{w-500}-0.6}*[(w-500)/500]*9', '0');
drop table if exists w_subscribe;
CREATE TABLE `w_subscribe` (
  `id` mediumint(11) NOT NULL auto_increment,
  `email` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `w_subscribe` VALUES ('1', 'werqwe@126.com', '2011-03-03 14:45:29', '1');
INSERT INTO `w_subscribe` VALUES ('2', 'sadf', '2011-03-03 14:57:06', '1');
drop table if exists w_tags;
CREATE TABLE `w_tags` (
  `id` int(11) NOT NULL auto_increment,
  `tag` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `w_tags` VALUES ('1', 'asdf');
INSERT INTO `w_tags` VALUES ('2', 'asfd');
INSERT INTO `w_tags` VALUES ('3', 'test');
INSERT INTO `w_tags` VALUES ('4', '手机');
INSERT INTO `w_tags` VALUES ('5', '戴尔');
INSERT INTO `w_tags` VALUES ('6', '黑陶');
drop table if exists w_templates_menu;
CREATE TABLE `w_templates_menu` (
  `template` varchar(255) NOT NULL default '',
  `menuid` int(11) NOT NULL default '0',
  `client_id` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`menuid`,`client_id`,`template`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `w_templates_menu` VALUES ('daybillion', '0', '0');
INSERT INTO `w_templates_menu` VALUES ('default', '0', '1');
drop table if exists w_tree;
CREATE TABLE `w_tree` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) default '',
  `lft` int(10) unsigned NOT NULL default '0',
  `rgt` int(10) unsigned NOT NULL default '0',
  `parent_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `w_tree` VALUES ('1', '关于我们', '1', '4', '0');
INSERT INTO `w_tree` VALUES ('2', '产品介绍', '5', '10', '0');
INSERT INTO `w_tree` VALUES ('3', '联系方式', '2', '3', '1');
INSERT INTO `w_tree` VALUES ('4', '电子产品', '6', '7', '2');
INSERT INTO `w_tree` VALUES ('5', '软件系列', '8', '9', '2');
drop table if exists w_user_friend;
CREATE TABLE `w_user_friend` (
  `uid` int(11) NOT NULL default '0',
  `fid` int(11) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `w_user_friend` VALUES ('1', '89');
INSERT INTO `w_user_friend` VALUES ('105', '111');
INSERT INTO `w_user_friend` VALUES ('109', '105');
INSERT INTO `w_user_friend` VALUES ('0', '89');
INSERT INTO `w_user_friend` VALUES ('0', '89');
INSERT INTO `w_user_friend` VALUES ('0', '89');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '89');
INSERT INTO `w_user_friend` VALUES ('0', '89');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('89', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('89', '105');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('1', '111');
INSERT INTO `w_user_friend` VALUES ('0', '111');
INSERT INTO `w_user_friend` VALUES ('89', '111');
INSERT INTO `w_user_friend` VALUES ('0', '111');
INSERT INTO `w_user_friend` VALUES ('0', '1');
INSERT INTO `w_user_friend` VALUES ('0', '1');
drop table if exists w_user_info;
CREATE TABLE `w_user_info` (
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

INSERT INTO `w_user_info` VALUES ('89', '1', '1984', '8', '18', '217', '220', 'adfasfdaf', 'dfasfd', '23423', '32', '43', '23', '23', '23', '23', '23', '23', '23', '23');
INSERT INTO `w_user_info` VALUES ('1', '1', '1975', '4', '1', '0', '0', '2222safd', '', 's23', 'we23', 'w2', '5', '', '', '', '', '', '', '');
INSERT INTO `w_user_info` VALUES ('110', '0', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `w_user_info` VALUES ('114', '1', '1973', '3', '9', '30', '37', 'sadfa2', '1', '2', '3', '4', '5', 'asdf', '23', '23', '23', '23', '23', '23');
INSERT INTO `w_user_info` VALUES ('109', '0', '1967', '1', '1', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `w_user_info` VALUES ('113', '0', '1967', '1', '1', '0', '0', 'asfd', '', '', '', '', '', '2', '23', '23', '23', '23', '23', '23');
INSERT INTO `w_user_info` VALUES ('112', '0', '1967', '1', '1', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `w_user_info` VALUES ('0', '0', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `w_user_info` VALUES ('115', '0', '1967', '1', '1', '184', '189', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `w_user_info` VALUES ('116', '0', '1967', '1', '1', '217', '218', '23', '1', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13');
drop table if exists w_users;
CREATE TABLE `w_users` (
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
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=utf8;

INSERT INTO `w_users` VALUES ('89', 'testtest', '', 'day@126.com2', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', '0', '0', '17', '2010-04-14 11:02:42', '2011-04-09 23:40:22', '', '', '1', '2', '67', '/member/media/photo/kt28.jpg', '电影导航', '819', '0', '217', '220');
INSERT INTO `w_users` VALUES ('1', 'china', 'asfd', 'whl308221710@163.com', 'c4033bff94b567a190e33faa551f411caef444f2', '', '0', '0', '22', '0000-00-00 00:00:00', '2011-03-24 13:33:26', '', '', '0', '3', '48', '/member/media/photo/kt2.jpg', '中国导航网', '3450', '0', '0', '0');
INSERT INTO `w_users` VALUES ('109', 'testtest2', '', 'daybillion@yahoo.com.cn', 'c4033bff94b567a190e33faa551f411caef444f2', '', '0', '0', '1', '2010-09-20 14:42:55', '2011-03-29 11:55:33', '', '', '0', '0', '0', '/member/media/photo/kt21.jpg', '世界都用UI58', '88', '0', '0', '0');
INSERT INTO `w_users` VALUES ('105', 'tanggsh', '', 'tanggsh@tom.com2', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', '0', '0', '1', '2010-09-01 21:05:23', '2010-11-20 14:39:01', '', '', '0', '0', '9', '/member/media/photo/kt25.jpg', '设计师专用导航', '103', '0', '0', '0');
INSERT INTO `w_users` VALUES ('108', 'mteddy', '', 'mteddy@126.com', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', '0', '0', '14', '2010-09-07 17:28:42', '2010-11-20 11:51:56', '', '', '0', '0', '0', '/member/media/photo/kt1.jpg', '', '118', '0', '0', '0');
INSERT INTO `w_users` VALUES ('110', 'testtest4', '', 'daybillion@yahoo.com.cn', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', '0', '0', '1', '2010-11-12 16:22:28', '2010-11-18 10:21:24', '', '', '0', '0', '1', '/member/media/photo/kt1.jpg', '我的小站', '93', '0', '0', '0');
INSERT INTO `w_users` VALUES ('112', 'testtest5', '', 'daybillion@yahoo.com.cn', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', '1', '0', '1', '2010-11-18 08:58:46', '0000-00-00 00:00:00', '', '', '0', '0', '0', '', '', '0', '0', '0', '0');
INSERT INTO `w_users` VALUES ('115', 'testtest33', '', 'whl30822710@163.com', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', '1', '0', '17', '2011-01-21 14:57:05', '0000-00-00 00:00:00', '', '', '0', '0', '0', '', '', '0', '0', '184', '189');
INSERT INTO `w_users` VALUES ('116', 'test8882', '', 'whl30822710@163.com', '69c5fcebaa65b560eaf06c3fbeb481ae44b8d618', '', '0', '0', '17', '2011-01-21 15:17:01', '2011-03-22 14:05:19', '', '', '0', '0', '0', '', '', '0', '0', '217', '218');
INSERT INTO `w_users` VALUES ('117', 'testtest333', '', 'werqwe@126.com', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', '0', '0', '1', '2011-03-15 16:27:02', '0000-00-00 00:00:00', '', '', '0', '0', '0', '', '', '0', '0', '0', '0');
INSERT INTO `w_users` VALUES ('118', 'newuser1', '', 'whl_whm@126.com', '063cd9edb635afeccfee305b8b21e073b5a58e00', '', '0', '0', '1', '2011-03-25 09:11:22', '2011-03-25 09:11:39', '', '', '0', '0', '0', '', '', '0', '0', '0', '0');
drop table if exists w_users_address;
CREATE TABLE `w_users_address` (
  `address_id` int(11) NOT NULL auto_increment,
  `address_name` varchar(50) NOT NULL default '',
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `consignee` varchar(60) NOT NULL default '',
  `email` varchar(60) default NULL,
  `country` smallint(5) default NULL,
  `province` varchar(255) default NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO `w_users_address` VALUES ('2', '', '4', '', '', '0', '', '0', '0', '', '', '', '', '', '', '0');
INSERT INTO `w_users_address` VALUES ('3', '', '5', 'asdfasf', '', '0', '', '0', '0', '', '', '', '', '', '', '0');
INSERT INTO `w_users_address` VALUES ('4', '', '1', 'safdasf23', '', '0', '166', '167', '0', 'asfdasfd', 'asfd', '', 'asfd', '', '', '0');
INSERT INTO `w_users_address` VALUES ('7', '', '1', 'asfd', '', '0', '148', '149', '0', 'asfdasfdasfd', 'asfd', '', 'asfd', '', '', '1');
INSERT INTO `w_users_address` VALUES ('8', '', '1', '新天地', '', '0', '136', '137', '0', 'asfdasfd', 'afd', '', 'asfd', '', '', '0');
INSERT INTO `w_users_address` VALUES ('9', '', '109', '张强', '', '0', '2', '0', '0', '北京市中心区', '10000', '', '12341234', '', '', '1');
INSERT INTO `w_users_address` VALUES ('10', '', '0', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '0');
INSERT INTO `w_users_address` VALUES ('11', '', '0', 'asdf', '', '0', '2', '0', '0', 'asdf', 'asdfasfd', 'asdf', 'sadf', '', '', '0');
INSERT INTO `w_users_address` VALUES ('12', '', '89', 'asdf', '', '0', '2', '0', '0', 'asdf', 'asdfasfd', 'asdf', 'sadf', '', '', '0');
INSERT INTO `w_users_address` VALUES ('13', '', '89', 'asdf', '', '0', '2', '0', '0', 'asdf', 'asdfasfd', 'asdf', 'sadf', '', '', '0');
INSERT INTO `w_users_address` VALUES ('14', '', '118', '小明', '', '0', '2', '0', '0', '北京市中心区', '12341234', '', '12342134', '', '', '0');
INSERT INTO `w_users_address` VALUES ('15', '', '109', 'dfdfdf', '', '0', '217', '218', '0', 'frfr', 'frfr', 'rfrfrfrf', 'frfrf', '', '', '0');
