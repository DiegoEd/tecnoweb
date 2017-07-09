<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employees';

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
    protected $fillable = ['name', 'lastname', 'sex', 'age', 'career', 'username', 'password', 'email'];

    public function maleSelected() {
        if (!is_null($this->sex) && $this->sex == "Masculino") {
            return "selected";
        }
        return "";
    }

    public function femaleSelected() {
        if (!is_null($this->sex) && $this->sex == "Femenino") {
            return "selected";
        }
        return "";
    }
    
}
