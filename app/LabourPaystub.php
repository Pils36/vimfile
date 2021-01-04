<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabourPaystub extends Model
{
    protected $fillable = ['estimate_id', 'busID', 'licence', 'make', 'model', 'date', 'service_type', 'service_option', 'hour', 'rate', 'pay_due', 'technician', 'pay_stub', 'start_date', 'end_date', 'deduction', 'balance', 'total_pay', 'cash_amount', 'cheque_no', 'cheque_date', 'cheque_amout', 'creditcard_no', 'creditcard_cc', 'creditcard_amount', 'total_amount', 'created_at', 'updated_at'];

    protected $table = "labour_paystub";
}
