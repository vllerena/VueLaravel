<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Info\SupplierAttr;

class CreateSuppliersTable extends Migration
{
    private const SUPPLIERS_TABLE = SupplierAttr::TABLE_NAME;

    public function up()
    {
        Schema::create(self::SUPPLIERS_TABLE, function (Blueprint $table) {
            $table->id(SupplierAttr::ID);
            $table->string(SupplierAttr::NAME, 150);
            $table->string(SupplierAttr::EMAIL, 150)->unique();
            $table->string(SupplierAttr::PHONE, 10)->nullable();
            $table->string(SupplierAttr::ADDRESS, 150)->nullable();
            $table->text(SupplierAttr::PHOTO)->nullable();
            $table->string(SupplierAttr::SHOPNAME, 150)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::SUPPLIERS_TABLE);
    }
}
