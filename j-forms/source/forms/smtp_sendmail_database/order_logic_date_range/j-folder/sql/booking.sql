
CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` int(10) NOT NULL AUTO_INCREMENT,
  `booking_date_from` varchar(255) DEFAULT NULL,
  `booking_date_to` varchar(255) DEFAULT NULL,
  `booking_room_type` varchar(255) DEFAULT NULL,
  `booking_extra_service` varchar(255) DEFAULT NULL,
  `booking_total_room_price` varchar(255) DEFAULT NULL,
  `booking_total_extra_service` varchar(255) DEFAULT NULL,
  `booking_totals` varchar(255) DEFAULT NULL,
  `booking_name` varchar(255) DEFAULT NULL,
  `booking_email` varchar(255) DEFAULT NULL,
  `booking_phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;