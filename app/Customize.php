<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customize extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customizes';

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

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
    protected $fillable = ['color', 'font', 'imagepath'];

    
}
