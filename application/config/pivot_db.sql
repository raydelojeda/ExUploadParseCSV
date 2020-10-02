/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : pivot_db

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 02/10/2020 01:49:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for invoices
-- ----------------------------
DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `inv_date` datetime(0) NOT NULL,
  `inv_number` int NOT NULL,
  `inv_po_number` int NULL DEFAULT NULL,
  `inv_shipping_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `inv_billing_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `inv_shipping_cost` decimal(10, 2) NOT NULL,
  `inv_sales_tax` decimal(10, 2) NOT NULL,
  `inv_discount` decimal(10, 2) NOT NULL,
  `inv_comments` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of invoices
-- ----------------------------
INSERT INTO `invoices` VALUES (1, '2020-09-01 00:00:00', 1234, 12345, 'TestShipping Address', 'Test billing address', 20.00, 10.00, 0.00, 'Test comments');
INSERT INTO `invoices` VALUES (2, '2020-10-01 00:00:00', 325, 3423, 'TestShipping address2', 'Test Billing addres2', 15.00, 3.00, 0.00, 'Test Comments 2');
INSERT INTO `invoices` VALUES (24, '0000-00-00 00:00:00', 7854, 6534, '5th Ave #54214, Road Duke FL', '10th St, Mounty Road', 20.00, 15.00, 3.00, 'Invoice test comments');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `product_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `product_sku_number` varchar(55) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `product_quantity` int NOT NULL,
  `product_price` decimal(10, 2) NOT NULL,
  `product_rebate_elegible` bit(1) NOT NULL,
  `product_invoice_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_product_invoice`(`product_invoice_id`) USING BTREE,
  CONSTRAINT `fk_product_invoice` FOREIGN KEY (`product_invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'Test Product', 'Product Test Description', '124564AA32', 120, 15.00, b'1', 1);
INSERT INTO `products` VALUES (2, 'Test Product 2', 'Prod Test desc 2', '34234SA12', 23, 35.00, b'0', 1);
INSERT INTO `products` VALUES (20, 'Smartphone', 'Fancy Smartphone', 'Smart8652654', 23, 34.00, b'1', 24);
INSERT INTO `products` VALUES (21, 'Laptop', 'Fancy laptop', 'Laptop4534', 4, 120.00, b'1', 24);
INSERT INTO `products` VALUES (22, 'Tablet', 'Fancy Tablet', 'Tablet8652654', 23, 34.00, b'1', 24);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', '$2y$10$pkD6x2VkKSYMu.6t24JNOegH4Iaz33UiK8gHWhiHwqSEw7r8Fb29O');

SET FOREIGN_KEY_CHECKS = 1;
