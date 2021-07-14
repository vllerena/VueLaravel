<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Info\EmployeeAttr;
use Image;

class EmployeesController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('JWT');
//    }

    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            EmployeeAttr::NAME => 'required',
            EmployeeAttr::EMAIL => 'required | email | unique:employees',
            EmployeeAttr::PHONE => 'required | unique:employees',
        ]);

        if ($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo,0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
        }

        $employe = Employee::create([
            EmployeeAttr::NAME => $request->name,
            EmployeeAttr::EMAIL => $request->email,
            EmployeeAttr::PHONE => $request->phone,
            EmployeeAttr::SALLERY => $request->sallery,
            EmployeeAttr::ADDRESS => $request->address,
            EmployeeAttr::PHOTO => isset($request->photo) ? $image_url : '',
            EmployeeAttr::NID => $request->nid,
            EmployeeAttr::JOINING_DATE => $request->joining_date,
        ]);

        return response()->json($employe);
    }
}
