
CREATE TABLE IF NOT EXISTS `travel` (
  `travel_id` int(10) NOT NULL AUTO_INCREMENT,
  `travel_name` varchar(255) DEFAULT NULL,
  `travel_phone` varchar(255) DEFAULT NULL,
  `travel_email` varchar(255) DEFAULT NULL,
  `travel_pickup_date` varchar(255) DEFAULT NULL,
  `travel_return_date` varchar(255) DEFAULT NULL,
  `travel_next_step` varchar(255) DEFAULT NULL,
  `travel_airport` varchar(255) DEFAULT NULL,
  `travel_airline_flight_number` varchar(255) DEFAULT NULL,
  `travel_pickup_address` varchar(255) DEFAULT NULL,
  `travel_drop_off` varchar(255) DEFAULT NULL,
  `travel_message` text,
  PRIMARY KEY (`travel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;