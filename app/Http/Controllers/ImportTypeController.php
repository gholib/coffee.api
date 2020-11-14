<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportTypeStoreRequest;
use App\ImportType;
use App\Services\TextConverter;
use Illuminate\Http\Request;

class ImportTypeController extends Controller
{
    public function getAll()
    {
        $importTypes = ImportType::all();

        return compact('importTypes');
    }

    public function store(ImportTypeStoreRequest $requiest)
    {
        $importType = new ImportType;

        $importType->name = TextConverter::convertToLatin($requiest->display_name);
        $importType->display_name = $requiest->display_name;
        $importType->price = $requiest->price;

        $importType->save();

        return compact('importType');
    }

    public function update(ImportTypeStoreRequest $requiest, $importTypeId)
    {
        $importType = ImportType::find($importTypeId);

        $importType->name = TextConverter::convertToLatin($requiest->display_name);
        $importType->display_name = $requiest->display_name;
        $importType->price = $requiest->price;

        $importType->update();

        return compact('importType');
    }

    public function destroy($importTypeId)
    {
        $importType = ImportType::find($importTypeId);

        $importType->delete();
    }
}
