<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();   /* required */
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');   /* required */
            $table->rememberToken();
            $table->timestamps();

            /* aggiungere data di nascita e cognome */
            /* $table->string('surname');              DA RICONTROLLARE
            $table->date('date_of_birth'); */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
