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
            $table->integer('num_po', 15)->unique(););
            $table->date('date_order');
            $table->string('type_PO', 2);
            $table->string('name_Superint', 50);
            $table->string('phone_Superint', 15);
            $table->boolean('paid')->default(0);
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
