<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManageLabour extends Model
{
    protected $fillable = ['busID', 'labours_description', 'labours_categories', 'hour', 'rate_per_hour', 'flat_rate', 'wholesale_rate', 'retail_rate', 'detailed_description', 'labour_video', 'labour_note', 'created_at', 'updated_at'];

    protected $table = "manage_labour";
}
