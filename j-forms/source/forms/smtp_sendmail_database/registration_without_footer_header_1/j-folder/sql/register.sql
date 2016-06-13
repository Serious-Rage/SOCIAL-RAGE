
CREATE TABLE IF NOT EXISTS `register` (
  `register_id` int(10) NOT NULL AUTO_INCREMENT,
  `register_username` varchar(255) DEFAULT NULL,
  `register_email` varchar(255) DEFAULT NULL,
  `register_password` varchar(255) DEFAULT NULL,
  `register_firstname` varchar(255) DEFAULT NULL,
  `register_lastname` varchar(255) DEFAULT NULL,
  `register_gender` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`register_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;