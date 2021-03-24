<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionPoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descriptionpo', function (Blueprint $table) {
            $table->id();
            $table->string('description', 250);
            $table->string('option', 100)->nullable();
            $table->decimal('qty_po', 8, 2);
            $table->decimal('unit_price', 8, 2);
            $table->unsignedBigInteger('order_id');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

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
        Schema::dropIfExists('descriptionpo');
    }
}
