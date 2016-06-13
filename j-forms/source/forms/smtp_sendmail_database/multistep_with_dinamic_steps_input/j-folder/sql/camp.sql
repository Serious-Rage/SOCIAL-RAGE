
CREATE TABLE IF NOT EXISTS `camp` (
  `camp_id` int(10) NOT NULL AUTO_INCREMENT,
  `camp_child_first_name` varchar(255) DEFAULT NULL,
  `camp_child_last_name` varchar(255) DEFAULT NULL,
  `camp_name_of_school` varchar(255) DEFAULT NULL,
  `camp_grade` varchar(255) DEFAULT NULL,
  `camp_age` varchar(255) DEFAULT NULL,
  `camp_parent_first_name` varchar(255) DEFAULT NULL,
  `camp_parent_last_name` varchar(255) DEFAULT NULL,
  `camp_email` varchar(255) DEFAULT NULL,
  `camp_phone` varchar(255) DEFAULT NULL,
  `camp_message` text,
  PRIMARY KEY (`camp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;