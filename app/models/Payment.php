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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
 *
 */

/**
 * Class Payment
 */
class Payment extends Illuminate\Database\Eloquent\Model {

    protected $table = 'payment';
    public $timestamps = false;
    protected $dates = ['created_at', 'payment_taken_at'];


    public function setPaymentTakenAtAttribute($date)
    {
        $this->attributes['payment_taken_at'] = \Carbon\Carbon::parse($date);
    }

    public function scopeSinceHoursAgo($query, $hours = 24)
    {
        return $query->where('payment_taken_at', '>=', \Carbon\Carbon::now()->subHours($hours))->orderBy('id', 'desc');
    }

    /**
     * Get the payment type associated with the payment.
     */
    public function payment_type()
    {
        return $this->belongsTo('\PaymentType');
    }
}