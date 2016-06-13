
CREATE TABLE IF NOT EXISTS `callback` (
  `callback_id` int(10) NOT NULL AUTO_INCREMENT,
  `callback_name` varchar(255) DEFAULT NULL,
  `callback_phone` varchar(255) DEFAULT NULL,
  `callback_time` varchar(255) DEFAULT NULL,
  `callback_info` text,
  PRIMARY KEY (`callback_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;