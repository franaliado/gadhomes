<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentSubcontractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_subcontractors', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount_delivery_subc', 8, 2);
            $table->date('date_delivery_subc');
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
        Schema::dropIfExists('payment_subcontractors');
    }
}
