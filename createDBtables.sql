/*ALF_DB table creations*/

CREATE TABLE `catalog` (
  `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` VARCHAR(20),
  `table_name` VARCHAR(20),
  `type` VARCHAR(20),
  `spanish_value` TEXT CHARACTER SET latin1,
  `english_value` TEXT CHARACTER SET latin1,
  `description` VARCHAR(100),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;