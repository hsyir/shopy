<?php

namespace Hsy\Store\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $casts = [
        'extra_data'=> 'array',
    ];
}
