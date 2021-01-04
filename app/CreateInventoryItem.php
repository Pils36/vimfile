<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreateInventoryItem extends Model
{
    protected $fillable = ['busID', 'post_id', 'part_no', 'description', 'category', 'upccode', 'location', 'qtyathand', 'createdby', 'created_at', 'updated_at'];

    protected $table = "create_inventory_item";
}
