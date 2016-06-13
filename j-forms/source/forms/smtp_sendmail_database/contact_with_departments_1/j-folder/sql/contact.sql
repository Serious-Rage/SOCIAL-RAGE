
CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` int(10) NOT NULL AUTO_INCREMENT,
  `contact_sendername` varchar(255) DEFAULT NULL,
  `contact_senderemail` varchar(255) DEFAULT NULL,
  `contact_senderphone` varchar(255) DEFAULT NULL,
  `contact_recipientname` varchar(255) DEFAULT NULL,
  `contact_recipientemail` varchar(255) DEFAULT NULL,
  `contact_subject` varchar(255) DEFAULT NULL,
  `contact_firstfilename` varchar(255) DEFAULT NULL,
  `contact_secondfilename` varchar(255) DEFAULT NULL,
  `contact_message` text,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;