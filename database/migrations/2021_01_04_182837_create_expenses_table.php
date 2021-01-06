<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('description');
            $table->string('amount');
            $table->integer('status');//0=fixed and 1 =reccurent
            $table->string('currency')->default('dollar');
            $table->date('date');
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->foreignId('category_id')->constrained('category')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('expenses');
    }
}
