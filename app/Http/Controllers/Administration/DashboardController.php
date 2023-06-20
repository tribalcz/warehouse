<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(10)->get();
        $warehouses = Warehouse::latest()->take(10)->get();
        $suppliers = Supplier::latest()->take(10)->get();

        return view('dashboard', compact('products', 'warehouses', 'suppliers'));
    }
}
