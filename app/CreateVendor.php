<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreateVendor extends Model
{
    protected $fillable = ['busID', 'vendor_code', 'vendor_name', 'vendor_salesrep', 'vendor_address', 'vendor_country', 'vendor_state', 'vendor_city', 'vendor_email', 'vendor_phone', 'vendor_fax', 'vendor_createdby', 'created_at', 'updated_at' ];

    protected $table = "create_vendor";
}
