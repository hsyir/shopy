<?php

namespace Hsy\Shopy\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $casts = [
        'extra_data'=> 'array',
    ];
}
