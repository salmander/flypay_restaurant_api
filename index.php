<?php

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/app/config/config.php";

$data = isset($_REQUEST) ? $_REQUEST : []; // GET or POST data payload
$method = $_SERVER['REQUEST_URI']; // "post_payment" or "get_payments_report"

// Validate URL and call respective function
if (preg_match('/^\/post_payment/', $method)) { // For post_payment request
    $flypay = new \App\FlyPay($data);
    $flypay->postPayment();

} else if (preg_match('/^\/get_payments_report/', $method)) { // For get_payments_report request
    $flypay = new \App\FlyPay($data);
    $flypay->getPaymentsReport();

} else {
    return output(['success' => 0, 'message' => 'Invalid method called']);

}

/* TO DO: Authentication */
