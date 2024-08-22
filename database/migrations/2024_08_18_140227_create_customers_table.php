<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('telephone_number', 15, 0);
            $table->decimal('passport_code', 15, 0);
            $table->string('passport_image');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('motorcycle_id')->constrained('motorcycles');
            $table->decimal('rate_per_day', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rentals');
    }
};