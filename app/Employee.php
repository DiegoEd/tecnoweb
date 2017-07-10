<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employees';

    public function user() {
        return $this->belongsTo(User::class);
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
    protected $fillable = ['name', 'lastname', 'sex', 'age', 'career', 'user_id'];

    public function sexSelected($sex) {
        if (!is_null($this->sex) && $this->sex == $sex) {
            return "selected";
        }
        return "";
    }
    
}
