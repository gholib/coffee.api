<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function getAll()
    {
        $branches = Branch::all();

        return compact('branches');
    }
}
