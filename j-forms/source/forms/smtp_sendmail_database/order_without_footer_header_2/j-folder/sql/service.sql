
CREATE TABLE IF NOT EXISTS `service` (
  `service_id` int(10) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) DEFAULT NULL,
  `service_company` varchar(255) DEFAULT NULL,
  `service_email` varchar(255) DEFAULT NULL,
  `service_phone` varchar(255) DEFAULT NULL,
  `service_service` varchar(255) DEFAULT NULL,
  `service_budget` varchar(255) DEFAULT NULL,
  `service_datefrom` varchar(255) DEFAULT NULL,
  `service_dateto` varchar(255) DEFAULT NULL,
  `service_filename` varchar(255) DEFAULT NULL,
  `service_message` text,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
