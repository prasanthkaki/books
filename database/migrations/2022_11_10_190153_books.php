<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books',function(Blueprint $table){
            $table->id();
            $table->bigInteger('author_id')->references('id')->on('authors');
            $table->dateTimeTz('created_datetime')->useCurrent();
            $table->dateTimeTz('modified_datetime')->useCurrent();
            $table->string('name')->nullable(false);
            $table->boolean('active')->default(1);
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
