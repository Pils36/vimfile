<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialInventoryRecord extends Model
{
    protected $fillable = ['estimate_id', 'material_level', 'inventory_list', 'amount', 'add_note', 'created_at', 'updated_at'];

    protected $table = "material_inventory_record";
}
