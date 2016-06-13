
CREATE TABLE IF NOT EXISTS `recovery` (
  `recovery_id` int(10) NOT NULL AUTO_INCREMENT,
  `recovery_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`recovery_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;