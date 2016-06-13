
CREATE TABLE IF NOT EXISTS `step` (
  `step_id` int(10) NOT NULL AUTO_INCREMENT,
  `step_name` varchar(255) DEFAULT NULL,
  `step_way_to_communicate` varchar(255) DEFAULT NULL,
  `step_email` varchar(255) DEFAULT NULL,
  `step_email_message` text,
  `step_phone` varchar(255) DEFAULT NULL,
  `step_time` varchar(255) DEFAULT NULL,
  `step_phone_message` text,
  PRIMARY KEY (`step_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;