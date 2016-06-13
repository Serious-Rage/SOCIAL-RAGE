
CREATE TABLE IF NOT EXISTS `party` (
  `party_id` int(10) NOT NULL AUTO_INCREMENT,
  `party_you_make_it` varchar(255) DEFAULT NULL,
  `party_guest_quantity` varchar(255) DEFAULT NULL,
  `party_friends` text,
  `party_message` text,
  PRIMARY KEY (`party_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;