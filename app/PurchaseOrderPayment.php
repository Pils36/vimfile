<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderPayment extends Model
{
    protected $fillable = ['busID', 'vendor_email', 'post_id', 'pay_type', 'pay_po_number', 'pay_order_date', 'pay_date_expected', 'pay_invent_item', 'pay_description_of_item', 'pay_quantity', 'pay_rate', 'pay_tot_cost', 'pay_shipping_cost', 'pay_discount', 'pay_othercosts', 'pay_tax', 'pay_po_total', 'pay_advance', 'pay_balance', 'pay_cashamount', 'pay_chequeno', 'pay_chequedate', 'pay_chequeamount', 'pay_credit', 'pay_cc', 'pay_cardamount', 'pay_grandtotal', 'created_at', 'updated_at'];

    protected $table = "purchase_order_payment";
}

