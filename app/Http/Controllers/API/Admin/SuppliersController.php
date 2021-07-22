<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Info\SupplierAttr;

class SuppliersController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }

    public function show(Supplier $supplier)
    {
        return response()->json($supplier);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            SupplierAttr::NAME => 'required',
            SupplierAttr::EMAIL => 'required | email | unique:suppliers',
            SupplierAttr::PHONE => 'required | unique:suppliers',
        ]);
    }
}
