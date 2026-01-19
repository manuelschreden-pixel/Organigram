<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabelle: adressen
        Schema::create('adresses', function (Blueprint $table) {
            $table->bigIncrements('adress_id'); // eigener Primärschlüssel
            $table->string('street');
            $table->string('housenumber')->nullable();
            $table->string('plz');
            $table->string('town');
            $table->timestamps();            
        });

        // Tabelle: kunden
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('customer_id'); // eigener Primärschlüssel
            $table->string('prename');
            $table->string('surname');
            $table->unsignedBigInteger('adress_id')->nullable(); // Fremdschlüssel auf adressen
            $table->string('email')->unique()->nullable();
            $table->string('telephonenumber')->nullable();
            $table->timestamps();

            // Beziehung definieren
            $table->foreign('adress_id')
                  ->references('adress_id')
                  ->on('adresses')
                  ->cascadeOnDelete();
        });

        
    }

    public function down(): void
    {
        Schema::dropIfExists('adresses');
        Schema::dropIfExists('customers');
    }
};
