<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = ['busID', 'post_id', 'vendor', 'purchase_order_no', 'order_date', 'expected_date', 'purchase_order_inventory_item', 'purchase_order_qty', 'purchase_order_rate', 'purchase_order_totcost', 'purchase_order_shippingcost', 'purchase_order_discount', 'purchase_order_othercost', 'purchase_order_tax', 'purchase_order_totalpurchaseorder', 'purchase_order_shipto', 'purchase_order_address1', 'purchase_order_address2', 'purchase_order_city', 'purchase_order_state', 'purchase_order_country', 'purchase_order_zip', 'purchase_order_destphone', 'purchase_order_destfax', 'purchase_order_destmail', 'purchase_order_orderby', 'receive_order', 'make_payment', 'move_to_inventory', 'created_at', 'updated_at'];

    protected $table = "purchase_order";
}

