
CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(10) NOT NULL AUTO_INCREMENT,
  `login_login` varchar(255) DEFAULT NULL,
  `login_password` varchar(255) DEFAULT NULL,
  `login_loggedin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;