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

    public function customize() {
        return $this->hasOne(Customize::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public static function intrash()
    {
        return Employee::withTrashed()->whereNotNull('deleted_at')->get();
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
