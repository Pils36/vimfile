<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialInventory extends Model
{
    protected $fillable = ['category', 'created_at', 'updated_at'];

    protected $table = "material_inventory";
}
