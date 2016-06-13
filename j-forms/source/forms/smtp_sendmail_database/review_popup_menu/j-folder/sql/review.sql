
CREATE TABLE IF NOT EXISTS `review` (
  `review_id` int(10) NOT NULL AUTO_INCREMENT,
  `review_name` varchar(255) DEFAULT NULL,
  `review_email` varchar(255) DEFAULT NULL,
  `review_message` text,
  `review_product` int(5) DEFAULT NULL,
  `review_service` int(5) DEFAULT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;