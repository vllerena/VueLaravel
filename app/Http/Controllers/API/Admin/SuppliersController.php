<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Info\SupplierAttr;
use Image;
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

        if ($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo,0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
        }

        $supplier = Supplier::create([
            SupplierAttr::NAME => $request->name,
            SupplierAttr::EMAIL => $request->email,
            SupplierAttr::PHONE => $request->phone,
            SupplierAttr::ADDRESS => $request->address,
            SupplierAttr::PHOTO => isset($request->photo) ? $image_url : '',
            SupplierAttr::SHOPNAME => $request->shopname,
        ]);

        return response()->json($supplier);
    }
}
