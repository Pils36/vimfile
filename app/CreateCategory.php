<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreateCategory extends Model
{
   protected $fillable = ['busID', 'category', 'description', 'created_at', 'updated_at'];

   protected $table = "create_category";
}
