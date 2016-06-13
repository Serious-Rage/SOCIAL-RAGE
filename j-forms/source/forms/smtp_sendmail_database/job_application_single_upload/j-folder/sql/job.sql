
CREATE TABLE IF NOT EXISTS `job` (
  `job_id` int(10) NOT NULL AUTO_INCREMENT,
  `job_firstname` varchar(255) DEFAULT NULL,
  `job_lastname` varchar(255) DEFAULT NULL,
  `job_email` varchar(255) DEFAULT NULL,
  `job_phone` varchar(255) DEFAULT NULL,
  `job_country` varchar(255) DEFAULT NULL,
  `job_city` varchar(255) DEFAULT NULL,
  `job_postcode` varchar(255) DEFAULT NULL,
  `job_address` varchar(255) DEFAULT NULL,
  `job_position` varchar(255) DEFAULT NULL,
  `job_filename` varchar(255) DEFAULT NULL,
  `job_info` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;