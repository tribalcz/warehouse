<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'url', 'weight', 'description', 'content', 'code', 'ean', 'price', 'qty', 'supplier_id', 'warehouse_id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, 'product_warehouse');
    }

    public function getAvailableWarehouses()
    {
        return $this->warehouses()->get();
    }
}
