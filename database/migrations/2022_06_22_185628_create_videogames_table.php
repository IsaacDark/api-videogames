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
        Schema::create('videogames', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            
            $table->date('publication_date');
            
            $table->unsignedBigInteger('user_id');

            $table->string('created_by')
                    ->default(null)
                    ->nullable();

            $table->string('updated_by')
                    ->default(null)
                    ->nullable();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

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
        Schema::dropIfExists('videogames');
    }
};
