<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class history_user extends Model
{
    protected $fillable = ['time', 'date','client_id','week','year'];
}
