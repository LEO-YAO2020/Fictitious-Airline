
-- ----------------------------
-- Table structure for aircraft
-- ----------------------------
DROP TABLE IF EXISTS `aircraft`;
CREATE TABLE `aircraft`  (
  `craftID` varchar(3) NOT NULL,
  `model` varchar(55)  NOT NULL,
  `capacity` int NOT NULL,
  `rangenmi` float NOT NULL,
  `cruisekn` float NOT NULL,
  PRIMARY KEY (`craftID`)
);

-- ----------------------------
-- Records of aircraft
-- ----------------------------
INSERT INTO `aircraft` VALUES ('A01', 'SyberJet SJ30i', 6, 2500, 880);
INSERT INTO `aircraft` VALUES ('A02', 'Cirrus SF50', 4, 1171, 342);
INSERT INTO `aircraft` VALUES ('A03', 'HondaJet Elite', 5, 2205, 408);
INSERT INTO `aircraft` VALUES ('A04', 'Cirrus SF50', 4, 1171, 342);
INSERT INTO `aircraft` VALUES ('A05', 'HondaJet Elite', 5, 2205, 408);

-- ----------------------------
-- Table structure for destinations
-- ----------------------------
DROP TABLE IF EXISTS `destinations`;
CREATE TABLE `destinations`  (
  `code` varchar(4)  NOT NULL,
  `airport` varchar(55)  NOT NULL,
  `region` varchar(55)  NOT NULL,
  PRIMARY KEY (`code`) 
);

-- ----------------------------
-- Records of destinations
-- ----------------------------
INSERT INTO `destinations` VALUES ('NZCI', 'Tuuta Aiport', 'Chatham Islands');
INSERT INTO `destinations` VALUES ('NZGB', 'Claris Aerodrome', 'Great Barrier Island');
INSERT INTO `destinations` VALUES ('NZNE', 'Dairy Flat Airport', 'North Shore');
INSERT INTO `destinations` VALUES ('NZRO', 'Rotorua Aiport', 'Rotorua');
INSERT INTO `destinations` VALUES ('NZTL', 'Lake Tekapo Airport', 'Mackenzie District');
INSERT INTO `destinations` VALUES ('YSSY', 'Sydney Kingsford Smith Airport', 'Sydney');

-- ----------------------------
-- Table structure for routes
-- ----------------------------
DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes`  (
   `routeID` varchar(3) NOT NULL,
   `point1` varchar(4) NOT NULL,
   `point2` varchar(4) NOT NULL,
   `distance` float NOT NULL,
   PRIMARY KEY (`routeID`),
   FOREIGN KEY (`point1`) REFERENCES `destinations` (`code`),
   FOREIGN KEY (`point2`) REFERENCES `destinations` (`code`)
);

-- ----------------------------
-- Records of routes
-- ----------------------------
INSERT INTO `routes` VALUES ('R01', 'NZNE', 'YSSY', 1164);
INSERT INTO `routes` VALUES ('R02', 'NZNE', 'NZRO', 137);
INSERT INTO `routes` VALUES ('R03', 'NZNE', 'NZCI', 581);
INSERT INTO `routes` VALUES ('R04', 'NZNE', 'NZGB', 54);
INSERT INTO `routes` VALUES ('R05', 'NZNE', 'NZTL', 472);

-- ----------------------------
-- Table structure for timetable
-- ----------------------------
DROP TABLE IF EXISTS `timetable`;
CREATE TABLE `timetable`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `craftID` varchar(3) NOT NULL,
  `origin` varchar(4) NOT NULL,
  `dest` varchar(4) NOT NULL,
  `depDay` varchar(3) NOT NULL,
  `depTime` varchar(8) NOT NULL,
  `Price` varchar(3) NOT NULL,
  `arrTime` varchar(8) NOT NULL,
  `seats` int NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  FOREIGN KEY (`craftID`) REFERENCES `aircraft` (`craftID`),
  FOREIGN KEY (`origin`) REFERENCES `destinations` (`code`),
  FOREIGN KEY (`dest`) REFERENCES `destinations` (`code`)
);

-- ----------------------------
-- Records of timetable
-- ----------------------------
INSERT INTO `timetable` VALUES (1, 'A01', 'NZNE', 'YSSY', 'Fri', '12:30:00', '400', '11:48:00', 6);
INSERT INTO `timetable` VALUES (2, 'A01', 'YSSY', 'NZNE', 'Sun', '15:30:00', '400', '15:48:00', 6);
INSERT INTO `timetable` VALUES (3, 'A02', 'NZNE', 'NZRO', 'Mon', '9:00:00', '80', '9:40:00', 4);
INSERT INTO `timetable` VALUES (4, 'A02', 'NZNE', 'NZRO', 'Tue', '9:00:00', '80', '9:40:00', 4);
INSERT INTO `timetable` VALUES (5, 'A02', 'NZNE', 'NZRO', 'Wed', '9:00:00', '80', '9:40:00', 4);
INSERT INTO `timetable` VALUES (6, 'A02', 'NZNE', 'NZRO', 'Thu', '9:00:00', '80', '9:40:00', 4);
INSERT INTO `timetable` VALUES (7, 'A02', 'NZNE', 'NZRO', 'Fri', '9:00:00', '80', '9:40:00', 4);
INSERT INTO `timetable` VALUES (8, 'A02', 'NZRO', 'NZNE', 'Mon', '12:00:00', '80', '12:40:00', 4);
INSERT INTO `timetable` VALUES (9, 'A02', 'NZRO', 'NZNE', 'Tue', '12:00:00', '80', '12:40:00', 4);
INSERT INTO `timetable` VALUES (10, 'A02', 'NZRO', 'NZNE', 'Wed', '12:00:00', '80', '12:40:00', 4);
INSERT INTO `timetable` VALUES (11, 'A02', 'NZRO', 'NZNE', 'Thu', '12:00:00', '80', '12:40:00', 4);
INSERT INTO `timetable` VALUES (12, 'A02', 'NZRO', 'NZNE', 'Fri', '12:00:00', '80', '12:40:00', 4);
INSERT INTO `timetable` VALUES (13, 'A02', 'NZNE', 'NZRO', 'Mon', '14:00:00', '80', '14:40:00', 4);
INSERT INTO `timetable` VALUES (14, 'A02', 'NZNE', 'NZRO', 'Tue', '14:00:00', '80', '14:40:00', 4);
INSERT INTO `timetable` VALUES (15, 'A02', 'NZNE', 'NZRO', 'Wed', '14:00:00', '80', '14:40:00', 4);
INSERT INTO `timetable` VALUES (16, 'A02', 'NZNE', 'NZRO', 'Thu', '14:00:00', '80', '14:40:00', 4);
INSERT INTO `timetable` VALUES (17, 'A02', 'NZNE', 'NZRO', 'Fri', '14:00:00', '80', '14:40:00', 4);
INSERT INTO `timetable` VALUES (18, 'A02', 'NZRO', 'NZNE', 'Mon', '21:00:00', '80', '21:40:00', 4);
INSERT INTO `timetable` VALUES (19, 'A02', 'NZRO', 'NZNE', 'Tue', '21:00:00', '80', '21:40:00', 4);
INSERT INTO `timetable` VALUES (20, 'A02', 'NZRO', 'NZNE', 'Wed', '21:00:00', '80', '21:40:00', 4);
INSERT INTO `timetable` VALUES (21, 'A02', 'NZRO', 'NZNE', 'Thu', '21:00:00', '80', '21:40:00', 4);
INSERT INTO `timetable` VALUES (22, 'A02', 'NZRO', 'NZNE', 'Fri', '21:00:00', '80', '21:40:00', 4);
INSERT INTO `timetable` VALUES (23, 'A04', 'NZNE', 'NZGB', 'Mon', '9:00:00', '50', '9:15:00', 4);
INSERT INTO `timetable` VALUES (24, 'A04', 'NZNE', 'NZGB', 'Wed', '9:00:00', '50', '9:15:00', 4);
INSERT INTO `timetable` VALUES (25, 'A04', 'NZNE', 'NZGB', 'Fri', '9:00:00', '50', '9:15:00', 4);
INSERT INTO `timetable` VALUES (26, 'A04', 'NZGB', 'NZNE', 'Tue', '8:00:00', '50', '8:15:00', 4);
INSERT INTO `timetable` VALUES (27, 'A04', 'NZGB', 'NZNE', 'Fri', '8:00:00', '50', '8:15:00', 4);
INSERT INTO `timetable` VALUES (28, 'A04', 'NZGB', 'NZNE', 'Sat', '8:00:00', '50', '8:15:00', 4);
INSERT INTO `timetable` VALUES (29, 'A03', 'NZNE', 'NZCI', 'Tue', '10:00:00', '150', '12:09:00', 5);
INSERT INTO `timetable` VALUES (30, 'A03', 'NZNE', 'NZCI', 'Fri', '10:00:00', '150', '12:09:00', 5);
INSERT INTO `timetable` VALUES (31, 'A03', 'NZCI', 'NZNE', 'Wed', '10:00:00', '150', '10:39:00', 5);
INSERT INTO `timetable` VALUES (32, 'A03', 'NZCI', 'NZNE', 'Sat', '10:00:00', '150', '10:39:00', 5);
INSERT INTO `timetable` VALUES (33, 'A05', 'NZNE', 'NZTL', 'Mon', '15:00:00', '120', '16:10:00', 5);
INSERT INTO `timetable` VALUES (34, 'A05', 'NZTL', 'NZNE', 'Fri', '15:00:00', '120', '16:10:00', 5);

-- ----------------------------
-- Table structure for userinfomation
-- ----------------------------
DROP TABLE IF EXISTS `userinfomation`;
CREATE TABLE `userinfomation`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `Reference` varchar(255) NOT NULL,
  `craftid` varchar(3) NOT NULL,
  `dep` varchar(4) NOT NULL,
  `depday` varchar(255) NOT NULL,
  `arr` varchar(4) NOT NULL,
  `arrTime` varchar(255) NOT NULL,
  `deptime` varchar(255)  NOT NULL,
  `date` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`craftid`) REFERENCES `timetable` (`craftID`),
  FOREIGN KEY (`dep`) REFERENCES `destinations` (`code`),
  FOREIGN KEY (`arr`) REFERENCES `destinations` (`code`)
);

