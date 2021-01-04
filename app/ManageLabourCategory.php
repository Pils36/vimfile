<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManageLabourCategory extends Model
{
    protected $fillable = ['busID', 'labours_category', 'created_at', 'updated_at'];

    protected $table = "labour_category";
}
