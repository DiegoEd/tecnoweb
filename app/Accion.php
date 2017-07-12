<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    protected $table = 'accions';

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
    protected $fillable = ['name', 'pageroute','module_id'];

    
}
