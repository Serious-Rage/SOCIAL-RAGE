
CREATE TABLE IF NOT EXISTS `error_report` (
  `error_report_id` int(10) NOT NULL AUTO_INCREMENT,
  `error_report_message` text,
  `error_report_email` varchar(255) DEFAULT NULL,
  `error_report_filename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`error_report_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;