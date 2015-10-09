/** Payment table **/
CREATE TABLE `payment` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `payment_amount_ex_vat` double(5,2) unsigned zerofill NOT NULL COMMENT 'total payment excluding vat in GBP',
    `vat_amount` double(5,2) unsigned zerofill NOT NULL COMMENT 'total vat',
    `gratuity_amount` double(5,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'tip in GBP',
    `table_id` int(11) unsigned NOT NULL DEFAULT '1' COMMENT 'table number',
    `branch_id` int(11) unsigned NOT NULL COMMENT 'restaurant location id',
    `payment_vendor_id` varchar(55) NOT NULL DEFAULT '' COMMENT 'payment reference',
    `employee_id` int(11) unsigned NOT NULL COMMENT 'served by',
    `order_id` int(11) unsigned NOT NULL COMMENT 'order number',
    `payment_taken_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'payment transaction timestamp',
    `terminal_id` int(11) unsigned NOT NULL COMMENT 'payment terminal used',
    `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `card_type_id` int(11) unsigned NOT NULL COMMENT 'from card_types table',
    PRIMARY KEY (`id`),
    KEY `table_id` (`table_id`),
    KEY `branch_id` (`branch_id`),
    KEY `payment_vendor_id` (`payment_vendor_id`),
    KEY `employee_id` (`employee_id`),
    KEY `order_id` (`order_id`),
    KEY `terminal_id` (`terminal_id`),
    KEY `card_type_id` (`card_type_id`)
)
ENGINE=InnoDB
AUTO_INCREMENT=1 
DEFAULT CHARSET=latin1;

/** Payment Type table **/
CREATE TABLE `payment_type` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `description` varchar(25) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
) 
ENGINE=InnoDB
AUTO_INCREMENT=1
DEFAULT CHARSET=latin1;

/** Order header table **/
CREATE TABLE `order_header` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
AUTO_INCREMENT=1;

/** Branch/Location table */
CREATE TABLE `branch` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL,
	`address1` VARCHAR(60) NOT NULL,
	`address2` VARCHAR(60) NOT NULL,
	`Address3` VARCHAR(60) NOT NULL,
	`town` VARCHAR(30) NOT NULL,
	`county` VARCHAR(30) NOT NULL,
	`postcode` VARCHAR(8) NOT NULL,
	`telephone` VARCHAR(20) NOT NULL,
	`fax` VARCHAR(20) NOT NULL,
	`manager_id` SMALLINT(5) UNSIGNED NOT NULL,
	`assistant_manager_id` SMALLINT(5) UNSIGNED NOT NULL,
	`latitude` DOUBLE(9,6) NULL DEFAULT NULL,
	`longitude` DOUBLE(9,6) NULL DEFAULT NULL,
	`email` VARCHAR(255) NOT NULL,
	`established` ENUM('Y','N') NOT NULL DEFAULT 'N',
	PRIMARY KEY (`id`)
)
	COMMENT='List of Restaurant branches'
	COLLATE='latin1_swedish_ci'
	ENGINE=InnoDB
;

/** Employees table */
CREATE TABLE `employees` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	`start_date` TIMESTAMP NULL DEFAULT NULL,
	`title` VARCHAR(10) NOT NULL,
	`first_name` VARCHAR(50) NOT NULL,
	`middle_name` VARCHAR(50) NOT NULL,
	`last_name` VARCHAR(50) NOT NULL,
	`dob` DATE NULL DEFAULT NULL,
	`address1` VARCHAR(50) NULL DEFAULT NULL,
	`address2` VARCHAR(50) NULL DEFAULT NULL,
	`address3` VARCHAR(50) NULL DEFAULT NULL,
	`address4` VARCHAR(50) NULL DEFAULT NULL,
	`postcode` VARCHAR(20) NULL DEFAULT NULL,
	`tel` VARCHAR(30) NULL DEFAULT NULL,
	`mobile` VARCHAR(30) NULL DEFAULT NULL,
	`contract_type` CHAR(3) NULL DEFAULT NULL,
	`branch_id` SMALLINT(6) NOT NULL,
	`job_title` VARCHAR(40) NULL DEFAULT NULL,
	`job_description` VARCHAR(50) NULL DEFAULT NULL,
	`leaving_date` DATE NULL DEFAULT NULL,
	`reason_for_leaving` MEDIUMTEXT NULL,
	`contract_end_date` DATE NULL DEFAULT '0000-00-00',
	PRIMARY KEY (`id`),
	INDEX `branch` (`branch_id`)
)
	COLLATE='latin1_swedish_ci'
	ENGINE=InnoDB
	AUTO_INCREMENT=1
;

/** Order Line table */
CREATE TABLE `order_line` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
