<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle', function (Blueprint $table) {
            $table->id();
            $table->string('Vehicle_Reg_No');
            $table->string('Vehicle_Type');
            $table->string('Vehicle_Model');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('vehicle_status_id');
            $table->timestamps();
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade');
            $table->foreign('vehicle_status_id')->references('id')->on('vehicle_status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle');
    }
}
