<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;

class UserOTPDetails extends Model
{
    
    protected $table = "email_otp_verification";
    
    protected $fillable = ['email_token','email_sent_date_time_for_email_verification','	email_sent_for_email_verification','otp']; 

}
