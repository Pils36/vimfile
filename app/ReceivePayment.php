<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivePayment extends Model
{
    protected $fillable = ['busID', 'vehicle_licence', 'maintenace_date', 'service_option', 'service_type', 'total_bill_amount', 'deposit_made', 'additional_payment', 'cash_payment_amount', 'cheque_no', 'cheque_date', 'cheque_amount', 'creditcard_no', 'creditcard_cc', 'creditcard_amount', 'total_payment_made', 'spec_payment_type', 'gateway', 'created_at', 'updated_at'];


    protected $table = "receive_payment";
}
