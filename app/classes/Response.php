<?php
/**
 * Created by PhpStorm.
 * User: salman
 * Date: 09/10/15
 * Time: 00:21
 */

namespace App;


class Response
{
    private $success;
    private $message;
    private $payment_id;

    public function __construct()
    {
        $this->setSuccess(0);
        $this->message = '';
        $this->setPaymentId(false);
    }

    public function setSuccess($d)
    {
        $this->success = $d;
    }

    public function setPaymentId($id = false)
    {
        $this->payment_id = $id;
    }


    public function addMessage($msg = '')
    {
        $this->message[] = $msg;
    }

    public function toJson()
    {
        $resp = [
            'success' => $this->success,
            'message' => $this->message,
        ];


        if ($this->payment_id) {
            $resp['payment_id'] = $this->payment_id;
        }

        return json_encode($resp);
    }
}