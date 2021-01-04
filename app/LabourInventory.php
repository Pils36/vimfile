<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabourInventory extends Model
{
    protected $fillable = ['description', 'category', 'created_at', 'updated_at'];

    protected $table = "labour_inventory";
}
