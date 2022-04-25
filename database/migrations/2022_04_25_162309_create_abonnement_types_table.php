<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonnement_types', function (Blueprint $table) {
            $table->id();
            $table->string('abonnement');
            $table->string('coach')->default("-");
            $table->string('coach_specialization')->default("-");
            $table->bigInteger('lenght');
            $table->double('price', 4, 1);
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
        Schema::dropIfExists('abonnement_types');
    }
};
