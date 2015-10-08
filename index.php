<?php
/**
 * Created by PhpStorm.
 * User: salman
 * Date: 08/10/15
 * Time: 21:32
 */


require_once __DIR__ . "/vendor/autoload.php";

require_once __DIR__ . "/app/config/config.php";

$data = isset($_REQUEST) ? $_REQUEST : [];
$method = $_SERVER['REQUEST_URI']; // "post_payment" or "get_payments_report"


echo "<pre>";
echo "method: ", print_r($method, true), "\r\n";
echo "data: ", print_r($data, true), "\r\n";

// Validate URL

if (preg_match('/post_payment/', $method)) {
    processPayment($data);

} else if (preg_match('/get_payments_report/', $method)) {
    getPaymentsReport($data);
}

// Do authentication

/* TO DO: Authentication */


############# Functions ############

/**
 * Process payment
 */
function processPayment($data = array())
{
    echo "Process Payment function\n";
    $return = [];

    $required_fields = [
        'payment_amount_ex_vat',
        'vat_amount',
        'branch_id',
        'payment_vendor_id',
        'employee_id',
        'order_id',
        'payment_taken_at',
        'terminal_id',
    ];

    // Validate payment request
    foreach ($required_fields as $f) {
        if (!isset($data[$f])) {
            $return['success'] = 0;
            $return['message'][] = 'Invalid Payment Request. Missing: ' . $f;

            return output($return);
        }
    }

    // Validation passed -> Create new payment

    $payment = new Payment();
    $payment->payment_amount_ex_vat = $data['payment_amount_ex_vat'];
    $payment->vat_amount = $data['vat_amount'];
    $payment->branch_id = $data['branch_id'];
    $payment->payment_vendor_id = $data['payment_vendor_id'];
    $payment->employee_id = $data['employee_id'];
    $payment->order_id = $data['order_id'];
    $payment->payment_taken_at = $data['payment_taken_at'];
    $payment->terminal_id = $data['terminal_id'];
    $payment->created_at = \Carbon\Carbon::now();

    return output($payment->save());



}


/**
 * Return report
 */
function getPaymentsReport()
{
    echo "get payments report function";
}

function output($output = array())
{
    header('Content-Type: application/json');

    echo json_encode($output);
}