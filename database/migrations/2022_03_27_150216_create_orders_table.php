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
            $table->text('name');
            $table->string('gander',50);
            $table->integer('number_phone');

            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');

            $table->bigInteger('Room_id')->unsigned();
            $table->foreign('Room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->integer('count_user');

            $table->string('status',50);
            $table->integer('value_status');

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->string('description', 100);

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
