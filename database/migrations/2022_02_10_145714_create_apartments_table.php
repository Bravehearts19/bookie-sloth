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
            $table->tinyInteger("n_rooms");
            $table->tinyInteger("n_bathrooms");
            $table->smallInteger("size");  /* va fino a 32767 mq */
            $table->float("price", 8, 2);
            $table->float("x_coordinate", 8, 5);
            $table->float("y_coordinate", 8, 5);
            $table->string("cover_img")->default('url 404 not found');
            $table->boolean("visible")->default(true);
            $table->string("address");
            $table->string("location");
            $table->string("cap");
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
