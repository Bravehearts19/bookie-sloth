<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId("apartment_id")->constrained();
            $table->float("rating", 3, 1);
            $table->string("badge");
            $table->integer("total_count");
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
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropForeign('ratings_apartment_id_foreign');    /* per togliere la foreign key */
            $table->dropColumn('apartment_id');   /* per cancellare la colonna */
        });

        Schema::dropIfExists('ratings');
    }
}
