<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId("apartment_id")->constrained();
            $table->foreignId("service_id")->constrained();
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
        Schema::table('apartment_service', function (Blueprint $table) {
            $table->dropForeign('apartment_service_apartment_id_foreign');    /* per togliere la foreign key */
            $table->dropColumn('apartment_id');   /* per cancellare la colonna */
        });

        Schema::table('apartment_service', function (Blueprint $table) {
            $table->dropForeign('apartment_service_service_id_foreign');    /* per togliere la foreign key */
            $table->dropColumn('service_id');   /* per cancellare la colonna */
        });

        Schema::dropIfExists('apartment_service');
    }
}
