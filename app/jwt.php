<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jwt extends Model
{
    protected $fillable = ['token', 'user_id','client_id'];
}
