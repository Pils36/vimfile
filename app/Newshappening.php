<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newshappening extends Model
{
    protected $fillable = ['post_id', 'subject', 'description', 'file_upload', 'state', 'created_at', 'updated_at'];

    protected $table = "news_happening";
}
