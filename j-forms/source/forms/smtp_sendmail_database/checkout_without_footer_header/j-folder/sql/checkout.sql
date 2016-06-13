
CREATE TABLE IF NOT EXISTS `checkout` (
  `checkout_id` int(10) NOT NULL AUTO_INCREMENT,
  `checkout_firstname` varchar(255) DEFAULT NULL,
  `checkout_lastname` varchar(255) DEFAULT NULL,
  `checkout_email` varchar(255) DEFAULT NULL,
  `checkout_phone` varchar(255) DEFAULT NULL,
  `checkout_country` varchar(255) DEFAULT NULL,
  `checkout_city` varchar(255) DEFAULT NULL,
  `checkout_postcode` int(15) DEFAULT NULL,
  `checkout_address` varchar(255) DEFAULT NULL,
  `checkout_info` varchar(255) DEFAULT NULL,
  `checkout_payment` varchar(255) DEFAULT NULL,
  `checkout_cardname` varchar(255) DEFAULT NULL,
  `checkout_cardnumber` varchar(255) DEFAULT NULL,
  `checkout_cvv2` int(10) DEFAULT NULL,
  `checkout_cardmonth` varchar(255) DEFAULT NULL,
  `checkout_cardyear` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`checkout_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;