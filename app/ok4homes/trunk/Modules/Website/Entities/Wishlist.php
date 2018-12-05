<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wishlist extends Model
{
    protected $table = "add_to_wishlist"; 
    protected $fillable = ['user_id','property_id'];
}
