CREATE DATABASE IF NOT EXISTS contactDb;

USE contactDb;

CREATE TABLE IF NOT EXISTS `status` (
  `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` INT(11) unsigned NOT NULL,
  `value` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `value` (`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `contact` (
  `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
  `phoneNumber` VARCHAR(20) NOT NULL,
  `statusId` INT(11) unsigned NOT NULL,
  `operatorId` INT(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phoneNumber` (`phoneNumber`),
  KEY `statusId` (`statusId`),
  KEY `operatorId` (`operatorId`),
  CONSTRAINT `fk_contact_to_status` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Add the status list */
INSERT INTO `status` (`code`,`value`) VALUES
(0,'have not called yet'),
(1,'closed'),
(2,'busy'),
(3,'no answer'),
(4,'call back'),
(5,'refusal');

