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
            $table->enum('name', ['pets', 'wheelchair', 'hairdryer', 'heating', 'air_conditioner', 'beach', 'tv', 'pool', 'fire_alarm', 'gym', 'washing_machine', 'fireplace', 'coffee_machine', 'wifi', 'car_charger', 'vault', 'skiing', 'breakfast', 'kitchen', 'bathroom'])->unique();
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
