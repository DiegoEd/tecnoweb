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
    protected $fillable = ['color', 'font', 'imagepath', 'employee_id'];

    public function colorSelected($color) {
        if (is_null($this->color) && $this->color == $color) {
            return "selected";
        }
        return "";
    }

    public function fontSelected($font) {
        if (is_null($this->font) && $this->font == $font) {
            return "selected";
        }
        return "";
    }

    public function imagepathSelected($imagepath) {
        if (is_null($this->imagepath) && $this->imagepath == $imagepath) {
            return "checked";
        }
        return "";
    }
    
}
