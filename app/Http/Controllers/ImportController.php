<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportStoreRequest;
use App\Import;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function store(ImportStoreRequest $request)
    {
        $import = new Import;

        $import->import_type_id = $request->import_type_id;
        $import->quantity = $request->quantity;
        $import->price = $request->price;
        $import->import_date = Carbon::today();

        $import->save();

        return compact('import');
    }
}
