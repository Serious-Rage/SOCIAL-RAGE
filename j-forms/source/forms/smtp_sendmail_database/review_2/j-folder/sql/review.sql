
CREATE TABLE IF NOT EXISTS `review` (
  `review_id` int(10) NOT NULL AUTO_INCREMENT,
  `review_firstname` varchar(255) DEFAULT NULL,
  `review_lastname` varchar(255) DEFAULT NULL,
  `review_email` varchar(255) DEFAULT NULL,
  `review_phone` varchar(255) DEFAULT NULL,
  `review_message` text,
  `review_product` int(5) DEFAULT NULL,
  `review_service` int(5) DEFAULT NULL,
  `review_delivery` int(5) DEFAULT NULL,
  `review_support` int(5) DEFAULT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;