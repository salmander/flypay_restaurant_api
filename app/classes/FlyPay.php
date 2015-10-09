<?php
/**
 * Created by PhpStorm.
 * User: salman
 * Date: 08/10/15
 * Time: 23:52
 */

namespace App;


class FlyPay
{
    private $data;
    private $required_fields;
    private $response;


    public function __construct($data = array())
    {
        $this->data = $data;

        $this->required_fields  = $this->getRequiredFields();
        $this->response = new Response();
    }

    public function getRequiredFields()
    {
        return  [
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
    }

    private function validatePaymentRequest()
    {
        foreach ($this->required_fields as $f) {
            if (!isset($this->data[$f])) {
                $this->response->addMessage('Missing field: ' . $f);
                return false;
            }
        }

        return true;
    }

    public function postPayment()
    {
        // Step 1: Check if the request contains required fields
        if (!$this->validatePaymentRequest()) {
            $this->response->addMessage('Invalid Payment Request.');
            return $this->output();
        }

        // Step 2: Validation passed -> Create new payment
        $payment = new \Payment();
        $payment->payment_amount_ex_vat = $this->data['payment_amount_ex_vat'];
        $payment->vat_amount = $this->data['vat_amount'];
        $payment->gratuity_amount = (isset($this->data['gratuity_amount'])) ? $this->data['gratuity_amount'] : 0;
        $payment->branch_id = $this->data['branch_id'];
        $payment->payment_vendor_id = $this->data['payment_vendor_id'];
        $payment->employee_id = $this->data['employee_id'];
        $payment->order_id = $this->data['order_id'];
        $payment->payment_taken_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $this->data['payment_taken_at']);
        $payment->terminal_id = $this->data['terminal_id'];
        $payment->created_at = \Carbon\Carbon::now();

        // Step 3: Save the payment into the database
        if ($payment->save()) {
            $this->response->setSuccess(1);
            $this->response->setPaymentId($payment->id);

            return $this->output();
        }
    }

    private function output()
    {
        header('Content-Type: application/json');

        echo $this->response->toJson();
    }

    private function authenticatePaymentRequest()
    {

    }

    public function getPaymentsReport()
    {
        echo "get payments report function";
    }
}