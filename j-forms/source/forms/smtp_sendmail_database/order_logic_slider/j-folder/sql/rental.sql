
CREATE TABLE IF NOT EXISTS `rental` (
  `rental_id` int(10) NOT NULL AUTO_INCREMENT,
  `rental_apartment_type` varchar(255) DEFAULT NULL,
  `rental_bedrooms` varchar(255) DEFAULT NULL,
  `rental_bathrooms` varchar(255) DEFAULT NULL,
  `rental_feets` varchar(255) DEFAULT NULL,
  `rental_feets_price` varchar(255) DEFAULT NULL,
  `rental_totals` varchar(255) DEFAULT NULL,
  `rental_name` varchar(255) DEFAULT NULL,
  `rental_email` varchar(255) DEFAULT NULL,
  `rental_phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`rental_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;