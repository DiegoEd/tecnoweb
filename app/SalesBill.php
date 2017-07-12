<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesBill extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sales_bills';

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function salebilldetails() {
        return $this->hasMany(SaleBillDetail::class);
    }

    public function isf($idclient)
    {
        return $this->client_id==$idclient?'selected ':' ';
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
    protected $fillable = ['salesdate', 'totalamount','confirmed', 'employee_id', 'client_id'];

    
}
