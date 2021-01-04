<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstimatePay extends Model
{
    protected $fillable = ['transactionid', 'name', 'email', 'amount', 'currency', 'station', 'post_id', 'estimate_id', 'ReceiptId', 'ReferenceNum', 'ResponseCode', 'ISO', 'AuthCode', 'TransTime', 'TransDate', 'TransType', 'Complete', 'Message', 'TransAmount', 'CardType', 'TransID', 'TimedOut', 'Ticket', 'IssuerId', 'IsVisaDebit', 'gateway', 'state', 'created_at', 'updated_at'];

    protected $table = "estimatepay";
}
