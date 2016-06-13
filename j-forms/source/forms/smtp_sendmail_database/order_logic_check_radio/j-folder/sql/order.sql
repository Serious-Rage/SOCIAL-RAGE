
CREATE TABLE IF NOT EXISTS `cake` (
	`cake_id` int(10) NOT NULL AUTO_INCREMENT,
	`cake_cake_size` varchar(255) DEFAULT NULL,
	`cake_filling` varchar(255) DEFAULT NULL,
	`cake_candles` varchar(255) DEFAULT NULL,
	`cake_show_inscription` varchar(255) DEFAULT NULL,
	`cake_inscription` varchar(255) DEFAULT NULL,
	`cake_delivery` varchar(255) DEFAULT NULL,
	`cake_name` varchar(255) DEFAULT NULL,
	`cake_phone` varchar(255) DEFAULT NULL,
	`cake_email` varchar(255) DEFAULT NULL,
	`cake_address` varchar(255) DEFAULT NULL,
	PRIMARY KEY (`cake_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;