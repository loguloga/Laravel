<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'public.question';

    public $timestamps = false;

    protected $guarded = [];

}
