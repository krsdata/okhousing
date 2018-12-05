<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    protected $table = "property_enquiry"; 
    protected $fillable = ['name','email','phone','message','subject','property_id'];
}
