<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayPlan extends Model
{
    protected $fillable = ['email', 'transaction_id', 'plan', 'free', 'lite', 'litecommercial', 'startup', 'basic', 'classic', 'super', 'gold', 'userType', 'currency', 'payment_status', 'subscription_plan', 'date_from', 'date_to', 'created_at', 'updated_at'];

    protected $table = "payment_plan";
}
