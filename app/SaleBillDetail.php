<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleBillDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sale_bill_details';

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function salesbill() {
        return $this->belongsTo(SalesBill::class);
    }

    public function isf($idprod)
    {
        return $this->product_id==$idprod?'selected ':' ';
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
    protected $fillable = ['price', 'amount', 'product_id', 'sales_bill_id'];

    
}
     