<?php

namespace App\Http\Controllers;

use App\ImportType;
use Illuminate\Http\Request;

class ImportTypeController extends Controller
{
    public function getAll()
    {
        $importTypes = ImportType::all();

        return compact('importTypes');
    }
}
