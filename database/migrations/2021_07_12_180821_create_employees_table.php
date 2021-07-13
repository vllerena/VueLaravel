<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Info\EmployeeAttr;

class CreateEmployeesTable extends Migration
{
    private const EMPLOYEES_TABLE = EmployeeAttr::TABLE_NAME;

    public function up()
    {
        Schema::create(self::EMPLOYEES_TABLE, function (Blueprint $table) {
            $table->id(EmployeeAttr::ID);
            $table->string(EmployeeAttr::NAME, 150);
            $table->string(EmployeeAttr::EMAIL, 150)->unique();
            $table->string(EmployeeAttr::PHONE, 10)->nullable();
            $table->double(EmployeeAttr::SALLERY, 16 ,2)->nullable();
            $table->string(EmployeeAttr::ADDRESS, 150)->nullable();
            $table->text(EmployeeAttr::PHOTO)->nullable();
            $table->string(EmployeeAttr::NID, 50)->nullable();
            $table->date(EmployeeAttr::JOINING_DATE)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::EMPLOYEES_TABLE);
    }
}
