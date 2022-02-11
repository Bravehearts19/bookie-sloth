<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnApartmentsIdToViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('views', function (Blueprint $table) {
            /* $table->unsignedInteger("apartment_id");
            $table->foreign("apartment_id")
                ->references("id")                  *****  SI PUO' USARE ALLO STESSO MODO DELLA RIGA SCRITTA QUI SOTTO  *****
                ->on("apartments"); */

            $table->foreignId("apartment_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('views', function (Blueprint $table) {
            $table->dropForeign('views_apartment_id_foreign');    /* per togliere la foreign key */
            $table->dropColumn('apartment_id');   /* per cancellare la colonna */
        });
    }
}