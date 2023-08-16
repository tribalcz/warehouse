<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'weight', 'description', 'content', 'code', 'ean', 'price', 'qty', 'supplier_id', 'warehouse_id', 'isVariant'];

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

    public function images()
    {
        return $this->belongsToMany(Image::class, 'product_image');
    }

    public function getNumberOfImages()
    {
        return $this->images()->count();
    }

    public function getImagesPaths()
    {
        return $this->images()->get();
    }

    public function manufacturers()
    {
        return $this->belongsToMany(Manufacturer::class, 'product_manufacturer');
    }
}
