<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceOrderLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_order_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product');
            $table->integer('number');
            $table->integer('price');
            $table->unsignedInteger('invoice_order_id');
            $table->foreign('invoice_order_id')->references('id')->on('invoice_orders')->onDelete('cascade');
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
        Schema::dropIfExists('invoice_order_lines');
    }
}
