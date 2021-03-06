<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->integer('num_po');
            $table->string('description', 100);
            $table->string('option', 100)->nullable();
            $table->date('date_order');
            $table->decimal('qty_po', 8, 2);
            $table->decimal('unit_price', 8, 2);
            $table->string('name_Superint', 50);
            $table->string('phone_Superint', 15);
            $table->unsignedBigInteger('house_id');

            $table->foreign('house_id')
                ->references('id')
                ->on('houses')
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
        Schema::dropIfExists('orders');
    }
}
