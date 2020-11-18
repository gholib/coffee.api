<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleStoreRequest;
use App\Import;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function store(SaleStoreRequest $request)
    {
        $sales = [];

        foreach ($request->sales as $sale) {
            $sales[] = [
                'menu_item_id' => $sale['menu_item_id'],
                'sale_date' => Carbon::today(),
                'created_at' => Carbon::now(),
            ];
        }

        DB::table('sales')->insert($sales);
    }

    public function calculation()
    {
        $calculations = Sale::select(DB::raw('COUNT(menu_item_id) as count'),
            'menu_items.price',
            'menu_items.cost_price',
            'menu_items.display_name')
            ->join('menu_items', function ($join) {
                $join->on('sales.menu_item_id', '=', 'menu_items.id');
            })
            ->today()
            ->groupBy('menu_item_id')
            ->get();

        return compact('calculations');

    }

    public function getLeftOvers()
    {
        $imports = Import::select(DB::raw('COUNT(import_type_id) as count'),
            DB::raw('SUM(quantity) as import_quantity'),
            'import_types.name as import_name',
            'import_types.display_name as import_display_name',)
            ->join('import_types', function ($join) {
                $join->on('imports.import_type_id', '=', 'import_types.id');
            })
            ->groupBy('import_type_id')
            ->get()->toArray();
        $sales = Sale::select(DB::raw('COUNT(menu_item_id) as count'),
            'menu_items.price',
            'menu_items.cost_price',
            'menu_items.display_name',
            'import_types.price as import_price',
            'import_types.name as import_name')
            ->join('menu_items', function ($join) {
                $join->on('sales.menu_item_id', '=', 'menu_items.id');
            })
            ->join('import_types', function ($join) {
                $join->on('menu_items.import_type_id', '=', 'import_types.id');
            })
            ->groupBy('menu_items.import_type_id')
            ->get();

        return compact('sales', 'imports');
    }
}
