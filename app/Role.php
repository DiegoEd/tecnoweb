<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    public function accions()
    {
        return $this->belongsToMany(Accion::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function inrole($id)
    {
        foreach($this->accions as $accion)
        {
            if($accion->id == $id)
            {
                return ' checked ';
            }
        }
        return ' ';
    }
    
    protected $table = 'roles';

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
    protected $fillable = ['role', 'description'];

    
}
