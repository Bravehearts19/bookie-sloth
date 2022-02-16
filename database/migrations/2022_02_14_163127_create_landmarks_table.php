<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId("apartment_id")->constrained();
            $table->string("label");
            $table->string("distance");
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
        Schema::table('landmarks', function (Blueprint $table) {
            $table->dropForeign('landmarks_apartment_id_foreign');    /* per togliere la foreign key */
            $table->dropColumn('apartment_id');   /* per cancellare la colonna */
        });

        Schema::dropIfExists('landmarks');
    }
}
