﻿CREATE TABLE `order_header` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`transaction_reference` VARCHAR(45) NULL DEFAULT NULL,
	`contact_name` VARCHAR(45) NULL DEFAULT NULL,
	`telephone` VARCHAR(45) NULL DEFAULT NULL,
	`order_date` TIMESTAMP NULL DEFAULT NULL,
	`address_status` VARCHAR(45) NULL DEFAULT NULL,
	`currency` VARCHAR(45) NULL DEFAULT NULL,
	`special_instructions` TEXT NULL,
	`order_received` TIMESTAMP NULL DEFAULT NULL,
	`order_status_id` INT(11) NOT NULL,
	`branch_id` INT(3) NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX `transaction_reference` (`transaction_reference`),
	INDEX `fk_order_header_order_status1_idx` (`order_status_id`),
	INDEX `branch_id` (`branch_id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1
;


﻿CREATE TABLE `branch` (
	`id` SMALLINT(4) UNSIGNED NOT NULL DEFAULT '0',
	`name` VARCHAR(50) NOT NULL,
	`address1` VARCHAR(60) NOT NULL COLLATE 'utf8_general_ci',
	`address2` VARCHAR(60) NOT NULL COLLATE 'utf8_general_ci',
	`Address3` VARCHAR(60) NOT NULL COLLATE 'utf8_general_ci',
	`town` VARCHAR(30) NOT NULL COLLATE 'utf8_general_ci',
	`county` VARCHAR(30) NOT NULL COLLATE 'utf8_general_ci',
	`postcode` VARCHAR(8) NOT NULL COLLATE 'utf8_general_ci',
	`telephone` VARCHAR(20) NOT NULL COLLATE 'utf8_general_ci',
	`fax` VARCHAR(20) NOT NULL COLLATE 'utf8_general_ci',
	`managerID` SMALLINT(5) UNSIGNED NOT NULL,
	`assistant_manager_id` SMALLINT(5) UNSIGNED NOT NULL,
	`latitude` DOUBLE(9,6) NULL DEFAULT NULL,
	`longitude` DOUBLE(9,6) NULL DEFAULT NULL,
	`email` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
	`established` ENUM('Y','N') NOT NULL DEFAULT 'N' COLLATE 'utf8_general_ci',
	PRIMARY KEY (`id`),
)
	COMMENT='List of Restaurant branches'
	COLLATE='latin1_swedish_ci'
	ENGINE=InnoDB
;

﻿CREATE TABLE `employees` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	`start_date` TIMESTAMP NULL DEFAULT NULL,
	`title` VARCHAR(10) NOT NULL COLLATE 'utf8_general_ci',
	`first_name` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`middle_name` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`last_name` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`dob` DATE NULL DEFAULT NULL,
	`address1` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`address2` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`address3` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`address4` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`postcode` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`tel` VARCHAR(30) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`mobile` VARCHAR(30) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`contract_type` CHAR(3) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`branch_id` SMALLINT(6) NOT NULL,
	`jobtitle` VARCHAR(40) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`jobdescription` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`leaving_date` DATE NULL DEFAULT NULL,
	`reason_for_leaving` MEDIUMTEXT NULL COLLATE 'utf8_general_ci',
	`contract_end_date` DATE NULL DEFAULT '0000-00-00',
	PRIMARY KEY (`id`),
	INDEX `branch` (`branch_id`)
)
	COLLATE='latin1_swedish_ci'
	ENGINE=InnoDB
	AUTO_INCREMENT=1
;


﻿CREATE TABLE `order_line` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`order_header_id` INT(11) NOT NULL,
	`product_id` INT(10) UNSIGNED NOT NULL,
	`qty` SMALLINT(6) NOT NULL,
	`title` VARCHAR(45) NOT NULL,
	`price` DOUBLE(4,2) NOT NULL,
	`vat_total` DOUBLE(4,2) NOT NULL,
	`notes` TEXT NULL,
	PRIMARY KEY (`id`),
	INDEX `fk_e_order_line_order_header1_idx` (`order_header_id`),
	INDEX `fk_e_order_line_product1_idx` (`product_id`)
)
	COLLATE='latin1_swedish_ci'
	ENGINE=InnoDB
	AUTO_INCREMENT=1
;
