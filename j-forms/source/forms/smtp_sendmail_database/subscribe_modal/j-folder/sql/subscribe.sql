
CREATE TABLE IF NOT EXISTS `subscribe` (
  `subscribe_id` int(10) NOT NULL AUTO_INCREMENT,
  `subscribe_name` varchar(255) DEFAULT NULL,
  `subscribe_email` varchar(255) DEFAULT NULL,
  `subscribe_newsletter` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`subscribe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;