<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    public function productcategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public static function intrash()
    {
        return Product::withTrashed()->whereNotNull('deleted_at')->get();
    }

    public function isf($idcat)
    {
        return $this->productcategory_id==$idcat?'selected ':' ';
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
    protected $fillable = ['name', 'price', 'stock','productcategory_id'];

    
}
