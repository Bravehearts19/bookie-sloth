<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->tinyInteger("n_guests");  /* va fino a 127 */
            $table->tinyInteger("n_beds");
            $table->tinyInteger("n_rooms");
            $table->tinyInteger("n_bathrooms");
            $table->smallInteger("size");  /* va fino a 32767 mq */
            $table->float("x_coordinate", 8, 5);
            $table->float("y_coordinate", 8, 5);
            $table->string("cover_img");
            $table->boolean("visible");
            $table->string("location");
            $table->string("address");
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
        Schema::dropIfExists('apartments');
    }
}
