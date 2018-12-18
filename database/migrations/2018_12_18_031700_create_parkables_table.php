<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkables',function (Blueprint $table){
            $table->increments('id');
            $table->string('plate')->index();
            $table->enum('type',['bus','car','motorbike']);
            $table->timestamps();
        });


        Schema::create('lot_parkable',function (Blueprint $table){
            $table->unsignedInteger('lot_id')->index();
            $table->unsignedInteger('parkable_id')->index();

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
        Schema::dropIfExists('parkables');
        Schema::dropIfExists('lot_parkable');
    }
}
