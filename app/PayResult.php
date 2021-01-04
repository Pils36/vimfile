<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayResult extends Model
{
    protected $fillable = ['transaction_id', 'email', 'fee', 'authorization_code', 'card_type', 'bank', 'country_code', 'brand', 'currency', 'created_at', 'updated_at'];

    protected $table = "payment_transaction";
}
