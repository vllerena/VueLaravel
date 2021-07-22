<?php

namespace App\Models;

use App\Models\Info\SupplierAttr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = SupplierAttr::TABLE_NAME;

    protected $fillable = [
        SupplierAttr::NAME,
        SupplierAttr::EMAIL,
        SupplierAttr::PHONE,
        SupplierAttr::ADDRESS,
        SupplierAttr::PHOTO,
        SupplierAttr::SHOPNAME,
    ];
}
