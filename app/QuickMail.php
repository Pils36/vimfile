<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuickMail extends Model
{
    protected $fillable = ['receiver', 'subject', 'message', 'sender', 'status', 'msgId', 'created_at', 'updated_at'];

    protected $table = "quickmail";
}
