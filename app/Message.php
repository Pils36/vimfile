<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['sent_to', 'subject', 'message', 'file', 'msg_read', 'msg_sent', 'msg_draft', 'msg_trash', 'receiver_id', 'sender_id', 'created_at', 'updated_at'];

    protected $table = "compose_message";
}
