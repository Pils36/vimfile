<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticketing extends Model
{
    protected $fillable = ['ticketID', 'ticketName', 'ticketEmail', 'ticketSubject', 'ticketDepartment', 'ticketRelatedServices', 'ticketPriority', 'ticketMessage', 'ticketAttachment', 'ticketUsertype', 'created_at', 'updated_at'];

    protected $table = "ticketing";
}
