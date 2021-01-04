<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addpart extends Model
{
    protected $fillable = ['busID', 'post_id', 'part_no', 'description', 'category', 'upload', 'vendor_code', 'vendor', 'manufacturer', 'location', 'quantity', 'unit_cost', 'total_cost', 'mark_up', 'discount', 'unit_price', 'total_discount', 'tax_rate', 'total_price', 'technician', 'created_at', 'updated_at'];

    protected $table = "add_part";
}
