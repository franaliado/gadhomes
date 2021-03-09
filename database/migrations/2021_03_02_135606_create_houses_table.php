<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Boolean;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('community_id')->nullable();
            $table->string('address', 150);
            $table->integer('lot');
            $table->integer('status');
            $table->boolean('withoutpo')->default(0);
            $table->date('start_date');
            //Datos del Subcontratista
            $table->unsignedBigInteger('subcontractor_id')->nullable();
            $table->decimal('amount_assigned_subc', 8, 2)->default(0);

            $table->foreign('community_id')
                ->references('id')
                ->on('community')
                ->onDelete('set null');

            $table->foreign('subcontractor_id')
                    ->references('id')
                    ->on('subcontractors')
                    ->onDelete('set null');

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
        Schema::dropIfExists('houses');
    }
}
