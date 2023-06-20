<?php

namespace App\Http\Middleware;

use App\Models\Supplier;
use App\Models\Warehouse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDependencies
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('products/create') || $request->is('warehouses/create'))
        {
            $supplierCount = Supplier::count();
            $warehouseCount = Warehouse::count();

            if ($request->is('warehouses/create') && $supplierCount === 0) {
                return redirect()->route('dashboard')->with('error', 'Nejprve vytvořte dodavatele.');
            }

            if ($request->is('products/create') && $warehouseCount === 0) {
                return redirect()->route('dashboard')->with('error', 'Nejprve vytvořte sklad.');
            }
        }
        return $next($request);
    }
}
