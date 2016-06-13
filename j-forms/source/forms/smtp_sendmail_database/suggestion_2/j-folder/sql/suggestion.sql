
CREATE TABLE IF NOT EXISTS `suggestion` (
  `suggestion_id` int(10) NOT NULL AUTO_INCREMENT,
  `suggestion_name` varchar(255) DEFAULT NULL,
  `suggestion_email` varchar(255) DEFAULT NULL,
  `suggestion_department` varchar(255) DEFAULT NULL,
  `suggestion_subject` varchar(255) DEFAULT NULL,
  `suggestion_filename` varchar(255) DEFAULT NULL,
  `suggestion_info` text,
  PRIMARY KEY (`suggestion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;