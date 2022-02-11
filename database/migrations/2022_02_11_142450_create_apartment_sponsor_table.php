<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateApartmentSponsorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_sponsor', function (Blueprint $table) {
            $table->id();
            $table->timestamp("expires_at");
            $table->foreignId("apartment_id")->constrained();
            $table->foreignId("sponsor_id")->constrained();
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
        Schema::table('apartment_sponsor', function (Blueprint $table) {
            $table->dropForeign('apartment_sponsor_apartment_id_foreign');    /* per togliere la foreign key */
            $table->dropColumn('apartment_id');   /* per cancellare la colonna */
        });

        Schema::table('apartment_sponsor', function (Blueprint $table) {
            $table->dropForeign('apartment_sponsor_sponsor_id_foreign');    /* per togliere la foreign key */
            $table->dropColumn('sponsor_id');   /* per cancellare la colonna */
        });

        Schema::dropIfExists('apartment_sponsor');
    }
}
