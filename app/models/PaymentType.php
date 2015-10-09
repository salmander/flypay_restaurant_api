<?php
/**
 * Created by PhpStorm.
 * User: salman
 * Date: 08/10/15
 * Time: 21:45
 */

/**
 *
 * Payment table schema:

CREATE TABLE `payment_type` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `description` varchar(25) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
 *
 */

/**
 * Class Payment
 */
class PaymentType extends Illuminate\Database\Eloquent\Model {

    protected $table = 'payment_type';
    public $timestamps = false;


}