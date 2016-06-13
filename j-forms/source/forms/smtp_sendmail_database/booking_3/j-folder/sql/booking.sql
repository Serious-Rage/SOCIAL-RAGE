
CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` int(10) NOT NULL AUTO_INCREMENT,
  `booking_name` varchar(255) DEFAULT NULL,
  `booking_email` varchar(255) DEFAULT NULL,
  `booking_phone` varchar(255) DEFAULT NULL,
  `booking_rooms` int(5) DEFAULT NULL,
  `booking_adults` int(5) DEFAULT NULL,
  `booking_children` int(5) DEFAULT NULL,
  `booking_date_from` varchar(255) DEFAULT NULL,
  `booking_date_to` varchar(255) DEFAULT NULL,
  `booking_message` text,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;