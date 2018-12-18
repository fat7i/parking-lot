<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('action', ['park', 'depart']);
            $table->unsignedInteger('lot_id')->index();
            $table->unsignedInteger('parkable_id')->index();
            $table->timestamps();

            $table->foreign('lot_id')
                ->references('id')->on('lots')
                ->onDelete('cascade');

            $table->foreign('parkable_id')
                ->references('id')->on('parkables')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movements');
    }
}
