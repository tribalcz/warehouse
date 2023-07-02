<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address'];

    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, 'warehouse_supplier');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
