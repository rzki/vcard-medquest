<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->uuid('contactId');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('phone_number2')->nullable();
            $table->string('email');
            $table->string('st_address');
            $table->string('city_address');
            $table->string('province_address');
            $table->string('postcode_address');
            $table->string('country_address');
            $table->string('dept');
            $table->string('title');
            $table->string('barcode');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
