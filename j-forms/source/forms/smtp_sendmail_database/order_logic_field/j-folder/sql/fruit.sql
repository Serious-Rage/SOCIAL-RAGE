
CREATE TABLE IF NOT EXISTS `fruits` (
	`fruits_id` int(10) NOT NULL AUTO_INCREMENT,
	`fruits_first_field` varchar(255) DEFAULT NULL,
	`fruits_first_field_quantity` varchar(255) DEFAULT NULL,
	`fruits_first_field_price` varchar(255) DEFAULT NULL,
	`fruits_first_field_total` varchar(255) DEFAULT NULL,
	`fruits_second_field` varchar(255) DEFAULT NULL,
	`fruits_second_field_quantity` varchar(255) DEFAULT NULL,
	`fruits_second_field_price` varchar(255) DEFAULT NULL,
	`fruits_second_field_total` varchar(255) DEFAULT NULL,
	`fruits_third_field` varchar(255) DEFAULT NULL,
	`fruits_third_field_quantity` varchar(255) DEFAULT NULL,
	`fruits_third_field_price` varchar(255) DEFAULT NULL,
	`fruits_third_field_total` varchar(255) DEFAULT NULL,
	`fruits_field_totals` varchar(255) DEFAULT NULL,
	`fruits_name` varchar(255) DEFAULT NULL,
	`fruits_email` varchar(255) DEFAULT NULL,
	`fruits_phone` varchar(255) DEFAULT NULL,
	PRIMARY KEY (`fruits_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;