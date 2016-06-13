
CREATE TABLE IF NOT EXISTS `notebook` (
	`notebook_id` int(10) NOT NULL AUTO_INCREMENT,
	`notebook_notebook` varchar(255) DEFAULT NULL,
	`notebook_notebook_model` varchar(255) DEFAULT NULL,
	`notebook_notebook_model_action` varchar(255) DEFAULT NULL,
	`notebook_software` varchar(255) DEFAULT NULL,
	`notebook_courier` varchar(255) DEFAULT NULL,
	`notebook_total_service` varchar(255) DEFAULT NULL,
	`notebook_name` varchar(255) DEFAULT NULL,
	`notebook_phone` varchar(255) DEFAULT NULL,
	`notebook_email` varchar(255) DEFAULT NULL,
	`notebook_address` varchar(255) DEFAULT NULL,
	PRIMARY KEY (`notebook_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;