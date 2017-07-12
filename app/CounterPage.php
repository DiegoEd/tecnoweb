<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CounterPage extends Model
{

    protected $table = 'counter_pages';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['pageroute','visitcount'];

    
}