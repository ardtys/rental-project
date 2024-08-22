<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('motorcycle', function (Blueprint $table) {
            $table->id('motorcycle_id')->autoIncrement();
            $table->enum('merk_motor', ['Honda', 'Yamaha', 'Suzuki', 'Kawasaki', 'Vespa', 'TVS', 'Bajaj']);
            $table->enum('motor_type', ['Sport', 'Matic', 'Cub', 'Naked', 'Adventure', 'Cruiser', 'Touring']);
            $table->year('year');
            $table->string('nama_motor');
            $table->string('plat_nomor');
            $table->double('ganti_oli', 15, 2);
            $table->double('cleaning_cvt', 15, 2);
            $table->double('service_etc', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('motorcycle');
    }
};