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

    public function customize() {
        return $this->hasOne(Customize::class);
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
    protected $fillable = ['name', 'lastname', 'sex', 'age', 'career'];

    public function sexSelected($sex) {
        if (!is_null($this->sex) && $this->sex == $sex) {
            return "selected";
        }
        return "";
    }
    
}
