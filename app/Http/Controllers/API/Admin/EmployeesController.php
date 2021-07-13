<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Info\EmployeeAttr;

class EmployeesController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('JWT');
//    }

    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees, 200);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            EmployeeAttr::NAME => 'required',
            EmployeeAttr::EMAIL => 'required | email | unique:employees',
            EmployeeAttr::PHONE => 'nullable',
        ]);
        return response()->json($request);
    }
}
