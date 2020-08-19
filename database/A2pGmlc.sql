/*
 Navicat Premium Data Transfer

 Source Server         : A2pGMLC Prod
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : 127.0.0.1:3860
 Source Schema         : A2pGmlc

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 18/08/2020 15:02:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment`  (
  `item_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `first_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_update` datetime(0) NULL DEFAULT NULL,
  `last_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_update` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`) USING BTREE,
  INDEX `auth_assignment_user_id_idx`(`user_id`) USING BTREE,
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_auth_assignment_auth_login1` FOREIGN KEY (`user_id`) REFERENCES `auth_login` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('admin', 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_assignment` VALUES ('admin', 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'gibran19', '10.12.12.62', '2020-06-03 12:36:18', NULL, NULL, NULL);
INSERT INTO `auth_assignment` VALUES ('admin', 'VmtMs4An4y74QXRS6xH_RdX6AgiaCjtB', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_assignment` VALUES ('Developer', 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', '10.12.12.62', '2020-06-04 11:29:50', NULL, NULL, NULL);
INSERT INTO `auth_assignment` VALUES ('Super admin', 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_assignment` VALUES ('Super admin', 'fa15FphJoHy0xem6wt8ShMqhalQrHsmw', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_assignment` VALUES ('Super admin', 'KKw0-EzprSh4U56cFTwnPn3kSZCPAHIt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_assignment` VALUES ('Super admin', 'M2-csEWTY6oVzqsGC-4Pqy2I2gSrOlq6', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_assignment` VALUES ('Super admin', 'mBSlF8QdeaVM4nfYjqKlzplNx0LmMNWy', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_assignment` VALUES ('View only', '83NFJg-QI6FQPVP425Pk0VB_aHP9Fy1j', 'gibran19', '10.12.12.62', '2020-06-03 12:37:25', NULL, NULL, NULL);
INSERT INTO `auth_assignment` VALUES ('View only', 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_assignment` VALUES ('View only', 'yibmYizxUEbXV5ZMDeL5QeaMQPtm-ASn', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rule_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `data` blob NULL,
  `menu1` varchar(450) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menu2` varchar(450) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menu3` varchar(450) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menu_label` varchar(450) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menu_url` varchar(450) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_update` datetime(0) NULL DEFAULT NULL,
  `last_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_update` datetime(0) NULL DEFAULT NULL,
  `perent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE,
  INDEX `rule_name`(`rule_name`) USING BTREE,
  INDEX `type`(`type`) USING BTREE,
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('Account API', 3, NULL, NULL, NULL, 'Configuration', 'Configuration APH', NULL, 'Account API', 'aph/', NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-02 16:35:04', '');
INSERT INTO `auth_item` VALUES ('admin', 2, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-03 12:28:11', NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('APH Transaction Detail', 3, NULL, NULL, NULL, 'Reporting', 'Report', NULL, 'APH Transaction Detail', 'aph-transaction-history/', NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-08 13:42:54', '');
INSERT INTO `auth_item` VALUES ('app\\controllers\\AphController', 3, NULL, NULL, NULL, 'hidden', 'undefined2', NULL, 'app\\\\controllers\\\\AphController', 'aph/', NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-02 13:43:10', '');
INSERT INTO `auth_item` VALUES ('app\\controllers\\AphController.create', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\AphController', 'create', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AphController.delete', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\AphController', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AphController.index', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\AphController', 'index', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AphController.update', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\AphController', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AphController.view', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\AphController', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthAssignmentController', 3, NULL, NULL, NULL, 'hidden', 'hidden', NULL, 'Auth Assignment', 'auth-assignment/', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthAssignmentController.create', 1, NULL, NULL, NULL, 'Auth Assignment', 'create', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthAssignmentController.delete', 1, NULL, NULL, NULL, 'Auth Assignment', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthAssignmentController.index', 1, NULL, NULL, NULL, 'Auth Assignment', 'index', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthAssignmentController.update', 1, NULL, NULL, NULL, 'Auth Assignment', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthAssignmentController.view', 1, NULL, NULL, NULL, 'Auth Assignment', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem2Controller.create', 1, NULL, NULL, NULL, '2.Profile Group', 'create', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem2Controller.delete', 1, NULL, NULL, NULL, '2.Profile Group', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem2Controller.index', 1, NULL, NULL, NULL, '2.Profile Group', 'index', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem2Controller.update', 1, NULL, NULL, NULL, '2.Profile Group', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem2Controller.view', 1, NULL, NULL, NULL, '2.Profile Group', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem3Controller', 3, NULL, NULL, NULL, 'User', '3.Item', NULL, '1. Menu Item', 'auth-item3/', NULL, NULL, NULL, 'admin', '182.253.124.94', '2019-12-05 11:39:23', NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem3Controller.create', 1, NULL, NULL, NULL, '1.Auth Item', 'create', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem3Controller.delete', 1, NULL, NULL, NULL, '1.Auth Item', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem3Controller.index', 1, NULL, NULL, NULL, '1.Auth Item', 'index', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem3Controller.update', 1, NULL, NULL, NULL, '1.Auth Item', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem3Controller.view', 1, NULL, NULL, NULL, '1.Auth Item', 'vew', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem5Controller', 3, NULL, NULL, NULL, 'hidden', 'hidden', NULL, 'app\\\\controllers\\\\AuthItem5Controller', 'auth-item5/', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem5Controller.create', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\AuthItem5Controller', 'create', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem5Controller.delete', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\AuthItem5Controller', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem5Controller.index', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\AuthItem5Controller', 'index', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem5Controller.update', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\AuthItem5Controller', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItem5Controller.view', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\AuthItem5Controller', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItemChildController', 3, NULL, NULL, NULL, 'hidden', 'hidden', NULL, 'Auth Item Detail', 'auth-item-child/', NULL, NULL, NULL, 'test', '180.243.92.37', '2019-10-15 00:15:28', NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItemChildController.create', 1, NULL, NULL, NULL, 'Auth Item Detail', 'create', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItemChildController.delete', 1, NULL, NULL, NULL, 'Auth Item Detail', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItemChildController.index', 1, NULL, NULL, NULL, 'Auth Item Detail', 'index', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItemChildController.update', 1, NULL, NULL, NULL, 'Auth Item Detail', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItemChildController.view', 1, NULL, NULL, NULL, 'Auth Item Detail', 'vew', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItemController', 3, NULL, NULL, NULL, 'User', '2.Configuration', NULL, '1.Menu Configuration', 'auth-item/', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItemController.create', 1, NULL, NULL, NULL, '1.Menu Configuration', 'create', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItemController.delete', 1, NULL, NULL, NULL, '1.Menu Configuration', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItemController.index', 1, NULL, NULL, NULL, '1.Menu Configuration', 'index', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItemController.update', 1, NULL, NULL, NULL, '1.Menu Configuration', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthItemController.view', 1, NULL, NULL, NULL, '1.Menu Configuration', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthLoginController', 3, NULL, NULL, NULL, 'hidden', '1. Security', NULL, '1.Login', 'auth-login/', NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-02 16:33:51', '');
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthLoginController.create', 1, NULL, NULL, NULL, '1.Login', 'create', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthLoginController.delete', 1, NULL, NULL, NULL, '1.Login', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthLoginController.index', 1, NULL, NULL, NULL, '1.Login', 'index', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthLoginController.update', 1, NULL, NULL, NULL, '1.Login', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthLoginController.view', 1, NULL, NULL, NULL, '1.Login', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthRuleController', 3, NULL, NULL, NULL, 'User', '3.Item', NULL, '2.Rule', 'auth-rule/', NULL, NULL, NULL, 'admin', '182.253.124.94', '2019-12-05 11:40:26', NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthRuleController.create', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthRuleController.delete', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthRuleController.index', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthRuleController.update', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\AuthRuleController.view', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\Controller', 3, NULL, NULL, NULL, 'hidden', 'undefined2', NULL, 'app\\\\controllers\\\\Controller', '/', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\Controller.create', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\Controller', 'create', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\Controller.delete', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\Controller', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\Controller.index', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\Controller', 'index', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\Controller.update', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\Controller', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\Controller.view', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\Controller', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\ErrCodeSmsController', 3, NULL, NULL, NULL, 'hidden', 'undefined2', NULL, 'app\\\\controllers\\\\ErrCodeSmsController', 'err-code-sms/', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\ErrCodeSmsController.create', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\ErrCodeSmsController', 'create', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\ErrCodeSmsController.delete', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\ErrCodeSmsController', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\ErrCodeSmsController.index', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\ErrCodeSmsController', 'index', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\ErrCodeSmsController.update', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\ErrCodeSmsController', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\ErrCodeSmsController.view', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\ErrCodeSmsController', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\GHistoryLogController', 3, NULL, NULL, NULL, 'hidden', '1. History', NULL, 'History Activity', 'g-history-log/', NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-02 16:13:23', '');
INSERT INTO `auth_item` VALUES ('app\\controllers\\GHistoryLogController.create', 1, NULL, NULL, NULL, 'History Activity', 'create', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\GHistoryLogController.delete', 1, NULL, NULL, NULL, 'History Activity', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\GHistoryLogController.index', 1, NULL, NULL, NULL, 'History Activity', 'index', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\GHistoryLogController.update', 1, NULL, NULL, NULL, 'History Activity', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\GHistoryLogController.view', 1, NULL, NULL, NULL, 'History Activity', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\MdnWhitelistController', 3, NULL, NULL, NULL, 'hidden', 'undefined2', NULL, 'app\\\\controllers\\\\MdnWhitelistController', 'mdn-whitelist/', NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-02 13:42:51', '');
INSERT INTO `auth_item` VALUES ('app\\controllers\\MdnWhitelistController.create', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\MdnWhitelistController', 'create', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\MdnWhitelistController.delete', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\MdnWhitelistController', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\MdnWhitelistController.index', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\MdnWhitelistController', 'index', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\MdnWhitelistController.update', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\MdnWhitelistController', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('app\\controllers\\MdnWhitelistController.view', 1, NULL, NULL, NULL, 'app\\\\controllers\\\\MdnWhitelistController', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('Dashboard', 3, NULL, NULL, NULL, 'Dashboard', 'Dashboard', NULL, 'Dashboard', 'site/index', 'gibran19', '10.12.12.62', '2020-06-05 15:28:40', NULL, NULL, NULL, '');
INSERT INTO `auth_item` VALUES ('Developer', 2, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-03 15:34:06', NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('Konfigurasi Whitelist MDN', 3, NULL, NULL, NULL, 'Configuration', 'Configuration Whitelist', NULL, 'Whitelist MDN', 'mdn-whitelist/', NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-02 16:35:18', '');
INSERT INTO `auth_item` VALUES ('Report Generator', 3, NULL, NULL, NULL, 'Reporting', 'Report Generator', NULL, 'Report Generator', '/report-generator-x', 'gibran19', '10.12.12.62', '2020-06-02 13:57:51', NULL, NULL, NULL, '');
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.APH Transaction Daily.json.build', 1, NULL, NULL, NULL, 'APH Transaction Daily', 'build', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.APH Transaction Daily.json.delete', 1, NULL, NULL, NULL, 'APH Transaction Daily', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.APH Transaction Daily.json.update', 1, NULL, NULL, NULL, 'APH Transaction Daily', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.APH Transaction Daily.json.view', 1, NULL, NULL, NULL, 'APH Transaction Daily', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.APH Transaction Detail.json.build', 1, NULL, NULL, NULL, 'APH Transaction Detail', 'build', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.APH Transaction Detail.json.delete', 1, NULL, NULL, NULL, 'APH Transaction Detail', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.APH Transaction Detail.json.update', 1, NULL, NULL, NULL, 'APH Transaction Detail', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.APH Transaction Detail.json.view', 1, NULL, NULL, NULL, 'APH Transaction Detail', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MO Daily.json.build', 1, NULL, NULL, NULL, 'report(Summary MO Daily)', 'build', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MO Daily.json.delete', 1, NULL, NULL, NULL, 'report(Summary MO Daily)', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MO Daily.json.update', 1, NULL, NULL, NULL, 'report(Summary MO Daily)', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MO Daily.json.view', 1, NULL, NULL, NULL, 'report(Summary MO Daily)', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MO Hourly.json.build', 1, NULL, NULL, NULL, 'Summary MO Hourly', 'build', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MO Hourly.json.delete', 1, NULL, NULL, NULL, 'Summary MO Hourly', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MO Hourly.json.update', 1, NULL, NULL, NULL, 'Summary MO Hourly', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MO Hourly.json.view', 1, NULL, NULL, NULL, 'Summary MO Hourly', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MT Daily.json.build', 1, NULL, NULL, NULL, 'Summary MT Daily', 'build', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MT Daily.json.delete', 1, NULL, NULL, NULL, 'Summary MT Daily', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MT Daily.json.update', 1, NULL, NULL, NULL, 'Summary MT Daily', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MT Daily.json.view', 1, NULL, NULL, NULL, 'Summary MT Daily', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MT Hourly.json.build', 1, NULL, NULL, NULL, 'Summary MT Hourly', 'build', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MT Hourly.json.delete', 1, NULL, NULL, NULL, 'Summary MT Hourly', 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MT Hourly.json.update', 1, NULL, NULL, NULL, 'Summary MT Hourly', 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('ReportGeneratorController.Summary MT Hourly.json.view', 1, NULL, NULL, NULL, 'Summary MT Hourly', 'view', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('Role Management', 3, NULL, NULL, NULL, 'User', '2.Configuration', NULL, 'Role Management', 'auth-item2/', NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-02 16:36:26', '');
INSERT INTO `auth_item` VALUES ('SMS Based On DR Daily', 3, NULL, NULL, NULL, 'Reporting', 'Report', NULL, 'SMS Based On DR Daily', 'sms-by-dr/', 'gibran19', '127.0.0.1', '2020-06-22 13:13:57', NULL, NULL, NULL, '');
INSERT INTO `auth_item` VALUES ('Success Rate DR Daily', 3, NULL, NULL, NULL, 'Reporting', 'Report KPI', NULL, 'Success Rate DR Daily', 'success-dr/', 'gibran19', '127.0.0.1', '2020-06-22 13:14:29', NULL, NULL, NULL, '');
INSERT INTO `auth_item` VALUES ('Success Rate DR Hourly', 3, NULL, NULL, NULL, 'Reporting', 'Report KPI', NULL, 'Success Rate DR Hourly', 'success-dr-hourly/', 'gibran19', '127.0.0.1', '2020-06-22 13:14:55', NULL, NULL, NULL, '');
INSERT INTO `auth_item` VALUES ('Success Rate GMLC Daily', 3, NULL, NULL, NULL, 'Reporting', 'Report KPI', NULL, 'Success Rate GMLC Daily', 'success-rate-gmlc/', 'gibran19', '127.0.0.1', '2020-06-22 13:15:25', NULL, NULL, NULL, '');
INSERT INTO `auth_item` VALUES ('Success Rate GMLC Hourly', 3, NULL, NULL, NULL, 'Reporting', 'Report KPI', NULL, 'Success Rate GMLC Hourly', 'success-rate-gmlc-hourly/', 'gibran19', '127.0.0.1', '2020-06-22 13:15:48', NULL, NULL, NULL, '');
INSERT INTO `auth_item` VALUES ('Summary APH Transaction Daily ALL', 3, NULL, NULL, NULL, 'Reporting', 'Report', NULL, 'Summary APH Transaction Daily ALL', 'aph-transaction-history-daily/', NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-08 19:08:13', '');
INSERT INTO `auth_item` VALUES ('Summary MO Daily', 3, NULL, NULL, NULL, 'Reporting', 'Report', NULL, 'Summary MO Daily', 'summary-mo-daily/', NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-08 13:18:50', '');
INSERT INTO `auth_item` VALUES ('Summary MO Hourly', 3, NULL, NULL, NULL, 'Reporting', 'Report', NULL, 'Summary MO Hourly', 'summary-mo-hourly/', NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-08 13:22:54', '');
INSERT INTO `auth_item` VALUES ('Summary MT Daily', 3, NULL, NULL, NULL, 'Reporting', 'Report', NULL, 'Summary MT Daily', 'summary-mt-daily/', NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-08 13:27:40', '');
INSERT INTO `auth_item` VALUES ('Summary MT Hourly', 3, NULL, NULL, NULL, 'Reporting', 'Report', NULL, 'Summary MT Hourly', 'summary-mt-hourly/', NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-08 13:30:31', '');
INSERT INTO `auth_item` VALUES ('Summary TPS Daily', 3, NULL, NULL, NULL, 'Reporting', 'Report', NULL, 'Summary TPS Daily', 'summary-tps-daily/', 'gibran19', '10.12.12.62', '2020-06-09 12:20:06', NULL, NULL, NULL, '');
INSERT INTO `auth_item` VALUES ('Summary TPS Hourly', 3, NULL, NULL, NULL, 'Reporting', 'Report', NULL, 'Summary TPS Hourly', 'summary-tps-hourly/', 'gibran19', '10.12.12.62', '2020-06-09 12:19:31', NULL, NULL, NULL, '');
INSERT INTO `auth_item` VALUES ('Super admin', 2, 'Supera dmin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-03 17:56:30', NULL, NULL, NULL, NULL);
INSERT INTO `auth_item` VALUES ('Template SMS', 3, NULL, NULL, NULL, 'Configuration', 'Configuration APH', NULL, 'Template SMS', 'err-code-sms/', NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-02 16:35:34', '');
INSERT INTO `auth_item` VALUES ('User Management', 3, NULL, NULL, NULL, 'User', 'User Management', NULL, 'User Management', '/auth-login', 'gibran19', '10.12.12.62', '2020-06-02 16:29:35', 'gibran19', '10.12.12.62', '2020-06-02 16:33:33', '');
INSERT INTO `auth_item` VALUES ('View only', 2, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-03 12:28:22', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child`  (
  `parent` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `first_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_update` datetime(0) NULL DEFAULT NULL,
  `last_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_update` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`parent`, `child`) USING BTREE,
  INDEX `child`(`child`) USING BTREE,
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('admin', 'APH Transaction Detail', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'app\\controllers\\ErrCodeSmsController', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'app\\controllers\\ErrCodeSmsController.create', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'app\\controllers\\ErrCodeSmsController.delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'app\\controllers\\ErrCodeSmsController.index', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'app\\controllers\\ErrCodeSmsController.update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'app\\controllers\\ErrCodeSmsController.view', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'Dashboard', 'gibran19', '10.12.12.62', '2020-06-08 16:14:26', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.APH Transaction Daily.json.build', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.APH Transaction Daily.json.delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.APH Transaction Daily.json.update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.APH Transaction Daily.json.view', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.APH Transaction Detail.json.build', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.APH Transaction Detail.json.delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.APH Transaction Detail.json.update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.APH Transaction Detail.json.view', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MO Daily.json.build', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MO Daily.json.delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MO Daily.json.update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MO Daily.json.view', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MO Hourly.json.build', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MO Hourly.json.delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MO Hourly.json.update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MO Hourly.json.view', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MT Daily.json.build', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MT Daily.json.delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MT Daily.json.update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MT Daily.json.view', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MT Hourly.json.build', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MT Hourly.json.delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MT Hourly.json.update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'ReportGeneratorController.Summary MT Hourly.json.view', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'SMS Based On DR Daily', 'gibran19', '127.0.0.1', '2020-06-22 13:45:02', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'Success Rate DR Daily', 'gibran19', '127.0.0.1', '2020-06-22 13:45:04', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'Success Rate DR Hourly', 'gibran19', '127.0.0.1', '2020-06-22 13:45:05', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'Success Rate GMLC Daily', 'gibran19', '127.0.0.1', '2020-06-22 13:45:07', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'Success Rate GMLC Hourly', 'gibran19', '127.0.0.1', '2020-06-22 13:45:08', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'Summary APH Transaction Daily ALL', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'Summary MO Daily', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'Summary MO Hourly', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'Summary MT Daily', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('admin', 'Summary MT Hourly', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Account API', 'gibran19', '10.12.12.62', '2020-06-04 11:26:04', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'APH Transaction Detail', 'gibran19', '10.12.12.62', '2020-06-04 18:06:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AphController', 'gibran19', '10.12.12.62', '2020-06-04 11:26:41', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AphController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:26:04', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AphController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:26:05', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AphController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:26:05', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AphController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:26:06', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AphController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:26:07', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthAssignmentController', 'gibran19', '10.12.12.62', '2020-06-04 11:26:07', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthAssignmentController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:26:13', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthAssignmentController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:26:14', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthAssignmentController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:26:14', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthAssignmentController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:26:15', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthAssignmentController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:26:16', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem2Controller.create', 'gibran19', '10.12.12.62', '2020-06-04 11:26:25', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem2Controller.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:26:23', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem2Controller.index', 'gibran19', '10.12.12.62', '2020-06-04 11:26:26', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem2Controller.update', 'gibran19', '10.12.12.62', '2020-06-04 11:26:27', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem2Controller.view', 'gibran19', '10.12.12.62', '2020-06-04 11:26:28', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem3Controller', 'gibran19', '10.12.12.62', '2020-06-04 11:26:29', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem3Controller.create', 'gibran19', '10.12.12.62', '2020-06-04 11:26:33', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem3Controller.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:26:47', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem3Controller.index', 'gibran19', '10.12.12.62', '2020-06-04 11:26:55', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem3Controller.update', 'gibran19', '10.12.12.62', '2020-06-04 11:32:17', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem3Controller.view', 'gibran19', '10.12.12.62', '2020-06-04 11:32:26', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem5Controller', 'gibran19', '10.12.12.62', '2020-06-04 11:32:28', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem5Controller.create', 'gibran19', '10.12.12.62', '2020-06-04 11:32:29', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem5Controller.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:32:30', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem5Controller.index', 'gibran19', '10.12.12.62', '2020-06-04 11:32:31', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem5Controller.update', 'gibran19', '10.12.12.62', '2020-06-04 11:32:33', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItem5Controller.view', 'gibran19', '10.12.12.62', '2020-06-04 11:32:35', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItemChildController', 'gibran19', '10.12.12.62', '2020-06-04 11:32:37', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItemChildController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:32:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItemChildController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:32:40', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItemChildController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:32:42', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItemChildController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:32:43', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItemChildController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:32:44', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItemController', 'gibran19', '10.12.12.62', '2020-06-04 11:32:45', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItemController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:32:47', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItemController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:32:48', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItemController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:32:52', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItemController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:32:59', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthItemController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:33:25', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthLoginController', 'gibran19', '10.12.12.62', '2020-06-04 11:33:31', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthLoginController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:33:37', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthLoginController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:33:46', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthLoginController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:33:53', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthLoginController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:33:59', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthLoginController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:34:05', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthRuleController', 'gibran19', '10.12.12.62', '2020-06-04 11:34:11', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthRuleController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:34:15', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthRuleController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:27:00', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthRuleController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:34:20', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthRuleController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:34:23', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\AuthRuleController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:34:26', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\Controller', 'gibran19', '10.12.12.62', '2020-06-04 11:34:30', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\Controller.create', 'gibran19', '10.12.12.62', '2020-06-04 11:34:34', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\Controller.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:34:39', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\Controller.index', 'gibran19', '10.12.12.62', '2020-06-04 11:34:42', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\Controller.update', 'gibran19', '10.12.12.62', '2020-06-04 11:34:45', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\Controller.view', 'gibran19', '10.12.12.62', '2020-06-04 11:35:09', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\ErrCodeSmsController', 'gibran19', '10.12.12.62', '2020-06-05 10:56:58', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\ErrCodeSmsController.create', 'gibran19', '10.12.12.62', '2020-06-05 10:57:16', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\ErrCodeSmsController.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:57:16', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\ErrCodeSmsController.index', 'gibran19', '10.12.12.62', '2020-06-05 10:57:16', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\ErrCodeSmsController.update', 'gibran19', '10.12.12.62', '2020-06-05 10:57:16', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\ErrCodeSmsController.view', 'gibran19', '10.12.12.62', '2020-06-05 10:57:16', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\GHistoryLogController', 'gibran19', '10.12.12.62', '2020-06-04 11:35:19', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\GHistoryLogController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:35:21', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\GHistoryLogController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:35:24', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\GHistoryLogController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:35:26', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\GHistoryLogController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:35:27', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\GHistoryLogController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:35:28', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\MdnWhitelistController', 'gibran19', '10.12.12.62', '2020-06-04 11:35:30', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\MdnWhitelistController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:35:31', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\MdnWhitelistController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:35:32', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\MdnWhitelistController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:35:33', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\MdnWhitelistController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:35:35', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'app\\controllers\\MdnWhitelistController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:35:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Dashboard', 'gibran19', '10.12.12.62', '2020-06-05 15:29:47', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Konfigurasi Whitelist MDN', 'gibran19', '10.12.12.62', '2020-06-04 11:35:53', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Report Generator', 'gibran19', '10.12.12.62', '2020-06-04 11:35:54', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Daily.json.build', 'gibran19', '10.12.12.62', '2020-06-04 18:02:47', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Daily.json.delete', 'gibran19', '10.12.12.62', '2020-06-04 18:02:55', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Daily.json.update', 'gibran19', '10.12.12.62', '2020-06-04 18:02:49', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Daily.json.view', 'gibran19', '10.12.12.62', '2020-06-04 18:02:50', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Detail.json.build', 'gibran19', '10.12.12.62', '2020-06-04 18:06:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Detail.json.delete', 'gibran19', '10.12.12.62', '2020-06-04 18:06:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Detail.json.update', 'gibran19', '10.12.12.62', '2020-06-04 18:06:39', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Detail.json.view', 'gibran19', '10.12.12.62', '2020-06-04 18:07:02', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MO Daily.json.build', 'gibran19', '10.12.12.62', '2020-06-04 17:49:52', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MO Daily.json.delete', 'gibran19', '10.12.12.62', '2020-06-04 17:49:52', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MO Daily.json.update', 'gibran19', '10.12.12.62', '2020-06-04 17:49:59', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MO Daily.json.view', 'gibran19', '10.12.12.62', '2020-06-04 17:49:53', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MO Hourly.json.build', 'gibran19', '10.12.12.62', '2020-06-04 18:49:53', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MO Hourly.json.delete', 'gibran19', '10.12.12.62', '2020-06-04 18:49:49', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MO Hourly.json.update', 'gibran19', '10.12.12.62', '2020-06-04 18:49:44', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MO Hourly.json.view', 'gibran19', '10.12.12.62', '2020-06-04 18:49:41', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MT Daily.json.build', 'gibran19', '10.12.12.62', '2020-06-04 19:00:44', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MT Daily.json.delete', 'gibran19', '10.12.12.62', '2020-06-04 19:00:45', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MT Daily.json.update', 'gibran19', '10.12.12.62', '2020-06-04 19:00:46', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MT Daily.json.view', 'gibran19', '10.12.12.62', '2020-06-04 19:00:47', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MT Hourly.json.build', 'gibran19', '10.12.12.62', '2020-06-04 19:14:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MT Hourly.json.delete', 'gibran19', '10.12.12.62', '2020-06-04 19:14:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MT Hourly.json.update', 'gibran19', '10.12.12.62', '2020-06-04 19:14:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'ReportGeneratorController.Summary MT Hourly.json.view', 'gibran19', '10.12.12.62', '2020-06-04 19:14:37', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Role Management', 'gibran19', '10.12.12.62', '2020-06-04 11:36:14', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'SMS Based On DR Daily', 'gibran19', '127.0.0.1', '2020-06-22 13:16:18', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Success Rate DR Daily', 'gibran19', '127.0.0.1', '2020-06-22 13:16:20', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Success Rate DR Hourly', 'gibran19', '127.0.0.1', '2020-06-22 13:16:21', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Success Rate GMLC Daily', 'gibran19', '127.0.0.1', '2020-06-22 13:16:23', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Success Rate GMLC Hourly', 'gibran19', '127.0.0.1', '2020-06-22 13:16:24', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Summary APH Transaction Daily ALL', 'gibran19', '10.12.12.62', '2020-06-04 18:02:47', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Summary MO Daily', 'gibran19', '10.12.12.62', '2020-06-04 17:49:51', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Summary MO Hourly', 'gibran19', '10.12.12.62', '2020-06-04 18:49:56', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Summary MT Daily', 'gibran19', '10.12.12.62', '2020-06-04 19:00:44', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Summary MT Hourly', 'gibran19', '10.12.12.62', '2020-06-04 19:14:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Summary TPS Daily', 'gibran19', '10.12.12.62', '2020-06-09 12:20:39', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Summary TPS Hourly', 'gibran19', '10.12.12.62', '2020-06-09 12:20:40', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'Template SMS', 'gibran19', '10.12.12.62', '2020-06-04 11:36:11', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Developer', 'User Management', 'gibran19', '10.12.12.62', '2020-06-04 11:36:10', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'Account API', 'gibran19', '10.12.12.62', '2020-06-03 15:34:17', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'APH Transaction Detail', 'gibran19', '10.12.12.62', '2020-06-05 10:56:24', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AphController', 'gibran19', '10.12.12.62', '2020-06-03 15:34:20', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AphController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:34:21', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AphController.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:34:22', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AphController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:34:22', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AphController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:34:27', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AphController.view', 'gibran19', '10.12.12.62', '2020-06-03 15:34:28', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthAssignmentController', 'gibran19', '10.12.12.62', '2020-06-03 15:34:29', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthAssignmentController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:34:29', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthAssignmentController.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:34:30', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthAssignmentController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:34:31', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthAssignmentController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:34:32', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthAssignmentController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:02:08', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem2Controller.create', 'gibran19', '10.12.12.62', '2020-06-03 15:34:34', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem2Controller.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:34:34', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem2Controller.index', 'gibran19', '10.12.12.62', '2020-06-03 15:34:35', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem2Controller.update', 'gibran19', '10.12.12.62', '2020-06-03 15:34:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem2Controller.view', 'gibran19', '10.12.12.62', '2020-06-03 15:34:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem3Controller.create', 'gibran19', '10.12.12.62', '2020-06-03 15:34:48', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem3Controller.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:34:49', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem3Controller.index', 'gibran19', '10.12.12.62', '2020-06-03 15:34:50', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem3Controller.update', 'gibran19', '10.12.12.62', '2020-06-03 15:34:51', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem3Controller.view', 'gibran19', '10.12.12.62', '2020-06-03 15:34:52', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem5Controller', 'gibran19', '10.12.12.62', '2020-06-03 15:34:53', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem5Controller.create', 'gibran19', '10.12.12.62', '2020-06-03 15:34:54', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem5Controller.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:34:55', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem5Controller.index', 'gibran19', '10.12.12.62', '2020-06-03 15:34:58', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem5Controller.update', 'gibran19', '10.12.12.62', '2020-06-03 15:35:03', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItem5Controller.view', 'gibran19', '10.12.12.62', '2020-06-03 15:35:05', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItemChildController', 'gibran19', '10.12.12.62', '2020-06-03 15:35:05', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItemChildController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:35:05', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItemChildController.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:35:06', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItemChildController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:35:07', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItemChildController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:35:08', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItemChildController.view', 'gibran19', '10.12.12.62', '2020-06-03 15:35:11', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItemController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:35:13', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItemController.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:35:14', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItemController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:35:18', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItemController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:35:20', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthItemController.view', 'gibran19', '10.12.12.62', '2020-06-03 15:35:21', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthLoginController', 'gibran19', '10.12.12.62', '2020-06-03 15:35:22', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthLoginController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:35:23', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthLoginController.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:35:24', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthLoginController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:35:28', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthLoginController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:35:29', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthLoginController.view', 'gibran19', '10.12.12.62', '2020-06-03 15:35:29', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthRuleController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:35:35', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthRuleController.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:35:31', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthRuleController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:35:32', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthRuleController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:35:37', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\AuthRuleController.view', 'gibran19', '10.12.12.62', '2020-06-03 15:35:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\Controller', 'gibran19', '10.12.12.62', '2020-06-03 15:35:39', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\Controller.create', 'gibran19', '10.12.12.62', '2020-06-03 15:35:39', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\Controller.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:35:40', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\Controller.index', 'gibran19', '10.12.12.62', '2020-06-03 15:35:41', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\Controller.update', 'gibran19', '10.12.12.62', '2020-06-03 15:35:41', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\Controller.view', 'gibran19', '10.12.12.62', '2020-06-03 15:35:46', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\ErrCodeSmsController', 'gibran19', '10.12.12.62', '2020-06-05 10:58:25', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\ErrCodeSmsController.create', 'gibran19', '10.12.12.62', '2020-06-05 10:58:27', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\ErrCodeSmsController.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:58:28', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\ErrCodeSmsController.index', 'gibran19', '10.12.12.62', '2020-06-05 10:58:29', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\ErrCodeSmsController.update', 'gibran19', '10.12.12.62', '2020-06-05 10:58:30', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\ErrCodeSmsController.view', 'gibran19', '10.12.12.62', '2020-06-05 10:58:31', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\GHistoryLogController', 'gibran19', '10.12.12.62', '2020-06-03 15:35:51', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\GHistoryLogController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:35:54', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\GHistoryLogController.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:35:58', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\GHistoryLogController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:35:58', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\GHistoryLogController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:35:59', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\GHistoryLogController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:24:33', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\MdnWhitelistController', 'gibran19', '10.12.12.62', '2020-06-03 15:36:00', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\MdnWhitelistController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:36:01', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\MdnWhitelistController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:24:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\MdnWhitelistController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:36:02', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\MdnWhitelistController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:36:02', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'app\\controllers\\MdnWhitelistController.view', 'gibran19', '10.12.12.62', '2020-06-03 15:36:04', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'Konfigurasi Whitelist MDN', 'gibran19', '10.12.12.62', '2020-06-04 11:24:58', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Daily.json.build', 'gibran19', '10.12.12.62', '2020-06-05 10:56:27', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Daily.json.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:56:04', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Daily.json.update', 'gibran19', '10.12.12.62', '2020-06-05 10:56:05', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Daily.json.view', 'gibran19', '10.12.12.62', '2020-06-05 10:56:06', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Detail.json.build', 'gibran19', '10.12.12.62', '2020-06-05 10:56:07', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Detail.json.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:56:08', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Detail.json.update', 'gibran19', '10.12.12.62', '2020-06-05 10:56:09', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Detail.json.view', 'gibran19', '10.12.12.62', '2020-06-05 10:56:10', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Daily.json.build', 'gibran19', '10.12.12.62', '2020-06-05 10:56:14', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Daily.json.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:56:14', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Daily.json.update', 'gibran19', '10.12.12.62', '2020-06-05 10:56:23', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Daily.json.view', 'gibran19', '10.12.12.62', '2020-06-05 10:56:16', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Hourly.json.build', 'gibran19', '10.12.12.62', '2020-06-05 10:56:19', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Hourly.json.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:56:20', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Hourly.json.update', 'gibran19', '10.12.12.62', '2020-06-05 10:55:21', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Hourly.json.view', 'gibran19', '10.12.12.62', '2020-06-05 10:55:28', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Daily.json.build', 'gibran19', '10.12.12.62', '2020-06-05 10:55:32', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Daily.json.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:55:33', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Daily.json.update', 'gibran19', '10.12.12.62', '2020-06-05 10:55:34', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Daily.json.view', 'gibran19', '10.12.12.62', '2020-06-05 10:55:35', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Hourly.json.build', 'gibran19', '10.12.12.62', '2020-06-05 10:55:37', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Hourly.json.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:55:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Hourly.json.update', 'gibran19', '10.12.12.62', '2020-06-05 10:55:40', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Hourly.json.view', 'gibran19', '10.12.12.62', '2020-06-05 10:55:41', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'SMS Based On DR Daily', 'gibran19', '127.0.0.1', '2020-06-22 13:44:07', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'Success Rate DR Daily', 'gibran19', '127.0.0.1', '2020-06-22 13:44:09', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'Success Rate DR Hourly', 'gibran19', '127.0.0.1', '2020-06-22 13:44:11', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'Success Rate GMLC Daily', 'gibran19', '127.0.0.1', '2020-06-22 13:44:12', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'Success Rate GMLC Hourly', 'gibran19', '127.0.0.1', '2020-06-22 13:44:14', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'Summary APH Transaction Daily ALL', 'gibran19', '10.12.12.62', '2020-06-05 10:56:03', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'Summary MO Daily', 'gibran19', '10.12.12.62', '2020-06-05 10:56:13', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'Summary MO Hourly', 'gibran19', '10.12.12.62', '2020-06-05 10:56:18', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'Summary MT Daily', 'gibran19', '10.12.12.62', '2020-06-05 10:55:30', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'Summary MT Hourly', 'gibran19', '10.12.12.62', '2020-06-05 10:55:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'Summary TPS Daily', 'gibran19', '10.12.12.62', '2020-06-09 12:21:02', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'Summary TPS Hourly', 'gibran19', '10.12.12.62', '2020-06-09 12:21:04', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'Template SMS', 'gibran19', '10.12.12.62', '2020-06-04 11:24:43', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('Super admin', 'User Management', 'gibran19', '10.12.12.62', '2020-06-04 11:24:41', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('View only', 'Account API', 'gibran19', '10.12.12.62', '2020-06-03 12:32:03', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('View only', 'APH Transaction Detail', 'gibran19', '10.12.12.62', '2020-06-08 16:12:40', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('View only', 'app\\controllers\\AphController.index', 'gibran19', '10.12.12.62', '2020-06-03 12:31:57', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('View only', 'app\\controllers\\AphController.view', 'gibran19', '10.12.12.62', '2020-06-03 12:32:00', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('View only', 'app\\controllers\\ErrCodeSmsController.index', 'gibran19', '10.12.12.62', '2020-06-08 16:13:04', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('View only', 'app\\controllers\\MdnWhitelistController.index', 'gibran19', '10.12.12.62', '2020-06-03 12:32:51', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('View only', 'app\\controllers\\MdnWhitelistController.view', 'gibran19', '10.12.12.62', '2020-06-08 16:13:21', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('View only', 'Dashboard', 'gibran19', '10.12.12.62', '2020-06-08 16:13:23', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('View only', 'Konfigurasi Whitelist MDN', 'gibran19', '10.12.12.62', '2020-06-03 12:32:59', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('View only', 'Summary APH Transaction Daily ALL', 'gibran19', '10.12.12.62', '2020-06-08 16:12:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child` VALUES ('View only', 'Template SMS', 'gibran19', '10.12.12.62', '2020-06-03 12:33:36', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for auth_item_child_backup
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child_backup`;
CREATE TABLE `auth_item_child_backup`  (
  `parent` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `first_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_update` datetime(0) NULL DEFAULT NULL,
  `last_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_update` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`parent`, `child`) USING BTREE,
  INDEX `child`(`child`) USING BTREE,
  CONSTRAINT `auth_item_child_backup_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_backup_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_item_child_backup
-- ----------------------------
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'APH Transaction Detail', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'app\\controllers\\ErrCodeSmsController', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'app\\controllers\\ErrCodeSmsController.create', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'app\\controllers\\ErrCodeSmsController.delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'app\\controllers\\ErrCodeSmsController.index', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'app\\controllers\\ErrCodeSmsController.update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'app\\controllers\\ErrCodeSmsController.view', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'Dashboard', 'gibran19', '10.12.12.62', '2020-06-08 16:14:26', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.APH Transaction Daily.json.build', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.APH Transaction Daily.json.delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.APH Transaction Daily.json.update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.APH Transaction Daily.json.view', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.APH Transaction Detail.json.build', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.APH Transaction Detail.json.delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.APH Transaction Detail.json.update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.APH Transaction Detail.json.view', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MO Daily.json.build', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MO Daily.json.delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MO Daily.json.update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MO Daily.json.view', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MO Hourly.json.build', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MO Hourly.json.delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MO Hourly.json.update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MO Hourly.json.view', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MT Daily.json.build', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MT Daily.json.delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MT Daily.json.update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MT Daily.json.view', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MT Hourly.json.build', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MT Hourly.json.delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MT Hourly.json.update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'ReportGeneratorController.Summary MT Hourly.json.view', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'Summary APH Transaction Daily ALL', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'Summary MO Daily', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'Summary MO Hourly', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'Summary MT Daily', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('admin', 'Summary MT Hourly', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'Account API', 'gibran19', '10.12.12.62', '2020-06-04 11:26:04', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'APH Transaction Detail', 'gibran19', '10.12.12.62', '2020-06-04 18:06:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AphController', 'gibran19', '10.12.12.62', '2020-06-04 11:26:41', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AphController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:26:04', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AphController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:26:05', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AphController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:26:05', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AphController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:26:06', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AphController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:26:07', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthAssignmentController', 'gibran19', '10.12.12.62', '2020-06-04 11:26:07', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthAssignmentController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:26:13', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthAssignmentController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:26:14', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthAssignmentController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:26:14', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthAssignmentController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:26:15', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthAssignmentController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:26:16', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem2Controller.create', 'gibran19', '10.12.12.62', '2020-06-04 11:26:25', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem2Controller.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:26:23', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem2Controller.index', 'gibran19', '10.12.12.62', '2020-06-04 11:26:26', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem2Controller.update', 'gibran19', '10.12.12.62', '2020-06-04 11:26:27', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem2Controller.view', 'gibran19', '10.12.12.62', '2020-06-04 11:26:28', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem3Controller', 'gibran19', '10.12.12.62', '2020-06-04 11:26:29', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem3Controller.create', 'gibran19', '10.12.12.62', '2020-06-04 11:26:33', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem3Controller.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:26:47', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem3Controller.index', 'gibran19', '10.12.12.62', '2020-06-04 11:26:55', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem3Controller.update', 'gibran19', '10.12.12.62', '2020-06-04 11:32:17', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem3Controller.view', 'gibran19', '10.12.12.62', '2020-06-04 11:32:26', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem5Controller', 'gibran19', '10.12.12.62', '2020-06-04 11:32:28', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem5Controller.create', 'gibran19', '10.12.12.62', '2020-06-04 11:32:29', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem5Controller.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:32:30', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem5Controller.index', 'gibran19', '10.12.12.62', '2020-06-04 11:32:31', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem5Controller.update', 'gibran19', '10.12.12.62', '2020-06-04 11:32:33', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItem5Controller.view', 'gibran19', '10.12.12.62', '2020-06-04 11:32:35', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItemChildController', 'gibran19', '10.12.12.62', '2020-06-04 11:32:37', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItemChildController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:32:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItemChildController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:32:40', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItemChildController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:32:42', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItemChildController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:32:43', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItemChildController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:32:44', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItemController', 'gibran19', '10.12.12.62', '2020-06-04 11:32:45', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItemController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:32:47', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItemController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:32:48', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItemController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:32:52', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItemController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:32:59', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthItemController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:33:25', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthLoginController', 'gibran19', '10.12.12.62', '2020-06-04 11:33:31', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthLoginController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:33:37', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthLoginController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:33:46', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthLoginController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:33:53', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthLoginController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:33:59', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthLoginController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:34:05', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthRuleController', 'gibran19', '10.12.12.62', '2020-06-04 11:34:11', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthRuleController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:34:15', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthRuleController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:27:00', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthRuleController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:34:20', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthRuleController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:34:23', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\AuthRuleController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:34:26', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\Controller', 'gibran19', '10.12.12.62', '2020-06-04 11:34:30', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\Controller.create', 'gibran19', '10.12.12.62', '2020-06-04 11:34:34', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\Controller.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:34:39', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\Controller.index', 'gibran19', '10.12.12.62', '2020-06-04 11:34:42', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\Controller.update', 'gibran19', '10.12.12.62', '2020-06-04 11:34:45', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\Controller.view', 'gibran19', '10.12.12.62', '2020-06-04 11:35:09', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\ErrCodeSmsController', 'gibran19', '10.12.12.62', '2020-06-05 10:56:58', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\ErrCodeSmsController.create', 'gibran19', '10.12.12.62', '2020-06-05 10:57:16', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\ErrCodeSmsController.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:57:16', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\ErrCodeSmsController.index', 'gibran19', '10.12.12.62', '2020-06-05 10:57:16', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\ErrCodeSmsController.update', 'gibran19', '10.12.12.62', '2020-06-05 10:57:16', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\ErrCodeSmsController.view', 'gibran19', '10.12.12.62', '2020-06-05 10:57:16', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\GHistoryLogController', 'gibran19', '10.12.12.62', '2020-06-04 11:35:19', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\GHistoryLogController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:35:21', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\GHistoryLogController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:35:24', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\GHistoryLogController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:35:26', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\GHistoryLogController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:35:27', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\GHistoryLogController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:35:28', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\MdnWhitelistController', 'gibran19', '10.12.12.62', '2020-06-04 11:35:30', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\MdnWhitelistController.create', 'gibran19', '10.12.12.62', '2020-06-04 11:35:31', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\MdnWhitelistController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:35:32', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\MdnWhitelistController.index', 'gibran19', '10.12.12.62', '2020-06-04 11:35:33', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\MdnWhitelistController.update', 'gibran19', '10.12.12.62', '2020-06-04 11:35:35', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'app\\controllers\\MdnWhitelistController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:35:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'Dashboard', 'gibran19', '10.12.12.62', '2020-06-05 15:29:47', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'Konfigurasi Whitelist MDN', 'gibran19', '10.12.12.62', '2020-06-04 11:35:53', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'Report Generator', 'gibran19', '10.12.12.62', '2020-06-04 11:35:54', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Daily.json.build', 'gibran19', '10.12.12.62', '2020-06-04 18:02:47', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Daily.json.delete', 'gibran19', '10.12.12.62', '2020-06-04 18:02:55', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Daily.json.update', 'gibran19', '10.12.12.62', '2020-06-04 18:02:49', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Daily.json.view', 'gibran19', '10.12.12.62', '2020-06-04 18:02:50', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Detail.json.build', 'gibran19', '10.12.12.62', '2020-06-04 18:06:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Detail.json.delete', 'gibran19', '10.12.12.62', '2020-06-04 18:06:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Detail.json.update', 'gibran19', '10.12.12.62', '2020-06-04 18:06:39', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.APH Transaction Detail.json.view', 'gibran19', '10.12.12.62', '2020-06-04 18:07:02', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MO Daily.json.build', 'gibran19', '10.12.12.62', '2020-06-04 17:49:52', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MO Daily.json.delete', 'gibran19', '10.12.12.62', '2020-06-04 17:49:52', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MO Daily.json.update', 'gibran19', '10.12.12.62', '2020-06-04 17:49:59', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MO Daily.json.view', 'gibran19', '10.12.12.62', '2020-06-04 17:49:53', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MO Hourly.json.build', 'gibran19', '10.12.12.62', '2020-06-04 18:49:53', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MO Hourly.json.delete', 'gibran19', '10.12.12.62', '2020-06-04 18:49:49', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MO Hourly.json.update', 'gibran19', '10.12.12.62', '2020-06-04 18:49:44', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MO Hourly.json.view', 'gibran19', '10.12.12.62', '2020-06-04 18:49:41', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MT Daily.json.build', 'gibran19', '10.12.12.62', '2020-06-04 19:00:44', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MT Daily.json.delete', 'gibran19', '10.12.12.62', '2020-06-04 19:00:45', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MT Daily.json.update', 'gibran19', '10.12.12.62', '2020-06-04 19:00:46', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MT Daily.json.view', 'gibran19', '10.12.12.62', '2020-06-04 19:00:47', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MT Hourly.json.build', 'gibran19', '10.12.12.62', '2020-06-04 19:14:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MT Hourly.json.delete', 'gibran19', '10.12.12.62', '2020-06-04 19:14:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MT Hourly.json.update', 'gibran19', '10.12.12.62', '2020-06-04 19:14:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'ReportGeneratorController.Summary MT Hourly.json.view', 'gibran19', '10.12.12.62', '2020-06-04 19:14:37', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'Role Management', 'gibran19', '10.12.12.62', '2020-06-04 11:36:14', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'Summary APH Transaction Daily ALL', 'gibran19', '10.12.12.62', '2020-06-04 18:02:47', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'Summary MO Daily', 'gibran19', '10.12.12.62', '2020-06-04 17:49:51', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'Summary MO Hourly', 'gibran19', '10.12.12.62', '2020-06-04 18:49:56', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'Summary MT Daily', 'gibran19', '10.12.12.62', '2020-06-04 19:00:44', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'Summary MT Hourly', 'gibran19', '10.12.12.62', '2020-06-04 19:14:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'Summary TPS Daily', 'gibran19', '10.12.12.62', '2020-06-09 12:20:39', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'Summary TPS Hourly', 'gibran19', '10.12.12.62', '2020-06-09 12:20:40', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'Template SMS', 'gibran19', '10.12.12.62', '2020-06-04 11:36:11', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Developer', 'User Management', 'gibran19', '10.12.12.62', '2020-06-04 11:36:10', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'Account API', 'gibran19', '10.12.12.62', '2020-06-03 15:34:17', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'APH Transaction Detail', 'gibran19', '10.12.12.62', '2020-06-05 10:56:24', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AphController', 'gibran19', '10.12.12.62', '2020-06-03 15:34:20', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AphController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:34:21', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AphController.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:34:22', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AphController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:34:22', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AphController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:34:27', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AphController.view', 'gibran19', '10.12.12.62', '2020-06-03 15:34:28', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthAssignmentController', 'gibran19', '10.12.12.62', '2020-06-03 15:34:29', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthAssignmentController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:34:29', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthAssignmentController.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:34:30', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthAssignmentController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:34:31', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthAssignmentController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:34:32', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthAssignmentController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:02:08', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem2Controller.create', 'gibran19', '10.12.12.62', '2020-06-03 15:34:34', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem2Controller.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:34:34', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem2Controller.index', 'gibran19', '10.12.12.62', '2020-06-03 15:34:35', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem2Controller.update', 'gibran19', '10.12.12.62', '2020-06-03 15:34:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem2Controller.view', 'gibran19', '10.12.12.62', '2020-06-03 15:34:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem3Controller', 'gibran19', '10.12.12.62', '2020-06-03 15:34:39', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem3Controller.create', 'gibran19', '10.12.12.62', '2020-06-03 15:34:48', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem3Controller.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:34:49', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem3Controller.index', 'gibran19', '10.12.12.62', '2020-06-03 15:34:50', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem3Controller.update', 'gibran19', '10.12.12.62', '2020-06-03 15:34:51', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem3Controller.view', 'gibran19', '10.12.12.62', '2020-06-03 15:34:52', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem5Controller', 'gibran19', '10.12.12.62', '2020-06-03 15:34:53', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem5Controller.create', 'gibran19', '10.12.12.62', '2020-06-03 15:34:54', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem5Controller.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:34:55', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem5Controller.index', 'gibran19', '10.12.12.62', '2020-06-03 15:34:58', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem5Controller.update', 'gibran19', '10.12.12.62', '2020-06-03 15:35:03', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItem5Controller.view', 'gibran19', '10.12.12.62', '2020-06-03 15:35:05', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItemChildController', 'gibran19', '10.12.12.62', '2020-06-03 15:35:05', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItemChildController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:35:05', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItemChildController.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:35:06', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItemChildController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:35:07', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItemChildController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:35:08', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItemChildController.view', 'gibran19', '10.12.12.62', '2020-06-03 15:35:11', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItemController', 'gibran19', '10.12.12.62', '2020-06-03 15:35:12', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItemController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:35:13', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItemController.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:35:14', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItemController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:35:18', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItemController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:35:20', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthItemController.view', 'gibran19', '10.12.12.62', '2020-06-03 15:35:21', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthLoginController', 'gibran19', '10.12.12.62', '2020-06-03 15:35:22', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthLoginController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:35:23', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthLoginController.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:35:24', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthLoginController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:35:28', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthLoginController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:35:29', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthLoginController.view', 'gibran19', '10.12.12.62', '2020-06-03 15:35:29', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthRuleController', 'gibran19', '10.12.12.62', '2020-06-03 15:35:30', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthRuleController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:35:35', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthRuleController.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:35:31', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthRuleController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:35:32', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthRuleController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:35:37', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\AuthRuleController.view', 'gibran19', '10.12.12.62', '2020-06-03 15:35:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\Controller', 'gibran19', '10.12.12.62', '2020-06-03 15:35:39', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\Controller.create', 'gibran19', '10.12.12.62', '2020-06-03 15:35:39', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\Controller.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:35:40', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\Controller.index', 'gibran19', '10.12.12.62', '2020-06-03 15:35:41', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\Controller.update', 'gibran19', '10.12.12.62', '2020-06-03 15:35:41', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\Controller.view', 'gibran19', '10.12.12.62', '2020-06-03 15:35:46', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\ErrCodeSmsController', 'gibran19', '10.12.12.62', '2020-06-05 10:58:25', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\ErrCodeSmsController.create', 'gibran19', '10.12.12.62', '2020-06-05 10:58:27', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\ErrCodeSmsController.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:58:28', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\ErrCodeSmsController.index', 'gibran19', '10.12.12.62', '2020-06-05 10:58:29', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\ErrCodeSmsController.update', 'gibran19', '10.12.12.62', '2020-06-05 10:58:30', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\ErrCodeSmsController.view', 'gibran19', '10.12.12.62', '2020-06-05 10:58:31', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\GHistoryLogController', 'gibran19', '10.12.12.62', '2020-06-03 15:35:51', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\GHistoryLogController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:35:54', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\GHistoryLogController.delete', 'gibran19', '10.12.12.62', '2020-06-03 15:35:58', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\GHistoryLogController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:35:58', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\GHistoryLogController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:35:59', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\GHistoryLogController.view', 'gibran19', '10.12.12.62', '2020-06-04 11:24:33', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\MdnWhitelistController', 'gibran19', '10.12.12.62', '2020-06-03 15:36:00', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\MdnWhitelistController.create', 'gibran19', '10.12.12.62', '2020-06-03 15:36:01', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\MdnWhitelistController.delete', 'gibran19', '10.12.12.62', '2020-06-04 11:24:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\MdnWhitelistController.index', 'gibran19', '10.12.12.62', '2020-06-03 15:36:02', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\MdnWhitelistController.update', 'gibran19', '10.12.12.62', '2020-06-03 15:36:02', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'app\\controllers\\MdnWhitelistController.view', 'gibran19', '10.12.12.62', '2020-06-03 15:36:04', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'Konfigurasi Whitelist MDN', 'gibran19', '10.12.12.62', '2020-06-04 11:24:58', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'Report Generator', 'gibran19', '10.12.12.62', '2020-06-04 11:24:58', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Daily.json.build', 'gibran19', '10.12.12.62', '2020-06-05 10:56:27', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Daily.json.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:56:04', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Daily.json.update', 'gibran19', '10.12.12.62', '2020-06-05 10:56:05', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Daily.json.view', 'gibran19', '10.12.12.62', '2020-06-05 10:56:06', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Detail.json.build', 'gibran19', '10.12.12.62', '2020-06-05 10:56:07', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Detail.json.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:56:08', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Detail.json.update', 'gibran19', '10.12.12.62', '2020-06-05 10:56:09', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.APH Transaction Detail.json.view', 'gibran19', '10.12.12.62', '2020-06-05 10:56:10', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Daily.json.build', 'gibran19', '10.12.12.62', '2020-06-05 10:56:14', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Daily.json.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:56:14', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Daily.json.update', 'gibran19', '10.12.12.62', '2020-06-05 10:56:23', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Daily.json.view', 'gibran19', '10.12.12.62', '2020-06-05 10:56:16', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Hourly.json.build', 'gibran19', '10.12.12.62', '2020-06-05 10:56:19', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Hourly.json.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:56:20', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Hourly.json.update', 'gibran19', '10.12.12.62', '2020-06-05 10:55:21', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MO Hourly.json.view', 'gibran19', '10.12.12.62', '2020-06-05 10:55:28', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Daily.json.build', 'gibran19', '10.12.12.62', '2020-06-05 10:55:32', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Daily.json.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:55:33', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Daily.json.update', 'gibran19', '10.12.12.62', '2020-06-05 10:55:34', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Daily.json.view', 'gibran19', '10.12.12.62', '2020-06-05 10:55:35', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Hourly.json.build', 'gibran19', '10.12.12.62', '2020-06-05 10:55:37', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Hourly.json.delete', 'gibran19', '10.12.12.62', '2020-06-05 10:55:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Hourly.json.update', 'gibran19', '10.12.12.62', '2020-06-05 10:55:40', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'ReportGeneratorController.Summary MT Hourly.json.view', 'gibran19', '10.12.12.62', '2020-06-05 10:55:41', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'Summary APH Transaction Daily ALL', 'gibran19', '10.12.12.62', '2020-06-05 10:56:03', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'Summary MO Daily', 'gibran19', '10.12.12.62', '2020-06-05 10:56:13', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'Summary MO Hourly', 'gibran19', '10.12.12.62', '2020-06-05 10:56:18', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'Summary MT Daily', 'gibran19', '10.12.12.62', '2020-06-05 10:55:30', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'Summary MT Hourly', 'gibran19', '10.12.12.62', '2020-06-05 10:55:36', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'Summary TPS Daily', 'gibran19', '10.12.12.62', '2020-06-09 12:21:02', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'Summary TPS Hourly', 'gibran19', '10.12.12.62', '2020-06-09 12:21:04', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'Template SMS', 'gibran19', '10.12.12.62', '2020-06-04 11:24:43', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('Super admin', 'User Management', 'gibran19', '10.12.12.62', '2020-06-04 11:24:41', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('View only', 'Account API', 'gibran19', '10.12.12.62', '2020-06-03 12:32:03', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('View only', 'APH Transaction Detail', 'gibran19', '10.12.12.62', '2020-06-08 16:12:40', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('View only', 'app\\controllers\\AphController.index', 'gibran19', '10.12.12.62', '2020-06-03 12:31:57', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('View only', 'app\\controllers\\AphController.view', 'gibran19', '10.12.12.62', '2020-06-03 12:32:00', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('View only', 'app\\controllers\\ErrCodeSmsController.index', 'gibran19', '10.12.12.62', '2020-06-08 16:13:04', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('View only', 'app\\controllers\\MdnWhitelistController.index', 'gibran19', '10.12.12.62', '2020-06-03 12:32:51', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('View only', 'app\\controllers\\MdnWhitelistController.view', 'gibran19', '10.12.12.62', '2020-06-08 16:13:21', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('View only', 'Dashboard', 'gibran19', '10.12.12.62', '2020-06-08 16:13:23', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('View only', 'Konfigurasi Whitelist MDN', 'gibran19', '10.12.12.62', '2020-06-03 12:32:59', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('View only', 'Summary APH Transaction Daily ALL', 'gibran19', '10.12.12.62', '2020-06-08 16:12:38', NULL, NULL, NULL);
INSERT INTO `auth_item_child_backup` VALUES ('View only', 'Template SMS', 'gibran19', '10.12.12.62', '2020-06-03 12:33:36', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for auth_login
-- ----------------------------
DROP TABLE IF EXISTS `auth_login`;
CREATE TABLE `auth_login`  (
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tl_username` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tl_password` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tl_authKey` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tl_accessToken` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_update` datetime(0) NULL DEFAULT NULL,
  `last_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_update` datetime(0) NULL DEFAULT NULL,
  `tl_user_status_ref` int(11) NULL DEFAULT NULL,
  `tl_email` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tl_phone_number` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tl_address` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tl_city` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tl_country` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tl_retry_count` int(11) NULL DEFAULT NULL,
  `tl_max_retry` int(11) NULL DEFAULT NULL,
  `tl_password_expire` datetime(0) NULL DEFAULT NULL,
  `tl_account_expire` datetime(0) NULL DEFAULT NULL,
  `tl_change_password_duration` int(11) NULL DEFAULT NULL,
  `tl_imei` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tl_flag_imei` int(11) NULL DEFAULT NULL,
  `tl_notif_date` datetime(0) NULL DEFAULT NULL,
  `tl_token` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`, `tl_username`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_login
-- ----------------------------
INSERT INTO `auth_login` VALUES ('2XKMIMKlWGq_jz-sJZ7TVcOKDSv1D4zU', 'dodo', '$2y$13$I2l5mhnwvyptaS88ixH6helGxcGrnL2hojgTg5yQknl.AJCa40r/S', NULL, NULL, NULL, '182.253.168.57', '2020-03-19 14:58:57', 'dodo', '10.12.12.62', '2020-05-29 12:02:22', 0, 'hendro@icode.co.id', '082119000000', 'jekarta', 'jekarta', 'jekarta', -1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_login` VALUES ('83NFJg-QI6FQPVP425Pk0VB_aHP9Fy1j', 'viewonly', '$2y$13$BnGdT4NfOMyWhHEE04xttejfUzqcwiaEQbjbBidq8ZkxP.IxsqEee', NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-03 12:37:07', 'viewonly', '127.0.0.1', '2020-06-22 13:45:35', 0, '', '', '', '', '', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_login` VALUES ('dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', '$2y$13$uQaG4opzIf9fKcaceh4GjuF2Ms1lo7dtaTQmtfaVd9Rs4jLReP9Ta', NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-03 12:36:47', 'superadmin', '127.0.0.1', '2020-08-07 14:07:36', 0, '', '', '', '', '', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_login` VALUES ('fa15FphJoHy0xem6wt8ShMqhalQrHsmw', 'Priyo.widodo', '$2y$13$HLYH4HhBhMc9xXMd9WcdHOEBCN9YdvOfi3jpwpPbdY.5I1U139Qq.', NULL, NULL, 'superadmin', '127.0.0.1', '2020-08-05 16:09:51', 'Priyo.widodo', '10.9.252.192', '2020-08-07 19:28:28', 0, 'priyo.widodo@_smartfren.com', '08881851881', 'Jakarta', 'Jakarta', 'Indonesia', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_login` VALUES ('h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', '$2y$13$vN7d45Ox64zD.loyYxr6a./m/8nhGONAmiBrM6GIuBNXomYsgcKue', NULL, NULL, 'superadmin', '127.0.0.1', '2020-06-17 16:30:03', 'robbyview', '127.0.0.1', '2020-07-24 14:17:53', 0, 'robby.icode2@gmail.com', '081288990212', 'Jakarta', 'Jakarta', 'Jakarta', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_login` VALUES ('KKw0-EzprSh4U56cFTwnPn3kSZCPAHIt', 'gibran19s', '$2y$13$lfj8Yiuqc2fIPNdeslRiRu1.qcA/B3CLbXyWVKvIXEjudUx9e2C.S', NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-12 13:02:05', NULL, NULL, NULL, 0, 'hh@_._', '089282', 'hhh', 'hhh', 'hhh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_login` VALUES ('M2-csEWTY6oVzqsGC-4Pqy2I2gSrOlq6', 'adisuperadmin', '$2y$13$5X9k/TqKw25OzlXVQlPHqeJacw4vnYE5JBgO3eofkpBAh.OkQw3xq', NULL, NULL, 'superadmin', '127.0.0.1', '2020-06-16 10:56:26', 'adisuperadmin', '127.0.0.1', '2020-06-16 11:00:18', 0, 'adi.alfaarix@icode.id', '08444444', 'jakarta', 'jakarta', 'indonesia', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_login` VALUES ('mBSlF8QdeaVM4nfYjqKlzplNx0LmMNWy', 'priyoyes', '$2y$13$PBf3u2.b9ozdrEUaBOMYnuN.OfXCwU0D/mHZMSJHQxxUe8Te2fBSK', NULL, NULL, 'Priyo.widodo', '10.17.120.22', '2020-08-07 10:53:11', 'priyoyes', '10.17.120.22', '2020-08-10 11:55:28', 0, 'priyo.widodo@smartfren.com', '08881851881', 'NOC-OSS', 'JKT', 'INA', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_login` VALUES ('NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', '$2y$13$j4f4lXCb.tu3ByUgluzvNuN7u613MdmORmRrhWVZMKKHOp6f9LJHu', NULL, NULL, 'superadmin', '127.0.0.1', '2020-06-17 15:01:34', 'robbyadmin', '127.0.0.1', '2020-07-24 14:12:31', 0, 'robyicode@gmail.com', '081288990210', 'Jakarta', 'Jakarta', 'Jakarta', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_login` VALUES ('Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', '$2y$13$G8GoToNzxudU2jwZZODVGOB8fv6nak3jhF4E8fIYXcRZp5PlqSf0S', NULL, NULL, 'gibran19', '10.12.12.62', '2020-06-02 16:37:10', 'admin', '10.12.12.62', '2020-06-08 16:15:16', 0, '', '0892828282', '', '', '', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_login` VALUES ('Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', '$2y$13$lvqTTjdaaweXKeABBeevfOPcOO7P1tnJb4q1zVRHYJyeG/asSTqLW', NULL, NULL, 'dodo', '10.12.12.62', '2020-05-29 19:23:14', 'gibran19', '127.0.0.1', '2020-06-22 13:11:02', 0, 'gggg@_._', '08', 'Jl.kenangan', '', '', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_login` VALUES ('VmtMs4An4y74QXRS6xH_RdX6AgiaCjtB', 'adiadmin', '$2y$13$6LCh5XsptY449XgJ5bC79OZSXZ4Mr9FyJ3aX7P.jejOU7HpXceCte', NULL, NULL, 'superadmin', '127.0.0.1', '2020-06-16 10:57:28', 'adiadmin', '127.0.0.1', '2020-06-16 11:03:14', 0, 'adi@icode.id', '0811111', 'jkt', 'jkt', 'indonesia', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `auth_login` VALUES ('yibmYizxUEbXV5ZMDeL5QeaMQPtm-ASn', 'adiview', '$2y$13$2yNKeRqCoc4ccPbQyr6.BukE7uZE8rHppVa4re.NzVpMh9Ahf3Dqm', NULL, NULL, 'superadmin', '127.0.0.1', '2020-06-16 10:59:04', 'adiview', '127.0.0.1', '2020-06-19 16:25:51', 0, 'adi@icode.id', '6229988888', 'jkt', 'jkt', 'indonesia', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `data` blob NULL,
  `first_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_update` datetime(0) NULL DEFAULT NULL,
  `last_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_update` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for g_history_log
-- ----------------------------
DROP TABLE IF EXISTS `g_history_log`;
CREATE TABLE `g_history_log`  (
  `ghl_id` int(11) NOT NULL AUTO_INCREMENT,
  `ghl_userid` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ghl_username` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ghl_log` longblob NULL,
  `ghl_ip` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ghl_date` datetime(0) NULL DEFAULT NULL,
  `ghl_id_model` int(11) NULL DEFAULT NULL,
  `ghl_model` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ghl_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 267 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of g_history_log
-- ----------------------------
INSERT INTO `g_history_log` VALUES (121, 'YfgNVY5V4pGldKXYpr9gY7n-A4cWYdAY', 'budipratama', 0x55736572206275646970726174616D6120686173205B4C4F474F55545D, '10.12.12.62', '2020-05-29 13:16:34', NULL, NULL);
INSERT INTO `g_history_log` VALUES (122, 'YfgNVY5V4pGldKXYpr9gY7n-A4cWYdAY', 'budipratama', 0x55736572206275646970726174616D6120686173205B4C4F474F55545D, '10.12.12.62', '2020-05-29 13:25:00', NULL, NULL);
INSERT INTO `g_history_log` VALUES (123, '_-kDNIS0MTDB-QAROdA0p1mlEZL509gi', 'gibran', 0x557365722067696272616E20686173205B4C4F47494E5D, '10.12.12.62', '2020-05-29 17:18:34', NULL, NULL);
INSERT INTO `g_history_log` VALUES (124, '_-kDNIS0MTDB-QAROdA0p1mlEZL509gi', 'gibran', 0x557365722067696272616E20686173205B4C4F474F55545D, '10.12.12.62', '2020-05-29 17:21:48', NULL, NULL);
INSERT INTO `g_history_log` VALUES (125, '', '', 0x557365722020686173205B4C4F474F55545D, '10.12.12.62', '2020-05-29 17:34:21', NULL, NULL);
INSERT INTO `g_history_log` VALUES (126, '2XKMIMKlWGq_jz-sJZ7TVcOKDSv1D4zU', 'gibran', 0x557365722067696272616E20686173205B4C4F47494E5D, '10.12.12.62', '2020-05-29 17:39:17', NULL, NULL);
INSERT INTO `g_history_log` VALUES (127, '2XKMIMKlWGq_jz-sJZ7TVcOKDSv1D4zU', 'dodo', 0x5573657220646F646F20686173205B4C4F474F55545D, '10.12.12.62', '2020-05-29 17:42:54', NULL, NULL);
INSERT INTO `g_history_log` VALUES (128, '', '', 0x557365722020686173205B4C4F474F55545D, '10.12.12.62', '2020-05-29 19:16:10', NULL, NULL);
INSERT INTO `g_history_log` VALUES (129, '2XKMIMKlWGq_jz-sJZ7TVcOKDSv1D4zU', 'dodo', 0x5573657220646F646F20686173205B4C4F474F55545D, '10.12.12.62', '2020-05-29 19:19:54', NULL, NULL);
INSERT INTO `g_history_log` VALUES (130, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F47494E5D, '10.12.12.62', '2020-05-29 19:23:35', NULL, NULL);
INSERT INTO `g_history_log` VALUES (131, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F474F55545D, '10.12.12.62', '2020-06-02 09:37:33', NULL, NULL);
INSERT INTO `g_history_log` VALUES (132, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F47494E5D, '10.12.12.62', '2020-06-02 09:37:56', NULL, NULL);
INSERT INTO `g_history_log` VALUES (133, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F47494E5D, '10.12.12.62', '2020-06-02 10:20:06', NULL, NULL);
INSERT INTO `g_history_log` VALUES (134, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F474F55545D, '10.12.12.62', '2020-06-02 12:06:44', NULL, NULL);
INSERT INTO `g_history_log` VALUES (135, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F47494E5D, '10.12.12.62', '2020-06-02 12:27:48', NULL, NULL);
INSERT INTO `g_history_log` VALUES (136, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F474F55545D, '10.12.12.62', '2020-06-02 16:37:39', NULL, NULL);
INSERT INTO `g_history_log` VALUES (137, 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', 0x557365722061646D696E20686173205B4C4F47494E5D, '10.12.12.62', '2020-06-02 16:38:03', NULL, NULL);
INSERT INTO `g_history_log` VALUES (138, 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', 0x557365722061646D696E20686173205B4C4F474F55545D, '10.12.12.62', '2020-06-02 16:41:37', NULL, NULL);
INSERT INTO `g_history_log` VALUES (139, 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', 0x557365722061646D696E20686173205B4C4F47494E5D, '10.12.12.62', '2020-06-02 16:41:58', NULL, NULL);
INSERT INTO `g_history_log` VALUES (140, 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', 0x557365722061646D696E20686173205B4C4F474F55545D, '10.12.12.62', '2020-06-02 16:42:30', NULL, NULL);
INSERT INTO `g_history_log` VALUES (141, 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', 0x557365722061646D696E20686173205B4C4F47494E5D, '10.12.12.62', '2020-06-02 16:43:11', NULL, NULL);
INSERT INTO `g_history_log` VALUES (142, 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', 0x557365722061646D696E20686173205B4C4F47494E5D, '10.12.12.49', '2020-06-02 18:05:58', NULL, NULL);
INSERT INTO `g_history_log` VALUES (143, 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', 0x557365722061646D696E20686173205B4C4F474F55545D, '10.12.12.49', '2020-06-02 18:06:05', NULL, NULL);
INSERT INTO `g_history_log` VALUES (144, 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', 0x557365722061646D696E20686173205B4C4F47494E5D, '10.12.12.49', '2020-06-02 18:09:31', NULL, NULL);
INSERT INTO `g_history_log` VALUES (145, 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', 0x557365722061646D696E20686173205B4C4F474F55545D, '10.12.12.62', '2020-06-03 10:44:19', NULL, NULL);
INSERT INTO `g_history_log` VALUES (146, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F47494E5D, '10.12.12.62', '2020-06-03 10:47:21', NULL, NULL);
INSERT INTO `g_history_log` VALUES (147, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F474F55545D, '10.12.12.62', '2020-06-03 12:38:07', NULL, NULL);
INSERT INTO `g_history_log` VALUES (148, '83NFJg-QI6FQPVP425Pk0VB_aHP9Fy1j', 'viewonly', 0x5573657220766965776F6E6C7920686173205B4C4F47494E5D, '10.12.12.62', '2020-06-03 12:38:18', NULL, NULL);
INSERT INTO `g_history_log` VALUES (149, '83NFJg-QI6FQPVP425Pk0VB_aHP9Fy1j', 'viewonly', 0x5573657220766965776F6E6C7920686173205B4C4F474F55545D, '10.12.12.62', '2020-06-03 12:41:54', NULL, NULL);
INSERT INTO `g_history_log` VALUES (150, 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', 0x557365722061646D696E20686173205B4C4F474F55545D, '10.12.12.49', '2020-06-03 12:42:52', NULL, NULL);
INSERT INTO `g_history_log` VALUES (151, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '10.12.12.49', '2020-06-03 12:43:55', NULL, NULL);
INSERT INTO `g_history_log` VALUES (152, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F47494E5D, '10.12.12.62', '2020-06-03 12:46:13', NULL, NULL);
INSERT INTO `g_history_log` VALUES (153, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '10.12.12.49', '2020-06-03 16:37:10', NULL, NULL);
INSERT INTO `g_history_log` VALUES (154, 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', 0x557365722061646D696E20686173205B4C4F47494E5D, '10.12.12.62', '2020-06-03 17:04:43', NULL, NULL);
INSERT INTO `g_history_log` VALUES (155, 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', 0x557365722061646D696E20686173205B4C4F474F55545D, '10.12.12.62', '2020-06-04 13:47:32', NULL, NULL);
INSERT INTO `g_history_log` VALUES (156, 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', 0x557365722061646D696E20686173205B4C4F47494E5D, '10.12.12.62', '2020-06-04 13:47:41', NULL, NULL);
INSERT INTO `g_history_log` VALUES (157, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F47494E5D, '10.12.12.62', '2020-06-04 18:47:11', NULL, NULL);
INSERT INTO `g_history_log` VALUES (158, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '10.12.12.69', '2020-06-08 11:01:42', NULL, NULL);
INSERT INTO `g_history_log` VALUES (159, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '192.168.89.178', '2020-06-08 14:24:36', NULL, NULL);
INSERT INTO `g_history_log` VALUES (160, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F474F55545D, '10.12.12.62', '2020-06-08 16:15:05', NULL, NULL);
INSERT INTO `g_history_log` VALUES (161, 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', 0x557365722061646D696E20686173205B4C4F47494E5D, '10.12.12.62', '2020-06-08 16:15:16', NULL, NULL);
INSERT INTO `g_history_log` VALUES (162, 'Q3S8Zp19_3ZeK6o_VKFxKa5b1ZdVxS2H', 'admin', 0x557365722061646D696E20686173205B4C4F474F55545D, '10.12.12.62', '2020-06-08 16:15:51', NULL, NULL);
INSERT INTO `g_history_log` VALUES (163, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F47494E5D, '10.12.12.62', '2020-06-08 16:16:00', NULL, NULL);
INSERT INTO `g_history_log` VALUES (164, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F47494E5D, '10.12.12.62', '2020-06-10 15:37:21', NULL, NULL);
INSERT INTO `g_history_log` VALUES (165, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '10.12.12.68', '2020-06-11 14:49:29', NULL, NULL);
INSERT INTO `g_history_log` VALUES (166, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '10.12.12.64', '2020-06-11 17:30:19', NULL, NULL);
INSERT INTO `g_history_log` VALUES (167, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '10.12.12.64', '2020-06-11 17:31:54', NULL, NULL);
INSERT INTO `g_history_log` VALUES (168, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '10.12.12.68', '2020-06-12 10:28:46', NULL, NULL);
INSERT INTO `g_history_log` VALUES (169, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '10.12.12.68', '2020-06-12 10:31:42', NULL, NULL);
INSERT INTO `g_history_log` VALUES (170, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-15 13:33:31', NULL, NULL);
INSERT INTO `g_history_log` VALUES (171, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-15 15:08:17', NULL, NULL);
INSERT INTO `g_history_log` VALUES (172, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-15 15:08:49', NULL, NULL);
INSERT INTO `g_history_log` VALUES (173, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-16 10:59:56', NULL, NULL);
INSERT INTO `g_history_log` VALUES (174, 'M2-csEWTY6oVzqsGC-4Pqy2I2gSrOlq6', 'adisuperadmin', 0x5573657220616469737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-16 11:00:18', NULL, NULL);
INSERT INTO `g_history_log` VALUES (175, 'M2-csEWTY6oVzqsGC-4Pqy2I2gSrOlq6', 'adisuperadmin', 0x5573657220616469737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-16 11:00:37', NULL, NULL);
INSERT INTO `g_history_log` VALUES (176, 'VmtMs4An4y74QXRS6xH_RdX6AgiaCjtB', 'adiadmin', 0x557365722061646961646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-16 11:03:14', NULL, NULL);
INSERT INTO `g_history_log` VALUES (177, 'VmtMs4An4y74QXRS6xH_RdX6AgiaCjtB', 'adiadmin', 0x557365722061646961646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-16 11:04:13', NULL, NULL);
INSERT INTO `g_history_log` VALUES (178, 'yibmYizxUEbXV5ZMDeL5QeaMQPtm-ASn', 'adiview', 0x55736572206164697669657720686173205B4C4F47494E5D, '127.0.0.1', '2020-06-16 11:04:36', NULL, NULL);
INSERT INTO `g_history_log` VALUES (179, 'yibmYizxUEbXV5ZMDeL5QeaMQPtm-ASn', 'adiview', 0x55736572206164697669657720686173205B4C4F474F55545D, '127.0.0.1', '2020-06-16 11:05:45', NULL, NULL);
INSERT INTO `g_history_log` VALUES (180, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-16 16:15:03', NULL, NULL);
INSERT INTO `g_history_log` VALUES (181, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-16 17:13:49', NULL, NULL);
INSERT INTO `g_history_log` VALUES (182, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-16 17:15:46', NULL, NULL);
INSERT INTO `g_history_log` VALUES (183, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-16 17:23:08', NULL, NULL);
INSERT INTO `g_history_log` VALUES (184, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-16 17:25:21', NULL, NULL);
INSERT INTO `g_history_log` VALUES (185, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-16 17:28:23', NULL, NULL);
INSERT INTO `g_history_log` VALUES (186, 'TPrOTcI4EVcC4gEonixZDXsmFndXkN7T', 'robbysuperadmin', 0x5573657220726F626279737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-16 17:28:50', NULL, NULL);
INSERT INTO `g_history_log` VALUES (187, 'TPrOTcI4EVcC4gEonixZDXsmFndXkN7T', 'robbysuperadmin', 0x5573657220726F626279737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-16 17:38:09', NULL, NULL);
INSERT INTO `g_history_log` VALUES (188, 'TPrOTcI4EVcC4gEonixZDXsmFndXkN7T', 'robbysuperadmin', 0x5573657220726F626279737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-17 10:20:12', NULL, NULL);
INSERT INTO `g_history_log` VALUES (189, 'TPrOTcI4EVcC4gEonixZDXsmFndXkN7T', 'robbysuperadmin', 0x5573657220726F626279737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-17 13:12:10', NULL, NULL);
INSERT INTO `g_history_log` VALUES (190, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-17 13:12:34', NULL, NULL);
INSERT INTO `g_history_log` VALUES (191, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-17 15:02:00', NULL, NULL);
INSERT INTO `g_history_log` VALUES (192, 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', 0x5573657220726F62627961646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-17 15:02:28', NULL, NULL);
INSERT INTO `g_history_log` VALUES (193, 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', 0x5573657220726F62627961646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-17 16:21:39', NULL, NULL);
INSERT INTO `g_history_log` VALUES (194, 'TPrOTcI4EVcC4gEonixZDXsmFndXkN7T', 'robbysuperadmin', 0x5573657220726F626279737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-17 16:22:16', NULL, NULL);
INSERT INTO `g_history_log` VALUES (195, 'TPrOTcI4EVcC4gEonixZDXsmFndXkN7T', 'robbysuperadmin', 0x5573657220726F626279737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-17 16:22:39', NULL, NULL);
INSERT INTO `g_history_log` VALUES (196, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-17 16:23:08', NULL, NULL);
INSERT INTO `g_history_log` VALUES (197, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-17 16:23:51', NULL, NULL);
INSERT INTO `g_history_log` VALUES (198, 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', 0x5573657220726F62627961646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-17 16:25:48', NULL, NULL);
INSERT INTO `g_history_log` VALUES (199, 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', 0x5573657220726F62627961646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-17 16:28:24', NULL, NULL);
INSERT INTO `g_history_log` VALUES (200, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-17 16:28:49', NULL, NULL);
INSERT INTO `g_history_log` VALUES (201, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-17 16:30:15', NULL, NULL);
INSERT INTO `g_history_log` VALUES (202, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F47494E5D, '127.0.0.1', '2020-06-17 16:30:42', NULL, NULL);
INSERT INTO `g_history_log` VALUES (203, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F474F55545D, '127.0.0.1', '2020-06-17 16:33:31', NULL, NULL);
INSERT INTO `g_history_log` VALUES (204, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-17 16:33:53', NULL, NULL);
INSERT INTO `g_history_log` VALUES (205, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-17 16:43:15', NULL, NULL);
INSERT INTO `g_history_log` VALUES (206, 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', 0x5573657220726F62627961646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-17 16:43:53', NULL, NULL);
INSERT INTO `g_history_log` VALUES (207, 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', 0x5573657220726F62627961646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-18 13:47:11', NULL, NULL);
INSERT INTO `g_history_log` VALUES (208, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-18 13:47:31', NULL, NULL);
INSERT INTO `g_history_log` VALUES (209, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-18 13:48:43', NULL, NULL);
INSERT INTO `g_history_log` VALUES (210, 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', 0x5573657220726F62627961646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-18 13:49:07', NULL, NULL);
INSERT INTO `g_history_log` VALUES (211, 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', 0x5573657220726F62627961646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-18 13:49:25', NULL, NULL);
INSERT INTO `g_history_log` VALUES (212, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F47494E5D, '127.0.0.1', '2020-06-18 13:49:51', NULL, NULL);
INSERT INTO `g_history_log` VALUES (213, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F474F55545D, '127.0.0.1', '2020-06-18 15:08:20', NULL, NULL);
INSERT INTO `g_history_log` VALUES (214, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F47494E5D, '127.0.0.1', '2020-06-18 15:09:21', NULL, NULL);
INSERT INTO `g_history_log` VALUES (215, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F474F55545D, '127.0.0.1', '2020-06-18 15:20:35', NULL, NULL);
INSERT INTO `g_history_log` VALUES (216, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F47494E5D, '127.0.0.1', '2020-06-18 15:21:07', NULL, NULL);
INSERT INTO `g_history_log` VALUES (217, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F474F55545D, '127.0.0.1', '2020-06-18 15:51:17', NULL, NULL);
INSERT INTO `g_history_log` VALUES (218, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F47494E5D, '127.0.0.1', '2020-06-18 15:51:55', NULL, NULL);
INSERT INTO `g_history_log` VALUES (219, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F474F55545D, '127.0.0.1', '2020-06-18 15:56:00', NULL, NULL);
INSERT INTO `g_history_log` VALUES (220, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F47494E5D, '127.0.0.1', '2020-06-18 15:57:20', NULL, NULL);
INSERT INTO `g_history_log` VALUES (221, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F474F55545D, '127.0.0.1', '2020-06-18 16:03:31', NULL, NULL);
INSERT INTO `g_history_log` VALUES (222, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F47494E5D, '127.0.0.1', '2020-06-18 16:04:08', NULL, NULL);
INSERT INTO `g_history_log` VALUES (223, 'yibmYizxUEbXV5ZMDeL5QeaMQPtm-ASn', 'adiview', 0x55736572206164697669657720686173205B4C4F47494E5D, '127.0.0.1', '2020-06-19 16:25:51', NULL, NULL);
INSERT INTO `g_history_log` VALUES (224, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F474F55545D, '127.0.0.1', '2020-06-22 09:49:26', NULL, NULL);
INSERT INTO `g_history_log` VALUES (225, 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', 0x5573657220726F62627961646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-22 09:49:48', NULL, NULL);
INSERT INTO `g_history_log` VALUES (226, 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', 0x5573657220726F62627961646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-22 09:50:29', NULL, NULL);
INSERT INTO `g_history_log` VALUES (227, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-22 10:28:53', NULL, NULL);
INSERT INTO `g_history_log` VALUES (228, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-22 10:34:00', NULL, NULL);
INSERT INTO `g_history_log` VALUES (229, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-22 12:36:39', NULL, NULL);
INSERT INTO `g_history_log` VALUES (230, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F47494E5D, '127.0.0.1', '2020-06-22 13:11:02', NULL, NULL);
INSERT INTO `g_history_log` VALUES (231, 'Qkx9U2vW75FRyvVsx9D3QpdCR05-QAkF', 'gibran19', 0x557365722067696272616E313920686173205B4C4F474F55545D, '127.0.0.1', '2020-06-22 13:45:12', NULL, NULL);
INSERT INTO `g_history_log` VALUES (232, '83NFJg-QI6FQPVP425Pk0VB_aHP9Fy1j', 'viewonly', 0x5573657220766965776F6E6C7920686173205B4C4F47494E5D, '127.0.0.1', '2020-06-22 13:45:35', NULL, NULL);
INSERT INTO `g_history_log` VALUES (233, 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', 0x5573657220726F62627961646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-23 14:25:31', NULL, NULL);
INSERT INTO `g_history_log` VALUES (234, 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', 0x5573657220726F62627961646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-23 14:33:11', NULL, NULL);
INSERT INTO `g_history_log` VALUES (235, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-24 18:38:48', NULL, NULL);
INSERT INTO `g_history_log` VALUES (236, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-25 10:01:00', NULL, NULL);
INSERT INTO `g_history_log` VALUES (237, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-26 09:28:11', NULL, NULL);
INSERT INTO `g_history_log` VALUES (238, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-26 09:32:58', NULL, NULL);
INSERT INTO `g_history_log` VALUES (239, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-06-29 17:06:01', NULL, NULL);
INSERT INTO `g_history_log` VALUES (240, 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', 0x5573657220726F62627961646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-06-29 17:06:16', NULL, NULL);
INSERT INTO `g_history_log` VALUES (241, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-07-14 18:35:40', NULL, NULL);
INSERT INTO `g_history_log` VALUES (242, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-07-14 18:36:39', NULL, NULL);
INSERT INTO `g_history_log` VALUES (243, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-07-15 15:30:09', NULL, NULL);
INSERT INTO `g_history_log` VALUES (244, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-07-15 16:34:25', NULL, NULL);
INSERT INTO `g_history_log` VALUES (245, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-07-15 16:37:54', NULL, NULL);
INSERT INTO `g_history_log` VALUES (246, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-07-24 14:11:46', NULL, NULL);
INSERT INTO `g_history_log` VALUES (247, 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', 0x5573657220726F62627961646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-07-24 14:12:31', NULL, NULL);
INSERT INTO `g_history_log` VALUES (248, 'NlqUbiZg_6zqATpYOoNKUUlQFhoMC4is', 'robbyadmin', 0x5573657220726F62627961646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-07-24 14:17:30', NULL, NULL);
INSERT INTO `g_history_log` VALUES (249, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F47494E5D, '127.0.0.1', '2020-07-24 14:17:53', NULL, NULL);
INSERT INTO `g_history_log` VALUES (250, 'h8Bpfk16r-FLR6SfTtZ-hZ1zHYvqmoPO', 'robbyview', 0x5573657220726F6262797669657720686173205B4C4F474F55545D, '127.0.0.1', '2020-07-24 14:45:08', NULL, NULL);
INSERT INTO `g_history_log` VALUES (251, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-07-24 16:07:42', NULL, NULL);
INSERT INTO `g_history_log` VALUES (252, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-07-27 15:31:27', NULL, NULL);
INSERT INTO `g_history_log` VALUES (253, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-08-05 13:56:24', NULL, NULL);
INSERT INTO `g_history_log` VALUES (254, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-08-05 13:56:56', NULL, NULL);
INSERT INTO `g_history_log` VALUES (255, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-08-05 14:26:46', NULL, NULL);
INSERT INTO `g_history_log` VALUES (256, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-08-05 16:36:04', NULL, NULL);
INSERT INTO `g_history_log` VALUES (257, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-08-06 15:04:39', NULL, NULL);
INSERT INTO `g_history_log` VALUES (258, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F474F55545D, '127.0.0.1', '2020-08-06 15:06:10', NULL, NULL);
INSERT INTO `g_history_log` VALUES (259, 'fa15FphJoHy0xem6wt8ShMqhalQrHsmw', 'Priyo.widodo', 0x5573657220507269796F2E7769646F646F20686173205B4C4F47494E5D, '127.0.0.1', '2020-08-06 15:06:29', NULL, NULL);
INSERT INTO `g_history_log` VALUES (260, 'fa15FphJoHy0xem6wt8ShMqhalQrHsmw', 'Priyo.widodo', 0x5573657220507269796F2E7769646F646F20686173205B4C4F474F55545D, '127.0.0.1', '2020-08-06 15:06:33', NULL, NULL);
INSERT INTO `g_history_log` VALUES (261, 'fa15FphJoHy0xem6wt8ShMqhalQrHsmw', 'Priyo.widodo', 0x5573657220507269796F2E7769646F646F20686173205B4C4F47494E5D, '10.17.120.22', '2020-08-07 10:50:00', NULL, NULL);
INSERT INTO `g_history_log` VALUES (262, 'fa15FphJoHy0xem6wt8ShMqhalQrHsmw', 'Priyo.widodo', 0x5573657220507269796F2E7769646F646F20686173205B4C4F474F55545D, '10.17.120.22', '2020-08-07 10:53:41', NULL, NULL);
INSERT INTO `g_history_log` VALUES (263, 'mBSlF8QdeaVM4nfYjqKlzplNx0LmMNWy', 'priyoyes', 0x5573657220707269796F79657320686173205B4C4F47494E5D, '10.17.120.22', '2020-08-07 10:54:01', NULL, NULL);
INSERT INTO `g_history_log` VALUES (264, 'dcurl2r04olM-ay3CcZhDks6EkpZ5foT', 'superadmin', 0x5573657220737570657261646D696E20686173205B4C4F47494E5D, '127.0.0.1', '2020-08-07 14:07:36', NULL, NULL);
INSERT INTO `g_history_log` VALUES (265, 'mBSlF8QdeaVM4nfYjqKlzplNx0LmMNWy', 'priyoyes', 0x5573657220707269796F79657320686173205B4C4F474F55545D, '10.17.120.22', '2020-08-10 11:54:47', NULL, NULL);
INSERT INTO `g_history_log` VALUES (266, 'mBSlF8QdeaVM4nfYjqKlzplNx0LmMNWy', 'priyoyes', 0x5573657220707269796F79657320686173205B4C4F47494E5D, '10.17.120.22', '2020-08-10 11:55:28', NULL, NULL);

-- ----------------------------
-- Table structure for tbl_aph
-- ----------------------------
DROP TABLE IF EXISTS `tbl_aph`;
CREATE TABLE `tbl_aph`  (
  `ta_id` int(11) NOT NULL AUTO_INCREMENT,
  `ta_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ta_desc` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ta_api_username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ta_api_password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `first_user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `first_ip` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `first_update` datetime(0) NULL DEFAULT NULL,
  `last_user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `last_ip` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `last_update` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`ta_id`) USING BTREE,
  INDEX `ta_name`(`ta_name`) USING BTREE,
  INDEX `ta_api_username`(`ta_api_username`) USING BTREE,
  INDEX `ta_api_password`(`ta_api_password`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_aph
-- ----------------------------
INSERT INTO `tbl_aph` VALUES (1, 'Test', 'Test', 'Test', 'Test', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_aph` VALUES (2, 'Gibran test', 'Gibran lagi ngetest', 'gibran19', 'icode1234', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_aph` VALUES (6, 'testing', 'testing', 'sfuser', 'sfpass', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_aph` VALUES (7, 'test2', 'test2', 'sfuser', 'sfpass', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_aph` VALUES (9, 'tester3', 'tester3', 'usertester', 'passtester', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tbl_aph_transaction_history
-- ----------------------------
DROP TABLE IF EXISTS `tbl_aph_transaction_history`;
CREATE TABLE `tbl_aph_transaction_history`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_datetime` datetime(0) NOT NULL,
  `mdn` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `shortcode` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `content` blob NOT NULL,
  `direction` int(2) NOT NULL COMMENT '0 mo, 1 mt',
  `status` int(2) NOT NULL COMMENT '0 failed, 1 success',
  `error_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `msg_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `api_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `aph_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `msg_id`(`msg_id`, `direction`) USING BTREE,
  INDEX `event_datetime`(`event_datetime`) USING BTREE,
  INDEX `mdn`(`mdn`) USING BTREE,
  INDEX `shortcode`(`shortcode`) USING BTREE,
  INDEX `direction`(`direction`) USING BTREE,
  INDEX `status`(`status`) USING BTREE,
  INDEX `msg_id2`(`msg_id`) USING BTREE,
  INDEX `api_id`(`api_id`) USING BTREE,
  INDEX `aph_id`(`aph_id`) USING BTREE,
  CONSTRAINT `aph_id` FOREIGN KEY (`aph_id`) REFERENCES `tbl_aph` (`ta_id`) ON DELETE RESTRICT ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 867 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_aph_transaction_history
-- ----------------------------
INSERT INTO `tbl_aph_transaction_history` VALUES (3, '2020-06-03 16:32:20', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 0, 'ERR_INTERNAL_PARAM', '5ed76e24231f49', '', 1);
INSERT INTO `tbl_aph_transaction_history` VALUES (5, '2020-06-03 16:37:31', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 0, 'ERR_INTERNAL_PARAM', '5ed76f5ae0d647', '', 2);
INSERT INTO `tbl_aph_transaction_history` VALUES (7, '2020-06-03 16:54:23', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 0, 'ERR_INTERNAL_PARAM', '5ed7734f934011', '', 2);
INSERT INTO `tbl_aph_transaction_history` VALUES (8, '2020-06-03 16:54:23', '6285921271243', '77100', 0x63705F363238383131363430353530, 1, 0, 'ERR_INTERNAL_PARAM', '5ed7734f934011', '', 2);
INSERT INTO `tbl_aph_transaction_history` VALUES (9, '2020-06-03 17:57:16', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 0, '1000', '5ed7820c1e0892', NULL, NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (10, '2020-06-03 17:57:16', '6285921271243', '77100', 0x63705F363238383131363430353530, 1, 0, '1000', '5ed7820c1e0892', NULL, NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (11, '2020-06-03 17:58:52', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed7826a967da1', '2764674924223688', 2);
INSERT INTO `tbl_aph_transaction_history` VALUES (12, '2020-06-03 17:58:52', '6285921271243', '77100', 0x63705F363238383131363430353530, 1, 1, '0', '5ed7826a967da1', '2764674924223688', 2);
INSERT INTO `tbl_aph_transaction_history` VALUES (13, '2020-06-03 18:08:57', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed784c840b4c0', '2765280070657514', 2);
INSERT INTO `tbl_aph_transaction_history` VALUES (14, '2020-06-03 18:08:57', '6285921271243', '77100', 0x63705F363238383131363430353530, 1, 1, '0', '5ed784c840b4c0', '2765280070657514', 2);
INSERT INTO `tbl_aph_transaction_history` VALUES (15, '2020-06-03 18:10:11', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed78512d61e24', '2765354129085603', 2);
INSERT INTO `tbl_aph_transaction_history` VALUES (16, '2020-06-03 18:10:11', '6285921271243', '77100', 0x63705F363238383131363430353530, 1, 1, '0', '5ed78512d61e24', '2765354129085603', 2);
INSERT INTO `tbl_aph_transaction_history` VALUES (17, '2020-06-03 18:14:02', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed785fa030216', '2765585047731629', 2);
INSERT INTO `tbl_aph_transaction_history` VALUES (18, '2020-06-03 18:14:02', '6285921271243', '77100', 0x63705F363238383131363430353530, 1, 1, '0', '5ed785fa030216', '2765585047731629', 2);
INSERT INTO `tbl_aph_transaction_history` VALUES (19, '2020-06-04 11:15:39', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 0, '1000', '5ed8756bb63f88', NULL, NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (20, '2020-06-04 11:15:40', '6285921271243', '77100', 0x63705F363238383131363430353530, 1, 0, '1000', '5ed8756bb63f88', NULL, NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (21, '2020-06-04 11:22:38', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 0, '1000', '5ed8770ec777c7', NULL, NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (22, '2020-06-04 11:22:39', '6285921271243', '77100', 0x63705F363238383131363430353530, 1, 0, '1000', '5ed8770ec777c7', NULL, NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (23, '2020-06-04 11:24:05', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed87765344090', '2827388267927038', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (24, '2020-06-04 11:24:05', '6285921271243', '77100', 0x63705F363238383131363430353530, 1, 1, '0', '5ed87765344090', '2827388267927038', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (25, '2020-06-04 11:42:23', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed87bafbae634', '2828486809934819', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (26, '2020-06-04 11:42:24', '6285921271243', '77100', 0x63705F363238383131363430353530, 1, 1, '0', '5ed87bafbae634', '2828486809934819', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (27, '2020-06-04 11:45:36', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed87c6f2b0fe8', '2828678183387980', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (28, '2020-06-04 11:45:36', '6285921271243', '77100', 0x63705F363238383131363430353530, 1, 1, '0', '5ed87c6f2b0fe8', '2828678183387980', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (29, '2020-06-04 11:48:27', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed87d1b7bfce1', '2828850517670646', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (30, '2020-06-04 11:48:27', '6285921271243', '77100', 0x63705F363238383131363430353530, 1, 1, '0', '5ed87d1b7bfce1', '2828850517670646', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (31, '2020-06-04 11:50:13', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed87d84e3eb43', '2828955942288150', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (32, '2020-06-04 11:50:13', '6285921271243', '77100', 0x63705F363238383131363430353530, 1, 1, '0', '5ed87d84e3eb43', '2828955942288150', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (33, '2020-06-04 12:15:05', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed88359691480', '2830448418503660', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (34, '2020-06-04 12:15:05', '6285921271243', '77100', 0x63705F363238383131363430353530, 1, 1, '0', '5ed88359691480', '2830448418503660', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (35, '2020-06-04 12:25:08', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed885b3d34049', '2831050874952063', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (36, '2020-06-04 12:25:08', '6285921271243', '77100', 0x63705F363238383131363430353530, 1, 1, '0', '5ed885b3d34049', '2831050874952063', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (37, '2020-06-04 15:18:22', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 0, '1000', '5ed8ae4ecb5ad1', NULL, NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (38, '2020-06-04 15:18:23', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E202831303030290D0A, 1, 0, '1000', '5ed8ae4ecb5ad1', NULL, NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (39, '2020-06-04 15:20:00', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed8aeb0303728', '2841543293971400', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (40, '2020-06-04 15:37:39', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed8b2d2b8c236', '2842601889309507', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (41, '2020-06-04 15:37:39', '6285921271243', '77100', 0x4C4154544954554445203A207B7B6C61747D7D2023243041204C4F4E4749545544453A207B7B6C6F6E677D7D2023243041204D534953444E203A207B7B6D646E5F747261636B696E677D7D20232430412054494D452044415445203A207B7B6461746574696D657D7D2023243041204C4F434154494F4E20494E464F203A207B7B6C6F636174696F6E7D7D20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D7B7B706172616D657465727D7D, 1, 1, '0', '5ed8b2d2b8c236', '2842601889309507', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (42, '2020-06-04 18:00:03', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed8d432c18f83', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (43, '2020-06-04 18:00:03', '6285921271243', '77100', 0x4C4154544954554445203A2034313730333422313727323022532023243041204C4F4E4749545544453A20343132373336223527333622452023243041204D534953444E203A2036323838313136343035353020232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A6274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D31323334373439392C31323633383438393439, 1, 1, '0', '5ed8d432c18f83', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (44, '2020-06-04 18:17:58', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed8d8663efba1', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (45, '2020-06-04 18:17:58', '6285921271243', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A2036323838313136343035353020232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A6274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5ed8d8663efba1', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (46, '2020-06-04 18:17:59', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed8d86795ee87', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (47, '2020-06-04 18:17:59', '6285921271243', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A2036323838313136343035353020232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A6274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5ed8d86795ee87', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (48, '2020-06-04 18:21:21', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed8d931dbeff6', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (49, '2020-06-04 18:21:22', '6285921271243', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A2036323838313136343035353020232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A6274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5ed8d931dbeff6', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (50, '2020-06-04 18:25:00', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 0, 'ERR_001', '5ed8da0c25ae12', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (51, '2020-06-04 18:25:00', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30303129, 1, 0, 'ERR_001', '5ed8da0c25ae12', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (52, '2020-06-04 18:30:38', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30303129, 1, 0, 'ERR_001', '5ed8db5ea61724', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (53, '2020-06-04 18:32:32', '6285921271243', '77100', 0x63705F36323838313136343035353021402324255E262A28295F2B7B7D7C5D5B3A222F2E2667743B3F, 0, 0, 'ERR_001', '5ed8dbd0d10b73', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (54, '2020-06-04 18:32:33', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30303129, 1, 0, 'ERR_001', '5ed8dbd0d10b73', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (55, '2020-06-04 18:42:39', '6285921271243', '77100', 0x63705F36323838313136343035353021402324255E262A28295F2B7B7D7C5D5B3A222F2E2667743B3F, 0, 0, 'ERR_001', '5ed8de2f8ae448', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (56, '2020-06-04 18:42:40', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30303129, 1, 0, 'ERR_001', '5ed8de2f8ae448', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (57, '2020-06-04 18:43:04', '6285921271243', '77100', 0x63705F3632383831313634303535302722, 0, 0, 'ERR_001', '5ed8de47ee1b27', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (58, '2020-06-04 18:43:04', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30303129, 1, 0, 'ERR_001', '5ed8de47ee1b27', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (59, '2020-06-04 18:43:44', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_001', '5ed8de70a97323', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (60, '2020-06-04 18:43:45', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30303129, 1, 0, 'ERR_001', '5ed8de70a97323', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (61, '2020-06-04 19:37:35', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_001', '5ed8eb0f8d43d4', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (62, '2020-06-04 19:37:35', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30303129, 1, 0, 'ERR_001', '5ed8eb0f8d43d4', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (63, '2020-06-04 22:43:16', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_001', '5ed916940c0f68', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (64, '2020-06-04 22:43:16', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30303129, 1, 0, 'ERR_001', '5ed916940c0f68', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (65, '2020-06-04 22:43:40', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ed916ac761c36', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (66, '2020-06-04 22:43:40', '6285921271243', '77100', 0x74657374207175657279, 1, 1, '0', '5ed916ac761c36', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (67, '2020-06-05 01:23:59', '6285921271243', '77100', 0x63705F363238383131363430353530, 0, 1, '0', '5ed93c3fd64d84', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (68, '2020-06-05 01:24:00', '6285921271243', '77100', 0x74657374207175657279, 1, 1, '0', '5ed93c3fd64d84', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (69, '2020-06-05 11:38:39', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ed9cc4f4993a5', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (70, '2020-06-05 11:38:39', '6285921271243', '77100', 0x74657374207175657279, 1, 1, '0', '5ed9cc4f4993a5', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (71, '2020-06-05 11:40:21', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ed9ccb51731e4', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (72, '2020-06-05 11:40:21', '6285921271243', '77100', 0x74657374207175657279, 1, 1, '0', '5ed9ccb51731e4', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (73, '2020-06-05 11:40:22', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ed9ccb6536df6', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (74, '2020-06-05 11:40:22', '6285921271243', '77100', 0x74657374207175657279, 1, 1, '0', '5ed9ccb6536df6', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (75, '2020-06-05 14:44:51', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ed9f7f346a2a7', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (76, '2020-06-05 14:44:51', '6285921271243', '77100', 0x74657374207175657279, 1, 1, '0', '', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (77, '2020-06-05 14:46:28', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ed9f8543cf5f1', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (79, '2020-06-05 14:50:09', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ed9f931a45987', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (81, '2020-06-05 15:05:57', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ed9fce4eec601', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (82, '2020-06-05 15:05:57', '6285921271243', '77100', 0x74657374207175657279, 1, 1, '0', '5ed9fce4eec601_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (83, '2020-06-05 15:07:08', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ed9fd2c967d68', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (84, '2020-06-05 15:07:08', '628592222222', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A203632383831313634303535302720232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A6274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5ed9fd2c967d68_mt', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (85, '2020-06-05 15:17:10', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ed9ff86dad024', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (86, '2020-06-05 15:17:11', '6285921271243', '77100', 0x74657374207175657279, 1, 1, '0', '5ed9ff86dad024_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (87, '2020-06-05 15:18:45', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ed9ffe5df7d75', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (88, '2020-06-05 15:18:46', '628592222222', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A203632383831313634303535302720232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A6274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5ed9ffe5df7d75_mt', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (89, '2020-06-05 15:22:27', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5eda00c32e49e5', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (90, '2020-06-05 15:22:27', '628592222222', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A203632383831313634303535302720232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A6274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5eda00c32e49e5_mt', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (91, '2020-06-05 15:22:56', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5eda00e09f2976', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (92, '2020-06-05 15:22:56', '628592222222', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A203632383831313634303535302720232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A6274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5eda00e09f2976_mt', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (93, '2020-06-05 15:26:43', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5eda01c3e65c10', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (94, '2020-06-05 15:26:44', '628592222222', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A203632383831313634303535302720232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A6274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5eda01c3e65c10_mt', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (95, '2020-06-05 15:28:47', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5eda023f305574', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (96, '2020-06-05 15:28:47', '628592222222', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A203632383831313634303535302720232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A6274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5eda023f305574_mt', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (97, '2020-06-05 15:59:31', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5eda0973c90d11', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (98, '2020-06-05 15:59:32', '628592222222', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A203632383831313634303535302720232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A6274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5eda0973c90d11_mt', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (99, '2020-06-05 23:20:18', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5eda70c2d3a1e4', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (100, '2020-06-05 23:20:19', '628592222222', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A203632383831313634303535302720232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A6274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5eda70c2d3a1e4_mt', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (101, '2020-06-08 17:53:13', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ede18993ea0f9', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (102, '2020-06-08 17:53:13', '628592222222', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A203632383831313634303535302720232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A206274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5ede18993ea0f9_mt', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (103, '2020-06-08 17:56:12', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ede194c31e5b9', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (104, '2020-06-08 17:56:12', '6285921271243', '77100', 0x74657374207175657279, 1, 1, '0', '5ede194c31e5b9_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (105, '2020-06-08 17:56:52', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ede1974cb1896', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (106, '2020-06-08 17:56:53', '6285921271243', '77100', 0x746573742071756572792036323838313136343035353027, 1, 1, '0', '5ede1974cb1896_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (107, '2020-06-08 17:57:56', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ede19b434c471', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (108, '2020-06-08 17:57:56', '6285921271243', '77100', 0x74657374207175657279203632383831313634303535302720696D73692079616E6720646920747261636B203D207B7B696D73695F747261636B696E677D7D20696D65692079616E6720646920747261636B203D207B7B696D65695F747261636B696E677D7D, 1, 1, '0', '5ede19b434c471_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (109, '2020-06-08 18:08:02', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ede1c11a80708', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (110, '2020-06-08 18:08:02', '6285921271243', '77100', 0x6D736973646E2079616E6720646920747261636B203D203632383831313634303535302720696D73692079616E6720646920747261636B203D2035313030393838313131323035303820696D65692079616E6720646920747261636B203D202064657669636520696E666F203D2020737461747573203D2064656174746163686564206E6574776F726B203D2034472063656C6C20696E666F203D203131206C61746974756465203D20362232372732322253206C6F6E676974756465203D203130362235382733392245, 1, 1, '0', '5ede1c11a80708_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (111, '2020-06-08 18:16:41', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ede1e1994e960', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (112, '2020-06-08 18:16:41', '6285921271243', '77100', 0x617A696D757468203D20206C61737420757064617465203D20323032302D30352D32302032313A32363A3039206C6F636174696F6E20696E666F203D206274735F69636F646520747261636B696E672074696D65203D20323032302D30352D32302032313A32363A30392065636769203D20353130303931353133303231353520656E626964203D20353931303234206F70657261746F72203D20496E646F6E6573696120505420536D6172746672656E2054656C65636F6D2054626B0D0A20706172616D65746572206C6F6E676C617420676F6F676C65203D202D362E3435363034302C3130362E393737333739, 1, 1, '0', '5ede1e1994e960_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (113, '2020-06-08 18:19:06', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ede1eaa03fdc0', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (114, '2020-06-08 18:19:06', '6285921271243', '77100', 0x6C61746974756465206F726967696E616C203D202D362E343536303430206C6F6E676974756465206F726967696E616C203D203130362E393737333739, 1, 1, '0', '5ede1eaa03fdc0_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (115, '2020-06-08 18:19:06', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ede1eaa9524e7', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (116, '2020-06-08 18:19:06', '628592222222', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A203632383831313634303535302720232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A206274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5ede1eaa9524e7_mt', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (117, '2020-06-08 18:19:53', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ede1ed9712789', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (118, '2020-06-08 18:19:53', '6285921271243', '77100', 0x6C61746974756465206F726967696E616C203D202D362E343536303430206C6F6E676974756465206F726967696E616C203D203130362E393737333739, 1, 1, '0', '5ede1ed9712789_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (119, '2020-06-09 03:30:49', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ede9ff9de6643', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (120, '2020-06-09 03:30:50', '6285921271243', '77100', 0x6C61746974756465206F726967696E616C203D202D362E343536303430206C6F6E676974756465206F726967696E616C203D203130362E393737333739, 1, 1, '0', '5ede9ff9de6643_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (121, '2020-06-09 13:12:47', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5edf285edf7c64', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (122, '2020-06-09 13:12:48', '6285921271243', '77100', 0x6C61746974756465206F726967696E616C203D202D362E343536303430206C6F6E676974756465206F726967696E616C203D203130362E393737333739, 1, 1, '0', '5edf285edf7c64_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (123, '2020-06-09 13:14:23', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5edf28bef24dd0', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (124, '2020-06-09 13:14:23', '6285921271243', '77100', 0x6C61746974756465206F726967696E616C203D202D362E343536303430206C6F6E676974756465206F726967696E616C203D203130362E393737333739, 1, 1, '0', '5edf28bef24dd0_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (125, '2020-06-09 13:14:25', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5edf28c15367b3', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (126, '2020-06-09 13:14:25', '6285921271243', '77100', 0x6C61746974756465206F726967696E616C203D202D362E343536303430206C6F6E676974756465206F726967696E616C203D203130362E393737333739, 1, 1, '0', '5edf28c15367b3_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (127, '2020-06-09 13:14:48', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5edf28d8abb500', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (128, '2020-06-09 13:14:48', '6285921271243', '77100', 0x6C61746974756465206F726967696E616C203D202D362E343536303430206C6F6E676974756465206F726967696E616C203D203130362E393737333739, 1, 1, '0', '5edf28d8abb500_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (129, '2020-06-09 13:15:40', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5edf290c148bc0', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (130, '2020-06-09 13:15:40', '6285921271243', '77100', 0x6C61746974756465206F726967696E616C203D202D362E343536303430206C6F6E676974756465206F726967696E616C203D203130362E393737333739, 1, 1, '0', '5edf290c148bc0_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (131, '2020-06-09 14:06:33', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_001', '5edf34f900ccb0', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (132, '2020-06-09 14:06:33', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30303129, 1, 0, 'ERR_001', '5edf34f900ccb0_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (133, '2020-06-09 14:17:14', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_00199', '5edf377a7c4d37', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (134, '2020-06-09 14:17:14', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, 'ERR_00199', '5edf377a7c4d37_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (135, '2020-06-09 15:57:27', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_00199', '5edf4ef6f3b755', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (136, '2020-06-09 15:57:27', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, 'ERR_00199', '5edf4ef6f3b755_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (137, '2020-06-11 15:58:19', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_00199', '5ee1f2299c3072', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (138, '2020-06-11 15:58:19', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, 'ERR_00199', '5ee1f2299c3072_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (139, '2020-06-11 16:02:50', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_00199', '5ee1f33a135977', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (140, '2020-06-11 16:02:50', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, 'ERR_00199', '5ee1f33a135977_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (141, '2020-06-11 16:03:11', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_00199', '5ee1f34ea3ec31', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (142, '2020-06-11 16:03:12', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, 'ERR_00199', '5ee1f34ea3ec31_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (143, '2020-06-11 16:03:30', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_00199', '5ee1f362188c96', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (144, '2020-06-11 16:03:30', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, 'ERR_00199', '5ee1f362188c96_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (145, '2020-06-11 16:03:54', '6285221271243', '77100', 0x63705F36323838313136343035353027, 0, 0, '1000', '5ee1f37a918570', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (146, '2020-06-11 16:03:54', '6285221271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5ee1f37a918570_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (147, '2020-06-11 16:04:28', '6288921271243', '77100', 0x63705F36323838313136343035353027, 0, 0, '1000', '5ee1f39c1c6716', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (148, '2020-06-11 16:04:28', '6288921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5ee1f39c1c6716_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (149, '2020-06-11 16:05:06', '6289821271243', '77100', 0x63705F36323838313136343035353027, 0, 0, '1000', '5ee1f3c1bc11d1', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (150, '2020-06-11 16:05:06', '6289821271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5ee1f3c1bc11d1_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (151, '2020-06-11 16:05:27', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_00199', '5ee1f3d79388d9', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (152, '2020-06-11 16:05:27', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, 'ERR_00199', '5ee1f3d79388d9_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (153, '2020-06-11 18:35:44', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_00199', '5ee21710be0045', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (154, '2020-06-11 18:35:44', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, 'ERR_00199', '5ee21710be0045_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (155, '2020-06-15 20:09:04', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_00199', '5ee772f043cb92', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (156, '2020-06-15 20:09:04', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, 'ERR_00199', '5ee772f043cb92_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (157, '2020-06-15 20:09:42', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_00199', '5ee77316ad04f9', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (158, '2020-06-15 20:09:42', '6285921271243', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, 'ERR_00199', '5ee77316ad04f9_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (159, '2020-06-15 20:11:23', '6285921271243', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ee7737b25cb42', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (160, '2020-06-15 20:11:23', '6285921271243', '77100', 0x74657374206C61746974756465206F726967696E616C203D202D362E343536303430206C6F6E676974756465206F726967696E616C203D203130362E393737333739, 1, 1, '0', '5ee7737b25cb42_mt', '2851145857787697', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (161, '2020-06-22 14:22:33', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ef05c39472220', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (162, '2020-06-22 14:22:33', '628592222222', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A203632383831313634303535302720232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A206274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5ef05c39472220_mt', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (163, '2020-06-22 14:24:26', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ef05caabe7094', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (164, '2020-06-22 14:24:26', '628592222222', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A203632383831313634303535302720232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A206274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5ef05caabe7094_mt', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (165, '2020-06-22 14:25:14', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ef05cda1d4f95', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (166, '2020-06-22 14:25:14', '628592222222', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A203632383831313634303535302720232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A206274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5ef05cda1d4f95_mt', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (167, '2020-06-22 14:30:40', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 1, '0', '5ef05e2073fcd8', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (168, '2020-06-22 14:30:40', '628592222222', '77100', 0x4C4154544954554445203A203622323727323222532023243041204C4F4E4749545544453A2031303622353827333922452023243041204D534953444E203A203632383831313634303535302720232430412054494D452044415445203A20323032302D30352D32302032313A32363A30392023243041204C4F434154494F4E20494E464F203A206274735F69636F646520232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3435363034302C3130362E393737333739, 1, 1, '0', '5ef05e2073fcd8_mt', '2851145857787697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (169, '2020-06-22 14:31:27', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_INTERNAL_PARAM', '5ef05e4fbba3c2', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (170, '2020-06-22 14:31:27', '628592222222', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, 'ERR_INTERNAL_PARAM', '5ef05e4fbba3c2_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (171, '2020-06-22 14:32:15', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_018', '5ef05e7f1ca6a0', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (172, '2020-06-22 14:32:15', '628592222222', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, 'ERR_018', '5ef05e7f1ca6a0_mt', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (173, '2020-06-22 14:39:27', '628592222222', '77100', 0x63705F36323838313136343035353027, 0, 0, 'ERR_018', '5ef0602fb32527', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (174, '2020-06-22 14:39:27', '628592222222', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, 'ERR_018', '5ef0602fb32527_mt', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (175, '2020-06-22 14:49:37', '628592222222', '77100', 0x63705F363238383131363430353530, 0, 0, '1003', '5ef06291193290', '49235771229146526', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (176, '2020-06-22 14:49:37', '628592222222', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '1003', '5ef06291193290_mt', '49235771229146526', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (177, '2020-06-22 14:52:09', '628592222222', '77100', 0x63705F363238383732323735373036, 0, 1, '0', '5ef06329627640', '49235923531637316', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (178, '2020-06-22 14:52:09', '628592222222', '77100', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef06329627640_mt', '49235923531637316', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (179, '2020-06-22 15:04:18', '628592222222', '628881818101', 0x63705F363238383732323735373036, 0, 1, '0', '5ef06602254dd8', '49236652361318896', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (180, '2020-06-22 15:04:18', '628592222222', '628881818101', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef06602254dd8_mt', '49236652361318896', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (181, '2020-06-22 15:06:28', '628592222222', '628881818101', 0x63705F363238383131363430353530, 0, 0, '1003', '5ef0668488dcc1', '49236782711632649', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (182, '2020-06-22 15:06:28', '628592222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '1003', '5ef0668488dcc1_mt', '49236782711632649', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (183, '2020-06-22 15:18:27', '628592222222', '628881818101', 0x63705F363238383131363430353530, 0, 0, '1003', '5ef0695304c7d1', '49237501165450394', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (184, '2020-06-22 15:18:27', '628592222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5ef0695304c7d1_mt', '49237501165450394', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (185, '2020-06-22 15:23:22', '628592222222', '628881818101', 0x63705F363238383131363430353530, 0, 0, '1003', '5ef06a7a5cb1b0', '49237796520642780', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (186, '2020-06-22 15:23:22', '628592222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5ef06a7a5cb1b0_mt', '49237796520642780', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (187, '2020-06-22 15:29:16', '628592222222', '628881818101', 0x63705F363238383131363430353530, 0, 0, '1003', '5ef06bdcb2d645', '49238150882641451', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (188, '2020-06-22 15:29:16', '628592222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5ef06bdcb2d645_mt', '49238150882641451', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (189, '2020-06-22 15:37:07', '628592222222', '77100', 0x63705F363238383131363430353530, 0, 0, '1003', '5ef06db31c6de8', '49238621261672806', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (190, '2020-06-22 15:37:07', '628592222222', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5ef06db31c6de8_mt', '49238621261672806', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (191, '2020-06-22 15:41:03', '628592222222', '77100', 0x63705F363238383131363430353530, 0, 0, '1003', '5ef06e9f6fcb41', '49238857583531712', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (192, '2020-06-22 15:41:03', '628592222222', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5ef06e9f6fcb41_mt', '49238857583531712', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (193, '2020-06-22 15:42:05', '628592222222', '77100', 0x63705F363238383131363430353530, 0, 0, '1003', '5ef06eddb81820', '49238919883445350', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (194, '2020-06-22 15:42:05', '628592222222', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5ef06eddb81820_mt', '49238919883445350', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (195, '2020-06-22 15:44:37', '628592222222', '77100', 0x63705F363238383131363430353530, 0, 0, '1003', '5ef06f750d24e5', '49239071181844138', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (196, '2020-06-22 15:44:37', '628592222222', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5ef06f750d24e5_mt', '49239071181844138', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (197, '2020-06-22 15:56:13', '628592222222', '77100', 0x63705F363238383131363430353530, 0, 0, '1003', '5ef0722d726a34', '49239767600717436', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (198, '2020-06-22 15:56:13', '628592222222', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5ef0722d726a34_mt', '49239767600717436', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (199, '2020-06-22 15:56:53', '628592222222', '628881818101', 0x63705F363238383131363430353530, 0, 0, '1003', '5ef07255bb5959', '49239807900568391', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (200, '2020-06-22 15:56:53', '628592222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5ef07255bb5959_mt', '49239807900568391', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (201, '2020-06-22 15:59:58', '628592222222', '628881818101', 0x63705F363238383131363430353530, 0, 0, '1003', '5ef0730e1613e2', '49239992229448772', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (202, '2020-06-22 15:59:58', '628592222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5ef0730e1613e2_mt', '49239992229448772', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (203, '2020-06-22 16:00:35', '628592222222', '628881818101', 0x63705F363238383131363430353530, 0, 0, '1003', '5ef07333603cf2', '49240029541864937', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (204, '2020-06-22 16:00:35', '628592222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5ef07333603cf2_mt', '49240029541864937', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (205, '2020-06-22 16:26:20', '628592222222', '628881818101', 0x63705F363238383732323735373036, 0, 1, '0', '5ef0793bed5047', '49241574114366922', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (206, '2020-06-22 16:26:20', '628592222222', '628881818101', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef0793bed5047_mt', '49241574114366922', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (207, '2020-06-22 16:40:08', '628592222222', '77100', 0x63705F363238383732323735373036, 0, 1, '0', '5ef07c788fd9f1', '49242402732058587', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (208, '2020-06-22 16:40:08', '628592222222', '77100', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef07c788fd9f1_mt', '49242402732058587', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (209, '2020-06-22 16:45:05', '628592222222', '77100', 0x63705F363238383732323735373036, 0, 1, '0', '5ef07da0e49860', '49242699085972241', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (210, '2020-06-22 16:45:05', '628592222222', '77100', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef07da0e49860_mt', '49242699085972241', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (211, '2020-06-22 17:06:36', '628592222222', '77100', 0x63705F363238383732323735373036, 0, 1, '0', '5ef082ac75fd78', '49243990628092290', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (212, '2020-06-22 17:06:36', '628592222222', '77100', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef082ac75fd78_mt', '49243990628092290', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (213, '2020-06-22 17:08:37', '628592222222', '77100', 0x63705F363238383732323735373036, 0, 1, '0', '5ef08325c7a894', '49244111947429861', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (214, '2020-06-22 17:08:37', '628592222222', '77100', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef08325c7a894_mt', '49244111947429861', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (215, '2020-06-22 17:10:52', '628592222222', '77100', 0x63705F363238383732323735373036, 0, 1, '0', '5ef083ac1a11e2', '49244246245285971', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (216, '2020-06-22 17:10:52', '628592222222', '77100', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef083ac1a11e2_mt', '49244246245285971', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (217, '2020-06-22 19:11:42', '628592222222', '628881818101', 0x63705F363238383732323735373036, 0, 1, '0', '5ef09ffdd41b30', '49251496027510820', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (218, '2020-06-22 19:11:42', '628592222222', '628881818101', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef09ffdd41b30_mt', '49251496027510820', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (219, '2020-06-22 19:20:53', '628592222222', '628881818101', 0x63705F363238383732323735373036, 0, 1, '0', '5ef0a2254fe696', '49252047484870182', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (220, '2020-06-22 19:20:53', '628592222222', '628881818101', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef0a2254fe696_mt', '49252047484870182', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (221, '2020-06-22 19:21:29', '628592222222', '628881818101', 0x63705F363238383732323735373036, 0, 1, '0', '5ef0a249a32ef1', '49252083803814882', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (222, '2020-06-22 19:21:29', '628592222222', '628881818101', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef0a249a32ef1_mt', '49252083803814882', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (223, '2020-06-22 19:22:21', '628882222222', '628881818101', 0x63705F363238383732323735373036, 0, 0, '1000', '5ef0a27ceb6045', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (224, '2020-06-22 19:22:21', '628882222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5ef0a27ceb6045_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (225, '2020-06-22 19:22:49', '628882222222', '628881818101', 0x63705F363238383732323735373036, 0, 0, '1000', '5ef0a2991c0f34', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (226, '2020-06-22 19:22:49', '628882222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5ef0a2991c0f34_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (227, '2020-06-22 19:40:48', '628592222222', '628881818101', 0x63705F363238383732323735373036, 0, 1, '0', '5ef0a6d0698296', '49253242556340693', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (228, '2020-06-22 19:40:48', '628592222222', '628881818101', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef0a6d0698296_mt', '49253242556340693', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (229, '2020-06-22 19:41:18', '628882222222', '628881818101', 0x63705F363238383732323735373036, 0, 0, '1000', '5ef0a6eeb1c7f7', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (230, '2020-06-22 19:41:18', '628882222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5ef0a6eeb1c7f7_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (231, '2020-06-22 19:45:33', '628882222222', '77100', 0x63705F363238383732323735373036, 0, 0, '1000', '5ef0a7eceb6283', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (232, '2020-06-22 19:45:33', '628882222222', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5ef0a7eceb6283_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (233, '2020-06-22 19:46:18', '628882222222', '77100', 0x63705F363238383732323735373036, 0, 0, '1000', '5ef0a81a3434f4', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (234, '2020-06-22 19:46:18', '628882222222', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5ef0a81a3434f4_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (235, '2020-06-22 19:46:40', '628882222222', '77100', 0x63705F363238383732323735373036, 0, 0, '1000', '5ef0a8306e7600', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (236, '2020-06-22 19:46:40', '628882222222', '77100', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5ef0a8306e7600_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (237, '2020-06-24 12:22:23', '628592222222', '628881818101', 0x63705F363238383732323735373036, 0, 1, '0', '5ef2e30f92ed65', '49399737766722126', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (238, '2020-06-24 12:22:23', '628592222222', '628881818101', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef2e30f92ed65_mt', '49399737766722126', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (239, '2020-06-24 12:23:48', '628562222222', '628881818101', 0x63705F363238383732323735373036, 0, 0, '1000', '5ef2e363e65053', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (240, '2020-06-24 12:23:48', '628562222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5ef2e363e65053_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (241, '2020-06-24 12:24:23', '628882222222', '628881818101', 0x63705F363238383732323735373036, 0, 0, '1000', '5ef2e3872d39b5', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (242, '2020-06-24 12:24:23', '628882222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5ef2e3872d39b5_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (243, '2020-06-24 12:25:07', '628882222222', '628881818101', 0x63705F363238383732323735373036, 0, 0, '1000', '5ef2e3b355cd89', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (244, '2020-06-24 12:25:07', '628882222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5ef2e3b355cd89_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (245, '2020-06-24 12:26:27', '628882222222', '628881818101', 0x63705F363238383732323735373036, 0, 0, '1000', '5ef2e40382ed51', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (246, '2020-06-24 12:26:27', '628882222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5ef2e40382ed51_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (247, '2020-06-24 14:00:06', '628592222222', '628881818101', 0x63705F3038383732323735373036, 0, 0, 'ERR_018', '5ef2f9f6ab89d9', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (248, '2020-06-24 14:00:06', '628592222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5ef2f9f6ab89d9_mt', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (249, '2020-06-24 18:35:40', '628592222222', '628881818101', 0x63705F3038383732323735373036, 0, 1, '0', '5ef33a8ca451f7', '49422134890398500', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (250, '2020-06-24 18:35:40', '628592222222', '628881818101', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef33a8ca451f7_mt', '49422134890398500', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (251, '2020-06-24 18:36:53', '628592222222', '628881818101', 0x63705F363238383732323735373036, 0, 1, '0', '5ef33ad5151ee3', '49422207245182856', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (252, '2020-06-24 18:36:53', '628592222222', '628881818101', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef33ad5151ee3_mt', '49422207245182856', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (253, '2020-06-24 18:37:30', '628592222222', '628881818101', 0x63705F3138383732323735373036, 0, 0, 'ERR_018', '5ef33afa68dd55', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (254, '2020-06-24 18:37:30', '628592222222', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5ef33afa68dd55_mt', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (255, '2020-06-24 18:38:01', '628592222222', '628881818101', 0x63705F3038383732323735373036, 0, 1, '0', '5ef33b19b57d37', '49422275907226165', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (256, '2020-06-24 18:38:01', '628592222222', '628881818101', 0x74657374206C61746974756465206F726967696E616C203D202D3633312E343233206C6F6E676974756465206F726967696E616C203D203130362E3931373238, 1, 1, '0', '5ef33b19b57d37_mt', '49422275907226165', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (257, '2020-07-21 03:14:26', '6288212086557', '628881818101', 0x63702031323334, 0, 0, '1000', '5f15fb22ada5b6', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (258, '2020-07-21 03:14:26', '6288212086557', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f15fb22ada5b6_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (259, '2020-07-21 11:07:34', '6288212086557', '628881818101', 0x43702031323334, 0, 0, '1000', '5f166a064acdc4', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (260, '2020-07-21 11:07:34', '6288212086557', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f166a064acdc4_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (261, '2020-07-21 11:08:12', '6288212086557', '628881818101', 0x63702031323334, 0, 0, '1000', '5f166a2c940de6', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (262, '2020-07-21 11:08:12', '6288212086557', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f166a2c940de6_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (263, '2020-07-21 11:24:40', '6288212086557', '628881818101', 0x63702036323838323132303836353537, 0, 0, 'ERR_INTERNAL_PARAM', '5f166e0807d8b6', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (264, '2020-07-21 11:24:40', '6288212086557', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F494E5445524E414C5F504152414D29, 1, 0, 'ERR_INTERNAL_PARAM', '5f166e0807d8b6_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (265, '2020-07-21 11:50:43', '6288212086557', '628881818101', 0x63702036323838323132303836353537, 0, 0, 'ERR_INTERNAL_PARAM', '5f167423aa76a8', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (266, '2020-07-21 11:50:43', '6288212086557', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F494E5445524E414C5F504152414D29, 1, 0, 'ERR_INTERNAL_PARAM', '5f167423aa76a8_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (267, '2020-07-21 12:23:56', '628811210618', '628881818101', 0x4350203038383131323130363138, 0, 0, '1000', '5f167beca6f8e0', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (268, '2020-07-21 12:23:56', '628811210618', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f167beca6f8e0_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (269, '2020-07-21 12:24:10', '628161888844', '628881818101', 0x4350203038383131323130363138, 0, 0, '1000', '5f167bfaa064f9', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (270, '2020-07-21 12:24:10', '628161888844', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f167bfaa064f9_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (271, '2020-07-21 12:29:35', '628811210618', '628881818101', 0x4350203038383131323130363138, 0, 0, '1000', '5f167d3ef1d098', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (272, '2020-07-21 12:29:35', '628811210618', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f167d3ef1d098_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (273, '2020-07-21 12:41:52', '628811210618', '628881818101', 0x4350203038383131323130363138, 0, 0, '1000', '5f168020574635', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (274, '2020-07-21 12:41:52', '628811210618', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f168020574635_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (275, '2020-07-21 12:42:14', '628811210618', '628881818101', 0x4350203038383131323130363138, 0, 0, '1000', '5f168036955528', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (276, '2020-07-21 12:42:14', '628811210618', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f168036955528_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (277, '2020-07-21 13:03:07', '628811210618', '628881818101', 0x4350203038383131323130363138, 0, 0, '1000', '5f16851b0febe3', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (278, '2020-07-21 13:03:07', '628811210618', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f16851b0febe3_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (279, '2020-07-21 15:46:59', '628161888844', '628881818101', 0x4350203038383131323130363138, 0, 0, '1000', '5f16ab83b1dad1', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (280, '2020-07-21 15:46:59', '628161888844', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f16ab83b1dad1_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (281, '2020-07-21 15:47:05', '628811210618', '628881818101', 0x4350203038383131323130363138, 0, 0, '1000', '5f16ab89c50297', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (282, '2020-07-21 15:47:05', '628811210618', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f16ab89c50297_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (283, '2020-07-21 16:46:46', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 0, 'ERR_INTERNAL_PARAM', '5f16b985e5d2d3', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (284, '2020-07-21 16:46:46', '6288212086557', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F494E5445524E414C5F504152414D29, 1, 0, 'ERR_INTERNAL_PARAM', '5f16b985e5d2d3_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (285, '2020-07-21 16:53:49', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f16bb2c47feb6', '51748822436599208', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (286, '2020-07-21 16:53:49', '6288212086557', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32312031363A35333A34392023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D2C6465736372697074696F6E3A20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134, 1, 1, '0', '5f16bb2c47feb6_mt', '51748822436599208', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (287, '2020-07-21 17:03:04', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f16bd57622907', '51749377541996904', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (288, '2020-07-21 17:03:04', '6288212086557', '628881818101', 0x4C4154544954554445203A2036223827323022532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32312031373A30333A30342023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D2C6465736372697074696F6E3A20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f16bd57622907_mt', '51749377541996904', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (289, '2020-07-21 17:43:08', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f16c6bba96820', '51751781830172199', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (290, '2020-07-21 17:43:08', '6288212086557', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32312031373A34333A30382023243041202068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E38303431342023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D2C6465736372697074696F6E3A, 1, 1, '0', '5f16c6bba96820_mt', '51751781830172199', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (291, '2020-07-21 17:55:44', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 0, '1000', '5f16c9b0376579', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (292, '2020-07-21 17:55:44', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f16c9b0376579_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (293, '2020-07-21 17:57:35', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f16ca1d86dcc9', '51752647696191941', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (294, '2020-07-21 17:57:35', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32312031373A35373A33352023243041202068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E313338343037372C3130362E38303431342023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D2C6465736372697074696F6E3A, 1, 1, '0', '5f16ca1d86dcc9_mt', '51752647696191941', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (295, '2020-07-21 18:00:53', '6285214114010', '628881818101', 0x43705F7465732E205B5D, 0, 0, 'ERR_018', '5f16cae519c4f8', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (296, '2020-07-21 18:00:53', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f16cae519c4f8_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (297, '2020-07-21 18:07:41', '628161827176', '628881818101', 0x43505F3038383831383138313031, 0, 0, '1000', '5f16cc7de58438', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (298, '2020-07-21 18:07:42', '628161827176', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f16cc7de58438_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (299, '2020-07-21 18:16:29', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f16ce8b81a044', '51753781653545723', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (300, '2020-07-21 18:16:29', '6285214114010', '628881818101', 0x4C4154544954554445203A20362238273230225320232430414C4F4E4749545544453A20313036223438273135224520232430414D534953444E203A2036323838323132303836353537202324304154494D452044415445203A20323032302D30372D32312031383A31363A323920232430414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D2C6465736372697074696F6E3A2324304168747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f16ce8b81a044_mt', '51753781653545723', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (301, '2020-07-21 18:17:33', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f16cecc0d7cc6', '51753846181768462', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (302, '2020-07-21 18:17:33', '6285214114010', '628881818101', 0x4C4154544954554445203A20362238273230225320232430414C4F4E4749545544453A20313036223438273135224520232430414D534953444E203A2036323838323132303836353537202324304154494D452044415445203A20323032302D30372D32312031383A31373A333320232430414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D2C6465736372697074696F6E3A2324304168747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f16cecc0d7cc6_mt', '51753846181768462', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (303, '2020-07-21 18:18:32', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f16cf070324d9', '51753905133333300', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (304, '2020-07-21 18:18:32', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827323022532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32312031383A31383A33322023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D2C6465736372697074696F6E3A20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f16cf070324d9_mt', '51753905133333300', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (305, '2020-07-21 19:13:02', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f16dbcd76a421', '51757175643143848', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (306, '2020-07-21 19:13:02', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827313922532023243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32312031393A31333A30322023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D3030322C6465736372697074696F6E3A20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f16dbcd76a421_mt', '51757175643143848', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (307, '2020-07-21 19:13:22', '6285214114010', '628881818101', 0x43705F35353535, 0, 0, 'ERR_018', '5f16dbe2538712', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (308, '2020-07-21 19:13:22', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f16dbe2538712_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (309, '2020-07-21 19:18:49', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 0, '1002', '5f16dd299d9750', '0', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (310, '2020-07-21 19:18:49', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303229, 1, 0, '1002', '5f16dd299d9750_mt', '0', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (311, '2020-07-21 19:25:56', '628161827176', '628881818101', 0x43505F363238383831383138313031, 0, 0, '4201', '5f16ded3d7b545', '51757950085574285', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (312, '2020-07-21 19:25:56', '628161827176', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '4201', '5f16ded3d7b545_mt', '51757950085574285', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (313, '2020-07-21 19:37:36', '628161827176', '628881818101', 0x43505F363238313631383237313736, 0, 0, '1002', '5f16e19056ce57', '0', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (314, '2020-07-21 19:37:36', '628161827176', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303229, 1, 0, '1002', '5f16e19056ce57_mt', '0', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (315, '2020-07-21 19:39:02', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f16e1e626a0e8', '51758736339386378', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (316, '2020-07-21 19:39:02', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827313922532023243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32312031393A33393A30322023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D3030322C6465736372697074696F6E3A20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f16e1e626a0e8_mt', '51758736339386378', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (317, '2020-07-21 19:42:53', '628161827176', '628881818101', 0x43505F36323838323133353834343731, 0, 0, '4221', '5f16e2cdb627a7', '51758967886490655', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (318, '2020-07-21 19:42:53', '628161827176', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283432323129, 1, 0, '4221', '5f16e2cdb627a7_mt', '51758967886490655', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (319, '2020-07-21 19:56:17', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 0, '1003', '5f16e5f02c88c9', '51759770410002424', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (320, '2020-07-21 19:56:17', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5f16e5f02c88c9_mt', '51759770410002424', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (321, '2020-07-21 19:57:36', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 0, '1003', '5f16e63f066446', '51759849176483344', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (322, '2020-07-21 19:57:36', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5f16e63f066446_mt', '51759849176483344', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (323, '2020-07-21 20:02:22', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 0, '1003', '5f16e75d1619f7', '51760135309342177', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (324, '2020-07-21 20:02:22', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5f16e75d1619f7_mt', '51760135309342177', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (325, '2020-07-21 20:13:23', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f16e9f0d25218', '51760795072402052', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (326, '2020-07-21 20:13:23', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32312032303A31333A32322023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D2C6465736372697074696F6E3A20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134, 1, 1, '0', '5f16e9f0d25218_mt', '51760795072402052', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (327, '2020-07-21 20:50:59', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 0, '1003', '5f16f2c1920209', '51763051811990267', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (328, '2020-07-21 20:50:59', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5f16f2c1920209_mt', '51763051811990267', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (329, '2020-07-21 21:07:03', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f16f685db7a90', '51764016104245625', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (330, '2020-07-21 21:07:03', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32312032313A30373A30332023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D3A20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134, 1, 1, '0', '5f16f685db7a90_mt', '51764016104245625', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (331, '2020-07-21 21:11:40', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f16f79be0a665', '51764294077522964', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (332, '2020-07-21 21:11:40', '6288212086557', '628881818101', 0x4C4154544954554445203A2036223827323022532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32312032313A31313A34302023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D3A20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f16f79be0a665_mt', '51764294077522964', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (333, '2020-07-21 21:13:43', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f16f8169da3c9', '51764416871373385', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (334, '2020-07-21 21:13:43', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827323022532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32312032313A31313A34302023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f16f8169da3c9_mt', '51764416871373385', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (335, '2020-07-21 21:15:44', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '-3001', '5f16f88b0f98f1', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (336, '2020-07-21 21:15:44', '6288212086557', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f16f88b0f98f1_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (337, '2020-07-21 21:17:53', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '-3001', '5f16f90c186519', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (338, '2020-07-21 21:17:53', '6288212086557', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f16f90c186519_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (339, '2020-07-21 21:27:14', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f16fb41322df4', '51765227355907195', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (340, '2020-07-21 21:27:14', '6288212086557', '628881818101', 0x4C4154544954554445203A2036223827323022532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32312032313A32373A31342023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f16fb41322df4_mt', '51765227355907195', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (341, '2020-07-21 22:09:02', '628811210618', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f17050e9a1cc5', '51767736789674183', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (342, '2020-07-21 22:09:02', '628811210618', '628881818101', 0x4C4154544954554445203A203622313527343422532023243041204C4F4E4749545544453A20313036223430273722452023243041204D534953444E203A2036323838313132313036313820232430412054494D452044415445203A20323032302D30372D32312032323A30393A30322023243041204C4F434154494F4E20494E464F203A204B70204A656C7570616E6720232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32363231362C3130362E3636383732, 1, 1, '0', '5f17050e9a1cc5_mt', '51767736789674183', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (343, '2020-07-21 22:35:56', '628881852079', '628881818101', 0x43505F3038383831383532303739, 0, 0, '1000', '5f170b5c3410c7', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (344, '2020-07-21 22:35:56', '628881852079', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f170b5c3410c7_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (345, '2020-07-21 22:36:35', '628881852079', '628881818101', 0x43505F363238383831383532303739, 0, 0, '1000', '5f170b837f63e7', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (346, '2020-07-21 22:36:35', '628881852079', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f170b837f63e7_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (347, '2020-07-22 10:42:15', '628811210618', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f17b5971e2f32', '51812929282171308', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (348, '2020-07-22 10:42:15', '628811210618', '628881818101', 0x4C4154544954554445203A203622313527343422532023243041204C4F4E4749545544453A20313036223430273722452023243041204D534953444E203A2036323838313132313036313820232430412054494D452044415445203A20323032302D30372D32322031303A34323A31352023243041204C4F434154494F4E20494E464F203A204B70204A656C7570616E6720232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32363231362C3130362E3636383732, 1, 1, '0', '5f17b5971e2f32_mt', '51812929282171308', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (349, '2020-07-22 10:43:03', '628811210618', '628881818101', 0x43505F363238383131323133333132, 0, 1, '0', '5f17b5c67ba419', '51812976635578595', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (350, '2020-07-22 10:43:03', '628811210618', '628881818101', 0x4C4154544954554445203A203622313727343322532023243041204C4F4E4749545544453A2031303622343027313622452023243041204D534953444E203A2036323838313132313333313220232430412054494D452044415445203A20323032302D30372D32322031303A34333A30332023243041204C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D55706772616465205444442028352920232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32393533382C3130362E3637313132, 1, 1, '0', '5f17b5c67ba419_mt', '51812976635578595', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (351, '2020-07-22 10:43:32', '628811210618', '628881818101', 0x43505F363238383831383532333830, 0, 1, '0', '5f17b5e39708e7', '51813005760726044', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (352, '2020-07-22 10:43:32', '628811210618', '628881818101', 0x4C4154544954554445203A2036223137273433224E2023243041204C4F4E4749545544453A2031303622343027313622452023243041204D534953444E203A2036323838383138353233383020232430412054494D452044415445203A20323032302D30372D32322031303A34333A33322023243041204C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D55706772616465205444442028352920232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D362E323935333730362C3130362E3637313132, 1, 1, '0', '5f17b5e39708e7_mt', '51813005760726044', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (353, '2020-07-22 10:44:11', '628811210618', '628881818101', 0x43505F363238383131323130363638, 0, 1, '0', '5f17b60b514867', '51813045449733811', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (354, '2020-07-22 10:44:11', '628811210618', '628881818101', 0x4C4154544954554445203A203622313227313322532023243041204C4F4E4749545544453A2031303622343327323222452023243041204D534953444E203A2036323838313132313036363820232430412054494D452044415445203A20323032302D30372D32322031303A34343A31312023243041204C4F434154494F4E20494E464F203A204B616D70756E67204B6172616E67204D756C7961205B48532D31205461672D355D20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32303337332C3130362E3732323734, 1, 1, '0', '5f17b60b514867_mt', '51813045449733811', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (355, '2020-07-22 11:05:03', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f17baed053b28', '51814295160155350', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (356, '2020-07-22 11:05:03', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827313922532023243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32322031313A30353A30322023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D30303220232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f17baed053b28_mt', '51814295160155350', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (357, '2020-07-22 11:09:52', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f17bc10102d24', '51814586195944751', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (358, '2020-07-22 11:09:53', '6288212086557', '628881818101', 0x4C4154544954554445203A2036223827323022532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32322031313A30393A35322023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f17bc10102d24_mt', '51814586195944751', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (359, '2020-07-22 11:15:55', '6285214114010', '628881818101', 0x43705F7765657274, 0, 0, 'ERR_018', '5f17bd7b4914f8', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (360, '2020-07-22 11:15:55', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f17bd7b4914f8_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (361, '2020-07-22 11:28:47', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f17c07e4cc0c5', '51815720438521266', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (362, '2020-07-22 11:28:47', '6288212086557', '628881818101', 0x4C4154544954554445203A2036223827323322532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32322031313A32383A34372023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393831332C3130362E3830343134, 1, 1, '0', '5f17c07e4cc0c5_mt', '51815720438521266', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (363, '2020-07-22 11:32:35', '6285894994832', '628881818101', 0x63705F363235383934393934383332, 0, 0, 'ERR_018', '5f17c16367e6c0', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (364, '2020-07-22 11:32:35', '6285894994832', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f17c16367e6c0_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (365, '2020-07-22 11:39:00', '6285214114010', '628881818101', 0x43705F74657374205B205D, 0, 0, 'ERR_018', '5f17c2e4da1ac5', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (366, '2020-07-22 11:39:01', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f17c2e4da1ac5_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (367, '2020-07-22 13:51:42', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f17e1fc1c7bd7', '51824294278517522', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (368, '2020-07-22 13:51:42', '6288212086557', '628881818101', 0x4C4154544954554445203A2036223827323022532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32322031333A35313A34322023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f17e1fc1c7bd7_mt', '51824294278517522', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (369, '2020-07-22 18:27:31', '628811210618', '628881818101', 0x43505F363238383131323130363638, 0, 1, '0', '5f1822a1dd5609', '51840844079391860', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (370, '2020-07-22 18:27:31', '628811210618', '628881818101', 0x4C4154544954554445203A203622313227313322532023243041204C4F4E4749545544453A2031303622343327323222452023243041204D534953444E203A2036323838313132313036363820232430412054494D452044415445203A20323032302D30372D32322031383A32373A33302023243041204C4F434154494F4E20494E464F203A204B616D70756E67204B6172616E67204D756C7961205B48532D31205461672D355D20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32303337332C3130362E3732323734, 1, 1, '0', '5f1822a1dd5609_mt', '51840844079391860', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (371, '2020-07-23 10:44:33', '628881853272', '628881818101', 0x63705F363238383831383532303333, 0, 1, '0', '5f1907a0e95f39', '51899467134088686', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (372, '2020-07-23 10:44:33', '628881853272', '628881818101', 0x4C4154544954554445203A203622313727343322532023243041204C4F4E4749545544453A2031303622343027313622452023243041204D534953444E203A2036323838383138353230333320232430412054494D452044415445203A20323032302D30372D32332031303A34343A33332023243041204C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D55706772616465205444442028352920232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32393533382C3130362E3637313132, 1, 1, '0', '5f1907a0e95f39_mt', '51899467134088686', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (373, '2020-07-23 10:49:18', '628881853005', '628881818101', 0x43705F3038383831383533303035, 0, 1, '0', '5f1908be4de7a7', '51899752463477940', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (374, '2020-07-23 10:49:18', '628881853005', '628881818101', 0x4C4154544954554445203A203622313727323022532023243041204C4F4E4749545544453A2031303622343927323922452023243041204D534953444E203A2036323838383138353330303520232430412054494D452044415445203A20323032302D30372D32332031303A34393A31382023243041204C4F434154494F4E20494E464F203A204A61746920506164616E672D3030322065782050656E6A6172696E67616E2D30303220232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32383839392C3130362E3832343637, 1, 1, '0', '5f1908be4de7a7_mt', '51899752463477940', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (375, '2020-07-23 11:37:24', '628881850373', '628881818101', 0x43705F36323838323132303836353537, 0, 0, '1000', '5f191404bb55e4', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (376, '2020-07-23 11:37:24', '628881850373', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f191404bb55e4_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (377, '2020-07-23 12:38:22', '628811210618', '628881818101', 0x43505F363238383131323130363638, 0, 1, '0', '5f19224e48e332', '51906296452793443', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (378, '2020-07-23 12:38:22', '628811210618', '628881818101', 0x4C4154544954554445203A203622313127353022532023243041204C4F4E4749545544453A2031303622343327353522452023243041204D534953444E203A2036323838313132313036363820232430412054494D452044415445203A20323032302D30372D32332031323A33383A32322023243041204C4F434154494F4E20494E464F203A204D65727579612055746172612D4B656D62616E67616E205B48532D31205461672D355D20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31393731352C3130362E3733323031, 1, 1, '0', '5f19224e48e332_mt', '51906296452793443', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (379, '2020-07-23 12:53:54', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1925f2234249', '51907228289186555', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (380, '2020-07-23 12:53:54', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827323022532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332030333A30393A31312023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D20232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f1925f2234249_mt', '51907228289186555', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (381, '2020-07-23 13:03:41', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f19283d928cd1', '51907815740614115', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (382, '2020-07-23 13:03:41', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827323022532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332030333A30393A31312020232430412068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E38303431342023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D, 1, 1, '0', '5f19283d928cd1_mt', '51907815740614115', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (383, '2020-07-23 13:04:53', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f192884e9cee4', '51907887107149441', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (384, '2020-07-23 13:04:53', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827323022532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332030333A30393A3131202023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D20232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E383034313420, 1, 1, '0', '5f192884e9cee4_mt', '51907887107149441', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (385, '2020-07-23 13:05:58', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1928c64aac41', '51907952434518999', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (386, '2020-07-23 13:05:58', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827323022532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332030333A30393A31312020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134202023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D, 1, 1, '0', '5f1928c64aac41_mt', '51907952434518999', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (387, '2020-07-23 13:35:01', '6285894994832', '628881818101', 0x63705F363235383934393934383332, 0, 0, 'ERR_018', '5f192f9500ac08', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (388, '2020-07-23 13:35:01', '6285894994832', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f192f9500ac08_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (389, '2020-07-23 13:41:49', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f19312ca4c2b0', '51910102799847373', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (390, '2020-07-23 13:41:49', '6288212086557', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332031333A34313A34392020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E313338343037372C3130362E3830343134202023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D, 1, 1, '0', '5f19312ca4c2b0_mt', '51910102799847373', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (391, '2020-07-23 13:51:57', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f19338c756c77', '51910710627899836', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (392, '2020-07-23 13:51:57', '6285894994832', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332031333A35313A35372020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134202023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D, 1, 1, '0', '5f19338c756c77_mt', '51910710627899836', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (393, '2020-07-23 14:00:36', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f19359231a204', '51911228336667888', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (394, '2020-07-23 14:00:36', '6285894994832', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332031343A30303A33362020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134202023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D, 1, 1, '0', '5f19359231a204_mt', '51911228336667888', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (395, '2020-07-23 14:05:20', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1936afc962c5', '51911513959415611', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (396, '2020-07-23 14:05:20', '6288212086557', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332031343A30353A32302020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383232352C3130362E3830343134202023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D, 1, 1, '0', '5f1936afc962c5_mt', '51911513959415611', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (397, '2020-07-23 14:15:26', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f19390d35fb02', '51912119368309799', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (398, '2020-07-23 14:15:27', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827313922532023243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332031343A31353A32362020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533202023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D303032, 1, 1, '0', '5f19390d35fb02_mt', '51912119368309799', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (399, '2020-07-23 14:22:34', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f193ab8a47797', '51912546812930292', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (400, '2020-07-23 14:22:34', '6285894994832', '628881818101', 0x4C4154544954554445203A2036223727353722532023243041204C4F4E4749545544453A2031303622343827323122452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332031343A32323A33342020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333233392C3130362E3830353839202023243041204C4F434154494F4E20494E464F203A2050656E6A6172696E67616E2D3033302065782050656E6A6172696E67616E2D303032205B48532D33205461672D355D, 1, 1, '0', '5f193ab8a47797_mt', '51912546812930292', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (401, '2020-07-23 15:48:00', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f194ebf10bc94', '51917673235609762', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (402, '2020-07-23 15:48:00', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827313922532023243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332031353A34383A30302020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533202023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D303032, 1, 1, '0', '5f194ebf10bc94_mt', '51917673235609762', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (403, '2020-07-23 15:52:53', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 0, '-3001', '5f194fe00e55d8', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (404, '2020-07-23 15:52:53', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f194fe00e55d8_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (405, '2020-07-23 15:53:18', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 0, '-3001', '5f194ff910a6f4', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (406, '2020-07-23 15:53:18', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f194ff910a6f4_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (407, '2020-07-23 15:54:45', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 0, '-3001', '5f195050157781', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (408, '2020-07-23 15:54:45', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f195050157781_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (409, '2020-07-23 15:57:18', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1950ee1edfb0', '51918232259448737', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (410, '2020-07-23 15:57:18', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223727353722532023243041204C4F4E4749545544453A2031303622343827323122452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332031353A35373A31382020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333233392C3130362E3830353839202023243041204C4F434154494F4E20494E464F203A2050656E6A6172696E67616E2D3033302065782050656E6A6172696E67616E2D303032205B48532D33205461672D355D, 1, 1, '0', '5f1950ee1edfb0_mt', '51918232259448737', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (411, '2020-07-23 16:02:40', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f19522fcc10e5', '51918553964779844', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (412, '2020-07-23 16:02:40', '6288212086557', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332031363A30323A34302020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134202023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D, 1, 1, '0', '5f19522fcc10e5_mt', '51918553964779844', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (413, '2020-07-24 08:18:51', '628881852033', '628881818101', 0x43705F3038383831383532303736, 0, 1, '0', '5f1a36fb82aee2', '51977125708952336', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (414, '2020-07-24 08:18:51', '628881852033', '628881818101', 0x4C4154544954554445203A203022302730224E2023243041204C4F4E4749545544453A2031303622343027313622452023243041204D534953444E203A2036323838383138353230373620232430412054494D452044415445203A20323032302D30372D32342030383A31383A35312020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D342E32393135333438452D352C3130362E3637313134202023243041204C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D557067726164652054444420283529, 1, 1, '0', '5f1a36fb82aee2_mt', '51977125708952336', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (415, '2020-07-24 08:19:26', '628881852033', '628881818101', 0x43705F363238383831383532303736, 0, 1, '0', '5f1a371e15bf67', '51977160218561674', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (416, '2020-07-24 08:19:26', '628881852033', '628881818101', 0x4C4154544954554445203A2036223137273433224E2023243041204C4F4E4749545544453A2031303622343027313622452023243041204D534953444E203A2036323838383138353230373620232430412054494D452044415445203A20323032302D30372D32342030383A31393A32362020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D362E323935333730362C3130362E3637313132202023243041204C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D557067726164652054444420283529, 1, 1, '0', '5f1a371e15bf67_mt', '51977160218561674', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (417, '2020-07-24 08:20:27', '628881852033', '628881818101', 0x63705F363238383831383532303736, 0, 1, '0', '5f1a375b9482c1', '51977221739810388', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (418, '2020-07-24 08:20:27', '628881852033', '628881818101', 0x4C4154544954554445203A2036223137273433224E2023243041204C4F4E4749545544453A2031303622343027313622452023243041204D534953444E203A2036323838383138353230373620232430412054494D452044415445203A20323032302D30372D32342030383A32303A32372020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D362E323935333730362C3130362E3637313132202023243041204C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D557067726164652054444420283529, 1, 1, '0', '5f1a375b9482c1_mt', '51977221739810388', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (419, '2020-07-24 08:21:11', '628881853272', '628881818101', 0x43705F3038383831383532303736, 0, 1, '0', '5f1a37869a2fd8', '51977264761367477', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (420, '2020-07-24 08:21:11', '628881853272', '628881818101', 0x4C4154544954554445203A2036223137273433224E2023243041204C4F4E4749545544453A2031303622343027313622452023243041204D534953444E203A2036323838383138353230373620232430412054494D452044415445203A20323032302D30372D32342030383A32313A31312020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D362E323935333730362C3130362E3637313132202023243041204C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D557067726164652054444420283529, 1, 1, '0', '5f1a37869a2fd8_mt', '51977264761367477', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (421, '2020-07-24 08:21:48', '628881853272', '628881818101', 0x43705F3038383831383533323735, 0, 1, '0', '5f1a37aa4ee717', '51977300444203271', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (422, '2020-07-24 08:21:48', '628881853272', '628881818101', 0x4C4154544954554445203A203622313827313222532023243041204C4F4E4749545544453A20313036223430273822452023243041204D534953444E203A2036323838383138353332373520232430412054494D452044415445203A20323032302D30372D32342030383A32313A34382020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E33303332312C3130362E3636393031202023243041204C4F434154494F4E20494E464F203A20426F6C6576617264204253442053616C6F6E204C6F20536865205B48532D31205461672D355D, 1, 1, '0', '5f1a37aa4ee717_mt', '51977300444203271', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (423, '2020-07-24 08:58:25', '628881853005', '628881818101', 0x43705F303838323432323732343331, 0, 1, '0', '5f1a4040d99dd9', '51979499036451707', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (424, '2020-07-24 08:58:25', '628881853005', '628881818101', 0x4C4154544954554445203A203522313027323522532023243041204C4F4E4749545544453A2031313922323627313022452023243041204D534953444E203A203632383832343232373234333120232430412054494D452044415445203A20323032302D30372D32342030383A35383A32352020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D352E31373335342C3131392E3433363034202023243041204C4F434154494F4E20494E464F203A20444D5420534D4B2053616E646879205075747261, 1, 1, '0', '5f1a4040d99dd9_mt', '51979499036451707', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (425, '2020-07-24 12:49:39', '628811210618', '628881818101', 0x43505F363238383131323130363638, 0, 1, '0', '5f1a7671e18776', '51993372091458739', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (426, '2020-07-24 12:49:39', '628811210618', '628881818101', 0x4C4154544954554445203A203622313127353622532023243041204C4F4E4749545544453A2031303622343327343122452023243041204D534953444E203A2036323838313132313036363820232430412054494D452044415445203A20323032302D30372D32342031323A34393A33392020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31393838352C3130362E3732373934202023243041204C4F434154494F4E20494E464F203A204D65727579612055746172612D303230, 1, 1, '0', '5f1a7671e18776_mt', '51993372091458739', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (427, '2020-07-24 13:13:10', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1a7bf613a004', '51994784241552180', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (428, '2020-07-24 13:13:10', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332031363A30323A34302020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134202023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D, 1, 1, '0', '5f1a7bf613a004_mt', '51994784241552180', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (429, '2020-07-24 13:16:33', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1a7cc1c3ecd6', '51994987939485000', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (430, '2020-07-24 13:16:33', '6285894994832', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332031363A30323A34302020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134202023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D, 1, 1, '0', '5f1a7cc1c3ecd6_mt', '51994987939485000', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (431, '2020-07-24 13:20:42', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1a7dba278d09', '51995236302871446', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (432, '2020-07-24 13:20:42', '6285894994832', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32332031363A30323A34302020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134202023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D, 1, 1, '0', '5f1a7dba278d09_mt', '51995236302871446', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (433, '2020-07-24 13:55:43', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1a85ef296bb4', '51997337305115487', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (434, '2020-07-24 13:55:43', '6288212086557', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32342031333A35353A34332020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134202023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D, 1, 1, '0', '5f1a85ef296bb4_mt', '51997337305115487', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (435, '2020-07-24 14:52:36', '628811210618', '628881818101', 0x43505F363238383131323130363638, 0, 1, '0', '5f1a93441e78a6', '52000750289708663', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (436, '2020-07-24 14:52:36', '628811210618', '628881818101', 0x4C4154544954554445203A203622313227313322532023243041204C4F4E4749545544453A2031303622343327323222452023243041204D534953444E203A2036323838313132313036363820232430412054494D452044415445203A20323032302D30372D32342031343A35323A33362020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32303337332C3130362E3732323734202023243041204C4F434154494F4E20494E464F203A204B616D70756E67204B6172616E67204D756C7961205B48532D31205461672D355D, 1, 1, '0', '5f1a93441e78a6_mt', '52000750289708663', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (437, '2020-07-24 14:53:07', '628811210618', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f1a9363850b92', '52000781679930082', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (438, '2020-07-24 14:53:07', '628811210618', '628881818101', 0x4C4154544954554445203A203622313727343322532023243041204C4F4E4749545544453A2031303622343027313622452023243041204D534953444E203A2036323838313132313036313820232430412054494D452044415445203A20323032302D30372D32342031343A35333A30372020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32393533382C3130362E3637313132202023243041204C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D557067726164652054444420283529, 1, 1, '0', '5f1a9363850b92_mt', '52000781679930082', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (439, '2020-07-24 14:57:34', '628811210618', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f1a946ddf44a6', '52001048036644470', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (440, '2020-07-24 14:57:34', '628811210618', '628881818101', 0x4C4154544954554445203A203622313727343322532023243041204C4F4E4749545544453A2031303622343027313622452023243041204D534953444E203A2036323838313132313036313820232430412054494D452044415445203A20323032302D30372D32342031343A35373A33342020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32393533382C3130362E3637313132202023243041204C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D557067726164652054444420283529, 1, 1, '0', '5f1a946ddf44a6_mt', '52001048036644470', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (441, '2020-07-24 14:57:37', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1a94705c17a0', '52001050493089156', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (442, '2020-07-24 14:57:37', '6285894994832', '628881818101', 0x4C4154544954554445203A2036223827313922532023243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32342031343A35373A33372020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533202023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D303032, 1, 1, '0', '5f1a94705c17a0_mt', '52001050493089156', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (443, '2020-07-24 14:59:07', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1a94c9606085', '52001139533709476', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (444, '2020-07-24 14:59:07', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827313922532023243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A20363238383231323038363535372023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D30303220232430412054494D452044415445203A20323032302D30372D32342031343A35393A30372020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1a94c9606085_mt', '52001139533709476', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (445, '2020-07-24 14:59:49', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1a94f4574042', '52001182496269289', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (446, '2020-07-24 14:59:49', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827313922532023243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A20363238383231323038363535372023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D30303220232430412054494D452044415445203A20323032302D30372D32342031343A35393A34392020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1a94f4574042_mt', '52001182496269289', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (447, '2020-07-24 15:03:57', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1a95ec936176', '52001430742135923', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (448, '2020-07-24 15:03:57', '6288212086557', '628881818101', 0x4C4154544954554445203A2036223827313922532023243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A20363238383231323038363535372023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D30303220232430412054494D452044415445203A20323032302D30372D32342031353A30333A35372020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1a95ec936176_mt', '52001430742135923', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (449, '2020-07-24 15:35:00', '6285894994832', '628881818101', 0x63705F313233, 0, 0, 'ERR_018', '5f1a9d340567a2', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (450, '2020-07-24 15:35:00', '6285894994832', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f1a9d340567a2_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (451, '2020-07-24 15:46:42', '628881853005', '628881818101', 0x43705F3038383831383533303035, 0, 1, '0', '5f1a9ff295a492', '52003996755850697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (452, '2020-07-24 15:46:42', '628881853005', '628881818101', 0x4C4154544954554445203A203622313327323322532023243041204C4F4E4749545544453A20313036223438273922452023243041204D534953444E203A203632383838313835333030352023243041204C4F434154494F4E20494E464F203A20486F74656C2043656E74757279205B48532D33205461672D355D20232430412054494D452044415445203A20323032302D30372D32342031353A34363A34322020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32323239342C3130362E3830323536, 1, 1, '0', '5f1a9ff295a492_mt', '52003996755850697', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (453, '2020-07-24 15:49:02', '628881852033', '628881818101', 0x43705F363238383831383532303736, 0, 1, '0', '5f1aa07e3937b0', '52004136363190359', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (454, '2020-07-24 15:49:02', '628881852033', '628881818101', 0x4C4154544954554445203A2036223137273433224E2023243041204C4F4E4749545544453A2031303622343027313622452023243041204D534953444E203A203632383838313835323037362023243041204C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D55706772616465205444442028352920232430412054494D452044415445203A20323032302D30372D32342031353A34393A30322020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D362E323935333730362C3130362E3637313132, 1, 1, '0', '5f1aa07e3937b0_mt', '52004136363190359', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (455, '2020-07-24 16:40:20', '628161888844', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f1aac82b33289', '52007212887619592', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (456, '2020-07-24 16:40:20', '628161888844', '628881818101', 0x4C4154544954554445203A203622313727343322532023243041204C4F4E4749545544453A2031303622343027313622452023243041204D534953444E203A203632383831313231303631382023243041204C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D55706772616465205444442028352920232430412054494D452044415445203A20323032302D30372D32342031363A34303A32302020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32393533382C3130362E3637313132, 1, 1, '0', '5f1aac82b33289_mt', '52007212887619592', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (457, '2020-07-24 16:52:44', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1aaf6a9b3256', '52007956774539713', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (458, '2020-07-24 16:52:44', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827313922532023243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A20363238383231323038363535372023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D30303220232430412054494D452044415445203A20323032302D30372D32342031363A35323A34342020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1aaf6a9b3256_mt', '52007956774539713', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (459, '2020-07-24 17:40:58', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1abab9002072', '52010851156508384', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (460, '2020-07-24 17:40:58', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A20363238383231323038363535372023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D20232430412054494D452044415445203A20323032302D30372D32342031373A34303A35382020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134, 1, 1, '0', '5f1abab9002072_mt', '52010851156508384', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (461, '2020-07-24 17:42:05', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1abafbd11725', '52010917975504323', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (462, '2020-07-24 17:42:05', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827313822532023243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32342031373A34323A30352020232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E313338343037372C3130362E383034313423243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D20, 1, 1, '0', '5f1abafbd11725_mt', '52010917975504323', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (463, '2020-07-24 18:01:57', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1abfa286d162', '52012108695520629', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (464, '2020-07-24 18:01:57', '6285214114010', '628881818101', 0x4C4154544954554445203A203622382731382253232430414C4F4E4749545544453A203130362234382731352245232430414D534953444E203A20363238383231323038363535372324304154494D452044415445203A20323032302D30372D32342031383A30313A3537232430414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D2324304155524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134, 1, 1, '0', '5f1abfa286d162_mt', '52012108695520629', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (465, '2020-07-24 18:03:43', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1ac00d651d47', '52012215549923416', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (466, '2020-07-24 18:03:43', '6285214114010', '628881818101', 0x4C4154544954554445203A203622382731382253232430414C4F4E4749545544453A203130362234382731352245232430414D534953444E203A20363238383231323038363535372324304154494D452044415445203A20323032302D30372D32342031383A30333A34332324304155524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134, 1, 1, '0', '5f1ac00d651d47_mt', '52012215549923416', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (467, '2020-07-24 18:04:24', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1ac0363d7b68', '52012256372325036', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (468, '2020-07-24 18:04:24', '6285214114010', '628881818101', 0x4C4154544954554445203A203622382732302253232430414C4F4E4749545544453A203130362234382731352245232430414D534953444E203A20363238383231323038363535372324304154494D452044415445203A20323032302D30372D32342031383A30343A32332324304155524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134232430414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D, 1, 1, '0', '5f1ac0363d7b68_mt', '52012256372325036', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (469, '2020-07-24 18:05:46', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1ac089357f64', '52012339338680004', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (470, '2020-07-24 18:05:47', '6285214114010', '628881818101', 0x4C4154544954554445203A207B7B6C61747D207D23243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32342031383A30353A343620232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E38303735332023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D303032, 1, 1, '0', '5f1ac089357f64_mt', '52012339338680004', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (471, '2020-07-24 18:07:23', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1ac0e92c3566', '52012435340600928', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (472, '2020-07-24 18:07:23', '6285214114010', '628881818101', 0x4C4154544954554445203A207B7B6C61747D207D23243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32342031383A30373A323320232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E38303735332023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D303032, 1, 1, '0', '5f1ac0e92c3566_mt', '52012435340600928', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (473, '2020-07-24 18:08:18', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1ac1205b2ac0', '52012490490702410', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (474, '2020-07-24 18:08:18', '6285214114010', '628881818101', 0x4C4154544954554445203A207B7B6C61747D207D23243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32342031383A30383A31382023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D30303220232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134, 1, 1, '0', '5f1ac1205b2ac0_mt', '52012490490702410', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (475, '2020-07-24 18:13:23', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1ac2522a1496', '52012796301069703', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (476, '2020-07-24 18:13:23', '6288212086557', '628881818101', 0x4C4154544954554445203A207B7B6C61747D207D23243041204C4F4E4749545544453A2031303622343827313522452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32342031383A31333A32332023243041204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D20232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f1ac2522a1496_mt', '52012796301069703', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (477, '2020-07-24 18:14:46', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1ac2a5546984', '52012879477779569', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (478, '2020-07-24 18:14:46', '6288212086557', '628881818101', 0x4C4154544954554445203A207B7B6C61747D207D23243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32342031383A31343A34362023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D30303220232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1ac2a5546984_mt', '52012879477779569', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (479, '2020-07-24 18:15:36', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1ac2d73a84c3', '52012929366624017', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (480, '2020-07-24 18:15:36', '6288212086557', '628881818101', 0x4C4154544954554445203A2036223827313922532023243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32342031383A31353A33362023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D30303220232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1ac2d73a84c3_mt', '52012929366624017', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (481, '2020-07-24 18:22:47', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1ac48588f0a6', '52013359709081333', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (482, '2020-07-24 18:22:47', '6285214114010', '628881818101', 0x74657374206C61746974756465206F726967696E616C203D202D362E31333834303737206C6F6E676974756465206F726967696E616C203D203130362E3830343134, 1, 1, '0', '5f1ac48588f0a6_mt', '52013359709081333', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (483, '2020-07-24 18:25:50', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1ac53cdef246', '52013543053103598', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (484, '2020-07-24 18:25:50', '6285214114010', '628881818101', 0x4C4154544954554445203A202D362E31333837322023243041204C4F4E4749545544453A203130362E38303735332023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32342031383A32353A35302023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D30303220232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1ac53cdef246_mt', '52013543053103598', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (485, '2020-07-24 18:28:00', '628811210618', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f1ac5c044bcf4', '52013674404305881', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (486, '2020-07-24 18:28:00', '628811210618', '628881818101', 0x4C4154544954554445203A203622313727343322532023243041204C4F4E4749545544453A2031303622343027313622452023243041204D534953444E203A2036323838313132313036313820232430412054494D452044415445203A20323032302D30372D32342031383A32383A30302023243041204C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D55706772616465205444442028352920232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32393533382C3130362E3637313132, 1, 1, '0', '5f1ac5c044bcf4_mt', '52013674404305881', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (487, '2020-07-27 12:02:30', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e5fe6a01082', '52249744807578359', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (488, '2020-07-27 12:02:30', '6285214114010', '628881818101', 0x4C4154544954554445203A202D362E31333837322023243041204C4F4E4749545544453A203130362E38303735332023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32342031383A32353A35302023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D30303220232430412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1e5fe6a01082_mt', '52249744807578359', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (489, '2020-07-27 12:04:00', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e604000ee84', '52249834158971626', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (490, '2020-07-27 12:04:00', '6285214114010', '628881818101', 0x3131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131, 1, 1, '0', '5f1e604000ee84_mt', '52249834158971626', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (491, '2020-07-27 12:10:16', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1e61b8100b00', '52250210213272035', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (492, '2020-07-27 12:10:16', '6285894994832', '628881818101', 0x3131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131, 1, 1, '0', '5f1e61b8100b00_mt', '52250210213272035', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (493, '2020-07-27 12:11:41', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1e620d5f6096', '52250295513339607', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (494, '2020-07-27 12:11:41', '6285894994832', '628881818101', 0x3131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131313131, 1, 1, '0', '5f1e620d5f6096_mt', '52250295513339607', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (495, '2020-07-27 12:38:53', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e686dc2d608', '52251927943909749', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (496, '2020-07-27 12:38:53', '6285214114010', '628881818101', 0x4C41545449545544453A20362238273139225320232430414C4F4E4749545544453A20313036223438273237224520232430414D534953444E3A2036323838323132303836353537202324304154494D4520444154453A20323032302D30372D32342031383A32353A353020232430414C4F434154494F4E20494E464F3A2050656B6F6A616E2D303032202324304155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1e686dc2d608_mt', '52251927943909749', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (497, '2020-07-27 12:39:40', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e689c1d6260', '52251974245421891', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (498, '2020-07-27 12:39:40', '6285214114010', '628881818101', 0x4D534953444E3A2036323838323132303836353537202324304154494D4520444154453A20323032302D30372D32342031383A32353A353020232430414C4F434154494F4E20494E464F3A2050656B6F6A616E2D303032202324304155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1e689c1d6260_mt', '52251974245421891', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (499, '2020-07-27 12:40:35', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e68d36559b8', '52252029541302923', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (500, '2020-07-27 12:40:35', '6285214114010', '628881818101', 0x4D534953444E3A363238383231323038363535372324304154494D4520444154453A323032302D30372D32342031383A32353A353020232430414C4F434154494F4E20494E464F3A50656B6F6A616E2D3030322324304168747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1e68d36559b8_mt', '52252029541302923', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (501, '2020-07-27 12:41:01', '6285214114010', '628881818101', 0x43705F3131313131313131, 0, 0, 'ERR_018', '5f1e68eda9d409', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (502, '2020-07-27 12:41:01', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f1e68eda9d409_mt', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (503, '2020-07-27 12:41:57', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e6924ec7486', '52252111121286138', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (504, '2020-07-27 12:41:57', '6285214114010', '628881818101', 0x4D534953444E3A363238383231323038363535372324304154494D4520444154453A323032302D30372D32342031383A32353A3530232430414C4F434154494F4E20494E464F3A50656B6F6A616E2D3030322324304168747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1e6924ec7486_mt', '52252111121286138', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (505, '2020-07-27 12:45:33', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e69fd4e8507', '52252327459541082', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (506, '2020-07-27 12:45:33', '6285214114010', '628881818101', 0x4D534953444E3A363238383231323038363535372054494D4520444154453A323032302D30372D32342031383A32353A3530204C4F434154494F4E20494E464F3A50656B6F6A616E2D3030322068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1e69fd4e8507_mt', '52252327459541082', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (507, '2020-07-27 12:46:26', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e6a3298ed17', '52252380758747136', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (508, '2020-07-27 12:46:26', '6285214114010', '628881818101', 0x4D534953444E3A363238383231323038363535372068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1e6a3298ed17_mt', '52252380758747136', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (509, '2020-07-27 12:50:22', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e6b1de6c437', '52252616085072038', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (510, '2020-07-27 12:50:22', '6285214114010', '628881818101', 0x68747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1e6b1de6c437_mt', '52252616085072038', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (511, '2020-07-27 12:51:48', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e6b74401e37', '52252702392814545', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (512, '2020-07-27 12:51:48', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223827313922532023243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32342031383A32353A35302023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D303032, 1, 1, '0', '5f1e6b74401e37_mt', '52252702392814545', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (513, '2020-07-27 12:58:42', '6285214114010', '628881818101', 0x43705F3131313131, 0, 0, 'ERR_018', '5f1e6d1296a920', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (514, '2020-07-27 12:58:42', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f1e6d1296a920_mt', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (515, '2020-07-27 13:01:30', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1e6dba1f5426', '52253284256515222', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (516, '2020-07-27 13:01:30', '6285894994832', '628881818101', 0x4C4154544954554445203A2036223827313922532023243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32342031383A32353A35302023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D303032, 1, 1, '0', '5f1e6dba1f5426_mt', '52253284256515222', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (517, '2020-07-27 13:01:35', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1e6dbf68a972', '52253289544306315', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (518, '2020-07-27 13:01:35', '6285894994832', '628881818101', 0x4C4154544954554445203A2036223827313922532023243041204C4F4E4749545544453A2031303622343827323722452023243041204D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32342031383A32353A35302023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D303032, 1, 1, '0', '5f1e6dbf68a972_mt', '52253289544306315', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (519, '2020-07-27 13:03:29', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e6e30e43bb4', '52253403054760335', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (520, '2020-07-27 13:03:29', '6285214114010', '628881818101', 0x4D534953444E203A203632383832313230383635353720232430412054494D452044415445203A20323032302D30372D32342031383A32353A35302023243041204C4F434154494F4E20494E464F203A2050656B6F6A616E2D303032, 1, 1, '0', '5f1e6e30e43bb4_mt', '52253403054760335', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (521, '2020-07-27 13:04:03', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e6e53350437', '52253437343108016', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (522, '2020-07-27 13:04:03', '6285214114010', '628881818101', 0x4D534953444E203A20363238383231323038363535372054494D452044415445203A20323032302D30372D32342031383A32353A3530204C4F434154494F4E20494E464F203A2050656B6F6A616E2D303032, 1, 1, '0', '5f1e6e53350437_mt', '52253437343108016', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (523, '2020-07-27 13:04:56', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1e6e88b28f70', '52253490860617271', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (524, '2020-07-27 13:04:56', '6285894994832', '628881818101', 0x4D534953444E203A20363238383231323038363535372054494D452044415445203A20323032302D30372D32342031383A32353A3530204C4F434154494F4E20494E464F203A2050656B6F6A616E2D303032, 1, 1, '0', '5f1e6e88b28f70_mt', '52253490860617271', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (525, '2020-07-27 13:07:00', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e6f047ff172', '52253614642095051', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (526, '2020-07-27 13:07:00', '6285214114010', '628881818101', 0x4D534953444E203A2036323838323132303836353537204C4F434154494F4E20494E464F203A2050656B6F6A616E2D3030322068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1e6f047ff172_mt', '52253614642095051', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (527, '2020-07-27 13:07:56', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1e6f3c09e5d5', '52253670166405672', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (528, '2020-07-27 13:07:56', '6285894994832', '628881818101', 0x4D534953444E203A2036323838323132303836353537204C4F434154494F4E20494E464F203A2050656B6F6A616E2D3030322068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1e6f3c09e5d5_mt', '52253670166405672', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (529, '2020-07-27 13:14:37', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e70ccdcdb27', '52254071026809490', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (530, '2020-07-27 13:14:37', '6285214114010', '628881818101', 0x4D534953444E203A203632383832313230383635353723244F444C4F434154494F4E20494E464F203A2050656B6F6A616E2D3030322068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1e70ccdcdb27_mt', '52254071026809490', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (531, '2020-07-27 13:15:04', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1e70e85d7535', '52254098503797337', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (532, '2020-07-27 13:15:04', '6285894994832', '628881818101', 0x4D534953444E203A203632383832313230383635353723244F444C4F434154494F4E20494E464F203A2050656B6F6A616E2D3030322068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1e70e85d7535_mt', '52254098503797337', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (533, '2020-07-27 13:21:30', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e726a409091', '52254484470832178', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (534, '2020-07-27 13:21:30', '6285214114010', '628881818101', 0x4D534953444E203A203632383832313230383635353723244F414C4F434154494F4E20494E464F203A2050656B6F6A616E2D3030322068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1e726a409091_mt', '52254484470832178', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (535, '2020-07-27 13:22:15', '6285214114010', '628881818101', 0x43705F66666767, 0, 0, 'ERR_018', '5f1e7297a0d4d8', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (536, '2020-07-27 13:22:15', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f1e7297a0d4d8_mt', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (537, '2020-07-27 13:23:07', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e72caea0df9', '52254581097470158', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (538, '2020-07-27 13:23:07', '6285214114010', '628881818101', 0x4D534953444E203A203632383832313230383635353723244F414C4F434154494F4E20494E464F203A2050656B6F6A616E2D3030322068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1e72caea0df9_mt', '52254581097470158', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (539, '2020-07-27 13:30:26', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1e7481645172', '52255019557263709', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (540, '2020-07-27 13:30:26', '6288212086557', '628881818101', 0x4C4154544954554445203A2036223827313922532023244F41204C4F4E4749545544453A2031303622343827323722452023244F41204D534953444E203A20363238383231323038363535372023244F412054494D452044415445203A20323032302D30372D32342031383A32353A35302023244F41204C4F434154494F4E20494E464F203A2050656B6F6A616E2D3030322023244F412055524C203A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f1e7481645172_mt', '52255019557263709', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (541, '2020-07-27 13:38:25', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e766062afd0', '52255498543693217', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (542, '2020-07-27 13:38:25', '6285214114010', '628881818101', 0x7465737423244F415465737423244F4131323323244F413132333423244F41, 1, 1, '0', '5f1e766062afd0_mt', '52255498543693217', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (543, '2020-07-27 13:39:20', '6285214114010', '628881818101', 0x43705F3131313131, 0, 0, 'ERR_018', '5f1e7698689f88', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (544, '2020-07-27 13:39:20', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f1e7698689f88_mt', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (545, '2020-07-27 13:40:07', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e76c6b052c1', '52255600857563536', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (546, '2020-07-27 13:40:07', '6285214114010', '628881818101', 0x746573742031323334, 1, 1, '0', '5f1e76c6b052c1_mt', '52255600857563536', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (547, '2020-07-27 13:46:29', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1e78445fc1b0', '52255982543378248', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (548, '2020-07-27 13:46:29', '6288212086557', '628881818101', 0x4C4154544954554445203A20362238273231225323244F414C4F4E4749545544453A20313036223438273135224523244F414D534953444E203A203632383832313230383635353723244F4154494D452044415445203A20323032302D30372D32372031333A34363A323923244F414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393130352C3130362E3830343134, 1, 1, '0', '5f1e78445fc1b0_mt', '52255982543378248', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (549, '2020-07-27 13:48:55', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1e78d60c6757', '52256128175353101', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (550, '2020-07-27 13:48:56', '6285894994832', '628881818101', 0x4D534953444E203A203632383832313230383635353723244F414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D23244F4168747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f1e78d60c6757_mt', '52256128175353101', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (551, '2020-07-27 13:49:15', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1e78e92ce4f6', '52256147300695099', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (552, '2020-07-27 13:49:15', '6285894994832', '628881818101', 0x4D534953444E203A203632383832313230383635353723244F414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D23244F4168747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E313338343037372C3130362E3830343134, 1, 1, '0', '5f1e78e92ce4f6_mt', '52256147300695099', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (553, '2020-07-27 13:50:49', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1e7946bea258', '52256240931664680', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (554, '2020-07-27 13:50:49', '6285894994832', '628881818101', 0x4D534953444E203A203632383832313230383635353723244F444C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D23244F4468747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f1e7946bea258_mt', '52256240931664680', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (555, '2020-07-27 13:52:06', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1e799543f152', '52256319395033483', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (556, '2020-07-27 13:52:06', '6285894994832', '628881818101', 0x4D534953444E203A2036323838323132303836353537204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D6368747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383232352C3130362E3830343134, 1, 1, '0', '5f1e799543f152_mt', '52256319395033483', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (557, '2020-07-27 13:59:59', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e7b6db975d5', '52256791887225167', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (558, '2020-07-27 13:59:59', '6285214114010', '628881818101', 0x4D534953444E203A2036323838323132303836353537204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D6368747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134, 1, 1, '0', '5f1e7b6db975d5_mt', '52256791887225167', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (559, '2020-07-27 14:00:44', '6285214114010', '628881818101', 0x43705F31323334, 0, 0, 'ERR_018', '5f1e7b9c464716', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (560, '2020-07-27 14:00:44', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f1e7b9c464716_mt', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (561, '2020-07-27 14:01:32', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e7bca8adf95', '52256884695643428', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (562, '2020-07-27 14:01:32', '6285214114010', '628881818101', 0x4D6161662E204D534953444E203A2036323838323132303836353537204C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D6368747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E313338343037372C3130362E3830343134, 1, 1, '0', '5f1e7bca8adf95_mt', '52256884695643428', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (563, '2020-07-27 14:03:00', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e7c23933343', '52256973726192803', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (564, '2020-07-27 14:03:00', '6285214114010', '628881818101', 0x4D6161662E204D534953444E203A20363238383231323038363535372068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134, 1, 1, '0', '5f1e7c23933343_mt', '52256973726192803', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (565, '2020-07-27 14:04:15', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e7c6cc78cb4', '52257046950102934', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (566, '2020-07-27 14:04:15', '6285214114010', '628881818101', 0x4D6161662E204D534953444E203A2036323838323132303836353537, 1, 1, '0', '5f1e7c6cc78cb4_mt', '52257046950102934', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (567, '2020-07-27 14:05:26', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e7cb552c170', '52257119467308409', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (568, '2020-07-27 14:05:26', '6285214114010', '628881818101', 0x4D6161662E204D534953444E, 1, 1, '0', '5f1e7cb552c170_mt', '52257119467308409', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (569, '2020-07-27 14:06:05', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e7cdbe80a21', '52257158082973751', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (570, '2020-07-27 14:06:05', '6285214114010', '628881818101', 0x4D6161662E204D534953444E2036323835323134313134303130, 1, 1, '0', '5f1e7cdbe80a21_mt', '52257158082973751', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (571, '2020-07-27 14:27:19', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 0, '-3001', '5f1e81d2923115', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (572, '2020-07-27 14:27:19', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f1e81d2923115_mt', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (573, '2020-07-27 14:27:39', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 0, '-3001', '5f1e81e6935b91', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (574, '2020-07-27 14:27:39', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f1e81e6935b91_mt', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (575, '2020-07-27 14:28:51', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 0, '-3001', '5f1e822e9a2604', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (576, '2020-07-27 14:28:51', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f1e822e9a2604_mt', '', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (577, '2020-07-27 15:28:25', '628161888844', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f1e9027910372', '52262097747531876', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (578, '2020-07-27 15:28:25', '628161888844', '628881818101', 0x4C4154544954554445203A2036223135273434225323244F414C4F4E4749545544453A203130362234302737224523244F414D534953444E203A2036323838313132313036313823244F4154494D452044415445203A20323032302D30372D32372031353A32383A323523244F414C4F434154494F4E20494E464F203A204B70204A656C7570616E6723244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32363231362C3130362E3636383732, 1, 1, '0', '5f1e9027910372_mt', '52262097747531876', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (579, '2020-07-27 15:28:28', '628811210618', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f1e902be5ead6', '52262102067840322', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (580, '2020-07-27 15:28:28', '628811210618', '628881818101', 0x4C4154544954554445203A2036223135273434225323244F414C4F4E4749545544453A203130362234302737224523244F414D534953444E203A2036323838313132313036313823244F4154494D452044415445203A20323032302D30372D32372031353A32383A323823244F414C4F434154494F4E20494E464F203A204B70204A656C7570616E6723244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32363231362C3130362E3636383732, 1, 1, '0', '5f1e902be5ead6_mt', '52262102067840322', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (581, '2020-07-27 15:28:52', '628161888844', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f1e90435d35c0', '52262125529100218', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (582, '2020-07-27 15:28:52', '628161888844', '628881818101', 0x4C4154544954554445203A2036223135273434225323244F414C4F4E4749545544453A203130362234302737224523244F414D534953444E203A2036323838313132313036313823244F4154494D452044415445203A20323032302D30372D32372031353A32383A353223244F414C4F434154494F4E20494E464F203A204B70204A656C7570616E6723244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32363231362C3130362E3636383732, 1, 1, '0', '5f1e90435d35c0_mt', '52262125529100218', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (583, '2020-07-27 15:35:51', '6287722181388', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1e91e557b004', '52262543493729252', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (584, '2020-07-27 15:35:51', '6287722181388', '628881818101', 0x4C4154544954554445203A20362238273138225323244F414C4F4E4749545544453A20313036223438273135224523244F414D534953444E203A203632383832313230383635353723244F4154494D452044415445203A20323032302D30372D32372031353A33353A353123244F414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134, 1, 1, '0', '5f1e91e557b004_mt', '52262543493729252', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (585, '2020-07-27 15:51:57', '628979540616', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1e95ac888b10', '52263510715371612', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (586, '2020-07-27 15:51:57', '628979540616', '628881818101', 0x4C4154544954554445203A20362238273138225323244F414C4F4E4749545544453A20313036223438273135224523244F414D534953444E203A203632383832313230383635353723244F4154494D452044415445203A20323032302D30372D32372031353A35313A353723244F414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383332322C3130362E3830343134, 1, 1, '0', '5f1e95ac888b10_mt', '52263510715371612', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (587, '2020-07-27 16:26:42', '6285214114010', '628881818101', 0x43705F36323838323132303836353537, 0, 1, '0', '5f1e9dd0b8d909', '52265594896875508', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (588, '2020-07-27 16:26:42', '6285214114010', '628881818101', 0x4C4154544954554445203A20362237273537225323244F414C4F4E4749545544453A20313036223438273231224523244F414D534953444E203A203632383832313230383635353723244F4154494D452044415445203A20323032302D30372D32372031363A32363A343223244F414C4F434154494F4E20494E464F203A2050656E6A6172696E67616E2D3033302065782050656E6A6172696E67616E2D303032205B48532D33205461672D355D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333233392C3130362E3830353839, 1, 1, '0', '5f1e9dd0b8d909_mt', '52265594896875508', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (589, '2020-07-27 16:27:08', '6285214114010', '628881818101', 0x43705F3131313131, 0, 0, 'ERR_018', '5f1e9debf1eb80', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (590, '2020-07-27 16:27:08', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f1e9debf1eb80_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (591, '2020-07-27 16:44:49', '6285214114010', '628881818101', 0x43705F363238383831383532333830, 0, 1, '0', '5f1ea20f879609', '52266681716574961', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (592, '2020-07-27 16:44:49', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223137273433224E23244F414C4F4E4749545544453A20313036223430273136224523244F414D534953444E203A2036323838383138353233383023244F4154494D452044415445203A20323032302D30372D32372031363A34343A343923244F414C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D55706772616465205444442028352923244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D362E323935333730362C3130362E3637313132, 1, 1, '0', '5f1ea20f879609_mt', '52266681716574961', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (593, '2020-07-27 16:53:32', '6287722181388', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f1ea41b47d0e4', '52267205435776019', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (594, '2020-07-27 16:53:32', '6287722181388', '628881818101', 0x4C4154544954554445203A2036223137273433224E23244F414C4F4E4749545544453A20313036223430273136224523244F414D534953444E203A2036323838383138353233383023244F4154494D452044415445203A20323032302D30372D32372031363A35333A333223244F414C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D55706772616465205444442028352923244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D362E323935333730362C3130362E3637313132, 1, 1, '0', '5f1ea41b47d0e4_mt', '52267205435776019', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (595, '2020-07-27 16:55:46', '6285894994832', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f1ea4a19edb37', '52267339775732094', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (596, '2020-07-27 16:55:46', '6285894994832', '628881818101', 0x4D534953444E203A20363238383831383532333830204C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D5570677261646520544444202835292068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D362E323935333730362C3130362E3637313132, 1, 1, '0', '5f1ea4a19edb37_mt', '52267339775732094', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (597, '2020-07-27 16:58:52', '6285894994832', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f1ea55c52b106', '52267526484956498', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (598, '2020-07-27 16:58:52', '6285894994832', '628881818101', 0x4C4154544954554445203A2036223137273433224E23244F414C4F4E4749545544453A20313036223430273136224523244F414D534953444E203A2036323838383138353233383023244F4154494D452044415445203A20323032302D30372D32372031363A35353A343623244F414C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D55706772616465205444442028352923244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D362E323935333730362C3130362E3637313132, 1, 1, '0', '5f1ea55c52b106_mt', '52267526484956498', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (599, '2020-07-27 17:00:32', '628979540616', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f1ea5bea855d7', '52267624826422760', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (600, '2020-07-27 17:00:32', '628979540616', '628881818101', 0x4C4154544954554445203A2036223137273433224E23244F414C4F4E4749545544453A20313036223430273136224523244F414D534953444E203A2036323838383138353233383023244F4154494D452044415445203A20323032302D30372D32372031373A30303A333223244F414C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D55706772616465205444442028352923244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D362E323935333730362C3130362E3637313132, 1, 1, '0', '5f1ea5bea855d7_mt', '52267624826422760', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (601, '2020-07-27 17:22:08', '628979540616', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f1eaace8bc335', '52268920707064341', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (602, '2020-07-27 17:22:08', '628979540616', '628881818101', 0x4C4154544954554445203A2036223137273433224E23244F414C4F4E4749545544453A20313036223430273136224523244F414D534953444E203A2036323838383138353233383023244F4154494D452044415445203A20323032302D30372D32372031373A32323A303823244F414C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D55706772616465205444442028352923244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D362E323935333730362C3130362E3637313132, 1, 1, '0', '5f1eaace8bc335_mt', '52268920707064341', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (603, '2020-07-28 11:11:54', '628161888844', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f1fa5897bd8d3', '52333107669137782', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (604, '2020-07-28 11:11:54', '628161888844', '628881818101', 0x4C4154544954554445203A2036223135273434225323244F414C4F4E4749545544453A203130362234302737224523244F414D534953444E203A2036323838313132313036313823244F4154494D452044415445203A20323032302D30372D32382031313A31313A353423244F414C4F434154494F4E20494E464F203A204B70204A656C7570616E6723244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32363231362C3130362E3636383732, 1, 1, '0', '5f1fa5897bd8d3_mt', '52333107669137782', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (605, '2020-07-28 11:12:11', '628811210618', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f1fa59b286648', '52333125287088655', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (606, '2020-07-28 11:12:11', '628811210618', '628881818101', 0x4C4154544954554445203A2036223135273434225323244F414C4F4E4749545544453A203130362234302737224523244F414D534953444E203A2036323838313132313036313823244F4154494D452044415445203A20323032302D30372D32382031313A31323A313123244F414C4F434154494F4E20494E464F203A204B70204A656C7570616E6723244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32363231362C3130362E3636383732, 1, 1, '0', '5f1fa59b286648_mt', '52333125287088655', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (607, '2020-07-28 11:22:39', '628161888844', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f1fa80dc50bd9', '52333751950150154', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (608, '2020-07-28 11:22:39', '628161888844', '628881818101', 0x4C4154544954554445203A2036223135273434225323244F414C4F4E4749545544453A203130362234302737224523244F414D534953444E203A2036323838313132313036313823244F4154494D452044415445203A20323032302D30372D32382031313A32323A333923244F414C4F434154494F4E20494E464F203A204B70204A656C7570616E6723244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32363231362C3130362E3636383732, 1, 1, '0', '5f1fa80dc50bd9_mt', '52333751950150154', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (609, '2020-07-28 11:22:57', '628811210618', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f1fa8218d9052', '52333771678133098', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (610, '2020-07-28 11:22:57', '628811210618', '628881818101', 0x4C4154544954554445203A2036223135273434225323244F414C4F4E4749545544453A203130362234302737224523244F414D534953444E203A2036323838313132313036313823244F4154494D452044415445203A20323032302D30372D32382031313A32323A353723244F414C4F434154494F4E20494E464F203A204B70204A656C7570616E6723244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32363231362C3130362E3636383732, 1, 1, '0', '5f1fa8218d9052_mt', '52333771678133098', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (611, '2020-07-28 11:25:55', '6287722181388', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f1fa8d2e0e4d8', '52333949052920585', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (612, '2020-07-28 11:25:55', '6287722181388', '628881818101', 0x4C4154544954554445203A2036223137273433224E23244F414C4F4E4749545544453A20313036223430273136224523244F414D534953444E203A2036323838383138353233383023244F4154494D452044415445203A20323032302D30372D32382031313A32353A353523244F414C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D55706772616465205444442028352923244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D362E323935333730362C3130362E3637313132, 1, 1, '0', '5f1fa8d2e0e4d8_mt', '52333949052920585', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (613, '2020-07-28 11:26:28', '6287722181388', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1fa8f28b0a85', '52333980704612478', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (614, '2020-07-28 11:26:28', '6287722181388', '628881818101', 0x4C4154544954554445203A20362238273230225323244F414C4F4E4749545544453A20313036223438273135224523244F414D534953444E203A203632383832313230383635353723244F4154494D452044415445203A20323032302D30372D32382031313A32363A323823244F414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f1fa8f28b0a85_mt', '52333980704612478', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (615, '2020-07-28 11:32:04', '6285214114010', '628881818101', 0x43705F363238383831383532333830, 0, 1, '0', '5f1faa42a7c9f0', '52334316802490123', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (616, '2020-07-28 11:32:04', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223137273433224E23244F414C4F4E4749545544453A20313036223430273136224523244F414D534953444E203A2036323838383138353233383023244F4154494D452044415445203A20323032302D30372D32382031313A33323A303423244F414C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D55706772616465205444442028352923244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D362E323935333730362C3130362E3637313132, 1, 1, '0', '5f1faa42a7c9f0_mt', '52334316802490123', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (617, '2020-07-28 11:32:45', '6285214114010', '628881818101', 0x43705F363238383831383532333830, 0, 1, '0', '5f1faa6c42c041', '52334358397676067', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (618, '2020-07-28 11:32:45', '6285214114010', '628881818101', 0x7465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737431, 1, 1, '0', '5f1faa6c42c041_mt', '52334358397676067', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (619, '2020-07-28 11:33:44', '6285214114010', '628881818101', 0x43705F363238383831383532333830, 0, 1, '0', '5f1faaa6d9ec29', '52334417026235049', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (620, '2020-07-28 11:33:44', '6285214114010', '628881818101', 0x7465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737431, 1, 1, '0', '5f1faaa6d9ec29_mt', '52334417026235049', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (621, '2020-07-28 11:35:52', '6285894994832', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f1fab2718b602', '52334545240631399', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (622, '2020-07-28 11:35:52', '6285894994832', '628881818101', 0x7465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737431, 1, 1, '0', '5f1fab2718b602_mt', '52334545240631399', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (623, '2020-07-28 11:36:49', '628979540616', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f1fab60ba1d44', '52334602900262318', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (624, '2020-07-28 11:36:49', '628979540616', '628881818101', 0x7465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737431, 1, 1, '0', '5f1fab60ba1d44_mt', '52334602900262318', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (625, '2020-07-28 11:51:07', '6287722181388', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1faeb9cd58a1', '52335459979984941', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (626, '2020-07-28 11:51:07', '6287722181388', '628881818101', 0x7465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737431, 1, 1, '0', '5f1faeb9cd58a1_mt', '52335459979984941', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (627, '2020-07-28 12:09:41', '628161888844', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f1fb3134fcd49', '52336573465485363', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (628, '2020-07-28 12:09:41', '628161888844', '628881818101', 0x4C4154544954554445203A2036223135273434225323244F414C4F4E4749545544453A203130362234302737224523244F414D534953444E203A2036323838313132313036313823244F4154494D452044415445203A20323032302D30372D32382031323A30393A343123244F414C4F434154494F4E20494E464F203A204B70204A656C7570616E6723244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32363231362C3130362E3636383732, 1, 1, '0', '5f1fb3134fcd49_mt', '52336573465485363', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (629, '2020-07-28 13:10:01', '628979540616', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1fc137714065', '52340193643259076', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (630, '2020-07-28 13:10:01', '628979540616', '628881818101', 0x7465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737431, 1, 1, '0', '5f1fc137714065_mt', '52340193643259076', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (631, '2020-07-28 13:11:53', '628979540616', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f1fc1a8aa1684', '52340306836872386', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (632, '2020-07-28 13:11:53', '628979540616', '628881818101', 0x7465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737431, 1, 1, '0', '5f1fc1a8aa1684_mt', '52340306836872386', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (633, '2020-07-28 13:29:22', '628979540616', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f1fc5c20bfda7', '52341356179591477', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (634, '2020-07-28 13:29:22', '628979540616', '628881818101', 0x7465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737431, 1, 1, '0', '5f1fc5c20bfda7_mt', '52341356179591477', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (635, '2020-07-28 14:16:24', '6285214114010', '628881818101', 0x43705F363238383831383532333830, 0, 1, '0', '5f1fd0c80bf0e8', '52344178208187486', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (636, '2020-07-28 14:16:24', '6285214114010', '628881818101', 0x7465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737431, 1, 1, '0', '5f1fd0c80bf0e8_mt', '52344178208187486', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (637, '2020-07-28 14:18:07', '6285894994832', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f1fd12f2d3e35', '52344281316579607', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (638, '2020-07-28 14:18:07', '6285894994832', '628881818101', 0x7465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737431, 1, 1, '0', '5f1fd12f2d3e35_mt', '52344281316579607', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (639, '2020-07-28 14:35:20', '628161888844', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f1fd537d087d9', '52345313999084625', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (640, '2020-07-28 14:35:20', '628161888844', '628881818101', 0x4C4154544954554445203A2036223135273434225323244F414C4F4E4749545544453A203130362234302737224523244F414D534953444E203A2036323838313132313036313823244F4154494D452044415445203A20323032302D30372D32382031343A33353A323023244F414C4F434154494F4E20494E464F203A204B70204A656C7570616E6723244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32363231362C3130362E3636383732, 1, 1, '0', '5f1fd537d087d9_mt', '52345313999084625', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (641, '2020-07-28 16:20:16', '628881852045', '628881818101', 0x63705F3038383831383532303435, 0, 1, '0', '5f1fedcfd44469', '52351610032756041', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (642, '2020-07-28 16:20:16', '628881852045', '628881818101', 0x4C4154544954554445203A2036223232273435225323244F414C4F4E4749545544453A20313036223535273132224523244F414D534953444E203A2036323838383138353230343523244F4154494D452044415445203A20323032302D30372D32382031363A32303A313623244F414C4F434154494F4E20494E464F203A204B72616E6767616E204B6F74612057697361746123244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E333739313934372C3130362E393230303734, 1, 1, '0', '5f1fedcfd44469_mt', '52351610032756041', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (643, '2020-07-28 16:27:48', '6282298075529', '628881818101', 0x43705F3038383831383532303435, 0, 0, '-3001', '5f1fef8ede1ce2', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (644, '2020-07-28 16:27:48', '6282298075529', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f1fef8ede1ce2_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (645, '2020-07-28 16:28:39', '6282298075529', '628881818101', 0x63705F3038383831383532303435, 0, 0, '-3001', '5f1fefc1e0eeb9', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (646, '2020-07-28 16:28:39', '6282298075529', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f1fefc1e0eeb9_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (647, '2020-07-28 16:39:59', '628881852045', '628881818101', 0x43705F3038383831383532303435, 0, 1, '0', '5f1ff26ed1f320', '52352793002058177', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (648, '2020-07-28 16:39:59', '628881852045', '628881818101', 0x4C4154544954554445203A2036223232273131225323244F414C4F4E4749545544453A20313036223535273432224523244F414D534953444E203A2036323838383138353230343523244F4154494D452044415445203A20323032302D30372D32382031363A33393A353923244F414C4F434154494F4E20494E464F203A204B52414E4747414E204A41544953414D5055524E4123244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E33363935392C3130362E3932383235, 1, 1, '0', '5f1ff26ed1f320_mt', '52352793002058177', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (649, '2020-07-28 16:40:33', '6282298075529', '628881818101', 0x43705F3038383831383532303435, 0, 0, '-3001', '5f1ff28c094a37', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (650, '2020-07-28 16:40:33', '6282298075529', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f1ff28c094a37_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (651, '2020-07-28 16:51:35', '6282298075529', '628881818101', 0x43705F30383838313835303235, 0, 0, '5001', '5f1ff52726dd90', '52353489291927857', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (652, '2020-07-28 16:51:35', '6282298075529', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283530303129, 1, 0, '5001', '5f1ff52726dd90_mt', '52353489291927857', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (653, '2020-07-28 16:52:24', '6282298075529', '628881818101', 0x43705F3038383831383532303435, 0, 0, '-3001', '5f1ff55369fec8', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (654, '2020-07-28 16:52:24', '6282298075529', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f1ff55369fec8_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (655, '2020-07-28 16:53:14', '628881852045', '628881818101', 0x43705F3038383831383532303435, 0, 1, '0', '5f1ff58ac8fa47', '52353588941126937', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (656, '2020-07-28 16:53:15', '628881852045', '628881818101', 0x4C4154544954554445203A2036223232273131225323244F414C4F4E4749545544453A20313036223535273432224523244F414D534953444E203A2036323838383138353230343523244F4154494D452044415445203A20323032302D30372D32382031363A35333A313423244F414C4F434154494F4E20494E464F203A204B52414E4747414E204A41544953414D5055524E4123244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E33363935392C3130362E3932383235, 1, 1, '0', '5f1ff58ac8fa47_mt', '52353588941126937', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (657, '2020-07-28 16:53:42', '6282298075529', '628881818101', 0x43705F3038383831373431303836, 0, 1, '0', '5f1ff5a4709c57', '52353614592086521', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (658, '2020-07-28 16:53:42', '6282298075529', '628881818101', 0x4C4154544954554445203A2036223233273133225323244F414C4F4E4749545544453A203130362235352738224523244F414D534953444E203A2036323838383137343130383623244F4154494D452044415445203A20323032302D30372D32382031363A35333A343223244F414C4F434154494F4E20494E464F203A204B72616E6767616E204B6F74612057697361746123244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E333836393733342C3130362E3931383736, 1, 1, '0', '5f1ff5a4709c57_mt', '52353614592086521', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (659, '2020-07-29 15:19:54', '628881852045', '628881818101', 0x43705F3038383831373431303836, 0, 1, '0', '5f213128b8b351', '52434386934357762', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (660, '2020-07-29 15:19:54', '628881852045', '628881818101', 0x4C4154544954554445203A2036223233273138225323244F414C4F4E4749545544453A20313036223535273331224523244F414D534953444E203A2036323838383137343130383623244F4154494D452044415445203A20323032302D30372D32392031353A31393A353423244F414C4F434154494F4E20494E464F203A204B72616E6767616E204B6F74612057697361746123244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3338383231382C3130362E3932353339, 1, 1, '0', '5f213128b8b351_mt', '52434386934357762', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (661, '2020-07-29 15:42:29', '628811210618', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f213675877a06', '52435743715778920', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (662, '2020-07-29 15:42:29', '628811210618', '628881818101', 0x4C4154544954554445203A2036223135273434225323244F414C4F4E4749545544453A203130362234302737224523244F414D534953444E203A2036323838313132313036313823244F4154494D452044415445203A20323032302D30372D32392031353A34323A323923244F414C4F434154494F4E20494E464F203A204B70204A656C7570616E6723244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32363231362C3130362E3636383732, 1, 1, '0', '5f213675877a06_mt', '52435743715778920', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (663, '2020-07-29 16:27:13', '628979540616', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f2140f09d3ce9', '52438426800409050', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (664, '2020-07-29 16:27:14', '628979540616', '628881818101', 0x7465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737431, 1, 1, '0', '5f2140f09d3ce9_mt', '52438426800409050', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (665, '2020-07-29 16:29:44', '628979540616', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f2141862e4095', '52438576329791067', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (666, '2020-07-29 16:29:44', '628979540616', '628881818101', 0x4C4154544954554445203A2036223131273439225323244F414C4F4E4749545544453A20313036223532273238224523244F414D534953444E203A2036323838383138353233383023244F4154494D452044415445203A20323032302D30372D32392031363A32393A343423244F414C4F434154494F4E20494E464F203A205554414E204B4159552055544152412D303032205B53532D335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31393730372C3130362E38373434, 1, 1, '0', '5f2141862e4095_mt', '52438576329791067', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (667, '2020-07-29 16:41:29', '628979540616', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f2144480ae9e4', '52439282186924029', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (668, '2020-07-29 16:41:29', '628979540616', '628881818101', 0x7465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737431, 1, 1, '0', '5f2144480ae9e4_mt', '52439282186924029', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (669, '2020-07-30 01:59:31', '628811210618', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f21c7138383c2', '52472765699713595', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (670, '2020-07-30 01:59:31', '628811210618', '628881818101', 0x4C4154544954554445203A2036223135273434225323244F414C4F4E4749545544453A203130362234302737224523244F414D534953444E203A2036323838313132313036313823244F4154494D452044415445203A20323032302D30372D33302030313A35393A333123244F414C4F434154494F4E20494E464F203A204B70204A656C7570616E6723244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32363231362C3130362E3636383732, 1, 1, '0', '5f21c7138383c2_mt', '52472765699713595', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (671, '2020-07-30 02:10:27', '628161888844', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f21c9a1981d07', '52473419770043670', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (672, '2020-07-30 02:10:27', '628161888844', '628881818101', 0x4C4154544954554445203A2036223135273434225323244F414C4F4E4749545544453A203130362234302737224523244F414D534953444E203A2036323838313132313036313823244F4154494D452044415445203A20323032302D30372D33302030323A31303A323723244F414C4F434154494F4E20494E464F203A204B70204A656C7570616E6723244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32363231362C3130362E3636383732, 1, 1, '0', '5f21c9a1981d07_mt', '52473419770043670', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (673, '2020-07-30 02:10:41', '628161888844', '628881818101', 0x43505F363238383131323130363138, 0, 0, '-3001', '5f21c9ac84ca04', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (674, '2020-07-30 02:10:41', '628161888844', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f21c9ac84ca04_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (675, '2020-07-30 02:10:47', '628161888844', '628881818101', 0x43505F363238383131323130363138, 0, 0, '-3001', '5f21c9b2879995', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (676, '2020-07-30 02:10:47', '628161888844', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f21c9b2879995_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (677, '2020-07-30 03:06:39', '628811210618', '628881818101', 0x43505F363238383131323130363138, 0, 1, '0', '5f21d6cf8917b3', '52476793713387114', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (678, '2020-07-30 03:06:39', '628811210618', '628881818101', 0x4C4154544954554445203A2036223135273434225323244F414C4F4E4749545544453A203130362234302737224523244F414D534953444E203A2036323838313132313036313823244F4154494D452044415445203A20323032302D30372D33302030333A30363A333923244F414C4F434154494F4E20494E464F203A204B70204A656C7570616E6723244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32363231362C3130362E3636383732, 1, 1, '0', '5f21d6cf8917b3_mt', '52476793713387114', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (679, '2020-07-30 15:32:19', '6287722181388', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f22859305b187', '52521533185210746', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (680, '2020-07-30 15:32:19', '6287722181388', '628881818101', 0x7465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737431, 1, 1, '0', '5f22859305b187_mt', '52521533185210746', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (681, '2020-07-30 15:33:11', '6287722181388', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f2285c761ed02', '52521585543795847', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (682, '2020-07-30 15:33:11', '6287722181388', '628881818101', 0x4C4154544954554445203A20362238273139225323244F414C4F4E4749545544453A20313036223438273237224523244F414D534953444E203A203632383832313230383635353723244F4154494D452044415445203A20323032302D30372D32382031363A33333A333123244F414C4F434154494F4E20494E464F203A2050656B6F6A616E2D30303223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f2285c761ed02_mt', '52521585543795847', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (683, '2020-07-30 15:34:32', '6285214114010', '628881818101', 0x43705F363238383831383532333830, 0, 1, '0', '5f2286165afa40', '52521664508232073', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (684, '2020-07-30 15:34:32', '6285214114010', '628881818101', 0x4C4154544954554445203A2036223131273439225323244F414C4F4E4749545544453A20313036223532273238224523244F414D534953444E203A2036323838383138353233383023244F4154494D452044415445203A20323032302D30372D33302031353A33343A333223244F414C4F434154494F4E20494E464F203A205554414E204B4159552055544152412D303032205B53532D335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31393730372C3130362E38373434, 1, 1, '0', '5f2286165afa40_mt', '52521664508232073', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (685, '2020-07-30 15:39:40', '6285894994832', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f22874c0c7232', '52521974185416408', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (686, '2020-07-30 15:39:40', '6285894994832', '628881818101', 0x7465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737431, 1, 1, '0', '5f22874c0c7232_mt', '52521974185416408', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (687, '2020-07-30 15:42:10', '6285894994832', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f2287e119b401', '52522123230411642', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (688, '2020-07-30 15:42:10', '6285894994832', '628881818101', 0x4C4154544954554445203A2036223131273439225323244F414C4F4E4749545544453A20313036223532273238224523244F414D534953444E203A2036323838383138353233383023244F4154494D452044415445203A20323032302D30372D33302031353A34323A313023244F414C4F434154494F4E20494E464F203A205554414E204B4159552055544152412D303032205B53532D335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31393730372C3130362E38373434, 1, 1, '0', '5f2287e119b401_mt', '52522123230411642', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (689, '2020-07-30 15:45:12', '628979540616', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f2288971839a5', '52522305248586370', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (690, '2020-07-30 15:45:12', '628979540616', '628881818101', 0x7465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737420746573742074657374207465737431, 1, 1, '0', '5f2288971839a5_mt', '52522305248586370', 6);
INSERT INTO `tbl_aph_transaction_history` VALUES (691, '2020-07-30 15:46:36', '628979540616', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f2288ea279fb1', '52522388294962649', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (692, '2020-07-30 15:46:36', '628979540616', '628881818101', 0x4C4154544954554445203A20362231322732225323244F414C4F4E4749545544453A203130362235322739224523244F414D534953444E203A2036323838383138353233383023244F4154494D452044415445203A20323032302D30372D33302031353A34363A333523244F414C4F434154494F4E20494E464F203A205554414E204B4159552055544152412D303032205B53532D335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E323030343935322C3130362E3836393035, 1, 1, '0', '5f2288ea279fb1_mt', '52522388294962649', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (693, '2020-07-30 15:53:11', '628979540616', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f228a76420242', '52522784408481948', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (694, '2020-07-30 15:53:11', '628979540616', '628881818101', 0x4C4154544954554445203A20362231322732225323244F414C4F4E4749545544453A203130362235322739224523244F414D534953444E203A2036323838383138353233383023244F4154494D452044415445203A20323032302D30372D33302031353A35333A313123244F414C4F434154494F4E20494E464F203A205554414E204B4159552055544152412D303032205B53532D335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E323030343935322C3130362E3836393035, 1, 1, '0', '5f228a76420242_mt', '52522784408481948', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (695, '2020-07-30 16:05:37', '628161888844', '628881818101', 0x43505F363238383131323130363138, 0, 0, '-3001', '5f228d5c419ca2', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (696, '2020-07-30 16:05:37', '628161888844', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f228d5c419ca2_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (697, '2020-07-30 16:49:52', '6285894994832', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f2297be307320', '52526184355691684', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (698, '2020-07-30 16:49:52', '6285894994832', '628881818101', 0x4C4154544954554445203A20362231322732225323244F414C4F4E4749545544453A203130362235322739224523244F414D534953444E203A2036323838383138353233383023244F4154494D452044415445203A20323032302D30372D33302031363A34393A353223244F414C4F434154494F4E20494E464F203A204A4C2047414C555220534152492052415941205B53532D31205461672D355D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E323030343935322C3130362E3836393035, 1, 1, '0', '5f2297be307320_mt', '52526184355691684', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (699, '2020-07-30 16:54:42', '628979540616', '628881818101', 0x63705F363238383831383532333830, 0, 1, '0', '5f2298e0ed1480', '52526475109749453', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (700, '2020-07-30 16:54:42', '628979540616', '628881818101', 0x4C4154544954554445203A2036223131273439225323244F414C4F4E4749545544453A20313036223532273238224523244F414D534953444E203A2036323838383138353233383023244F4154494D452044415445203A20323032302D30372D33302031363A35343A343223244F414C4F434154494F4E20494E464F203A205554414E204B4159552055544152412D303032205B53532D335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31393730372C3130362E38373434, 1, 1, '0', '5f2298e0ed1480_mt', '52526475109749453', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (701, '2020-07-30 17:52:19', '6285214114010', '628881818101', 0x43705F363238383831383532333830, 0, 1, '0', '5f22a6628a4c78', '52529932723171999', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (702, '2020-07-30 17:52:19', '6285214114010', '628881818101', 0x4C4154544954554445203A20362231322732225323244F414C4F4E4749545544453A203130362235322739224523244F414D534953444E203A2036323838383138353233383023244F4154494D452044415445203A20323032302D30372D33302031373A35323A313923244F414C4F434154494F4E20494E464F203A204A4C2047414C555220534152492052415941205B53532D31205461672D355D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E323030343935322C3130362E3836393035, 1, 1, '0', '5f22a6628a4c78_mt', '52529932723171999', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (703, '2020-07-30 17:54:19', '6287722181388', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f22a6db280d55', '52530053287941464', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (704, '2020-07-30 17:54:19', '6287722181388', '628881818101', 0x4C4154544954554445203A20362238273139225323244F414C4F4E4749545544453A20313036223438273237224523244F414D534953444E203A203632383832313230383635353723244F4154494D452044415445203A20323032302D30372D32382031363A33333A333123244F414C4F434154494F4E20494E464F203A2050656B6F6A616E2D30303223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f22a6db280d55_mt', '52530053287941464', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (705, '2020-07-30 18:00:21', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f22a844a8b921', '52530414827113760', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (706, '2020-07-30 18:00:21', '6288212086557', '628881818101', 0x4C4154544954554445203A20362238273138225323244F414C4F4E4749545544453A20313036223438273135224523244F414D534953444E203A203632383832313230383635353723244F4154494D452044415445203A20323032302D30372D33302031383A30303A323123244F414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133383232352C3130362E3830343134, 1, 1, '0', '5f22a844a8b921_mt', '52530414827113760', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (707, '2020-07-30 18:53:31', '628881853005', '628881818101', 0x43705F3038383135313330323839, 0, 1, '0', '5f22b4bb5f2b09', '52533605547642633', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (708, '2020-07-30 18:53:31', '628881853005', '628881818101', 0x4C4154544954554445203A20362235382735225323244F414C4F4E4749545544453A20313038223239273230224523244F414D534953444E203A2036323838313531333032383923244F4154494D452044415445203A20323032302D30362D32372030323A30313A333723244F414C4F434154494F4E20494E464F203A204D554C544946494E414E4345204B554E494E47414E23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E39363739382C3130382E3438383938, 1, 1, '0', '5f22b4bb5f2b09_mt', '52533605547642633', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (709, '2020-07-31 01:35:51', '628811210618', '628881818101', 0x43505F363238383131323130363138, 0, 0, '-3001', '5f231302a90125', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (710, '2020-07-31 01:35:51', '628811210618', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f231302a90125_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (711, '2020-07-31 01:36:07', '628811210618', '628881818101', 0x43505F363238383131323130363138, 0, 0, '-3001', '5f231312a79b62', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (712, '2020-07-31 01:36:07', '628811210618', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f231312a79b62_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (713, '2020-07-31 01:36:27', '628811210618', '628881818101', 0x43505F363238383131323130363138, 0, 0, '-3001', '5f231326aa4df3', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (714, '2020-07-31 01:36:27', '628811210618', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f231326aa4df3_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (715, '2020-07-31 01:36:43', '628811210618', '628881818101', 0x43505F363238383131323130363138, 0, 0, '-3001', '5f231336ad9da0', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (716, '2020-07-31 01:36:43', '628811210618', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f231336ad9da0_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (717, '2020-08-04 10:10:13', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f28d1945f8a03', '52934206569182600', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (718, '2020-08-04 10:10:13', '6288212086557', '628881818101', 0x4C4154544954554445203A20362238273139225323244F414C4F4E4749545544453A20313036223438273237224523244F414D534953444E203A203632383832313230383635353723244F4154494D452044415445203A20323032302D30382D30342031303A31303A313323244F414C4F434154494F4E20494E464F203A2050656B6F6A616E2D30303223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31333837322C3130362E3830373533, 1, 1, '0', '5f28d1945f8a03_mt', '52934206569182600', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (719, '2020-08-04 16:08:15', '628881853005', '628881818101', 0x43705F3038383137323039353632, 0, 0, '5001', '5f29257ef0acc3', '52955689137557416', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (720, '2020-08-04 16:08:15', '628881853005', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283530303129, 1, 0, '5001', '5f29257ef0acc3_mt', '52955689137557416', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (721, '2020-08-04 17:16:22', '628881853005', '628881818101', 0x43705F3038383831383533303035, 0, 1, '0', '5f293575ea0937', '52959776113557056', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (722, '2020-08-04 17:16:22', '628881853005', '628881818101', 0x4C4154544954554445203A20362231312737225323244F414C4F4E4749545544453A20313036223439273336224523244F414D534953444E203A2036323838383138353330303523244F4154494D452044415445203A20323032302D30382D30342031373A31363A323223244F414C4F434154494F4E20494E464F203A20536D61727420536162616E67204F6666696365205B48532D335D5F53505248554223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31383533362C3130362E3832363638, 1, 1, '0', '5f293575ea0937_mt', '52959776113557056', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (723, '2020-08-05 11:16:38', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f2a32a5978087', '53024591806581069', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (724, '2020-08-05 11:16:38', '6288212086557', '628881818101', 0x4C4154544954554445203A20362238273230225323244F414C4F4E4749545544453A20313036223438273135224523244F414D534953444E203A203632383832313230383635353723244F4154494D452044415445203A20323032302D30382D30352031313A31363A333823244F414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f2a32a5978087_mt', '53024591806581069', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (725, '2020-08-05 11:49:29', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '1000', '5f2a3a593e7509', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (726, '2020-08-05 11:49:29', '6288212086557', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f2a3a593e7509_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (727, '2020-08-05 12:07:23', '6288212086557', '628881818101', 0x63705F74657374696E67, 0, 0, 'ERR_018', '5f2a3e8baa72b4', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (728, '2020-08-05 12:07:23', '6288212086557', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f2a3e8baa72b4_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (729, '2020-08-05 13:10:21', '628881853005', '628881818101', 0x43705F3038383831383533303035, 0, 1, '0', '5f2a4d4cde8819', '53031415061124897', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (730, '2020-08-05 13:10:21', '628881853005', '628881818101', 0x4C4154544954554445203A20362231312737225323244F414C4F4E4749545544453A20313036223439273336224523244F414D534953444E203A2036323838383138353330303523244F4154494D452044415445203A20323032302D30382D30352031333A31303A323123244F414C4F434154494F4E20494E464F203A20536D61727420536162616E67204F6666696365205B48532D335D5F53505248554223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31383533362C3130362E3832363638, 1, 1, '0', '5f2a4d4cde8819_mt', '53031415061124897', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (731, '2020-08-05 13:10:49', '628881853005', '628881818101', 0x43705F3038383831383533373036, 0, 1, '0', '5f2a4d69494954', '53031443427285857', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (732, '2020-08-05 13:10:49', '628881853005', '628881818101', 0x4C4154544954554445203A20362231312737225323244F414C4F4E4749545544453A20313036223439273336224523244F414D534953444E203A2036323838383138353337303623244F4154494D452044415445203A20323032302D30382D30352031333A31303A343923244F414C4F434154494F4E20494E464F203A20536D61727420536162616E67204F6666696365205B48532D335D5F53505248554223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31383533362C3130362E3832363638, 1, 1, '0', '5f2a4d69494954_mt', '53031443427285857', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (733, '2020-08-05 14:10:54', '628881853005', '628881818101', 0x43705F3038383137323039353632, 0, 0, '5001', '5f2a5b7e294eb4', '53035048331800106', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (734, '2020-08-05 14:10:54', '628881853005', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283530303129, 1, 0, '5001', '5f2a5b7e294eb4_mt', '53035048331800106', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (735, '2020-08-05 15:31:33', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f2a6e64ce6288', '53039887057369883', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (736, '2020-08-05 15:31:33', '6288212086557', '628881818101', 0x4C4154544954554445203A20362238273230225323244F414C4F4E4749545544453A20313036223438273135224523244F414D534953444E203A203632383832313230383635353723244F4154494D452044415445203A20323032302D30382D30352031353A33313A333323244F414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f2a6e64ce6288_mt', '53039887057369883', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (737, '2020-08-05 19:09:48', '628881853005', '628881818101', 0x43705F3038383135313330323839, 0, 1, '0', '5f2aa18c2a1b80', '53052982339541618', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (738, '2020-08-05 19:09:48', '628881853005', '628881818101', 0x4C4154544954554445203A20362235382735225323244F414C4F4E4749545544453A20313038223239273230224523244F414D534953444E203A2036323838313531333032383923244F4154494D452044415445203A20323032302D30362D32372030323A30313A333723244F414C4F434154494F4E20494E464F203A204D554C544946494E414E4345204B554E494E47414E23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E39363739382C3130382E3438383938, 1, 1, '0', '5f2aa18c2a1b80_mt', '53052982339541618', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (739, '2020-08-06 20:59:13', '628881853005', '628881818101', 0x43705F3038383135313330323839, 0, 1, '0', '5f2c0cb18fe986', '53145947795980888', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (740, '2020-08-06 20:59:13', '628881853005', '628881818101', 0x4C4154544954554445203A20362235382735225323244F414C4F4E4749545544453A20313038223239273230224523244F414D534953444E203A2036323838313531333032383923244F4154494D452044415445203A20323032302D30362D32372030323A30313A333723244F414C4F434154494F4E20494E464F203A204D554C544946494E414E4345204B554E494E47414E23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E39363739382C3130382E3438383938, 1, 1, '0', '5f2c0cb18fe986_mt', '53145947795980888', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (741, '2020-08-07 13:58:52', '6287722181388', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f2cfbabde12d7', '53207126101956522', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (742, '2020-08-07 13:58:52', '6287722181388', '628881818101', 0x4C4154544954554445203A20362238273230225323244F414C4F4E4749545544453A20313036223438273135224523244F414D534953444E203A203632383832313230383635353723244F4154494D452044415445203A20323032302D30382D30352031353A33313A333323244F414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f2cfbabde12d7_mt', '53207126101956522', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (743, '2020-08-07 14:09:52', '6287722181388', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '1000', '5f2cfe40682851', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (744, '2020-08-07 14:09:52', '6287722181388', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f2cfe40682851_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (745, '2020-08-07 15:08:08', '628979540616', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '1000', '5f2d0be8197bb4', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (746, '2020-08-07 15:08:08', '628979540616', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f2d0be8197bb4_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (747, '2020-08-07 15:08:41', '628979540616', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '1000', '5f2d0c0963a820', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (748, '2020-08-07 15:08:41', '628979540616', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f2d0c0963a820_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (749, '2020-08-07 15:09:48', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '1000', '5f2d0c4c726814', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (750, '2020-08-07 15:09:48', '6285894994832', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f2d0c4c726814_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (751, '2020-08-07 15:11:00', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '1000', '5f2d0c94b2e933', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (752, '2020-08-07 15:11:00', '6285894994832', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f2d0c94b2e933_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (753, '2020-08-07 15:11:04', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '1000', '5f2d0c97eda449', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (754, '2020-08-07 15:11:04', '6285894994832', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f2d0c97eda449_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (755, '2020-08-07 15:18:47', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '1000', '5f2d0e67491378', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (756, '2020-08-07 15:18:47', '6285894994832', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f2d0e67491378_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (757, '2020-08-07 15:33:24', '628979540616', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '1000', '5f2d11d4d7daa6', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (758, '2020-08-07 15:33:24', '628979540616', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f2d11d4d7daa6_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (759, '2020-08-07 16:50:11', '628881853005', '628881818101', 0x43705F3038383831383533303035, 0, 1, '0', '5f2d23d2f25407', '53217405141885745', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (760, '2020-08-07 16:50:11', '628881853005', '628881818101', 0x4C4154544954554445203A20362231312737225323244F414C4F4E4749545544453A20313036223439273336224523244F414D534953444E203A2036323838383138353330303523244F4154494D452044415445203A20323032302D30382D30372031363A35303A313123244F414C4F434154494F4E20494E464F203A20536D61727420536162616E67204F6666696365205B48532D335D5F53505248554223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31383533362C3130362E3832363638, 1, 1, '0', '5f2d23d2f25407_mt', '53217405141885745', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (761, '2020-08-10 12:15:06', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '1000', '5f30d7da730b90', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (762, '2020-08-10 12:15:06', '6285894994832', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f30d7da730b90_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (763, '2020-08-10 12:34:27', '6285214114010', '628881818101', 0x43705F363238383831383532333830, 0, 0, '1000', '5f30dc6394db31', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (764, '2020-08-10 12:34:27', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f30dc6394db31_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (765, '2020-08-10 12:36:34', '6285214114010', '628881818101', 0x43705F363238383831383532333830, 0, 0, '1000', '5f30dce2c806c1', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (766, '2020-08-10 12:36:34', '6285214114010', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f30dce2c806c1_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (767, '2020-08-10 12:43:30', '6285894994832', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '1000', '5f30de82039657', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (768, '2020-08-10 12:43:30', '6285894994832', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f30de82039657_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (769, '2020-08-10 13:47:58', '628881853005', '628881818101', 0x43705F303838323132303735303033, 0, 0, '4201', '5f30ed9e8daf12', '53465672743631732', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (770, '2020-08-10 13:47:58', '628881853005', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '4201', '5f30ed9e8daf12_mt', '53465672743631732', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (771, '2020-08-10 13:54:35', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f30ef2b474951', '53466069443063380', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (772, '2020-08-10 13:54:35', '6288212086557', '628881818101', 0x4C4154544954554445203A20362238273230225323244F414C4F4E4749545544453A20313036223438273135224523244F414D534953444E203A203632383832313230383635353723244F4154494D452044415445203A20323032302D30382D30352031353A33313A333323244F414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f30ef2b474951_mt', '53466069443063380', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (773, '2020-08-10 16:04:57', '628881852033', '628881818101', 0x63705F363238383138383832303038, 0, 0, '1003', '5f310db76dc418', '53473889636361895', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (774, '2020-08-10 16:04:57', '628881852033', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5f310db76dc418_mt', '53473889636361895', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (775, '2020-08-10 16:06:12', '628881852008', '628881818101', 0x63705F3038383138383832303038, 0, 0, '1003', '5f310e0266f733', '53473964559321366', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (776, '2020-08-10 16:06:12', '628881852008', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5f310e0266f733_mt', '53473964559321366', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (777, '2020-08-10 16:11:11', '628881852033', '628881818101', 0x43705F363238383131323130313931, 0, 1, '0', '5f310f2f1ebe02', '53474265265949358', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (778, '2020-08-10 16:11:11', '628881852033', '628881818101', 0x4C4154544954554445203A2036223137273433225323244F414C4F4E4749545544453A20313036223430273136224523244F414D534953444E203A2036323838313132313031393123244F4154494D452044415445203A20323032302D30382D31302031363A31313A313123244F414C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D55706772616465205444442028352923244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32393533382C3130362E3637313132, 1, 1, '0', '5f310f2f1ebe02_mt', '53474265265949358', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (779, '2020-08-10 16:19:20', '628881852008', '628881818101', 0x63705F3038383838313330333635, 0, 0, '1003', '5f3111175e5ea1', '53474753532462949', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (780, '2020-08-10 16:19:20', '628881852008', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5f3111175e5ea1_mt', '53474753532462949', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (781, '2020-08-10 16:20:29', '628881852008', '628881818101', 0x63705F3038383831383533323732, 0, 1, '0', '5f31115bd411e7', '53474822024946108', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (782, '2020-08-10 16:20:29', '628881852008', '628881818101', 0x4C4154544954554445203A20362231362739224E23244F414C4F4E4749545544453A20313036223430273136224523244F414D534953444E203A2036323838383138353332373223244F4154494D452044415445203A20323032302D30382D31302031363A32303A323923244F414C4F434154494F4E20494E464F203A204D53432042756D6920536572706F6E672044616D61692D55706772616465205444442028352923244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D362E32363931362C3130362E3637313132, 1, 1, '0', '5f31115bd411e7_mt', '53474822024946108', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (783, '2020-08-10 16:22:28', '628881852008', '628881818101', 0x63705F3038383131363531313131, 0, 1, '0', '5f3111d43c3e65', '53474942400701258', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (784, '2020-08-10 16:22:28', '628881852008', '628881818101', 0x4C4154544954554445203A2036223134273132225323244F414C4F4E4749545544453A20313036223437273536224523244F414D534953444E203A2036323838313136353131313123244F4154494D452044415445203A20323032302D30382D31302031363A32323A323823244F414C4F434154494F4E20494E464F203A204A6C2E536973696E67616D616E676172616A6123244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32333636392C3130362E3739383939, 1, 1, '0', '5f3111d43c3e65_mt', '53474942400701258', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (785, '2020-08-11 11:46:59', '628881853005', '628881818101', 0x43705F3038383137323039353632, 0, 0, '5001', '5f3222c38f74c1', '53544813759437257', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (786, '2020-08-11 11:46:59', '628881853005', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283530303129, 1, 0, '5001', '5f3222c38f74c1_mt', '53544813759437257', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (787, '2020-08-11 11:47:30', '628881853005', '628881818101', 0x43705F3038383131373531363834, 0, 0, '5001', '5f3222e1ebf4f5', '53544844116920772', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (788, '2020-08-11 11:47:30', '628881853005', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283530303129, 1, 0, '5001', '5f3222e1ebf4f5_mt', '53544844116920772', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (789, '2020-08-11 13:32:18', '628881853005', '628881818101', 0x43705F303838323338373333343331, 0, 0, '4201', '5f323b723c7e21', '53551132420777385', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (790, '2020-08-11 13:32:18', '628881853005', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '4201', '5f323b723c7e21_mt', '53551132420777385', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (791, '2020-08-11 13:32:58', '628881853005', '628881818101', 0x43705F3038383831383533303035, 0, 0, '-3001', '5f323b95931d77', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (792, '2020-08-11 13:32:58', '628881853005', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f323b95931d77_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (793, '2020-08-11 16:28:07', '628881853005', '628881818101', 0x43705F3038383831383533303035, 0, 0, '-3001', '5f3264a24cfd03', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (794, '2020-08-11 16:28:07', '628881853005', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f3264a24cfd03_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (795, '2020-08-11 16:31:20', '628881853005', '628881818101', 0x43705F363238383831383533303035, 0, 0, '-3001', '5f326563540526', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (796, '2020-08-11 16:31:20', '628881853005', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f326563540526_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (797, '2020-08-11 16:31:42', '628881853005', '628881818101', 0x43705F2B363238383831383533303035, 0, 0, 'ERR_018', '5f32657e58c3a1', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (798, '2020-08-11 16:31:42', '628881853005', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f32657e58c3a1_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (799, '2020-08-11 16:38:09', '628881853005', '628881818101', 0x43705F3038383831383533373036, 0, 1, '0', '5f326700a48296', '53562282812302305', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (800, '2020-08-11 16:38:09', '628881853005', '628881818101', 0x4C4154544954554445203A20362231312737225323244F414C4F4E4749545544453A20313036223439273336224523244F414D534953444E203A2036323838383138353337303623244F4154494D452044415445203A20323032302D30382D31312031363A33383A303923244F414C4F434154494F4E20494E464F203A20536D61727420536162616E67204F6666696365205B48532D335D5F53505248554223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31383533362C3130362E3832363638, 1, 1, '0', '5f326700a48296_mt', '53562282812302305', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (801, '2020-08-11 16:39:02', '628881853005', '628881818101', 0x43705F2B363238383831383532303333, 0, 0, 'ERR_018', '5f32673623f024', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (802, '2020-08-11 16:39:02', '628881853005', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20284552525F30313829, 1, 0, 'ERR_018', '5f32673623f024_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (803, '2020-08-11 16:39:34', '628881853005', '628881818101', 0x43705F3038383831383532303333, 0, 1, '0', '5f3267566588d2', '53562368558978522', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (804, '2020-08-11 16:39:34', '628881853005', '628881818101', 0x4C4154544954554445203A2036223134273235225323244F414C4F4E4749545544453A203130362234342733224523244F414D534953444E203A2036323838383138353230333323244F4154494D452044415445203A20323032302D30382D31312031363A33393A333423244F414C4F434154494F4E20494E464F203A20436970616475205B48532D335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32343032342C3130362E3733343239, 1, 1, '0', '5f3267566588d2_mt', '53562368558978522', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (805, '2020-08-11 16:40:13', '628881853272', '628881818101', 0x63705F3038383831383533303035, 0, 0, '-3001', '5f32677860b543', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (806, '2020-08-11 16:40:13', '628881853272', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f32677860b543_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (807, '2020-08-11 16:40:27', '628881853005', '628881818101', 0x43705F303838323935333337353536, 0, 1, '0', '5f32678abdec41', '53562420922198459', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (808, '2020-08-11 16:40:27', '628881853005', '628881818101', 0x4C4154544954554445203A2036223137273230225323244F414C4F4E4749545544453A20313036223439273239224523244F414D534953444E203A203632383832393533333735353623244F4154494D452044415445203A20323032302D30382D31312031363A34303A323723244F414C4F434154494F4E20494E464F203A204A61746920506164616E672D3030322065782050656E6A6172696E67616E2D30303223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32383839392C3130362E3832343637, 1, 1, '0', '5f32678abdec41_mt', '53562420922198459', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (809, '2020-08-11 16:44:41', '628881853005', '628881818101', 0x43705F36323838323935333337353536, 0, 1, '0', '5f3268882af190', '53562674303656381', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (810, '2020-08-11 16:44:41', '628881853005', '628881818101', 0x4C4154544954554445203A2036223137273230225323244F414C4F4E4749545544453A20313036223439273239224523244F414D534953444E203A203632383832393533333735353623244F4154494D452044415445203A20323032302D30382D31312031363A34343A343123244F414C4F434154494F4E20494E464F203A204A61746920506164616E672D3030322065782050656E6A6172696E67616E2D30303223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32383839392C3130362E3832343637, 1, 1, '0', '5f3268882af190_mt', '53562674303656381', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (811, '2020-08-11 16:45:45', '628881853005', '628881818101', 0x43705F36323838383039393338363236, 0, 1, '0', '5f3268c9860533', '53562739675830069', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (812, '2020-08-11 16:45:45', '628881853005', '628881818101', 0x4C4154544954554445203A2036223137273230225323244F414C4F4E4749545544453A20313036223439273239224523244F414D534953444E203A203632383838303939333836323623244F4154494D452044415445203A20323032302D30382D31312031363A34353A343523244F414C4F434154494F4E20494E464F203A204A61746920506164616E672D3030322065782050656E6A6172696E67616E2D30303223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32383839392C3130362E3832343637, 1, 1, '0', '5f3268c9860533_mt', '53562739675830069', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (813, '2020-08-11 17:36:45', '6287722181388', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '1000', '5f3274bcf38e46', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (814, '2020-08-11 17:36:45', '6287722181388', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f3274bcf38e46_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (815, '2020-08-11 17:44:43', '6287722181388', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '1000', '5f32769b5f6529', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (816, '2020-08-11 17:44:43', '6287722181388', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f32769b5f6529_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (817, '2020-08-11 17:51:40', '628979540616', '628881818101', 0x63705F36323838323132303836353537, 0, 0, '1000', '5f32783c049f75', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (818, '2020-08-11 17:51:40', '628979540616', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303029, 1, 0, '1000', '5f32783c049f75_mt', '0', NULL);
INSERT INTO `tbl_aph_transaction_history` VALUES (819, '2020-08-11 18:08:43', '628881852033', '628881818101', 0x43705F363238383131323130313931, 0, 1, '0', '5f327c3a26b921', '53567716351734833', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (820, '2020-08-11 18:08:43', '628881852033', '628881818101', 0x4C4154544954554445203A2036223137273337225323244F414C4F4E4749545544453A203130372231273136224523244F414D534953444E203A2036323838313132313031393123244F4154494D452044415445203A20323032302D30382D31312031383A30383A343323244F414C4F434154494F4E20494E464F203A204B616D70756E67204A617469203223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E323933363332352C3130372E303231323235, 1, 1, '0', '5f327c3a26b921_mt', '53567716351734833', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (821, '2020-08-13 04:43:03', '628881853005', '628881818101', 0x43705F303838323931343634323138, 0, 1, '0', '5f346266087d00', '53692176308776677', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (822, '2020-08-13 04:43:03', '628881853005', '628881818101', 0x4C4154544954554445203A2036223132273234225323244F414C4F4E4749545544453A203130362234372735224523244F414D534953444E203A203632383832393134363432313823244F4154494D452044415445203A20323032302D30382D31332030343A34333A303323244F414C4F434154494F4E20494E464F203A20524157412042454C4F4E47204B4F535432414E20535553414E4F2052554D4C4923244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32303636332C3130362E3738343836, 1, 1, '0', '5f346266087d00_mt', '53692176308776677', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (823, '2020-08-14 05:36:05', '628881853005', '628881818101', 0x43705F3038383831383533303035, 0, 0, '-3001', '5f35c05038c605', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (824, '2020-08-14 05:36:05', '628881853005', '628881818101', 0x4D6161662C204D444E20746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f35c05038c605_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (825, '2020-08-14 05:37:23', '628881853005', '628881818101', 0x43705F303838383039393338363236, 0, 1, '0', '5f35c0a33dbba6', '53781837410942959', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (826, '2020-08-14 05:37:23', '628881853005', '628881818101', 0x4C4154544954554445203A2036223137273230225323244F414C4F4E4749545544453A20313036223439273239224523244F414D534953444E203A203632383838303939333836323623244F4154494D452044415445203A20323032302D30382D31312031363A34353A343523244F414C4F434154494F4E20494E464F203A204A61746920506164616E672D3030322065782050656E6A6172696E67616E2D30303223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32383839392C3130362E3832343637, 1, 1, '0', '5f35c0a33dbba6_mt', '53781837410942959', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (827, '2020-08-14 05:38:35', '628881853005', '628881818101', 0x43705F303838323935333337353536, 0, 1, '0', '5f35c0eb943099', '53781909753888374', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (828, '2020-08-14 05:38:35', '628881853005', '628881818101', 0x4C4154544954554445203A2036223137273230225323244F414C4F4E4749545544453A20313036223439273239224523244F414D534953444E203A203632383832393533333735353623244F4154494D452044415445203A20323032302D30382D31342030353A33383A333523244F414C4F434154494F4E20494E464F203A204A61746920506164616E672D3030322065782050656E6A6172696E67616E2D30303223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32383839392C3130362E3832343637, 1, 1, '0', '5f35c0eb943099_mt', '53781909753888374', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (829, '2020-08-14 05:42:07', '628881853005', '628881818101', 0x43705F3038383831383533303035, 0, 0, '-3001', '5f35c1b9f33550', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (830, '2020-08-14 05:42:07', '628881853005', '628881818101', 0x4D6161662C204D444E20746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f35c1b9f33550_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (831, '2020-08-14 05:46:21', '628881852033', '628881818101', 0x43705F363238383831383532303333, 0, 1, '0', '5f35c2bca4cbc8', '53782374814369262', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (832, '2020-08-14 05:46:21', '628881852033', '628881818101', 0x4C4154544954554445203A2036223139273132225323244F414C4F4E4749545544453A20313036223435273330224523244F414D534953444E203A2036323838383138353230333323244F4154494D452044415445203A20323032302D30382D31342030353A34363A323123244F414C4F434154494F4E20494E464F203A204B616D702E204C65676F736F2D506973616E67616E23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E333230313332372C3130362E37353833, 1, 1, '0', '5f35c2bca4cbc8_mt', '53782374814369262', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (833, '2020-08-14 13:44:14', '6288212086557', '628881818101', 0x63705F363238383831383533303035, 0, 1, '0', '5f3632bcdaa604', '53811047062940906', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (834, '2020-08-14 13:44:14', '6288212086557', '628881818101', 0x4C4154544954554445203A20362231312737225323244F414C4F4E4749545544453A20313036223439273336224523244F414D534953444E203A2036323838383138353330303523244F4154494D452044415445203A20323032302D30382D31342031333A34343A313423244F414C4F434154494F4E20494E464F203A20536D61727420536162616E67204F6666696365205B48532D335D5F53505248554223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31383533362C3130362E3832363638, 1, 1, '0', '5f3632bcdaa604_mt', '53811047062940906', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (835, '2020-08-14 13:44:58', '6288212086557', '628881818101', 0x63705F3038383831383533303035, 0, 1, '0', '5f3632e9ec2d08', '53811092109273384', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (836, '2020-08-14 13:44:58', '6288212086557', '628881818101', 0x4C4154544954554445203A20362231312737225323244F414C4F4E4749545544453A20313036223439273336224523244F414D534953444E203A2036323838383138353330303523244F4154494D452044415445203A20323032302D30382D31342031333A34343A353823244F414C4F434154494F4E20494E464F203A20536D61727420536162616E67204F6666696365205B48532D335D5F53505248554223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E31383533362C3130362E3832363638, 1, 1, '0', '5f3632e9ec2d08_mt', '53811092109273384', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (837, '2020-08-14 16:12:51', '6288291464218', '628881818101', 0x43705F303838323931343634323138, 0, 0, '-3001', '5f36558e6244d1', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (838, '2020-08-14 16:12:51', '6288291464218', '628881818101', 0x4D6161662C204D444E20746964616B2064692074656D756B616E2E2E, 1, 0, '-3001', '5f36558e6244d1_mt', '', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (839, '2020-08-14 16:13:08', '6288291464218', '628881818101', 0x43705F363238383138383634343135, 0, 0, '4201', '5f3655a462ed51', '53819982547146693', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (840, '2020-08-14 16:13:08', '6288291464218', '628881818101', 0x4D6161662C204D444E20746964616B2064692074656D756B616E2E2E, 1, 0, '4201', '5f3655a462ed51_mt', '53819982547146693', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (841, '2020-08-14 16:13:43', '6288291464218', '628881818101', 0x43705F303838323931343634323138, 0, 1, '0', '5f3655c5ac4f08', '53820015839923407', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (842, '2020-08-14 16:13:43', '6288291464218', '628881818101', 0x4C4154544954554445203A2036223136273137225323244F414C4F4E4749545544453A20313036223438273536224523244F414D534953444E203A203632383832393134363432313823244F4154494D452044415445203A20323032302D30382D31342031363A31333A343323244F414C4F434154494F4E20494E464F203A20476564756E67204172746566616B23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32373133362C3130362E3831353533, 1, 1, '0', '5f3655c5ac4f08_mt', '53820015839923407', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (843, '2020-08-15 09:15:44', '6288297883262', '628881818101', 0x43705F303838323937383833323632, 0, 1, '0', '5f374550581789', '53881338541525413', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (844, '2020-08-15 09:15:44', '6288297883262', '628881818101', 0x4C4154544954554445203A2036223133273431225323244F414C4F4E4749545544453A203130362235352737224523244F414D534953444E203A203632383832393738383332363223244F4154494D452044415445203A20323032302D30382D31352030393A31353A343423244F414C4F434154494F4E20494E464F203A204A4B545F3831205B48532D315F325D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32323831322C3130362E3931383638, 1, 1, '0', '5f374550581789_mt', '53881338541525413', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (845, '2020-08-15 18:29:41', '6288297883263', '628881818101', 0x43705F303838323937383833323633, 0, 1, '0', '5f37c724eb27e9', '53914575136327730', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (846, '2020-08-15 18:29:41', '6288297883263', '628881818101', 0x4C4154544954554445203A2036223133273231225323244F414C4F4E4749545544453A203130362235352739224523244F414D534953444E203A203632383832393738383332363323244F4154494D452044415445203A20323032302D30382D31352031383A32393A343123244F414C4F434154494F4E20494E464F203A204A4B545F3831205B48532D315F325D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E323232333731362C3130362E3931393236, 1, 1, '0', '5f37c724eb27e9_mt', '53914575136327730', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (847, '2020-08-15 20:31:18', '6288297883263', '628881818101', 0x43705F303838323937383833323633, 0, 0, '1003', '5f37e3a69b60e9', '53921872801844562', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (848, '2020-08-15 20:31:18', '6288297883263', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5f37e3a69b60e9_mt', '53921872801844562', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (849, '2020-08-15 20:31:54', '6288297883263', '628881818101', 0x43705F303838323937383833323633, 0, 0, '1003', '5f37e3ca0c9727', '53921908185306613', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (850, '2020-08-15 20:31:54', '6288297883263', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283130303329, 1, 0, '1003', '5f37e3ca0c9727_mt', '53921908185306613', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (851, '2020-08-15 20:54:23', '6288297883263', '628881818101', 0x43705F303838323937383833323633, 0, 1, '0', '5f37e90e9c9252', '53923256796612042', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (852, '2020-08-15 20:54:23', '6288297883263', '628881818101', 0x4C4154544954554445203A2036223133273131225323244F414C4F4E4749545544453A20313036223534273534224523244F414D534953444E203A203632383832393738383332363323244F4154494D452044415445203A20323032302D30382D31352032303A35343A323323244F414C4F434154494F4E20494E464F203A20526B20447572656E205361776974204B6C656E646572205B48532D315D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E323139363033352C3130362E3931343936, 1, 1, '0', '5f37e90e9c9252_mt', '53923256796612042', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (853, '2020-08-16 20:09:53', '6288297883262', '628881818101', 0x43705F303838323937383833323632, 0, 1, '0', '5f39302069f333', '54006986597690851', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (854, '2020-08-16 20:09:53', '6288297883262', '628881818101', 0x4C4154544954554445203A2036223133273136225323244F414C4F4E4749545544453A20313036223534273339224523244F414D534953444E203A203632383832393738383332363223244F4154494D452044415445203A20323032302D30382D31362032303A30393A353323244F414C4F434154494F4E20494E464F203A205975646973746972612044535223244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E32323131352C3130362E3931303835, 1, 1, '0', '5f39302069f333_mt', '54006986597690851', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (855, '2020-08-17 13:30:45', '6288291464218', '628881818101', 0x43705F36323838383039333830373239, 0, 0, '4201', '5f3a2415a14059', '54069439837158389', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (856, '2020-08-17 13:30:45', '6288291464218', '628881818101', 0x4D6161662C204D444E20746964616B2064692074656D756B616E2E2E, 1, 0, '4201', '5f3a2415a14059_mt', '54069439837158389', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (857, '2020-08-17 22:03:56', '6288291464218', '628881818101', 0x43705F36323838383039333830373239, 0, 0, '4201', '5f3a9c5c8daee6', '54100230747468896', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (858, '2020-08-17 22:03:56', '6288291464218', '628881818101', 0x4D6161662C204D444E20746964616B2064692074656D756B616E2E2E, 1, 0, '4201', '5f3a9c5c8daee6_mt', '54100230747468896', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (859, '2020-08-18 09:15:48', '628881853005', '628881818101', 0x43705F303838323836313034373637, 0, 0, '4201', '5f3b39d481d5b9', '54140542723186470', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (860, '2020-08-18 09:15:48', '628881853005', '628881818101', 0x4D6161662C204D444E20746964616B2064692074656D756B616E2E2E, 1, 0, '4201', '5f3b39d481d5b9_mt', '54140542723186470', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (861, '2020-08-18 09:17:12', '628881853005', '628881818101', 0x43705F3038383238363230343736, 0, 0, '5001', '5f3b3a27dff598', '54140626056134086', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (862, '2020-08-18 09:17:12', '628881853005', '628881818101', 0x4D6161662C204461746120746964616B2064692074656D756B616E20283530303129, 1, 0, '5001', '5f3b3a27dff598_mt', '54140626056134086', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (863, '2020-08-18 09:17:56', '628881853005', '628881818101', 0x43705F303838323836313034373637, 0, 0, '4201', '5f3b3a5438f892', '54140670362982279', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (864, '2020-08-18 09:17:56', '628881853005', '628881818101', 0x4D6161662C204D444E20746964616B2064692074656D756B616E2E2E, 1, 0, '4201', '5f3b3a5438f892_mt', '54140670362982279', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (865, '2020-08-18 13:02:10', '6288212086557', '628881818101', 0x63705F36323838323132303836353537, 0, 1, '0', '5f3b6ee1cfd5e1', '54154124060304702', 7);
INSERT INTO `tbl_aph_transaction_history` VALUES (866, '2020-08-18 13:02:10', '6288212086557', '628881818101', 0x4C4154544954554445203A20362238273230225323244F414C4F4E4749545544453A20313036223438273135224523244F414D534953444E203A203632383832313230383635353723244F4154494D452044415445203A20323032302D30382D31382031333A30323A313023244F414C4F434154494F4E20494E464F203A2042616E64656E67616E2053656C6174616E205B48532D315F335D23244F4155524C3A2068747470733A2F2F7777772E676F6F676C652E636F6D2F6D6170732F7365617263682F3F6170693D312671756572793D2D362E3133393031392C3130362E3830343134, 1, 1, '0', '5f3b6ee1cfd5e1_mt', '54154124060304702', 7);

-- ----------------------------
-- Table structure for tbl_aph_transaction_history_old
-- ----------------------------
DROP TABLE IF EXISTS `tbl_aph_transaction_history_old`;
CREATE TABLE `tbl_aph_transaction_history_old`  (
  `event_datetime` datetime(0) NOT NULL,
  `mdn` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `shortcode` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `content` blob NOT NULL,
  `direction` int(2) NOT NULL COMMENT '0 mo, 1 mt',
  `status` int(2) NOT NULL COMMENT '0 failed, 1 success',
  `error_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `msg_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `api_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `aph_id` int(11) NOT NULL,
  UNIQUE INDEX `msg_id`(`msg_id`) USING BTREE,
  INDEX `event_datetime`(`event_datetime`) USING BTREE,
  INDEX `mdn`(`mdn`) USING BTREE,
  INDEX `shortcode`(`shortcode`) USING BTREE,
  INDEX `direction`(`direction`) USING BTREE,
  INDEX `status`(`status`) USING BTREE,
  INDEX `msg_id2`(`msg_id`) USING BTREE,
  INDEX `api_id`(`api_id`) USING BTREE,
  INDEX `aph_id`(`aph_id`) USING BTREE,
  CONSTRAINT `tbl_aph_transaction_history_old_ibfk_1` FOREIGN KEY (`aph_id`) REFERENCES `tbl_aph` (`ta_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_err_code_sms
-- ----------------------------
DROP TABLE IF EXISTS `tbl_err_code_sms`;
CREATE TABLE `tbl_err_code_sms`  (
  `tecs_id` int(11) NOT NULL AUTO_INCREMENT,
  `tecs_err_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '0 : success\n			\r\n-1 : error default selain yg didefinisikan\n			1-xxxxxx : error code yg didefinisikan',
  `tecs_sms_template` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `first_user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `first_ip` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `first_update` datetime(0) NULL DEFAULT NULL,
  `last_user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `last_ip` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `last_update` datetime(0) NULL DEFAULT NULL,
  `tecs_aph_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`tecs_id`) USING BTREE,
  INDEX `tecs_aph_id`(`tecs_aph_id`) USING BTREE,
  INDEX `tecs_err_code`(`tecs_err_code`) USING BTREE,
  INDEX `tecs_sms_template`(`tecs_sms_template`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 118 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_err_code_sms
-- ----------------------------
INSERT INTO `tbl_err_code_sms` VALUES (7, 'ERR_001', 'Maaf, Data tidak di temukan (ERR_001)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (8, 'ERR_002', 'Maaf, Data tidak di temukan (ERR_002)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (9, 'ERR_003', 'Maaf, Data tidak di temukan (ERR_003)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (10, 'ERR_004', 'Maaf, Data tidak di temukan (ERR_004)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (11, 'ERR_005', 'Maaf, Data tidak di temukan (ERR_005)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (12, 'ERR_006', 'Maaf, Data tidak di temukan (ERR_006)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (13, 'ERR_007', 'Maaf, Data tidak di temukan (ERR_007)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (14, 'ERR_008', 'Maaf, Data tidak di temukan (ERR_008)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (15, 'ERR_009', 'Maaf, Data tidak di temukan (ERR_009)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (16, 'ERR_010', 'Maaf, Data tidak di temukan (ERR_010)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (17, 'ERR_011', 'Maaf, Data tidak di temukan (ERR_011)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (18, 'ERR_012', 'Maaf, Data tidak di temukan (ERR_012)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (19, 'ERR_013', 'Maaf, Data tidak di temukan (ERR_013)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (20, 'ERR_014', 'Maaf, Data tidak di temukan (ERR_014)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (21, 'ERR_015', 'Maaf, Data tidak di temukan (ERR_015)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (22, 'ERR_016', 'Maaf, Data tidak di temukan (ERR_016)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (23, 'ERR_017', 'Maaf, Data tidak di temukan (ERR_017)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (24, 'ERR_018', 'Maaf, Data tidak di temukan (ERR_018)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (25, 'ERR_019', 'Maaf, Data tidak di temukan (ERR_019)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (26, 'ERR_020', 'Maaf, Data tidak di temukan (ERR_020)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (27, 'ERR_021', 'Maaf, Data tidak di temukan (ERR_021)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (28, 'ERR_022', 'Maaf, Data tidak di temukan (ERR_022)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (29, 'ERR_INTERNAL_PARAM', 'Maaf, Data tidak di temukan (ERR_INTERNAL_PARAM)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (30, 'TRUE', 'Maaf, Data tidak di temukan (TRUE)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (31, 'FALSE', 'Maaf, Data tidak di temukan (FALSE)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (32, '-1', 'Maaf, Data tidak di temukan (-1)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (33, '1', 'Maaf, Data tidak di temukan (1)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (34, '2', 'Maaf, Data tidak di temukan (2)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (35, '3', 'Maaf, Data tidak di temukan (3)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (36, '1001', 'Maaf, Data tidak di temukan (1001)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (37, '2002', 'Maaf, Data tidak di temukan (2002)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (38, '2003', 'Maaf, Data tidak di temukan (2003)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (39, '2004', 'Maaf, Data tidak di temukan (2004)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (40, '2005', 'Maaf, Data tidak di temukan (2005)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (41, '2006', 'Maaf, Data tidak di temukan (2006)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (42, '2007', 'Maaf, Data tidak di temukan (2007)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (43, '2008', 'Maaf, Data tidak di temukan (2008)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (44, '2009', 'Maaf, Data tidak di temukan (2009)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (45, '3001', 'Maaf, Data tidak di temukan (3001)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (46, '3002', 'Maaf, Data tidak di temukan (3002)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (47, '3003', 'Maaf, Data tidak di temukan (3003)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (48, '3004', 'Maaf, Data tidak di temukan (3004)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (49, '3005', 'Maaf, Data tidak di temukan (3005)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (50, '3006', 'Maaf, Data tidak di temukan (3006)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (51, '3007', 'Maaf, Data tidak di temukan (3007)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (52, '3008', 'Maaf, Data tidak di temukan (3008)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (53, '3009', 'Maaf, Data tidak di temukan (3009)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (54, '3010', 'Maaf, Data tidak di temukan (3010)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (55, '4001', 'Maaf, Data tidak di temukan (4001)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (56, '4002', 'Maaf, Data tidak di temukan (4002)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (57, '4003', 'Maaf, Data tidak di temukan (4003)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (58, '4005', 'Maaf, Data tidak di temukan (4005)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (59, '4006', 'Maaf, Data tidak di temukan (4006)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (60, '4007', 'Maaf, Data tidak di temukan (4007)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (61, '4008', 'Maaf, Data tidak di temukan (4008)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (62, '4010', 'Maaf, Data tidak di temukan (4010)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (63, '4011', 'Maaf, Data tidak di temukan (4011)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (64, '4012', 'Maaf, Data tidak di temukan (4012)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (65, '4013', 'Maaf, Data tidak di temukan (4013)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (66, '4221', 'Maaf, Data tidak di temukan (4221)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (67, '4222', 'Maaf, Data tidak di temukan (4222)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (68, '4223', 'Maaf, Data tidak di temukan (4223)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (69, '4224', 'Maaf, Data tidak di temukan (4224)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (70, '4225', 'Maaf, Data tidak di temukan (4225)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (71, '4226', 'Maaf, Data tidak di temukan (4226)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (72, '5001', 'Maaf, Data tidak di temukan (5001)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (73, '5002', 'Maaf, Data tidak di temukan (5002)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (74, '5003', 'Maaf, Data tidak di temukan (5003)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (75, '5004', 'Maaf, Data tidak di temukan (5004)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (76, '5005', 'Maaf, Data tidak di temukan (5005)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (77, '5006', 'Maaf, Data tidak di temukan (5006)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (78, '5007', 'Maaf, Data tidak di temukan (5007)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (79, '5008', 'Maaf, Data tidak di temukan (5008)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (80, '5009', 'Maaf, Data tidak di temukan (5009)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (81, '5010', 'Maaf, Data tidak di temukan (5010)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (82, '5011', 'Maaf, Data tidak di temukan (5011)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (83, '5012', 'Maaf, Data tidak di temukan (5012)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (84, '5013', 'Maaf, Data tidak di temukan (5013)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (85, '5014', 'Maaf, Data tidak di temukan (5014)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (86, '5015', 'Maaf, Data tidak di temukan (5015)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (87, '5016', 'Maaf, Data tidak di temukan (5016)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (88, '5017', 'Maaf, Data tidak di temukan (5017)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (89, '5018', 'Maaf, Data tidak di temukan (5018)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (90, '5024', 'Maaf, Data tidak di temukan (5024)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (91, '5025', 'Maaf, Data tidak di temukan (5025)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (92, '5030', 'Maaf, Data tidak di temukan (5030)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (93, '5031', 'Maaf, Data tidak di temukan (5031)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (94, '5032', 'Maaf, Data tidak di temukan (5032)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (95, '5033', 'Maaf, Data tidak di temukan (5033)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (96, '5034', 'Maaf, Data tidak di temukan (5034)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (97, '5035', 'Maaf, Data tidak di temukan (5035)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (98, '5036', 'Maaf, Data tidak di temukan (5036)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (99, '5037', 'Maaf, Data tidak di temukan (5037)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (100, '5038', 'Maaf, Data tidak di temukan (5038)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (101, '5039', 'Maaf, Data tidak di temukan (5039)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (102, '5040', 'Maaf, Data tidak di temukan (5040)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (103, '5041', 'Maaf, Data tidak di temukan (5041)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (104, '4241', 'Maaf, Data tidak di temukan (4241)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (105, '5241', 'Maaf, Data tidak di temukan (5241)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (106, '0', 'LATTITUDE : {{lat}}#$OALONGITUDE: {{long}}#$OAMSISDN : {{mdn_tracking}}#$OATIME DATE : {{datetime}}#$OALOCATION INFO : {{location}}#$OAURL: https://www.google.com/maps/search/?api=1&query={{parameter}}', NULL, NULL, NULL, NULL, NULL, NULL, 7);
INSERT INTO `tbl_err_code_sms` VALUES (107, '1000', 'Maaf, Data tidak di temukan (1000)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (108, '1002', 'Maaf, Data tidak di temukan (1002)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (109, '1003', 'Maaf, Data tidak di temukan (1003)', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_err_code_sms` VALUES (110, '0', 'test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test1', NULL, NULL, NULL, NULL, NULL, NULL, 6);

-- ----------------------------
-- Table structure for tbl_json
-- ----------------------------
DROP TABLE IF EXISTS `tbl_json`;
CREATE TABLE `tbl_json`  (
  `tj_id` int(11) NOT NULL AUTO_INCREMENT,
  `tj_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tj_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tj_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_update` datetime(0) NULL DEFAULT NULL,
  `last_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_update` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`tj_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_json
-- ----------------------------
INSERT INTO `tbl_json` VALUES (2, 'APH Transaction Detail', 'APH Transaction Detail', 'APH Transaction Detail.json', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_json` VALUES (3, 'APH Transaction Daily', 'APH Transaction Daily', 'APH Transaction Daily.json', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_json` VALUES (4, 'Summary MO Daily', 'Summary MO Daily', 'Summary MO Daily.json', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_json` VALUES (5, 'Summary MO Hourly', 'Summary MO Hourly', 'Summary MO Hourly.json', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_json` VALUES (6, 'Summary MT Daily', 'Summary MT Daily', 'Summary MT Daily.json', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_json` VALUES (7, 'Summary MT Hourly', 'Summary MT Hourly', 'Summary MT Hourly.json', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tbl_mdn_whitelist
-- ----------------------------
DROP TABLE IF EXISTS `tbl_mdn_whitelist`;
CREATE TABLE `tbl_mdn_whitelist`  (
  `tmw_id` int(11) NOT NULL AUTO_INCREMENT,
  `tmw_aph_id` int(11) NOT NULL,
  `tmw_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tmw_mdn` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `first_user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `first_ip` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `first_update` datetime(0) NULL DEFAULT NULL,
  `last_user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `last_ip` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `last_update` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`tmw_id`) USING BTREE,
  INDEX `tmw_name`(`tmw_name`) USING BTREE,
  INDEX `tmw_mdn`(`tmw_mdn`) USING BTREE,
  INDEX `tmw_aph_id`(`tmw_aph_id`) USING BTREE,
  CONSTRAINT `tbl_mdn_whitelist_ibfk_1` FOREIGN KEY (`tmw_aph_id`) REFERENCES `tbl_aph` (`ta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 88 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_mdn_whitelist
-- ----------------------------
INSERT INTO `tbl_mdn_whitelist` VALUES (69, 7, 'test_1', '628881853005', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_mdn_whitelist` VALUES (70, 7, 'test_2', '628881852008', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_mdn_whitelist` VALUES (71, 7, 'test_3', '628881853272', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_mdn_whitelist` VALUES (73, 7, 'test_5', '628811210618', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_mdn_whitelist` VALUES (74, 7, 'Imam', '628881852045', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_mdn_whitelist` VALUES (75, 7, 'Fuad', '628881852033', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_mdn_whitelist` VALUES (81, 7, 'test', '6288212086557', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_mdn_whitelist` VALUES (85, 7, 'Den88', '6288291464218 ', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_mdn_whitelist` VALUES (86, 7, 'BNN01', '6288297883262', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_mdn_whitelist` VALUES (87, 7, 'BNN02', '6288297883263 ', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tbl_scheduler_status
-- ----------------------------
DROP TABLE IF EXISTS `tbl_scheduler_status`;
CREATE TABLE `tbl_scheduler_status`  (
  `description` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `scheduler_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `next_execute_time` datetime(0) NULL DEFAULT NULL,
  `status` tinyint(1) NULL DEFAULT NULL,
  `next_end_time` datetime(0) NULL DEFAULT NULL,
  `module_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `desc_view` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bypass_exec_id` int(11) NULL DEFAULT NULL,
  `last_exec_id` int(11) NULL DEFAULT NULL,
  `last_exec_time` datetime(0) NULL DEFAULT NULL,
  `last_exec_time_file` datetime(0) NULL DEFAULT NULL,
  `add_desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `process_active` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`description`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_scheduler_status
-- ----------------------------
INSERT INTO `tbl_scheduler_status` VALUES ('summary_tps', 'summary_tps', '2020-08-18 16:00:00', 0, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, '2020-08-18 15:00:02', NULL, NULL, 1);
INSERT INTO `tbl_scheduler_status` VALUES ('summary_mo', 'summary_mo', '2020-08-18 16:00:00', 0, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, '2020-08-18 15:00:02', NULL, NULL, 1);
INSERT INTO `tbl_scheduler_status` VALUES ('summary_mt', 'summary_mt', '2020-08-18 16:00:00', 0, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, '2020-08-18 15:00:02', NULL, NULL, 1);
INSERT INTO `tbl_scheduler_status` VALUES ('cdr_mo_mt_gmlc', 'cdr_mo_mt_gmlc', '2020-08-18 15:04:00', 0, '2020-06-10 00:00:00', NULL, NULL, NULL, NULL, '2020-08-18 15:03:01', NULL, NULL, 1);

-- ----------------------------
-- Table structure for tbl_summary_hourly_mo
-- ----------------------------
DROP TABLE IF EXISTS `tbl_summary_hourly_mo`;
CREATE TABLE `tbl_summary_hourly_mo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime(0) NULL DEFAULT NULL,
  `shortcode` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `aph_id` int(11) NULL DEFAULT NULL,
  `status` int(2) NULL DEFAULT NULL COMMENT '0 failed, 1 success',
  `error_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `total` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 171 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_summary_hourly_mo
-- ----------------------------
INSERT INTO `tbl_summary_hourly_mo` VALUES (1, '2020-06-03 16:00:00', '77100', 1, 0, 'ERR_INTERNAL_PARAM', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (2, '2020-06-03 16:00:00', '77100', 2, 0, 'ERR_INTERNAL_PARAM', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (3, '2020-06-03 17:00:00', '77100', 0, 0, '1000', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (4, '2020-06-03 17:00:00', '77100', 2, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (5, '2020-06-03 18:00:00', '77100', 2, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (6, '2020-06-04 11:00:00', '77100', 0, 0, '1000', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (7, '2020-06-04 11:00:00', '77100', 6, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mo` VALUES (8, '2020-06-04 12:00:00', '77100', 6, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (9, '2020-06-04 15:00:00', '77100', 0, 0, '1000', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (10, '2020-06-04 15:00:00', '77100', 6, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (11, '2020-06-04 18:00:00', '77100', 6, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mo` VALUES (12, '2020-06-04 18:00:00', '77100', 6, 0, 'ERR_001', 5);
INSERT INTO `tbl_summary_hourly_mo` VALUES (13, '2020-06-04 19:00:00', '77100', 6, 0, 'ERR_001', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (14, '2020-06-04 22:00:00', '77100', 6, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (15, '2020-06-04 22:00:00', '77100', 6, 0, 'ERR_001', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (16, '2020-06-05 01:00:00', '77100', 6, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (17, '2020-06-05 11:00:00', '77100', 6, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (18, '2020-06-05 14:00:00', '77100', 6, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (19, '2020-06-05 14:00:00', '77100', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (20, '2020-06-05 15:00:00', '77100', 6, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (21, '2020-06-05 15:00:00', '77100', 7, 1, '0', 7);
INSERT INTO `tbl_summary_hourly_mo` VALUES (22, '2020-06-05 23:00:00', '77100', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (23, '2020-06-08 17:00:00', '77100', 6, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (24, '2020-06-08 17:00:00', '77100', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (25, '2020-06-08 18:00:00', '77100', 6, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mo` VALUES (26, '2020-06-08 18:00:00', '77100', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (27, '2020-06-09 03:00:00', '77100', 6, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (28, '2020-06-09 13:00:00', '77100', 6, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mo` VALUES (29, '2020-06-09 14:00:00', '77100', 6, 0, 'ERR_001', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (30, '2020-06-09 14:00:00', '77100', 6, 0, 'ERR_00199', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (31, '2020-06-09 15:00:00', '77100', 6, 0, 'ERR_00199', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (32, '2020-06-11 15:00:00', '77100', 6, 0, 'ERR_00199', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (33, '2020-06-11 16:00:00', '77100', 0, 0, '1000', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (34, '2020-06-11 16:00:00', '77100', 6, 0, 'ERR_00199', 4);
INSERT INTO `tbl_summary_hourly_mo` VALUES (35, '2020-06-11 18:00:00', '77100', 6, 0, 'ERR_00199', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (36, '2020-06-15 20:00:00', '77100', 6, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (37, '2020-06-15 20:00:00', '77100', 6, 0, 'ERR_00199', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (38, '2020-06-22 14:00:00', '77100', 6, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (39, '2020-06-22 14:00:00', '77100', 6, 0, '1003', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (40, '2020-06-22 14:00:00', '77100', 6, 0, 'ERR_018', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (41, '2020-06-22 14:00:00', '77100', 7, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mo` VALUES (42, '2020-06-22 14:00:00', '77100', 7, 0, 'ERR_INTERNAL_PARAM', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (43, '2020-06-22 15:00:00', '628881818101', 6, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (44, '2020-06-22 15:00:00', '628881818101', 6, 0, '1003', 6);
INSERT INTO `tbl_summary_hourly_mo` VALUES (45, '2020-06-22 15:00:00', '77100', 6, 0, '1003', 5);
INSERT INTO `tbl_summary_hourly_mo` VALUES (46, '2020-06-22 16:00:00', '628881818101', 6, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (47, '2020-06-22 16:00:00', '77100', 6, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (48, '2020-06-22 16:00:00', '628881818101', 6, 0, '1003', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (49, '2020-06-22 17:00:00', '77100', 6, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (50, '2020-06-22 19:00:00', '628881818101', 6, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mo` VALUES (51, '2020-06-24 12:00:00', '628881818101', 6, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (52, '2020-06-24 14:00:00', '628881818101', 6, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (53, '2020-06-24 18:00:00', '628881818101', 6, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (54, '2020-06-24 18:00:00', '628881818101', 6, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (55, '2020-07-21 11:00:00', '628881818101', 7, 0, 'ERR_INTERNAL_PARAM', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (56, '2020-07-21 16:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (57, '2020-07-21 16:00:00', '628881818101', 7, 0, 'ERR_INTERNAL_PARAM', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (58, '2020-07-21 17:00:00', '628881818101', 7, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (59, '2020-07-21 18:00:00', '628881818101', 7, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (60, '2020-07-21 18:00:00', '628881818101', 7, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (61, '2020-07-21 19:00:00', '628881818101', 7, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (62, '2020-07-21 19:00:00', '628881818101', 7, 0, '1002', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (63, '2020-07-21 19:00:00', '628881818101', 7, 0, '1003', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (64, '2020-07-21 19:00:00', '628881818101', 7, 0, '4201', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (65, '2020-07-21 19:00:00', '628881818101', 7, 0, '4221', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (66, '2020-07-21 19:00:00', '628881818101', 7, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (67, '2020-07-21 20:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (68, '2020-07-21 20:00:00', '628881818101', 7, 0, '1003', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (69, '2020-07-21 21:00:00', '628881818101', 7, 0, '-3001', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (70, '2020-07-21 21:00:00', '628881818101', 7, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mo` VALUES (71, '2020-07-21 22:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (72, '2020-07-22 10:00:00', '628881818101', 7, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mo` VALUES (73, '2020-07-22 11:00:00', '628881818101', 7, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (74, '2020-07-22 11:00:00', '628881818101', 7, 0, 'ERR_018', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (75, '2020-07-22 13:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (76, '2020-07-22 18:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (77, '2020-07-23 10:00:00', '628881818101', 7, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (78, '2020-07-23 12:00:00', '628881818101', 7, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (79, '2020-07-23 13:00:00', '628881818101', 7, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mo` VALUES (80, '2020-07-23 13:00:00', '628881818101', 7, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (81, '2020-07-23 14:00:00', '628881818101', 7, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mo` VALUES (82, '2020-07-23 15:00:00', '628881818101', 7, 0, '-3001', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (83, '2020-07-23 15:00:00', '628881818101', 7, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (84, '2020-07-23 16:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (85, '2020-07-24 08:00:00', '628881818101', 7, 1, '0', 6);
INSERT INTO `tbl_summary_hourly_mo` VALUES (86, '2020-07-24 12:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (87, '2020-07-24 13:00:00', '628881818101', 7, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mo` VALUES (88, '2020-07-24 14:00:00', '628881818101', 7, 1, '0', 6);
INSERT INTO `tbl_summary_hourly_mo` VALUES (89, '2020-07-24 15:00:00', '628881818101', 7, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (90, '2020-07-24 15:00:00', '628881818101', 7, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (91, '2020-07-24 16:00:00', '628881818101', 7, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (92, '2020-07-24 17:00:00', '628881818101', 7, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (93, '2020-07-24 18:00:00', '628881818101', 6, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (94, '2020-07-24 18:00:00', '628881818101', 7, 1, '0', 10);
INSERT INTO `tbl_summary_hourly_mo` VALUES (95, '2020-07-27 12:00:00', '628881818101', 6, 1, '0', 12);
INSERT INTO `tbl_summary_hourly_mo` VALUES (96, '2020-07-27 12:00:00', '628881818101', 6, 0, 'ERR_018', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (97, '2020-07-27 13:00:00', '628881818101', 6, 1, '0', 18);
INSERT INTO `tbl_summary_hourly_mo` VALUES (98, '2020-07-27 13:00:00', '628881818101', 6, 0, 'ERR_018', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (99, '2020-07-27 13:00:00', '628881818101', 7, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (100, '2020-07-27 14:00:00', '628881818101', 6, 0, '-3001', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (101, '2020-07-27 14:00:00', '628881818101', 6, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mo` VALUES (102, '2020-07-27 14:00:00', '628881818101', 6, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (103, '2020-07-27 15:00:00', '628881818101', 7, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mo` VALUES (104, '2020-07-27 16:00:00', '628881818101', 6, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (105, '2020-07-27 16:00:00', '628881818101', 7, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mo` VALUES (106, '2020-07-27 16:00:00', '628881818101', 7, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (107, '2020-07-27 17:00:00', '628881818101', 7, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (108, '2020-07-28 11:00:00', '628881818101', 6, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mo` VALUES (109, '2020-07-28 11:00:00', '628881818101', 7, 1, '0', 7);
INSERT INTO `tbl_summary_hourly_mo` VALUES (110, '2020-07-28 12:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (111, '2020-07-28 13:00:00', '628881818101', 6, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (112, '2020-07-28 14:00:00', '628881818101', 6, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (113, '2020-07-28 14:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (114, '2020-07-28 16:00:00', '628881818101', 7, 0, '-3001', 4);
INSERT INTO `tbl_summary_hourly_mo` VALUES (115, '2020-07-28 16:00:00', '628881818101', 7, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mo` VALUES (116, '2020-07-28 16:00:00', '628881818101', 7, 0, '5001', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (117, '2020-07-29 15:00:00', '628881818101', 7, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (118, '2020-07-29 16:00:00', '628881818101', 6, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (119, '2020-07-29 16:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (120, '2020-07-30 01:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (121, '2020-07-30 02:00:00', '628881818101', 7, 0, '-3001', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (122, '2020-07-30 02:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (123, '2020-07-30 03:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (124, '2020-07-30 15:00:00', '628881818101', 6, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (125, '2020-07-30 15:00:00', '628881818101', 7, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mo` VALUES (126, '2020-07-30 16:00:00', '628881818101', 7, 0, '-3001', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (127, '2020-07-30 16:00:00', '628881818101', 7, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (128, '2020-07-30 17:00:00', '628881818101', 7, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (129, '2020-07-30 18:00:00', '628881818101', 7, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (130, '2020-07-31 01:00:00', '628881818101', 7, 0, '-3001', 4);
INSERT INTO `tbl_summary_hourly_mo` VALUES (131, '2020-08-04 10:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (132, '2020-08-04 16:00:00', '628881818101', 7, 0, '5001', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (133, '2020-08-04 17:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (134, '2020-08-05 11:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (135, '2020-08-05 12:00:00', '628881818101', 7, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (136, '2020-08-05 13:00:00', '628881818101', 7, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (137, '2020-08-05 14:00:00', '628881818101', 7, 0, '5001', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (138, '2020-08-05 15:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (139, '2020-08-05 19:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (140, '2020-08-06 20:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (141, '2020-08-07 13:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (142, '2020-08-07 16:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (143, '2020-08-10 13:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (144, '2020-08-10 13:00:00', '628881818101', 7, 0, '4201', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (145, '2020-08-10 16:00:00', '628881818101', 7, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (146, '2020-08-10 16:00:00', '628881818101', 7, 0, '1003', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (147, '2020-08-11 11:00:00', '628881818101', 7, 0, '5001', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (148, '2020-08-11 13:00:00', '628881818101', 7, 0, '-3001', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (149, '2020-08-11 13:00:00', '628881818101', 7, 0, '4201', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (150, '2020-08-11 16:00:00', '628881818101', 7, 0, '-3001', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (151, '2020-08-11 16:00:00', '628881818101', 7, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mo` VALUES (152, '2020-08-11 16:00:00', '628881818101', 7, 0, 'ERR_018', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (153, '2020-08-11 18:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (154, '2020-08-13 04:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (155, '2020-08-14 05:00:00', '628881818101', 7, 0, '-3001', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (156, '2020-08-14 05:00:00', '628881818101', 7, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mo` VALUES (157, '2020-08-14 13:00:00', '628881818101', 7, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (158, '2020-08-14 16:00:00', '628881818101', 7, 0, '-3001', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (159, '2020-08-14 16:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (160, '2020-08-14 16:00:00', '628881818101', 7, 0, '4201', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (161, '2020-08-15 09:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (162, '2020-08-15 18:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (163, '2020-08-15 20:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (164, '2020-08-15 20:00:00', '628881818101', 7, 0, '1003', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (165, '2020-08-16 20:00:00', '628881818101', 7, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (166, '2020-08-17 13:00:00', '628881818101', 7, 0, '4201', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (167, '2020-08-17 22:00:00', '628881818101', 7, 0, '4201', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (168, '2020-08-18 09:00:00', '628881818101', 7, 0, '4201', 2);
INSERT INTO `tbl_summary_hourly_mo` VALUES (169, '2020-08-18 09:00:00', '628881818101', 7, 0, '5001', 1);
INSERT INTO `tbl_summary_hourly_mo` VALUES (170, '2020-08-18 13:00:00', '628881818101', 7, 1, '0', 1);

-- ----------------------------
-- Table structure for tbl_summary_hourly_mt
-- ----------------------------
DROP TABLE IF EXISTS `tbl_summary_hourly_mt`;
CREATE TABLE `tbl_summary_hourly_mt`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime(0) NULL DEFAULT NULL,
  `shortcode` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `aph_id` int(11) NULL DEFAULT NULL,
  `status` int(2) NULL DEFAULT NULL COMMENT '0 failed, 1 success',
  `error_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `total` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 175 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_summary_hourly_mt
-- ----------------------------
INSERT INTO `tbl_summary_hourly_mt` VALUES (1, '2020-06-03 16:00:00', '77100', NULL, 0, 'ERR_INTERNAL_PARAM', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (2, '2020-06-03 17:00:00', '77100', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (3, '2020-06-03 17:00:00', '77100', NULL, 0, '1000', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (4, '2020-06-03 18:00:00', '77100', NULL, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (5, '2020-06-04 11:00:00', '77100', NULL, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mt` VALUES (6, '2020-06-04 11:00:00', '77100', NULL, 0, '1000', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (7, '2020-06-04 12:00:00', '77100', NULL, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (8, '2020-06-04 15:00:00', '77100', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (9, '2020-06-04 15:00:00', '77100', NULL, 0, '1000', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (10, '2020-06-04 18:00:00', '77100', NULL, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mt` VALUES (11, '2020-06-04 18:00:00', '77100', NULL, 0, 'ERR_001', 6);
INSERT INTO `tbl_summary_hourly_mt` VALUES (12, '2020-06-04 19:00:00', '77100', NULL, 0, 'ERR_001', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (13, '2020-06-04 22:00:00', '77100', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (14, '2020-06-04 22:00:00', '77100', NULL, 0, 'ERR_001', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (15, '2020-06-05 01:00:00', '77100', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (16, '2020-06-05 11:00:00', '77100', NULL, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (17, '2020-06-05 14:00:00', '77100', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (18, '2020-06-05 15:00:00', '77100', NULL, 1, '0', 9);
INSERT INTO `tbl_summary_hourly_mt` VALUES (19, '2020-06-05 23:00:00', '77100', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (20, '2020-06-08 17:00:00', '77100', NULL, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mt` VALUES (21, '2020-06-08 18:00:00', '77100', NULL, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mt` VALUES (22, '2020-06-09 03:00:00', '77100', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (23, '2020-06-09 13:00:00', '77100', NULL, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mt` VALUES (24, '2020-06-09 14:00:00', '77100', NULL, 0, 'ERR_001', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (25, '2020-06-09 14:00:00', '77100', NULL, 0, 'ERR_00199', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (26, '2020-06-09 15:00:00', '77100', NULL, 0, 'ERR_00199', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (27, '2020-06-11 15:00:00', '77100', NULL, 0, 'ERR_00199', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (28, '2020-06-11 16:00:00', '77100', NULL, 0, '1000', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (29, '2020-06-11 16:00:00', '77100', NULL, 0, 'ERR_00199', 4);
INSERT INTO `tbl_summary_hourly_mt` VALUES (30, '2020-06-11 18:00:00', '77100', NULL, 0, 'ERR_00199', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (31, '2020-06-15 20:00:00', '77100', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (32, '2020-06-15 20:00:00', '77100', NULL, 0, 'ERR_00199', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (33, '2020-06-22 14:00:00', '77100', NULL, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mt` VALUES (34, '2020-06-22 14:00:00', '77100', NULL, 0, '1003', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (35, '2020-06-22 14:00:00', '77100', NULL, 0, 'ERR_018', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (36, '2020-06-22 14:00:00', '77100', NULL, 0, 'ERR_INTERNAL_PARAM', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (37, '2020-06-22 15:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (38, '2020-06-22 15:00:00', '628881818101', NULL, 0, '1003', 6);
INSERT INTO `tbl_summary_hourly_mt` VALUES (39, '2020-06-22 15:00:00', '77100', NULL, 0, '1003', 5);
INSERT INTO `tbl_summary_hourly_mt` VALUES (40, '2020-06-22 16:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (41, '2020-06-22 16:00:00', '77100', NULL, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (42, '2020-06-22 16:00:00', '628881818101', NULL, 0, '1003', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (43, '2020-06-22 17:00:00', '77100', NULL, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (44, '2020-06-22 19:00:00', '628881818101', NULL, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mt` VALUES (45, '2020-06-22 19:00:00', '628881818101', NULL, 0, '1000', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (46, '2020-06-22 19:00:00', '77100', NULL, 0, '1000', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (47, '2020-06-24 12:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (48, '2020-06-24 12:00:00', '628881818101', NULL, 0, '1000', 4);
INSERT INTO `tbl_summary_hourly_mt` VALUES (49, '2020-06-24 14:00:00', '628881818101', NULL, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (50, '2020-06-24 18:00:00', '628881818101', NULL, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (51, '2020-06-24 18:00:00', '628881818101', NULL, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (52, '2020-07-21 03:00:00', '628881818101', NULL, 0, '1000', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (53, '2020-07-21 11:00:00', '628881818101', NULL, 0, '1000', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (54, '2020-07-21 11:00:00', '628881818101', NULL, 0, 'ERR_INTERNAL_PARAM', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (55, '2020-07-21 12:00:00', '628881818101', NULL, 0, '1000', 5);
INSERT INTO `tbl_summary_hourly_mt` VALUES (56, '2020-07-21 13:00:00', '628881818101', NULL, 0, '1000', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (57, '2020-07-21 15:00:00', '628881818101', NULL, 0, '1000', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (58, '2020-07-21 16:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (59, '2020-07-21 16:00:00', '628881818101', NULL, 0, 'ERR_INTERNAL_PARAM', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (60, '2020-07-21 17:00:00', '628881818101', NULL, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (61, '2020-07-21 17:00:00', '628881818101', NULL, 0, '1000', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (62, '2020-07-21 18:00:00', '628881818101', NULL, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (63, '2020-07-21 18:00:00', '628881818101', NULL, 0, '1000', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (64, '2020-07-21 18:00:00', '628881818101', NULL, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (65, '2020-07-21 19:00:00', '628881818101', NULL, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (66, '2020-07-21 19:00:00', '628881818101', NULL, 0, '1002', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (67, '2020-07-21 19:00:00', '628881818101', NULL, 0, '1003', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (68, '2020-07-21 19:00:00', '628881818101', NULL, 0, '4201', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (69, '2020-07-21 19:00:00', '628881818101', NULL, 0, '4221', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (70, '2020-07-21 19:00:00', '628881818101', NULL, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (71, '2020-07-21 20:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (72, '2020-07-21 20:00:00', '628881818101', NULL, 0, '1003', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (73, '2020-07-21 21:00:00', '628881818101', NULL, 0, '-3001', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (74, '2020-07-21 21:00:00', '628881818101', NULL, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mt` VALUES (75, '2020-07-21 22:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (76, '2020-07-21 22:00:00', '628881818101', NULL, 0, '1000', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (77, '2020-07-22 10:00:00', '628881818101', NULL, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mt` VALUES (78, '2020-07-22 11:00:00', '628881818101', NULL, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (79, '2020-07-22 11:00:00', '628881818101', NULL, 0, 'ERR_018', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (80, '2020-07-22 13:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (81, '2020-07-22 18:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (82, '2020-07-23 10:00:00', '628881818101', NULL, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (83, '2020-07-23 11:00:00', '628881818101', NULL, 0, '1000', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (84, '2020-07-23 12:00:00', '628881818101', NULL, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (85, '2020-07-23 13:00:00', '628881818101', NULL, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mt` VALUES (86, '2020-07-23 13:00:00', '628881818101', NULL, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (87, '2020-07-23 14:00:00', '628881818101', NULL, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mt` VALUES (88, '2020-07-23 15:00:00', '628881818101', NULL, 0, '-3001', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (89, '2020-07-23 15:00:00', '628881818101', NULL, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (90, '2020-07-23 16:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (91, '2020-07-24 08:00:00', '628881818101', NULL, 1, '0', 6);
INSERT INTO `tbl_summary_hourly_mt` VALUES (92, '2020-07-24 12:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (93, '2020-07-24 13:00:00', '628881818101', NULL, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mt` VALUES (94, '2020-07-24 14:00:00', '628881818101', NULL, 1, '0', 6);
INSERT INTO `tbl_summary_hourly_mt` VALUES (95, '2020-07-24 15:00:00', '628881818101', NULL, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (96, '2020-07-24 15:00:00', '628881818101', NULL, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (97, '2020-07-24 16:00:00', '628881818101', NULL, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (98, '2020-07-24 17:00:00', '628881818101', NULL, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (99, '2020-07-24 18:00:00', '628881818101', NULL, 1, '0', 12);
INSERT INTO `tbl_summary_hourly_mt` VALUES (100, '2020-07-27 12:00:00', '628881818101', NULL, 1, '0', 12);
INSERT INTO `tbl_summary_hourly_mt` VALUES (101, '2020-07-27 12:00:00', '628881818101', NULL, 0, 'ERR_018', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (102, '2020-07-27 13:00:00', '628881818101', NULL, 1, '0', 20);
INSERT INTO `tbl_summary_hourly_mt` VALUES (103, '2020-07-27 13:00:00', '628881818101', NULL, 0, 'ERR_018', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (104, '2020-07-27 14:00:00', '628881818101', NULL, 0, '-3001', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (105, '2020-07-27 14:00:00', '628881818101', NULL, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mt` VALUES (106, '2020-07-27 14:00:00', '628881818101', NULL, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (107, '2020-07-27 15:00:00', '628881818101', NULL, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mt` VALUES (108, '2020-07-27 16:00:00', '628881818101', NULL, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mt` VALUES (109, '2020-07-27 16:00:00', '628881818101', NULL, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (110, '2020-07-27 17:00:00', '628881818101', NULL, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (111, '2020-07-28 11:00:00', '628881818101', NULL, 1, '0', 12);
INSERT INTO `tbl_summary_hourly_mt` VALUES (112, '2020-07-28 12:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (113, '2020-07-28 13:00:00', '628881818101', NULL, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (114, '2020-07-28 14:00:00', '628881818101', NULL, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (115, '2020-07-28 16:00:00', '628881818101', NULL, 0, '-3001', 4);
INSERT INTO `tbl_summary_hourly_mt` VALUES (116, '2020-07-28 16:00:00', '628881818101', NULL, 1, '0', 4);
INSERT INTO `tbl_summary_hourly_mt` VALUES (117, '2020-07-28 16:00:00', '628881818101', NULL, 0, '5001', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (118, '2020-07-29 15:00:00', '628881818101', NULL, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (119, '2020-07-29 16:00:00', '628881818101', NULL, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (120, '2020-07-30 01:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (121, '2020-07-30 02:00:00', '628881818101', NULL, 0, '-3001', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (122, '2020-07-30 02:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (123, '2020-07-30 03:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (124, '2020-07-30 15:00:00', '628881818101', NULL, 1, '0', 8);
INSERT INTO `tbl_summary_hourly_mt` VALUES (125, '2020-07-30 16:00:00', '628881818101', NULL, 0, '-3001', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (126, '2020-07-30 16:00:00', '628881818101', NULL, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (127, '2020-07-30 17:00:00', '628881818101', NULL, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (128, '2020-07-30 18:00:00', '628881818101', NULL, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (129, '2020-07-31 01:00:00', '628881818101', NULL, 0, '-3001', 4);
INSERT INTO `tbl_summary_hourly_mt` VALUES (130, '2020-08-04 10:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (131, '2020-08-04 16:00:00', '628881818101', NULL, 0, '5001', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (132, '2020-08-04 17:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (133, '2020-08-05 11:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (134, '2020-08-05 11:00:00', '628881818101', NULL, 0, '1000', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (135, '2020-08-05 12:00:00', '628881818101', NULL, 0, 'ERR_018', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (136, '2020-08-05 13:00:00', '628881818101', NULL, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (137, '2020-08-05 14:00:00', '628881818101', NULL, 0, '5001', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (138, '2020-08-05 15:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (139, '2020-08-05 19:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (140, '2020-08-06 20:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (141, '2020-08-07 13:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (142, '2020-08-07 14:00:00', '628881818101', NULL, 0, '1000', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (143, '2020-08-07 15:00:00', '628881818101', NULL, 0, '1000', 7);
INSERT INTO `tbl_summary_hourly_mt` VALUES (144, '2020-08-07 16:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (145, '2020-08-10 12:00:00', '628881818101', NULL, 0, '1000', 4);
INSERT INTO `tbl_summary_hourly_mt` VALUES (146, '2020-08-10 13:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (147, '2020-08-10 13:00:00', '628881818101', NULL, 0, '4201', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (148, '2020-08-10 16:00:00', '628881818101', NULL, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (149, '2020-08-10 16:00:00', '628881818101', NULL, 0, '1003', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (150, '2020-08-11 11:00:00', '628881818101', NULL, 0, '5001', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (151, '2020-08-11 13:00:00', '628881818101', NULL, 0, '-3001', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (152, '2020-08-11 13:00:00', '628881818101', NULL, 0, '4201', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (153, '2020-08-11 16:00:00', '628881818101', NULL, 0, '-3001', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (154, '2020-08-11 16:00:00', '628881818101', NULL, 1, '0', 5);
INSERT INTO `tbl_summary_hourly_mt` VALUES (155, '2020-08-11 16:00:00', '628881818101', NULL, 0, 'ERR_018', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (156, '2020-08-11 17:00:00', '628881818101', NULL, 0, '1000', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (157, '2020-08-11 18:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (158, '2020-08-13 04:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (159, '2020-08-14 05:00:00', '628881818101', NULL, 0, '-3001', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (160, '2020-08-14 05:00:00', '628881818101', NULL, 1, '0', 3);
INSERT INTO `tbl_summary_hourly_mt` VALUES (161, '2020-08-14 13:00:00', '628881818101', NULL, 1, '0', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (162, '2020-08-14 16:00:00', '628881818101', NULL, 0, '-3001', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (163, '2020-08-14 16:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (164, '2020-08-14 16:00:00', '628881818101', NULL, 0, '4201', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (165, '2020-08-15 09:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (166, '2020-08-15 18:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (167, '2020-08-15 20:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (168, '2020-08-15 20:00:00', '628881818101', NULL, 0, '1003', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (169, '2020-08-16 20:00:00', '628881818101', NULL, 1, '0', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (170, '2020-08-17 13:00:00', '628881818101', NULL, 0, '4201', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (171, '2020-08-17 22:00:00', '628881818101', NULL, 0, '4201', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (172, '2020-08-18 09:00:00', '628881818101', NULL, 0, '4201', 2);
INSERT INTO `tbl_summary_hourly_mt` VALUES (173, '2020-08-18 09:00:00', '628881818101', NULL, 0, '5001', 1);
INSERT INTO `tbl_summary_hourly_mt` VALUES (174, '2020-08-18 13:00:00', '628881818101', NULL, 1, '0', 1);

-- ----------------------------
-- Table structure for tbl_summary_tps
-- ----------------------------
DROP TABLE IF EXISTS `tbl_summary_tps`;
CREATE TABLE `tbl_summary_tps`  (
  `time` datetime(0) NULL DEFAULT NULL,
  `aph_id` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mo_tps_min` int(11) NULL DEFAULT NULL,
  `mo_tps_max` int(11) NULL DEFAULT NULL,
  `mo_tps_count` int(11) NULL DEFAULT NULL,
  `mt_tps_min` int(11) NULL DEFAULT NULL,
  `mt_tps_max` int(11) NULL DEFAULT NULL,
  `mt_tps_count` int(11) NULL DEFAULT NULL,
  `api_tps_min` int(11) NULL DEFAULT NULL,
  `api_tps_max` int(11) NULL DEFAULT NULL,
  `api_tps_count` int(11) NULL DEFAULT NULL,
  `dr_tps_min` int(11) NULL DEFAULT NULL,
  `dr_tps_max` int(11) NULL DEFAULT NULL,
  `dr_tps_count` int(11) NULL DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 135 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_summary_tps
-- ----------------------------
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-04 11:00:00', '-', 1, 1, 2, 1, 1, 2, 1, 1, 2, 0, 0, 0, 1);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-04 11:00:00', '6', 1, 1, 5, 1, 1, 5, 1, 1, 5, 0, 0, 0, 2);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-04 12:00:00', '6', 1, 1, 2, 1, 1, 2, 1, 1, 2, 0, 0, 0, 3);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-04 15:00:00', '-', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 4);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-04 15:00:00', '6', 1, 1, 2, 1, 1, 1, 1, 1, 2, 0, 0, 0, 5);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-04 18:00:00', '6', 1, 1, 9, 1, 1, 10, 1, 1, 9, 0, 0, 0, 6);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-04 19:00:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 7);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-04 22:00:00', '6', 1, 1, 2, 1, 1, 2, 1, 1, 2, 0, 0, 0, 8);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-05 01:00:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 9);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-05 11:00:00', '6', 1, 1, 3, 1, 1, 3, 1, 1, 3, 0, 0, 0, 10);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-05 14:00:00', '6', 1, 1, 2, 1, 1, 1, 1, 1, 2, 0, 0, 0, 11);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-05 14:00:00', '7', 1, 1, 1, 0, 0, 0, 1, 1, 1, 0, 0, 0, 12);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-05 15:00:00', '7', 1, 1, 7, 1, 1, 7, 1, 1, 7, 1, 1, 1, 13);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-05 23:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 14);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-08 17:00:00', '6', 1, 1, 3, 1, 1, 3, 1, 1, 3, 1, 1, 3, 15);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-08 17:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 16);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-08 18:00:00', '6', 1, 1, 4, 1, 1, 4, 1, 1, 4, 1, 1, 4, 17);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-08 18:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 18);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-09 03:00:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 19);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-09 13:00:00', '6', 1, 1, 5, 1, 1, 5, 1, 1, 5, 1, 1, 5, 20);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-09 14:00:00', '6', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 21);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-09 15:00:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 22);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-11 15:00:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 23);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-11 16:00:00', '-', 1, 1, 3, 1, 1, 3, 1, 1, 3, 1, 1, 2, 24);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-11 16:00:00', '6', 1, 1, 4, 1, 1, 4, 1, 1, 4, 1, 1, 4, 25);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-11 18:00:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 26);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-15 20:00:00', '6', 1, 1, 3, 1, 1, 3, 1, 1, 3, 0, 0, 0, 27);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-22 14:00:00', '6', 1, 1, 4, 1, 1, 4, 1, 1, 4, 0, 0, 0, 28);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-22 14:00:00', '7', 1, 1, 5, 1, 1, 5, 1, 1, 5, 0, 0, 0, 29);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-22 15:00:00', '6', 1, 1, 12, 1, 1, 12, 1, 1, 12, 0, 0, 0, 30);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-22 16:00:00', '6', 1, 1, 4, 1, 1, 4, 1, 1, 4, 0, 0, 0, 31);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-22 17:00:00', '6', 1, 1, 3, 1, 1, 3, 1, 1, 3, 5, 5, 5, 32);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-22 19:00:00', '-', 1, 1, 6, 1, 1, 6, 1, 1, 6, 1, 1, 1, 33);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-22 19:00:00', '6', 1, 1, 4, 1, 1, 4, 1, 1, 4, 1, 1, 4, 34);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-24 12:00:00', '-', 1, 1, 4, 1, 1, 4, 1, 1, 4, 1, 1, 2, 35);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-24 12:00:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 36);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-24 14:00:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 37);
INSERT INTO `tbl_summary_tps` VALUES ('2020-06-24 18:00:00', '6', 1, 1, 4, 1, 1, 4, 1, 1, 4, 1, 1, 4, 38);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-21 03:00:00', '-', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 39);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-21 11:00:00', '-', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 40);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-21 12:00:00', '-', 1, 1, 5, 1, 1, 5, 1, 1, 5, 0, 0, 0, 41);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-21 13:00:00', '-', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 42);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-21 15:00:00', '-', 1, 1, 2, 1, 1, 2, 1, 1, 2, 0, 0, 0, 43);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-21 16:00:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 0, 0, 0, 44);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-21 17:00:00', '-', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 45);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-21 17:00:00', '7', 1, 1, 3, 1, 1, 3, 1, 1, 3, 0, 0, 0, 46);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-21 18:00:00', '-', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 47);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-21 18:00:00', '7', 1, 1, 4, 1, 1, 4, 1, 1, 4, 0, 0, 0, 48);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-21 19:00:00', '7', 1, 1, 9, 1, 1, 9, 1, 1, 9, 0, 0, 0, 49);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-21 20:00:00', '7', 1, 1, 3, 1, 1, 3, 1, 1, 3, 0, 0, 0, 50);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-21 21:00:00', '7', 1, 1, 6, 1, 1, 6, 1, 1, 6, 0, 0, 0, 51);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-21 22:00:00', '-', 1, 1, 2, 1, 1, 2, 1, 1, 2, 0, 0, 0, 52);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-21 22:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 53);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-22 10:00:00', '7', 1, 1, 4, 1, 1, 4, 1, 1, 4, 0, 0, 0, 54);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-22 11:00:00', '7', 1, 1, 6, 1, 1, 6, 1, 1, 6, 0, 0, 0, 55);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-22 13:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 56);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-22 18:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 57);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-23 10:00:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 0, 0, 0, 58);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-23 11:00:00', '-', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 59);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-23 12:00:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 0, 0, 0, 60);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-23 13:00:00', '7', 1, 1, 6, 1, 1, 6, 1, 1, 6, 0, 0, 0, 61);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-23 14:00:00', '7', 1, 1, 4, 1, 1, 4, 1, 1, 4, 0, 0, 0, 62);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-23 15:00:00', '7', 1, 1, 5, 1, 1, 5, 1, 1, 5, 1, 1, 4, 63);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-23 16:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 64);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-24 08:00:00', '7', 1, 1, 6, 1, 1, 6, 1, 1, 6, 1, 1, 3, 65);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-24 12:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 66);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-24 13:00:00', '7', 1, 1, 4, 1, 1, 4, 1, 1, 4, 1, 1, 2, 67);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-24 14:00:00', '7', 1, 1, 6, 1, 1, 6, 1, 1, 6, 1, 1, 5, 68);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-24 15:00:00', '7', 1, 1, 4, 1, 1, 4, 1, 1, 4, 1, 1, 3, 69);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-24 16:00:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 70);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-24 17:00:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 71);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-24 18:00:00', '6', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 72);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-24 18:00:00', '7', 1, 1, 10, 1, 1, 10, 1, 1, 10, 1, 1, 10, 73);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-27 12:00:00', '6', 1, 1, 14, 1, 1, 14, 1, 1, 14, 1, 4, 17, 74);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-27 13:00:00', '6', 1, 1, 20, 1, 1, 20, 1, 1, 20, 1, 1, 14, 75);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-27 13:00:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 76);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-27 14:00:00', '6', 1, 1, 9, 1, 1, 9, 1, 1, 9, 1, 1, 9, 77);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-27 15:00:00', '7', 1, 1, 5, 1, 1, 5, 1, 1, 5, 1, 1, 4, 78);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-27 16:00:00', '7', 1, 1, 5, 1, 1, 5, 1, 1, 5, 1, 5, 8, 79);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-27 17:00:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 1, 80);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-28 11:00:00', '6', 1, 1, 5, 1, 1, 5, 1, 1, 5, 1, 1, 5, 81);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-28 11:00:00', '7', 1, 1, 7, 1, 1, 7, 1, 1, 7, 1, 1, 7, 82);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-28 12:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 83);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-28 13:00:00', '6', 1, 1, 3, 1, 1, 3, 1, 1, 3, 1, 1, 3, 84);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-28 14:00:00', '6', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 1, 85);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-28 14:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 86);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-28 16:00:00', '7', 1, 1, 9, 1, 1, 9, 1, 1, 9, 1, 1, 9, 87);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-29 15:00:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 88);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-29 16:00:00', '6', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 89);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-29 16:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 90);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-30 01:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 91);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-30 02:00:00', '7', 1, 1, 3, 1, 1, 3, 1, 1, 3, 1, 1, 2, 92);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-30 03:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 93);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-30 15:00:00', '6', 1, 1, 3, 1, 1, 3, 1, 1, 3, 1, 1, 3, 94);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-30 15:00:00', '7', 1, 1, 5, 1, 1, 5, 1, 1, 5, 1, 1, 4, 95);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-30 16:00:00', '7', 1, 1, 3, 1, 1, 3, 1, 1, 3, 1, 1, 3, 96);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-30 17:00:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 97);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-30 18:00:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 98);
INSERT INTO `tbl_summary_tps` VALUES ('2020-07-31 01:00:00', '7', 1, 1, 4, 1, 1, 4, 1, 1, 4, 1, 1, 4, 99);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-04 10:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-04 16:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 101);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-04 17:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 102);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-05 11:00:00', '-', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 103);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-05 11:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 104);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-05 12:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 105);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-05 13:00:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 106);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-05 14:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 107);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-05 15:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 108);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-05 19:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 109);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-06 20:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 110);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-07 13:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 111);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-07 14:00:00', '-', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 112);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-07 15:00:00', '-', 1, 1, 7, 1, 1, 7, 1, 1, 7, 1, 1, 7, 113);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-07 16:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 114);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-10 12:00:00', '-', 1, 1, 4, 1, 1, 4, 1, 1, 4, 0, 0, 0, 115);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-10 13:00:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 116);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-10 16:00:00', '7', 1, 1, 6, 1, 1, 6, 1, 1, 6, 1, 1, 4, 117);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-11 11:00:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 118);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-11 13:00:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 119);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-11 16:00:00', '7', 1, 1, 10, 1, 1, 10, 1, 1, 10, 1, 1, 10, 120);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-11 17:00:00', '-', 1, 1, 3, 1, 1, 3, 1, 1, 3, 0, 0, 0, 121);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-11 18:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 122);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-13 04:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 123);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-14 05:00:00', '7', 1, 1, 5, 1, 1, 5, 1, 1, 5, 1, 1, 5, 124);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-14 13:00:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 125);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-14 16:00:00', '7', 1, 1, 3, 1, 1, 3, 1, 1, 3, 1, 1, 3, 126);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-15 09:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 127);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-15 18:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 128);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-15 20:00:00', '7', 1, 1, 3, 1, 1, 3, 1, 1, 3, 1, 1, 3, 129);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-16 20:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 130);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-17 13:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 131);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-17 22:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 132);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-18 09:00:00', '7', 1, 1, 3, 1, 1, 3, 1, 1, 3, 1, 1, 3, 133);
INSERT INTO `tbl_summary_tps` VALUES ('2020-08-18 13:00:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 134);

-- ----------------------------
-- Table structure for tbl_summary_tps_backup
-- ----------------------------
DROP TABLE IF EXISTS `tbl_summary_tps_backup`;
CREATE TABLE `tbl_summary_tps_backup`  (
  `time` datetime(0) NULL DEFAULT NULL,
  `aph_id` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mo_tps_min` int(11) NULL DEFAULT NULL,
  `mo_tps_max` int(11) NULL DEFAULT NULL,
  `mo_tps_count` int(11) NULL DEFAULT NULL,
  `mt_tps_min` int(11) NULL DEFAULT NULL,
  `mt_tps_max` int(11) NULL DEFAULT NULL,
  `mt_tps_count` int(11) NULL DEFAULT NULL,
  `api_tps_min` int(11) NULL DEFAULT NULL,
  `api_tps_max` int(11) NULL DEFAULT NULL,
  `api_tps_count` int(11) NULL DEFAULT NULL,
  `dr_tps_min` int(11) NULL DEFAULT NULL,
  `dr_tps_max` int(11) NULL DEFAULT NULL,
  `dr_tps_count` int(11) NULL DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 72 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_summary_tps_backup
-- ----------------------------
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-03 16:32:00', '1', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-03 16:37:00', '2', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-03 16:54:00', '2', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 3);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-03 17:57:00', '-', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 4);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-03 17:58:00', '2', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 5);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-03 18:08:00', '2', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 6);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-03 18:10:00', '2', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 7);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-03 18:14:00', '2', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 8);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 11:15:00', '-', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 9);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 11:22:00', '-', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 10);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 11:24:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 11);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 11:42:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 12);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 11:45:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 13);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 11:48:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 14);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 11:50:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 15);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 12:15:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 16);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 12:25:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 17);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 15:18:00', '-', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 18);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 15:19:00', '6', 1, 1, 1, 0, 0, 0, 1, 1, 1, 0, 0, 0, 19);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 15:20:00', '6', 1, 1, 1, 0, 0, 0, 1, 1, 1, 0, 0, 0, 20);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 15:37:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 21);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 18:00:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 22);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 18:17:00', '6', 1, 1, 2, 1, 1, 2, 1, 1, 2, 0, 0, 0, 23);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 18:21:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 24);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 18:24:00', '6', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 25);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 18:25:00', '6', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 26);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 18:30:00', '6', 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 27);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 18:32:00', '6', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 28);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 18:42:00', '6', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 29);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 18:43:00', '6', 1, 1, 2, 1, 1, 2, 0, 0, 0, 0, 0, 0, 30);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 19:37:00', '6', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 31);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-04 22:43:00', '6', 1, 1, 2, 1, 1, 2, 1, 1, 1, 0, 0, 0, 32);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 01:23:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 33);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 01:24:00', '6', 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 34);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 11:38:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 35);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 11:40:00', '6', 1, 1, 2, 1, 1, 2, 1, 1, 2, 0, 0, 0, 36);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 14:44:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 37);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 14:46:00', '7', 1, 1, 1, 0, 0, 0, 1, 1, 1, 0, 0, 0, 38);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 14:50:00', '6', 1, 1, 1, 0, 0, 0, 1, 1, 1, 0, 0, 0, 39);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 15:05:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 40);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 15:07:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 41);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 15:17:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 42);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 15:18:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 43);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 15:22:00', '7', 1, 1, 2, 1, 1, 2, 1, 1, 2, 0, 0, 0, 44);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 15:26:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 45);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 15:28:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 46);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 15:59:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 47);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-05 23:20:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 48);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-08 17:53:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 49);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-08 17:56:00', '6', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 50);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-08 17:57:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 51);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-08 18:08:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 52);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-08 18:16:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 53);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-08 18:19:00', '6', 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 54);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-08 18:19:00', '7', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 55);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-09 03:30:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 56);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-09 13:12:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 57);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-09 13:14:00', '6', 1, 1, 3, 1, 1, 3, 1, 1, 3, 1, 1, 3, 58);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-09 13:15:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 59);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-09 14:06:00', '6', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 60);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-09 14:17:00', '6', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 61);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-09 15:57:00', '6', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 62);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-11 15:58:00', '6', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 63);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-11 16:02:00', '6', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 64);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-11 16:03:00', '-', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 65);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-11 16:03:00', '6', 1, 1, 2, 1, 1, 2, 0, 0, 0, 0, 0, 0, 66);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-11 16:04:00', '-', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 67);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-11 16:05:00', '-', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 68);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-11 16:05:00', '6', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 69);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-11 18:35:00', '6', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 70);
INSERT INTO `tbl_summary_tps_backup` VALUES ('2020-06-15 20:11:00', '6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 71);

SET FOREIGN_KEY_CHECKS = 1;
