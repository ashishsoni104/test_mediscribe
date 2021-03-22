<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("company_id")->unsigned();
            $table->string("fullname");
            $table->string("email")->unique();
            $table->string("phone");
            $table->string("profile_picture");
            $table->string("dob");
            $table->string("designation");
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
