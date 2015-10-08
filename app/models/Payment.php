<?php
/**
 * Created by PhpStorm.
 * User: salman
 * Date: 08/10/15
 * Time: 22:08
 */

/**
 *
 * Payment table schema:

CREATE TABLE `payment` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `payment_amount_ex_vat` double(5,2) unsigned zerofill NOT NULL,
    `vat_amount` double(5,2) unsigned zerofill NOT NULL,
    `branch_id` int(11) unsigned NOT NULL COMMENT 'restaurant location id',
    `payment_vendor_id` varchar(55) NOT NULL DEFAULT '' COMMENT 'payment reference',
    `employee_id` int(11) unsigned NOT NULL,
    `order_id` int(11) unsigned NOT NULL,
    `payment_taken_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `terminal_id` int(11) unsigned NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `card_type_id` int(11) unsigned NOT NULL COMMENT 'from card_types table',
    `gratuity_amount` double(5,2) unsigned DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 *
 */

/**
 * Class User
 */
class Payment extends Illuminate\Database\Eloquent\Model {

    protected $table = 'payment';
    public $timestamps = false;
    protected $dates = ['created_at', 'payment_taken_at'];


}