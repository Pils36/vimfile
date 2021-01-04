<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpportunityPost extends Model
{
    protected $fillable = ['post_id', 'ref_code', 'email', 'post_subject', 'service_option', 'post_licence', 'post_make', 'post_model', 'post_mileage', 'post_curr_mileage', 'post_year', 'post_description', 'post_timeline', 'post_service_need', 'postcity', 'poststate', 'postzipcode', 'state', 'created_at', 'updated_at'];

    protected $table = "opportunitypost";
}
