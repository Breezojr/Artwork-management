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
            $table->foreignId('user_id')->onDelete('cascade')->onUpdate('cascade');
            $table->string('note');
            $table->string('name');
            $table->string('client_name');
            $table->integer('phon_no')->nullable();
            $table->string('email')->unique()->nullable();
            $table->decimal('price', 10, 2);
            $table->text('description');
            $table->enum('status', ['Pending', 'Completed'])->default('Pending');
            $table->json('image')->nullable();
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
