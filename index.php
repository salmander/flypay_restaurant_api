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

} else if (preg_match('/^\/get_payments_report/', $method)) {
    getPaymentsReport($data);

} else {
    return output(['success' => 0, 'message' => 'Invalid method called']);

}

// Do authentication

/* TO DO: Authentication */
