<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUserIdToApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartments', function (Blueprint $table) {
            /* $table->unsignedInteger("user_id");
            $table->foreign("user_id")
                ->references("id")                  *****  SI PUO' USARE ALLO STESSO MODO DELLA RIGA SCRITTA QUI SOTTO  *****
                ->on("users"); */

            $table->foreignId("user_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropForeign('apartments_user_id_foreign');    /* per togliere la foreign key */
            $table->dropColumn('user_id');   /* per cancellare la colonna */
        });
    }
}