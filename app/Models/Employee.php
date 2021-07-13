<?php

namespace App\Models;

use App\Models\Info\EmployeeAttr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = EmployeeAttr::TABLE_NAME;

    protected $fillable = [
        EmployeeAttr::NAME,
        EmployeeAttr::EMAIL,
        EmployeeAttr::PHONE,
        EmployeeAttr::SALLERY,
        EmployeeAttr::ADDRESS,
        EmployeeAttr::PHOTO,
        EmployeeAttr::NID,
        EmployeeAttr::JOINING_DATE,
    ];
}
