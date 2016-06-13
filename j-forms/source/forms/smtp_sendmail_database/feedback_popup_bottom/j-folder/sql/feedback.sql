
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(10) NOT NULL AUTO_INCREMENT,
  `feedback_name` varchar(255) DEFAULT NULL,
  `feedback_email` varchar(255) DEFAULT NULL,
  `feedback_department` varchar(255) DEFAULT NULL,
  `feedback_message` text,
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;