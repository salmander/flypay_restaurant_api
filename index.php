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

// Validate URL and call respective function

if (preg_match('/^\/post_payment/', $method)) {

    $flypay = new \App\FlyPay($data);
    $flypay->postPayment();

    //processPayment($data);

} else if (preg_match('/^\/get_payments_report/', $method)) {
    getPaymentsReport($data);

} else {
    return output(['success' => 0, 'message' => 'Invalid method called']);

}

// Do authentication

/* TO DO: Authentication */


############# Functions ############

/**
 * Process payment
 */
function processPayment($data = array())
{
    $return = [];

    $required_fields = [
        'payment_amount_ex_vat',        // payment total excluding VAT
        'vat_amount',                   // total VAT
        'gratuity_amount',              // tip
        'table_id',                     // table number
        'branch_id',                    // the ID of the restaurant location where the table is at
        'payment_vendor_id',            // a payment reference for the third party (who created the payment)
        'payment_taken_at',             // timestamp provided in the request
        'employee_id',                  // who served the customer
        'order_id',                     // unique order reference
        'terminal_id',                  // payment terminal used
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
    $payment->gratuity_amount = (isset($data['gratuity_amount'])) ? $data['gratuity_amount'] : 0;
    $payment->branch_id = $data['branch_id'];
    $payment->payment_vendor_id = $data['payment_vendor_id'];
    $payment->employee_id = $data['employee_id'];
    $payment->order_id = $data['order_id'];
    $payment->payment_taken_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $data['payment_taken_at']);
    $payment->terminal_id = $data['terminal_id'];
    $payment->created_at = \Carbon\Carbon::now();

    // Save it into the database
    if ($payment->save()) {
        $return['success'] = 1;
        $return['payment_id'] = $payment->id;

        output($return);
    }

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