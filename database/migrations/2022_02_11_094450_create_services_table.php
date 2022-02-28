<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->enum('name', ['Animali', 'Disabilità', 'Riscaldamento', 'Mare', 'Tv', 'Piscina', 'Palestra', 'Macchina del caffè', 'Wi-fi', 'Auto elettriche', 'Cassaforte', 'Colazione'])->unique();
            $table->string('icon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
