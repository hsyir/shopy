<?php

namespace Hsy\Store\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $casts = [
        'extra_data'=> 'array',
    ];
}
