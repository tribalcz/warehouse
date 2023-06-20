<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'warehouse';
    protected $fillable = ['supplier_id', 'address'];

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'warehouse_supplier');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_warehouse');
    }
}
